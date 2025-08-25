<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Product;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Product - Detail')]
class ProductDetailPage extends Component
{
    public string $slug;
    public $product;

    public $quantity=1; 

    public function mount(string $slug): void
    {
        $this->slug = $slug;
      $this->product = Product::where('slug', $slug)
            ->where('is_active', 1)
            ->first();
            
    }

    public function increaseQty(){
        $this->quantity++;

    }

    public function decreaseQty(){
      if($this->quantity>1){

     
        $this->quantity--;}
        
    }

     public function addToCart($product_id)
{
    $total_count = CartManagement::addItemToCartWithQuantity($product_id, $this->quantity);
  
    $this->dispatch('update-cart-count', total_count:$total_count)->to(Navbar::class);

    
        LivewireAlert::title('Product added to cart successfully!')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->timer(3000)
            ->show();
 
    
}

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product,
        ]);
    }
}