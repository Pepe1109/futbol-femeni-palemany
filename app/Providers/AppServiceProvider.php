<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repositories
use App\Repositories\BaseRepository;
use App\Repositories\EquipRepository;
use App\Repositories\EstadiRepository;
use App\Repositories\EloquentEstadiRepository;
use App\Repositories\GenereRepository;
use App\Repositories\EloquentGenereRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepository::class, EquipRepository::class);
        $this->app->bind(EstadiRepository::class, EloquentEstadiRepository::class);
        $this->app->bind(GenereRepository::class, EloquentGenereRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Nada extra necesario por ahora
    }
}
