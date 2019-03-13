<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    // all controller sẽ chạy __construct() này vì chúng kế thừa class Controller
    function __construct () {
        $this->DangNhap();
    }

    public function DangNhap () {
        if (Auth::check()) {
            view()->share('Login', Auth::user());
        }
    }
}
