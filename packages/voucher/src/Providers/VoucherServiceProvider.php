<?php
 
namespace Sudo\Voucher\Providers;
 
use Illuminate\Support\ServiceProvider;
use File;
class VoucherServiceProvider extends ServiceProvider
{
    /**
     * Register config file here
     * alias => path
     */
    private $configFile = [
        'SudoVoucher' => 'SudoVoucher.php'
    ];

    /**
     * Register commands file here
     * alias => path
     */
    protected $commands = [
//        'Sudo\Voucher\Commands\VoucherSeedCommand'
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
        $moduleName = 'Voucher';

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
                //
            ];
            $config = [
                //
            ];
            $all = array_merge($assets, $config);
            // Chạy riêng
            $this->publishes($all, 'sudo/voucher');
            $this->publishes($assets, 'sudo/voucher/assets');
            $this->publishes($config, 'sudo/voucher/config');
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