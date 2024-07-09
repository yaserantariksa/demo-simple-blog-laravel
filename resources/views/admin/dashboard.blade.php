@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            {{ auth()->user()->name }}
        </div>
    </div>
@endsection
