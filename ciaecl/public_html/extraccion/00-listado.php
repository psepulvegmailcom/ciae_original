 
<?php

	include ("config.cfg");
	$ControlPersonasCurso = new ControlPersonasCurso(); 
	$cursos = $ControlPersonasCurso->buscarCursosDisponibles();
	//print_r($cursos);
	$total = count($cursos);
	echo "<ul>";
	for($i=0; $i < $total; $i++)
	{
		echo "<li><b>C�digo:</b> ".$cursos[$i]['id_curso']." | <b>Curso:</b> ".$cursos[$i]['curso']." | <b>Colegio:</b> ".$cursos[$i]['colegio']." | <b>A�o:</b> ".$cursos[$i]['agno'];
		
		$alumnos =$ControlPersonasCurso->buscarListaCurso($cursos[$i]['id_curso'],$cursos[$i]['agno']);
		$total_persona = count($alumnos);
		//print_r($alumnos);
		echo "<ul>";
		for($j=0;$j < $total_persona; $j++)
		{
			echo "<li><b>C�digo:</b> ".$alumnos[$j]['id_persona']." | <b>Persona:</b> ".$alumnos[$j]['nombre']." ".$alumnos[$j]['apellido']." | <b>Relaci�n Curso:</b> ".$alumnos[$j]['relacion']."</li>";
		}
		echo "</ul>";
		
		echo "</li>";
	}
	echo "</ul>";
?>
 