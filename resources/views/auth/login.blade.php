@extends('auth.layouts.master')
@section('title', 'Login')
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
                <div class="card-header"><h4>Login</h4></div>
                @include('layout.alert')
                <div class="card-body">     
                  <form method="POST" action="{{route('login')}}" class="needs-validation" novalidate="">
                      @csrf
                      <input type="hidden" id="recaptcha-response" name="recaptcha-response" />
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" type="email" autocomplete="username" class="form-control" name="email" value="{{old('email')}}" tabindex="1" required autofocus>
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
                      <div class="d-block">
                          <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                          <a href="{{route('password.request')}}" class="text-small">
                            Lupa Password?
                          </a>
                        </div>
                      </div>
                      <input id="password" type="password" autocomplete="current-password" class="form-control" name="password" tabindex="2" required>
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
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                      </div>
                    </div>
  
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                      </button>
                    </div>
                  </form>
            
                </div>
              </div>
              <div class="mt-5 text-muted text-center">
                Belum punya akun? <a href="{{route('register')}}">Daftar Sekarang</a>
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




  
