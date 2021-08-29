/*
 Navicat Premium Data Transfer

 Source Server         : tp
 Source Server Type    : MySQL
 Source Server Version : 50651
 Source Host           : 192.168.109.143:3306
 Source Schema         : tpdata

 Target Server Type    : MySQL
 Target Server Version : 50651
 File Encoding         : 65001

 Date: 11/08/2021 14:06:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_table
-- ----------------------------
DROP TABLE IF EXISTS `tp_table`;
CREATE TABLE `tp_table`  (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `text` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tp_table
-- ----------------------------
INSERT INTO `tp_table` VALUES ('admin', 'c2d26f1f8b55bc39d604d1f674442a41', 'FLAG: green{admin\'s hash}');

SET FOREIGN_KEY_CHECKS = 1;
