<?php
function study($xml){
    $redis = \database\predis::getInstance();
    $content = input((string)$xml->Content);

    if($content == '大哥下课啦'){
        $redis->set('is_study', 'false');
        $redis->set('action', 'close');
        echo 'success';
        exit;
    }

    if($redis->get('is_study') == 'true'){
        if($redis->get('action') == 'original') {
            echo 'success';
            $o_id = \database\User::insertOriginal($content);
            if($o_id == \errorCode::$INSERTERROR){
                return \errorCode::$INSERTERROR;
            }
            $redis->set('oid', $o_id);
            $redis->set('action', 'reply');
            exit;
        }
        if($redis->get('action') == 'reply') {
            echo 'success';
            $o_id = $redis->get('oid');
            $ret = \database\User::insertReply($o_id, $content);
            if($ret == \errorCode::$INSERTERROR){
                return \errorCode::$INSERTERROR;
            }
            $redis->set('action', 'original');
            exit;
        }
    }

    if($content == '大哥来学习了'){
        $redis->set('is_study', 'true');
        $redis->set('action', 'original');
        echo 'success';
        exit;
    }
}

function input($str){
    $str = htmlspecialchars(strip_tags(trim($str)));
    $str = nl2br($str);

    return $str;
}