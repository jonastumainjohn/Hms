@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Receptionist</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Receptionist
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title text-white">Edit Receptionist Information</h5>
        </div>
        <div class="card-body">
            <x-form-alerts></x-form-alerts>
            <form action="{{ route('admin.update-Receptionist', $receptionist->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Select Receptionist -->
                    <div class="form-group col-md-6">
                        <label for="user_id" class="form-label">Select Receptionist</label>
                        <select name="user_id" id="user_id" class="form-control" disabled>
                            <option value="" disabled selected>Select a Receptionist</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $receptionist->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="form-group col-md-6">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" 
                            value="{{ old('date_of_birth', $receptionist->date_of_birth) }}">
                        @error('date_of_birth')
                            <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Shift -->
                    <div class="form-group col-md-6">
                        <label for="shift" class="form-label">Shift</label>
                        <select name="shift" id="shift" class="form-control">
                            <option value="day" {{ $receptionist->shift == 'day' ? 'selected' : '' }}>Day</option>
                            <option value="night" {{ $receptionist->shift == 'night' ? 'selected' : '' }}>Night</option>
                            <option value="full time" {{ $receptionist->shift == 'full time' ? 'selected' : '' }}>Full Time</option>
                        </select>
                        @error('shift')
                            <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
        $(document).ready(function() {
        // Initialize Select2 on the dropdown
        $('#user_id').select2({
            placeholder: "Select a Receptionist",
            allowClear: true,
        });
    });
</script>

@endpush