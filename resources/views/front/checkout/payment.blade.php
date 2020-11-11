@extends('layouts.front-master')
@section('content')
<div class="container">
    <ul class="checkout-progress-bar">
        <li>
            <span>Shipping</span>
        </li>
        <li class="active">
            <span>Review &amp; Payments</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-lg-4">
            @include('front.include.order_summary')

            <div class="checkout-info-box">
                <h3 class="step-title">Ship To:
                    <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                </h3>

                <address>
                    Address: {{$address->address}} <br>
                    City: {{ $address->city->name }} <br>
                    zip: {{$address->zip }}<br>
                    Phone:{{ $address->phone }} <br>
                    
                </address>
            </div><!-- End .checkout-info-box -->

            <div class="checkout-info-box">
                <h3 class="step-title">Shipping Method: 
                    <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                </h3>

                <p>Flat Rate - Fixed</p>
            </div><!-- End .checkout-info-box -->
        </div><!-- End .col-lg-4 -->

        <div class="col-lg-8 order-lg-first">
            <div class="checkout-payment">
                <h2 class="step-title">Payment Method:</h2>

                <h4>Check / Money order</h4>
                
                <div class="form-group-custom-control">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="change-bill-address" id="change-bill-address" value="true" >
                        <label class="custom-control-label" for="change-bill-address">My billing and shipping address are the same</label>
                    </div><!-- End .custom-checkbox -->
                </div><!-- End .form-group -->

                
                <form method="POST" action="/pay">
                    @csrf
                    <input type="hidden" value="{{\Gloudemans\Shoppingcart\Facades\Cart::totalFloat()}}" name="amount" id="total_amount" required/>
                    <div>
                        <div class="form-group required-field">
                            <label>Name </label>
                            <input type="text" name="cus_name" value="{{ auth()->check() ? auth()->user()->name : ''  }}" class="form-control" required>
                        </div><!-- End .form-group -->
                      
                      
                        <div class="form-group required-field">
                            <label> Address </label>
                            <input type="text" class="form-control" name="cus_addr1" required>
                        </div><!-- End .form-group -->

                       
                        <div class="form-group">
                            <label>City</label>
                            <div class="select-custom" >
                                <select class="form-control" name="cus_city">
                                    @foreach(App\Models\City::all() as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div><!-- End .select-custom -->
                        </div><!-- End .form-group -->

                        <div class="form-group required-field">
                            <label>Zip/Postal Code </label>
                            <input type="text" name="cus_postcode" class="form-control" required>
                        </div><!-- End .form-group -->

                      

                        <div class="form-group required-field">
                            <label>Phone Number </label>
                            <div class="form-control-tooltip">
                                <input type="tel" name="cus_phone" class="form-control" required>
                                <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                            </div><!-- End .form-control-tooltip -->
                        </div><!-- End .form-group -->

                        </div>       
                    </div><!-- End #new-checkout-address -->
                    <div class="clear-fix">
                        <button type="submit" class="btn btn-primary float-right">Pay Now</button>
                    </div>

                </form>
                
            </div><!-- End .checkout-payment -->

        </div><!-- End .col-lg-8 -->
    </div><!-- End .row -->
    <div class="mb-6"></div>
</div><!-- End .container -->
@endsection
@section('script')
<script type="text/javascript">
    // capture the shipping address values 
    
    address = "{{$address->address}}";
    city = "{{$address->city->id}}";
    zip = "{{$address->zip}}";
    phone = "{{$address->phone}}";
    $("#change-bill-address").change(function() {
    if(this.checked) {
        $("input[name=cus_addr1]").val(address);
        $("select[name=cus_city]").val(city);
        $("input[name=cus_phone]").val(phone);
        $("input[name=cus_postcode]").val(zip);

    }
});
</script>

@endsection