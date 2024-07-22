<?php

  

			 
	echo date("Y-m-d H:i:s",mktime(date("H")-4, date("i"), date("s"), date("m")  , date("d"), date("Y")))."\n\n";
		 


	//Servidor local
	define('HOST','localhost');
	//define('USERDB','root');
	//define('PASSDB','');

	//define('USERDB','ciae_correo');
	//define('PASSDB','dUtcmujk4xy3');
	//define('DB_LOCAL','ciae_correoenvio'); 
	define('USERDB','ciaecl_correo');

	define('PASSDB','dUtcmujk4xy3');
	define('DB_LOCAL','ciaecl_correoweb'); 

	/*define('HOST_REMITENTE','host-170-246-173-100.anacondaweb.com'); 
	define('USERNAME_REMITENTE','webmaster@institutodeeducacion.cl');
	define('NOMBRE_REMITENTE','Instituto de Estudios Avanzados en Educacion - Universidad de Chile');
	define('PASSWORD_REMITENTE','Ps12ciae75'); */



	/*define('HOST_REMITENTE','smtp.gmail.com'); 
	define('USERNAME_REMITENTE','webmaster@ciae.uchile.cl');
	define('NOMBRE_REMITENTE','Instituto de Estudios Avanzados en Educacion - Universidad de Chile');
	define('PASSWORD_REMITENTE','Ps12ciae75');  */

	define('REPOSITORIO_CERTIFICADOS','/home/ciae/public_html/correos/certificados/'); 
	

	define('HOST_REMITENTE','smtp.gmail.com'); 
	define('USERNAME_REMITENTE0','webmaster@ciae.uchile.cl');
	define('USERNAME_REMITENTE1','informaciones@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE2','informaciones2@ciae.uchile.cl');	
	define('USERNAME_REMITENTE3','informaciones3@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE4','informaciones4@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE5','informaciones5@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE6','informaciones6@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE7','informaciones7@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE8','informaciones8@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE9','informaciones9@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE10','informaciones10@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE11','informaciones11@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE12','informaciones12@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE13','informaciones13@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE14','informaciones14@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE15','informaciones15@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE16','informaciones16@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE17','informaciones17@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE18','informaciones18@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE19','informaciones19@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE20','informaciones20@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE21','informaciones21@ciae.uchile.cl');
	define('USERNAME_REMITENTE22','informaciones22@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE23','informaciones23@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE24','informaciones24@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE25','informaciones25@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE26','informaciones26@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE27','informaciones27@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE28','informaciones28@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE29','informaciones29@ciae.uchile.cl');  
	define('USERNAME_REMITENTE30','informaciones30@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE31','informaciones31@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE32','informaciones32@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE33','informaciones33@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE34','informaciones34@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE35','informaciones35@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE36','informaciones36@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE37','informaciones37@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE38','informaciones38@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE39','informaciones39@ciae.uchile.cl'); 
	define('USERNAME_REMITENTE40','informaciones40@ciae.uchile.cl');  
	define('NOMBRE_REMITENTE','CIAE-IE Universidad de Chile'); 
	define('NOMBRE_REMITENTE_IE','Instituto de Estudios Avanzados en Educación - Universidad de Chile');
	define('NOMBRE_REMITENTE_CIAE','Centro de Investigación Avanzada en Educación - Universidad de Chile');
	
	
	define('PASSWORD_REMITENTE','Ps12..ciae75'); 



	define('NOMBRE_REMITENTE_LAB','Laboratorio de Neurociencia, Cognición y Educación - IE - Universidad de Chile');
	define('USERNAME_REMITENTE_LAB','neuroedulab@ciae.uchile.cl');
	define('PASSWORD_REMITENTE_LAB','NCElab2022'); 
	

	define('USERNAME_REMITENTE_POSTGRADO','catalina.amenabar@ciae.uchile.cl');	
	define('NOMBRE_REMITENTE_POSTGRADO','Catalina Amenabar, Coordinadora de la Escuela de Postgrado IE');
	define('PASSWORD_REMITENTE_POSTGRADO','cata1234..90'); 

	define('USERNAME_REPLYTO_1','contacto@ciae.uchile.cl');
	define('NOMBRE_REPLYTO_1','Contacto CIAE-IE'); 


	define('USERNAME_REPLYTO_2','administracion.diplomados@ciae.uchile.cl');
	define('NOMBRE_REPLYTO_2','Diplomados IE'); 


	define('USERNAME_BCC_1','webmaster@ciae.uchile.cl');
	define('NOMBRE_BCC_1','CIAE-IE'); 

 
 	
	define('ESTADO_PRUEBA',FALSE); 
	//define('ESTADO_PRUEBA',TRUE); 	
	define('ESTADO_PRUEBA_CASO','985-202406-campana-filosofia');  

 	
 /*  
 
 
######  PARA ENVIO PRUEBAS############

UPDATE `envio_email_detalle` SET `bcc_1` = 'boletin@ciae.uchile.cl', estado = 'activo'  WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';
UPDATE `envio_email_detalle` SET `bcc_1` = 'boletin_02@ciae.uchile.cl', estado = 'activo'  WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';
UPDATE `envio_email_detalle` SET `bcc_1` = 'boletin_03@ciae.uchile.cl', estado = 'activo' WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';
INSERT IGNORE INTO `envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`,nombre, apellidos ) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'informaciones@ciae.uchile.cl' , '', '');


UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'informaciones@ciae.uchile.cl';
UPDATE `envio_email_detalle` SET `bcc_1` = '', estado = 'inactivo' WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';





INSERT IGNORE INTO envio_email_detalle  
SELECT REPLACE(`caso_envio`, 'online','presencial') as `caso_envio`, MD5(REPLACE(`caso_envio`, 'online','presencial')), `vistas`, `fecha_creacion`, `fecha_actualizacion`, `tipo`, `estado`, `fecha_activar`, `fecha_desactivar`, `orden_envio`, REPLACE(`asunto`, 'ONLINE','PRESENCIAL') as `asunto`, `tipo_remitente`, `reply`, `cc_1`, `cc_2`, `bcc_1`, `bcc_2`, REPLACE(`contenido`, 'online','presencial') as `contenido`, `adjunto` FROM `envio_email_detalle` WHERE `caso_envio` LIKE '985-202406-campana-filosofia%' ORDER BY `fecha_creacion` DESC;



INSERT IGNORE INTO `envio_email_destino_inscripciones`  
SELECT REPLACE(`caso_envio`, 'online','presencial') as `caso_envio`, REPLACE( `tipo_inscripcion`, 'online','presencial') as   `tipo_inscripcion` FROM `envio_email_destino_inscripciones` WHERE  `caso_envio` LIKE '985-202406-campana-filosofia%';

INSERT IGNORE INTO `envio_email_destino_inscripciones`  
SELECT REPLACE(`caso_envio`, 'online','presencial') as `caso_envio`, REPLACE( `tipo_inscripcion`, '_online','') as   `tipo_inscripcion` FROM `envio_email_destino_inscripciones` WHERE  `caso_envio` LIKE '985-202406-campana-filosofia%';


--------------------------------------------------------------------------------
	UPDATE  `envio_email_detalle` SET `caso_envio_md5` = MD5(caso_envio) WHERE caso_envio_md5 = '' OR LENGTH(caso_envio_md5) < 4 OR `caso_envio_md5` IS NULL;
	
	

INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_01@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_01@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_02@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_03@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_04@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_05@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_06@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_07@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_08@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_09@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia'); 
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_010@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_011@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_012@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_013@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`email`, `estado`, `caso_envio`) VALUES ('a_masivo_014@ciae.uchile.cl', 'enviado', '985-202406-campana-filosofia');

UPDATE `ciaecl_correoweb`.`envio_email_destino`  SET `email_md5` = MD5(email);
	
	UPDATE  `envio_email_detalle` SET `caso_envio_md5` = MD5(caso_envio) ;
	
	UPDATE `envio_email_detalle` SET `estado` = 'activo' , orden_envio = '0', `bcc_1` = 'webmaster@ciae.uchile.cl'  WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';
	
	UPDATE `base_datos_email` SET `estado` = 'activo', `comentario` = '' WHERE `base_datos_email`.`email` = 'psepulve@gmail.com';
	UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'psepulve@gmail.com';
	INSERT IGNORE INTO `envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`,nombre, apellidos ) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'psepulve@gmail.com' , 'Paulina', 'Sepúlveda');


UPDATE `envio_email_detalle` SET `orden_envio` = '3', `estado` = 'activo'  WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';

 

UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'enviopruebaemail@ciae.uchile.cl';
INSERT IGNORE INTO `envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`,nombre, apellidos ) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'enviopruebaemail@ciae.uchile.cl', 'Comunicaciones', 'CIAE-IE' );


 
 

###### ENVIO MASIVOS ###############

 
UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'boletin-incidencias@ciae.uchile.cl';
INSERT IGNORE INTO `envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`,nombre, apellidos ) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'boletin-incidencias@ciae.uchile.cl', '', '' );





UPDATE `envio_email_detalle` SET `bcc_1` = 'lista-ciae@ciae.uchile.cl' WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';


UPDATE `base_datos_email` SET `estado` = 'activo', `comentario` = '' WHERE `base_datos_email`.`email` = 'lista-seminarios@ciae.uchile.cl';
UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'lista-seminarios@ciae.uchile.cl';
INSERT IGNORE INTO `envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'lista-seminarios@ciae.uchile.cl' );
UPDATE `envio_email_detalle` SET `bcc_1` = '' WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia'; 



UPDATE `base_datos_email` SET `estado` = 'activo', `comentario` = '' WHERE `base_datos_email`.`email` = 'lista-ciae@ciae.uchile.cl';
UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'lista-ciae@ciae.uchile.cl';
INSERT IGNORE INTO `envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'lista-ciae@ciae.uchile.cl' );  


UPDATE `ciaecl_correoweb`.`base_datos_email` SET `estado` = 'activo' WHERE  `email` = 'informaciones@ciae.uchile.cl';
UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `estado` = 'enviado' WHERE  `email` = 'informaciones@ciae.uchile.cl';
UPDATE `envio_email_detalle` SET `bcc_1` = 'a_masivo_01@ciae.uchile.cl', estado = 'activo' WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';
INSERT IGNORE INTO `ciaecl_correoweb`.`envio_email_destino` (`caso_envio`, `fecha_estado`, `estado`, `email`,nombre, apellidos ) VALUES ('985-202406-campana-filosofia', CURRENT_TIMESTAMP, 'no_enviado', 'informaciones@ciae.uchile.cl' , '', '');
UPDATE IGNORE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'informaciones@ciae.uchile.cl';
SELECT * FROM `view_envio_estados_no_enviados`;

###### FULL CON FILTRO DE TIPO LISTA


INSERT IGNORE INTO envio_email_destino (tratamiento,estado,  caso_envio,   email,  nombre,apellidos ) 
SELECT  DISTINCT 'o/a' as tratamiento,  'no_enviado' as estado, '985-202406-campana-filosofia' as caso_envio, email ,  nombre ,apellidos
FROM `view_bases_datos_email` 
WHERE tipo_base LIKE '%docente%' AND tipo_base NOT LIKE 'ciae_inscripciones%' AND email NOT LIKE '%@ciae.uchile.cl'  ;

UPDATE `envio_email_detalle` SET estado = 'no_enviado' WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia' AND  estado = 'enviado';

SELECT * FROM `view_envio_estados_no_enviados`;



INSERT IGNORE INTO envio_email_destino (tratamiento,estado,  caso_envio,   email,  nombre,apellidos ) 
SELECT  DISTINCT 'o/a' as tratamiento,  'no_enviado' as estado, '985-202406-campana-filosofia' as caso_envio, email ,  nombre ,apellidos
FROM `view_bases_datos_email` 
WHERE tipo_base LIKE 'ciae%' AND tipo_base NOT LIKE 'ciae_inscripciones%' AND email NOT LIKE '%@ciae.uchile.cl' 
ORDER BY RAND() limit 3000;



INSERT IGNORE INTO envio_email_destino (tratamiento,estado,  caso_envio,   email,  nombre,apellidos ) 
SELECT  DISTINCT 'o/a' as tratamiento,  'no_enviado' as estado, '985-202406-campana-filosofia' as caso_envio, email ,  nombre ,apellidos
FROM envio_email_destino 
WHERE caso_envio = '20231220_webinar_educacion_intercultural_online_confirmacion';
 

###### ENVIO MASIVOS ###############


UPDATE `envio_email_detalle` SET `orden_envio` = '4', `estado` = 'activo'  WHERE `envio_email_detalle`.`caso_envio` = '985-202406-campana-filosofia';

INSERT IGNORE INTO envio_email_destino (tratamiento,estado,  caso_envio,   email,  nombre ,apellidos) 
SELECT 'o/a' as tratamiento,  'no_enviado' as estado, '985-202406-campana-filosofia' as caso_envio, email as email ,  nombre ,apellidos
FROM `view_bases_activos` 
WHERE ( (email LIKE '%uchile.cl'  AND  email NOT LIKE '%@ciae.uchile.cl') OR  email LIKE '%@santotomas.cl' OR email  LIKE '%@uc.cl' OR email  LIKE '%@gmail.com'    OR email LIKE '%@udec.cl'  OR  email LIKE '%@uahurtado.cl' OR email LIKE '%@unab.cl' OR email   LIKE '%@hotmail%' OR email   LIKE '%@msn%'  OR email   LIKE '%@live%'  OR email   LIKE '%@outlook.%') 
ORDER by RAND(), RAND() LIMIT 300000;


INSERT IGNORE INTO envio_email_destino (tratamiento,estado,  caso_envio,   email,  nombre ,apellidos) 
SELECT 'o/a' as tratamiento,  'no_enviado' as estado, '985-202406-campana-filosofia' as caso_envio, email as email ,  nombre ,apellidos
FROM `view_bases_activos` 
WHERE ( (email LIKE '%uchile.cl'  AND  email NOT LIKE '%@ciae.uchile.cl') OR  email LIKE '%@santotomas.cl' OR email  LIKE '%@uc.cl' OR email  LIKE '%@gmail.com'    OR email LIKE '%@udec.cl'  OR  email LIKE '%@uahurtado.cl' OR email LIKE '%@unab.cl' OR email   LIKE '%@hotmail%' OR email   LIKE '%@msn%'  OR email   LIKE '%@live%'  OR email   LIKE '%@outlook.%') 
ORDER by creacion_fecha DESC  LIMIT 90000;

  

######COPIO DE ENVIO ANTERIOR############

INSERT IGNORE INTO  `ciaecl_correoweb`.`envio_email_destino` (caso_envio, email , nombre, apellidos, tratamiento,  estado ) 
SELECT '985-202406-campana-filosofia' as caso_envio,`email`, `nombre`, `apellidos` ,tratamiento,'no_enviado' as   estado  
FROM `ciaecl_correoweb`.`view_envio_destino_activos`  
WHERE caso_envio LIKE '20231211_charla_magister_indagacioneduparvularia_online_confirmacion'    
ORDER BY fecha_estado ASC  ;
  

######  ############
 
UPDATE `envio_email_destino` SET `estado` = 'no_enviado' WHERE  caso_envio = '985-202406-campana-filosofia';


UPDATE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `estado` = 'pendiente'  AND caso_envio = '985-202406-campana-filosofia';


UPDATE `envio_email_destino` SET `estado` = 'no_enviado' WHERE `estado` = 'enviado' AND caso_envio = '985-202406-campana-filosofia';


SELECT * FROM `envio_email_destino` WHERE `email` LIKE 'psepulve@g%'   ORDER BY `envio_email_destino`.`fecha_estado` DESC;

######RESETEA ENVIO ############

UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `estado` = 'no_enviado' 
WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND   `estado` NOT LIKE 'rebote'   ;



UPDATE IGNORE `ciaecl_correoweb`.`envio_email_destino` SET `estado` = 'enviado' WHERE  `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND  (email LIKE '%@ciae.uchile.cl' OR   email LIKE '%@ie.uchile.cl' ) AND `estado` NOT LIKE 'rebote' ;"   ; 
		  

######INSERTA COMUNICACIONES############

INSERT IGNORE   INTO `ciaecl_correoweb`.`envio_email_destino` (`caso_envio`, `email`, `email_secundario`, `nombre`, `apellidos`, `tratamiento`, `cargo`, `estado` ) VALUES ('985-202406-campana-filosofia', 'psepulveda@ciae.uchile.cl', '', 'Paulina', 'Sepúlveda', 'o/a', ' ', 'pendiente' );

INSERT IGNORE   INTO `ciaecl_correoweb`.`envio_email_destino` (`caso_envio`, `email`, `email_secundario`, `nombre`, `apellidos`, `tratamiento`, `cargo`, `estado` ) VALUES ('985-202406-campana-filosofia', 'enviopruebaemail@ciae.uchile.cl', '', 'Comunicaciones', 'IE-CIAE', 'o/a', ' ', 'pendiente' ); 

INSERT IGNORE   INTO `ciaecl_correoweb`.`envio_email_destino` (`caso_envio`, `email`, `email_secundario`, `nombre`, `apellidos`, `tratamiento`, `cargo`, `estado` ) VALUES ('985-202406-campana-filosofia', 'postgrado@ciae.uchile.cl', '', 'Catalina', 'Amenabar', 'o/a', ' ', 'pendiente' );

UPDATE `ciaecl_correoweb`.`envio_email_destino` SET `estado` = 'pendiente' WHERE `envio_email_destino`.`caso_envio` = '985-202406-campana-filosofia' AND `envio_email_destino`.`email` = 'postgrado@ciae.uchile.cl' ; 

INSERT IGNORE   INTO `ciaecl_correoweb`.`envio_email_destino` (`caso_envio`, `email`, `email_secundario`, `nombre`, `apellidos`, `tratamiento`, `cargo`, `estado` ) VALUES ('985-202406-campana-filosofia', 'lista-seminarios@ciae.uchile.cl', '', '', '', 'o/a', ' ', 'pendiente' );
 
######TRAE DE INSCRIPCIONES############

INSERT IGNORE  INTO  `ciaecl_correoweb`.`envio_email_destino` (caso_envio, email , nombre, apellidos, estado ,tratamiento ) 
SELECT '985-202406-campana-filosofia' as `tipo_inscripcion`,`email`, `nombre`, `apellidos`, 'no_enviado' as estado  ,tratamiento
FROM `ciaecl_ciae`.`site_inscripcion` 
WHERE `tipo_inscripcion` LIKE '20230518_lily_orland_barak'   ;




######TRAE DE TIPO DE LISTAS CORREOS############


INSERT IGNORE  INTO  `ciaecl_correoweb`.`envio_email_destino` (caso_envio, email , nombre, apellidos, estado ) 
SELECT  DISTINCT  '985-202406-campana-filosofia' as `tipo_inscripcion`,`email`, `nombre`, `apellidos`, 'no_enviado' as estado  
FROM `ciaecl_correoweb`.`view_bases_datos_email` 
WHERE `tipo_base` LIKE '%pedagogias%' OR  `tipo_base` LIKE '%colegio%'  OR  `tipo_base` LIKE '%arpa%' ;


INSERT IGNORE  INTO  `ciaecl_correoweb`.`envio_email_destino` (caso_envio, email , nombre, apellidos, estado ) 
SELECT  DISTINCT  '985-202406-campana-filosofia' as `tipo_inscripcion`,`email`, `nombre`, `apellidos`, 'no_enviado' as estado  
FROM `ciaecl_correoweb`.`view_bases_datos_email` 
WHERE `tipo_base` LIKE '%carrera%matematica%'  AND `tipo_base`  NOT LIKE '%invitacion%'    ;

 

######INGRESAR EN LISTA BASES DESDE DESTINO############



INSERT IGNORE INTO `ciaecl_correoweb`.`base_datos_email_tipo` (tipo_base, email) 
SELECT 'ciae_interesados_area_diplomados_mejoramiento' as tipo_base,`email` 
FROM `ciaecl_correoweb`.`view_envio_destino_activos`  
WHERE caso_envio LIKE '%mejoramiento%'   AND email NOT LIKE '%@ciae.uchile.cl' ;
 
 
  

##################

REPLACE IGNORE INTO `ciaecl_correoweb`.`base_datos_email` ( email,  creacion_lista,nombre,apellidos,cargo_posicion,actividad,profesion,institucion,ciudad,pais) 
SELECT email, tipo_inscripcion, nombre, apellidos, cargo, actividad, profesion, institucion, ciudad, pais  
FROM `ciaecl_ciae`.`site_inscripcion`     ;


  
INSERT IGNORE INTO `ciaecl_correoweb`.`base_datos_email_tipo` (tipo_base, email) 
SELECT 'pedagogias_carrera_media_docentes' as `tipo_base`,`email` , profesion, actividad
FROM `ciaecl_correoweb`.`base_datos_email`
WHERE (`profesion` LIKE '%profes%media%'  OR actividad  LIKE '%profes%media%' ) AND email NOT LIKE '%@ciae.uchile.cl' AND estado = 'activo'  ;



 
 
  */
?>
