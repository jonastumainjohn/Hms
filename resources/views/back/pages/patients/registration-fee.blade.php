@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add Registration Fee')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Fees</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Registration Fee
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
            <h5 class="card-title text-white">{{ isset($fee) ? 'Edit' : 'Add' }} Registration Fee</h5>
        </div>

        <div class="card-body">
            <form action="{{ isset($fee) ? route('admin.update-registration-fee', $fee->id) : route('admin.store-registration-fee') }}" method="POST">
                @csrf
                @if(isset($fee)) @method('PUT') @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fee_amount">Fee Amount</label>
                            <input type="number" class="form-control" id="fee_amount" name="fee_amount" placeholder="Enter fee amount" value="{{ old('fee_amount', $fee->fee_amount ?? '') }}">
                            @error('fee_amount')
                            <span class="text-danger ml-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select class="form-control" id="currency" name="currency">
                                <option value="USD" {{ (old('currency', $fee->currency ?? '') == 'USD') ? 'selected' : '' }}>USD</option>
                                <option value="TZS" {{ (old('currency', $fee->currency ?? '') == 'TZS') ? 'selected' : '' }}>TZS</option>
                            </select>
                            @error('currency')
                            <span class="text-danger ml-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valid_from">Valid From</label>
                            <input type="date" class="form-control" id="valid_from" name="valid_from" value="{{ old('valid_from', $fee->valid_from ?? '') }}">
                            @error('valid_from')
                            <span class="text-danger ml-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valid_until">Valid Until</label>
                            <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ old('valid_until', $fee->valid_until ?? '') }}">
                            @error('valid_until')
                            <span class="text-danger ml-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Provide details about the registration fee">{{ old('description', $fee->description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> {{ isset($fee) ? 'Update Fee' : 'Save Fee' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($fee) <!-- Display only if the fee exists -->
<div class="pb-20">
    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title text-white">Current Registration Fee</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="fees-table" class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Fee Amount</th>
                            <th>Currency</th>
                            <th>Valid From</th>
                            <th>Valid Until</th>
                            <th>Description</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ number_format($fee->fee_amount, 2) }}</td>
                            <td>{{ $fee->currency }}</td>
                            <td>{{ $fee->valid_from }}</td>
                            <td>{{ $fee->valid_until }}</td>
                            <td>{{ $fee->description }}</td>
                            <td>{{ $fee->created_at->format('d/m/Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#fees-table').DataTable({
            responsive: true,
            language: {
                search: "Search: ",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
            },
            autoWidth: false,
        });
    });
</script>
@endpush
