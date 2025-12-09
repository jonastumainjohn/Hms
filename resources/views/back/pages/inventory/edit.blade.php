@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Product')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Products</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.list_inventory') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Product Registration Card -->
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Edit Product</h5>
    </div>
    <div class="card-body">
        <div class="mt-2 mb-2">
            <x-form-alerts></x-form-alerts>
        </div>

        <!-- Product Registration Form -->
        <form id="product-registration-form" action="{{ route('admin.update_product', $products->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $products->name }}" placeholder="Enter product name">
                    @error('name')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ $products->slug }}" placeholder="Product Slug" readonly>
                    @error('slug')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6 mt-2">
                    <label for="price">Price:</label>
                    <input type="number" name="price" class="form-control" value="{{ $products->price }}" placeholder="Enter price" step="0.01">
                    @error('price')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <label for="quantity">Current Quantity:</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $products->quantity }}" placeholder="Enter quantity" readonly>
                    @error('quantity')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <label for="stock">Add Stock:</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="Enter stock">
                    @error('stock')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $products->status == 'active'  ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $products->status == 'inactive'  ? 'selected' : ''  }}>Inactive</option>
                    </select>
                    @error('status')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="btn btn-success mt-3">Update Product</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // jQuery for dynamic slug generation
    $("#name").on('change', function() {
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("admin.getSlug") }}',  // AJAX route
            type: 'get',
            data: { title: element.val() },
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);

                if (response.status == false) {
                    // If product exists, show message
                    alert(response.message);  // Or show a custom error message on the page
                    $("#slug").val('');  // Clear the slug field
                } else {
                    // If the slug is unique, set it
                    $("#slug").val(response.slug);
                }
            }
        });
    });
</script>
@endpush
