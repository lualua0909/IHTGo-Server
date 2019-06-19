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

 Date: 19/06/2019 13:23:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for others
-- ----------------------------
DROP TABLE IF EXISTS `others`;
CREATE TABLE `others`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of others
-- ----------------------------
INSERT INTO `others` VALUES (1, 2, 'Thái Độ1', 1, NULL, '2018-07-02 07:36:44', '2019-04-19 16:36:59');
INSERT INTO `others` VALUES (2, 2, 'Thời Gian', 1, NULL, '2018-07-02 07:36:59', '2018-07-02 07:36:59');
INSERT INTO `others` VALUES (3, 1, 'Chất Lượng', 1, NULL, '2018-07-02 07:38:24', '2018-07-02 07:38:24');
INSERT INTO `others` VALUES (4, 1, 'Giá Cả', 1, NULL, '2018-07-02 07:38:33', '2018-07-02 07:38:33');
INSERT INTO `others` VALUES (5, 3, 'Thời Gian', 1, NULL, '2018-07-02 07:38:45', '2018-07-02 07:38:45');
INSERT INTO `others` VALUES (6, 3, 'Tính Cách', 1, NULL, '2018-07-02 07:40:47', '2018-07-02 07:40:47');
INSERT INTO `others` VALUES (7, 4, 'Xe tai 500 kg', 1, NULL, '2018-10-01 05:47:53', '2018-10-01 05:47:53');
INSERT INTO `others` VALUES (8, 4, 'Xe máy', 1, NULL, '2018-10-20 15:56:54', '2018-10-20 15:56:54');
INSERT INTO `others` VALUES (9, 1, 'wechat2', 1, '2019-04-19 16:37:28', '2019-04-19 16:37:14', '2019-04-19 16:37:28');

SET FOREIGN_KEY_CHECKS = 1;
