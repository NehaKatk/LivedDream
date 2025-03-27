<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('categories.index');

    }
    public function create()
    {
      
        $categories = Category::select('id', 'name')->get();
        return view('categories.create', compact('categories'));

    }
}
