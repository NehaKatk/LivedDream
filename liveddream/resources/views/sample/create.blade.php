@extends('layouts.app')
@section('content')
    <div class="content">
        <!-- Header Section -->
        <div style="display: flex; flex-direction: row; gap: 30%;">
            <h2 class="mb-0">Create New Display Cost</h2>
            <button class="btn btn-primary btn-save" type="submit" id="sample">Save Sample</button>
        </div>

        <!-- Main Content Section -->
        <div class="row mt-3 d-flex flex-row" style="gap:5%"> <!-- Ensure flex row alignment -->
            <!-- Company Details -->
            <div class="card" style="width: 50%">
                <div class="mb-5">
                    <h5>Sample Details</h5>
                    <div class="mt-4">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="category" class="form-control w-100" placeholder="Enter category name" required>
                    </div>
                    <div class="mt-4">
                        <label class="form-label">Sample Name</label>
                        <input type="text" name="sample_name" class="form-control w-100">
                    </div>
                    <div class="mt-4">
                        <label class="form-label">Sample Cost</label>
                        <input type="text" name="sample_cost" class="form-control w-100" placeholder="00">
                    </div>
                    <div class="mt-4">
                        <span>Display area required</span>
                        <div style="display: flex; flex-direction: row; justify-content: space-between;">
                            <div>
                                <label class="form-label">Length</label>
                                <input type="text" class="form-control w-100" placeholder="00">
                            </div>
                            <div>
                                <label class="form-label">Width</label>
                                <input type="text" name="width" class="form-control w-100" placeholder="00">
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Thickness</label>
                            <input type="text" name="thickness" class="form-control" style="width: 37%;" placeholder="00">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Product Image Section -->
            <div class="card" style="width: 40%; display: flex; justify-content: center; padding: 20px;">
                <h6>Display Product Image</h6>
                    <div class="upload-box" >
                        <input type="file" id="fileInput" accept=".jpg, .png, .webp" hidden>
                        <label for="fileInput" class="upload-area" style="justify-items: center">
                            <!-- <img src="upload-icon.png" alt="Upload Icon" class="upload-icon"> -->
                            <i class="fa-solid fa-cloud-arrow-up fa-xl" style="color: #437ca8;"></i>
                            <p>Drag your file(s) or <span class="browse-text">browse</span></p>
                            <small>Max 10 MB files are allowed</small>
                        </label>
                        
                    </div>
                    <p class="file-support-text">Only support .jpg, .png, and .webp files</p>
        
            </div>
        </div>
    </div>
@endsection
