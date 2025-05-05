<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartItems = session()->get('cartItems', []);
            $cartCount = array_sum(array_column($cartItems, 'quantity'));

            $view->with('cartCount', $cartCount);
        });
    }
}
