@extends('admin.layouts.datatable')
@section('title', 'Cetgory List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"> Category Data Table</h4>
                <p class="text-muted font-13 mb-4">
                    The user data table displays a list of all users in the system. You can view, edit, and delete users from this table.
                    <br> You can also add new users by clicking the "Add category" button.
                </p>

                <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Add category</a>
                {{-- <a href="{{ route('admin.user.export') }}" class="btn btn-success mb-3">Export Users</a> --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}

                </div>
            @endif
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                           <th>Image</th>
                           <th>lang</th>
                           <th>Created/Updated By
                           </th>
                           <th>Created/Updated At
                           </th>
                           <th>top</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($categories as $category)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td><small>{{ $category->name }}</small></td>
                            <td><img class=" img-thumbnail" src="{{ asset('uploads/categories/' . $category->image) }}" style="width:80px;"></td>
                            <td>
                                @if(isset($category->language) && !empty($category->language->name))
                                    <span class="badge bg-light text-dark">{{ $category->language->name }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                <br>
                                <small class="text-muted">Created by: {{ $category->user->name ?? 'N/A' }}</small>
                                <br>
                                <small class="text-muted">Updated by: {{ $category->updatedby->name ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <small class="text-muted">Created at: {{ $category->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}</small>
                                <br>
                                <small class="text-muted">Updated at: {{ $category->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}</small>
                            </td>
                            <td>{{ $category->top_category ? 'Yes' : 'No' }}</td>
                            <td><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick=" return confirm('are you sure to delete  this ') " class="btn btn-danger btn-sm">Delete</button>
                            </form>
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
