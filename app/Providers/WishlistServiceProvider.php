<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WishlistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/wishlist.php', 'wishlist');

        $this->app->bind('wishlist', function () {
            return new Wishlist();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         $this->registerPublishables();
    }

    protected function registerPublishables(): void
    {
        $this->publishes([
            __DIR__.'/../config/wishlist.php' => config_path('wishlist.php'),
        ], 'config');

        if (! class_exists('CreateWishlistTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_wishlist_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_wishlist_table.php'),
            ], 'migrations');
        }
    }
}
