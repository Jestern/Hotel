-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2016 at 10:47 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sibw`
--

-- --------------------------------------------------------

--
-- Table structure for table `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
  `tituloPagina` varchar(100) DEFAULT NULL,
  `nombreActividad` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` double NOT NULL,
  `divisa` varchar(10) NOT NULL,
  `video` varchar(300) NOT NULL,
  `ref` varchar(10) NOT NULL,
  UNIQUE KEY `nombreActividad` (`nombreActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Actividad`
--

INSERT INTO `Actividad` (`tituloPagina`, `nombreActividad`, `descripcion`, `precio`, `divisa`, `video`, `ref`) VALUES
('ACTIVIDADES', 'EXCURSIÓN A SIERRA NEVADA', 'Programa  en el que podrán disfrutar de un día completo en Sierra Nevada. Combina la vertiente educativa y cultural, dentro de la montaña y divertidas actividades de ocio.<br><br>Por la mañana se proyectará un video para conocer el medio en el que nos vamos a mover durante un día. Más tarde visitaremos la zona de Fuente Alta, el museo etnográfico, y elaboraremos tortas y té casero de Sierra Nevada. Aquí podremos conocer la forma de vida de nuestros antepasados en la montaña. Disfrutaremos de las actividades de la zona del Mirlo Blanco durante dos horas y media.<br><br><span class="resaltar">Incluye:</span> Guía, presentación de vídeo, visita natural vivero, visita de prácticas Fuente Alta, Actividades Mirlo Blanco. Picnic o merienda opcional.<br><br><span class="resaltar">Precio por persona:</span> $1', 50, '€', 'https://www.youtube.com/watch?v=586P7egqYHo', 'sierra'),
('ACTIVIDADES', 'VISITA A LA ALHAMBRA', 'La Alhambra no es sólo el mayor tesoro arquitectónico de España, si no también una de las maravillas del mundo. En un primer momento puede que nos sorprenda como lo haría el Taj Mahal o una gran pirámide, pero tan pronto como uno se adentra en ella y deja atrás su austero exterior; La Alhambra revela una maravilla de fuentes musicales, jardines artificiosas y palacios finamente talladas.<br><br>Su construcción se inició en el siglo 11 en la colina roja conocida como Assabika, y ofrece unas bellas vistas hacia Granada. La fortaleza de la Alcazaba fue la primera estructura construida, seguido por el Palacio Real y la residencia de los miembros de la corte.<br><br>La Alhambra sigue trabajando para hacer más accesible el Monumento. Por este motivo, hemos instalado unos "Puntos táctiles" en el itinerario de visita pública para que personas con discapacidad visual y también el resto de los visitantes puedan percibir con el tacto las características y los detalles de los elementos que decoran el Conjunto Monumental. De esta manera, participarán en la conservación  preventiva del Monumento.<br><br><span class="resaltar">Incluye:</span> Recogida, ida y vuelta, en bus en el hotel, azafata acompañante, entradas al monumento y guía oficial.<br><br><span class="resaltar">Duración:</span> Aproximadamente 3 h.<br><br><span class="resaltar">Horario:</span> Según disponibilidad a la hora de la reserva.<br><br><span class="resaltar">Precio por persona:</span> $1', 14, '€', 'https://www.youtube.com/watch?v=UAdH7VSmhaE', 'alhambra');

-- --------------------------------------------------------

--
-- Table structure for table `Administrador`
--

CREATE TABLE IF NOT EXISTS `Administrador` (
  `hotel` varchar(20) NOT NULL,
  `nombreUsuario` varchar(80) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(80) NOT NULL,
  UNIQUE KEY `nombreUsuario` (`nombreUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Administrador`
--

INSERT INTO `Administrador` (`hotel`, `nombreUsuario`, `password`, `email`) VALUES
('HOTEL PLAZA NUEVA', 'admin', 'admin', 'admin1@hotelplazanueva.hopto.org');

-- --------------------------------------------------------

--
-- Table structure for table `AsideContacto`
--

CREATE TABLE IF NOT EXISTS `AsideContacto` (
  `menu` varchar(80) NOT NULL,
  `idioma` varchar(10) NOT NULL,
  `reservas` varchar(80) NOT NULL,
  `contacto` varchar(80) NOT NULL,
  `promociones` varchar(80) NOT NULL,
  UNIQUE KEY `idioma` (`idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AsideContacto`
--

INSERT INTO `AsideContacto` (`menu`, `idioma`, `reservas`, `contacto`, `promociones`) VALUES
('Menú', 'es', 'Reservar', 'Contacto', 'PROMOCIONES');

-- --------------------------------------------------------

--
-- Table structure for table `Cabecera`
--

CREATE TABLE IF NOT EXISTS `Cabecera` (
  `tituloCabecera` varchar(80) NOT NULL,
  `inicioSesion` varchar(80) NOT NULL,
  `registrarse` varchar(80) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `contrasenia` varchar(80) NOT NULL,
  `msgIniciado` varchar(80) NOT NULL,
  `hotel` varchar(20) NOT NULL,
  UNIQUE KEY `tituloCabecera` (`tituloCabecera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cabecera`
--

INSERT INTO `Cabecera` (`tituloCabecera`, `inicioSesion`, `registrarse`, `usuario`, `contrasenia`, `msgIniciado`, `hotel`) VALUES
('HOTEL PLAZA NUEVA', 'Iniciar Sesión', 'Registrese', 'Nombre de usuario', 'Contraseña', 'Bienvenido $1.', 'HOTEL PLAZA NUEVA');

-- --------------------------------------------------------

--
-- Table structure for table `Cliente`
--

CREATE TABLE IF NOT EXISTS `Cliente` (
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `identificacion` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `numeroTlf` varchar(20) NOT NULL,
  `hotel` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  UNIQUE KEY `identificacion` (`identificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cliente`
--

INSERT INTO `Cliente` (`nombre`, `apellidos`, `identificacion`, `email`, `numeroTlf`, `hotel`, `direccion`) VALUES
('  elias', 'mendez', '11111111j', 'eilagomez@hotmail.com', '622936800', 'HOTEL PLAZA NUEVA', 'C/san Salvador'),
('  Eladio', 'Garví', '12322565u', 'egarvi@ugr.es', '652369645', 'HOTEL PLAZA NUEVA', 'ETS'),
('  eila', 'gomez', '75757575', 'eilagomez@hotmail.com', '622936800', 'HOTEL PLAZA NUEVA', 'C/san Salvador');

-- --------------------------------------------------------

--
-- Table structure for table `ClienteRegistrado`
--

CREATE TABLE IF NOT EXISTS `ClienteRegistrado` (
  `usuario` varchar(80) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `identificacion` varchar(80) NOT NULL,
  UNIQUE KEY `identificacion` (`identificacion`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Contacto`
--

CREATE TABLE IF NOT EXISTS `Contacto` (
  `idioma` varchar(80) NOT NULL,
  `tlf` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `fax` varchar(80) NOT NULL,
  `dir` varchar(250) NOT NULL,
  UNIQUE KEY `infoContacto` (`idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contacto`
--

INSERT INTO `Contacto` (`idioma`, `tlf`, `email`, `fax`, `dir`) VALUES
('es', 'Teléfono', 'E-mail', 'Fax', 'Dirección');

-- --------------------------------------------------------

--
-- Table structure for table `Formulario`
--

CREATE TABLE IF NOT EXISTS `Formulario` (
  `tituloPagina` varchar(100) NOT NULL,
  `tlf` varchar(20) NOT NULL,
  `nombreApellidos` varchar(20) NOT NULL,
  `camposObligatorios` varchar(200) NOT NULL,
  `txtBoton` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `msg` varchar(20) NOT NULL,
  UNIQUE KEY `tituloPagina` (`tituloPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Formulario`
--

INSERT INTO `Formulario` (`tituloPagina`, `tlf`, `nombreApellidos`, `camposObligatorios`, `txtBoton`, `email`, `msg`) VALUES
('FORMULARIO DE CONTACTO', 'Teléfono de contacto', 'Nombre y apellidos*', 'Los campos señalados con * son obligatorios.', 'Enviar', 'E-mail*', 'Mensaje*');

-- --------------------------------------------------------

--
-- Table structure for table `FormularioRegistro`
--

CREATE TABLE IF NOT EXISTS `FormularioRegistro` (
  `Usuario` varchar(80) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Apellidos` varchar(80) NOT NULL,
  `Contrasenia` varchar(80) NOT NULL,
  `ContraseniaRep` varchar(80) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `Identificacion` varchar(80) NOT NULL,
  `Tlf` varchar(80) NOT NULL,
  `Boton` varchar(80) NOT NULL,
  `tituloPagina` varchar(80) NOT NULL,
  `camposObligatorios` text NOT NULL,
  `tarjeta` varchar(40) NOT NULL,
  UNIQUE KEY `tituloPagina` (`tituloPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FormularioRegistro`
--

INSERT INTO `FormularioRegistro` (`Usuario`, `Nombre`, `Apellidos`, `Contrasenia`, `ContraseniaRep`, `Email`, `Direccion`, `Identificacion`, `Tlf`, `Boton`, `tituloPagina`, `camposObligatorios`, `tarjeta`) VALUES
('Usuario*', 'Nombre*', 'Apellidos*', 'Contraseña*', 'Repetir contraseña*', 'Email*', 'Dirección*', 'DNI o Pasaporte*', 'Teléfono*', 'Registrarse', 'REGISTRO DE USARIO', 'Los campos señalados con * son obligatorios.', 'Número de tarjeta*');

-- --------------------------------------------------------

--
-- Table structure for table `FormularioReserva`
--

CREATE TABLE IF NOT EXISTS `FormularioReserva` (
  `hotel` varchar(20) NOT NULL,
  `tituloReserva` varchar(20) NOT NULL,
  `fechaEntrada` varchar(50) NOT NULL,
  `fechaSalida` varchar(50) NOT NULL,
  `adultos` varchar(50) NOT NULL,
  `nAdultos` int(11) NOT NULL,
  `ninios` varchar(50) NOT NULL,
  `nNinios` int(11) NOT NULL,
  `botonBuscar` varchar(50) NOT NULL,
  UNIQUE KEY `hotel` (`hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FormularioReserva`
--

INSERT INTO `FormularioReserva` (`hotel`, `tituloReserva`, `fechaEntrada`, `fechaSalida`, `adultos`, `nAdultos`, `ninios`, `nNinios`, `botonBuscar`) VALUES
('HOTEL PLAZA NUEVA', 'Realiza tu reserva', 'Fecha de entrada', 'Fecha de salida', 'Nº de adultos', 2, 'Nº de niños', 2, 'Buscar');

-- --------------------------------------------------------

--
-- Table structure for table `Habitacion`
--

CREATE TABLE IF NOT EXISTS `Habitacion` (
  `tipo` varchar(80) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL,
  `precioDesayuno` double NOT NULL,
  `precioFestivos` double NOT NULL,
  `descripcionHabitacion` text NOT NULL,
  `idioma` varchar(10) NOT NULL,
  `divisa` varchar(4) NOT NULL,
  `pax` int(11) NOT NULL,
  `idImagen` varchar(20) NOT NULL,
  `hotel` varchar(20) NOT NULL,
  `ref` varchar(10) NOT NULL,
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Habitacion`
--

INSERT INTO `Habitacion` (`tipo`, `cantidad`, `precio`, `precioDesayuno`, `precioFestivos`, `descripcionHabitacion`, `idioma`, `divisa`, `pax`, `idImagen`, `hotel`, `ref`) VALUES
('HABITACIÓN DOBLE', 25, 49, 10, 86, 'En nuestras habitaciones standard disfrutará de todo el equipamiento y comodidades que su estancia en Granada merece. La habitación cuenta con dos camas o cama de matrimonio según disponibilidad. <br><br>Desde $1 por noche.', 'es', '€', 2, 'h_doble', 'HOTEL PLAZA NUEVA', 'doble'),
('HABITACIÓN INDIVIDUAL', 5, 30, 10, 72, 'Habitación interior con cama individual de 90 cm.<br><br>\r\nDesde $1 por noche.', 'es', '€', 1, 'h_individual', 'HOTEL PLAZA NUEVA', 'individual'),
('HABITACIÓN TRIPLE', 25, 49, 10, 86, 'En nuestras habitaciones triples podrá disfrutar de sus vacaciones en familia o con amigos en el centro de Granada. Tiene dos camas o una cama de matrimonio según disponibilidad, la tercera cama es una cama supletoria. <br><br> Desde $1 por noche.', 'es', '€', 3, 'h_triple', 'HOTEL PLAZA NUEVA', 'triple'),
('SUITE', 2, 100, 10, 148, 'Esta amplia habitación cuenta con una amplia zona de estar y una terraza privada con vistas a la ciudad de Granada.\r\n<br><br>\r\nDesde $1 por noche.<br>', 'es', '€', 4, 'h_suite', 'HOTEL PLAZA NUEVA', 'suite');

-- --------------------------------------------------------

--
-- Table structure for table `Hotel`
--

CREATE TABLE IF NOT EXISTS `Hotel` (
  `hotel` varchar(20) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `numeroTel` varchar(20) NOT NULL,
  `numeroFax` varchar(20) NOT NULL,
  UNIQUE KEY `hotel` (`hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Hotel`
--

INSERT INTO `Hotel` (`hotel`, `direccion`, `NIF`, `correo`, `numeroTel`, `numeroFax`) VALUES
('HOTEL PLAZA NUEVA', 'Imprenta, nº 2. 18010 Granada, Granada, España', '58964525J', 'info@hotel-plazanueva.com', '+34 958 215 273', '+34 958 225 765');

-- --------------------------------------------------------

--
-- Table structure for table `Imagen`
--

CREATE TABLE IF NOT EXISTS `Imagen` (
  `idImagen` varchar(20) NOT NULL,
  `path` varchar(300) NOT NULL,
  UNIQUE KEY `idImagen` (`idImagen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Imagen`
--

INSERT INTO `Imagen` (`idImagen`, `path`) VALUES
('AC', '/images/AC.png'),
('acceso', '/images/acceso.png'),
('al1', '/images/al1.jpg'),
('al2', '/images/al2.jpg'),
('al3', '/images/al3.jpg'),
('al4', '/images/al4.jpg'),
('bar', '/images/bar.png'),
('entorno', '/images/entorno.jpg'),
('equipaje', '/images/equipaje.png'),
('facebook', '/images/facebook.png'),
('fachada', '/images/fachada.jpg'),
('google', '/images/google.png'),
('habitacion', '/images/habitacion.jpg'),
('h_doble', '/images/h_doble.png'),
('h_individual', '/images/h_individual.jpg'),
('h_suite', '/images/h_suite.png'),
('h_triple', '/images/h_triple.png'),
('logo', '/images/logo.png'),
('parking', '/images/parking.png'),
('recepcion', '/images/recepcion.png'),
('servicioh', '/images/servicioh.png'),
('sierra1', '/images/sierra1.jpg'),
('sierra2', '/images/sierra2.jpg'),
('sierra3', '/images/sierra3.jpg'),
('sierra4', '/images/sierra4.jpg'),
('slide_1', '/images/slide_1.jpg'),
('slide_2', '/images/slide_2.png'),
('slide_3', '/images/slide_3.jpg'),
('twitter', '/images/twitter.png'),
('wifi', '/images/wifi.png');

-- --------------------------------------------------------

--
-- Table structure for table `ImagenesActividad`
--

CREATE TABLE IF NOT EXISTS `ImagenesActividad` (
  `idImagen` varchar(20) NOT NULL,
  `nombreActividad` varchar(80) NOT NULL,
  UNIQUE KEY `idImagen` (`idImagen`,`nombreActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ImagenesActividad`
--

INSERT INTO `ImagenesActividad` (`idImagen`, `nombreActividad`) VALUES
('al1', 'VISITA A LA ALHAMBRA'),
('al2', 'VISITA A LA ALHAMBRA'),
('al3', 'VISITA A LA ALHAMBRA'),
('al4', 'VISITA A LA ALHAMBRA'),
('sierra1', 'EXCURSIÓN A SIERRA NEVADA'),
('sierra2', 'EXCURSIÓN A SIERRA NEVADA'),
('sierra3', 'EXCURSIÓN A SIERRA NEVADA'),
('sierra4', 'EXCURSIÓN A SIERRA NEVADA');

-- --------------------------------------------------------

--
-- Table structure for table `ImagenesInicio`
--

CREATE TABLE IF NOT EXISTS `ImagenesInicio` (
  `tituloPagina` varchar(80) NOT NULL,
  `idImagen` varchar(20) NOT NULL,
  UNIQUE KEY `tituloPagina` (`tituloPagina`,`idImagen`),
  UNIQUE KEY `tituloPagina_2` (`tituloPagina`,`idImagen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ImagenesInicio`
--

INSERT INTO `ImagenesInicio` (`tituloPagina`, `idImagen`) VALUES
('HOTEL PLAZA NUEVA', 'fachada'),
('HOTEL PLAZA NUEVA', 'habitacion'),
('HOTEL PLAZA NUEVO', 'entorno');

-- --------------------------------------------------------

--
-- Table structure for table `Inicio`
--

CREATE TABLE IF NOT EXISTS `Inicio` (
  `tituloPagina` varchar(100) NOT NULL,
  `servDescripcion` text NOT NULL,
  `serv` text NOT NULL,
  `subTitulo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  UNIQUE KEY `tituloPagina` (`tituloPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Inicio`
--

INSERT INTO `Inicio` (`tituloPagina`, `servDescripcion`, `serv`, `subTitulo`) VALUES
('HOTEL PLAZA NUEVA', 'Durante su estancia en el Hotel Plaza Nueva podrá disfrutar distintos servios, entre los que destacamos el servicio de cuna gratuito (según disponibilidad) y ofertas para realizar distintas actividades. También ponemos a su disposición:', 'Servicios', 'El Hotel Plaza Nueva está situado en el pleno centro monumental, comercial y administrativo de Granada, a 10 minutos de la Alhambra. ');

-- --------------------------------------------------------

--
-- Table structure for table `ItemMenu`
--

CREATE TABLE IF NOT EXISTS `ItemMenu` (
  `hotel` varchar(20) NOT NULL,
  `nombreItem` varchar(20) NOT NULL,
  `idioma` varchar(10) NOT NULL,
  `url` varchar(300) NOT NULL,
  `position` int(11) NOT NULL,
  UNIQUE KEY `nombreItem` (`nombreItem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ItemMenu`
--

INSERT INTO `ItemMenu` (`hotel`, `nombreItem`, `idioma`, `url`, `position`) VALUES
('HOTEL PLAZA NUEVA', 'ACTIVIDADES', 'es', 'index.php?page=actividades', 2),
('HOTEL PLAZA NUEVA', 'CONTACTO', 'es', 'index.php?page=contacto', 4),
('HOTEL PLAZA NUEVA', 'HABITACIONES', 'es', 'index.php?page=habitaciones', 1),
('HOTEL PLAZA NUEVA', 'INICIO', 'es', 'index.php', 0),
('HOTEL PLAZA NUEVA', 'LOCALIZACIÓN', 'es', 'index.php?page=localizacion', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Pagina`
--

CREATE TABLE IF NOT EXISTS `Pagina` (
  `hotel` varchar(20) NOT NULL,
  `tituloPagina` varchar(100) NOT NULL,
  `descripcion` text,
  `idioma` varchar(10) NOT NULL,
  UNIQUE KEY `tituloPagina` (`tituloPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pagina`
--

INSERT INTO `Pagina` (`hotel`, `tituloPagina`, `descripcion`, `idioma`) VALUES
('HOTEL PLAZA NUEVA', 'ACTIVIDADES', ' ', 'es'),
('HOTEL PLAZA NUEVA', 'DATOS DE PAGO', 'Introduzca sus datos para finalizar el proceso de reserva', 'es'),
('HOTEL PLAZA NUEVA', 'FORMULARIO DE CONTACTO', 'Ponemos a su disposición el siguiente formulario para contactar con nosotros, que deberá rellenar con los datos personales que se solicitan. Puede consultarnos cualquier duda que tenga a través de éste sobre los servicios que ofrecemos, sobre el proceso para realizar una reserva o sobre cualquier otro asunto. Contestaremos a su mensaje tan pronto como podamos.', 'es'),
('HOTEL PLAZA NUEVA', 'HABITACIONES', 'Nuestras habitaciones con vistas a Plaza Nueva y a la Torre de la Vela, que pertenece al recinto de la Alhambra, le permitirán disfrutar de una perspectiva distinta de la ciudad. Disfrute de esta experiencia por un pequeño suplemento. \r\n<br><br>\r\nAsimismo el hotel dispone de habitaciones interiores, recomendables para personas que desean descansar con la máxima tranquilidad. \r\n<br><br>\r\nLas habitaciones también disponen de un cuarto de baño completo, aire acondicionado, TV, teléfono directo y una caja de seguridad gratuita para su mayor tranquilidad.\r\n<br><br>\r\nEn las habitaciones pueden hospedarse dos adultos como máximo por habitación. Los niños menores de cuatro años no necesitan pagar y no cuentan para el cupo máximo de una habitación.', 'es'),
('HOTEL PLAZA NUEVA', 'HOTEL PLAZA NUEVA', '<br><br>El hotel ofrece una amplia y eficiente gama de servicios extra que satisfarán cualquier necesidad que le surja, reservas a shows de flamenco o visitas turísticas por la ciudad y la Alhambra. \r\n<br><br>\r\nEl hotel le ofrece 25 amplias y luminosas habitaciones repartidas sobre 3 plantas con ascensor. \r\n<br><br>\r\nCada planta del hotel y cada habitación poseen un nombre y encanto propio. Este nombre es una representación de un evento importante en la vida e historia de Granada. No tienen tarjetas magnéticas para abrir las puertas de las habitaciones, preferimos la originalidad que proporciona una tradicional llave. \r\n<br><br>\r\nEl hotel ofrece el servicio de desayuno continental en la cafetería, donde podrá disfrutar de conexión WIFI. Asimismo podrá obtener mediante pago del servicio conexión WIFI en su habitación. \r\n<br><br>\r\nConfiamos en que disfrute plenamente su estancia entre nosotros así como de nuestra bella ciudad. \r\n<br><br>\r\nNúmero de registro del hotel en la consejería de turismo de Andalucía: H/GR/0118.\r\n\r\n', 'es'),
('HOTEL PLAZA NUEVA', 'LOCALIZACION', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d472.55835823140677!2d-3.5965057396974927!3d37.17692166019689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9253186efccf153a!2sHotel+Plaza+Nueva!5e0!3m2!1ses!2ses!4v1458056524790" width="100%" height="950px" frameborder="0" style="border:0" allowfullscreen> </iframe>', 'es'),
('HOTEL PLAZA NUEVA', 'REGISTRO DE USUARIO', NULL, 'es');

-- --------------------------------------------------------

--
-- Table structure for table `Pie`
--

CREATE TABLE IF NOT EXISTS `Pie` (
  `idioma` varchar(80) NOT NULL,
  `idImagen` varchar(20) NOT NULL,
  UNIQUE KEY `idioma` (`idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pie`
--

INSERT INTO `Pie` (`idioma`, `idImagen`) VALUES
('es', 'logo');

-- --------------------------------------------------------

--
-- Table structure for table `Promocion`
--

CREATE TABLE IF NOT EXISTS `Promocion` (
  `nombrePromocion` varchar(80) NOT NULL,
  `descripcionPromocion` text NOT NULL,
  `hotel` varchar(20) NOT NULL,
  `idImagen` varchar(20) NOT NULL,
  UNIQUE KEY `nombrePromocion` (`nombrePromocion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Promocion`
--

INSERT INTO `Promocion` (`nombrePromocion`, `descripcionPromocion`, `hotel`, `idImagen`) VALUES
('HABITACIÓN DOBLE + ESPECTÁCULO FLAMENCO', 'Incluye dos entradas para una sesión de espectáculo flamenco.', 'HOTEL PLAZA NUEVA', 'slide_3'),
('OFERTA DOS NOCHES', 'Disfrute de un 10% de descuento en estancias de un mínimo de dos noches.', 'HOTEL PLAZA NUEVA', 'slide_1'),
('OFERTA RESERVA ANTICIPADA', 'Disfruta de un 10% de descuento reservando con 21 días de antelación.', 'HOTEL PLAZA NUEVA', 'slide_2');

-- --------------------------------------------------------

--
-- Table structure for table `RedSocial`
--

CREATE TABLE IF NOT EXISTS `RedSocial` (
  `nombreRed` varchar(20) NOT NULL,
  `enlace` varchar(300) NOT NULL,
  `idImagen` varchar(20) NOT NULL,
  UNIQUE KEY `nombreRed` (`nombreRed`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RedSocial`
--

INSERT INTO `RedSocial` (`nombreRed`, `enlace`, `idImagen`) VALUES
('Facebook', 'https://www.facebook.com/Hotel-Plaza-Nueva-176542882374100', 'facebook'),
('Google+', 'https://www.google.es/maps/place/Hotel+Plaza+Nueva/@37.17704,/%20%20%20%20%20%20%20%20-3.5984897,17z/data=!3m1!4b1!4m2!3m1!1s0xd71fcb8cb9390e1:/%20%20%20%20%20%20%20%200x9253186efccf153a', 'google'),
('Twitter', 'https://twitter.com/HOTELPLAZANUEVA', 'twitter');

-- --------------------------------------------------------

--
-- Table structure for table `Reserva`
--

CREATE TABLE IF NOT EXISTS `Reserva` (
  `identificador` varchar(20) NOT NULL,
  `fechaSalida` date NOT NULL,
  `fechaEntrada` date NOT NULL,
  `numTarjeta` varchar(16) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `identificacion` varchar(80) NOT NULL,
  `ninios` int(11) NOT NULL,
  `adultos` int(11) NOT NULL,
  UNIQUE KEY `identificador` (`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reserva`
--

INSERT INTO `Reserva` (`identificador`, `fechaSalida`, `fechaEntrada`, `numTarjeta`, `estado`, `fecha`, `identificacion`, `ninios`, `adultos`) VALUES
('1', '2016-06-05', '2016-06-04', '1212121212121212', 'Confirmada', '2016-06-02', '12322565u', 0, 1),
('2', '2016-06-17', '2016-06-16', '1111111111111111', 'SinConfirmar', '2016-06-09', '75757575', 0, 2),
('3', '2016-06-30', '2016-06-29', '1234567890123456', 'Confirmada', '2016-06-09', '11111111j', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ReservaActividad`
--

CREATE TABLE IF NOT EXISTS `ReservaActividad` (
  `Identificador` varchar(20) NOT NULL,
  `nombreActividad` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  UNIQUE KEY `Identificador` (`Identificador`,`nombreActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ReservaActividad`
--

INSERT INTO `ReservaActividad` (`Identificador`, `nombreActividad`, `cantidad`) VALUES
('1', 'EXCURSIÓN A SIERRA NEVADA', 2),
('2', 'VISITA A LA ALHAMBRA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ReservaHabitacion`
--

CREATE TABLE IF NOT EXISTS `ReservaHabitacion` (
  `tipo` varchar(80) NOT NULL,
  `identificador` varchar(80) NOT NULL,
  UNIQUE KEY `tipo` (`tipo`,`identificador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ReservaHabitacion`
--

INSERT INTO `ReservaHabitacion` (`tipo`, `identificador`) VALUES
('HABITACIÓN DOBLE', '2'),
('HABITACIÓN DOBLE', '3'),
('HABITACIÓN INDIVIDUAL', '1'),
('HABITACIÓN INDIVIDUAL', '3');

-- --------------------------------------------------------

--
-- Table structure for table `Reservar`
--

CREATE TABLE IF NOT EXISTS `Reservar` (
  `hotel` varchar(20) NOT NULL,
  `botonAtras` varchar(20) NOT NULL,
  `botonSig` varchar(20) NOT NULL,
  `botonFinalizar` varchar(20) NOT NULL,
  `tituloDatos` varchar(80) NOT NULL,
  `tituloHabitaciones` varchar(80) NOT NULL,
  `tituloActividades` varchar(80) NOT NULL,
  `total` varchar(80) NOT NULL,
  `idioma` varchar(10) NOT NULL,
  UNIQUE KEY `hotel` (`hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reservar`
--

INSERT INTO `Reservar` (`hotel`, `botonAtras`, `botonSig`, `botonFinalizar`, `tituloDatos`, `tituloHabitaciones`, `tituloActividades`, `total`, `idioma`) VALUES
('HOTEL PLAZA NUEVA', 'ATRAS', 'SIGUIENTE', 'FINALIZAR', 'Datos reserva', 'Habitaciones seleccionadas', 'Actividades reservadas', 'Total:', 'es');

-- --------------------------------------------------------

--
-- Table structure for table `Servicio`
--

CREATE TABLE IF NOT EXISTS `Servicio` (
  `tituloPagina` varchar(100) NOT NULL,
  `idImagen` varchar(80) NOT NULL,
  `nombreServicio` text NOT NULL,
  `divisa` varchar(10) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  UNIQUE KEY `nombreServicio` (`idImagen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Servicio`
--

INSERT INTO `Servicio` (`tituloPagina`, `idImagen`, `nombreServicio`, `divisa`, `precio`) VALUES
('HOTEL PLAZA NUEVA', 'AC', 'Aire <br>acondicionado', NULL, NULL),
('HOTEL PLAZA NUEVA', 'acceso', 'Accesos <br>adaptados', NULL, NULL),
('HOTEL PLAZA NUEVA', 'bar', 'Bar<br>Cafetería', NULL, NULL),
('HOTEL PLAZA NUEVA', 'equipaje', 'Consigna <br>de equipajes', NULL, NULL),
('HOTEL PLAZA NUEVA', 'parking', 'Parking <br>cubierto', NULL, NULL),
('HOTEL PLAZA NUEVA', 'recepcion', 'Recepción <br>24 horas', NULL, NULL),
('HOTEL PLAZA NUEVA', 'servicioh', 'Servicio de <br>habitaciones', NULL, NULL),
('HOTEL PLAZA NUEVA', 'wifi', 'Conexión Wi-fi <br>a internet', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `SubItem`
--

CREATE TABLE IF NOT EXISTS `SubItem` (
  `nombreItem` varchar(20) NOT NULL,
  `nombreSubItem` varchar(80) NOT NULL,
  `url` varchar(300) NOT NULL,
  `position` int(11) NOT NULL,
  UNIQUE KEY `nombreItem` (`nombreItem`,`nombreSubItem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SubItem`
--

INSERT INTO `SubItem` (`nombreItem`, `nombreSubItem`, `url`, `position`) VALUES
('ACTIVIDADES', 'EXCURSIÓN SIERRA NEVADA', 'index.php?page=actividades#sierra', 1),
('ACTIVIDADES', 'VISITA ALHAMBRA', 'index.php?page=actividades#alhambra', 0),
('HABITACIONES', 'HABITACION DOBLE', 'index.php?page=habitaciones#doble', 0),
('HABITACIONES', 'HABITACION INDIVIDUAL', 'index.php?page=habitaciones#individual', 2),
('HABITACIONES', 'HABITACION TRIPLE', 'index.php?page=habitaciones#triple', 1),
('HABITACIONES', 'SUITE', 'index.php?page=habitaciones#suite', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
