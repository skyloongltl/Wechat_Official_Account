<?php
namespace reply;

class Reply{

    public function __construct()
    {

    }

    /*public function __call($methodName, $arguments)
    {
        switch ($methodName){
            case 'text':
                break;
            case 'image':
                break;
            case 'voice':
                break;
            case 'video':
                break;
            case 'music':
                break;
            case 'news':
                break;
            default:
                break;
        }
    }
    */

    public static function textReply($toUserName, $fromUserName, $content){
        $xml = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[fuckfuckfuckfuck%s]]></Content>
</xml>";
        $reply = sprintf($xml, $toUserName, $fromUserName, (string)time(), $content);
        return $reply;
    }

    public static function imageReply($toUserName, $fromUserName, $mediaId){
        $xml = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
</xml>";
        $reply = sprintf($xml, $toUserName, $fromUserName, (string)time(), $mediaId);
        return $reply;
    }

    public static function voiceReply($toUserName, $fromUserName, $mediaId){
        $xml = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>
</xml>";
        $reply = sprintf($xml, $toUserName, $fromUserName, (string)time(), $mediaId);
        return $reply;
    }

    public static function videoReply($toUserName, $fromUserName, $mediaId, $title, $description){
        $xml = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
<Video>
<MediaId><![CDATA[%s]]></MediaId>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
</Video> 
</xml>";
        $reply = sprintf($xml, $toUserName, $fromUserName, (string)time(), $mediaId, $title, $description);
        return $reply;
    }

    public static function musicReply($toUserName, $fromUserName, $title, $description, $musicUrl, $hQMusicUrl, $thumbMediaId){
        $xml = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
<Music>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
</Music>
</xml>";
        $reply = sprintf($xml, $toUserName, $fromUserName, (string)time(), $title, $description, $musicUrl, $hQMusicUrl, $thumbMediaId);
        return $reply;
    }

    public  static function newsReply($toUserName, $fromUserName, $articleCount, $title = array(), $description = array(), $picUrl = array(), $url = array()){
        $xml_head = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>";
        $reply_body = '';
        for ($i = 0; $i < $articleCount; $i++){
            $xml_body = "<item>
<Title><![CDATA[%s]]></Title> 
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>";
            $reply_body .= sprintf($xml_body, $title[$i], $description[$i], $picUrl[$i], $url[$i]);
        }
        $xml_end = "</Articles>
</xml>";
        $replay_head = sprintf($xml_head, $toUserName, $fromUserName, (string)time(), $articleCount);
        $reply = $replay_head.$reply_body.$xml_end;
        return $reply;
    }
}