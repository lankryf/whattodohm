<?php
spl_autoload_register(function ($className) {
    require_once($className . ".php");
});
use App\Controller\PagesController;
use App\Controller\NotesController;
use App\Controller\LoginController;
use Vendor\Routes;
session_start();
$routes = new Routes;

#Routes here!
$routes->get("/", [Pagescontroller::class, "mainpage"]);
$routes->get("", [Pagescontroller::class, "mainpage"]);
$routes->get("/login", [Pagescontroller::class, "loginpage"]);
$routes->post("/loginconfirm", [LoginController::class, "confirm"]);

$routes->get("/load", [Notescontroller::class, "load"]);
$routes->post("/update", [NotesController::class, "update"]);
#requtest process
echo $routes->process();