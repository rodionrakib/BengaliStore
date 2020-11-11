@extends('layouts.front-master')


@section('content')

<div class="container">
    <ul class="checkout-progress-bar">
        <li class="active">
            <span>Shipping</span>
        </li>
        <li>
            <span>Review &amp; Payments</span>
        </li>
    </ul>
    <form method="POST" id="storeShipping" action="{{ route('checkout.shipping.store') }}">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            @include('layouts.errors-and-messages')
            <ul class="checkout-steps">
                <li>
                    @if(auth()->user()->addresses()->count() < 1 )
                    <h2 class="step-title">Dont Have Any Address ! Please Add One</h2>
                    @else
                    <h2 class="step-title">Shipping Address</h2>
                    @endif
                    <div class="shipping-step-addresses" id="address-list">
                        
                        @foreach(auth()->user()->addresses as $address)
                            
                            <div class="shipping-address-box">
                                <input  type="checkbox"  name="address_id"   id="{{$address->id}}" value="{{$address->id}}">
                                <label class="form-check-label " for="{{$address->id}}">Ship Here</label>
                                <address>
                                    City:{{$address->city->name}}<br>
                                    Address:{{$address->address}} <br>
                                    Phone: {{ $address->phone}}<br>
                                    Zip:{{ $address->zip}}<br>
                                </address>

                                <div class="address-box-action clearfix">
                                    <a href="#" class="btn btn-sm btn-link" data-toggle="modal" data-target="#editAddress{{$address->id}}">
                                        Edit 
                                    </a>

                                    {{-- <a href="#" class="btn btn-sm btn-outline-secondary float-right">
                                        Ship Here
                                    </a> --}}
                                </div><!-- End .address-box-action -->
                                <div class="modal fade" id="editAddress{{$address->id}}" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form >
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="addressModalLabel">Edit Shipping Address</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div><!-- End .modal-header -->

                                                <div class="modal-body">
                                                       
                                                        

                                                        <div class="form-group required-field">
                                                            <label> Address </label>
                                                            <input type="text" class="form-control form-control-sm" name="address"  value="{{$address->address}}">
                                                        </div><!-- End .form-group -->

                                                        

                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <div class="select-custom">
                                                                <select class="form-control form-control-sm" name="city_id">
                                                                    @foreach(\App\Models\City::all() as $city)
                                                                    <option 
                                                                     value="{{$city->id}}"
                                                                     {{ $address->city->id == $city->id ? 'selected': '' }}
                                                                     >{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div><!-- End .select-custom -->
                                                        </div><!-- End .form-group -->

                                                        <div class="form-group ">
                                                            <label>Zip Code </label>
                                                            <input type="text" class="form-control form-control-sm" name="zip" value="{{$address->zip}}">
                                                        </div><!-- End .form-group -->


                                                        <div class="form-group required-field">
                                                            <label>Phone Number </label>
                                                            <div class="form-control-tooltip">
                                                                <input type="text" name="phone" value="{{$address->phone}}" class="form-control form-control-sm" >
                                                                <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                                                            </div><!-- End .form-control-tooltip -->
                                                        </div><!-- End .form-group -->
                                                      
                                                </div><!-- End .modal-body -->

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                                </div><!-- End .modal-footer -->
                                            </form>
                                        </div><!-- End .modal-content -->
                                    </div><!-- End .modal-dialog -->
                                </div><!-- End .modal -->

                            </div><!-- End .shipping-address-box -->
                        @endforeach
                    </div><!-- End .shipping-step-addresses -->
                    <a href="#" class="btn btn-sm btn-outline-secondary btn-new-address" data-toggle="modal" data-target="#addressModal">+ New Address</a>
                    
                </li>


                <li>
                    <div class="checkout-step-shipping">
                        <h2 class="step-title">Shipping Methods</h2>

                        <table class="table table-step-shipping">
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="shipping-method" value="flat"></td>
                                    <td><strong>$20.00</strong></td>
                                    <td>Fixed</td>
                                    <td>Flat Rate</td>
                                </tr>

                                <tr>
                                    <td><input type="radio" name="shipping-method" value="best"></td>
                                    <td><strong>$15.00</strong></td>
                                    <td>Table Rate</td>
                                    <td>Best Way</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- End .checkout-step-shipping -->
                </li>
            </ul>
        </div><!-- End .col-lg-8 -->

        <div class="col-lg-4">
           @include('front.include.order_summary')
        </div><!-- End .col-lg-4 -->
    </div><!-- End .row -->

    <div class="row">
        <div class="col-lg-8">
            <div class="checkout-steps-action">
                <a href="checkout-review.html" id="paymentStep" class="btn btn-primary float-right">NEXT</a>
            </div><!-- End .checkout-steps-action -->
        </div><!-- End .col-lg-8 -->
    </div>
    </form>
    <div class="mb-6"></div>
    
</div><!-- End .container -->
    <!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addressForm">
                <div class="modal-header">
                    <h3 class="modal-title" id="addressModalLabel">Shipping Address</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- End .modal-header -->

                <div class="modal-body">
                     

                        <div class="form-group required-field">
                            <label> Address </label>
                            <input type="text" class="form-control form-control-sm" id="shippingAddressId" name="address" >
                        </div><!-- End .form-group -->

                        

                        <div class="form-group">
                            <label>City</label>
                            <div class="select-custom">
                                <select class="form-control form-control-sm" name="city_id" id="cityId">
                                    @foreach(\App\Models\City::all() as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->
                        </div><!-- End .form-group -->

                        <div class="form-group ">
                            <label>Zip Code </label>
                            <input type="text" class="form-control form-control-sm" name="zip" id="shipZip" >
                        </div><!-- End .form-group -->


                        <div class="form-group required-field">
                            <label>Phone Number </label>
                            <div class="form-control-tooltip">
                                <input type="text" name="phone" class="form-control form-control-sm" id="shipPhone">
                                <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                            </div><!-- End .form-control-tooltip -->
                        </div><!-- End .form-group -->
                        
                        <div class="form-group-custom-control">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"  name="address-save" class="custom-control-input" id="address-save">
                                <label class="custom-control-label" for="address-save">Save in Address book</label>
                            </div><!-- End .custom-checkbox -->
                        </div><!-- End .form-group -->
                </div><!-- End .modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div><!-- End .modal-footer -->
            </form>
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->
@endsection

@section('script')
<script type="text/javascript">

    $('#addressForm').on('submit',function(event){
        event.preventDefault();

        address = $("#shippingAddressId").val();
        cityId = $("#cityId").val();
        zip = $("#shipZip").val();
        phone = $("#shipPhone").val();
        addressSave = $("[name='address-save']").is(":checked");

        $.ajax({
          url: "{{route('accounts.address.store')}}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            address:address,
            city_id:cityId,
            phone:phone,
            zip:zip,
            address_save:addressSave,
          },
          success:function(response){
            $("#address-list").append(response.htmlAddress);
            $('#addressModal').modal('hide');
            console.log(response);
          },
        });
    });

    $('#paymentStep').on('click',function(event){
         event.preventDefault();
         $('#storeShipping').submit();
    })     
</script>
@endsection 