@extends('employee.layouts.datatable')
@section('title', 'Store List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Store data Table</h4>
                <p class="text-muted font-13 mb-4">
                    The store data table displays a list of all stores in the system. You can view, edit, and delete stores from this table.
                    <br> You can also add new stores by clicking the "Add store" button.
                </p>

                <a href="{{ route('employee.store.create') }}" class="btn btn-primary mb-3">Add new store</a>
                <button id="deleteSelected"  class="btn btn-danger mb-3">Delete Selected</button>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
                @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


          <form id="deleteForm" action="{{ route('employee.store.deleteSelected') }}" method="POST">
                    @csrf
                    @method('DELETE')
                           </form>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>id</th>
                                <th>image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Network</th>
                                <th>lang</th>
                                <th>Status</th>
                                <th>Action / view</th>
                                <th>edit coupon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                            <tr>
                                <td><input type="checkbox" class="select-checkbox" name="ids[]" value="{{ $store->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                  <td><img class="img-thumbnail" src="{{ asset('uploads/stores/' . $store->image) }}" style="width:50px;" loading="lazy">
                                </td>
                                <td><small>{{ $store->name }}</small></td>
                                <td><small>{{ $store->category->name ?? Null }}</small></td>
                                <td>{{ $store->network->title ?? "N/A" }}</td>
                                <td>
                                    @if(isset($store->language) && !empty($store->language->name))
                                        <span class="badge bg-light text-dark">{{ $store->language->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($store->status == '1')
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('employee.store.edit', $store->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('employee.store.destroy', $store->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                     <a href="{{ route('store.detail',['slug' =>Str::slug($store->slug)]) }}" class="btn btn-primary btn-sm">view</a>
                                </td>
                                <td>
                                    <a class="btn btn-success text-white btn-sm"
                                        href="{{ route('employee.store.show', ['slug' => Str::slug($store->slug)]) }}"
                                        rel="noopener noreferrer">
                                        Edit Coupon
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection
