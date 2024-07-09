@extends('layout.admin')

@section('title', 'Edit Posts')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="title" class="form-title">Title</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $post->title) }}">
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
                            @if ($post->image)
                                <img src="{{ asset('/storage/upload/' . $post->image) }}" alt="{{ $post->image }}"
                                    class="my-3 img-thumbnail rounded mx-auto d-block" style="width: 300px;"
                                    id="featured-image">
                            @else
                                <img src="{{ asset('/placeholder.png') }}" alt="placeholder"
                                    class="my-3 img-thumbnail rounded mx-auto d-block" style="width: 300px;"
                                    id="featured-image">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Post Content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" cols="30"
                                rows="10" hidden>{!! old('content', $post->content) !!}</textarea>
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
                                        @foreach (old('tags', $post->tags) as $t)
                                            @if ((old('tags') ? $t : $t->id) == $tag->id)
                                                selected
                                            @endif @endforeach>
                                        {{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="is_draft" id="is_draft"
                                @if (old('is_draft', $post->is_draft)) checked @endif onchange="whenChecked()">
                            <label for="is_draft" class="form-check-label"</label>Draft</label>
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
