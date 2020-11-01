@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            @include('layouts.errors-and-messages')
            <h2>Address Book</h2>
                        
            @if(!$addresses->isEmpty())
            <a href="{{route('accounts.address.create')}}" class="btn btn-primary">Create Address</a>
                <table class="table">
                <tbody>
                <tr>
                    <td>Alias</td>
                    <td>Address</td>
                    <td>Phone</td>
                    <td>Zip Code</td>
                    <td>Actions</td>
                </tr>
                </tbody>
                <tbody>
                @foreach ($addresses as $address)
                    <tr>
                        <td>{{ $address->alias }}</td>
                        <td>{{ $address->address }}</td>
                        <td>{{ $address->phone }}</td>
                        <td>{{ $address->zip }}</td>
                        <td>
                            <form action="{{route('accounts.address.delete',['address'=> $address->id])}}" method="post" class="form-horizontal">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{route('accounts.address.edit',['address'=> $address->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <button 
                                     
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
                <p class="alert alert-warning">No address created yet. <a href="{{ route('accounts.address.create') }}">Create</a></p>
            @endif
          
        </div><!-- End .col-lg-9 -->

       @include('front.include.account-sidebar')
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection