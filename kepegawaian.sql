/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : kepegawaian

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-01-09 23:21:45
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `bagian`
-- ----------------------------
DROP TABLE IF EXISTS `bagian`;
CREATE TABLE `bagian` (
  `id_bag` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_bagian` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_bag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bagian
-- ----------------------------
INSERT INTO `bagian` VALUES ('1', 'HRD');
INSERT INTO `bagian` VALUES ('2', 'IT');
INSERT INTO `bagian` VALUES ('3', 'Pemasaran');
INSERT INTO `bagian` VALUES ('4', 'Warehouse');

-- ----------------------------
-- Table structure for `pegawai`
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id_peg` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` char(10) NOT NULL,
  `id_bag` tinyint(5) unsigned NOT NULL,
  `nm_lengkap` varchar(50) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `ktp` char(16) NOT NULL,
  `lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `telp` char(14) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('Aktif','Tidak') NOT NULL DEFAULT 'Aktif',
  `foto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_peg`),
  UNIQUE KEY `nip` (`nip`),
  KEY `id_bag` (`id_bag`),
  CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_bag`) REFERENCES `bagian` (`id_bag`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES ('1', '10001', '3', 'Cahyaning', 'Sekretaris', '1234567890', 'Jakarta', '1990-01-09', 'P', '021987654321', 'Islam', 'Jl. Moh Kahfi I', 'Aktif', '10001.jpg');
INSERT INTO `pegawai` VALUES ('2', '10002', '2', 'Octavian Tri Wibowo', 'Manajer', '99999912213', 'Jakarta', '1992-02-20', 'L', '9898998989', 'Islam', 'Jl. Ciledug', 'Aktif', '10002.jpg');

-- ----------------------------
-- Table structure for `pegawai_copy`
-- ----------------------------
DROP TABLE IF EXISTS `pegawai_copy`;
CREATE TABLE `pegawai_copy` (
  `id_peg` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` char(10) NOT NULL,
  `id_bag` tinyint(5) unsigned NOT NULL,
  `nm_lengkap` varchar(50) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `ktp` char(16) NOT NULL,
  `lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `telp` char(14) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('Aktif','Tidak') NOT NULL DEFAULT 'Aktif',
  `foto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_peg`),
  UNIQUE KEY `nip` (`nip`),
  KEY `id_bag` (`id_bag`),
  CONSTRAINT `pegawai_copy_ibfk_1` FOREIGN KEY (`id_bag`) REFERENCES `bagian` (`id_bag`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pegawai_copy
-- ----------------------------
INSERT INTO `pegawai_copy` VALUES ('1', '10001', '3', 'Cahyaning', 'Sekretaris', '1234567890', 'Jakarta', '1990-01-09', 'P', '021987654321', 'Islam', 'Jl. Moh Kahfi I', 'Aktif', '10001.jpg');
INSERT INTO `pegawai_copy` VALUES ('2', '10002', '2', 'Octavian Tri Wibowo', 'Manajer', '99999912213', 'Jakarta', '1992-02-20', 'L', '9898998989', 'Islam', 'Jl. Ciledug', 'Aktif', '10002.jpg');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','User') NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin');
INSERT INTO `users` VALUES ('2', 'user', '12dea96fec20593566ab75692c9949596833adc9', 'User');
