@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Patient List')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Patients</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Patient List
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
            <h5 class="card-title text-white">Patient List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="patient-table" class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>MRN Number</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $patient)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$patient->mrn_number}}</td>
                            <td>{{ $patient->full_name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone_number }}</td>
                            <td>{{ $patient->age }}</td>
                            <td class="text-center">
                                @if(auth()->user()->type == 'doctor' || auth()->user()->type == 'superAdmin' || auth()->user()->type == 'receptionist')
                                <a href="{{route('admin.view-patient',$patient->id)}}" class="btn btn-info btn-sm m-1">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                @endif
                                @if(auth()->user()->type == 'receptionist')
                                <a href="{{route('admin.edit-patient', $patient->id)}}" class="btn btn-warning btn-sm m-1">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                @endif
                                @if(auth()->user()->type == 'superAdmin')
                                <a href="#" class="btn btn-danger btn-sm m-1">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
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
        $('#patient-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false, 
            columnDefs: [
                {
                    targets: [6],
                    orderable: false, // Disable sorting for the action column
                }
            ],
        });
    });
</script>
@endpush
