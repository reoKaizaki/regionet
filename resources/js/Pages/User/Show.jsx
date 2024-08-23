import React from 'react';
import { Inertia } from '@inertiajs/inertia';

const Show = ({ user, isFollowing }) => {
    const handleFollow = () => {
        Inertia.post(`/follow/${user.id}`);
    };

    const handleUnfollow = () => {
        Inertia.post(`/unfollow/${user.id}`);
    };

    return (
        <div>
            <h1>{user.name}</h1>
            <p>{user.bio}</p>
            <div>
                <strong>Posts:</strong>
                <ul>
                    {user.posts.map(post => (
                        <li key={post.id}>{post.content}</li>
                    ))}
                </ul>
            </div>
            <button onClick={user.isFollowing ? handleUnfollow : handleFollow}>
                {user.isFollowing ? 'Unfollow' : 'Follow'}
            </button>
        </div>
    );
};

export default Show;