<?php
 
namespace Sudo\Media\Providers;
 
use Illuminate\Support\ServiceProvider;
use File;
class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register config file here (Chỉ áp dụng cho configs không sắp sếp theo thứ tự và không phải ghi đè lên file mặc định)
     * alias => path
     */
    private $configFile = [
        'SudoMedia' => 'media.php',
    ];

	/**
     * Register bindings in the container.
     */
    public function register()
    {
        // Đăng ký config cho từng Module
        $this->mergeConfig();
    }

	public function boot()
	{
		$this->registerModule();

        $this->publishMedia();
	}

	private function registerModule() {
		$modulePath = __DIR__.'/../../';
        $moduleName = 'media';

        // boot route
        if (File::exists($modulePath."routes/routes.php")) {
            $this->loadRoutesFrom($modulePath."/routes/routes.php");
        }

        // boot migration
        if (File::exists($modulePath . "database/migrations")) {
            $this->loadMigrationsFrom($modulePath . "database/migrations");
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
    public function publishMedia()
    {
        if ($this->app->runningInConsole()) {
            $assets = [
                __DIR__.'/../../resources/assets' => public_path('platforms/media'),
            ];
            $config = [
                __DIR__.'/../../config/media.php' => config_path('SudoMedia.php'),
            ];
            $all = array_merge($assets, $config);
            // Chạy riêng
            $this->publishes($all, 'sudo/media');
            $this->publishes($assets, 'sudo/media/assets');
            $this->publishes($config, 'sudo/media/config');
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