@extends('admin.layouts.datatable')
@section('title', 'Network List')
@section('content')
<div class="row text-capitalize">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"> network data Table</h4>
                <p class="text-muted font-13 mb-4">
                    The network data table displays a list of all networks in the system. You can view, edit, and delete networks from this table.
                    <br> You can also add new networks by clicking the "Add network" button.
                </p>

                <a href="{{ route('admin.network.create') }}" class="btn btn-primary mb-3">Add network</a>
                {{-- <a href="{{ route('admin.store.export') }}" class="btn btn-success mb-3">Export stores</a> --}}
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
                            <th>title</th>
                            <th>created by/ updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($networks as $network)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $network->title }}</td>
                            <td>
                                <small>created by: {{ $network->user->name ?? 'N/A'}}</small>
                                <br>
                                <small>updated by:{{ $network->updatedby->name ?? 'N/A'}}</small>
                            </td>

                            <td>
                                <a href="{{ route('admin.network.edit', $network->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.network.destroy', $network->id) }}" method="POST" style="display:inline;">
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
