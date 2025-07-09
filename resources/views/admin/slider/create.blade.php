@extends('admin.layouts.app')
@section('title', 'Create Slider')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="header-title text-white">Create New Slider</h4>
                <p class="mb-0">Fill out the form below to add a new slider</p>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="createSliderForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.slider.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-primary" name="title" id="title"
                                       value="{{ old('title') }}" placeholder="Enter slider title" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subtitle" class="font-weight-bold">Subtitle <span class="text-danger">*</span></label>
                                <textarea class="form-control border-primary" name="subtitle" id="subtitle"
                                          rows="3" placeholder="Enter slider subtitle" required>{{ old('subtitle') }}</textarea>
                                @error('subtitle')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold d-block">Status <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_true" value="1" {{ old('status') === '1' ? 'checked' : '' }} checked required>
                                    <label class="form-check-label" for="status_true">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_false" value="0" {{ old('status') === '0' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="status_false">Inactive</label>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sort_order" class="font-weight-bold">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control border-primary" name="sort_order" id="sort_order"
                                       value="{{ old('sort_order') }}" placeholder="Enter sort order" required>
                                @error('sort_order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="font-weight-bold">Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image" accept="image/*" required>
                                    <label class="custom-file-label border-primary" for="image">Choose image file</label>
                                </div>
                                <small class="form-text text-muted">Recommended size: 1920x1080 pixels</small>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="link" class="font-weight-bold">Link <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-primary" name="link" id="link"
                                       value="{{ old('link') }}" placeholder="Enter slider link" required>
                                @error('link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                            <div class="mb-3">
                                <label for="language_id" class="form-label">Language <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-select" required>
                                    <option value="" disabled {{ old('language_id') ? '' : 'selected' }}>-- Select Language --</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-plus-circle mr-1"></i> Create Slider
                            </button>
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-light px-4 py-2 ml-2">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Show selected file name in file input
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("image").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection
