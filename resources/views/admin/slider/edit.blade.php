@extends('admin.layouts.app')
@section('title', 'Edit Slider')
@section('content')
<div class="row page-title-alt text-capitalize">
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
                <h4 class="header-title">Edit Slider</h4>
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $slider->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <textarea class="form-control" id="subtitle" name="subtitle" rows="3">{{ old('subtitle', $slider->subtitle) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold d-block">Status <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_true" value="1" {{ old('status', $slider->status) == 1 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="status_true">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_false" value="0" {{ old('status', $slider->status) == 0 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="status_false">Inactive</label>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sort_order" class="font-weight-bold">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control border-primary" name="sort_order" id="sort_order"
                                       value="{{ old('sort_order', $slider->sort_order) }}" placeholder="Enter sort order" required>
                                @error('sort_order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                       
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="font-weight-bold">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image" accept="image/*">
                                    <label class="custom-file-label border-primary" for="image">Choose new image (leave blank to keep current)</label>
                                </div>
                                <small class="form-text text-muted">Recommended size: 1920x1080 pixels</small>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @if($slider->image)
                                    <div class="mt-2">
                                      <img src="{{ asset('uploads/slider/' . $slider->image) }}"
                                    class="rounded me-2"
                                    alt="{{ $slider->title }}"
                                    width="40">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="link" class="font-weight-bold">Link</label>
                                <input type="text" class="form-control border-primary" name="link" id="link"
                                       value="{{ old('link', $slider->link) }}" placeholder="Enter slider link">
                                @error('link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Slider</button>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection
