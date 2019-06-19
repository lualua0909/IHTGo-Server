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

 Date: 19/06/2019 13:23:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for manager_prices
-- ----------------------------
DROP TABLE IF EXISTS `manager_prices`;
CREATE TABLE `manager_prices`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NULL DEFAULT NULL,
  `type_car` tinyint(1) NULL DEFAULT 1,
  `option` tinyint(1) NULL DEFAULT 1,
  `min` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `min_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `increase` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `increase_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `to` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `time_sende` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `time_receive` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address_receive` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address_payment` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of manager_prices
-- ----------------------------
INSERT INTO `manager_prices` VALUES (16, 2, 7, 2, '1', '70000', 1, NULL, '', '01', '74', NULL, NULL, NULL, NULL, 'update 13-12-2018', 0, '2018-12-12 20:55:31', '2019-02-13 08:10:57');
INSERT INTO `manager_prices` VALUES (17, 2, 8, 2, '1', '70000', 1, NULL, '', '74', '79', NULL, NULL, NULL, NULL, NULL, 1, '2018-12-12 20:58:00', '2018-12-12 20:58:00');
INSERT INTO `manager_prices` VALUES (18, 3, 8, 2, '25', '140000', 1, '1', '3000', '74', '79', NULL, NULL, NULL, NULL, NULL, 1, '2018-12-12 21:37:17', '2018-12-12 21:37:17');
INSERT INTO `manager_prices` VALUES (19, 1, 8, 2, '25', '70000', 1, '1', '3000', '74', '', NULL, NULL, NULL, NULL, NULL, 1, '2018-12-12 21:51:45', '2018-12-12 21:51:45');
INSERT INTO `manager_prices` VALUES (20, 1, 7, 2, '1', '70000', 1, '1', '3000', '74', '74', NULL, NULL, '1', '70000', 'update 13-12-2012', 1, '2018-12-13 09:39:19', '2018-12-13 09:39:19');
INSERT INTO `manager_prices` VALUES (21, 1, 8, 2, '25', '70000', 1, '1', '3000', '79', NULL, NULL, NULL, '1', '70,000', NULL, 1, '2018-12-27 08:21:00', '2019-01-14 07:16:36');
INSERT INTO `manager_prices` VALUES (22, 3, 8, 2, '25', '140000', 1, '1', '3000', '79', '74', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 03:59:59', '2019-01-12 03:59:59');
INSERT INTO `manager_prices` VALUES (23, 3, 8, 2, '25', '140000', 1, '1', '3000', '74', '75', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:01:19', '2019-01-12 04:01:19');
INSERT INTO `manager_prices` VALUES (24, 3, 8, 2, '25', '140000', 1, '1', '3000', '74', '72', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:01:47', '2019-01-12 04:01:47');
INSERT INTO `manager_prices` VALUES (25, 3, 8, 2, '25', '140000', 1, '1', '3000', '74', '80', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:02:10', '2019-01-12 04:02:10');
INSERT INTO `manager_prices` VALUES (26, 3, 8, 2, '25', '140000', 1, '1', '3000', '74', '70', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:05:18', '2019-01-12 04:05:18');
INSERT INTO `manager_prices` VALUES (27, 3, 8, 2, '25', '140000', 1, '1', '3000', '79', '75', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:05:55', '2019-01-12 04:05:55');
INSERT INTO `manager_prices` VALUES (28, 3, 8, 2, '25', '140000', 1, '1', '3000', '79', '72', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:06:26', '2019-01-12 04:06:26');
INSERT INTO `manager_prices` VALUES (29, 3, 8, 2, '25', '140000', 1, '1', '3000', '79', '80', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:06:44', '2019-01-12 04:06:44');
INSERT INTO `manager_prices` VALUES (30, 3, 8, 2, '25', '140000', 1, '1', '3000', '79', '70', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-12 04:06:58', '2019-01-12 04:06:58');
INSERT INTO `manager_prices` VALUES (31, 1, 8, 2, '25', '70000', 1, '1', '3000', '75', NULL, NULL, NULL, '1', '70,000', NULL, 1, '2019-01-14 07:15:07', '2019-01-14 07:15:07');
INSERT INTO `manager_prices` VALUES (32, 3, 8, 2, '25', '140000', 127, NULL, '', '75', '74', NULL, NULL, NULL, NULL, NULL, 0, '2019-01-17 08:08:06', '2019-01-17 08:34:51');
INSERT INTO `manager_prices` VALUES (33, 3, 8, 2, '25', '140000', 127, '1', '3000', '75', '74', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-17 08:35:18', '2019-01-17 08:35:18');
INSERT INTO `manager_prices` VALUES (34, 2, 8, 2, '1', '70000', 1, NULL, '', '79', '74', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-18 02:18:54', '2019-01-18 02:18:54');
INSERT INTO `manager_prices` VALUES (35, 3, 7, 2, '25', '140000', 27, '1', '3000', '79', '74', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-13 08:06:42', '2019-02-13 08:06:42');
INSERT INTO `manager_prices` VALUES (36, 3, 7, 2, '25', '140000', 27, '1', '3000', '74', '79', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-13 08:07:36', '2019-02-13 08:07:36');
INSERT INTO `manager_prices` VALUES (37, 1, 7, 2, '25', '70000', 27, '1', '3000', '74', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-02-13 08:11:38', '2019-02-13 08:11:38');
INSERT INTO `manager_prices` VALUES (38, 2, 8, 2, '1', '70000', 1, NULL, '', '79', '79', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-14 10:45:15', '2019-02-14 10:45:15');
INSERT INTO `manager_prices` VALUES (39, 2, 8, 2, '1', '70000', 1, NULL, '', '74', '74', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-14 10:45:38', '2019-02-14 10:45:38');
INSERT INTO `manager_prices` VALUES (40, 2, 8, 2, '1', '140000', 1, NULL, '', '79', '72', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-20 15:45:49', '2019-02-20 15:45:49');
INSERT INTO `manager_prices` VALUES (41, 2, 8, 2, '1', '140000', 1, NULL, '', '79', '70', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-20 15:46:03', '2019-02-20 15:46:03');
INSERT INTO `manager_prices` VALUES (42, 3, 8, 2, '1', '140000', 1, '1', '3000', '70', '74', NULL, NULL, NULL, NULL, NULL, 0, '2019-02-28 09:58:38', '2019-02-28 10:32:32');
INSERT INTO `manager_prices` VALUES (43, 3, 8, 2, '25', '140000', 1, '1', '3000', '70', '74', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-28 10:32:58', '2019-02-28 10:32:58');
INSERT INTO `manager_prices` VALUES (44, 1, 7, 2, '1', '70000', 1, '1', '3000', '79', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-05-28 08:42:47', '2019-05-28 08:42:47');

SET FOREIGN_KEY_CHECKS = 1;
