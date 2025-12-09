@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'List Product')

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
                    <li class="breadcrumb-item active" aria-current="page">
                        List Product
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Product Table Card -->
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Product List</h5>
    </div>
    
    <div class="card-body">

    <x-form-alerts></x-form-alerts>
        <div class="table-responsive">
            <table id="products-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->price }} Tshs</td>
                            <td> ( {{  $product->quantity }} ) left in Stock</td>
                            <td>
                                <span class="badge 
                                    {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }} text-white">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>


                            <td>
                                <!-- Example: Edit and Delete buttons -->
                                 
                                <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.delete_product', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#products-table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });

    
    function confirmDelete() {
        return confirm('Are you sure you want to delete this product?');
    }

</script>
@endpush
