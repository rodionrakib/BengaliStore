@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>Create Address</h2>
            <form action="{{ route('accounts.address.store') }}" method="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="status" value="1">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                       
                        <label for="alias">Alias <span class="text-danger">*</span></label>
                        @error('alias')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="alias" id="alias" placeholder="Home or Office" class="form-control" value="{{ old('alias') }}">
                    </div>
                    <div class="form-group">
                        
                        <label for="address">Address <span class="text-danger">*</span></label>
                         @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{ old('address') }}">
                    </div>
                   
                    <div class="form-group">
                        <label for="zip">Zip Code </label>
                        <input type="text" name="zip" id="zip" placeholder="Zip code" class="form-control" value="{{ old('zip') }}">
                    </div>
                    <div class="form-group">

                        <label for="phone">Your Phone  <span class="text-danger">*</span></label>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="phone" id="phone" placeholder="Phone number" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('accounts.profile') }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
                
        </div><!-- End .col-lg-9 -->

        <aside class="sidebar col-lg-3">
            <div class="widget widget-dashboard">
                <h3 class="widget-title">My Account</h3>

                <ul class="list">
                    <li class="active"><a href="{{route('accounts.profile')}}">Account Profile</a></li>
                    <li><a href="{{route('accounts.address')}}">Address Book</a></li>
                    <li><a href="{{route('accounts.order')}}">My Orders</a></li>
                    <li><a href="#">My Wishlist</a></li>

                </ul>
            </div><!-- End .widget -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection