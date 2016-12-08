<?php
/**
 * Created by PhpStorm.
 * User: hzy
 * Date: 16-12-5
 * Time: 下午9:29
 */

include("MySQL.config.php");
$SQL="
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `writer` text NOT NULL,
  `type` int(11) NOT NULL,
  `reply_to` int(11) NOT NULL,
  `sub_articles` text NOT NULL,
  `like` text NOT NULL,
  `value` text NOT NULL,
  `title` text NOT NULL,
  `desp` text NOT NULL,
  `pic` VARCHAR(40) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
/*
INSERT INTO `blog_user` (`id`,`mean_id`,`name`,`motto`, `sha1_password`, `reg_time`, `permission`) VALUES
(NULL,11,'Faraway','壁立千仞，无欲则刚',SHA1('hzylovelyl'), '2016-12-05 16:17:29', 0);
CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mean_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `motto` TEXT NOT NULL,
  `sha1_password` varchar(40) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
INSERT INTO `blog_user` (`id`, `name`, `sha1_password`, `reg_time`, `permission`) VALUES
(NULL,1,'Faraway',SHA1('hzylovelyl'), '2016-12-05 16:17:29', 0);*/
";
if($mysql->query($SQL)){
    echo("数据库创建成功！");
}else{
    echo("数据库创建失败！Error:".$mysql->error);
}



