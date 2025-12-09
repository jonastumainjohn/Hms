@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add Diagnosis')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Add Diagnosis</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.list-patients') }}">Patient List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.view-patient', $patient->id) }}">View Patient</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Diagnosis</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="mt-3 mb-2">
    <x-form-alerts></x-form-alerts>
</div>

<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
            <h5 class="card-title text-white">Diagnosis Form</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.store-diagnosis', $patient->id) }}" method="POST">
                @csrf
                <!-- Patient Information -->
                <h5>Patient Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="patient_name" class="form-label">Patient Name</label>
                        <input type="text" id="patient_name" class="form-control" value="{{ $patient->full_name }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mrn_number" class="form-label">MRN Number</label>
                        <input type="text" id="mrn_number" class="form-control" value="{{ $patient->mrn_number }}" disabled>
                    </div>
                </div>

                <!-- Medical History -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="medical_history" class="form-label">Medical History</label>
                        <textarea id="medical_history" name="medical_history" class="form-control" rows="4"></textarea>
                        @error('medical_history')
                        <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <!-- Diagnosis Information -->
                <h5>Diagnosis Details</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="symptoms" class="form-label">Symptoms</label>
                        <textarea id="symptoms" name="symptoms" class="form-control" rows="3"></textarea>
                        @error('symptoms')
                        <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <textarea id="diagnosis" name="diagnosis" class="form-control" rows="3" ></textarea>
                        @error('diagnosis')
                        <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.view-patient', $patient->id) }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Save Diagnosis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
