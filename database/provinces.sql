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

 Date: 19/06/2019 13:23:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces`  (
  `province_id` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`province_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES ('01', 'Thành phố Hà Nội', 'Thành phố Trung ương', 0);
INSERT INTO `provinces` VALUES ('02', 'Tỉnh Hà Giang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('04', 'Tỉnh Cao Bằng', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('06', 'Tỉnh Bắc Kạn', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('08', 'Tỉnh Tuyên Quang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('10', 'Tỉnh Lào Cai', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('11', 'Tỉnh Điện Biên', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('12', 'Tỉnh Lai Châu', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('14', 'Tỉnh Sơn La', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('15', 'Tỉnh Yên Bái', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('17', 'Tỉnh Hoà Bình', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('19', 'Tỉnh Thái Nguyên', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('20', 'Tỉnh Lạng Sơn', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('22', 'Tỉnh Quảng Ninh', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('24', 'Tỉnh Bắc Giang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('25', 'Tỉnh Phú Thọ', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('26', 'Tỉnh Vĩnh Phúc', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('27', 'Tỉnh Bắc Ninh', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('30', 'Tỉnh Hải Dương', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('31', 'Thành phố Hải Phòng', 'Thành phố Trung ương', 0);
INSERT INTO `provinces` VALUES ('33', 'Tỉnh Hưng Yên', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('34', 'Tỉnh Thái Bình', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('35', 'Tỉnh Hà Nam', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('36', 'Tỉnh Nam Định', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('37', 'Tỉnh Ninh Bình', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('38', 'Tỉnh Thanh Hóa', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('40', 'Tỉnh Nghệ An', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('42', 'Tỉnh Hà Tĩnh', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('44', 'Tỉnh Quảng Bình', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('45', 'Tỉnh Quảng Trị', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('46', 'Tỉnh Thừa Thiên Huế', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('48', 'Thành phố Đà Nẵng', 'Thành phố Trung ương', 0);
INSERT INTO `provinces` VALUES ('49', 'Tỉnh Quảng Nam', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('51', 'Tỉnh Quảng Ngãi', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('52', 'Tỉnh Bình Định', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('54', 'Tỉnh Phú Yên', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('56', 'Tỉnh Khánh Hòa', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('58', 'Tỉnh Ninh Thuận', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('60', 'Tỉnh Bình Thuận', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('62', 'Tỉnh Kon Tum', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('64', 'Tỉnh Gia Lai', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('66', 'Tỉnh Đắk Lắk', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('67', 'Tỉnh Đắk Nông', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('68', 'Tỉnh Lâm Đồng', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('70', 'Tỉnh Bình Phước', 'Tỉnh', 1);
INSERT INTO `provinces` VALUES ('72', 'Tỉnh Tây Ninh', 'Tỉnh', 1);
INSERT INTO `provinces` VALUES ('74', 'Tỉnh Bình Dương', 'Tỉnh', 1);
INSERT INTO `provinces` VALUES ('75', 'Tỉnh Đồng Nai', 'Tỉnh', 1);
INSERT INTO `provinces` VALUES ('77', 'Tỉnh Bà Rịa - Vũng Tàu', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('79', 'Thành phố Hồ Chí Minh', 'Thành phố Trung ương', 1);
INSERT INTO `provinces` VALUES ('80', 'Tỉnh Long An', 'Tỉnh', 1);
INSERT INTO `provinces` VALUES ('82', 'Tỉnh Tiền Giang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('83', 'Tỉnh Bến Tre', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('84', 'Tỉnh Trà Vinh', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('86', 'Tỉnh Vĩnh Long', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('87', 'Tỉnh Đồng Tháp', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('89', 'Tỉnh An Giang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('91', 'Tỉnh Kiên Giang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('92', 'Thành phố Cần Thơ', 'Thành phố Trung ương', 0);
INSERT INTO `provinces` VALUES ('93', 'Tỉnh Hậu Giang', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('94', 'Tỉnh Sóc Trăng', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('95', 'Tỉnh Bạc Liêu', 'Tỉnh', 0);
INSERT INTO `provinces` VALUES ('96', 'Tỉnh Cà Mau', 'Tỉnh', 0);

SET FOREIGN_KEY_CHECKS = 1;
