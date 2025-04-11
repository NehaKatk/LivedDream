@extends('layouts.app')
@section('content')

    <div class="container">
        <h2>Edit Adhesive</h2>
        <form action="{{ route('adhesive.update', $adhesive->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button class="btn btn-success btn-save" type="submit">Update</button>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="m-3">
                            <h5>Adhesive Details</h5>

                            <div class="mb-3">
                                <label class="form-label">Company</label>
                                <select name="company_id" class="form-select">
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $adhesive->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adhesive Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $adhesive->name) }}" placeholder="Enter adhesive name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adhesive Quantity</label>
                                <input type="text" name="quantity" class="form-control" value="{{ old('quantity', $adhesive->quantity) }}" placeholder="Enter adhesive quantity">
                            </div>

                            <div>
                                <h5>Pricing Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Purchase Cost</label>
                                        <input type="number" name="purchase_cost" class="form-control" min="0" value="{{ old('purchase_cost', $adhesive->purchase_cost) }}" placeholder="₹00">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Selling Price</label>
                                        <input type="number" name="selling_price" class="form-control" min="0" value="{{ old('selling_price', $adhesive->selling_price) }}" placeholder="₹00">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection
