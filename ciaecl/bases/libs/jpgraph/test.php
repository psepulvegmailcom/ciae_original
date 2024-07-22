<?php  
 // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
// Some data

$aux = $_GET['valores'];

$data = explode(',',$aux);

//$data = array(40,21,17,14);

// Create the Pie Graph. 
$graph = new PieGraph(450,550);

$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// Set A title for the plot
$graph->title->Set("A Simple Pie Plot");
$graph->SetBox(true);
$graph->SetBackgroundImage('world_map.png',BGIMG_FILLFRAME);

// Create
$p1 = new PiePlot($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
$graph->Stroke();

?> 