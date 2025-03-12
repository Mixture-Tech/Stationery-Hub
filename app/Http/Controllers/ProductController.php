<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 16);

        $query = Product::where('hide', false);
        
        if($request->has('category')){
            $query->where('id_category', $request->category);
        }

        $products = $query->paginate($perPage);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // public function showAllProduct()
}
