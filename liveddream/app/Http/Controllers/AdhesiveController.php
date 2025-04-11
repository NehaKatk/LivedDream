<?php

namespace App\Http\Controllers;

use App\Models\Adhesive;
use App\Models\Company;
use Illuminate\Http\Request;

class AdhesiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adhesives = Adhesive::with('company')->get();
        return view('adhesive.index', compact('adhesives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::select('id','name')->get();
        return view('adhesive.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate the request
         $request->validate([
            'company_id' => 'required',
            'name' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'purchase_cost' => 'required|integer',
            'selling_price' => 'required|integer',
           
        ]);

        // Add the authenticated user's ID to the request data
        $data = $request->all();
        $data['user_id'] = auth()->id(); // Get the logged-in user's ID
        // dd($data);
        // Create the company record
        Adhesive::create($data);

        return redirect()->back()->with('success', 'Company added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adhesive $adhesive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
      
            $adhesive = Adhesive::findOrFail($id);
            $companies = Company::all();
            return view('adhesive.edit', compact('adhesive', 'companies'));
        
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adhesive $adhesive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adhesive $adhesive)
    {
        //
    }
}
