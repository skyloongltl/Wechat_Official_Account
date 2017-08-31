<?php
namespace data;

class RequestHandleRegistry extends Registry {
    private $value;
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

    protected function get($key)
    {
        if(isset($this->value[$key])){
            return $this->value[$key];
        }
        return null;
    }

    public function setRequestHandle(\request\RequestHandle $requestHandle){
        $this->set('requestHandle', $requestHandle);
    }

    public function getRequestHandle(){
        return $this->get('requestHandle');
    }
}