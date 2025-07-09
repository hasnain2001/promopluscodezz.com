@extends('employee.layouts.datatable')
@section('title', 'Category List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="header-title">Category Management</h4>
                    <a href="{{ route('employee.category.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Add Category
                    </a>
                </div>

                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i> Manage all product categories in the system. You can view, edit, and delete categories from this table.
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-hover dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>lang</th>
                                <th>Actions/view</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($category->image)
                                        <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                             class="rounded me-3"
                                             width="40"
                                             height="40"
                                             alt="{{ $category->name }}">
                                        @endif
                                        <strong>{{ $category->name }}</strong>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">{{ $category->slug }}</span>
                                </td>
                                <td>
                                    @if($category->image)
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                         class="img-thumbnail"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                    <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $category->created_at->setTimezone('Asia/Karachi')->format('M j, Y h:i A') }}
                                    </small>
                                </td>
                                <td>
                                    @if($category->status == 1)
                                        <span class="badge bg-success rounded-pill">Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill">Inactive</span>
                                    @endif
                                </td>
                                  <td>
                                @if(isset($category->language) && !empty($category->language->name))
                                    <span class="badge bg-light text-dark">{{ $category->language->name }}</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('employee.category.edit', $category->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-pill"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employee.category.destroy', $category->id) }}"
                                              method="POST"
                                              class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                                    data-bs-toggle="tooltip"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('category.detail',['slug'=>Str::slug($category->slug)]) }}"
                                           class="btn btn-sm btn-outline-info rounded-pill"
                                           data-bs-toggle="tooltip"
                                           target="_blank"
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection

@push('scripts')

@endpush
