<?php

namespace App\Http\Controllers;

use App\Models\Adhesive;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSample;
use App\Models\ProductSize;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with([
            'images',
            'category:id,name',  // Fetch only 'id' and 'name' from Category
            'company:id,name'   // Fetch only 'id' and 'name' from Company
        ])
        ->get();
     
        return view('products.index', compact('products'));
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
            'app_area' => $request->app_area,
            'gst' => $request->gst,
            'warranty_duration' => $request->warranty_duration,
            'warranty_type' => $request->warranty_type,
            'adhesive_id' => $request->adhesive_id,
            'labor_charge' => $request->labor_charges ?? 0,
            'estimate_delivery_duration' => $request->estimated_delivery_time,
            'estimate_delivery_type' => $request->estimated_delivery_type,
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
        
return redirect()->route('products.show')->with('success', 'Product added successfully!');
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
        $sampleData = [];
        $userId = auth()->id();
        $timestamp = now();
    
        foreach ((array) $files as $key => $file) {
            $imagePath = is_string($file) ? $file : 'storage/' . $file->storeAs('product_images', time() . "_$key." . $file->getClientOriginalExtension(), 'public');
    
            if ($sampleStatus == 0) {
                // Store in `product_images`
                $imageData[] = [
                    'pdf_name' => request("product_name.$key", null),
                    'product_id' => $productId,
                    'product_image' => $imagePath,
                    'product_code' => request("product_code.$key", null),
                    'product_color' => request("product_color.$key", null),
                    'purchase_cost' => request("purchase_cost.$key", 0),
                    'selling_price' => request("selling_price.$key", 0),
                    'discount_price' => request("discount_price.$key", 0),
                    'stock_available' => request("stock_available.$key", 0),
                    'user_id' => $userId,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            } else {
                // Store in `product_samples`
                $sampleData[] = [
                    'product_id' => $productId,
                    'sample_image' => $imagePath,
                    'user_id' => $userId,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }
    
        if (!empty($imageData)) ProductImage::insert($imageData);
        if (!empty($sampleData)) ProductSample::insert($sampleData);
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
    public function edit($id)
    {
        $companies = Company::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $adhesives = Adhesive::select('id', 'name')->get();
        $product = Product::with([
            'images',
            'category:id,name',
            'company:id,name',
            'sizes'
        ])->findOrFail($id);
     
        // dd($product);
        return view('products.edit', compact('product','categories','companies','adhesives'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }


    public function editProductImage( $id, $productId)
    {
        Session::put('previous_url', url()->previous());
        $product = ProductImage::findOrFail($id); // Find the product using product ID
      
        return view('product_images.edit', compact('product'));
    }
    public function updateProductImage(Request $request, $id)
{
    $product = ProductImage::findOrFail($id);

    // Validate request
    $request->validate([
        'pdf_name' => 'nullable|string|max:255',
        'product_code' => 'nullable|string|max:50',
        'product_color' => 'nullable|string|max:50',
        'purchase_cost' => 'required|numeric|min:0',
        'selling_price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);

    // Handle file upload
    if ($request->hasFile('product_image')) {
        $imagePath = $request->file('product_image')->store('product_images', 'public');

        // Delete old image if exists
        if ($product->product_image && file_exists(public_path($product->product_image))) {
            unlink(public_path($product->product_image));
        }

        $product->product_image = 'storage/' . $imagePath;
    }

    // Update product details
    $product->pdf_name = $request->pdf_name;
    $product->product_code = $request->product_code;
    $product->product_color = $request->product_color;
    $product->purchase_cost = $request->purchase_cost;
    $product->selling_price = $request->selling_price;
    $product->discount_price = $request->discount_price;
    $product->stock_available = $request->stock_available == 'on'? 1: 0;

    $product->save();
    // dd($product);

   
    return redirect(Session::pull('previous_url', route('products.show')))
    ->with('success', 'Product updated successfully!');

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
