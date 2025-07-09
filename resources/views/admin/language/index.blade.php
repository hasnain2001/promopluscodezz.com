@extends('admin.layouts.datatable')
@section('title', 'langauge list')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Language</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('admin.language.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert" style="font-size: 1.1rem; background: linear-gradient(90deg, #d4fc79 0%, #96e6a1 100%); color: #155724;">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-check-circle me-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <strong>Success!</strong> {{ session('success') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="basic-datatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>language Name</th>
                                            <th>code</th>
                                            <th>image</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>updated_at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($languages as $language)
                                            <tr>
                                                <td>{{ $language->name }}</td>
                                                <td>{{ $language->code }}</td>
                                                <td>    <img src="{{ asset('uploads/flags/' . $language->flag) }}"
                                                 class="rounded me-2"
                                                 alt="{{ $language->name }}"
                                                 width="40"
                                                 onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                                 loading="lazy"></td>
                                                <td>
                                                @if ($language->status == '1')
                                                    <small class="text-success">Active</small>
                                                @else
                                                    <small class="text-danger">Inactive</small>
                                                @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    <span class="badge bg-primary">
                                                        {{ $language->created_at->setTimezone('Asia/Karachi')->format('Y-m-d H:i:s') }}
                                                    </span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <span class="badge bg-success">
                                                        {{ $language->updated_at->setTimezone('Asia/Karachi')->format('Y-m-d H:i:s') }}
                                                    </span>
                                                </td>




                                                <td>
                                                    <a href="{{ route('admin.language.edit', $language->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                              <form action="{{ route('admin.language.destroy', $language->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick=" return confirm('are you sure to delete  this ') " class="btn btn-danger btn-sm">Delete</button>
                                               </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Language Name</th>
                                            <th>code</th>
                                            <th>image</th>
                                            <th>Status</th>
                                            <th>Added</th>
                                            <th>updated_at</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
