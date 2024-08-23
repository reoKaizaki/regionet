<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with("user")->get();
        return Inertia::render("Post/Index", [
            "posts" => $posts
        ]);
        
    }
    
    
}
