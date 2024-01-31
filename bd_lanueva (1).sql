/*
 Navicat Premium Data Transfer

 Source Server         : Bases
 Source Server Type    : MySQL
 Source Server Version : 50173 (5.1.73-community)
 Source Host           : localhost:3306
 Source Schema         : bd_lanueva

 Target Server Type    : MySQL
 Target Server Version : 50173 (5.1.73-community)
 File Encoding         : 65001

 Date: 12/06/2023 23:55:12
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categoria_de_productos
-- ----------------------------
DROP TABLE IF EXISTS `categoria_de_productos`;
CREATE TABLE `categoria_de_productos`  (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_categoria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of categoria_de_productos
-- ----------------------------
INSERT INTO `categoria_de_productos` VALUES (13, 'Papas');
INSERT INTO `categoria_de_productos` VALUES (14, 'PRODUCTOS LIMPIEZA');

-- ----------------------------
-- Table structure for detalle_venta
-- ----------------------------
DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE `detalle_venta`  (
  `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` decimal(13, 0) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `precio_detalle_venta` double NOT NULL,
  `cantidad_detalle_venta` double NOT NULL,
  PRIMARY KEY (`id_detalle_venta`) USING BTREE,
  INDEX `fk_venta`(`id_venta`) USING BTREE,
  INDEX `id_producto`(`id_producto`) USING BTREE,
  CONSTRAINT `fk_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta_productos` (`id_venta`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of detalle_venta
-- ----------------------------
INSERT INTO `detalle_venta` VALUES (1, 765365, 1, 20, 20);

-- ----------------------------
-- Table structure for marca_productos
-- ----------------------------
DROP TABLE IF EXISTS `marca_productos`;
CREATE TABLE `marca_productos`  (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_marca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of marca_productos
-- ----------------------------
INSERT INTO `marca_productos` VALUES (1, 'Bar');
INSERT INTO `marca_productos` VALUES (2, '   Bonafont');

-- ----------------------------
-- Table structure for presentacion_productos
-- ----------------------------
DROP TABLE IF EXISTS `presentacion_productos`;
CREATE TABLE `presentacion_productos`  (
  `id_presentacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_presentacion` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_presentacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of presentacion_productos
-- ----------------------------
INSERT INTO `presentacion_productos` VALUES (1, 'en bolsado');
INSERT INTO `presentacion_productos` VALUES (2, 'EN BOTELLADO');
INSERT INTO `presentacion_productos` VALUES (3, 'EN BOTELLADO');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos`  (
  `id_producto` decimal(13, 0) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `costo_urinario` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `id_marca` int(11) NULL DEFAULT NULL,
  `id_categoria` int(11) NULL DEFAULT NULL,
  `id_precentacion` int(11) NULL DEFAULT NULL,
  `existencias` int(11) NOT NULL,
  `estatus` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_producto`) USING BTREE,
  INDEX `id_marca`(`id_marca`) USING BTREE,
  INDEX `id_categoria`(`id_categoria`) USING BTREE,
  INDEX `id_precentacion`(`id_precentacion`) USING BTREE,
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_de_productos` (`id_categoria`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `fk_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca_productos` (`id_marca`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `fk_presentacion` FOREIGN KEY (`id_precentacion`) REFERENCES `presentacion_productos` (`id_presentacion`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES (85, 'AGUA', 'simple', 25, 25, 1, 13, 1, 3, '0');
INSERT INTO `productos` VALUES (7653, 'papas', 'simple', 25, 25, 1, 13, 1, 100, '1');
INSERT INTO `productos` VALUES (765365, 'prueva', 'purueva ', 10, 10, 1, 13, 1, 1, '1');
INSERT INTO `productos` VALUES (7653256, 'AGUA', 'simple', 25, 25, 1, 13, 2, 7, '1');
INSERT INTO `productos` VALUES (76537884, 'AGUA', 'simple', 10, 25, 1, 13, 1, 10, '1');
INSERT INTO `productos` VALUES (765365565693, 'AGUA', 'simple', 25, 25, 1, 13, 1, 6, '1');
INSERT INTO `productos` VALUES (7513648956216, 'AGUA', 'simple', 25, 25, 1, 13, 1, 3, '1');
INSERT INTO `productos` VALUES (7528693249789, 'creama', 'crema depiladora', 20, 28, NULL, NULL, NULL, 2, '1');
INSERT INTO `productos` VALUES (7653655656565, 'AGUA', 'simple', 25, 25, 2, 13, 1, 1, '1');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `no_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apellido1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apellido2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contrasenia` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`no_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Jessica', 'Martinez', 'Jimenez', 'jessica@hotmail.com', 'Jessica', '12345');
INSERT INTO `usuarios` VALUES (2, 'IRVING JEREMY', 'MARTINEZ', 'AVILA', 'irvingjeremy.777@gmail.com', 'Jeremy1', '12345');
INSERT INTO `usuarios` VALUES (3, 'IRVING JEREMY', 'MARTINEZ', 'AVILA', 'irvingjeremy.777@gmail.com', 'Jeremy1', '5');
INSERT INTO `usuarios` VALUES (4, 'IRVING JEREMY', 'MARTINEZ', 'AVILA', 'irvingjeremy.777@gmail.com', 'Jeremy65745', '32332');

-- ----------------------------
-- Table structure for venta_productos
-- ----------------------------
DROP TABLE IF EXISTS `venta_productos`;
CREATE TABLE `venta_productos`  (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `total_venta` double NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_venta`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of venta_productos
-- ----------------------------
INSERT INTO `venta_productos` VALUES (1, 25, '2023-06-11');
INSERT INTO `venta_productos` VALUES (2, 60, '2023-06-11');
INSERT INTO `venta_productos` VALUES (3, 60, '2023-06-11');
INSERT INTO `venta_productos` VALUES (4, 70, '2023-06-12');
INSERT INTO `venta_productos` VALUES (5, 0, '2023-06-12');
INSERT INTO `venta_productos` VALUES (6, 25, '2023-06-12');
INSERT INTO `venta_productos` VALUES (7, 25, '2023-06-12');

-- ----------------------------
-- Procedure structure for actualizarProducto
-- ----------------------------
DROP PROCEDURE IF EXISTS `actualizarProducto`;
delimiter ;;
CREATE PROCEDURE `actualizarProducto`(IN productoId DECIMAL(13, 0),
  IN nuevoNombre VARCHAR(50),
  IN nuevaDescripcion VARCHAR(100),
  IN nuevoCostoUrinal INT(11),
  IN nuevoPrecioVenta INT(11),
  IN nuevaMarcaId INT(11),
  IN nuevaCategoriaId INT(11),
  IN nuevaPresentacionId INT(11),
  IN nuevasExistencias INT(11),
  IN nuevoEstatus CHAR(1))
BEGIN
  UPDATE productos
  SET nombre = nuevoNombre,
      descripcion = nuevaDescripcion,
      costo_urinario = nuevoCostoUrinal,
      precio_venta = nuevoPrecioVenta,
      id_marca = nuevaMarcaId,
      id_categoria = nuevaCategoriaId,
      id_precentacion = nuevaPresentacionId,
      existencias = nuevasExistencias,
      estatus = nuevoEstatus
  WHERE id_producto = productoId;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for actualizar_categoria
-- ----------------------------
DROP PROCEDURE IF EXISTS `actualizar_categoria`;
delimiter ;;
CREATE PROCEDURE `actualizar_categoria`(p_nombre_categoria VARCHAR(50),
p_id_categoria INT)
BEGIN
UPDATE categoria_de_productos SET
nombre_categoria = p_nombre_categoria
WHERE
id_categoria = p_id_categoria;
End
;;
delimiter ;

-- ----------------------------
-- Procedure structure for actualizar_presentacion
-- ----------------------------
DROP PROCEDURE IF EXISTS `actualizar_presentacion`;
delimiter ;;
CREATE PROCEDURE `actualizar_presentacion`(p_tipo_presentacion VARCHAR (50),
p_id_precentacion INT)
Begin 
update presentacion_productos SET 
tipo_presentacion = p_tipo_presentacion
Where 
id_precentacion = p_id_precentacion;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for actualizar_productos
-- ----------------------------
DROP PROCEDURE IF EXISTS `actualizar_productos`;
delimiter ;;
CREATE PROCEDURE `actualizar_productos`(p_nombre varchar(50),
  p_descripcion varchar(100),
  p_costo_urinario int(11),
  p_precio_venta int(11),
  p_nombre_marca varchar(50),
  p_nombre_categoria varchar(50),
  p_tipo_presentacion varchar(50),
  p_existencias int(11),
p_id_producto decimal(13,0))
BEGIN
  DECLARE v_id_marca INT;
  DECLARE v_id_categoria INT;
  DECLARE v_id_presentacion INT;

  SELECT id_marca INTO v_id_marca FROM marca_productos WHERE nombre_marca = p_nombre_marca LIMIT 1;
  SELECT id_categoria INTO v_id_categoria FROM categoria_de_productos WHERE nombre_categoria = p_nombre_categoria LIMIT 1;
  SELECT id_presentacion INTO v_id_presentacion FROM presentacion_productos WHERE tipo_presentacion = p_tipo_presentacion LIMIT 1;

  UPDATE productos SET
    nombre = p_nombre,
    descripcion = p_descripcion,
    costo_urinario = p_costo_urinario,
    precio_venta = p_precio_venta,
    id_marca = v_id_marca,
    id_categoria = v_id_categoria,
    id_precentacion = v_id_presentacion,
    existencias = p_existencias
  WHERE
    id_producto = p_id_producto;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for actuliazar_marca
-- ----------------------------
DROP PROCEDURE IF EXISTS `actuliazar_marca`;
delimiter ;;
CREATE PROCEDURE `actuliazar_marca`(p_nombre_marca VARCHAR(50),
p_id_marca INT)
begin
UPDATE marca_productos SET
nombre_marca = p_nombre_marca
WHERE 
id_marca = p_id_marca;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for agrega_cate
-- ----------------------------
DROP PROCEDURE IF EXISTS `agrega_cate`;
delimiter ;;
CREATE PROCEDURE `agrega_cate`(p_nombre_categoria VARCHAR(50))
BEGIN
INSERT categoria_de_productos VALUES(
DEFAULT,
p_nombre_categoria);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for agrega_marca
-- ----------------------------
DROP PROCEDURE IF EXISTS `agrega_marca`;
delimiter ;;
CREATE PROCEDURE `agrega_marca`(p_nombre_marca VARCHAR(50))
BEGIN
INSERT marca_productos VALUES(
DEFAULT,
p_nombre_marca);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for agrega_presenta
-- ----------------------------
DROP PROCEDURE IF EXISTS `agrega_presenta`;
delimiter ;;
CREATE PROCEDURE `agrega_presenta`(p_tipo_presentacion VARCHAR(50))
BEGIN
INSERT presentacion_productos VALUES(
DEFAULT,
p_tipo_presentacion);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for agrega_productos
-- ----------------------------
DROP PROCEDURE IF EXISTS `agrega_productos`;
delimiter ;;
CREATE PROCEDURE `agrega_productos`(p_id_producto decimal(13,0),
  p_nombre varchar(50) ,
  p_descripcion varchar(100) ,
  p_costo_urinario int(11) ,
  p_precio_venta int(11) ,
  p_nombre_marca varchar(50) ,
  p_nombre_categoria varchar(50),
  p_tipo_presentacion varchar(50),
p_existencias int(11),
p_estatus char(1))
BEGIN
INSERT productos VALUES (
p_id_producto , p_nombre , p_descripcion, p_costo_urinario, p_precio_venta,
(SELECT id_marca FROM marca_productos WHERE nombre_marca = p_nombre_marca LIMIT 1),
(SELECT id_categoria FROM categoria_de_productos WHERE nombre_categoria = p_nombre_categoria LIMIT 1),
(SELECT id_presentacion FROM presentacion_productos WHERE tipo_presentacion = p_tipo_presentacion LIMIT 1),
p_existencias,
p_estatus
);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for eliminar_producto
-- ----------------------------
DROP PROCEDURE IF EXISTS `eliminar_producto`;
delimiter ;;
CREATE PROCEDURE `eliminar_producto`(eliminar_id_producto decimal(13,0))
BEGIN
UPDATE productos SET productos.estatus = 0
WHERE productos.id_producto = eliminar_id_producto;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
