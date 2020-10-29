
@extends('layouts.front-master')


@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-6 mx-auto">
            <div class="heading">
                <h2 class="title">Create An Account</h2>
                <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
            </div><!-- End .heading -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            

            <form  method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" class="form-control" placeholder="Name" name="name" required>

                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div><!-- End .form-footer -->
            </form>
        </div><!-- End .col-md-6 -->
    </div><!-- End .row -->
</div><!-- End .container -->

@endsection