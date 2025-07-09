@extends('admin.layouts.app')
@section('title')
    Create Language
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-language"></i> Create New Language</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.language.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Languages
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-2" aria-hidden="true"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Error!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Language Details</h3>
                </div>

                <form name="Createlanguage" id="Createlanguage" method="POST" action="{{ route('admin.language.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Language Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="e.g. French" required>
                                    </div>
                                    <small class="form-text text-muted">The full name of the language</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="font-weight-bold">Language Code <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-code"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="code" id="code" placeholder="e.g. fr, es, de" required>
                                    </div>
                                    <small class="form-text text-muted">2-letter ISO code (lowercase)</small>
                                </div>
                            </div>
                                <div class="col-md-6">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="enable" value="1" checked>
                                                <label class="form-check-label text-success" for="enable">
                                                    <i class="mdi mdi-check-circle-outline"></i> Enable
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="disable" value="0">
                                                <label class="form-check-label text-danger" for="disable">
                                                    <i class="mdi mdi-close-circle-outline"></i> Disable
                                                </label>
                                            </div>
                                        </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="flag" class="font-weight-bold">Country Flag <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="flag" id="flag" required>
                                        <label class="custom-file-label" for="flag">Choose flag image</label>
                                    </div>
                                    <small class="form-text text-muted">Recommended: 16:9 ratio, PNG format</small>
                                    <div class="mt-2" id="flag-preview-container" style="display:none;">
                                        <img id="flag-preview" src="#" alt="Flag Preview" class="img-thumbnail" style="max-width: 100px; max-height: 60px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-white">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Save Language
                                </button>
                                <button type="reset" class="btn btn-warning">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <a href="{{ route('admin.language.index') }}" class="btn btn-danger">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Preview flag image before upload
    document.getElementById('flag').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('flag-preview');
                preview.src = e.target.result;
                document.getElementById('flag-preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);

            // Update the custom file label
            const label = document.querySelector('.custom-file-label');
            label.textContent = file.name;
        }
    });

    // Add bs-custom-file-input for better file input styling
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection
