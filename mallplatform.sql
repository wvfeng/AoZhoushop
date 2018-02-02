/*
Navicat MySQL Data Transfer

Source Server         : 步云信息
Source Server Version : 50720
Source Host           : 121.43.165.149:3306
Source Database       : mallplatform

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-02-02 17:42:24
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_address
-- ----------------------------
INSERT INTO `mall_address` VALUES ('3', '订单', '123', '321', '0', null);
INSERT INTO `mall_address` VALUES ('4', null, '123', '321555', '0', null);
INSERT INTO `mall_address` VALUES ('5', null, '12322', '321555444444', '0', null);
INSERT INTO `mall_address` VALUES ('7', null, '12322', '321555444444', '0', null);
INSERT INTO `mall_address` VALUES ('8', null, '12322', '321555444444', '0', null);
INSERT INTO `mall_address` VALUES ('9', null, '12322', '321555444444', '0', null);

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
INSERT INTO `mall_admin` VALUES ('1', 'oto', 'c33367701511b4f6020ec61ded352059', '1', '2018-01-18 19:17:03');
INSERT INTO `mall_admin` VALUES ('13', 'chong', 'e10adc3949ba59abbe56e057f20f883e', '1', '2018-01-04 14:01:52');

-- ----------------------------
-- Table structure for mall_cart
-- ----------------------------
DROP TABLE IF EXISTS `mall_cart`;
CREATE TABLE `mall_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL COMMENT '商品数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='购物车，登陆后用，登录前存session';

-- ----------------------------
-- Records of mall_cart
-- ----------------------------
INSERT INTO `mall_cart` VALUES ('2', '1', '1', null);
INSERT INTO `mall_cart` VALUES ('3', '1', '1', null);
INSERT INTO `mall_cart` VALUES ('4', '1', '1', null);
INSERT INTO `mall_cart` VALUES ('5', '1', '1', null);
INSERT INTO `mall_cart` VALUES ('6', '1', '1', null);
INSERT INTO `mall_cart` VALUES ('10', '21', '1', '21');
INSERT INTO `mall_cart` VALUES ('11', '22', '1', '55');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_classify
-- ----------------------------
INSERT INTO `mall_classify` VALUES ('20', '健康生活', '20180122/5a65517fe6872.jpg', '2018-01-22 10:45:16', '1', '0');
INSERT INTO `mall_classify` VALUES ('21', '营养保健', '20180122/5a6551857b2f0.jpg', '2018-01-22 10:46:33', '1', '0');
INSERT INTO `mall_classify` VALUES ('22', '美妆护肤', '20180122/5a65518a14f3e.jpg', '2018-01-22 10:46:45', '1', '0');
INSERT INTO `mall_classify` VALUES ('23', '生活护理', '20180122/5a65518f2a439.jpg', '2018-01-22 10:46:56', '1', '0');
INSERT INTO `mall_classify` VALUES ('24', '婴幼儿食品', '20180122/5a6551940344e.jpg', '2018-01-22 10:47:56', '2', '20');
INSERT INTO `mall_classify` VALUES ('25', '生鲜水果', '20180122/5a65519a26c16.jpg', '2018-01-22 10:48:08', '2', '20');
INSERT INTO `mall_classify` VALUES ('26', '零食坚果', '20180122/5a6551a061ae3.jpg', '2018-01-22 10:48:20', '2', '21');
INSERT INTO `mall_classify` VALUES ('27', '酒水饮料', '20180122/5a6551a670a85.jpg', '2018-01-22 10:50:10', '2', '22');
INSERT INTO `mall_classify` VALUES ('28', '饼干糕点', '20180122/5a6551ac85401.jpg', '2018-01-22 10:50:22', '2', '23');
INSERT INTO `mall_classify` VALUES ('29', '蜂蜜', '20180122/5a6551b223ac2.jpg', '2018-01-22 10:50:34', '2', '21');

-- ----------------------------
-- Table structure for mall_collect
-- ----------------------------
DROP TABLE IF EXISTS `mall_collect`;
CREATE TABLE `mall_collect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `s_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `create_time` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='商品收藏表';

-- ----------------------------
-- Records of mall_collect
-- ----------------------------
INSERT INTO `mall_collect` VALUES ('2', '1', '20', '1516162744');
INSERT INTO `mall_collect` VALUES ('3', '1', '19', '1516162744');
INSERT INTO `mall_collect` VALUES ('45', '60', '22', '1517390772');
INSERT INTO `mall_collect` VALUES ('46', '60', '22', '1517390774');
INSERT INTO `mall_collect` VALUES ('47', '60', '22', '1517390778');
INSERT INTO `mall_collect` VALUES ('57', '60', '22', '1517396101');
INSERT INTO `mall_collect` VALUES ('58', '60', '22', '1517396103');
INSERT INTO `mall_collect` VALUES ('59', '60', '22', '1517396107');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='优惠券';

-- ----------------------------
-- Records of mall_coupons
-- ----------------------------
INSERT INTO `mall_coupons` VALUES ('1', '10000', '2.00', '3', '2018-01-11', '2018-01-12', '1');
INSERT INTO `mall_coupons` VALUES ('2', '120000', '99.00', '12700', '2018-01-11', '2018-01-31', '0');
INSERT INTO `mall_coupons` VALUES ('3', 'ewqeq111000', '12.00', '32', '2018-01-12', '2018-01-31', '1');

-- ----------------------------
-- Table structure for mall_credit_order
-- ----------------------------
DROP TABLE IF EXISTS `mall_credit_order`;
CREATE TABLE `mall_credit_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(10) unsigned NOT NULL COMMENT '商品ID',
  `u_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '退货说明',
  `type` enum('退货','换货','售后') NOT NULL DEFAULT '退货' COMMENT '1表示退货、2表示换货、3表示售后',
  `status` enum('未审核','通过','拒绝','取消') NOT NULL DEFAULT '未审核' COMMENT '1表示未审核、2表示通过审核、3表示拒绝请求、4表示用户取消',
  `company_id` varchar(30) NOT NULL DEFAULT '' COMMENT '快递公司ID',
  `LogisticCode` varchar(30) NOT NULL DEFAULT '' COMMENT '快递运单号',
  `tel` varchar(11) NOT NULL DEFAULT '' COMMENT '联系电话',
  `images` varchar(300) NOT NULL DEFAULT '' COMMENT '图片路径，用英文逗号分隔',
  `create_time` varchar(111) NOT NULL COMMENT '创建时间',
  `update_time` varchar(111) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='退换货/售后表';

-- ----------------------------
-- Records of mall_credit_order
-- ----------------------------
INSERT INTO `mall_credit_order` VALUES ('1', '1', '1', '', '退货', '未审核', '', '1', '', '', '1', '1');

-- ----------------------------
-- Table structure for mall_evaluation
-- ----------------------------
DROP TABLE IF EXISTS `mall_evaluation`;
CREATE TABLE `mall_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text COMMENT '评论内容',
  `star` tinyint(4) DEFAULT NULL COMMENT '1一颗星2二颗星........以此类推',
  `img` varchar(255) DEFAULT NULL COMMENT '多个图片，以|*|区分字符串,例子20180110/5a559ebfd2923.jpg|*|20180110/5a559ec1f0dfc.jpg|*|',
  `type` int(2) DEFAULT '1' COMMENT '1不匿名  2匿名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_evaluation
-- ----------------------------
INSERT INTO `mall_evaluation` VALUES ('1', '19', '20', '2018-01-25 16:42:45', 'lalalala', '3', '12121', '1');
INSERT INTO `mall_evaluation` VALUES ('2', '20', '20', '2018-01-27 16:43:09', 'popopo', '4', 'wqwqwq', '1');
INSERT INTO `mall_evaluation` VALUES ('3', '0', '60', null, '1111111', '1', '/conf/5a6ec0fa293f1.jpg|*|/conf/5a6ec0fa29f63.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('4', '22', '60', null, '1111111', '1', '/conf/5a6ec12247498.jpg|*|/conf/5a6ec1224a62f.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('5', '22', '60', '2018-01-29 14:38:11', '1111111', '1', '/conf/5a6ec1b62b646.jpg|*|/conf/5a6ec1b62c588.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('6', '22', '60', '2018-01-29 14:43:37', '1111111', '1', '/conf/5a6ec2fc16a65.jpg|*|/conf/5a6ec2fc1c222.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('7', '22', '60', '2018-01-29 14:56:32', '1111111', '1', '/conf/5a6ec6033436b.jpg|*|/conf/5a6ec60337502.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('8', '214', '60', '2018-01-29 15:09:06', '1111111', '1', '/conf/5a6ec8f5016e3.jpg|*|/conf/5a6ec8f502625.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('74', '213', '60', '2018-01-30 16:48:54', 'aaa', '3', '/conf/5a7031dc2aad4.jpg|*|/conf/5a7031dc2ba16.jpg', '1');
INSERT INTO `mall_evaluation` VALUES ('75', '213', '60', '2018-01-30 16:49:31', 'aaa', '3', '/conf/5a70320101ab3.jpg|*|/conf/5a703201029f6.jpg', '1');

-- ----------------------------
-- Table structure for mall_kuaidi_code
-- ----------------------------
DROP TABLE IF EXISTS `mall_kuaidi_code`;
CREATE TABLE `mall_kuaidi_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(30) NOT NULL COMMENT '快递公司名称',
  `kuaidiniao_code` varchar(20) DEFAULT NULL COMMENT '快递鸟代号',
  `kuaidi100_code` varchar(20) DEFAULT NULL COMMENT '快递100代号',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_kuaidi_code
-- ----------------------------
INSERT INTO `mall_kuaidi_code` VALUES ('1', '澳大利亚邮政(英文结果）', 'IADLYYZ', 'auspost', '2018-01-17 14:37:09', '2018-01-17 15:03:48');
INSERT INTO `mall_kuaidi_code` VALUES ('2', '德邦物流', 'DBL', 'debangwuliu', '2018-01-17 14:37:53', '2018-01-17 14:58:56');
INSERT INTO `mall_kuaidi_code` VALUES ('3', 'EMS(中文结果)', 'EMS', 'ems', '2018-01-17 14:38:10', '2018-01-17 14:57:18');
INSERT INTO `mall_kuaidi_code` VALUES ('4', 'EMS（英文结果）', 'EMS', 'emsen', '2018-01-17 14:38:40', '2018-01-17 14:57:27');
INSERT INTO `mall_kuaidi_code` VALUES ('5', '国通快递', 'GTO', 'guotongkuaidi', '2018-01-17 14:39:57', '2018-01-17 14:59:49');
INSERT INTO `mall_kuaidi_code` VALUES ('6', '汇通快运', 'BTWL', 'huitongkuaidi', '2018-01-17 14:40:17', '2018-01-17 15:00:51');
INSERT INTO `mall_kuaidi_code` VALUES ('7', '汇强快递', 'ZHQKD', 'huiqiangkuaidi', '2018-01-17 14:40:41', '2018-01-17 15:01:17');
INSERT INTO `mall_kuaidi_code` VALUES ('8', '华宇物流', null, 'tiandihuayu', '2018-01-17 14:42:06', '2018-01-17 14:42:06');
INSERT INTO `mall_kuaidi_code` VALUES ('9', '申通', 'STO', 'shentong', '2018-01-17 14:42:21', '2018-01-17 14:56:51');
INSERT INTO `mall_kuaidi_code` VALUES ('10', '顺丰', 'SF', 'shunfeng', '2018-01-17 14:48:34', '2018-01-17 14:56:02');
INSERT INTO `mall_kuaidi_code` VALUES ('11', '顺丰（英文结果）', 'SF', 'shunfengen', '2018-01-17 14:49:22', '2018-01-17 14:57:34');
INSERT INTO `mall_kuaidi_code` VALUES ('12', '圆通速递', 'YTO', 'yuantong', '2018-01-17 14:49:40', '2018-01-17 14:57:02');
INSERT INTO `mall_kuaidi_code` VALUES ('13', '韵达快运', 'YD', 'yunda', '2018-01-17 14:50:34', '2018-01-17 14:57:14');
INSERT INTO `mall_kuaidi_code` VALUES ('14', '中通速递', 'ZTO', 'zhongtong', '2018-01-17 14:50:51', '2018-01-17 14:56:39');
INSERT INTO `mall_kuaidi_code` VALUES ('15', '京东快递', 'JD', 'jd', '2018-01-17 14:55:58', '2018-01-17 14:57:37');
INSERT INTO `mall_kuaidi_code` VALUES ('16', '百世快递', 'HTKY', 'baishikuaidi', '2018-01-17 14:56:31', '2018-01-17 14:56:31');
INSERT INTO `mall_kuaidi_code` VALUES ('17', '天天快递', 'HHTT', 'tiantiankuaidi', '2018-01-17 14:58:08', '2018-01-17 14:58:08');
INSERT INTO `mall_kuaidi_code` VALUES ('18', '亚马逊物流', 'AMAZON', null, '2018-01-17 15:00:20', '2018-01-17 15:00:20');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='自提点';

-- ----------------------------
-- Records of mall_logsince
-- ----------------------------
INSERT INTO `mall_logsince` VALUES ('1', '1', '2', '3', '4', '2018-01-11 10:08:06', '1');
INSERT INTO `mall_logsince` VALUES ('2', '11', '21', '41', '71', '2018-01-11 10:23:59', '1');
INSERT INTO `mall_logsince` VALUES ('3', '', '', '', '', '2018-01-24 13:21:35', '1');

-- ----------------------------
-- Table structure for mall_order
-- ----------------------------
DROP TABLE IF EXISTS `mall_order`;
CREATE TABLE `mall_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` varchar(255) DEFAULT NULL COMMENT '|*|多个用分开',
  `user_id` int(11) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL COMMENT '|*|多个用分开',
  `name` char(10) DEFAULT NULL COMMENT '收件人',
  `iphone` varchar(20) DEFAULT NULL COMMENT '收件手机号',
  `address` varchar(255) DEFAULT NULL COMMENT '收件地址',
  `date` date DEFAULT NULL,
  `no` char(20) DEFAULT NULL COMMENT '物流编号',
  `log` char(10) DEFAULT NULL COMMENT '物流公司名称',
  `paytype` char(30) DEFAULT NULL COMMENT '支付方式',
  `type` enum('未付款','待发货','已发货','待评论','已评价','退货','换货','售后') DEFAULT '未付款' COMMENT '1代表未付款,2代表待发货,3代表已发货,4代表未评论,5代表已评价,6代表退货,7代表换货,8代表售后',
  `money` decimal(12,2) DEFAULT '0.00' COMMENT '总计消费金额',
  `paymoney` decimal(12,2) DEFAULT NULL COMMENT '实际付款金额',
  `freight` decimal(12,2) DEFAULT NULL COMMENT '运费',
  `nickname` char(20) DEFAULT '0' COMMENT '用户昵称',
  `pick_type` tinyint(4) DEFAULT NULL COMMENT '1物流2上门',
  `warn` int(3) DEFAULT '0' COMMENT '提醒发货次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8 COMMENT='订单表，购买记录';

-- ----------------------------
-- Records of mall_order
-- ----------------------------
INSERT INTO `mall_order` VALUES ('196', '20|*|19|*|212', '203', null, '飞鸿', '13914049914', '苏州', '2017-12-01', null, null, null, '已发货', '19800.00', null, null, '飛鴻', null, '0');
INSERT INTO `mall_order` VALUES ('197', '20|*|19|*|213', '189', null, '銀魂', '18913540051', '额额', '2017-12-01', null, null, null, '已发货', '19800.00', null, null, '꧁꫞꯭JMM꫞꧂', null, '0');
INSERT INTO `mall_order` VALUES ('198', '20|*|19|*|211', '202', null, '赵玉言', '18015591297', '城市', '2017-12-01', null, null, null, '已发货', '19800.00', null, null, '赵玉言', null, '0');
INSERT INTO `mall_order` VALUES ('199', '20|*|19|*|214', '216', null, '王小二', '13915583959', '苏州', '2017-12-01', null, null, null, '已发货', '19800.00', null, null, '智慧◎祝福', null, '0');
INSERT INTO `mall_order` VALUES ('200', '20|*|19|*|215', '191', null, '王婷', '15851400726', '梦巴士', '2017-12-01', null, null, null, '已发货', '1298.00', null, null, '傲娇的假正经逗比小公举', null, '0');
INSERT INTO `mall_order` VALUES ('205', '20|*|19|*|216', '220', null, '汪伟娜', '18625269900', '苏州', '2017-12-01', null, null, null, '已发货', '19800.00', null, null, 'super娜', null, '0');
INSERT INTO `mall_order` VALUES ('206', '20|*|19|*|217', '185', null, '啦啦', '13576764949', '11', '2017-12-01', null, null, null, '已发货', '1298.00', null, null, '777', null, '0');
INSERT INTO `mall_order` VALUES ('207', '21|*|19|*|218', '185', null, '啦啦', '13576764949', '11', '2017-12-01', null, null, null, '已发货', '19800.00', null, null, '777', null, '0');
INSERT INTO `mall_order` VALUES ('210', '20|*|19|*|211', '1', '1|*|1|*|1', '1', '2', '3', '2018-01-17', null, null, null, '未付款', '200.00', '222.00', null, '0', '1', '4');
INSERT INTO `mall_order` VALUES ('211', '20|*|19|*|21', '2', '1|*|1|*|1', null, null, null, '2018-01-17', null, null, null, '未付款', '200.00', null, null, '0', '1', '0');
INSERT INTO `mall_order` VALUES ('212', '20|*|190|*|21', '1', '1|*|1|*|1', null, null, null, '2018-01-23', null, null, null, '未付款', '100.00', null, null, '0', null, '0');
INSERT INTO `mall_order` VALUES ('213', '20|*|19|*|21', '60', '1|*|1|*|1', '1', '2', '3', '2018-01-17', null, null, null, '已评价', '200.00', '222.00', null, '0', '1', '4');
INSERT INTO `mall_order` VALUES ('214', '20|*|190|*|21', '60', '1|*|1|*|1', null, null, null, '2018-01-23', null, null, null, '未付款', '100.00', null, null, '0', null, '0');

-- ----------------------------
-- Table structure for mall_setup
-- ----------------------------
DROP TABLE IF EXISTS `mall_setup`;
CREATE TABLE `mall_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL COMMENT '广告图',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `type` tinyint(4) DEFAULT NULL COMMENT '1首页轮播2首页中间广告位3分类页banner',
  `sort` tinyint(4) DEFAULT NULL COMMENT '排序',
  `models` tinyint(4) DEFAULT NULL COMMENT '1pc2移动端',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_setup
-- ----------------------------
INSERT INTO `mall_setup` VALUES ('6', '20180125/5a69385ed2094.jpg', 'a@qq.com', '1', null, null);
INSERT INTO `mall_setup` VALUES ('7', '20180125/5a6938a9e1002.jpg', 'a@qq.com', '1', null, null);
INSERT INTO `mall_setup` VALUES ('8', '20180125/5a6938b4aedbb.png', 'a@qq.com', '2', null, null);
INSERT INTO `mall_setup` VALUES ('9', '20180125/5a693921eda9c.png', 'a@qq.com', '3', null, null);

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
  `num` int(11) DEFAULT NULL COMMENT '商品库存',
  `specifications` varchar(100) DEFAULT NULL COMMENT '规格',
  `origin` varchar(100) DEFAULT NULL COMMENT '产地',
  `storage` varchar(100) DEFAULT NULL COMMENT '储存方法',
  `oldprice` decimal(12,2) DEFAULT NULL COMMENT '原价',
  `price` decimal(12,2) DEFAULT '0.00' COMMENT '会员价格',
  `rate` decimal(12,4) DEFAULT NULL COMMENT '汇率',
  `detail_en` text,
  `detail` text COMMENT '详情',
  `sales` int(11) DEFAULT NULL COMMENT '销量',
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0删除1显示',
  `classify_id` int(11) DEFAULT NULL COMMENT '分类',
  `type` varchar(255) DEFAULT NULL COMMENT '类型|*|号分开,今日上新，今日特价，热门品牌，会员特权',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of mall_shop
-- ----------------------------
INSERT INTO `mall_shop` VALUES ('19', '20180110/5a559ebdb5fa1.jpg', '20180110/5a559ebfd2923.jpg|*|20180110/5a559ec1f0dfc.jpg|*|', '王企鹅3', '21321', '11111', '3123', '12313', '131', '50.00', '0.00', '3131.0000', '<p><span style=\"color: rgb(238, 236, 225);\">231321</span></p>', '<p><span style=\"color: rgb(247, 150, 70);\">32132131</span></p>', null, '2018-01-10 13:04:12', '1', '29', '今日上新|*|');
INSERT INTO `mall_shop` VALUES ('20', '20180110/5a559f0567a1d.jpg', '20180110/5a559f078eb99.jpg|*|20180110/5a559f0980590.jpg|*|', '烧麦王1', '8098098', '1111', '090', '9090', '909', '40.00', '909.00', '909.0000', '<p><span style=\"color: rgb(79, 97, 40);\">0909</span></p>', '<p><span style=\"color: rgb(147, 137, 83);\">0909</span></p>', null, '2018-01-10 13:05:21', '1', '27', '今日特价|*|会员特权|*|热门品牌|*|今日上新|*|');
INSERT INTO `mall_shop` VALUES ('21', '20180110/5a559f0567a1d.jpg', '20180110/5a559f078eb99.jpg|*|20180110/5a559f0980590.jpg|*|', '烧麦王2', '8098098', '1111', '090', '9090', '909', '1000.00', '909.00', '909.0000', '<p><span style=\"color: rgb(217, 150, 148);\">0909</span></p>', '<p><span style=\"color: rgb(215, 227, 188);\">0909</span></p>', null, '2018-01-10 13:05:21', '1', '25', '今日特价|*|会员特权|*|热门品牌|*|');
INSERT INTO `mall_shop` VALUES ('22', '20180122/5a658b4144f8b.png', '20180110/5a559f078eb99.jpg|*|20180110/5a559f0980590.jpg|*|', '烧麦王2222烧麦王烧麦王烧麦王烧麦王烧麦王烧麦王', '8098098', '1111', '090', '9090', '909', '10.00', '909.00', '909.0000', '<p><span style=\"color: rgb(196, 189, 151);\">eqqewq</span></p>', '<p><span style=\"color: rgb(196, 189, 151);\">eqqewq<span style=\"color: rgb(196, 189, 151);\">eqqewq</span><span style=\"color: rgb(196, 189, 151);\">eqqewq</span><span style=\"color: rgb(196, 189, 151);\">eqqewq</span><span style=\"color: rgb(196, 189, 151);\">eqqewq</span></span></p>', null, '2018-01-10 13:05:21', '1', '24', '今日特价|*|会员特权|*|热门品牌|*|今日上新|*|');

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
  `accessToken` char(200) DEFAULT NULL COMMENT '创建用于激活识别码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of mall_user
-- ----------------------------
INSERT INTO `mall_user` VALUES ('1', '212', '12121', '2121', '2121', null);
INSERT INTO `mall_user` VALUES ('2', 'as123456', '222222', '333333', 'f6c65667c1b7f780ea31287b6cd7c03f', null);
INSERT INTO `mall_user` VALUES ('3', '3333333', null, '1234564.q', 'f6c65667c1b7f780ea31287b6cd7c03f', null);
INSERT INTO `mall_user` VALUES ('4', '33333334', null, '', 'f6c65667c1b7f780ea31287b6cd7c03f', null);
INSERT INTO `mall_user` VALUES ('5', '33333334', '1234564555', null, 'ecf693840ed3ce3ef56e4f620bd89ee6', null);
INSERT INTO `mall_user` VALUES ('6', '33333334', '1234564555', null, 'ecf693840ed3ce3ef56e4f620bd89ee6', null);
INSERT INTO `mall_user` VALUES ('7', '155176', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('8', '111', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('9', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('10', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('11', '1234564', null, '', 'dc33e2edf4f1b2eacec7b2199f560d04', null);
INSERT INTO `mall_user` VALUES ('12', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('13', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('14', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('15', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('16', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('17', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('18', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('19', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('20', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('21', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('22', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('23', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('24', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('25', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('26', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('27', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('28', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('29', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('30', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('31', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('32', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('33', '11', '15517656092', null, 'b6d767d2f8ed5d21a44b0e5886680cb9', null);
INSERT INTO `mall_user` VALUES ('34', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('35', '1111', '15517656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('36', '111', '15517656093', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('37', '111', '15517656093', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('38', '111', '15517656093', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('39', '111', '15517656093', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('40', '111', '15517656093', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('41', '111', '15517656093', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('42', '11', '15711048013', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('43', '111', '15711048013', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('44', '11', '15517656092', null, 'fc9d6fd2d8db223be4a7484a8619f26b', null);
INSERT INTO `mall_user` VALUES ('45', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('46', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('47', '11', '15711048013', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('48', '11', '15711048013', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('49', '11', '15711048013', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('50', '11', '15711048013', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('51', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('52', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('53', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('54', '11', '15517656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('55', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('56', '11', '15517656092', null, '6512bd43d9caa6e02c990b0a82652dca', null);
INSERT INTO `mall_user` VALUES ('57', '11', '15517656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('58', '123', '15517656092', null, 'e10adc3949ba59abbe56e057f20f883e', null);
INSERT INTO `mall_user` VALUES ('59', '111', '15517656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('60', '15517656092', '13517656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('61', '18817656092', '18817656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('62', '11', '17617656092', null, '698d51a19d8a121ce581499d7b701668', null);
INSERT INTO `mall_user` VALUES ('63', '11', '18817626092', null, '6512bd43d9caa6e02c990b0a82652dca', null);

-- ----------------------------
-- Table structure for mall_user_detail
-- ----------------------------
DROP TABLE IF EXISTS `mall_user_detail`;
CREATE TABLE `mall_user_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` char(20) DEFAULT NULL COMMENT '昵称',
  `mood` varchar(50) DEFAULT '' COMMENT '留言、心情',
  `sex` enum('男','女') DEFAULT '男' COMMENT '性别1男2女',
  `address` char(20) DEFAULT NULL COMMENT '地址',
  `headimgurl` varchar(250) DEFAULT '' COMMENT '头像',
  `date` char(30) DEFAULT NULL,
  `surplus_money` decimal(12,2) DEFAULT NULL COMMENT '余额',
  `surplus_int` int(11) DEFAULT '0' COMMENT '剩余积分',
  `qrcode` char(40) DEFAULT NULL COMMENT '二维码',
  `birthday` char(30) DEFAULT NULL COMMENT '生日',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=232 DEFAULT CHARSET=utf8 COMMENT='用户信息表，通过user_id关联到user表';

-- ----------------------------
-- Records of mall_user_detail
-- ----------------------------
INSERT INTO `mall_user_detail` VALUES ('196', 'Sunflower ✿', '小主还没有留言呢', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKvBWGibeV3p6kOU9tkweMSibMyuibIawpVhBVahgOW4FvTgbibtZagTKuCAIeGLHztJcZozlZZ7FEibDA/0', '2017-12-01', null, '12980', '20171201/196.png', null, '1');
INSERT INTO `mall_user_detail` VALUES ('197', '夜～', '', '男', 'Zhejiang', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKdwibXS9GcBt3ib32WQbOBjAjXPK8ibhtKichqoChiaj2f9xp6uTCmushNjtMvMXq1HLZsCIPIGEKldqQ/0', '2017-12-01', null, '12980', '20171201/197.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('198', '木木还是那个木木', '', '男', 'Jiangxi', 'http://wx.qlogo.cn/mmopen/vi_32/hQoOP719jaqn1FiaBia2s7QhdEibXEGmcFBicH8iaTjaib2OzCrXl6ibLTPNvkpoHsdoibucIn5Qhur8xeQEfjso4V1ruw/0', '2017-12-01', null, '12980', '20171201/198.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('199', '苏州博思派', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/FgqmFVmK8Uhg6uiaWQSYHPyZh1wWicia3ZvZd7ZTEqFPKrrF0TFDHSTFoIthRfyedzFmgcBGsCO6VSnoEHs8VFZDw/0', '2017-12-01', null, '12980', '20171201/199.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('185', '777', '', '女', 'Beijing', 'http://wx.qlogo.cn/mmopen/vi_32/XZ05jWBvzsg42FbFqNysLjEU8Hc5R3UCJKGzic2oHKwqZK32NicJhIibk30IXyp3w8GUZ2zwvu1la1jTn7V86CKew/0', '2017-12-01', null, '223960', '20171201/185.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('186', '斑驳·Mppstore', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK4tsu9z0efKLdVzJsFOojwkAttWWsT50nI1n1Xoia0FiaW8hVcNkVvI20ib8iazpgaRDWQjRicudMrwqA/0', '2017-12-01', null, '0', '20171201/186.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('187', '阿信', '', '男', 'Rotterda', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ep4Djgibjic8z0mSCWQlDgIia2esOWwMgRq2WSwoFCfnFov6qsWHh7g0eLFgRLaHicETD7HkwdOSv3wgQ/0', '2017-12-01', null, '12980', '20171201/187.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('188', '素年锦时', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIsjYkp2Kl5snBnq2MGdvnN7YuHuI3E27LUZ71L4Y6E3YXkyLex3Adne6S4hOpg6euGNMEw70R9zg/0', '2017-12-01', null, '198000', '20171201/188.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('189', '꧁꫞꯭JMM꫞꧂', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/ZwdAd32mZLDr2dHpqMjfDL0KhKlmM5VCuabSWakyNWw8EIzXsibSqXkrchBUKTZyCenQiaDpicuW4YZlwKsbwA0Lw/0', '2017-12-01', null, '210980', '20171201/189.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('190', '孟德烜', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/2tA1EskBGs6iaI0SFBtkd1mdKzyOHaurkY9q8yKFCsehoGLLnMLXQ1wtehvsx21Ps8bDgqwQaT9grFqzQNJAoyw/0', '2017-12-01', null, '12980', '20171201/190.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('191', '傲娇的假正经逗比小公举', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erj7xwibr86d3FxBGDg8qWicsDkvYdpNktD5w1oNO6WpeqhlIA1giaBlvqia2m0fobB5YtF4b9GTcjP6w/0', '2017-12-01', null, '12980', '20171201/191.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('192', '赵文', '', '男', 'Beijing', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epxVEGfNCt8icAm1aTia13l5I9GfOCkSrAicsQgvt0iaFCpSZiadghSttwfCpqIw2HVicWLo8eib0vN7W6ZQ/0', '2017-12-01', null, '12980', '20171201/192.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('193', '鑫', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83er9jJoIOnNX6Zh5MibStPKok88u6286cUGJhsWYyMRgpIibZawCJF5dKyzIw3zPQFHrv64ejwzibwhng/0', '2017-12-01', null, '12980', '20171201/193.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('194', '梦想家  廖旭', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIMnghalvQicr958HfeHtDpPqNZZ2Xwat2cFc3LmLeGtichMHrGd7DtRzMvNlYibXAO0d9zGF8qBdpWQ/0', '2017-12-01', null, '12980', '20171201/194.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('195', '叒木桑', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ergzZ59ajiakkaXWWoT1GpxPNXHFeoT5AU6oMo5Uoeyx3IOJeicSfgMJQtGs7uR2myIqEPDTpHeGFMQ/0', '2017-12-01', null, '12980', '20171201/195.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('200', '汪敏', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTI1VrPs7GTnFSOWFFcOjPv1DNEo20hONUm3bXbyasHUOWzPwzf3cr98g7NJmBPjMGVs81Y4Xibdbibw/0', '2017-12-01', null, '12980', '20171201/200.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('201', '唐俊 梦巴士智慧社区+智慧教育', '', '男', 'Shanghai', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIRzKmOGrozLFjJfroiaxvZNicq1kMJMoicETibvicGae3cB1uNhWCjPfc2BDoUF7PvSOR0MVY7MdSyfnA/0', '2017-12-01', null, '198000', '20171201/201.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('202', '赵玉言', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKUgmsyyyBJHiaZnUMbF1yV8lqbhmCGqCHyBc3fWKodU2TXFexxGUMYibibq0M338pUIqDZkql4lCZ7w/0', '2017-12-01', null, '198000', '20171201/202.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('203', '飛鴻', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJpdoetgNjXAC7GJaO5dqRqzcyNWKJmSy5Nib6UNM2ia9AmcHFPoa2BblInYKXl6EDAfKCx4BXnoAnQ/0', '2017-12-01', null, '210980', '20171201/203.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('222', '王悦君', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLBHnBFuMy5sc0p2gstYPw437LViaLOwXkjpIB1Cv0t6W1HuCPT2pC5SRSgms72x0mPE3q7EP66oiaw/0', '2017-12-01', null, '0', '20171201/222.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('205', '巧巧', '', '女', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLyEWO2T2Brg5vxu5VSOJ6WI9BL0RsQPywj1eFHibVVP45LzfDsej5Mfqcf0PX0O89E8tzdKkQgicqQ/0', '2017-12-01', null, '12980', '20171201/205.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('206', '汪伟', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIf68tL1ibvFQxApgI9BLRqKZjuQgmSljbPoZuibyGac4Hy3sicfIiaHrH6vMSQMcBB4RgjnLj8pqTkibA/0', '2017-12-01', null, '0', '20171201/206.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('207', '项晨', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erp5vduKPtu6hbe6qTl3VnqicqKUicXrIsCInC9R4C96puD72uyjz6fVwr7tLI8Un8icIQh94vXvgYDA/0', '2017-12-01', null, '210980', '20171201/207.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('208', '浅浅猫', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIcWnCzWXv0esm1qd11Mic10hj4gKoMNTK7pXVFVveUiciaEmt0JuFgAv2VjTHJayia3b6BicmJvVNYq6g/0', '2017-12-01', null, '198000', '20171201/208.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('209', 'a   love 王敏（招学员）', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLNia8YfxCHrMlgzPyp314H6nlmJxMr9Y7YzQOp9arhHAwsiaUqhKRxzuSS7UtfCKmwicMDAticRia0rxA/0', '2017-12-01', null, '12980', '20171201/209.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('210', '言立明', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLrhI3tFPRHPmr1HYNf60EDESBoiaCvIuCaZ9RtCCdjia3TwKvKo0Jpcia1G1ibxu1jceQZibBm7cicHLkQ/0', '2017-12-01', null, '25960', '20171201/210.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('211', '༺༼࿅࿆奇美拉姆࿄࿆༽༻', '', '女', 'Shanghai', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eolibHibbzicClicXGNQ0qvFyQxibEricRmDkoUNFzJpibuicGbH0IFON2tNEBgBwpoiaxYjTXINwaibSceiaDNQ/0', '2017-12-01', null, '198000', '20171201/211.png', null, '60');
INSERT INTO `mall_user_detail` VALUES ('212', '杨兴斌___达州', '', '男', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKCdzkWetV6xz9NVTA7jDOOqQbry4X4u39dz3xZNiaVS2xsIaEAmYMgWv1sDDDZ9ziaF0UpjrB6GnDw/0', '2017-12-01', null, '12980', '20171201/212.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('213', '台湾 郑先生 健康管理 15962440', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/6a4gibhkbrqEGib6N8Ga2XBNFQiaAnHdWHpPxcm1nMqjxziaEs10tYIAJfJQORRzd2HnoqkJiah0OmksuMv8YWkcoyA/0', '2017-12-01', null, '12980', '20171201/213.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('214', '忘不了的味道', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLkWoiaXhl4tWugUtm71m09R3GbmgV3KotrVRUFeEUhkWp59rgmKj2GCMLQ2oTcV4ibx4xm6PiaIlzew/0', '2017-12-01', null, '0', '20171201/214.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('215', '芳铃', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/lnfzMT7DeZC9C5kNPBAtJv8hGKNRC6pYzXibo47UzGhU2lGAvhcF9HWBtoyYPB8iaicZx5qmNib2d7r7kpMibGGLD6Q/0', '2017-12-01', null, '0', '20171201/215.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('216', '智慧◎祝福', '', '男', '', 'http://wx.qlogo.cn/mmopen/vi_32/Wps7nuvHDicRC6bbLUXicblbPxzKOEuL8Qsr8wH886ERQKz7xPnibOWlTFnwhs20xke8vu1X50ARoqWLhQcicKIE1w/0', '2017-12-01', null, '198000', '20171201/216.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('219', '我和你', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJH3dribPS9Aibq0u1WZjEQalLPAhRbDE5QAts52YjUwwMZyPFtKHwsXNL4IySfoTCeHRUbPDauSPuA/0', '2017-12-01', null, '0', '20171201/219.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('221', '竹海', '', '男', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJmibVfoScf2lPV6S4FHOu7Iv72Wgiau15Jhr2CTBnBHujD0d7jR0U6IyBTPiaoGrbbE7POvibX8XibWWg/0', '2017-12-01', null, '0', '20171201/221.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('220', 'super娜', '', '女', 'Victoria', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIxNRv9KERly31jic2JGosAMad5wAaBOGpSbOwibzUkiapsLUticuusQznMSFRkqIuSrwQoWKgIic8nR6g/0', '2017-12-01', null, '198000', '20171201/220.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('223', '苏州伊钻祛斑～签不反弹合约', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoeca6DAKEAlh8Vy10faFw0Niamox5W1WBf6rQiaDGzoqKMlX5wv4zayvxloHRVWtTyHs5E9OktGSEg/0', '2017-12-01', null, '0', '20171201/223.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('224', '马新平', '', '女', 'Jiangsu', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqKLria7oX5323jYJb839qA4RGLyPYW1UmohDOhu1icGwhn5n9MMfzNLVry12UNCuhJEuSLCibPWdpcA/0', '2017-12-01', null, '0', '20171201/224.png', null, null);
INSERT INTO `mall_user_detail` VALUES ('231', '小可爱', '个性签名', '男', '河南', '', null, null, '0', null, '', '11');
SET FOREIGN_KEY_CHECKS=1;
