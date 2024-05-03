<?php

namespace Sudo\Theme\Http\Controllers\Admin;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use DB;
use Form;

class IconController extends AdminController
{
    public function boxicons(){
        return view('Default::admin.icons.boxicons');
    }
    public function design(){
        return view('Default::admin.icons.design');
    }
    public function dripicons(){
        return view('Default::admin.icons.dripicons');
    }
    public function awesome(){
        return view('Default::admin.icons.awesome');
    }
}