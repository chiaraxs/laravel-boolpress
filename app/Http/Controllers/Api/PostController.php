<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'category_id' => 'nullable',
            'tags' => 'nullable',
        ]);

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->user_id = 1;   // 1 è l'id dell'user loggato
        $newPost->save();

        return response()->json($newPost);
    }

    public function show($id)
    {
        // la funzione with -> inserisce nello show anche i tags/user/category (come fosse un join)
        // tags/user/category sono dichiarati nel model Post.php
        $post = Post::where('id', $id)->with(['tags', 'user', 'category'])->first();

        return response()->json($post);
    }
}
