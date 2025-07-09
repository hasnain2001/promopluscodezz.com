@extends('employee.layouts.datatable')
@section('title', 'Search Result')
@section('content')   
<div class="row text-capitalize">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <h4 class="header-title mb-3">Search Result</h4>
                <p class="text-muted">List of all stores in the system with drag-and-drop sorting.</p>
                <a href="{{ route('employee.store.create') }}" class="btn btn-primary mb-3">Add new store</a>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif



                <div class="table-responsive">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Network</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                                <th>View Coupons</th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents">
                            @foreach ($stores as $store)
                            <tr class="row1" data-id="{{ $store->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->category->name ?? 'null' }}</td>
                                <td>{{ $store->network }}</td>
                                <td>
                                    @if ($store->status == '1')
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td><img class="img-thumbnail" src="{{ asset('uploads/stores/' . $store->image) }}" style="width:80px;"></td>
                                <td>{{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A')}}</td>
                                <td>
                                    <a href="{{ route('employee.store.edit', $store->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('employee.store.destroy', $store->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('employee.coupon.index', ['store_id' => $store->id]) }}" class="btn btn-info btn-sm">View Coupons</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection