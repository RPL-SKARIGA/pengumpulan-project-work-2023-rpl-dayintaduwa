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
                    <h1 class="h3 mb-2 text-gray-800">Detail User</h1>
                    
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Users Information</h6>
                                </div>
                                <div class="card-body">
                                <div class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <p>Name</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <p> {{ $user->name }} </p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Phone</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <ip> {{ $user->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Address</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <P> {{ $user->address }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Username</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <p> {{ $user->username }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Status</p>
                                        </div>
                                        <div class="col-sm-10">
                                        <p> {{  $user->status }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Role</p>
                                        </div>
                                        <div class="col-sm-10">
                                        <p> {{ $user->role }}</p>
                                        </div>
                                    </div>
                                </div>
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
                                    <img class="img-fluid center" src="{{ asset('images/' . $user->photo) }}">
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