<?php
namespace command;

class SubscribeCommand extends Command{

    public function __construct($xml)
    {
        parent::__construct($xml);
    }

    public function send()
    {
        $this->dealWith();
        $sendData = \reply\Reply::textReply($this->fromUserName, $this->toUserName, '感谢关注');

        echo $sendData;
    }

    protected function dealWith()
    {
        // TODO: Implement dealWith() method.
    }
}