/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : aldom_com_redx

 Target Server Type    : MariaDB
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 15/05/2025 21:30:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias`  (
  `Pk_categorias` int(5) NOT NULL DEFAULT 0,
  `Nombre_categoria` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_categorias`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES (1, 'Today');
INSERT INTO `categorias` VALUES (2, 'Next');
INSERT INTO `categorias` VALUES (3, 'Someday');
INSERT INTO `categorias` VALUES (4, 'Projects');
INSERT INTO `categorias` VALUES (5, 'Inbox');

-- ----------------------------
-- Table structure for grupo
-- ----------------------------
DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo`  (
  `Pk_Id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `Password_grupo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Nom_Grupo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `usuario` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_Id_grupo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grupo
-- ----------------------------
INSERT INTO `grupo` VALUES (1, 'RED', 'RED', 30);
INSERT INTO `grupo` VALUES (2, 'BLACK', 'BLACK', 30);
INSERT INTO `grupo` VALUES (3, 'OSEAS', 'OSEAS', 30);
INSERT INTO `grupo` VALUES (4, 'CHICOSCHE', 'CHICOSCHE', 30);
INSERT INTO `grupo` VALUES (5, 'WWW', 'WWW', 30);
INSERT INTO `grupo` VALUES (6, 'GANTZ', 'GANTZ', 30);
INSERT INTO `grupo` VALUES (7, 'ASM', 'ASM', 30);
INSERT INTO `grupo` VALUES (8, 'CHOCOLATE', 'CHOCOLATE', 30);
INSERT INTO `grupo` VALUES (9, 'MIO', 'MIO', 30);
INSERT INTO `grupo` VALUES (10, 'grupo 2', 'grupo 2', 32);

-- ----------------------------
-- Table structure for grupo_proyecto
-- ----------------------------
DROP TABLE IF EXISTS `grupo_proyecto`;
CREATE TABLE `grupo_proyecto`  (
  `Pk_clave` int(5) NOT NULL DEFAULT 0,
  `Fk_Id_grupo` int(5) NULL DEFAULT NULL,
  `Fk_clave_proyecto` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_clave`) USING BTREE,
  INDEX `Fktarea`(`Fk_Id_grupo`) USING BTREE,
  INDEX `Fkusuario`(`Fk_clave_proyecto`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grupo_proyecto
-- ----------------------------
INSERT INTO `grupo_proyecto` VALUES (1, 4, 3);
INSERT INTO `grupo_proyecto` VALUES (2, 5, 8);
INSERT INTO `grupo_proyecto` VALUES (3, 6, 7);
INSERT INTO `grupo_proyecto` VALUES (4, 6, 5);
INSERT INTO `grupo_proyecto` VALUES (5, 7, 3);
INSERT INTO `grupo_proyecto` VALUES (107, 10, 7);

-- ----------------------------
-- Table structure for proyecto
-- ----------------------------
DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE `proyecto`  (
  `Pk_clave_proyecto` int(5) NOT NULL AUTO_INCREMENT,
  `Nom_proyecto` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Decripcion_proyecto` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `usuario` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_clave_proyecto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyecto
-- ----------------------------
INSERT INTO `proyecto` VALUES (1, 'Instalacion de red', 'Se instalara una red de el centro de computo del ITVH', NULL);
INSERT INTO `proyecto` VALUES (2, 'Crar una pagina web', 'Se creara una pagina web tipo GTD', NULL);
INSERT INTO `proyecto` VALUES (3, 'Contaminacion del suelo', 'Se hara una investigacion de los contaminantes del suelo', NULL);
INSERT INTO `proyecto` VALUES (4, 'Construccion de pared', 'Se hara una investigacion hacerca de los materiales necesarios para contruir una pared', NULL);
INSERT INTO `proyecto` VALUES (5, 'calbleado esructurado', 'Se hara la instalacion de una red estrucctuada en un super mercado', NULL);
INSERT INTO `proyecto` VALUES (6, 'automatizacion itvh', 'Se automatizara la forma de recepcion de servicio social en el itvh', NULL);
INSERT INTO `proyecto` VALUES (7, 'Proyecto piloto', 'Es una prueba', 32);

-- ----------------------------
-- Table structure for proyecto_tareas
-- ----------------------------
DROP TABLE IF EXISTS `proyecto_tareas`;
CREATE TABLE `proyecto_tareas`  (
  `Pk_proyecto_tareas` int(5) NOT NULL DEFAULT 0,
  `Fk_clave_proyecto` int(5) NULL DEFAULT NULL,
  `Fk_tareas` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_proyecto_tareas`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyecto_tareas
-- ----------------------------

-- ----------------------------
-- Table structure for tarea
-- ----------------------------
DROP TABLE IF EXISTS `tarea`;
CREATE TABLE `tarea`  (
  `Pk_tarea` int(5) NOT NULL AUTO_INCREMENT,
  `Nom_tarea` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Fech_tarea` date NULL DEFAULT NULL,
  `Descripcion_tarea` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Fk_categorias` int(5) NULL DEFAULT NULL,
  `Energia` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `usuario` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_tarea`) USING BTREE,
  INDEX `Fk_categorias`(`Fk_categorias`) USING BTREE,
  CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`Fk_categorias`) REFERENCES `categorias` (`Pk_categorias`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tarea
-- ----------------------------
INSERT INTO `tarea` VALUES (1, 'comprar la despensa', NULL, 'ir al super y comprar la despensa de la quincena', 1, 'Media', 30);
INSERT INTO `tarea` VALUES (2, 'Otras cosas', '2025-05-16', 'Otras cosas', 1, 'Poco', 30);
INSERT INTO `tarea` VALUES (3, 'Prueba', '2025-05-16', 'Ejemplo', 1, 'Poco', 32);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `Pk_usuario` int(5) NOT NULL AUTO_INCREMENT,
  `Password` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Nombre` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Direccion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Municipio` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (30, '123', 'adriana', 'villahermosa', 'centro');
INSERT INTO `usuario` VALUES (31, '12', '12', '12', '12');
INSERT INTO `usuario` VALUES (32, '123', 'Aldo', 'Tabasco', 'Centro');

-- ----------------------------
-- Table structure for usuario_grupo
-- ----------------------------
DROP TABLE IF EXISTS `usuario_grupo`;
CREATE TABLE `usuario_grupo`  (
  `Pk_clave` int(5) NOT NULL DEFAULT 0,
  `Fk_Id_grupo` int(5) NULL DEFAULT NULL,
  `Fk_usuario` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Pk_clave`) USING BTREE,
  INDEX `Fkusuario`(`Fk_Id_grupo`) USING BTREE,
  INDEX `Fkproyecto`(`Fk_usuario`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario_grupo
-- ----------------------------
INSERT INTO `usuario_grupo` VALUES (1, 1, 1);
INSERT INTO `usuario_grupo` VALUES (2, 3, 1);
INSERT INTO `usuario_grupo` VALUES (3, 9, 2);
INSERT INTO `usuario_grupo` VALUES (4, 1, 3);
INSERT INTO `usuario_grupo` VALUES (5, 2, 2);
INSERT INTO `usuario_grupo` VALUES (6, 2, 3);
INSERT INTO `usuario_grupo` VALUES (7, 9, 4);
INSERT INTO `usuario_grupo` VALUES (130, 1, 30);
INSERT INTO `usuario_grupo` VALUES (132, 1, 32);
INSERT INTO `usuario_grupo` VALUES (832, 8, 32);

SET FOREIGN_KEY_CHECKS = 1;
