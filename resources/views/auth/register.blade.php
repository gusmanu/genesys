@extends('auth.layouts.master')
@section('title', 'Register')
@push('page-css')
  <style>
     .login-with-google-btn {
        background-position: 4rem 14px;
      }
    
      @media only screen and (max-width: 600px) {
        .login-with-google-btn {
          background-position: 5rem 14px;
        }
      }

       @media only screen and (max-width: 360px) {
        .login-with-google-btn {
          background-position: 3rem 14px;
        }
      }

  </style>
@endpush
@section('body')
<body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              {{-- <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
              </div> --}}
  
              <div class="card card-primary">
                <div class="card-header"><h4>Register</h4></div>
                <div class="card-body">
                  <form method="POST" action="{{route('register')}}" class="needs-validation" novalidate="">
                      @csrf
                      <input type="hidden" id="recaptcha-response" name="recaptcha-response" />
                    <div class="form-group">
                    <label for="email">Nama</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" tabindex="1" required autofocus>
                    @error('name')
                    <div class="invalid-feedback" style="display: block">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="invalid-feedback">
                        Please fill in your name
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" tabindex="1" required autofocus>
                      @error('email')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                      <div class="invalid-feedback">
                          Please fill in your email
                      </div>
                    </div>
  
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                      <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                      @error('password')
                      <div class="invalid-feedback" style="display: block">
                          {{ $message }}
                      </div>
                      @enderror
                      <div class="invalid-feedback">
                        please fill in your password
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label">Konfirmasi Password</label>
                      <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                      <div class="invalid-feedback">
                        please fill in your password confirmation
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Register
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="mt-5 text-muted text-center">
                Sudah punya akun? <a href="{{route('login')}}">Login</a>
              </div>
              <div class="simple-footer">
                 Copyright
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
@endsection


  
