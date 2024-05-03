<?php
 
namespace Sudo\Theme\Providers;
 
use Illuminate\Support\ServiceProvider;
use File;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register config file here
     * alias => path
     */
    private $configFile = [
    ];

    /**
     * Register commands file here
     * alias => path
     */
    protected $commands = [
        
    ];

    /**
     * Register middleare file here
     * name => middleware
     */
    protected $middleare = [
        
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

        $this->registerMiddleware();
	}

	private function registerModule() {
		$modulePath = __DIR__.'/../../';
        $moduleName = 'Default';

        // boot route
        if (File::exists($modulePath."routes/admin.php")) {
            $this->loadRoutesFrom($modulePath."/routes/admin.php");
        }
        if (File::exists($modulePath."routes/general.php")) {
            $this->loadRoutesFrom($modulePath."/routes/general.php");
        }
        if ($this->checkAgent() == 'mobile') {
            if (File::exists($modulePath."routes/mobile.php")) {
                $this->loadRoutesFrom($modulePath."/routes/web.php");
            }
        } else {
            if (File::exists($modulePath."routes/web.php")) {
                $this->loadRoutesFrom($modulePath."/routes/web.php");
            }
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
                __DIR__.'/../../resources/assets' => public_path('assets'),
            ];
            $config = [
                __DIR__.'/../../config/SudoAdminer.php' => config_path('SudoAdminer.php'),
                __DIR__.'/../../config/SudoAsset.php' => config_path('SudoAsset.php'),
                __DIR__.'/../../config/SudoMedia.php' => config_path('SudoMedia.php'),
                __DIR__.'/../../config/SudoMenu.php' => config_path('SudoMenu.php'),
                __DIR__.'/../../config/SudoModule.php' => config_path('SudoModule.php'),
                __DIR__.'/../../config/SudoWidget.php' => config_path('SudoWidget.php'),
            ];
            $all = array_merge($assets, $config);
            // Chạy riêng
            $this->publishes($all, 'sudo/theme/default');
            $this->publishes($assets, 'sudo/theme/default/assets');
            $this->publishes($config, 'sudo/theme/default/config');
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

    /**
     * Đăng ký Middleare
     */
    public function registerMiddleware()
    {
        foreach ($this->middleare as $key => $value) {
            $this->app['router']->pushMiddlewareToGroup($key, $value);
        }
    }

    // kiểm tra loại trình duyệt
    function checkAgent() {
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
            $is_mobile = false;
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            $is_mobile = true;
        } else {
            $is_mobile = false;
        }

        if ($is_mobile == true) {
            return 'mobile';
        } else {
            return 'web';
        }
    }

}