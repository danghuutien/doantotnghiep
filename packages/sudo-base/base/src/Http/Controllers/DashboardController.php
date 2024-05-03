<?php

namespace Sudo\Base\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends AdminController
{
    public function index(Request $requests) {
    	return view('Core::home');
    }
}