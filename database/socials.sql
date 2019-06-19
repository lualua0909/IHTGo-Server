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

 Date: 19/06/2019 13:24:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for socials
-- ----------------------------
DROP TABLE IF EXISTS `socials`;
CREATE TABLE `socials`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `provider_user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `socials_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `socials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of socials
-- ----------------------------
INSERT INTO `socials` VALUES (7, 22, '107306640829781645845', 'google', 'https://lh5.googleusercontent.com/-ZP0F_9O4p_E/AAAAAAAAAAI/AAAAAAAAAAA/ACevoQMk7dFA2sIicr5Z0qAyBoj0dah8lA/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (8, 23, '107643563753885218790', 'google', 'https://lh4.googleusercontent.com/-fIwkkdzbx1Q/AAAAAAAAAAI/AAAAAAAAAAA/ACevoQPI4GPwx_j0vXQjl4RwQWVrPIU0aw/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (9, 26, '552929498521358', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=552929498521358&height=200&width=200&ext=1551901168&hash=AeTxEu_pRapqL-2_');
INSERT INTO `socials` VALUES (10, NULL, '2331154593794588', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2331154593794588&height=200&width=200&ext=1552724323&hash=AeTSbLPaozYQ4F-B');
INSERT INTO `socials` VALUES (11, 132, '2575524945808236', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2575524945808236&height=200&width=200&ext=1554026816&hash=AeShBld-I_YAcRvw');
INSERT INTO `socials` VALUES (12, 136, '103925976778525579414', 'google', 'https://lh5.googleusercontent.com/-ehHC-pZUQmk/AAAAAAAAAAI/AAAAAAAAAAc/l9TueGfGw9g/s120/photo.jpg');
INSERT INTO `socials` VALUES (13, NULL, '116575423486022126501', 'google', 'https://lh4.googleusercontent.com/-ZW2YdVih-YM/AAAAAAAAAAI/AAAAAAAAACs/8BUGauM4VjM/s120/photo.jpg');
INSERT INTO `socials` VALUES (14, 143, '1234292870068218', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1234292870068218&height=200&width=200&ext=1554360393&hash=AeSVqEf4taO-vQDJ');
INSERT INTO `socials` VALUES (15, 144, '10210028449866299', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=10210028449866299&height=200&width=200&ext=1554362825&hash=AeSitPryVTAK4CB_');
INSERT INTO `socials` VALUES (24, 192, '113910868520838321983', 'google', 'https://lh5.googleusercontent.com/-ZKg5ZkY700s/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rftgpTVSxVUIAGSJdqaXtuHmHl_aA/s120/photo.jpg');
INSERT INTO `socials` VALUES (25, 194, '112641470830289350904', 'google', 'https://lh6.googleusercontent.com/-MGSvTuevHNE/AAAAAAAAAAI/AAAAAAAABAs/BAx1RlnsugY/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (26, 195, '112819369912056068436', 'google', 'https://lh3.googleusercontent.com/-95gtScXmlCc/AAAAAAAAAAI/AAAAAAAAAaI/IIlUG7d6C04/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (27, 202, '128264021640618', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=128264021640618&height=200&width=200&ext=1555943352&hash=AeTxEfTVa5qqF6Cx');
INSERT INTO `socials` VALUES (28, 205, '1218095805014163', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1218095805014163&height=200&width=200&ext=1556166790&hash=AeSzM3o1NzxGV4ZM');
INSERT INTO `socials` VALUES (29, 241, '113755077768748093151', 'google', 'https://lh5.googleusercontent.com/-pzhxsinN_vA/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf5Bovz-4FTV1fUSI3qEFNKu_Je8Q/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (30, 242, '106453199069445775488', 'google', 'https://lh4.googleusercontent.com/-0qz7EzfEy6o/AAAAAAAAAAI/AAAAAAAAIjw/k3870tKGCm4/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (31, 248, '113503570950400328994', 'google', 'https://lh5.googleusercontent.com/-mEFzoqFULKI/AAAAAAAAAAI/AAAAAAAAZGk/Eu9GBAi3qkQ/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (35, 255, '104561758190547667720', 'google', 'https://lh4.googleusercontent.com/-Ay__WeLLhiQ/AAAAAAAAAAI/AAAAAAAAH7Q/VmJnOTSFrUI/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (36, 256, '101194711805416473724', 'google', 'https://lh6.googleusercontent.com/-qnjkLEhdTks/AAAAAAAAAAI/AAAAAAAAADE/49F-5ZG-8cQ/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (37, 261, '107955425880030106869', 'google', 'https://lh3.googleusercontent.com/-r7UGTALnLDc/AAAAAAAAAAI/AAAAAAAABD8/HXYiqGm-G5g/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (38, 267, '279947039542434', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=279947039542434&height=200&width=200&ext=1558256959&hash=AeQRTufySJvZyn-7');
INSERT INTO `socials` VALUES (39, NULL, '1391977304269988', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1391977304269988&height=200&width=200&ext=1558508561&hash=AeQn_-6elQYEt1sc');
INSERT INTO `socials` VALUES (40, 273, '111004468541853643876', 'google', 'https://lh5.googleusercontent.com/-G_ym4iIZPMo/AAAAAAAAAAI/AAAAAAAABsA/wxRu3KMdr7A/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (41, 275, '108851938791877948780', 'google', 'https://lh4.googleusercontent.com/-w_nlnuuRwI0/AAAAAAAAAAI/AAAAAAAAE9Y/Nt3ZwD2VUZk/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (42, 286, '117786803771857443262', 'google', 'https://lh3.googleusercontent.com/-O-3432TMQYA/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reNF2g5WOi25uusPqe02tbwT-vx_w/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (43, 287, '112438226934750094423', 'google', 'https://lh3.googleusercontent.com/-LGL9jM43N88/AAAAAAAAAAI/AAAAAAAAABE/g1GvHTcN2V8/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (44, 289, '1852768414864667', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1852768414864667&height=200&width=200&ext=1560065899&hash=AeSg8o-Dg32r4P4L');
INSERT INTO `socials` VALUES (45, 298, '111301624117344298220', 'google', 'https://lh6.googleusercontent.com/-Y2_iGYBU0nU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcZbEZCVUgM42P83bJm-hgfuO955g/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (46, 301, '103427897134785845232', 'google', 'https://lh4.googleusercontent.com/-xHlAsamtri4/AAAAAAAAAAI/AAAAAAAAAkg/GnNYuyy83_A/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (47, 306, '112836606970805691108', 'google', 'https://lh3.googleusercontent.com/-jTKcBw8_DmM/AAAAAAAAAAI/AAAAAAAAAvU/dRl8OyFi650/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (48, 309, '1132792120226345', 'facebook', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1132792120226345&height=200&width=200&ext=1561180104&hash=AeQ0h-M09Ulaq60d');
INSERT INTO `socials` VALUES (49, NULL, '114906418740375749739', 'google', 'https://lh3.googleusercontent.com/--XqxoTqb_QM/AAAAAAAAAAI/AAAAAAAAACw/_XGQ_vnfNoA/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (50, 313, '100912313935980011520', 'google', 'https://lh5.googleusercontent.com/-zzgg2mLbhq4/AAAAAAAAAAI/AAAAAAAADOI/Qh0ZV48ft9I/s120/photo.jpg');
INSERT INTO `socials` VALUES (51, 323, '115272832875130617514', 'google', 'https://lh3.googleusercontent.com/-NHVao-yhnW4/AAAAAAAAAAI/AAAAAAAAEjk/ItO-co5BzKE/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (52, 327, '114946756911940753078', 'google', 'https://lh4.googleusercontent.com/-3b_iuvyZwx8/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rez5B0IAXHaDBGonO7KZ-H0bGuPsA/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (53, 330, '100108728416455209712', 'google', 'https://lh4.googleusercontent.com/-B1jeyVEW5QE/AAAAAAAAAAI/AAAAAAAAAHU/HDa97r9N8rk/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (54, 331, '106445687653323308929', 'google', 'https://lh3.googleusercontent.com/-pE05Mzq4yfM/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfgWobXG-Wy8XkTMuGjpOWvrUoHnQ/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (55, 334, '100601664237811840076', 'google', 'https://lh5.googleusercontent.com/-WJtGsY_M5yw/AAAAAAAAAAI/AAAAAAAAABg/gqD2iE84dBE/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (56, 335, '106273605556198018555', 'google', 'https://lh4.googleusercontent.com/-mEOmk3Gp2hE/AAAAAAAAAAI/AAAAAAAAADs/pRvn5yrLErY/s96-c/photo.jpg');
INSERT INTO `socials` VALUES (57, 338, '116741099569839280876', 'google', 'https://lh6.googleusercontent.com/-6jjjG-gCezc/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reeioW-u_1Cz6s9V6s_MfS-YSWqZw/s96-c/photo.jpg');

SET FOREIGN_KEY_CHECKS = 1;
