<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="refresh" CONTENT="1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?
	$HOST = "localhost";
	$PORT = "3306";
	$USER = "encuesta_ciae";
	$PASS = "encuesta_ciae_2009";
	$DB = "limesurvey";
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
	$rbd = $_GET["rbd"];
	
	TotalEscuelasHistoricoXagno($conn);
	$suma =0;
function TotalEscuelasHistoricoXagno($conn){
	$qryResultado = "SELECT rbd, nom_est, nom_director, email
							FROM 
							view_estab_sep 
							where nom_est > 'T%'    
							 order by nom_est";
						echo $qryResultado;
						//exit;
			$resultResultado = mysql_query($qryResultado, $conn);
			//return $resultResultado;
			while($result=mysql_fetch_array($resultResultado)){
			$mail=$result['email'];
				$nombre=$result['nom_est'];
				$director=$result['nom_director'];
				$mail=$result['email'];
				$rbd=$result['rbd'];
				
	$qryResultado1 = "SELECT tid, firstname, lastname, email
							FROM 
							lime_tokens_58924 
							where firstname='".$nombre."' and lastname='".$director."'";	
						echo "<br>";
						echo $qryResultado1;
							$resultResultado1 = mysql_query($qryResultado1, $conn);	
							$result1=mysql_fetch_array($resultResultado1);
				if(($result1["firstname"]==$nombre) && ($result1["lastname"] == $director) && ($result1["email"] != $mail))	{
						echo "<br>";
				echo 	$nombre;
				echo "<br>";				
				echo 	$result1["email"];
				echo "<br>";				
				echo 	$mail;
				echo "<br>";						
				//echo "hola";
				//exit;
					$qryResultado = "Update lime_tokens_58924 set email='".$mail."' 
							 where firstname='".$result1["firstname"]."' and lastname='".$director."'";
							 echo $qryResultado;
							 //exit;
							 $resultResultado = mysql_query($qryResultado, $conn);
							 //echo $mail;
							 }
							 //echo 	$result1["firstname"];
							 $suma = $suma +1;
							 //echo $suma;
							 echo "<br>";
							 $tid = $result1["tid"];
							 echo $rbd;
				
				}
			}
			
			?>

<input type="hidden" name="rbd" value="<? echo $rbd; ?>"  />
</body>
</html>
