import React, { useState } from 'react';
import { Link, } from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Inertia } from '@inertiajs/inertia';

const Create = (props) => {
    const [content, setContent] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.post('/posts', { content });
    };

    return (
            <Authenticated user={props.auth.user} header={
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Create
                    </h2>
                }>

                <div className="p-12">

                    <form onSubmit={handleSubmit}>
                        <textarea
                            value={content}
                            onChange={(e) => setContent(e.target.value)}
                            required
                        ></textarea>
                        
                        <button type="submit">Create</button>
                    </form>

                    <Link href="/posts">Back To List</Link>
                </div>

            </Authenticated>
            );
    }

export default Create;
