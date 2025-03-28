<?php

namespace App\Http\Controllers;

use App\Models\Adhesive;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $adhesives = Adhesive::select('id', 'name')->get();
        return view('products.create', compact('companies','categories','adhesives'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'company_id' => 'required|integer|exists:companies,id',  // Ensure it exists in the companies table
            'category_id' => 'required',
            'name' => 'required|string',
         
        ]);
        // Create Product
        $product = Product::create([
            'company_id' => $request->company_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'gst' => $request->gst,
            'warranty_duration' => $request->warranty_duration,
            'warranty_type' => $request->warranty_type,
            'adhesive_id' => $request->adhesive_id,
            'labor_charges' => $request->labor_charges,
            'delivery_time' => $request->estimated_delivery_time,
            'user_id' => auth()->id(),
        ]);

        // Get current timestamp
$timestamp = Carbon::now();

$sizes = [];

if (!empty($request->length[0]) && $request->length[0] != 0) {
    $sizes[] = [
        'key' => 'Length', 
        'value' => $request->length[0], 
        'unit' => $request->unit, 
        'product_id' => $product->id, 
        'user_id' => auth()->id(),
        'created_at' => $timestamp,
        'updated_at' => $timestamp
    ];
}

if (!empty($request->width[0]) && $request->width[0] != 0) {
    $sizes[] = [
        'key' => 'Width', 
        'value' => $request->width[0], 
        'unit' => $request->unit, 
        'product_id' => $product->id, 
        'user_id' => auth()->id(),
        'created_at' => $timestamp,
        'updated_at' => $timestamp
    ];
}

if (!empty($request->thickness[0]) && $request->thickness[0] != 0) {
    $sizes[] = [
        'key' => 'Thickness', 
        'value' => $request->thickness[0], 
        'unit' => $request->unit, 
        'product_id' => $product->id, 
        'user_id' => auth()->id(),
        'created_at' => $timestamp,
        'updated_at' => $timestamp
    ];
}

// Handle additional dynamic parameters
if ($request->has('custom_keys') && $request->has('custom_values')) {
    foreach ($request->custom_keys as $index => $key) {
        if (!empty($request->custom_values[$index]) && $request->custom_values[$index] != 0) {
            $sizes[] = [
                'key' => $key,
                'value' => $request->custom_values[$index],
                'unit' => $request->unit, 
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }
    }
}

// Insert only if there are valid entries
if (!empty($sizes)) {
    ProductSize::insert($sizes);
}


// if ($request->hasFile('sample_image')) {
//     Log::info('Sample image found in request.', [
//         'product_id' => $product->id,
//         'file_name' => $request->file('sample_image'),
//     ]);

//     $this->storeProductImages($request->file('sample_image'), $product->id, 1);

//     Log::info('Sample image stored successfully.', [
//         'product_id' => $product->id
//     ]);
// }

        
// if ($request->has('product_image')) { 
//     $image = $request->input('product_image');

//     if (is_array($image)) {
//         $image = reset($image); 
//     }

//     if (is_string($image)) {
//         $imageName = 'product_' . time() . '.jpg'; 
//         $imagePath = public_path('uploads/products/' . $imageName);

//         // Ensure the directory exists
//         if (!file_exists(public_path('uploads/products'))) {
//             mkdir(public_path('uploads/products'), 0777, true);
//         }

//         file_put_contents($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image)));
//         $this->storeProductImages($imageName, $product->id, 0);

//         Log::info('Product image stored successfully.', [
//             'file_name' => $imageName,
//         ]);
//     } else {
//         Log::error('Invalid product image format', ['data' => $image]);
//     }
// }

if ($request->has('product_image')) { 
    $image = $request->input('product_image');

    if (is_array($image)) {
        foreach ($image as $key => $img) {
            $this->processBase64Image($img, $product->id, 0, $key);
        }
    } else {
        $this->processBase64Image($image, $product->id, 0);
    }
}

if ($request->hasFile('sample_image')) {
    $this->storeProductImages($request->file('sample_image'), $product->id, 1);
}
        
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    // private function storeProductImages($files, $productId, $sampleStatus)
    // {
    //     if (!$files) return;

    //     $imageData = [];
    //     foreach ($files as $key => $image) {
    //         $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
    //         $imagePath = $image->storeAs('product_images', $imageName, 'public');
    //         Log::info("store product image",["sampleStatus"=> $sampleStatus,"imagePath" => $imagePath, "imageName"=>$imageName]);
    //         $imageData[] = [
    //             'product_id' => $productId,
    //             'pdf_name' => request("product_name.$key", null),
    //             'product_code' => request("product_code.$key", null),
    //             'product_color' => request("product_color.$key", null),
    //             'product_image' => $imagePath,
    //             'purchase_cost' => request("purchase_cost.$key", 0),
    //             'selling_price' => request("selling_price.$key", 0),
    //             'discount_price' => request("discount_price.$key", 0),
    //             'stock_available' => request("stock_available.$key", 0),
    //             'sample_status' => $sampleStatus,
    //             'user_id' => auth()->id(),
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ];
    //     }

    //     ProductImage::insert($imageData);
    // }


    private function storeProductImages($files, $productId, $sampleStatus, $key = 0)
    {
        $imageData = [];
    
        if (is_string($files)) {
            // Handling base64 images
            $imageEntry = [
                'product_id' => $productId,
                'product_image' => $files, // Directly use path from base64 processing
                'sample_status' => $sampleStatus,
                'user_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            // Add extra fields only if sample_status is 1
            if ($sampleStatus == 0) {
                $imageEntry = array_merge($imageEntry, [
                    'pdf_name' => request("product_name.$key", null),
                    'product_code' => request("product_code.$key", null),
                    'product_color' => request("product_color.$key", null),
                    'purchase_cost' => request("purchase_cost.$key", 0),
                    'selling_price' => request("selling_price.$key", 0),
                    'discount_price' => request("discount_price.$key", 0),
                    'stock_available' => request("stock_available.$key", 0),
                ]);
                 // Log the merged data
                Log::info("Product Image Data (SampleStatus 0 - Base64)", $imageEntry);
            }
    
            $imageData[] = $imageEntry;
        } else {
            // Handling file uploads
            foreach ((array) $files as $key => $image) {
                $imageName = time() . "_$key." . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('product_images', $imageName, 'public');
    
                $imageEntry = [
                    'product_id' => $productId,
                    'product_image' => 'storage/' . $imagePath,
                    'sample_status' => $sampleStatus,
                    'user_id' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
    
                // Add extra fields only if sample_status is 1
                if ($sampleStatus == 0) {
                    $imageEntry = array_merge($imageEntry, [
                        'pdf_name' => request("product_name.$key", null),
                        'product_code' => request("product_code.$key", null),
                        'product_color' => request("product_color.$key", null),
                        'purchase_cost' => request("purchase_cost.$key", 0),
                        'selling_price' => request("selling_price.$key", 0),
                        'discount_price' => request("discount_price.$key", 0),
                        'stock_available' => request("stock_available.$key", 0),
                    ]);
                     // Log the merged data
                Log::info("Product Image Data (SampleStatus 0 - File Upload)", $imageEntry);
                }
    
                $imageData[] = $imageEntry;
            }
        }
    
        ProductImage::insert($imageData);
    }
    
private function processBase64Image($image, $productId, $sampleStatus, $key = 0)
{
    if (!is_string($image)) {
        Log::error('Invalid base64 image format', ['data' => $image]);
        return;
    }

    $imageName = 'product_' . time() . "_$key.jpg"; 
    $imagePath = 'uploads/products/' . $imageName;

    // Ensure the directory exists
    if (!file_exists(public_path('uploads/products'))) {
        mkdir(public_path('uploads/products'), 0777, true);
    }

    file_put_contents(public_path($imagePath), base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image)));

    // Call storeProductImages to save database record
    $this->storeProductImages($imagePath, $productId, $sampleStatus, $key);
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
