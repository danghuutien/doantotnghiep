<?php

namespace Sudo\CallMeBack\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class CallMeBackServiceProvider extends ServiceProvider
{
    /**
     * Register config file here
     * alias => path
     */
    private $configFile = [
        //
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Đăng ký config cho từng Module
        $this->mergeConfig();
        // boot commands
        // $this->commands($this->commands);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModule();

        $this->publish();
    }

    private function registerModule() {
        $modulePath = __DIR__.'/../../';
        $moduleName = 'CallMeBack';
        
        // boot route
        if (File::exists($modulePath."routes/routes.php")) {
            $this->loadRoutesFrom($modulePath."/routes/routes.php");
        }

        // boot migration
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        // boot languages
        if (File::exists($modulePath . "resources/lang")) {
            $this->loadTranslationsFrom($modulePath . "resources/lang", $moduleName);
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
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
                __DIR__.'/../../resources/assets/web' => public_path('platforms/call_me_back'),
            ];
            $config = [
                //
            ];
            $all = array_merge($assets, $config);
            // Chạy riêng
            $this->publishes($all, 'sudo/call_me_back');
            $this->publishes($assets, 'sudo/call_me_back/assets');
            $this->publishes($config, 'sudo/call_me_back/config');
            // Khởi chạy chung theo core
            $this->publishes($all, 'sudo/core');
            $this->publishes($assets, 'sudo/core/assets');
            $this->publishes($config, 'sudo/core/config');
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
