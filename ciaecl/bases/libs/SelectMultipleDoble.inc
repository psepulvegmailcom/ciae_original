<?php
class SelectMultiple extends FormControl
{

	var $className = "Select";
	var $name      = ""; 
	var $data      = array();
	var $dataSel   = array();
	var $tip       = "";
	var $key       = "";
	var $field     = "";
 	var $size      = 7;
	var $sel       = 0;
	var $nullData  = "";
	var $nullValue = "0";
	var $jsCode    = "";
	var $width     = "";
	var $multiple  = "multiple";
	
	var $selectOrigen ;
	var $selectDestino ;
	var $nameOrigen='';
	var $nameDestino='';
	var $titleOrigen='';
	var $titleDestino='';
	var $disable = "";

	//new Select($nombre_id_sectores,$ListadeSectores,$nombre_id_sectores,$elControlSectores->texto,0,$$nombre_id_sectores,"<-- Seleccione Elemento ->",-1)
	function SelectMultiple($nameOrigen,$arrayDataOrigen,$nameDestino,$arrayDataDestino,$key,$field)
	{
		$arrayDataOrigen=$this->fixSelect($arrayDataOrigen,$arrayDataDestino,$key,$field);
			
		$this->selectOrigen = new Select($nameOrigen,$arrayDataOrigen,$key,$field);
		$this->selectOrigen->setMultiple($this->size);
		$this->selectOrigen->width="100%";
		$this->selectDestino = new Select($nameDestino,$arrayDataDestino,$key,$field);
		$this->selectDestino->setMultiple($this->size);
		$this->selectDestino->width="100%";
		$this->nameOrigen=$nameOrigen;
		$this->nameDestino=$nameDestino;
	}
	
	function setDisable()
	{		
		$this->selectOrigen->setDisable();
		$this->selectDestino->setDisable();
	}
		

	function fixSelect($arrayDataOrigen,&$arrayDataDestino,$key,$field)
	{		
		$OrigenAux=array();
		$OrigenSalida=array();
		
		$espacio="";
		if(is_array($arrayDataOrigen))
		{
			foreach($arrayDataOrigen as $id => $value)
			{
				$OrigenAux[$value[$key]]=$value[$field];
			}
		}
		
		if(is_array($arrayDataDestino))
		{
			foreach($arrayDataDestino as $id => $value)
			{
				unset($OrigenAux[$value[$key]]);
				$arrayDataDestino[$id][$field]=$value[$field].$espacio;
			}		
		}
		else
			$arrayDataDestino=array();
		$i=0;
		foreach($OrigenAux as $id => $value)
		{
			$OrigenSalida[$i][$key]=$id;
			$OrigenSalida[$i][$field]=$value.$espacio;
			$i++;
		}
		return $OrigenSalida;
	}
	
	function toHtml() 
	{
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		$botonIzq=new Button(" >> "," >> ","moverOrigenADestino('".$this->nameOrigen."','".$this->nameDestino."')");
		$botonDer=new Button(" << "," << ","moverOrigenADestino('".$this->nameDestino."','".$this->nameOrigen."')");
		
		/** $select = new TableComplete();
		
		$select->createRow();		
		$select->addColumnPlus($this->titleOrigen,array('align'=>'center','class'=>'titulo_campo_form'));
		$select->addColumn("");
		$select->addColumnPlus($this->titleDestino,array('align'=>'center','class'=>'titulo_campo_form'));		
		$select->closeRow();
		
		$select->createRow();		
		$select->addColumnPlus($this->selectOrigen->toHtml(),array('align'=>'center','rowspan'=>2));
		
		$tablaBotones =new TableComplete(" align='' "); 
		$tablaBotones->createRow("");
		$tablaBotones->addColumn($botonIzq->toHtml());
		$tablaBotones->addColumn($botonDer->toHtml());
		$tablaBotones->closeRow();
		
		$select->addColumn($tablaBotones->toHtml());		
		$select->addColumnPlus($this->titleDestino,array('align'=>'center','rowspan'=>2));		
		$select->closeRow();
		
		
		$select->createRow();	
		$select->addColumnPlus("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
		array('align'=>'left' , 'valign'=>'top', 'style'=>'padding-right: 5px;'));		
		$select->closeRow();*/		
		
		$select = "
		<center><table border=0  width='100%' cellpadding=4>	<tr>
				<td class='titulo_select' width='40%'>".$this->titleOrigen."</td>
				<td  width='10%'>&nbsp;</td><td  width='40%' class='titulo_select'>".$this->titleDestino."</td>
			</tr><tr  >		  <td rowspan=2 align=center>  ".$this->selectOrigen->toHtml()."  </td>
			  <td align=left  valign=bottom style='padding-right: 1px;'>  <table> <tr><td>".$botonIzq->toHtml()."</td></tr> <tr><td> ".$botonDer->toHtml()."</td></tr>	  </table>  </td> <td rowspan=2 align=center >".$this->selectDestino->toHtml()."</td></tr><tr  ><td  align=left  valign=top style='padding-right: 5px;'>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  </tr> </table></center>";
		return $select;
	}
}
?>