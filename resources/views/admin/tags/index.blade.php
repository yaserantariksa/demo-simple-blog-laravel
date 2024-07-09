@extends('layout.admin')

@section('title', 'Tags')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <h1 class="card-title">Add New Tag</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col">
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" class="col-4 btn btn-primary" value="Save"
                                style="width: 100px; height: 37px">
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">No</th>
                        <th>Tag</th>
                        <th class="text-center" style="width: 130px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tags) == 0)
                        <tr>
                            <td colspan="3" class="text-center">Data is empty</td>
                        </tr>
                    @else
                        @foreach ($tags as $i => $tag)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $tag->title }}</td>
                                <td class="text-center">
                                    <form action="{{ route('tags.destroy', $tag->slug) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="btn btn-outline-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
