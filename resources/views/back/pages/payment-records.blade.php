@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Payments Records')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Payment Records</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Payment Records
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">All Payment Records</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="payment-table" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Phone</th>
                        <th>MRN Number</th>
                        <th>Receptionist</th>
                        <th>Doctor</th>
                        <th>Medical Items</th>
                        <th>Date of Payment</th>
                        <th>Registration Fee (Tshs)</th>
                        <th>Service/Prescription Fee (Tshs)</th>
                        <th>Total Amount (Tshs)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payment as $record)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $record->patient->first_name }} {{ $record->patient->last_name }}</td>
                        <td>{{ $record->patient->phone_number ?? 'N/A' }}</td>
                        <td>{{ $record->patient->mrn_number }}</td>
                        <td>{{ $record->patient->receptionist->name ?? 'N/A' }}</td>
                        <td>{{ $record->doctor->name ?? 'N/A' }}</td>
                        <td>
                            @foreach($record->prescriptionItems as $item)
                                {{ $item->medical->name ?? 'N/A' }}<br>
                            @endforeach
                        </td>
                        <td>{{ $record->created_at->format('d M, Y') }}</td>
                        <td>{{ number_format($registrationFee, 2) }}</td>
                        <td>{{ number_format($record->total_price, 2) }}</td>
                        <td>{{ number_format($record->total_price + $registrationFee, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#payment-table').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    next: "Next",
                    previous: "Previous",
                },
            },
            pageLength: 10, // Default rows per page
            columnDefs: [
                {
                    targets: [6], // Medical Items column index
                    orderable: false, // Disable sorting for this column
                },
            ],
        });
    });
</script>
@endpush


