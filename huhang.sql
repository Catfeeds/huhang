/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 100119
 Source Host           : localhost:3306
 Source Schema         : huhang

 Target Server Type    : MySQL
 Target Server Version : 100119
 File Encoding         : 65001

 Date: 15/08/2018 17:14:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for huhang_activity
-- ----------------------------
DROP TABLE IF EXISTS `huhang_activity`;
CREATE TABLE `huhang_activity`  (
  `act_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '平台活动自增id',
  `act_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '活动编号',
  `act_p_id` int(11) DEFAULT NULL COMMENT '省份id',
  `act_c_id` int(11) DEFAULT NULL COMMENT '城市id',
  `act_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '活动主题',
  `act_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '活动封面图',
  `act_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片alt',
  `act_url` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '活动外链',
  `act_address` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '活动地址',
  `act_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '活动内容',
  `act_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `act_starttime` int(11) DEFAULT NULL COMMENT '开始时间',
  `act_endtime` int(11) DEFAULT NULL COMMENT '结束时间',
  `act_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `act_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1，显示；2，隐藏',
  `act_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶： 1，置顶；2常规',
  `act_view` int(10) DEFAULT 0 COMMENT '活动热度',
  `act_sign_num` int(10) DEFAULT 0 COMMENT '报名人数',
  `act_admin` int(10) DEFAULT NULL COMMENT '管理员id',
  PRIMARY KEY (`act_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '平台活动表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_activity
-- ----------------------------
INSERT INTO `huhang_activity` VALUES (1, '201807210001', 1, 56, '炎炎夏日，冰爽一夏123', '/uploads/activity/20180721/545bbeaecfa1204433b0d1cab8a969cc.jpg', '123123', '12', '陕西省西安市未央区大明宫遗址公园', '<p>公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！</p><p>1、公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！</p><p>2、公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！</p><p>3、公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！</p><p>4、公装护航网官方平台活动创业季豪礼不断，装修送办公家具活动开始啦！</p>', 1532139221, 1530547200, 1532534399, 1533362441, 1, 1, 0, 0, 1);
INSERT INTO `huhang_activity` VALUES (3, '201807210003', 1, 56, '炎炎夏日，冰爽一夏', '/uploads/activity/20180721/8e0c9b05551cf35d57b2f91012815b8d.png', '123123', '123', '陕西省西安市未央区大明宫遗址公园', '12321', 1532140838, 1530547200, 1532534399, 1532140838, 1, 1, 0, 0, 1);

-- ----------------------------
-- Table structure for huhang_activity_sign
-- ----------------------------
DROP TABLE IF EXISTS `huhang_activity_sign`;
CREATE TABLE `huhang_activity_sign`  (
  `sign_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动报名表自增id',
  `sign_m_id` int(11) DEFAULT NULL COMMENT '参加报名的商户id',
  `sign_act_id` int(10) DEFAULT NULL COMMENT '报名的活动id',
  `sign_link_person` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '联系人',
  `sign_link_phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '联系人电话',
  `sign_addtime` int(11) DEFAULT NULL COMMENT '报名时间',
  `sign_updatetime` int(11) DEFAULT NULL COMMENT '后台处理时间',
  `sign_admin` int(10) DEFAULT NULL COMMENT '处理人id,平台处理人',
  `sign_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '处理备注',
  PRIMARY KEY (`sign_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '活动报名表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_activity_sign
-- ----------------------------
INSERT INTO `huhang_activity_sign` VALUES (1, 2, 1, '1582', '1582222333', 1533364217, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for huhang_admin
-- ----------------------------
DROP TABLE IF EXISTS `huhang_admin`;
CREATE TABLE `huhang_admin`  (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `ad_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '员工编号',
  `ad_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '密码',
  `ad_realname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '员工真实姓名',
  `ad_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员邮箱，用于登录',
  `ad_branch` int(10) DEFAULT NULL COMMENT '归属站点，对应站点id',
  `ad_p_id` int(11) DEFAULT NULL COMMENT '管理员省份id',
  `ad_c_id` int(11) DEFAULT NULL COMMENT '管理员城市id',
  `ad_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员手机号，用于登录',
  `ad_qq` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员QQ号码',
  `ad_birth` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '出生年月日',
  `ad_sex` tinyint(2) DEFAULT 3 COMMENT '性别；1 男；2 女； 3 未知',
  `ad_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员图像',
  `ad_createtime` int(11) DEFAULT NULL COMMENT '开通时间',
  `ad_isable` tinyint(2) DEFAULT NULL COMMENT '是否在职 1 在职；2 离职',
  `ad_role` int(11) DEFAULT NULL COMMENT '权限，对应权限的id',
  `ad_admin` int(255) DEFAULT NULL COMMENT '操作人，对应管理员id',
  PRIMARY KEY (`ad_id`, `ad_phone`, `ad_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_admin
-- ----------------------------
INSERT INTO `huhang_admin` VALUES (1, '201806010001', 'e10adc3949ba59abbe56e057f20f883e', '夜微凉', '1549089944@qq.com', 0, 1, 3, '13891022675', '31123123', '2010-05-18', 1, '/uploads/20180519/9c478cec4a8460e814d8b2a20bb94ae5.jpg', 1525592904, 1, 1, 1);
INSERT INTO `huhang_admin` VALUES (20, '201806010002', 'e10adc3949ba59abbe56e057f20f883e', '徐燕萍', '1091056353@qq.com', 22, 1, 3, '18292927635', '123', '2006-05-16', 2, '/uploads/20180519/f48beac456a6a199a1aa680c0e75fbf0.jpg', 1525922417, 1, 12, 1);
INSERT INTO `huhang_admin` VALUES (6, '201806010003', 'e10adc3949ba59abbe56e057f20f883e', '张美娟', '2469792307@qq.com', 22, 1, 3, '15332335773', '123123', '1997-05-19', 2, '/uploads/20180519/d123cb5ebc64bb297887d0955c31c3c9.jpg', 1525767570, 1, 6, 1);
INSERT INTO `huhang_admin` VALUES (21, '201806010005', 'e10adc3949ba59abbe56e057f20f883e', '曾志腾', '911036704@qq.com', 22, 1, 3, '18292668778', NULL, NULL, 1, '/uploads/20180506/2eb695a99f106b4265100dd3d9ebee14.jpg', 1525924852, 1, 9, NULL);
INSERT INTO `huhang_admin` VALUES (23, '201806010007', 'e10adc3949ba59abbe56e057f20f883e', '贺晓乐', '15588889999@qq.com', 25, 1, 2, '13689265844', '2133123', '1996-05-19', 2, '/uploads/20180519/9dc2dafd4cbeb18dbd832443db1296df.jpg', 1526621968, 1, 6, 1);
INSERT INTO `huhang_admin` VALUES (30, '201806070001', 'e10adc3949ba59abbe56e057f20f883e', '杨玲', '1163578447@qq.com', 22, 1, 3, '18291950220', NULL, NULL, 2, '/uploads/20180506/2eb695a99f106b4265100dd3d9ebee14.jpg', 1528354917, 1, 12, 1);

-- ----------------------------
-- Table structure for huhang_alisign
-- ----------------------------
DROP TABLE IF EXISTS `huhang_alisign`;
CREATE TABLE `huhang_alisign`  (
  `ali_sign_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '阿里短信签名id',
  `ali_sign_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阿里短信签名名称',
  `ali_sign_remarks` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '描述说明',
  `ali_sign_addtime` int(11) DEFAULT NULL COMMENT '签名添加时间',
  `ali_sign_admin` int(10) DEFAULT NULL COMMENT '添加人',
  `ali_sign_able` tinyint(2) DEFAULT NULL COMMENT '是否可用 1 是  2  否',
  PRIMARY KEY (`ali_sign_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '阿里云短信签名' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_answer
-- ----------------------------
DROP TABLE IF EXISTS `huhang_answer`;
CREATE TABLE `huhang_answer`  (
  `qaa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '问答回答自增id',
  `qaa_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '回复编号',
  `qaa_question` int(10) DEFAULT NULL COMMENT '回答问题的id',
  `qaa_answer` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '回复内容',
  `qaa_addtime` int(11) DEFAULT NULL COMMENT '回答时间',
  `qaa_istop` tinyint(2) DEFAULT NULL COMMENT '是否置顶；1置顶；2正常',
  `qaa_isable` tinyint(2) DEFAULT NULL COMMENT '是否显示，审核通过就1显示，不通过就不2显示',
  `qaa_status` tinyint(255) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `qaa_admin` int(255) DEFAULT NULL COMMENT '审核人',
  `qaa_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '回复人ip',
  `qaa_type` tinyint(255) DEFAULT NULL COMMENT '回复类型：1。平台回复；2.客户回复',
  `qaa_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  PRIMARY KEY (`qaa_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '问题回复表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_answer
-- ----------------------------
INSERT INTO `huhang_answer` VALUES (8, '201808030003', 6, '你猜还有几个？123', 1533279916, NULL, 1, 1, 2, NULL, 1, NULL);
INSERT INTO `huhang_answer` VALUES (7, '201808030002', 6, '这个我也不知道啊，要问问库管的。', 1533279655, NULL, 1, 2, 2, NULL, 1, NULL);
INSERT INTO `huhang_answer` VALUES (5, '201807190001', 4, 'qewqwewrwqer', 1531964929, 2, 1, 2, 1, NULL, 1, NULL);
INSERT INTO `huhang_answer` VALUES (9, '201808150001', 5, '千百炼装饰，是一家集装饰设计、施工、家具、家电等服务为一体，并以全球集采平台整合国内外大牌主材的整体家装集团企业。\r\n\r\n成立于2014年12月，现已覆盖西安、昆明、武汉、宝鸡、贵阳、成都等全国多个中心城市。', 1534311773, 2, 1, 2, 1, NULL, 1, '');
INSERT INTO `huhang_answer` VALUES (10, '201808150002', 4, '千百炼主材都是国际国内主流品牌，辅料全德系，都是达到高环保级别认证的，像我们用的乳胶漆是德国百年品牌“都芳”，采用0毒害技术+国际认证。\r\n\r\n同时我们公司还会和客户签订装修协议，如果环保不达标我们负责到底，所以环保方面您是可以完全放心的。', 1534311807, 1, 1, 2, 1, NULL, 1, '');

-- ----------------------------
-- Table structure for huhang_area
-- ----------------------------
DROP TABLE IF EXISTS `huhang_area`;
CREATE TABLE `huhang_area`  (
  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '添加人',
  `p_id` int(11) DEFAULT NULL COMMENT '省份id',
  `c_id` int(11) DEFAULT NULL COMMENT '城市id',
  `a_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '县区名称',
  `a_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `a_admin` int(11) DEFAULT NULL COMMENT '添加人',
  PRIMARY KEY (`a_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '县区表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_area
-- ----------------------------
INSERT INTO `huhang_area` VALUES (1, 1, 56, '未央区', 1531822506, 1);
INSERT INTO `huhang_area` VALUES (2, 1, 56, '新城区', 1531904335, 1);
INSERT INTO `huhang_area` VALUES (3, 1, 56, '新城区', 1531905392, 1);
INSERT INTO `huhang_area` VALUES (4, 1, 56, '长安区', 1531904349, 1);
INSERT INTO `huhang_area` VALUES (5, 1, 56, '碑林区', 1531905413, 1);
INSERT INTO `huhang_area` VALUES (6, 1, 56, '莲湖区', 1531905430, 1);
INSERT INTO `huhang_area` VALUES (7, 1, 56, '灞桥区', 1531905442, 1);
INSERT INTO `huhang_area` VALUES (8, 1, 56, '雁塔区', 1531905456, 1);
INSERT INTO `huhang_area` VALUES (9, 1, 56, '高新区', 1531905480, 1);
INSERT INTO `huhang_area` VALUES (10, 1, 56, '经济技术开发区', 1531905539, 1);
INSERT INTO `huhang_area` VALUES (11, 1, 56, '曲江新区', 1531905514, 1);
INSERT INTO `huhang_area` VALUES (12, 1, 56, '浐灞生态区', 1531905528, 1);
INSERT INTO `huhang_area` VALUES (13, 1, 56, '沣东新城', 1531905555, 1);
INSERT INTO `huhang_area` VALUES (14, 1, 56, '阎良区', 1531905577, 1);
INSERT INTO `huhang_area` VALUES (15, 1, 56, '高陵区', 1531905592, 1);
INSERT INTO `huhang_area` VALUES (16, 1, 56, '国际港务区', 1531905610, 1);
INSERT INTO `huhang_area` VALUES (17, 1, 56, '国家民用航天基地', 1531905627, 1);
INSERT INTO `huhang_area` VALUES (18, 1, 56, '国家航空高技术产业基地', 1531905649, 1);
INSERT INTO `huhang_area` VALUES (19, 1, 56, '蓝田县', 1531905674, 1);
INSERT INTO `huhang_area` VALUES (20, 1, 56, '周至县', 1531905682, 1);
INSERT INTO `huhang_area` VALUES (21, 1, 56, '鄠邑区', 1531905694, 1);

-- ----------------------------
-- Table structure for huhang_article
-- ----------------------------
DROP TABLE IF EXISTS `huhang_article`;
CREATE TABLE `huhang_article`  (
  `art_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `art_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章编号。系统还是能成的编号，规则同客户编号生成规则',
  `art_p_id` int(10) DEFAULT NULL COMMENT '文章省份',
  `art_c_id` int(10) DEFAULT NULL COMMENT '文章城市',
  `art_b_id` int(10) DEFAULT NULL COMMENT '文章站点',
  `art_m_id` int(10) DEFAULT NULL COMMENT '文章商户',
  `art_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '关键词 同seo关键词',
  `art_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '文章标题 同seo标题',
  `art_subtitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '文章子标题 同seo 描述',
  `art_type` tinyint(2) DEFAULT NULL COMMENT '文章分类，关联类型参数表的type_sort= 4  的数据',
  `art_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '文章封面图',
  `art_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '封面图alt',
  `art_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '文章内容',
  `art_createtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `art_updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `art_view` int(11) DEFAULT 0 COMMENT '浏览量',
  `art_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示，1是，2否',
  `art_status` tinyint(2) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `art_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶，1是，2否',
  `art_admin` int(10) DEFAULT NULL COMMENT '发布人，对应管理员的id',
  `art_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  PRIMARY KEY (`art_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文章' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_article
-- ----------------------------
INSERT INTO `huhang_article` VALUES (1, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 110, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532166169, 1532166169, 27, 1, 2, 2, 1, '');
INSERT INTO `huhang_article` VALUES (2, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 2, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (3, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 2, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (4, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (5, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (6, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (7, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (8, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (9, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 1, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (10, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (11, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (12, '201807210001', 1, 56, NULL, 9, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (13, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (14, '201807210001', 1, 56, NULL, 1, '水漆时代，西安装修', '“水漆时代”离我们还有多远？', '作为家庭装修装饰过程中不可或缺的材料，油漆对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。', 111, '/uploads/article/20180721/c21f295b97e1c03fc63aa5fe7cd68061.png', '', '<p>作为<a href=\"http://zixun.jia.com/tag/2626/\" target=\"_blank\">家庭装修</a>装饰过程中不可或缺的材料，油<a href=\"http://zixun.jia.com/tag/2596/\" target=\"_blank\">漆</a>对于大多数消费者而言并不陌生。然而近年来，随着国家治污力度的加强、人们环保意识的提升，以环保安全著称的水性漆悄然崛起，“水进油退”似乎已成大势所趋。但与此同时，水性漆在发展过程中仍面临着许多困难。“水漆时代”离我们还有多远?</p><p><span><span>环保需求呼唤水漆到来</span></span></p><p>环保需求呼唤水性漆“逆袭” 众所周知，<a href=\"http://zixun.jia.com/tag/1720/\" target=\"_blank\">油漆</a>一般含有大量的的苯、甲醛等有害物质，而这些有害物质往往就来源于油漆的溶剂。油漆通常以有毒、有污染的溶剂(如天拿水、香蕉水)为稀释剂，其释放的有害物质不仅会对人体健康造成威胁，还会对环境造成污染。</p><p>而水性漆与油漆的根本区别就在于水性漆是以水作溶剂，不燃不爆，无毒无刺激气味，对人体无害，符合环保要求。</p><p>近年来，随着各种环境问题频发，人们对环境的关注度在不断提高的同时，环保意识也不断增强。绿色环保成为不少商品的卖点，而环保家装也成了不少消费者的重点诉求。</p><p>当然除了消费者之外，环保问题还牵动着社会上每个人的心。曲美<a href=\"http://zixun.jia.com/tag/2574/\" target=\"_blank\">家具</a>集团董事长赵瑞海曾表示：“现在这个时代，环境问题是决定生死的问题，而不仅仅是决定发展的问题，对于每一个有社会责任感的企业来说，环保都不是一个可选项，而是一个必选项。”</p><p><span><span>政策支持推动了“水进油退”</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi12.jia.com/112/375/12375955.jpg\"></p><p>近期，各地关于鼓励水性漆使用的政策纷纷出台。而于7月19日正式实施的《杭州市2014年大气污染防治实施计划》中更提到，民用建筑内外墙体<a href=\"http://zixun.jia.com/tag/2599/\" target=\"_blank\">涂料</a>强制使用水性涂料，家庭装修倡导使用水性涂料，全市民用建筑内外墙体水性涂料的使用率达到65%。这无疑将极大地推动了“水进油退”的进程。据了解，目前市面上的家庭内墙乳胶漆大都为水性漆，而除了承诺全线产品将启用水性漆生产的曲美<a href=\"http://zixun.jia.com/tag/2555/\" target=\"_blank\">家居</a>外，等家居<a href=\"http://zixun.jia.com/tag/pinpai/\" target=\"_blank\">品牌</a>，百强家具、天坛家具等家居品牌，在产品上也都不同程度地使用水性漆。</p><p>而由国家环保部新修订，并在今年7月1日正式实施的《环境标志产品技术要求 水性涂料》，不仅重新明确了水性涂料的有害物质限量要求，调整了不得人为添加的物质要求，还提高了挥发性有机化合物(VOC)、苯、甲苯等总量限量要求。专家指出，在新标准的指导下，水性漆行业将向更环保、更安全的方向发展。</p><p><span><span>性能缺陷是发展受限的主因</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375957.jpg\"></p><p>水性漆拥有许多油漆无法比拟的优势，但为什么“油水之争”一直僵持不下呢?事实上，水性漆在市场上未能得到充分发展最大的原因就在于产品本身性能、技术上的限制。</p><p>有专家指出，水性漆用水来替代过去的有机溶剂，尽管在环保性能上具有明显优越性，但却在物理性能上做出了牺牲，水性漆普遍存在耐水性差、对抗强机械作用力的分散稳定性差等缺陷。</p><p>而这就要求涂料企业在技术研发、生产设备等方面的不断改善和提高。据了解，目前国内一些起步较早的涂料企业的水性漆生产技术已经相对成熟，部分甚至突破了水性漆从做样板到设备批量化生产的最难攻坚，能够实现在稳定品质下的产品量产。不难想象，随着技术的发展，水性漆的缺陷也会被逐一解决。</p><p><span><span>施工要求高制约水性漆推广</span></span></p><p><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375958.jpg\"></p><p>涂装行业有一种说法叫“三分涂料,七分涂装”，意在表明涂装服务在涂料产品呈现过程中所起到的重大作用。而这句话的在水性漆上同样适用，由于受到性能、技术等因素的限制，水性漆的施工环境条件要求较严格，施工材质表面清洁度要求高，对涂装设备腐蚀性也较大。这都使得水性漆的推广受到阻碍。</p><p>施工要求高制约水漆发展 尽管有业内人士指出，油漆要能达到的平整光滑的效果，水性漆完全可以达到。但由于目前许多涂料企业普遍存在“重销售，轻服务”的观念，更多地将精力投入到产品升级、业务扩展上，而涂装服务并未得到应有的重视。所以尽管涂料本身没有问题，但由于涂装服务进行得不顺利，而最终导致涂装效果不佳，由此亦使水性漆遭受消费者质疑。</p><p><span><span>材料成本高阻碍水性漆发展</span></span></p><p style=\"text-align: center;\"><img alt=\"\" src=\"http://tgi13.jia.com/112/375/12375959.jpg\"></p><p>笔者走访家装涂料市场，发现市面上水性漆的零售价格普遍要比传统油漆高，而一些水性木器漆的价格更是要比油性木器漆高出的2倍以上。</p><p>但有业内人士指出，由于油漆要还要兑20%的稀料才能施工，而购买稀料需要增加成本，而水性漆只需要加入水，所以总体算下来，水性漆的价格未必就比油漆高。</p><p>当然，成本的控制最终还是要回归到水性漆生产过程中的技术创新问题。怎样才能够在确保水性漆质量的基础上，提高生产效率，降低产品价格，吸引更多消费者选择水性漆，是值得涂料企业深思的问题。</p><p><span><span>点评：</span></span>尽管得到了政策的支持与群众的呼声，但“水进油退”之路注定不是一帆风顺的，正如同环保事业不是一蹴而就的，而是一个需要长期坚持、不断努力的过程。而唯有人人将环保理念深深植根于心中，并付诸力所能及的行动，“水漆时代”才能早日到来，从而推动环境问题的改善和解决。</p>', 1532162541, 1532162541, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (15, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 4, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (16, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (17, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (18, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 1, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (19, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (20, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (21, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (22, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (23, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (24, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (25, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (26, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (27, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (28, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (29, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (30, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 1, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (31, '201807210015', 1, 56, NULL, 1, '装修日记', '中木《装修日记》视频拍摄', '临近春节，用一个新的面貌去迎接新年是每一位中国人不变的传统。住了多年的旧房子，墙面起皮、墙纸翘边都不可避免的影响了整体效果。怎样才能让爱家快速的焕然一新，环保、快装的中木集成墙板成为了消费者们争相选择的热点产品！', 110, '/uploads/article/20180721/ac827ea3839d3fa3ae5bbf4cdbcfd9d1.png', '123123', '<p><span>为了让消费者更加直观的了解到中木集成墙板的装修过程和实际装修效果，中木品牌运营中心从武汉直营店“百城百家”样板间征集活动中收集到的众多报名者中，选择了一个“旧房改造”的案例，全程跟踪拍摄，并在装修完成后实时检测空间内的甲醛含量。用事实说话，真正做到让消费者放心装修，安心入住！</span></p><p><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/78d5cdc1f05843a68e912e2757108ccf.gif\"></p><p><span>1月17日，正式开工啦！施工人员开始了火热朝天的装修工作，所有装修过程都被摄像机清晰的记录了下来！</span></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/aeb1c956b2e74f4a9fed32149943299e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bad34581dcce43ac8a1a044333bfcdd1.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/33023119db014baa8fd6513c8b8b63a2.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/bc08342879a749a396a090117456411e.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/579235544fbe45a89f2f709c41552008.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/cd3fd6645d6e43cd9f2ae066b24862ad.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/816a168943f4473ea1fe1b06befe15d7.jpeg\"></p><p style=\"text-align: center;\"><img src=\"http://5b0988e595225.cdn.sohucs.com/images/20180125/82e950b8c21e4a78b9ca7faf2ba9f524.jpeg\"></p><p style=\"text-align: center;\">装修临近收尾</p><p style=\"text-align: center;\">敬请期待成片效果</p>', 1532164117, 1532164117, 0, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (32, '201807260001', 1, 56, NULL, 2, '', '贵州安龙国家山地户外运动示范公园游客服务中心', '安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公', 110, '/uploads/article/20180726/1c71fc45062c8444dd930499e0cd9c78.jpg', '', '<p><span>安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、<img src=\"/uploads/layui/20180731/1371539e57ff743d20ffe7dea3ee06c9.png\" alt=\"undefined\">热气球、滑翔伞、水上运动、越野车等户外<img src=\"/uploads/layui/20180731/ff1d253d979c6b55da0bdc9dc005bc32.png\" alt=\"undefined\">极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公园游客服务中心。</span></p><p><span style=\"text-align: center;\">鸟瞰图</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/7a8f0e8f4bbed95068df985cd9783bff.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">显和隐</span></p><p><span><span class=\"Apple-converted-space\"> </span>游客服务中心位于谷底的一座小山丘顶上。小山丘是谷底唯一的高点，具有良好的视线，本身也极为醒目。选择在这里建造游客中心，除了希望建筑成为谷底的视觉焦点之外，还因为这里的地势最高，可以抵御每年雨季河流涨水淹没建筑的危险。实际上，当地没有确切的水文资料，建筑师只能根据当地人的口述，确定建筑的地板高度，这也是建筑被设计建造在一个架高的平台上的原因。因为建筑选址的特殊性，建筑师需要首先解决的问题就是建筑和环境的关系。在建筑师看来，峡谷的风景是极具力量感的，也应该是整个公园的绝对主角，而建筑应该首先融入环境，然后才是利用自身的特征为整个谷底点睛。因此，如何处理好建筑的显隐问题就成为了设计的起点。</span></p><p><span style=\"text-align: center;\">建筑插入山石之间，如同从山石中生长出来</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9885b9ece8678ecced101e065d9bf5d4.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9f0e087fe37e13aa7e0f7ac9ef6f742d.jpg\" alt=\"undefined\"><br></span></p><p><span>在实地勘察中，设计师发现小山顶部并不是平的。山顶有四组山石高起，而高起的山石之间自然形成了若干个小高地。设计师把建筑打散，形成若干个小的单体，并将它们体藏在这些小高地中。建筑自然的避让原有场地中的山石，并和山石形成一种共生关系：藏身于山石，又从山石的缝隙中伸出来，若隐若现。建筑的形式并不刻意的追求新奇，仍然沿用了贵州黔西南地区的双坡顶民居形式，立面材料也尽量选择本地的石材为主。设计师不希望建筑过于彰显，除了对周边环境的尊敬外，也深知即使卖力的表现也无法和周边的大山大水争锋。</span></p><p><span style=\"text-align: center;\">建筑被抬起，既解决了季节性涨水对建筑的威胁，又尽量减少对环境的破坏</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9507d4e271fefb0e8f0c31b145aea9c7.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">山谷壮美的景色为游客服务中心提供了丰富的景观面</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/482a56bf5bc9fd4952c3d1282bd43e15.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑立面材料尽量采用地域性材料，与环境和谐共处</span></p><p><span style=\"text-align: center;\">内和外</span></p><p><span>游客服务中心由接待站、西餐厅（“红点餐厅”）、酒吧（“仙掌酒吧”）和会议室（“磐石会议中心”）四座建筑组成，其总体布局围绕着基地上的山石展开，呈现出一种外观和内聚共存的状态。</span></p><p><span style=\"text-align: center;\">m亭，红点餐厅和仙掌酒吧围合成的室外空间构成游客公共活动的场所</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/989d00ed29fcc9278afea7a3655d9b90.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">当地布依族妇女在m亭休息</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c35ff8e609c5448093884aa3b2d64361.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从仙掌酒吧看m亭</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/f46227485b25a21de231d952d508f04f.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/12a2c676b176e93a193ef0f5107d20c1.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/e3169360676a0b70ed7fb2073e4a9eca.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑与环境和谐共处</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c3442d1b21f7e6127931f10bd71b3c27.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">仙掌酒吧室内空间</span></p><p><span>外观，指每栋建筑都具有很好的观景面，通过落地玻璃，山谷的壮美景色可以被收入建筑室内，使游客中心和山谷形成共鸣。人坐在建筑室内或者屋檐下，通过视线与谷底远处的岩壁、河流、大地交流，并融入其中。内聚，指建筑与建筑之间，建筑与被其围绕的山石之间形成的内向的聚合。这种聚合被一个高架的平台功能化，明确化。平台不仅在汛期很好的解决了建筑主体的防洪问题，也是串联建筑与建筑的室外空间。除了会议室，接待站、西餐厅和咖啡厅的入口都指向室外平台，这里是未来游客交流，与山石亲密互动的主要空间。平台中部，半室外的凉亭进一步加强了平台的聚集性，设计师希望这里可以成为游客中心最具活力的地点。</span></p><p><strong style=\"text-align: center;\">项目信息</strong><br style=\"text-align: center;\"><span style=\"text-align: center;\">项目名称：安龙国家山地户外运动示范公园游客服务中心<br></span><span style=\"text-align: center;\">项目地点：贵州省黔西南布依族苗族自治州安龙县笃山镇<br></span><span style=\"text-align: center;\">业主：安龙县荷韵旅游文化发展有限责任公司<br></span><span style=\"text-align: center;\">建筑设计：三文建筑/何崴工作室<br></span><span style=\"text-align: center;\">主持建筑师：何崴<br></span><span style=\"text-align: center;\">设计团队：陈龙、米健、孙琪、赵卓然、宋珂、吴前铖<br></span><span style=\"text-align: center;\">项目顾问：聂建，王滨<br></span><span style=\"text-align: center;\">建筑面积：1400平方米<br></span><span style=\"text-align: center;\">设计时间：2016年4月-2016年7月<br></span><span style=\"text-align: center;\">建造时间：2016年7月-2017年7月<br></span><span style=\"text-align: center;\">驻场工程师：靳雷柱，何秀根<br></span><span style=\"text-align: center;\">合作单位：北京山岳美途体育文化有限公司<br></span><span style=\"text-align: center;\">室内施工图设计：北京鸿尚国际设计有限公司<br></span><span style=\"text-align: center;\">室内家具品牌：天一美家<br></span><span style=\"text-align: center;\">摄影师：金伟琦</span></p>', 1532597598, 1533005176, 41, 1, 2, 2, 2, '');
INSERT INTO `huhang_article` VALUES (33, '201807260001', 1, 56, NULL, 2, NULL, '贵州安龙国家山地户外运动示范公园游客服务中心', '安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公', 111, '/uploads/article/20180726/1c71fc45062c8444dd930499e0cd9c78.jpg', NULL, '<p><span>安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公园游客服务中心。</span></p><p><span style=\"text-align: center;\">鸟瞰图</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/7a8f0e8f4bbed95068df985cd9783bff.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">显和隐</span></p><p><span><span class=\"Apple-converted-space\"> </span>游客服务中心位于谷底的一座小山丘顶上。小山丘是谷底唯一的高点，具有良好的视线，本身也极为醒目。选择在这里建造游客中心，除了希望建筑成为谷底的视觉焦点之外，还因为这里的地势最高，可以抵御每年雨季河流涨水淹没建筑的危险。实际上，当地没有确切的水文资料，建筑师只能根据当地人的口述，确定建筑的地板高度，这也是建筑被设计建造在一个架高的平台上的原因。因为建筑选址的特殊性，建筑师需要首先解决的问题就是建筑和环境的关系。在建筑师看来，峡谷的风景是极具力量感的，也应该是整个公园的绝对主角，而建筑应该首先融入环境，然后才是利用自身的特征为整个谷底点睛。因此，如何处理好建筑的显隐问题就成为了设计的起点。</span></p><p><span style=\"text-align: center;\">建筑插入山石之间，如同从山石中生长出来</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9885b9ece8678ecced101e065d9bf5d4.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9f0e087fe37e13aa7e0f7ac9ef6f742d.jpg\" alt=\"undefined\"><br></span></p><p><span>在实地勘察中，设计师发现小山顶部并不是平的。山顶有四组山石高起，而高起的山石之间自然形成了若干个小高地。设计师把建筑打散，形成若干个小的单体，并将它们体藏在这些小高地中。建筑自然的避让原有场地中的山石，并和山石形成一种共生关系：藏身于山石，又从山石的缝隙中伸出来，若隐若现。建筑的形式并不刻意的追求新奇，仍然沿用了贵州黔西南地区的双坡顶民居形式，立面材料也尽量选择本地的石材为主。设计师不希望建筑过于彰显，除了对周边环境的尊敬外，也深知即使卖力的表现也无法和周边的大山大水争锋。</span></p><p><span style=\"text-align: center;\">建筑被抬起，既解决了季节性涨水对建筑的威胁，又尽量减少对环境的破坏</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9507d4e271fefb0e8f0c31b145aea9c7.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">山谷壮美的景色为游客服务中心提供了丰富的景观面</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/482a56bf5bc9fd4952c3d1282bd43e15.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑立面材料尽量采用地域性材料，与环境和谐共处</span></p><p><span style=\"text-align: center;\">内和外</span></p><p><span>游客服务中心由接待站、西餐厅（“红点餐厅”）、酒吧（“仙掌酒吧”）和会议室（“磐石会议中心”）四座建筑组成，其总体布局围绕着基地上的山石展开，呈现出一种外观和内聚共存的状态。</span></p><p><span style=\"text-align: center;\">m亭，红点餐厅和仙掌酒吧围合成的室外空间构成游客公共活动的场所</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/989d00ed29fcc9278afea7a3655d9b90.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">当地布依族妇女在m亭休息</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c35ff8e609c5448093884aa3b2d64361.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从仙掌酒吧看m亭</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/f46227485b25a21de231d952d508f04f.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/12a2c676b176e93a193ef0f5107d20c1.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/e3169360676a0b70ed7fb2073e4a9eca.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑与环境和谐共处</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c3442d1b21f7e6127931f10bd71b3c27.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">仙掌酒吧室内空间</span></p><p><span>外观，指每栋建筑都具有很好的观景面，通过落地玻璃，山谷的壮美景色可以被收入建筑室内，使游客中心和山谷形成共鸣。人坐在建筑室内或者屋檐下，通过视线与谷底远处的岩壁、河流、大地交流，并融入其中。内聚，指建筑与建筑之间，建筑与被其围绕的山石之间形成的内向的聚合。这种聚合被一个高架的平台功能化，明确化。平台不仅在汛期很好的解决了建筑主体的防洪问题，也是串联建筑与建筑的室外空间。除了会议室，接待站、西餐厅和咖啡厅的入口都指向室外平台，这里是未来游客交流，与山石亲密互动的主要空间。平台中部，半室外的凉亭进一步加强了平台的聚集性，设计师希望这里可以成为游客中心最具活力的地点。</span></p><p><strong style=\"text-align: center;\">项目信息</strong><br style=\"text-align: center;\"><span style=\"text-align: center;\">项目名称：安龙国家山地户外运动示范公园游客服务中心<br></span><span style=\"text-align: center;\">项目地点：贵州省黔西南布依族苗族自治州安龙县笃山镇<br></span><span style=\"text-align: center;\">业主：安龙县荷韵旅游文化发展有限责任公司<br></span><span style=\"text-align: center;\">建筑设计：三文建筑/何崴工作室<br></span><span style=\"text-align: center;\">主持建筑师：何崴<br></span><span style=\"text-align: center;\">设计团队：陈龙、米健、孙琪、赵卓然、宋珂、吴前铖<br></span><span style=\"text-align: center;\">项目顾问：聂建，王滨<br></span><span style=\"text-align: center;\">建筑面积：1400平方米<br></span><span style=\"text-align: center;\">设计时间：2016年4月-2016年7月<br></span><span style=\"text-align: center;\">建造时间：2016年7月-2017年7月<br></span><span style=\"text-align: center;\">驻场工程师：靳雷柱，何秀根<br></span><span style=\"text-align: center;\">合作单位：北京山岳美途体育文化有限公司<br></span><span style=\"text-align: center;\">室内施工图设计：北京鸿尚国际设计有限公司<br></span><span style=\"text-align: center;\">室内家具品牌：天一美家<br></span><span style=\"text-align: center;\">摄影师：金伟琦</span></p>', 1532589062, 1532589061, 20, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (34, '201807260001', 1, 56, NULL, 2, NULL, '贵州安龙国家山地户外运动示范公园游客服务中心', '安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公', 110, '/uploads/article/20180726/1c71fc45062c8444dd930499e0cd9c78.jpg', NULL, '<p><span>安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公园游客服务中心。</span></p><p><span style=\"text-align: center;\">鸟瞰图</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/7a8f0e8f4bbed95068df985cd9783bff.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">显和隐</span></p><p><span><span class=\"Apple-converted-space\"> </span>游客服务中心位于谷底的一座小山丘顶上。小山丘是谷底唯一的高点，具有良好的视线，本身也极为醒目。选择在这里建造游客中心，除了希望建筑成为谷底的视觉焦点之外，还因为这里的地势最高，可以抵御每年雨季河流涨水淹没建筑的危险。实际上，当地没有确切的水文资料，建筑师只能根据当地人的口述，确定建筑的地板高度，这也是建筑被设计建造在一个架高的平台上的原因。因为建筑选址的特殊性，建筑师需要首先解决的问题就是建筑和环境的关系。在建筑师看来，峡谷的风景是极具力量感的，也应该是整个公园的绝对主角，而建筑应该首先融入环境，然后才是利用自身的特征为整个谷底点睛。因此，如何处理好建筑的显隐问题就成为了设计的起点。</span></p><p><span style=\"text-align: center;\">建筑插入山石之间，如同从山石中生长出来</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9885b9ece8678ecced101e065d9bf5d4.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9f0e087fe37e13aa7e0f7ac9ef6f742d.jpg\" alt=\"undefined\"><br></span></p><p><span>在实地勘察中，设计师发现小山顶部并不是平的。山顶有四组山石高起，而高起的山石之间自然形成了若干个小高地。设计师把建筑打散，形成若干个小的单体，并将它们体藏在这些小高地中。建筑自然的避让原有场地中的山石，并和山石形成一种共生关系：藏身于山石，又从山石的缝隙中伸出来，若隐若现。建筑的形式并不刻意的追求新奇，仍然沿用了贵州黔西南地区的双坡顶民居形式，立面材料也尽量选择本地的石材为主。设计师不希望建筑过于彰显，除了对周边环境的尊敬外，也深知即使卖力的表现也无法和周边的大山大水争锋。</span></p><p><span style=\"text-align: center;\">建筑被抬起，既解决了季节性涨水对建筑的威胁，又尽量减少对环境的破坏</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9507d4e271fefb0e8f0c31b145aea9c7.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">山谷壮美的景色为游客服务中心提供了丰富的景观面</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/482a56bf5bc9fd4952c3d1282bd43e15.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑立面材料尽量采用地域性材料，与环境和谐共处</span></p><p><span style=\"text-align: center;\">内和外</span></p><p><span>游客服务中心由接待站、西餐厅（“红点餐厅”）、酒吧（“仙掌酒吧”）和会议室（“磐石会议中心”）四座建筑组成，其总体布局围绕着基地上的山石展开，呈现出一种外观和内聚共存的状态。</span></p><p><span style=\"text-align: center;\">m亭，红点餐厅和仙掌酒吧围合成的室外空间构成游客公共活动的场所</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/989d00ed29fcc9278afea7a3655d9b90.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">当地布依族妇女在m亭休息</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c35ff8e609c5448093884aa3b2d64361.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从仙掌酒吧看m亭</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/f46227485b25a21de231d952d508f04f.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/12a2c676b176e93a193ef0f5107d20c1.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/e3169360676a0b70ed7fb2073e4a9eca.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑与环境和谐共处</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c3442d1b21f7e6127931f10bd71b3c27.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">仙掌酒吧室内空间</span></p><p><span>外观，指每栋建筑都具有很好的观景面，通过落地玻璃，山谷的壮美景色可以被收入建筑室内，使游客中心和山谷形成共鸣。人坐在建筑室内或者屋檐下，通过视线与谷底远处的岩壁、河流、大地交流，并融入其中。内聚，指建筑与建筑之间，建筑与被其围绕的山石之间形成的内向的聚合。这种聚合被一个高架的平台功能化，明确化。平台不仅在汛期很好的解决了建筑主体的防洪问题，也是串联建筑与建筑的室外空间。除了会议室，接待站、西餐厅和咖啡厅的入口都指向室外平台，这里是未来游客交流，与山石亲密互动的主要空间。平台中部，半室外的凉亭进一步加强了平台的聚集性，设计师希望这里可以成为游客中心最具活力的地点。</span></p><p><strong style=\"text-align: center;\">项目信息</strong><br style=\"text-align: center;\"><span style=\"text-align: center;\">项目名称：安龙国家山地户外运动示范公园游客服务中心<br></span><span style=\"text-align: center;\">项目地点：贵州省黔西南布依族苗族自治州安龙县笃山镇<br></span><span style=\"text-align: center;\">业主：安龙县荷韵旅游文化发展有限责任公司<br></span><span style=\"text-align: center;\">建筑设计：三文建筑/何崴工作室<br></span><span style=\"text-align: center;\">主持建筑师：何崴<br></span><span style=\"text-align: center;\">设计团队：陈龙、米健、孙琪、赵卓然、宋珂、吴前铖<br></span><span style=\"text-align: center;\">项目顾问：聂建，王滨<br></span><span style=\"text-align: center;\">建筑面积：1400平方米<br></span><span style=\"text-align: center;\">设计时间：2016年4月-2016年7月<br></span><span style=\"text-align: center;\">建造时间：2016年7月-2017年7月<br></span><span style=\"text-align: center;\">驻场工程师：靳雷柱，何秀根<br></span><span style=\"text-align: center;\">合作单位：北京山岳美途体育文化有限公司<br></span><span style=\"text-align: center;\">室内施工图设计：北京鸿尚国际设计有限公司<br></span><span style=\"text-align: center;\">室内家具品牌：天一美家<br></span><span style=\"text-align: center;\">摄影师：金伟琦</span></p>', 1532589064, 1532589061, 2, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (35, '201807260001', 1, 56, NULL, 2, NULL, '贵州安龙国家山地户外运动示范公园游客服务中心', '安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公', 111, '/uploads/article/20180726/1c71fc45062c8444dd930499e0cd9c78.jpg', NULL, '<p><span>安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公园游客服务中心。</span></p><p><span style=\"text-align: center;\">鸟瞰图</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/7a8f0e8f4bbed95068df985cd9783bff.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">显和隐</span></p><p><span><span class=\"Apple-converted-space\"> </span>游客服务中心位于谷底的一座小山丘顶上。小山丘是谷底唯一的高点，具有良好的视线，本身也极为醒目。选择在这里建造游客中心，除了希望建筑成为谷底的视觉焦点之外，还因为这里的地势最高，可以抵御每年雨季河流涨水淹没建筑的危险。实际上，当地没有确切的水文资料，建筑师只能根据当地人的口述，确定建筑的地板高度，这也是建筑被设计建造在一个架高的平台上的原因。因为建筑选址的特殊性，建筑师需要首先解决的问题就是建筑和环境的关系。在建筑师看来，峡谷的风景是极具力量感的，也应该是整个公园的绝对主角，而建筑应该首先融入环境，然后才是利用自身的特征为整个谷底点睛。因此，如何处理好建筑的显隐问题就成为了设计的起点。</span></p><p><span style=\"text-align: center;\">建筑插入山石之间，如同从山石中生长出来</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9885b9ece8678ecced101e065d9bf5d4.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9f0e087fe37e13aa7e0f7ac9ef6f742d.jpg\" alt=\"undefined\"><br></span></p><p><span>在实地勘察中，设计师发现小山顶部并不是平的。山顶有四组山石高起，而高起的山石之间自然形成了若干个小高地。设计师把建筑打散，形成若干个小的单体，并将它们体藏在这些小高地中。建筑自然的避让原有场地中的山石，并和山石形成一种共生关系：藏身于山石，又从山石的缝隙中伸出来，若隐若现。建筑的形式并不刻意的追求新奇，仍然沿用了贵州黔西南地区的双坡顶民居形式，立面材料也尽量选择本地的石材为主。设计师不希望建筑过于彰显，除了对周边环境的尊敬外，也深知即使卖力的表现也无法和周边的大山大水争锋。</span></p><p><span style=\"text-align: center;\">建筑被抬起，既解决了季节性涨水对建筑的威胁，又尽量减少对环境的破坏</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9507d4e271fefb0e8f0c31b145aea9c7.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">山谷壮美的景色为游客服务中心提供了丰富的景观面</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/482a56bf5bc9fd4952c3d1282bd43e15.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑立面材料尽量采用地域性材料，与环境和谐共处</span></p><p><span style=\"text-align: center;\">内和外</span></p><p><span>游客服务中心由接待站、西餐厅（“红点餐厅”）、酒吧（“仙掌酒吧”）和会议室（“磐石会议中心”）四座建筑组成，其总体布局围绕着基地上的山石展开，呈现出一种外观和内聚共存的状态。</span></p><p><span style=\"text-align: center;\">m亭，红点餐厅和仙掌酒吧围合成的室外空间构成游客公共活动的场所</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/989d00ed29fcc9278afea7a3655d9b90.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">当地布依族妇女在m亭休息</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c35ff8e609c5448093884aa3b2d64361.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从仙掌酒吧看m亭</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/f46227485b25a21de231d952d508f04f.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/12a2c676b176e93a193ef0f5107d20c1.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/e3169360676a0b70ed7fb2073e4a9eca.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑与环境和谐共处</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c3442d1b21f7e6127931f10bd71b3c27.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">仙掌酒吧室内空间</span></p><p><span>外观，指每栋建筑都具有很好的观景面，通过落地玻璃，山谷的壮美景色可以被收入建筑室内，使游客中心和山谷形成共鸣。人坐在建筑室内或者屋檐下，通过视线与谷底远处的岩壁、河流、大地交流，并融入其中。内聚，指建筑与建筑之间，建筑与被其围绕的山石之间形成的内向的聚合。这种聚合被一个高架的平台功能化，明确化。平台不仅在汛期很好的解决了建筑主体的防洪问题，也是串联建筑与建筑的室外空间。除了会议室，接待站、西餐厅和咖啡厅的入口都指向室外平台，这里是未来游客交流，与山石亲密互动的主要空间。平台中部，半室外的凉亭进一步加强了平台的聚集性，设计师希望这里可以成为游客中心最具活力的地点。</span></p><p><strong style=\"text-align: center;\">项目信息</strong><br style=\"text-align: center;\"><span style=\"text-align: center;\">项目名称：安龙国家山地户外运动示范公园游客服务中心<br></span><span style=\"text-align: center;\">项目地点：贵州省黔西南布依族苗族自治州安龙县笃山镇<br></span><span style=\"text-align: center;\">业主：安龙县荷韵旅游文化发展有限责任公司<br></span><span style=\"text-align: center;\">建筑设计：三文建筑/何崴工作室<br></span><span style=\"text-align: center;\">主持建筑师：何崴<br></span><span style=\"text-align: center;\">设计团队：陈龙、米健、孙琪、赵卓然、宋珂、吴前铖<br></span><span style=\"text-align: center;\">项目顾问：聂建，王滨<br></span><span style=\"text-align: center;\">建筑面积：1400平方米<br></span><span style=\"text-align: center;\">设计时间：2016年4月-2016年7月<br></span><span style=\"text-align: center;\">建造时间：2016年7月-2017年7月<br></span><span style=\"text-align: center;\">驻场工程师：靳雷柱，何秀根<br></span><span style=\"text-align: center;\">合作单位：北京山岳美途体育文化有限公司<br></span><span style=\"text-align: center;\">室内施工图设计：北京鸿尚国际设计有限公司<br></span><span style=\"text-align: center;\">室内家具品牌：天一美家<br></span><span style=\"text-align: center;\">摄影师：金伟琦</span></p>', 1532589065, 1532589061, 26, 1, 2, 2, 1, NULL);
INSERT INTO `huhang_article` VALUES (36, '201807260001', 1, 56, NULL, 2, NULL, '贵州安龙国家山地户外运动示范公园游客服务中心', '安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公', 110, '/uploads/article/20180726/1c71fc45062c8444dd930499e0cd9c78.jpg', NULL, '<p><span>安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公园游客服务中心。</span></p><p><span style=\"text-align: center;\">鸟瞰图</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/7a8f0e8f4bbed95068df985cd9783bff.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">显和隐</span></p><p><span><span class=\"Apple-converted-space\"> </span>游客服务中心位于谷底的一座小山丘顶上。小山丘是谷底唯一的高点，具有良好的视线，本身也极为醒目。选择在这里建造游客中心，除了希望建筑成为谷底的视觉焦点之外，还因为这里的地势最高，可以抵御每年雨季河流涨水淹没建筑的危险。实际上，当地没有确切的水文资料，建筑师只能根据当地人的口述，确定建筑的地板高度，这也是建筑被设计建造在一个架高的平台上的原因。因为建筑选址的特殊性，建筑师需要首先解决的问题就是建筑和环境的关系。在建筑师看来，峡谷的风景是极具力量感的，也应该是整个公园的绝对主角，而建筑应该首先融入环境，然后才是利用自身的特征为整个谷底点睛。因此，如何处理好建筑的显隐问题就成为了设计的起点。</span></p><p><span style=\"text-align: center;\">建筑插入山石之间，如同从山石中生长出来</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9885b9ece8678ecced101e065d9bf5d4.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9f0e087fe37e13aa7e0f7ac9ef6f742d.jpg\" alt=\"undefined\"><br></span></p><p><span>在实地勘察中，设计师发现小山顶部并不是平的。山顶有四组山石高起，而高起的山石之间自然形成了若干个小高地。设计师把建筑打散，形成若干个小的单体，并将它们体藏在这些小高地中。建筑自然的避让原有场地中的山石，并和山石形成一种共生关系：藏身于山石，又从山石的缝隙中伸出来，若隐若现。建筑的形式并不刻意的追求新奇，仍然沿用了贵州黔西南地区的双坡顶民居形式，立面材料也尽量选择本地的石材为主。设计师不希望建筑过于彰显，除了对周边环境的尊敬外，也深知即使卖力的表现也无法和周边的大山大水争锋。</span></p><p><span style=\"text-align: center;\">建筑被抬起，既解决了季节性涨水对建筑的威胁，又尽量减少对环境的破坏</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/9507d4e271fefb0e8f0c31b145aea9c7.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">山谷壮美的景色为游客服务中心提供了丰富的景观面</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/482a56bf5bc9fd4952c3d1282bd43e15.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑立面材料尽量采用地域性材料，与环境和谐共处</span></p><p><span style=\"text-align: center;\">内和外</span></p><p><span>游客服务中心由接待站、西餐厅（“红点餐厅”）、酒吧（“仙掌酒吧”）和会议室（“磐石会议中心”）四座建筑组成，其总体布局围绕着基地上的山石展开，呈现出一种外观和内聚共存的状态。</span></p><p><span style=\"text-align: center;\">m亭，红点餐厅和仙掌酒吧围合成的室外空间构成游客公共活动的场所</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/989d00ed29fcc9278afea7a3655d9b90.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">当地布依族妇女在m亭休息</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c35ff8e609c5448093884aa3b2d64361.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从仙掌酒吧看m亭</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/f46227485b25a21de231d952d508f04f.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/12a2c676b176e93a193ef0f5107d20c1.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">从m亭看红点餐厅和酒吧</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/e3169360676a0b70ed7fb2073e4a9eca.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">建筑与环境和谐共处</span></p><p><span style=\"text-align: center;\"><img src=\"/uploads/layui/20180726/c3442d1b21f7e6127931f10bd71b3c27.jpg\" alt=\"undefined\"><br></span></p><p><span style=\"text-align: center;\">仙掌酒吧室内空间</span></p><p><span>外观，指每栋建筑都具有很好的观景面，通过落地玻璃，山谷的壮美景色可以被收入建筑室内，使游客中心和山谷形成共鸣。人坐在建筑室内或者屋檐下，通过视线与谷底远处的岩壁、河流、大地交流，并融入其中。内聚，指建筑与建筑之间，建筑与被其围绕的山石之间形成的内向的聚合。这种聚合被一个高架的平台功能化，明确化。平台不仅在汛期很好的解决了建筑主体的防洪问题，也是串联建筑与建筑的室外空间。除了会议室，接待站、西餐厅和咖啡厅的入口都指向室外平台，这里是未来游客交流，与山石亲密互动的主要空间。平台中部，半室外的凉亭进一步加强了平台的聚集性，设计师希望这里可以成为游客中心最具活力的地点。</span></p><p><strong style=\"text-align: center;\">项目信息</strong><br style=\"text-align: center;\"><span style=\"text-align: center;\">项目名称：安龙国家山地户外运动示范公园游客服务中心<br></span><span style=\"text-align: center;\">项目地点：贵州省黔西南布依族苗族自治州安龙县笃山镇<br></span><span style=\"text-align: center;\">业主：安龙县荷韵旅游文化发展有限责任公司<br></span><span style=\"text-align: center;\">建筑设计：三文建筑/何崴工作室<br></span><span style=\"text-align: center;\">主持建筑师：何崴<br></span><span style=\"text-align: center;\">设计团队：陈龙、米健、孙琪、赵卓然、宋珂、吴前铖<br></span><span style=\"text-align: center;\">项目顾问：聂建，王滨<br></span><span style=\"text-align: center;\">建筑面积：1400平方米<br></span><span style=\"text-align: center;\">设计时间：2016年4月-2016年7月<br></span><span style=\"text-align: center;\">建造时间：2016年7月-2017年7月<br></span><span style=\"text-align: center;\">驻场工程师：靳雷柱，何秀根<br></span><span style=\"text-align: center;\">合作单位：北京山岳美途体育文化有限公司<br></span><span style=\"text-align: center;\">室内施工图设计：北京鸿尚国际设计有限公司<br></span><span style=\"text-align: center;\">室内家具品牌：天一美家<br></span><span style=\"text-align: center;\">摄影师：金伟琦</span></p>', 1532589012, 1532589061, 12, 1, 2, 2, 1, NULL);

-- ----------------------------
-- Table structure for huhang_banner
-- ----------------------------
DROP TABLE IF EXISTS `huhang_banner`;
CREATE TABLE `huhang_banner`  (
  `ba_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'banner轮播ID',
  `ba_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'banner编号',
  `ba_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'banner主题',
  `ba_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '图片路径，两张用‘，’隔开，第一张图是电脑端的，第二张是手机端的图片',
  `ba_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'banner图片alt',
  `ba_url` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '跳转路径，两个个用‘，’隔开，第一个是电脑端的，第二个是手机端的',
  `ba_p_id` int(11) DEFAULT NULL COMMENT '省份id',
  `ba_c_id` int(11) DEFAULT NULL COMMENT '城市id',
  `ba_m_id` int(11) DEFAULT 1 COMMENT '商家id',
  `ba_createtime` int(11) DEFAULT NULL COMMENT 'banner 添加时间',
  `ba_updatetime` int(11) DEFAULT NULL COMMENT 'banner 修改更新时间',
  `ba_order` int(10) DEFAULT 1 COMMENT 'banner图排序',
  `ba_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1 显示：2隐藏',
  `ba_status` tinyint(2) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `ba_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `ba_type` tinyint(2) DEFAULT NULL COMMENT 'banner类型1 站点banner，2 商户banner',
  `ba_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '审核备注',
  PRIMARY KEY (`ba_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 81 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_banner
-- ----------------------------
INSERT INTO `huhang_banner` VALUES (77, '201807190005', '装修报价', '/uploads/case/20180719/2666776630571fb8e095637df6567c6a.png,/uploads/case/20180719/3ba6fe1e533df6e3d2849b9b32e7e11c.png', '', 'https://www.baidu.com/,', 1, 56, 1, 1531995672, 1531995672, 1, 1, 2, 1, 2, '');
INSERT INTO `huhang_banner` VALUES (75, '201807190005', '装修保障', '/uploads/case/20180719/e20af0d570af8f20741f1d4095d85ef9.png,/uploads/case/20180719/85e57a39704c12632e9c7d6d8c52f392.png', '', ',', 1, 56, 1, 1531972831, 1531972831, 4, 1, 2, 1, 2, '1221');
INSERT INTO `huhang_banner` VALUES (74, '201807190004', '装修报价', '/uploads/case/20180719/948b1bf225d4461c7a3e262c38b4a55d.png,/uploads/case/20180719/f8877fa050079dfd5b746c0f3a0be434.png', '', ',', 1, 56, 1, 1531972654, 1531972654, 5, 1, 2, 1, 1, '');
INSERT INTO `huhang_banner` VALUES (76, '201807190004', '装修保障', '/uploads/case/20180719/c6604b02a115e633c79a51af063d8308.png,/uploads/case/20180719/1a766d2455e1bf0250fdcac299201701.png', '', 'http://www.huhang.com/,', 1, 56, 1, 1531993785, 1531993785, 1, 1, 2, 1, 1, '');
INSERT INTO `huhang_banner` VALUES (71, '201807190001', '', ',', '', ',', 0, 0, 0, 1531971817, 1531971817, 0, 1, 2, 1, 1, '');
INSERT INTO `huhang_banner` VALUES (78, '201807300001', '光改', '/uploads/commerce/banner/20180813/b9f2065562bd02d6eb88ec71082c2bb3.jpg,/uploads/commerce/banner/20180730/355d94fd3f8741d2bc8eafe7a84a44b2.png', '', ',', 1, 56, 2, 1532942461, 1534140853, 2, 1, 1, 2, 2, '');
INSERT INTO `huhang_banner` VALUES (80, '201808130001', '12', '/uploads/commerce/banner/20180813/78b1e756a01666b45e1f63a7c4f662b0.jpg,/uploads/commerce/banner/20180813/04a042d27b4def220c58f38ac41964c8.jpg', '', 'https://www.baidu.com,', 1, 56, 2, 1534140815, 1534141155, 5, 1, 1, NULL, 2, '');

-- ----------------------------
-- Table structure for huhang_branch
-- ----------------------------
DROP TABLE IF EXISTS `huhang_branch`;
CREATE TABLE `huhang_branch`  (
  `b_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '站点id',
  `b_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点编号',
  `b_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点名称',
  `b_website` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '该分站的链接',
  `b_tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点电话（如：400电话）',
  `b_province` int(10) DEFAULT NULL COMMENT '所属省份id',
  `b_city` int(10) DEFAULT NULL COMMENT '城市id',
  `b_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点地址',
  `b_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点地理坐标',
  `b_description` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '站点简介',
  `b_templet` int(10) DEFAULT NULL COMMENT '站点模板',
  `b_createtime` int(11) DEFAULT NULL COMMENT '站点开通时间',
  `b_isopen` tinyint(2) DEFAULT NULL COMMENT '是否开通：1.是：2 否',
  `b_temple` int(10) DEFAULT NULL COMMENT '站点模板，对应模板表的id',
  `b_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `b_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `b_manger` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点负责人姓名',
  `b_manger_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点负责人手机号',
  `b_manger_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '站点负责人邮箱',
  PRIMARY KEY (`b_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 71 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '站点管理' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_branch
-- ----------------------------
INSERT INTO `huhang_branch` VALUES (62, '201807140001', '西安站', 'xian', '029-88867375', 1, 56, '陕西省西安市经济技术开发区天地时代广场C座', '109.003344,34.30966', '这个简介不知道怎么写！<br>', 3, 1531552108, 1, NULL, 1, 1532167162, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (63, '201807210001', '上海站', 'shanghai', '029-88867375', 5, 64, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532167196, 1, NULL, 1, 1532167196, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (64, '201807230001', '昆明站', 'kunming', '029-88867375', 2, 60, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532324066, 1, NULL, 1, 1532324066, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (65, '201807230002', '武汉站', 'wuhan', '029-88867375', 3, 62, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532324132, 1, NULL, 1, 1532324132, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (66, '201807230003', '长沙站', 'changsha', '029-88867375', 4, 63, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532324173, 1, NULL, 1, 1532324186, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (67, '201807230004', '北京站', 'beijing', '029-88867375', 6, 65, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532324885, 1, NULL, 1, 1532324885, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (68, '201807230005', '杭州站', 'hangzhou', '029-88867375', 7, 66, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532324985, 1, NULL, 1, 1532324985, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (69, '201807230006', '南京站', 'nanjing', '029-88867375', 8, 67, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532325053, 1, NULL, 1, 1532325053, '房腾飞', '13891022675', 'huhang315@163.com');
INSERT INTO `huhang_branch` VALUES (70, '201807230007', '苏州站', 'suzhou', '029-88867375', 8, 68, '陕西省西安市经济技术开发区天地时代广场C座', '', '22', 3, 1532325159, 1, NULL, 1, 1532325159, '房腾飞', '13891022675', 'huhang315@163.com');

-- ----------------------------
-- Table structure for huhang_buildings
-- ----------------------------
DROP TABLE IF EXISTS `huhang_buildings`;
CREATE TABLE `huhang_buildings`  (
  `bu_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '楼盘小区表',
  `bu_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '楼盘编号。系统自动生成的编号，规则同客户编号生成规则',
  `bu_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '楼盘名称',
  `bu_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '楼盘描述',
  `bu_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '楼盘地理坐标',
  `bu_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '楼盘封面图',
  `bu_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片alt',
  `bu_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '楼盘地址',
  `bu_p_id` int(11) DEFAULT NULL COMMENT '省份id',
  `bu_c_id` int(11) DEFAULT NULL COMMENT '城市id',
  `bu_branch` int(255) DEFAULT NULL COMMENT '站点id',
  `bu_seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `bu_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  `bu_seo_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'seo描述',
  `bu_activity` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '优惠活动内容',
  `bu_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '活动链接',
  `bu_view` int(10) DEFAULT 0 COMMENT '浏览量热度，浏览次数',
  `bu_ordered` int(10) DEFAULT 0 COMMENT '报名户数（数字），前端在这个楼盘下的预约数量',
  `bu_case_num` int(11) DEFAULT 0 COMMENT '案例数量（在这个楼盘下所展示的案例的数量）',
  `bu_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1，显示；2，隐藏',
  `bu_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶：1是；2否',
  `bu_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `bu_createtime` int(11) DEFAULT NULL COMMENT '操作时间',
  `bu_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`bu_id`, `bu_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '楼盘小区表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_case
-- ----------------------------
DROP TABLE IF EXISTS `huhang_case`;
CREATE TABLE `huhang_case`  (
  `case_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '案例id',
  `case_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '案例编号。系统自动生成的编号，规则同客户编号生成规则',
  `case_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '案例名称',
  `case_p_id` int(10) DEFAULT NULL COMMENT '省份id',
  `case_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `case_b_id` int(11) DEFAULT NULL COMMENT '分站id',
  `case_m_id` int(10) DEFAULT NULL COMMENT '商户id',
  `case_price` int(10) DEFAULT NULL COMMENT '案例造价（单位：万元）',
  `case_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '项目类型',
  `case_type_title` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '户型标题',
  `case_type_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '户型描述',
  `case_bulid` int(11) DEFAULT NULL COMMENT '楼盘id 对应楼盘表（小区）',
  `case_decotime` int(11) DEFAULT NULL COMMENT '案例发布日期',
  `case_updatetime` int(11) DEFAULT NULL COMMENT '案例更新日期',
  `case_finishtime` int(11) DEFAULT NULL COMMENT '完工日期',
  `case_view` int(10) DEFAULT 0 COMMENT '浏览量',
  `case_url` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '案例全景URL',
  `case_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '图片,多张图用‘，’分割',
  `case_img_alt` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '案例图片alt,个数同图片数量，多个用“，”隔开',
  `case_img_title` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '案例图片描述，个数同图片数量，多个用“，”隔开',
  `case_img_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '图片的描述，个数同图片，多个用“，”分割',
  `case_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '面积',
  `case_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '案例简介',
  `case_designer` int(11) DEFAULT NULL COMMENT '案例设计师id对应设计师表id',
  `case_seo_tilte` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `case_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  `case_seo_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo描述',
  `case_status` tinyint(2) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `case_istop` tinyint(2) DEFAULT 2 COMMENT '置顶: 1 是；2否',
  `case_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1，显示；2，隐藏',
  `case_admin` int(10) DEFAULT NULL COMMENT '案例发布人，对应管理员的id',
  `case_order_num` int(10) DEFAULT 0 COMMENT '案例预约数量',
  `case_tip` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  PRIMARY KEY (`case_id`, `case_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 86 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '装修案例表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_case
-- ----------------------------
INSERT INTO `huhang_case` VALUES (60, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1532489153, 1532489153, NULL, 17, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造白塔寺胡同大杂院改造白塔寺胡同大杂院改造白塔寺胡同大杂院改造白塔寺胡同大杂院改造白塔寺胡同大杂院改造白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (61, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '86', NULL, NULL, NULL, 1532572193, 1532572193, NULL, 8, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (62, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 1, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (63, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (64, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (65, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 2, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (66, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (67, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 1, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (68, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (69, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (70, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (71, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (72, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (73, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (74, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (75, '201807190001', '白塔寺胡同大杂院改造', 1, 56, NULL, 1, 38, '89', NULL, NULL, NULL, 1531972705, 1531972705, NULL, 0, '', '/uploads/case/20180719/7c8c3e5d7eb5b33e10ccf03cda766c58.jpg,/uploads/case/20180719/9077766fb01186a6757b8b5341f4fc63.jpg,/uploads/case/20180719/5572a6195369bd191c0c2d747bbdd0c6.jpg,/uploads/case/20180719/bfdebc3bbdd2ebc15bd229d704fe8270.jpg,,', ',,,,,', NULL, NULL, '246', '白塔寺胡同大杂院改造', NULL, NULL, '', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (76, '201807260002', '项目名称：美豪丽致酒店（苏州店）', 1, 56, NULL, 2, 6226, '86', NULL, NULL, NULL, 1532589970, 1532589970, NULL, 59, '', '/uploads/case/20180726/888a13637095ca1a37cbf56e6bd3995f.jpg,/uploads/case/20180726/86b5699c8bec31c112ac6ed46392e0cf.jpg,/uploads/case/20180726/b828871b8bc3c244c4b76e77c264ccb7.jpg,/uploads/case/20180726/345176e770e8faa94b7f73bb0d350175.jpg,/uploads/case/20180726/84fbddae2aab5ed02ace6ae6dddef056.jpg,/uploads/case/20180726/639a82b2647111aaff80740df1d1aec3.jpg', ',,,,,', NULL, NULL, '232', '安龙国家山地户外运动示范公园位于贵州黔西南州安龙县笃山镇。公园位于一个天然的山谷中，占地约700亩，风景雄奇。山谷四周是典型的喀斯特地形岩壁，其中一段更是垂直的百米悬崖，谷底成口袋形，有一条蜿蜒的河流将谷底分为两半，河流的尽头是两个天坑，河流在天坑处从地面消失流入地下，形成地下河。这里是户外运动绝佳的场地，攀岩、热气球、滑翔伞、水上运动、越野车等户外极限运动都可以在这里找到理想的场地。2016年，三文建筑/何崴工作室受邀参与了公园的规划和设计，并主持设计整个谷底唯一的一组建筑——安龙国家山地户外运动示范公', NULL, NULL, '', NULL, 2, 2, 1, 2, 0, NULL);
INSERT INTO `huhang_case` VALUES (79, '201807260003', '项目名称：美豪丽致酒店（西安北二环店）', 1, 56, NULL, 2, 222, '92', NULL, NULL, NULL, 1533865855, 1533865855, NULL, 7, '', '/uploads/case/20180726/8e1afe2492d6f0ae8ed83c1d23a6968f.jpg,/uploads/case/20180726/f9cc36b4b8a1bba8dd610c4396783b6d.jpg,/uploads/case/20180726/64650eff9c895f50d9cb8488449b04d5.jpg,/uploads/case/20180726/48a0eeb4adf1deffd499839b9fc3d81d.jpg,/uploads/case/20180726/17000ada4d0272eb937d39d56c79837c.jpg,/uploads/case/20180726/3cad09e7c79a6d49d9ba4fba0e4f448d.jpg', ',,,,,', NULL, NULL, '3222', '项目名称：美豪丽致酒店（西安北二环店）', 71, NULL, '项目名称：美豪丽致酒店（西安北二环店）', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (80, '201807260003', '项目名称：美豪丽致酒店（西安北二环店）', 1, 56, NULL, 2, 222, '92', NULL, NULL, NULL, 1533866153, 1533866153, NULL, 14, '', '/uploads/case/20180726/8e1afe2492d6f0ae8ed83c1d23a6968f.jpg,/uploads/case/20180726/f9cc36b4b8a1bba8dd610c4396783b6d.jpg,/uploads/case/20180726/64650eff9c895f50d9cb8488449b04d5.jpg,/uploads/case/20180726/48a0eeb4adf1deffd499839b9fc3d81d.jpg,/uploads/case/20180726/17000ada4d0272eb937d39d56c79837c.jpg,/uploads/case/20180726/3cad09e7c79a6d49d9ba4fba0e4f448d.jpg', ',,,,,', NULL, NULL, '3222', '项目名称：美豪丽致酒店（西安北二环店）', 0, NULL, '项目名称：美豪丽致酒店（西安北二环店）', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (81, '201807260003', '项目名称：美豪丽致酒店（西安北二环店）', 1, 56, NULL, 2, 222, '92', NULL, NULL, NULL, 1532590167, 1532590167, NULL, 0, NULL, '/uploads/case/20180726/8e1afe2492d6f0ae8ed83c1d23a6968f.jpg,/uploads/case/20180726/f9cc36b4b8a1bba8dd610c4396783b6d.jpg,/uploads/case/20180726/64650eff9c895f50d9cb8488449b04d5.jpg,/uploads/case/20180726/48a0eeb4adf1deffd499839b9fc3d81d.jpg,/uploads/case/20180726/17000ada4d0272eb937d39d56c79837c.jpg,/uploads/case/20180726/3cad09e7c79a6d49d9ba4fba0e4f448d.jpg', ',,,,,', NULL, NULL, '3222', '项目名称：美豪丽致酒店（西安北二环店）', NULL, NULL, '项目名称：美豪丽致酒店（西安北二环店）', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (82, '201807260003', '项目名称：美豪丽致酒店（西安北二环店）', 1, 56, NULL, 2, 222, '92', NULL, NULL, NULL, 1532590167, 1532590167, NULL, 0, NULL, '/uploads/case/20180726/8e1afe2492d6f0ae8ed83c1d23a6968f.jpg,/uploads/case/20180726/f9cc36b4b8a1bba8dd610c4396783b6d.jpg,/uploads/case/20180726/64650eff9c895f50d9cb8488449b04d5.jpg,/uploads/case/20180726/48a0eeb4adf1deffd499839b9fc3d81d.jpg,/uploads/case/20180726/17000ada4d0272eb937d39d56c79837c.jpg,/uploads/case/20180726/3cad09e7c79a6d49d9ba4fba0e4f448d.jpg', ',,,,,', NULL, NULL, '3222', '项目名称：美豪丽致酒店（西安北二环店）', NULL, NULL, '项目名称：美豪丽致酒店（西安北二环店）', NULL, 2, 2, 1, 2, 0, NULL);
INSERT INTO `huhang_case` VALUES (83, '201807260003', '项目名称：美豪丽致酒店（西安北二环店）', 1, 56, NULL, 2, 222, '92', NULL, NULL, NULL, 1532590167, 1532590167, NULL, 1, NULL, '/uploads/case/20180726/8e1afe2492d6f0ae8ed83c1d23a6968f.jpg,/uploads/case/20180726/f9cc36b4b8a1bba8dd610c4396783b6d.jpg,/uploads/case/20180726/64650eff9c895f50d9cb8488449b04d5.jpg,/uploads/case/20180726/48a0eeb4adf1deffd499839b9fc3d81d.jpg,/uploads/case/20180726/17000ada4d0272eb937d39d56c79837c.jpg,/uploads/case/20180726/3cad09e7c79a6d49d9ba4fba0e4f448d.jpg', ',,,,,', NULL, NULL, '3222', '项目名称：美豪丽致酒店（西安北二环店）', NULL, NULL, '项目名称：美豪丽致酒店（西安北二环店）', NULL, 2, 2, 1, 1, 0, NULL);
INSERT INTO `huhang_case` VALUES (84, '201807260003', '项目名称：美豪丽致酒店（西安北二环店）', 1, 56, NULL, 2, 222, '92', NULL, NULL, NULL, 1532590167, 1532590167, NULL, 1, NULL, '/uploads/case/20180726/8e1afe2492d6f0ae8ed83c1d23a6968f.jpg,/uploads/case/20180726/f9cc36b4b8a1bba8dd610c4396783b6d.jpg,/uploads/case/20180726/64650eff9c895f50d9cb8488449b04d5.jpg,/uploads/case/20180726/48a0eeb4adf1deffd499839b9fc3d81d.jpg,/uploads/case/20180726/17000ada4d0272eb937d39d56c79837c.jpg,/uploads/case/20180726/3cad09e7c79a6d49d9ba4fba0e4f448d.jpg', ',,,,,', NULL, NULL, '3222', '项目名称：美豪丽致酒店（西安北二环店）', NULL, NULL, '项目名称：美豪丽致酒店（西安北二环店）', NULL, 2, 2, 1, 2, 0, NULL);
INSERT INTO `huhang_case` VALUES (85, '201807310001', '这是我修改的案例', 1, 56, NULL, 2, 123, '93', NULL, NULL, NULL, 1533004811, 1533018619, NULL, 1, '', '/uploads/commerce/case/20180731/da01d4e993c362950b9826b9e3a85f4e.png,,,,,', ',,,,,', NULL, NULL, '123', '123', NULL, NULL, '12', NULL, 1, 2, 1, 2, 0, NULL);

-- ----------------------------
-- Table structure for huhang_city
-- ----------------------------
DROP TABLE IF EXISTS `huhang_city`;
CREATE TABLE `huhang_city`  (
  `c_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '城市id',
  `c_p_id` int(10) DEFAULT NULL COMMENT '省份id对应省份表的id',
  `c_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '城市名称',
  `c_rank` int(10) DEFAULT NULL COMMENT '对应城市等级表的id',
  `c_opeatime` int(11) DEFAULT NULL COMMENT '操作时间',
  `c_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  PRIMARY KEY (`c_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 69 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_city
-- ----------------------------
INSERT INTO `huhang_city` VALUES (59, 1, '商洛', 5, 1531822437, 1);
INSERT INTO `huhang_city` VALUES (56, 1, '西安', 4, 1531822442, 1);
INSERT INTO `huhang_city` VALUES (58, 1, '咸阳', 5, 1531822447, 1);
INSERT INTO `huhang_city` VALUES (60, 2, '昆明', 4, 1531822452, 1);
INSERT INTO `huhang_city` VALUES (61, 2, '大理', 5, 1531822457, 1);
INSERT INTO `huhang_city` VALUES (62, 3, '武汉', 4, 1531822462, 1);
INSERT INTO `huhang_city` VALUES (63, 4, '长沙', 4, 1531822466, 1);
INSERT INTO `huhang_city` VALUES (65, 6, '北京', 1, 1532324796, 1);
INSERT INTO `huhang_city` VALUES (64, 5, '上海', 1, 1532167116, 1);
INSERT INTO `huhang_city` VALUES (66, 7, '杭州', 1, 1532324925, 1);
INSERT INTO `huhang_city` VALUES (67, 8, '南京', 1, 1532325020, 1);
INSERT INTO `huhang_city` VALUES (68, 8, '苏州', 4, 1532325127, 1);

-- ----------------------------
-- Table structure for huhang_city_rank
-- ----------------------------
DROP TABLE IF EXISTS `huhang_city_rank`;
CREATE TABLE `huhang_city_rank`  (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '城市等级自增id',
  `cr_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '城市等级名称',
  `cr_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '城市等级备注',
  `cr_level_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '装修品质，对应装修品质id，多个用‘，’分隔开',
  `cr_level_price` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '品质单价，与装修id对应，多个用‘，’隔开',
  `cr_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `cr_order` int(10) DEFAULT NULL COMMENT '排序',
  `cr_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1.显示；2.隐藏',
  `cr_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id ',
  PRIMARY KEY (`cr_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '城市等级表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_city_rank
-- ----------------------------
INSERT INTO `huhang_city_rank` VALUES (1, '一线城市', '一线城市', '102,103,99', '11,22,33', 1531383613, 123, 1, 1);
INSERT INTO `huhang_city_rank` VALUES (4, '二线城市', '二线城市', '102,103,99', '44,55,66', 1531383806, 22, 1, 1);
INSERT INTO `huhang_city_rank` VALUES (5, '三线城市', '三线城市', '102,103,99', '666,777,888', 1531384733, 0, 1, 1);

-- ----------------------------
-- Table structure for huhang_customer
-- ----------------------------
DROP TABLE IF EXISTS `huhang_customer`;
CREATE TABLE `huhang_customer`  (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户id',
  `cus_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '客户编号系统生成的编号，做客户唯一标识生成规则，如：“201804210001”,前面8位是年与日，后面4位1-9999；不够的用0补空位。',
  `cus_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '客户名字对接人名字',
  `cus_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '客户电话',
  `cus_phone2` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '备用联系方式',
  `cus_qq` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '客户qq',
  `cus_sex` tinyint(2) DEFAULT NULL COMMENT '性别：1 男； 2 女； 3 不明',
  `cus_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户邮箱',
  `cus_provid` int(10) DEFAULT 0 COMMENT '省份id，对应省份表id',
  `cus_cityid` int(10) DEFAULT NULL COMMENT '城市id，对应城市表id',
  `cus_mer_id` int(10) DEFAULT NULL COMMENT '预约商户的id',
  `cus_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '项目面积',
  `cus_isrent` tinyint(4) DEFAULT 1 COMMENT '房屋类型：1：已租房；2：未租房',
  `cus_type` int(10) DEFAULT NULL COMMENT '装修项目类型,对应装修类型',
  `cus_quality` tinyint(4) DEFAULT NULL COMMENT '装修品质（档次）对应档次表ID',
  `cus_company` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '公司名称',
  `cus_promoney` int(10) DEFAULT NULL COMMENT '预估消费',
  `cus_case` int(10) DEFAULT NULL COMMENT '预约的案例编号',
  `cus_design` int(10) DEFAULT NULL COMMENT '预约的设计师id',
  `cus_build_id` int(11) DEFAULT NULL COMMENT '预约的楼盘',
  `cus_link` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '网址入口',
  `cus_position` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '预约页面位置',
  `cus_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户IP',
  `cus_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '推广关键词',
  `cus_from` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '推广来源',
  `cus_origin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '推广创意',
  `cus_device` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '用户浏览设备',
  `cus_net_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '用户网络状态',
  `cus_opptime` int(11) DEFAULT NULL COMMENT '预约时间',
  PRIMARY KEY (`cus_id`, `cus_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 698 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '客户预约表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_customer
-- ----------------------------
INSERT INTO `huhang_customer` VALUES (672, '201807270005', '123', '18255556661', NULL, NULL, NULL, NULL, 1, 59, NULL, '123', 1, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index/example/details.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532680658);
INSERT INTO `huhang_customer` VALUES (673, '201807270006', '', '15233332222', NULL, NULL, NULL, NULL, 7, 66, NULL, '1325', 2, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index/example/release.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532681468);
INSERT INTO `huhang_customer` VALUES (674, '201807270007', '', '15266666666', NULL, NULL, NULL, NULL, 5, 64, NULL, '666', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index/service/index.html#aaaa', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532681876);
INSERT INTO `huhang_customer` VALUES (675, '201807270007', '快快快', '18656235698', NULL, NULL, NULL, NULL, 0, NULL, NULL, '132', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/index/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532684188);
INSERT INTO `huhang_customer` VALUES (676, '201807270007', '发发发', '13891022675', NULL, NULL, NULL, NULL, 1, 56, NULL, '232', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532684644);
INSERT INTO `huhang_customer` VALUES (677, '201807270008', '123', '13245698523', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/company/profile.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685365);
INSERT INTO `huhang_customer` VALUES (678, '201807270008', '去去去', '18599998888', NULL, NULL, NULL, NULL, 0, NULL, NULL, '555', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/index/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685393);
INSERT INTO `huhang_customer` VALUES (679, '201807270008', '123', '18255556662', NULL, NULL, NULL, NULL, 0, NULL, NULL, '213', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/company/news.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685428);
INSERT INTO `huhang_customer` VALUES (680, '201807270008', '', '15633335555', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/company/details.html?art_id=1', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685490);
INSERT INTO `huhang_customer` VALUES (681, '201807270008', '12', '12313', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685700);
INSERT INTO `huhang_customer` VALUES (682, '201807270008', '123', '18755554444', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685890);
INSERT INTO `huhang_customer` VALUES (683, '201807270008', '123', '18255556632', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685916);
INSERT INTO `huhang_customer` VALUES (684, '201807270008', '123', '18255556634', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685929);
INSERT INTO `huhang_customer` VALUES (685, '201807270008', '123', '18255556600', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/details.html?case_id=60', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685946);
INSERT INTO `huhang_customer` VALUES (686, '201807270008', '123', '18255556667', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/company/honor.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685960);
INSERT INTO `huhang_customer` VALUES (687, '201807270008', '123', '18255556634', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/wanted/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685980);
INSERT INTO `huhang_customer` VALUES (688, '201807270008', '123', '18255556678', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/wanted/details.html?wt_id=21', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532685994);
INSERT INTO `huhang_customer` VALUES (689, '201807270008', '152', '15266665555', NULL, NULL, NULL, NULL, 0, NULL, NULL, '132', 0, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/company/about.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532686017);
INSERT INTO `huhang_customer` VALUES (690, '201807280001', '123', '18220995991', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749063);
INSERT INTO `huhang_customer` VALUES (691, '201807280001', '123', '18566663333', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749386);
INSERT INTO `huhang_customer` VALUES (692, '201807280001', 'yenvshi', '15233332222', NULL, NULL, NULL, NULL, 0, NULL, NULL, '255', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749494);
INSERT INTO `huhang_customer` VALUES (693, '201807280001', '123', '18566662222', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749775);
INSERT INTO `huhang_customer` VALUES (694, '201807280001', '123', '18599996666', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749811);
INSERT INTO `huhang_customer` VALUES (695, '201807280001', '123', '18699994444', NULL, NULL, NULL, NULL, 0, NULL, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749858);
INSERT INTO `huhang_customer` VALUES (696, '201807280001', '123', '18744447777', NULL, NULL, NULL, NULL, 1, 56, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1532749960);
INSERT INTO `huhang_customer` VALUES (697, '201808130001', '123', '18220995991', NULL, NULL, NULL, NULL, 1, 59, NULL, '123', 0, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/merchant/example/release.html?mt_id=1', '平台端首页', '117.36.76.230', '', '', '', 'windows', 'Internet', 1534126159);
INSERT INTO `huhang_customer` VALUES (669, '201807270002', '阿萨德飞电风扇', '18522223333', NULL, NULL, NULL, NULL, 1, 59, NULL, '123', 1, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index/bidding/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532680037);
INSERT INTO `huhang_customer` VALUES (668, '201807270003', '夜微凉', '17691074991', NULL, NULL, NULL, NULL, 1, 59, NULL, '21321', 1, 86, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532678346);
INSERT INTO `huhang_customer` VALUES (671, '201807270004', '灌灌灌灌', '18255556669', NULL, NULL, NULL, NULL, 2, 61, NULL, '132', 1, 90, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index/news/details.html?art_id=15', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532680331);
INSERT INTO `huhang_customer` VALUES (670, '201807270003', '123', '18255556666', NULL, NULL, NULL, NULL, 2, 60, NULL, '123', 1, 88, NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.huhang.com/index/company/index.html', '平台端首页', '117.36.76.230', '', '', '', NULL, NULL, 1532680209);

-- ----------------------------
-- Table structure for huhang_customer_allot
-- ----------------------------
DROP TABLE IF EXISTS `huhang_customer_allot`;
CREATE TABLE `huhang_customer_allot`  (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户分配表自增id',
  `ca_cus_id` int(10) DEFAULT NULL COMMENT '分配的客户id',
  `ca_mer_id` int(10) DEFAULT NULL COMMENT '分配的商户id',
  `ca_admin_id` int(10) DEFAULT NULL COMMENT '分配的管理员id',
  `ca_addtime` int(11) DEFAULT NULL COMMENT '分配时间',
  `ca_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '分配备注',
  PRIMARY KEY (`ca_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '客户分配关联表一个客户分配给对个商家' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_customer_log
-- ----------------------------
DROP TABLE IF EXISTS `huhang_customer_log`;
CREATE TABLE `huhang_customer_log`  (
  `cl_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '客户回访记录表',
  `cl_cus_id` int(10) DEFAULT NULL COMMENT '回访的客户id',
  `cl_admin_id` int(10) DEFAULT NULL COMMENT '回访的管理员id',
  `cl_mer_id` int(11) DEFAULT NULL COMMENT '回访的商户id',
  `cl_addtime` int(11) DEFAULT NULL COMMENT '回访时间',
  `cl_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '回访备注',
  `cl_isadmin` tinyint(2) DEFAULT NULL COMMENT '是否为平台管理员回访1：是：2 ：否',
  PRIMARY KEY (`cl_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '客户回访记录表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for huhang_designer
-- ----------------------------
DROP TABLE IF EXISTS `huhang_designer`;
CREATE TABLE `huhang_designer`  (
  `des_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '设计师id',
  `des_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设计师编号。系统自动生成的编号，规则同客户编号生成规则',
  `des_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '设计师名称',
  `des_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '设计师头像长方形',
  `des_avatar` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '设计师头像正方形',
  `des_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片alt',
  `des_age` tinyint(4) DEFAULT NULL COMMENT '年龄',
  `des_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '手机号',
  `des_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '邮箱',
  `des_exp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '从业经验',
  `des_tanlent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '擅长风格',
  `des_guand` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '毕业院校',
  `des_remarks` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '设计师简介',
  `des_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示： 1 是；2 否',
  `des_status` tinyint(2) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `des_istop` tinyint(2) DEFAULT 2 COMMENT '置顶： 1 是 ；2 否',
  `des_view` int(11) DEFAULT 0 COMMENT '设计师的浏览量',
  `des_p_id` int(11) DEFAULT NULL COMMENT '省份id',
  `des_c_id` int(11) DEFAULT NULL COMMENT '城市id',
  `des_m_id` int(11) DEFAULT NULL COMMENT '商户id',
  `des_createtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `des_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `dec_admin` int(11) DEFAULT NULL COMMENT '发布人，对应管理员的id',
  `des_seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `des_seo_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'seo描述',
  `des_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  PRIMARY KEY (`des_id`, `des_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 73 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_designer
-- ----------------------------
INSERT INTO `huhang_designer` VALUES (70, '201808030002', '123', '/uploads/commerce/designer/20180803/6e0e3ebf75c4ca73af2477ec775a6955.png', '/uploads/commerce/designer/20180803/97df7833bb665871efcb476c76758871.png', '123', 123, '17694561236', '1549089944@qq.com', '123', '86', '123', NULL, 1, 2, 2, 0, 1, 56, 2, 1533263010, 1533263010, NULL, NULL, NULL, NULL);
INSERT INTO `huhang_designer` VALUES (71, '201808030003', '鲁班七号1', '/uploads/commerce/designer/20180803/6e0e3ebf75c4ca73af2477ec775a6955.png', '/uploads/commerce/designer/20180803/97df7833bb665871efcb476c76758871.png', '123', 123, '17694561236', '1549089944@qq.com', '123', '86,88', '奥术大师多', '12321当过兵的发布 ', 1, 2, 2, 2, 1, 56, 2, 1533266135, 1533267332, NULL, NULL, NULL, '鲁班七号1-只能是 权威 ');
INSERT INTO `huhang_designer` VALUES (72, '201808030004', '123', '/uploads/commerce/designer/20180803/ffb4028c896635070d6fa2a27a831457.png', '/uploads/commerce/designer/20180803/b11ea2c302a4ddb8f92a6f4a85f30650.png', '132154 mnklk', 123, '18256895623', '154@qq.com', '123', '86,88,89', '西安美术越远', '12312312西安美术越远', 1, 1, 2, 3, 1, 56, 2, 1533266495, 1533267335, NULL, NULL, NULL, '123');

-- ----------------------------
-- Table structure for huhang_friendlink
-- ----------------------------
DROP TABLE IF EXISTS `huhang_friendlink`;
CREATE TABLE `huhang_friendlink`  (
  `fl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '友情链接自增id',
  `fl_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '友情链接编号',
  `fl_p_id` int(10) DEFAULT NULL COMMENT '友情链接省份id',
  `fl_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `fl_m_id` int(10) DEFAULT NULL COMMENT '商户id',
  `fl_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '友情链接名称',
  `fl_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '备注，说明',
  `fl_url` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '链接地址',
  `fl_createtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `fl_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `fl_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1：显示，2：隐藏',
  `fl_status` tinyint(2) DEFAULT 1 COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `fl_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶：1：置顶，2：常规',
  `fl_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `fl_isadmin` tinyint(2) DEFAULT NULL COMMENT '添加类型：是否为平台添加，1.平台；2，城市站；3.商户',
  `fl_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  PRIMARY KEY (`fl_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '友情链接表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_friendlink
-- ----------------------------
INSERT INTO `huhang_friendlink` VALUES (1, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (2, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (3, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (4, '201807190001', 1, 56, NULL, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532160612, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (5, '201807190001', 1, 56, NULL, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (6, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (7, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (8, '201807190001', 1, 56, NULL, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (9, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (10, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (11, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (12, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (13, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (14, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);
INSERT INTO `huhang_friendlink` VALUES (15, '201807190001', 1, 56, 1, '百度一下', '', 'https://www.baidu.com/', 1531984150, 1532074363, 1, 2, 2, 1, 1, NULL);

-- ----------------------------
-- Table structure for huhang_honor
-- ----------------------------
DROP TABLE IF EXISTS `huhang_honor`;
CREATE TABLE `huhang_honor`  (
  `h_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '荣誉资质自增id',
  `h_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '荣誉资质编号',
  `h_p_id` int(10) DEFAULT NULL COMMENT '省份id',
  `h_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `h_b_id` int(10) DEFAULT NULL COMMENT '站点id',
  `h_m_id` int(10) DEFAULT NULL COMMENT '商户id',
  `h_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '资质名称',
  `h_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '资质图片',
  `h_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片alt',
  `h_remarks` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '资质简介',
  `h_addtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `h_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `h_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1.显示；2，隐藏',
  `h_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶：1，置顶；2，常规',
  `h_status` tinyint(255) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `h_admin` int(10) DEFAULT NULL COMMENT '发布人：对应管理员id',
  `h_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  PRIMARY KEY (`h_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '荣誉资质表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_honor
-- ----------------------------
INSERT INTO `huhang_honor` VALUES (13, '201807300001', 1, 56, NULL, 2, '这是一个荣誉资质', '/uploads/commerce/honor/20180730/0b8909e67ea8c27bd9969e6e58a177ff.png', '123', '123123', 1532938150, 1532938150, 1, 2, 1, 2, NULL);
INSERT INTO `huhang_honor` VALUES (12, '201807190002', 1, 56, NULL, 1, '陕西省建筑装饰协会2018年度最佳施工单位', '/uploads/article/20180725/d954108fff42dcc3396d7c5ea3c48100.png', '123123', '123123', 1531970302, 1532484934, 1, 2, 2, 1, '');
INSERT INTO `huhang_honor` VALUES (11, '201807190001', 1, 56, NULL, 1, '123', '/uploads/article/20180719/10ed5cf7e50527eb99b9bbfc38a6b45c.jpg', '123', '', 1531970270, 1531970288, 1, 2, 3, 1, '123');

-- ----------------------------
-- Table structure for huhang_loginlog
-- ----------------------------
DROP TABLE IF EXISTS `huhang_loginlog`;
CREATE TABLE `huhang_loginlog`  (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_admin` int(11) DEFAULT NULL COMMENT '管理员，对应admin_id',
  `log_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `log_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '登录日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_menu
-- ----------------------------
DROP TABLE IF EXISTS `huhang_menu`;
CREATE TABLE `huhang_menu`  (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `m_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '菜单名称',
  `m_fid` int(11) DEFAULT NULL COMMENT '菜单父级id',
  `m_control` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '控制器名称，小写',
  `m_action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '方法名，小写',
  `m_sort` int(10) DEFAULT NULL COMMENT '排序',
  `m_type` int(10) DEFAULT NULL COMMENT '菜单类型1.菜单；2.操作',
  `m_icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '菜单图标',
  `m_opeatime` int(11) DEFAULT NULL COMMENT '操作时间',
  `m_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 131 CHARACTER SET = utf8 COLLATE = utf8_bin COMMENT = '菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_merchant
-- ----------------------------
DROP TABLE IF EXISTS `huhang_merchant`;
CREATE TABLE `huhang_merchant`  (
  `mt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商户自增id',
  `mt_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商户编号',
  `mt_p_id` int(10) DEFAULT NULL COMMENT '省份id',
  `mt_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `mt_b_id` int(10) DEFAULT NULL COMMENT '分站id',
  `mt_name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户名称全程',
  `mt_short_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户简称',
  `mt_hotline` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '热线电话',
  `mt_logo` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '商户logo',
  `mt_wechat` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '商户微信二维码',
  `mt_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户地址',
  `mt_location` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户坐标',
  `mt_manger` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户对接人',
  `mt_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '对接人电话（接受短信的手机号 商户账号 手机号）',
  `mt_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '对接人电子邮箱（商户账号email）',
  `mt_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户登录商户后台的密码',
  `mt_services` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '服务类型，存类型的id。',
  `mt_description` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '商户简介',
  `mt_view` int(10) DEFAULT NULL COMMENT '浏览量',
  `mt_order_num` int(10) DEFAULT NULL COMMENT '预约量',
  `mt_recive_num` int(10) DEFAULT 0 COMMENT '接单量',
  `mt_addtime` int(11) DEFAULT NULL COMMENT '商户入驻时间',
  `mt_updatetime` int(11) DEFAULT NULL COMMENT '操作修改时间',
  `mt_admin` int(10) DEFAULT NULL COMMENT '操作人id，对应管理员表id',
  `mt_templet` int(10) DEFAULT NULL COMMENT '商家模板id',
  `mt_rank` tinyint(2) DEFAULT NULL COMMENT '商户等级：1：未认证（仅平台注册），2：已认证（该商户提交了认证资料并通过了审核），3：专业版（在平台交了钱）；4旗舰版（交了更多的钱）',
  `mt_status` tinyint(2) DEFAULT NULL COMMENT '商户状态：1：开启；2：关闭',
  `mt_money` int(11) DEFAULT NULL COMMENT '商户充值的金额（金额大于0，表示通过口碑认证）',
  `mt_deadline` int(11) DEFAULT NULL COMMENT '商户的有效期限',
  `mt_recive_area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户可接单的面积范围。对应空间大小的id，多个用‘，’隔开，',
  `mt_recive_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '商户可简单的项目类型。对应项目类型的id，多个用‘，’隔开，',
  `mt_service_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户可简单的服务类型。对应服务类型的id，多个用‘，’隔开，',
  PRIMARY KEY (`mt_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商家表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_merchant
-- ----------------------------
INSERT INTO `huhang_merchant` VALUES (1, '201808150001', 1, 56, 62, '商洛市人民银行', '西安千百炼1', '400-029-1986', '/uploads/platform/20180721/d32b22842e6b10c5a43fd522fc553204.png,/uploads/platform/20180721/d32b22842e6b10c5a43fd522fc553204.png', NULL, '陕西省西安市未央区辛家庙地铁C口千百炼', '33.871720,109.934230', '鲁班七号', '15899996611', '1122@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '千百炼家装集团致力于打造让客户拎包入住的整体装修模式，努力践行 “千锤百炼，钻石品质” 的企业承诺，为客户提供省力、省心又省钱的装修体验势在必行！', 123, 211, 123, 1531468114, 1531468114, 1, 2, 1, 1, 0, 1534059454, NULL, '', '2,4');
INSERT INTO `huhang_merchant` VALUES (2, '201808150001', 1, 56, 62, '陕西中鑫盛邦实业发展有限公司', '中鑫盛邦', '029-88345766   /   400-1186-001', '/uploads/superior/20180813/75c32ab90ff35e35fdce64fa1b8c228b.png,/uploads/superior/20180813/0692ce2e5c568700a219d50faa22548d.png', '/uploads/superior/20180813/21ceb7ad9bc2619e93365481231739d6.jpg', '陕西省西安市高新六路北口米罗蓝山东门1-4层', '34.304117,108.9965791', '小鑫', '15899996666', '281534867@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '   中鑫盛邦实业发展有限公司是一家在地产、商业、教育、市政、生态农业、健康养生等方面全面发展的多元化平台，经营范围涉及装饰设计及施工、市政工程、弱电工程、钢结构工程、建材家居销售等。\r\n\r\n       公司在保持传统建筑装修装饰业务的前提下，与多家知名地产万科地产、碧桂园地产、凯德集团等达成配套精装修战略合作，成为装修行业地产配套精装领航军。', 234, 985, 253, 1534145912, 1531468114, 1, 1, 1, 1, 2, NULL, '1,2', '86,88', '1,2,4');

-- ----------------------------
-- Table structure for huhang_merchant_admin
-- ----------------------------
DROP TABLE IF EXISTS `huhang_merchant_admin`;
CREATE TABLE `huhang_merchant_admin`  (
  `ma_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商家管理员id',
  `ma_mt_id` int(10) NOT NULL COMMENT '商户id',
  `ma_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '登录手机号',
  `ma_emails` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '登录邮箱',
  `ma_pasword` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '登录密码',
  `ma_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`ma_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商户管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_merchant_admin
-- ----------------------------
INSERT INTO `huhang_merchant_admin` VALUES (1, 1, '18522223333', '110@qq.com', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `huhang_merchant_admin` VALUES (2, 2, '15699996688', '120@qq.co', 'e10adc3949ba59abbe56e057f20f883e', NULL);

-- ----------------------------
-- Table structure for huhang_merchant_manager
-- ----------------------------
DROP TABLE IF EXISTS `huhang_merchant_manager`;
CREATE TABLE `huhang_merchant_manager`  (
  `mtm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户管理员id',
  `mtm_mt_id` int(10) DEFAULT NULL COMMENT '商户id',
  `mtm_manager` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员名字',
  `mtm_id_card` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员身份证号',
  `mtm_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员手机号',
  `mtm_emails` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员邮箱',
  `mtm_id_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '身份证正面',
  `mtm_id_imgs` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '身份证反面',
  `mtm_adddtime` int(11) DEFAULT NULL COMMENT '提交时间',
  `mtm_is_identy` tinyint(2) DEFAULT NULL COMMENT '是否通过验证1，待审核，2已通过，3 未通过',
  `mtm_identy_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  `mtm_identy_time` int(11) DEFAULT NULL COMMENT '验证时间',
  `mtm_identy_admin` int(10) DEFAULT NULL COMMENT '验证人，对应平台管理员id',
  PRIMARY KEY (`mtm_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商户管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_merchant_manager
-- ----------------------------
INSERT INTO `huhang_merchant_manager` VALUES (9, 2, '夜微凉123', '612501199309106322123', '182220995991123', '110@QQ.COM123', '/uploads/commerce/designer/20180809/c1b4a487a0000c0e95d62ca300ec28ef.jpg', '/uploads/commerce/designer/20180809/c75c388d0f075ca3d5f5184ca185d407.png', 1533795739, 3, '123123', 1533801897, 1);

-- ----------------------------
-- Table structure for huhang_merchant_order
-- ----------------------------
DROP TABLE IF EXISTS `huhang_merchant_order`;
CREATE TABLE `huhang_merchant_order`  (
  `mo_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商户预约自增id',
  `mo_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户预约编号',
  `mo_c_id` int(10) DEFAULT NULL COMMENT '预约城市',
  `mo_merchant` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户名称',
  `mo_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户电话',
  `mo_manger` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商户联系人',
  `mo_addtime` int(10) DEFAULT NULL COMMENT '投标时间',
  PRIMARY KEY (`mo_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_merchant_order
-- ----------------------------
INSERT INTO `huhang_merchant_order` VALUES (1, '201807290001', 56, '微梦集团', '18220995911', '党萌萌', 1532843886);
INSERT INTO `huhang_merchant_order` VALUES (2, '201807290002', 56, '132456', '11566552233', '小猪猪', 1532843932);
INSERT INTO `huhang_merchant_order` VALUES (3, '201807290003', 56, '132456789', '15622223333', '傻帆子', 1532844030);
INSERT INTO `huhang_merchant_order` VALUES (4, '201807290004', 56, '123', '18566699952', '123', 1532844093);
INSERT INTO `huhang_merchant_order` VALUES (5, '201807290005', 56, '123', '18955662233', '123', 1532844168);
INSERT INTO `huhang_merchant_order` VALUES (6, '201807290006', 56, '123', '18699552233', '123', 1532844180);
INSERT INTO `huhang_merchant_order` VALUES (7, '201807290007', 56, '微萌科技', '12345678998', '党萌萌', 1532851004);

-- ----------------------------
-- Table structure for huhang_merchant_verify
-- ----------------------------
DROP TABLE IF EXISTS `huhang_merchant_verify`;
CREATE TABLE `huhang_merchant_verify`  (
  `mtv_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商户信息认证表id',
  `mtv_mt_id` int(10) DEFAULT NULL COMMENT '商户基本信息表商户id',
  `mtv_merchant_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '公司全称',
  `mtv_merchant_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '社会认证统一信用代码',
  `mtv_merchant_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '营业执照注册地址',
  `mtv_law_er` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '法人姓名',
  `mtv_low_id_card` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '法人身份证号',
  `mtv_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '联系方式',
  `mtv_tel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '座机号',
  `mtv_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '电子邮箱',
  `mtv_id_card_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '法人身份证正面',
  `mtv_id_card_imgs` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '身份证反面',
  `mtv_licence_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '营业执照扫描件',
  `mtv_permit_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '公户开户许可证',
  `mtv_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `mtv_is_aut` tinyint(2) DEFAULT NULL COMMENT '是否通过认证：1待认证，2通过，3驳回',
  `mtv_aut_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  `mtv_aut_time` int(11) DEFAULT NULL COMMENT '认证处理时间',
  `mtv_admin` int(10) DEFAULT NULL COMMENT '处理管理员，对应后台登录id',
  PRIMARY KEY (`mtv_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商户信息认证表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_merchant_verify
-- ----------------------------
INSERT INTO `huhang_merchant_verify` VALUES (1, 2, '123', '123', '123', '123', '612501199309106322', '18222099599', '123123', '123@qq.com', '/uploads/commerce/designer/20180808/1a7cb410e91e80e625ed61da6482d144.png', '/uploads/commerce/designer/20180808/f1828cfb61284764330e38973ad162b5.png', '/uploads/commerce/designer/20180808/3cb8268144d6e06ccf7c521ff528402b.png', '/uploads/commerce/designer/20180808/a3803853624d69250baa3e3e8967e0b5.png', 1533699479, 3, '1233', 1533801965, 1);

-- ----------------------------
-- Table structure for huhang_nav
-- ----------------------------
DROP TABLE IF EXISTS `huhang_nav`;
CREATE TABLE `huhang_nav`  (
  `nav_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '导航id',
  `nav_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '导航标题',
  `nav_fid` int(10) DEFAULT NULL COMMENT '导航父级id',
  `nav_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '导航图片',
  `nav_hover_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '悬停图片',
  `nav_seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `nav_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  `nav_seo_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo描述',
  `nav_order` tinyint(255) DEFAULT NULL COMMENT '导航排序数字越大越靠前',
  `nav_isable` tinyint(4) DEFAULT NULL COMMENT '是否显示：1 显示；2 隐藏',
  `nav_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '导航链接',
  `nav_opeatime` int(11) DEFAULT NULL COMMENT '操作时间',
  `nav_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `nav_type` tinyint(2) DEFAULT NULL COMMENT '导航类型：1.站点导航；2.商户导航',
  PRIMARY KEY (`nav_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 79 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '前端网站导航' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_nav
-- ----------------------------
INSERT INTO `huhang_nav` VALUES (71, '首页', 0, '', '', '首页', '首页', '首页', 10, 1, 'index/index', 1532507504, 1, 2);
INSERT INTO `huhang_nav` VALUES (50, '项目案例', 0, '', '', '项目案例', '项目案例', '项目案例', 9, 1, 'example/index', 1532508093, 1, 1);
INSERT INTO `huhang_nav` VALUES (51, '工装招标', 0, '', '', '工装招标', '工装招标', '工装招标', 8, 1, 'bidding/index', 1532508106, 1, 1);
INSERT INTO `huhang_nav` VALUES (52, '发布项目', 0, '', '', '发布项目', '发布项目', '发布项目', 6, 1, 'example/release', 1532508117, 1, 1);
INSERT INTO `huhang_nav` VALUES (53, '装饰公司', 0, '', '', '装饰公司', '装饰公司', '装饰公司', 5, 1, 'company/index', 1532508127, 1, 1);
INSERT INTO `huhang_nav` VALUES (73, '公司动态', 0, '', '', '公司动态', '公司动态', '公司动态', 8, 1, 'company/news', 1532507534, 1, 2);
INSERT INTO `huhang_nav` VALUES (74, '发布项目', 0, '', '', '发布项目', '发布项目', '发布项目', 7, 1, 'example/release', 1532507552, 1, 2);
INSERT INTO `huhang_nav` VALUES (68, '本地资讯', 0, '', '', '本地资讯', '本地资讯', '本地资讯', 3, 1, 'news/index', 1532508154, 1, 1);
INSERT INTO `huhang_nav` VALUES (69, '城市加盟', 0, '', '', '城市加盟', '城市加盟', '城市加盟', 2, 0, 'join/index', 1532510312, 1, 1);
INSERT INTO `huhang_nav` VALUES (70, '首页', 0, '', '', '首页', '首页', '首页', 10, 1, 'index/index', 1532507494, 1, 1);
INSERT INTO `huhang_nav` VALUES (72, '公司简介', 0, '', '', '公司简介', '公司简介', '公司简介', 9, 1, 'company/profile', 1532507520, 1, 2);
INSERT INTO `huhang_nav` VALUES (67, '服务保障', 0, '', '', '服务保障', '服务保障', '服务保障', 4, 1, 'service/index', 1532508137, 1, 1);
INSERT INTO `huhang_nav` VALUES (75, '装修案例', 0, '', '', '装修案例', '装修案例', '装修案例', 6, 1, 'example/index', 1532507563, 1, 2);
INSERT INTO `huhang_nav` VALUES (76, '荣誉资质', 0, '', '', '荣誉资质', '荣誉资质', '荣誉资质', 5, 1, 'company/honor', 1532507583, 1, 2);
INSERT INTO `huhang_nav` VALUES (77, '人才招聘', 0, '', '', '人才招聘', '人才招聘', '人才招聘', 4, 1, 'wanted/index', 1532507609, 1, 2);
INSERT INTO `huhang_nav` VALUES (78, '关于我们', 0, '', '', '关于我们', '关于我们', '关于我们', 3, 1, 'company/about', 1532507598, 1, 2);

-- ----------------------------
-- Table structure for huhang_province
-- ----------------------------
DROP TABLE IF EXISTS `huhang_province`;
CREATE TABLE `huhang_province`  (
  `p_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '省份id',
  `p_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '省份名称',
  `p_opeatime` int(11) DEFAULT NULL COMMENT '操作时间',
  `p_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  PRIMARY KEY (`p_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_province
-- ----------------------------
INSERT INTO `huhang_province` VALUES (1, '陕西', 1531822356, 1);
INSERT INTO `huhang_province` VALUES (2, '云南', 1531822362, 1);
INSERT INTO `huhang_province` VALUES (3, '湖北', 1531822369, 1);
INSERT INTO `huhang_province` VALUES (4, '湖南', 1531822376, 1);
INSERT INTO `huhang_province` VALUES (6, '北京', 1532324784, 1);
INSERT INTO `huhang_province` VALUES (5, '上海', 1532167102, 1);
INSERT INTO `huhang_province` VALUES (7, '浙江', 1532324911, 1);
INSERT INTO `huhang_province` VALUES (8, '江苏', 1532325004, 1);

-- ----------------------------
-- Table structure for huhang_question
-- ----------------------------
DROP TABLE IF EXISTS `huhang_question`;
CREATE TABLE `huhang_question`  (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '问答自增id',
  `qa_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '问答编号',
  `qa_p_id` int(10) DEFAULT NULL COMMENT '省份id',
  `qa_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `qa_b_id` int(10) DEFAULT NULL COMMENT '站点id',
  `qa_m_id` int(10) DEFAULT NULL COMMENT '商户id',
  `qa_ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户ip',
  `qa_question` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '问题内容',
  `qa_addtime` int(10) DEFAULT NULL COMMENT '提问时间',
  `qa_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶',
  `qa_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示：1，显示；2.隐藏',
  `qa_status` tinyint(2) DEFAULT 2 COMMENT '审核状态：1，待审核；2.通过，3驳回',
  `qa_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  `qa_admin` int(10) DEFAULT NULL COMMENT '审核人',
  `qa_type` tinyint(2) DEFAULT NULL COMMENT '问题类型：1 后台发布；2 客户提问',
  PRIMARY KEY (`qa_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_question
-- ----------------------------
INSERT INTO `huhang_question` VALUES (6, '201808030001', 1, 56, NULL, 2, NULL, '便当盒还有几个？', 1533277417, 2, 1, 2, NULL, 2, 1);
INSERT INTO `huhang_question` VALUES (4, '201807190001', 1, 56, NULL, 0, NULL, '因为我是孕妈妈，所以对材料上要求都要环保，不知道你们公司用的材料都有哪些？', 1531964654, 2, 1, 2, '2', 1, 1);
INSERT INTO `huhang_question` VALUES (5, '201807190002', 1, 56, NULL, 0, NULL, '“千百炼装饰”是一家什么样的公司？', 1531971749, 2, 1, 2, '2', 1, 1);

-- ----------------------------
-- Table structure for huhang_role
-- ----------------------------
DROP TABLE IF EXISTS `huhang_role`;
CREATE TABLE `huhang_role`  (
  `r_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `r_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '权限编号',
  `r_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '权限名称',
  `r_power` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '权限设置，对应菜单的id',
  `r_opeatime` int(11) DEFAULT NULL COMMENT '操作时间',
  `r_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  PRIMARY KEY (`r_id`, `r_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_bin COMMENT = '管理员权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_role
-- ----------------------------
INSERT INTO `huhang_role` VALUES (1, '123', '炒鸡管理员', '123', NULL, 1);

-- ----------------------------
-- Table structure for huhang_service_type
-- ----------------------------
DROP TABLE IF EXISTS `huhang_service_type`;
CREATE TABLE `huhang_service_type`  (
  `st_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服务类型自增id',
  `st_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '服务类型名称',
  `st_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '服务类型备注',
  `st_isable` tinyint(2) DEFAULT NULL COMMENT '是否显示',
  `st_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `st_order` int(10) DEFAULT 0 COMMENT '类型排序',
  `st_admin` int(10) DEFAULT NULL COMMENT '操作人',
  PRIMARY KEY (`st_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '服务类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_service_type
-- ----------------------------
INSERT INTO `huhang_service_type` VALUES (1, '设计服务', '设计服务设计服务设计服务', 1, 1531368236, 0, 1);
INSERT INTO `huhang_service_type` VALUES (2, '施工服务', '施工服务施工服务施工服务', 1, 1531361014, 0, 1);
INSERT INTO `huhang_service_type` VALUES (4, '家具软装', '家具软装家具软装家具软装', 1, 1532857322, 0, 1);

-- ----------------------------
-- Table structure for huhang_setinfo
-- ----------------------------
DROP TABLE IF EXISTS `huhang_setinfo`;
CREATE TABLE `huhang_setinfo`  (
  `s_id` int(100) NOT NULL AUTO_INCREMENT COMMENT '基本配置自增键',
  `s_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '系统配置key',
  `s_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '解释说明',
  `s_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '配置值',
  `s_is_able` tinyint(2) DEFAULT 1 COMMENT '是否可用',
  `s_opeatime` int(11) DEFAULT NULL COMMENT '操作时间',
  `s_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `s_type` tinyint(2) DEFAULT NULL COMMENT '设置的类型；1 短信配置',
  PRIMARY KEY (`s_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_setinfo
-- ----------------------------
INSERT INTO `huhang_setinfo` VALUES (8, 'plat_name', '123', '公装护航', 1, 1531456669, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (9, 'plat_logo', '平台logo', '/uploads/platform/20180721/d32b22842e6b10c5a43fd522fc553204.png', 1, 1532155770, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (10, 'plat_tel', '站点电话', '029-88867375', 1, 1531460539, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (11, 'plat_wechat', '平台微信二维码', '/uploads/platform/20180713/e6f0dc556969ec4a6136ff726de69496.jpg', 1, 1531460827, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (12, 'plat_weibo', '平台微博', '/uploads/platform/20180713/170645d75f7aea072845e136947c6d51.jpg', 1, 1531461402, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (13, 'plat_company_name', '陕西华顺志诚网络科技有限公司', '陕西华顺志诚网络科技有限公司', 1, 1531461465, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (14, 'plat_record', '平台备案号', '陕ICP备17003733号', 1, 1531461524, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (15, 'plat_url', '站点域名', 'huhang.com', 1, 1531476891, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (16, '接单时间', '接单时间/否则自动提醒平台重新加派一家', '5分钟', 1, 1531556894, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (17, '派单家数', '派单家数/一条订单信息，最多可派多少家', '4家', 1, 1531556963, 1, NULL);
INSERT INTO `huhang_setinfo` VALUES (19, 'plat_address', '平台地址', '陕西省西安市高新六路公装护航网', 1, 1532329428, 1, NULL);

-- ----------------------------
-- Table structure for huhang_smstem
-- ----------------------------
DROP TABLE IF EXISTS `huhang_smstem`;
CREATE TABLE `huhang_smstem`  (
  `sms_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '阿里云短信模板id',
  `sms_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '短信模板名称',
  `sms_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '短信模板,以sms开头的一串字母',
  `sms_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '模板内容',
  `sms_remarks` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '模板说明',
  `sms_addtime` int(11) DEFAULT NULL COMMENT '操作时间',
  `sms_admin` int(10) DEFAULT NULL COMMENT '操作人',
  `sms_type` tinyint(2) DEFAULT NULL COMMENT '模板类型：1.管理员通知；2.普通预约；3报价预约；4量房预约；5活动预约，6设计预约',
  PRIMARY KEY (`sms_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '阿里云短信模板' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_space
-- ----------------------------
DROP TABLE IF EXISTS `huhang_space`;
CREATE TABLE `huhang_space`  (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '空间大小自增id',
  `sp_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '空间名称',
  `sp_min` int(10) DEFAULT NULL COMMENT '最小值',
  `sp_max` int(10) DEFAULT NULL COMMENT '最大值',
  `sp_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `sp_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '空间备注',
  `sp_order` int(10) DEFAULT NULL COMMENT '空间排序',
  `sp_isable` tinyint(2) DEFAULT NULL COMMENT '是否显示：1.显示，2隐藏',
  `sp_admin` int(10) DEFAULT NULL COMMENT '操作人，管理员id',
  PRIMARY KEY (`sp_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '空间大小表配置参数' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_space
-- ----------------------------
INSERT INTO `huhang_space` VALUES (1, '200平以下', 0, 200, 1531194319, '200平以下', 8, 1, 1);
INSERT INTO `huhang_space` VALUES (2, '201-600平', 201, 600, 1531194349, '201-600平', 7, 1, 1);
INSERT INTO `huhang_space` VALUES (3, '601-1000平', 601, 1000, 1531194365, '601-1000平', 6, 1, 1);
INSERT INTO `huhang_space` VALUES (4, '1001-2000平', 1001, 2000, 1531194386, '1001-2000平', 5, 1, 1);
INSERT INTO `huhang_space` VALUES (5, '2001-4000平', 2001, 4000, 1531194407, '2001-4000平', 4, 1, 1);
INSERT INTO `huhang_space` VALUES (7, '8000平以上', 8001, 100000, 1531194456, '8000平以上', 2, 1, 1);
INSERT INTO `huhang_space` VALUES (8, '4001-8000平', 4001, 8000, 1531206052, '4001-8000平', 3, 1, 1);

-- ----------------------------
-- Table structure for huhang_suggestion
-- ----------------------------
DROP TABLE IF EXISTS `huhang_suggestion`;
CREATE TABLE `huhang_suggestion`  (
  `sg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投诉建议自增id',
  `sg_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '建议编号',
  `sg_type` tinyint(2) DEFAULT NULL COMMENT '投诉类型：1.投诉商家；2.投诉平台；3.投诉员工；4.其他意见；5.鼓励表扬',
  `sg_ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '投诉ip',
  `sg_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '投诉内容',
  `sg_link` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '投诉人联系方式',
  `sg_addtime` int(11) DEFAULT NULL COMMENT '投诉时间',
  `sg_updatetime` int(11) DEFAULT NULL COMMENT '投诉处理时间',
  `sg_admin` int(10) DEFAULT NULL COMMENT '投诉处理人，管理员id',
  PRIMARY KEY (`sg_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '投诉建议表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_suggestion
-- ----------------------------
INSERT INTO `huhang_suggestion` VALUES (6, '201807190002', 1, '127.0.0.1', '123', '18555556666', 1531995511, 1531995511, NULL);
INSERT INTO `huhang_suggestion` VALUES (9, '201807260001', 1, '127.0.0.1', '这个商家卖的东西是假冒伪劣产品', '110', 1532567932, 1532567932, NULL);
INSERT INTO `huhang_suggestion` VALUES (10, '201807260002', 3, '127.0.0.1', '欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！欢迎反馈问题，您的建议就是我们的动力！', '123', 1532568202, 1532568202, NULL);
INSERT INTO `huhang_suggestion` VALUES (11, '201808100001', 1, '127.0.0.1', '123', '123', 1533894318, 1533894318, NULL);

-- ----------------------------
-- Table structure for huhang_templet
-- ----------------------------
DROP TABLE IF EXISTS `huhang_templet`;
CREATE TABLE `huhang_templet`  (
  `tem_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模板自增id',
  `tem_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '模板编号',
  `tem_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '模板名称',
  `tem_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '文件存放路径',
  `tem_type` tinyint(2) DEFAULT NULL COMMENT '模板类型：1，商户模板；2.分站模板',
  `tem_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '模板简介',
  `tem_addtime` int(11) DEFAULT NULL COMMENT '模板添加时间',
  `tem_isable` tinyint(2) DEFAULT NULL COMMENT '是否显示：1.显示；2.隐藏',
  `tem_admin` int(10) DEFAULT NULL COMMENT '添加人员；对应管理员id',
  PRIMARY KEY (`tem_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '前端模板表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_templet
-- ----------------------------
INSERT INTO `huhang_templet` VALUES (1, '201807140001', '默认模板', 'superior', 1, '默认模板', 1532083787, 1, 1);
INSERT INTO `huhang_templet` VALUES (2, '201807140002', '普通模板', 'merchant', 1, '普通模板', 1525767570, 1, 1);
INSERT INTO `huhang_templet` VALUES (3, '201807140003', '默认模板', 'default', 2, '普通模板', 1532083762, 1, 1);
INSERT INTO `huhang_templet` VALUES (4, '201807140004', '普通模板', 'index', 2, '普通模板', 1525767570, 1, 1);

-- ----------------------------
-- Table structure for huhang_topic
-- ----------------------------
DROP TABLE IF EXISTS `huhang_topic`;
CREATE TABLE `huhang_topic`  (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专题id',
  `tp_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '专题编号。系统自动生成的编号，规则同客户编号生成规则',
  `tp_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '专题名称',
  `tp_p_id` int(10) DEFAULT NULL COMMENT '省份',
  `tp_c_id` int(10) DEFAULT NULL COMMENT '城市',
  `tp_b_id` int(10) DEFAULT NULL COMMENT '站点id',
  `tp_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '专题内容（万能编辑器）',
  `tp_view` int(11) DEFAULT 0 COMMENT '浏览量',
  `tp_seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `tp_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  `tp_seo_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo描述',
  `tp_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示',
  `tp_createtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `tp_admin` int(10) DEFAULT NULL COMMENT '发布人，对应管理员的id',
  PRIMARY KEY (`tp_id`, `tp_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '专题文章' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_topics
-- ----------------------------
DROP TABLE IF EXISTS `huhang_topics`;
CREATE TABLE `huhang_topics`  (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专题id',
  `tp_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '专题二编号。系统自动生成的编号，规则同客户编号生成规则',
  `tp_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '专题名称',
  `tp_p_id` int(10) DEFAULT NULL COMMENT '省份',
  `tp_c_id` int(10) DEFAULT NULL COMMENT '城市',
  `tp_b_id` int(10) DEFAULT NULL COMMENT '站点',
  `tp_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '专题内容（万能编辑器）',
  `tp_topic_url` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '推广链接',
  `tp_view` int(11) DEFAULT 0 COMMENT '浏览量',
  `tp_seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `tp_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  `tp_seo_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo描述',
  `tp_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示',
  `tp_createtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `tp_admin` int(10) DEFAULT NULL COMMENT '发布人，对应管理员的id',
  PRIMARY KEY (`tp_id`, `tp_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '专题文章' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_type
-- ----------------------------
DROP TABLE IF EXISTS `huhang_type`;
CREATE TABLE `huhang_type`  (
  `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类型id',
  `type_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '类型名称',
  `type_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '封面图',
  `type_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '若为项目类型，则是单位标价；若是等级指数则为等级积分',
  `type_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '类型描述',
  `type_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `type_sort` tinyint(4) DEFAULT NULL COMMENT '类型分类1.项目类型；2.等级指数;3.装修品质；4文章类型；5.客户联系人身份',
  `type_isable` tinyint(2) DEFAULT NULL COMMENT '是否可用',
  `type_admin` int(10) DEFAULT NULL COMMENT '操作人，对应管理员id',
  `type_order` int(10) DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 126 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '各种类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_type
-- ----------------------------
INSERT INTO `huhang_type` VALUES (85, '办公空间', '/uploads/type/20180709/4e3d829f139a8f972a6a263c3aecae97.png', '2343', '123123', 1531125150, NULL, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (86, '办公空间', '/uploads/type/20180710/5be4bdf610a45086918d08e3c5054a43.png', '102', '办公空间办公空间办公空间', 1531456719, 1, 1, 1, 6);
INSERT INTO `huhang_type` VALUES (88, '餐饮空间', '/uploads/type/20180710/49cff578f54af20c257baa3990f441a2.png', '110', '餐饮空间餐饮空间餐饮空间', 1531445672, 1, 1, 1, 5);
INSERT INTO `huhang_type` VALUES (89, '酒店会所', '/uploads/type/20180710/34e6c7bd369eb41f5ddccfd9d6b9fe17.png', '123', '酒店会所酒店会所酒店会所', 1531445692, 1, 1, 1, 4);
INSERT INTO `huhang_type` VALUES (90, '教育培训', '/uploads/type/20180710/d4d544d9e44488f67cf5a9bbc088582c.png', '111', '教育培训教育培训教育培训', 1531445761, 1, 1, 1, 3);
INSERT INTO `huhang_type` VALUES (109, '本地生活', NULL, NULL, '本地生活本地生活', 1531885449, 4, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (110, '行业新闻', NULL, NULL, '行业新闻行业新闻', 1532588397, 4, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (92, '地产精装', '/uploads/type/20180710/327515820b89ff32486133ed1a6375ff.png', '120', '地产精装地产精装地产精装', 1531445682, 1, 1, 1, 2);
INSERT INTO `huhang_type` VALUES (93, '购物空间', '/uploads/type/20180710/d1c3c92161d8878cd35ca56eae3ea075.png', '1123', '其他空间其他空间其他空间', 1531972815, 1, 1, 1, 1);
INSERT INTO `huhang_type` VALUES (95, 'rank123', '/uploads/type/20180710/7f97687ac40677e84e43d768bbe42296.jpg', '521', 'rank_1rank_1rank_1', 1531207427, 2, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (99, '经济适用', NULL, NULL, '经济适用', 1531365776, 3, 1, 1, 1);
INSERT INTO `huhang_type` VALUES (97, 'rank_1', '/uploads/type/20180710/a2d32ed077927dc2baaae4577063aafd.jpg', '20', '这是第一个等级', 1531207400, 2, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (98, 'rank_5', '/uploads/type/20180710/7f97687ac40677e84e43d768bbe42296.jpg', '30', 'rank_1rank_1rank_112312', 1531207415, 2, 1, 1, 30123);
INSERT INTO `huhang_type` VALUES (108, '风水指南', NULL, NULL, '风水指南风水指南', 1531618021, 4, 1, 1, 2);
INSERT INTO `huhang_type` VALUES (102, '高档品质', NULL, NULL, '高档品质', 1531460710, 3, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (103, '高档奢华', NULL, NULL, '高档奢华', 1531537045, 3, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (106, '设计指南', NULL, NULL, '设计指南设计指南', 1531618003, 4, 1, 1, 1);
INSERT INTO `huhang_type` VALUES (107, '施工指南', NULL, NULL, '施工指南施工指南', 1531618012, 4, 1, 1, 1);
INSERT INTO `huhang_type` VALUES (111, '企业动态', NULL, NULL, '企业动态企业动态', 1532588407, 4, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (117, '合同负责人', NULL, NULL, '合同负责人', 1531885934, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (116, '行政', NULL, NULL, '行政', 1531885690, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (115, '副总', NULL, NULL, '副总', 1531885923, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (118, '财务', NULL, NULL, '财务', 1531885943, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (119, '合伙人', NULL, NULL, '合伙人', 1531885951, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (120, '老板', NULL, NULL, '老板', 1531885959, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (121, '老板助理', NULL, NULL, '老板助理', 1531885968, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (122, '引荐人', NULL, NULL, '引荐人', 1531885981, 5, 1, 1, 0);
INSERT INTO `huhang_type` VALUES (125, '其他空间', '/uploads/type/20180721/0212b71d69f4ed6804d4f01fdd891b41.png', '12', '13165', 1532154416, 1, 1, 1, 0);

-- ----------------------------
-- Table structure for huhang_user_status
-- ----------------------------
DROP TABLE IF EXISTS `huhang_user_status`;
CREATE TABLE `huhang_user_status`  (
  `us_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户状态表',
  `us_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '状态',
  `us_remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '备注',
  `us_order` int(10) DEFAULT NULL COMMENT '排序',
  `us_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `us_isable` tinyint(2) DEFAULT NULL COMMENT '是否显示，1显示；2隐藏',
  `us_sort` tinyint(2) DEFAULT NULL COMMENT '状态类型：1',
  `us_admin` int(10) DEFAULT NULL COMMENT '对应的操作的管理员id',
  PRIMARY KEY (`us_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of huhang_user_status
-- ----------------------------
INSERT INTO `huhang_user_status` VALUES (1, '未接通', '打电话，客户但是没接，准备以后再打', 1, 1533880600, 1, 1, 1);
INSERT INTO `huhang_user_status` VALUES (3, '已签约1', '已签约已签约已签约1', 3, 1533882813, 2, 1, 1);

-- ----------------------------
-- Table structure for huhang_wanted
-- ----------------------------
DROP TABLE IF EXISTS `huhang_wanted`;
CREATE TABLE `huhang_wanted`  (
  `wt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '人才招聘自增id',
  `wt_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '人才招聘编号系统自动生成的编号',
  `wt_p_id` int(10) DEFAULT NULL COMMENT '省份id',
  `wt_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `wt_b_id` int(10) DEFAULT NULL COMMENT '站点id',
  `wt_m_id` int(10) DEFAULT NULL COMMENT '商家id',
  `wt_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '职位名称',
  `wt_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '工作地点',
  `wt_salary` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '薪资待遇',
  `wt_num` int(10) DEFAULT NULL COMMENT '招聘人数单位人；特别注意数据类型。',
  `wt_addtime` int(11) DEFAULT NULL COMMENT '发布日期',
  `wt_updatetime` int(11) DEFAULT NULL COMMENT '更新日期',
  `wt_deadline` int(11) DEFAULT NULL COMMENT '有效截止',
  `wt_duty` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '岗位职责',
  `wt_skills` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '任职要求',
  `wt_admin` int(10) DEFAULT NULL COMMENT '发布人，对应的登录管理员id',
  `wt_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示:1,显示；2.隐藏',
  `wt_status` tinyint(2) DEFAULT NULL COMMENT '显示状态：1.待审核；2.通过；3.驳回',
  `wt_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶：1，置顶；2 常规',
  `wt_view` int(10) DEFAULT NULL COMMENT '浏览量',
  `wt_seo_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo-title',
  `wt_seo_keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'wt_seo_keywords',
  `wt_seo_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'wt_seo_description',
  `wt_tip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '审核备注',
  PRIMARY KEY (`wt_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '人才招聘表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of huhang_wanted
-- ----------------------------
INSERT INTO `huhang_wanted` VALUES (23, '201807300001', 1, 56, NULL, 2, 'PHP程序员1', NULL, '40001-80001', 21, 1532940862, 1532940566, 1535040000, '<p>1.负责协助技术总监进行技术评测，bug处理，代码开发；</p><p>2.负责网站数据库、栏目、程序模块的设计与开发；</p><p>3.负责根据公司要求进行erp、oa、crm系统等项目开发；</p><p>4.定期与培训部和测试部沟通，获取反馈信息并进行相应的处理；</p><p>5.按时按质完成公司下达程度开发、系统评测等工作任务；</p><p>6.定期维护网站程序，处理反馈回来的系统bug；</p><p>7.网站程序开发文档的编写。1</p><div><br></div>', '<p>1、精通html、CSS、JS等网站前端技术。</p><p>2、掌握PHP编程技术。</p><p>3、了解Linux及Apache、MySql</p><p>4、知道基本的网络原理，了解TCP/IP协议。</p><p>5、了解基本的软件工程知识和软件设计技术。</p><p>必须具备的基础知识：</p><p>1、LAMP技术(加强)：Linux+Apache+Mysql+PHP,是PHP网站最普遍的架构之一，也是效率最好的架构之一。</p><p>2、对潜在的安全漏洞有深刻的理解。如：SQL注入漏洞、字符编码循环、跨站脚本攻击(XSS)、跨站请求伪造(CSRF)。(好陌生 – -！)</p><p>3、掌握MVC模式：Model(模式)、View(视图）、Controller（控制器）。</p><p>4、其他：面向对象编程（OOP）、PHP缓存技术、PHP相关开发框架、软件重构技术、软件设计模式。</p><p>必须掌握的工具：</p><p>1、PHPMyAdmin（安装完LAMP以后第一个安装的工具）。</p><p>2、PHPDocumenter，会从PHP中找到所有的逻辑结构。</p><p>3、Zend，专业PHP集成开发环境，是php程序员首选IDE工具。1</p><div><br></div>', 2, 1, 1, 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `huhang_wanted` VALUES (20, '201807190001', 0, 0, NULL, 0, '', NULL, '-', 0, 1531970347, 1531970347, 0, '', '', 1, 1, 2, 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `huhang_wanted` VALUES (21, '201807190001', 1, 56, NULL, 1, '网络客户经理', NULL, '6000-8000', 10, 1533864756, 1531970896, 1535299200, '<p></p><p style=\"text-align: center;\"></p><p style=\"text-align: left;\">1.网络推广（QQ群、论坛、博客、微博、微信、社交媒体等）；</p><p></p><p>2.网站编辑（软文贴、SEO文章编写、营销活动帖）；</p><p></p><p>3.网站填充（案例、设计资料整理、工地、视频等上传）</p><p>4.网站优化工作（发外连接、站内图片文字修改、友情链接交换等)；</p><p>5.合作的网络渠道管理（渠道内容上传、信息统计）；</p><p>6.重点楼盘调研、活动策划、执行；</p><p>7.客户咨询邀约（网上在线咨询和线下电话邀约客户）；</p>', '<p>1.专业：电子商务，市场营销，室内设计等专业；</p><p>2.工作经验：装修，家居行业或者网络推广工作经验者优先；</p><p>3.专业技巧：了解家居行业，熟悉家居知识，网络推广技巧；</p><p>4.综合能力：性格活泼，善于思考，有电话营销，网站优化，网络推广技能，熟悉ps操作等。</p>', 1, 1, 2, 2, NULL, NULL, NULL, NULL, '1221');
INSERT INTO `huhang_wanted` VALUES (22, '201807210002', 1, 56, NULL, 1, '前端工程师', NULL, '3000-6000', 10, 1532159452, 1532159452, 2100182400, '<p>1. 负责产品相关功能设计和开发；</p><p>2. 通过研究学习新技术，满足产品的实际需要；</p><p>3. 解决业务发展过程中遇到的问题，持续提升用户的访问体验 。</p>', '<p>1. 计算机相关专业专科及以上学历，2年以上相关工作经验；</p><p>2. 熟练掌握Web以及Mobile Web开发相关技术；</p><p>3. 对类似于layui（重点）、AngularJS、React、Backbone、等前端，MVC框架有过熟悉研究者优先；</p><p>4. 学习能力强，有较好的沟通能力，能迅速融入团队；</p>', 1, 1, 2, 2, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for huhang_worker
-- ----------------------------
DROP TABLE IF EXISTS `huhang_worker`;
CREATE TABLE `huhang_worker`  (
  `wk_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '工长id',
  `wk_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工长编号',
  `wk_p_id` int(10) DEFAULT NULL COMMENT '省份id',
  `wk_c_id` int(10) DEFAULT NULL COMMENT '城市id',
  `wk_b_id` int(10) DEFAULT NULL COMMENT '站点id',
  `wk_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '工长姓名',
  `wk_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '工长头像长方形',
  `wk_avatar` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '工长头像正方形',
  `wk_img_alt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图像alt',
  `wk_num` int(10) DEFAULT 0 COMMENT '工地数量',
  `wk_view` int(10) DEFAULT 0 COMMENT '浏览 热度',
  `wk_des` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '工长简介',
  `wk_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶 1 置顶 2 常规',
  `wk_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示 1显示 2 隐藏',
  `wk_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `wk_updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `wk_admin` int(10) DEFAULT NULL COMMENT '管理员id',
  `wk_seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo标题',
  `wk_seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'seo关键词',
  `wk_seo_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'seo描述',
  PRIMARY KEY (`wk_id`, `wk_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '工长表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for huhang_worksite
-- ----------------------------
DROP TABLE IF EXISTS `huhang_worksite`;
CREATE TABLE `huhang_worksite`  (
  `w_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工地的id',
  `w_bid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工地编号，生成规则同客户编号',
  `w_p_id` int(10) DEFAULT NULL COMMENT '省份id  关联省份表',
  `w_c_id` int(10) DEFAULT NULL COMMENT '城市id  关联城市表',
  `w_b_id` int(10) DEFAULT NULL COMMENT '站点id  关联分站表',
  `w_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '工地标题',
  `w_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '关键词 多个用逗号隔开',
  `w_descript` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '工地描述',
  `w_house_type` int(10) DEFAULT NULL COMMENT '房屋户型  对应房屋户型id ',
  `w_des_style` int(10) DEFAULT NULL COMMENT '装修风格  对应装修风格id',
  `w_des_level` int(10) DEFAULT NULL COMMENT '装修品质  对应装修品质id',
  `w_house_area` int(10) DEFAULT NULL COMMENT '房屋面积 （输入）',
  `w_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '工地地址',
  `w_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '工地坐标',
  `w_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '工地图片',
  `w_worker` int(10) DEFAULT NULL COMMENT '工长id 关联工长表',
  `w_desinger` int(10) DEFAULT NULL COMMENT '设计师id 关联设计师表',
  `w_view` int(10) DEFAULT NULL COMMENT '工地浏览量',
  `w_step_one_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '阶段一，拆除工程 图片  多图逗号隔开',
  `w_step_one_des` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阶段一 阶段描述',
  `w_step_two_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '阶段二，水电工程 图片  多图逗号隔开',
  `w_step_two_des` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阶段二 阶段描述',
  `w_step_three_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '阶段三，瓦工工程 图片  多图逗号隔开',
  `w_step_three_des` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阶段三 阶段描述',
  `w_step_four_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '阶段四，油工工程 图片  多图逗号隔开',
  `w_step_four_des` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阶段四 阶段描述',
  `w_step_five_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '阶段五，木作安装 图片  多图逗号隔开',
  `w_step_five_des` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阶段五 阶段描述',
  `w_step_six_img` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '阶段六，竣工保洁 图片  多图逗号隔开',
  `w_step_six_des` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '阶段六 阶段描述',
  `w_addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `w_updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `w_admin` int(10) DEFAULT NULL COMMENT '操作人id  对应管理员表',
  `w_isable` tinyint(2) DEFAULT 1 COMMENT '是否显示 1 显示  2 隐藏',
  `w_istop` tinyint(2) DEFAULT 2 COMMENT '是否置顶 1 置顶  2 常规',
  PRIMARY KEY (`w_id`, `w_bid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '在施工地表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
