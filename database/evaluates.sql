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

 Date: 19/06/2019 13:23:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for evaluates
-- ----------------------------
DROP TABLE IF EXISTS `evaluates`;
CREATE TABLE `evaluates`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NULL DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `content` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `note` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rate` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of evaluates
-- ----------------------------
INSERT INTO `evaluates` VALUES (1, 18, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 02:42:28', '2019-02-13 02:42:28');
INSERT INTO `evaluates` VALUES (2, 18, 1, 1, '[\"8\"]', 'undefined', '5', '2019-02-13 02:43:11', '2019-02-13 02:43:11');
INSERT INTO `evaluates` VALUES (3, 18, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 02:43:24', '2019-02-13 02:43:24');
INSERT INTO `evaluates` VALUES (4, 18, 1, 1, '[\"8\"]', 'undefined', '5', '2019-02-13 02:43:45', '2019-02-13 02:43:45');
INSERT INTO `evaluates` VALUES (5, 18, 1, 1, '[\"\"]', 'undefined', '3', '2019-02-13 03:57:27', '2019-02-13 03:57:27');
INSERT INTO `evaluates` VALUES (6, 18, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 07:28:37', '2019-02-13 07:28:37');
INSERT INTO `evaluates` VALUES (7, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:29:05', '2019-02-13 16:29:05');
INSERT INTO `evaluates` VALUES (8, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:29:20', '2019-02-13 16:29:20');
INSERT INTO `evaluates` VALUES (9, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:30:01', '2019-02-13 16:30:01');
INSERT INTO `evaluates` VALUES (10, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:30:51', '2019-02-13 16:30:51');
INSERT INTO `evaluates` VALUES (11, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:31:09', '2019-02-13 16:31:09');
INSERT INTO `evaluates` VALUES (12, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:33:32', '2019-02-13 16:33:32');
INSERT INTO `evaluates` VALUES (13, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-13 16:33:59', '2019-02-13 16:33:59');
INSERT INTO `evaluates` VALUES (14, 33, 1, 1, '[\"\"]', 'Da giao', '5', '2019-02-13 16:34:57', '2019-02-13 16:34:57');
INSERT INTO `evaluates` VALUES (15, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-13 16:35:27', '2019-02-13 16:35:27');
INSERT INTO `evaluates` VALUES (16, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-13 16:38:17', '2019-02-13 16:38:17');
INSERT INTO `evaluates` VALUES (17, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-13 16:44:31', '2019-02-13 16:44:31');
INSERT INTO `evaluates` VALUES (18, 33, 1, 1, '[\"6\"]', 'Chup hinh', '5', '2019-02-13 16:47:45', '2019-02-13 16:47:45');
INSERT INTO `evaluates` VALUES (19, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-13 17:00:14', '2019-02-13 17:00:14');
INSERT INTO `evaluates` VALUES (20, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-14 11:26:46', '2019-02-14 11:26:46');
INSERT INTO `evaluates` VALUES (21, 35, 1, 1, '[\"2\"]', 'Thời  gian  chờ  lâu', '2', '2019-02-14 13:02:50', '2019-02-14 13:02:50');
INSERT INTO `evaluates` VALUES (22, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-14 15:50:44', '2019-02-14 15:50:44');
INSERT INTO `evaluates` VALUES (23, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-14 15:52:40', '2019-02-14 15:52:40');
INSERT INTO `evaluates` VALUES (24, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-15 16:02:08', '2019-02-15 16:02:08');
INSERT INTO `evaluates` VALUES (25, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-15 16:21:25', '2019-02-15 16:21:25');
INSERT INTO `evaluates` VALUES (26, 35, 1, 1, '[\"\"]', 'undefined', '4', '2019-02-16 14:59:32', '2019-02-16 14:59:32');
INSERT INTO `evaluates` VALUES (27, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-20 09:41:43', '2019-02-20 09:41:43');
INSERT INTO `evaluates` VALUES (28, 33, 1, 1, '[\"5\"]', 'undefined', '5', '2019-02-20 09:42:04', '2019-02-20 09:42:04');
INSERT INTO `evaluates` VALUES (29, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-20 10:10:00', '2019-02-20 10:10:00');
INSERT INTO `evaluates` VALUES (30, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-20 16:14:35', '2019-02-20 16:14:35');
INSERT INTO `evaluates` VALUES (31, 33, 1, 1, '[\"6\"]', 'undefined', '5', '2019-02-20 16:16:22', '2019-02-20 16:16:22');
INSERT INTO `evaluates` VALUES (32, 36, 1, 1, '[\"4\",\"5\",\"8\"]', 'undefined', '5', '2019-02-20 17:04:10', '2019-02-20 17:04:10');
INSERT INTO `evaluates` VALUES (33, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-21 08:39:09', '2019-02-21 08:39:09');
INSERT INTO `evaluates` VALUES (34, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-23 09:13:01', '2019-02-23 09:13:01');
INSERT INTO `evaluates` VALUES (35, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-25 16:00:04', '2019-02-25 16:00:04');
INSERT INTO `evaluates` VALUES (36, 31, 1, 1, '[\"\"]', 'undefined', '5', '2019-02-26 12:38:45', '2019-02-26 12:38:45');
INSERT INTO `evaluates` VALUES (37, 33, 1, 1, '[\"\"]', 'undefined', '5', '2019-03-02 08:42:56', '2019-03-02 08:42:56');
INSERT INTO `evaluates` VALUES (38, 18, 1, 1, '[\"2\"]', 'undefined', '5', '2019-04-12 11:01:53', '2019-04-12 11:01:53');
INSERT INTO `evaluates` VALUES (39, 24, 1, 1, '[\"2\"]', 'undefined', '5', '2019-04-16 11:30:02', '2019-04-16 11:30:02');
INSERT INTO `evaluates` VALUES (40, 18, 1, 1, '[\"1\"]', NULL, '3', '2019-05-10 11:25:32', '2019-05-10 11:25:32');
INSERT INTO `evaluates` VALUES (41, 18, 34, 1, '[\"1\",\"2\"]', 'hoi lau', '2', '2019-05-17 16:00:25', '2019-05-17 16:00:25');
INSERT INTO `evaluates` VALUES (42, 129, 1, 1, '[\"7\"]', 'Chưa thu tiền, khách nói chuyển khoản qua cty đại phát', '5', '2019-06-01 14:53:54', '2019-06-01 14:53:54');
INSERT INTO `evaluates` VALUES (43, 129, 1, 1, '[\"2\",\"3\",\"4\",\"5\"]', 'Shit', '1', '2019-06-15 22:39:33', '2019-06-15 22:39:33');
INSERT INTO `evaluates` VALUES (44, 339, 1, 1, '[\"\"]', 'undefined', '5', '2019-06-19 13:02:04', '2019-06-19 13:02:04');

SET FOREIGN_KEY_CHECKS = 1;
