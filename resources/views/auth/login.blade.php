@extends('layout.auth')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="login-logo"> <a href=""><b>Demo</b>Blog</a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login.authenticate') }}" method="post">
                    @csrf
                    <div class="input-group mb-3"> <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3"> <input type="password" name="password"
                            class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> <!--begin::Row-->
                    <div class="row mt-3">
                        <div class="col">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
            </div> <!-- /.login-card-body -->
        </div>
    </div>
@endsection
