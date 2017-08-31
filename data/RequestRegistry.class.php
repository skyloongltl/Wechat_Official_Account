<?php
namespace data;

class RequestRegistry extends Registry{
    private $value = array();
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function set($key, $val)
    {
        $this->value[$key] = $val;
    }

    protected function get($key){
        if(isset($this->value[$key])) {
            return $this->value[$key];
        }
        return null;
    }

    public function getRequest(){
        return self::getInstance()->get('request');
    }

    public function setRequest(\request\Request $request){
        self::getInstance()->set('request', $request);
    }
}