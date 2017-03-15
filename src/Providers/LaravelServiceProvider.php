<?php
namespace juniorb2ss\LaravelHelloWorldPackage\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{

    /** Config file name without extension */
    const CONFIG_FILE_NAME_WO_EXT = 'laravel-hello-world-package';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishConfig();
    }

    /**
     * @return \Illuminate\Contracts\Config\Repository
     */
    protected function getConfigRepository()
    {
        /** @var Repository $config */
        $config = $this->app['config'];
        return $config;
    }

    /**
     * Publish config file
     * @return void
     */
    public function registerPublishConfig()
    {
        $publishPath = $this->app['path.config'] . DIRECTORY_SEPARATOR . static::CONFIG_FILE_NAME_WO_EXT . '.php';

        $this->publishes([
            $this->getConfigPath() => $publishPath,
        ]);
    }

    /**
     * @return string
     */
    protected function getConfigPath()
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $path = $root . 'config' . DIRECTORY_SEPARATOR . static::CONFIG_FILE_NAME_WO_EXT . '.php';
        return $path;
    }

    /**
     * Register the service provider.
     * @inheritdoc
     * @return void
     */
    public function register()
    {
    }
}
