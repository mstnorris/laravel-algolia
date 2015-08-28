<?php

namespace App\Providers;

use App\Services\AlgoliaSearch;
use Illuminate\Support\ServiceProvider;
use AlgoliaSearch\Client;
use App\Contracts\Search;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Search::class, function() {
            return new AlgoliaSearch(
                new Client(env('ALGOLIA_APP_ID'), env("ALGOLIA_API_KEY"))
            );
        });
    }
}
