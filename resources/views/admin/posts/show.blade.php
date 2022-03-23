@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                {{-- title --}}
                <div class="card-header d-flex title">
                   
                   {{$post->title}}

                </div>
                {{-- /title --}}

                {{-- post img --}}
                @if ($post->img)
                    <img src="{{ asset('storage/' . $post->img) }}" class="img-fluid" alt="">
                @else
                    <p class="text-center">No Image</p>
                @endif
                {{-- /post img --}}

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

                {{-- dettagli ora/data post --}}
                <div>
                    <p class="ms-3 fw-light"><span class="text-decoration-underline">Post details:</span>
                        <br>
                        Update: {{ $post->created_at->format('l jS \\of F Y h:i:s A') }}
                        <br>
                        Last update: {{ $post->updated_at->diffForHumans(['$post->updated_at' => Carbon::ONE_DAY_WORDS]) }}
                    </p>
                </div>
                {{-- dettagli ora/data post --}}

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
                        <a href="#"><span class="badge badge-pink">#{{$tag->name}}</span></a>
                    @endforeach
                </div>
                {{-- /tags --}}
                
                {{-- edit/destroy container --}}
                <div class="d-flex justify-content-center">
                    
                    {{-- edit button --}}
                    <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-mint me-2 mb-2">Edit your post</a>
                    {{-- edit button --}}

                    {{-- destroy button --}}
                    <form action="{{ route('admin.posts.destroy', $post->slug)}}" method="post">
                        @csrf

                        @method('delete')

                        <button type="submit" class="btn btn-plum">Delete</button>
                    </form>
                    {{-- /destroy button --}}

                </div>  
                {{-- /edit/destroy container --}}
            </div>
        </div>
    </div>
</div>
@endsection
