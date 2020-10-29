
@extends('layouts.front-master')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="heading">
                <h2 class="title">Login</h2>
                <p>If you have an account with us, please log in.</p>
                <p>If you dont have an account with us, please <a href="{{ route('register') }}" class="forget-pass"> Register</a></p>
                
            </div><!-- End .heading -->

            <form  method="POST" action="{{ route('login') }}" >
                @csrf
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email Address" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                    <a href="{{ route('password.request') }}" class="forget-pass"> Forgot your password?</a>
                    
                </div><!-- End .form-footer -->
            </form>
        </div><!-- End .col-md-6 -->

    </div><!-- End .row -->
</div><!-- End .container -->

@endsection