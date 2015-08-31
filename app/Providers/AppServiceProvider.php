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
            $config = config('services.algolia');

            return new AlgoliaSearch(
                new Client($config['app_id'], $config['api_key'])
            );
        });
    }
}
