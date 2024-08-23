import React from "react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Link } from '@inertiajs/react';//

const Index = (props) => {
    const { posts } = props;
    console.log(props); // 確認用に追加

    return (
        <Authenticated user={props.auth.user} header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Index
                </h2>
            }>
            
            <div className="p-12">
                <h1>Posts</h1>
                <Link href="/posts/create">Create</Link>

                { posts.map((post) => (
                    <div key={post.id}>
                        <h2>
                            <Link href={`/users/${post.user.id}`}>{post.user.screen_name}</Link>
                        </h2>
                        <h2>
                            <Link href={`/posts/${post.id}`}>{post.content}</Link>
                        </h2>
                    </div>
                )) }
                
                

            </div>
            
        </Authenticated>
        );
}

export default Index;