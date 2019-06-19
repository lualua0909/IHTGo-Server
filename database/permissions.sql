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

 Date: 19/06/2019 13:23:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `group_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'Dashboard', 'Quản Trị', 'dashboard', 'dashboard', NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'Xem Quyền', 'Phân Quyền', 'view-permission', 'permission', NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'Tạo Quyền', 'Phân Quyền', 'create-permission', 'permission', NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'Sửa Quyền', 'Phân Quyền', 'edit-permission', 'permission', NULL, NULL);
INSERT INTO `permissions` VALUES (5, 'Xoá Quyền', 'Phân Quyền', 'delete-permission', 'permission', NULL, NULL);
INSERT INTO `permissions` VALUES (6, 'Xem Người Dùng', 'Người Dùng', 'view-user', 'user', NULL, NULL);
INSERT INTO `permissions` VALUES (7, 'Tạo Người Dùng', 'Người Dùng', 'create-user', 'user', NULL, NULL);
INSERT INTO `permissions` VALUES (8, 'Sửa Người Dùng', 'Người Dùng', 'edit-user', 'user', NULL, NULL);
INSERT INTO `permissions` VALUES (9, 'Xoá Người Dùng', 'Người Dùng', 'delete-user', 'user', NULL, NULL);
INSERT INTO `permissions` VALUES (10, 'Xem Xe', 'Xe', 'view-car', 'car', NULL, NULL);
INSERT INTO `permissions` VALUES (11, 'Tạo Xe', 'Xe', 'create-car', 'car', NULL, NULL);
INSERT INTO `permissions` VALUES (12, 'Sửa Xe', 'Xe', 'edit-car', 'car', NULL, NULL);
INSERT INTO `permissions` VALUES (13, 'Xoá Xe', 'Xe', 'delete-car', 'car', NULL, NULL);
INSERT INTO `permissions` VALUES (14, 'Xem Bảng Giá', 'Bảng Giá', 'view-price', 'price', NULL, NULL);
INSERT INTO `permissions` VALUES (15, 'Tạo Bảng Giá', 'Bảng Giá', 'create-price', 'price', NULL, NULL);
INSERT INTO `permissions` VALUES (16, 'Sửa Bảng Giá', 'Bảng Giá', 'edit-price', 'price', NULL, NULL);
INSERT INTO `permissions` VALUES (17, 'Xoá Bảng Giá', 'Bảng Giá', 'delete-price', 'price', NULL, NULL);
INSERT INTO `permissions` VALUES (18, 'Xem Nhà Kho', 'Nhà Kho', 'view-warehouse', 'warehouse', NULL, NULL);
INSERT INTO `permissions` VALUES (19, 'Tạo Nhà Kho', 'Nhà Kho', 'create-warehouse', 'warehouse', NULL, NULL);
INSERT INTO `permissions` VALUES (20, 'Sửa Nhà Kho', 'Nhà Kho', 'edit-warehouse', 'warehouse', NULL, NULL);
INSERT INTO `permissions` VALUES (21, 'Xoá Nhà Kho', 'Nhà Kho', 'delete-warehouse', 'warehouse', NULL, NULL);
INSERT INTO `permissions` VALUES (22, 'Xem Tài Xế', 'Tài Xế', 'view-driver', 'driver', NULL, NULL);
INSERT INTO `permissions` VALUES (23, 'Tạo Tài Xế', 'Tài Xế', 'create-driver', 'driver', NULL, NULL);
INSERT INTO `permissions` VALUES (24, 'Sửa Tài Xế', 'Tài Xế', 'edit-driver', 'driver', NULL, NULL);
INSERT INTO `permissions` VALUES (25, 'Xoá Tài Xế', 'Tài Xế', 'delete-driver', 'driver', NULL, NULL);
INSERT INTO `permissions` VALUES (26, 'Xem Loại Khác', 'Loại Khác', 'view-other', 'other', NULL, NULL);
INSERT INTO `permissions` VALUES (27, 'Tạo Loại Khác', 'Loại Khác', 'create-other', 'other', NULL, NULL);
INSERT INTO `permissions` VALUES (28, 'Sửa Loại Khác', 'Loại Khác', 'edit-other', 'other', NULL, NULL);
INSERT INTO `permissions` VALUES (29, 'Xoá Loại Khác', 'Loại Khác', 'delete-other', 'other', NULL, NULL);
INSERT INTO `permissions` VALUES (30, 'Giao Hàng', 'Giao Hàng', 'view-delivery', 'delivery', NULL, NULL);
INSERT INTO `permissions` VALUES (31, 'Tạo Giao Hàng', 'Giao Hàng', 'create-delivery', 'delivery', NULL, NULL);
INSERT INTO `permissions` VALUES (32, 'Sửa Giao Hàng', 'Giao Hàng', 'edit-delivery', 'delivery', NULL, NULL);
INSERT INTO `permissions` VALUES (33, 'Xoá Giao Hàng', 'Giao Hàng', 'delete-delivery', 'delivery', NULL, NULL);
INSERT INTO `permissions` VALUES (34, 'Xem Khách Hàng', 'Khách Hàng', 'view-customer', 'customer', NULL, NULL);
INSERT INTO `permissions` VALUES (35, 'Xem Công Nợ', 'Công Nợ', 'view-dept', 'dept', NULL, NULL);
INSERT INTO `permissions` VALUES (36, 'Export Công Nợ', 'Công Nợ', 'export-dept', 'dept', NULL, NULL);
INSERT INTO `permissions` VALUES (37, 'Xem Đánh Giá', 'Đánh Giá', 'view-evaluate', 'evaluate', NULL, NULL);
INSERT INTO `permissions` VALUES (38, 'Xem Đơn Hàng', 'Đơn Hàng', 'view-order', 'order', NULL, NULL);
INSERT INTO `permissions` VALUES (39, 'Tạo Đơn Hàng', 'Đơn Hàng', 'create-order', 'order', NULL, NULL);
INSERT INTO `permissions` VALUES (40, 'Sửa Đơn Hàng', 'Đơn Hàng', 'edit-order', 'order', NULL, NULL);
INSERT INTO `permissions` VALUES (41, 'Xoá Đơn Hàng', 'Đơn Hàng', 'delete-order', 'order', NULL, NULL);
INSERT INTO `permissions` VALUES (42, 'Bản Đồ', 'Bản Đồ', 'map', 'map', NULL, NULL);
INSERT INTO `permissions` VALUES (43, 'Thống Kê', 'Thống Kê', 'statistic', 'statistic', NULL, NULL);
INSERT INTO `permissions` VALUES (44, 'Xem Tài Chính', 'Tài Chính', 'view-finance', 'finance', NULL, NULL);
INSERT INTO `permissions` VALUES (45, 'Tạo Tài Chính', 'Tài Chính', 'create-finance', 'finance', NULL, NULL);
INSERT INTO `permissions` VALUES (46, 'Sửa Tài Chính', 'Tài Chính', 'edit-finance', 'finance', NULL, NULL);
INSERT INTO `permissions` VALUES (47, 'Xoá Tài Chính', 'Tài Chính', 'delete-finance', 'finance', NULL, NULL);
INSERT INTO `permissions` VALUES (48, 'Chat', 'Chat', 'view-chat', 'chat', NULL, NULL);
INSERT INTO `permissions` VALUES (49, 'Xem Log', 'Log', 'view-log', 'log', NULL, NULL);
INSERT INTO `permissions` VALUES (50, 'Xem Công Ty', 'Công Ty', 'view-company', 'company', NULL, NULL);
INSERT INTO `permissions` VALUES (51, 'Tạo Công Ty', 'Công Ty', 'create-company', 'company', NULL, NULL);
INSERT INTO `permissions` VALUES (52, 'Sửa Công Ty', 'Công Ty', 'edit-company', 'company', NULL, NULL);
INSERT INTO `permissions` VALUES (53, 'Xoá Công Ty', 'Công Ty', 'delete-company', 'company', NULL, NULL);
INSERT INTO `permissions` VALUES (54, 'Chi Tiết Đơn Hàng', 'Đơn Hàng', 'view-order-detail', 'order', NULL, NULL);
INSERT INTO `permissions` VALUES (55, 'Chi Tiết Công Ty', 'Công Ty', 'view-company-detail', 'company', NULL, NULL);
INSERT INTO `permissions` VALUES (56, 'Chi Tiết Khách Hàng', 'Khách Hàng', 'view-customer-detail', 'customer', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
