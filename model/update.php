<?php
    spl_autoload_register(function ($className) {
        require_once __DIR__ . "/lib/" . $className . ".php";
    });
    session_start();

    $u = new user();

  
    $u->loadForm();
    
    if ($_POST['action'] == '0'){

        $u->deleteBlock($_POST["value"]);
    } else {
        $u->addBlock($_POST["value"]);
    }

    $u->updateForm();
    
