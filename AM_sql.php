<?php
//用户账户表
CREATE table `am_user`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`username` varchar(50) NOT NULL DEFAULT '',
	`password` char(32) NOT NULL DEFAULT '',
	`code` varchar(10) NOT NULL DEFAULT '',
	`last_login_ip` varchar(20) NOT NULL DEFAULT '',
	`last_login_time` int(11) NOT NULL DEFAULT 0,
	`email` varchar(30) NOT NULL DEFAULT '',
	`mobile` varchar(10) NOT NULL DEFAULT '',
	`level` varchar(10) NOT NULL DEFAULT 'user',
	`listorder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY username(`username`),
	UNIQUE KEY email(`email`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

//监测机器表
CREATE table `am_machine`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`city_path` varchar(32) NOT NULL DEFAULT '',
	`number` int(10) unsigned NOT NULL,
	`xpoint` varchar(20) NOT NULL,
	`ypoint` varchar(20) NOT NULL,
	`type` varchar(30) NOT NULL DEFAULT '',
	`status` tinyint(1) NOT NULL DEFAULT 1,
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

//监测数据表
CREATE table `am_data`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`pm2.5` int(10) unsigned NOT NULL,
	`mid` int(10) unsigned NOT NULL,
	`time` int(11) unsigned NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT 1,
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	CONSTRAINT `M_ID` FOREIGN KEY (`mid`) REFERENCES `am_machine` (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

//城市地区表
CREATE table `am_city`(
	`id` int(11) unsigned NOT NULL auto_increment,
	`name` varchar(50) NOT NULL DEFAULT '',
	`uname` varchar(50) NOT NULL DEFAULT '',
	`parent_id` int(10) unsigned NOT NULL DEFAULT 0,
	`listorder` int(8) unsigned NOT NULL DEFAULT 0,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`create_time` int(11) unsigned NOT NULL DEFAULT 0,
	`update_time` int(11) unsigned NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	KEY parent_id(`parent_id`),
	UNIQUE KEY uname(`uname`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
