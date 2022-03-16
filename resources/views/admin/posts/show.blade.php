@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                {{-- title --}}
                <div class="card-header d-flex">
                   
                   {{$post->title}}

                </div>
                {{-- /title --}}

                {{-- content --}}
                <div class="card-body">

                    {{$post->content}}

                </div>
                {{-- /content --}}

                {{-- dettagli user --}}
                <div>
                    <p class="ms-3"> User: {{ $post->user->name }} 
                    <br>
                    Mail: {{ $post->user->email }}</p>
                </div>
                {{-- dettagli user --}}

                {{-- category --}}
                @if(isset($post->category))
                    <div>
                        <p class="ms-3"><span class="fw-bold">Category:</span> {{ $post->category->type }}</p>
                    </div>
                @endif
                {{-- /category --}}

                {{-- tags --}}
                <div class="ms-3">
                    <span class="fw-bold">Tags:</span>
                    @foreach ($post->tags as $tag )
                        <a href="#"><span class="badge bg-info text-dark">#{{$tag->name}}</span></a>
                    @endforeach
                </div>
                {{-- /tags --}}
                
                {{-- edit/destroy container --}}
                <div class="d-flex justify-content-center">
                    
                    {{-- edit button --}}
                    <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-info me-2 mb-2">Edit your post</a>
                    {{-- edit button --}}

                    {{-- destroy button --}}
                    <form action="{{ route('admin.posts.destroy', $post->slug)}}" method="post">
                        @csrf

                        @method('delete')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    {{-- /destroy button --}}

                </div>  
                {{-- /edit/destroy container --}}
            </div>
        </div>
    </div>
</div>
@endsection
