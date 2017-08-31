<?php
/*define('DIR', dirname(__FILE__));
include DIR . "/app/AutoLoading.php";
spl_autoload_register(array('\app\AutoLoading', 'autoload'));
\app\Controller::run();*/
$xml = file_get_contents("php://input");
var_dump($xml->MsgId);