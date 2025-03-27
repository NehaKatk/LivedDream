<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\zones;


class zoneController extends Controller
{
    //
    public function index()
    {
        return view('zones.index');
    }



    
    public function create()
    {
        // $companies = Company::select('id', 'name')->get();
        // $sample = Sample::select('id', 'name')->get();
      
        return view('zones.create');
    }
}
