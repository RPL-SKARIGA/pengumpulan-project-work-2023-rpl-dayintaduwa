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
                    <h1 class="h3 mb-2 text-gray-800">User</h1>
                    <p class="mb-4">Update Users<a target="_blank"> </a></p>
                    <div class="card shadow mb-4">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Name</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control form-control-user" placeholder="Nama" value="{{ old('name', $user->name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Phone</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="number" name="phone" class="form-control form-control-user" placeholder="No Telepon" value="{{ old('phone', $user->phone) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Address</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text-area" name="address" class="form-control form-control-user" placeholder="Alamat" value="{{ old('address', $user->address) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Username</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Username" value="{{ old('username', $user->username) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Password</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Status</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="status" id="status">
                                                <option value="Active" {{ ( $user->status == 'Active') ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ ( $user->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Role</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="role_id" id="role_id">
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{ ( $user->role_id == $role->id) ? 'selected' : '' }} >{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Photo</p>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="file" name="photo" id="photo" >
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Save Updates
                                    </button>
                                </form>
                                <hr>
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