@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Add a post &hearts;
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("put")

                        {{-- title --}}
                        <div class="mb-3">
                            <label class="fw-bold">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Insert title" value="{{ old('title', $post->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- /title --}}

                        {{-- post img --}}
                        <div class="mb-3">
                            <label class="fw-bold">Post's Image</label>
                            <input type="file" name="img" class="form-control @error('img') is-invalid @enderror" placeholder="Insert img" required>
                            @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- /post img --}}

                        {{-- content --}}
                        <div class="mb-3">
                            <label class="fw-bold">Content</label>
                            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Insert your post's content" required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- /content --}}

                        {{-- category select --}}
                        <div class="mb-2">
                            <label class="fw-bold">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">----</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($post->category_id === $category->id) selected @endIf>
                                        {{ $category->type }}</option>
                                    @endforeach
                            </select>
                        </div>
                        {{-- /category select --}}

                        {{-- tags checkbox --}}
                        {{-- n.b. -> name="tags[]" in input -> grazie alle quadre finali, rimanda al server un array di tags --}}
                        {{-- contains -> se i tags contengono il tag ciclato -> checked (selezionati di default)-> altrimenti non sono pre-selezionati --}}
                        <div class="mb-2">
                            <p class="fw-bold">Tags</p>
                            
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tag_{{$tag->id}}" value="{{$tag->id}}" name="tags[]"
                                    {{$post->tags->contains($tag) ?  'checked' : ''}}>
                                    <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                                </div>
                            @endforeach
                            
                        </div>
                        {{-- /tags checkbox --}}

                        <div class="form-group">
                            {{-- submit button --}}
                            <button type="submit" class="btn btn-primary mx-2" value="Create post">Edit</button>
                            {{-- /submit button --}}

                            {{-- link per annullare il post appena creato --}}
                            <a href="{{ route('admin.posts.index')}}" class="btn btn-primary">Undo</a>
                            {{-- /link per annullare il post appena creato --}}

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
