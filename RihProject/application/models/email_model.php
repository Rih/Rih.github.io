<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->model('crud_model');
    }

	function generateRandomString($length = 8) {
      $characters = 'ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }


	function account_opening_email($account_type = '' , $email = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		
		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account type : ".$account_type."<br />";
		$email_msg		.=	"Your login password : ".$this->db->get_where($account_type , array('email' => $email))->row()->password."<br />";
		$email_msg		.=	"Login Here : ".base_url()."<br />";
		
		$email_sub		=	"Account opening email";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function password_reset_email( $email = '', $npassword = 8)
	{
		$query			=	$this->db->get_where('account' , array('Muser' => $email));
		if($query->num_rows() > 0)
		{
			
      		//CAMBIAR TAMAÑO DE CONTRASEÑA DE RESET
      		$length = $npassword;	      	
	      	//$password = $this->email_model->generateRandomString($length);
	      	$password = "12345678";
	      	$lengthsalt = 10;	      	
			$salt	=	$this->email_model->generateRandomString($lengthsalt);
			$psha = sha1($password + $salt);

			$this->db->where('Muser',$email);
			$this->db->update('account',array('Mpassword'=> $psha, 'salt' => $salt));
			$iduser = $this->session->userdata('userid');
			//$data = $this->crud_model->get_datos_personales_by_id($iduser);
			//$email_msg	 =	"<img src='http://www.unavezenlavida.cl/sistema/template/theme/img/logo-header.png'><br />";
			//$email_msg	.=	"<img src='http://www.unavezenlavida.cl/sistema/unnamed.jpg'><br />";
			
			$email_msg	 =	"<h1 style='font-size:24px;font-weight:bolder;line-height:27px;margin:0 0 11px 0;color:#26969C'>¿Has solicitado cambiar de contraseña?</h1><br />";
			$email_msg	.=	"De no ser así, se sugiere usar o cambiar esta contraseña por una mas segura. <br />";			
			$email_msg	.=	"Tu nueva contraseña es: <h1 style='font-size:16px;font-weight:bolder;color:#26969C'>".$password."</h1><br />";
			$email_msg	.=	"Puedes copiar y pegar la contraseña en el ingreso del Sistema <br />";	
			$email_msg	.=  "Ingresa aquí: <strong>".base_url()."?login</strong> para loguearte y realizar el cambio. <br />";	
			$email_sub	 =	"Recuperación de Contraseña";
			$email_to	 =	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	function password_change_email( $email = '', $password)
	{
		$query			=	$this->db->get_where('account' , array('correo' => $email));
		if($query->num_rows() > 0)
		{
			$iduser = $this->session->userdata('userid');
			$data = $this->crud_model->get_datos_personales_by_id($iduser);
			$email_msg	 =	"<img src='http://www.unavezenlavida.cl/sistema/template/theme/img/logo-header.png'><br />";
			$email_msg	.=	"<img src='http://www.unavezenlavida.cl/sistema/unnamed.jpg'><br />";
			$email_msg  .= 	"¡Hola ".$data->nombres." ".$data->apellido_paterno."!: <br/><br/>";			
			$email_msg	.=	"<h1 style='font-size:24px;font-weight:bolder;line-height:27px;margin:0 0 11px 0;color:#26969C'>Has cambiado la contraseña desde tu perfil.</h1><br />";			
			$email_msg	.=	"Tu nueva contraseña es: <h1 style='font-size:16px;font-weight:bolder;color:#26969C'>".$password."</h1><br />";
			$email_msg	.=	"Puedes copiar y pegar la contraseña en el ingreso del Sistema <br />";	
			$email_msg	.=  "Ingresa aquí: <strong>".base_url()."?login</strong> para loguearte. <br />";	
			$email_sub	 =	"Cambio de Contraseña";
			$email_to	 =	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	function create_account_email( $data , $pass)
	{

		$email = $data['Muser'];
		$query			=	$this->db->get_where('account' , array('Muser' => $data['Muser']));
		if($query->num_rows() > 0)
		{
			return false;
		}else{		
			
			$this->db->insert('account',$data);
			//$lastid = $this->db->insert_id(); //for future references
			
			$email_msg	 =	"<h1 style='font-size:24px;font-weight:bolder;line-height:27px;margin:0 0 11px 0;color:#26969C'>¡Gracias por registrarte!</h1><br />";
			$email_msg	.=	"Te recordamos que tu contraseña es : ".$pass."<br />";		
			$email_msg	.=  "Ya puedes ingresar a tu cuenta desde aquí: <strong>".base_url()."?login</strong><br />";	
			$email_sub	=	"Creación de Cuenta";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
	
	}
	
	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";        
        $config['smtp_host']	= "ssl://smtp.googlemail.com";
        $config['validation']	= TRUE;
        $config['smtp_timeout']	=  30;        
        $config['smtp_port']	= "465"; //"25"
        //$config['smtp_user']	= "rifacodemakers2015@gmail.com";
        //$config['smtp_pass']	= "pliqse123098";
        $config['smtp_user']	= "drigox90rih@gmail.com";
        $config['smtp_pass']	= "zaidogir1478653z";
        
        /*
        $config['smtp_host']	= "gtd172.hostingnic.cl"; //TA OK
        //$config['smtp_host']	= "mail.unavezenlavida.cl";
		//$config['smtp_server']	= "mail.unavezenlavida.cl";
        //$config['smtp_server']	= "gtd172.hostingnic.cl";
        $config['validation']	= TRUE;
        $config['smtp_timeout']	=  15;        
        $config['smtp_port']	= "25"; //"465"; //"25"
        $config['smtp_user']	= "no-reply@unavezenlavida.cl";
        $config['smtp_pass']	= "noreply123";
        */
         //rodrigo.ediaz.f@gmail.com
        $config['mailtype']		= "html";
        $config['charset']		= "utf-8";
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;
        //SYSTEM EMAIL
		//user rifacodemakers2015@gmail.com
		//password: pliqse123098
        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	'Management System';
		if($from == NULL)
			$from		=	'rifacodemakers2015@gmail.com';
		
		//$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://www.unavezenlavida.cl/\">&copy; ".date("Y")." Unavezenlavida.cL</a></center>";
		$this->email->message($msg);
		
		//$this->email->send();
		if(@$this->email->send()){
    		$this->email_status= true;
		}else{
		    $this->email_status= false; 
		 } 
		
		//echo $this->email->print_debugger();
	}
}

