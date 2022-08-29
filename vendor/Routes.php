<?php
namespace Vendor;

class Routes{
    private $routes = [
        "GET"=> [],
        "POST"=> []
    ];
    public function __construct(){
        $this->siteConfig = include('.\configs\Site.php');
    }
    
    public function get(string $url, $action){
        $this->routes["GET"][$url] = $action;
    }

    public function post(string $url, $action){
        $this->routes["POST"][$url] = $action;
    }

    public function process(){
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace($this->siteConfig['mainDomain'], '', $url);
        $url = explode("?", $url)[0];
        if (!key_exists($url, $this->routes[$_SERVER['REQUEST_METHOD']])){
            return "404";
        }
        $action = $this->routes[$_SERVER['REQUEST_METHOD']][$url];
        return call_user_func($action);
    }

    
}