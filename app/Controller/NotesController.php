<?php
namespace App\Controller;

use App\Model\User;

class NotesController{
    public static function load() {
        
        $user = new User();
        $user->checkSession();      
        $user->loadForm();

        return json_encode($user->form); 
    }


    public static function update() {
    
        $user = new User();
        $user->checkSession();
        $user->loadForm();

        if ($_POST['action'] == '0'){
            $user->deleteBlock($_POST["value"]);
        } else {
            $user->addBlock($_POST["value"]);
        }
        $user->updateForm();
    }
};