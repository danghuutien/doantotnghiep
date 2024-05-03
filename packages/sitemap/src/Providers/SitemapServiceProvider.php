<?php

namespace Sudo\Sitemap\Providers;

use Illuminate\Support\ServiceProvider;
use File;
class SitemapServiceProvider extends ServiceProvider
{
    /**
     * Register config file here
     * alias => path
     */
    private $configFile = [
        'SudoSitemap' => 'SudoSitemap.php'
    ];

    /**
     * Register commands file here
     * alias => path
     */
    protected $commands = [

    ];

	/**
     * Register bindings in the container.
     */
    public function register()
    {
        // Đăng ký config cho từng Module
        $this->mergeConfig();
        // boot commands
        $this->commands($this->commands);
    }

	public function boot()
	{
		$this->registerModule();

        $this->publish();
	}

	private function registerModule() {
		$modulePath = __DIR__.'/../../';
        $moduleName = 'Sitemap';

        // boot route
        if (File::exists($modulePath."routes/routes.php")) {
            $this->loadRoutesFrom($modulePath."/routes/routes.php");
        }

        // boot migration
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        // boot views
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", $moduleName);
        }

	    // boot all helpers
        if (File::exists($modulePath . "helpers")) {
            // get all file in Helpers Folder
            $helper_dir = File::allFiles($modulePath . "helpers");
            // foreach to require file
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                require $file;
            }
        }
	}

    /*
    * publish dự án ra ngoài
    * publish config File
    * publish assets File
    */
    public function publish()
    {
        if ($this->app->runningInConsole()) {
            $assets = [
                __DIR__.'/../../resources/assets' => public_path('assets/sitemap'),
            ];
            $config = [
                __DIR__.'/../../config' => config_path(),
            ];
            $all = array_merge($assets, $config);
            // Chạy riêng
            $this->publishes($all, 'sudo/sitemap');
            $this->publishes($assets, 'sudo/sitemap/assets');
            $this->publishes($config, 'sudo/sitemap/config');
        }
    }

    /*
    * Đăng ký config cho từng Module
    * $this->configFile
    */
    public function mergeConfig() {
        foreach ($this->configFile as $alias => $path) {
            $this->mergeConfigFrom(__DIR__ . "/../../config/" . $path, $alias);
        }
    }
}
