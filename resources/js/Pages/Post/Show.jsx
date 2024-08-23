import React from "react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Link } from '@inertiajs/react';

const Show = (props) => {
    const { user } = props;
    const { article } = props;
    const { comment } = props;
    console.log(comment);

    return (
        <Authenticated user={props.auth.user} header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Show
                </h2>
            }>
            
            <div className="p-12">
                
                <div>
                    <h1>{user.screen_name}</h1>
                    <p>{article.content}</p>
                </div>
                <div>
                    <h1>コメント：</h1>
                    
                    { comment.map((comment) => (
                        <div key={comment.id}>
                            <h2>{comment.content}</h2>
                        </div>
                    )) }
                    
                    
                </div>
                
                <div>
                    <Link href={`/posts/${article.id}/comments/create`}>Comment</Link>
                </div>
                
                <div>
                    <Link href="/posts">Back To List</Link>
                </div>
            </div>
            
        </Authenticated>
        );
}

export default Show;

