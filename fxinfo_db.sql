# Host: 127.0.0.1  (Version 5.5.5-10.1.21-MariaDB)
# Date: 2017-12-09 04:41:10
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "fx_about"
#

DROP TABLE IF EXISTS `fx_about`;
CREATE TABLE `fx_about` (
  `about_id` varchar(11) NOT NULL DEFAULT '',
  `belong_id` varchar(11) NOT NULL DEFAULT '' COMMENT '所属栏目Id',
  `about_content` text,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "fx_about"
#

INSERT INTO `fx_about` VALUES ('5a24524cece','5a244d4c67c','ASDFASDFASD','2017-12-04 03:36:44','2017-12-05 03:02:39'),('5a26c45d27a','5a26c13196a','<h2>\n\t<span style=\"font-size:24px;\">1. 核心战力</span> \n</h2>\n<p>\n\t<span style=\"font-size:24px;\">&nbsp; &nbsp; <span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">as</span></span>\n</p>\n<p>\n\t<span style=\"font-size:24px;\"><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">dfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfa</span></span>\n</p>\n<p>\n\t<span style=\"font-size:24px;\"><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">sdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdf</span></span>\n</p>\n<p>\n\t<span style=\"font-size:24px;\"><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">as</span></span>\n</p>\n<p>\n\t<span style=\"font-size:24px;\"><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">dfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasd</span></span>\n</p>\n<p>\n\t<span style=\"font-size:24px;\"><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">fsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\">asdfasdfasdfsdaf</span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span><span style=\"font-size:16px;line-height:2;font-family:微软雅黑;\"></span></span> \n</p>\n<p>\n\t<span style=\"font-size:24px;\"><strong>2. 实践能力</strong></span> \n</p>','2017-12-06 00:07:57','2017-12-08 17:48:08'),('5a26cc49559','5a26c1299e5','<p style=\"text-align:justify;\">\n\t<strong><span style=\"font-family:SimHei;\"></span></strong><strong><span style=\"font-size:24px;font-family:微软雅黑;color:#FF9900;\">致力于成为中国特色小镇智慧建设产业引领者</span></strong> \n</p>\n<p style=\"text-align:justify;\">\n\t<strong><span style=\"font-size:24px;\"><span style=\"color:#5A5A5A;font-size:16px;line-height:2;font-family:微软雅黑;\">卓宝信息科技（上海）股份有限公司成立于2012年11月，公司为高新技术企业，并致力于成为中国特色小镇智慧建设产业引领者。</span></span></strong>\n</p>\n<p style=\"text-align:left;\">\n\t<strong><span style=\"font-size:24px;\"> <span style=\"color:#5A5A5A;font-size:16px;line-height:2;font-family:微软雅黑;\">公司总部及国内研发基地均设立在上海，并在美国加州、日本横滨设立研发中心。公司整合全球资源，将国外智慧城镇建设成功案例及智能信息化前沿技术融入智慧建设理念，打造中国特色小镇智慧建设。</span><br />\n<span style=\"color:#5A5A5A;font-size:16px;line-height:2;font-family:微软雅黑;\">公司核心人员由国内外从事智慧建设精英、IT行业精英、资深工程师组成。并在智慧建设、软件研发领域拥有丰富工作经验，并取得显著成就。</span><br />\n<span style=\"color:#5A5A5A;font-size:16px;line-height:2;font-family:微软雅黑;\">国际视野、领先理念、技术实力确立了公司在智慧建设领域的领先优势，全力打造最具特色，具有竞争力的智慧化建设解决方案。</span><br />\n</span></strong> \n</p>\n<p style=\"text-align:left;\">\n\t<strong><span style=\"font-size:24px;\"><span style=\"color:#5A5A5A;font-size:16px;line-height:2;\"><img src=\"http://api.map.baidu.com/staticimage?center=121.473704%2C31.230393&zoom=11&width=558&height=360&markers=121.473704%2C31.230393&markerStyles=l%2CA\" alt=\"\" /><br />\n</span></span></strong> \n</p>\n<p style=\"text-align:left;\">\n\t<br />\n</p>','2017-12-06 00:41:45','2017-12-08 15:17:59'),('5a275640e88','5a26c144bf7','<p>\n\t企业文化\n</p>\n<p>\n\t<span>企业文化</span>\n</p>\n<p>\n\t<span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span><span>企业文化</span>\n</p>','2017-12-06 10:30:24','2017-12-06 10:30:24');

#
# Structure for table "fx_admin"
#

DROP TABLE IF EXISTS `fx_admin`;
CREATE TABLE `fx_admin` (
  `admin_id` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员Id',
  `admin_name` varchar(255) NOT NULL DEFAULT '',
  `admin_guest_name` varchar(16) DEFAULT NULL,
  `admin_pass` varchar(255) NOT NULL DEFAULT '',
  `admin_auth` varchar(255) DEFAULT NULL,
  `last_login_time` datetime DEFAULT '0000-00-00 00:00:00',
  `login_error_times` int(1) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员';

#
# Data for table "fx_admin"
#

INSERT INTO `fx_admin` VALUES ('0f9abd5b96e8dd7a0813ec671055a226','fx-admin1204','fx-aaa','b0baee9d279d34fa1dfd71aadb908c3f',NULL,'0000-00-00 00:00:00',0,'2017-12-05 02:55:01');

#
# Structure for table "fx_admin_log"
#

DROP TABLE IF EXISTS `fx_admin_log`;
CREATE TABLE `fx_admin_log` (
  `log_id` varchar(11) NOT NULL DEFAULT '',
  `log_name` varchar(255) NOT NULL DEFAULT '',
  `log_ret_status` int(1) NOT NULL DEFAULT '0' COMMENT '日志结果状态 0：成功 1：失败',
  `log_ip` varchar(32) NOT NULL DEFAULT '',
  `log_brower` varchar(255) DEFAULT NULL,
  `log_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "fx_admin_log"
#

INSERT INTO `fx_admin_log` VALUES ('5a25965e3f6','修改用户名',0,'127.0.0.1','agent','2017-12-05 02:39:26'),('5a259798a26','修改密码',0,'127.0.0.1','Chrome','2017-12-05 02:44:40'),('5a259844296','修改用户名',0,'127.0.0.1','Chrome','2017-12-05 02:47:32'),('5a25987365e','修改用户名',0,'127.0.0.1','Chrome','2017-12-05 02:48:19'),('5a2598a4125','修改用户名',0,'127.0.0.1','Chrome','2017-12-05 02:49:08'),('5a2598b1907','修改用户名',0,'127.0.0.1','Chrome','2017-12-05 02:49:21'),('5a2599ecbe4','修改密码',0,'127.0.0.1','Chrome','2017-12-05 02:54:36'),('5a259a059ec','修改密码',0,'127.0.0.1','Chrome','2017-12-05 02:55:01'),('agent','修改用户名',0,'127.0.0.1','Chrome','2017-12-05 02:39:49');

#
# Structure for table "fx_column"
#

DROP TABLE IF EXISTS `fx_column`;
CREATE TABLE `fx_column` (
  `column_id` varchar(11) NOT NULL DEFAULT '',
  `column_name` varchar(20) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `module_id` varchar(255) NOT NULL DEFAULT '' COMMENT '所属',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`column_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单';

#
# Data for table "fx_column"
#

INSERT INTO `fx_column` VALUES ('5a2046e2d03','社会招聘','5a1fd64ba9b','2017-12-01 01:58:58'),('5a207132664','16年案例','5a1fd667848','2017-12-01 04:59:30'),('5a20814a230','17年案例','5a1fd667848','2017-12-01 06:08:10'),('5a21136b6ae','111','5a1fd6c64fd','2017-12-01 16:31:39'),('5a26bbb4a4b','2017校园招聘','5a1fd64ba9b','2017-12-05 23:31:00'),('5a26c1299e5','企业简介','5a2442d4483','2017-12-05 23:54:17'),('5a26c13196a','企业优势','5a2442d4483','2017-12-05 23:54:25'),('5a26c144bf7','企业文化','5a2442d4483','2017-12-05 23:54:44');

#
# Structure for table "fx_hr"
#

DROP TABLE IF EXISTS `fx_hr`;
CREATE TABLE `fx_hr` (
  `hr_id` varchar(11) NOT NULL DEFAULT '',
  `hr_belong` varchar(11) NOT NULL DEFAULT '',
  `hr_name` varchar(60) NOT NULL DEFAULT '',
  `hr_number` int(11) NOT NULL DEFAULT '0' COMMENT '招聘人数',
  `hr_end` date NOT NULL DEFAULT '0000-00-00' COMMENT '截止日期',
  `hr_desc` text NOT NULL COMMENT '职位描述',
  `hr_need_desc` text NOT NULL COMMENT '岗位要求',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建日期',
  `created_by` varchar(60) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`hr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "fx_hr"
#

INSERT INTO `fx_hr` VALUES ('5a2306b0d2e','','asdfasdf',0,'0000-00-00','asdfasdf','asdfasdfasdf','2017-12-03 04:01:52','aaa','2017-12-03 04:01:52'),('5a230beb96f','','asdfasd',0,'0000-00-00','<br />','asdf','2017-12-03 04:24:11','fx-admin','2017-12-03 04:24:11'),('5a230c14181','','asdfasdf111',0,'2017-12-03','asdf','asdfasdf','2017-12-03 04:24:52','fx-admin','2017-12-03 05:04:36'),('5a230c486d1','','111111111',11,'2017-12-06','asdfasdf','asdfasdf','2017-12-03 04:25:44','fx-admin','2017-12-03 04:25:44'),('5a230c763e1','','222222',2,'2017-12-04','asdf','asdf','2017-12-03 04:26:30','fx-admin','2017-12-03 04:26:30'),('5a230f2410b','','asdf',1,'2017-12-05','asdf','asdfasdf','2017-12-03 04:37:56','fx-admin','2017-12-03 04:37:56'),('5a24236b9ee','','11111111111',0,'0000-00-00','1111111111','1111111111','2017-12-04 00:16:43','fx-admin','2017-12-04 00:16:43'),('5a24245284d','5a1fd64ba9b','11111112222',22,'2017-12-05','1111111111','1111111111','2017-12-04 00:20:34','fx-admin','2017-12-04 00:25:28'),('5a26bd71a03','5a1fd64ba9b','11111111',0,'0000-00-00','111111111','1111111111','2017-12-05 23:38:25','fx-admin','2017-12-05 23:38:25'),('5a26d8cce14','5a2046e2d03','Java开发工程师',0,'2017-12-06','<p>\n\t<ol>\n\t\t<li>\n\t\t\t1111111111111\n\t\t</li>\n\t\t<li>\n\t\t\t222222222\n\t\t</li>\n\t\t<li>\n\t\t\t22222222222222\n\t\t</li>\n\t</ol>\n</p>\n<p>\n\t<br />\n</p>','<ul>\n\t<li>\n\t\t1111111111111\n\t</li>\n\t<li>\n\t\tasdfaa\n\t</li>\n\t<li>\n\t\tsdddddddd\n\t</li>\n\t<li>\n\t\tcccccccc\n\t</li>\n</ul>','2017-12-06 01:35:08','fx-admin','2017-12-06 01:52:15');

#
# Structure for table "fx_module"
#

DROP TABLE IF EXISTS `fx_module`;
CREATE TABLE `fx_module` (
  `module_id` varchar(11) NOT NULL DEFAULT '',
  `module_name` varchar(30) DEFAULT '' COMMENT '模块名',
  `module_type` int(1) NOT NULL DEFAULT '0' COMMENT '0:文章模块 1：案例模块 2：招聘模块 3：简介模块',
  `show_name` varchar(30) NOT NULL DEFAULT '' COMMENT '显示的名称',
  `show_where` int(1) NOT NULL DEFAULT '0' COMMENT '0:都显示 1：不显示 2：页头 3：页尾',
  `icon_img` varchar(60) NOT NULL DEFAULT '',
  `cover_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块表';

#
# Data for table "fx_module"
#

INSERT INTO `fx_module` VALUES ('5a1fd64ba9b','',2,'招贤纳士',0,'resource/images/admin/zhaopin.png','resource/images/banner/3512f87747a6c79f414c92510ef73872.jpg'),('5a1fd667848','',1,'案例展示',0,'resource/images/admin/anli.png','resource/images/banner/3a89ffc720a4bcb3f543413f6dbd0c7e.jpg'),('5a1fd6c64fd','',1,'核心内容',0,'resource/images/admin/anli.png','resource/images/banner/9314579db4469db3abec61d04e3c8f4e.jpg'),('5a2442d4483','',3,'关于我们',0,'resource/images/admin/jieshao.png','resource/images/banner/ee244160df2087ff730b18e59860347f.jpg');

#
# Structure for table "fx_post"
#

DROP TABLE IF EXISTS `fx_post`;
CREATE TABLE `fx_post` (
  `post_id` varchar(11) NOT NULL DEFAULT '' COMMENT '唯一键',
  `post_title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题（85个汉字）',
  `post_content` text NOT NULL COMMENT '文章内容',
  `post_cover_image` varchar(255) DEFAULT NULL COMMENT '封面图片',
  `first_belong` varchar(11) NOT NULL DEFAULT '' COMMENT '一级栏目',
  `second_belong` varchar(11) NOT NULL DEFAULT '' COMMENT '二级栏目',
  `is_top` int(1) NOT NULL DEFAULT '0' COMMENT '是否置顶（0：不置顶 1：置顶）',
  `is_recommend` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐（0：不推荐 1：推荐）',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `created_by` varchar(16) NOT NULL DEFAULT '' COMMENT '创建者',
  `show_publishd_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '显示在页面上的创建时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章案例表格';

#
# Data for table "fx_post"
#

INSERT INTO `fx_post` VALUES ('5a20fcf1d57','asdfasdf','<img src=\"http://127.0.0.1/aaa/resource/editor/plugins/emoticons/images/28.gif\" border=\"0\" alt=\"\" /><img src=\"http://127.0.0.1/aaa/resource/editor/plugins/emoticons/images/28.gif\" border=\"0\" alt=\"\" />','','5a1fd67acdc','5a2076d23f8',1,1,'2017-12-01 14:55:45','asdfasdfasdf','2017-12-01 14:55:45','0000-00-00 00:00:00'),('5a211386978','核心内容','asdfasdfasdfasdf','uploads/2017120817395212850.jpg','5a1fd6c64fd','5a21136b6ae',1,1,'2017-12-01 16:32:06','asdfasdf','2017-12-01 16:32:06','2017-12-08 17:39:55'),('5a211be7554','111','cccccccccccccccccc','uploads/2017120817392228305.jpg','5a1fd6c64fd','5a21136b6ae',1,1,'2017-12-01 17:07:51','11','2017-12-01 17:07:51','2017-12-08 17:39:32'),('5a22c92b62e','asdfasdf','asdasdf','uploads/2017120817382183001.jpg','5a1fd667848','5a207132664',0,1,'2017-12-02 23:39:23','asdfasdf','2017-12-02 23:39:23','2017-12-08 17:38:22'),('5a22d39079b','2222','2222222222','uploads/2017120817290286387.jpg','5a1fd667848','5a207132664',1,1,'2017-12-03 00:23:44','2222222','2017-12-03 00:23:44','2017-12-08 17:29:05'),('5a22d3a4ec4','33333333','33333333333333','uploads/2017120817381564673.jpg','5a1fd667848','5a207132664',0,1,'2017-12-03 00:24:04','3333333333333','2017-12-03 00:24:04','2017-12-08 17:38:17'),('5a22d76a64d','111111','11111111111',NULL,'5a1fd67acdc','5a2076d23f8',0,1,'2017-12-03 00:40:10','111111111','2017-12-03 00:40:10','0000-00-00 00:00:00'),('5a22e4abdc7','55555555555555555555555','<ol>\n\t<li>\n\t\t555555555555555\n\t</li>\n\t<li>\n\t\tasdf\n\t</li>\n\t<li>\n\t\tasdfasdfasd\n\t</li>\n</ol>','uploads/2017120817252656241.jpg','5a1fd667848','5a207132664',1,1,'2017-12-03 01:36:43','55555','2017-12-03 01:36:43','2017-12-08 17:25:30'),('5a22fe3be77','1212','2222','','5a1fd67acdc','5a2076d23f8',0,1,'2017-12-03 03:25:47','2222222','2017-12-03 03:25:47','2017-12-03 03:25:57'),('5a252eabee2','cccccccc','ccccccccc','uploads/2017120817380784566.jpg','5a1fd667848','5a207132664',0,1,'2017-12-04 19:16:59','cccccc','2017-12-04 19:16:59','2017-12-08 17:38:11'),('8c27aea106','罢了，双十二继续剁手吧，骚年','test<br />\ntest','uploads/2017120817383243090.jpg','5a1fd667848','5a207132664',0,1,'2017-11-27 01:35:26','admin','2017-11-27 01:35:26','2017-12-08 17:38:33'),('8c27aea108','罢了，双十二继续剁手吧，骚年','test<br>test',NULL,'01','02',1,1,'2017-11-27 01:35:26','admin','2017-11-27 01:35:26','0000-00-00 00:00:00'),('8c27aea109','今天有重要信息发布2','test<br>test',NULL,'00','01',0,0,'2017-11-27 01:35:26','admin','2017-11-27 01:35:26','0000-00-00 00:00:00'),('8c27aea111','今天有重要信息发布4','asdfasdfasdf',NULL,'02','01',0,0,'2017-11-27 01:35:26','admin','2017-11-27 01:35:26','0000-00-00 00:00:00'),('8c27aea112','今天有重要信息发布3','asdfasdfasdf',NULL,'02','01',1,1,'2017-11-27 01:35:26','admin','2017-11-27 01:35:26','0000-00-00 00:00:00');

#
# Structure for table "fx_website"
#

DROP TABLE IF EXISTS `fx_website`;
CREATE TABLE `fx_website` (
  `website_id` varchar(32) NOT NULL DEFAULT '',
  `website_name` varchar(255) NOT NULL DEFAULT '',
  `website_logo` varchar(255) NOT NULL DEFAULT '',
  `website_ico` varchar(255) NOT NULL DEFAULT '',
  `website_copyright` varchar(255) NOT NULL DEFAULT '',
  `updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`website_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点信息';

#
# Data for table "fx_website"
#

INSERT INTO `fx_website` VALUES ('91abd8042b4f3b864757c3acbf10c09a','凡星信息技术有限公司','resource/images/base/fx-logo.png?0.8437886626808688','resource/images/base/fx-ico.ico?0.7921665874897541','沪ICP备88888888号 © 2006-2017 凡星信息技术有限公司 ALL RIGHTS RESERVED','2017-12-05 17:01:04');
