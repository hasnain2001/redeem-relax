@extends('admin.datatable_master')
@section('datatable-title')
    Stores
@endsection
@section('datatable-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stores</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('admin.store.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>{{ session('success') }}</b>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="SearchTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Store Name</th>
                                            <th>Network</th>
                                            <th>Featured</th>
                                            <th>Top Store</th>
                                            <th>Popular Store</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stores as $store)
                                            <tr>
                                                <td>{{ $store->name }}</td>
                                                <td>{{ $store->network }}</td>
                                                <td>{{ $store->category }}</td>
                                                <td>
                                                    @if ($store->authentication == "featured")
                                                        <i class="fa fa-fw fa-check-circle"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($store->authentication == "top_store")
                                                        <i class="fa fa-fw fa-check-circle"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($store->status == "disable")
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-check-circle"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $store->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.store.edit', $store->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <a href="{{ route('admin.store.delete', $store->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Store Name</th>
                                            <th>Network</th>
                                            <th>Featured</th>
                                            <th>Top Store</th>
                                            <th>Popular Store</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
