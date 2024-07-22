<?php
//mail('psepulve@gmail.com','test3333','dfdfd');

include('clases/smtp_mail/loadsmtp.php'); 
			$GLOBALS['ishtml']		= true;
			$email = 'psepulve@gmail.com';
			$GLOBALS['reply_to']	= $email;
			$GLOBALS['reply_name']	= $email;
			$GLOBALS['from_email']	= $email;
			$GLOBALS['from_name']	= $email;
			$GLOBALS['subject']		= 'testing';
			$GLOBALS['resipent_address'] = $email;
			$GLOBALS['htmlcontent'] = 'testing body'; 
				loadsmtp::mailsend(); 	 
?>