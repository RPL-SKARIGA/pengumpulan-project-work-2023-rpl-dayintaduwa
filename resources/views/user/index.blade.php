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
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <p class="mb-4">These are the Users we have !<a target="_blank"> </a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                                @if(auth()->user()->id == 1)
                                <a href="/user/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New User</a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phon3</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>{{ $user->role_name}}</td>
                                            <td>
                                                <a href="/user/{{ $user->id }}/view" class="btn btn-sm  btn btn-warning mr-2" >View</a>
                                                @if(auth()->user()->id == 1)
                                                <a href="/user/{{ $user->id }}/edit" class="btn btn-sm btn-info mr-2" >Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger" onclick="
                                                    event.preventDefault();
                                                    if (confirm('Do you want to remove this?')) {
                                                        document.getElementById('delete-row-{{ $user->id }}').submit();
                                                    }
                                                    ">
                                                    Delete
                                                </a>
                                                @endif
                                                <form id="delete-row-{{ $user->id }}" action="{{ route('user.destroy', ['id' => $user->id]) }}" method="POST">
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