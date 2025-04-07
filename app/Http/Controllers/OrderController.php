<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn đặt hàng của người dùng
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('id_user', $user->id_user)
            ->where('hide', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết đơn đặt hàng
     */
    public function detail($id)
    {
        $user = Auth::user();
        $order = Order::with(['orderDetails.product', 'province', 'district', 'area'])
            ->where('id_order', $id)
            ->where('id_user', $user->id_user)
            ->where('hide', false)
            ->firstOrFail();
            
        return view('orders.detail', compact('order'));
    }
    
    /**
     * Hủy đơn hàng (chỉ cho đơn hàng đang ở trạng thái chờ xử lý)
     */
    public function cancel($id)
    {
        $user = Auth::user();
        $order = Order::where('id_order', $id)
            ->where('id_user', $user->id_user)
            ->where('status', 'pending')
            ->firstOrFail();
            
        $order->status = 'cancelled';
        $order->save();
        
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công');
    }
    
    /**
     * Ẩn đơn hàng (không xóa vĩnh viễn)
     */
    public function hide($id)
    {
        $user = Auth::user();
        $order = Order::where('id_order', $id)
            ->where('id_user', $user->id_user)
            ->firstOrFail();
            
        $order->hide = true;
        $order->save();
        
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được ẩn khỏi danh sách');
    }
}