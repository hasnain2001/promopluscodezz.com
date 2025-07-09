@extends('admin.layouts.datatable')
@section('title', 'User List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"> user data Table</h4>
                <p class="text-muted font-13 mb-4">
                    The user data table displays a list of all users in the system. You can view, edit, and delete users from this table.
                    <br> You can also add new users by clicking the "Add User" button.
                </p>

                <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Add User</a>
                {{-- <a href="{{ route('admin.user.export') }}" class="btn btn-success mb-3">Export Users</a> --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}

                </div>
            @endif
                <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                           <th>Created At </th>
                            <th>Action</th>
                            <th>View details</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($users as $user)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A')}}</td>

                            <td>
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick=" return confirm('are you sure to delete  this ') " class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-success text-white btn-sm"
                                    href="{{ route('admin.user.show', $user->id) }}"
                                    rel="noopener noreferrer">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection
