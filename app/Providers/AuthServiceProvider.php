<?php

namespace App\Providers;

use App\Models\Category;

use App\Models\City;
use App\Models\Image;
use App\Models\Product;
use App\Policies\CategoryPolicy;
use App\Policies\CityPolicy;
use App\Policies\ImagePolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Image::class => ImagePolicy::class,
        Product::class => ProductPolicy::class,
        City::class => CityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
