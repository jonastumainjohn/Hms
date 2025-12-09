@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit User')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Users</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit User
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title text-white">Edit User Information</h5>
        </div>
        <div class="card-body">
           <form id="editUserForm" action="{{ route('admin.update-user', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Name and Username -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullName">Name</label>
                    <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter Full Name" required>
                    @error('name')
                    <span class="text-danger ml-1">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="userName">Username</label>
                    <input type="text" class="form-control" id="userName" name="username" value="{{ old('username', $user->username) }}" placeholder="Enter Username" required>
                    @error('username')
                    <span class="text-danger ml-1">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Email and Password -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter Email" required>
                    @error('email')
                    <span class="text-danger ml-1">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password (Leave blank if not updating)</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                    @error('password')
                    <span class="text-danger ml-1">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- User Type and Status -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">User Type</label>
                    <select class="form-control" id="type" name="type">
                        <option value="superAdmin" {{ $user->type == 'superAdmin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="doctor" {{ $user->type == 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="receptionist" {{ $user->type == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                    </select>
                    @error('type')
                    <span class="text-danger ml-1">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                    <span class="text-danger ml-1">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
    </div>
</div>

@endsection
