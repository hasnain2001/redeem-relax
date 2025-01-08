@extends('admin.master')

@section('title')
    User
@endsection

@section('main-content')
<div class=" container content-wrapper">
    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="fa fa-check-circle" aria-hidden="true"></i>
<strong>Success!</strong> {{ session('success') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<div class="container mt-4">
    <h2 class="mb-4">User List</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <!-- Edit and Delete Buttons -->
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
</div>
@endsection
