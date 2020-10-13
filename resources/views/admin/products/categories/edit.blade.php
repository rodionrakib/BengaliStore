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
        <h1 class="h3 mb-2 text-gray-800">Edit Category</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <form id="contact-form" method="post" action="{{route('admin.categories.update',['category'=> $category->id])}}"  enctype="multipart/form-data" role="form">
        @csrf
        @method('PATCH')
            <div class="box-body">
                <div class="form-group">
                    <label for="parent">Parent Category</label>
                    <select name="parent" id="parent" class="form-control select2">
                        <option value="">Select Parent Category</option>
                        @foreach($categories as $cat)
                        <option 
                        {{ $cat->id == $category->parent->id ? 'selected': '' }}
                        value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" placeholder="Slug" class="form-control" value="{{ $category->slug }}">
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cover">Cover </label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>        
                    </div>
                    <div class="col-md-6">
                         <img src="{{ $category->coverImagePath()}}" alt=""  style="width: 300px; height: 300px" class="img-responsive img-thumbnail"> <br /> <br>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status">Status </label>
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$category->status ? '':'selected' }} >Disable</option>
                        <option value="1" {{ $category->status ? 'selected' : '' }} >Enable</option>
                    </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Back</a>
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





