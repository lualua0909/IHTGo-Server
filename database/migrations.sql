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

 Date: 19/06/2019 13:23:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_03_26_133125_create_roles_and_permisstions_tables', 1);
INSERT INTO `migrations` VALUES (4, '2018_06_21_154836_create_cars_table', 1);
INSERT INTO `migrations` VALUES (5, '2018_06_21_155458_create_customers_table', 1);
INSERT INTO `migrations` VALUES (8, '2018_06_23_074859_create_others_table', 2);
INSERT INTO `migrations` VALUES (9, '2018_06_24_024109_create_management_prices_table', 2);
INSERT INTO `migrations` VALUES (10, '2018_06_24_041200_create_evaluates_table', 3);
INSERT INTO `migrations` VALUES (12, '2018_06_24_071326_create_deliveries_table', 4);
INSERT INTO `migrations` VALUES (13, '2018_06_24_073104_create_finances_table', 4);
INSERT INTO `migrations` VALUES (14, '2018_06_24_154731_create_orders_table', 4);
INSERT INTO `migrations` VALUES (15, '2018_06_27_032558_create_order_details_table', 4);
INSERT INTO `migrations` VALUES (16, '2018_06_24_071211_create_drivers_table', 5);
INSERT INTO `migrations` VALUES (17, '2018_07_05_083456_create_templates_table', 6);
INSERT INTO `migrations` VALUES (18, '2018_07_11_035732_create_socials_table', 6);
INSERT INTO `migrations` VALUES (19, '2018_07_12_060704_create_warehouses_table', 7);
INSERT INTO `migrations` VALUES (20, '2018_08_25_090448_create_devices_table', 8);
INSERT INTO `migrations` VALUES (21, '2018_08_28_161051_create_order_receives_table', 9);
INSERT INTO `migrations` VALUES (22, '2018_08_29_075407_create_rooms_table', 10);
INSERT INTO `migrations` VALUES (23, '2018_08_29_075523_create_contacts_table', 10);

SET FOREIGN_KEY_CHECKS = 1;
