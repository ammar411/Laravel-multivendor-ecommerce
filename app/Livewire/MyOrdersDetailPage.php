<?php

namespace App\Livewire;

use App\Models\OrderItem;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Address;
use App\Models\Order;

#[Title('Orders Detail')]
class MyOrdersDetailPage extends Component
{
    public $order_id;
    
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        $address = Address::where('order_id', $this->order_id)->first();
        $order = Order::where('id', $this->order_id)->first();

        return view('livewire.my-orders-detail-page', [
            'order_items' => $order_items, // ✅ fixed casing
            'address' => $address,         // ✅ fixed casing
            'order' => $order              // ✅ fixed casing
        ]);
    }
}
