@extends('admin.layouts.app')
@section('title')
    Update Language
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header bg-gradient-primary rounded shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-dark"><i class="fas fa-language"></i> Update Language</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle"></i>
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form name="Updatelanguage" id="Updatelanguage" method="POST" action="{{ route('admin.language.update', $language->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-info-circle"></i> Language Details
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="name" class="font-weight-bold">Language Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $language->name }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="code" class="font-weight-bold">Language Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ $language->code }}" required placeholder="e.g. en, fr, es, de">
                                </div>
                                <div class="form-group mb-0">
                                    <label for="flag" class="font-weight-bold">Country Flag <span class="text-danger">*</span></label>
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="flag" id="flag" accept="image/png,image/jpeg">
                                        <label class="custom-file-label" for="flag">Choose flag image</label>
                                    </div>
                                    <small class="form-text text-muted">Recommended: 16:9 ratio, PNG format</small>
                                    <div class="mt-2" id="flag-preview-container" style="display:none;">
                                        <img id="flag-preview" src="#" alt="Flag Preview" class="img-thumbnail border" style="max-width: 100px; max-height: 60px;">
                                    </div>
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/flags/' . $language->flag) }}"
                                             class="rounded border"
                                             alt="{{ $language->name }}"
                                             width="60"
                                             onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                             loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-toggle-on"></i> Status
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-radio mt-2">
                                        <input type="radio" class="custom-control-input" name="status" id="1" {{ $language->status == '1' ? 'checked' : '' }} value="1">
                                        <label class="custom-control-label" for="1">Enable</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="status" id="0" {{ $language->status == '0' ? 'checked' : '' }} value="0">
                                        <label class="custom-control-label" for="0">Disable</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success px-4"><i class="fas fa-save"></i> Save</button>
                        <a href="{{ route('admin.language.index') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left"></i> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@push('scripts')
<script>
    // Show selected file name
    document.querySelector('.custom-file-input').addEventListener('change', function(e){
        var fileName = document.getElementById("flag").files[0]?.name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    });

    // Preview flag image
    document.getElementById('flag').addEventListener('change', function(event){
        const [file] = event.target.files;
        if(file){
            const preview = document.getElementById('flag-preview');
            preview.src = URL.createObjectURL(file);
            document.getElementById('flag-preview-container').style.display = 'block';
        }
    });
</script>
@endpush
@endsection
