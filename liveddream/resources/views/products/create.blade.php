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
                            <div class="mb-3 row">
                                <label class="form-label">Estimated Delivery Time</label>
                                {{-- <input type="text" name="estimated_delivery_time" class="form-control"
                                    placeholder="Enter estimated delivery time"> --}}
                                    <div class="col-md-6">
                                        <input type="number" name="estimated_delivery_time" class="form-control"
                                            placeholder="Duration" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="estimated_delivery_type" class="form-select">
                                            <option value="days">Days</option>
                                            <option value="months">Months</option>
                                            <option value="years">Years</option>
                                        </select>
                                    </div>
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
                                                                <span class="text-danger d-none" id="pdfNameError">Required</span>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productCode" class="form-label">Product Code</label>
                                                                <input type="text" class="form-control" id="productCode" placeholder="Enter product code">
                                                                {{-- <span class="text-danger d-none" id="productCodeError">Required</span> --}}
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="productColor" class="form-label">Product Color</label>
                                                                <input type="text" class="form-control" id="productColor" placeholder="Enter Color">
                                                                {{-- <span class="text-danger d-none" id="productCodeError">Required</span> --}}
                                                            </div>
                                                        </div>
                                                        <div class="column">
                                                            <div class="row">
                                                                <div class="col-md-6" style="display:flex;flex-direction:column">
                                                                    <label for="purchaseCost" class="form-label">Purchase cost*</label>
                                                                    <input type="number" class="form-control" id="purchaseCost" name="purchase_cost" value="0" min="0" placeholder="₹ 00" required>
                                                                    <span class="text-danger d-none" id="purchaseCostError">Required</span>
                                                                </div>
                                                                <div class="col-md-6" style="display:flex;flex-direction:column">
                                                                    <label for="sellingPrice" class="form-label">Selling price*</label>
                                                                    <input type="number" class="form-control" id="sellingPrice" name="selling_price" value="0" min="0" placeholder="₹ 00" required>
                                                                    <span class="text-danger d-none" id="sellingPriceError">Required</span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="discountPrice" class="form-label">Discount price</label>
                                                                <input type="number" class="form-control" id="discountPrice" placeholder="₹ 00" min="0">
                                                            </div>
                                                            <div class="form-check">
                                                            
                                                                <label class="form-check-label" for="stockAvailable">Stock Available</label>
                                                                <input class="form-check-input" type="checkbox" id="stockAvailable" checked>
                                                            </div>
                                                            <div class="modal-footer">
                                                    
                                                                    <button type="button" class="btn btn-primary" onclick="saveProduct()">Save</button>
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

                                 
                        </div>


                              
                                <div class="container mt-4">
                                    <h5 class="mb-3">Product List</h5>
                                
                                    <!-- Product Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-3 text-center align-middle">
                                            {{-- <thead class="table-light">
                                                <tr>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Code</th>
                                                    <th>Product Color</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead> --}}
                                            <tbody id="productTableBody">
                                                <!-- Dynamic product rows will be added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                
                                    <!-- File Upload Section -->
                                    <h6 class="mt-4">Upload Sample Images</h6>
                                    <div id="uploadSection" class="border p-3 text-center rounded" style="border-style: dashed; cursor: pointer;">
                                        <p class="mb-1">Drag your file(s) here or <a href="#" onclick="document.getElementById('imageUpload').click(); return false;">browse</a></p>
                                        <p class="text-muted">Max 10 MB files are allowed</p>
                                        <input type="file" id="imageUpload" class="d-none" multiple accept="image/*">
                                    </div>
                                
                                    <!-- Image Preview Section -->
                                    <div id="imagePreviewContainer" name="imagePreviewContainer" class="row mt-3"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
   
    <script>
        let saveButton = document.getElementById('product');
        let form = document.getElementById("productForm");
        const selectedFiles = [];
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
            previewContainer.dataset.imgSrc = e.target.result; // ✅ Properly storing image URL
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.innerHTML = "";
        delete previewContainer.dataset.imgSrc; // ✅ Properly removing the attribute
    }
}

function saveProduct() {
    // debugger;
    const previewContainer = document.getElementById('imagePreview');
    const productImage = previewContainer.dataset.imgSrc || ''; // ✅ Properly accessing stored image
    const productName = document.getElementById('pdfName').value.trim();
    const productCode = document.getElementById('productCode').value.trim();
    const productColor = document.getElementById('productColor').value.trim();
    const SellingPrice = document.getElementById('sellingPrice').value.trim();
    const discountPrice = document.getElementById('discountPrice').value.trim();
    const purchaseCost = document.getElementById('purchaseCost').value.trim();
    let stockAvailable = document.getElementById('stockAvailable').value.trim();
    stockAvailable = stockAvailable == 'on' ? 1 : 0;
    const modal = document.querySelector('.modal'); // ✅ Ensure you target the correct modal

    let valid = true;
    document.querySelectorAll(".text-danger").forEach(el => el.classList.add("d-none"));

    if (!productImage) valid = showError("imagePreview", "Please select an image", "red");
    // if (!productName) valid = showError("pdfNameError", "PDF Name is Requied");
    // if (!productCode) valid = showError("productCodeError", "Product Code is Required");
    // if (!productColor) valid = showError("productColorError", "Product Color is Required");
    if (purchaseCost === null || isNaN(Number(purchaseCost)) || purchaseCost == 0) {
    valid = showError("purchaseCostError", "Product Cost is Required");
}
if (SellingPrice === null || isNaN(Number(SellingPrice))  || SellingPrice == 0) {
    valid = showError("sellingPriceError", "Selling Price is Required");
}



    if (!valid) return;

    const tableBody = document.querySelector('table tbody');

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
    <td>
        <img src="${productImage}" style="max-height: 50px; border-radius: 5px;">
        <input type="hidden" name="product_image[]" value="${productImage}">
    </td>
    <td>
        ${productName}
        <input type="hidden" name="product_name[]" value="${productName}">
    </td>
    <td>
        ${productCode}
        <input type="hidden" name="product_code[]" value="${productCode}">
    </td>
    <td>
        ${productColor}
        <input type="hidden" name="product_color[]" value="${productColor}">
    </td>
   
      
        <input type="hidden" name="purchase_cost[]" value="${purchaseCost}">
    
   
        
        <input type="hidden" name="selling_price[]" value="${SellingPrice}">
    
   
       
        <input type="hidden" name="discount_price[]" value="${discountPrice}">
    
   
       
        <input type="hidden" name="stock_available[]" value="${stockAvailable}">
        <td>
         <button type="button" class="remove-row btn btn-danger btn-sm">
            <i class="fa fa-trash"></i>
        </button>
    </td>
    
`;

    tableBody.appendChild(newRow);
    newRow.querySelector('.remove-row').addEventListener('click', function () {
    this.closest('tr').remove();
});
    // Hide the modal after saving
    const modalInstance = bootstrap.Modal.getInstance(modal); // ✅ Bootstrap 5 method
    if (modalInstance) {
        modalInstance.hide();
    }

    // Optional: Reset form fields
    document.getElementById('imagePreview').value = "";
    document.getElementById('pdfName').value = "";
    document.getElementById('productCode').value = "";
    document.getElementById('productColor').value = "";
    document.getElementById('stockAvailable').value = "";
    document.getElementById('purchaseCost').value = "";
    document.getElementById('discountPrice').value = "";
    document.getElementById('sellingPrice').value = "";
    previewContainer.innerHTML = "";
}
function showError(id, msg, color) {
    document.getElementById(id).classList.remove("d-none");
    document.getElementById(id).textContent= msg;
    document.getElementById(id).style.color= color;
    return false;
}

        document.addEventListener("DOMContentLoaded", function() {
            const imageUpload = document.getElementById('imageUpload');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    let uploadedImages = new Set(); // Track uploaded images

    // Handle file selection
    imageUpload.addEventListener('change', function () {
        previewImages(this.files);
    });

    // Preview uploaded images
    function previewImages(files) {
        Array.from(files).forEach(file => {
            if (file.size > 10 * 1024 * 1024) {
                alert("File size must be less than 10MB");
                return;
            }

            const fileName = file.name;
            if (uploadedImages.has(fileName)) {
                alert("Duplicate image detected: " + fileName);
                return;
            }
            uploadedImages.add(fileName); // Add to Set
            selectedFiles.push(file);

            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.className = "col-md-6 mb-2";
                col.innerHTML = `
                    <div class="card shadow-sm">
                        <img src="${e.target.result}" name="sample_image" class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;" alt="Uploaded Image">
                        <div class="card-body p-2 text-center">
                            <button class="btn btn-sm btn-danger remove-img" data-name="${fileName}">Remove</button>
                        </div>
                    </div>
                `;
                imagePreviewContainer.appendChild(col);

                // Remove image functionality
                col.querySelector('.remove-img').addEventListener('click', function () {
                    uploadedImages.delete(fileName); // Remove from Set
                    col.remove();
                });
            };
            reader.readAsDataURL(file);
        });
    }
            const modal = document.getElementById('addproduct');

            modal.addEventListener('hidden.bs.modal', function () {
                // Clear all input fields
                // document.getElementById('productImage').value = "";
                // document.getElementById('pdfName').value = "";
                // document.getElementById('productCode').value = "";
                // document.getElementById('productColor').value = "";
                document.getElementById('purchaseCostError').innerHTML = "";
                document.getElementById('sellingPriceError').innerHTML = "";
                // document.getElementById('discountPrice').value = "";
                // document.getElementById('stockAvailable').checked = true; // Reset checkbox

                // Clear image preview
                document.getElementById('imagePreview').innerHTML = "";
            });
            

            

            if (saveButton) {
                saveButton.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent the form from submitting automatically

                    if (validateForm()) {
                        submitFormWithImages();
                        // form.submit(); // Submit the form only if validation passes
                    }
                });
            }
            function submitFormWithImages() {
    const formData = new FormData(form);

    // Append selected images
    selectedFiles.forEach((file, index) => {
        formData.append(`sample_image[${index}]`, file);
    });

    fetch(form.action, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Success:", data);
        alert("Product uploaded successfully!");
        form.reset(); // Reset form after success
        imagePreviewContainer.innerHTML = ""; // Clear image previews
        uploadedImages.clear();
        selectedFiles.length = 0;
        window.location.reload();
    })
    .catch(error => {
        console.error("Error:", error);
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
                    document.getElementById('product_name_error').innerText = 'Product name is Required';
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
                <div class="col-md-5">
                    <label class="form-label">Parameter Name</label>
                    <input type="text" name="custom_keys[]" class="form-control" placeholder="Enter parameter (e.g., Height)">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Value</label>
                    <input type="text" name="custom_values[]" class="form-control" >
                </div>
               <div class="col-md-2 text-center">
                <button type="button" class="btn btn-danger mt-5 btn-sm remove-row">X</button>
            </div>
            `;

                    container.appendChild(newRow);
                    newRow.querySelector(".remove-row").addEventListener("click", function () {
                        newRow.remove();
                    });
                });
            } else {
                console.error("Element not found: Ensure 'add-size' button and 'size-container' exist.");
            }
        });
    </script>
@endsection
