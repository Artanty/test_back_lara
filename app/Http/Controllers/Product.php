<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class Product extends Controller
{
    
    public function index(Request $request)
    {
        // $product = Products::all();
        return '$product';
    }
}
