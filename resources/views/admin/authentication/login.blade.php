@extends('admin.authentication.master')

@section('title')
    Login
@endsection

@push('css')
@endpush

@section('content')

<div class="card p-2">
    <!-- Logo -->
    <div class="app-brand justify-content-center mt-5">
      <a href="index.html" class="app-brand-link gap-2">
        <span class="app-brand-logo demo">
          <span style="color: #9055fd">

          </span>
        </span>
        <span class="app-brand-text demo text-heading fw-semibold">WMA APP</span>
      </a>
    </div>
    <!-- /Logo -->

    <div class="card-body mt-2">
        <form action="{{ route('login') }}" method="post">
            @csrf
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-floating form-floating-outline mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
            <label for="email">Email or Username</label>
            </div>
            <div class="mb-3">
            <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <label for="password">Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
            </div>
            </div>
            <div class="mb-3 d-flex justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>

            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>
    </div>
  </div>

@push('scripts')
@endpush
@endsection

