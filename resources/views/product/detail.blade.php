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
                    <h1 class="h3 mb-2 text-gray-800">Detail Product</h1>
                    
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
                                </div>
                                <div class="card-body">
                                <form action="{{ route('product.show', $product->id) }}" method="GET" class="product">
                                        @method('GET')
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Product Name</p>
                                            </div>
                                             <div class="col-sm-9">
                                                <p> {{ old('name', $product->name) }} </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Description</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p> {{ old('description', $product->description) }} </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Price</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p> {{ old('price', $product->price) }} </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Created at</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p> {{ old('created_at', $product->created_at) }} </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Image</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <img class="img-product center" src="{{ asset('images/' . $product->image) }}">
                                </div>
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