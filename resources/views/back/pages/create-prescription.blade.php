@extends('back.layout.pages-layout')

@section('pageTitle', 'Add Prescription')

@section('content')
<div class="card mt-3 shadow-sm mb-3">
    <div class="card-header bg-success text-white">
        <h5 class="card-title text-white">Add Prescription</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.store-prescriptions') }}" method="POST">
            @csrf
            <x-form-alerts></x-form-alerts>
           
            <!-- Searchable Select for Patients -->
            <div class="form-group">
                <label for="patient_id">Select Patient:</label>
                <select name="patient_id" id="patient_id" class="form-control select2" style="width: 100%">
                    <option value="" disabled selected>Select a patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">
                            {{ $patient->first_name }} {{ $patient->last_name }} - MRN: {{ $patient->mrn_number }}
                        </option>
                    @endforeach
                </select>
                @error('patient_id')
                    <span class="text-danger ml-l">{{$message}}</span>
                @enderror
            </div>

            <!-- Searchable Medical List -->
            <div class="form-group mt-3">
                <label>Select Medicals:</label>
                <input type="text" id="search-medical" class="form-control mb-2" placeholder="Search medical items">
                <div id="medicals-list" class="border p-2" style="max-height: 300px; overflow-y: auto;">
                    @foreach($medicals as $medical)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input medical-checkbox" data-price="{{ $medical->price }}" name="medical_items[{{ $medical->id }}][id]" value="{{ $medical->id }}">
                            <label class="form-check-label">{{ $medical->name }} ({{ $medical->price }} Tshs)</label>
                            <!-- Minimum quantity set to 1 -->
                            <input type="number" name="medical_items[{{ $medical->id }}][quantity]" class="form-control quantity-input d-inline-block w-25 ml-2" value="1" min="1" disabled>
                        </div>
                    @endforeach
                    @error('medical_items')
                        <span class="text-danger ml-l">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <!-- Searchable Product List -->
            <div class="form-group mt-3">
                <label>Select Product:</label>
                <input type="text" id="search-product" class="form-control mb-2" placeholder="Search Product items">
                <div id="products-list" class="border p-2" style="max-height: 300px; overflow-y: auto;">
                    @foreach($products as $product)
                        <div class="form-check" style="{{ $product->quantity < 5 ? 'color: red;' : '' }}">
                            <input type="checkbox" class="form-check-input product-checkbox" data-price="{{ $product->price }}" name="product_items[{{ $product->id }}][id]" value="{{ $product->id }}">
                            <label class="form-check-label">{{ $product->name }} ({{ $product->price }} Tshs) Available:({{$product->quantity}})</label>
                            <!-- Minimum quantity set to 1 -->
                            <input type="number" name="product_items[{{ $product->id }}][quantity]" class="form-control quantity-input d-inline-block w-25 ml-2" value="1" min="1" disabled>
                        </div>
                    @endforeach
                    @error('product_items')
                        <span class="text-danger ml-l">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <!-- Additional Notes -->
            <div class="form-group mt-3">
                <label for="description">Additional Notes:</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group mt-3">
                <label for="appointment_date">Appointment Date and Time:</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control">
                @error('appointment_date')
                    <span class="text-danger ml-l">{{ $message }}</span>
                @enderror
            </div>

            <!-- Total Price -->
            <div class="form-group mt-3">
                <strong>Total Medical Price: <span id="total-medical-price">0</span> Tshs</strong>
            </div>

            <div class="form-group mt-3">
                <strong>Total Product Price: <span id="total-product-price">0</span> Tshs</strong>
            </div>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 for the Patient dropdown
        $('.select2').select2({
            placeholder: "Select a patient",
            allowClear: true
        });

        // Search functionality for Medicals
        $('#search-medical').on('input', function() {
            let searchValue = $(this).val().toLowerCase();
            $('#medicals-list .form-check').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
            });
        });

        // Search functionality for Products
        $('#search-product').on('input', function() {
            let searchValue = $(this).val().toLowerCase();
            $('#products-list .form-check').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
            });
        });

        // Handle Medical Selection and Quantity
        const medicalCheckboxes = document.querySelectorAll('.medical-checkbox');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const totalMedicalPriceDisplay = document.getElementById('total-medical-price');
        const totalProductPriceDisplay = document.getElementById('total-product-price');

        medicalCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const quantityInput = this.closest('.form-check').querySelector('.quantity-input');
                quantityInput.disabled = !this.checked;

                // Ensure minimum quantity is 1
                if (!quantityInput.disabled && quantityInput.value < 1) {
                    quantityInput.value = 1;
                }

                calculateTotal();
            });

            checkbox.closest('.form-check').querySelector('.quantity-input').addEventListener('input', function() {
                // Enforce minimum value on input
                if (this.value < 1) {
                    this.value = 1;
                }
                calculateTotal();
            });
        });

        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const quantityInput = this.closest('.form-check').querySelector('.quantity-input');
                quantityInput.disabled = !this.checked;

                // Ensure minimum quantity is 1
                if (!quantityInput.disabled && quantityInput.value < 1) {
                    quantityInput.value = 1;
                }

                calculateTotal();
            });

            checkbox.closest('.form-check').querySelector('.quantity-input').addEventListener('input', function() {
                // Enforce minimum value on input
                if (this.value < 1) {
                    this.value = 1;
                }
                calculateTotal();
            });
        });

        function calculateTotal() {
            let totalMedical = 0;
            let totalProduct = 0;

            medicalCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const quantity = checkbox.closest('.form-check').querySelector('.quantity-input').value || 1;
                    const price = checkbox.getAttribute('data-price');
                    totalMedical += parseFloat(price) * parseInt(quantity);
                }
            });

            productCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const quantity = checkbox.closest('.form-check').querySelector('.quantity-input').value || 1;
                    const price = checkbox.getAttribute('data-price');
                    totalProduct += parseFloat(price) * parseInt(quantity);
                }
            });

            totalMedicalPriceDisplay.textContent = totalMedical.toFixed(2);
            totalProductPriceDisplay.textContent = totalProduct.toFixed(2);
        }
    });
</script>
@endpush
