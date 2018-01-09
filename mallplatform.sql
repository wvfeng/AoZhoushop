/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : mallplatform

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-04 16:25:07
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_classify
-- ----------------------------
INSERT INTO `mall_classify` VALUES ('2', '999', '2018-01-04 14:25:27');
INSERT INTO `mall_classify` VALUES ('3', '8888', '2018-01-04 14:25:31');

-- ----------------------------
-- Table structure for mall_order
-- ----------------------------
DROP TABLE IF EXISTS `mall_order`;
CREATE TABLE `mall_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` char(10) DEFAULT NULL COMMENT '收件人',
  `iphone` varchar(20) DEFAULT NULL COMMENT '收件手机号',
  `address` varchar(255) DEFAULT NULL COMMENT '收件地址',
  `date` date DEFAULT NULL,
  `no` char(20) DEFAULT NULL COMMENT '物流编号',
  `log` char(10) DEFAULT NULL COMMENT '物流公司名称',
  `type` tinyint(4) DEFAULT '1' COMMENT '1待发货2已发货3已完成',
  `classify` tinyint(4) DEFAULT '0' COMMENT '分类',
  `money` decimal(12,2) DEFAULT '0.00' COMMENT '消费金额',
  `nickname` char(20) DEFAULT '0' COMMENT '用户昵称',
  `fahuo_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COMMENT='订单表，购买记录';

-- ----------------------------
-- Records of mall_order
-- ----------------------------
INSERT INTO `mall_order` VALUES ('170', null, '188', '胡跃娟', '18860917035', '梦巴士', '2017-12-01', null, null, '3', '3', '19800.00', '素年锦时', '2017-12-01');
INSERT INTO `mall_order` VALUES ('171', null, '189', '焦晨龙', '18913540051', '额额', '2017-12-01', null, null, '3', '2', '1298.00', '꧁꫞꯭JMM꫞꧂', '2017-12-01');
INSERT INTO `mall_order` VALUES ('172', null, '196', '侍小丽', '15195645837', '梦巴士', '2017-12-01', null, null, '3', '2', '1298.00', 'Sunflower ✿', '2017-12-01');
INSERT INTO `mall_order` VALUES ('173', null, '193', '彭', '13912622006', '梦巴士', '2017-12-01', null, null, '3', '2', '1298.00', '鑫', '2017-12-01');
INSERT INTO `mall_order` VALUES ('174', null, '190', '孟德', '18362767671', '梦巴士', '2017-12-01', null, null, '3', '2', '1298.00', '孟德烜', '2017-12-01');
INSERT INTO `mall_order` VALUES ('175', null, '187', '阿信', '15666625990', '17', '2017-12-01', null, null, '3', '2', '1298.00', '阿信', '2017-12-01');
INSERT INTO `mall_order` VALUES ('176', null, '197', '徐文强', '17506185710', '万达广场', '2017-12-01', null, null, '3', '2', '1298.00', '夜～', '2017-12-01');
INSERT INTO `mall_order` VALUES ('177', null, '210', '言立明', '18896972713', '雅安', '2017-12-01', null, null, '3', '2', '1298.00', '言立明', '2017-12-01');
INSERT INTO `mall_order` VALUES ('183', null, '195', '桑晶晶', '18913188948', '苏州', '2017-12-01', null, null, '3', '2', '1298.00', '叒木桑', '2017-12-01');
INSERT INTO `mall_order` VALUES ('179', null, '203', '飞鸿', '13914049914', '苏州', '2017-12-01', null, null, '3', '2', '1298.00', '飛鴻', '2017-12-01');
INSERT INTO `mall_order` VALUES ('180', null, '198', '李小俊', '15270229736', '江苏苏州吴中万达广场', '2017-12-01', null, null, '3', '2', '1298.00', '木木还是那个木木', '2017-12-01');
INSERT INTO `mall_order` VALUES ('181', null, '199', '甘道燕', '15862330789', '苏州市吴中区万达广场信息产业园6楼602', '2017-12-01', null, null, '3', '2', '1298.00', '苏州博思派', '2017-12-01');
INSERT INTO `mall_order` VALUES ('182', null, '207', '项晨', '13656247767', '吴中区梦巴士', '2017-12-01', null, null, '3', '2', '1298.00', '项晨', '2017-12-01');
INSERT INTO `mall_order` VALUES ('184', null, '194', '常笑', '13606136732', '苏州', '2017-12-01', null, null, '3', '2', '1298.00', '梦想家  廖旭', '2017-12-01');
INSERT INTO `mall_order` VALUES ('185', null, '212', '杨兴彬', '13776065294', '苏州吴中区万达', '2017-12-01', null, null, '3', '2', '1298.00', '杨兴斌___达州', '2017-12-01');
INSERT INTO `mall_order` VALUES ('186', null, '209', '王敏', '13771982291', '江苏省苏州市吴中区', '2017-12-01', null, null, '3', '2', '1298.00', 'a   love 王敏（招学员）', '2017-12-01');
INSERT INTO `mall_order` VALUES ('187', null, '205', '陈番巧', '18912635539', '吴中区', '2017-12-01', null, null, '3', '2', '1298.00', '巧巧', '2017-12-01');
INSERT INTO `mall_order` VALUES ('188', null, '200', '汪敏', '13862111205', '江苏省', '2017-12-01', null, null, '3', '2', '1298.00', '汪敏', '2017-12-01');
INSERT INTO `mall_order` VALUES ('189', null, '192', '赵文', '13911650911', '苏州', '2017-12-01', null, null, '3', '2', '1298.00', '赵文', '2017-12-01');
INSERT INTO `mall_order` VALUES ('190', null, '201', '唐俊', '18013567168', '苏州', '2017-12-01', null, null, '3', '3', '19800.00', '唐俊 梦巴士智慧社区+智慧教育', '2017-12-01');
INSERT INTO `mall_order` VALUES ('191', null, '213', '郑永芳', '15962440964', '你好', '2017-12-01', null, null, '3', '2', '1298.00', '台湾 郑先生 健康管理 15962440', '2017-12-01');
INSERT INTO `mall_order` VALUES ('192', null, '207', '项晨', '13656247767', '吴中区梦巴士', '2017-12-01', null, null, '3', '3', '19800.00', '项晨', '2017-12-01');
INSERT INTO `mall_order` VALUES ('193', null, '211', '王晨风', '18662527918', '苏州', '2017-12-01', null, null, '3', '3', '19800.00', '༺༼࿅࿆奇美拉姆࿄࿆༽༻', '2017-12-01');
INSERT INTO `mall_order` VALUES ('194', null, '208', '王莹', '18761870350', '苏州', '2017-12-01', null, null, '3', '3', '19800.00', '浅浅猫', '2017-12-01');
INSERT INTO `mall_order` VALUES ('198', null, '202', '赵玉言', '18015591297', '城市', '2017-12-01', null, null, '3', '3', '19800.00', '赵玉言', '2017-12-01');
INSERT INTO `mall_order` VALUES ('196', null, '203', '飞鸿', '13914049914', '苏州', '2017-12-01', null, null, '3', '3', '19800.00', '飛鴻', '2017-12-01');
INSERT INTO `mall_order` VALUES ('197', null, '189', '銀魂', '18913540051', '额额', '2017-12-01', null, null, '3', '3', '19800.00', '꧁꫞꯭JMM꫞꧂', '2017-12-01');
INSERT INTO `mall_order` VALUES ('199', null, '216', '王小二', '13915583959', '苏州', '2017-12-01', null, null, '3', '3', '19800.00', '智慧◎祝福', '2017-12-01');
INSERT INTO `mall_order` VALUES ('200', null, '191', '王婷', '15851400726', '梦巴士', '2017-12-01', null, null, '3', '2', '1298.00', '傲娇的假正经逗比小公举', '2017-12-01');
INSERT INTO `mall_order` VALUES ('205', null, '220', '汪伟娜', '18625269900', '苏州', '2017-12-01', null, null, '3', '3', '19800.00', 'super娜', '2017-12-01');
INSERT INTO `mall_order` VALUES ('206', null, '185', '啦啦', '13576764949', '11', '2017-12-01', null, null, '3', '2', '1298.00', '777', '2017-12-01');
INSERT INTO `mall_order` VALUES ('207', null, '185', '啦啦', '13576764949', '11', '2017-12-01', null, null, '3', '3', '19800.00', '777', '2017-12-01');
INSERT INTO `mall_order` VALUES ('208', null, '185', '啦啦', '13576764949', '11', '2017-12-01', null, null, '3', '2', '1298.00', '777', '2017-12-01');

-- ----------------------------
-- Table structure for mall_shop
-- ----------------------------
DROP TABLE IF EXISTS `mall_shop`;
CREATE TABLE `mall_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` char(50) DEFAULT NULL COMMENT '商品图',
  `tit` char(30) DEFAULT NULL COMMENT '商品名称',
  `introduce` varchar(100) DEFAULT NULL COMMENT '介绍',
  `integral` mediumint(11) DEFAULT NULL COMMENT '积分',
  `price` decimal(12,2) DEFAULT NULL COMMENT '价格',
  `detail` text COMMENT '详情',
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0删除1显示',
  `sliedimg` varchar(255) DEFAULT NULL COMMENT '滚动图片|*|',
  `classify_id` int(11) DEFAULT NULL COMMENT '分类',
  `type` tinyint(4) DEFAULT NULL COMMENT '类型*号分开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_shop
-- ----------------------------
INSERT INTO `mall_shop` VALUES ('13', '20171129/5a1e81753c775.png', '抽纸盒', '欧式高档纸巾盒 创意餐厅客厅专用', '100', '1.00', '&lt;p&gt;&lt;img src=&quot;/Uploads/ueditor/20171129/1511948717730944.png&quot; title=&quot;1511948717730944.png&quot; alt=&quot;x_2@2x.png&quot;/&gt;&lt;/p&gt;', '2017-11-29 17:45:24', '1', '20171129/5a1e81780e85d.png|*|', null, null);
INSERT INTO `mall_shop` VALUES ('14', '20171129/5a1e81cb5d10e.png', '纯棉毛巾', '成人加厚柔软吸水 素色 男女通用洗脸面巾', '200', '1.00', '&lt;p&gt;&lt;img src=&quot;/Uploads/ueditor/20171129/1511948800752667.png&quot; title=&quot;1511948800752667.png&quot; alt=&quot;x_4@2x.png&quot;/&gt;&lt;/p&gt;', '2017-11-29 17:46:48', '1', '20171129/5a1e81d6506a1.png|*|', null, null);
INSERT INTO `mall_shop` VALUES ('15', '20171129/5a1e822e6928d.png', '防水棉麻桌布', '防水棉麻桌布布艺长方形格子田园小清新茶几台布', '200', '1.00', '&lt;p&gt;&lt;img src=&quot;/Uploads/ueditor/20171129/1511948856523999.png&quot; title=&quot;1511948856523999.png&quot; alt=&quot;x_6@2x.png&quot;/&gt;&lt;/p&gt;', '2017-11-29 17:49:34', '1', '20171129/5a1e823156b41.png|*|20171129/5a1e8233db11d.png|*|', null, null);
INSERT INTO `mall_shop` VALUES ('16', '20171129/5a1e82ed70355.png', '储米桶', '防虫储米桶 带盖塑料 20kg装', '1500', '1.00', '&lt;p&gt;&lt;img src=&quot;/Uploads/ueditor/20171129/1511949086626477.png&quot; title=&quot;1511949086626477.png&quot; alt=&quot;x_2@2x.png&quot;/&gt;&lt;/p&gt;', '2017-11-29 17:51:34', '0', '20171129/5a1e82f031f2a.png|*|', null, null);
INSERT INTO `mall_shop` VALUES ('17', '20171129/5a1e832e3a230.png', '小仓鼠毛绒玩具', '毛绒玩具 小仓鼠可爱布偶娃娃公仔 大号睡觉抱枕', '5000', '1.00', '&lt;p&gt;&lt;img src=&quot;/Uploads/ueditor/20171129/1511949157312198.png&quot; title=&quot;1511949157312198.png&quot; alt=&quot;x_4@2x.png&quot;/&gt;&lt;/p&gt;', '2017-11-29 17:52:47', '1', '20171129/5a1e833110494.png|*|', null, null);
INSERT INTO `mall_shop` VALUES ('18', '20171129/5a1e8376de308.png', '洗漱套装', '居家卫生间用品 家用小东西 生活日用品', '200000', '1.00', '&lt;p&gt;&lt;img src=&quot;/Uploads/ueditor/20171129/1511950142611349.png&quot; title=&quot;1511950142611349.png&quot; alt=&quot;x_4@2x.png&quot;/&gt;&lt;/p&gt;', '2017-11-29 18:09:39', '1', '20171129/5a1e837970ff2.png|*|', null, null);

-- ----------------------------
-- Table structure for mall_user
-- ----------------------------
DROP TABLE IF EXISTS `mall_user`;
CREATE TABLE `mall_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` char(20) DEFAULT NULL COMMENT '昵称',
  `sex` char(2) DEFAULT NULL COMMENT '性别1男2女',
  `city` char(10) DEFAULT NULL COMMENT '城市',
  `country` char(10) DEFAULT NULL COMMENT '国家',
  `province` char(8) DEFAULT NULL COMMENT '省份',
  `headimgurl` varchar(250) DEFAULT '' COMMENT '头像',
  `grade_id` int(11) DEFAULT '0',
  `date` char(30) DEFAULT NULL,
  `name` char(8) DEFAULT NULL COMMENT '收件人',
  `iphone` char(20) DEFAULT NULL COMMENT '收件手机号',
  `address` char(30) DEFAULT NULL COMMENT '收件地址',
  `clip_type` tinyint(4) DEFAULT '0' COMMENT '购卡类型1或2或3,3是一和二的和',
  `surplus_money` decimal(12,2) unsigned DEFAULT '0.00' COMMENT '账户余额',
  `surplus_int` int(11) DEFAULT '0' COMMENT '剩余积分',
  `openid` char(40) DEFAULT '0',
  `qrcode` char(40) DEFAULT NULL COMMENT '二维码',
  `ind` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_user
-- ----------------------------
INSERT INTO `mall_user` VALUES ('196', 'Sunflower ✿', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKvBWGibeV3p6kOU9tkweMSibMyuibIawpVhBVahgOW4FvTgbibtZagTKuCAIeGLHztJcZozlZZ7FEibDA/0', '2', '2017-12-01', '侍小丽', '15195645837', '梦巴士', '1', '1285.02', '12980', 'oKoJkwOJQrOX7matxSVZSdhbcpLo', '20171201/196.png', null);
INSERT INTO `mall_user` VALUES ('197', '夜～', '1', 'Wenzhou', 'CN', 'Zhejiang', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKdwibXS9GcBt3ib32WQbOBjAjXPK8ibhtKichqoChiaj2f9xp6uTCmushNjtMvMXq1HLZsCIPIGEKldqQ/0', '0', '2017-12-01', '徐文强', '17506185710', '万达广场', '1', '0.00', '12980', 'oKoJkwMresM3UJIptxcETTvoBu_o', '20171201/197.png', null);
INSERT INTO `mall_user` VALUES ('198', '木木还是那个木木', '1', 'Jiujiang', 'CN', 'Jiangxi', 'http://wx.qlogo.cn/mmopen/vi_32/hQoOP719jaqn1FiaBia2s7QhdEibXEGmcFBicH8iaTjaib2OzCrXl6ibLTPNvkpoHsdoibucIn5Qhur8xeQEfjso4V1ruw/0', '0', '2017-12-01', '李小俊', '15270229736', '江苏苏州吴中万达广场', '1', '0.00', '12980', 'oKoJkwOedgY4A_7DXuZe_U8NRQ6c', '20171201/198.png', null);
INSERT INTO `mall_user` VALUES ('199', '苏州博思派', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/FgqmFVmK8Uhg6uiaWQSYHPyZh1wWicia3ZvZd7ZTEqFPKrrF0TFDHSTFoIthRfyedzFmgcBGsCO6VSnoEHs8VFZDw/0', '0', '2017-12-01', '甘道燕', '15862330789', '苏州市吴中区万达广场信息产业园6楼602', '1', '0.00', '12980', 'oKoJkwDzciQlgdqnI_XaVoWzqMzQ', '20171201/199.png', null);
INSERT INTO `mall_user` VALUES ('185', '777', '2', 'Haidian', 'CN', 'Beijing', 'http://wx.qlogo.cn/mmopen/vi_32/XZ05jWBvzsg42FbFqNysLjEU8Hc5R3UCJKGzic2oHKwqZK32NicJhIibk30IXyp3w8GUZ2zwvu1la1jTn7V86CKew/0', '0', '2017-12-01', '啦啦', '13576764949', '11', '1', '2668.00', '223960', 'oKoJkwAD87TzTcYHLu_dH1sKPy84', '20171201/185.png', null);
INSERT INTO `mall_user` VALUES ('186', '斑驳·Mppstore', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK4tsu9z0efKLdVzJsFOojwkAttWWsT50nI1n1Xoia0FiaW8hVcNkVvI20ib8iazpgaRDWQjRicudMrwqA/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwPwx3qmdEZ66nwzFDwN2F80', '20171201/186.png', null);
INSERT INTO `mall_user` VALUES ('187', '阿信', '1', '', 'NL', 'Rotterda', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ep4Djgibjic8z0mSCWQlDgIia2esOWwMgRq2WSwoFCfnFov6qsWHh7g0eLFgRLaHicETD7HkwdOSv3wgQ/0', '0', '2017-12-01', '阿信', '15666625990', '17', '1', '0.00', '12980', 'oKoJkwISv5CO2FBL6trDTzl5ngfo', '20171201/187.png', null);
INSERT INTO `mall_user` VALUES ('188', '素年锦时', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIsjYkp2Kl5snBnq2MGdvnN7YuHuI3E27LUZ71L4Y6E3YXkyLex3Adne6S4hOpg6euGNMEw70R9zg/0', '2', '2017-12-01', '胡跃娟', '18860917035', '梦巴士', '2', '13515.48', '198000', 'oKoJkwF2YdlO9mwjdNYttXeP9LSk', '20171201/188.png', null);
INSERT INTO `mall_user` VALUES ('189', '꧁꫞꯭JMM꫞꧂', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/ZwdAd32mZLDr2dHpqMjfDL0KhKlmM5VCuabSWakyNWw8EIzXsibSqXkrchBUKTZyCenQiaDpicuW4YZlwKsbwA0Lw/0', '1', '2017-12-01', '銀魂', '18913540051', '额额', '3', '1168.20', '210980', 'oKoJkwDOH0z1tV0CPDHKG7-WXAf8', '20171201/189.png', null);
INSERT INTO `mall_user` VALUES ('190', '孟德烜', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/2tA1EskBGs6iaI0SFBtkd1mdKzyOHaurkY9q8yKFCsehoGLLnMLXQ1wtehvsx21Ps8bDgqwQaT9grFqzQNJAoyw/0', '0', '2017-12-01', '孟德', '18362767671', '梦巴士', '1', '389.40', '12980', 'oKoJkwApXi2QbgLWES-lRL1Z9RBA', '20171201/190.png', null);
INSERT INTO `mall_user` VALUES ('191', '傲娇的假正经逗比小公举', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erj7xwibr86d3FxBGDg8qWicsDkvYdpNktD5w1oNO6WpeqhlIA1giaBlvqia2m0fobB5YtF4b9GTcjP6w/0', '0', '2017-12-01', '王婷', '15851400726', '梦巴士', '1', '0.00', '12980', 'oKoJkwE_XDMoUKaPkFUdd9jdqi64', '20171201/191.png', null);
INSERT INTO `mall_user` VALUES ('192', '赵文', '1', 'East', 'CN', 'Beijing', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epxVEGfNCt8icAm1aTia13l5I9GfOCkSrAicsQgvt0iaFCpSZiadghSttwfCpqIw2HVicWLo8eib0vN7W6ZQ/0', '2', '2017-12-01', '赵文', '13911650911', '苏州', '1', '6017.88', '12980', 'oKoJkwGkuslRBz1CFyeT5ZXitt_0', '20171201/192.png', '4');
INSERT INTO `mall_user` VALUES ('193', '鑫', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83er9jJoIOnNX6Zh5MibStPKok88u6286cUGJhsWYyMRgpIibZawCJF5dKyzIw3zPQFHrv64ejwzibwhng/0', '0', '2017-12-01', '彭', '13912622006', '梦巴士', '1', '389.40', '12980', 'oKoJkwOGz6olj2QdaXs-PVVMPgPM', '20171201/193.png', null);
INSERT INTO `mall_user` VALUES ('194', '梦想家  廖旭', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIMnghalvQicr958HfeHtDpPqNZZ2Xwat2cFc3LmLeGtichMHrGd7DtRzMvNlYibXAO0d9zGF8qBdpWQ/0', '0', '2017-12-01', '常笑', '13606136732', '苏州', '1', '0.00', '12980', 'oKoJkwIShZK-BEW6ooi14fP-X3pw', '20171201/194.png', null);
INSERT INTO `mall_user` VALUES ('195', '叒木桑', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ergzZ59ajiakkaXWWoT1GpxPNXHFeoT5AU6oMo5Uoeyx3IOJeicSfgMJQtGs7uR2myIqEPDTpHeGFMQ/0', '0', '2017-12-01', '桑晶晶', '18913188948', '苏州', '1', '0.00', '12980', 'oKoJkwJHAKuL3aBMkpl8dMyO5gpo', '20171201/195.png', null);
INSERT INTO `mall_user` VALUES ('200', '汪敏', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI1VrPs7GTnFSOWFFcOjPv1DNEo20hONUm3bXbyasHUOWzPwzf3cr98g7NJmBPjMGVs81Y4Xibdbibw/0', '2', '2017-12-01', '汪敏', '13862111205', '江苏省', '1', '389.40', '12980', 'oKoJkwKEwy_3ssn4vMH7pcEzXXIU', '20171201/200.png', '3');
INSERT INTO `mall_user` VALUES ('201', '唐俊 梦巴士智慧社区+智慧教育', '1', '', 'CN', 'Shanghai', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIRzKmOGrozLFjJfroiaxvZNicq1kMJMoicETibvicGae3cB1uNhWCjPfc2BDoUF7PvSOR0MVY7MdSyfnA/0', '0', '2017-12-01', '唐俊', '18013567168', '苏州', '2', '1616.34', '198000', 'oKoJkwONK9trCU9hJEWVn0kUsX7k', '20171201/201.png', '5');
INSERT INTO `mall_user` VALUES ('202', '赵玉言', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKUgmsyyyBJHiaZnUMbF1yV8lqbhmCGqCHyBc3fWKodU2TXFexxGUMYibibq0M338pUIqDZkql4lCZ7w/0', '0', '2017-12-01', '赵玉言', '18015591297', '城市', '2', '5940.00', '198000', 'oKoJkwHukU7lnRyvmOTJ0-yBHT5M', '20171201/202.png', null);
INSERT INTO `mall_user` VALUES ('203', '飛鴻', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJpdoetgNjXAC7GJaO5dqRqzcyNWKJmSy5Nib6UNM2ia9AmcHFPoa2BblInYKXl6EDAfKCx4BXnoAnQ/0', '1', '2017-12-01', '飞鸿', '13914049914', '苏州', '3', '1168.20', '210980', 'oKoJkwGkbtwkvsizMu135mRe97fE', '20171201/203.png', null);
INSERT INTO `mall_user` VALUES ('222', '王悦君', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLBHnBFuMy5sc0p2gstYPw437LViaLOwXkjpIB1Cv0t6W1HuCPT2pC5SRSgms72x0mPE3q7EP66oiaw/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwHpdxBEEVRCJ099UKzati0g', '20171201/222.png', null);
INSERT INTO `mall_user` VALUES ('205', '巧巧', '2', '', 'EG', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLyEWO2T2Brg5vxu5VSOJ6WI9BL0RsQPywj1eFHibVVP45LzfDsej5Mfqcf0PX0O89E8tzdKkQgicqQ/0', '0', '2017-12-01', '陈番巧', '18912635539', '吴中区', '1', '1100.22', '12980', 'oKoJkwBKuc7SGza9JFY6SVINQfJA', '20171201/205.png', '2');
INSERT INTO `mall_user` VALUES ('206', '汪伟', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIf68tL1ibvFQxApgI9BLRqKZjuQgmSljbPoZuibyGac4Hy3sicfIiaHrH6vMSQMcBB4RgjnLj8pqTkibA/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwBT8AKlvIft8Fpo6ITIXNVk', '20171201/206.png', null);
INSERT INTO `mall_user` VALUES ('207', '项晨', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erp5vduKPtu6hbe6qTl3VnqicqKUicXrIsCInC9R4C96puD72uyjz6fVwr7tLI8Un8icIQh94vXvgYDA/0', '0', '2017-12-01', '项晨', '13656247767', '吴中区梦巴士', '3', '0.00', '210980', 'oKoJkwHHvricS1QyKxVBx25wSAek', '20171201/207.png', null);
INSERT INTO `mall_user` VALUES ('208', '浅浅猫', '2', 'Nanjing', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIcWnCzWXv0esm1qd11Mic10hj4gKoMNTK7pXVFVveUiciaEmt0JuFgAv2VjTHJayia3b6BicmJvVNYq6g/0', '0', '2017-12-01', '王莹', '18761870350', '苏州', '2', '19377.60', '198000', 'oKoJkwLAnUnq60z9v7BhdelydQ94', '20171201/208.png', '8');
INSERT INTO `mall_user` VALUES ('209', 'a   love 王敏（招学员）', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLNia8YfxCHrMlgzPyp314H6nlmJxMr9Y7YzQOp9arhHAwsiaUqhKRxzuSS7UtfCKmwicMDAticRia0rxA/0', '0', '2017-12-01', '王敏', '13771982291', '江苏省苏州市吴中区', '1', '983.40', '12980', 'oKoJkwHIZtZ62CbgqFFSM49q5DHQ', '20171201/209.png', '1');
INSERT INTO `mall_user` VALUES ('210', '言立明', '1', 'Changzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLrhI3tFPRHPmr1HYNf60EDESBoiaCvIuCaZ9RtCCdjia3TwKvKo0Jpcia1G1ibxu1jceQZibBm7cicHLkQ/0', '0', '2017-12-01', '言立明', '18896972713', '雅安', '1', '0.00', '25960', 'oKoJkwJ2qF4nGWQawgzVWT5YSZ9k', '20171201/210.png', null);
INSERT INTO `mall_user` VALUES ('211', '༺༼࿅࿆奇美拉姆࿄࿆༽༻', '2', 'Huangpu', 'CN', 'Shanghai', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eolibHibbzicClicXGNQ0qvFyQxibEricRmDkoUNFzJpibuicGbH0IFON2tNEBgBwpoiaxYjTXINwaibSceiaDNQ/0', '3', '2017-12-01', '王晨风', '18662527918', '苏州', '2', '9338.34', '198000', 'oKoJkwPVNaYYnDlDIAoheLeCcSQ0', '20171201/211.png', '7');
INSERT INTO `mall_user` VALUES ('212', '杨兴斌___达州', '1', '', 'TT', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKCdzkWetV6xz9NVTA7jDOOqQbry4X4u39dz3xZNiaVS2xsIaEAmYMgWv1sDDDZ9ziaF0UpjrB6GnDw/0', '0', '2017-12-01', '杨兴彬', '13776065294', '苏州吴中区万达', '1', '0.00', '12980', 'oKoJkwKMoXSP_s6rQqhJAhGOK0rE', '20171201/212.png', null);
INSERT INTO `mall_user` VALUES ('213', '台湾 郑先生 健康管理 15962440', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/6a4gibhkbrqEGib6N8Ga2XBNFQiaAnHdWHpPxcm1nMqjxziaEs10tYIAJfJQORRzd2HnoqkJiah0OmksuMv8YWkcoyA/0', '2', '2017-12-01', '郑永芳', '15962440964', '你好', '1', '14372.82', '12980', 'oKoJkwAlhBEA2FH6k7_qeY-KPB68', '20171201/213.png', '6');
INSERT INTO `mall_user` VALUES ('214', '忘不了的味道', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLkWoiaXhl4tWugUtm71m09R3GbmgV3KotrVRUFeEUhkWp59rgmKj2GCMLQ2oTcV4ibx4xm6PiaIlzew/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwJ8QW7xdn3WivHdrmu-5rDw', '20171201/214.png', null);
INSERT INTO `mall_user` VALUES ('215', '芳铃', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/lnfzMT7DeZC9C5kNPBAtJv8hGKNRC6pYzXibo47UzGhU2lGAvhcF9HWBtoyYPB8iaicZx5qmNib2d7r7kpMibGGLD6Q/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwFftavclcKtN7aN53uNs0Cw', '20171201/215.png', null);
INSERT INTO `mall_user` VALUES ('216', '智慧◎祝福', '1', '', 'IL', '', 'http://wx.qlogo.cn/mmopen/vi_32/Wps7nuvHDicRC6bbLUXicblbPxzKOEuL8Qsr8wH886ERQKz7xPnibOWlTFnwhs20xke8vu1X50ARoqWLhQcicKIE1w/0', '0', '2017-12-01', '王小二', '13915583959', '苏州', '2', '0.00', '198000', 'oKoJkwBDw1n-UqlYanSZY2Cr343A', '20171201/216.png', null);
INSERT INTO `mall_user` VALUES ('219', '我和你', '1', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJH3dribPS9Aibq0u1WZjEQalLPAhRbDE5QAts52YjUwwMZyPFtKHwsXNL4IySfoTCeHRUbPDauSPuA/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwM_vlgMqmc9pLtq-R_SPF7A', '20171201/219.png', null);
INSERT INTO `mall_user` VALUES ('221', '竹海', '1', 'Nanjing', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJmibVfoScf2lPV6S4FHOu7Iv72Wgiau15Jhr2CTBnBHujD0d7jR0U6IyBTPiaoGrbbE7POvibX8XibWWg/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwCOeAgqYpWhFB0yTV3YLEK8', '20171201/221.png', null);
INSERT INTO `mall_user` VALUES ('220', 'super娜', '2', 'Melbourne', 'AU', 'Victoria', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIxNRv9KERly31jic2JGosAMad5wAaBOGpSbOwibzUkiapsLUticuusQznMSFRkqIuSrwQoWKgIic8nR6g/0', '0', '2017-12-01', '汪伟娜', '18625269900', '苏州', '2', '0.00', '198000', 'oKoJkwG7udpVS3s4tuOktR7mPrSA', '20171201/220.png', '9');
INSERT INTO `mall_user` VALUES ('223', '苏州伊钻祛斑～签不反弹合约', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoeca6DAKEAlh8Vy10faFw0Niamox5W1WBf6rQiaDGzoqKMlX5wv4zayvxloHRVWtTyHs5E9OktGSEg/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwIqmLUYW7YDu6Gt17T1Seg0', '20171201/223.png', null);
INSERT INTO `mall_user` VALUES ('224', '马新平', '2', 'Suzhou', 'CN', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqKLria7oX5323jYJb839qA4RGLyPYW1UmohDOhu1icGwhn5n9MMfzNLVry12UNCuhJEuSLCibPWdpcA/0', '0', '2017-12-01', null, null, null, '0', '0.00', '0', 'oKoJkwPNd3hvdlwBqrubWVOyHb_k', '20171201/224.png', null);
