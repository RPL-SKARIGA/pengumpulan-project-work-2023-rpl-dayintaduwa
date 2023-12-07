@extends('layouts.master')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

    @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('partials.header')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Product</h1>
                    <p class="mb-4">This is the product data that we have !<a target="_blank"> </a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Product</h6>
                                <a href="/product/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Product</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                            <a href="/product/{{ $product->id }}/view" class="btn btn-sm  btn btn-warning mr-2" >View</a>
                                                <a href="/product/{{ $product->id }}/edit" class="btn btn-sm btn-info mr-2" >Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger" onclick="
                                                    event.preventDefault();
                                                    if (confirm('Do you want to remove this?')) {
                                                        document.getElementById('delete-row-{{ $product->id }}').submit();
                                                    }
                                                ">
                                                    Delete
                                                </a>
                                                <form id="delete-row-{{ $product->id }}" action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Empty Data</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

@endsection