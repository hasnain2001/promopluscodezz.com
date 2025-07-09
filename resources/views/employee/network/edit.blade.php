@extends('employee.layouts.app')
@section('title', 'Edit Netwok')
@section('content')
<div class="row  page-title-alt text-capitalize">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <h4 class="header-title">Edit netwok</h4>
                <form action="{{ route('employee.network.update', $network->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $network->title }}" required>
                    </div>

     
                    <button type="submit" class="btn btn-primary">Update netwok</button>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection