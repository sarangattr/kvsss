@extends('authentication::layouts.master')
@section('title', 'Login')
@section('heading', 'Enter your email address and password to access admin panel.')
@section('content')
<form action="{{url('/admin/login')}}" method="POST">
    @csrf
    <div class="mb-2">
        <label for="emailaddress" class="form-label">Email address</label>
        <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
         @error('email')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-2">
        <label for="password" class="form-label">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
         @error('password')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <div class="form-check">
            <!-- <input class="form-check-input" type="checkbox" name="remember" id="checkbox-signin" checked>
            <label class="form-check-label" for="checkbox-signin">
                Remember me
            </label> -->
        </div>
    </div>
    <div class="d-grid mb-0 text-center">
        <button class="btn btn-primary" type="submit"> Log In </button>
    </div>
</form>
@endsection
@section('social-logins')
{{-- <div class="text-center">
    <h5 class="mt-3 text-muted">Sign in with</h5>
    <ul class="social-list list-inline mt-3 mb-0">
        <li class="list-inline-item">
            <a href="javascript: void(0);" class="social-list-item border-purple text-purple"><i class="mdi mdi-facebook"></i></a>
        </li>
        <li class="list-inline-item">
            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
        </li>
        <li class="list-inline-item">
            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
        </li>
        <li class="list-inline-item">
            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
        </li>
    </ul>
</div> --}}
@endsection
@section('bottom-links')
<div class="row mt-3">
    <div class="col-12 text-center">
        <p> <a href="auth-recoverpw.html" class="text-muted ms-1">Forgot your password?</a></p>
        {{-- <p class="text-muted">Don't have an account? <a href="auth-register.html" class="text-primary fw-medium ms-1">Sign Up</a></p> --}}
    </div> <!-- end col -->
</div>
@endsection
