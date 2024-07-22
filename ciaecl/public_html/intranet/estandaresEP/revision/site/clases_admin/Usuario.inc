<?php

	class Usuarios extends PersistentObject 
	{		
		var $nombre;
		var $user_id;
		var $password;
		var $username;
		var $perms;
		var $sourceTable = "auth_user_md5";
		
		function Usuario() 
		{
			parent::PersistentObject();
		}

		function havePerm($look_for) 
		{
			$permlist = explode( ",", $this->perms );
			while( list($a,$b) = each($permlist) ) {
				if( $look_for == $b ) { return true; };
			};
			return false;
		}		
	}
	
?>