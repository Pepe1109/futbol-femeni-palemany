<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepository;
use App\Repositories\EquipRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Quan es demani BaseRepository, Laravel injecta EquipRepository
        $this->app->bind(BaseRepository::class, EquipRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
