<?php 
namespace Digivo\StringBladeCompiler;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;

class StringBladeCompilerServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $config_path = __DIR__ . '/../../../config/string-blade-compiler.php';
        $this->publishes([$config_path => config_path('string-blade-compiler.php')], 'config');

        $views_path = __DIR__ . '/../../../config/.gitkeep';
        $this->publishes([$views_path => storage_path('app/string-blade-compiler/views/.gitkeep')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config_path = __DIR__ . '/../../../config/string-blade-compiler.php';
        $this->mergeConfigFrom($config_path, 'string-blade-compiler');

        $this->app['stringview'] = $this->app->share(function ($app) {
            $cache_path = storage_path('app/string-blade-compiler/views');

            $string_view = new StringView($app['config']);
            $compiler = new StringBladeCompiler($app['files'], $cache_path, $app['config'], $app);
            $string_view->setEngine(new CompilerEngine($compiler));

            return $string_view;
        });
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('StringView', 'Digivo\StringBladeCompiler\Facades\StringView');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
