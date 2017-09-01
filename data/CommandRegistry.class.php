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

    //sprintf将$xml->MsgId从对象转化为字符串,因为数组的索引不能是对象
    public function setMsgId($msgId, $value){
        $id = sprintf('%s', $msgId);
        $this->set($id, $value);
    }

    public function getMsgId($msgId){
        $msgId = sprintf('%s', $msgId);
        if(isset($this->value[$msgId])){
            return $this->value[$msgId];
        }
        return null;
    }

    public function is_exists($msgId) {
        $msgId = sprintf('%s', $msgId);
        return isset($this->value[$msgId]);
    }

    public function unsetMsgId($msgId){
        $msgId = sprintf('%s', $msgId);
        unset($this->value[$msgId]);
    }
}