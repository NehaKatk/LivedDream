<?php

namespace App\Http\Controllers;

use App\Models\Adhesive;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
       
    
        // Handle product image upload
        // if ($request->hasFile('product_images')) {
        //     foreach ($request->file('product_images') as $image) {
        //         $imagePath = $image->store('products', 'public');
        //         ProductImage::create([
        //             'product_id' => $product->id,
        //             'image_path' => $imagePath,
        //         ]);
        //     }
        // }
    
        return redirect()->back()->with('success', 'Product added successfully!');
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
