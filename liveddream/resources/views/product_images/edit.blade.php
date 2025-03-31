@extends('layouts.app')
@section('content')
    <div class="content">
        <h2 class="mb-4">Edit Product Image</h2>
        <div class="container">
            <div class="card p-4">
                <form action="{{ route('product.image.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="row g-3">

                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label class="form-label">Select Image</label>
                        <div class="border p-3 text-center" style="border-style: dashed;">
                            <input type="file" class="form-control d-none" id="productImage" name="product-image" accept="image/*" onchange="previewImage(event)">
                            <label for="productImage" class="d-block cursor-pointer">📤 Drag your file(s) or
                                <a href="#">browse</a></label>
                            <small class="text-muted">Max 10 MB files are allowed</small>
                            
                            <div id="imagePreview" class="mt-3">
                                @if(!empty($product->product_image) && file_exists(public_path($product->product_image)))
                                <img id="previewImg" src="{{ asset($product->product_image) }}" 
                                     class="img-fluid mt-2" 
                                     name="product-image"
                                     style="max-height: 150px; border-radius: 10px; cursor: pointer;"
                                     onclick="document.getElementById('productImage').click()">
                                <p class="text-muted mt-2" id="fileName">{{ basename($product->product_image) }}</p>
                            @else
                                <p class="text-muted mt-2" id="fileName">No file selected</p>
                            @endif
                            
                            </div>
                        </div>
                    </div>

                    <!-- PDF Name -->
                    <div class="col-md-6">
                        <label for="pdfName" class="form-label">PDF Name</label>
                        <input type="text" class="form-control" id="pdfName" name="pdf_name" value="{{ $product->pdf_name }}" placeholder="Enter PDF Name">
                        <span class="text-danger d-none" id="pdfNameError">Required</span>
                    </div>

                    <!-- Product Code -->
                    <div class="col-md-6">
                        <label for="productCode" class="form-label">Product Code</label>
                        <input type="text" class="form-control" id="productCode" name="product_code" value="{{ $product->product_code }}" placeholder="Enter product code">
                    </div>

                    <!-- Product Color -->
                    <div class="col-md-6">
                        <label for="productColor" class="form-label">Product Color</label>
                        <input type="text" class="form-control" id="productColor" name="product_color" value="{{ $product->product_color }}" placeholder="Enter Color">
                    </div>

                    <!-- Purchase Cost -->
                    <div class="col-md-6">
                        <label for="purchaseCost" class="form-label">Purchase Cost*</label>
                        <input type="number" class="form-control" id="purchaseCost" name="purchase_cost" value="{{ $product->purchase_cost }}" min="0" placeholder="₹ 00" required>
                        <span class="text-danger d-none" id="purchaseCostError">Required</span>
                    </div>

                    <!-- Selling Price -->
                    <div class="col-md-6">
                        <label for="sellingPrice" class="form-label">Selling Price*</label>
                        <input type="number" class="form-control" id="sellingPrice" name="selling_price" value="{{ $product->selling_price }}" min="0" placeholder="₹ 00" required>
                        <span class="text-danger d-none" id="sellingPriceError">Required</span>
                    </div>

                    <!-- Discount Price -->
                    <div class="col-md-6">
                        <label for="discountPrice" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" id="discountPrice" name="discount_price" value="{{ $product->discount_price }}" placeholder="₹ 00" min="0">
                    </div>

                    <!-- Stock Available -->
                    <div class="col-md-6">
                        <label class="form-check-label" for="stockAvailable">Stock Available</label>
                        <input class="form-check-input" type="checkbox" id="stockAvailable" name="stock_available" {{ $product->stock_available ? 'checked' : '' }}>
                    </div>

                    <!-- Save Button -->
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary" >Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid mt-2" style="max-height: 150px; border-radius: 10px;">
                        <p class="text-muted mt-2">${file.name}</p>
                    `;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
