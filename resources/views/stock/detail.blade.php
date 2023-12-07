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
                    <h1 class="h3 mb-2 text-gray-800">Detail Stock</h1>
                    
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-15 col-lg-12">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Stock Information</h6>
                                </div>
                                <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Product Name</p>
                                            </div>
                                             <div class="col-sm-9">
                                                <p>{{ $stock->product_name }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Stock</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p> {{ $stock->stock }} </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Updated By</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p> {{  $stock->name }} </p>
                                            </div>
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