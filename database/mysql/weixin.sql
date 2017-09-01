CREATE DATABASE weixin;
CREATE TABLE `original` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '原文id',
  `original` char(200) NOT NULL DEFAULT '' COMMENT '原文',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复的id',
  `oid` int(10) unsigned NOT NULL COMMENT '原文id',
  `reply` char(200) NOT NULL COMMENT '回复',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SELECT FLOOR(RAND() * COUNT(*)) AS `offset` FROM reply where oid=3;
SELECT * FROM `reply` where oid=3 LIMIT 7, 1;