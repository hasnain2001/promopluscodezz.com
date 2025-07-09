@extends('admin.layouts.datatable')
@section('title', 'blog List')
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

                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary mb-3">Add new blog</a>
                {{-- <a href="{{ route('admin.blog.export') }}" class="btn btn-success mb-3">Export blogs</a> --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}

                </div>
            @endif
                <table  id="basic-datatable" class="table table-striped  dt-responsive nowrap w-100">

                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name </th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>image</th>
                            <th>lang</th>
                            <th>Created by </th>
                           <th>Created/updated  </th>
                            <th>Action/view</th>

                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($blogs as $blog)

                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>
                            <small class="text-muted">{{ $blog->name }}</small>
                            </td>
                            <td>
                            @if ($blog->category)
                                <small class="badge bg-light text-dark">{{ $blog->category->name }}</small>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif

                            </td>

                            <td>
                            @if ($blog->status == '1')
                                <small class="text-success">Active</small>
                            @else
                                <small class="text-danger">Inactive</small>
                            @endif
                            </td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/blogs/' . $blog->image) }}" style="width:30px;"></td>
                            <td>
                                @if(isset($blog->language) && !empty($blog->language->name))
                                    <span class="badge bg-light text-dark">{{ $blog->language->name }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                            <small class=" text-muted">{{$blog->user->name}}</small>
                            <br>
                            <small class="text-muted">Updated by: {{ $blog->updatedby->name ?? 'N/A' }}</small>
                           </td>
                            <td>
                                <small class="text-muted">Created at: {{ $blog->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}</small>
                                <br>
                                <small class="text-muted">Updated at: {{ $blog->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick=" return confirm('are you sure to delete  this ') " class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                          <a class="btn btn-success text-white btn-sm"
                                href="{{ route('admin.blog.show', ['slug' => Str::slug($blog->slug)]) }}"
                                rel="noopener noreferrer">
                                <i class="ri-eye-line"></i>
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
