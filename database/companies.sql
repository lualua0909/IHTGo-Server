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

 Date: 19/06/2019 13:22:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tax` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `district_id` int(5) NULL DEFAULT NULL,
  `province_id` tinyint(1) NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 160 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES (1, 'VNG', '123456', '123456', 'aaa', NULL, NULL, 0, 1, '2019-01-22 11:08:47', '0000-00-00 00:00:00');
INSERT INTO `companies` VALUES (100, 'VNG', '123456', '123456', 'aaa', NULL, NULL, 0, 1, '2019-01-22 11:09:10', '0000-00-00 00:00:00');
INSERT INTO `companies` VALUES (101, 'Công ty TNHH DVTMVC IHT VIệt Nam', '+ 84-8-38380888', '0310212371', '8 bà triệu', 774, 79, 1, 1, '2019-01-25 15:59:03', '2019-01-25 08:59:03');
INSERT INTO `companies` VALUES (102, 'Công ty TNHH Sense Plus', '02866579090', '0312262787', '163 Trương Văn Bang,p.Thạnh Mỹ Lợi', 769, 79, 1, 1, '2019-02-13 01:37:41', '2019-02-13 01:37:41');
INSERT INTO `companies` VALUES (103, 'CTY POLYTEX FAR EASTERN-Quận 7', '1', '3702376432', 'Tầng 12, Tòa nhà Mapletree Business Center, 1060 Đại lộ Nguyễn Văn Linh, phường Tân Phong', 778, 79, 27, 1, '2019-02-13 08:57:30', '2019-02-13 01:57:30');
INSERT INTO `companies` VALUES (104, 'CÔNG TY VẠN ĐẠT', '02866844928', '1', '168/7/2 LÊ ĐÌNH CẨN, PHƯỜNG TÂN TẠO', 777, 79, 27, 1, '2019-02-13 03:34:14', '2019-02-13 03:34:14');
INSERT INTO `companies` VALUES (105, 'CÔNG TY TNHH QUỐC TẾ RISING TIME', '02854317002', '0313427304', 'Số 25 Đường số 24 KDC Him Lam 6A, ấp 4, Xã Bình Hưng', 785, 79, 27, 1, '2019-02-13 03:40:56', '2019-02-13 03:40:56');
INSERT INTO `companies` VALUES (106, 'Công ty TNHH YIN HWA', '02743783185', '3700474730', 'ĐƯỜNG SỐ 2A, KCN ĐỒNG AN , PHƯỜNG BÌNH HÒA,', 725, 74, 28, 1, '2019-02-14 12:01:27', '2019-02-14 12:01:27');
INSERT INTO `companies` VALUES (107, 'CÔNG TY CHAIN YARN VN', '0274 2221 871', '3702 424 80', 'Lô A7, KCN Bàu Bàng, Bình Dương', 719, 74, 39, 1, '2019-02-18 09:39:29', '2019-02-18 09:39:29');
INSERT INTO `companies` VALUES (108, 'Cty TNHH WINNING', '02743721060', '3700560281', 'Khu phố Bình Phú , Phường Bình Chuẩn', 725, 74, 28, 1, '2019-02-18 11:49:01', '2019-02-18 11:49:01');
INSERT INTO `companies` VALUES (109, 'Cty TNHH Công nghiệp TungShin', '0966412504', '3702364589', 'số 8  đường 18 , KCN Sóng Thần 2, phường Dĩ An', 724, 74, 28, 1, '2019-02-20 10:27:14', '2019-02-20 10:27:14');
INSERT INTO `companies` VALUES (110, 'CÔNG TY THỦ QUÂN', '0274 3585 277', 'X', 'ĐƯỜNG NA5, Mỹ Phước, Bến Cát, Bình Dương', 720, 74, 39, 1, '2019-02-21 08:36:59', '2019-02-21 08:36:59');
INSERT INTO `companies` VALUES (111, 'XNK HUGE BAMBOO', '0274 3567 277', '13', 'Đường D1-n7 Kcn Mỹ Phước Huyện Bến Cát, Bình Dương', 0, 74, 39, 1, '2019-03-05 09:32:38', '2019-03-05 09:32:38');
INSERT INTO `companies` VALUES (112, 'Cty IHT (Văn phòng IHT GO VSIP)', '0909843803', '0310212371*', '32/1 Đại lộ Hữu Nghị , KCN VSIP 1', 0, 74, 28, 1, '2019-02-21 09:07:41', '2019-02-21 09:07:41');
INSERT INTO `companies` VALUES (113, 'Công Ty Polytex Far Eastern (KHO DỆT NHUỘM, BÀU BÀNG, BÌNH DƯƠNG)', '0274 2221 888', '777', 'B4B CN và B 5B CN đường DC KCN Bàu Bàng - Huyện Bàu Bàng - Bình Dương', 719, 74, 39, 1, '2019-02-22 13:38:51', '2019-02-22 13:38:51');
INSERT INTO `companies` VALUES (114, 'Cty TNHH MTV Hữu Thiên Ngũ Kim', '0974662028', '0304991306', '76 KP.Bình Hòa 1, Tân Phước Khánh', 723, 74, 28, 1, '2019-02-21 09:27:40', '2019-02-21 09:27:40');
INSERT INTO `companies` VALUES (115, 'CÔNG TY CHEN TAI', '0274 3558 233', '4', 'Đường N8 Kcn Mỹ Phước Huyện Bến Cát, Bến Cát, Bình Dương', 721, 74, 39, 1, '2019-02-21 13:46:01', '2019-02-21 13:46:01');
INSERT INTO `companies` VALUES (116, 'Công ty Thu tiền mặt', '0902710570', '0310212371.1', 'Số 8 Bà Triệu  Phường 12', 774, 79, 27, 1, '2019-02-22 09:29:04', '2019-02-22 09:29:04');
INSERT INTO `companies` VALUES (117, 'Công Ty Polytex Far Eastern ( PHÒNG SALE 02, BÀU BÀNG , BÌNH DƯƠNG)', '0274 2221888', 'V222', 'Lô A7, KCN Bàu Bàng, Bình Dương', 0, 74, 39, 1, '2019-02-22 13:41:39', '2019-02-22 13:41:39');
INSERT INTO `companies` VALUES (118, 'CÔNG TY KURIM VN', '02743658248', '3702297029', 'ĐƯỜNG N1, KHU CÔNG NGHIỆP ĐẠI ĐĂNG', 718, 74, 29, 1, '2019-02-26 11:51:10', '2019-02-26 11:51:10');
INSERT INTO `companies` VALUES (119, 'CÔNG TY CHEUNG YUE', '0785355165', '11', 'Số 8 Bà Triệu', 774, 79, 27, 1, '2019-02-27 10:42:38', '2019-02-27 10:42:38');
INSERT INTO `companies` VALUES (120, 'CÔNG TY IHT VĂN PHÒNG MỸ PHƯỚC', '0908027485', '12', 'C04-05, Đường DA1-1, LCG Rubyland, KCN Mỹ Phước II, Bến Cát, Bình Dương', 721, 74, 39, 1, '2019-03-01 13:59:04', '2019-03-01 13:59:04');
INSERT INTO `companies` VALUES (121, 'CÔNG TY CÔNG NGHIỆP JIUCHENG VN', '0332869981', '177', 'đường số 1, Khu công nghiệp Việt Hương 2, Xã An Tây, Thị Xã Bến Cát, Bình Dương', 721, 74, 39, 1, '2019-03-01 14:19:06', '2019-03-01 14:19:06');
INSERT INTO `companies` VALUES (122, 'CTY Hoàng Gia Hưng', '02513.954542', '3602834939', '99 Bis ấp 2 , xã Tân Hạnh', 731, 75, 84, 1, '2019-03-02 14:53:48', '2019-03-02 14:53:48');
INSERT INTO `companies` VALUES (123, 'CÔNG TY GOOD STELL', '0937861055', '745', 'Lô F-2-CN, đường D15, khu công nghiệp Mỹ Phước, Phường Mỹ Phước,', 721, 74, 39, 1, '2019-03-04 10:51:42', '2019-03-04 10:51:42');
INSERT INTO `companies` VALUES (124, 'CÔNG TY TNHH CHEN TAI VN', '0274558233', '15', 'lô H-1A CN, Đường N8, KCN Mỹ Phước, , Thị Xã Bến Cát, Bình Dương', 721, 74, 39, 1, '2019-03-05 09:11:51', '2019-03-05 09:11:51');
INSERT INTO `companies` VALUES (125, 'CÔNG TY TNHH CÔNG NGHIỆP DỆT HUGE BAMBOO ( PHÒNG KINH DOANH LẦU 5)', '0366 320 948', 'CCC', 'Đường N7, KCN. Mỹ Phước I, TX. Bến Cát, Bình Dương', 721, 74, 39, 1, '2019-03-05 09:48:29', '2019-03-05 09:48:29');
INSERT INTO `companies` VALUES (126, 'Cty Hợp lực Vina', '0974297943', '3603301549', '4/8 Khu phố II, P.Tân Phú', 724, 74, 28, 1, '2019-03-06 10:29:29', '2019-03-06 10:29:29');
INSERT INTO `companies` VALUES (127, 'CTY TÂN VĨNH HÒA', '02743756355', '152', 'ấp An sơn, Bến Cát, Bình Dương', 721, 74, 39, 1, '2019-03-06 14:54:40', '2019-03-06 14:54:40');
INSERT INTO `companies` VALUES (128, 'CÔNG TY IHT GO', '0902926925', '123', 'Số 8 Bà Triệu  Phường 12', 0, 79, 27, 1, '2019-03-07 08:13:14', '2019-03-07 08:13:14');
INSERT INTO `companies` VALUES (129, 'CTY IHT GO (VĂN PHÒNG IHT GO BÌNH CHÁNH)', '0909886783', '0', '3A 64/3 ẤP 3,xã Phạm Văn Hai,huyện Bình Chánh', 785, 79, 106, 1, '2019-03-12 10:37:44', '2019-03-12 10:37:44');
INSERT INTO `companies` VALUES (130, 'CÔNG TY CHẾ NHỰA PHẨM LIÊN HÒA', '0933261568', '1101870354', 'Thửa đất số 518, ấp 5, Xã Đức Hòa Đông', 802, 80, 106, 1, '2019-03-12 14:36:54', '2019-03-12 14:36:54');
INSERT INTO `companies` VALUES (131, 'CTY TNHH ngũ kim Jia yuan', '02743868398', '3702674527', 'Lô A1-A7, Đường N2, KCN Đại Đăng, P.Phú Tân, TP Thủ Dầu Một, Bình Dương', 718, 74, 27, 1, '2019-03-18 09:16:16', '2019-03-18 09:16:16');
INSERT INTO `companies` VALUES (132, 'CÔNG TY TNHH KIM AN HƯNG', '0365959001', '3603595169', 'số nhà 23, đường 25 B , Tổ 16 , ấp xóm gốc, xã long an , huyện long thành , tỉnh Đông Nai', 740, 75, 27, 1, '2019-03-28 14:01:22', '2019-03-28 14:01:22');
INSERT INTO `companies` VALUES (133, 'CÔNG TY TNHH TÂN THỊNH BÌNH DƯƠNG', '02743899808', '3702593980', 'SỐ 11A, ĐƯỜNG NGUYỄN THÁI BÌNH, TỔ 3, KHU 9, PHƯỜNG PHÚ HÒA', 718, 74, 29, 1, '2019-03-29 11:03:17', '2019-03-29 11:03:17');
INSERT INTO `companies` VALUES (134, 'Cty TNHH KIM BẰNG', '0836207666', '0314232227', '793 QL13 , P.Hiệp Bình Phước', 762, 79, 28, 1, '2019-05-28 10:24:57', '2019-05-28 10:24:57');
INSERT INTO `companies` VALUES (135, 'CÔNG TY RTI VN', '0', '3702413451', 'Lô số 9-1 đường số 2A, Khu công nghiệp Quốc tế Protrade, Xã An Tây, Thị xã Bến Cát, Tỉnh Bình Dương  Read more: http://www.thongtincongty.com/company/115d16bcb-cong-ty-tnhh-rti-viet-nam/#ixzz5k06Sj9IS', 721, 74, 39, 1, '2019-04-03 10:48:11', '2019-04-03 10:48:11');
INSERT INTO `companies` VALUES (136, 'CÔNG TY TNHH SUN OCEAN VIỆT NAM', '0274 3581 865', '3700649839', 'Lô CN3, Khu công nghiệp Mai Trung, Xã An Tây, Thị xã Bến Cát, Tỉnh Bình Dương', 721, 74, 39, 1, '2019-04-08 14:56:12', '2019-04-08 14:56:12');
INSERT INTO `companies` VALUES (137, 'CÔNG TY TNHH THỰC NGHIỆM ACCT BÌNH DƯƠNG', '02743655916', '3702734029', 'THỬA ĐẤT SỐ 803, TỜ BẢN ĐỒ 28, KHU PHỐ TÂN BÌNH PHƯỜNG TÂN HIỆP', 723, 74, 29, 1, '2019-04-10 15:27:47', '2019-04-10 15:27:47');
INSERT INTO `companies` VALUES (138, 'CÔNG TY TNHH VẬT LIỆU MỚI ZHANCHEN (VIỆT NAM)', '00', '3702619124', 'Nhà xưởng 1, lô F6 (khu B3), đường D2 và D9, khu công nghiệp, Xã An Điền, Thị xã Bến Cát, Tỉnh Bình Dương', 721, 74, 39, 1, '2019-04-11 08:41:06', '2019-04-11 08:41:06');
INSERT INTO `companies` VALUES (139, 'CÔNG TY TNHH CHÍNH XÁC YOSHITA VN', '0773609269', '111', 'KCN MỸ PHƯỚC 2, BẾN CÁT, BÌNH DƯƠNG', 720, 74, 39, 1, '2019-04-12 08:42:23', '2019-04-12 08:42:23');
INSERT INTO `companies` VALUES (140, 'Cty Xin Shuang Li', '0962135731', '00', 'đường D23 KDC Việt Sing', 725, 74, 28, 1, '2019-04-12 16:00:11', '2019-04-12 16:00:11');
INSERT INTO `companies` VALUES (141, 'WOW trà sữa', '0932598270', '0314274516', '117 nguyễn trãi p.2', 774, 79, 150, 1, '2019-04-13 08:41:39', '2019-04-13 08:41:39');
INSERT INTO `companies` VALUES (142, 'CÔNG TY TNHH FOCUS SUCCESS', '0909121534', '0313427745', 'Tầng 9, Tòa nhà Viễn Đông, 14 Phan Tôn, Phường Đa Kao,', 760, 79, 150, 1, '2019-04-17 09:29:27', '2019-04-17 09:29:27');
INSERT INTO `companies` VALUES (143, 'CTY TNHH NGUYEN HUONG', '0902644897', '0310227184', '2/71 phan thức duyện  phường 4 tân bình', 766, 79, 27, 1, '2019-04-18 10:41:57', '2019-04-18 10:41:57');
INSERT INTO `companies` VALUES (144, 'Cty TNHH CRECIMIENTO INDUSTRIAL VN (C.R.M.T.O)', '0336790856', '1234566', 'Đường số 4 KCN Đồng An', 725, 74, 28, 1, '2019-04-19 15:06:22', '2019-04-19 15:06:22');
INSERT INTO `companies` VALUES (145, 'Cty TNHH CÔNG NGHIỆP LIANG CHI II (VN)', '0374951485', '3700338921', 'KP.Bình Phú, p.Bình Chuẩn', 725, 74, 28, 1, '2019-05-02 08:45:14', '2019-05-02 08:45:14');
INSERT INTO `companies` VALUES (146, 'Cty Tam Phong', '0916913066', '001', '66 Tạ Uyên , Phường 15', 0, 79, 28, 1, '2019-05-03 16:11:32', '2019-05-03 16:11:32');
INSERT INTO `companies` VALUES (147, 'CTY ĐẠI PHÁT', '06503790540', '3700341674', 'SỐ 32, ĐƯỜNG SỐ 6, KCN SÓNG THẦN 2, PHƯỜNG DĨ AN', 724, 74, 29, 1, '2019-05-13 15:34:04', '2019-05-13 15:34:04');
INSERT INTO `companies` VALUES (148, 'CTY YUO YI VN', '0983099124', '3600526600', 'LÔ V5 KCN HỐ NAI, TRẢNG BOM, ĐỒNG NAI', 737, 75, 27, 1, '2019-05-13 17:13:01', '2019-05-13 17:13:01');
INSERT INTO `companies` VALUES (149, 'CHI NHÁNH CÔNG TY TNHH CHANG HUA - BÌNH DƯƠNG', '02743650668', '3901106078-001', 'LÔ F14/15/16, ĐƯỜNG N4, KCN NAM TÂN UYÊN MỞ RỘNG, XÃ HỘI NGHĨA', 723, 74, 29, 1, '2019-05-14 13:00:39', '2019-05-14 13:00:39');
INSERT INTO `companies` VALUES (150, 'CTY DỆT HƯNG LONG', '02837198638', '0313856310', '160 TL15, Phường Thạnh Lộc', 761, 79, 28, 1, '2019-05-15 16:12:31', '2019-05-15 16:12:31');
INSERT INTO `companies` VALUES (151, 'Công ty TNHH Modern Sourcing Việt Nam', '0988651103', '0315623304', 'Tầng 6, 27b Nguyễn Đình Chiểu, Phường Đakao, Quận 1, Thành phố Hồ Chí Minh, Việt Nam', 770, 79, 27, 1, '2019-05-16 10:32:28', '2019-05-16 10:32:28');
INSERT INTO `companies` VALUES (152, 'IHT GO MỸ PHƯỚC', '0909650620', '789', 'MP', 721, 74, 39, 1, '2019-05-17 09:36:19', '2019-05-17 09:36:19');
INSERT INTO `companies` VALUES (153, 'Công Ty TNHH MTV May Công Nghiệp Ge Lan', '0354 453 427', '531', 'Lô số 10-3c, đường số 3A, KCN Quốc Tế Protrade xã An Tây, Bến Cát', 721, 74, 39, 1, '2019-05-18 10:49:29', '2019-05-18 10:49:29');
INSERT INTO `companies` VALUES (154, 'CÔNG TY TNHH BAIMUWU', '02862873301', '0313196745', '2 HOA PHƯỢNG, PHƯỜNG 02', 768, 79, 274, 1, '2019-05-18 11:23:49', '2019-05-18 11:23:49');
INSERT INTO `companies` VALUES (155, 'CÔNG TY TNHH JIU YANG VN', '7893', '753', 'ĐƯỜNG NA1, KCN MỸ PHƯỚC 2, Thị xã Bến Cát, Tỉnh Bình Dương', 0, 74, 39, 1, '2019-05-21 09:39:29', '2019-05-21 09:39:29');
INSERT INTO `companies` VALUES (156, 'CÔNG TY TNHH CÔNG NGHIỆP NHỰA QUỐC TẾ HER CHANG', '02743756206', '3700299038', 'KHU PHỐ ĐỒNG AN 1, PHƯỜNG BÌNH HÒA', 725, 74, 28, 1, '2019-06-07 10:29:28', '2019-06-07 10:29:28');
INSERT INTO `companies` VALUES (157, 'CÔNG TY TNHH XUẤT NHẬP KHẨU FURNITECH TRADING', '0888303877', '3702738682', 'DC 36 Ô 34-36, ĐƯỜNG D33,KDC VIỆT SING,P.AN PHÚ', 725, 74, 28, 1, '2019-06-08 08:40:25', '2019-06-08 08:40:25');
INSERT INTO `companies` VALUES (158, 'CÔNG TY CỔ PHẦN CÔNG NGHIỆP VIỆT NHẤT', '02839618398/28', '3700659499', 'ĐƯỜNG ĐT747B, TỔ 6, KHU PHỐ KHÁNH VÂN, PHƯỜNG KHÁNH BÌNH', 723, 74, 29, 1, '2019-06-08 09:20:57', '2019-06-08 09:20:57');
INSERT INTO `companies` VALUES (159, 'Công ty TNHH REGAL BRIDAL', '02742220971', '547', 'Số 12 VSIP II-A Đường số 11, KCN Việt nam-Singapore II-A', 0, 74, 39, 1, '2019-06-13 08:31:50', '2019-06-13 08:31:50');

SET FOREIGN_KEY_CHECKS = 1;
