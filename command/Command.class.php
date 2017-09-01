<?php
namespace command;

abstract class Command{
    protected $toUserName;
    protected $fromUserName;
    protected $createTime;
    protected $msgType;

    public function __construct($xml)
    {
        $this->toUserName = $xml->ToUserName;
        $this->fromUserName = $xml->FromUserName;
        $this->createTime = $xml->CreateTime;
        $this->msgType = $xml->MsgType;
    }

    public abstract function send();
    protected abstract function dealWith();
}