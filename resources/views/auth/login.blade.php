@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3>Login</h3>
                    <div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" placeholder="Enter Password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group d-flex flex-column">
                                <button type="submit" class="btn btn-success">Login</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    
                    
                        <div class="text-center">
                            <h5>OR</h5>
                        </div>
                    

                    <!--Social Logins-->
                    <div class="d-flex flex-column">                
                        <a href="{{ route('google-auth') }}" class="col btn text-white m-1" style="background-color:#3B5998;">
                            <i class="fa fa-facebook fa-fw"></i>Login with Facebook
                        </a>
                        <a href="{{ route('google-auth') }}" class="col btn text-white m-1" style="background-color:#dd4b39;">
                            <i class="fa fa-google fa-fw"></i> Login with Google
                        </a>
                    </div>
                     <!--Social Logins End-->

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
