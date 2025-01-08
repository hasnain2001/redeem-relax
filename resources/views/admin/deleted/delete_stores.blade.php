@extends('admin.datatable_master')

@section('datatable-title')
  Deleted Stores
@endsection

@section('datatable-content')
<div class="content-wrapper">
    <h1 class="text-center mb-4">Deleted Stores</h1>
    <div class="table-responsive">
        <table id="SearchTable" class="table table-bordered table-hover table-striped align-middle text-center">
            <thead class="bg-primary text-white">
                <tr>
                    <th>ID</th>
                    <th>Store Name</th>
                    <th>Deleted By</th>
                    <th>Role User</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedStores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->store_name }}</td>
                        <td>{{ $store->deletedBy->name ?? 'Unknown' }}</td>
                        <td>{{ $store->deletedBy->role ?? 'Unknown' }}</td>
<td><span class=" text-dark" data-bs-toggle="tooltip" title="{{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
{{ $store->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
</span></td>

                        <td><button></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .content-wrapper {
        padding: 20px;
        background-color: #f8f9fa;
    }
    h1 {
        font-family: 'Arial', sans-serif;
        font-size: 28px;
        color: #343a40;
    }
    .table {
        border: 1px solid #dee2e6;
        margin-bottom: 20px;
    }
    .table th {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }
    .table td {
        color: #495057;
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f3f5;
    }
</style>
@endsection
