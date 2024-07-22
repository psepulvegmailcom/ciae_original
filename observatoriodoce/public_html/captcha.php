<?PHP
  $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");
  
  $image = @imagecreatefromjpeg('www/imag/captcha.jpg') or die("Cannot Initialize new GD image stream");
  // set background and allocate drawing colours
  $background = imagecolorallocate($image, 216, 216, 216);
   
  imagefill($image, 0, 0, $background);
  $linecolor 	= imagecolorallocate($image, 4, 130, 171);
   
  $textcolor 	= imagecolorallocate($image, 0x00, 0x00, 0x00);
  // draw random lines on canvas
   
  session_start();
  // add random digits to canvas using random black/white colour
  $digit = '';
  for($x = 15; $x <= 95; $x += 20)
  {    
    $num = RandomString();
    $digit .= $num;
    imagechar($image, rand(20, 25), $x, rand(4, 10), $num, $textcolor);
  }
  // record digits in session variable
  $_SESSION['digit'] = $digit;
  //echo $digit;

  // display image and clean up
  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);
  
  function RandomString()
  {
    $characters = 'defghijmn23456789abd&#=%efghijmnq23456&#=%789rtABDEFG&#=%HIJLMN23456789TRGHIJLM';
    $largo  = strlen($characters)-1;
    $random = rand(0, $largo);
    $randstring = $characters[$random]; 
    //echo strlen($characters).' '.$random.' '.$randstring.'<br>';
    return $randstring;
  }
?>