@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your posts
                    <a class="d-flex justify-content-end" href="{{route('admin.posts.create')}}">Add post</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">

                        {{-- foreach --}}
                        @foreach ($posts as $post )
                            <li class="list-group-item">{{$post->title}}</li>
                            <a href="{{route('admin.posts.show', $post->slug)}}">Details</a>
                        @endforeach
                        {{-- /foreach --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

