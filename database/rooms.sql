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

 Date: 19/06/2019 13:24:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms`  (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE INDEX `rooms_id_unique`(`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES (19397295, 'ba96928187aba273520cf419666efe9d', 'vWxwkUP4IX8W39z9', 1, '2019-01-26T02:47:20Z', '2019-01-26T02:47:20Z');
INSERT INTO `rooms` VALUES (19402450, '882615e43408628bf50a91dc92e81fd8', '1QwwDdFNDLe3QeIa', 1, '2019-02-13T02:59:43Z', '2019-02-13T02:59:43Z');
INSERT INTO `rooms` VALUES (19402451, '64999f4f70f206fb34346a115be7ee35', 'nZbDIxkxj6nb6x4p', 1, '2019-02-13T03:06:44Z', '2019-02-13T03:06:44Z');
INSERT INTO `rooms` VALUES (19402463, '31c69b6e7c1772fcd4326c3f3afb0a20', '9LAUWlPjJaI42V6v', 1, '2019-02-13T07:36:10Z', '2019-02-13T07:36:10Z');
INSERT INTO `rooms` VALUES (19402839, '250bb60112fa31cb97396b89f9389c5b', '2mrxxqnyGSL0iB00', 1, '2019-02-13T23:55:44Z', '2019-02-13T23:55:44Z');
INSERT INTO `rooms` VALUES (19402842, 'dd5279f1646645536e88439491bab683', 'lOXm77KGGOH2SXa8', 1, '2019-02-14T01:17:45Z', '2019-02-14T01:17:45Z');
INSERT INTO `rooms` VALUES (19402847, 'f685525ec49bde55b474e5f2dfd044c4', 'lOXm77KGGOH2SXa8', 1, '2019-02-14T06:48:46Z', '2019-02-14T06:48:46Z');
INSERT INTO `rooms` VALUES (19402853, '111ea5e6643730c33e95ac066f729853', 'vgYg4i8Tz7DlFQqE', 1, '2019-02-14T07:37:01Z', '2019-02-14T07:37:01Z');
INSERT INTO `rooms` VALUES (19402854, '22d4554575b4c0a19c928e829aaf5d9c', 'qJFreLniGC59tMKe', 1, '2019-02-14T07:39:36Z', '2019-02-14T07:39:36Z');
INSERT INTO `rooms` VALUES (19403198, '198c010884e172659e23cc1477c4981a', 'lOXm77KGGOH2SXa8', 1, '2019-02-15T08:15:09Z', '2019-02-15T08:15:09Z');
INSERT INTO `rooms` VALUES (19404476, '5c329d04e7f5600d0ff8a2c1066320b4', 'VOjt9RevCcBEfkmf', 1, '2019-02-17T01:53:49Z', '2019-02-17T01:53:49Z');
INSERT INTO `rooms` VALUES (19404518, '40e735de5ee37b5b5a1e35d2859279b1', '04XxZjxQjSD3mcdM', 1, '2019-02-17T16:11:05Z', '2019-02-17T16:11:05Z');
INSERT INTO `rooms` VALUES (19405389, '1464c1ff200acdc7e7f5319b683398a6', 'YkhHgXrrjj41ybcl', 1, '2019-02-19T04:45:03Z', '2019-02-19T04:45:03Z');
INSERT INTO `rooms` VALUES (19406257, '29b978d07a83906ac3cec48f407e869a', 'lOXm77KGGOH2SXa8', 1, '2019-02-20T13:47:01Z', '2019-02-20T13:47:01Z');
INSERT INTO `rooms` VALUES (19407540, 'c9cefc502f0cc01d991a5dc004d1c8d6', 'qJFreLniGC59tMKe', 1, '2019-02-21T03:09:18Z', '2019-02-21T03:09:18Z');
INSERT INTO `rooms` VALUES (19407542, '40bd1ffd79dfbf7e2c40d54d9e6e7a1b', 'vIXkNZzWDgVrDqh6', 1, '2019-02-21T03:46:36Z', '2019-02-21T03:46:36Z');
INSERT INTO `rooms` VALUES (19407555, '3afb031b68e555b79f2e545dd8e1d59c', '9SYqqzNgGJbAqMFd', 1, '2019-02-21T06:39:18Z', '2019-02-21T06:39:18Z');
INSERT INTO `rooms` VALUES (19407562, 'feec5651f7268f81dfed4cf673b086c4', 'TiN0ePEJCElvSnT7', 1, '2019-02-21T08:50:17Z', '2019-02-21T08:50:17Z');
INSERT INTO `rooms` VALUES (19407950, '6439ecd05c5f57efa089b8afac68c229', 'PdJu77yj7L8aQwZb', 1, '2019-02-22T06:49:03Z', '2019-02-22T06:49:03Z');
INSERT INTO `rooms` VALUES (19407952, 'a9ecd11088ff51de7b2232cb6ce6e333', '04XxZjxQjSD3mcdM', 1, '2019-02-22T09:04:37Z', '2019-02-22T09:04:37Z');
INSERT INTO `rooms` VALUES (19407953, 'c0b0b82cb7704cf9169af2cd11031fd8', 'sofD6DxHpdH2oSE9', 1, '2019-02-22T09:17:07Z', '2019-02-22T09:17:07Z');
INSERT INTO `rooms` VALUES (19408110, 'bac925a158dbf0f670d3904873acc5a2', 'UnMj7CVRjKKKe6q1', 1, '2019-02-23T04:02:06Z', '2019-02-23T04:02:06Z');
INSERT INTO `rooms` VALUES (19408180, '6b86c1bf017f1d9f590e8258e12a2ee3', 'ew41boy02LpzS4CF', 1, '2019-02-25T03:56:48Z', '2019-02-25T03:56:48Z');
INSERT INTO `rooms` VALUES (19408184, 'e14b61a4e44da848a93cce8bed1db748', 'vWxwkUP4IX8W39z9', 1, '2019-02-25T07:44:49Z', '2019-02-25T07:44:49Z');
INSERT INTO `rooms` VALUES (19408467, '61f1222ba77fe1d674057a1a05624d23', '2mrxxqnyGSL0iB00', 1, '2019-02-27T03:01:29Z', '2019-02-27T03:01:29Z');
INSERT INTO `rooms` VALUES (19408468, '3b545a448d341bef6156c6f77140d189', 'qJFreLniGC59tMKe', 1, '2019-02-27T03:07:53Z', '2019-02-27T03:07:53Z');
INSERT INTO `rooms` VALUES (19409454, '876e0453549afa97552902f78e5d2460', 'sstEx3jjaaNV7pwd', 1, '2019-02-28T04:08:31Z', '2019-02-28T04:08:31Z');
INSERT INTO `rooms` VALUES (19409666, 'bd9356083c0f1e3b0e473e79df875c6e', 'qJFreLniGC59tMKe', 1, '2019-03-01T04:04:06Z', '2019-03-01T04:04:06Z');
INSERT INTO `rooms` VALUES (19410298, '023b8ed3cbf9aeaa8ffe21fb5b406ff1', 'RQ7BL5eI3TcJjcdP', 1, '2019-03-04T07:19:48Z', '2019-03-04T07:19:48Z');
INSERT INTO `rooms` VALUES (19410754, 'd023e8d60232b65ba2b1b41e7736090c', 'NW7v30LTSqM9pRq4', 1, '2019-03-05T06:54:40Z', '2019-03-05T06:54:40Z');
INSERT INTO `rooms` VALUES (19411479, 'c8fb8286ca0f74c891d80b721bbb7f64', 'vWxwkUP4IX8W39z9', 1, '2019-03-07T02:39:56Z', '2019-03-07T02:39:56Z');
INSERT INTO `rooms` VALUES (19412029, 'ae83f49fca84a5cc2cd1586180f5562f', 'sstEx3jjaaNV7pwd', 1, '2019-03-09T08:06:18Z', '2019-03-09T08:06:18Z');
INSERT INTO `rooms` VALUES (19412130, 'bc51f60c8dc3dbbefa2a3b16ab457b2d', 'vWxwkUP4IX8W39z9', 1, '2019-03-11T02:30:10Z', '2019-03-11T02:30:10Z');
INSERT INTO `rooms` VALUES (19412131, '6d2acf23df9c05036acf533ee3fdb963', 'NW7v30LTSqM9pRq4', 1, '2019-03-11T02:31:03Z', '2019-03-11T02:31:03Z');
INSERT INTO `rooms` VALUES (19412132, '02c1624abe6589d7fbd66b7d1fbb3054', 'zGUtgf4dGYlb6RAv', 1, '2019-03-11T02:39:22Z', '2019-03-11T02:39:22Z');
INSERT INTO `rooms` VALUES (19412543, '90102e64627d43714988be8c1758f701', 'Gxakp7ZbxLqEVlnq', 1, '2019-03-13T01:24:25Z', '2019-03-13T01:24:25Z');
INSERT INTO `rooms` VALUES (19415594, '94efe9cb6aeac65d3032fa52f7e8910f', 'Gxakp7ZbxLqEVlnq', 1, '2019-03-14T04:36:24Z', '2019-03-14T04:36:24Z');
INSERT INTO `rooms` VALUES (19416016, 'fa075d8771a6ac55e3c55e091a888a62', 'RQ7BL5eI3TcJjcdP', 1, '2019-03-18T09:09:32Z', '2019-03-18T09:09:32Z');
INSERT INTO `rooms` VALUES (19416224, 'a2202568b7ff83510299396abcf6d5c5', '1QwwDdFNDLe3QeIa', 1, '2019-03-19T01:26:09Z', '2019-03-19T01:26:09Z');
INSERT INTO `rooms` VALUES (19416254, '4943732080a687613f8ab14679fc5df6', 'nQ6frccy0qGACCmR', 1, '2019-03-19T09:12:02Z', '2019-03-19T09:12:02Z');
INSERT INTO `rooms` VALUES (19416970, '977b00bab306ebb8aa56ddfdbb29c801', 'JXof5owDYexlX2da', 1, '2019-03-20T13:08:05Z', '2019-03-20T13:08:05Z');
INSERT INTO `rooms` VALUES (19419508, 'b7fd0755c9ab624b8a402edf8cc35960', 'vgYg4i8Tz7DlFQqE', 1, '2019-03-29T06:33:22Z', '2019-03-29T06:33:22Z');
INSERT INTO `rooms` VALUES (19419895, 'd61eaf8c39c9ddbbe284fa574d347b44', '2mrxxqnyGSL0iB00', 1, '2019-04-01T09:02:04Z', '2019-04-01T09:02:04Z');
INSERT INTO `rooms` VALUES (19420146, 'f45b0009fabafdc58ec78d8cee9b2c1b', 'RQ7BL5eI3TcJjcdP', 1, '2019-04-02T04:15:12Z', '2019-04-02T04:15:12Z');
INSERT INTO `rooms` VALUES (19420153, '3ed49dfffa60713482868c485fbfd8bf', 'cp1ZaexCZBuzGXyx', 1, '2019-04-02T06:45:54Z', '2019-04-02T06:45:54Z');
INSERT INTO `rooms` VALUES (19420154, '64201f8b543a6b438157bb6f1d017c82', 'cp1ZaexCZBuzGXyx', 1, '2019-04-02T06:46:15Z', '2019-04-02T06:46:15Z');
INSERT INTO `rooms` VALUES (19420155, '56806ba9d49bb2ebc5beb67fe99f17ed', 'sofD6DxHpdH2oSE9', 1, '2019-04-02T07:01:57Z', '2019-04-02T07:01:57Z');
INSERT INTO `rooms` VALUES (19420357, '631bc08cd899e83cc23dcc71abbe74f2', 'gEzZUssR3itprg7r', 1, '2019-04-02T15:16:35Z', '2019-04-02T15:16:35Z');
INSERT INTO `rooms` VALUES (19420370, '965d6dabd1d479d9bd78bebf5740e34b', 'vWxwkUP4IX8W39z9', 1, '2019-04-02T15:52:49Z', '2019-04-02T15:52:49Z');
INSERT INTO `rooms` VALUES (19420371, 'd08f34053deded4453451fb14bee929b', 'WiLvd2Pt87JeM0Z3', 1, '2019-04-02T15:54:50Z', '2019-04-02T15:54:50Z');
INSERT INTO `rooms` VALUES (19420372, 'fc961fc7ecc825d2091f25edf32e9bc1', 'WiLvd2Pt87JeM0Z3', 1, '2019-04-02T15:55:37Z', '2019-04-02T15:55:37Z');
INSERT INTO `rooms` VALUES (19420621, 'dda646ab1a8ef97562ec4ba1d9d98a3f', '1C68wcackb7tcoza', 1, '2019-04-03T01:20:19Z', '2019-04-03T01:20:19Z');
INSERT INTO `rooms` VALUES (19423067, 'a63c38d8a1c7b320d72f43ca7f612572', 'vWxwkUP4IX8W39z9', 1, '2019-04-08T03:44:11Z', '2019-04-08T03:44:11Z');
INSERT INTO `rooms` VALUES (19423069, '61b6f02e065c8feff00d1e0cbf5e9674', 'WiLvd2Pt87JeM0Z3', 1, '2019-04-08T04:19:08Z', '2019-04-08T04:19:08Z');
INSERT INTO `rooms` VALUES (19423070, '2e3014db1849d7c07ac74dcb99b0dd65', '1C68wcackb7tcoza', 1, '2019-04-08T04:36:18Z', '2019-04-08T04:36:18Z');
INSERT INTO `rooms` VALUES (19423071, 'd0fa7da7185d0bed39e4382bdadd1373', '1C68wcackb7tcoza', 1, '2019-04-08T04:36:52Z', '2019-04-08T04:36:52Z');
INSERT INTO `rooms` VALUES (19424440, '28aa6d6aabc24f084fd958bb6ea3892e', 'cp1ZaexCZBuzGXyx', 1, '2019-04-09T08:57:32Z', '2019-04-09T08:57:32Z');
INSERT INTO `rooms` VALUES (19425428, 'b4ff592ed46852adedace0fe69c82700', 'lGNjVdT3pwTZ5X3A', 1, '2019-04-10T04:14:07Z', '2019-04-10T04:14:07Z');
INSERT INTO `rooms` VALUES (19425467, '18621f297ff4d9677ad924d739a7fb4f', '6HQPCyMPnim36a3x', 1, '2019-04-10T08:38:40Z', '2019-04-10T08:38:40Z');
INSERT INTO `rooms` VALUES (19425468, '7715975741c378c2bde82fdbcc89269e', '1C68wcackb7tcoza', 1, '2019-04-10T08:47:38Z', '2019-04-10T08:47:38Z');
INSERT INTO `rooms` VALUES (19426237, '3acb61a1acb3115b6f711b9f1d09db1a', 'vWxwkUP4IX8W39z9', 1, '2019-04-11T06:34:43Z', '2019-04-11T06:34:43Z');
INSERT INTO `rooms` VALUES (19426239, 'e91f56b4434e3b722f29ab53eba589b9', 'vWxwkUP4IX8W39z9', 1, '2019-04-11T06:45:53Z', '2019-04-11T06:45:53Z');
INSERT INTO `rooms` VALUES (19426240, '4c2049f1ebde52c30a464544ad275d98', 'cp1ZaexCZBuzGXyx', 1, '2019-04-11T07:44:16Z', '2019-04-11T07:44:16Z');
INSERT INTO `rooms` VALUES (19426362, '400bb14dc4bae8cf56d41cf60b362e01', 'sofD6DxHpdH2oSE9', 1, '2019-04-12T03:50:13Z', '2019-04-12T03:50:13Z');
INSERT INTO `rooms` VALUES (19426371, '6bbddf6c91623eb4c1e09cf4c5c4b063', 'vWxwkUP4IX8W39z9', 1, '2019-04-12T07:26:25Z', '2019-04-12T07:26:25Z');
INSERT INTO `rooms` VALUES (19426372, '5702aa7fbb92c5f6c862c118260d3980', 'vWxwkUP4IX8W39z9', 1, '2019-04-12T07:26:36Z', '2019-04-12T07:26:36Z');
INSERT INTO `rooms` VALUES (19426443, 'f6376876bb56eb4dbb4cb476ec83f5ff', 'vWxwkUP4IX8W39z9', 1, '2019-04-12T14:49:41Z', '2019-04-12T14:49:41Z');
INSERT INTO `rooms` VALUES (19426771, '7dbfadd5f8a744d047d6ce20c7ad8c77', 'lGNjVdT3pwTZ5X3A', 1, '2019-04-13T06:03:46Z', '2019-04-13T06:03:46Z');
INSERT INTO `rooms` VALUES (19427897, '7a0caec0dbb1ce8b939c071c059a1334', 'FETHgc8YfwHFlqEA', 1, '2019-04-19T04:08:01Z', '2019-04-19T04:08:01Z');
INSERT INTO `rooms` VALUES (19427919, 'ff649aa7d4ba9cc498f3d75a63020c32', 'm8tigGfral5MF5VU', 1, '2019-04-19T09:18:50Z', '2019-04-19T09:18:50Z');
INSERT INTO `rooms` VALUES (19427920, '981edd6cf4aebaad416740c85884c074', 'cp1ZaexCZBuzGXyx', 1, '2019-04-19T09:21:47Z', '2019-04-19T09:21:47Z');
INSERT INTO `rooms` VALUES (19427921, '633da8488907b85d1c0ee05691ec838c', 'taVXigK4QWYYCQeW', 1, '2019-04-19T09:22:44Z', '2019-04-19T09:22:44Z');
INSERT INTO `rooms` VALUES (19427922, 'da5ab7eb3b4e64e49c1f3db2563b7f52', 'taVXigK4QWYYCQeW', 1, '2019-04-19T09:23:32Z', '2019-04-19T09:23:32Z');
INSERT INTO `rooms` VALUES (19427925, '260a53856456c4b640661b9267823fab', 'NW7v30LTSqM9pRq4', 1, '2019-04-19T09:52:33Z', '2019-04-19T09:52:33Z');
INSERT INTO `rooms` VALUES (19427926, '260a53856456c4b640661b9267823fab', 'NW7v30LTSqM9pRq4', 1, '2019-04-19T09:52:34Z', '2019-04-19T09:52:34Z');
INSERT INTO `rooms` VALUES (19427927, 'd0008faa4c4590f8e00ab89e5a27fed1', 'zGUtgf4dGYlb6RAv', 1, '2019-04-19T10:03:50Z', '2019-04-19T10:03:50Z');
INSERT INTO `rooms` VALUES (19427928, '40c00e2b2fbf6003b2526775705d8f22', 'taVXigK4QWYYCQeW', 1, '2019-04-19T10:06:42Z', '2019-04-19T10:06:42Z');
INSERT INTO `rooms` VALUES (19427957, 'a16299fb427801661b8ad66e87072c1f', 'nZbDIxkxj6nb6x4p', 1, '2019-04-20T09:57:15Z', '2019-04-20T09:57:15Z');
INSERT INTO `rooms` VALUES (19427964, '0d04181707c05b9f42c10a18b24db8a5', 'WiLvd2Pt87JeM0Z3', 1, '2019-04-20T12:02:18Z', '2019-04-20T12:02:18Z');
INSERT INTO `rooms` VALUES (19428019, '1dc1efe2cc16ff2e43af3e61e68d63a9', 'ozOrWq2StwyzlAGe', 1, '2019-04-22T06:53:58Z', '2019-04-22T06:53:58Z');
INSERT INTO `rooms` VALUES (19428020, '2c2eae5461f27d3a503512b9e261b62a', 'ApdynuTlEC9tqBMh', 1, '2019-04-22T06:58:53Z', '2019-04-22T06:58:53Z');
INSERT INTO `rooms` VALUES (19428023, '409ac6e394416f6ddfa5ebad5ad1f425', '9SYqqzNgGJbAqMFd', 1, '2019-04-22T07:13:48Z', '2019-04-22T07:13:48Z');
INSERT INTO `rooms` VALUES (19428564, '63daaa1c7b0dd0b3236a0df75f930cdc', 'taVXigK4QWYYCQeW', 1, '2019-04-25T05:09:43Z', '2019-04-25T05:09:43Z');
INSERT INTO `rooms` VALUES (19428565, '52322795c295f18d9c80403418e39096', 'taVXigK4QWYYCQeW', 1, '2019-04-25T05:10:02Z', '2019-04-25T05:10:02Z');
INSERT INTO `rooms` VALUES (19428566, '6192fb2a6eedcb90f8b3f73b5bcb945c', 'taVXigK4QWYYCQeW', 1, '2019-04-25T05:10:05Z', '2019-04-25T05:10:05Z');
INSERT INTO `rooms` VALUES (19428567, 'faeca514e2bf0909a165f457c8bb1292', 'taVXigK4QWYYCQeW', 1, '2019-04-25T05:10:08Z', '2019-04-25T05:10:08Z');
INSERT INTO `rooms` VALUES (19428568, 'b031ad64ae92453a8d947622012ad943', 'taVXigK4QWYYCQeW', 1, '2019-04-25T05:10:11Z', '2019-04-25T05:10:11Z');
INSERT INTO `rooms` VALUES (19428571, '9db5d940135557ce245b56b656c24d7d', 'cp1ZaexCZBuzGXyx', 1, '2019-04-25T06:19:43Z', '2019-04-25T06:19:43Z');
INSERT INTO `rooms` VALUES (19428572, 'cfefe8eddfd3440e7e05d22db74abc74', 'JcGxgS1TEHhQ9fAp', 1, '2019-04-25T06:19:43Z', '2019-04-25T06:19:43Z');
INSERT INTO `rooms` VALUES (19428664, 'd9a8bc6b4c9882e1fd307c849f5424fd', 'aVOPqeRWZPqnTuHy', 1, '2019-04-26T06:43:04Z', '2019-04-26T06:43:04Z');
INSERT INTO `rooms` VALUES (19430256, '6c41bb242a86ae26e7a3e70505dd3e31', '9E3ZK5zW9sl9lbFU', 1, '2019-05-06T08:53:11Z', '2019-05-06T08:53:11Z');
INSERT INTO `rooms` VALUES (19430497, 'e7ecec235c74ce077092c61e8420de80', 'cp1ZaexCZBuzGXyx', 1, '2019-05-08T07:26:49Z', '2019-05-08T07:26:49Z');
INSERT INTO `rooms` VALUES (19430604, 'f4f8521d7ba8fca6e182f401159b807a', 'ZghoWAzr1Qi7aIRb', 1, '2019-05-09T03:13:21Z', '2019-05-09T03:13:21Z');
INSERT INTO `rooms` VALUES (19430607, 'c3aa2a0155e2fc4bc191fe7ad35563e1', 'taVXigK4QWYYCQeW', 1, '2019-05-09T03:23:01Z', '2019-05-09T03:23:01Z');
INSERT INTO `rooms` VALUES (19430609, '8b79172b3016818a0cc86b217c7de00b', 'taVXigK4QWYYCQeW', 1, '2019-05-09T03:40:39Z', '2019-05-09T03:40:39Z');
INSERT INTO `rooms` VALUES (19430612, '5ef96adbb4501c24c74cfab7181c8a1e', 'cp1ZaexCZBuzGXyx', 1, '2019-05-09T03:57:17Z', '2019-05-09T03:57:17Z');
INSERT INTO `rooms` VALUES (19430628, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:06:43Z', '2019-05-09T08:06:43Z');
INSERT INTO `rooms` VALUES (19430629, '02c1624abe6589d7fbd66b7d1fbb3054', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:08:41Z', '2019-05-09T08:08:41Z');
INSERT INTO `rooms` VALUES (19430630, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:09:17Z', '2019-05-09T08:09:17Z');
INSERT INTO `rooms` VALUES (19430631, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:12:03Z', '2019-05-09T08:12:03Z');
INSERT INTO `rooms` VALUES (19430632, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:15:29Z', '2019-05-09T08:15:29Z');
INSERT INTO `rooms` VALUES (19430633, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:24:18Z', '2019-05-09T08:24:18Z');
INSERT INTO `rooms` VALUES (19430635, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:26:13Z', '2019-05-09T08:26:13Z');
INSERT INTO `rooms` VALUES (19430636, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:34:35Z', '2019-05-09T08:34:35Z');
INSERT INTO `rooms` VALUES (19430637, '02c1624abe6589d7fbd66b7d1fbb3054', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:36:06Z', '2019-05-09T08:36:06Z');
INSERT INTO `rooms` VALUES (19430638, '40c00e2b2fbf6003b2526775705d8f22', 'vWxwkUP4IX8W39z9', 1, '2019-05-09T08:36:12Z', '2019-05-09T08:36:12Z');
INSERT INTO `rooms` VALUES (19430768, 'de42b68112afdcb00bfaf3273b4680d7', 'WiLvd2Pt87JeM0Z3', 1, '2019-05-10T07:02:55Z', '2019-05-10T07:02:55Z');
INSERT INTO `rooms` VALUES (19431167, '48c09076d5cfbb697ba7a8a4a3c89918', 'TiOxIz5rpyu7O4Bu', 1, '2019-05-11T06:57:08Z', '2019-05-11T06:57:08Z');
INSERT INTO `rooms` VALUES (19431185, 'e60e8431f0e81f7b41808464e68b3ef7', 'E8YmZwttugbTcCLc', 1, '2019-05-11T11:39:49Z', '2019-05-11T11:39:49Z');
INSERT INTO `rooms` VALUES (19431639, '2feafc26061cee7842a443be531a6f7c', '1F0pbpxhCzxn3uL0', 1, '2019-05-14T03:18:48Z', '2019-05-14T03:18:48Z');
INSERT INTO `rooms` VALUES (19432018, '2d1be2a55d8bf6216159d1f53c8854ff', 'qJFreLniGC59tMKe', 1, '2019-05-16T03:36:18Z', '2019-05-16T03:36:18Z');
INSERT INTO `rooms` VALUES (19432026, '0b3702dd64042fd34599a750a9ee0070', 'Gxakp7ZbxLqEVlnq', 1, '2019-05-16T07:14:40Z', '2019-05-16T07:14:40Z');
INSERT INTO `rooms` VALUES (19432031, '3383f8ddb74fc2d3354f9c182261f88c', 'NW7v30LTSqM9pRq4', 1, '2019-05-16T08:20:54Z', '2019-05-16T08:20:54Z');
INSERT INTO `rooms` VALUES (19432032, '61aaf309ff99f13df1451ca948d0d1c0', 'JcGxgS1TEHhQ9fAp', 1, '2019-05-16T08:37:29Z', '2019-05-16T08:37:29Z');
INSERT INTO `rooms` VALUES (19432033, '6a862d77edf6d569ee90920fc6451db8', '1C68wcackb7tcoza', 1, '2019-05-16T09:08:38Z', '2019-05-16T09:08:38Z');
INSERT INTO `rooms` VALUES (19432035, 'e8c9be0e0b2745b4da3afa54907e969c', 'Mkvg70CvcK7Bg476', 1, '2019-05-16T09:52:01Z', '2019-05-16T09:52:01Z');
INSERT INTO `rooms` VALUES (19432123, '8ba8cf385ad8a934eb2f94fb59380e52', 'E8YmZwttugbTcCLc', 1, '2019-05-17T10:06:10Z', '2019-05-17T10:06:10Z');
INSERT INTO `rooms` VALUES (19432236, 'd9ddbc7b791d35991da6123181601896', 'UZl6zaKwViu4c70B', 1, '2019-05-18T23:35:17Z', '2019-05-18T23:35:17Z');
INSERT INTO `rooms` VALUES (19432607, '035b398dd44539383463e731117be2b4', 'Mkvg70CvcK7Bg476', 1, '2019-05-22T11:06:17Z', '2019-05-22T11:06:17Z');
INSERT INTO `rooms` VALUES (19432712, '4b0b21c3e63ff60734e80e37e496e8a3', '2mrxxqnyGSL0iB00', 1, '2019-05-23T06:35:36Z', '2019-05-23T06:35:36Z');
INSERT INTO `rooms` VALUES (19432753, '38a446ea0af580a416cb5000edf20924', 'a4t71dtvloxjnH0a', 1, '2019-05-23T11:05:52Z', '2019-05-23T11:05:52Z');
INSERT INTO `rooms` VALUES (19433032, '096e8510c940cb1d788f19b2fb2eab5f', 'Gxakp7ZbxLqEVlnq', 1, '2019-05-25T07:38:19Z', '2019-05-25T07:38:19Z');
INSERT INTO `rooms` VALUES (19433345, '4fb8ebafe0e19a1a5a8822e8070f47a1', '5oC9rpnNjAluLrjE', 1, '2019-05-27T04:40:43Z', '2019-05-27T04:40:43Z');
INSERT INTO `rooms` VALUES (19433346, '77c39e7df56df6b1d4f66584f20f6355', '5oC9rpnNjAluLrjE', 1, '2019-05-27T04:40:50Z', '2019-05-27T04:40:50Z');
INSERT INTO `rooms` VALUES (19433347, '5de778c274c37c434992ba8d4817a730', '5oC9rpnNjAluLrjE', 1, '2019-05-27T04:40:56Z', '2019-05-27T04:40:56Z');
INSERT INTO `rooms` VALUES (19433349, 'a22cb74a7825c8fcc012f1c8d99ad3c2', '5oC9rpnNjAluLrjE', 1, '2019-05-27T04:44:12Z', '2019-05-27T04:44:12Z');
INSERT INTO `rooms` VALUES (19433350, '569bffa1e03d1105cfe4abffaf542bc1', 'PReCpr99DnMqNo8t', 1, '2019-05-27T05:01:47Z', '2019-05-27T05:01:47Z');
INSERT INTO `rooms` VALUES (19434332, '211bdfb6da0392edc4fb742e63462a06', 'SnzC9427UMbN27h7', 1, '2019-06-01T07:54:21Z', '2019-06-01T07:54:21Z');
INSERT INTO `rooms` VALUES (19434684, 'de9b1a6dcadb98db7999bccd3566eadd', 'hHOPSEz8sS3Cjc9A', 1, '2019-06-03T02:56:07Z', '2019-06-03T02:56:07Z');
INSERT INTO `rooms` VALUES (19434685, 'f4bacfbd78cd76e159e2c27b02eccf2e', '1XNTxUiqLZ297sT0', 1, '2019-06-03T03:41:25Z', '2019-06-03T03:41:25Z');
INSERT INTO `rooms` VALUES (19435066, '33bc4f5e6efdcc47b045cdb6e89f44dc', 'zOTEBSADcOT5UANa', 1, '2019-06-04T08:32:39Z', '2019-06-04T08:32:39Z');
INSERT INTO `rooms` VALUES (19435144, 'c1e28be646040876ec1ad6d71e52fb18', 'wrvkvvDcbgtaBFyT', 1, '2019-06-04T15:51:57Z', '2019-06-04T15:51:57Z');
INSERT INTO `rooms` VALUES (19436628, '35854cf1240de9df62c5388e7ab906c1', '00sbx0XnmHpvRa0u', 1, '2019-06-08T02:51:17Z', '2019-06-08T02:51:17Z');
INSERT INTO `rooms` VALUES (19436697, 'b27c00c778f9b5c5b273e74f430f0214', '00sbx0XnmHpvRa0u', 1, '2019-06-08T09:52:09Z', '2019-06-08T09:52:09Z');
INSERT INTO `rooms` VALUES (19436714, 'c3dfcc7d218722bdb905b3f060b743a0', '47seLtXc93HWrSi9', 1, '2019-06-08T11:06:06Z', '2019-06-08T11:06:06Z');
INSERT INTO `rooms` VALUES (19436872, 'b123f8db895a08105c26341770bfa156', 'nn2Y4VQvdhxvJ8kd', 1, '2019-06-10T01:05:05Z', '2019-06-10T01:05:05Z');
INSERT INTO `rooms` VALUES (19437205, '5366de5a9c076018eba67eb9b2145e56', 'Mkvg70CvcK7Bg476', 1, '2019-06-11T08:28:31Z', '2019-06-11T08:28:31Z');
INSERT INTO `rooms` VALUES (19440313, '850b136849ac263477b0d1f25deedefc', '9E3ZK5zW9sl9lbFU', 1, '2019-06-14T07:20:57Z', '2019-06-14T07:20:57Z');

SET FOREIGN_KEY_CHECKS = 1;
