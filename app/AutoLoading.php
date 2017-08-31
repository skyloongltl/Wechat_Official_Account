<?php
namespace app;
class AutoLoading{
    public static function autoload($class_name){
        $file_name = str_replace("\\", DIRECTORY_SEPARATOR, DIR . "\\" . $class_name) . '.class.php';
        if(file_exists($file_name)){
            include $file_name;
        }else{
            echo "{$file_name}类不存在\n";
            exit;
        }
    }
}