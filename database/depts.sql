/*
 Navicat Premium Data Transfer

 Source Server         : x
 Source Server Type    : MySQL
 Source Server Version : 100121
 Source Host           : phpmyadmin.yousoft.vn:3306
 Source Schema         : iht

 Target Server Type    : MySQL
 Target Server Version : 100121
 File Encoding         : 65001

 Date: 19/06/2019 13:22:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for depts
-- ----------------------------
DROP TABLE IF EXISTS `depts`;
CREATE TABLE `depts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `money` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of depts
-- ----------------------------
INSERT INTO `depts` VALUES (1, 1, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (2, 100, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (3, 101, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (4, 102, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (5, 103, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (6, 104, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (7, 105, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (8, 106, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (9, 107, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (10, 108, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (11, 109, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (12, 110, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (13, 111, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (14, 112, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (15, 113, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (16, 114, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (17, 115, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (18, 116, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (19, 117, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (20, 118, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (21, 119, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (22, 120, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (23, 121, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (24, 122, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (25, 123, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (26, 124, 1, '2019-02-01', '2019-02-28', '0');
INSERT INTO `depts` VALUES (27, 125, 1, '2019-02-01', '2019-02-28', '0');

SET FOREIGN_KEY_CHECKS = 1;
