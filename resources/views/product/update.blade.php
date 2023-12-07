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
                    <p class="mb-4">Update Product<a target="_blank"> </a></p>
                    <div class="card shadow mb-4">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <p>Product Name</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control form-control-user" id="exampleLastName"
                                                placeholder="Nama Barang" value="{{ old('name', $product->name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Description</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <textarea type="text" name="description" class="form-control form-control-user" id="exampleLastName" placeholder="Deskripsi" >{{ old('description', $product->description) }} </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Price</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="number" name="price" class="form-control form-control-user" id="exampleLastName"
                                                placeholder="Harga" value="{{ old('price', $product->price) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Photo</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="file" name="image" id="image">
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