@extends('layouts.app')
@section('content')
    <div class="content">
        <h2 class="mb-4">Create New Product</h2>

        <form action="{{ route('products.store') }}" method="POST" id="productForm" enctype="multipart/form-data" onsubmit="return false;">
            @csrf
            <button class="btn btn-primary"  id="product">Save Product</button>
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="m-3">
                            <h5>Product Details</h5>
                            <div class="mb-3">
                                <label class="form-label">Company</label><span class="">*</span>
                                <select name="company_id" class="form-select">
                                    <option value="" disabled selected>Select company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach

                                </select>
                                <span id="company_name_error" style="color: red;"></span>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label><span class="">*</span>
                                <select name="category_id" id="category" class="form-select">
                                    <option value="" disabled selected>Select Product category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span id="Cat_name_error" style="color: red;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Name</label><span class="">*</span>
                                <input type="text" name="name" class="form-control" placeholder="Enter product name">
                                <span id="product_name_error" style="color: red;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Application Area</label>
                                <input type="text" name="app_area" class="form-control" placeholder="Enter application area">
                                
                            </div>
                            <h5>Product Size</h5>
                            <div class="row" id="size-container">
                                <div class="col-md-4">
                                    <label class="form-label">Length</label>
                                    <input type="number" name="length[]" class="form-control" value="00"
                                        min="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Width</label>
                                    <input type="number" name="width[]" class="form-control" value="00" min="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Thickness</label>
                                    <input type="number" name="thickness[]" class="form-control" value="00"
                                        min="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Unit</label>
                                    <select name="unit" id="unit" class="form-select">
                                        <option value="ft" selected>Foot (ft)</option>
                                        <option value="m">Meter (m)</option>
                                        <option value="cm">Centimeter (cm)</option>
                                        <option value="mm">Millimeter (mm)</option>
                                    
                                        <option value="inch">Inch (in)</option>
                                     
                                        
                                    </select>
                                   
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Other</label>
                                    <button type="button" class="btn btn-primary form-control" id="add-size">Add
                                        Parameter</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">GST Applied (%)</label>
                                <input type="text" name="gst" class="form-control"
                                    placeholder="Enter GST Percentage">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Warranty period</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" name="warranty_duration" class="form-control"
                                            placeholder="Duration" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="warranty_type" class="form-select">
                                            <option value="months">Months</option>
                                            <option value="years">Years</option>
                                        </select>
                                    </div>




                                </div>

                            </div>
                            <!-- <button class="btn btn-primary">Save Product</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="m-3">
                            <h5>Adhesive</h5>
                            <select name="adhesive_id" class="form-select mb-3">
                                <option value="" disabled selected>Select Adhesive</option>
                                @foreach ($adhesives as $adhesive)
                                    <option value="{{ $adhesive->id }}">{{ $adhesive->name }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label class="form-label">Labor Charges (per sq.ft)</label>
                                <input type="text" name="labor_charges" class="form-control"
                                    placeholder="Enter Labor Charges">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estimated Delivery Time</label>
                                <input type="text" name="estimated_delivery_time" class="form-control"
                                    placeholder="Enter estimated delivery time">
                            </div>
                            {{-- <button class="btn btn-primary">Save</button> --}}
                        </div>
                        <div class="card m-2">
                            <div class="m-3">
                                <h5>Product Images</h5>
                                <button class="btn btn-dark w-100 mb-3"  data-bs-toggle="modal" data-bs-target="#addproduct">Add Product Images</button>

                                <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Product Details</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" >
                                                
                                                    <div style="display:flex;flex-direction:row;gap:5%;width:100% ;">
                                                        <div class="column" >
                                                            <div class="mb-3">
                                                                <label class="form-label">Select Image</label>
                                                                <div class="border p-3 text-center" style="border-style: dashed;">
                                                                    <input type="file" class="form-control d-none" id="productImage" accept="image/*" onchange="previewImage(event)">
                                                                    <label for="productImage" class="d-block cursor-pointer">📤 Drag your file(s) or <a href="#">browse</a></label>
                                                                    <small class="text-muted">Max 10 MB files are allowed</small>
                                                                
                                                                    <!-- Image Preview Section -->
                                                                    <div id="imagePreview" class="mt-3"></div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3" >
                                                                <label for="pdfName" class="form-label">PDF Name</label>
                                                                <input type="text" class="form-control" id="pdfName" placeholder="Enter PDF Name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productCode" class="form-label">Product Code</label>
                                                                <input type="text" class="form-control" id="productCode" placeholder="Enter product code">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productColor" class="form-label">Product Color</label>
                                                                <input type="text" class="form-control" id="productColor" placeholder="Enter Color">
                                                            </div>
                                                        </div>
                                                        <div class="column">
                                                            <div class="row">
                                                                <div class="col-md-6" style="display:flex;flex-direction:column">
                                                                    <label for="purchaseCost" class="form-label">Purchase cost*</label>
                                                                    <input type="number" class="form-control" id="purchaseCost" name="purchase_cost" value="0" placeholder="₹ 00" required>
                                                                </div>
                                                                <div class="col-md-6" style="display:flex;flex-direction:column">
                                                                    <label for="sellingPrice" class="form-label">Selling price*</label>
                                                                    <input type="number" class="form-control" id="sellingPrice" name="selling_price" value="0" placeholder="₹ 00" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="discountPrice" class="form-label">Discount price</label>
                                                                <input type="number" class="form-control" id="discountPrice" placeholder="₹ 00">
                                                            </div>
                                                            <div class="form-check">
                                                            
                                                                <label class="form-check-label" for="stockAvailable">Stock Available</label>
                                                                <input class="form-check-input" type="checkbox" id="stockAvailable" checked>
                                                            </div>
                                                            <div class="modal-footer">
                                                    
                                                                    <button type="button" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <!-- <div class="modal-footer">
                                               
                                                <button type="button" class="btn btn-primary">Save</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                                 {{-- <!-- Modal for adding images -->
                                 <div class="modal fade" id="addproduct" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Product Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Image</label>
                                                        <input type="file" class="form-control" id="productImage" accept="image/*">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Product Code</label>
                                                        <input type="text" class="form-control" id="productCode">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Product Color</label>
                                                        <input type="text" class="form-control" id="productColor">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Purchase Cost*</label>
                                                        <input type="number" class="form-control" id="purchaseCost" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Selling Price*</label>
                                                        <input type="number" class="form-control" id="sellingPrice" required>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="stockAvailable" checked>
                                                        <label class="form-check-label" for="stockAvailable">Stock Available</label>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Sample Image Upload -->
                                {{-- <h6>Sample Images</h6>
                                <div class="border p-3 text-center" style="border-style: dashed;">
                                    Drag your file(s) or <a href="#">browse</a><br>
                                    Max 10 MB files are allowed
                                </div>
                            </div> --}}
                        </div>


                                <table class="table table-bordered mt-3">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Color</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Product rows will go here -->
                                    </tbody>
                                </table>
                                <h6>Sample Images</h6>

                                <div class="border p-3 text-center" style="border-style: dashed;">
                                    Drag your file(s) or <a href="#">browse</a>
                                    <br>
                                    Max 10 MB files are allowed
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    {{-- <script>
      document.getElementById("product").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default button behavior
        let form = document.getElementById("productForm");
        
        // Manually submit the form
        form.submit();
      });
    </script> --}}
    <script>
               function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" class="img-fluid mt-2" style="max-height: 150px; border-radius: 10px;">
                    <p class="text-muted mt-2">${file.name}</p>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = "";
        }
    }
        document.addEventListener("DOMContentLoaded", function() {
            
     
             let form = document.getElementById("productForm");

            let saveButton = document.getElementById('product');

            if (saveButton) {
                saveButton.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent the form from submitting automatically

                    if (validateForm()) {
                        form.submit(); // Submit the form only if validation passes
                    }
                });
            }

            function validateForm() {
                var productName = document.getElementsByName('name')[0].value;
                var productCategory = document.getElementById('category').value;
                var productCompany = document.getElementsByName('company_id')[0].value;

                // Clear previous error messages
                document.getElementById('product_name_error').innerText = '';
                document.getElementById('Cat_name_error').innerText = '';
                document.getElementById('company_name_error').innerText = '';

                let isValid = true;

                if (productName.trim() === '') {
                    document.getElementById('product_name_error').innerText = 'Product name is required';
                    isValid = false;
                }

                if (!productCategory || productCategory === '') {
                    document.getElementById('Cat_name_error').innerText = 'Please select a category.';
                    isValid = false;
                }

                if (!productCompany || productCompany === '') {
                    document.getElementById('company_name_error').innerText = 'Please select a Company.';
                    isValid = false;
                }

                if (isValid) {
                    // toastr.success('Product added successfully.');
                    // setTimeout(function() {
                    //     window.location.href = '/products';
                    // }, 8000);
                    return true;
                    
                }

                return false;
            }



            let addButton = document.getElementById("add-size");
            let container = document.getElementById("size-container");

            if (addButton && container) {
                addButton.addEventListener("click", function() {
                    let newRow = document.createElement("div");
                    newRow.classList.add("row", "mt-2");

                    newRow.innerHTML = `
                <div class="col-md-6">
                    <label class="form-label">Parameter Name</label>
                    <input type="text" name="custom_keys[]" class="form-control" placeholder="Enter parameter (e.g., Height)">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Value</label>
                    <input type="text" name="custom_values[]" class="form-control" >
                </div>
            `;

                    container.appendChild(newRow);
                });
            } else {
                console.error("Element not found: Ensure 'add-size' button and 'size-container' exist.");
            }
        });
    </script>
@endsection
