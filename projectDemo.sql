/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-11-17 20:55:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_role_id` int(11) NOT NULL COMMENT '后台角色id',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账号',
  `realname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '真实姓名',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'ip地址',
  `login_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登录时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1启用，2禁用',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', '1', 'Reer', 'Lin-reer', '1101588888@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '2019-11-17 17:50:10', '1', '2019-09-10 17:54:15', '2019-11-17 17:50:10');
INSERT INTO `admin` VALUES ('3', '3', 'Reer2', '123123', '123123@qq.com', '', '', '2019-09-18 19:47:37', '1', '2019-09-18 19:47:37', '2019-10-14 09:09:55');

-- ----------------------------
-- Table structure for admin_permission
-- ----------------------------
DROP TABLE IF EXISTS `admin_permission`;
CREATE TABLE `admin_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 NOT NULL COMMENT '权限名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级id 0为模块',
  `model` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模块名',
  `controller` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '控制器名',
  `action` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'f方法名',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '图标',
  `is_play` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否菜单显示 0否，1显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='客户权限表';

-- ----------------------------
-- Records of admin_permission
-- ----------------------------
INSERT INTO `admin_permission` VALUES ('1', '管理员管理', '0', 'admin', '', '', '&#xe70b;', '1', '4', '2019-10-13 23:50:42');
INSERT INTO `admin_permission` VALUES ('2', '管理员列表', '1', 'admin', 'Admin', 'userList', '', '1', '0', '2019-09-11 18:04:34');
INSERT INTO `admin_permission` VALUES ('3', '角色列表', '1', 'admin', 'AdminRole', 'roleList', '', '1', '1', '2019-09-11 18:04:42');
INSERT INTO `admin_permission` VALUES ('6', '权限列表', '1', 'admin', 'AdminPermission', 'permissionList', '', '1', '2', '2019-09-11 18:04:45');
INSERT INTO `admin_permission` VALUES ('7', '添加顶级权限', '6', 'admin', 'AdminPermission', 'addTopPermission', '', '1', '0', '2019-09-11 15:21:22');
INSERT INTO `admin_permission` VALUES ('8', '添加子权限', '6', 'admin', 'AdminPermission', 'addChildPermission', '', '1', '0', '2019-09-11 15:21:24');
INSERT INTO `admin_permission` VALUES ('9', '编辑权限节点', '6', 'admin', 'AdminPermission', 'editPermission', '', '1', '0', '2019-09-11 15:21:27');
INSERT INTO `admin_permission` VALUES ('10', '删除权限节点', '6', 'admin', 'AdminPermission', 'delPermission', '', '1', '0', '2019-09-11 15:21:28');
INSERT INTO `admin_permission` VALUES ('13', '添加管理员', '2', 'admin', 'Admin', 'addUser', '', '0', '0', '2019-09-11 15:21:33');
INSERT INTO `admin_permission` VALUES ('14', '添加角色', '3', 'admin', 'AdminRole', 'addRole', '', '0', '0', '2019-09-11 15:21:35');
INSERT INTO `admin_permission` VALUES ('15', '分配权限', '3', 'admin', 'AdminRole', 'allocationPermissions', '', '0', '0', '2019-09-11 15:21:37');
INSERT INTO `admin_permission` VALUES ('16', '修改角色', '3', 'admin', 'AdminRole', 'editRole', '', '0', '0', '2019-09-11 15:21:39');
INSERT INTO `admin_permission` VALUES ('17', '删除角色', '3', 'admin', 'AdminRole', 'delRole', '', '0', '0', '2019-09-11 15:21:41');
INSERT INTO `admin_permission` VALUES ('20', '编辑管理员', '2', 'admin', 'Admin', 'editUser', '', '0', '0', '2019-09-11 15:21:56');
INSERT INTO `admin_permission` VALUES ('21', '删除管理员', '2', 'admin', 'Admin', 'delUser', '', '0', '0', '2019-09-11 15:21:55');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '角色名称',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='客户角色表';

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('1', '超级管理员', '2019-09-10 17:53:04', '2019-09-10 17:53:01');
INSERT INTO `admin_role` VALUES ('3', '测试', '2019-09-16 15:47:42', '2019-09-16 15:47:45');

-- ----------------------------
-- Table structure for admin_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permission`;
CREATE TABLE `admin_role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_role_id` int(11) NOT NULL COMMENT '后台角色id、',
  `admin_permission_id` int(11) NOT NULL COMMENT '后台权限id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='客户角色权限表';

-- ----------------------------
-- Records of admin_role_permission
-- ----------------------------
INSERT INTO `admin_role_permission` VALUES ('1', '1', '1');
INSERT INTO `admin_role_permission` VALUES ('2', '1', '2');
INSERT INTO `admin_role_permission` VALUES ('3', '1', '3');
INSERT INTO `admin_role_permission` VALUES ('5', '1', '5');
INSERT INTO `admin_role_permission` VALUES ('6', '1', '6');
INSERT INTO `admin_role_permission` VALUES ('7', '1', '7');
INSERT INTO `admin_role_permission` VALUES ('8', '1', '8');
INSERT INTO `admin_role_permission` VALUES ('9', '1', '9');
INSERT INTO `admin_role_permission` VALUES ('10', '1', '10');
INSERT INTO `admin_role_permission` VALUES ('11', '1', '11');
INSERT INTO `admin_role_permission` VALUES ('12', '1', '12');
INSERT INTO `admin_role_permission` VALUES ('13', '1', '13');
INSERT INTO `admin_role_permission` VALUES ('14', '1', '14');
INSERT INTO `admin_role_permission` VALUES ('15', '1', '15');
INSERT INTO `admin_role_permission` VALUES ('16', '1', '16');
INSERT INTO `admin_role_permission` VALUES ('17', '1', '17');
INSERT INTO `admin_role_permission` VALUES ('18', '1', '18');
INSERT INTO `admin_role_permission` VALUES ('19', '1', '19');
INSERT INTO `admin_role_permission` VALUES ('20', '1', '20');
INSERT INTO `admin_role_permission` VALUES ('21', '1', '21');
INSERT INTO `admin_role_permission` VALUES ('166', '1', '54');
INSERT INTO `admin_role_permission` VALUES ('167', '1', '55');
INSERT INTO `admin_role_permission` VALUES ('168', '1', '56');
INSERT INTO `admin_role_permission` VALUES ('169', '1', '57');
INSERT INTO `admin_role_permission` VALUES ('170', '1', '58');
INSERT INTO `admin_role_permission` VALUES ('171', '1', '59');
INSERT INTO `admin_role_permission` VALUES ('172', '1', '60');
INSERT INTO `admin_role_permission` VALUES ('173', '1', '61');
INSERT INTO `admin_role_permission` VALUES ('174', '1', '62');
INSERT INTO `admin_role_permission` VALUES ('175', '1', '63');
INSERT INTO `admin_role_permission` VALUES ('176', '1', '64');
INSERT INTO `admin_role_permission` VALUES ('177', '3', '1');
INSERT INTO `admin_role_permission` VALUES ('178', '3', '6');
INSERT INTO `admin_role_permission` VALUES ('179', '3', '7');
INSERT INTO `admin_role_permission` VALUES ('180', '3', '8');
INSERT INTO `admin_role_permission` VALUES ('181', '3', '9');
INSERT INTO `admin_role_permission` VALUES ('182', '3', '10');
