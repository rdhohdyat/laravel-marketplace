<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::buyer.home')->name('home');
Route::livewire('/wishlist', 'pages::buyer.wishlist')->name('wishlist');
Route::livewire('/cart', 'pages::buyer.cart')->name('cart');
Route::livewire('/checkout', 'pages::buyer.checkout')->name('checkout');
Route::livewire('/profile', 'pages::buyer.profile')->name('profile');
Route::livewire('/orders', 'pages::buyer.orders')->name('orders');
Route::livewire('/products/{id}', 'pages::buyer.product-detail')->name('product.detail');
Route::livewire('/message', 'pages::buyer.message')->name('message');