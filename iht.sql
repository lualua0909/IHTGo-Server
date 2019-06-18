-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 05, 2018 lúc 06:33 AM
-- Phiên bản máy phục vụ: 10.1.33-MariaDB
-- Phiên bản PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `iht`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `manufacturer` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_plate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `manufacturer`, `name`, `number`, `brand`, `weight`, `license_plate`, `owner_id`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Porro cumque', 'Gareth Nieves sss', '711', 'Ea laudantium', '1000', 'Ipsum aut ea n', 3, 1, NULL, '2018-06-27 21:20:31', '2018-09-30 21:51:05'),
(2, 1, 'Et voluptatem', 'Coby Hooper', '731', 'Officia est in', '1000', '20000', NULL, 2, NULL, '2018-07-12 07:44:02', '2018-07-14 22:51:36'),
(3, 1, 'Recusandae', 'Tara Guerra', '801', 'Fuga Voluptatum', 'Dolore', 'Nihil iusto dolorum modi iure et', 0, 2, NULL, '2018-07-14 21:56:07', '2018-07-14 21:56:07'),
(4, 1, 'Sit tempora', 'Petra Levy', '838', 'Velit repu', 'Cillum vel e', 'Et id u', 1, 1, NULL, '2018-07-14 22:27:56', '2018-07-15 05:29:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `user1_id`, `user2_id`, `room_id`, `created_at`, `updated_at`) VALUES
(6, 1, 40, 17309722, '2018-09-28 06:35:51', '2018-09-28 06:35:51'),
(7, 1, 39, 17311426, '2018-09-28 07:06:59', '2018-09-28 07:06:59'),
(10, 45, 39, 17311427, '2018-09-28 07:06:59', '2018-09-28 07:06:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_company` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `type`, `address`, `pic`, `phone_company`, `tax`, `code`, `tax_code`, `deleted_at`, `created_at`, `updated_at`) VALUES
(22, 39, 2, 'address', 'Thaile', '09632560961', NULL, NULL, '123443211', NULL, '2018-08-29 07:05:03', '2018-08-29 07:05:03'),
(23, 46, 1, 'address', 'Thaile', '09632560962', NULL, NULL, '123443211', NULL, '2018-09-28 19:46:39', '2018-09-28 19:46:39'),
(24, 47, 1, 'address', 'Thaile', '09632560962', NULL, NULL, '123443211', NULL, '2018-09-28 19:53:18', '2018-09-28 19:53:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `deliveries`
--

INSERT INTO `deliveries` (`id`, `order_id`, `user_id`, `driver_id`, `car_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1, '2018-09-30 21:51:14', '2018-09-30 21:51:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fcm` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_version` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `fcm`, `device_id`, `device_name`, `os`, `app_version`, `created_at`, `updated_at`) VALUES
(9, 12, 'faCdrYmJz3Q:APA91bH2L9BJlbagsHyXN7ITk_38dLsfZAA5FRS6yeu-sMtH0u0T02R6cw6hkmhWCxSxAwPhQel5nK6m2c6rtau1F-qM5WlUF-vq7-HGCCcGyR0xhtmn2NaZaB4F5hRV3NpiCnRR5-xu', '3', '3', 'Android', '0,1', '2018-08-25 02:27:22', '2018-08-25 02:27:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `province_id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`id`, `name`, `type`, `province_id`, `publish`) VALUES
('001', 'Quận Ba Đình', 'Quận', '01', 0),
('002', 'Quận Hoàn Kiếm', 'Quận', '01', 0),
('003', 'Quận Tây Hồ', 'Quận', '01', 0),
('004', 'Quận Long Biên', 'Quận', '01', 0),
('005', 'Quận Cầu Giấy', 'Quận', '01', 0),
('006', 'Quận Đống Đa', 'Quận', '01', 0),
('007', 'Quận Hai Bà Trưng', 'Quận', '01', 0),
('008', 'Quận Hoàng Mai', 'Quận', '01', 0),
('009', 'Quận Thanh Xuân', 'Quận', '01', 0),
('016', 'Huyện Sóc Sơn', 'Huyện', '01', 0),
('017', 'Huyện Đông Anh', 'Huyện', '01', 0),
('018', 'Huyện Gia Lâm', 'Huyện', '01', 0),
('019', 'Quận Nam Từ Liêm', 'Quận', '01', 0),
('020', 'Huyện Thanh Trì', 'Huyện', '01', 0),
('021', 'Quận Bắc Từ Liêm', 'Quận', '01', 0),
('024', 'Thành phố Hà Giang', 'Thành phố', '02', 0),
('026', 'Huyện Đồng Văn', 'Huyện', '02', 0),
('027', 'Huyện Mèo Vạc', 'Huyện', '02', 0),
('028', 'Huyện Yên Minh', 'Huyện', '02', 0),
('029', 'Huyện Quản Bạ', 'Huyện', '02', 0),
('030', 'Huyện Vị Xuyên', 'Huyện', '02', 0),
('031', 'Huyện Bắc Mê', 'Huyện', '02', 0),
('032', 'Huyện Hoàng Su Phì', 'Huyện', '02', 0),
('033', 'Huyện Xín Mần', 'Huyện', '02', 0),
('034', 'Huyện Bắc Quang', 'Huyện', '02', 0),
('035', 'Huyện Quang Bình', 'Huyện', '02', 0),
('040', 'Thành phố Cao Bằng', 'Thành phố', '04', 0),
('042', 'Huyện Bảo Lâm', 'Huyện', '04', 0),
('043', 'Huyện Bảo Lạc', 'Huyện', '04', 0),
('044', 'Huyện Thông Nông', 'Huyện', '04', 0),
('045', 'Huyện Hà Quảng', 'Huyện', '04', 0),
('046', 'Huyện Trà Lĩnh', 'Huyện', '04', 0),
('047', 'Huyện Trùng Khánh', 'Huyện', '04', 0),
('048', 'Huyện Hạ Lang', 'Huyện', '04', 0),
('049', 'Huyện Quảng Uyên', 'Huyện', '04', 0),
('050', 'Huyện Phục Hoà', 'Huyện', '04', 0),
('051', 'Huyện Hoà An', 'Huyện', '04', 0),
('052', 'Huyện Nguyên Bình', 'Huyện', '04', 0),
('053', 'Huyện Thạch An', 'Huyện', '04', 0),
('058', 'Thành Phố Bắc Kạn', 'Thành phố', '06', 0),
('060', 'Huyện Pác Nặm', 'Huyện', '06', 0),
('061', 'Huyện Ba Bể', 'Huyện', '06', 0),
('062', 'Huyện Ngân Sơn', 'Huyện', '06', 0),
('063', 'Huyện Bạch Thông', 'Huyện', '06', 0),
('064', 'Huyện Chợ Đồn', 'Huyện', '06', 0),
('065', 'Huyện Chợ Mới', 'Huyện', '06', 0),
('066', 'Huyện Na Rì', 'Huyện', '06', 0),
('070', 'Thành phố Tuyên Quang', 'Thành phố', '08', 0),
('071', 'Huyện Lâm Bình', 'Huyện', '08', 0),
('072', 'Huyện Nà Hang', 'Huyện', '08', 0),
('073', 'Huyện Chiêm Hóa', 'Huyện', '08', 0),
('074', 'Huyện Hàm Yên', 'Huyện', '08', 0),
('075', 'Huyện Yên Sơn', 'Huyện', '08', 0),
('076', 'Huyện Sơn Dương', 'Huyện', '08', 0),
('080', 'Thành phố Lào Cai', 'Thành phố', '10', 0),
('082', 'Huyện Bát Xát', 'Huyện', '10', 0),
('083', 'Huyện Mường Khương', 'Huyện', '10', 0),
('084', 'Huyện Si Ma Cai', 'Huyện', '10', 0),
('085', 'Huyện Bắc Hà', 'Huyện', '10', 0),
('086', 'Huyện Bảo Thắng', 'Huyện', '10', 0),
('087', 'Huyện Bảo Yên', 'Huyện', '10', 0),
('088', 'Huyện Sa Pa', 'Huyện', '10', 0),
('089', 'Huyện Văn Bàn', 'Huyện', '10', 0),
('094', 'Thành phố Điện Biên Phủ', 'Thành phố', '11', 0),
('095', 'Thị Xã Mường Lay', 'Thị xã', '11', 0),
('096', 'Huyện Mường Nhé', 'Huyện', '11', 0),
('097', 'Huyện Mường Chà', 'Huyện', '11', 0),
('098', 'Huyện Tủa Chùa', 'Huyện', '11', 0),
('099', 'Huyện Tuần Giáo', 'Huyện', '11', 0),
('100', 'Huyện Điện Biên', 'Huyện', '11', 0),
('101', 'Huyện Điện Biên Đông', 'Huyện', '11', 0),
('102', 'Huyện Mường Ảng', 'Huyện', '11', 0),
('103', 'Huyện Nậm Pồ', 'Huyện', '11', 0),
('105', 'Thành phố Lai Châu', 'Thành phố', '12', 0),
('106', 'Huyện Tam Đường', 'Huyện', '12', 0),
('107', 'Huyện Mường Tè', 'Huyện', '12', 0),
('108', 'Huyện Sìn Hồ', 'Huyện', '12', 0),
('109', 'Huyện Phong Thổ', 'Huyện', '12', 0),
('110', 'Huyện Than Uyên', 'Huyện', '12', 0),
('111', 'Huyện Tân Uyên', 'Huyện', '12', 0),
('112', 'Huyện Nậm Nhùn', 'Huyện', '12', 0),
('116', 'Thành phố Sơn La', 'Thành phố', '14', 0),
('118', 'Huyện Quỳnh Nhai', 'Huyện', '14', 0),
('119', 'Huyện Thuận Châu', 'Huyện', '14', 0),
('120', 'Huyện Mường La', 'Huyện', '14', 0),
('121', 'Huyện Bắc Yên', 'Huyện', '14', 0),
('122', 'Huyện Phù Yên', 'Huyện', '14', 0),
('123', 'Huyện Mộc Châu', 'Huyện', '14', 0),
('124', 'Huyện Yên Châu', 'Huyện', '14', 0),
('125', 'Huyện Mai Sơn', 'Huyện', '14', 0),
('126', 'Huyện Sông Mã', 'Huyện', '14', 0),
('127', 'Huyện Sốp Cộp', 'Huyện', '14', 0),
('128', 'Huyện Vân Hồ', 'Huyện', '14', 0),
('132', 'Thành phố Yên Bái', 'Thành phố', '15', 0),
('133', 'Thị xã Nghĩa Lộ', 'Thị xã', '15', 0),
('135', 'Huyện Lục Yên', 'Huyện', '15', 0),
('136', 'Huyện Văn Yên', 'Huyện', '15', 0),
('137', 'Huyện Mù Căng Chải', 'Huyện', '15', 0),
('138', 'Huyện Trấn Yên', 'Huyện', '15', 0),
('139', 'Huyện Trạm Tấu', 'Huyện', '15', 0),
('140', 'Huyện Văn Chấn', 'Huyện', '15', 0),
('141', 'Huyện Yên Bình', 'Huyện', '15', 0),
('148', 'Thành phố Hòa Bình', 'Thành phố', '17', 0),
('150', 'Huyện Đà Bắc', 'Huyện', '17', 0),
('151', 'Huyện Kỳ Sơn', 'Huyện', '17', 0),
('152', 'Huyện Lương Sơn', 'Huyện', '17', 0),
('153', 'Huyện Kim Bôi', 'Huyện', '17', 0),
('154', 'Huyện Cao Phong', 'Huyện', '17', 0),
('155', 'Huyện Tân Lạc', 'Huyện', '17', 0),
('156', 'Huyện Mai Châu', 'Huyện', '17', 0),
('157', 'Huyện Lạc Sơn', 'Huyện', '17', 0),
('158', 'Huyện Yên Thủy', 'Huyện', '17', 0),
('159', 'Huyện Lạc Thủy', 'Huyện', '17', 0),
('164', 'Thành phố Thái Nguyên', 'Thành phố', '19', 0),
('165', 'Thành phố Sông Công', 'Thành phố', '19', 0),
('167', 'Huyện Định Hóa', 'Huyện', '19', 0),
('168', 'Huyện Phú Lương', 'Huyện', '19', 0),
('169', 'Huyện Đồng Hỷ', 'Huyện', '19', 0),
('170', 'Huyện Võ Nhai', 'Huyện', '19', 0),
('171', 'Huyện Đại Từ', 'Huyện', '19', 0),
('172', 'Thị xã Phổ Yên', 'Thị xã', '19', 0),
('173', 'Huyện Phú Bình', 'Huyện', '19', 0),
('178', 'Thành phố Lạng Sơn', 'Thành phố', '20', 0),
('180', 'Huyện Tràng Định', 'Huyện', '20', 0),
('181', 'Huyện Bình Gia', 'Huyện', '20', 0),
('182', 'Huyện Văn Lãng', 'Huyện', '20', 0),
('183', 'Huyện Cao Lộc', 'Huyện', '20', 0),
('184', 'Huyện Văn Quan', 'Huyện', '20', 0),
('185', 'Huyện Bắc Sơn', 'Huyện', '20', 0),
('186', 'Huyện Hữu Lũng', 'Huyện', '20', 0),
('187', 'Huyện Chi Lăng', 'Huyện', '20', 0),
('188', 'Huyện Lộc Bình', 'Huyện', '20', 0),
('189', 'Huyện Đình Lập', 'Huyện', '20', 0),
('193', 'Thành phố Hạ Long', 'Thành phố', '22', 0),
('194', 'Thành phố Móng Cái', 'Thành phố', '22', 0),
('195', 'Thành phố Cẩm Phả', 'Thành phố', '22', 0),
('196', 'Thành phố Uông Bí', 'Thành phố', '22', 0),
('198', 'Huyện Bình Liêu', 'Huyện', '22', 0),
('199', 'Huyện Tiên Yên', 'Huyện', '22', 0),
('200', 'Huyện Đầm Hà', 'Huyện', '22', 0),
('201', 'Huyện Hải Hà', 'Huyện', '22', 0),
('202', 'Huyện Ba Chẽ', 'Huyện', '22', 0),
('203', 'Huyện Vân Đồn', 'Huyện', '22', 0),
('204', 'Huyện Hoành Bồ', 'Huyện', '22', 0),
('205', 'Thị xã Đông Triều', 'Thị xã', '22', 0),
('206', 'Thị xã Quảng Yên', 'Thị xã', '22', 0),
('207', 'Huyện Cô Tô', 'Huyện', '22', 0),
('213', 'Thành phố Bắc Giang', 'Thành phố', '24', 0),
('215', 'Huyện Yên Thế', 'Huyện', '24', 0),
('216', 'Huyện Tân Yên', 'Huyện', '24', 0),
('217', 'Huyện Lạng Giang', 'Huyện', '24', 0),
('218', 'Huyện Lục Nam', 'Huyện', '24', 0),
('219', 'Huyện Lục Ngạn', 'Huyện', '24', 0),
('220', 'Huyện Sơn Động', 'Huyện', '24', 0),
('221', 'Huyện Yên Dũng', 'Huyện', '24', 0),
('222', 'Huyện Việt Yên', 'Huyện', '24', 0),
('223', 'Huyện Hiệp Hòa', 'Huyện', '24', 0),
('227', 'Thành phố Việt Trì', 'Thành phố', '25', 0),
('228', 'Thị xã Phú Thọ', 'Thị xã', '25', 0),
('230', 'Huyện Đoan Hùng', 'Huyện', '25', 0),
('231', 'Huyện Hạ Hoà', 'Huyện', '25', 0),
('232', 'Huyện Thanh Ba', 'Huyện', '25', 0),
('233', 'Huyện Phù Ninh', 'Huyện', '25', 0),
('234', 'Huyện Yên Lập', 'Huyện', '25', 0),
('235', 'Huyện Cẩm Khê', 'Huyện', '25', 0),
('236', 'Huyện Tam Nông', 'Huyện', '25', 0),
('237', 'Huyện Lâm Thao', 'Huyện', '25', 0),
('238', 'Huyện Thanh Sơn', 'Huyện', '25', 0),
('239', 'Huyện Thanh Thuỷ', 'Huyện', '25', 0),
('240', 'Huyện Tân Sơn', 'Huyện', '25', 0),
('243', 'Thành phố Vĩnh Yên', 'Thành phố', '26', 0),
('244', 'Thị xã Phúc Yên', 'Thị xã', '26', 0),
('246', 'Huyện Lập Thạch', 'Huyện', '26', 0),
('247', 'Huyện Tam Dương', 'Huyện', '26', 0),
('248', 'Huyện Tam Đảo', 'Huyện', '26', 0),
('249', 'Huyện Bình Xuyên', 'Huyện', '26', 0),
('250', 'Huyện Mê Linh', 'Huyện', '01', 0),
('251', 'Huyện Yên Lạc', 'Huyện', '26', 0),
('252', 'Huyện Vĩnh Tường', 'Huyện', '26', 0),
('253', 'Huyện Sông Lô', 'Huyện', '26', 0),
('256', 'Thành phố Bắc Ninh', 'Thành phố', '27', 0),
('258', 'Huyện Yên Phong', 'Huyện', '27', 0),
('259', 'Huyện Quế Võ', 'Huyện', '27', 0),
('260', 'Huyện Tiên Du', 'Huyện', '27', 0),
('261', 'Thị xã Từ Sơn', 'Thị xã', '27', 0),
('262', 'Huyện Thuận Thành', 'Huyện', '27', 0),
('263', 'Huyện Gia Bình', 'Huyện', '27', 0),
('264', 'Huyện Lương Tài', 'Huyện', '27', 0),
('268', 'Quận Hà Đông', 'Quận', '01', 0),
('269', 'Thị xã Sơn Tây', 'Thị xã', '01', 0),
('271', 'Huyện Ba Vì', 'Huyện', '01', 0),
('272', 'Huyện Phúc Thọ', 'Huyện', '01', 0),
('273', 'Huyện Đan Phượng', 'Huyện', '01', 0),
('274', 'Huyện Hoài Đức', 'Huyện', '01', 0),
('275', 'Huyện Quốc Oai', 'Huyện', '01', 0),
('276', 'Huyện Thạch Thất', 'Huyện', '01', 0),
('277', 'Huyện Chương Mỹ', 'Huyện', '01', 0),
('278', 'Huyện Thanh Oai', 'Huyện', '01', 0),
('279', 'Huyện Thường Tín', 'Huyện', '01', 0),
('280', 'Huyện Phú Xuyên', 'Huyện', '01', 0),
('281', 'Huyện Ứng Hòa', 'Huyện', '01', 0),
('282', 'Huyện Mỹ Đức', 'Huyện', '01', 0),
('288', 'Thành phố Hải Dương', 'Thành phố', '30', 0),
('290', 'Thị xã Chí Linh', 'Thị xã', '30', 0),
('291', 'Huyện Nam Sách', 'Huyện', '30', 0),
('292', 'Huyện Kinh Môn', 'Huyện', '30', 0),
('293', 'Huyện Kim Thành', 'Huyện', '30', 0),
('294', 'Huyện Thanh Hà', 'Huyện', '30', 0),
('295', 'Huyện Cẩm Giàng', 'Huyện', '30', 0),
('296', 'Huyện Bình Giang', 'Huyện', '30', 0),
('297', 'Huyện Gia Lộc', 'Huyện', '30', 0),
('298', 'Huyện Tứ Kỳ', 'Huyện', '30', 0),
('299', 'Huyện Ninh Giang', 'Huyện', '30', 0),
('300', 'Huyện Thanh Miện', 'Huyện', '30', 0),
('303', 'Quận Hồng Bàng', 'Quận', '31', 0),
('304', 'Quận Ngô Quyền', 'Quận', '31', 0),
('305', 'Quận Lê Chân', 'Quận', '31', 0),
('306', 'Quận Hải An', 'Quận', '31', 0),
('307', 'Quận Kiến An', 'Quận', '31', 0),
('308', 'Quận Đồ Sơn', 'Quận', '31', 0),
('309', 'Quận Dương Kinh', 'Quận', '31', 0),
('311', 'Huyện Thuỷ Nguyên', 'Huyện', '31', 0),
('312', 'Huyện An Dương', 'Huyện', '31', 0),
('313', 'Huyện An Lão', 'Huyện', '31', 0),
('314', 'Huyện Kiến Thuỵ', 'Huyện', '31', 0),
('315', 'Huyện Tiên Lãng', 'Huyện', '31', 0),
('316', 'Huyện Vĩnh Bảo', 'Huyện', '31', 0),
('317', 'Huyện Cát Hải', 'Huyện', '31', 0),
('318', 'Huyện Bạch Long Vĩ', 'Huyện', '31', 0),
('323', 'Thành phố Hưng Yên', 'Thành phố', '33', 0),
('325', 'Huyện Văn Lâm', 'Huyện', '33', 0),
('326', 'Huyện Văn Giang', 'Huyện', '33', 0),
('327', 'Huyện Yên Mỹ', 'Huyện', '33', 0),
('328', 'Huyện Mỹ Hào', 'Huyện', '33', 0),
('329', 'Huyện Ân Thi', 'Huyện', '33', 0),
('330', 'Huyện Khoái Châu', 'Huyện', '33', 0),
('331', 'Huyện Kim Động', 'Huyện', '33', 0),
('332', 'Huyện Tiên Lữ', 'Huyện', '33', 0),
('333', 'Huyện Phù Cừ', 'Huyện', '33', 0),
('336', 'Thành phố Thái Bình', 'Thành phố', '34', 0),
('338', 'Huyện Quỳnh Phụ', 'Huyện', '34', 0),
('339', 'Huyện Hưng Hà', 'Huyện', '34', 0),
('340', 'Huyện Đông Hưng', 'Huyện', '34', 0),
('341', 'Huyện Thái Thụy', 'Huyện', '34', 0),
('342', 'Huyện Tiền Hải', 'Huyện', '34', 0),
('343', 'Huyện Kiến Xương', 'Huyện', '34', 0),
('344', 'Huyện Vũ Thư', 'Huyện', '34', 0),
('347', 'Thành phố Phủ Lý', 'Thành phố', '35', 0),
('349', 'Huyện Duy Tiên', 'Huyện', '35', 0),
('350', 'Huyện Kim Bảng', 'Huyện', '35', 0),
('351', 'Huyện Thanh Liêm', 'Huyện', '35', 0),
('352', 'Huyện Bình Lục', 'Huyện', '35', 0),
('353', 'Huyện Lý Nhân', 'Huyện', '35', 0),
('356', 'Thành phố Nam Định', 'Thành phố', '36', 0),
('358', 'Huyện Mỹ Lộc', 'Huyện', '36', 0),
('359', 'Huyện Vụ Bản', 'Huyện', '36', 0),
('360', 'Huyện Ý Yên', 'Huyện', '36', 0),
('361', 'Huyện Nghĩa Hưng', 'Huyện', '36', 0),
('362', 'Huyện Nam Trực', 'Huyện', '36', 0),
('363', 'Huyện Trực Ninh', 'Huyện', '36', 0),
('364', 'Huyện Xuân Trường', 'Huyện', '36', 0),
('365', 'Huyện Giao Thủy', 'Huyện', '36', 0),
('366', 'Huyện Hải Hậu', 'Huyện', '36', 0),
('369', 'Thành phố Ninh Bình', 'Thành phố', '37', 0),
('370', 'Thành phố Tam Điệp', 'Thành phố', '37', 0),
('372', 'Huyện Nho Quan', 'Huyện', '37', 0),
('373', 'Huyện Gia Viễn', 'Huyện', '37', 0),
('374', 'Huyện Hoa Lư', 'Huyện', '37', 0),
('375', 'Huyện Yên Khánh', 'Huyện', '37', 0),
('376', 'Huyện Kim Sơn', 'Huyện', '37', 0),
('377', 'Huyện Yên Mô', 'Huyện', '37', 0),
('380', 'Thành phố Thanh Hóa', 'Thành phố', '38', 0),
('381', 'Thị xã Bỉm Sơn', 'Thị xã', '38', 0),
('382', 'Thị xã Sầm Sơn', 'Thị xã', '38', 0),
('384', 'Huyện Mường Lát', 'Huyện', '38', 0),
('385', 'Huyện Quan Hóa', 'Huyện', '38', 0),
('386', 'Huyện Bá Thước', 'Huyện', '38', 0),
('387', 'Huyện Quan Sơn', 'Huyện', '38', 0),
('388', 'Huyện Lang Chánh', 'Huyện', '38', 0),
('389', 'Huyện Ngọc Lặc', 'Huyện', '38', 0),
('390', 'Huyện Cẩm Thủy', 'Huyện', '38', 0),
('391', 'Huyện Thạch Thành', 'Huyện', '38', 0),
('392', 'Huyện Hà Trung', 'Huyện', '38', 0),
('393', 'Huyện Vĩnh Lộc', 'Huyện', '38', 0),
('394', 'Huyện Yên Định', 'Huyện', '38', 0),
('395', 'Huyện Thọ Xuân', 'Huyện', '38', 0),
('396', 'Huyện Thường Xuân', 'Huyện', '38', 0),
('397', 'Huyện Triệu Sơn', 'Huyện', '38', 0),
('398', 'Huyện Thiệu Hóa', 'Huyện', '38', 0),
('399', 'Huyện Hoằng Hóa', 'Huyện', '38', 0),
('400', 'Huyện Hậu Lộc', 'Huyện', '38', 0),
('401', 'Huyện Nga Sơn', 'Huyện', '38', 0),
('402', 'Huyện Như Xuân', 'Huyện', '38', 0),
('403', 'Huyện Như Thanh', 'Huyện', '38', 0),
('404', 'Huyện Nông Cống', 'Huyện', '38', 0),
('405', 'Huyện Đông Sơn', 'Huyện', '38', 0),
('406', 'Huyện Quảng Xương', 'Huyện', '38', 0),
('407', 'Huyện Tĩnh Gia', 'Huyện', '38', 0),
('412', 'Thành phố Vinh', 'Thành phố', '40', 0),
('413', 'Thị xã Cửa Lò', 'Thị xã', '40', 0),
('414', 'Thị xã Thái Hoà', 'Thị xã', '40', 0),
('415', 'Huyện Quế Phong', 'Huyện', '40', 0),
('416', 'Huyện Quỳ Châu', 'Huyện', '40', 0),
('417', 'Huyện Kỳ Sơn', 'Huyện', '40', 0),
('418', 'Huyện Tương Dương', 'Huyện', '40', 0),
('419', 'Huyện Nghĩa Đàn', 'Huyện', '40', 0),
('420', 'Huyện Quỳ Hợp', 'Huyện', '40', 0),
('421', 'Huyện Quỳnh Lưu', 'Huyện', '40', 0),
('422', 'Huyện Con Cuông', 'Huyện', '40', 0),
('423', 'Huyện Tân Kỳ', 'Huyện', '40', 0),
('424', 'Huyện Anh Sơn', 'Huyện', '40', 0),
('425', 'Huyện Diễn Châu', 'Huyện', '40', 0),
('426', 'Huyện Yên Thành', 'Huyện', '40', 0),
('427', 'Huyện Đô Lương', 'Huyện', '40', 0),
('428', 'Huyện Thanh Chương', 'Huyện', '40', 0),
('429', 'Huyện Nghi Lộc', 'Huyện', '40', 0),
('430', 'Huyện Nam Đàn', 'Huyện', '40', 0),
('431', 'Huyện Hưng Nguyên', 'Huyện', '40', 0),
('432', 'Thị xã Hoàng Mai', 'Thị xã', '40', 0),
('436', 'Thành phố Hà Tĩnh', 'Thành phố', '42', 0),
('437', 'Thị xã Hồng Lĩnh', 'Thị xã', '42', 0),
('439', 'Huyện Hương Sơn', 'Huyện', '42', 0),
('440', 'Huyện Đức Thọ', 'Huyện', '42', 0),
('441', 'Huyện Vũ Quang', 'Huyện', '42', 0),
('442', 'Huyện Nghi Xuân', 'Huyện', '42', 0),
('443', 'Huyện Can Lộc', 'Huyện', '42', 0),
('444', 'Huyện Hương Khê', 'Huyện', '42', 0),
('445', 'Huyện Thạch Hà', 'Huyện', '42', 0),
('446', 'Huyện Cẩm Xuyên', 'Huyện', '42', 0),
('447', 'Huyện Kỳ Anh', 'Huyện', '42', 0),
('448', 'Huyện Lộc Hà', 'Huyện', '42', 0),
('449', 'Thị xã Kỳ Anh', 'Thị xã', '42', 0),
('450', 'Thành Phố Đồng Hới', 'Thành phố', '44', 0),
('452', 'Huyện Minh Hóa', 'Huyện', '44', 0),
('453', 'Huyện Tuyên Hóa', 'Huyện', '44', 0),
('454', 'Huyện Quảng Trạch', 'Thị xã', '44', 0),
('455', 'Huyện Bố Trạch', 'Huyện', '44', 0),
('456', 'Huyện Quảng Ninh', 'Huyện', '44', 0),
('457', 'Huyện Lệ Thủy', 'Huyện', '44', 0),
('458', 'Thị xã Ba Đồn', 'Huyện', '44', 0),
('461', 'Thành phố Đông Hà', 'Thành phố', '45', 0),
('462', 'Thị xã Quảng Trị', 'Thị xã', '45', 0),
('464', 'Huyện Vĩnh Linh', 'Huyện', '45', 0),
('465', 'Huyện Hướng Hóa', 'Huyện', '45', 0),
('466', 'Huyện Gio Linh', 'Huyện', '45', 0),
('467', 'Huyện Đa Krông', 'Huyện', '45', 0),
('468', 'Huyện Cam Lộ', 'Huyện', '45', 0),
('469', 'Huyện Triệu Phong', 'Huyện', '45', 0),
('470', 'Huyện Hải Lăng', 'Huyện', '45', 0),
('471', 'Huyện Cồn Cỏ', 'Huyện', '45', 0),
('474', 'Thành phố Huế', 'Thành phố', '46', 0),
('476', 'Huyện Phong Điền', 'Huyện', '46', 0),
('477', 'Huyện Quảng Điền', 'Huyện', '46', 0),
('478', 'Huyện Phú Vang', 'Huyện', '46', 0),
('479', 'Thị xã Hương Thủy', 'Thị xã', '46', 0),
('480', 'Thị xã Hương Trà', 'Thị xã', '46', 0),
('481', 'Huyện A Lưới', 'Huyện', '46', 0),
('482', 'Huyện Phú Lộc', 'Huyện', '46', 0),
('483', 'Huyện Nam Đông', 'Huyện', '46', 0),
('490', 'Quận Liên Chiểu', 'Quận', '48', 0),
('491', 'Quận Thanh Khê', 'Quận', '48', 0),
('492', 'Quận Hải Châu', 'Quận', '48', 0),
('493', 'Quận Sơn Trà', 'Quận', '48', 0),
('494', 'Quận Ngũ Hành Sơn', 'Quận', '48', 0),
('495', 'Quận Cẩm Lệ', 'Quận', '48', 0),
('497', 'Huyện Hòa Vang', 'Huyện', '48', 0),
('498', 'Huyện Hoàng Sa', 'Huyện', '48', 0),
('502', 'Thành phố Tam Kỳ', 'Thành phố', '49', 0),
('503', 'Thành phố Hội An', 'Thành phố', '49', 0),
('504', 'Huyện Tây Giang', 'Huyện', '49', 0),
('505', 'Huyện Đông Giang', 'Huyện', '49', 0),
('506', 'Huyện Đại Lộc', 'Huyện', '49', 0),
('507', 'Thị xã Điện Bàn', 'Thị xã', '49', 0),
('508', 'Huyện Duy Xuyên', 'Huyện', '49', 0),
('509', 'Huyện Quế Sơn', 'Huyện', '49', 0),
('510', 'Huyện Nam Giang', 'Huyện', '49', 0),
('511', 'Huyện Phước Sơn', 'Huyện', '49', 0),
('512', 'Huyện Hiệp Đức', 'Huyện', '49', 0),
('513', 'Huyện Thăng Bình', 'Huyện', '49', 0),
('514', 'Huyện Tiên Phước', 'Huyện', '49', 0),
('515', 'Huyện Bắc Trà My', 'Huyện', '49', 0),
('516', 'Huyện Nam Trà My', 'Huyện', '49', 0),
('517', 'Huyện Núi Thành', 'Huyện', '49', 0),
('518', 'Huyện Phú Ninh', 'Huyện', '49', 0),
('519', 'Huyện Nông Sơn', 'Huyện', '49', 0),
('522', 'Thành phố Quảng Ngãi', 'Thành phố', '51', 0),
('524', 'Huyện Bình Sơn', 'Huyện', '51', 0),
('525', 'Huyện Trà Bồng', 'Huyện', '51', 0),
('526', 'Huyện Tây Trà', 'Huyện', '51', 0),
('527', 'Huyện Sơn Tịnh', 'Huyện', '51', 0),
('528', 'Huyện Tư Nghĩa', 'Huyện', '51', 0),
('529', 'Huyện Sơn Hà', 'Huyện', '51', 0),
('530', 'Huyện Sơn Tây', 'Huyện', '51', 0),
('531', 'Huyện Minh Long', 'Huyện', '51', 0),
('532', 'Huyện Nghĩa Hành', 'Huyện', '51', 0),
('533', 'Huyện Mộ Đức', 'Huyện', '51', 0),
('534', 'Huyện Đức Phổ', 'Huyện', '51', 0),
('535', 'Huyện Ba Tơ', 'Huyện', '51', 0),
('536', 'Huyện Lý Sơn', 'Huyện', '51', 0),
('540', 'Thành phố Qui Nhơn', 'Thành phố', '52', 0),
('542', 'Huyện An Lão', 'Huyện', '52', 0),
('543', 'Huyện Hoài Nhơn', 'Huyện', '52', 0),
('544', 'Huyện Hoài Ân', 'Huyện', '52', 0),
('545', 'Huyện Phù Mỹ', 'Huyện', '52', 0),
('546', 'Huyện Vĩnh Thạnh', 'Huyện', '52', 0),
('547', 'Huyện Tây Sơn', 'Huyện', '52', 0),
('548', 'Huyện Phù Cát', 'Huyện', '52', 0),
('549', 'Thị xã An Nhơn', 'Thị xã', '52', 0),
('550', 'Huyện Tuy Phước', 'Huyện', '52', 0),
('551', 'Huyện Vân Canh', 'Huyện', '52', 0),
('555', 'Thành phố Tuy Hoà', 'Thành phố', '54', 0),
('557', 'Thị xã Sông Cầu', 'Thị xã', '54', 0),
('558', 'Huyện Đồng Xuân', 'Huyện', '54', 0),
('559', 'Huyện Tuy An', 'Huyện', '54', 0),
('560', 'Huyện Sơn Hòa', 'Huyện', '54', 0),
('561', 'Huyện Sông Hinh', 'Huyện', '54', 0),
('562', 'Huyện Tây Hoà', 'Huyện', '54', 0),
('563', 'Huyện Phú Hoà', 'Huyện', '54', 0),
('564', 'Huyện Đông Hòa', 'Huyện', '54', 0),
('568', 'Thành phố Nha Trang', 'Thành phố', '56', 0),
('569', 'Thành phố Cam Ranh', 'Thành phố', '56', 0),
('570', 'Huyện Cam Lâm', 'Huyện', '56', 0),
('571', 'Huyện Vạn Ninh', 'Huyện', '56', 0),
('572', 'Thị xã Ninh Hòa', 'Thị xã', '56', 0),
('573', 'Huyện Khánh Vĩnh', 'Huyện', '56', 0),
('574', 'Huyện Diên Khánh', 'Huyện', '56', 0),
('575', 'Huyện Khánh Sơn', 'Huyện', '56', 0),
('576', 'Huyện Trường Sa', 'Huyện', '56', 0),
('582', 'Thành phố Phan Rang-Tháp Chàm', 'Thành phố', '58', 0),
('584', 'Huyện Bác Ái', 'Huyện', '58', 0),
('585', 'Huyện Ninh Sơn', 'Huyện', '58', 0),
('586', 'Huyện Ninh Hải', 'Huyện', '58', 0),
('587', 'Huyện Ninh Phước', 'Huyện', '58', 0),
('588', 'Huyện Thuận Bắc', 'Huyện', '58', 0),
('589', 'Huyện Thuận Nam', 'Huyện', '58', 0),
('593', 'Thành phố Phan Thiết', 'Thành phố', '60', 0),
('594', 'Thị xã La Gi', 'Thị xã', '60', 0),
('595', 'Huyện Tuy Phong', 'Huyện', '60', 0),
('596', 'Huyện Bắc Bình', 'Huyện', '60', 0),
('597', 'Huyện Hàm Thuận Bắc', 'Huyện', '60', 0),
('598', 'Huyện Hàm Thuận Nam', 'Huyện', '60', 0),
('599', 'Huyện Tánh Linh', 'Huyện', '60', 0),
('600', 'Huyện Đức Linh', 'Huyện', '60', 0),
('601', 'Huyện Hàm Tân', 'Huyện', '60', 0),
('602', 'Huyện Phú Quí', 'Huyện', '60', 0),
('608', 'Thành phố Kon Tum', 'Thành phố', '62', 0),
('610', 'Huyện Đắk Glei', 'Huyện', '62', 0),
('611', 'Huyện Ngọc Hồi', 'Huyện', '62', 0),
('612', 'Huyện Đắk Tô', 'Huyện', '62', 0),
('613', 'Huyện Kon Plông', 'Huyện', '62', 0),
('614', 'Huyện Kon Rẫy', 'Huyện', '62', 0),
('615', 'Huyện Đắk Hà', 'Huyện', '62', 0),
('616', 'Huyện Sa Thầy', 'Huyện', '62', 0),
('617', 'Huyện Tu Mơ Rông', 'Huyện', '62', 0),
('618', 'Huyện Ia H\' Drai', 'Huyện', '62', 0),
('622', 'Thành phố Pleiku', 'Thành phố', '64', 0),
('623', 'Thị xã An Khê', 'Thị xã', '64', 0),
('624', 'Thị xã Ayun Pa', 'Thị xã', '64', 0),
('625', 'Huyện KBang', 'Huyện', '64', 0),
('626', 'Huyện Đăk Đoa', 'Huyện', '64', 0),
('627', 'Huyện Chư Păh', 'Huyện', '64', 0),
('628', 'Huyện Ia Grai', 'Huyện', '64', 0),
('629', 'Huyện Mang Yang', 'Huyện', '64', 0),
('630', 'Huyện Kông Chro', 'Huyện', '64', 0),
('631', 'Huyện Đức Cơ', 'Huyện', '64', 0),
('632', 'Huyện Chư Prông', 'Huyện', '64', 0),
('633', 'Huyện Chư Sê', 'Huyện', '64', 0),
('634', 'Huyện Đăk Pơ', 'Huyện', '64', 0),
('635', 'Huyện Ia Pa', 'Huyện', '64', 0),
('637', 'Huyện Krông Pa', 'Huyện', '64', 0),
('638', 'Huyện Phú Thiện', 'Huyện', '64', 0),
('639', 'Huyện Chư Pưh', 'Huyện', '64', 0),
('643', 'Thành phố Buôn Ma Thuột', 'Thành phố', '66', 0),
('644', 'Thị Xã Buôn Hồ', 'Thị xã', '66', 0),
('645', 'Huyện Ea H\'leo', 'Huyện', '66', 0),
('646', 'Huyện Ea Súp', 'Huyện', '66', 0),
('647', 'Huyện Buôn Đôn', 'Huyện', '66', 0),
('648', 'Huyện Cư M\'gar', 'Huyện', '66', 0),
('649', 'Huyện Krông Búk', 'Huyện', '66', 0),
('650', 'Huyện Krông Năng', 'Huyện', '66', 0),
('651', 'Huyện Ea Kar', 'Huyện', '66', 0),
('652', 'Huyện M\'Đrắk', 'Huyện', '66', 0),
('653', 'Huyện Krông Bông', 'Huyện', '66', 0),
('654', 'Huyện Krông Pắc', 'Huyện', '66', 0),
('655', 'Huyện Krông A Na', 'Huyện', '66', 0),
('656', 'Huyện Lắk', 'Huyện', '66', 0),
('657', 'Huyện Cư Kuin', 'Huyện', '66', 0),
('660', 'Thị xã Gia Nghĩa', 'Thị xã', '67', 0),
('661', 'Huyện Đăk Glong', 'Huyện', '67', 0),
('662', 'Huyện Cư Jút', 'Huyện', '67', 0),
('663', 'Huyện Đắk Mil', 'Huyện', '67', 0),
('664', 'Huyện Krông Nô', 'Huyện', '67', 0),
('665', 'Huyện Đắk Song', 'Huyện', '67', 0),
('666', 'Huyện Đắk R\'Lấp', 'Huyện', '67', 0),
('667', 'Huyện Tuy Đức', 'Huyện', '67', 0),
('672', 'Thành phố Đà Lạt', 'Thành phố', '68', 0),
('673', 'Thành phố Bảo Lộc', 'Thành phố', '68', 0),
('674', 'Huyện Đam Rông', 'Huyện', '68', 0),
('675', 'Huyện Lạc Dương', 'Huyện', '68', 0),
('676', 'Huyện Lâm Hà', 'Huyện', '68', 0),
('677', 'Huyện Đơn Dương', 'Huyện', '68', 0),
('678', 'Huyện Đức Trọng', 'Huyện', '68', 0),
('679', 'Huyện Di Linh', 'Huyện', '68', 0),
('680', 'Huyện Bảo Lâm', 'Huyện', '68', 0),
('681', 'Huyện Đạ Huoai', 'Huyện', '68', 0),
('682', 'Huyện Đạ Tẻh', 'Huyện', '68', 0),
('683', 'Huyện Cát Tiên', 'Huyện', '68', 0),
('688', 'Thị xã Phước Long', 'Thị xã', '70', 0),
('689', 'Thị xã Đồng Xoài', 'Thị xã', '70', 0),
('690', 'Thị xã Bình Long', 'Thị xã', '70', 0),
('691', 'Huyện Bù Gia Mập', 'Huyện', '70', 0),
('692', 'Huyện Lộc Ninh', 'Huyện', '70', 0),
('693', 'Huyện Bù Đốp', 'Huyện', '70', 0),
('694', 'Huyện Hớn Quản', 'Huyện', '70', 0),
('695', 'Huyện Đồng Phú', 'Huyện', '70', 0),
('696', 'Huyện Bù Đăng', 'Huyện', '70', 0),
('697', 'Huyện Chơn Thành', 'Huyện', '70', 0),
('698', 'Huyện Phú Riềng', 'Huyện', '70', 0),
('703', 'Thành phố Tây Ninh', 'Thành phố', '72', 0),
('705', 'Huyện Tân Biên', 'Huyện', '72', 0),
('706', 'Huyện Tân Châu', 'Huyện', '72', 0),
('707', 'Huyện Dương Minh Châu', 'Huyện', '72', 0),
('708', 'Huyện Châu Thành', 'Huyện', '72', 0),
('709', 'Huyện Hòa Thành', 'Huyện', '72', 0),
('710', 'Huyện Gò Dầu', 'Huyện', '72', 0),
('711', 'Huyện Bến Cầu', 'Huyện', '72', 0),
('712', 'Huyện Trảng Bàng', 'Huyện', '72', 0),
('718', 'Thành phố Thủ Dầu Một', 'Thành phố', '74', 1),
('719', 'Huyện Bàu Bàng', 'Huyện', '74', 1),
('720', 'Huyện Dầu Tiếng', 'Huyện', '74', 0),
('721', 'Thị xã Bến Cát', 'Thị xã', '74', 1),
('722', 'Huyện Phú Giáo', 'Huyện', '74', 0),
('723', 'Thị xã Tân Uyên', 'Thị xã', '74', 1),
('724', 'Thị xã Dĩ An', 'Thị xã', '74', 1),
('725', 'Thị xã Thuận An', 'Thị xã', '74', 1),
('726', 'Huyện Bắc Tân Uyên', 'Huyện', '74', 0),
('731', 'Thành phố Biên Hòa', 'Thành phố', '75', 0),
('732', 'Thị xã Long Khánh', 'Thị xã', '75', 0),
('734', 'Huyện Tân Phú', 'Huyện', '75', 0),
('735', 'Huyện Vĩnh Cửu', 'Huyện', '75', 0),
('736', 'Huyện Định Quán', 'Huyện', '75', 0),
('737', 'Huyện Trảng Bom', 'Huyện', '75', 0),
('738', 'Huyện Thống Nhất', 'Huyện', '75', 0),
('739', 'Huyện Cẩm Mỹ', 'Huyện', '75', 0),
('740', 'Huyện Long Thành', 'Huyện', '75', 0),
('741', 'Huyện Xuân Lộc', 'Huyện', '75', 0),
('742', 'Huyện Nhơn Trạch', 'Huyện', '75', 0),
('747', 'Thành phố Vũng Tàu', 'Thành phố', '77', 0),
('748', 'Thành phố Bà Rịa', 'Thành phố', '77', 0),
('750', 'Huyện Châu Đức', 'Huyện', '77', 0),
('751', 'Huyện Xuyên Mộc', 'Huyện', '77', 0),
('752', 'Huyện Long Điền', 'Huyện', '77', 0),
('753', 'Huyện Đất Đỏ', 'Huyện', '77', 0),
('754', 'Huyện Tân Thành', 'Huyện', '77', 0),
('755', 'Huyện Côn Đảo', 'Huyện', '77', 0),
('760', 'Quận 1', 'Quận', '79', 1),
('761', 'Quận 12', 'Quận', '79', 1),
('762', 'Quận Thủ Đức', 'Quận', '79', 1),
('763', 'Quận 9', 'Quận', '79', 1),
('764', 'Quận Gò Vấp', 'Quận', '79', 1),
('765', 'Quận Bình Thạnh', 'Quận', '79', 1),
('766', 'Quận Tân Bình', 'Quận', '79', 1),
('767', 'Quận Tân Phú', 'Quận', '79', 1),
('768', 'Quận Phú Nhuận', 'Quận', '79', 1),
('769', 'Quận 2', 'Quận', '79', 1),
('770', 'Quận 3', 'Quận', '79', 1),
('771', 'Quận 10', 'Quận', '79', 1),
('772', 'Quận 11', 'Quận', '79', 1),
('773', 'Quận 4', 'Quận', '79', 1),
('774', 'Quận 5', 'Quận', '79', 1),
('775', 'Quận 6', 'Quận', '79', 1),
('776', 'Quận 8', 'Quận', '79', 1),
('777', 'Quận Bình Tân', 'Quận', '79', 1),
('778', 'Quận 7', 'Quận', '79', 1),
('783', 'Huyện Củ Chi', 'Huyện', '79', 1),
('784', 'Huyện Hóc Môn', 'Huyện', '79', 1),
('785', 'Huyện Bình Chánh', 'Huyện', '79', 1),
('786', 'Huyện Nhà Bè', 'Huyện', '79', 1),
('787', 'Huyện Cần Giờ', 'Huyện', '79', 1),
('794', 'Thành phố Tân An', 'Thành phố', '80', 0),
('795', 'Thị xã Kiến Tường', 'Thị xã', '80', 0),
('796', 'Huyện Tân Hưng', 'Huyện', '80', 0),
('797', 'Huyện Vĩnh Hưng', 'Huyện', '80', 0),
('798', 'Huyện Mộc Hóa', 'Huyện', '80', 0),
('799', 'Huyện Tân Thạnh', 'Huyện', '80', 0),
('800', 'Huyện Thạnh Hóa', 'Huyện', '80', 0),
('801', 'Huyện Đức Huệ', 'Huyện', '80', 0),
('802', 'Huyện Đức Hòa', 'Huyện', '80', 0),
('803', 'Huyện Bến Lức', 'Huyện', '80', 0),
('804', 'Huyện Thủ Thừa', 'Huyện', '80', 0),
('805', 'Huyện Tân Trụ', 'Huyện', '80', 0),
('806', 'Huyện Cần Đước', 'Huyện', '80', 0),
('807', 'Huyện Cần Giuộc', 'Huyện', '80', 0),
('808', 'Huyện Châu Thành', 'Huyện', '80', 0),
('815', 'Thành phố Mỹ Tho', 'Thành phố', '82', 0),
('816', 'Thị xã Gò Công', 'Thị xã', '82', 0),
('817', 'Thị xã Cai Lậy', 'Huyện', '82', 0),
('818', 'Huyện Tân Phước', 'Huyện', '82', 0),
('819', 'Huyện Cái Bè', 'Huyện', '82', 0),
('820', 'Huyện Cai Lậy', 'Thị xã', '82', 0),
('821', 'Huyện Châu Thành', 'Huyện', '82', 0),
('822', 'Huyện Chợ Gạo', 'Huyện', '82', 0),
('823', 'Huyện Gò Công Tây', 'Huyện', '82', 0),
('824', 'Huyện Gò Công Đông', 'Huyện', '82', 0),
('825', 'Huyện Tân Phú Đông', 'Huyện', '82', 0),
('829', 'Thành phố Bến Tre', 'Thành phố', '83', 0),
('831', 'Huyện Châu Thành', 'Huyện', '83', 0),
('832', 'Huyện Chợ Lách', 'Huyện', '83', 0),
('833', 'Huyện Mỏ Cày Nam', 'Huyện', '83', 0),
('834', 'Huyện Giồng Trôm', 'Huyện', '83', 0),
('835', 'Huyện Bình Đại', 'Huyện', '83', 0),
('836', 'Huyện Ba Tri', 'Huyện', '83', 0),
('837', 'Huyện Thạnh Phú', 'Huyện', '83', 0),
('838', 'Huyện Mỏ Cày Bắc', 'Huyện', '83', 0),
('842', 'Thành phố Trà Vinh', 'Thành phố', '84', 0),
('844', 'Huyện Càng Long', 'Huyện', '84', 0),
('845', 'Huyện Cầu Kè', 'Huyện', '84', 0),
('846', 'Huyện Tiểu Cần', 'Huyện', '84', 0),
('847', 'Huyện Châu Thành', 'Huyện', '84', 0),
('848', 'Huyện Cầu Ngang', 'Huyện', '84', 0),
('849', 'Huyện Trà Cú', 'Huyện', '84', 0),
('850', 'Huyện Duyên Hải', 'Huyện', '84', 0),
('851', 'Thị xã Duyên Hải', 'Thị xã', '84', 0),
('855', 'Thành phố Vĩnh Long', 'Thành phố', '86', 0),
('857', 'Huyện Long Hồ', 'Huyện', '86', 0),
('858', 'Huyện Mang Thít', 'Huyện', '86', 0),
('859', 'Huyện  Vũng Liêm', 'Huyện', '86', 0),
('860', 'Huyện Tam Bình', 'Huyện', '86', 0),
('861', 'Thị xã Bình Minh', 'Thị xã', '86', 0),
('862', 'Huyện Trà Ôn', 'Huyện', '86', 0),
('863', 'Huyện Bình Tân', 'Huyện', '86', 0),
('866', 'Thành phố Cao Lãnh', 'Thành phố', '87', 0),
('867', 'Thành phố Sa Đéc', 'Thành phố', '87', 0),
('868', 'Thị xã Hồng Ngự', 'Thị xã', '87', 0),
('869', 'Huyện Tân Hồng', 'Huyện', '87', 0),
('870', 'Huyện Hồng Ngự', 'Huyện', '87', 0),
('871', 'Huyện Tam Nông', 'Huyện', '87', 0),
('872', 'Huyện Tháp Mười', 'Huyện', '87', 0),
('873', 'Huyện Cao Lãnh', 'Huyện', '87', 0),
('874', 'Huyện Thanh Bình', 'Huyện', '87', 0),
('875', 'Huyện Lấp Vò', 'Huyện', '87', 0),
('876', 'Huyện Lai Vung', 'Huyện', '87', 0),
('877', 'Huyện Châu Thành', 'Huyện', '87', 0),
('883', 'Thành phố Long Xuyên', 'Thành phố', '89', 0),
('884', 'Thành phố Châu Đốc', 'Thành phố', '89', 0),
('886', 'Huyện An Phú', 'Huyện', '89', 0),
('887', 'Thị xã Tân Châu', 'Thị xã', '89', 0),
('888', 'Huyện Phú Tân', 'Huyện', '89', 0),
('889', 'Huyện Châu Phú', 'Huyện', '89', 0),
('890', 'Huyện Tịnh Biên', 'Huyện', '89', 0),
('891', 'Huyện Tri Tôn', 'Huyện', '89', 0),
('892', 'Huyện Châu Thành', 'Huyện', '89', 0),
('893', 'Huyện Chợ Mới', 'Huyện', '89', 0),
('894', 'Huyện Thoại Sơn', 'Huyện', '89', 0),
('899', 'Thành phố Rạch Giá', 'Thành phố', '91', 0),
('900', 'Thị xã Hà Tiên', 'Thị xã', '91', 0),
('902', 'Huyện Kiên Lương', 'Huyện', '91', 0),
('903', 'Huyện Hòn Đất', 'Huyện', '91', 0),
('904', 'Huyện Tân Hiệp', 'Huyện', '91', 0),
('905', 'Huyện Châu Thành', 'Huyện', '91', 0),
('906', 'Huyện Giồng Riềng', 'Huyện', '91', 0),
('907', 'Huyện Gò Quao', 'Huyện', '91', 0),
('908', 'Huyện An Biên', 'Huyện', '91', 0),
('909', 'Huyện An Minh', 'Huyện', '91', 0),
('910', 'Huyện Vĩnh Thuận', 'Huyện', '91', 0),
('911', 'Huyện Phú Quốc', 'Huyện', '91', 0),
('912', 'Huyện Kiên Hải', 'Huyện', '91', 0),
('913', 'Huyện U Minh Thượng', 'Huyện', '91', 0),
('914', 'Huyện Giang Thành', 'Huyện', '91', 0),
('916', 'Quận Ninh Kiều', 'Quận', '92', 0),
('917', 'Quận Ô Môn', 'Quận', '92', 0),
('918', 'Quận Bình Thuỷ', 'Quận', '92', 0),
('919', 'Quận Cái Răng', 'Quận', '92', 0),
('923', 'Quận Thốt Nốt', 'Quận', '92', 0),
('924', 'Huyện Vĩnh Thạnh', 'Huyện', '92', 0),
('925', 'Huyện Cờ Đỏ', 'Huyện', '92', 0),
('926', 'Huyện Phong Điền', 'Huyện', '92', 0),
('927', 'Huyện Thới Lai', 'Huyện', '92', 0),
('930', 'Thành phố Vị Thanh', 'Thành phố', '93', 0),
('931', 'Thị xã Ngã Bảy', 'Thị xã', '93', 0),
('932', 'Huyện Châu Thành A', 'Huyện', '93', 0),
('933', 'Huyện Châu Thành', 'Huyện', '93', 0),
('934', 'Huyện Phụng Hiệp', 'Huyện', '93', 0),
('935', 'Huyện Vị Thuỷ', 'Huyện', '93', 0),
('936', 'Huyện Long Mỹ', 'Huyện', '93', 0),
('937', 'Thị xã Long Mỹ', 'Thị xã', '93', 0),
('941', 'Thành phố Sóc Trăng', 'Thành phố', '94', 0),
('942', 'Huyện Châu Thành', 'Huyện', '94', 0),
('943', 'Huyện Kế Sách', 'Huyện', '94', 0),
('944', 'Huyện Mỹ Tú', 'Huyện', '94', 0),
('945', 'Huyện Cù Lao Dung', 'Huyện', '94', 0),
('946', 'Huyện Long Phú', 'Huyện', '94', 0),
('947', 'Huyện Mỹ Xuyên', 'Huyện', '94', 0),
('948', 'Thị xã Ngã Năm', 'Thị xã', '94', 0),
('949', 'Huyện Thạnh Trị', 'Huyện', '94', 0),
('950', 'Thị xã Vĩnh Châu', 'Thị xã', '94', 0),
('951', 'Huyện Trần Đề', 'Huyện', '94', 0),
('954', 'Thành phố Bạc Liêu', 'Thành phố', '95', 0),
('956', 'Huyện Hồng Dân', 'Huyện', '95', 0),
('957', 'Huyện Phước Long', 'Huyện', '95', 0),
('958', 'Huyện Vĩnh Lợi', 'Huyện', '95', 0),
('959', 'Thị xã Giá Rai', 'Thị xã', '95', 0),
('960', 'Huyện Đông Hải', 'Huyện', '95', 0),
('961', 'Huyện Hoà Bình', 'Huyện', '95', 0),
('964', 'Thành phố Cà Mau', 'Thành phố', '96', 0),
('966', 'Huyện U Minh', 'Huyện', '96', 0),
('967', 'Huyện Thới Bình', 'Huyện', '96', 0),
('968', 'Huyện Trần Văn Thời', 'Huyện', '96', 0),
('969', 'Huyện Cái Nước', 'Huyện', '96', 0),
('970', 'Huyện Đầm Dơi', 'Huyện', '96', 0),
('971', 'Huyện Năm Căn', 'Huyện', '96', 0),
('972', 'Huyện Phú Tân', 'Huyện', '96', 0),
('973', 'Huyện Ngọc Hiển', 'Huyện', '96', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `drivers`
--

CREATE TABLE `drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `identification` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `drivers`
--

INSERT INTO `drivers` (`id`, `user_id`, `warehouse_id`, `available`, `identification`, `experience`, `lng`, `lat`, `current_address`, `date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 45, 2, 1, '2020020200202', '10', NULL, NULL, NULL, '2018-09-02', NULL, '2018-09-14 20:05:54', '2018-09-14 20:05:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `evaluates`
--

CREATE TABLE `evaluates` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `evaluates`
--

INSERT INTO `evaluates` (`id`, `from_id`, `to_id`, `type`, `content`, `note`, `rate`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '[{\"name\":\"T\\u00e0i x\\u1ebf\",\"comment\":\"Th\\u00e2n thi\\u1ec7n\"}]', 'note', '5', '2018-06-24 08:14:02', '2018-06-24 08:14:02'),
(2, 1, 1, 2, '[1,4]', 'note', '4', '2018-07-02 00:53:38', '2018-07-02 00:53:38'),
(3, 1, 1, 2, '[1,4]', 'note', '4', '2018-07-02 00:53:38', '2018-07-02 00:53:38'),
(4, 1, 1, 1, '[\"1\",\"4\"]', 'note', '5', '2018-09-28 20:58:37', '2018-09-28 20:58:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `finances`
--

CREATE TABLE `finances` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `order_id` int(11) DEFAULT NULL,
  `total` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `own` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `finances`
--

INSERT INTO `finances` (`id`, `name`, `type`, `order_id`, `total`, `payment`, `own`, `date`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Remedios Morse', 1, 0, '100000', '50000', '50000', '2018-07-01', NULL, 1, '2018-07-17 07:27:31', '2018-07-17 07:27:31'),
(2, 'Brenden King', 2, NULL, '1000000', NULL, NULL, '2018-07-02', NULL, 1, '2018-07-17 07:30:07', '2018-07-17 07:30:07'),
(3, 'Brenden King', 2, NULL, '1000000', NULL, NULL, '2018-07-02', 'sasasasasas', 1, '2018-07-17 07:35:26', '2018-07-17 07:35:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `position` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `service_id`, `type`, `filename`, `path`, `position`) VALUES
(1, 12, 'order', 'Screen Shot 2018-07-18 at 11.13.36.png', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/18072018/', 1),
(2, 12, 'avatar', 'Screen Shot 2018-07-18 at 11.13.36.png', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/18072018/', 1),
(3, 1, 'order', 'UNADJUSTEDNONRAW_thumb_1.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/19072018/', 1),
(4, 12, 'avatar', 'b2.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/25082018/', 1),
(5, 12, 'avatar', 'b2.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/25082018/', 1),
(6, 12, 'avatar', 'b2.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/25082018/', 1),
(7, 12, 'avatar', 'b2.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/25082018/', 1),
(8, 1, 'order', '3.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/26082018/', 1),
(9, 1, 'order', '4.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/26082018/', 1),
(10, 1, 'order', 'b2.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/26082018/', 1),
(11, 1, 'order', 'b3.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/26082018/', 1),
(12, 1, 'order', 'bg.jpg', '/Applications/XAMPP/xamppfiles/htdocs/thaile/project/book-car/public/storage/uploads/26082018/', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manager_prices`
--

CREATE TABLE `manager_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `type_car` tinyint(1) DEFAULT '1',
  `option` tinyint(1) DEFAULT '1',
  `min` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_value` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `increase` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `increase_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '79',
  `to` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_sende` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_receive` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_receive` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_payment` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `manager_prices`
--

INSERT INTO `manager_prices` (`id`, `type`, `type_car`, `option`, `min`, `min_value`, `user_id`, `increase`, `increase_value`, `from`, `to`, `time_sende`, `time_receive`, `address_receive`, `address_payment`, `note`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '25', '70000', 1, NULL, '', '79', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 06:53:48', '2018-08-28 06:53:48'),
(2, 1, 2, 2, '1', '70000', 1, '1', '5000', '79', NULL, NULL, NULL, '1', '70000', NULL, 1, '2018-08-28 07:00:01', '2018-08-28 07:00:01'),
(3, 2, 1, 2, '1', '50000', 1, NULL, '', '79', '718', NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 07:11:00', '2018-08-28 07:14:24'),
(4, 2, 1, 2, '1', '50000', 1, NULL, '', '79', '724', NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 07:11:19', '2018-08-28 07:14:24'),
(5, 2, 1, 2, '1', '70000', 1, NULL, '', '79', '719', NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 07:11:43', '2018-08-28 07:14:24'),
(6, 2, 1, 2, '1', '70000', 1, NULL, '', '79', '721', NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 07:12:03', '2018-08-28 07:14:24'),
(7, 2, 1, 2, '1', '70000', 1, NULL, '', '79', '723', NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 07:13:29', '2018-08-28 07:14:24'),
(8, 2, 1, 2, '1', '50000', 1, NULL, '', '79', '725', NULL, NULL, NULL, NULL, NULL, 1, '2018-08-28 07:14:24', '2018-08-28 07:14:24'),
(9, 3, 1, 2, '5', '120000', 1, '1', '12000', '79', '718', '10', '13', NULL, NULL, NULL, 1, '2018-08-28 07:20:04', '2018-08-28 07:20:04'),
(10, 3, 1, 2, '5', '120000', 1, '1', '12000', '79', '724', '10', '13', NULL, NULL, NULL, 1, '2018-08-28 07:21:04', '2018-08-28 07:21:04'),
(11, 3, 1, 2, '5', '120000', 1, '1', '12000', '79', '725', '10', '13', NULL, NULL, NULL, 1, '2018-08-28 07:21:35', '2018-08-28 07:21:35'),
(12, 3, 1, 2, '5', '150000', 1, '1', '15000', '79', '721', '10', '14', NULL, NULL, NULL, 1, '2018-08-28 07:22:28', '2018-08-28 07:22:28'),
(13, 3, 1, 2, '5', '150000', 1, '1', '15000', '79', '723', '10', '14', NULL, NULL, NULL, 1, '2018-08-28 07:22:50', '2018-08-28 07:22:50'),
(14, 3, 1, 2, '5', '180000', 1, '1', '18000', '79', '719', '10', '15', NULL, NULL, NULL, 0, '2018-08-28 07:23:20', '2018-08-28 23:03:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_26_133125_create_roles_and_permisstions_tables', 1),
(4, '2018_06_21_154836_create_cars_table', 1),
(5, '2018_06_21_155458_create_customers_table', 1),
(8, '2018_06_23_074859_create_others_table', 2),
(9, '2018_06_24_024109_create_management_prices_table', 2),
(10, '2018_06_24_041200_create_evaluates_table', 3),
(12, '2018_06_24_071326_create_deliveries_table', 4),
(13, '2018_06_24_073104_create_finances_table', 4),
(14, '2018_06_24_154731_create_orders_table', 4),
(15, '2018_06_27_032558_create_order_details_table', 4),
(16, '2018_06_24_071211_create_drivers_table', 5),
(17, '2018_07_05_083456_create_templates_table', 6),
(18, '2018_07_11_035732_create_socials_table', 6),
(19, '2018_07_12_060704_create_warehouses_table', 7),
(20, '2018_08_25_090448_create_devices_table', 8),
(21, '2018_08_28_161051_create_order_receives_table', 9),
(22, '2018_08_29_075407_create_rooms_table', 10),
(23, '2018_08_29_075523_create_contacts_table', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_type` tinyint(1) NOT NULL,
  `car_option` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `total_price` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT '1',
  `is_payment` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `name`, `car_type`, `car_option`, `status`, `total_price`, `payment_type`, `is_payment`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'IHT20180915001', 'required', 1, 1, 2, '120001', 2, 0, 39, '2018-09-14 20:15:43', '2018-09-14 20:15:43'),
(50, 'IHT20180915002', 'required', 1, 1, 1, '1000000', 2, 0, 39, '2018-09-14 20:16:16', '2018-09-14 20:36:58'),
(51, 'IHT20180915003', 'required', 1, 1, 1, '-1', 2, 0, 39, '2018-09-14 21:10:07', '2018-09-14 21:10:07'),
(52, 'IHT20180915004', 'required', 1, 1, 1, '-1', 2, 0, 39, '2018-09-14 21:10:59', '2018-09-14 21:10:59'),
(53, 'IHT20180915005', 'required', 1, 1, 1, '-1', 2, 0, 39, '2018-09-14 21:13:58', '2018-09-14 21:13:58'),
(54, 'IHT20180915006', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:14:31', '2018-09-14 21:14:31'),
(55, 'IHT20180915007', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:16:00', '2018-09-14 21:16:00'),
(56, 'IHT20180915008', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:20:36', '2018-09-14 21:20:36'),
(57, 'IHT20180915009', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:21:36', '2018-09-14 21:21:36'),
(58, 'IHT20180915010', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:24:56', '2018-09-14 21:24:56'),
(59, 'IHT20180915011', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:25:07', '2018-09-14 21:25:07'),
(60, 'IHT20180915012', 'required', 1, 1, 1, '120000', 2, 0, 39, '2018-09-14 21:26:34', '2018-09-14 21:26:34'),
(61, 'IHT20180929001', 'required', 1, 1, 1, '120000', 2, 0, 40, '2018-09-28 20:17:36', '2018-09-28 20:17:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_deliveries`
--

CREATE TABLE `order_deliveries` (
  `order_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `sender_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_date` date DEFAULT NULL,
  `receive_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `km` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_province_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_district_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_province_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_district_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `sender_name`, `sender_phone`, `sender_address`, `sender_date`, `receive_name`, `receive_phone`, `receive_address`, `receive_date`, `km`, `weight`, `sender_province_id`, `sender_district_id`, `receive_province_id`, `receive_district_id`, `price_id`, `warehouse_id`) VALUES
(4, 1, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 1),
(5, 50, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 2),
(6, 51, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 1),
(7, 52, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 1),
(8, 53, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 2),
(9, 54, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 1),
(10, 55, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 1),
(11, 56, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 1),
(12, 58, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 2),
(13, 59, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 2),
(14, 60, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 2),
(15, 61, 'Thaile 1', '11111111', '208 Nguyễn Hữu Cảnh, Phường 22', '2018-03-10', 'Thaile 2', '22222222', 'Khu phố 3, thị trấn Trảng Bom', NULL, '20,3', '100000', '79', '765', '75', '737', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_receives`
--

CREATE TABLE `order_receives` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_receives`
--

INSERT INTO `order_receives` (`id`, `name`, `phone`, `district_id`, `province_id`, `address`, `order_id`) VALUES
(1, 'Receive 1', '123', '778', '79', '69 tran tron cung', 1),
(2, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 1),
(3, 'Receive 1', '123', '778', '79', '69 tran tron cung', 2),
(4, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 2),
(5, 'Receive 1', '123', '778', '79', '69 tran tron cung', 49),
(6, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 49),
(7, 'Receive 1', '123', '778', '79', '69 tran tron cung', 50),
(8, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 50),
(9, 'Receive 1', '123', '778', '79', '69 tran tron cung', 51),
(10, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 51),
(11, 'Receive 1', '123', '778', '79', '69 tran tron cung', 52),
(12, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 52),
(13, 'Receive 1', '123', '778', '79', '69 tran tron cung', 53),
(14, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 53),
(15, 'Receive 1', '123', '778', '79', '69 tran tron cung', 54),
(16, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 54),
(17, 'Receive 1', '123', '778', '79', '69 tran tron cung', 55),
(18, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 55),
(19, 'Receive 1', '123', '778', '79', '69 tran tron cung', 56),
(20, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 56),
(21, 'Receive 1', '123', '778', '79', '69 tran tron cung', 58),
(22, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 58),
(23, 'Receive 1', '123', '778', '79', '69 tran tron cung', 59),
(24, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 59),
(25, 'Receive 1', '123', '778', '79', '69 tran tron cung', 60),
(26, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 60),
(27, 'Receive 1', '123', '778', '79', '69 tran tron cung', 61),
(28, 'Receive 2', '456', '765', '79', '170 nguyen van dau', 61);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `others`
--

CREATE TABLE `others` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `others`
--

INSERT INTO `others` (`id`, `type`, `name`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Thái Độ', 1, NULL, '2018-07-02 00:36:44', '2018-07-02 00:36:44'),
(2, 2, 'Thời Gian', 1, NULL, '2018-07-02 00:36:59', '2018-07-02 00:36:59'),
(3, 1, 'Chất Lượng', 1, NULL, '2018-07-02 00:38:24', '2018-07-02 00:38:24'),
(4, 1, 'Giá Cả', 1, NULL, '2018-07-02 00:38:33', '2018-07-02 00:38:33'),
(5, 3, 'Thời Gian', 1, NULL, '2018-07-02 00:38:45', '2018-07-02 00:38:45'),
(6, 3, 'Tính Cách', 1, NULL, '2018-07-02 00:40:47', '2018-07-02 00:40:47'),
(7, 4, 'Xe tai 500 kg', 1, NULL, '2018-09-30 22:47:53', '2018-09-30 22:47:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE `provinces` (
  `province_id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `publish` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `provinces`
--

INSERT INTO `provinces` (`province_id`, `name`, `type`, `publish`) VALUES
('01', 'Thành phố Hà Nội', 'Thành phố Trung ương', NULL),
('02', 'Tỉnh Hà Giang', 'Tỉnh', NULL),
('04', 'Tỉnh Cao Bằng', 'Tỉnh', NULL),
('06', 'Tỉnh Bắc Kạn', 'Tỉnh', NULL),
('08', 'Tỉnh Tuyên Quang', 'Tỉnh', NULL),
('10', 'Tỉnh Lào Cai', 'Tỉnh', NULL),
('11', 'Tỉnh Điện Biên', 'Tỉnh', NULL),
('12', 'Tỉnh Lai Châu', 'Tỉnh', NULL),
('14', 'Tỉnh Sơn La', 'Tỉnh', NULL),
('15', 'Tỉnh Yên Bái', 'Tỉnh', NULL),
('17', 'Tỉnh Hoà Bình', 'Tỉnh', NULL),
('19', 'Tỉnh Thái Nguyên', 'Tỉnh', NULL),
('20', 'Tỉnh Lạng Sơn', 'Tỉnh', NULL),
('22', 'Tỉnh Quảng Ninh', 'Tỉnh', NULL),
('24', 'Tỉnh Bắc Giang', 'Tỉnh', NULL),
('25', 'Tỉnh Phú Thọ', 'Tỉnh', NULL),
('26', 'Tỉnh Vĩnh Phúc', 'Tỉnh', NULL),
('27', 'Tỉnh Bắc Ninh', 'Tỉnh', NULL),
('30', 'Tỉnh Hải Dương', 'Tỉnh', NULL),
('31', 'Thành phố Hải Phòng', 'Thành phố Trung ương', NULL),
('33', 'Tỉnh Hưng Yên', 'Tỉnh', NULL),
('34', 'Tỉnh Thái Bình', 'Tỉnh', NULL),
('35', 'Tỉnh Hà Nam', 'Tỉnh', NULL),
('36', 'Tỉnh Nam Định', 'Tỉnh', NULL),
('37', 'Tỉnh Ninh Bình', 'Tỉnh', NULL),
('38', 'Tỉnh Thanh Hóa', 'Tỉnh', NULL),
('40', 'Tỉnh Nghệ An', 'Tỉnh', NULL),
('42', 'Tỉnh Hà Tĩnh', 'Tỉnh', NULL),
('44', 'Tỉnh Quảng Bình', 'Tỉnh', NULL),
('45', 'Tỉnh Quảng Trị', 'Tỉnh', NULL),
('46', 'Tỉnh Thừa Thiên Huế', 'Tỉnh', NULL),
('48', 'Thành phố Đà Nẵng', 'Thành phố Trung ương', NULL),
('49', 'Tỉnh Quảng Nam', 'Tỉnh', NULL),
('51', 'Tỉnh Quảng Ngãi', 'Tỉnh', NULL),
('52', 'Tỉnh Bình Định', 'Tỉnh', NULL),
('54', 'Tỉnh Phú Yên', 'Tỉnh', NULL),
('56', 'Tỉnh Khánh Hòa', 'Tỉnh', NULL),
('58', 'Tỉnh Ninh Thuận', 'Tỉnh', NULL),
('60', 'Tỉnh Bình Thuận', 'Tỉnh', NULL),
('62', 'Tỉnh Kon Tum', 'Tỉnh', NULL),
('64', 'Tỉnh Gia Lai', 'Tỉnh', NULL),
('66', 'Tỉnh Đắk Lắk', 'Tỉnh', NULL),
('67', 'Tỉnh Đắk Nông', 'Tỉnh', NULL),
('68', 'Tỉnh Lâm Đồng', 'Tỉnh', NULL),
('70', 'Tỉnh Bình Phước', 'Tỉnh', NULL),
('72', 'Tỉnh Tây Ninh', 'Tỉnh', NULL),
('74', 'Tỉnh Bình Dương', 'Tỉnh', 1),
('75', 'Tỉnh Đồng Nai', 'Tỉnh', NULL),
('77', 'Tỉnh Bà Rịa - Vũng Tàu', 'Tỉnh', NULL),
('79', 'Thành phố Hồ Chí Minh', 'Thành phố Trung ương', 1),
('80', 'Tỉnh Long An', 'Tỉnh', NULL),
('82', 'Tỉnh Tiền Giang', 'Tỉnh', NULL),
('83', 'Tỉnh Bến Tre', 'Tỉnh', NULL),
('84', 'Tỉnh Trà Vinh', 'Tỉnh', NULL),
('86', 'Tỉnh Vĩnh Long', 'Tỉnh', NULL),
('87', 'Tỉnh Đồng Tháp', 'Tỉnh', NULL),
('89', 'Tỉnh An Giang', 'Tỉnh', NULL),
('91', 'Tỉnh Kiên Giang', 'Tỉnh', NULL),
('92', 'Thành phố Cần Thơ', 'Thành phố Trung ương', NULL),
('93', 'Tỉnh Hậu Giang', 'Tỉnh', NULL),
('94', 'Tỉnh Sóc Trăng', 'Tỉnh', NULL),
('95', 'Tỉnh Bạc Liêu', 'Tỉnh', NULL),
('96', 'Tỉnh Cà Mau', 'Tỉnh', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Nathaniel Mayo', 'Earum eius corporis ea labore quo nostrud magni', '2018-07-18 01:08:21', '2018-07-18 01:08:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `created_by_id`, `private`, `created_at`, `updated_at`) VALUES
(17309722, '71c1855f34330f2d2912fbff4e9cb22b', 'NW7v30LTSqM9pRq4', 1, '2018-09-28T13:35:50Z', '2018-09-28T13:35:50Z'),
(17311426, '17bce86fbdfc79062719baf077520b87', 'NW7v30LTSqM9pRq4', 1, '2018-09-28T14:06:59Z', '2018-09-28T14:06:59Z'),
(17311427, '17bce86fbdfc79062719baf077520b88', 'NW7v30LTSqM9pRq4', 1, '2018-09-28T14:06:59Z', '2018-09-28T14:06:59Z');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `provider_user_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `templates`
--

CREATE TABLE `templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `level` tinyint(1) NOT NULL DEFAULT '3',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` date DEFAULT NULL,
  `baned` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated_phone` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chatkit_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `code`, `email`, `gender`, `level`, `activated`, `birthday`, `baned`, `password`, `activated_phone`, `chatkit_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ThaiLe Admin', '09632560961', NULL, 'admin@admin.com', 1, 1, 1, '1994-01-01', 0, '$2y$10$fIfgtcJrZCg51YE7fbncBe0puO3aZq6UblwjaXFMJysW8L.tXQ4p6', NULL, 'NW7v30LTSqM9pRq4', 'IYhq9mTtyyi3bqCySU9nWSU1UBpsfMcrM5WHtfLFZcNhzkgqZrRvxdGDjDrb', '2018-06-22 13:36:28', '2018-07-04 01:51:30'),
(39, 'ThaiLe', '09632560961', NULL, 'thaile.dev01@gmail.com', 1, 3, 1, '1994-01-01', 0, '$2y$10$vXXmvZYjw5qllGItTFUom.bdaXWJ2.m.4Bj7oNC7PqfZmFGkkayda', '396290', 'NW7v30LTSqM9pRq3', NULL, '2018-08-29 07:05:01', '2018-08-29 07:05:01'),
(40, 'LeThai', '09632560962', NULL, 'lethai.dev01@gmail.com', 1, 2, 1, '1994-01-01', 0, '$2y$10$3oWt/7kIcTnVg9emf.o.CuHEuwmMSbRPsQzt0rMey3VZjBU97VoXe', '670821', 'ncNKWHbZFDyOny0X', NULL, '2018-08-29 07:08:08', '2018-08-29 07:08:08'),
(43, 'Blair Browning', '+588-87-9135369', '1111', 'wufubehafy@mailinator.net', 1, 1, 1, NULL, 0, NULL, NULL, 'wuWNMqHwJnZRGajK', NULL, '2018-09-14 19:49:25', '2018-09-14 19:49:25'),
(44, 'Chloe Dyer', '+867-45-2164445', '1212', 'tubyrizi@mailinator.net', 1, 1, 1, NULL, 0, '$2y$10$MHwXbS3hzzOnGvW0s/wnCO/DEpfN2fCXDDkiw5nLe7OoXCUZub/ni', NULL, 'C2qJMHFYm7zBNY9c', NULL, '2018-09-14 19:51:13', '2018-09-14 19:51:13'),
(45, 'Thai Le', '+325-29-7007908', '111111', 'toqo@mailinator.com', 1, 2, 0, NULL, 0, '$2y$10$uH61vG297PV3MxI.syL2YusFp0Ql034TiHefxUmhvNZM8BhbQYn6C', NULL, '2aRSNqD99VirPPgt', NULL, '2018-09-14 20:05:54', '2018-09-14 20:12:23'),
(46, 'LeThai', '09632560962', NULL, 'lethai.devhh01@gmail.com', 1, 3, 0, '1994-01-01', 0, '$2y$10$xQ.3IopvysYAdT8M7fNlUeHkh3fiInwV1A/4jWTuQlbaom01LC.na', '594994', '0hz8WyDLLn1KrrEm', NULL, '2018-09-28 19:46:35', '2018-09-28 19:46:35'),
(47, 'LeThai', '09632560962', NULL, 'lethai.devhhdd01@gmail.com', 1, 3, 0, '1994-01-01', 0, '$2y$10$2XewrzX16J1k0S/byk4u5uDHN7IZMU9i0s2rhvU7c5rPBgR/LXq/m', '315596', 'S1yZkmWRdLBmfLhl', NULL, '2018-09-28 19:53:11', '2018-09-28 19:53:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `distribution` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acreage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `warehouses`
--

INSERT INTO `warehouses` (`id`, `code`, `user_id`, `manager_id`, `distribution`, `acreage`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '123', 1, 11, '321', '100', '123', NULL, '2018-07-12 01:04:05', '2018-07-12 01:04:05'),
(2, '00003', 1, 11, 'Aut molestiae harum iure voluptate asperiores', 'Iusto ad officiis fuga Reiciendis reprehenderit ad animi quia itaque quia autem', 'In autem adipisicing et soluta qui amet', NULL, '2018-07-12 07:53:15', '2018-07-12 07:53:15');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contacts_room_id_unique` (`room_id`),
  ADD KEY `contacts_user1_id_foreign` (`user1_id`),
  ADD KEY `contacts_user2_id_foreign` (`user2_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `evaluates`
--
ALTER TABLE `evaluates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `manager_prices`
--
ALTER TABLE `manager_prices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_receives`
--
ALTER TABLE `order_receives`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`province_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `role_permission_permission_id_foreign` (`permission_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD UNIQUE KEY `rooms_id_unique` (`id`);

--
-- Chỉ mục cho bảng `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socials_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_code_unique` (`code`);

--
-- Chỉ mục cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouses_code_unique` (`code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `evaluates`
--
ALTER TABLE `evaluates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `manager_prices`
--
ALTER TABLE `manager_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `order_receives`
--
ALTER TABLE `order_receives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `others`
--
ALTER TABLE `others`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `contacts_user1_id_foreign` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contacts_user2_id_foreign` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `socials`
--
ALTER TABLE `socials`
  ADD CONSTRAINT `socials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
