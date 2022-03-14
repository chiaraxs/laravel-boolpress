<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact ('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPost = new Post();
        $newPost->fill($request->validate([
            'title'=> 'required|min:5',
            'content'=> 'required|min:10|max:200'
        ]));

        // SLUG -> rende unico il titolo del post -> se c'è un doppione aggiunge, con il counter, un id incrementale
        // genero lo slug
        $slug = Str::slug($newPost->title);

        // fase di controllo: $exists dice se esiste già una riga con quello slug
        // il first() restituisce null quando non trova l’elemento (quindi lo slug è univoco)
        // Quindi vuoi ciclare fino a quando $exists non diventa null (false)
        // Fino a quando non succede, incrementi il contatore e provi un nuovo slug
        // se il valore non esiste -> assegno il nuovo valore al $newSlug
        $exists = Post::where('slug', $slug)->first();
        $counter = 1;
        
        while($exists){
            $newSlug = $slug . '-' . $counter;
            $counter++;
            $exists = Post::where('slug', $newSlug)->first();

            if(!$exists) {
                $slug = $newSlug;
            }
        }

        // assegno il valore di $slug al nuovo post
        $newPost->slug = $slug;
        // /SLUG

        $newPost->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
