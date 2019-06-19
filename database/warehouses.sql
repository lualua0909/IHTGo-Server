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

 Date: 19/06/2019 13:24:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for warehouses
-- ----------------------------
DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE `warehouses`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `manager_id` int(11) NULL DEFAULT NULL,
  `distribution` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acreage` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `warehouses_code_unique`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of warehouses
-- ----------------------------
INSERT INTO `warehouses` VALUES (1, 'HCM', 1, 1, 'Hồ Chí Minh', '1', '1610 Võ Văn Kiệt, P7, Quận 6, TPHCM', NULL, '2019-01-26 01:13:57', '2019-01-26 01:13:57');
INSERT INTO `warehouses` VALUES (2, 'MPC', 39, 1, 'IHT MỸ PHƯỚC', '5856', 'DA1-1, PHƯỜNG MỸ PHƯỚC, TX. BẾN CÁT, BÌNH DƯƠNG', NULL, '2019-02-14 09:48:13', '2019-02-14 09:48:13');
INSERT INTO `warehouses` VALUES (3, '478829', 1, 1, 'xzcxz', 'cvcv', '20 Cộng Hòa, phường 4, Tân Bình, HCM', '2019-04-19 16:49:45', '2019-04-19 16:46:20', '2019-04-19 16:49:45');

SET FOREIGN_KEY_CHECKS = 1;
