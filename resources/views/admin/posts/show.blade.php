@extends('layout.admin')

@section('title', $post->title)

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ $post->title }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <p class="card-subtitle">Author: {{ $post->user->name }}, updated at: {{ $post->updated_at }} -
                                {{ $post->is_draft ? 'Draft' : 'Published' }}</p>
                            <div>
                                @foreach ($post->tags as $tag)
                                    <span class="badge text-bg-success">{{ $tag->title }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="col-md d-flex align-items-start justify-content-md-end justify-content-start gap-3 mt-3 mt-md-0">
                            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                                style="padding: 0;margin:0;">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-outline-danger">
                            </form>
                        </div>
                    </div>
                    @if ($post->image)
                        <div class="bg-secondary text-center mt-3" style="max-height: 200px;">
                            <img class="img-fluid object-fit-cover" src="{{ asset('/storage/upload/' . $post->image) }}"
                                alt="{{ $post->title }}" style="max-height: 200px;">
                        </div>
                    @endif
                    <p>{!! $post->content !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
