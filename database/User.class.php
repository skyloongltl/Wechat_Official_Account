<?php

namespace database;

class User
{
    public static function insertOriginal($str)
    {
        if(strlen($str) > 200){
            return \errorCode::$STRTOOLONG;
        }
        $pdo = \database\mysql\Database::getInstance()->pdo;
        $stmt = $pdo->prepare('REPLACE INTO original (statement) VALUES (?)');
        $result = $stmt->execute($str);
        if ($result === false) {
            return \errorCode::$INSERTERROR;
        }
        return $pdo->lastInsertId();
    }

    public static function insertReply($o_id, $str){
        if(strlen($str) > 200){
            return \errorCode::$STRTOOLONG;
        }
        $pdo = \database\mysql\Database::getInstance()->pdo;
        $stmt = $pdo->prepare('INSERT INTO reply (oid, reply) VALUES (?, ?)');
        $result = $stmt->execute(array($o_id, $str));
        if($result === false){
            return \errorCode::$INSERTERROR;
        }
        return $pdo->lastInsertId();
    }

    public static function getOriginalId($content){
        $pdo = \database\mysql\Database::getInstance()->pdo;
        $stmt = $pdo->prepare('SELECT id FROM original WHERE original=?');
        $result = $stmt->excute($content);
        if($result === false){
            return \errorCode::$SELECTERROR;
        }
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return empty($result) ? \errorCode::$EMPTYSELECT : $result['id'];

    }

    public static function getReply($strId)
    {
        $pdo = \database\mysql\Database::getInstance()->pdo;
        $stmt = $pdo->prepare('SELECT FLOOR(RAND() * COUNT(*)) AS `offset` FROM reply where oid=?');
        $result = $stmt->execute($strId);
        if($result === false){
            return \errorCode::$SELECTERROR;
        }
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $offset = $result['offset'];
        $stmt = $pdo->prepare('SELECT reply FROM `reply` where oid=? LIMIT ?, 1;');
        $result = $stmt->excute(array($strId, $offset));
        if($result === false){
            return \errorCode::$SELECTERROR;
        }
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return empty($result) ? \errorCode::$EMPTYSELECT :$result['reply'];
    }
}