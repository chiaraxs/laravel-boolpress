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
        $post = new Post();
        $post->fill($request->validate([
            'title'=> 'required|min:5',
            'content'=> 'required|min:10'
        ]));


        $post->slug = $this->generateUniqueSlug($request['title']);

        $post->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('admin.posts.edit', compact('post'));
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
        $data = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10|max:200'
        ]);

        $post = Post::findOrFail($id);

        // se il titolo del post è diverso dal titolo del post che ho nel mio db -> parte la funzione dello slug
        // cioè -> se l'utente ha cambiato titolo, rigenera lo slug
        // altrimenti ->
        if ($data['title'] !== $post->title) {
            $data['slug'] = $this->generateUniqueSlug($data['title']);
        }

        $post->update($data);
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->delete();
        return redirect()->route('admin.posts.index');
    
    }

    protected function generateUniqueSlug($postTitle) {
        // SLUG -> rende unico il titolo del post -> se c'è un doppione aggiunge, con il counter, un id incrementale
        // genero lo slug
        $slug = Str::slug($postTitle);

        // fase di controllo: $exists dice se esiste già una riga con quello slug
        // il first() restituisce null quando non trova l’elemento (quindi lo slug è univoco)
        // Quindi vuoi ciclare fino a quando $exists non diventa null (false)
        // Fino a quando non succede, incrementi il contatore e provi un nuovo slug
        // se il valore non esiste -> assegno il nuovo valore al $newSlug
        $exists = Post::where('slug', $slug)->first();
        $counter = 1;

        while ($exists) {
            $newSlug = $slug . '-' . $counter;
            $counter++;

            $exists = Post::where('slug', $newSlug)->first();

            if (!$exists) {
                $slug = $newSlug;
            }
        }
        
        // ritorna lo $slug
        return $slug;

    }
}

