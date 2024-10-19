@extends('layouts.app')

@section('content')
<!-- Content area -->
<div class="content d-flex justify-content-center align-items-center">

  <!-- Registration form -->
  <form class="login-form" action="{{ route('register') }}" method="post">
    @csrf
    <div class="card mb-0">
      <div class="card-body">
        <div class="text-center mb-3">
          <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
          <h5 class="mb-0">Create account</h5>
          <span class="d-block text-muted">All fields are required</span>
        </div>

        <div class="form-group text-center text-muted content-divider">
          <span class="px-2">Your credentials</span>
        </div>

        <div class="form-group form-group-feedback form-group-feedback-left">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">
          <div class="form-control-feedback">
            <i class="icon-user-check text-muted"></i>
          </div>
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group form-group-feedback form-group-feedback-left">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
          <div class="form-control-feedback">
            <i class="icon-mention text-muted"></i>
          </div>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group form-group-feedback form-group-feedback-left">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
          <div class="form-control-feedback">
            <i class="icon-user-lock text-muted"></i>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group form-group-feedback form-group-feedback-left">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
          <div class="form-control-feedback">
            <i class="icon-user-lock text-muted"></i>
          </div>
        </div>

        <div class="form-group text-center text-muted content-divider">
          <span class="px-2">Additions</span>
        </div>

        <div class="form-group">
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
              Send me <a href="#">test account settings</a>
            </label>
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
              Subscribe to monthly newsletter
            </label>
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" name="remember" class="form-input-styled" data-fouc>
              Accept <a href="#">terms of service</a>
            </label>
          </div>
        </div>

        <button type="submit" class="btn bg-teal-400 btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>
      </div>
    </div>
  </form>
  <!-- /registration form -->

</div>
<!-- /content area -->
@endsection
