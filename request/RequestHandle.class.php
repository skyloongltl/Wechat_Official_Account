<?php
namespace request;
use \data\RequestHandleRegistry;
class RequestHandle{
    public function __construct()
    {
        RequestHandleRegistry::getInstance()->setRequestHandle($this);
    }

    public function handle(){
        $post = \data\RequestRegistry::getInstance()->getRequest()->getProperties('post');
        $xml = simplexml_load_string($post);
        $type = $xml->MsgType;
        switch ($type){
            case 'text':
                $is_exists = \data\CommandRegistry::getInstance()->is_exists($xml->MsgId);
                if($is_exists){
                    $textCommand = \data\CommandRegistry::getInstance()->getMsgId($xml->MsgId);
                }else{
                    $textCommand = new \command\TextCommand($xml);
                    \data\CommandRegistry::getInstance()->setMsgId($xml->MsgId, $textCommand);
                }
                $textCommand->send();
                \data\CommandRegistry::getInstance()->unsetMsgId($xml->MsgId);
                break;
            case 'image':
                $is_exists = \data\CommandRegistry::getInstance()->is_exists($xml->MsgId);
                if($is_exists){
                    $imageCommand = \data\CommandRegistry::getInstance()->getMsgId($xml->Msgid);
                }else {
                    $imageCommand = new \command\ImageCommand($xml);
                    \data\CommandRegistry::getInstance()->setMsgId($xml->MsgId, $imageCommand);
                }
                $imageCommand->send();
                \data\CommandRegistry::getInstance()->unsetMsgId($xml->MsgId);
                break;
            case 'event':
                if(isset($xml->EventKey)){
                    break;
                }else{
                    switch ($xml->Event){
                        case 'subscribe':
                            break;
                        case 'unsubscribe':
                            break;
                    }
                }
                break;
            default :
                break;
        }
    }
}