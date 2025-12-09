@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Diagnosis List')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Diagnosis List</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Diagnosis List
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
            <h5 class="card-title text-white">Diagnosis List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="diagnoses-table" class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Mrn Number</th>
                            <th>Symptoms</th>
                            <th>Diagnosis</th>
                            <th>Medical History</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diagnoses as $diagnosis)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $diagnosis->patient ? $diagnosis->patient->full_name : 'N/A' }}</td>
                            <td>{{ $diagnosis->patient ? $diagnosis->patient->mrn_number : 'N/A' }}</td>
                            <td>{{ $diagnosis->symptoms }}</td>
                            <td>{{ $diagnosis->diagnosis }}</td>
                            <td>{{ $diagnosis->medical_history ? $diagnosis->medical_history : 'N/A'}}</td>
                            <td>{{ $diagnosis->created_at->format('Y-m-d') }}</td>
                           
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
    function confirmDelete() {
        return confirm('Are you sure you want to delete this diagnosis?');
    }

    $(document).ready(function() {
        $('#diagnoses-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false,
            columnDefs: [
                {
                    targets: [6], // Actions column is at index 6
                    orderable: false, 
                }
            ],
        });
    });
</script>
@endpush
