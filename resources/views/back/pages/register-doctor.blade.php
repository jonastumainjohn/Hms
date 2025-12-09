@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : 'Page Title Here')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Doctors</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add Doctor
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Add Doctor Information</h5>
    </div>
    <div class="card-body">
        <div class="mt-2 mb-2">
            <x-form-alerts></x-form-alerts>
        </div>

            <!-- Form to Add Doctor -->
        <form action="{{ route('admin.store-doctor') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Select Doctor -->
                <div class="form-group col-md-6">
                    <label for="user_id" class="form-label">Select Doctor</label>
                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                        <option value="" disabled selected>Select a Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('user_id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }} ({{ $doctor->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Specialization -->
                <div class="form-group col-md-6">
                    <label for="specialization" class="form-label">Specialization</label>
                    <input type="text" name="specialization" id="specialization" class="form-control" 
                        placeholder="Enter Doctor's Specialization" value="{{ old('specialization') }}">
                    @error('specialization')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="form-group col-12">
                    <label for="availability" class="form-label">Availability</label>
                    <textarea name="availability" id="availability" class="form-control" 
                            placeholder="Enter Doctor Availability">{{ old('availability') }}</textarea>
                    @error('availability')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success">Save Doctor Info</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "Select a Doctor",
            allowClear: true, 
        });
    });
</script>

@endpush
