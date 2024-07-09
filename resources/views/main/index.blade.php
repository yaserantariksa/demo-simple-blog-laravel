@extends('layout.main')

@section('title', 'Home')

@section('content')
    <main>
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-3">
            <span class="card px-3 py-2"><a href="{{ '/?tag=' }}" style="text-decoration: none; color: inherit;">All</a>
            </span>
            @foreach ($tags as $tag)
                <span class="card px-3 py-2"><a href="{{ '/?tag=' . $tag->slug }}"
                        style="text-decoration: none; color: inherit;">{{ $tag->title }}</a>
                </span>
            @endforeach
        </div>
        @if ($search)
            <p>Search post: "{{ $search }}"</p>
        @endif
        @if ($search_by_tag)
            <p>Search post by title: "{{ $search_by_tag }}"</p>
        @endif

        <div class="row row-cols-1 row-cols-lg-2 g-3 mb-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">{{ $post->title }}</h1>
                        </div>
                        <div class="card-body">
                            <p>Author: {{ $post->user->name }}, published at {{ $post->updated_at }}</p>
                            @foreach ($tags as $tag)
                                <div class="badge text-bg-success text-white">{{ $tag->title }}</div>
                            @endforeach
                            <div class="text-center">
                                <img src="{{ $post->image ? asset('storage/upload/' . $post->image) : asset('placeholder.png') }}"
                                    alt="{{ $post->title }}" class="img-thumbnail" style="height: 200px">
                            </div>
                            <p>{!! Str::words($post->content, 50, '...') !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex align-items-center justify-content-center">
            {{ $posts->links() }}
        </div>
    </main>
@endsection
