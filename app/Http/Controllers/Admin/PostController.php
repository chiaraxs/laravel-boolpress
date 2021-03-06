<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", compact("categories", 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->validate([
            'title'=> 'required|min:5',
            'content'=> 'required|min:10',
            'category_id'=>'nullable',
            'tags'=>'nullable',
            'img'=> 'nullable',
        ]);

        $post = new Post();
        $post->fill($data);


        $post->slug = $this->generateUniqueSlug($request['title']);
        $post->user_id = Auth::user()->id;

        // assegazione img e controllo esistenza post img e storage
        if(key_exists('img', $data)){
            $post->img = Storage::put('img', $data['img']);     // specifico la cartella in public/storage/img (oppure null oppure stringa vuota) e come secondo argomento -> l'istanza img in data 
        }
        // /assegazione img e controllo esistenza post img e storage


        $post->save();

        if (key_exists("tags", $data)) {
            $post->tags()->attach($data["tags"]);
        }

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
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post'=> $post,
            'categories'=> $categories,
            'tags' => $tags
        ]);
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
            'content' => 'required|min:10',
            'category_id'=> 'nullable|exists:categories,id',
            'tags'=> 'nullable|exists:tags,id',    // in fase di validazione quando riceve il tags e per ogni tags cercher?? se esiste nel db un tag con quell'id, se non esiste avr?? un errore
            'img'=> 'nullable',
        ]);

        $post = Post::findOrFail($id);

        // se il titolo del post ?? diverso dal titolo del post che ho nel mio db -> parte la funzione dello slug
        // cio?? -> se l'utente ha cambiato titolo, rigenera lo slug
        // altrimenti ->
        if ($data['title'] !== $post->title) {
            $data['slug'] = $this->generateUniqueSlug($data['title']);
        }

        // controllo esistenza post img e update
        if (key_exists('img', $data)){
            
            // controllo esistenza image old -> se esiste gi?? un'img x post, cancella la vecchia e salva la nuova caricata
            if($post->img){
                Storage::delete($post->img);
            }
            // /controllo esistenza image old 
            
            // storage in cartella storage/img del $data -> img
            $post->img = Storage::put('img', $data ['img']);

            // save del post aggiornato con i $data
            $post->save();
        }
        // /controllo esistenza post img e update


        $post->update($data);

        // aggiorno la tabella ponte post_tag
        // il post invoca la funzione tag(che contiene la relazione molti a molti)->
        // detach -> rimuove la relazione esistente con i tag presenti per il post corrente
        // attach -> al contrario, per il post corrente aggiunge le relazioni posts/tags -> crea una riga nel pivot con l'id del post corrente
        // $post->tags()->detach();
        // $post->tags()->attach($data['tags']);

        // se esiste il tag -> sync
        // il sync fa detach e attach contemporaneamente
        // il detach solo per gli elementi non pi?? esistenti
        // l'attach solo dei nuovi elementi
        // altrimenti -> detach

        if (key_exists("tags", $data)) {
            $post->tags()->sync($data["tags"]);
        } else {
            $post->tags()->detach();
        }

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

        $post->tags()->detach();     // per far funzionare correttamente il softdelete senza perdere le relazioni, 
                                    // questa riga del detach() andrebbe commentata -> basta solo il delete()
        
        $post->delete();
        return redirect()->route('admin.posts.index');
    
    }

    protected function generateUniqueSlug($postTitle) {
        // SLUG -> rende unico il titolo del post -> se c'?? un doppione aggiunge, con il counter, un id incrementale
        // genero lo slug
        $slug = Str::slug($postTitle);

        // fase di controllo: $exists dice se esiste gi?? una riga con quello slug
        // il first() restituisce null quando non trova l???elemento (quindi lo slug ?? univoco)
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

