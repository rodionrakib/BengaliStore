@extends('layouts.admin-master')
@section('content')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Topbar -->
        @include('admin.partials.top-toolbar')
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Product List</h1>
       

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Price</th>
                    <th>Cover Image</th>
                    <th>Quantity</th>
                    <th>Featured</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Code</th>
                    <th>Cover Image</th>
                    <th>Quantity</th>
                    <th>Featured</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach ($products  as  $product)
                    <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->slug}}</td>
                        <td>{{$product->price}}</td>
                        <td> <img src="{{$product->coverImagePath()}}" style="width: 200px; height: 200px"  class="img-thumbnail" >  </td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->featured}}</td>
                        <td>
                        <a href="{{route('admin.products.edit',['product'=>$product->id])}}" class="edit" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-user-edit"></i></a>&nbsp;&nbsp;
                        <form method="POST" action="{{route('admin.products.destroy',['product'=>$product->id])}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </form>

                        </td>
                    </tr>
                    @endforeach
              
                </tbody>
            </table>
            </div>
        </div>
        </div>

        {{ $products->links() }}

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