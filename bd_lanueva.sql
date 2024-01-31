-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-06-2023 a las 05:23:28
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_lanueva`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `actualizarProducto` (IN `productoId` DECIMAL(13,0), IN `nuevoNombre` VARCHAR(50), IN `nuevaDescripcion` VARCHAR(100), IN `nuevoCostoUrinal` INT(11), IN `nuevoPrecioVenta` INT(11), IN `nuevaMarcaId` INT(11), IN `nuevaCategoriaId` INT(11), IN `nuevaPresentacionId` INT(11), IN `nuevasExistencias` INT(11), IN `nuevoEstatus` CHAR(1))   BEGIN
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
END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `actualizar_categoria` (`p_nombre_categoria` VARCHAR(50), `p_id_categoria` INT)   BEGIN
UPDATE categoria_de_productos SET
nombre_categoria = p_nombre_categoria
WHERE
id_categoria = p_id_categoria;
End$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `actualizar_presentacion` (`p_tipo_presentacion` VARCHAR(50), `p_id_precentacion` INT)   Begin 
update presentacion_productos SET 
tipo_presentacion = p_tipo_presentacion
Where 
id_precentacion = p_id_precentacion;
END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `actualizar_productos` (`p_nombre` VARCHAR(50), `p_descripcion` VARCHAR(100), `p_costo_urinario` INT(11), `p_precio_venta` INT(11), `p_nombre_marca` VARCHAR(50), `p_nombre_categoria` VARCHAR(50), `p_tipo_presentacion` VARCHAR(50), `p_existencias` INT(11), `p_id_producto` DECIMAL(13,0))   BEGIN
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
END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `actuliazar_marca` (`p_nombre_marca` VARCHAR(50), `p_id_marca` INT)   begin
UPDATE marca_productos SET
nombre_marca = p_nombre_marca
WHERE 
id_marca = p_id_marca;
END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `agrega_cate` (`p_nombre_categoria` VARCHAR(50))   BEGIN
	INSERT categoria_de_productos VALUES(
	DEFAULT,
	p_nombre_categoria);
	END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `agrega_marca` (`p_nombre_marca` VARCHAR(50))   BEGIN
	INSERT marca_productos VALUES(
	DEFAULT,
	p_nombre_marca);
	END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `agrega_presenta` (`p_tipo_presentacion` VARCHAR(50))   BEGIN
	INSERT presentacion_productos VALUES(
	DEFAULT,
	p_tipo_presentacion);
	END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `agrega_productos` (`p_id_producto` DECIMAL(13,0), `p_nombre` VARCHAR(50), `p_descripcion` VARCHAR(100), `p_costo_urinario` INT(11), `p_precio_venta` INT(11), `p_nombre_marca` VARCHAR(50), `p_nombre_categoria` VARCHAR(50), `p_tipo_presentacion` VARCHAR(50), `p_existencias` INT(11), `p_estatus` CHAR(1))   BEGIN
INSERT productos VALUES (
p_id_producto , p_nombre , p_descripcion, p_costo_urinario, p_precio_venta,
(SELECT id_marca FROM marca_productos WHERE nombre_marca = p_nombre_marca LIMIT 1),
(SELECT id_categoria FROM categoria_de_productos WHERE nombre_categoria = p_nombre_categoria LIMIT 1),
(SELECT id_presentacion FROM presentacion_productos WHERE tipo_presentacion = p_tipo_presentacion LIMIT 1),
p_existencias,
p_estatus
);
END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `eliminar_producto` (`eliminar_id_producto` DECIMAL(13,0))   BEGIN
UPDATE productos SET productos.estatus = 0
WHERE productos.id_producto = eliminar_id_producto;
END$$

CREATE DEFINER=`id20904610_userlanueva`@`localhost` PROCEDURE `insertarUsuario` (`p_nombre` VARCHAR(70), `p_apellido1` VARCHAR(50), `p_apellido2` VARCHAR(50), `p_email` VARCHAR(100), `p_usuario` VARCHAR(50), `p_contraseña` VARCHAR(15))   BEGIN
INSERT usuario VALUES ( 
DEFAULT, 
p_nombre,
p_apellido1,
p_apellido2,
p_email, 
p_usuario,
p_contraseña
);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_de_productos`
--

CREATE TABLE `categoria_de_productos` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `categoria_de_productos`
--

INSERT INTO `categoria_de_productos` (`id_categoria`, `nombre_categoria`) VALUES
(13, 'Papas'),
(14, 'PRODUCTOS LIMPIEZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` bigint(20) UNSIGNED NOT NULL,
  `id_producto` decimal(13,0) NOT NULL,
  `cantidad` bigint(20) UNSIGNED NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_productos`
--

CREATE TABLE `marca_productos` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion_productos`
--

CREATE TABLE `presentacion_productos` (
  `id_presentacion` int(11) NOT NULL,
  `tipo_presentacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` decimal(13,0) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `costo_urinario` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_precentacion` int(11) DEFAULT NULL,
  `existencias` int(11) NOT NULL,
  `estatus` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `no_usuario` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`no_usuario`, `nombre`, `apellido1`, `apellido2`, `email`, `usuario`, `contraseña`) VALUES
(1, 'Jessica', 'Martinez', 'Jimenez', 'jessica@hotmail.com', 'Jessica', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_productos`
--

CREATE TABLE `venta_productos` (
  `id_venta` int(11) NOT NULL,
  `total_venta` double NOT NULL,
  `fecha` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_de_productos`
--
ALTER TABLE `categoria_de_productos`
  ADD PRIMARY KEY (`id_categoria`) USING BTREE;

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `marca_productos`
--
ALTER TABLE `marca_productos`
  ADD PRIMARY KEY (`id_marca`) USING BTREE;

--
-- Indices de la tabla `presentacion_productos`
--
ALTER TABLE `presentacion_productos`
  ADD PRIMARY KEY (`id_presentacion`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`) USING BTREE,
  ADD KEY `id_marca` (`id_marca`) USING BTREE,
  ADD KEY `id_categoria` (`id_categoria`) USING BTREE,
  ADD KEY `id_precentacion` (`id_precentacion`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`no_usuario`) USING BTREE;

--
-- Indices de la tabla `venta_productos`
--
ALTER TABLE `venta_productos`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_de_productos`
--
ALTER TABLE `categoria_de_productos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `marca_productos`
--
ALTER TABLE `marca_productos`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `presentacion_productos`
--
ALTER TABLE `presentacion_productos`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `no_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta_productos`
--
ALTER TABLE `venta_productos`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `venta_productos` (`id_venta`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_de_productos` (`id_categoria`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca_productos` (`id_marca`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_presentacion` FOREIGN KEY (`id_precentacion`) REFERENCES `presentacion_productos` (`id_presentacion`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
