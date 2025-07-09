@extends('employee.layouts.datatable')
@section('title', 'Blog List')
@section('style' )
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"> blog data Table</h4>
                <p class="text-muted font-13 mb-4">
                    The blog data table displays a list of all blogs in the system. You can view, edit, and delete blogs from this table.
                    <br> You can also add new blogs by clicking the "Add blog" button.
                </p>

                <a href="{{ route('employee.blog.create') }}" class="btn btn-primary mb-3">Add new blog</a>
                {{-- <a href="{{ route('employee.blog.export') }}" class="btn btn-success mb-3">Export blogs</a> --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}

                </div>
            @endif
            <table id="basic-datatable" class="table table-bordered table-hover table-striped">

                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name  </th>
                            <th>Category</th>
                            <th>store</th>
                            <th>Status</th>
                             <th>image</th>
                             <th>lang</th>
                            <th>Created/updated </th>
                            <th>View</th>
                            <th>Action</th>

                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($blogs as $blog)

                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td><small>{{ $blog->name }}</small></td>
                            <td><small>{{ $blog->category->name ?? Null }}</small></td>
                            <td><small>{{ $blog->store->name ?? Null }}</small></td>
                            <td>
                                @if ($blog->status == '1')
                                <span class="text-success">Active</span>
                            @else
                                <span class="text-danger">Inactive</span>
                            @endif
                            </td>


                            <td><img class=" img-thumbnail" src="{{ asset('uploads/blogs/' . $blog->image) }}" style="width:40px;"></td>
                            <td>
                                @if(isset($blog->language) && !empty($blog->language->name))
                                    <span class="badge bg-light text-dark">{{ $blog->language->name }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $blog->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}</small>
                                <br>
                                <small class="text-muted">Updated at: {{ $blog->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}</small>
                            </td>
                            <td>
                                <a class="btn btn-success text-white btn-sm"
                                href="{{ route('employee.blog.show', ['slug' => Str::slug($blog->slug)]) }}"
                                rel="noopener noreferrer">
                                <i class="ri-eye-line"></i>
                            </td>
                            <td>
                                <a href="{{ route('employee.blog.edit', $blog->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('employee.blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
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
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>

<script>
    $(document).ready(function () {
        $('#SearchTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [2,5, 10, 25, 50, 100],
            "ordering": true,
            "searching": true
        });
    });
</script>
@endsection

@endsection
