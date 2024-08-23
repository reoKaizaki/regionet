import React, { useState } from 'react';
import { Link, useForm } from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Inertia } from '@inertiajs/inertia';

const Comment = (props) => {
    // const [content, setContent] = useState('');
    const { article } = props;
    console.log(article.id);
    //const post_id = post;
    const { data, setData, post } = useForm({
     post_id : article.id,
     content : ""
})
   

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/posts/{post}/comments');
    }; 
    
    
    return (
            <Authenticated user={props.auth.user} header={
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Comment
                    </h2>
                }>

                <div className="p-12">
                    
                    

                    <form onSubmit={handleSubmit}>
                        <textarea
                            onChange={(e) => setData("content", e.target.value)}
                            required
                        ></textarea>
                        
                        <button type="submit">Create</button>
                    </form>

                    <Link href={`/posts/${article.id}`}>Back To Post</Link>
                </div>

            </Authenticated>
            );
    }

export default Comment;
