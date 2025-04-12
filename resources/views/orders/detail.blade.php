<x-app-layout>
    <section class="container w-4/5 mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-dark-blue">Chi tiết đơn hàng</h1>
                <a href="{{ route('orders.index') }}" class="text-medium-blue hover:underline">
                    &larr; Quay lại danh sách đơn hàng
                </a>
            </div>
            
            <!-- Thông tin đơn hàng -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="border rounded-lg p-4">
                    <h2 class="font-semibold text-lg mb-3">Thông tin đơn hàng</h2>
                    <div class="space-y-2">
                        <!-- <div class="flex justify-between">
                            <span class="text-gray-600">Mã đơn hàng:</span>
                            <span>#{{ $order->id_order }}</span>
                        </div> -->
                        <div class="flex justify-between">
                            <span class="text-gray-600">Thời gian đặt:</span>
                            <span>{{ $order->created_at->format('H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ngày đặt:</span>
                            <span>{{ $order->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Trạng thái:</span>
                            <span class="px-2 py-1 rounded text-white text-sm
                                @if($order->status == 'Pending') bg-yellow-600
                                @elseif($order->status == 'Confirmed') bg-purple-500
                                @elseif($order->status == 'Processing') bg-blue-500
                                @elseif($order->status == 'Shipped') bg-purple-500
                                @elseif($order->status == 'Complete') bg-green-500
                                @elseif($order->status == 'Cancelled') bg-red-500
                                @endif">
                                @if($order->status == 'Pending') Chờ xác nhận
                                @elseif($order->status == 'Confirmed') Xác nhận
                                @elseif($order->status == 'Processing') Đang xử lý
                                @elseif($order->status == 'Shipped') Đang giao
                                @elseif($order->status == 'Complete') Đã giao
                                @elseif($order->status == 'Cancelled') Đã hủy
                                @else {{ $order->status }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phương thức thanh toán:</span>
                            <span>
                                @if($order->payment_methods == 'cod')
                                    Thanh toán khi nhận hàng
                                @elseif($order->payment_methods == 'momo')
                                    Ví MoMo
                                @elseif($order->payment_methods == 'vnpay')
                                    VNPay
                                @else
                                    {{ $order->payment_methods }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="border rounded-lg p-4">
                    <h2 class="font-semibold text-lg mb-3">Địa chỉ giao hàng</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Người nhận:</span>
                            <span>{{ $order->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Số điện thoại:</span>
                            <span>{{ $order->user->phone ?? 'Không có' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Địa chỉ:</span>
                            <span>{{ $order->area->name_area ?? '' }}, {{ $order->district->name_district ?? '' }}, {{ $order->province->name_province ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chi tiết sản phẩm -->
            <h2 class="font-semibold text-lg mb-3">Sản phẩm đã đặt</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left">Sản phẩm</th>
                            <th class="py-3 px-4 text-left">Giá</th>
                            <th class="py-3 px-4 text-left">Số lượng</th>
                            <th class="py-3 px-4 text-left">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $detail)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    @if($detail->product && $detail->product->image)
                                        @if(file_exists(public_path('storage/' . $detail->product->image)))
                                            <img src="{{ asset('storage/' . $detail->product->image) }}"
                                                 alt="{{ $detail->product->name ?? 'Sản phẩm' }}"
                                                 class="w-16 h-16 object-cover mr-3 border">
                                        @else
                                            <img src="{{ $detail->product->image }}"
                                                 alt="{{ $detail->product->name ?? 'Sản phẩm' }}"
                                                 class="w-16 h-16 object-cover mr-3 border">
                                        @endif
                                    @else
                                        <img src="{{ asset('resources/images/default-product.jpg') }}"
                                             alt="{{ $detail->product->name ?? 'Sản phẩm' }}"
                                             class="w-16 h-16 object-cover mr-3 border">
                                    @endif
                                    <div>
                                        <div class="font-medium">{{ $detail->product->name ?? 'Sản phẩm không có sẵn' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">{{ number_format($detail->product->discount_price, 3, ',', '.') }}đ</td>
                            <td class="py-3 px-4">{{ $detail->quantity }}</td>
                            <td class="py-3 px-4">{{ number_format($detail->product->discount_price * $detail->quantity, 3, ',', '.') }} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Tổng kết -->
            <div class="mt-6 border-t pt-4">
                <div class="flex justify-end">
                    <div class="w-full md:w-1/3">
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Tổng tiền hàng:</span>
                            <span>{{ number_format($order->orderDetails->sum(function($detail) { 
                                return $detail->product->discount_price * $detail->quantity; 
                            }), 3, ',', '.') }} đ</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Phí vận chuyển:</span>
                            <!-- <span>{{ number_format($order->total_price - $order->orderDetails->sum(function($detail) { 
                                return $detail->price * $detail->qty; 
                            }), 0, ',', '.') }}đ</span> -->
                            <span>{{ number_format($order->district->fee, 3, ',', '.' )}} đ</span>
                        </div>
                        <div class="flex justify-between py-2 font-bold">
                            <span>Tổng thanh toán:</span>
                            <span class="text-red-600">
                                @if($order->payment_methods == 'momo')
                                    {{ number_format($order->total_price, 0, '.', '.') }} đ
                                @else
                                    {{ number_format($order->total_price, 3, ',', '.') }} đ
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Trạng thái đơn hàng -->
            <div class="mt-6 border-t pt-4">
                <h2 class="font-semibold text-lg mb-3">Trạng thái đơn hàng</h2>
                <div class="relative">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 {{ in_array($order->status, ['Pending','Confirmed', 'Shipped', 'Complete']) ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                @if(in_array($order->status, ['Pending','Confirmed', 'Shipped', 'Complete']))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                            <span class="text-xs mt-1">Chờ xác nhận</span>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 {{ in_array($order->status, ['Confirmed', 'Shipped', 'Complete']) ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                @if(in_array($order->status, ['Confirmed', 'Shipped', 'Complete']))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                            <span class="text-xs mt-1">Xác nhận</span>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 {{ in_array($order->status, ['Shipped', 'Complete']) ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                @if(in_array($order->status, ['Shipped', 'Complete']))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                            <span class="text-xs mt-1">Vận chuyển</span>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 {{ $order->status == 'Complete' ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                @if($order->status == 'Complete')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                @endif
                            </div>
                            <span class="text-xs mt-1">Hoàn thành</span>
                        </div>
                    </div>
                    
                    <!-- Line connecting dots -->
                    <div class="absolute top-4 left-0 w-full h-0.5 bg-gray-200 -z-10">
                        <div class="h-full bg-green-500" style="width: 
                            @if($order->status == 'Pending') 0%
                            @elseif($order->status == 'Confirmed') 33%
                            @elseif($order->status == 'Shipped') 67%
                            @elseif($order->status == 'Complete') 100%
                            @else 0%
                            @endif
                        "></div>
                    </div>
                </div>
                
                @if($order->status == 'Cancelled')
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <p class="font-medium">Đơn hàng đã bị hủy</p>
                </div>
                @elseif($order->status == 'Pending')
                <div class="mt-4 flex justify-end">
                    <form action="{{ route('orders.cancel', $order->id_order) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Hủy đơn hàng
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>