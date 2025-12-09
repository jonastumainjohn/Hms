@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'View Prescription')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Priscriptions</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.list-prescriptions') }}">Priscriptions List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View patient prescription
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Prescription Details</h5>
    </div>
    <div class="card-body">
        <h5>Patient Information</h5>
        <p><strong>Name:</strong> {{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</p>
        <p><strong>MRN Number:</strong> {{ $prescription->patient->mrn_number }}</p>

        <h5>Prescription Details</h5>
        <ul class="list-group mb-3">
            @foreach($prescription->prescriptionItems as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item->medical->name }}
                <span>{{ $item->quantity }} x {{ $item->medical->price }} Tshs</span>
            </li>
            @endforeach
        </ul>

        <p><strong>Total Price:</strong> {{ number_format($prescription->total_price, 2) }} Tshs</p>
        <p><strong>Additional Notes:</strong> {{ $prescription->description }}</p>
    </div>
</div>

@endsection
