<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(4);     // funzione che modifica la struttura dei dati e li divide in pagine (qui 4 elementi x pag)
        $posts->load('user', 'category', 'tags');    // aggiunge anche i dettagli user, tags e category

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

    public function show($slug)
    {
        // la funzione with -> inserisce nello show anche i tags/user/category (come fosse un join)
        // tags/user/category sono dichiarati nel model Post.php
        // alternativa al with -> load
        $post = Post::where('slug', $slug)->with(['tags', 'user', 'category'])->first();


        return response()->json($post);
    }
}
