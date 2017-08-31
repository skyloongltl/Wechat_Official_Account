<?php
namespace command;

class TextCommand extends Command{
    protected $content;
    protected $msgId;

    public function __construct($xml)
    {
        parent::__construct($xml);
        $this->content = $xml->Content;
        $this->msgId = $xml->MsgId;
    }

    public function send(){
        $this->dealWith();
        $sendData = \reply\Reply::textReply($this->fromUserName, $this->toUserName, $this->content);

        echo $sendData;
    }

    public function dealWith()
    {
        //TODO
    }
}