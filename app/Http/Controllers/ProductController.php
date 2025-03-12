<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryParent;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 24);
        $query = Product::where('hide', false);
        
        if ($request->has('category')) {
            $query->where('id_category', $request->category);
        }
        
        if ($request->has('parent_category')) {
            $categoryIds = Category::where('id_parent', $request->parent_category)
                ->pluck('id_category')
                ->toArray();
            $query->whereIn('id_category', $categoryIds);
        }

        if ($request->has('price')) {
            $priceRange = $request->price;
            
            switch ($priceRange) {
                case '0-150':
                    $query->whereBetween('price', [0, 150]);
                    break;
                case '150-300':
                    $query->whereBetween('price', [150, 300]);
                    break;
                case '300-500':
                    $query->whereBetween('price', [300, 500]);
                    break;
                case '500-700':
                    $query->whereBetween('price', [500, 700]);
                    break;
                case '700-up':
                    $query->where('price', '>=', 700);
                    break;
            }
        }

        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate($perPage);
        
        $categoryParents = CategoryParent::where('hide', false)->get();
        $categories = Category::where('hide', false)->get();
        
        $selectedParentCategory = null;
        if ($request->has('parent_category')) {
            $selectedParentCategory = $request->parent_category;
        }
        
        return view('products.index', compact(
            'products', 
            'categories', 
            'categoryParents', 
            'selectedParentCategory'
        ));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('products.detail', compact('product'));
    }
}