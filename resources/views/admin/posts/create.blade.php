@extends('layout.admin')

@section('title', 'Add New Posts')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-title">Title</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="text" name="user_id" id="user_id" value="{{ auth()->user()->id }}" hidden>
                        <div class="mb-3">
                            <label for="image" class="form-label">Featured Image</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img src="{{ asset('/placeholder.png') }}" alt="placeholder"
                                class="my-3 img-thumbnail rounded mx-auto d-block" style="width: 300px;"
                                id="featured-image">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Post Content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" cols="30"
                                rows="10" hidden>{{ old('content') }}</textarea>
                            <div id="editor" style="height: 700px;">Editor Content</div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select name="tags[]" id="tags" class="form-select" multiple>
                                <option disabled>Select tags...</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        @foreach (old('tags', []) as $t)
                                            @if ($t == $tag->id)
                                                selected
                                            @endif @endforeach>
                                        {{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="is_draft" id="is_draft"
                                onchange="whenChecked()" @if (old('is_draft')) checked @endif>
                            <label for="is_draft" class="form-check-label">Draft</label>
                        </div>

                        <input type="submit" value="Publish" class="btn btn-primary" id="save_button">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('image')
        const featuredImage = document.getElementById('featured-image')
        imageInput.onchange = evt => {
            const [file] = imageInput.files
            if (file) {
                featuredImage.src = URL.createObjectURL(file);
            }
        }
    </script>


@endsection
