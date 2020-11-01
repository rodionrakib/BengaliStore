@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>Your Orders</h2>
   
        </div><!-- End .col-lg-9 -->

        @include('front.include.account-sidebar')
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection