@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register Medical Item')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Medicals</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add Medicals
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Medical Registration Card -->
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Add Medicals</h5>
    </div>
    <div class="card-body">
        <div class="mt-2 mb-2">
            <x-form-alerts></x-form-alerts>
        </div>

        <!-- Medical Registration Form -->
        <form id="medical-registration-form" action="{{ route('admin.store-medicals') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Medical Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter medical name">
                    @error('name')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="price">Price:</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Enter price" step="0.01">
                    @error('price')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
</div>

<!-- List of Medical Items -->
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Medical List</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered " id="medicals">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Medical Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicals as $medical)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $medical->name }}</td>
                        <td>{{ number_format($medical->price, 2) }} Tshs</td>
                        <td>
                            <a href="{{ route('admin.edit-medicals', $medical->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.delete-medicals', $medical->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No medicine found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection


@push('scripts')
<script>

$(document).ready(function() {
    $('#medicals').DataTable({
        responsive: true,
        language: {
            search: "Search: ",
            lengthMenu: "Display _MENU_ records per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
        },
        autoWidth: false,
        columnDefs: [
            {
                targets: [3], // Adjust the index to your action column
                orderable: false,
            }
        ],
    });
});

</script>
@endpush
