@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Appointment List')
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Appointments</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Appointment List
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
            <h5 class="card-title text-white">Appointment List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="appointment-table" class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Phone Number</th>
                            <th>MRN Number</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $prescription)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</td>
                                <td>{{ $prescription->patient->phone_number }}</td>
                                <td>{{ $prescription->patient->mrn_number }}</td>
                                <td>{{ $prescription->appointment_date ? $prescription->appointment_date->format('Y-m-d H:i') : 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('admin.update-appointment-status', $prescription->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="Pending" {{ $prescription->status == 'Pending' ? 'selected' : '' }} class="badge badge-warning">Pending</option>
                                            <option value="Performed" {{ $prescription->status == 'Performed' ? 'selected' : '' }} class="badge badge-success">Performed</option>
                                            
                                        </select>
                                    </form>
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
        $('#appointment-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false, 
            columnDefs: [
                {
                    targets: [5], // Status column
                    orderable: false, // Disable sorting for the status column
                }
            ],
        });
    });
</script>
@endpush
