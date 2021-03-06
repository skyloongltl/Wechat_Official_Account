<?php
namespace command;

class TextCommand extends Command{
    protected $content;
    protected $msgId;

    public function __construct($xml)
    {
        parent::__construct($xml);
        $this->content = (string)$xml->Content;
        $this->msgId = (string)$xml->MsgId;
    }

    public function send(){
        $this->dealWith();
        $sendData = \reply\Reply::textReply($this->fromUserName, $this->toUserName, $this->content);

        echo $sendData;
    }

    //还是用===号，因为有可能记录数会到达4000条以上
    protected function dealWith()
    {
        $oid = \database\User::getOriginalId($this->content);
        if($oid === \errorCode::$SELECTERROR){
            echo 'success';
            exit;
        }
        if($oid === \errorCode::$EMPTYSELECT){
            return;
        }
        $reply = \database\User::getReply($oid);
        if($reply === \errorCode::$SELECTERROR){
            echo 'success';
            exit;
        }
        if($reply === \errorCode::$EMPTYSELECT){
            return;
        }
        $this->content = $reply;
    }
}