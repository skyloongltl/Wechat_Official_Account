<?php
namespace command;

class ImageCommand extends Command{
    private $picUrl;
    private $mediaId;
    private $msgId;

    public function __construct($xml)
    {
        parent::__construct($xml);
        $this->picUrl = $xml->PicUrl;
        $this->mediaId = $xml->Mediald;
        $this->msgId = $xml->MsgId;
    }

    public function send(){
        $this->dealWith();
        $sendData = \reply\Reply::imageReply($this->fromUserName, $this->toUserName, $this->mediaId);
        echo $sendData;
    }

    protected function dealWith(){
        //TODO
    }
}