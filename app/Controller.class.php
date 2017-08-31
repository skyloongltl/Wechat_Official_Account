<?php
namespace app;

class Controller{
    public static function run(){
        $request = new \request\Request();
        $handle = new \request\RequestHandle();
        $handle->handle();
    }
}