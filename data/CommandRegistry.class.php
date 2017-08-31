<?php
namespace data;

class CommandRegistry extends Registry{
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

    protected  function get($key)
    {
        if(isset($this->value[$key])){
            return $this->value[$key];
        }
        return null;
    }

    protected  function set($key, $val)
    {
        $this->value[$key] = $val;
    }

    public function setMsgId($msgId, $value){
        $this->set($msgId, $value);
    }

    public function getMsgId($msgId){
        if(isset($this->value[$msgId])){
            return $this->value[$msgId];
        }
        return null;
    }

    public function is_exists($msgId) {
        return isset($this->value[$msgId]) ? true : false;
    }

    public function unsetMsgId($msgId){
        unset($this->value[$msgId]);
    }
}