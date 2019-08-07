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

 Date: 19/06/2019 13:23:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`) USING BTREE,
  INDEX `role_permission_permission_id_foreign`(`permission_id`) USING BTREE,
  CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES (2, 1);
INSERT INTO `role_permission` VALUES (2, 2);
INSERT INTO `role_permission` VALUES (2, 3);
INSERT INTO `role_permission` VALUES (2, 4);
INSERT INTO `role_permission` VALUES (2, 5);
INSERT INTO `role_permission` VALUES (2, 6);
INSERT INTO `role_permission` VALUES (2, 7);
INSERT INTO `role_permission` VALUES (2, 8);
INSERT INTO `role_permission` VALUES (2, 9);
INSERT INTO `role_permission` VALUES (2, 10);
INSERT INTO `role_permission` VALUES (2, 11);
INSERT INTO `role_permission` VALUES (2, 12);
INSERT INTO `role_permission` VALUES (2, 13);
INSERT INTO `role_permission` VALUES (2, 14);
INSERT INTO `role_permission` VALUES (2, 15);
INSERT INTO `role_permission` VALUES (2, 16);
INSERT INTO `role_permission` VALUES (2, 17);
INSERT INTO `role_permission` VALUES (2, 18);
INSERT INTO `role_permission` VALUES (2, 19);
INSERT INTO `role_permission` VALUES (2, 20);
INSERT INTO `role_permission` VALUES (2, 21);
INSERT INTO `role_permission` VALUES (2, 22);
INSERT INTO `role_permission` VALUES (2, 23);
INSERT INTO `role_permission` VALUES (2, 24);
INSERT INTO `role_permission` VALUES (2, 25);
INSERT INTO `role_permission` VALUES (2, 26);
INSERT INTO `role_permission` VALUES (2, 27);
INSERT INTO `role_permission` VALUES (2, 28);
INSERT INTO `role_permission` VALUES (2, 29);
INSERT INTO `role_permission` VALUES (2, 30);
INSERT INTO `role_permission` VALUES (2, 31);
INSERT INTO `role_permission` VALUES (2, 32);
INSERT INTO `role_permission` VALUES (2, 33);
INSERT INTO `role_permission` VALUES (2, 34);
INSERT INTO `role_permission` VALUES (2, 35);
INSERT INTO `role_permission` VALUES (2, 36);
INSERT INTO `role_permission` VALUES (2, 37);
INSERT INTO `role_permission` VALUES (2, 38);
INSERT INTO `role_permission` VALUES (2, 39);
INSERT INTO `role_permission` VALUES (2, 40);
INSERT INTO `role_permission` VALUES (2, 41);
INSERT INTO `role_permission` VALUES (2, 42);
INSERT INTO `role_permission` VALUES (2, 43);
INSERT INTO `role_permission` VALUES (2, 44);
INSERT INTO `role_permission` VALUES (2, 45);
INSERT INTO `role_permission` VALUES (2, 46);
INSERT INTO `role_permission` VALUES (2, 47);
INSERT INTO `role_permission` VALUES (2, 48);
INSERT INTO `role_permission` VALUES (2, 49);
INSERT INTO `role_permission` VALUES (2, 50);
INSERT INTO `role_permission` VALUES (2, 51);
INSERT INTO `role_permission` VALUES (2, 52);
INSERT INTO `role_permission` VALUES (2, 53);
INSERT INTO `role_permission` VALUES (2, 54);
INSERT INTO `role_permission` VALUES (2, 55);
INSERT INTO `role_permission` VALUES (2, 56);
INSERT INTO `role_permission` VALUES (3, 1);
INSERT INTO `role_permission` VALUES (3, 2);
INSERT INTO `role_permission` VALUES (3, 3);
INSERT INTO `role_permission` VALUES (3, 4);
INSERT INTO `role_permission` VALUES (3, 5);
INSERT INTO `role_permission` VALUES (3, 6);
INSERT INTO `role_permission` VALUES (3, 7);
INSERT INTO `role_permission` VALUES (3, 8);
INSERT INTO `role_permission` VALUES (3, 9);
INSERT INTO `role_permission` VALUES (3, 10);
INSERT INTO `role_permission` VALUES (3, 11);
INSERT INTO `role_permission` VALUES (3, 12);
INSERT INTO `role_permission` VALUES (3, 13);
INSERT INTO `role_permission` VALUES (3, 14);
INSERT INTO `role_permission` VALUES (3, 15);
INSERT INTO `role_permission` VALUES (3, 16);
INSERT INTO `role_permission` VALUES (3, 17);
INSERT INTO `role_permission` VALUES (3, 18);
INSERT INTO `role_permission` VALUES (3, 19);
INSERT INTO `role_permission` VALUES (3, 20);
INSERT INTO `role_permission` VALUES (3, 21);
INSERT INTO `role_permission` VALUES (3, 22);
INSERT INTO `role_permission` VALUES (3, 23);
INSERT INTO `role_permission` VALUES (3, 24);
INSERT INTO `role_permission` VALUES (3, 25);
INSERT INTO `role_permission` VALUES (3, 26);
INSERT INTO `role_permission` VALUES (3, 27);
INSERT INTO `role_permission` VALUES (3, 28);
INSERT INTO `role_permission` VALUES (3, 29);
INSERT INTO `role_permission` VALUES (3, 30);
INSERT INTO `role_permission` VALUES (3, 31);
INSERT INTO `role_permission` VALUES (3, 32);
INSERT INTO `role_permission` VALUES (3, 33);
INSERT INTO `role_permission` VALUES (3, 34);
INSERT INTO `role_permission` VALUES (3, 35);
INSERT INTO `role_permission` VALUES (3, 36);
INSERT INTO `role_permission` VALUES (3, 37);
INSERT INTO `role_permission` VALUES (3, 38);
INSERT INTO `role_permission` VALUES (3, 39);
INSERT INTO `role_permission` VALUES (3, 40);
INSERT INTO `role_permission` VALUES (3, 41);
INSERT INTO `role_permission` VALUES (3, 42);
INSERT INTO `role_permission` VALUES (3, 43);
INSERT INTO `role_permission` VALUES (3, 44);
INSERT INTO `role_permission` VALUES (3, 45);
INSERT INTO `role_permission` VALUES (3, 46);
INSERT INTO `role_permission` VALUES (3, 47);
INSERT INTO `role_permission` VALUES (3, 48);
INSERT INTO `role_permission` VALUES (3, 49);
INSERT INTO `role_permission` VALUES (3, 50);
INSERT INTO `role_permission` VALUES (3, 51);
INSERT INTO `role_permission` VALUES (3, 52);
INSERT INTO `role_permission` VALUES (3, 53);
INSERT INTO `role_permission` VALUES (3, 54);
INSERT INTO `role_permission` VALUES (3, 55);
INSERT INTO `role_permission` VALUES (3, 56);
INSERT INTO `role_permission` VALUES (6, 10);
INSERT INTO `role_permission` VALUES (6, 11);
INSERT INTO `role_permission` VALUES (6, 12);
INSERT INTO `role_permission` VALUES (6, 13);
INSERT INTO `role_permission` VALUES (6, 48);
INSERT INTO `role_permission` VALUES (6, 50);
INSERT INTO `role_permission` VALUES (6, 51);
INSERT INTO `role_permission` VALUES (6, 52);
INSERT INTO `role_permission` VALUES (6, 53);
INSERT INTO `role_permission` VALUES (6, 55);

SET FOREIGN_KEY_CHECKS = 1;
