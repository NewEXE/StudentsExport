<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\CsvProcessor;

class CsvProcessorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        require_once app_path() . '/Helpers/CsvProcessor.php';

        $this->app->bind(CsvProcessor::class, function ($app) {
            return new CsvProcessor();
        });

        $this->app->bind('csv', function () {
            return new CsvProcessor();
        });

    }
}
