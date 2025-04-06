<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryParent;
use App\Models\Order;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function getProducts(Request $request)
    {
        $search = $request->query('search');
        $query = Product::query();

        $query->where(function ($q) {
            $q->whereHas('category', function ($q2) {
                $q2->where('hide', 0)
                    ->whereHas('parent', function ($q3) {
                        $q3->where('hide', 0);
                    });
            })->orWhereNull('id_category');
        });

        if ($request->has('search')) {
            $search = $request->search;
            $query->where( function ($s) use ($search){
                $s->where('id_product', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(35);

        return view('admin.product', compact('products'));
    }

    public function getCategories(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $query = Category::query();

        $query->whereHas('parent', function ($q) {
            $q->where('hide', 0);
        });
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where( function ($s) use ($search){
                $s->where('id_category', 'like', '%' . $search . '%')
                  ->orWhere('name_category', 'like', '%' . $search . '%');
            });
        }
    
        $categories = $query->paginate($perPage)->appends($request->all());
    
        return view('admin.category', compact('categories'));
    }

    public function getCategoryParents(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $query = CategoryParent::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where( function ($s) use ($search){
                $s->where('id_parent', 'like', '%' . $search . '%')
                  ->orWhere('name_parent', 'like', '%' . $search . '%');
            });
        }
        $categoryParents = $query->paginate($perPage)->appends($request->all());

        return view('admin.categoryparent', compact('categoryParents'));
    }

    public function getOrders(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $query = Order::query();
        $query->with(['user', 'province', 'district', 'area']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_order', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%')
                  ->orWhere('payment_methods', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }
        $orders = $query->paginate($perPage)->appends($request->all());

        return view('admin.order', compact('orders'));
    }

    public function getUsers(Request $request){
        $perPage = $request->input('per_page', 10);
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_user', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        $users = $query->paginate($perPage)->appends($request->all());
        return view('admin.user', compact('users'));
    }

    //dashboard
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCategoryParents = CategoryParent::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalCategoryParents',
            'totalUsers'
        ));
    }

    //cập nhật product
    public function getidproduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('hide',0)->get();
        return view('admin.update.updateproduct', compact('product', 'categories'));
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
            'brand' => 'required|string|max:255',
            'hide' => 'required|in:0,1',
            'image' => 'nullable|image|max:2048',
            'id_category' => 'required|exists:categories,id_category', 
        ]);
    
        $discount_price = $request->price * (1 - ($request->discount / 100));
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }
    
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $discount_price,
            'nums' => $request->nums,
            'discount' => $request->discount,
            'brand' => $request->brand,
            'hide' => (int) $request->hide,
            'image' => $imagePath,
            'id_category' => $request->id_category, 
        ]);
    
        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được cập nhật.');
    }
    
    //cập nhật category
    public function getidcategory($id)
    {
        $category = Category::findOrFail($id);
        $categoryparents = CategoryParent::where('hide', 0)->get();
        return view('admin.update.updatecategory', compact('category','categoryparents'));
    }

    public function updatecategory(Request $request, $id)
    {
        $request->validate([
            'name_category' => 'required|string|max:255',
            'hide' => 'required|in:0,1',
            'id_parent' => 'required|exists:category_parents,id_parent', 
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name_category' => $request->name_category,
            'hide' => (int) $request->hide, 
            'id_parent' => $request->id_parent,
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

    //cập nhật đơn hàng
    public function getidorder($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.update.updateorder', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Pending,Processing,Complete',
            'hide' => 'required|boolean',
        ]);
        
        $order->update([
            'status' => $request->status,
            'hide' => (int) $request->hide,
        ]);
        
        return redirect()->route('admin.orders')->with('success', 'Đơn hàng đã được cập nhật.');
    }

    //cập nhật user
    public function getiduser($id){
        $user = User::findOrFail($id);
        return view('admin.update.updateuser', compact('user'));
    }

    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'id_role' => 'required|in:1,2,3',
            'hide' => 'required|boolean',
        ]);

        $user->update([
            'id_role' => (int) $request->id_role,
            'hide' => (int) $request->hide,
        ]);

        return redirect()->route('admin.users')->with('success', 'Tài khoản người dùng đã được cập nhật');
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
            'name' => [
                'required','string','max:255',
                Rule::unique('products', 'name')
            ],
            'nums' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'discount_price' => 'nullable|numeric',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'hide' => 'required|boolean',
            'id_category' => 'required|exists:categories,id_category',

        ],[
            'name.unique' => 'Sản phẩm này đã tồn tại. Vui lòng nhập tên khác!'
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
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
            'name_category' => [
                'required', 'string', 'max:255',
                Rule::unique('categories', 'name_category')
            ],
            'hide' => 'required|boolean',
            'id_parent' => 'required|exists:category_parents,id_parent',
        ],[
            'name_category.unique' => 'Danh mục này đã tồn tại. Vui lòng nhập tên khác!'
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
            'hide' => 'required|boolean',], 
            ['name_parent.unique' => 'Danh mục này đã tồn tại. Vui lòng nhập tên khác!'
        ]);

        CategoryParent::create($validated);
        return redirect()->route('admin.categoryparents')->with('success', 'Thêm danh mục thành công!');
    }

}
