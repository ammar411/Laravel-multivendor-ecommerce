<div class="w-full max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">My Orders</h1>

    @if($orders->count())
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="font-semibold">Order #{{ $order->id }}</p>
                            <p class="text-sm text-gray-500">Placed: {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 text-sm rounded-full 
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-700 
                                @elseif($order->status === 'completed') bg-green-100 text-green-700 
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-700 
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <p class="mb-3 text-sm text-gray-600">
                        <strong>Total:</strong> {{ $order->grand_total }} {{ $order->currency }}
                    </p>

                    {{-- ✅ Order Items --}}
                    @if($order->orderItems && $order->orderItems->count())
                        <div class="border-t pt-3 mt-3">
                            <p class="font-medium mb-2">Items:</p>
                            <ul class="space-y-2">
                                @foreach($order->orderItems as $item)
                                    <li class="flex items-center justify-between border-b pb-2">
                                        <div>
                                            {{-- Check product exists --}}
                                            <p>{{ $item->product->name ?? 'Product Removed' }}</p>
                                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                        </div>
                                        <p class="font-semibold">{{ $item->price }} {{ $order->currency }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mt-2">No items found for this order.</p>
                    @endif

                    {{-- ✅ Shipping Address --}}
                    @if($order->address)
                        <div class="border-t pt-3 mt-3">
                            <p class="font-medium mb-2">Shipping Address:</p>
                            <p class="text-sm text-gray-600">
                                {{ $order->address->address_line ?? '' }},
                                {{ $order->address->city ?? '' }},
                                {{ $order->address->country ?? '' }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <p class="text-gray-600">You have not placed any orders yet.</p>
    @endif
</div>
