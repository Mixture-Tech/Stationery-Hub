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
        $query = Product::where('hide', false)->where('nums', '>', 0);
        
        // Khởi tạo biến cho breadcrumb
        $breadcrumbItems = [];
        $categoryName = 'TẤT CẢ SẢN PHẨM';
        
        // Xử lý filter theo danh mục
        if ($request->has('category')) {
            $category = Category::findOrFail($request->category);
            $query->where('id_category', $request->category);
            $categoryName = $category->name_category;
            
            // Thêm danh mục cha vào breadcrumb
            $parentCategory = CategoryParent::findOrFail($category->id_parent);
            $breadcrumbItems[] = [
                'name' => $parentCategory->name_parent,
                'url' => route('products.index', ['parent_category' => $parentCategory->id_parent])
            ];
            
            // Thêm danh mục con vào breadcrumb
            $breadcrumbItems[] = [
                'name' => $category->name_category
            ];
        } 
        // Xử lý filter theo danh mục cha
        elseif ($request->has('parent_category')) {
            $parentCategory = CategoryParent::findOrFail($request->parent_category);
            $categoryIds = Category::where('id_parent', $request->parent_category)
                ->pluck('id_category')
                ->toArray();
            $query->whereIn('id_category', $categoryIds);
            $categoryName = $parentCategory->name_parent;
            
            // Thêm danh mục cha vào breadcrumb
            $breadcrumbItems[] = [
                'name' => $parentCategory->name_parent
            ];
        }
        // Hiển thị tất cả sản phẩm
        else {
            $breadcrumbItems[] = [
                'name' => 'TẤT CẢ SẢN PHẨM'
            ];
        }

        // Xử lý filter theo giá
        if ($request->has('price')) {
            $priceRanges = (array)$request->price;
            
            if (!empty($priceRanges)) {
                $query->where(function ($priceQuery) use ($priceRanges) {
                    foreach ($priceRanges as $priceRange) {
                        switch ($priceRange) {
                            case '0-150':
                                $priceQuery->orWhereBetween('price', [0, 150]);
                                break;
                            case '150-300':
                                $priceQuery->orWhereBetween('price', [151, 300]);
                                break;
                            case '300-500':
                                $priceQuery->orWhereBetween('price', [301, 500]);
                                break;
                            case '500-700':
                                $priceQuery->orWhereBetween('price', [501, 700]);
                                break;
                            case '700-up':
                                $priceQuery->orWhere('price', '>=', 701);
                                break;
                        }
                    }
                });
            }
        }

        // Xử lý sắp xếp
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('discount_price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('discount_price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
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
            'selectedParentCategory',
            'categoryName',
            'breadcrumbItems'
        ));
    }

    public function detail($id)
    {
        $product = Product::with('category.parent')->findOrFail($id);
        
        // Tạo breadcrumb cho trang chi tiết sản phẩm
        $breadcrumbItems = [];
        
        // Thêm danh mục cha vào breadcrumb
        $parentCategory = CategoryParent::findOrFail($product->category->id_parent);
        $breadcrumbItems[] = [
            'name' => $parentCategory->name_parent,
            'url' => route('products.index', ['parent_category' => $parentCategory->id_parent])
        ];
        
        // Thêm danh mục con vào breadcrumb
        $breadcrumbItems[] = [
            'name' => $product->category->name_category,
            'url' => route('products.index', ['category' => $product->category->id_category])
        ];
        
        // Thêm tên sản phẩm vào breadcrumb
        $breadcrumbItems[] = [
            'name' => $product->name
        ];
        
        return view('products.detail', compact('product', 'breadcrumbItems'));
    }
}