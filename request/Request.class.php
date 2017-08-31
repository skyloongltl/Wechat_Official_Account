<?php
namespace request;

use \data\RequestRegistry;

class Request{
    private $properties = array();

    public function __construct(){
        $this->init();
        RequestRegistry::getInstance()->setRequest($this);
    }

    public function __clone()
    {
        $this->properties = array();
    }

    public function init(){
        if(isset($_SERVER['REQUEST_METHOD'])){
            if(!empty($_GET)){
                $this->setProperties('get', $_GET);
            }
            $this->setProperties('post', file_get_contents("php://input"));
            return;
        }
    }

    public function setProperties($key, $val){
        $this->properties[$key] = $val;
    }

    public function getProperties($key){
        if(isset($this->properties[$key])){
            return $this->properties[$key];
        }
        return null;
    }
}