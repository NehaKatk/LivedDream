@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Add New Adhesive</h2>
    <form id="adhesiveForm" action="{{ route('adhesive.store') }}" method="POST" novalidate>
        @csrf
        <button class="btn btn-primary btn-save" type="submit" id="save">Save</button>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="m-3">
                        <h5>Adhesive Details</h5>

                        <!-- Company -->
                        <div class="mb-3">
                            <label class="form-label">Company</label>
                            <select name="company_id" class="form-select" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a company.</div>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Adhesive Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter adhesive name" required minlength="2">
                            <div class="invalid-feedback">Name must be at least 2 characters.</div>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label class="form-label">Adhesive Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter adhesive quantity" min="1" required>
                            <div class="invalid-feedback">Quantity must be at least 1.</div>
                        </div>

                        <!-- Pricing -->
                        <h5>Pricing Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Purchase Cost</label>
                                <input type="number" name="purchase_cost" class="form-control" min="0" value="0">
                                <div class="invalid-feedback">Purchase cost cannot be negative.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Selling Price</label>
                                <input type="number" name="selling_price" class="form-control" min="0" value="0">
                                <div class="invalid-feedback">Selling price cannot be negative.</div>
                            </div>
                        </div>
                    </div> <!-- m-3 -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->
    </form>
</div>

<script>
    document.getElementById('adhesiveForm').addEventListener('submit', function (e) {
        let form = this;
        let isValid = true;

        // Reset previous validations
        form.querySelectorAll('.form-control, .form-select').forEach(input => {
            input.classList.remove('is-invalid');
        });

        // Company
        const company = form.querySelector('select[name="company_id"]');
        if (company.value.trim() === "") {
            company.classList.add('is-invalid');
            isValid = false;
        }

        // Name
        const name = form.querySelector('input[name="name"]');
        if (name.value.trim().length < 2) {
            name.classList.add('is-invalid');
            isValid = false;
        }

        // Quantity
        const quantity = form.querySelector('input[name="quantity"]');
        if (parseInt(quantity.value) < 1 || quantity.value.trim() === "") {
            quantity.classList.add('is-invalid');
            isValid = false;
        }

        // Purchase Cost
        const purchaseCost = form.querySelector('input[name="purchase_cost"]');
        if (purchaseCost.value < 0) {
            purchaseCost.classList.add('is-invalid');
            isValid = false;
        }

        // Selling Price
        const sellingPrice = form.querySelector('input[name="selling_price"]');
        if (sellingPrice.value < 0) {
            sellingPrice.classList.add('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // prevent form from submitting
        }
    });
</script>

@endsection
