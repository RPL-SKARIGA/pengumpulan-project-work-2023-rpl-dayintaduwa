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
                    <p class="mb-4">This is the transaction history !<a target="_blank"> </a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
                                <a href="/transaction/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Transaction</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Buyer Name</th>
                                            <th>Purchase Type</th>
                                            <th>Purchase Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Buyer Name</th>
                                            <th>Purchase Type</th>
                                            <th>Purchase Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->buyer_name }}</td>
                                            <td>{{ $transaction->type }}</td>
                                            <td>{{ $transaction->created_at }}</td>
                                            <td>
                                                <a href="/transaction/{{ $transaction->id }}/view" class="btn btn-sm  btn btn-warning mr-2" >View</a>
                                                @if(auth()->user()->id == 1)
                                                <a href="/transaction/{{ $transaction->id }}/edit" class="btn btn-sm btn-info mr-2" >Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger" onclick="
                                                    event.preventDefault();
                                                    if (confirm('Do you want to remove this?')) {
                                                        document.getElementById('delete-row-{{ $transaction->id }}').submit();
                                                    }
                                                ">
                                                    Delete
                                                </a>
                                                @endif
                                                <form id="delete-row-{{ $transaction->id }}" action="{{ route('transaction.destroy', ['id' => $transaction->id]) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Tidak ada data</td>
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