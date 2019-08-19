/*
Navicat MySQL Data Transfer

Source Server         : eluedai
Source Server Version : 50727
Source Host           : 47.103.2.53:3306
Source Database       : loan

Target Server Type    : MYSQL
Target Server Version : 50727
File Encoding         : 65001

Date: 2019-08-12 09:18:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cateloan
-- ----------------------------
DROP TABLE IF EXISTS `cateloan`;
CREATE TABLE `cateloan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cateimg` varchar(255) DEFAULT NULL,
  `catename` varchar(255) DEFAULT NULL,
  `caterank` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cateloan
-- ----------------------------
INSERT INTO `cateloan` VALUES ('1', 'http://www.eluedai.com/wp-content/uploads/2019/06/信用报告-1.png', '无需征信', '1000');
INSERT INTO `cateloan` VALUES ('2', 'http://www.eluedai.com/wp-content/uploads/2019/06/时间-3.png', '10分钟下款', '999');
INSERT INTO `cateloan` VALUES ('3', 'http://www.eluedai.com/wp-content/uploads/2019/06/最新连载-1.png', '最新口子', '998');
INSERT INTO `cateloan` VALUES ('4', 'http://www.eluedai.com/wp-content/uploads/2019/05/钱币-01.png', '小额贷款', '997');
INSERT INTO `cateloan` VALUES ('5', 'http://www.eluedai.com/wp-content/uploads/2019/06/cash-flow-1.png', '当天到账', '996');
INSERT INTO `cateloan` VALUES ('6', 'http://www.eluedai.com/wp-content/uploads/2019/06/cash-flow-1.png', '大额贷款', '995');
INSERT INTO `cateloan` VALUES ('7', 'http://www.eluedai.com/wp-content/uploads/2019/06/Card.png', '信用卡贷', '994');
INSERT INTO `cateloan` VALUES ('8', 'http://www.eluedai.com/wp-content/uploads/2019/05/支付宝钱包.png', '芝麻分贷', '993');

-- ----------------------------
-- Table structure for find
-- ----------------------------
DROP TABLE IF EXISTS `find`;
CREATE TABLE `find` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of find
-- ----------------------------
INSERT INTO `find` VALUES ('1', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E4%BA%A4%E9%80%9A%E9%93%B6%E8%A1%8C.png', '交通银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615949513&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('2', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E6%8B%9B%E5%95%86%E9%93%B6%E8%A1%8C.png', '招商银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615951462&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('3', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E5%85%89%E5%A4%A7%E9%93%B6%E8%A1%8C.png', '光大银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615955030&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('4', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E5%85%89%E5%A4%A7%E7%99%BD%E9%87%91%E5%8D%A1.png', '光大白金卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615955912&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('5', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E5%B9%B3%E5%AE%89%E9%93%B6%E8%A1%8C.png', '平安银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615974168&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('6', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E9%82%AE%E6%94%BF%E9%93%B6%E8%A1%8C.png', '邮政银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615976079&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('7', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E5%85%B4%E4%B8%9A%E9%93%B6%E8%A1%8C.png', '兴业银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072615978058&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('8', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E4%B8%AD%E4%BF%A1%E9%93%B6%E8%A1%8C.png', '中信银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072916166638&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');
INSERT INTO `find` VALUES ('9', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E6%B0%91%E7%94%9F%E9%93%B6%E8%A1%8C.png', '民生银行', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072916168931&IVC=5F5ZYU&ownTrader=3', null, '信用卡申请');

-- ----------------------------
-- Table structure for findcate
-- ----------------------------
DROP TABLE IF EXISTS `findcate`;
CREATE TABLE `findcate` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of findcate
-- ----------------------------
INSERT INTO `findcate` VALUES ('1', '热点推荐');
INSERT INTO `findcate` VALUES ('2', '推荐贷款');
INSERT INTO `findcate` VALUES ('3', '信用卡申请');
INSERT INTO `findcate` VALUES ('4', '查询服务');

-- ----------------------------
-- Table structure for info
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `name` varchar(255) DEFAULT NULL COMMENT '口子名称',
  `successrate` varchar(255) DEFAULT NULL COMMENT '成功率',
  `money` varchar(255) DEFAULT NULL COMMENT '最低金额',
  `moneyrate` varchar(255) DEFAULT NULL COMMENT '利率',
  `describle` varchar(255) DEFAULT NULL COMMENT '口子描述',
  `time` varchar(255) DEFAULT NULL COMMENT '最低期限',
  `speed` varchar(255) DEFAULT NULL COMMENT '放款速度',
  `apply` varchar(255) DEFAULT NULL COMMENT '审核方式',
  `arrive` varchar(255) DEFAULT NULL COMMENT '到账方式',
  `href` varchar(255) DEFAULT NULL COMMENT '口子链接地址',
  `counts` varchar(255) DEFAULT NULL COMMENT '排名',
  `cate` varchar(255) DEFAULT NULL COMMENT '所属分类',
  `money2` varchar(255) DEFAULT NULL COMMENT '最高金额',
  `time2` varchar(255) DEFAULT NULL COMMENT '最长期限',
  `caution` varchar(255) DEFAULT NULL COMMENT '借款提示',
  `datalimit` varchar(255) DEFAULT NULL,
  `displayp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of info
-- ----------------------------
INSERT INTO `info` VALUES ('2', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E4%BB%BB%E6%80%A7%E8%B4%B7.png', '任性贷', '95', '1000', '0.04', '18-55周岁大陆居民，主动申请', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019040109214563&IVC=5F5ZYU&ownTrader=1', '1', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('3', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%9B%BD%E7%BE%8E%E6%98%93%E5%8D%A1.png', '国美易卡', '95', '1000', '0.065', '18-45周岁，贷款额度点击进入查看详情', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019051511570826&IVC=5F5ZYU&ownTrader=2', '2', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '150000', '36', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('4', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%B0%8F%E8%B5%A2%E6%98%93%E8%B4%B7.png', '小赢易贷', '94', '1000', '0.03', '基础认知项：身份证，运营商授权，储蓄卡', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019050611041860&IVC=5F5ZYU&ownTrader=2', '3', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '30000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('6', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%AE%89%E5%BF%83%E8%B4%B7.png', '安心贷', '91', '5000', '0.065', '22-55周岁，信用良好', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019070514591712&IVC=5F5ZYU&ownTrader=1', '5', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '10000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('7', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%B0%8F%E7%88%B1%E5%88%86%E6%9C%9F.png', '小爱分期', '97', '2000', '0.04', '芝麻分大于630，实名制手机使用5个月', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072415808204&IVC=5F5ZYU&ownTrader=1', '6', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,芝麻分贷', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('8', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E6%9C%88%E5%85%89%E4%BE%A0.png', '月光侠', '96', '3000', '0.03', '22-55周岁，身份证，银行卡，运营商授权', '3', '10', '人工+机审', '银行卡', ' https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019042410517696&IVC=5F5ZYU&ownTrader=1', '7', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '20000', '9', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('9', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%B0%8F%E8%8A%B1%E9%92%B1%E5%8C%85.png', '小花钱包', '94', '1000', '0.02', '20-45周岁，大专以上学历用户更优', '5', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019052011820368&IVC=5F5ZYU&ownTrader=2', '8', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '24', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('10', 'http://www.eluedai.com/wp-content/uploads/2019/07/ppd.jpg', '拍拍贷', '95', '1000', '0.02', '18-55周岁，无不良信用记录', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2018090500472609&IVC=5F5ZYU&ownTrader=2', '9', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '200000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('11', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%B0%8F%E8%B5%A2%E9%92%B1%E5%8C%85.png', '小赢钱包', '91', '1000', '0.065', '18-45周岁，无不良信用记录', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019011806138620&IVC=5F5ZYU&ownTrader=1', '10', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '60000', '11', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('12', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%A6%82%E6%9C%9F%E5%88%86%E6%9C%9F.png', '如期分期', '97', '10000', '0.065', '申请要求点击进入查看', '3', '10', '人工+机审', '银行卡', '。https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019041910255443&IVC=5F5ZYU&ownTrader=2', '11', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '30000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('13', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E7%A6%8F%E8%B4%B7.png', '福贷', '94', '3000', '0.03', '20-55手机实名用户', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019051511544577&IVC=5F5ZYU&ownTrader=2', '12', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('14', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%8D%A1%E5%8D%A1%E8%B4%B7.png', '卡卡贷', '96', '1000', '0.03', '20-50周岁，有一张 信用卡', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019032208628479&IVC=5F5ZYU&ownTrader=2', '13', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '20000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('15', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E4%BC%98%E6%99%BA%E5%80%9F.png', '优智借', '98', '2000', '0.03', '基础认证：身份证，银行卡，运营商授权', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019042410505475&IVC=5F5ZYU&ownTrader=1', '14', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '20000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('16', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E6%80%A5%E6%9C%89%E9%92%B1.png', '急有钱', '97', '5000', '0.03', '18-50周岁，企业正常参保6个月以上（深圳客户可批款10万以上）', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019062513871977&IVC=5F5ZYU&ownTrader=1', '15', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '100000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '天', '');
INSERT INTO `info` VALUES ('17', 'http://www.eluedai.com/wp-content/uploads/2019/08/GOGO%E8%B4%B7.png', 'gogo贷', '95', '5000', '0.04', '20-40周岁，入网9个月以上', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019080116361085&IVC=5F5ZYU&ownTrader=2', '17', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '30000', '9', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('18', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E6%98%93%E4%BA%AB%E5%80%9F.png', '易享借', '95', '1000', '0.02', '身份证，手机运营商，银行卡', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019072215661376&IVC=5F5ZYU&ownTrader=1', '18', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('19', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E9%A3%9E%E8%B4%B7.png', '飞贷', '94', '10000', '0.04', '申请模式，点击立即申请查看。', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019011806151410&IVC=5F5ZYU&ownTrader=1', '19', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '500000', '24', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('20', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%B0%8F%E9%B2%A8%E6%98%93%E8%B4%B7.png', '小鲨易贷', '98', '2000', '0.03', '22-45周岁，个人征信', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019060412573772&IVC=5F5ZYU&ownTrader=2', '22', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('21', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E7%82%B9%E7%82%B9.png', '点点', '98', '1000', '0.02', '芝麻分600以上，手机号在网可用，非170，171开头。', '1', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2018101501537327&IVC=5F5ZYU&ownTrader=1', '23', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款,芝麻分贷', '200000', '6', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('22', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%96%9C%E9%B9%8A%E5%BF%AB%E8%B4%B7.png', '喜鹊快贷', '96', '3000', '0.03', '22-45周岁，有信用卡，芝麻分600以上', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019060412576835&IVC=5F5ZYU&ownTrader=2', '24', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷,芝麻分贷', '100000', '24', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('23', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E6%97%B6%E5%85%89%E5%88%86%E6%9C%9F.png', '时光分期', '92', '1000', '0.04', '本人实名制手机使用满5个月', '1', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019061212930492&IVC=5F5ZYU&ownTrader=2', '25', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '40000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('24', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E7%91%9E%E8%B4%B7.png', '瑞贷', '94', '3000', '0.03', '23-40周岁，持有信用卡', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019052412042526&IVC=5F5ZYU&ownTrader=2', '26', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('25', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E9%AD%94%E5%80%9F.png', '魔借', '96', '3000', '0.02', '身份证，银行卡，运营商授权', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019042410519989&IVC=5F5ZYU&ownTrader=2', '27', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '10000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('36', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E8%B6%85%E7%BA%A7%E8%9C%A1%E7%AC%94.png', '超级蜡笔', '97', '5000', '0.04', '22-55周岁，非在校大学生，实名制手机满6个月', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019080816838309&IVC=5F5ZYU&ownTrader=1', '20', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '天', '');
INSERT INTO `info` VALUES ('27', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E9%92%B1%E4%BC%B4.png', '钱伴', '93', '1000', '0.02', '身份证，手机运营商，银行卡', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019041610086921&IVC=5F5ZYU&ownTrader=2', '29', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('28', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%90%8C%E7%A8%8B%E5%80%9F%E9%92%B1-%E6%8F%90%E9%92%B1%E6%B8%B8.png', '同程借钱-提钱游', '97', '1000', '0.02', '18-50周岁，芝麻分550以上', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019030407540833&IVC=5F5ZYU&ownTrader=2', '30', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款,芝麻分贷', '200000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('29', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E8%B4%9D%E7%94%A8%E9%87%91.png', '贝用金', '97', '5000', '0.04', '银行卡手机号必须与用户注册手机号一致', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019031308069242&IVC=5F5ZYU&ownTrader=1', '30', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('30', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E9%9A%8F%E5%BF%83%E8%8A%B1.png', '随心花', '96', '2000', '0.02', '公积金，信用卡，电商可三选一认证。香港，澳门，台湾，新疆，西藏，内蒙古除外', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019070214393945&IVC=5F5ZYU&ownTrader=2', '31', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '5000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('31', 'http://www.eluedai.com/wp-content/uploads/2019/07/%E5%AE%9C%E4%BA%BA%E8%B4%B7.png', '宜人贷', '94', '10000', '0.02', '申请要求点击进入查看', '1', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019011205892251&IVC=5F5ZYU&ownTrader=2', '33', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '200000', '48', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '天', '');
INSERT INTO `info` VALUES ('32', 'http://www.eluedai.com/wp-content/uploads/2019/08/360%E5%80%9F%E6%9D%A1.png', '360借条', '97', '10000', '0.05', '18-55周岁，无不良信用记录', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019070814770797&IVC=5F5ZYU&ownTrader=1', '34', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '200000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('33', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E6%98%93%E7%BE%8E%E4%BB%98.png', '易美付', '98', '1000', '0.03', '身份证，22-25随信用卡必填，25岁+选填', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2018122104742552&IVC=5F5ZYU&ownTrader=1', '35', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款,信用卡贷', '200000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('34', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E8%BF%98%E5%91%97.png', '还呗', '94', '1000', '0.02', '18-50周岁，最高额度50000', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019022707280924&IVC=5F5ZYU&ownTrader=1', '36', '10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('35', 'http://www.eluedai.com/wp-content/uploads/2019/08/%E8%B1%86%E8%B1%86%E9%92%B1.png', '豆豆钱', '98', '1000', '0.03', '20-50周岁，本人实名制手机满5个月', '3', '5', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019022807316647&IVC=5F5ZYU&ownTrader=1', '37', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款', '50000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
INSERT INTO `info` VALUES ('37', 'http://www.eluedai.com/wp-content/uploads/2019/08/51%E5%85%AC%E7%A7%AF%E9%87%91.png', '51公积金', '97', '5000', '0.03', '18-45周岁，芝麻分580以上', '3', '10', '人工+机审', '银行卡', 'https://webapp.uubee.com/galaxy_agent_web/withdrawal_share?SPC=2019080716792833&IVC=5F5ZYU&ownTrader=1', '6', '无需征信,10分钟下款,最新口子,小额贷款,当天到账,大额贷款,芝麻分贷', '10000', '12', '借款有风险，申请需谨慎。若有前期费用，停止申请，E撸E贷仅提供平台服务。', '月', '');
