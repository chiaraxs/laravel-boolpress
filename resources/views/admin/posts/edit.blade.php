@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit your post &hearts;
                </div>

                <div class="card-body d-flex justify-content-center">


                    {{-- form --}}
                    <form action="{{ route('admin.posts.update', $post->slug)) }}" method="post">
                        @csrf

                        {{-- aggiungo il metodo per l'edit --}}
                        @method('put')
                        {{-- /aggiungo il metodo per l'edit --}}


                        {{-- title gestuti con errori & old --}}
                        <div class="mb-2 ">
                            <label for="title" class="me-4">Title</label>
                            <input type="text" name="title" placeholder="Insert Title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required value="{{$post->title}}">


                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        {{-- /title --}}

                        {{-- content gestito con errori & old --}}
                        <div>
                            <label for="content" class="me-1">Content</label>
                            <textarea name="content" cols="40" rows="10" class="form-control @error('title') is-invalid @enderror" placeholder="Insert your post's content" required value="{{$post->content}}">{{ old('content') }}</textarea>


                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        {{-- /content --}}

                        <input type="submit" class="btn btn-info" value="Edit"></button>

                    </form>
                    {{-- /form --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

