@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                   Post Details {{ $post->title }}
                </div>

                <div class="card-body">

                    {{ $post->content }}

                </div>

                {{-- ROTTA DA MODIFICARE --}}
                <a href="{{route('admin.posts.create')}}" class="btn btn-info" value="Edit your post">Edit your post</a>



            </div>
        </div>
    </div>
</div>
@endsection
