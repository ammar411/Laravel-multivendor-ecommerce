<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\CancelPage;
use App\Livewire\CategoriesPage;
use App\Livewire\HomePage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyOrdersDetailPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', HomePage::class)->name('home');

Route::get('/categories', CategoriesPage::class)->name('categories');

Route::get('/products', ProductsPage::class)->name('products');

Route::get('/cart', CartPage::class)->name('cart');

Route::get('/products/{slug}', ProductDetailPage::class)->name('product.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->to('/');
    })->name('logout');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/myorders', MyOrdersPage::class)->name('my-orders');
    Route::get('/myorders/{order_id}', MyOrdersDetailPage::class)->name('my-order-show');
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});
