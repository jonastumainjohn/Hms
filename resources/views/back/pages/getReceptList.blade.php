@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : 'Page Title Here')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Receptionist</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Receptionist List
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
            <h5 class="card-title text-white">Receptionist List</h5>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="receptionist-table" class="table table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of birth</th>
                            <th>Shift</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receptionists as $recept)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $recept->user->name }}</td>
                            <td>{{ $recept->user->email }}</td>
                            <td>{{ $recept->date_of_birth }}</td>
                            <td>{{ $recept->shift }}</td>
                            <td class="text-center">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.edit-receptionist', $recept->id) }}" class="btn btn-success btn-sm m-1">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.delete-receptionist', $recept->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm m-1">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
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
    function confirmDelete() {
        return confirm('Are you sure you want to receptionist this doctor?');
    }

    $(document).ready(function() {
        $('#receptionist-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false, 
            columnDefs: [
                {
                    targets: [5],
                    orderable: false, // Disable sorting for the action column
                }
            ],
        });
    });
</script>


@endpush