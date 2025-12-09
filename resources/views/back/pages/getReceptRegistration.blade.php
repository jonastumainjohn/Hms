@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : 'Page Title Here')
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
                        <a href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Receptionist Registration
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
            <div class="mt-2 mb-2">
                <x-form-alerts></x-form-alerts>
            </div>
            <form action="{{ route('admin.store-Receptionist') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Select Doctor -->
                <div class="form-group col-md-6">
                    <label for="user_id" class="form-label">Select Receptionist</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="" disabled selected>Select a Receptionist</option>
                        @foreach($receptionists as $recept)
                            <option value="{{ $recept->id }}" {{ old('user_id') == $recept->id ? 'selected' : '' }}>
                                {{ $recept->name }} ({{ $recept->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Specialization -->
                <div class="form-group col-md-6">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control " 
                        placeholder="Enter Receptionist dob" value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- shift -->
                <div class="form-group col-md-6">
                    <label for="availability" class="form-label">Shift</label>
                    <select name="shift" id="shift" class="form-control">
                        <option value="day" selected>Day</option>
                        <option value="night">Night</option>
                        <option value="full time">Full Time</option>
                    </select>
                    @error('shift')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Save Recept Info</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "Select a Receptionist",
            allowClear: true, 
        });
    });
</script>

@endpush