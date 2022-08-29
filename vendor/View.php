<?php
namespace Vendor;

class View{
    public static function get(string $name){
        return file_get_contents("./resources/view/$name.php");
    }
};