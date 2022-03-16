@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Posts &hearts;
                    <a class="d-flex justify-content-end" href="{{route('admin.posts.create')}}">Add post</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">

                        {{-- foreach --}}
                        @foreach ($posts as $post )
                            <li class="list-group-item fw-bold">{{$post->title}}</li>

                            {{-- category --}}
                            {{-- se la categoria esiste -> la mostra --}}
                            {{-- altrimenti mostra stringa 'no category' --}}
                            <li class="list-group-item fst-italic">{{ isset($post->category) ? $post->category->type : 'No Category'}}</li>
                            {{-- /category --}}

                            {{-- tags --}}
                            <li class="list-group-item fst-italic">{{ isset($post->tag) ? $post->tag->name : 'No Tags'}}</li>
                            {{-- /tags --}}

                            {{-- dettagli user --}}
                             <li class="list-group-item">
                                <p class="ms-3 fw-light"><span class="text-decoration-underline"> Author:</span>
                                   <br>
                                    Name: {{ $post->user->name }}
                                    <br>
                                    Mail: {{ $post->user->email }}
                                </p>
                             </li>
                            {{-- dettagli user --}}


                            {{-- link to details --}}
                            <div class="d-flex justify-content-center mx-2 my-2">
                                <a href="{{route('admin.posts.show', $post->slug)}}">Details</a>
                            </div>
                            {{-- /link to details --}}  

                        @endforeach
                        {{-- /foreach --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

