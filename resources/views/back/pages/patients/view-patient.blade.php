@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'View Patient')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>View Patient Details</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.list-patients') }}">Patient List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Patient
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
            <h5 class="card-title text-white">Patient Information</h5>
            <div>
              
            </div>
        </div>

        <div class="card-body">
            <!-- Patient Info Section -->
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6 mb-3">
                    <div class="info-box mb-3">
                        <strong>MRN Number:</strong>
                        <span class="text-primary">{{$patient->mrn_number}}</span>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Full Name:</strong>
                        <span class="text-primary">{{$patient->full_name}}</span>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Email:</strong>
                        <span class="text-primary">{{$patient->email}}</span>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Phone Number:</strong>
                        <span class="text-primary">{{$patient->phone_number}}</span>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Age:</strong>
                        <span class="text-primary">{{$patient->age}}</span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="info-box mb-3">
                        <strong>Address:</strong>
                        <span class="text-primary">{{$patient->address}}</span>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Medical History:</strong>
                        <p class="text-muted bg-light p-2 rounded">{{$patient->medical_history ?? 'N/A'}}</p>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Registered By:</strong>
                        <span class="text-primary">{{$patient->receptionist->name ?? 'N/A'}}</span>
                    </div>
                    <div class="info-box mb-3">
                        <strong>Registration Date:</strong>
                        <span class="text-primary">{{$patient->created_at->format('d M, Y h:i A')}}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-2">
               
                @if(auth()->user()->type == 'doctor')
                <a href="{{route('admin.add-diagnosis',$patient->id)}}" class="btn btn-success btn-sm d-flex align-items-center">
                    <i class="fa fa-pencil mr-2"></i> Start Diagnoses
                </a>
                @endif


                <!-- <a href="#" class="btn btn-danger btn-sm" onclick="return confirmDelete();">
                    <i class="fa fa-trash"></i> Delete Patient
                </a> -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this patient?');
    }
</script>
@endpush

@push('styles')
<style>
    .btn {
    border-radius: 30px; /* Rounded buttons */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.btn:hover {
    transform: scale(1.05); /* Slight zoom effect */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
}

</style>
@endpush
