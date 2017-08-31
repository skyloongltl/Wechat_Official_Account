<?php
define('DIR', dirname(__FILE__));
include DIR . "/app/AutoLoading.php";
spl_autoload_register(array('\app\AutoLoading', 'autoload'));
\app\Controller::run();