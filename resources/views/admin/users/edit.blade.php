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
        <h1 class="h3 mb-2 text-gray-800">Edit User</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <form method="POST" action="{{route('admin.users.update',$employee->id)}}" >
            @method("PUT")
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
              <input  name="name"  value="{{ $employee->name }}" type="text" class="form-control" id="name">
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input name="email" value="{{ $employee->email }}" type="email" class="form-control" id="email">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
            <input type="text" name="address" class="form-control" id="inputAddress" value="{{$employee->address}}">
            </div>
            <div class="form-check form-group">
                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" 
                {{$employee->status == 1 ? 'checked':''}}  
                >
                <label class="form-check-label" for="exampleRadios1">
                 Active
                </label>
            </div>
            <div class="form-check form-group">
                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                {{$employee->status == 0 ? 'checked':''}}
                >
                <label class="form-check-label" for="exampleRadios2">
                  Forbidden
                </label>
            </div>
            <div class="form-group">
                <label> Roles</label>
                <select name="roles[]" class="selectpicker" multiple >
                    @foreach ($roles as $role)
                    <option {{ $employee->roles->contains($role) ? 'selected':'' }}
                    
                    value="{{$role->id}}"> {{ $role->label }} </option>    
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
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