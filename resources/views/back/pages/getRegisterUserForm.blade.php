@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Users')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Users</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Manage users
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <!-- "Add User" Button -->
            <a href="javascript:void(0);" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createUserModal">
                <i class="fa fa-user-plus"></i> Add User
            </a>
        </div>
    </div>
</div>

<div class="mt-2 mb-2">
            <x-form-alerts></x-form-alerts>
        </div>
<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title text-white">Users List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table hover multiple-select-row data-table-export nowrap dataTable no-footer dtr-inline collapsed" id="users-table" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="table-plus datatable-nosort">Name</th>
                            <th>Email</th>
                            <th class="sorting">Status</th>
                            <th class="sorting">Type</th>
                            <th class="sorting">Created At</th>
                            <th class="datatable-nosort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                <td class="table-plus sorting_1" tabindex="0">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->type }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{route('admin.edit-user',$user->id)}}" type="button" class="btn btn-success btn-sm" >
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
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

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" action="{{ route('admin.create-user') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullName">Name</label>
                        <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter Full Name" required value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="userName">Username</label>
                        <input type="text" class="form-control" id="userName" name="username" placeholder="Enter Username" required value="{{ old('username') }}">
                        @error('username')
                        <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter User Email" required value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        @error('password')
                        <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">User Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="superAdmin" {{ old('type') == 'superAdmin' ? 'selected' : '' }}>superAdmin</option>
                            <option value="doctor" {{ old('type') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                            <option value="receptionist" {{ old('type') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        </select>
                        @error('type')
                        <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                        <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Display _MENU_ records",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false, // Avoid auto-sizing of columns
        });
    });

    $(document).ready(function() {
        @if ($errors->any())
            $('#createUserModal').modal('show');
        @endif
    });
 
    function confirmDelete() {
        return confirm('Are you sure you want to delete this user? This action cannot be undone.');
    }
</script>
@endpush
