<?php
namespace App\Controller;

use App\Model\User;


class LoginController{
    public static function confirm() {
        $user = new User();
        $messages = include('.\lang\loginMessages.php');
        $result = $user->loginWithLogin($_POST["login"], $_POST["password"], boolval($_POST["type"]));
        return json_encode([$result[0], $messages['errorTexts'][$result[1]]]);
    }
};