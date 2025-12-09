@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Prescription List')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Prescriptions</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.list-prescriptions') }}">Prescriptions List</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        List Patient Prescription
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="mt-2 mb-2">
    <x-form-alerts></x-form-alerts>
</div>

<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title text-white">Prescription List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="prescription-table" class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Appointment Date</th>
                            <th>MRN Number</th>
                            <th>Prescription Date</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($prescriptions as $prescription)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</td>
                            <td>{{ $prescription->appointment_date ? $prescription->appointment_date->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>{{ $prescription->patient->mrn_number }}</td>
                            <td>{{ $prescription->created_at->format('d M Y') }}</td>
                            <td>{{ number_format($prescription->total_price, 2) }} Tshs</td>
                            <td class="text-center">
                                @if(auth()->user()->type == 'doctor' || auth()->user()->type == 'receptionist')
                                <a href="{{ route('admin.show-prescriptions', $prescription->id) }}" class="btn btn-info btn-sm m-1">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                @endif

                                @if(auth()->user()->type == 'receptionist')
                            <form action="{{ route('admin.send-invoice', $prescription->patient->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm m-1">
                                    <i class="fa fa-envelope"></i> Send Invoice
                                </button>
                            </form>
                        @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#prescription-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false, 
            columnDefs: [
                {
                    targets: [6], // Action column
                    orderable: false, // Disable sorting for the action column
                }
            ],
        });
    });
</script>
@endpush
