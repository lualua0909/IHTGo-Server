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

 Date: 19/06/2019 13:22:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for collection_of_debts
-- ----------------------------
DROP TABLE IF EXISTS `collection_of_debts`;
CREATE TABLE `collection_of_debts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `money` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `employee_id` int(11) NULL DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
