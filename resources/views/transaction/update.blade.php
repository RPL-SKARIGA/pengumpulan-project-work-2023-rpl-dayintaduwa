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
                    <p class="mb-4">Update Transaction<a target="_blank"> </a></p>
                    <div class="card shadow mb-4">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form action="{{ route('transaction.update', $transaction[0]->id) }}" method="POST" class="transaction">
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
                                        <p>Buyer Name</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" name="buyer_name" class="form-control form-control-user" placeholder="Buyer Name" value="{{ old('buyer_name', $transaction[0]->buyer_name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                        <p>Type Purchase</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="type" id="type" class="form-control">
                                                <option value="Offline" {{ ( $transaction[0]->type == 'Offline') ? 'selected' : '' }}>Offline</option>
                                                <option value="Instagram" {{ ( $transaction[0]->type == 'Instagram') ? 'selected' : '' }}>Instagram</option>
                                                <option value="Whatsapp" {{ ( $transaction[0]->type == 'Whatsapp') ? 'selected' : '' }}>WhatsApp</option>
                                            </select>
                                        </div>
                                        </div>
                                        <hr />
                                        @foreach ($transaction as $data)
                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Product Name</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <select name="product_id[]" id="product_id" class="productClass form-control" required readonly>
                                                        <option value="">Choose Product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }} {{ ( $data->product_id == $product->id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Amount </p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" name="amount[]" class="qtyClass form-control form-control-user" placeholder="Quantity" value="{{ old('amount[]', $data->amount) }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Price</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" name="price[]" class="priceClass form-control form-control-user" placeholder="Price" value="{{ old('price[]', $data->price) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                    <p class="mb-1">Total Payment</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" name="total[]" class="totalClass form-control form-control-user" placeholder="Amount" value="{{ old('total[]', $data->total) }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <hr>
                                    <button id="submit" type="submit" class="btn btn-primary btn-user btn-block">
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

    </div>
    <!-- End of Page Wrapper -->
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