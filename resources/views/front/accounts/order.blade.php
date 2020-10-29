@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>Your Orders</h2>
   
        </div><!-- End .col-lg-9 -->

        <aside class="sidebar col-lg-3">
            <div class="widget widget-dashboard">
                <h3 class="widget-title">My Account</h3>

               <ul class="list">
                    <li ><a href="{{route('accounts.profile')}}">Account Profile</a></li>
                    <li><a href="{{route('accounts.address')}}">Address Book</a></li>
                    <li><a class="active" href="{{route('accounts.order')}}">My Orders</a></li>
                    <li><a href="#">My Wishlist</a></li>

                </ul>
            </div><!-- End .widget -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection