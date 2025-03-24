<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryParent;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function getProducts(Request $request)
    {
        $search = $request->query('search');
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(20);

        return view('admin.product', compact('products'));
    }

    public function getCategories(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $query = Category::query();

        if ($request->has('search')) {
            $query->where('name_category', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate($perPage)->appends($request->all());

        return view('admin.category', compact('categories'));
    }


    public function getCategoryParents(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $query = CategoryParent::query();

        if ($request->has('search')) {
            $query->where('name_parent', 'like', '%' . $request->search . '%');
        }
        $categoryParents = $query->paginate($perPage)->appends($request->all());

        return view('admin.categoryparent', compact('categoryParents'));
    }


    public function getUsers (){
        return view('admin.user');
    }

    //cập nhật product
    public function getidproduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.update.updateproduct', compact('product'));
    }

    public function updateproduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'nums' => 'required|integer',
            'discount' => 'nullable|numeric|min:0|max:100',
            'hide' => 'required|in:0,1',
            'image' => 'nullable|image|max:2048',
        ]);

        $discount_price = $request->price * (1 - ($request->discount / 100));
    
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $discount_price, 
            'nums' => $request->nums,
            'discount' => $request->discount,
            'hide' => (int) $request->hide, 
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->update(['image' => $imagePath]);
        }
        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được cập nhật.');
    }
    
    //cập nhật category
    public function getidcategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.update.updatecategory', compact('category'));
    }

    public function updatecategory(Request $request, $id)
    {
        $request->validate([
            'name_category' => 'required|string|max:255',
            'hide' => 'required|in:0,1',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name_category' => $request->name_category,
            'hide' => (int) $request->hide, 
        ]);

        return redirect()->route('admin.categories')->with('success', 'Danh mục đã được cập nhật!');
    }

     //cập nhật categoryParent
    public function getidcategoryParent($id)
    {
        $categoryparent = CategoryParent::findOrFail($id);
        return view('admin.update.updatecategory-parent', compact('categoryparent'));
    }
    
    public function updatecategoryParent(Request $request, $id)
    {
        $request->validate([
            'name_parent' => 'required|string|max:255',
            'hide' => 'required|in:0,1',
        ]);
    
        $categoryparent = CategoryParent::findOrFail($id);
        $categoryparent->update([
            'name_parent' => $request->name_parent,
            'hide' => (int) $request->hide, 
        ]);
        return redirect()->route('admin.categoryparents')->with('success', 'Danh mục đã được cập nhật!');
    }

    //thêm sản phẩm
    public function addProduct()
    {
        $categories = Category::all(); 
        return view('admin.create.addproduct', compact('categories'));
    }
    

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nums' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'hide' => 'required|boolean',
            'id_category' => 'required|exists:categories,id_category',

        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads', 'public');
        }
        
        Product::create($validated);
        return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công!');
    }
    
     //thêm danh mục
     public function addCategory()
     {
         $categoryparents = CategoryParent::all(); 
         return view('admin.create.addcategory', compact('categoryparents'));
     }
     
 
     public function storeCategory(Request $request)
     {
         $validated = $request->validate([
             'name_category' => 'required|string|max:255',
             'hide' => 'required|boolean',
             'id_parent' => 'required|exists:categories,id_parent',
 
         ]);
        
         Category::create($validated);
         return redirect()->route('admin.categories')->with('success', 'Thêm danh mục thành công!');
     }

      //thêm danh mục parent
    public function addParent()
    {
        return view('admin.create.addcategoryparent');
    }



    public function storeParent(Request $request)
    {
        $validated = $request->validate([
            'name_parent' => [
                'required', 'string', 'max:255',
                Rule::unique('category_parents', 'name_parent')
            ],
            'hide' => 'required|boolean',
        ], [
            'name_parent.unique' => 'Danh mục này đã tồn tại. Vui lòng nhập tên khác!'
        ]);

        CategoryParent::create($validated);

        return redirect()->route('admin.categoryparents')->with('success', 'Thêm danh mục thành công!');
    }


}
