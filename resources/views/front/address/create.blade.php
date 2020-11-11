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
                       
                        <label for="alias">Alias </label>
                        @error('alias')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="alias" id="alias" placeholder="Home or Office" class="form-control" value="{{ old('alias') }}">
                    </div>
                   <div class="form-group">
                            <label>City</label>
                            <div class="select-custom">
                                <select class="form-control form-control-sm" name="city_id">
                                    @foreach(\App\Models\City::all() as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->
                    </div><!-- End .form-group -->
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

      @include('front.include.account-sidebar')
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection