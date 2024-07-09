@extends('layout.admin')

@section('title', 'Posts')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('posts.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by title"
                        aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ old('search') }}" autofocus>
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
            @if ($search)
                <h1>Search post title: {{ $search }}</h1>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th style="min-width: 200px;">Post</th>
                            <th style="width: 200px;">Tags</th>
                            <th style="width: 150px;">Created At</th>
                            <th style="width: 150px;">Updated At</th>
                            <th style="width: 90px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($posts) == 0)
                            <tr>
                                <td colspan="3" class="text-center">Data is empty</td>
                            </tr>
                        @else
                            @foreach ($posts as $i => $post)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td><a href="{{ route('posts.show', $post->slug) }}"> {{ $post->title }}</a></td>
                                    <td class="d-flex flex-wrap gap-1">
                                        @foreach ($post->tags as $tag)
                                            <span class="badge text-bg-success">{{ $tag->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>{{ $post->is_draft ? 'Draft' : 'Published' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $posts->links() }}
        </div>
    @endsection
