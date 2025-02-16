<?php

namespace App\Providers;

use App\Chess\Board;
use App\Chess\Game;
use App\Contracts\BoardContextContract;
use App\Contracts\GameContextContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            GameContextContract::class,
            Game::class
        );

        $this->app->bind(
            BoardContextContract::class,
            Board::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
