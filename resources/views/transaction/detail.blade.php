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
                    <h1 class="h3 mb-4 text-gray-800">Detail Transaction</h1>
                    
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-15 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex">
                                    <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
                                    <p class="m-0 ml-auto" id="print">Print</p>
                                </div>
                                <div class="card-body" id="printData">
                                    <div class="transaction">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p><b>Buyer Name</b></p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p> {{ $transaction[0]->buyer_name }} </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p><b>Purchase Type</b></p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p> {{ $transaction[0]->type }} </p>
                                            </div>
                                        </div>
                                        @foreach ($transaction as $data)
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p><b>Product Name</b></p>
                                                <p> {{ $data->product_name }}</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p><b>Amount</b></p>
                                                <p>{{ $data->amount }}</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p><b>Price</b></p>
                                                <p>{{ $data->price }}</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p><b>Total Payment</b></p>
                                                <p>{{ $data->total }}</p>
                                            </div>
                                        </div>
                                        @endforeach
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

@section('scripts')
<script>
$(document).ready(function() {
    $('#print').click(function() {
        $("#printData").print();        
    })
})
</script>
@endsection