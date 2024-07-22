<?
	class bildmail
	{ 
		var $boundary;
		var $bildboundary;
		var $bildID;
		var $BildHeader;
		var $textboundary;
		var $emailheader = "";
		var $empfaenger; 
		var $betreff;  
		var $textheader;
		
		// Konstruktor (Vorbesetzungen)
		function bildmail()
		{
			$this->boundary = uniqid(time());
			$this->bildboundary = uniqid(time());
			$this->bildID = uniqid(time());
			$this->textboundary = uniqid(time());
		}

		// Von wem die Email kommt in den Header setzen
		function from($name,$email)	
		{
			$this->emailheader .= "From: $name <$email>\n";
			$this->emailheader .= "Reply-to:  $email \n";
			$this->emailheader .= "MIME-Version: 1.0\n";
		}
		
		function bcc($bcc)
		{
			$this->emailheader .= "Bcc: ".$bcc."\r\n"; 
		}		
		
		// Funktion um den Adressaten anzugeben
		function to($to)
		{
			$this->empfaenger = $to;
		}
		// Funktionn für den Betreff anzugeben
		function subject($subject)
		{
			$this->betreff = $subject;
		}
		
		// Textdaten in Email Header packen
		function settext($text)
		{
			$this->textheader .= "Content-Type: multipart/alternative; boundary=\"$this->textboundary\"\n\n";
			$this->textheader .= "--$this->textboundary\n";
			$this->textheader .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n";
			$this->textheader .= "Content-Transfer-Enconding: quoted-printable\n\n";
			$this->textheader .= strip_tags($text)."\n\n";
			$this->textheader .= "--$this->textboundary\n";
			$this->textheader .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n";
			$this->textheader .= "Content-Transfer-Enconding: quoted-printable\n\n";
			$this->textheader .= "<html><body>".$this->replaceTextImg($text)."</body></html>\n\n";
			$this->textheader .= "--$this->textboundary--\n\n";
		}		
		
		function replaceTextImg($text)
		{
			$aux = explode('<img src="',$text);
			if(count($aux) > 0)
			{
				$aux1 = explode('">',$aux[1]); 
				$replace = '<img ="'.$aux1[0].'">';
				$img = '../email/'.$aux1[0];
			 	//echo getcwd();
				$print_img = $this->setbild($img); 
				$text = str_replace($aux1[0], $print_img.'" border="0', $text);	
			} 		   
			//	echo htmlentities($text);
			return $text;
		}
		
		function setbild($Dateiname)
		{
			// Überprüfen ob die Datei wirklich existiert
			if(is_file($Dateiname))
			{
				// Herausfinden welcher Grafiktyp die Datei ist			
				$showbildtyp = substr($Dateiname,-3);

				// Überprüfen ob Datei überhaupt eine Bildgrafik ist
				if($showbildtyp == "jpg" || $showbildtyp == "gif" || $showbildtyp == "png")
				{
					// Array für verschiedene Grafik Typen
					$imagetyp = array("jpg" => "jpeg", "gif" => "gif", "png" => "png");

					// Einlesen der Daten (in Base64 Email Format)
					$bilddaten = chunk_split(base64_encode(fread(fopen($Dateiname,"rb"),filesize($Dateiname))),72);

					//Bildheader anfangen zusammenzusetzen
					$header = "--$this->boundary\n";
					$header .= "Content-Type: image/".$imagetyp[$showbildtyp].";\n name=\"$Dateiname\"\n";
					$header .= "Content-Transfer-Encoding: base64\n";
					$header .= "Content-ID: <$this->bildID>\n\n";
					$header .= $bilddaten."\n\n";
			
					// Erzeugter Header an Globalen Bildheader übergeben
					$this->BildHeader[] = $header;
			
					// Ausgade der ID für das Bild in der Email
					return "cid:".$this->bildID;
				}
				else
				{
					echo "Angegebene Datei ist kein bekanntes Bildformat...";
				}
			}
		}
		
		function send()	
		{
			$header = $this->emailheader;
			
			// Überprüfen ob Attachments angehängt wurden			
			if(count($this->BildHeader)>0)
			{
				$header .= 	"Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"$this->boundary\"\n\n";
				$header .= "--$this->boundary\n";
				$header .= $this->textheader;
				
				for($i=0;$i<count($this->BildHeader);$i++)
				{
					$header .= $this->BildHeader[$i];
				}
				
				$header .= "--$this->boundary--";
			}
			else
			{
				$header .= $this->textheader;
			}
			// Versenden der Mail
			mail("$this->empfaenger",$this->betreff,"",$header);
		}
	}
?>