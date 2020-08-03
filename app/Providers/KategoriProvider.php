<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\KategoriRepositoryInterface;
use App\Repositories\Eloquent\KategoriRepository;

class KategoriProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KategoriRepositoryInterface::class, KategoriRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
