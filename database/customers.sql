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

 Date: 19/06/2019 13:22:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pic` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `company_id` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 201 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 2, 1, 'address', 'Thaile', NULL, NULL, NULL, '2019-01-22 03:58:34', '2019-01-22 03:58:34');
INSERT INTO `customers` VALUES (5, 6, 1, 'Xxx', NULL, NULL, NULL, NULL, '2019-01-22 08:18:32', '2019-01-22 08:18:50');
INSERT INTO `customers` VALUES (6, 7, 1, NULL, NULL, NULL, NULL, NULL, '2019-01-22 08:20:24', '2019-01-22 08:20:24');
INSERT INTO `customers` VALUES (12, 16, 1, 'xx', NULL, NULL, NULL, NULL, '2019-01-25 08:46:41', '2019-01-28 03:30:56');
INSERT INTO `customers` VALUES (15, 20, 2, '8 bà triệu, quận 5', 'null', 'IHT-KH2019012612', NULL, NULL, '2019-01-26 02:36:29', '2019-01-26 02:36:29');
INSERT INTO `customers` VALUES (17, 22, 1, 'xxx', NULL, NULL, NULL, NULL, '2019-01-28 03:47:15', '2019-01-28 03:47:28');
INSERT INTO `customers` VALUES (18, 23, 2, '8 bà triệu quận 5', NULL, NULL, 101, NULL, '2019-01-28 04:21:50', '2019-05-22 17:05:56');
INSERT INTO `customers` VALUES (19, 24, 2, '8 bà triệu quận 5', 'null', 'IHT-KH2019012816', 101, NULL, '2019-01-28 07:30:35', '2019-01-28 07:30:35');
INSERT INTO `customers` VALUES (21, 26, 1, 'Hello', NULL, NULL, NULL, NULL, '2019-02-04 19:39:31', '2019-02-04 19:40:02');
INSERT INTO `customers` VALUES (22, 34, 2, 'Tầng 12, Tòa nhà Mapletree Business Centre, số 1060 Nguyễn Văn Linh, Tân Phong, Quận 7, HCM.', 'Minh Thu', 'IHT-KH2019021319', 103, NULL, '2019-02-13 01:57:27', '2019-02-13 01:57:27');
INSERT INTO `customers` VALUES (23, 40, 2, 'bình hưng bình chánh', 'null', 'IHT-KH2019021320', 104, NULL, '2019-02-13 03:49:14', '2019-02-13 03:49:14');
INSERT INTO `customers` VALUES (25, 43, 2, '163 Trương Văn Bang, P. Thạnh Mỹ Lợi, Q.2, TP. HCM', 'Quang', 'IHT-KH2019021322', 102, NULL, '2019-02-13 07:20:04', '2019-02-13 07:20:04');
INSERT INTO `customers` VALUES (26, 44, 2, 'Tầng 4 Toà nhà Thành An, Số 8 Bà Triệu, P.12, Q5.', 'Trang', 'IHT-KH2019021323', 101, NULL, '2019-02-13 07:26:56', '2019-02-13 07:26:56');
INSERT INTO `customers` VALUES (28, 48, 2, '08 bà triệu', 'null', 'IHT-KH2019021321', 101, NULL, '2019-02-13 16:41:47', '2019-02-13 16:41:47');
INSERT INTO `customers` VALUES (33, 64, 2, 'số 8 Bà Triệu, P.12, Q.5, HCM', 'Thảo', 'IHT-KH2019021425', 101, NULL, '2019-02-14 10:31:29', '2019-02-14 10:31:29');
INSERT INTO `customers` VALUES (34, 65, 2, 'số 8 bà triệu, p12, q5,tp.hcm', 'null', 'IHT-KH2019021426', 101, NULL, '2019-02-14 13:38:19', '2019-02-14 13:38:19');
INSERT INTO `customers` VALUES (36, 73, 2, '25 đường số 24 kdc him lam 6A,bình hưng, bình chánh, hcm', 'Ngọc', 'IHT-KH2019021528', 105, NULL, '2019-02-15 10:21:01', '2019-02-15 10:21:01');
INSERT INTO `customers` VALUES (37, 74, 2, 'tầng 4 toà nhà thành an, số 8 bà triệu phường 12 quận 5', 'Mr. Peter', 'IHT-KH2019021529', 101, NULL, '2019-02-15 10:28:32', '2019-02-15 10:28:32');
INSERT INTO `customers` VALUES (38, 76, 2, 'số 8 bà triệu f12 q5', 'null', 'IHT-KH2019021530', 101, NULL, '2019-02-15 14:43:57', '2019-02-15 14:43:57');
INSERT INTO `customers` VALUES (40, 78, 2, 'Số 8 Bà Triệu P.12,Q.5', 'null', 'IHT-KH2019021532', 101, NULL, '2019-02-15 14:45:34', '2019-02-15 14:45:34');
INSERT INTO `customers` VALUES (41, 79, 2, 'số 8 bà triệu phường 12 quận 5 tphcm', 'null', 'IHT-KH2019021533', 101, NULL, '2019-02-15 14:46:28', '2019-02-15 14:46:28');
INSERT INTO `customers` VALUES (43, 81, 2, 'số 8 bà triệu', 'null', 'IHT-KH2019021535', 101, NULL, '2019-02-15 14:59:14', '2019-02-15 14:59:14');
INSERT INTO `customers` VALUES (44, 82, 2, '8 bà triệu quận 5', 'Trần thị ngọc thoa', 'IHT-KH2019021536', 101, NULL, '2019-02-15 16:10:02', '2019-02-15 16:10:02');
INSERT INTO `customers` VALUES (45, 83, 2, '8 Bà Triệu, Q. 5', 'null', 'IHT-KH2019021537', 101, NULL, '2019-02-15 16:32:13', '2019-02-15 16:32:13');
INSERT INTO `customers` VALUES (46, 90, 1, 'hcm', 'null', NULL, NULL, NULL, '2019-02-17 00:48:05', '2019-02-17 00:48:05');
INSERT INTO `customers` VALUES (47, 91, 1, 'số 408 đường Bắc Cạn TP Thái Nguyên tỉnh Thái Nguyên', 'Mai Thúy Nga', NULL, NULL, NULL, '2019-02-17 08:53:03', '2019-02-17 08:53:03');
INSERT INTO `customers` VALUES (48, 92, 2, 'Lô A_7_CN KCN BÀU BÀNG, XÃ LAI HƯNG, HUYỆN BÀU BÀNG, TỈNH BÌNH DƯƠNG', 'Ms Lương', 'IHT-KH2019021839', 107, NULL, '2019-02-18 14:15:12', '2019-02-18 14:15:12');
INSERT INTO `customers` VALUES (49, 93, 2, 'Mai', 'Mai', NULL, 108, NULL, '2019-02-19 11:44:15', '2019-02-19 11:44:15');
INSERT INTO `customers` VALUES (50, 94, 2, 'khu phố bình phú, P. Bình chuẩn, TX Thuận An, T. Bình Dương', 'Nhung', 'IHT-KH2019022041', 101, NULL, '2019-02-20 09:57:52', '2019-02-20 09:57:52');
INSERT INTO `customers` VALUES (51, 95, 2, 'CTY TNHH MAY THÊU WINNING- KHU PHỐ BÌNH PHÚ, PHƯỜNG BÌNH CHUẨN, THỊ XÃ THUẬN AN, TỈNH BÌNH DƯƠNG', 'Thoa', 'IHT-KH2019022042', 101, NULL, '2019-02-20 10:00:44', '2019-02-20 10:00:44');
INSERT INTO `customers` VALUES (52, 96, 2, 'số 8 đường số 18 , Kcn Sóng thần 2, Dĩ An, Bình Dương', 'Dung', 'IHT-KH2019022043', 109, NULL, '2019-02-20 11:25:23', '2019-02-20 11:25:23');
INSERT INTO `customers` VALUES (53, 97, 2, 'số 8 bà triệu p12 quận 5', 'Thanh Mai', 'IHT-KH2019022044', 101, NULL, '2019-02-20 12:05:31', '2019-02-20 12:05:31');
INSERT INTO `customers` VALUES (54, 98, 2, 'đường số 2A , Kcn Đồng an, Thuận An, Bình Dương', 'Vững', 'IHT-KH2019022045', 106, NULL, '2019-02-20 15:50:26', '2019-02-20 15:50:26');
INSERT INTO `customers` VALUES (55, 100, 2, 'Bình dương', 'hek', 'IHT-KH2019022146', 111, NULL, '2019-02-21 08:49:06', '2019-02-21 08:49:06');
INSERT INTO `customers` VALUES (57, 103, 2, 'số O8, KDT Vạn Phúc, đường Nguyễn Thị Nhung, P. Hiệp Bình Phước, Thủ Đức, Tp. HCM', 'Mai', 'IHT-KH2019022248', 1, NULL, '2019-02-22 09:10:59', '2019-02-22 09:10:59');
INSERT INTO `customers` VALUES (58, 104, 1, '0373970005', 'phạm đình phi', NULL, NULL, NULL, '2019-02-22 13:44:59', '2019-02-22 13:44:59');
INSERT INTO `customers` VALUES (59, 105, 2, 'Bình Dương', 'Ngõ', 'IHT-KH2019022250', 117, NULL, '2019-02-22 15:28:09', '2019-02-22 15:28:09');
INSERT INTO `customers` VALUES (60, 116, 1, 'Bình dương', 'Quỳnh', NULL, NULL, NULL, '2019-02-23 14:23:22', '2019-02-23 14:23:22');
INSERT INTO `customers` VALUES (61, 117, 2, 'Bình Dương', 'Bình', 'IHT-KH2019022352', 114, NULL, '2019-02-23 14:43:28', '2019-02-23 14:43:28');
INSERT INTO `customers` VALUES (62, 118, 2, 'Thuan An, Binh Duong', '0936397634', NULL, 101, NULL, '2019-02-23 15:38:44', '2019-02-23 15:38:44');
INSERT INTO `customers` VALUES (63, 119, 2, '12 phan kế bính quận 1', '0377104850', NULL, 101, NULL, '2019-02-24 18:26:53', '2019-02-24 18:26:53');
INSERT INTO `customers` VALUES (64, 120, 2, 'Mỹ phước, Bến Cát, Bình Dương', 'Nguyệt', 'IHT-KH2019022555', 111, NULL, '2019-02-25 15:38:29', '2019-02-25 15:38:29');
INSERT INTO `customers` VALUES (65, 121, 2, 'bình dương', 'Chắn', 'IHT-KH2019022656', 118, NULL, '2019-02-26 12:14:39', '2019-02-26 12:14:39');
INSERT INTO `customers` VALUES (66, 122, 2, 'Bình Dương', 'Trinh', 'IHT-KH2019022657', 110, NULL, '2019-02-26 14:11:19', '2019-02-26 14:11:19');
INSERT INTO `customers` VALUES (67, 123, 2, 'Bàu Bàng, Bình Dương', 'Khang', 'IHT-KH2019022658', 113, NULL, '2019-02-26 14:16:31', '2019-02-26 14:16:31');
INSERT INTO `customers` VALUES (68, 124, 2, 'số 8 Bà Triệu Phường 12 Quận 5 HCM', 'Vy', 'IHT-KH2019022659', 116, NULL, '2019-02-26 15:18:15', '2019-02-26 15:18:15');
INSERT INTO `customers` VALUES (69, 125, 2, 'số 8 Bà Triệu phường 12 quận 5', 'Jenny Chen', 'IHT-KH2019022760', 119, NULL, '2019-02-27 10:55:19', '2019-02-27 10:55:19');
INSERT INTO `customers` VALUES (70, 126, 2, 'số 8 Bà Triệu phường 12 Quận 5', 'chị Linh - Nancy', 'IHT-KH2019022761', 101, NULL, '2019-02-27 13:18:13', '2019-02-27 13:18:13');
INSERT INTO `customers` VALUES (71, 128, 2, 'd10/89q khu b3 qlo 1a phường tân tạo quận bình tân', 'c vy', 'IHT-KH2019030162', 117, NULL, '2019-03-01 10:15:49', '2019-03-01 10:15:49');
INSERT INTO `customers` VALUES (72, 130, 2, 'Bìng Dương', 'Nụ', 'IHT-KH2019030163', 120, NULL, '2019-03-01 14:00:45', '2019-03-01 14:00:45');
INSERT INTO `customers` VALUES (73, 131, 2, 'bình dương', 'lĩ', 'IHT-KH2019030164', 121, NULL, '2019-03-01 14:22:19', '2019-03-01 14:22:19');
INSERT INTO `customers` VALUES (74, 132, 1, '8 ba trieu P12Q5', NULL, NULL, NULL, NULL, '2019-03-01 17:06:56', '2019-03-01 17:07:24');
INSERT INTO `customers` VALUES (75, 133, 2, '99 Bis ấp 2 xã Tân Hạnh Biên Hoà , Đồng Nai', 'c. Dung', 'IHT-KH2019030266', 122, NULL, '2019-03-02 15:54:16', '2019-03-02 15:54:16');
INSERT INTO `customers` VALUES (76, 134, 2, 'Bình Dương', 'Trâm', 'IHT-KH2019030467', 123, NULL, '2019-03-04 10:53:08', '2019-03-04 10:53:08');
INSERT INTO `customers` VALUES (77, 135, 2, 'visip, bình dương', 'bảo hà', 'IHT-KH2019030468', 101, NULL, '2019-03-04 11:05:30', '2019-03-04 11:05:30');
INSERT INTO `customers` VALUES (78, 136, 1, 'Hồ Chí Minh', NULL, NULL, NULL, NULL, '2019-03-04 13:15:21', '2019-03-04 13:16:37');
INSERT INTO `customers` VALUES (79, 137, 2, '318 pham hung', 'nhi', NULL, 101, NULL, '2019-03-05 08:54:15', '2019-03-05 08:54:15');
INSERT INTO `customers` VALUES (80, 138, 2, 'Bình dương', 'loan', 'IHT-KH2019030571', 124, NULL, '2019-03-05 09:12:57', '2019-03-05 09:12:57');
INSERT INTO `customers` VALUES (82, 140, 2, 'Bình Dương', 'nhi', 'IHT-KH2019030573', 125, NULL, '2019-03-05 09:49:58', '2019-03-05 09:49:58');
INSERT INTO `customers` VALUES (83, 141, 1, '8 ba trieu', 'QAZ15974', NULL, NULL, NULL, '2019-03-05 13:40:50', '2019-03-05 13:40:50');
INSERT INTO `customers` VALUES (84, 143, 2, 'So 8 ba trieu', NULL, NULL, 101, NULL, '2019-03-05 13:46:34', '2019-03-05 15:15:15');
INSERT INTO `customers` VALUES (85, 144, 1, 'xxx', NULL, NULL, NULL, NULL, '2019-03-05 14:27:06', '2019-03-05 14:28:13');
INSERT INTO `customers` VALUES (90, 149, 1, '8 Bà Triệu, p12, 15, hcm', 'Thuý', NULL, NULL, NULL, '2019-03-05 16:02:43', '2019-03-05 16:02:43');
INSERT INTO `customers` VALUES (91, 151, 2, 'Cty hợp lực Vina', 'chị Lệ', 'IHT-KH2019030666', 126, NULL, '2019-03-06 10:33:13', '2019-03-06 10:33:13');
INSERT INTO `customers` VALUES (93, 153, 2, 'bình duong', 'nhung', 'IHT-KH2019030668', 127, NULL, '2019-03-06 15:03:40', '2019-03-06 15:03:40');
INSERT INTO `customers` VALUES (94, 155, 2, 'số 8 bà triệu', 'ms Vy', 'IHT-KH2019030769', 128, NULL, '2019-03-07 08:19:02', '2019-03-07 08:19:02');
INSERT INTO `customers` VALUES (98, 159, 2, '46, Dai Lo Tu Do, Thuan An, Binh Duong', 'null', 'IHT-KH2019031070', 101, NULL, '2019-03-10 18:00:20', '2019-03-10 18:00:20');
INSERT INTO `customers` VALUES (102, 181, 2, 'thửa đất 518 ấp 5 xã đức hòa đông huyện đức hòa tỉnh long an', 'Hảo', 'IHT-KH2019031271', 130, NULL, '2019-03-12 14:46:59', '2019-03-12 14:46:59');
INSERT INTO `customers` VALUES (104, 183, 2, '3A 64/3 ấp 3 xã phạm văn hai,huyện bình chánh', 'Quỳnh', 'IHT-KH2019031272', 129, NULL, '2019-03-12 15:44:35', '2019-03-12 15:44:35');
INSERT INTO `customers` VALUES (107, 186, 2, '8/7a phạm hùng p4 q8', 'mẫn', 'IHT-KH2019031474', 101, NULL, '2019-03-14 14:01:42', '2019-03-14 14:01:42');
INSERT INTO `customers` VALUES (108, 187, 1, 'Cây xăng Chung Phát, Tạo lực 6, Định Hoà, Thủ Dầu Một, Bình Dương', 'Tuyết Vân', NULL, NULL, NULL, '2019-03-15 08:28:20', '2019-03-15 08:28:20');
INSERT INTO `customers` VALUES (109, 188, 2, '172/97, duong An Duong Vuong , P16 , Q8 , TPHCm', 'Huynh Gia Loi', 'IHT-KH2019031876', 1, NULL, '2019-03-18 08:03:25', '2019-03-18 08:03:25');
INSERT INTO `customers` VALUES (110, 189, 2, 'lô A1-A7 Duong N2 KCN Dai Dang p Tân Phu Tp.Thu Dau Mot,BD', 'Ms Jessica', 'IHT-KH2019031877', 131, NULL, '2019-03-18 09:20:08', '2019-03-18 09:20:08');
INSERT INTO `customers` VALUES (111, 190, 1, 'tổ 1 ấp tân an. xã tân vĩnh hiệp huyện Tân Uyên tỉnh Bình Dương', 'null', NULL, NULL, NULL, '2019-03-18 11:47:37', '2019-03-18 11:47:37');
INSERT INTO `customers` VALUES (112, 192, 1, '362 tran phu p7 q5', NULL, NULL, NULL, NULL, '2019-03-19 10:39:38', '2019-03-19 10:40:32');
INSERT INTO `customers` VALUES (113, 193, 2, 'Công ty IHT', 'Trang', NULL, 101, NULL, '2019-03-20 10:04:50', '2019-03-20 10:04:50');
INSERT INTO `customers` VALUES (114, 194, 1, 'dia chi', NULL, NULL, NULL, NULL, '2019-03-20 20:01:31', '2019-03-20 20:02:18');
INSERT INTO `customers` VALUES (115, 195, 1, 'B', NULL, NULL, NULL, NULL, '2019-03-22 11:03:39', '2019-03-22 11:04:10');
INSERT INTO `customers` VALUES (116, 202, 1, '112/351', NULL, NULL, NULL, NULL, '2019-03-23 21:29:12', '2019-03-23 21:30:10');
INSERT INTO `customers` VALUES (117, 205, 1, 'Binh duong', NULL, NULL, NULL, NULL, '2019-03-26 11:33:12', '2019-03-26 11:33:30');
INSERT INTO `customers` VALUES (118, 233, 2, 'bình dương', 'tân thịnh', 'IHT-KH2019032984', 133, NULL, '2019-03-29 11:39:04', '2019-03-29 11:39:04');
INSERT INTO `customers` VALUES (119, 234, 1, 'address', 'Thaile', NULL, NULL, NULL, '2019-03-29 11:40:27', '2019-03-29 11:40:27');
INSERT INTO `customers` VALUES (120, 235, 2, 'thủ dầu một, bình dương', 'Chị Hằng', 'IHT-KH2019033086', 118, NULL, '2019-03-30 10:25:07', '2019-03-30 10:25:07');
INSERT INTO `customers` VALUES (121, 236, 2, '793 QL13, p.Hiệp Bình Phước, Thủ Đức, Bình Dương', 'chị Ngân', 'IHT-KH2019033087', 134, NULL, '2019-03-30 11:06:21', '2019-03-30 11:06:21');
INSERT INTO `customers` VALUES (122, 237, 1, '62 ba hom', 'null', NULL, NULL, NULL, '2019-03-30 21:11:01', '2019-03-30 21:11:01');
INSERT INTO `customers` VALUES (123, 239, 2, 'bình dương', 'anh', 'IHT-KH2019040389', 135, NULL, '2019-04-03 10:50:00', '2019-04-03 10:50:00');
INSERT INTO `customers` VALUES (124, 240, 2, 'tân phước khánh, tân uyên, bình dương', 'le ly', 'IHT-KH2019040390', 114, NULL, '2019-04-03 14:25:18', '2019-04-03 14:25:18');
INSERT INTO `customers` VALUES (125, 241, 1, 'xxxx', NULL, NULL, NULL, NULL, '2019-04-03 15:12:53', '2019-04-03 15:13:16');
INSERT INTO `customers` VALUES (126, 242, 1, NULL, NULL, NULL, NULL, NULL, '2019-04-03 16:40:41', '2019-04-03 16:40:41');
INSERT INTO `customers` VALUES (127, 243, 1, 'lầu 5, số 84 đường Bạch Đằng, P.2, Q.Tân Bình', 'huy', NULL, NULL, NULL, '2019-04-04 09:59:43', '2019-04-04 09:59:43');
INSERT INTO `customers` VALUES (128, 244, 2, 'so 23 ,duong 25B, to ap 16, ap xom goc, xa long an, huyen long thanh, tinh dong nai, viet nam', '123456', 'IHT-KH2019040494', 132, NULL, '2019-04-04 11:13:02', '2019-04-04 11:13:02');
INSERT INTO `customers` VALUES (129, 245, 2, 'bình dương', 'duyên', 'IHT-KH2019040895', 136, NULL, '2019-04-08 14:58:31', '2019-04-08 14:58:31');
INSERT INTO `customers` VALUES (130, 248, 1, '61/8 nguyễn bình, âp 2 xả phú xuân quyện nhà bè', NULL, NULL, NULL, NULL, '2019-04-10 09:47:12', '2019-04-10 09:48:14');
INSERT INTO `customers` VALUES (131, 249, 2, 'bình dương', 'dũng', 'IHT-KH2019041197', 138, NULL, '2019-04-11 08:42:37', '2019-04-11 08:42:37');
INSERT INTO `customers` VALUES (135, 254, 2, 'số 8 bà triệu p12 q5', 'Annie', 'IHT-KH2019041197', 101, NULL, '2019-04-11 11:51:11', '2019-04-11 11:51:11');
INSERT INTO `customers` VALUES (136, 255, 1, '933/5 Tỉnh Lộ 10, P. Tân Tạo, Q. Bình Tân, TP. HCM', NULL, NULL, NULL, NULL, '2019-04-11 12:47:41', '2019-04-11 12:51:41');
INSERT INTO `customers` VALUES (137, 256, 1, 'Bj', NULL, NULL, NULL, NULL, '2019-04-12 06:30:28', '2019-04-12 06:32:29');
INSERT INTO `customers` VALUES (138, 257, 2, 'bd', 'chi', 'IHT-KH20190412100', 139, NULL, '2019-04-12 08:46:14', '2019-04-12 08:46:14');
INSERT INTO `customers` VALUES (139, 258, 1, 'Số 15 đường 3A, KCN Biên Hoà 2, Đồng Nai', 'Yến', NULL, NULL, NULL, '2019-04-12 09:07:44', '2019-04-12 09:07:44');
INSERT INTO `customers` VALUES (140, 259, 2, 'đường D23 KDC Việt Sing, Thuận An, Bình Dương', 'Sealy Chueng', 'IHT-KH20190412102', 140, NULL, '2019-04-12 16:03:06', '2019-04-12 16:03:06');
INSERT INTO `customers` VALUES (141, 260, 2, '117 nguyễn trãi phường 2 quận 5 hcm', '123456', NULL, 141, NULL, '2019-04-13 08:40:17', '2019-04-13 08:40:17');
INSERT INTO `customers` VALUES (142, 261, 1, NULL, NULL, NULL, NULL, NULL, '2019-04-16 11:04:24', '2019-04-16 11:04:24');
INSERT INTO `customers` VALUES (143, 262, 2, '08 bà triệu,p12,q5', 'null', 'IHT-KH20190416105', 101, NULL, '2019-04-16 14:07:41', '2019-04-16 14:07:41');
INSERT INTO `customers` VALUES (144, 263, 2, 'Tang 9 ,toan nha Vien Dong, 14Phan Ton, Phuong Da kao,quan 1 tp.hcm', '123456', 'IHT-KH20190417106', 142, NULL, '2019-04-17 10:09:45', '2019-04-17 10:09:45');
INSERT INTO `customers` VALUES (145, 264, 1, '2/71 Phan Thúc Duyện Phường 4 Tân Bình', 'Krystal', NULL, NULL, NULL, '2019-04-18 10:48:10', '2019-04-18 10:48:10');
INSERT INTO `customers` VALUES (146, 266, 1, '8 Bà Triệu', 'null', NULL, NULL, NULL, '2019-04-19 13:39:41', '2019-04-19 13:39:41');
INSERT INTO `customers` VALUES (147, 267, 1, ',', NULL, NULL, NULL, NULL, '2019-04-19 16:09:24', '2019-04-19 16:09:44');
INSERT INTO `customers` VALUES (149, 271, 1, '99 nguyen thi thap, phuong tan phu, quan 7 tphcm', 'vu thi ngoc diep', NULL, NULL, NULL, '2019-04-22 13:58:09', '2019-04-22 13:58:09');
INSERT INTO `customers` VALUES (150, 273, 1, 'Cvv', NULL, NULL, NULL, NULL, '2019-04-22 17:02:10', '2019-04-22 17:02:19');
INSERT INTO `customers` VALUES (151, 275, 1, 'Bau bang', NULL, NULL, NULL, NULL, '2019-04-23 11:42:00', '2019-04-23 11:42:19');
INSERT INTO `customers` VALUES (152, 278, 1, 'số 17, đường số 24, KCN Vsip 2A, Vĩnh Tân, Tân Uyên, Bình Dương', 'null', NULL, NULL, NULL, '2019-04-24 10:13:08', '2019-04-24 10:13:08');
INSERT INTO `customers` VALUES (153, 279, 1, '73 minh phụng p5 q6', 'phương', NULL, NULL, NULL, '2019-04-24 13:49:40', '2019-04-24 13:49:40');
INSERT INTO `customers` VALUES (154, 280, 2, '33 tổ 9 kp bình hoà thuận an bình dương', 'Lý Tổ Phú', 'IHT-KH20190426115', 1, NULL, '2019-04-26 09:02:29', '2019-04-26 09:02:29');
INSERT INTO `customers` VALUES (155, 281, 2, 'khu phố bình phú phường bình chuẩn tx thuận an tỉnh bình dương', 'nguyễn thanh trúc', 'IHT-KH20190502116', 145, NULL, '2019-05-02 08:36:08', '2019-05-02 08:36:08');
INSERT INTO `customers` VALUES (156, 282, 1, 'số 8, bà triệu,  quận 5, tp HCM', 'Tuyết', NULL, NULL, NULL, '2019-05-02 10:54:41', '2019-05-02 10:54:41');
INSERT INTO `customers` VALUES (157, 283, 2, 'dc60 đường da8 kdc việt sing, thuận an, bình dương', 'Tám', 'IHT-KH20190503118', 1, NULL, '2019-05-03 11:07:08', '2019-05-03 11:07:08');
INSERT INTO `customers` VALUES (158, 284, 1, '4355 nguyen cuu phu p tan tao a quan binh tan tphcm', 'huynh vonh quang', NULL, NULL, NULL, '2019-05-07 11:26:51', '2019-05-07 11:26:51');
INSERT INTO `customers` VALUES (159, 285, 1, '66 tạ uyên phương 15 quận 5 ,hcm', 'c thanh', NULL, NULL, NULL, '2019-05-07 14:34:42', '2019-05-07 14:34:42');
INSERT INTO `customers` VALUES (160, 286, 1, '0973409729', NULL, NULL, NULL, NULL, '2019-05-07 14:49:52', '2019-05-07 14:52:30');
INSERT INTO `customers` VALUES (161, 287, 1, '40 nguyễn văn lượng gò vapa', NULL, NULL, NULL, NULL, '2019-05-08 17:58:18', '2019-05-08 17:58:44');
INSERT INTO `customers` VALUES (162, 288, 2, 'Polytex', 'null', NULL, 103, NULL, '2019-05-08 21:44:15', '2019-05-08 21:44:15');
INSERT INTO `customers` VALUES (163, 289, 1, 'Z', NULL, NULL, NULL, NULL, '2019-05-10 14:38:21', '2019-05-10 14:38:34');
INSERT INTO `customers` VALUES (164, 290, 2, 'kcn sóng thần 2, dĩ an, bình dương', 'anh trieu', 'IHT-KH20190513125', 147, NULL, '2019-05-13 15:37:52', '2019-05-13 15:37:52');
INSERT INTO `customers` VALUES (165, 293, 2, 'khu công nghiệp nam tân uyên, tx tân uyên, bình dương', 'hiếu', 'IHT-KH20190514126', 149, NULL, '2019-05-14 13:05:17', '2019-05-14 13:05:17');
INSERT INTO `customers` VALUES (166, 294, 2, '160 TL15, Kp.3, Quận 12', 'chị Thúy', 'IHT-KH20190516127', 150, NULL, '2019-05-16 10:07:30', '2019-05-16 10:07:30');
INSERT INTO `customers` VALUES (167, 295, 2, 'Tầng 6, 27b Nguyễn Đình Chiểu Phường Đa Kao, Quận 1', 'ms Thùy Dương', 'IHT-KH20190516128', 151, NULL, '2019-05-16 16:08:32', '2019-05-16 16:08:32');
INSERT INTO `customers` VALUES (168, 296, 2, 'mp', 'hạnh', 'IHT-KH20190517129', 152, NULL, '2019-05-17 09:38:30', '2019-05-17 09:38:30');
INSERT INTO `customers` VALUES (169, 297, 1, 'khánh bình, tân uyên, bình dương', 'Hằng', NULL, NULL, NULL, '2019-05-17 09:50:56', '2019-05-17 09:50:56');
INSERT INTO `customers` VALUES (170, 298, 1, '5 đường số 12', NULL, NULL, NULL, NULL, '2019-05-17 11:41:53', '2019-06-14 13:32:13');
INSERT INTO `customers` VALUES (171, 299, 2, 'Bình Dương', 'P', 'IHT-KH20190518132', 153, NULL, '2019-05-18 10:50:39', '2019-05-18 10:50:39');
INSERT INTO `customers` VALUES (172, 300, 2, 'Mã Lò KP6 P. Bình Trị Đông A Q.Bình Tân', 'Chị Anh', 'IHT-KH20190518133', 154, NULL, '2019-05-18 12:27:28', '2019-05-18 12:27:28');
INSERT INTO `customers` VALUES (173, 301, 1, 'bình dương', NULL, NULL, NULL, NULL, '2019-05-19 06:26:31', '2019-05-19 06:26:55');
INSERT INTO `customers` VALUES (174, 302, 1, '377/15 cmtt p12 q10', 'long', NULL, NULL, NULL, '2019-05-20 12:56:12', '2019-05-20 12:56:12');
INSERT INTO `customers` VALUES (175, 303, 2, 'BD', 'D', 'IHT-KH20190521136', 155, NULL, '2019-05-21 09:41:13', '2019-05-21 09:41:13');
INSERT INTO `customers` VALUES (176, 304, 1, 'đức giang, Yên Dũng ,Bắc Giang', 'null', NULL, NULL, NULL, '2019-05-21 17:12:10', '2019-05-21 17:12:10');
INSERT INTO `customers` VALUES (177, 305, 1, '160/58/4 Phan Huy Ích', 'khả', NULL, NULL, NULL, '2019-05-22 16:19:26', '2019-05-22 16:19:26');
INSERT INTO `customers` VALUES (178, 306, 1, NULL, NULL, NULL, NULL, NULL, '2019-05-23 09:59:13', '2019-05-23 09:59:13');
INSERT INTO `customers` VALUES (179, 308, 1, '8 Bà Triệu, P12, Q5', 'Ngo Bao', NULL, NULL, NULL, '2019-05-23 11:00:27', '2019-05-23 11:00:27');
INSERT INTO `customers` VALUES (180, 309, 1, 'Ấp ba trường , xã phước an , huyện nhơn trạch , tỉnh đồng nai', NULL, NULL, NULL, NULL, '2019-05-23 12:08:25', '2019-05-23 12:09:39');
INSERT INTO `customers` VALUES (181, 313, 1, 'Khu phố Khánh Lộc Phường Tân Phước Khánh Thị Xã Tân Uyên BD', NULL, NULL, NULL, NULL, '2019-05-25 09:20:58', '2019-05-25 09:21:44');
INSERT INTO `customers` VALUES (182, 314, 1, 'hoa lộc _tam Bình _vinh long', 'Bùi Văn thuan', NULL, NULL, NULL, '2019-05-27 17:00:07', '2019-05-27 17:00:07');
INSERT INTO `customers` VALUES (183, 315, 1, 'Kho IHT 1610 Võ Văn Kiệt', 'Ông Lý', NULL, NULL, NULL, '2019-05-28 15:34:20', '2019-05-28 15:34:20');
INSERT INTO `customers` VALUES (184, 316, 2, 'thành phố mới, bình dương', 'cẩm nhung', 'IHT-KH20190601145', 129, NULL, '2019-06-01 08:19:33', '2019-06-01 08:19:33');
INSERT INTO `customers` VALUES (185, 317, 2, '32/1 đại lộ Hữu Nghị, Kcn VSIP 1', 'Lương', 'IHT-KH20190601146', 112, NULL, '2019-06-01 09:39:36', '2019-06-01 09:39:36');
INSERT INTO `customers` VALUES (186, 320, 1, 'Khánh Hòa vạn giã', '0798424862', NULL, NULL, NULL, '2019-06-04 22:46:23', '2019-06-04 22:46:23');
INSERT INTO `customers` VALUES (187, 321, 1, 'Căn 24-F2, KDC Huỳnh Gia Phát, ấp Bàu Bàng, xã Lai Uyên, huyện Bàu Bàng, tỉnh Bình Dương', 'Nga Phạm', NULL, NULL, NULL, '2019-06-05 16:40:58', '2019-06-05 16:40:58');
INSERT INTO `customers` VALUES (188, 322, 1, '204C, Sư Vạn Hạnh, Phường 9 Quận 5', 'Nhà xe Minh Tâm', NULL, NULL, NULL, '2019-06-05 17:20:16', '2019-06-05 17:20:16');
INSERT INTO `customers` VALUES (189, 323, 1, '20 Nguyễn Quyền P.11 Q.8', NULL, NULL, NULL, NULL, '2019-06-07 10:43:50', '2019-06-07 10:44:37');
INSERT INTO `customers` VALUES (190, 324, 2, 'Kp.Đồng An, p.Bình Hoà, Thuận An , Bình Dương', 'My', 'IHT-KH20190607150', 156, NULL, '2019-06-07 11:13:19', '2019-06-07 11:13:19');
INSERT INTO `customers` VALUES (191, 325, 2, 'D33 KDC VIETSING', 'công ty furine trading', 'IHT-KH20190608151', 157, NULL, '2019-06-08 08:45:29', '2019-06-08 08:45:29');
INSERT INTO `customers` VALUES (192, 326, 2, 'thị xã tân uyên, bình dương', 'Công ty Việt Nhất', 'IHT-KH20190608152', 158, NULL, '2019-06-08 09:26:17', '2019-06-08 09:26:17');
INSERT INTO `customers` VALUES (193, 327, 1, '241/33/30', NULL, NULL, NULL, NULL, '2019-06-08 18:04:38', '2019-06-08 18:05:00');
INSERT INTO `customers` VALUES (194, 330, 1, '212 đường 4, kcn Amta, biên hòa, đồng nai', NULL, NULL, NULL, NULL, '2019-06-11 13:41:09', '2019-06-11 13:41:40');
INSERT INTO `customers` VALUES (195, 331, 1, NULL, NULL, NULL, NULL, NULL, '2019-06-12 12:56:12', '2019-06-12 12:56:12');
INSERT INTO `customers` VALUES (197, 333, 2, 'Bình Dương', 'Chia', 'IHT-KH20190613156', 159, NULL, '2019-06-13 09:15:11', '2019-06-13 09:15:11');
INSERT INTO `customers` VALUES (198, 334, 1, 'Chung cư Hoàng Quân,  Bình Chánh', NULL, NULL, NULL, NULL, '2019-06-13 13:14:43', '2019-06-13 13:15:32');
INSERT INTO `customers` VALUES (199, 335, 1, '44/32 pham van hai, tan binh, tp hcm', NULL, NULL, NULL, NULL, '2019-06-13 17:44:03', '2019-06-13 17:44:45');
INSERT INTO `customers` VALUES (200, 338, 1, '221/9 đường vườn lài phường phú thọ hoà quận tân phú', NULL, NULL, NULL, NULL, '2019-06-17 16:49:54', '2019-06-17 16:50:25');

SET FOREIGN_KEY_CHECKS = 1;
