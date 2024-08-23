import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const Edit = ({ user }) => {
    const [name, setName] = useState(user.name || '');
    const [bio, setBio] = useState(user.bio || '');
    const [profileImage, setProfileImage] = useState(null);

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('name', name);
        formData.append('bio', bio);
        if (profileImage) formData.append('profile_image', profileImage);

        Inertia.post('/profile/update', formData, { forceFormData: true });
    };

    return (
        <div>
            <h1>Edit Profile</h1>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    placeholder="Name"
                />
                <textarea
                    value={bio}
                    onChange={(e) => setBio(e.target.value)}
                    placeholder="Bio"
                ></textarea>
                <input
                    type="file"
                    onChange={(e) => setProfileImage(e.target.files[0])}
                />
                <button type="submit">Update Profile</button>
            </form>
        </div>
    );
};

export default Edit;