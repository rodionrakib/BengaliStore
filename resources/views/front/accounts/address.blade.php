@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>Address Book</h2>
            <a href="{{route('accounts.address.create',['account' => $customer->id])}}" class="btn btn-primary">Create Address</a>

            
                    @if(!$addresses->isEmpty())
                        <table class="table">
                        <tbody>
                        <tr>
                            <td>Alias</td>
                            <td>Address</td>
                            <td>Phone</td>
                            <td>Zip Code</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                        </tbody>
                        <tbody>
                        @foreach ($addresses as $address)
                            <tr>
                                <td><a href="">{{ $address->alias }}</a></td>
                                <td>{{ $address->address }}</td>
                                <td>{{ $address->phone }}</td>
                                <td>{{ $address->zip }}</td>
                                <td>@include('layouts.status', ['status' => $address->status])</td>
                                <td>
                                    <form action="" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <button 
                                            style="color: #dc3545" 
                                             type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <a href="{{ route('accounts.profile') }}" class="btn btn-default">Back to My Account</a>
                    @else
                        <p class="alert alert-warning">No address created yet. <a href="{{ route('accounts.address.create', auth()->id()) }}">Create</a></p>
                    @endif
          
        </div><!-- End .col-lg-9 -->

        <aside class="sidebar col-lg-3">
            <div class="widget widget-dashboard">
                <h3 class="widget-title">My Account</h3>

                <ul class="list">
                    <li ><a href="{{route('accounts.profile')}}">Account Profile</a></li>
                    <li><a class="active" href="{{route('accounts.address')}}">Address Book</a></li>
                    <li><a  href="{{route('accounts.order')}}">My Orders</a></li>
                    <li><a href="#">My Wishlist</a></li>

                </ul>
            </div><!-- End .widget -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection