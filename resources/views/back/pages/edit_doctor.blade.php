@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Doctor')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Doctor</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Doctor
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Edit Doctor Form -->
<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title text-white">Edit Doctor Information</h5>
        </div>
        <div class="card-body">
            <div class="mt-2 mb-2">
                <x-form-alerts></x-form-alerts>
            </div>


        <form action="{{ route('admin.update-doctor', $doctors->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Select Doctor -->
                <div class="form-group col-md-6">
                    <label for="user_id" class="form-label">Select Doctor</label>
                    <select name="user_id" id="user_id" class="form-control" disabled>
                        <option value="" disabled>Select a Doctor</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                    {{ optional($doctors->user)->id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Specialization -->
                <div class="form-group col-md-6">
                    <label for="specialization" class="form-label">Specialization</label>
                    <input type="text" name="specialization" id="specialization" 
                           class="form-control @error('specialization') is-invalid @enderror" 
                           placeholder="Enter Doctor's Specialization" 
                           value="{{ old('specialization', $doctors->specialization) }}">
                    @error('specialization')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="form-group col-12">
                    <label for="availability" class="form-label">Availability</label>
                    <textarea name="availability" id="availability" 
                              class="form-control @error('availability') is-invalid @enderror" 
                              placeholder="Enter Doctor Availability">{{ old('availability', $doctors->availability) }}</textarea>
                    @error('availability')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Update Doctor Info</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 on the dropdown
        $('#user_id').select2({
            placeholder: "Select a Doctor",
            allowClear: true,
        });
    });
</script>
@endpush
