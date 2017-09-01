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
        $type = (string)$xml->MsgType;
        $eventKey = (string)$xml->EventKey;
        $event = (string)$xml->Event;
        switch ($type){
            case 'text':
                $textCommand = $this->idIsExists('Text', $xml);
                call_user_func_array('study', array($xml));
                $textCommand->send();
                \data\CommandRegistry::getInstance()->unsetMsgId($xml->MsgId);
                break;
            case 'image':
                $imageCommand = $this->idIsExists('Image', $xml);
                $imageCommand->send();
                \data\CommandRegistry::getInstance()->unsetMsgId($xml->MsgId);
                break;
            case 'event':
                if(isset($eventKey)){
                    echo '';
                    break;
                }else{
                    switch ($event){
                        case 'subscribe':
                            $subscribeCommand = $this->eventIsExists('subscribe', $xml);
                            $subscribeCommand->send();
                            \data\CommandRegistry::getInstance()->unsetMsgId((string)$xml->FromUserName . (string)$xml->CreateTime);
                            break;
                        case 'unsubscribe':
                            echo '';
                            break;
                    }
                }
                break;
            default :
                echo '';
                break;
        }
    }

    private function eventIsExists($type = '', $xml){
        $type = ucfirst($type);
        $is_exists = \data\CommandRegistry::getInstance()->is_exists((string)$xml->FromUserName.(string)$xml->CreateTime);
        if($is_exists){
            $command = \data\CommandRegistry::getInstance()->getMsgId((string)$xml->FromUserName.(string)$xml->CreateTime);
        }else{
            $className = "\\command\\" . $type . "Command";
            $command = new $className($xml);
            \data\CommandRegistry::getInstance()->setMsgId((string)$xml->FromUserName . (string)$xml->CreateTime, $command);
        }
        return $command;
    }

    private function idIsExists($type = '', $xml){
        $type = ucfirst($type);
        $is_exists = \data\CommandRegistry::getInstance()->is_exists($xml->MsgId);
        if($is_exists){
            $command = \data\CommandRegistry::getInstance()->getMsgId($xml->MsgId);
        }else{
            $className = "\\command\\" . $type . "Command";
            $command = new $className($xml);
            \data\CommandRegistry::getInstance()->setMsgId($xml->MsgId, $command);
        }
        return $command;
    }
}