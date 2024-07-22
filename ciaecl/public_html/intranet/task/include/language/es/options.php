<?php
/****************************************************************************\
* TaskFreak!                                                                 *
* multi user                                                                 *
******************************************************************************
* Version: 0.6.1                                                             *
* Authors: Vicente Jiménez Aguilar <googuy+taskfreak@gmail.com>              *
* License:  http://www.gnu.org/licenses/gpl.txt (GPL)                        *
\****************************************************************************/

// project status
$GLOBALS['langProjectStatus'] = array(
	0 	=> 'An&aacute;lisis/Propuesta',           // 0 is for new project
	10	=> 'Dise&ntilde;o',      // anything between 0 and 40
	20 	=> 'En Desarrollo',   // is free to be customized
	30 	=> 'Mantención',   // is free to be customized
	35 	=> 'Marcha Blanca',   // is free to be customized
	40	=> 'Completado',     // anything 40 and over
	50	=> 'Suspendido/Cancelado'      // is for non active projects
);


$GLOBALS['langItemComplex'] = array(	   
	40  => 'Normal', 
	100 => 'Alta',
	25 	=> 'Baja',      
	50	=> 'Media'     
	
);
$GLOBALS['langItemUrgency'] = array(
	10	=> 'Normal',      
	15  => 'Alta',    
	20	=> 'Cr&iacute;tico',      
	40  => 'Super Cr&iacute;tico'
);

// project position
$GLOBALS['langProjectPosition'] = array(
	1	=> 'visitante',	// see only, no action
	2	=> 'oficial',	// add comments
	3	=> 'miembro',	// add tasks, add comments, task status
	4	=> 'moderador', // add/edit all tasks, comments, project members and status
	5	=> 'l&iacute;der'     // everything
);

// members global position
$GLOBALS['langGlobalPosition'] = array(
	1	=> 'invitado',     // access own projects, view only public tasks
	2	=> 'interno',    // access own projects, create projects, create tasks
	3	=> 'gerente',   // access own projects, create projects, tasks
	4	=> 'administrador' // everything
);

// task (item) status
$GLOBALS['langItemStatus'] = array(
	0	=> '0%',
	1	=> '20%',
	2	=> '40%',
	3	=> '60%',
	4	=> '80%',
	5	=> '100%'
);

// contexts

$GLOBALS['langItemContext'] = array (
	1 => 'Trabajo',
	2 => 'Reuni&oacute;n',
	3 => 'Documento',
	4 => 'Programaci&oacute;n',	
	5 => 'Informes',
	6 => 'Propuestas',
	10 => 'Testeo',
	11 => 'Bug',
	7 => 'Personal',
	8 => 'Administraci&oacute;n',
	9 => 'Contabilidad' 
);

$GLOBALS['langItemPriority'] = array (
	1 => '&iexcl;Urgente!',
	2 => 'Prioridad Alta',
	3 => 'Prioridad Media',
	4 => 'Prioridad Normal',	
	5 => 'Prioridad Baja',
	6 => 'Prioridad Baja',
	7 => 'Prioridad Muy Baja',
	8 => 'Prioridad Muy Baja',
	9 => 'Indiferente'
);
?>
