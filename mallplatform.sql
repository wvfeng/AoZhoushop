/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : mallplatform

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-11 14:36:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mall_address
-- ----------------------------
DROP TABLE IF EXISTS `mall_address`;
CREATE TABLE `mall_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` char(20) DEFAULT NULL,
  `siphone` char(20) DEFAULT NULL,
  `saddress` char(70) DEFAULT NULL,
  `sdefault` tinyint(4) DEFAULT '0' COMMENT '1为默认',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_address
-- ----------------------------

-- ----------------------------
-- Table structure for mall_admin
-- ----------------------------
DROP TABLE IF EXISTS `mall_admin`;
CREATE TABLE `mall_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_admin
-- ----------------------------
INSERT INTO `mall_admin` VALUES ('1', 'oto', 'c33367701511b4f6020ec61ded352059', '1', '2018-01-04 14:01:56');
INSERT INTO `mall_admin` VALUES ('13', 'chong', 'e10adc3949ba59abbe56e057f20f883e', '1', '2018-01-04 14:01:52');

-- ----------------------------
-- Table structure for mall_classify
-- ----------------------------
DROP TABLE IF EXISTS `mall_classify`;
CREATE TABLE `mall_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(10) DEFAULT NULL COMMENT '分类名称',
  `img` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL COMMENT '1级2级',
  `uid` tinyint(4) DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_classify
-- ----------------------------
INSERT INTO `mall_classify` VALUES ('15', '66666111', '20180109/5a548ac85e0c5.jpg', '2018-01-09 17:24:35', '2', '15');
INSERT INTO `mall_classify` VALUES ('16', '1', '20180109/5a548b771a2cf.jpg', '2018-01-09 17:29:27', '1', '0');
INSERT INTO `mall_classify` VALUES ('17', '2', '20180109/5a548b7e85b38.jpg', '2018-01-09 17:29:34', '2', '18');
INSERT INTO `mall_classify` VALUES ('18', '2', '20180109/5a548bd334da3.jpg', '2018-01-09 17:30:59', '1', '0');

-- ----------------------------
-- Table structure for mall_coupons
-- ----------------------------
DROP TABLE IF EXISTS `mall_coupons`;
CREATE TABLE `mall_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yname` char(50) DEFAULT NULL,
  `ymoney` decimal(11,2) DEFAULT NULL,
  `ynum` int(11) DEFAULT NULL,
  `ystart_date` date DEFAULT NULL,
  `yend_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='优惠券';

-- ----------------------------
-- Records of mall_coupons
-- ----------------------------
INSERT INTO `mall_coupons` VALUES ('1', '1', '2.00', '3', '2018-01-11', '2018-01-12', '1');
INSERT INTO `mall_coupons` VALUES ('2', '120000', '99.00', '12700', '2018-01-11', '2018-01-31', '0');

-- ----------------------------
-- Table structure for mall_logistics
-- ----------------------------
DROP TABLE IF EXISTS `mall_logistics`;
CREATE TABLE `mall_logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wname` char(50) DEFAULT NULL COMMENT '物流公司名称',
  `wiphone` char(50) NOT NULL COMMENT '物流公司手机',
  `wsort` int(11) DEFAULT NULL COMMENT '排序',
  `wtype` tinyint(4) DEFAULT NULL COMMENT '状态0为禁用1开启',
  `status` tinyint(4) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='物流';

-- ----------------------------
-- Records of mall_logistics
-- ----------------------------
INSERT INTO `mall_logistics` VALUES ('1', '1qqq2121210000', '233321000', '12713666', '1', '1', '2018-01-10 17:25:15');
INSERT INTO `mall_logistics` VALUES ('2', '6', '7', '127', '1', '1', '2018-01-11 09:12:34');
INSERT INTO `mall_logistics` VALUES ('3', '1qqq', '2', '127', '1', '1', '2018-01-11 09:13:15');

-- ----------------------------
-- Table structure for mall_logsince
-- ----------------------------
DROP TABLE IF EXISTS `mall_logsince`;
CREATE TABLE `mall_logsince` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zname` char(50) DEFAULT NULL,
  `zaddress` varchar(255) DEFAULT NULL,
  `zman` char(50) DEFAULT NULL,
  `ziphone` char(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='自提点';

-- ----------------------------
-- Records of mall_logsince
-- ----------------------------
INSERT INTO `mall_logsince` VALUES ('1', '1', '2', '3', '4', '2018-01-11 10:08:06', '1');
INSERT INTO `mall_logsince` VALUES ('2', '11', '21', '41', '71', '2018-01-11 10:23:59', '1');

-- ----------------------------
-- Table structure for mall_order
-- ----------------------------
DROP TABLE IF EXISTS `mall_order`;
CREATE TABLE `mall_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL COMMENT '|*|多个用分开',
  `user_id` int(11) DEFAULT NULL,
  `num` tinyint(4) DEFAULT NULL,
  `name` char(10) DEFAULT NULL COMMENT '收件人',
  `iphone` varchar(20) DEFAULT NULL COMMENT '收件手机号',
  `address` varchar(255) DEFAULT NULL COMMENT '收件地址',
  `date` date DEFAULT NULL,
  `no` char(20) DEFAULT NULL COMMENT '物流编号',
  `log` char(10) DEFAULT NULL COMMENT '物流公司名称',
  `type` tinyint(4) DEFAULT '1' COMMENT '1待发货2已发货3已完成',
  `money` decimal(12,2) DEFAULT '0.00' COMMENT '消费金额',
  `freight` decimal(12,2) DEFAULT NULL COMMENT '运费',
  `nickname` char(20) DEFAULT '0' COMMENT '用户昵称',
  `pick_type` tinyint(4) DEFAULT NULL COMMENT '1物流2上门',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COMMENT='订单表，购买记录';

-- ----------------------------
-- Records of mall_order
-- ----------------------------
INSERT INTO `mall_order` VALUES ('170', null, '188', null, '胡跃娟', '18860917035', '梦巴士', '2017-12-01', null, null, '3', '19800.00', null, '素年锦时', null);
INSERT INTO `mall_order` VALUES ('171', null, '189', null, '焦晨龙', '18913540051', '额额', '2017-12-01', null, null, '3', '1298.00', null, '꧁꫞꯭JMM꫞꧂', null);
INSERT INTO `mall_order` VALUES ('172', null, '196', null, '侍小丽', '15195645837', '梦巴士', '2017-12-01', null, null, '3', '1298.00', null, 'Sunflower ✿', null);
INSERT INTO `mall_order` VALUES ('173', null, '193', null, '彭', '13912622006', '梦巴士', '2017-12-01', null, null, '3', '1298.00', null, '鑫', null);
INSERT INTO `mall_order` VALUES ('174', null, '190', null, '孟德', '18362767671', '梦巴士', '2017-12-01', null, null, '3', '1298.00', null, '孟德烜', null);
INSERT INTO `mall_order` VALUES ('175', null, '187', null, '阿信', '15666625990', '17', '2017-12-01', null, null, '3', '1298.00', null, '阿信', null);
INSERT INTO `mall_order` VALUES ('176', null, '197', null, '徐文强', '17506185710', '万达广场', '2017-12-01', null, null, '3', '1298.00', null, '夜～', null);
INSERT INTO `mall_order` VALUES ('177', null, '210', null, '言立明', '18896972713', '雅安', '2017-12-01', null, null, '3', '1298.00', null, '言立明', null);
INSERT INTO `mall_order` VALUES ('183', null, '195', null, '桑晶晶', '18913188948', '苏州', '2017-12-01', null, null, '3', '1298.00', null, '叒木桑', null);
INSERT INTO `mall_order` VALUES ('179', null, '203', null, '飞鸿', '13914049914', '苏州', '2017-12-01', null, null, '3', '1298.00', null, '飛鴻', null);
INSERT INTO `mall_order` VALUES ('180', null, '198', null, '李小俊', '15270229736', '江苏苏州吴中万达广场', '2017-12-01', null, null, '3', '1298.00', null, '木木还是那个木木', null);
INSERT INTO `mall_order` VALUES ('181', null, '199', null, '甘道燕', '15862330789', '苏州市吴中区万达广场信息产业园6楼602', '2017-12-01', null, null, '3', '1298.00', null, '苏州博思派', null);
INSERT INTO `mall_order` VALUES ('182', null, '207', null, '项晨', '13656247767', '吴中区梦巴士', '2017-12-01', null, null, '3', '1298.00', null, '项晨', null);
INSERT INTO `mall_order` VALUES ('184', null, '194', null, '常笑', '13606136732', '苏州', '2017-12-01', null, null, '3', '1298.00', null, '梦想家  廖旭', null);
INSERT INTO `mall_order` VALUES ('185', null, '212', null, '杨兴彬', '13776065294', '苏州吴中区万达', '2017-12-01', null, null, '3', '1298.00', null, '杨兴斌___达州', null);
INSERT INTO `mall_order` VALUES ('186', null, '209', null, '王敏', '13771982291', '江苏省苏州市吴中区', '2017-12-01', null, null, '3', '1298.00', null, 'a   love 王敏（招学员）', null);
INSERT INTO `mall_order` VALUES ('187', null, '205', null, '陈番巧', '18912635539', '吴中区', '2017-12-01', null, null, '3', '1298.00', null, '巧巧', null);
INSERT INTO `mall_order` VALUES ('188', null, '200', null, '汪敏', '13862111205', '江苏省', '2017-12-01', null, null, '3', '1298.00', null, '汪敏', null);
INSERT INTO `mall_order` VALUES ('189', null, '192', null, '赵文', '13911650911', '苏州', '2017-12-01', null, null, '3', '1298.00', null, '赵文', null);
INSERT INTO `mall_order` VALUES ('190', null, '201', null, '唐俊', '18013567168', '苏州', '2017-12-01', null, null, '3', '19800.00', null, '唐俊 梦巴士智慧社区+智慧教育', null);
INSERT INTO `mall_order` VALUES ('191', null, '213', null, '郑永芳', '15962440964', '你好', '2017-12-01', null, null, '3', '1298.00', null, '台湾 郑先生 健康管理 15962440', null);
INSERT INTO `mall_order` VALUES ('192', null, '207', null, '项晨', '13656247767', '吴中区梦巴士', '2017-12-01', null, null, '3', '19800.00', null, '项晨', null);
INSERT INTO `mall_order` VALUES ('193', null, '211', null, '王晨风', '18662527918', '苏州', '2017-12-01', null, null, '3', '19800.00', null, '༺༼࿅࿆奇美拉姆࿄࿆༽༻', null);
INSERT INTO `mall_order` VALUES ('194', null, '208', null, '王莹', '18761870350', '苏州', '2017-12-01', null, null, '3', '19800.00', null, '浅浅猫', null);
INSERT INTO `mall_order` VALUES ('198', null, '202', null, '赵玉言', '18015591297', '城市', '2017-12-01', null, null, '3', '19800.00', null, '赵玉言', null);
INSERT INTO `mall_order` VALUES ('196', null, '203', null, '飞鸿', '13914049914', '苏州', '2017-12-01', null, null, '3', '19800.00', null, '飛鴻', null);
INSERT INTO `mall_order` VALUES ('197', null, '189', null, '銀魂', '18913540051', '额额', '2017-12-01', null, null, '3', '19800.00', null, '꧁꫞꯭JMM꫞꧂', null);
INSERT INTO `mall_order` VALUES ('199', null, '216', null, '王小二', '13915583959', '苏州', '2017-12-01', null, null, '3', '19800.00', null, '智慧◎祝福', null);
INSERT INTO `mall_order` VALUES ('200', null, '191', null, '王婷', '15851400726', '梦巴士', '2017-12-01', null, null, '3', '1298.00', null, '傲娇的假正经逗比小公举', null);
INSERT INTO `mall_order` VALUES ('205', null, '220', null, '汪伟娜', '18625269900', '苏州', '2017-12-01', null, null, '3', '19800.00', null, 'super娜', null);
INSERT INTO `mall_order` VALUES ('206', null, '185', null, '啦啦', '13576764949', '11', '2017-12-01', null, null, '3', '1298.00', null, '777', null);
INSERT INTO `mall_order` VALUES ('207', null, '185', null, '啦啦', '13576764949', '11', '2017-12-01', null, null, '3', '19800.00', null, '777', null);
INSERT INTO `mall_order` VALUES ('208', null, '185', null, '啦啦', '13576764949', '11', '2017-12-01', null, null, '3', '1298.00', null, '777', null);

-- ----------------------------
-- Table structure for mall_shop
-- ----------------------------
DROP TABLE IF EXISTS `mall_shop`;
CREATE TABLE `mall_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL COMMENT '商品图片',
  `sliedimg` varchar(255) DEFAULT NULL COMMENT '滚动图片|*|',
  `tit` char(30) DEFAULT NULL COMMENT '商品名称',
  `tit_en` char(50) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL COMMENT '规格',
  `origin` varchar(100) DEFAULT NULL COMMENT '产地',
  `storage` varchar(100) DEFAULT NULL COMMENT '储存方法',
  `price` decimal(12,2) DEFAULT NULL COMMENT '价格',
  `rate` decimal(12,4) DEFAULT NULL COMMENT '汇率',
  `detail_en` text,
  `detail` text COMMENT '详情',
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0删除1显示',
  `classify_id` int(11) DEFAULT NULL COMMENT '分类',
  `type` varchar(255) DEFAULT NULL COMMENT '类型|*|号分开,上新，特价，品牌',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_shop
-- ----------------------------
INSERT INTO `mall_shop` VALUES ('19', '20180110/5a559ebdb5fa1.jpg', '20180110/5a559ebfd2923.jpg|*|20180110/5a559ec1f0dfc.jpg|*|', '王企鹅', '21321', '3123', '12313', '131', '21321.00', '3131.0000', '&lt;p&gt;231321&lt;/p&gt;', '&lt;p&gt;32132131&lt;/p&gt;', '2018-01-10 13:04:12', '1', '15', '0');
INSERT INTO `mall_shop` VALUES ('20', '20180110/5a559f0567a1d.jpg', '20180110/5a559f078eb99.jpg|*|20180110/5a559f0980590.jpg|*|', '09099', '8098098', '090', '9090', '909', '909.00', '909.0000', '&lt;p&gt;0909&lt;/p&gt;', '&lt;p&gt;0909&lt;/p&gt;', '2018-01-10 13:05:21', '1', '15', '今日特价|*|会员特权|*|热门品牌|*|');

-- ----------------------------
-- Table structure for mall_user
-- ----------------------------
DROP TABLE IF EXISTS `mall_user`;
CREATE TABLE `mall_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL COMMENT '用户名',
  `iphone` varchar(20) DEFAULT NULL COMMENT '手机号',
  `email` char(50) DEFAULT NULL COMMENT '邮箱',
  `password` char(50) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_user
-- ----------------------------
INSERT INTO `mall_user` VALUES ('1', '212', '12121', '2121', '2121');

-- ----------------------------
-- Table structure for mall_user_detail
-- ----------------------------
DROP TABLE IF EXISTS `mall_user_detail`;
CREATE TABLE `mall_user_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` char(20) DEFAULT NULL COMMENT '昵称',
  `sex` char(2) DEFAULT NULL COMMENT '性别1男2女',
  `city` char(10) DEFAULT NULL COMMENT '城市',
  `country` char(10) DEFAULT NULL COMMENT '国家',
  `province` char(8) DEFAULT NULL COMMENT '省份',
  `headimgurl` varchar(250) DEFAULT '' COMMENT '头像',
  `date` char(30) DEFAULT NULL,
  `surplus_money` decimal(12,2) DEFAULT NULL COMMENT '余额',
  `surplus_int` int(11) DEFAULT '0' COMMENT '剩余积分',
  `qrcode` char(40) DEFAULT NULL COMMENT '二维码',
  `birthday` char(30) DEFAULT NULL COMMENT '生日',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_user_detail
-- ----------------------------
INSERT INTO `mall_user_detail` VALUES ('196', 'Sunflower ✿', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKvBWGibeV3p6kOU9tkweMSibMyuibIawpVhBVahgOW4FvTgbibtZagTKuCAIeGLHztJcZozlZZ7FEibDA/0', '2017-12-01', null, '12980', '20171201/196.png', null, '1');
INSERT INTO `mall_user_detail` VALUES ('197', '夜～', '1', 'Wenzhou', 'CN', 'Zhejiang', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKdwibXS9GcBt3ib32WQbOBjAjXPK8ibhtKichqoChiaj2f9xp6uTCmushNjtMvMXq1HLZsCIPIGEKldqQ/0', '2017-12-01', null, '12980', '20171201/197.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('198', '木木还是那个木木', '1', 'Jiujiang', 'CN', 'Jiangxi', 'http://wx.qlogo.cn/mmopen/vi_32/hQoOP719jaqn1FiaBia2s7QhdEibXEGmcFBicH8iaTjaib2OzCrXl6ibLTPNvkpoHsdoibucIn5Qhur8xeQEfjso4V1ruw/0', '2017-12-01', null, '12980', '20171201/198.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('199', '苏州博思派', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/FgqmFVmK8Uhg6uiaWQSYHPyZh1wWicia3ZvZd7ZTEqFPKrrF0TFDHSTFoIthRfyedzFmgcBGsCO6VSnoEHs8VFZDw/0', '2017-12-01', null, '12980', '20171201/199.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('185', '777', '2', 'Haidian', 'CN', 'Beijing', 'http://wx.qlogo.cn/mmopen/vi_32/XZ05jWBvzsg42FbFqNysLjEU8Hc5R3UCJKGzic2oHKwqZK32NicJhIibk30IXyp3w8GUZ2zwvu1la1jTn7V86CKew/0', '2017-12-01', null, '223960', '20171201/185.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('186', '斑驳·Mppstore', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK4tsu9z0efKLdVzJsFOojwkAttWWsT50nI1n1Xoia0FiaW8hVcNkVvI20ib8iazpgaRDWQjRicudMrwqA/0', '2017-12-01', null, '0', '20171201/186.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('187', '阿信', '1', '', 'NL', 'Rotterda', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ep4Djgibjic8z0mSCWQlDgIia2esOWwMgRq2WSwoFCfnFov6qsWHh7g0eLFgRLaHicETD7HkwdOSv3wgQ/0', '2017-12-01', null, '12980', '20171201/187.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('188', '素年锦时', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIsjYkp2Kl5snBnq2MGdvnN7YuHuI3E27LUZ71L4Y6E3YXkyLex3Adne6S4hOpg6euGNMEw70R9zg/0', '2017-12-01', null, '198000', '20171201/188.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('189', '꧁꫞꯭JMM꫞꧂', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/ZwdAd32mZLDr2dHpqMjfDL0KhKlmM5VCuabSWakyNWw8EIzXsibSqXkrchBUKTZyCenQiaDpicuW4YZlwKsbwA0Lw/0', '2017-12-01', null, '210980', '20171201/189.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('190', '孟德烜', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/2tA1EskBGs6iaI0SFBtkd1mdKzyOHaurkY9q8yKFCsehoGLLnMLXQ1wtehvsx21Ps8bDgqwQaT9grFqzQNJAoyw/0', '2017-12-01', null, '12980', '20171201/190.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('191', '傲娇的假正经逗比小公举', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erj7xwibr86d3FxBGDg8qWicsDkvYdpNktD5w1oNO6WpeqhlIA1giaBlvqia2m0fobB5YtF4b9GTcjP6w/0', '2017-12-01', null, '12980', '20171201/191.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('192', '赵文', '1', 'East', 'CN', 'Beijing', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epxVEGfNCt8icAm1aTia13l5I9GfOCkSrAicsQgvt0iaFCpSZiadghSttwfCpqIw2HVicWLo8eib0vN7W6ZQ/0', '2017-12-01', null, '12980', '20171201/192.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('193', '鑫', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83er9jJoIOnNX6Zh5MibStPKok88u6286cUGJhsWYyMRgpIibZawCJF5dKyzIw3zPQFHrv64ejwzibwhng/0', '2017-12-01', null, '12980', '20171201/193.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('194', '梦想家  廖旭', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIMnghalvQicr958HfeHtDpPqNZZ2Xwat2cFc3LmLeGtichMHrGd7DtRzMvNlYibXAO0d9zGF8qBdpWQ/0', '2017-12-01', null, '12980', '20171201/194.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('195', '叒木桑', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ergzZ59ajiakkaXWWoT1GpxPNXHFeoT5AU6oMo5Uoeyx3IOJeicSfgMJQtGs7uR2myIqEPDTpHeGFMQ/0', '2017-12-01', null, '12980', '20171201/195.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('200', '汪敏', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI1VrPs7GTnFSOWFFcOjPv1DNEo20hONUm3bXbyasHUOWzPwzf3cr98g7NJmBPjMGVs81Y4Xibdbibw/0', '2017-12-01', null, '12980', '20171201/200.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('201', '唐俊 梦巴士智慧社区+智慧教育', '1', '', 'CN', 'Shanghai', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIRzKmOGrozLFjJfroiaxvZNicq1kMJMoicETibvicGae3cB1uNhWCjPfc2BDoUF7PvSOR0MVY7MdSyfnA/0', '2017-12-01', null, '198000', '20171201/201.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('202', '赵玉言', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKUgmsyyyBJHiaZnUMbF1yV8lqbhmCGqCHyBc3fWKodU2TXFexxGUMYibibq0M338pUIqDZkql4lCZ7w/0', '2017-12-01', null, '198000', '20171201/202.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('203', '飛鴻', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJpdoetgNjXAC7GJaO5dqRqzcyNWKJmSy5Nib6UNM2ia9AmcHFPoa2BblInYKXl6EDAfKCx4BXnoAnQ/0', '2017-12-01', null, '210980', '20171201/203.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('222', '王悦君', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLBHnBFuMy5sc0p2gstYPw437LViaLOwXkjpIB1Cv0t6W1HuCPT2pC5SRSgms72x0mPE3q7EP66oiaw/0', '2017-12-01', null, '0', '20171201/222.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('205', '巧巧', '2', '', 'EG', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLyEWO2T2Brg5vxu5VSOJ6WI9BL0RsQPywj1eFHibVVP45LzfDsej5Mfqcf0PX0O89E8tzdKkQgicqQ/0', '2017-12-01', null, '12980', '20171201/205.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('206', '汪伟', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIf68tL1ibvFQxApgI9BLRqKZjuQgmSljbPoZuibyGac4Hy3sicfIiaHrH6vMSQMcBB4RgjnLj8pqTkibA/0', '2017-12-01', null, '0', '20171201/206.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('207', '项晨', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erp5vduKPtu6hbe6qTl3VnqicqKUicXrIsCInC9R4C96puD72uyjz6fVwr7tLI8Un8icIQh94vXvgYDA/0', '2017-12-01', null, '210980', '20171201/207.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('208', '浅浅猫', '2', 'Nanjing', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIcWnCzWXv0esm1qd11Mic10hj4gKoMNTK7pXVFVveUiciaEmt0JuFgAv2VjTHJayia3b6BicmJvVNYq6g/0', '2017-12-01', null, '198000', '20171201/208.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('209', 'a   love 王敏（招学员）', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLNia8YfxCHrMlgzPyp314H6nlmJxMr9Y7YzQOp9arhHAwsiaUqhKRxzuSS7UtfCKmwicMDAticRia0rxA/0', '2017-12-01', null, '12980', '20171201/209.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('210', '言立明', '1', 'Changzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLrhI3tFPRHPmr1HYNf60EDESBoiaCvIuCaZ9RtCCdjia3TwKvKo0Jpcia1G1ibxu1jceQZibBm7cicHLkQ/0', '2017-12-01', null, '25960', '20171201/210.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('211', '༺༼࿅࿆奇美拉姆࿄࿆༽༻', '2', 'Huangpu', 'CN', 'Shanghai', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eolibHibbzicClicXGNQ0qvFyQxibEricRmDkoUNFzJpibuicGbH0IFON2tNEBgBwpoiaxYjTXINwaibSceiaDNQ/0', '2017-12-01', null, '198000', '20171201/211.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('212', '杨兴斌___达州', '1', '', 'TT', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKCdzkWetV6xz9NVTA7jDOOqQbry4X4u39dz3xZNiaVS2xsIaEAmYMgWv1sDDDZ9ziaF0UpjrB6GnDw/0', '2017-12-01', null, '12980', '20171201/212.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('213', '台湾 郑先生 健康管理 15962440', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/6a4gibhkbrqEGib6N8Ga2XBNFQiaAnHdWHpPxcm1nMqjxziaEs10tYIAJfJQORRzd2HnoqkJiah0OmksuMv8YWkcoyA/0', '2017-12-01', null, '12980', '20171201/213.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('214', '忘不了的味道', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLkWoiaXhl4tWugUtm71m09R3GbmgV3KotrVRUFeEUhkWp59rgmKj2GCMLQ2oTcV4ibx4xm6PiaIlzew/0', '2017-12-01', null, '0', '20171201/214.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('215', '芳铃', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/lnfzMT7DeZC9C5kNPBAtJv8hGKNRC6pYzXibo47UzGhU2lGAvhcF9HWBtoyYPB8iaicZx5qmNib2d7r7kpMibGGLD6Q/0', '2017-12-01', null, '0', '20171201/215.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('216', '智慧◎祝福', '1', '', 'IL', '', 'http://wx.qlogo.cn/mmopen/vi_32/Wps7nuvHDicRC6bbLUXicblbPxzKOEuL8Qsr8wH886ERQKz7xPnibOWlTFnwhs20xke8vu1X50ARoqWLhQcicKIE1w/0', '2017-12-01', null, '198000', '20171201/216.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('219', '我和你', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJH3dribPS9Aibq0u1WZjEQalLPAhRbDE5QAts52YjUwwMZyPFtKHwsXNL4IySfoTCeHRUbPDauSPuA/0', '2017-12-01', null, '0', '20171201/219.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('221', '竹海', '1', 'Nanjing', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJmibVfoScf2lPV6S4FHOu7Iv72Wgiau15Jhr2CTBnBHujD0d7jR0U6IyBTPiaoGrbbE7POvibX8XibWWg/0', '2017-12-01', null, '0', '20171201/221.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('220', 'super娜', '2', 'Melbourne', 'AU', 'Victoria', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIxNRv9KERly31jic2JGosAMad5wAaBOGpSbOwibzUkiapsLUticuusQznMSFRkqIuSrwQoWKgIic8nR6g/0', '2017-12-01', null, '198000', '20171201/220.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('223', '苏州伊钻祛斑～签不反弹合约', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoeca6DAKEAlh8Vy10faFw0Niamox5W1WBf6rQiaDGzoqKMlX5wv4zayvxloHRVWtTyHs5E9OktGSEg/0', '2017-12-01', null, '0', '20171201/223.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('224', '马新平', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqKLria7oX5323jYJb839qA4RGLyPYW1UmohDOhu1icGwhn5n9MMfzNLVry12UNCuhJEuSLCibPWdpcA/0', '2017-12-01', null, '0', '20171201/224.png', null, '1');
