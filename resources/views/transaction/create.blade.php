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
                    <h1 class="h3 mb-2 text-gray-800">Transaction</h1>
                    <p class="mb-4">Create New Transaction<a target="_blank"> </a></p>
                    <div class="card shadow mb-4">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <p>Buyer Name</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" name="buyer_name" class="form-control form-control-user" placeholder="Buyer Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Purchase Type</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="type" id="type" class="form-control" required>
                                                <option value="">Pilih Purchase Type</option>
                                                <option value="Offline">Offline</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="Whatsapp">WhatsApp</option>
                                            </select>
                                        </div>
                                        </div>
                                        <hr />
                                        <div class="row" id="formNow">
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Product Name</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <select name="product_id[]" id="product_id" class="productClass form-control" required>
                                                        <option value="">Choose Product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }} data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Amount </p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" name="amount[]" class="qtyClass form-control form-control-user" placeholder="Quantity ">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Price</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" name="price[]" class="priceClass form-control form-control-user" placeholder="Price" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Total Payment</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" name="total[]" class="totalClass form-control form-control-user" placeholder="Amount" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newForm"></div>
                                        <button type="button" id="addForm" class="d-flex ml-auto btn btn-sm btn-primary shadow-sm mb-3">
                                            Add Another Product
                                        </button>
                                        <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="submit">
                                        Save New Transaction
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
            <!-- Hidden form -->
            <div class="d-none" id="deleteForm">
                <div id="form" class="row">
                    <div class="form-group col-sm-3">
                        <div class="col-sm-12">
                            <p class="mb-1">Product Name</p>
                        </div>
                        <div class="col-sm-12">
                            <select name="product_id[]" id="product_id" class="productClass form-control" required>
                                <option value="">Choose Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }} data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="col-sm-12">
                            <p class="mb-1">Amount </p>
                        </div>
                        <div class="col-sm-12">
                            <input type="number" name="amount[]" class="qtyClass form-control form-control-user" placeholder="Quantity ">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="col-sm-12">
                            <p class="mb-1">Price</p>
                        </div>
                        <div class="col-sm-12">
                            <input type="number" name="price[]" class="priceClass form-control form-control-user" placeholder="Price" readonly>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="col-sm-12">
                            <p class="mb-1">Total Payment</p>
                        </div>
                        <div class="col-sm-12">
                            <input type="number" name="total[]" class="totalClass form-control form-control-user" placeholder="Amount" readonly>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#addForm').click(function() {
        var newForm = $('#form').clone();
        $(newForm).insertAfter("#formNow")
        $('.productClass').change(function() {
            let index = $('form .productClass');
            $('.priceClass:eq('+index.index(this)+')').attr('value', Number($(this).find('option:selected').attr('data-price')))
        })
        $('.qtyClass').change(function() {
            let index = $('form .qtyClass').index(this);
            $('.totalClass:eq('+index+')').attr('value', Number($('.priceClass:eq('+index+')').val() * $(this).val()))
        })
    })
    $('.productClass').change(function() {
        let index = $('form .productClass');
        $('.priceClass:eq('+index.index(this)+')').attr('value', Number($(this).find('option:selected').attr('data-price')))
    })
    $('.qtyClass').change(function() {
        let index = $('form .qtyClass').index(this);
        $('.totalClass:eq('+index+')').attr('value', Number($('.priceClass:eq('+index+')').val() * $(this).val()))
    })
})
</script>
@endsection