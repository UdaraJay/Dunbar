<?php

namespace UdaraJay\Dunbar;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\JsonResponse;
use UdaraJay\Dunbar\Http\Exceptions\ProxyException;
use UdaraJay\Dunbar\Http\Proxy;

class DunbarServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/dunbar.php' => config_path('dunbar.php'),
        ]);
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dunbar');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register() {
        //$this->registerErrorHandlers();
        $this->mergeConfigFrom(__DIR__.'/../config/dunbar.php', 'dunbar');
        $this->registerApiProxy();
    }

    /**
     * Register ApiProxy with the IoC container
     * @return void
     */
    public function registerApiProxy() {
        $this->app->singleton('dunbar.proxy', function($app) {
            $params = $app['config']['dunbar'];
            $proxy = new Proxy($params);
            return $proxy;
        });

        $this->app->bind('UdaraJay\Dunbar\Proxy', function($app) {
            return $app['dunbar.proxy'];
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides() {
        return array('dunbar.proxy');
    }

    /**
     * Register the ApiProxy error handlers
     * @return void
     */
    private function registerErrorHandlers() {
        $this->app->error(function(ProxyException $ex) {
            if (\Request::ajax() && \Request::wantsJson()) {
                return new JsonResponse([
                    'error' => $ex->errorType,
                    'error_description' => $ex->getMessage()
                ], $ex->httpStatusCode, $ex->getHttpHeaders()
                );
            }

            return \View::make('api-proxy-laravel::proxy_error', array(
                'header' => $ex->getHttpHeaders()[0],
                'code' => $ex->httpStatusCode,
                'error' => $ex->errorType,
                'message' => $ex->getMessage()
            ));
        });
    }

}
