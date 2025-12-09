@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Medical Item')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Edit Medicals</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.create-medicals') }}">Medicals</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Medicals
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Edit Medical Item Card -->
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Edit Medicals</h5>
    </div>
    <div class="card-body">
        <form id="edit-medical-form" action="{{ route('admin.update-medicals', $medical->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Medical Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $medical->name) }}" placeholder="Enter medicine name">
                    @error('name')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="price">Price:</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $medical->price) }}" placeholder="Enter price" step="0.01">
                    @error('price')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Update Medicals</button>
        </form>
    </div>
</div>

@endsection
