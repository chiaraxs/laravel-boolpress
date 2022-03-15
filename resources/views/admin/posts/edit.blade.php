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

                    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                        @csrf
                        @method("put")

                        {{-- title --}}
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Insert title" value="{{ old('title', $post->title) }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- /title --}}


                        {{-- content --}}
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Insert your post's content" required>{{ old('content', $post->content) }}</textarea>

                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- /content --}}

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
