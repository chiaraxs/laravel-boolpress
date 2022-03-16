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
                           

                            {{-- title & link details --}}
                            <div class="text-center">
                                <p class="fw-bold mt-2">{{$post->title}}</p>
                                <a href="{{route('admin.posts.show', $post->slug)}}">Details</a>
                            </div>
                            {{-- /title & link to details --}}


                            {{-- category --}}
                            {{-- se la categoria esiste -> la mostra --}}
                            {{-- altrimenti mostra stringa 'no category' --}}
                            <li class="list-group-item fst-italic">Category: {{ isset($post->category) ? $post->category->type : 'no Category'}}</li>
                            {{-- /category --}}

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

                            {{-- tags --}}
                            <li class="list-group-item">

                                <div class="fw-bold d-flex justify-content-center mt-2">

                                    {{-- se esiste il tag -> stampamelo --}}
                                    {{-- altrimenti stampa -> 'No tags' --}}
                                    @forelse ($post->tags as $tag )
                                        <a href="#"><span class="badge bg-info text-dark mx-1 mb-3">#{{$tag->name}}</span></a>
                                        @empty
                                        <p>No Tags</p>
                                    @endforelse

                                </div>
                            </li>
                            {{-- /tags --}}

                            {{-- hr separatore per ogni post --}}
                            <hr style="height:3px; background-color: #1E90FF;">
                            {{-- /hr separatore per ogni post --}}

                        @endforeach
                        {{-- /foreach --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

