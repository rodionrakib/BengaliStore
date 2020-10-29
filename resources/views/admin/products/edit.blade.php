@extends('layouts.admin-master')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<style type="text/css">
    
.img-thumbnail {
  padding: 4px;
  line-height: 1.42857143;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  -webkit-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  display: inline-block;
  max-width: 100%;
  height: auto;
}
.img-responsive,
.thumbnail > img,
.thumbnail a > img,
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
  display: block;
  max-width: 100%;
  height: auto;
}
.img-rounded {
  border-radius: 6px;
}
</style>
@endsection
@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


    <!-- Topbar -->
    @include('admin.partials.top-toolbar')
    <!-- End of Topbar -->
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Product</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-8">
                        <h2>{{ ucfirst($product->name) }}</h2>
                        <div class="form-group">
                            <label for="sku">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" id="sku" placeholder="xxxxx" class="form-control" value="{!! $product->sku !!}">
                        </div>
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{!! $product->name !!}">
                        </div>
                        <div class="form-group">
                            <label for="description">Short Description </label>
                            <textarea class="form-control ckeditor" name="short_description" id="summernote1" rows="5" placeholder="Description">{!! $product->short_description  !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Long Description </label>
                            <textarea class="form-control ckeditor" name="long_description" id="summernote2" rows="5" placeholder="Description">{!! $product->long_description  !!}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <div class="row">
                                    <img src="{{ $product->coverImagePath() }}" alt="" class="img-responsive img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="form-group">
                            <label for="cover">Cover </label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            @forelse($product->getThumbImages() as $image)
                                <div class="col-md-3">
                                    <div class="row">
                                        <img src="{{ $image->getFullUrl()}}" alt="" class="img-responsive img-thumbnail"> <br /> <br>
                                        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.product.remove.thumb', ['id' => $image->id]) }}" class="btn btn-danger btn-sm btn-block">Remove?</a><br />
                                    </div>
                                </div>
                                @empty
                                <p>No Images</p>
                            @endforelse
                        </div>
                        <div class="row"></div>
                        <div class="form-group">
                            <label for="image">Images </label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <span class="text-warning">You can use ctr (cmd) to select multiple images</span>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $product->quantity }}" class="form-control">
   
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" id="price" placeholder="Price" class="form-control" value="{!! $product->price !!}" >
                               
                        </div>

                        <div class="form-group">
                            @include('admin.shared.status-select', ['status' => $product->status])
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox"  name="featured"  id="defaultCheck1"
                          {{$product->featured ?  'checked' : '' }}  >
                          <label class="form-check-label" for="defaultCheck1">
                            Featured
                          </label>
                        </div>
                        
                        <!-- /.box-body -->
                    </div>
                    <div class="col-md-4">
                        <h2>Categories</h2>
                        @include('admin.shared.categories', ['categories' => $categories, 'selectedIds' => $product->categories()->pluck('id')->toArray()])
                    </div>
                </div>
                <div class="row">
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
    </footer>
    <!-- End of Footer -->

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endsection