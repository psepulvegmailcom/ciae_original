<?PHP
/****************************************************************************\
* Email Notification 4 TaskFreak!                                            *
* Version: 0.1.6                                                             *
* Authors: Searcher <searcher@dracon.biz>                                    *
******************************************************************************
* For: TaskFreak! Multi User                                                 *
* Version: 0.6.1                                                             *
* Authors: Stan Ozier <taskfreak@gmail.com>                                  *
* License:  http://www.gnu.org/licenses/gpl.txt (GPL)                        *
\****************************************************************************/

function Get_Project_Emails($objTask,$objUser=false,$actUser=false,$taskOwner=false) {
	if ($taskOwner) {
		if ($actUser) {  // active user receives an email
			$objAuthor = new Member(); 
			$objAuthor->setUid($objTask->authorId); 
			$objAuthor->load(); 
			$contactList[] = $objAuthor->getEmail(); 
			if ($objTask->authorId == $objTask->member->id) return $contactList;  // no duplicates
		}
		$objOwner = new Member();  // owner receives an email
		$objOwner->setUid($objTask->member->id); 
		$objOwner->load(); 
		$contactList[] = $objOwner->getEmail(); 
		return $contactList;
	}
	$objMemberList = new MemberProject();
	if (!$actUser) $noSelfEmail = ($objUser) ? ' AND '.$objMemberList->gTable().'.memberId<>'.$objUser->id : false;
	$objMemberList->addWhere($objMemberList->gTable().'.projectId='.$objTask->project->id.$noSelfEmail);
	$objMemberList->loadList();
	while ($objMemberTeam = $objMemberList->rNext()) {
		$contactList[] = $objMemberTeam->member->getEmail();
	}
  return $contactList;
}

function ReRead_Array($Data) {
	if (is_array($Data)) {
		for ($i=0; $i<count($Data); $i++) {
			$NewData .= $Data[$i];
			if ($i<count($Data)-1) $NewData .= ", ";
		}
		return $NewData;
	}
	else return $Data;
}

function Send_Email_Notify($objTask,$objUser=false,$Type=false,$Data=false,$OldData=false) {
	# Check Config
	if (!PLG_EMAIL_ENABLED) {
		echo "-------------------------------------------------------------------------------------\n";
		echo "! Please check your config file for email settings and enable the plugin !\n";
		echo "-------------------------------------------------------------------------------------\n";
		exit;
	}
	# Subject & Data
		$objAuthor = new Member();
		$objAuthor->setUid($objUser->id);
		$objAuthor->load();
	
	
	
	$Body  = "<strong>Project</strong>: ".$Data->name."<br>";
	$Body .= "<strong>Title</strong>: ".$objTask->get('title')."<br>";
	$Body .= "<strong>Deadline</strong>: ".$objTask->get('deadlineDate')."<br>";	
	$Body .= "<strong>Priority</strong>: ".$GLOBALS['langItemPriority'][$objTask->get('priority')]."<br>";	
	$Body .= "<strong>Urgency</strong>: ".$GLOBALS['langItemUrgency'][$objTask->get('expectedUrgency')]."<br>";	
	$Body .= "<strong>Complex</strong>: ".$GLOBALS['langItemComplex'][$objTask->get('expectedComplex')]."<br>";	
	$Body .= "<strong>Created By</strong>: ".$objAuthor->getName()."<br>";
	$Body .= "<strong>Assigned to</strong>: ".$objTask->member->getName()."<br>";
	switch ($Type) {
		 default:
		 	$Subject = $GLOBALS['langMessage']['done_updated'];
		 break;
		case 1:  // status change
			$Subject = $GLOBALS['langMessage']['done_status']; 
			$Body .= "<strong>Status</strong>: from ".($OldData*20)."% to ".($Data*20)."%<br>";
			$Body .= "<strong>Updated by</strong>: ".$objAuthor->getName()."<br>";
			$Tab = "desc";
			break;
		case 2:  // comment added
			$Subject = $GLOBALS['langMessage']['done_comment_added']; 
			$Body .= "<strong>Comment</strong>: ".nl2br($Data)."<br>";
			$Body .= "<strong>Added by</strong>: ".$objAuthor->getName()."<br>";
			$Tab = "comm";
			break;
		case 3:  // task updated
			$Subject = $GLOBALS['langMessage']['done_updated'];
		case 4:  // task created
			if ($Type==4) $Subject = $GLOBALS['langMessage']['done_added']; 
			$Tab = "desc";
			break;
		case 5:  // file added
			$Subject = "File Added"; 
			$Body .= "<strong>File</strong>: ".$Data."<br>"; 
			$Body .= "<strong>Added by</strong>: ".$objAuthor->getName()."<br>";
			$Tab = "file";
		break;
	}		
	
	$Body .= "<strong>Description</strong>: <br />".nl2br($objTask->get('description'));
	
	
	if(trim($Data->name) == '')
	{
		$objTask->project->load();
		$projectName = $objTask->project->name;
	}
	else
	{
		$projectName = $Data->name;
	}
	
	$deadlineDate = $objTask->get('deadlineDate');
	if(trim($deadlineDate) != '')
	{
		$deadlineDate = " - ".$deadlineDate;
	}
	
	
	$Subject = htmlentities(utf8_encode($projectName." - ".$objTask->get('title')." - ".$Subject));  /*.$deadlineDate." - ".date("YmdHi")*/
	
	$Body .= "<br /><br /><strong>@@@@@</strong> ".$Subject."<br /><strong>@@@@@</strong> ".date("j F Y H:i");
	# Message
	$Message  = " ".$Body."<br /><br />";
	$link_aux = PRJ_WWW_URL."index.php?rssId=".$objTask->id."&tab=".$Tab."&elogin=1";
	$Message .= "<a href='".$link_aux."'>".$link_aux."</a> ";

	# ~~~~~ Email Settings ~~~~~~~~~~
	$contactList = Get_Project_Emails($objTask,$objUser,PLG_EMAIL_USER,PLG_EMAIL_OWNER_ONLY);
	if (!$contactList) {  // recipients list is empty
		echo "Sorry, there are no recipients, please check your settings!";
		exit;
	}
	$From = PLG_EMAIL_FROM;  // only cosmetics
	if (PLG_EMAIL_BCC) 
	{
		$To = PLG_EMAIL_TO;
		$Bcc = $contactList;
	}
	else 
	{
		$To = $contactList;
	}
	# ~~~~~ Send Mail ~~~~~~~~~~~~~~
	if (PLG_EMAIL_DEBUG) 
	{ 
		echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		echo "From: $From\nTo: ".ReRead_Array($To)."\nSubject: $Subject\nCC: ".ReRead_Array($Cc)."\nBCC: ".ReRead_Array($Bcc)."\nHeaders: $Headers\n\nMessage:\n---------------------------------\n".strip_tags(str_replace("<br>", "\n", $Message))."\n";
		echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		exit;
	}
	
	$sendEmail = true;
	if(PLG_EMAIL_ONLY_CREATE && $Type != 4 && $Type != 3)
	{
		$sendEmail = false;
	}
	
	if($sendEmail)
	 {
	 	SwiftMail($From, $To, $Subject, $Message, 1, "Utf-8", $Headers, $Bcc, $Cc, 5);
	}
	 
	
	if(PLG_EMAIL_TO_COPY && $Type != 4 && $Type != 3)
	{
		SwiftMail($From, array(PLG_EMAIL_TO), $Subject,$Message."<br /><br />BACKUP", 1, "Utf-8", $Headers, $Bcc, $Cc, 5); 
		/*caso respaldo sistema*/
	}	
}

function SwiftMail($From, $To, $Subject, $Message, $Type=0, $Charset='Utf-8', $Headers='', $Bcc='', $Cc='', $Pri='', $File='') 
{
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset='.$Charset.'' . "\r\n";
	$headers .= 'From: '.PLG_EMAIL_FROM_NAME.'  <'.$From.'>' . "\r\n";
 
	$Subject = html_entity_decode($Subject);
	for($i=0; $i < count($To); $i++) {
		$send = mail($To[$i], $Subject, $Message, $headers);
	}
	return $send;

	# Swift Dir 
	require(PLG_EMAIL_DIR."include/Swift.php");
	# SMTP
	if (PLG_EMAIL_SWIFT == "smtp") {
		require(PLG_EMAIL_DIR."include/Swift/Connection/SMTP.php");
		$SMTP = new Swift_Connection_SMTP(PLG_EMAIL_SERVER, 25);
		$SMTP->setTimeout(PLG_EMAIL_SERVER_TIMEOUT);  // smtp delay fix
		// if auth required
		if (PLG_EMAIL_SERVER_AUTH) {  
			$SMTP->setUsername(PLG_EMAIL_SERVER_USER);
			$SMTP->setpassword(PLG_EMAIL_SERVER_PASS);
		}
		$Swift = new Swift($SMTP);
	}
	# SendMail
	if (PLG_EMAIL_SWIFT == "sendmail") {
		require(PLG_EMAIL_DIR."include/Swift/Connection/Sendmail.php");
		$Swift = new Swift(new Swift_Connection_Sendmail(PLG_EMAIL_SENDMAIL));
	}
	# Native Mail
	if (PLG_EMAIL_SWIFT == "phpmail") {
		require(PLG_EMAIL_DIR."include/Swift/Connection/NativeMail.php");
		$Swift = new Swift(new Swift_Connection_NativeMail());
	}
	# Create Message
	$Msg = new Swift_Message($Subject, $Message);
	# Configure
	if ($Type == 1) $Msg->setContentType("text/html");
	$Msg->setCharset($Charset);
	$Msg->headers->set('X-Sender:', PLG_EMAIL_FROM_NAME.' TaskFreak! 2007');
	# Recipients
	$Recipients = new Swift_RecipientList();
	// addressee
	if (is_array($To)) for ($i=0; $i<count($To); $i++) $Recipients->addTo($To[$i]);
	else $Recipients->addTo($To);  // already set previously
	// carbon copy
	if ($Cc) {
		if (is_array($Cc)) for ($i=0; $i<count($Cc); $i++) $Recipients->addCc($Cc[$i]);
		else $Recipients->addCc($Cc);
	}
	// blind carbon copy
	if ($Bcc) {
		if (is_array($Bcc)) for ($i=0; $i<count($Bcc); $i++) $Recipients->addBcc($Bcc[$i]);
		else $Recipients->addBcc($Bcc);
	}
	# Optional Settings -- info
	if ($Headers) $Msg->headers->set($Headers);
	if ($Pri) $Msg->setPriority($Pri);
	if ($File) $Msg->attach(new Swift_Message_Attachment(file_get_contents($File)));

	//$Swift->addImage($path_to_image) - embed img into msg
	//$Swift->requestReadReceipt("name@domain.com");
	//$Swift->setReturnPath("name@domain.com");
	
	# Send
	if (!$Swift->send($Msg, $Recipients, new Swift_Address(PLG_EMAIL_FROM, PLG_EMAIL_FROM_NAME))) return false;
	return true;
}
?>
