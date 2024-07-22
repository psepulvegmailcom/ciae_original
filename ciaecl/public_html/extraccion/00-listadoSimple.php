 
<?php

	include ("config.cfg");
	$ControlPersonasCurso = new ControlPersonasCurso(); 
	$cursos = $ControlPersonasCurso->buscarCursosDisponibles();
	//print_r($cursos);
	$total = count($cursos);
	echo "<ul>";
	for($i=0; $i < $total; $i++)
	{
		echo "<li><b></b> ".$cursos[$i]['id_curso']." | <b>Curso:</b> ".$cursos[$i]['curso']." | <b>Colegio:</b> ".$cursos[$i]['colegio']." | <b>Año:</b> ".$cursos[$i]['agno'];
		
		$alumnos =$ControlPersonasCurso->buscarListaCurso($cursos[$i]['id_curso'],$cursos[$i]['agno']);
		$total_persona = count($alumnos);
		//print_r($alumnos);
		echo "<ul>";
		for($j=0;$j < $total_persona; $j++)
		{
			echo "  '".$alumnos[$j]['id_persona']." ".$alumnos[$j]['nombre']."' ";
		}
		echo "</ul>";
		
		echo "</li>";
	}
	echo "</ul>";
?>
 