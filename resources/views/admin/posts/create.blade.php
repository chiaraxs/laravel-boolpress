@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add a post &hearts;
                </div>

                <div class="card-body d-flex justify-content-center">

                    
                    {{-- form --}}
                    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- title gestiti con errori & old --}}
                        <div class="mb-2 ">
                            <label for="title" class="me-4">Title</label>
                            <input type="text" name="title" placeholder="Insert Title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>

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

                        {{-- content gestito con errori & old --}}
                        <div>
                            <label for="content" class="me-1">Content</label>
                            <textarea name="content" cols="40" rows="10" class="form-control @error('title') is-invalid @enderror" placeholder="Insert your post's content" required>{{ old('content') }}</textarea>

                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        {{-- /content --}}

                        {{-- category select --}}
                        <div class="mb-2">
                            <label>Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">----</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id') === $category->id) selected @endIf>
                                    {{ $category->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- /category select --}}

                        {{-- tags checkbox --}}
                        {{-- n.b. -> name="tags[]" in input -> grazie alle quadre finali, rimanda al server un array di tags --}}
                        <div class="mb-2">
                            <p class="fw-bold">Tags</p>

                            @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tag_{{$tag->id}}" value="{{$tag->id}}" name="tags[]">
                                <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                            </div>
                            @endforeach

                        </div>
                        {{-- /tags checkbox --}}


                        <div class="d-flex justify-content-center mt-4">
                            {{-- submit button --}}
                            <button type="submit" class="btn btn-mint mx-2" value="Create post">Create</button>
                            {{-- /submit button --}}

                            {{-- link per annullare il post appena creato --}}
                            <a href="{{ route('admin.posts.index')}}" class="btn btn-plum">Undo</a>
                            {{-- /link per annullare il post appena creato --}}
                        </div>

                    </form>
                    {{-- /form --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

