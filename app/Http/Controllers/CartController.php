<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('id_user', $user->id_user)
                        ->with('product')
                        ->get();
                        
        $subtotal = $cartItems->sum('total_price');
        $total = $subtotal;

        return view('cart.index', compact('cartItems', 'subtotal', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:products,id_product',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->id_product);
        
        $cartItem = Cart::where('id_user', $user->id_user)
                       ->where('id_product', $product->id_product)
                       ->first();

        $newQuantity = $request->quantity;
        if($cartItem){
            $newQuantity += $cartItem->quantity;
        }

        if($newQuantity > $product->nums) {
            return redirect()->back()->with('error', 'Số lượng yêu cầu cho ' . $newQuantity . ' không có sẵn!');
        }

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->total_price = $cartItem->quantity * ($product->discount_price > 0 ? $product->discount_price : $product->price);
            $cartItem->save();
        } else {
            Cart::create([
                'id_user' => $user->id_user,
                'id_product' => $product->id_product,
                'quantity' => $request->quantity,
                'total_price' => $request->quantity * ($product->discount_price > 0 ? $product->discount_price : $product->price),
                'purchased_at' => null
            ]);
        }

        // return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // Xóa 1 sản phẩm
    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::where('id', $request->cart_id)
                       ->where('id_user', Auth::user()->id_user)
                       ->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // Xóa nhiều sản phẩm
    public function removeMultiple(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array',
            'cart_ids.*' => 'exists:carts,id'
        ]);

        Cart::whereIn('id', $request->cart_ids)
            ->where('id_user', Auth::user()->id_user)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa các sản phẩm được chọn!');
    }

    // Cập nhật giỏ hàng
    public function update(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1'
        ]);

        $user = Auth::user();
        foreach ($request->quantities as $cartId => $quantity) {
            $cartItem = Cart::where('id', $cartId)
                           ->where('id_user', $user->id_user)
                           ->with('product')
                           ->firstOrFail();
            
            if ($quantity > $cartItem->product->nums) {
                $quantity = $cartItem->product->nums; // Giới hạn bởi số lượng tồn kho
            }

            $cartItem->quantity = $quantity;
            $cartItem->total_price = $quantity * ($cartItem->product->discount_price > 0 ? $cartItem->product->discount_price : $cartItem->product->price);
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
    }

    public static function cartItemCount()
    {
        if (Auth::check()) {
            return Cart::where('id_user', Auth::user()->id_user)->count();
        }
        return 0;
    }
}