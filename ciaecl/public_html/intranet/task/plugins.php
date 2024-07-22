<?PHP
/****************************************************************************\
* Plugin Manager 4 TaskFreak!                                                *
* Version: 0.2.5                                                             *
* Author: Searcher <searcher@dracon.biz>                                     *
******************************************************************************
* For: TaskFreak! Multi User                                                 *
* Version: 0.6.1                                                             *
* Authors: Stan Ozier <taskfreak@gmail.com>                                  *
* License:  http://www.gnu.org/licenses/gpl.txt (GPL)                        *
\****************************************************************************/

ob_start();
// [=== HTML ===================================================================] [original]
$pPageIsPublic = false;
include '_common.php';
include PRJ_INCLUDE_PATH.'html/header.php';

// [=== Version Check ==========================================================] [ok]
define(FRK_VERSION_REQ, "0.6.1");
if ($_GET['Ver_Confirm']) $_SESSION['FRK_VERSION_CONFIRM'] = true;
if (FRK_VERSION != FRK_VERSION_REQ && !$_SESSION['FRK_VERSION_CONFIRM']) { 
	echo '<div align="center" style="font-family:tahoma; font-size:11px; padding-top:50px; color:#FF0000">Sorry, wrong version, Plugin Manager requires TaskFreak <strong>v'.FRK_VERSION_REQ.'</strong><br><br><span style="color:#000">If you would like to proceed anyway, please <a href="?Ver_Confirm=ok">confirm again</a></span></div>';
	exit;
}	

// [=== Permission Check =======================================================] [ok]
if (!$objUser->checkLevel(4)) {
	echo '<div align="center" style="font-family:tahoma; font-size:11px; padding-top:50px; color:#FF0000">Sorry, only <strong>administrator</strong> can manage the plugins</div>';
	exit;
}	

// [=== Reload Page ============================================================] [ok]
if ($_SESSION['Reload_Page']) {
	$_SESSION['Reload_Page'] = false;
	echo '<script type="text/javascript">location.reload(true)</script>';
}

//echo (__LINE__);
// [=== Path ===================================================================] [ok]
define(ROOT_DIR, getcwd()."/");  // get root folder
define(PLG_DIR, "plugins/");
define(PLG_DATA_DIR, PLG_DIR."data/");
define(PLG_INSTALL_DIR, PLG_DIR."install/");
define(PLG_INSTALLED_DIR, PLG_DATA_DIR."installed/");
define(PLG_BACKUP_DIR, PLG_DATA_DIR."backup/");
define(PLG_UPLOAD_DIR, ROOT_DIR.PLG_INSTALL_DIR);
# WWW Path
define(PLG_FILE, substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1));
define(PLG_WWW_URL, rtrim("http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'],PLG_FILE));
define(PLG_DEFAULT_DIR, PLG_WWW_URL.PLG_DATA_DIR."default/");

// [=== Defaults ===============================================================] [ok]
$_SESSION['plg_Error'] = false;
$_SESSION['plg_Install'] = ($_GET['Install']) ? true : false;
$_SESSION['plg_Delete'] = ($_GET['DelConfirm']) ? true : false;
$_SESSION['plg_RevOrig'] = ($_GET['RevOrig']) ? true : false;

// [=== Functions - Permissions Info ===========================================] [ok]
function plg_Perms($DirFile) {
	clearstatcache();  // no cached info
	$Perms = fileperms($DirFile);
	if (($Perms & 0xC000) == 0xC000) $Info = 's';  // socket
	elseif (($Perms & 0xA000) == 0xA000) $Info = 'l';  // symbolic Link
 	elseif (($Perms & 0x8000) == 0x8000) $Info = '-';  // regular
	elseif (($Perms & 0x6000) == 0x6000) $Info = 'b';  // block special
	elseif (($Perms & 0x4000) == 0x4000) $Info = 'd';  // directory
	elseif (($Perms & 0x2000) == 0x2000) $Info = 'c';  // character special
	elseif (($Perms & 0x1000) == 0x1000) $Info = 'p';  // FIFO pipe
	else $Info = 'u';  // unknown
	// Owner
	$Info .= (($Perms & 0x0100) ? 'r' : '-');
	$Info .= (($Perms & 0x0080) ? 'w' : '-');
	$Info .= (($Perms & 0x0040) ?
           (($Perms & 0x0800) ? 's' : 'x' ) :
           (($Perms & 0x0800) ? 'S' : '-'));
	// Group
	$Info .= (($Perms & 0x0020) ? 'r' : '-');
	$Info .= (($Perms & 0x0010) ? 'w' : '-');
	$Info .= (($Perms & 0x0008) ?
           (($Perms & 0x0400) ? 's' : 'x' ) :
           (($Perms & 0x0400) ? 'S' : '-'));
	// World
	$Info .= (($Perms & 0x0004) ? 'r' : '-');
	$Info .= (($Perms & 0x0002) ? 'w' : '-');
	$Info .= (($Perms & 0x0001) ?
           (($Perms & 0x0200) ? 't' : 'x' ) :
           (($Perms & 0x0200) ? 'T' : '-'));
	//$Info .= ' ('.substr(sprintf('%o', fileperms('/tmp')), -4).')';  // show numeral
	return $Info;
}

// [=== Functions - Dir Write Permissions ======================================] [ok]
function plg_DirPerms($DirName, $DirDesc=false) {
	$DirName = rtrim($DirName,"/")."/";  // make sure there's only one slash
	if (@is_dir(ROOT_DIR.$DirName)) {  // check if exists
		@rmdir(ROOT_DIR.$DirName."tmp");	// just in case it was left there accidentally
		if (@mkdir(ROOT_DIR.$DirName."tmp")) {
			@rmdir(ROOT_DIR.$DirName."tmp");	
		}
		else {
			$Error_Msg = '<span style="color:#FF0000">Your plugin '.$DirDesc.' folder does <strong>not</strong> have <strong>write</strong> permissions, <br />please check <strong style="color:#0066FF">'.$DirName.'</strong> in your taskfreak <strong>root</strong> folder </span><br /><br />Current permissions: <strong>'.plg_Perms(ROOT_DIR.$DirName).'</strong><br /><br />Suggested command: <br /> <strong style="color:#000">chmod 777 -R '.ROOT_DIR.$DirName.'</strong>';
		}
	}
	else {
		$Error_Msg = '<span style="color:#FF0000">Your plugin '.$DirDesc.' folder does <strong>not</strong> exist, <br />please create <strong style="color:#0066FF">'.$DirName.'</strong> in your taskfreak <strong>root</strong> folder </span><br /><br />suggested command: <br /> <strong style="color:#000">mkdir '.ROOT_DIR.$DirName.'</strong>';
	}	
	// if error show msg and exit
	if ($Error_Msg) { 
		echo '<div align="center" style="font-family:tahoma; font-size:11px; padding-top:50px">'.$Error_Msg.'</div>';
		exit;
	}	
	return true;
}

// [=== Permissions Check ======================================================] [entire plg folder tree]
plg_DirPerms(PLG_DIR);
plg_DirPerms(PLG_INSTALL_DIR, "install");
plg_DirPerms(PLG_DATA_DIR, "data storage");
plg_DirPerms(PLG_BACKUP_DIR, "data backup");
plg_DirPerms(PLG_INSTALLED_DIR, "include");
plg_DirPerms(PLG_DATA_DIR."default/", "css & image files (unzip and copy the contents)");  // let's not complicate it

// [=== Functions - UnZip ======================================================] [ok]
function plg_UnZip($ZipFile, $DstDir=false, $Del=false) {
	if (!$DstDir) $DstDir = dirname($ZipFile);
	$DstDir = rtrim($DstDir,"/")."/";  // make sure there's only one slash
	$ZipRes = zip_open($ZipFile);
	while ($ZipFileEntry = zip_read($ZipRes)) {
		$Entry = zip_entry_open($ZipRes, $ZipFileEntry);
		$FileName = zip_entry_name($ZipFileEntry);
		$TargetDir = $DstDir.substr($FileName, 0, strrpos($FileName, "/"));
		$FileSize = zip_entry_filesize($ZipFileEntry);
		if (is_dir($TargetDir) || mkdir($TargetDir)) {
			if ($FileSize > 0) {
				$Contents = zip_entry_read($ZipFileEntry, $FileSize);
				plg_WriteFile($DstDir.$FileName, $Contents, true, false);
			}
		}
	}
	zip_close($ZipRes);
	if ($Del) unlink($ZipFile);
}

// [=== Functions - Folder Contents List =======================================] [ok]
function plg_DirList($SrcDir) {
	$SourceDIR = dir($SrcDir);
	while(($File = $SourceDIR->read()) !== false) {
		if (is_dir($File) && $File != "." && $File != "..") $Listing[count($Listing)] = $File;
	}
	if (!@sort($Listing)) return false;
	reset($Listing);
	return $Listing;
}

// [=== Functions - Recursive Folder copy ======================================] [ok]
function plg_DirCopy($SrcDir, $DstDir, $Verbose=false, $Copy=false) {
	if (!is_dir($DstDir)) mkdir($DstDir);
	if ($CurDir = opendir($SrcDir)) {
		while ($File = readdir($CurDir)) {
			if ($File != "." && $File != "..") {
				$SrcFile = $SrcDir."/".$File;
				$DstFile = $DstDir."/".$File;
				if (is_file($SrcFile)) {
					if ($Copy) {
						if ($Verbose) echo "Copied '".str_replace("//", "/", $DstFile)."' ... ";
						if (copy($SrcFile, $DstFile)) {
							if ($Verbose) echo "<span style='color:green'>OK</span><br>";
						}
						else echo "Error: File '$SrcFile' could not be copied!<br>";
					}
					else { 
						echo "Create '".str_replace("//", "/", $DstFile)."' ... ";
						if (plg_WriteFile($DstFile)) echo "<span style='color:green'>OK</span><br>";
						else { 
							echo "<span style='color:red'>Write Error! - please check <strong>".str_replace("//", "/", $DstFile)."</strong></span><br>";
							$_SESSION['plg_Error'] = true;
						}
					}
				}
				else if (is_dir($SrcFile)) {
					plg_DirCopy($SrcFile, $DstFile, $Verbose, $Copy);
				}
			}
		}
		closedir($CurDir);
	}
}

// [=== Plugin Upload ==========================================================] [ok]
if ($_FILES['Plugin_Upload']) {  // form upload - depends on unzip function [ok]
	$ZipFile = basename($_FILES['Plugin_Upload']['name']);
	$Target = PLG_UPLOAD_DIR.$ZipFile; 
	if (move_uploaded_file($_FILES['Plugin_Upload']['tmp_name'], $Target)) {
		$_SESSION['Upload_Info'] = "The file " . $ZipFile . " has been uploaded";
		plg_UnZip($Target, false, true);  // unzip into current folder and delete zip file
		header("Location: ".PLG_FILE);
		exit;
	} else {
    $_SESSION['Upload_Info'] = "There was an error uploading the file, please try again!";
	}
}

// [=== MySQL Table Check ======================================================] [ok]
function plg_SQLCheck($Query) {
	$Counter = 0;
	$QryData = explode("CREATE TABLE", $Query);
	for ($i=1; $i < count($QryData); $i++) {
		$TabName = trim(substr($QryData[$i], 0, strpos($QryData[$i], "(")));
		# Check if exists
		$Qry = "SHOW TABLES LIKE '$TabName'";
		$Res = mysql_query($Qry);
		while($Line = @mysql_fetch_array($Res)){
			if ($Line[$Counter]) {
				plg_SQLInfo($Line[$Counter]);
			}
			$Counter++;
			$Exists = true;
		}
		if (!$Exists) {
			echo "<em>Creating New Tables:</em> <pre style='color:green'>$TabName</pre>";
		}
	}
}

// [=== MySQL Table Info =======================================================] [ok]
function plg_SQLInfo($Table) {
	# Make diff between install and del
	$Action = ($_GET['DelPlugin']) ? "Delete" : "Install";
	if ($Action == "Install") {
		?>
			<span style="color:red">Table <strong><?php echo $Table; ?></strong> already exists, would you like to drop it?</span>
			<a href="?Info=<?php echo $_GET['Info']; ?>&SQLDrop=<?php echo $Table; ?>" onclick="if (!OkCancel('Are you sure?')) return false" style="vertical-align:middle">
				<img src="plugins/data/default/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()">
			</a>
			<br />
		<?php	
	}
	else if ($Action == "Delete") {
		?>
			<span style="color:red"><strong><?php echo $Table; ?></strong> detected, would you like to drop it?</span>
			<a href="?DelPlugin=<?php echo $_GET['DelPlugin']; ?>&SQLDrop=<?php echo $Table; ?>" onclick="if (!OkCancel('Are you sure?')) return false" style="vertical-align:middle">
				<img src="plugins/data/default/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()">
			</a>
			<br />
		<?php	
	}
	else return false;
}

// [=== MySQL Existing Table Drop ==============================================] [ok]
if ($_GET['SQLDrop']) {
	$Qry = "DROP TABLE ".$_GET['SQLDrop'];
	mysql_query($Qry);
	// redirect accordingly
	if ($_GET['DelPlugin']) echo "<script>location.href='".$_SERVER['PHP_SELF']."?DelPlugin=".$_GET['DelPlugin']."'</script>";
	else echo "<script>location.href='".$_SERVER['PHP_SELF']."?Info=".$_GET['Info']."'</script>";
}

// [=== Functions - Write File =================================================] [ok]
function plg_WriteFile($Target, $Source=false, $Write=false, $Verbose=true) {
	if (!$Write) {
		if (!file_exists($Target)) $Unlink = true;
		if ($File = fopen($Target, 'a')) {
 			fclose($File);
			if ($Unlink) unlink($Target);
			return true;
		}
		else return false;
	}
	else {
		if ($File = fopen($Target, 'w+')) {
			if (fwrite($File, $Source) === false) {
				if ($Verbose) echo "Cannot write to file<br>";
				return false;
			}
			else {
				if ($Verbose) echo "<span style='color:green'>File successfully updated</span><br>";
			}
			return true;
		}
		fclose($File);
	}
}

// [=== Functions - Modify File ================================================] [ok]
function plg_Modify($SrcDir, $DstDir, $Verbose=false, $Modify=false, $Reverse=false) {
	if (!is_dir($DstDir)) @mkdir($DstDir);
	if ($CurDir = @opendir($SrcDir)) {
		while ($File = readdir($CurDir)) {
			if ($File != '.' && $File != '..') {
				$SrcFile = $SrcDir."/".$File;
				$DstFile = $DstDir."/".$File;
				if (is_file($SrcFile)) {
					# Modify
					if ($Modify) {
						# Backup
						if (!$Reverse) plg_Backup($DstFile, $File); // more fixes to come
						if ($Reverse) echo "Reversed '".str_replace("//", "/", $DstFile)."' ... ";
						if (!$Reverse && $Verbose) echo "Updated '".str_replace("//", "/", $DstFile)."' ... ";
						if (plg_WriteFile($DstFile)) {
							if ($Verbose) echo "<span style='color:green'>OK</span><br>";
							plg_UpdateFile($SrcFile, $DstFile, $File, true, $Reverse);
						}
						else { 
							echo "<span style='color:red'>Write Error! - please check <strong>".str_replace("//", "/", $DstFile)."</strong></span><br>";
							$_SESSION['plg_Error'] = true;
						}
					}
					# View only
					else { 
						if ($Reverse) echo "Reverse '".str_replace("//", "/", $DstFile)."' ... ";
						else echo "Update '".str_replace("//", "/", $DstFile)."' ... ";
						if (plg_WriteFile($DstFile)) {
							plg_UpdateFile($SrcFile, $DstFile, $File);
							echo "<span style='color:green'>OK</span><br>";
						}
						else { 
							echo "<span style='color:red'>Write Error! - please check <strong>".str_replace("//", "/", $DstFile)."</strong></span><br>";
							// check for new file
							$Source = file_get_contents($SrcFile);
							$Mods = substr_count($Source, "---[find]---"); 
							if (!$Mods) {
								echo "<span style='color:blue'>This is a new file, please enable write permissions on <strong>".str_replace("//", "/", trim($DstFile,$File))."</strong></span><br>";
							}
							$_SESSION['plg_Error'] = true;
						}
					}
				}
				else if (is_dir($SrcFile)) {
					plg_Modify($SrcFile, $DstFile, $Verbose, $Modify, $Reverse);
				}
			}
		}
		closedir($CurDir);
	}
}

// [=== Functions - Recursive Delete ===========================================] [ok]
function plg_DirDel($SrcDir, $Verbose=false, $Del=false) {
	if ($SrcDir==ROOT_DIR.PLG_INSTALL_DIR) return false;  // resubmit fix - don't touch the main folders
	if ($CurDir = opendir($SrcDir)) {
		while ($File = readdir($CurDir)) {
			if ($File != "." && $File != "..") {
				$SrcFile = $SrcDir."/".$File;
				if (is_file($SrcFile)) {
					if ($Del) {
						if ($Verbose) echo 'Delete '.$SrcFile.' ... ';
						if (unlink($SrcFile) && ($Verbose)) echo "<span style='color:green'>OK</span><br>";
						else { 
							echo "<span style='color:red'>Write Error! - please check <strong>".str_replace("//", "/", $SrcFile)."</strong></span><br>";
							$_SESSION['plg_Error'] = true;
						}
					}
					else {
						if ($Verbose) echo 'Delete '.$SrcFile.'<br>';
					}
				}
				else if (is_dir($SrcFile)) {
					plg_DirDel($SrcFile, $Verbose, $Del);
				}
			}
		}
		closedir($CurDir);
		if ($Del) {
			if ($Verbose) echo 'Remove '.$SrcDir.' ... ';
			if (rmdir($SrcDir) && ($Verbose)) echo "<span style='color:green'>OK</span><br>";
			else { 
				echo "<span style='color:red'>Write Error! - please check <strong>".str_replace("//", "/", $SrcDir)."</strong></span><br>";
				$_SESSION['plg_Error'] = true;
			}
		}
		else {
			if ($Verbose) echo 'Remove '.$SrcDir.'<br>';
		}		
	}
}

// [=== Functions - Update File ================================================] [in progress]
function plg_UpdateFile($SrcFile, $DstFile, $FileName, $Update=false, $Reverse=false) {
	$Source = file_get_contents($SrcFile);
	$Mods = substr_count($Source, "---[find]---"); 
	if (!$Update) {
		if (!file_exists($DstFile) || !@filesize($DstFile) || !$Mods) echo "(new file) - ";
		else {
			echo "(".$Mods." mod";
			echo ($Mods == 1) ? ") - " : "s) - ";
		}
	}
	else {
		# If new file - place it where it belongs
		if (!file_exists($DstFile) || !@filesize($DstFile) || !$Mods) {
			if ($Reverse)	unlink($DstFile);
			else plg_WriteFile($DstFile, $Source, $Update);
			return true;
		}
		
		# If Backup exists -- requires backup fix first
		if (file_exists(PLG_BACKUP_DIR.PLG_DIR."/".$FileName)) {
			$Target = file_get_contents(PLG_BACKUP_DIR.PLG_DIR."/".$FileName);
			$Original = true;
		}
		else $Target = file_get_contents($DstFile);
		
		# Reverse original source choice - only with backup
		if ($Reverse && $_SESSION['plg_RevOrig'] && $Original) {
			plg_WriteFile($DstFile, $Target, $Update);
			return true;
		}

		# Search & Replace
		$SrcData = explode("---[find]---", $Source);
		for ($i=1; $i < count($SrcData); $i++) {
			$DstData = explode("---[replace]---", $SrcData[$i]);
			$DstData[0] = trim($DstData[0], "\r\n");
			$DstData[1] = trim($DstData[1], "\r\n");
			
			//echo "<hr size=1 color='green'>".$DstData[0];
			//echo "<hr size=1 color='gray'>".$DstData[1]."\n\n";
			/* Fancy stuff
			$MsgStart = "// Modified by Plugin Manager for: ".PLG_DIR." --- START ---";
			$MsgEnd = "// Modified by Plugin Manager for: ".PLG_DIR." --- START ---";
			$Target = str_replace($DstData[0], $MsgStart."\n".$DstData[1]."\n".$MsgEnd, $Target);
			*/
			
			if ($Reverse) $Target = str_replace($DstData[1], $DstData[0], $Target);
			else $Target = str_replace($DstData[0], $DstData[1], $Target);
		}
		//echo "<hr>".$Target."<hr>";
		plg_WriteFile($DstFile, $Target, $Update);
	}
}



// [=== Functions - Backup Upated Files ========================================] [in progress]
function plg_Backup($Source, $FileName) {
	# Requires recursive copy, this is useless - to be fixed
	/*
	# New file fix
	if (file_exists($Source)) {
		if (!file_exists("../data/backup/".PLG_DIR)) @mkdir("../data/backup/".PLG_DIR);
		if (!file_exists("../data/backup/".PLG_DIR."/".$FileName)) copy($Source, "../data/backup/".PLG_DIR."/".$FileName); 
	}
	*/
	return true;
}





// === Class ===================================================================
class plg_Main {

	var $Plugin;
	
	function plg_Main($ID=false){
		$Qry = "SELECT * FROM ".TZN_DB_PREFIX."_plugins WHERE pluginId='$ID'";
		$Res = mysql_query($Qry);
		if ($Line = @mysql_fetch_assoc($Res)) {
			foreach($Line as $Index => $Value) $this->$Index = $Value;
		} 
		else return false;
	}
	
	function GetList(){
		$Ret = array();
		$Qry = "SELECT pluginId FROM ".TZN_DB_PREFIX."_plugins ORDER BY pluginId ASC";
		$Res = mysql_query($Qry);
		if (@mysql_num_rows($Res)==0) return false;
		else {
			while($Line = mysql_fetch_array($Res)) {
				array_push($Ret,$Line["pluginId"]);
			}
			return $Ret;
		}
	}

	function CheckName($Title){
		$Qry = "SELECT title FROM ".TZN_DB_PREFIX."_plugins WHERE title = '".$Title."'";
		$Res = mysql_query($Qry);
		if (@mysql_num_rows($Res)==0) return false;
		return true;
	}

	function CheckVer($Ver){
		$Qry = "SELECT version FROM ".TZN_DB_PREFIX."_plugins WHERE version = '".$Ver."'";
		$Res = mysql_query($Qry);
		if (@mysql_num_rows($Res)==0) return false;
		return true;
	}

}


// -------------- PLUGINS LIST ------------------------------------------
chdir(ROOT_DIR.PLG_INSTALL_DIR);
?>
<link rel="stylesheet" type="text/css" href="<?php echo PLG_DEFAULT_DIR; ?>css/plugins.css" />
<script type="text/javascript" language="JavaScript" src="<?php echo PLG_DEFAULT_DIR; ?>scripts/plugins.js"></script>

<?php 
if ($_GET['Info']!="") { 
	define(PLG_ACTIVE_DIR, $_SESSION['Dir'][$_GET['Info']]."/");  // define active plugin
	define(PLG_FULL_ACTIVE_DIR, ROOT_DIR.PLG_INSTALL_DIR.PLG_ACTIVE_DIR);  // define active plugin full dir
	include PLG_FULL_ACTIVE_DIR."config.php";
?>
<div align="center" style="padding:10px">
	<h2 style="font-family:verdana; color:#006600"><span style="color:#000000"><?php echo $Title; ?></span> - Plugin Installation Information</h2>
	<table class="plugins_default" style="border:1px dashed gray" cellpadding="10"><tr><td align="left">
		<strong>General</strong>
		<hr color="#000000" size="1" />
		<em>Description:</em> <strong><?php echo $Description; ?></strong><br />
		<em>Version:</em> <?php echo $Version; ?><br />
		<em>Author:</em> <?php echo $Author; ?><br />
		<em>Release Date:</em> <?php echo $Date; ?><br />
		<em>Size:</em> <?php echo $Size; ?><br />
		<br />
		<strong>SQL</strong>
		<hr color="#000000" size="1" />
		<em>SQL File:</em> <?php echo $SQL; ?><br />
		<em>Table Prefix:</em> <?php echo TZN_DB_PREFIX; ?><br />
		<?php 
		$SQL_Cont = @file_get_contents(PLG_FULL_ACTIVE_DIR."db.sql"); 
		$SQL_Cont = str_replace("prefix_", TZN_DB_PREFIX."_", $SQL_Cont); 
		plg_SQLCheck($SQL_Cont);
		?>
		<em>Query: </em><pre><?php echo $SQL_Cont; ?></pre>
		<?php 
			# Finally create that poor table
			if ($_SESSION['plg_Install']) {
				mysql_query($SQL_Cont);
				if (!mysql_error()) echo "<span style='color:green'>Table(s) successfully created</span>";
			}
		?>

		<br />
		<strong>Files</strong>
		<hr color="#000000" size="1" />
		<em>New Files:</em> 
			<?php
				echo "<pre>";
				if ($_SESSION['plg_Install']) plg_DirCopy(PLG_FULL_ACTIVE_DIR, ROOT_DIR.PLG_INSTALLED_DIR.PLG_ACTIVE_DIR, true, true);
				else plg_DirCopy(PLG_FULL_ACTIVE_DIR, ROOT_DIR.PLG_INSTALLED_DIR.PLG_ACTIVE_DIR);
			 	echo "</pre>";
			?>
		<br />
		<em>Files to be modified:</em> 
		<?php
			echo "<pre>";
			if ($_SESSION['plg_Install']) plg_Modify(PLG_FULL_ACTIVE_DIR."modify", ROOT_DIR, true, true);
			else plg_Modify(PLG_FULL_ACTIVE_DIR."modify", ROOT_DIR, true);
			echo "</pre>";
		?>
		<br />
		<strong>Clean Up</strong>
		<hr color="#000000" size="1" />
		<em>Clean up the installation dir<br /></em> 
		<?php
			if ($_SESSION['plg_Install']) {
				# Change it to object after the cheesecake - or not ;)
				$Qry = "INSERT INTO ".TZN_DB_PREFIX."_plugins (title,description,icon,version,author,released,readme,changelog,size,sqlfile,folder,status) 
								VALUES ('$Title','$Description','$Icon','$Version','$Author','$Date','$Readme','$Changelog','$Size','$SQL','".PLG_ACTIVE_DIR."',1)";
				mysql_query($Qry);
				# Delete Install Dir
				echo "<pre>";
				plg_DirDel(PLG_FULL_ACTIVE_DIR, true, true);
				echo "</pre>";
				?>
					<div align="center">
					<h2 style="color:#009900">Plugin installed</h2>
					<span id="plg_redirector">Redirecting in x seconds...</span>
					<?php $_SESSION['Reload_Page'] = true; ?>
					<script type="text/javascript">plg_Redirector(5)</script>
				<?php
			}
			# Check permissions
			else { 
				plg_DirPerms(PLG_INSTALL_DIR.PLG_ACTIVE_DIR, "install");
			}

		if (!$_SESSION['plg_Install']) {
		?>
			<div align="center">
			<?php if ($_SESSION['plg_Error']) { ?>
				<h2 style="color:#FF0000">Please check your settings, there seems to be an errrrrrror</h2>
			<?php } ?>
			<?php
				$plg_ObjPlugin = new plg_Main($_GET['Info']);
				if ($plg_ObjPlugin->CheckName($Title) && $plg_ObjPlugin->CheckVer($Version)) {
			?>	
					<h2 style="color:#FF0000">Same plugin is already installed</h2>
			<?php } ?>
			<?php if (!$_SESSION['plg_Error']) { ?>
				<h2 style="color:#009900">Proceed to installation</h2>
				<a href="?Info=<?php echo $_GET['Info']; ?>&Install=YesPleeeeease#plg_Done">
					<img src="plugins/data/default/images/install.gif" width="16" height="16" border="0" alt="Install" title="Install" onclick="this.blur()">
				</a>
			<?php } ?>
		
		<?php } ?>
		</div>
	</td></tr></table>
</div>



<?php 
}
else if ($_GET['DelPlugin']!="") { 
	chdir(ROOT_DIR.PLG_INSTALLED_DIR);

	$plg_ObjPlugin = new plg_Main();
	$plg_ObjPlugin->plg_Main($_GET['DelPlugin']);

	define(PLG_ACTIVE_DIR, $plg_ObjPlugin->folder);  // define active plugin
	define(PLG_FULL_ACTIVE_DIR, ROOT_DIR.PLG_INSTALLED_DIR.PLG_ACTIVE_DIR);  // define active plugin full dir
	include PLG_FULL_ACTIVE_DIR."config.php";
?>
<div align="center" style="padding:10px">
	<h2 style="font-family:verdana; color:#FF0000"><span style="color:#000000"><?php echo $Title; ?></span> - Plugin Removal Information</h2>
	<table class="plugins_default" style="border:1px dashed gray" cellpadding="10"><tr><td align="left">
		<strong>General</strong>
		<hr color="#000000" size="1" />
		<em>Description:</em> <?php echo $Description; ?><br />
		<em>Version:</em> <?php echo $Version; ?><br />
		<em>Author:</em> <?php echo $Author; ?><br />
		<em>Release Date:</em> <?php echo $Date; ?><br />
		<em>Size:</em> <?php echo $Size; ?><br />
		<br />
		<strong>SQL</strong>
		<hr color="#000000" size="1" />
		<em>SQL File:</em> <?php echo ($SQL) ? $SQL : "No SQL file"; ?><br />
		<em>Table Prefix:</em> <?php echo TZN_DB_PREFIX; ?><br />
		<?php 
		$SQL_Cont = @file_get_contents(PLG_FULL_ACTIVE_DIR.$plg_ObjPlugin->sqlfile); 
		$SQL_Cont = str_replace("prefix_", TZN_DB_PREFIX."_", $SQL_Cont); 
		plg_SQLCheck($SQL_Cont);
		?>
		<br /><br />
		<strong>Files Clean Up</strong>
		<hr color="#000000" size="1" />

		<!-- Modification parx -->
		<em>List of modified files:</em> 
			<?php
				echo "<pre>";
				if ($_SESSION['plg_Delete']) plg_Modify(PLG_FULL_ACTIVE_DIR."modify", ROOT_DIR, true, true, true);
				else plg_Modify(PLG_FULL_ACTIVE_DIR."modify", ROOT_DIR, true, false, true);
				echo "</pre>";
			?>

			<?php if ($_SESSION['plg_RevOrig']) { ?>
				<span style="color:red">Active: <strong>Replace</strong></span><br />
				<span style="color:red">Change to: <strong>Reverse</strong> files with mod instruction</span>
				<a href="?DelPlugin=<?php echo $_GET['DelPlugin']; ?>" onclick="if (!OkCancel('Are you sure?')) return false" style="vertical-align:middle">
					<img src="plugins/data/default/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()">
				</a>
				<br />
			<?php } else { ?>
				<span style="color:red">Active: <strong>Reverse</strong></span><br />
				<span style="color:red">Change to: <strong>Replace</strong> files with originals (saved during installation)</span>
				<a href="?DelPlugin=<?php echo $_GET['DelPlugin']; ?>&RevOrig=x" onclick="if (!OkCancel('Are you sure?')) return false" style="vertical-align:middle">
					<img src="plugins/data/default/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()">
				</a>
				<br />
			<?php } ?>
			
		<br />
		<em>Files to be deleted:</em> 
		<?php
			echo "<pre>";
			if ($_SESSION['plg_Delete']) {
				# Copy back to install dir
				plg_DirCopy(PLG_FULL_ACTIVE_DIR, ROOT_DIR.PLG_INSTALL_DIR.PLG_ACTIVE_DIR, false, true);
				plg_DirDel(PLG_FULL_ACTIVE_DIR, true, true);
			}
			else plg_DirDel(PLG_FULL_ACTIVE_DIR, true);
			echo "</pre>";
		?>

		<br /><br />
		<strong>Finish</strong>
		<hr color="#000000" size="1" />
		<em>Clean up the leftovers<br /></em> 
			<?php
				if ($_SESSION['plg_Delete']) {
					# Remove DB Entry
					$Qry = "DELETE FROM ".TZN_DB_PREFIX."_plugins WHERE pluginId = ".$plg_ObjPlugin->pluginId;
					mysql_query($Qry);
					?>
						</pre>
						<div align="center">
						<h2 style="color:#009900">Plugin removed</h2>
						<span id="plg_redirector">Redirecting in x seconds...</span>
						<?php $_SESSION['Reload_Page'] = true; ?>
						<script type="text/javascript">plg_Redirector(5)</script>
					<?php
				}
			?>

		<?php
		if (!$_SESSION['plg_Delete']) {
		?>
			<div align="center">
			<?php if ($_SESSION['plg_Error']) { ?>
				<h2 style="color:#FF0000">Please check your settings, there seems to be an errrrrrror</h2>
			<?php } else { ?>
				<h2 style="color:#FF0000">Proceed to removal</h2>
				<a href="?DelPlugin=<?php echo $_GET['DelPlugin']; ?>&DelConfirm=Yeeeeeah#plg_Done">
					<img src="plugins/data/default/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()">
				</a>
			<?php } ?>
		
		<?php } ?>
		</div>
	</td></tr></table>
</div>

<?php 
} 
else if ($_GET['ReinstallPlugin']!="") { 
	chdir(ROOT_DIR.PLG_INSTALLED_DIR);

	$plg_ObjPlugin = new plg_Main();
	$plg_ObjPlugin->plg_Main($_GET['ReinstallPlugin']);

	define(PLG_ACTIVE_DIR, $plg_ObjPlugin->folder);  // define active plugin
	define(PLG_FULL_ACTIVE_DIR, ROOT_DIR.PLG_INSTALLED_DIR.PLG_ACTIVE_DIR);  // define active plugin full dir
	include PLG_FULL_ACTIVE_DIR."config.php";

	if ($_GET['ReinstallConfirm']!="") { 
	?>
	<div align="center" style="padding:10px">
		<h2 style="font-family:verdana; color:#0000FF"><span style="color:#000000"><?php echo $Title; ?></span> - Plugin Reinstallation</h2>
		<table width="500" class="plugins_default" style="border:1px dashed gray" cellpadding="10"><tr><td align="left">
			<?php plg_Modify(PLG_FULL_ACTIVE_DIR."modify", ROOT_DIR, true, true, true); ?>
			<br /><br />
			<?php plg_Modify(PLG_FULL_ACTIVE_DIR."modify", ROOT_DIR, true, true); ?>
			<br /><br />
			<div align="center">
				<h2 style="color:#009900">Plugin reinstalled</h2>
				<span id="plg_redirector">Redirecting in x seconds...</span>
				<?php $_SESSION['Reload_Page'] = true; ?>
				<script type="text/javascript">plg_Redirector(5)</script>
			</div>	
		</td></tr></table>
	</div>
	<?php
	}
	else {
	?>
	<div align="center" style="padding:10px">
		<h2 style="font-family:verdana; color:#0000FF"><span style="color:#000000"><?php echo $Title; ?></span> - Plugin Reinstallation</h2>
		<table width="500" class="plugins_default" style="border:1px dashed gray" cellpadding="10"><tr><td align="left">
			<strong>This is a turbo installation process to reenable your previous plugins after updating the main code.</strong>
			<br /><br />
			<strong style="color:#FF0000">Warning:</strong> Your old plugins might not be 100% compatible with the brand new TaskFreak! vanilla code, so don't be surprised if they won't work after reinstallation. If you want an absolutely clean process, get all newest plugins and install them from scratch. 
			<br /><br />
			<strong style="color:#0000FF">Final Note:</strong> If you got this far, you might be lazy or faithful, either way, by clicking on the icon below the current plugin will attempt to reinstall itself with no questions asked (but if permission or other errors occur, you will be notified) - your db entries won't be touched, though.
			<br /><br />
			<div align="center">
				<a href="?ReinstallPlugin=<?php echo $plg_ObjPlugin->pluginId; ?>&ReinstallConfirm=Yeeeeeah#plg_Done" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/update.gif" width="16" height="16" border="0" alt="Reinstall" title="Reinstall" onclick="this.blur()"></a>
			</div>	
		</td></tr></table>
	</div>
<?php
	}
} else { 
	$_SESSION['plg_Kill'] = false;
?>

<!-- Plugin Main Listing -->
<div style="padding:10px; margin-top:20px; border:1px solid #ccc; padding: 10px">
<table class="plugins_default" cellpadding="0" cellspacing="0" border="0" width="100%">

	<?php if ($_SERVER['QUERY_STRING'] == "OnlineCheck" || $_GET['DownloadPlugin']) { ?>
		<tr style="background-color:#FFFF99">
			<td class="plugins_td" style="border-left:1px solid #ccc">&nbsp;</td>
			<td class="plugins_td" nowrap colspan="2">Downloadable Plugins</td>
			<td class="plugins_td" nowrap>Description</td>
			<td class="plugins_td" nowrap>Version</td>
			<td class="plugins_td" nowrap>Author</td>
			<td class="plugins_td" nowrap>Size</td>
			<td align="center" class="plugins_td" nowrap style="border-right:1px solid #ccc">Get</td>
		</tr>

		<?php
		// fetch online list
		$plg_Online_Data = file('http://www.dracon.biz/download/online_plugins.txt');
		foreach ($plg_Online_Data as $plg_Online_Line) {
			$plg_Online_Line = explode("] [", $plg_Online_Line);
			$plg_Online['Order'] = trim($plg_Online_Line[0], "[]");
			$plg_Online['Title'] = trim($plg_Online_Line[1], "[]");
			$plg_Online['Description'] = trim($plg_Online_Line[2], "[]");
			$plg_Online['Version'] = trim($plg_Online_Line[3], "[]");
			$plg_Online['Author'] = trim($plg_Online_Line[4], "[]");
			$plg_Online['Size'] = trim($plg_Online_Line[5], "[]");
			$plg_Online['File'] = trim(ereg_replace("\[|\]","", $plg_Online_Line[6]));
			
			# Download file and unzip it
			if ($_GET['DownloadPlugin'] == $plg_Online['Order']) {
				copy('http://www.dracon.biz/download/'.$plg_Online['File'], PLG_UPLOAD_DIR.$plg_Online['File']); 
				plg_UnZip(PLG_UPLOAD_DIR.$plg_Online['File'], false, true);  // unzip into current folder and delete zip file
				header("Location: ".PLG_FILE."?OnlineCheck");
			}
		?>

	<tr>
		<td class="plugins_text"><?php echo '<span style="font-size:11px; color:#0000FF">'.$plg_Online['Order'].'.</span>'; ?></td>
		<td width="20%" nowrap class="plugins_text">
			<?php echo $plg_Online['Title']; ?>
		</td>
		<td nowrap valign="top" class="plugins_text">&nbsp;</td>
		<td width="60%" class="plugins_text">
			<?php echo $plg_Online['Description']; ?>
		</td>
		<td width="5%" align="center" valign="top" class="plugins_text">
			<?php echo $plg_Online['Version']; ?>
		</td>
		<td width="15%" nowrap valign="top" class="plugins_text">
			<?php echo $plg_Online['Author']; ?>
		</td>
		<td width="15%" nowrap valign="top" class="plugins_text" align="right">
			<?php echo $plg_Online['Size']; ?>
		</td>
		<td width="1%" align="center" valign="top" class="plugins_text">
			<?php
			# Check if installed
			$Qry = "SELECT pluginId FROM ".TZN_DB_PREFIX."_plugins WHERE title='".$plg_Online['Title']."' && version='".$plg_Online['Version']."'";
			$Res = @mysql_result(mysql_query($Qry),0);
			if ($Res) $Error = true;
			?>			
			<?php if ($Error) { $Error = false; // clean var for further use ?>
				<img src="<?php echo PLG_DEFAULT_DIR; ?>/images/download_g.gif" width="16" height="16" border="0" alt="Installed" title="Installed" onclick="this.blur()">
			<?php } else { ?>
				<a href="?DownloadPlugin=<?php echo $plg_Online['Order']; ?>" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/download.gif" width="16" height="16" border="0" alt="Download" title="Download" onclick="this.blur()"></a>
			<?php } ?>
		</td>
	</tr>

  <?php }  // finish listing ?>

	<tr><td><br /></td></tr>

  <?php } // onlinecheck end ?>
	      
	<tr style="background:#F3F7FA">
		<td class="plugins_td" style="border-left:1px solid #ccc">&nbsp;</td>
		<td class="plugins_td" nowrap colspan="2">Available Plugins</td>
		<td class="plugins_td" nowrap>Description</td>
		<td class="plugins_td" nowrap>Version</td>
		<td class="plugins_td" nowrap>Author</td>
		<td class="plugins_td" nowrap>Size</td>
		<td align="center" class="plugins_td" nowrap style="border-right:1px solid #ccc">Install</td>
	</tr>

	<?php
	# List available plugins
	$Library = plg_DirList(".");
	
	for ($i=0; $i < count($Library); $i++) {
		if ($_GET['DelFolder'] != "" && $_GET['DelFolder'] == $i) {
			plg_DirDel(ROOT_DIR.PLG_INSTALL_DIR.$Library[$i], true, true);
			if (!$_SESSION['plg_Error']) header("Location: ".PLG_FILE);
			exit;
		}
		if (file_exists($Library[$i]."/config.php")) include $Library[$i]."/config.php";
		if (!$Title || !$Description || !$Version || !$Author || !$Size) $Error = true;
	?>

	<tr>
		<td width="1%" class="plugins_text">
			<?php if ($Icon) { ?>
			
				<img src="<?php echo PLG_INSTALL_DIR."/".$Library[$i]."/".$Icon; ?>" width="16" height="16" alt="Plugin" title="Plugin" onclick="this.blur()">
			<?php } else { ?>
				<?php if ($Library) { ?>
					<img src="<?php echo PLG_DEFAULT_DIR; ?>/images/noicon.gif" width="16" height="16" alt="Plugin" title="Plugin" onclick="this.blur()">
				<?php } ?>
			<?php } ?>
		</td>
		<td width="20%" nowrap class="plugins_text">
			<?php 
			if ($Error) echo $Library[$i];
			else echo $Title; 
			?>
		</td>
		<td nowrap valign="top" class="plugins_text">
			<?php if (!$Error) { ?>
				<a href="?Info=<?php echo $i; ?>"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/info.gif" width="16" height="16" border="0" alt="Info" title="Info" onclick="this.blur()"></a>
			<?php $_SESSION['Dir'][$i] = $Library[$i]; } ?>
			<?php if ($Readme) { ?>
				<a href="<?php echo PLG_INSTALL_DIR."/".$Library[$i]."/".$Readme; ?>"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/readme.gif" width="16" height="16" border="0" alt="Readme" title="Readme" onclick="this.blur()"></a>
			<?php } else { ?>
				<img src="<?php echo PLG_DEFAULT_DIR; ?>/images/spacer.gif" width="16" height="0">
			<?php } ?>
			<?php if ($Changelog) { ?>
				<a href="<?php echo PLG_INSTALL_DIR."/".$Library[$i]."/".$Changelog; ?>"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/changelog.gif" width="16" height="16" border="0" alt="Changelog" title="Changelog" onclick="this.blur()"></a>
			<?php } else { ?>
				<img src="<?php echo PLG_DEFAULT_DIR; ?>/images/spacer.gif" width="16" height="0">
			<?php } ?>
		</td>
		<td width="60%" class="plugins_text">
			<?php if ($Error) { ?>
				<?php if ($Library) { ?>
					<span style="color:#FF0000">Error: Incomplete configuration file</span>
				<?php } ?>
			<?php } else echo $Description; ?>
		</td>
		<td width="5%" align="center" valign="top" class="plugins_text">
			<?php echo $Version; ?>
		</td>
		<td width="15%" nowrap valign="top" class="plugins_text">
			<?php echo $Author; ?>
		</td>
		<td width="15%" nowrap valign="top" class="plugins_text" align="right">
			<?php echo $Size; ?>
		</td>
		<td width="1%" align="center" valign="top" class="plugins_text">
			<?php
			# Check if installed
			$Qry = "SELECT pluginId FROM ".TZN_DB_PREFIX."_plugins WHERE title='$Title' && version='$Version'";
			$Res = @mysql_result(mysql_query($Qry),0);
			if ($Res) $Error = true;
			?>			
			<?php if ($Error) { ?>
				<?php if ($Library) { ?>
					<a href="?DelFolder=<?php echo $i; ?>" onclick="if (!OkCancel('Are you sure?')) return false">
						<img src="<?php echo PLG_DEFAULT_DIR; ?>/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()">
					</a>
				<?php } ?>
			<?php } else { ?>
				<a href="?Info=<?php echo $i; ?>" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/install.gif" width="16" height="16" border="0" alt="Install" title="Install" onclick="this.blur()"></a>
				<a href="?DelFolder=<?php echo $i; ?>" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()"></a>
			<?php } ?>
		</td>
	</tr>

	<!-- Effectos del mondos ~ disabled -->
	<tr id="id_row" style="display:none; background:#E7FBDE">
		<td width="1%" class="plugins_text">&nbsp;
		</td>
		<td colspan="6" nowrap class="plugins_text">Plugin installed successfully.</td>
		<td class="line-bottom-border" align="center">
				<img src="<?php echo PLG_DEFAULT_DIR; ?>/images/ok.gif" height="16" width="16" onclick="this.blur()"/>
		</td>
	</tr>

	<?php 
	$Title = false;	$Description = false;	$Version = false;	$Author = false; $Size = false; $Readme = false; $Changelog = false;
	$Error = false;
	} 
	?>

	<tr><td><br /></td></tr>

	<!-- Upload new plugin -->
	<form enctype="multipart/form-data" method="post">
	<tr id="Upload" style="display:true; background:#E7FBDE">
		<td class="plugins_text">&nbsp;</td>
		<td colspan="2" nowrap class="plugins_text">&nbsp;<?php echo $_SESSION['Upload_Info']; $_SESSION['Upload_Info'] = ''; ?></td>
		<td colspan="4" nowrap class="plugins_text" align="right"> 
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				Check online <a href="?OnlineCheck" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/update.gif" width="16" height="16" border="0" alt="Reinstall" title="Reinstall" onclick="this.blur()" align="absmiddle"></a> or choose a file to upload: <input name="Plugin_Upload" type="file" />
		</td>
		<td class="plugins_text" align="center"> 
				<input type="image" src="plugins/data/default/images/ok.gif" height="16" width="16" alt="Upload File" title="Upload File" align="absmiddle" onclick="if (!OkCancel('Are you sure?')) return false" />
		</td>
	</tr>
	</form>
	
	<tr><td><br/></td></tr>

	<tr style="background:#CCCCFF;">
		<td class="plugins_td" style="border-left:1px solid #ccc">&nbsp;</td>
		<td class="plugins_td" nowrap colspan="2">Installed Plugins</td>
		<td class="plugins_td" nowrap>Description</td>
		<td class="plugins_td" nowrap>Version</td>
		<td class="plugins_td" nowrap>Author</td>
		<td class="plugins_td" nowrap>Size</td>
		<td align="center" class="plugins_td" nowrap style="border-right:1px solid #ccc">Delete</td>
	</tr>

	<?php
	$plg_ObjList = plg_Main::GetList();
	
	if ($plg_ObjList) {
		foreach ($plg_ObjList as $PluginID) {
			$plg_Counter++;
			$plg_ObjPlugin = new plg_Main();
			$plg_ObjPlugin->plg_Main($PluginID);
		?>
	
		<tr>
			<td width="1%" class="plugins_text">
				<?php if ($plg_ObjPlugin->icon) { ?>
					<img src="<?php echo PLG_WWW_URL.PLG_INSTALLED_DIR.$plg_ObjPlugin->folder.$plg_ObjPlugin->icon; ?>" width="16" height="16" alt="Plugin" title="Plugin" onclick="this.blur()">
				<?php } else { ?>
					<img src="<?php echo PLG_DEFAULT_DIR; ?>images/noicon.gif" width="16" height="16" alt="Plugin" title="Plugin" onclick="this.blur()">
				<?php } ?>
			</td>
			<td width="20%" nowrap class="plugins_text">
				<?php echo '<span style="font-size:11px; color:#990000">'.$plg_Counter.'.</span> '; ?>
				<?php echo $plg_ObjPlugin->title; ?>
			</td>
			<td nowrap valign="top" class="plugins_text" align="right">
				<?php if ($plg_ObjPlugin->readme) { ?>
					<a href="<?php echo PLG_WWW_URL.PLG_INSTALLED_DIR.$plg_ObjPlugin->folder.$plg_ObjPlugin->readme; ?>"><img src="<?php echo PLG_DEFAULT_DIR; ?>images/readme.gif" width="16" height="16" border="0" alt="Readme" title="Readme" onclick="this.blur()"></a>
				<?php } else { ?>
					<img src="<?php echo PLG_DEFAULT_DIR; ?>images/spacer.gif" width="16" height="16">
				<?php } ?>
				<?php if ($plg_ObjPlugin->changelog) { ?>
					<a href="<?php echo PLG_WWW_URL.PLG_INSTALLED_DIR.$plg_ObjPlugin->folder.$plg_ObjPlugin->changelog; ?>"><img src="<?php echo PLG_DEFAULT_DIR; ?>images/changelog.gif" width="16" height="16" border="0" alt="Changelog" title="Changelog" onclick="this.blur()"></a>
				<?php } else { ?>
					<img src="<?php echo PLG_DEFAULT_DIR; ?>images/spacer.gif" width="16" height="16">
				<?php } ?>
			</td>
			<td width="60%" class="plugins_text">
				<?php echo $plg_ObjPlugin->description; ?>
			</td>
			<td width="5%" align="center" valign="top" class="plugins_text">
				<?php echo $plg_ObjPlugin->version; ?>
			</td>
			<td width="15%" nowrap valign="top" class="plugins_text">
				<?php echo $plg_ObjPlugin->author; ?>
			</td>
			<td width="15%" nowrap valign="top" class="plugins_text" align="right">
				<?php echo $plg_ObjPlugin->size; ?>
			</td>
			<td width="1%" align="center" valign="top" class="plugins_text">
					<a href="?ReinstallPlugin=<?php echo $plg_ObjPlugin->pluginId; ?>" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/update.gif" width="16" height="16" border="0" alt="Reinstall" title="Reinstall" onclick="this.blur()"></a>
					<a href="?DelPlugin=<?php echo $plg_ObjPlugin->pluginId; ?>" onclick="if (!OkCancel('Are you sure?')) return false"><img src="<?php echo PLG_DEFAULT_DIR; ?>/images/delete.gif" width="16" height="16" border="0" alt="Remove" title="Remove" onclick="this.blur()"></a>
			</td>
		</tr>

	<?php } } ?>

</table>
</div>

<?php } ?>
<div id="plg_Done">&nbsp;</div>
<?php
chdir(ROOT_DIR);
include PRJ_INCLUDE_PATH.'html/footer.php';
?>