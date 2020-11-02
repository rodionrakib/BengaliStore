 <tr class="product-row" data-row = {{$item->rowId}}>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="{{$item->model->path()}}" class="product-image">
                                                <img src="{{$item->model->coverImagePath()}}" alt="product">
                                            </a>
                                        </figure>
                                        <h2 class="product-title">
                                            <a href="{{$item->model->path()}}">{{$item->name}}</a>
                                        </h2>
                                    </td>
                                    <td>TK {{$item->price}}</td>
                                    {{-- <form action="{{ route('cart.update', $item->rowId) }}" class="form-inline" method="post">
                                    @csrf
                                    @method('PATCH') --}}
                                    <td>
                                        <input class="form-control vertical-quantity" type="text" value="{{$item->qty}}" >
                                    </td>
                                    {{-- <td>{{$item->options->has('size') ? $item->options->size : ''}}</td> --}}
                                    
                                    <td class="subtitla">TK {{$item->total}}</td>
                                    <td>  
                                           
                                 {{--    <button  type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update</button>
                                    </form>
                                        <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>Remove</button>
--}}
    {{-- <form method="POST" action="{{route('cart.destroy',$item->rowId)}}" >
        @csrf
        @method('DELETE')
        <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>Remove</button>
    </form> --}}

    <div class="btn-group">
    <a href="#" class="btn btn-primary btn-sm cart-update" data-rowid = {{$item->rowId}} ><i class="fa fa-edit"></i> Update</a>
    <button 
     
     type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>Remove</button>
    </div>
    
    
    

    </td>
     
</tr>  