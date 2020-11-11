<div class="shipping-address-box">
    <input type="checkbox" id="{{$address->id}}" name="address_id" value="{{$address->id}}">
    <label class="form-check-label" for="{{$address->id}}">Ship Here</label>
    <address>
        Address:{{$address->address}} <br>
        Phone: {{ $address->phone}}<br>
        Zip:{{ $address->zip}}<br>
    </address>

    <div class="address-box-action clearfix">
        <a href="#" class="btn btn-sm btn-link">
            Edit
        </a>

        <a href="#" class="btn btn-sm btn-outline-secondary ship-here float-right">
            Ship Here
        </a>
    </div><!-- End .address-box-action -->
</div><!-- End .shipping-address-box -->