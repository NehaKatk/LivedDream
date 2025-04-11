@extends('layouts.app')
@section('content')

    <div class="container">
        <h2>Add New Addhesive</h2>
        <form action="{{ route('adhesive.store') }}" method="POST">
            @csrf
            <button class="btn btn-primary btn-save" type="submit" id="save">Save </button>
            <div class="row mt-3">
                <!-- Company Details -->
                <div class="col-md-6">

                    <div class="card">
                        <div class="m-3">
                        <h5>Addhesive Details</h5>
                        <div class="mb-3">
                            <label class="form-label">Company </label>

                            <select name="company_id" class="form-select">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Addhesive Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter addhesive name"
                                >

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Addhesive Quantity</label>
                            <input type="text" name="quantity" class="form-control"
                                placeholder="Enter addhesive quantity">
                        </div>
                        <div>   
                            <h5>Pricing Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Purchase Cost</label>
                                    <input type="number" name="purchase_cost" class="form-control" min="0" placeholder="₹00"
                                        >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Selling Price</label>
                                    <input type="number" name="selling_price" class="form-control" min="0" placeholder="₹00"
                                        >
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