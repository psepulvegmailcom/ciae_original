-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 08-09-2009 a las 16:14:37
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `doc_investigacion`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `archivos`
-- 

CREATE TABLE `archivos` (
  `id_archivo` int(5) NOT NULL auto_increment,
  `id_autor` int(5) NOT NULL,
  `titulo` varchar(100) default NULL,
  `bajada` varchar(900) default NULL,
  `pais` varchar(20) default NULL,
  `fec_publicacion` date default NULL,
  `nom_archivo` varchar(100) default NULL,
  `estado` char(1) default NULL,
  `comentarios` char(1) default NULL,
  `id_tipoarchivo` int(3) NOT NULL,
  `autor_orig` varchar(50) default NULL,
  `ano_re` int(4) default NULL,
  PRIMARY KEY  (`id_archivo`),
  KEY `archivos_FKIndex2` (`id_autor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

-- 
-- Volcar la base de datos para la tabla `archivos`
-- 

INSERT INTO `archivos` (`id_archivo`, `id_autor`, `titulo`, `bajada`, `pais`, `fec_publicacion`, `nom_archivo`, `estado`, `comentarios`, `id_tipoarchivo`, `autor_orig`, `ano_re`) VALUES 
(5, 1, 'Archivo de Prueba 2', 'Este archivo tiene las cosas mas terribles del mundo, ya que se dedica a investigar de todo', 'Argentina', '2008-07-17', 'Serial Nero 7.10.1.2.doc', '1', '1', 2, NULL, NULL),
(13, 2, 'lkjlljl', 'ljkljkl', 'Chile', '2008-07-22', 'ley_17798.pdf', '2', '1', 1, NULL, NULL),
(4, 5, 'Archivo de Prueba 1', 'Probando el archivo numero uno, ya que no se podian efectuar las busquedas', 'Chile', '2008-07-17', 'Nero 8 Keys.txt', '1', '1', 1, NULL, NULL),
(16, 3, 'Archivo 9', 'probando el nueve', 'Chile', '2008-07-30', 'seraverdad.pps', '1', '1', 1, NULL, NULL),
(17, 2, 'sdfdsfsd', 'gfdsgdsfsdgsgsdddddddddddddddfttttttttttttttttttttttttttttttttttt', 'dsfsdgsgsdgsd', '2008-08-07', '6xc8vb.gif', '1', '1', 3, NULL, NULL),
(18, 2, 'fhjukuikyu', 'eeddddddfffffcccccccccccccccccccccccccccccccccccccccccccccccddddddddddrrrrrrrrrrrrrtttttttttttttttttffffff', 'nhgnjmymy', '2008-08-07', 'dentistm.gif', '1', '1', 1, NULL, NULL),
(19, 2, 'Dcto. articulo', 'bdjshfoewhfewklfnfdslknfrehfihrefehoghrtgohgedjfbdrseurohguorehgrehgehgerphgrepgiiphgpihregipehrverhgiphjregpiehgphtiihpehngbp', 'Chile', '2008-08-11', 'Imagen1.jpg', '1', '1', 6, NULL, NULL),
(20, 2, 'Prueba archivo base de datos ', 'sajdhbjsahdhdfhwefoehdlhfrehfiwlherfihfdlsflsdhldjhgblfsdjhgldfhgljfdhgjdfhgldfjhgljdhfljgdgfdlglfdhgjfdhljgdfhgdf', 'Chile', '2008-08-11', 'consulta.txt', '2', '1', 3, NULL, NULL),
(21, 2, 'prueba archivo base de datos público', '485''4''08''4''834580''4385''043''8584''038ifopugfldjgdljkl860t''54bgblngfbklgnflbnlgnbgnfblfnblfgbnlkgfl', 'Chile', '2008-08-11', 'nucleo.gif', '1', '1', 3, NULL, NULL),
(22, 2, 'Seminario', 'Plan de Formación de Nivel Avanzado en el Ámbito de la Educación. \r\nUn propósito principal del Centro es servir como un espacio académico para la formación avanzada en el ámbito de la educación y otras disciplinas relacionadas. Entendiendo que la formación de postgrado se apoya necesariamente en la actividad de investigación, será el fortalecimiento de ésta, la instalación de nuevas capacidades, la creación acelerada de masa crítica –a través de la asociatividad- la estrategia que se utilizará para el diseño de nuevas rutas de formación de postgrado en la Universidad de Chile y para el fortalecimiento de los postgrados en las universidades asociadas.\r\nLa Universidad de Chile posee el mayor número de programas de doctorado (36) y de magister (116) del país, con aproximadamente 4.300 alumnos de postgrado. Los estudiantes de postgrado se constituirán en un motor de la investigación interdis', 'Chile', '2008-08-12', 'menuHerramienta-02.gif', '0', '1', 7, NULL, NULL),
(23, 2, 'archivo nuevo3', 'La educación municipal -por su amplia cobertura y mayor accesibilidad- es, en la práctica, el garante del derecho a la escolaridad completa y gratuita consagrado constitucionalmente. En efecto, la mitad de los niños chilenos que estudia en el sistema subvencionado asiste a colegios administrados por los municipios; proporción que aumenta al 70% entre los niños pobres [30, 31, 32, 33, 34]. A pesar de su relevancia y de que diversos autores han indicado que la falta de sensibilidad a las lógicas de acción local sería una de las principales causas del fracaso de las estrategias de mejoramiento educativo [35, 36, 37], en el país existe un enorme déficit de conocimiento sobre la gestión municipal de la educación [38, 39]. La investigación sobre municipios efectivos es incipiente, poco sistemática y metodológicamente poco refinada [40, 41]. A su vez, la investigación sobre escuelas efectivas e', 'Chile', '2008-08-14', 'apache_pb2.gif', '1', '1', 6, NULL, NULL),
(24, 2, 'Prueba dcto.', 'La educación municipal -por su amplia cobertura y mayor accesibilidad- es, en la práctica, el garante del derecho a la escolaridad completa y gratuita consagrado constitucionalmente. ', 'Chile', '2008-08-14', 'Intel_equipo.doc', '1', '1', 6, NULL, NULL),
(25, 2, 'prueba', 'La educación municipal -por su amplia cobertura y mayor accesibilidad- es, en la práctica, el garante del derecho a la escolaridad completa y gratuita consagrado constitucionalmente. ', 'chile', '2008-08-14', 'Proveedor.doc', '1', '1', 6, NULL, NULL),
(26, 2, 'njjntnjtyh', 'mghmyumyumiu', 'tujyjyui', '2008-08-20', 'contacto.txt', '1', '1', 1, NULL, NULL),
(27, 2, 'gfhjhgjhg', 'hgjhgjfhhgj', 'jfhgfj', '2008-08-20', 'contacto.txt', '0', '1', 6, NULL, NULL),
(28, 2, 'hrfoehrohh', 'vrohvpjpjhvprihhephijre2222', 'Chile', '2008-08-21', 'contacto.txt', '1', '1', 6, NULL, NULL),
(29, 2, 'mhj', 'yujy', 'juyjyu', '2008-08-21', 'contacto.txt', '1', '1', 6, NULL, NULL),
(30, 2, '8', '8', '8', '2008-08-21', 'graficos.txt', '0', '1', 1, NULL, NULL),
(31, 2, 'refer', 'dfcecew', 'scdf', '2008-08-21', 'graficos.txt', '1', '1', 6, NULL, NULL),
(32, 2, 'rcre', 'dcd', 'cdcc', '2008-08-21', 'graficos.txt', '0', '1', 6, NULL, NULL),
(33, 2, 'dfg', 'fdgdfgdf', 'dfgdf', '2008-08-21', 'vv', '1', '0', 6, NULL, NULL),
(34, 2, 'gfgf', 'gfhfghfg', 'gfhfgh', '2008-08-21', 'graficos.txt', '0', '1', 1, NULL, NULL),
(35, 2, 'gfgf', 'gfhfghfg', 'gfhfgh', '2008-08-21', 'graficos.txt', '0', '1', 1, NULL, NULL),
(36, 2, 'df', 'dfd', 'fd', '2008-08-21', 'graficos.txt', '0', '1', 1, NULL, NULL),
(37, 2, 'df', 'dfd', 'fd', '2008-08-21', 'graficos.txt', '0', '1', 1, NULL, NULL),
(38, 0, 'fddv', 'fdvfdnfdfñnksdkfkrknjfrngrnegengpnekdlnfdgdfhgdfgfd', '', '2008-08-21', '', '0', '1', 0, NULL, NULL),
(39, 2, 'rexx', 'rexxx', 'rexxxxx', '2008-08-21', 'readme_en.txt', '1', '1', 1, NULL, NULL),
(40, 2, 'dfdg', 'fgdfgdfgdfgd', 'fdgdfgdf', '2008-08-28', 'contacto.txt', '0', '1', 6, NULL, NULL),
(41, 2, 'ytu676867', 'gjhjgjgjgjggh', 'ghjghjhg', '2008-08-28', 'AYUDAS_áreas_subáreas.doc', '1', '1', 6, NULL, NULL),
(42, 2, 'tyryhty', 'nytntynty', 'ntynyt', '2008-08-28', 'contacto.txt', '1', '1', 6, NULL, NULL),
(43, 2, 'dfgdgdfg', 'fdgdfgdfgd', 'dfgdfgd', '2008-08-28', 'graficos.txt', '1', '1', 6, NULL, NULL),
(44, 2, 'sdasd', 'sadasdas', 'sadasd', '2008-08-28', 'minuta reunión.doc', '1', '1', 1, NULL, NULL),
(45, 2, 'sdasd', 'sadasdas', 'sadasd', '2008-08-28', 'minuta reunión.doc', '1', '1', 1, NULL, NULL),
(47, 2, 'dfsdf', 'dsfsdfsdfsdfsd', 'fsdfsfs', '2008-08-28', 'partidos.txt', '0', '1', 6, NULL, NULL),
(59, 2, 'fdgfd', 'dfgdfgdfgdf', 'gfdgdfg', '2008-09-02', 'Educacion_2007.pdf', '0', '1', 8, NULL, NULL),
(48, 2, 'fdg', 'fgfdgdf', 'fgdfgd', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(49, 2, 'ssd', 'fsdfsdfs', 'dfssd', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(50, 2, 'dfs', 'dsfsdf', 'dsfsd', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(51, 2, 'dsf', 'gfdgdf', 'fdgdf', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(83, 2, 'fbdskbf', 'dfgdfgdfgfdgdfgfd', 'gfdg', '2008-09-10', 'pago_cable.pdf', '1', '0', 8, NULL, NULL),
(53, 2, 'fdg', 'fdgdfg', 'fgfdg', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(62, 2, 'hgnhgnhg', 'hghgmntyjtyjtyjbnbvnhgggggggggggggfffffffhhjnfhfgg', 'nhhg', '2008-09-03', 'CO+notebook.pdf', '1', '0', 8, NULL, NULL),
(56, 2, 'bg', 'bgfbfg', 'bgbf', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(57, 2, 'bg', 'bgfbfg', 'bgbf', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(58, 2, 'bg', 'bgfbfg', 'bgbf', '2008-09-01', 'Educacion_2007.pdf', '1', '0', 8, NULL, NULL),
(63, 2, 'fgdggdf', 'hbtbgtynbuuynyu', 'gbfgfgf', '2008-09-05', 'graficos.txt', '1', '1', 6, NULL, NULL),
(64, 2, 'gbrthbegb', 'dfgfdgfdgdfgdf', 'gdfgdfgdf', '2008-09-05', 'graficos.txt', '1', '1', 6, NULL, NULL),
(65, 2, 'ghfg', 'hgfhfgh', 'hgfh', '2008-09-08', 'Caja Herramienta_Vrs 01.pdf', '1', '0', 8, NULL, NULL),
(66, 2, 'ghfg', 'hgfhfgh', 'hgfh', '2008-09-08', 'Caja Herramienta_Vrs 01.pdf', '1', '0', 8, NULL, NULL),
(67, 2, 'gh', 'hgfhfghfg', 'hgfh', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(68, 2, 'dsf', 'sdfsdfs', 'sdfsd', '2008-09-08', 'Caja Herramienta_Vrs 01.pdf', '1', '0', 8, NULL, NULL),
(69, 2, 'dsf', 'sdfsdfs', 'sdfsd', '2008-09-08', 'Caja Herramienta_Vrs 01.pdf', '1', '0', 8, NULL, NULL),
(70, 2, 'dsfsdfdddggggggggggggggggg', 'dsfdsfsddddddddddddddddddddddddddddgggggggggggggggggg', 'dsfsdfddggggggg', '2008-09-08', 'pago08_2008.pdf', '2', '1', 8, 'Don Juan', NULL),
(72, 2, 'cxvcx2222222222', 'xcvxcv2222222222', 'vcxv222222222', '2008-09-08', 'graficos.txt', '0', '0', 8, NULL, NULL),
(73, 2, 'fsdf', 'fdsfsdfsd', 'sdfsd', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(89, 2, 'gfdg', 'fdgfdgdf', 'fdgdfgdfg', '2008-09-22', 'Corona_Skin_3.swf', '0', '1', 1, NULL, NULL),
(75, 2, 'fds', 'sdfsdfs', 'dfsdf', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(76, 2, 'fds', 'sdfsdfs', 'dfsdf', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(78, 2, 'gfdg', 'dfgdfgd', 'gdg', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(79, 2, 'gfdg', 'dfgdfgd', 'gdg', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(81, 2, 'fgf', 'fdgdfg', 'gfdg', '2008-09-08', 'graficos.txt', '1', '0', 8, NULL, NULL),
(82, 2, 'ffdgxd1111111111111111', 'gfdgdfxd1111111111', 'fdgdfgxd111111111111', '2008-09-08', 'partidos.txt', '1', '0', 8, NULL, NULL),
(84, 2, 'fbdskbf', 'dfgdfgdfgfdgdfgfd', 'gfdg', '2008-09-10', 'pago_cable.pdf', '1', '0', 8, NULL, NULL),
(85, 2, 'Prueba recurso', 'fjnjrehnghreguoihnvm,fnvohgothgol', 'Chile', '2008-09-11', 'graficos.txt', '0', '1', 8, NULL, NULL),
(86, 2, 'Nuevo docto.', 'feowfhoiewjnkviewhfgrorw´hog', 'Alemania', '2008-09-11', 'hpsc4.pdf', '1', '1', 8, NULL, NULL),
(87, 2, 'docto con coment', 'dsfjiriojgogvnhrtbjfn', 'Groenlandia', '2008-09-11', 'hpsc5.pdf', '1', '0', 8, NULL, NULL),
(88, 2, 'Nuevo Otros', 'fhgtrhyjumkjiuloiuloiu', 'Tansania', '2008-09-11', 'Intel_equipo.doc', '0', '1', 8, NULL, NULL),
(91, 2, 'mmmm', 'mmmmm', 'mmmm', '2008-09-29', 'univde.DOC', '0', '0', 8, '', 0),
(92, 2, 'vxvxc', 'gfhgf', 'Afganistan\r\n', '2008-09-29', 'univde.DOC', '0', '0', 8, '', 2004),
(93, 2, 'mmmmmmm', 'mmmmmmmmm', 'mmm', '2008-09-29', 'univde.DOC', '0', '0', 8, '', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `archivos_temas`
-- 

CREATE TABLE `archivos_temas` (
  `id_tema` int(10) NOT NULL,
  `id_archivo` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `archivos_temas`
-- 

INSERT INTO `archivos_temas` (`id_tema`, `id_archivo`) VALUES 
(2, 5),
(1, 5),
(29, 89),
(30, 16),
(1, 13),
(1, 4),
(30, 38),
(32, 25),
(38, 20),
(38, 21),
(33, 22),
(30, 62),
(32, 64),
(30, 70),
(38, 92),
(38, 72),
(38, 73),
(31, 88),
(31, 87),
(31, 86),
(29, 85),
(30, 83),
(32, 82);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `areas`
-- 

CREATE TABLE `areas` (
  `id_area` int(10) NOT NULL auto_increment,
  `area` varchar(40) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY  (`id_area`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `areas`
-- 

INSERT INTO `areas` (`id_area`, `area`, `descripcion`, `estado`) VALUES 
(1, 'Tecnologia', 'Documentacion sobre la actualidad en tecnologia', '1'),
(2, 'Administracion', 'Documentacion sobre los temas asociados a la administracion de empresas', '1'),
(3, 'Matematicas', 'Tema sobre el area matematicas', '1'),
(6, 'Lenguaje y ComunicaciÃ³n', 'Area dedicada al ramo lenguaje y comunicacion', '1');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `comentarios`
-- 

CREATE TABLE `comentarios` (
  `id_comentario` int(10) NOT NULL auto_increment,
  `id_archivo` int(5) NOT NULL,
  `titulo_comentario` varchar(30) default NULL,
  `autor_comentario` varchar(60) default NULL,
  `fec_comentario` date default NULL,
  `correo` varchar(100) default NULL,
  `comentario` text,
  `estado` char(1) NOT NULL,
  PRIMARY KEY  (`id_comentario`),
  KEY `comentarios_FKIndex1` (`id_archivo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- 
-- Volcar la base de datos para la tabla `comentarios`
-- 

INSERT INTO `comentarios` (`id_comentario`, `id_archivo`, `titulo_comentario`, `autor_comentario`, `fec_comentario`, `correo`, `comentario`, `estado`) VALUES 
(4, 5, 'eeeeeeeeeeee', 'rew', '2008-07-18', 'werwe@nd.cl', 'dsfsdfjhkh', '0'),
(3, 4, 'ttttttttx', 'ttttttttt', '2008-07-17', 'tttttttttt@ttt.tt', 'ttttttttt', '1'),
(7, 15, 'hgjhgj', 'jhhgjg', '2008-07-22', 'ghjghj@dfdfddf.vl', 'dffsddffs', '1'),
(6, 15, 'hghghghhg', 'uuuuuuuuum', '2008-07-22', 'uuuuuuuuu@uuuuu.uu', 'uuuuuuuuuuuhghg', '0'),
(8, 15, 'jkjjhk', 'jkjhkhk', '2008-07-22', 'khkjh@dfddf.cl', 'gdgfgdg', '1'),
(11, 5, 'hhhhhhhh', 'hhhhhhhhhh', '2008-07-22', 'hhhhhhhh@hhh.hh', 'hhhhh', '1'),
(12, 5, 'gdfdg', 'gdgg', '2008-07-22', 'gggggg@gggggg.gg', 'ggggg', '1'),
(13, 4, 'ttttttt', 'tttttttt', '2008-07-22', 'ttttttttt@ttt.tt', 'tttttt', '1'),
(14, 13, 'jjjjj', 'jjjjj', '2008-07-30', 'julio@xxx.cl', 'jjjjj', '1'),
(15, 16, 'xxx', 'xxxx', '2008-07-31', 'xxxx@xxxx.xx', 'xxxx', '1'),
(16, 16, '', '', '2008-08-08', 'fdgfd@nfs.cl', 'dghfdhgdjgdfjgd', '1'),
(17, 16, '', 'fgd', '2008-08-08', 'dfgd@dsfsd.cl', 'fndfgdf', '1'),
(18, 16, '', 'fgd', '2008-08-08', 'dfgd@dsfsd.cl', 'fndfgdf', '1'),
(19, 16, 'comentario', 'prueba real', '2008-08-08', 'joseluisrs@hotmail.com', 'prueba para ver funcionamiento de comentario', '1'),
(20, 16, 'comentario', '', '2008-08-11', '', '', '1'),
(21, 16, 'comentario', 'José Luis', '2008-08-11', 'joseluisrs@hotmail.com', 'prueba para probar funcionalidad', '1'),
(22, 16, 'comentario', 'José', '2008-08-11', 'jose@hotma.cl', 'fdggergergregregreger', '1'),
(23, 16, 'comentario', 'hyrth', '2008-08-11', 'trytr@dfsd.xl', 'oigfidoeger', '1'),
(24, 16, 'comentario', 'ghjr', '2008-08-11', 'tryhtrh@fdg.cl', 'fgjojgoerg', '1'),
(25, 16, 'comentario', 'fdgdgdf', '2008-08-11', 'gdfgdf@dnfde.cl', 'drejhigoerg', '1'),
(31, 82, 'comentario', 'gfkjb', '2009-04-21', 'dsfds@dsn.cl', 'rfljwkehejw lw', '1'),
(27, 16, 'comentario', 'xxxxxxxxxxxxxxx', '2008-09-08', 'xxxxx@dsljgfsjl.cl', 'gpifdjgipfdjpgjperkge', '1'),
(28, 16, 'comentario', 'xxxxxxxxxxxxxxx', '2008-09-08', 'xxxxx@dsljgfsjl.cl', 'gpifdjgipfdjpgjperkge', '1'),
(29, 16, 'comentario', 'xxxxxxxxxxxxxxx', '2008-09-08', 'xxxxx@dsljgfsjl.cl', 'gpifdjgipfdjpgjperkge', '1'),
(30, 70, 'comentario', 'José Luis', '2008-09-10', 'joseluisramos@gmx.net', 'prueba de comentario', '1');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `comentarios_temas`
-- 

CREATE TABLE `comentarios_temas` (
  `id_comentario` int(10) NOT NULL auto_increment,
  `id_tema` int(5) NOT NULL,
  `titulo_comentario` varchar(30) default NULL,
  `autor_comentario` varchar(60) default NULL,
  `fec_comentario` date default NULL,
  `correo` varchar(100) default NULL,
  `comentario` text,
  `estado` char(1) NOT NULL,
  PRIMARY KEY  (`id_comentario`),
  KEY `comentarios_FKIndex1` (`id_tema`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- Volcar la base de datos para la tabla `comentarios_temas`
-- 

INSERT INTO `comentarios_temas` (`id_comentario`, `id_tema`, `titulo_comentario`, `autor_comentario`, `fec_comentario`, `correo`, `comentario`, `estado`) VALUES 
(9, 28, 'ddddddd', 'jhgjj', '2008-07-22', 'jhjjh@fddf.cl', 'jjh', '1'),
(10, 1, 'dfsdff', 'dfsf', '2008-07-22', 'sdfdfsdf@dfsdfd.cl', 'dffsdf', '1'),
(6, 1, 'hghggh', 'ghfhh', '2008-07-22', 'HHHH@HHH.HH', 'ghhhgghf', '1'),
(4, 3, 'fddf', 'gfdg', '2008-07-21', 'dfgdf@gdfg.cl', 'dfggfhjgjgh', '1'),
(8, 28, 'lllllllllll', 'lllllllllll', '2008-07-22', 'lllll@llllll.ll', 'lllllllllll', '1'),
(11, 30, 'xxx', 'XXXX', '2008-07-31', 'aaa@aaa.cl', 'xxxxx', '1'),
(12, 2, 'fbdskbkf', 'fhofhowe', '2008-08-05', 'jfshf@dfosd.cl', 'lhngejhgerhgebrgbfmnbv', '1'),
(13, 29, 'fds', 'trhyt', '2008-08-08', 'fsdfsd@fre.cl', 'nflknfew', '1');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tema`
-- 

CREATE TABLE `tema` (
  `id_tema` int(5) NOT NULL auto_increment,
  `tema` varchar(40) default NULL,
  `descripcion` varchar(1900) default NULL,
  `descripcion2` varchar(1900) default NULL,
  `descripcion3` varchar(1900) default NULL,
  `estado` char(1) default NULL,
  `id_autor` int(5) NOT NULL,
  `id_tipotema` int(3) NOT NULL,
  `img1` varchar(30) NOT NULL,
  `img2` varchar(30) NOT NULL default 'default.jpg',
  `img3` varchar(30) NOT NULL,
  `comentarios` char(1) NOT NULL,
  `id_area` int(10) NOT NULL,
  `fec_creacion` date default NULL,
  PRIMARY KEY  (`id_tema`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=62 ;

-- 
-- Volcar la base de datos para la tabla `tema`
-- 

INSERT INTO `tema` (`id_tema`, `tema`, `descripcion`, `descripcion2`, `descripcion3`, `estado`, `id_autor`, `id_tipotema`, `img1`, `img2`, `img3`, `comentarios`, `id_area`, `fec_creacion`) VALUES 
(1, 'Tema Prueba 1', 'Probando el tema, y verificando si se cumplen los requerimientos solicitados del sistema.\r\n', 'Probando el tema, y verificando si se cumplen los requerimientos solicitados del sistema.\r\n', 'Probando el tema, y verificando si se cumplen los requerimientos solicitados del sistema.\r\n', '1', 2, 2, '', 'Pinguino.jpg', 'Wrinkles.jpg', '1', 1, NULL),
(2, 'Tema Prueba 2', 'sdfsdfsdf sdfdsf sdfgfgtert sdfgrrt sdgdrgerg dfgdftry dfgerter', NULL, NULL, '1', 2, 2, '', '', 'nucleo.gif', '1', 2, NULL),
(29, 'Publicaciones', 'Probando el Tema 3', NULL, NULL, '1', 2, 2, '', '', '', '1', 2, NULL),
(30, 'Documentos', '', '', '', '2', 2, 2, '', '', '', '1', 2, NULL),
(31, 'Hitos', 'Probando 5', '', '', '2', 2, 2, '', '', '', '1', 1, NULL),
(32, 'Artículos', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis ligula lorem, consequat eget, tristique nec, auctor quis, purus. Vivamus ut sem. Fusce aliquam nunc vitae purus. Aenean viverra malesuada libero. Fusce ac quam. Donec neque. Nunc venenatis enim nec quam. Cras faucibus, justo vel accumsan aliquam, tellus dui fringilla quam, in condimentum augue lorem non tellus. Pellentesque id arcu non sem placerat iaculis. Curabitur posuere, pede vitae lacinia accumsan, enim nibh elementum orci, ut volutpat eros sapien nec sapien. Suspendisse neque arcu, ultrices commodo, pellentesque sit amet, ul', 'comentario prueba 2', 'comentario prueba 3', '1', 2, 2, '', '', '', '1', 1, NULL),
(33, 'Actividades', 'sdffsdfsdf', '', '', '1', 2, 2, '', '', '', '1', 1, NULL),
(36, 'Tema Prueba 9', 'jajajajajajaja\r\n\r\nhola', '', '', '0', 2, 2, '', '', '', '1', 1, NULL),
(37, 'Diario Mural', 'cccxxczczxc', NULL, NULL, '2', 2, 1, '', '', '', '1', 2, NULL),
(38, 'Bases de datos', 'La exigencia de creación de conocimiento de valor universal se combina con la voluntad de abordar problemas relevantes para el país, tanto a nivel de diseño y monitoreo de política, como de necesidades de aula o de formación de profesores. La investigación que desarrollará el Centro se alimentará de vínculos estrechos con el medio escolar, profesional, de gestión y política sectorial. Tal garantía se ha establecido a través de un Consejo Asesor , en el que participan representantes de las principales instancias vinculadas con el tema. La propuesta opta por la inversión de la secuencia típica: investigación básica, investigación aplicada, desarrollo, transferencia al medio. A partir de las necesidades de los actores (estudiantes, profesores, administradores, tomadores de decisión), de productos y respuestas concretas, se generan los temas y preguntas de investigación, se crea el nuevo conocimiento, capaz de producir soluciones con base científica. Además de los miembros del Consejo Asesor, otros organismos relevantes en esta cadena, como la Fundación Arauco y la Sociedad de Instrucción Primaria (SIP), UNESCO, la Red Enlaces y el Centro de Perfeccionamiento, Experimentación e Investigaciones Pedagógicas, del Ministerio de Educación, han comprometido su participación.', '', '', '1', 2, 2, 'Bob Marley - Exodus - Back.jpg', '', '', '1', 3, NULL),
(39, 'fsdfsd', 'fsdf', 'chao', 'hola', '0', 1, 1, '', '', '', '1', 0, NULL),
(40, 'diario mural1', 'ehfoiehwfoie', 'retert', 'retertre', '1', 2, 1, 'apache_pb.gif', '', '', '1', 0, NULL),
(41, 'diario mural propio', 'es una iniciativa conjunta de la Universidad Mayor y de El Mercurio, cuyo propósito es compartir con los lectores investigaciones con alto impacto en la actividad productiva de nuestro país. Como parte del programa de Extensión de la Universidad Mayor, se expondrán resultados de los proyectos más relevantes de esta casa de estudios.', 'Educación universitaria para la 3a edad. El requisito de ingreso es tener cumplidos los 50 años de edad. Las posibilidades van desde hacer un curso hasta obtener una licenciatura en variadas áreas. La oferta académica cubre los intereses de todos quienes quieren reinventar su vida.', 'A través de este proyecto la Facultad de Medicina de la Universidad de Chile, en conjunto con El Mercurio, se unen en la hermosa tarea de informar a la comunidad, de manera seria y responsable, sobre materias que tocan el bien más preciado de las personas. Semana a semana compartiremos los resultados de nuestra permanente preocupación: la salud de los chilenos y chilenas. ', '1', 2, 1, 'imagenes_home (2).jpg', 'imagenes_home (3).jpg', 'imagenes_home (4).jpg', '1', 0, '2008-09-15'),
(61, 'dfsdsfsdfsdfqq', 'fsdfsdfsdfxxqq', 'fsdfsdfsdfsdfsxxqq', 'fdsfsdfdsfdsfsdxxqq', '2', 2, 1, 'imagenes_home (2).jpg', 'imagenes_home (3).jpg', 'imagenes_home (4).jpg', '1', 0, '2008-09-15');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipos_archivos`
-- 

CREATE TABLE `tipos_archivos` (
  `id_tipoarchivo` int(3) NOT NULL auto_increment,
  `tipo_archivo` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id_tipoarchivo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Volcar la base de datos para la tabla `tipos_archivos`
-- 

INSERT INTO `tipos_archivos` (`id_tipoarchivo`, `tipo_archivo`) VALUES 
(1, 'Publicaciones'),
(2, 'Otros'),
(3, 'Base de Datos'),
(4, 'Diario Mural'),
(5, 'Hitos'),
(6, 'Artículos'),
(7, 'Actividades'),
(8, 'Documentos');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipos_temas`
-- 

CREATE TABLE `tipos_temas` (
  `id_tipotema` int(3) NOT NULL auto_increment,
  `tipo_tema` varchar(30) NOT NULL,
  PRIMARY KEY  (`id_tipotema`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `tipos_temas`
-- 

INSERT INTO `tipos_temas` (`id_tipotema`, `tipo_tema`) VALUES 
(1, 'Publicaciones'),
(2, 'Otros');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipo_usuario`
-- 

CREATE TABLE `tipo_usuario` (
  `id_tipousuario` int(2) NOT NULL auto_increment,
  `tipo_usuario` varchar(40) default NULL,
  `perfil` char(1) default NULL,
  PRIMARY KEY  (`id_tipousuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `tipo_usuario`
-- 

INSERT INTO `tipo_usuario` (`id_tipousuario`, `tipo_usuario`, `perfil`) VALUES 
(1, 'Comun', '0'),
(2, 'Administrador', '1'),
(3, 'Investigador', '2');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id_usuario` int(5) NOT NULL auto_increment,
  `id_tipousuario` int(2) NOT NULL,
  `firstname` varchar(40) default NULL,
  `lastname` varchar(40) default NULL,
  `username` varchar(20) default NULL,
  `passwd` varchar(50) default NULL,
  `email` varchar(100) default NULL,
  `last_login` date default NULL,
  `estado_usu` char(1) NOT NULL default '1',
  `perfil_pro` varchar(50) default NULL,
  `curriculo` varchar(50) default NULL,
  `publicaciones` varchar(50) default NULL,
  PRIMARY KEY  (`id_usuario`),
  KEY `usuarios_FKIndex1` (`id_tipousuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` (`id_usuario`, `id_tipousuario`, `firstname`, `lastname`, `username`, `passwd`, `email`, `last_login`, `estado_usu`, `perfil_pro`, `curriculo`, `publicaciones`) VALUES 
(1, 2, 'José', 'Ramos', 'joseluis', 'joseramos', 'joseluisrs@hotmail.com', '2008-11-04', '1', NULL, NULL, NULL),
(2, 3, 'Julio', 'Videla', 'julio', 'julio', 'julio@xxx.cl', '2009-04-21', '1', 'Investigador del Centro de Investigación', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aabbbbbbbbbbbbbbbbbbbbbbbbbbbb'),
(3, 1, 'Marcos', 'Aravena', 'marcos', 'marcos', 'marcos@jefe.cl', '2008-08-05', '1', NULL, NULL, NULL),
(4, 3, 'Pedro', 'Pereira', 'pedro', 'pedro', 'ppereira@perez.cl', '2008-07-16', '1', NULL, NULL, NULL),
(5, 1, 'Carlos', 'Carnaza', 'carlos', 'carlos', 'ccarnaza@jajajaja.com', NULL, '0', NULL, NULL, NULL),
(13, 3, 'Juan Pablo', 'Valenzuela', 'juanpablo', 'juanpablo', 'jbarros@umich.edu', NULL, '1', NULL, NULL, NULL),
(14, 3, 'Cristián', 'Bellei', 'cristian', 'cristianbe', 'cbellei@uchile.cl', NULL, '1', NULL, NULL, NULL),
(15, 3, 'Danae', 'de los Rios', 'danae', 'danaedelos', 'ddelos@umich.edu', NULL, '1', NULL, NULL, NULL);
