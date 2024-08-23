<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function create(Post $post)
    {
        return Inertia::render("Post/Comment", ["article" => $post]);
        // $post_id = Comment::with('post')->where('post_id', $post_id)->get();
        // return Inertia::render('Post/Comment', [
        //     'posts_id' => $post_id
        // ]);
    }
    
    public function store(Request $request)
    {
        
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Comment::create([
        //     'user_id' => auth()->id(),
        //     'post_id' => $postId,
        //     'content' => $request->input('content'),
        // ]);

        // return Redirect::to('/posts/${post.id}');
        
       $comment = new Comment();
       $comment->content = $request->content;
       $comment->post_id = $request->post_id;
       $comment->user_id = auth()->id();
       $comment->save();

       return redirect('/posts/' .  $request->post_id);
    }
}
