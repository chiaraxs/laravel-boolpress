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
                    <form action="{{ route('admin.posts.store') }}" method="post">
                        @csrf

                        {{-- title gestuti con errori & old --}}
                        <div class="mb-2 ">
                            <label for="title" class="me-4">Title</label>
                            <input type="text" name="title" placeholder="Insert Title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>

                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        {{-- /title --}}

                        {{-- content gestito con errori & old --}}
                        <div>
                            <label for="content" class="me-1">Content</label>
                            <textarea name="content" cols="40" rows="10" class="form-control @error('title') is-invalid @enderror" placeholder="Insert your post's content" required>{{ old('content') }}</textarea>

                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        {{-- /content --}}


                        <div class="d-flex justify-content-center mt-4">
                            {{-- submit button --}}
                            <button type="submit" class="btn btn-primary mx-2" value="Create post">Create</button>
                            {{-- /submit button --}}

                            {{-- link per annullare il post appena creato --}}
                            <a href="{{ route('admin.posts.index')}}" class="btn btn-primary">Undo</a>
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

