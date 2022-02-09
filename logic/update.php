<?php
    spl_autoload_register(function ($className) {
        require_once __DIR__ . "/lib/" . $className . ".php";
    });

    
    $u = new user($_POST["login"], $_POST["password"]);
    
    if($u->search()){
        if ($_POST['action'] == '0'){

            $u->deleteBlock($_POST["value"]);
        } else {
            $u->addBlock($_POST["value"]);
        }
    }
    $u->updateForm();
    
