@if(!$products->isEmpty())
    <table class="table table-striped">
        <thead>
        <th class="col-md-2 col-lg-2">Cover</th>
        <th class="col-md-2 col-lg-5">Name</th>
        <th class="col-md-2 col-lg-2">Quantity</th>
        <th class="col-md-2 col-lg-1"></th>
        <th class="col-md-2 col-lg-2">Price</th>
        </thead>
        <tfoot>
        <tr>
            <td class="">Subtotal</td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class="">Tk{{ $subtotal }}</td>
        </tr>
        <tr>
            <td class="">Shipping</td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class="">Tk <span id="shippingFee">{{ number_format(0, 2) }}</span></td>
        </tr>
        <tr>
            <td class="">Tax</td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class="">Tk {{ number_format($tax, 2) }}</td>
        </tr>
        <tr>
            <td class="">Total</td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class="">Tk <span id="total_amount" data-total="{{ $total }}">{{ $total }}</span></td>
        </tr>
        </tfoot>
        <tbody>
        @foreach($cartItems as $cartItem)
            <tr>
                <td>
                    <a href="{{ route('front.products.show', [$cartItem->model->slug]) }}" class="hover-border">
                        @if($cartItem->model->hasMedia('cover'))
                            <img src="{{$cartItem->model->coverImagePath()}}" alt="{{ $cartItem->name }}" class="img-responsive img-thumbnail">
                        @else
                            <img src="https://placehold.it/120x120" alt="" class="img-responsive img-thumbnail">
                        @endif
                    </a>
                </td>
                <td>
                    <p>
                        <strong>{{ $cartItem->name }}</strong> <br />
                       
                    </p>
                    <hr>
                   {{--  <div class="product-description">
                        {!! $cartItem->model->short_description !!}
                    </div> --}}
                </td>
                <td>
                    <form action="{{ route('cart.update', $cartItem->rowId) }}" class="form-inline" method="post">
                        @csrf
                        @method('PATCH')
                        
                        <div class="input-group">
                            <input type="text" name="quantity" value="{{ $cartItem->qty }}" class="form-control" />
                            <span class="input-group-btn"><button class="btn btn-default">Update</button></span>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{ route('cart.destroy', $cartItem->rowId) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </form>
                </td>
                <td>{{config('cart.currency')}} {{ number_format($cartItem->price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
{{-- <script type="text/javascript">
    $(document).ready(function () {
        let courierRadioBtn = $('input[name="rate"]');
        courierRadioBtn.click(function () {
            $('#shippingFee').text($(this).data('fee'));
            let totalElement = $('span#grandTotal');
            let shippingFee = $(this).data('fee');
            let total = totalElement.data('total');
            let grandTotal = parseFloat(shippingFee) + parseFloat(total);
            totalElement.html(grandTotal.toFixed(2));
        });
    });
</script> --}}