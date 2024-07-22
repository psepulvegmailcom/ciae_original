<?

class AuthSessionIntranet extends AuthSession 
{
	var $error_login;

	function AuthSessionIntranet() 
	{
		parent::AuthSession();
	}	
	
	function initSession() 	
	{		
		parent::initSession();	
		$this->is_auth();	
		if(!$this->autenticate)
		{
			$this->auth_session();			
		} 
		if($this->autenticate)
		{
			$this->create_session();					
		}
	}
	
	/** se revisa si esta con session*/
	private function is_auth()
	{				
		$this->autenticate = false;	 
		if((bool)parent::get_register('userId'))
		{ 
			$now = time();
			$exp = parent::get_register('exp');			
			if($exp < $now)
				return $this->logout();				
			
			$this->userName 	= parent::get_register('userName');
			$this->refreshSession();								
			$this->autenticate 	= true;	 
		}			
	}
	
	private function create_session()
	{
		$usuarioControl	= new ControladorDeUsuarios(); 		
		$usuarioControl->setUsuarioByUsername($this->userName);	
		if($usuarioControl->ExisteUsuario())
		{
			$this->userObject 	= $usuarioControl->getUsuario();		
			$this->user 		= $this->userObject->nombre;
			$this->userId 		= $this->userObject->user_id;
			$this->userName		= $this->userObject->username;
			$this->uId			= $this->userObject->username;						
			$this->autenticate 	= true;				
			$this->refreshSession();			
		}	
		parent::register('userId',$this->userId);
		parent::register('autenticate',true);
		parent::register('user',$this->user);
		parent::register('userName',$this->userName);
		return $usuarioControl->ExisteUsuario();
	}
	
	function logout()
	{ 
		parent::unregister('exp');
		parent::unregister('userId');
		parent::unregister('user');
		parent::unregister('userName');
		parent::unregister('ip');
		parent::unregister('loginbyIP');
		$this->autenticate 	= false;
		parent::logout();	
		return $this->autenticate;
	}	
		
	private function refreshSession()
	{
		parent::register('exp',time() + (60 * VarConfig::timeSession_system));
	}
   
   	function auth_session()
	{ 
		$usuarioControl	= new ControladorDeUsuarios();				

		if($login = $this->loginByForm())
		{	   
			/* INGRESO POR FORMULARIO PERO SE DEBE CHEQUEAR QUE CONCUERDE CON LDAP*/ 
			if(!$usuarioControl->setUsuarioByLogin($login['username'],$login['password']))
			{			 
				if($usuarioControl->setUsuarioByUsername($login['username']))
				{
					$this->error_login = 2;
				}
				else
				{
					$this->error_login = 1;
				}	
				//Funciones::mostrarArreglo($this,true);
				$this->autenticate 	= false;
				return $this->autenticate;
			} 		 
		}   
		
		if(trim($this->error_login) == '' && !$usuarioControl->isUsuarioActivo())
		{
			$usuarioControl		= new ControladorDeUsuarios();
			$this->error_login 	= 4;  
			$this->autenticate 	= false; 
		}
		else
		{ 	
			$this->autenticate 	= $usuarioControl->ExisteUsuario();	
			if($this->autenticate)
			{
				$this->userName = $usuarioControl->getUsername();
			}
		}
		return $this->autenticate;		
	}
	
	function loginByForm()
	{		 	
		$username 		= VarSystem::getVariable("login_username");
		$password 		= VarSystem::getVariable("login_password");
		$response_post 	= VarSystem::getVariable("login_response");
		$challenge 		= VarSystem::getVariable("login_challenge");
		$captcha 		= VarSystem::getVariable("login_captcha");
		$checkcaptcha 	= VarSystem::getVariable("login_checkcaptcha"); 
		  
		if((bool)$checkcaptcha && trim($captcha) != $_SESSION['tmp_captcha'])
		{
			$this->error_login = 3; 
			return false;
		}	 
		if(trim($username) != '' && trim($password) != '')
		{			
			$response = md5($username).":".$password.":".md5($challenge);	
			//echo $response; 
			if($response == trim($response_post))
			{
				$password = base64_decode($password);  
				return array('username'=>$username,'password'=>md5($password));
			}
		}	
		return false;
	} 
}
?>