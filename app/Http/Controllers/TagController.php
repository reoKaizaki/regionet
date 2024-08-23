<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;

class TagController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'tags' => 'required|array',
        ]);

        $post = Post::findOrFail($postId);

        $tags = $request->input('tags');
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        }

        return Redirect::to('/posts/${post.id}');
    }
}