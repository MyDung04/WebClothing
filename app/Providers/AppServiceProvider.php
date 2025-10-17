<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('frontend.layout.menu_left', function ($view) {
            $view->with('category', Category::all());
            $view->with('brand', Brand::all());
        });
        View::composer('frontend.layout.header', function ($view) {
            $qty = 0;
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {

                $qty += $item['quantity'];

                $view->with('qty', $qty);
            }
        });
    }
}
