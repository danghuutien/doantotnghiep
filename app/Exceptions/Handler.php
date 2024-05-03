<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Cache cấu hình general
        $config_general = getOption('general');
        \View::share('config_general',$config_general);

        $config_product = getOption('product');
        \View::share('config_product',$config_product);
        // cache menu
        $config_menu = getOption('menu');
        \View::share('config_menu',$config_menu);

        // cache mã chuyển đổi
        $config_code = getOption('code');
        \View::share('config_code',$config_code);

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $data_link_sync = DB::table('sync_links')->where('old', $_SERVER['REQUEST_URI'])->where('status',1)->first();
            if ((!empty($data_link_sync)) && ($data_link_sync->new != '')) {
                $redirect = $data_link_sync->new;
                return redirect($redirect, 301);
            } else {
                return response()->view('Default::errors.404',compact('config_general','config_menu', 'config_code'));
            }
        }
        if($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $data_link_sync = DB::table('sync_links')->where('old', $_SERVER['REQUEST_URI'])->where('status',1)->first();
            if ((!empty($data_link_sync)) && ($data_link_sync->new != '')) {
                $redirect = $data_link_sync->new;
                return redirect($redirect, 301);
            } else {
                return response()->view('Default::errors.404',compact('config_general','config_menu', 'config_code'));
            }
        }
        return parent::render($request, $exception);
    }
}
