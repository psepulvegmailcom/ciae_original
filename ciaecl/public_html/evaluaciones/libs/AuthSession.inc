<?
/**
* Clase que sirve para Manejar Autentificacion en una pagina web.
*
* Esta clase es solo una encapsulacion del sistema de autentificacion de PHPLIB
* los usuarios son manejados en una base de datos MySQL o postgreSQL.
* 
* 
* La session debe ser abierta al inicio de la pagina con initSession y terminada al final de la pagina con endSession
* Cuando el usuario queira salirse del sistema, usar el metodo logoff().
* 
*/

class AuthSession {

	/**
	* @var          boolean
	* @access       private 
	*/
	var $isAdmin;

	/**
	* @var          boolean
	* @access       private 
	*/
	var $autenticate;

	/**
	* @var          string 
	* @access       private 
	*/
	var $user;

	/**
	* @var          string 
	* @access       private 
	*/
	var $userName;

	/**
	* @var          string 
	* @access       private 
	*/
	var $userId;

	/**
	* @var          Auth 
	* @access       private 
	*/
	var $auth;

	/**
	* @var          Perm 
	* @access       private 
	*/
	var $perm;

	/**
	* @var          Session 
	* @access       private 
	*/
	var $session;

	/**
	* @var          strnig 
	* @access       private 
	*/
	var $userTable;

	/**
	* @var          strnig 
	* @access       private 
	*/
	var $uId;

	/**
	* @var          strnig 
	* @access       private 
	*/
	var $hashPass;

	/**
	* @var          Usuario 
	* @access       private 
	*/
	var $userObject;

	/**
	* Constructor 
	*
	* Define el nombre de las clases PHPLIB que seran usadas para manejar la autentificacion, permisos y sessiones.
	*
	*/

	function AuthSession() {
		$this->encriptar = false;
		$this->autenticate 	= false;
	}

	/**
	* Devuelve el nombre de usuario (userid) del usuario autentificado. 
	* @return string
	*/

	function getUser() {
		return($this->uId);
	}


	function getHashPass() {
		return($this->hashPass);
	}

	/**
	* Inicializa una Session autentificada. Si no existe un usuario ya autentificado, pedira nombre de usuario y password. 
	* @return void
	*/

	function initSession() 	
	{
		session_start();  
	}

	function gc() {
	
	}
	
	function unregister($variable) 
	{
		if($this->encriptar)
			$auxvariable = md5($variable);
		else
			$auxvariable = $variable;
		unset($_SESSION[$auxvariable]);
  	}
		
	function register($variable,$value) 
	{
		if($this->encriptar)
			$auxvariable = md5($variable);
		else
			$auxvariable = $variable;
			
		$_SESSION[$auxvariable]= $value;
  	}
	
	function is_register($variable)
	{	
		if($this->encriptar)
			$auxvariable = md5($variable);
		else
			$auxvariable = $variable;
	   return isset($_SESSION[$auxvariable]);
	}

	function get_register($variable)
	{
		if($this->encriptar)
			$auxvariable = md5($variable);
		else
			$auxvariable = $variable;
		if(isset($_SESSION[$auxvariable]))
			return $_SESSION[$auxvariable];
		else
			return false;
	}	
	/**
	* Termina una Session autentificada.  
	* @return void
	*/

	function logout() 
	{
		
		@session_destroy();	
	}

	/**
	* Cierra una session autentificada, 
	* @return void
	*/


	function endSession() {

	}
}
?>
