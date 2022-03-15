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
