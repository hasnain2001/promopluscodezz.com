@foreach($categories as $category)
<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
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
        @if($category->language)
            <span class="badge badge-info">{{ $category->language->name }}</span>
        @else
            <span class="badge badge-secondary">N/A</span>
        @endif
    </td>
    <td>
        @if($category->status)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>
    <td>
        @if($category->user)
            {{ $category->user->name }}
        @else
            System
        @endif
    </td>
    <td>
        {{ $category->updated_at->format('Y-m-d H:i') }}
        @if($category->updatedby)
            <br><small>by {{ $category->updatedby->name }}</small>
        @endif
    </td>
    <td>
        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-primary" title="Edit">
            <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach

@if($categories->isEmpty())
<tr>
    <td colspan="8" class="text-center">No categories found</td>
</tr>
@endif
