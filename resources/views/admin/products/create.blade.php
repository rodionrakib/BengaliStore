@extends('layouts.admin-master')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
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
        <h1 class="h3 mb-2 text-gray-800">Add Product</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            
        <form action="{{ route('admin.products.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8">
                        <h2>Product</h2>
                        <div class="form-group">
                            <label for="sku">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" id="sku" placeholder="xxxxx" class="form-control" value="{{ old('sku') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="slug" placeholder="Slug" class="form-control" value="{{ old('slug') }}">
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short Description </label>
                            <textarea class="form-control" name="short_description" id="summernote1" rows="5" placeholder="Short Description">{{ old('short_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="long_description">Long Description </label>
                            <textarea class="form-control" name="long_description" id="summernote2" rows="5" placeholder="Long Description">{{ old('long_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="cover">Cover </label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Images</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <small class="text-warning">You can use ctr (cmd) to select multiple images</small>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity <span class="text-danger">*</span></label>
                            <input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                {{-- <span class="input-group-addon">PHP</span> --}}
                                <input type="text" name="price" id="price" placeholder="Price" class="form-control" value="{{ old('price') }}">
                            </div>
                        </div>
                        @include('admin.shared.status-select', ['status' => 0])
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox"  name="featured" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Featured
                          </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h2>Categories</h2>
                        @include('admin.shared.categories', ['categories' => $categories, 'selectedIds' => []])
                        
                    </div>

                </div>
                
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">Back</a>
                    <button type="submit" class="btn btn-primary">Create</button>
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