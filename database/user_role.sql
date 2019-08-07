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

 Date: 19/06/2019 13:24:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `user_id`) USING BTREE,
  INDEX `user_role_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (2, 27);
INSERT INTO `user_role` VALUES (2, 28);
INSERT INTO `user_role` VALUES (2, 29);
INSERT INTO `user_role` VALUES (2, 39);
INSERT INTO `user_role` VALUES (2, 84);
INSERT INTO `user_role` VALUES (2, 106);
INSERT INTO `user_role` VALUES (2, 150);
INSERT INTO `user_role` VALUES (2, 307);
INSERT INTO `user_role` VALUES (3, 27);
INSERT INTO `user_role` VALUES (3, 265);
INSERT INTO `user_role` VALUES (3, 274);
INSERT INTO `user_role` VALUES (6, 160);

SET FOREIGN_KEY_CHECKS = 1;
