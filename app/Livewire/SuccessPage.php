<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;

#[Title('Success-Page')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;
    public $order;

    public function mount()
    {
        // Get the latest order for the authenticated user
        $this->order = Order::with('address')
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        // Optional: Redirect if no order found
        if (!$this->order) {
            return redirect()->route('home'); // or wherever you want to redirect
        }
    }

    public function render()
    {
        if ($this->session_id) {
           Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            // FIX 1: Correct way to retrieve a checkout session
            $session_info = Session::retrieve($this->session_id);

            // FIX 2: Use $this->order instead of undefined $latest_order
            if ($session_info->payment_status != 'paid') {
                $this->order->payment_status = 'failed';
                $this->order->save();
                return redirect()->route('cancel');
            } else if ($session_info->payment_status == 'paid') {
                $this->order->payment_status = 'paid';
                $this->order->save();
            }
        }

        return view('livewire.success-page', ['order' => $this->order]);
    }
}
