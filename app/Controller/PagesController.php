<?php
namespace App\Controller;

use Vendor\View;
use App\Model\User;


class PagesController{
    public static function mainpage(){
        $user = new User();
        $user->checkSession();
        return View::get("main");
    }

    public static function loginpage(){
        $_SESSION = [];
        return View::get("registerlogin");
    }
};