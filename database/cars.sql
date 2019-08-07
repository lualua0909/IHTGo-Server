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

 Date: 19/06/2019 13:22:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cars
-- ----------------------------
DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `manufacturer` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_plate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(11) NULL DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `type_car` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cars
-- ----------------------------
INSERT INTO `cars` VALUES (1, 1, 'Honda', 'Xe A.Bình', '59M1-04832', 'Dream', '100', '1', 1, 1, 8, NULL, '2019-01-26 01:21:55', '2019-01-26 01:21:55');
INSERT INTO `cars` VALUES (2, 27, 'honda', 'xe a.Lộc', '51l4 6413', 'wave', '100', '123', 5, 1, 8, NULL, '2019-02-13 06:42:29', '2019-02-13 06:42:29');
INSERT INTO `cars` VALUES (3, 27, 'honda', 'Xe a.Vũ', '59P1 81915', 'src', '100', '1234', 4, 1, 8, NULL, '2019-02-13 06:43:12', '2019-02-13 06:43:12');
INSERT INTO `cars` VALUES (4, 28, 'honda', 'Lê Văn Mạnh', '36D1 - 23221', 'sirus', '100', '12345', 6, 1, 8, NULL, '2019-02-13 07:20:41', '2019-02-13 07:20:41');
INSERT INTO `cars` VALUES (5, 28, 'yamaha', 'Trần Ngọc Diệp', '67M1 - 20698', 'exciter', '100', '1122', 8, 1, 8, NULL, '2019-02-13 07:26:36', '2019-02-13 07:26:36');
INSERT INTO `cars` VALUES (6, 28, 'yamaha', 'Võ Trọng Cần', '67C1 - 23894', 'sirus', '100', '1112', 9, 1, 8, NULL, '2019-02-13 07:27:38', '2019-02-13 07:27:38');
INSERT INTO `cars` VALUES (7, 27, 'honda', 'Xe A.Tú', '54y9 4416', 'wave', '100', '1235', 3, 1, 8, NULL, '2019-02-13 07:53:24', '2019-02-13 07:53:24');
INSERT INTO `cars` VALUES (8, 1, 'Honda', 'xe anh Danh', '67k9-5019', 'Dream', '100', '1236', 2, 1, 8, NULL, '2019-02-13 15:58:46', '2019-02-13 15:58:46');
INSERT INTO `cars` VALUES (9, 39, 'YAMAHA', 'xe  RI', '66h1-26720', 'AXELO', '100', '777', 10, 1, 8, NULL, '2019-02-14 09:42:36', '2019-02-14 09:42:36');
INSERT INTO `cars` VALUES (10, 39, 'HONDA', 'NAM', '83 k1 8169', 'WAVE', '100', '454', 11, 1, 8, NULL, '2019-02-14 09:43:34', '2019-02-14 09:43:34');
INSERT INTO `cars` VALUES (11, 39, 'HONDA', 'XE SANG', '61X1 -9537', 'WAVE', '100', '352', 12, 1, 8, NULL, '2019-02-14 09:45:11', '2019-02-14 09:45:11');
INSERT INTO `cars` VALUES (12, 1, 'SUZUKI', 'PHẠM HÙNG (500kg)', '51D-41966', 'XE TẢI', '500KG', '230', NULL, 2, 7, NULL, '2019-02-14 10:01:25', '2019-03-13 13:18:49');
INSERT INTO `cars` VALUES (13, 1, 'SUZUKI', 'KHANG (1000kg)', '51D-44471', 'XE TẢI', '1000KG', '3521', NULL, 2, 7, NULL, '2019-02-14 10:04:05', '2019-03-13 13:19:10');
INSERT INTO `cars` VALUES (14, 29, 'Zamaha', '61T7-2890', '1', 'F', 'Xe gắn máy', 'A1', 16, 1, 8, NULL, '2019-02-14 14:18:16', '2019-02-14 14:18:16');
INSERT INTO `cars` VALUES (15, 29, 'Yma', 'Nhớ', '59G1-01299', 'Max', 'Xe gắn máy', '27178', 17, 1, 8, NULL, '2019-02-14 14:29:29', '2019-02-14 14:29:29');
INSERT INTO `cars` VALUES (16, 29, 'Yamaha', 'Linh', '69D1-22846', 'Siryus', 'Xe gắn máy', '22846', 18, 1, 8, NULL, '2019-02-14 14:35:26', '2019-02-14 14:35:26');
INSERT INTO `cars` VALUES (17, 84, 'honda', 'Nguyễn Thanh Long', '61G9-4785', 'wave', '110', '03', 19, 1, 8, NULL, '2019-02-16 10:15:51', '2019-02-16 10:15:51');
INSERT INTO `cars` VALUES (18, 84, 'honda', 'Châu Thắng Quang', '60B1- 45576', 'airblade', '110', '02', 20, 1, 8, NULL, '2019-02-16 10:59:35', '2019-02-16 10:59:35');
INSERT INTO `cars` VALUES (19, 28, 'yamaha', 'Phạm Bá Bằng', '36B1 - 48082', 'sirus', '100', '11122', 7, 1, 8, NULL, '2019-02-16 14:18:27', '2019-02-16 14:18:27');
INSERT INTO `cars` VALUES (20, 1, 'Honda', 'Xe a.Khang', '59x2 9772', 'Wave s', '100', '11', 21, 1, 8, NULL, '2019-02-21 08:21:38', '2019-02-21 08:21:38');
INSERT INTO `cars` VALUES (21, 39, 'SUZUKI', 'THẠCH ALY KHANG', '51D- 44471', 'SUZUKI', '1000', 'VVV', 0, 1, 7, NULL, '2019-02-25 15:52:31', '2019-02-25 15:53:12');
INSERT INTO `cars` VALUES (22, 39, 'YA', 'KHANG', '61D1111', 'HONDA', '125', '455', 31, 1, 8, '2019-04-23 14:19:37', '2019-02-25 15:55:09', '2019-04-23 14:19:37');
INSERT INTO `cars` VALUES (23, 84, 'suzuki', 'Lầm Sấm Vảy', '39F1 - 4318', 'suzuki', '110', '750138003333', 0, 1, 8, NULL, '2019-03-01 08:43:03', '2019-03-01 08:43:03');
INSERT INTO `cars` VALUES (24, 39, 'SUZUKI', 'LẦM SẤM VẢY', '39F1-4318', 'HONDA', '160', '782', 22, 1, 8, NULL, '2019-03-02 14:11:15', '2019-03-02 14:11:15');
INSERT INTO `cars` VALUES (25, 29, 'YAMAHA', 'NGUYỄN HOÀNG THÂN', '66-B1 13702', 'SIRIUS', '1', '1282', 24, 1, 8, NULL, '2019-03-11 09:42:31', '2019-03-11 09:42:31');
INSERT INTO `cars` VALUES (26, 1, 'Honda', 'Nguyễn Thành Trung', '59b1-19321', 'wave', '100', '0', 25, 1, 8, NULL, '2019-03-18 14:31:31', '2019-03-18 14:31:31');
INSERT INTO `cars` VALUES (27, 27, 'suzuki', 'xe a hưng', '61C-36584', 'suzuki', '499', '111', 0, 2, 7, NULL, '2019-03-26 08:21:43', '2019-03-26 08:21:43');
INSERT INTO `cars` VALUES (28, 39, 'YA', 'XUYẾN', '0', 'HONDA', '160', '47', 26, 1, 8, NULL, '2019-04-03 09:10:58', '2019-04-03 09:10:58');
INSERT INTO `cars` VALUES (29, 250, 'honda', 'xe A. Phong', '59Y1- 542.36', 'WAVE RS', '1', '22', 27, 1, 8, NULL, '2019-04-08 16:01:27', '2019-05-22 14:04:34');
INSERT INTO `cars` VALUES (30, 27, 'honda', 'xe A. Xuân', '59G2 - 17658', 'vision', '1', '222', 28, 1, 8, NULL, '2019-04-10 08:51:47', '2019-04-10 08:51:47');
INSERT INTO `cars` VALUES (31, 28, 'XE TẢI', 'Xe cty', '51D1-12949', 'XE TẢI', '500', '00', 0, 2, 7, NULL, '2019-04-22 08:18:07', '2019-04-22 08:18:07');
INSERT INTO `cars` VALUES (32, 39, 'SUZUKI', 'THẠCH ALY KHANG', '61D11111', 'HONDA', '1000', '7821', 0, 2, 7, NULL, '2019-04-23 14:20:07', '2019-04-23 14:20:07');
INSERT INTO `cars` VALUES (33, 39, 'YA', 'KHANG', '51D- 44473', 'SUZUKI', '1000', '14783', 0, 2, 7, NULL, '2019-04-23 14:27:37', '2019-04-23 14:27:37');
INSERT INTO `cars` VALUES (34, 28, 'XE TẢI', 'Xe tải cty', '51D - 41966', 'XE TẢI', '500', '110', 0, 2, 7, NULL, '2019-04-24 15:51:38', '2019-04-24 15:51:38');
INSERT INTO `cars` VALUES (35, 106, 'honda', 'xe a.Vũ', '52Y5-5380', '1', '1', '.', 33, 1, 8, NULL, '2019-05-14 09:24:02', '2019-05-14 09:24:02');
INSERT INTO `cars` VALUES (36, 27, 'honda', 'yang', '59L2- 6666', 'PCX', '100', '6666', 34, 1, 8, NULL, '2019-05-14 10:16:13', '2019-05-14 10:16:13');
INSERT INTO `cars` VALUES (37, 307, 'Honda', 'Phạm Trung Trực', '01', 'Vision', '110', '123456', 36, 1, 8, NULL, '2019-05-27 10:40:58', '2019-05-27 10:40:58');
INSERT INTO `cars` VALUES (38, 307, 'Honda', 'Nguyễn Văn Thân', '60C2-297.86', 'Wave alpha', '100', '123456789', 35, 1, 8, NULL, '2019-05-27 10:43:12', '2019-05-27 10:43:12');
INSERT INTO `cars` VALUES (39, 307, 'Honda', 'Nguyễn Văn Khanh', '60C2-533.37', 'Wave alpha', '110', '234567', 37, 1, 8, NULL, '2019-06-03 09:27:32', '2019-06-03 09:27:32');
INSERT INTO `cars` VALUES (40, 84, 'honda', 'Đỗ Kim Trọng', '60B1-92416', 'honda', '110', '750038006340', 38, 1, 8, NULL, '2019-06-04 15:29:46', '2019-06-04 15:29:46');
INSERT INTO `cars` VALUES (41, 307, 'Honda', 'Trần Thanh Phong', '38X1-001.82', 'Click', '110', '234578', 39, 1, 8, NULL, '2019-06-10 14:31:58', '2019-06-10 14:31:58');
INSERT INTO `cars` VALUES (42, 1, 'Honda', 'Xe A.Luận', '22697', 'AB', '100', '213', 40, 1, 8, NULL, '2019-06-17 08:29:03', '2019-06-17 08:29:03');
INSERT INTO `cars` VALUES (43, 106, 'honda', 'Hồ Thị Thu Hồng', '54N6-7394', 'wave', '1', '000', 41, 1, 8, NULL, '2019-06-17 14:04:03', '2019-06-17 14:04:03');
INSERT INTO `cars` VALUES (44, 250, 'Honda', 'Xe Minh Trung', '59-L2 30189', 'AB', '100', '000000', 42, 1, 8, NULL, '2019-06-19 09:14:29', '2019-06-19 09:14:29');
INSERT INTO `cars` VALUES (45, 250, 'Yamaha', 'Xe Mẫn', '62-M4 3844', 'Sirius', '100', '01235', 43, 1, 8, NULL, '2019-06-19 09:18:25', '2019-06-19 09:18:25');

SET FOREIGN_KEY_CHECKS = 1;
