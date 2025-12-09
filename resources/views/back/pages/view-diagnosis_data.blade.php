@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'View Diagnosis')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>View Diagnosis Details</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.list-diagnosis') }}">Diagnosis List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Diagnosis
                    </li>
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
            <h5 class="card-title text-white">Diagnosis Information</h5>
        </div>

        <div class="card-body">
            <!-- Diagnosis and Patient Info -->
            <div class="row">
    <div class="col-md-6 mb-3">
        <h6 class="text-primary"><i class="fas fa-diagnoses"></i> Diagnosis Details</h6>
        <ul class="list-group">
            <li class="list-group-item"><strong>Diagnosis ID:</strong> {{ $diagnosis->id }}</li>
            <li class="list-group-item"><strong>Diagnosis:</strong> {{ $diagnosis->diagnosis }}</li>
            <li class="list-group-item"><strong>Symptoms:</strong> {{ $diagnosis->symptoms }}</li>
            <li class="list-group-item"><strong>Medication:</strong> {{ $diagnosis->medication }}</li>
            <li class="list-group-item"><strong>Created At:</strong> {{ $diagnosis->created_at->format('d M, Y h:i A') }}</li>
        </ul>
    </div>
    <div class="col-md-6 mb-3">
        <h6 class="text-primary"><i class="fas fa-user"></i> Patient Information</h6>
        <ul class="list-group">
            <li class="list-group-item"><strong>Full Name:</strong> {{ $diagnosis->patient->full_name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $diagnosis->patient->email }}</li>
            <li class="list-group-item"><strong>Phone:</strong> {{ $diagnosis->patient->phone_number }}</li>
        </ul>
    </div>
</div>

            <!-- Appointment and Payment Section -->
            <div class="mt-4">
                <h6 class="text-primary"><i class="fas fa-calendar-check"></i> Appointment and Payment</h6>
                <form action="{{ route('admin.create-appointment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="diagnosis_id" value="{{ $diagnosis->id }}">
                    <input type="hidden" name="patient_id" value="{{ $diagnosis->patient->id }}">

                    <div class="row">
                        <!-- Appointment Date -->
                        <div class="col-md-6 mb-3">
                            <label for="appointment_date" class="form-label">Appointment Date</label>
                            <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
                        </div>

                        <!-- Amount to be Paid -->
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Amount to be Paid</label>
                            <input type="number" id="amount" name="amount" class="form-control" step="0.01" required>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="4"></textarea>
                    </div>

                    <!-- Reminder -->
                    <div class="mb-3">
                        <label for="reminder_date" class="form-label">Reminder Date</label>
                        <input type="date" id="reminder_date" name="reminder_date" class="form-control" required>
                        <small class="text-muted">You can use this date to calculate reminders later.</small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Save Appointment & Send Invoice
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
