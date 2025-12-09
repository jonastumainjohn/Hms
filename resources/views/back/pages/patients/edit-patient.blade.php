@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register Patient')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Patients</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Patient
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Patient Registration Card -->
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Edit Patient Information</h5>
    </div>
    <div class="card-body">
        <div class="mt-2 mb-2">
            <x-form-alerts></x-form-alerts>
        </div>

        <!-- Patient Registration Form -->
        <form id="patient-edit-form" action="{{ route('admin.update-patient',$patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $patient->first_name }}">
                    @error('first_name')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ $patient->middle_name }}">
                </div>
                <div class="col-md-4">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $patient->last_name }}">
                    @error('last_name')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $patient->email }}">
                    @error('email')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone_number">Phone Number:</label>
                    <input type="number" name="phone_number" class="form-control" value="{{ $patient->phone_number }}">
                    @error('phone_number')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="age">Age:</label>
                    <input type="number" name="age" class="form-control" value="{{ $patient->age }}">
                    @error('age')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="address">Address:</label>
                    <input type="text" name="address" class="form-control" value="{{ $patient->address }}">
                    @error('address')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="gender">Gender:</label>
                    <select name="gender" class="form-control">
                        <option value="" disabled>Select Gender</option>
                        <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="medical_history">Medical History:</label>
                    <textarea name="medical_history" class="form-control" rows="4" placeholder="Enter patient's medical history here">{{$patient->medical_history }}</textarea>
                    @error('medical_history')
                    <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Update Patient</button>
        </form>
    </div>
</div>

@endsection
