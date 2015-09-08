<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
	
	function __construct()
		{
				parent::__construct();
		}
	public function getEntropy($str =''){
		$password = 'McF-GU*".k9B[';
		//require 'class.pwd-entropy.php';
		$ent = new pwd_entropy;
		echo $ent->entropy($password); // 85 bits


	}
	public function generateRandomString($length = 10,$option = -1) {
			$signs = '!#$*{}+-_:.;,[]';
			$characters = array('ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'.$signs,
								$signs.'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
								'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'.$signs,      
								$signs.'ABCDEFGHIJKLMNO01234PQRSTUVWXYZ56789',      
								'56789ABCDEFGHIJKLMNO01234PQRSTUVWXYZ'.$signs,								
								'abcde01fghij23klmno45pqrst67uvwxyzZ89'.$signs,
								$signs.'0123456789abcdefghijklmnopqrstuvwxyz',
								'abcdefghijklmnopqrstuvwxyz0123456789'.$signs,      
								$signs.'abcdefghijklmno01234pqrstuvwxyz56789',      
								'56789abcdefghijklmno01234pqrstuvwxyz'.$signs
								);
			
			$charactersLength = strlen($characters[0]);
			$charsetlength = count($characters);			
			$randomString = '';
			if($option > $charsetlength-1) $option = 0;
			$position0 = $option;
			for ($i = 0; $i < $length; $i++) {  					
					$position = rand(0, $charactersLength - 1);
					if($option === -1){
						$position0 = rand(0, $charsetlength - 1);
					}
					$randomString .= strval($characters[$position0][$position]);
					
			}
			return $randomString;
	}		
///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////

	function delete_by_id($table = '',$id=0, $iduser){
		if ($id != 0) {
			$tables = array('account','service','registry','vinculation_accountservice');
			if(in_array($table,$tables)){
				$this->db->delete($table,array('id' => $id));
				return true;
			}
			else{ return false; }
			
		}else{
			return false;
		}
		
	}

	public function fetch_tabla($tabla,$limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get($tabla); //add where comprado = 1 !

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	 }
	 

	public function get_num_filas($tabla)
	{
		$total = 0;
		$total = $this->db->count_all($tabla);
		if($tabla == 'account') $total--; //substract admin user from total
		return $total;
	}
///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
////////////------------------------------END-----------------------------------------------///////////

///////////////////////////// CRUD FOR ACCOUNT TABLE //////////////////////////////////////////////////


	function account_insert($muser, $mpassword, $mpattern, $salt){
		$data = array(
			'Muser' =>$muser,
			'Mpassword' =>$mpassword,
			'Mpattern' =>$mpattern,
			'salt' =>$salt
			);
		$value = $this->db->insert('account',$data);
		return $value;
	}

	function account_delete_by_id($table = 'account',$iduser=0){
		if ($iduser != 0) {
			$tables = array('account');
			if(in_array($table,$tables)){
				$this->db->delete($table,array('id' => $iduser));
				return true;
			}
			else{ return false; }
			
		}else{
			return false;
		}
		
	}
	function account_update_field_by_id($id,$namefield,$field){
		$data = array( $namefield => $field );
		$this->db->where('id', $id);
		$value = $this->db->update('account', $data);
		return $value;
	}
	function account_update_by_id($id,$newpassword= '',$newpattern = '', $newsalt= ''){
		if ($newpassword != ''){
			$data = array( 'Mpassword' => $newpassword );
			$this->db->where('id', $id);
			$this->db->update('account', $data);	
		} 
		if ($newpattern != ''){
			$data = array( 'Mpattern' => $newpattern );
			$this->db->where('id', $id);
			$this->db->update('account', $data);	
		} 
		if ($newsalt != ''){
			$data = array( 'salt' => $newsalt );
			$this->db->where('id', $id);
			$this->db->update('account', $data);	
		} 
		return true;
	}

	function account_get_id_by_Muser($mail = '',$logged = false){
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){			
			return $this->db->select('id')->get_where('account', array( 'Muser'=> $mail))->row()->id;
		}else{
			return false;
		}
		
	}
	function account_get_all_by_Muser($mail = '',$logged = false){
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){			
			return $this->db->get_where('account', array( 'Muser'=> $mail))->row();
		}else{
			return false;
		}
		
	}
	function account_get_all_by_iduser($iduser = '',$logged = false){
		if ($logged == true) {
			$iduser = $this->session->userdata('userid');
		}
		if($iduser != ''){			
			return $this->db->get_where('account', array( 'id'=> $iduser))->row_array();
		}else{
			return false;
		}
		
	}

///////////////////////////// CRUD FOR ACCOUNT TABLE //////////////////////////////////////////////////

////////////------------------------------END-----------------------------------------------///////////

///////////////////////////// CRUD FOR SERVICE TABLE //////////////////////////////////////////////////

	function service_insert($name, $url, $topic, $desc='',$approved = 0){
		$data = array(
			'name' =>$name,
			'url' =>$url,
			'topic' =>$topic,
			'desc' =>$desc,
			'approved' => $approved
			);
		$value = $this->db->insert('service',$data);
		return $value;
	}
	function service_delete_by_id($idserv = 0){
		if ($idserv != 0) {
			$tables = array('service');			
			$table = "service";
			$this->db->delete($table,array('id' => $idserv));
			return true;
			
		}else{
			return false;
		}
		
	}
	function service_update_field_by_id($idserv,$fieldname,$value){
		$data = array( $fieldname => $value );
		$this->db->where('id', $idserv);
		$this->db->update('service', $data);	
	}
	function service_update_fields_by_id($idserv,$data){		
		$this->db->where('id', $idserv);
		$this->db->update('service', $data);	
	}
	function service_get_num_filas($arg = true){ //approved = 1 , not approved = 0		
		if ($arg){
			$query = $this->db->get_where('service',array('approved' => 1));
		}else{
			$query = $this->db->get_where('service',array('approved' => 0));		
		}
		$total = $query->num_rows();
		return $total;
	}
	public function service_fetch_tabla($limit, $start,$arg = true) {
		$this->db->limit($limit, $start);
		if($arg){
			$query = $this->db->get_where('service',array('approved' => 1)); 
		}else{
			$query = $this->db->get_where('service',array('approved' => 0)); 
		}
		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	 }
	function service_get_id_by_name($name = ''){ //name should be UNIQUE
		
		if($name != ''){			
			return $this->db->select('id')->get_where('service', array( 'name'=> $name))->row()->id;
		}else{
			return false;
		}
		
	}
	function service_get_name_by_id($id = ''){ //name should be UNIQUE
		
		if($id != ''){			
			return $this->db->select('name')->get_where('service', array( 'id'=> $id))->row()->name;
		}else{
			return false;
		}
		
	}
	function service_get_field_by_id($id = '',$field){ //name should be UNIQUE
		
		if($id != ''){			
			return $this->db->select($field)->get_where('service', array( 'id'=> $id))->row();
		}else{
			return false;
		}
		
	}
	
	function service_get_all_by_id($id = ''){
		
		if($id != '' || $id != 0){			
			return $this->db->get_where('service', array( 'id'=> $id))->result_array();
		}else{
			return false;
		}
		
	}
	function service_get_all(){
		$query = $this->db->get_where("service",array('approved' => 1)); //add where comprado = 1 !
		if ($query->num_rows() > 0) {
		return $query->result_array();
		}else{ return false; }
	}

///////////////////////////// CRUD FOR SERVICE TABLE //////////////////////////////////////////////////
////////////------------------------------END-----------------------------------------------///////////
		
///////////////////////////// CRUD FOR REGISTRY TABLE /////////////////////////////////////////////////
	function registry_insert($idserv, $field){
		$data = array(
			'idserv' =>$idserv,
			'fieldname' =>$field
			);
		$value = $this->db->insert('registry',$data);
		return $value;
	}
	function registry_get_all_by_id($id = ''){
		
		if($id != ''){			
			return $this->db->select('fieldname')->get_where('registry', array( 'idserv'=> $id))->result_array();
		}else{
			return false;
		}
		
	}


///////////////////////////// CRUD FOR registry TABLE /////////////////////////////////////////////////
////////////------------------------------END-----------------------------------------------///////////
//'000','001','010','011','100','101','110','111'
	/*
CREATE TABLE `vinculation_accountservice` (
  `id` int(20) unsigned NOT NULL auto_increment,
  `idAcc` int(20) unsigned NOT NULL,
  `idServ` int(20) unsigned NOT NULL,
  `status` enum('000','001','010','011','100','101','110','111') NOT NULL default '011',
  `valuation` enum('1','2','3','4','5','6','7','8','9','10') NOT NULL default '10',
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `lastVisited` datetime NOT NULL,
  `times` int(20) NOT NULL default '0',
  `lastChangedPwd` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_idacc` (`idAcc`),
  KEY `fk_idserv` (`idServ`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `vinculation_accountservice`
-- 

-- 
-- Filtros para la tabla `vinculation_accountservice`
-- 
ALTER TABLE `vinculation_accountservice`
  ADD CONSTRAINT `vinculation_accountservice_ibfk_2` FOREIGN KEY (`idServ`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vinculation_accountservice_ibfk_1` FOREIGN KEY (`idAcc`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

	*/
///////////////////////////// CRUD FOR vinculation_accountservice TABLE //////////////////////////////////////////

	function vinculation_accountservice_insert($idAcc, $idServ, $status='001',$value, $username, $password,$notes=''){ //value is service worth by user
		date_default_timezone_set('America/Argentina/Buenos_Aires');

		$data = array(
			'idAcc' =>$idAcc,
			'idServ' =>$idServ,
			'status' =>$status,
			'valuation' =>$value,
			'username' => $username,
			'password' => $password,
			'oldpassword' => $password,
			'notes' => $notes,
			'created' => date("Y-m-d H:i:s"),
			'lastVisited' => date("Y-m-d H:i:s"),			
			'times' => 0,
			'lastChangedPwd' => date("Y-m-d H:i:s")
			);
		$value = $this->db->insert('vinculation_accountservice',$data);
		return $value;
	}
	function vinculation_accountservice_delete_by_id($id = 0){
		if ($id != 0) {
			$tables = array('vinculation_accountservice');			
			$table = "vinculation_accountservice";
			$this->db->delete($table,array('id' => $id));
			return true;
			
		}else{
			return false;
		}
		
	}
	function vinculation_accountservice_update_fields_by_id($id,$data){
		date_default_timezone_set('America/Argentina/Buenos_Aires');		
		$this->db->where('id', $id);
		$value = $this->db->update('vinculation_accountservice', $data);
		return $value;
	}
	function vinculation_accountservice_update_field_by_id($id,$namefield,$field){
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$data = array( $namefield => $field );
		$this->db->where('id', $id);
		$value = $this->db->update('vinculation_accountservice', $data);
		return $value;
	}
	function vinculation_accountservice_update_times_by_id($id, $idserv){
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$iduser = $this->session->userdata('userid');
		$ask = $this->db->query("SELECT TO_DAYS(NOW()) - TO_DAYS(lastVisited) as diffdays FROM vinculation_accountservice WHERE id = $id AND idAcc = $iduser AND idServ = $idserv");

		if($ask->num_rows() > 0){
			$days = $ask->row();
			if(isset($days)){
				//print_r($days->diffdays);
				if($days->diffdays > 0){
					$query = $this->db->query("UPDATE vinculation_accountservice SET times = times + 1 WHERE id = $id AND idAcc = $iduser AND idServ = $idserv AND TO_DAYS(NOW()) - TO_DAYS(lastVisited) > 0");
					if($query == true){
						$this->vinculation_accountservice_update_field_by_id($id,'lastVisited',date("Y-m-d H:i:s"));
					}	
				}
			}
		}
	
	}

	
	function vinculation_accountservice_update_status_by_iduser($idAcc){
		/*example OR where
		$user = $this->db->escape($user);
		$this->db->select('id,level,email,username');
		$this->db->where("(email = $user OR username = $user)");
		$this->db->where('password', $pass);
		*/
		//exponencial formula
		/*
		$maxval = 730; //max days to renew pass
		$minval = 30; //min days to renew pass
		$mininterval = 1; //min valuation 
		$maxinterval = 10; //max valuation 
		$time = 0;
		$equation = $minval*(($maxval/$minval)^(10/9))*EXP((-1/9)*LN($maxval/$minval)*$time;
		$diff = array(1 => 730, 2 => 513, 3 => 360, 4 => 252, 5 => 177, 6 => 124,
			7 => 87,8 => 61, 9 => 43, 10 => 30);
		////////////////////////////////7			
		//linear formula (approximation)
		$equation = ($maxval - $minval)/($maxinterval - $mininterval)*(11 - $time) - 40;
		$diff = array(1 => 730, 2 => 653, 3 => 576, 4 => 499, 5 => 422, 6 => 345,
			7 => 268,8 => 191, 9 => 114, 10 => 30);
		*/
		//$diff = array(1 => 730, 2 => 513, 3 => 360, 4 => 252, 5 => 177, 6 => 124,
		//	7 => 87,8 => 61, 9 => 43, 10 => 30);
		$diff = array(1 => 25, 2 => 20, 3 => 18, 4 => 12, 5 => 10, 6 => 8,
			7 => 6,8 => 4, 9 => 2, 10 => 1);
		//$this->db->select("*,TO_DAYS(NOW()) - TO_DAYS(lastChangedPwd) as diffdays");
		//$query = $this->db->query("SELECT *,TO_DAYS(NOW()) - TO_DAYS(lastChangedPwd) as diffdays
		//	FROM vinculation_accountservice wHERE idAcc = $idAcc");		            
		$query = $this->db->query("SELECT *,ROUND((TIME_TO_SEC(TIMEDIFF(NOW(),lastChangedPwd))/60),0) as diffdays
			FROM vinculation_accountservice wHERE idAcc = $idAcc");		            
		if($query->num_rows() > 0 ){			
			$data = array();			
			foreach ($query->result_array() as $row) {
				$daystorenew = $diff[$row['valuation']];
				//print_r("daystorenew: ");
				//print_r($daystorenew);
				$diffdays = $row['diffdays'];				
				if ($diffdays > $daystorenew){
					$status = $row['status'];
					$newstat = $status[0].'0'.$status[2];
					$vincdata = array('id' => $row['id'],
									'status' => $newstat);
					$data[] = $vincdata;
				}
			}			
			if(count($data) > 0){				
				$this->db->update_batch('vinculation_accountservice', $data, 'id'); 				
			}
		}
				
	}
	public function vinculation_accountservice_get_num_filas_by_id($idAcc,$option="all", $val="")
	{
		$total = 0;
		if($option=="all"){			
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc));
		}
		if($option=="vulnerable"){
			$expr = "[0|1]0[0|1]";
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc,
																			'status RLIKE' => $expr));
		}			
		if($option=="async"){
			$expr = "[0|1][0|1]0";
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc,
																			'status RLIKE' => $expr));
		}
		if($option =="search"){
			if($val != "" && (ord($val) >= 65 && ord($val) <= 90) ){
				//return -1;
				$qr = "SELECT  v.* FROM vinculation_accountservice v, service s ";
				$qr .="WHERE v.idAcc = ".$idAcc." AND v.idServ = s.id AND s.name LIKE '".$val."%'";
				print_r($qr);
				$query  =   $this->db->query($qr);	
			}			
			else
				return 0;
		}	
		else{
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc));	
		}	
		$total = $query->num_rows();		
		return $total;
	}
	public function vinculation_accountservice_fetch_tabla_by_idAcc($idAcc,$limit, $start, $option="all",$val="") {// val only used if option = search
		
		$expr = "[0|1]0[0|1]";
		//"SELECT * FROM `vinculation_accountservice` WHERE status RLIKE '[0|1]0[0|1]'"; SHOW ONLY VULNERABLES
		if($option=="all"){
			$this->db->limit($limit, $start);
			$this->db->order_by("times", "desc");
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc));
		}
		elseif($option=="visible"){
			$this->db->limit($limit, $start);
			$this->db->order_by("times", "desc");
			$expr = "0[0|1][0|1]";
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc,
																			'status RLIKE' => $expr));
		}
		elseif($option=="hide"){
			$this->db->limit($limit, $start);
			$this->db->order_by("times", "desc");
			$expr = "1[0|1][0|1]";
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc,
																			'status RLIKE' => $expr));
		}
		elseif($option=="vulnerable"){
			$this->db->limit($limit, $start);
			$this->db->order_by("times", "desc");
			$expr = "[0|1]0[0|1]";
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc,
																			'status RLIKE' => $expr));
		}			
		elseif($option=="async"){
			$this->db->limit($limit, $start);
			$this->db->order_by("times", "desc");
			$expr = "[0|1][0|1]0";
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc,
																			'status RLIKE' => $expr));
		}
		elseif($option=="search"){
			if($val != "" && (ord(strtoupper($val)) >= 65 && ord(strtoupper($val)) <= 90) ){
			$query  =   $this->db->query("SELECT  v.* FROM vinculation_accountservice v, service s 
					WHERE v.idAcc = $idAcc AND v.idServ = s.id AND s.name LIKE '$val%'  LIMIT $start, $limit");
			}else
				return false;
		}
		else{
			$this->db->limit($limit, $start);
			$this->db->order_by("times", "desc");
			$query  =   $this->db->get_where('vinculation_accountservice' , array('idAcc' => $idAcc));	
		}	

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	 }
	public function vinculation_accountservice_get_field_by_id($id,$field) {
		if($id != ''){			
			return $this->db->select($field)->get_where('vinculation_accountservice', array( 'id'=> $id))->row();
		}else{
			return false;
		}
	}
	public function vinculation_accountservice_get_all_by_id($id) {
		if($id != ''){			
			$this->db->select('*,DAY(created) as dcreated, MONTH(created) as mcreated, YEAR(created) as ycreated, TIME(created) as tcreated,
				DAY(lastVisited) as dlastVisited, MONTH(lastVisited) as mlastVisited, YEAR(lastVisited) as ylastVisited, TIME(lastVisited) as tlastVisited,
				DAY(lastChangedPwd) as dlastChangedPwd, MONTH(lastChangedPwd) as mlastChangedPwd, YEAR(lastChangedPwd) as ylastChangedPwd,TIME(lastChangedPwd) as tlastChangedPwd');
			return $this->db->get_where('vinculation_accountservice', array( 'id'=> $id))->row_array();
		}else{
			return false;
		}
	}  
///////////////////////////// CRUD FOR vinculation_accountservice TABLE //////////////////////////////////////////
////////////------------------------------END-----------------------------------------------///////////



/*IGNORE BELOW - JUST FOR FUTURE REFERENCES */
/*
	function get_id_by_correo($mail = ''){
		if($mail == ''){
			$mail = $this->session->userdata('email');
		}
			return $this->db->select('iduser')->get_where('user', array( 'correo'=> $mail))->row()->iduser;
		}

	function get_correo_by_id($iduser = 0){
		if($iduser == 0)
				$iduser = $this->session->userdata('userid');
			$query = $this->db->select('correo')->get_where('user', array( 'iduser'=> $iduser));
			if( $query->num_rows() > 0){
				return $query->row()->correo;
			}else{
				return false;
			}
			//return $this->db->select('correo')->get_where('user', array( 'iduser'=> $iduser))->row()->correo;
	 }

	function get_rifa_by_id($iduser = 0){
		 
			if($iduser == 0)
				$iduser = $this->session->userdata('userid');
			return $this->db->select('*')             
						 ->get_where('venta',array('id_user' => $iduser))->result();
	 }


	function get_correo_by_id_transaccion($idtrans = 0)
	{
		$query = $this->db->select('id_user')->get_where('venta',array('idtransaccion' => $idtrans));
		if ($query->num_rows() > 0)
			return $this->crud_model->get_correo_by_id($query->row()->id_user);
		else
			return 'id transaccion invalida';
	}

	

	 public function fetch_rifas($limit, $start) {
				$this->db->limit($limit, $start);
				$query = $this->db->get("rifa"); //add where comprado = 1 !
 
				if ($query->num_rows() > 0) {
						foreach ($query->result() as $row) {
								$data[] = $row;
						}
						return $data;
				}
				return false;
	 }

	

	public function fetch_all_buys($limit,$start)
	 {
		$query = $this->db->query("SELECT U.iduser AS iduser, U.rut AS rut, U.correo AS correo, P.cantidad AS cantidad, P.hash AS hash, 
			YEAR(P.fecha_peticion) AS year, MONTH(P.fecha_peticion) AS month, DAY(P.fecha_peticion) AS day, 
			HOUR(P.fecha_peticion) AS hour, MINUTE(P.fecha_peticion) AS minute 
			FROM user U, payment P WHERE U.iduser = P.iduser AND cantidad > 0 AND confirmado = 1 GROUP BY U.iduser LIMIT $start, $limit ");
		if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;       
	 }

	function get_num_compras(){
		$query = $this->db->query("SELECT * FROM payment WHERE cantidad > 0 AND confirmado = 1");
		return $query->num_rows();
	}

	public function fetch_trans_by_id($iduser,$limit, $start) {
				
		//$query = $this->db->get($tabla); //add where comprado = 1 !
		$query = $this->db->query("SELECT T.* FROM transaccion T, venta V WHERE V.id_user = $iduser AND T.idtransaccion = V.idtransaccion GROUP BY idtransaccion LIMIT $start, $limit ");    
		if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	 }

	 public function fetch_tabla_by_id($iduser,$tabla,$limit, $start) {
				$this->db->limit($limit, $start);
				$query = $this->db->get_where($tabla,array('id_user'=>$iduser)); //add where comprado = 1 !
 
				if ($query->num_rows() > 0) {
						foreach ($query->result() as $row) {
								$data[] = $row;
						}
						return $data;
				}
				return false;
	 }

	 function get_num_rifas_compradas()
	 {
			$query = $this->db->get_where('rifa',array('comprado' => 1));
		$total = $query->num_rows();
		return $total;
	 }

	 function get_payment_by_id($iduser = 0){    
		$query = $this->db->get_where('payment', array('iduser' => $iduser));
		return $query->row();
	 }

	 function get_tabla($tabla, $limit = 10, $start = 0)
	 {
		if ($limit > 10)
			return $this->db->select('*')->from($tabla)->limit($limit,$start)->get();
		else
			return $this->db->select('*')->from($tabla)->get()->result();
	 }
	 function get_all_tansacciones()
	 {
			return $this->db->get('transaccion')->result();
	 }
	 function get_all_ventas()
	 {  $this->db->order_by("idventa", "asc");
			return $this->db->select('*')->get('venta')->result();
	 }
	 function get_datos_personales($mail ='')
	 {
		if ($mail == '')
			$mail =  $this->session->userdata('email');
		
		return $this->db->select('*, DAY(fecha_nacimiento) AS day, MONTH(fecha_nacimiento) AS month, YEAR(fecha_nacimiento) AS year')             
					 ->get_where('user',array('correo' => $mail))->row();
		 
	 }
	 
	 //EXCEPT MY PERSONAL DATA
	 function get_all_datos_personales($limit,$start)
	 {
		$this->db->limit($limit,$start);
		//$query = $this->db->select('*, DAY(fecha_nacimiento) AS day, MONTH(fecha_nacimiento) AS month, YEAR(fecha_nacimiento) AS year')             
				//->from('user')->get();
		$email = $this->session->userdata('email');
		$query = $this->db->query("SELECT *, DAY(fecha_nacimiento) AS day, MONTH(fecha_nacimiento) AS month, YEAR(fecha_nacimiento) AS year FROM user WHERE correo != '$email' LIMIT $start, $limit");
		if ($query->num_rows() > 0) {
						foreach ($query->result() as $row) {
								$data[] = $row;
						}
						return $data;
				}
				return false;       
		
	 }

	 function get_all_user_datos_personales()
	 {
	 
		 $query = $this->db->select('*, DAY(fecha_nacimiento) AS day, MONTH(fecha_nacimiento) AS month, YEAR(fecha_nacimiento) AS year')             
				->from('user')->get();
		if ($query->num_rows() > 0) {
						foreach ($query->result() as $row) {
								$data[] = $row;
						}
						return $data;
				}
				return false;       
		
	 }
	 
	 function get_last_transaction()
	 {
		$this->db->order_by("idtransaccion", "desc");
		$this->db->limit(6);
		$query = $this->db->get('transaccion');
		if($query->num_rows() > 0)
			return $query->result();
		else 
			return false;
	 }
	 function get_transaccion_by_id($idtransaccion = 0)
		 {
			$query = $this->db->get_where('transaccion', array('idtransaccion' => $idtransaccion));
			if($query->num_rows() > 0)
				return $query->row();
			else 
				return false;
		 }
	 function get_last_transaccion_by_id($iduser = 0)
		 
	 {
			$this->db->order_by("idventa", "desc");      
			$query = $this->db->get_where('venta', array('id_user' => $iduser));
			if($query->num_rows() > 0)
				return $query->first_row()->idtransaccion;
			else 
				return false;
	 }

	 function get_last_venta_by_id($iduser,$idtransaccion){    
		$query = $this->db->get_where('venta', array('id_user' => $iduser,'idtransaccion' => $idtransaccion));
		if($query->num_rows() > 0)
			return $query->result();
		else 
			return false;
	 }
	 function get_last_venta($cantidad)
	 {
		
		$userid =  $this->session->userdata('userid');
		$this->db->order_by("fecha_venta", "desc");
		$this->db->limit($cantidad);
		$query = $this->db->get_where('venta', array('id_user' => $userid));
		if($query->num_rows() > 0)
			return $query->result();
		else 
			return false;
	 }
	 function update_rifa($userid,$cantidad){
		
		$mail =  $this->crud_model->get_correo_by_id($userid);
		$query = $this->db->select('*')->from('rifa')->where('comprado', 0)->limit($cantidad);
		$query = $this->db->get();
		$valor = 10000;
		if($query->num_rows() >= $cantidad){
			
			$rifa = $query->result();

			$fecha_aux = date("Y-m-d H:i:s");
			$fecha2 = strtotime($fecha_aux);
			$fecha = date("Y-m-d H:i:s", $fecha2);

			$monto = $cantidad*$valor;
			$data_transaccion = array(
						 'fecha_transaccion' => $fecha,
						 'cantidad_numeros' => $cantidad,
						 'monto' => $monto
				);
			$this->db->insert('transaccion',$data_transaccion);
			$lastid = $this->db->insert_id();

			foreach($rifa as $row)
			{	  
					
					$code = $row->codigo;
					$num = $row->numero;
					$data_rifa = array( 'comprado' => 1 );
					$this->db->where('codigo', $code);
					$this->db->update('rifa',$data_rifa);
					$data_venta = array(
							'idtransaccion' => $lastid,
								 'fecha_venta' => $fecha,
								 'rifa_codigo' => $code,
								 'id_user' => $userid
							);

					$this->db->insert('venta',$data_venta);
					
			}
		
			return TRUE;

		}else{
			return FALSE;
		}
		
	
	 }
	 function update_payment_by_id($iduser, $cantidad = 0, $hash = 'NONE',$confirm = 0){      
			$this->db->where('iduser', $iduser);
			$this->db->update('payment', array('iduser' => $iduser, 'cantidad' => $cantidad, 'hash' => $hash, 'confirmado' => $confirm));
			if ($cantidad > 0){        
				return TRUE;
			}else{      
				return FALSE;
			}
	 }

	 function update_payment($cantidad = 0, $hash = 'NONE',$confirm = 0){
			$iduser = $this->session->userdata('userid');
			$this->db->where('iduser', $iduser);
			$this->db->update('payment', array('iduser' => $iduser, 'cantidad' => $cantidad, 'hash' => $hash, 'fecha_peticion'=> date("Y-m-d H:i:s"),'confirmado' => $confirm));
			if ($cantidad > 0){        
				return TRUE;
			}else{      
				return FALSE;
			}
	 }

	function confirm_payment(){
		$iduser = $this->session->userdata('userid');
		$this->db->where('iduser', $iduser);
		$this->db->update('payment', array('confirmado' => 1, 'fecha_peticion'=> date("Y-m-d H:i:s")));
	}

	 function get_rifa($mail = ''){
		if ($mail == '')
			$mail =  $this->session->userdata('email');
		
		$iduser = $this->crud_model->get_id_by_correo($mail);

		return $this->db->select('*')             
						 ->get_where('venta',array('id_user' => $iduser))->result();
	 }

	
 
	 function get_datos_personales_by_id($iduser = 0)
	 {
			if($iduser == 0)
				$iduser = $this->session->userdata('userid');

			$correo = $this->crud_model->get_correo_by_id($iduser);
			if ($correo != false)
				return $this->db->select('*, DAY(fecha_nacimiento) AS day, MONTH(fecha_nacimiento) AS month, YEAR(fecha_nacimiento) AS year')             
							 ->get_where('user',array('correo' => $correo))->row();
			else
				return false;
	 }

// seed with microseconds
	function make_seed()
	{
			list($usec, $sec) = explode(' ', microtime());
			return (float) $sec + ((float) $usec * 100000);
	}
	

	 function generateRandomString($length = 10,$option = 0) {

			$characters = array('ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89',
								'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
								'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',      
								'ABCDEFGHIJKLMNO01234PQRSTUVWXYZ56789',      
								'56789ABCDEFGHIJKLMNO01234PQRSTUVWXYZ');
			
			$charactersLength = strlen($characters[0]);

			$randomString = '';
			for ($i = 0; $i < $length; $i++) {      	  
					$position = rand(0, $charactersLength - 1);
					$randomString .= $characters[$option][$position];
			}
			return $randomString;
	}
	function insertCode($cantidad){
		
		//srand($this->crud_model->make_seed()); 
		$i = $this->crud_model->get_num_filas('rifa') + 1;
		$ran = 0;
		while($i <= $cantidad){
			
				$ran = ($ran + 1) % 5;

				$code =$this->crud_model->generateRandomString(10,$ran);
				$data = array(
				 'codigo' => $code,
				 'numero' => $i,
				);
			
				$this->db->insert('rifa', $data);
			 
				$i = $i + 1;
		}
		
	}


*/
//***********OTHERS CONTROLLER METHODS
	
	function clear_cache()
	{
				$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
				$this->output->set_header('Pragma: no-cache');
	}
	

	function create_log($data)
	{
		$data['timestamp']	=	strtotime(date('Y-m-d').' '.date('H:i:s'));
		$data['ip']			=	$_SERVER["REMOTE_ADDR"];
		$location 			=	new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/'.$_SERVER["REMOTE_ADDR"]));
		$data['location']	=	$location->City.' , '.$location->CountryName;
		$this->db->insert('log' , $data);
	}

		
	
	////////BACKUP RESTORE/////////
	function create_backup($type)
	{
		$this->load->dbutil();
		
		
		$options = array(
								'format'      => 'txt',             // gzip, zip, txt
								'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
								'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
								'newline'     => "\n"               // Newline character used in backup file
							);
		
		 
		if($type == 'all')
		{
			$tables = $this->db->list_tables();
			$file_name	=	'db_rihapp_backup';
		}
		else 
		{
			$tables = array('tables'	=>	array($type));
			$file_name	=	'db_rihapp_backup_'.$type;
		}

		//$backup =& $this->dbutil->backup(array_merge($options , $tables)); 
		$backup = $this->dbutil->backup(array_merge($options , $tables)); 

		$this->load->helper('download');
		force_download($file_name.'.sql', $backup);
	}
	
	
	/////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
	function restore_backup()
	{	
		print_r($_FILES['userfile']['tmp_name']);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
		$this->load->dbutil();
		
		
		$prefs = array(
				'filepath'						=> 'uploads/backup.sql',
				'delete_after_upload'			=> TRUE,
				'delimiter'						=> ';'
				);
		//$restore =& $this->dbutil->restore($prefs); 
		$restore = $this->dbutil->restore($prefs); 
		unlink($prefs['filepath']);
	}
	
	/////////DELETE DATA FROM TABLES///////////////
	function truncate($type)
	{
		if($type == 'all')
		{
			$this->db->truncate('account');
			
		}
		else
		{	
			$this->db->truncate($type);
		}
	}
	
	
	////////IMAGE URL//////////
	function get_image_url($type = '' , $id = '')
	{
		if(file_exists('uploads/'.$type.'_image/'.$id.'.jpg'))
			$image_url	=	base_url().'uploads/'.$type.'_image/'.$id.'.jpg';
		else
			$image_url	=	base_url().'uploads/user.jpg';
			
		return $image_url;
	}

	//*ENTROPY PASSWORD FUNCTIONS *//
/**
 *
 * Password Entropy Estimator
 * Version: 1.0.0
 * Date: 2013-10-13
 * Copyright (c) 2012-2013 Peter Kahl. All rights reserved.
 * Use of this source code is governed by a GNU General Public License
 * that can be found in the LICENSE file.
 *
 * https://github.com/peterkahl/password-entropy-estimator
 *
 */
function shannonEntropy($str = ''){
	$nonfrecdata  = count_chars($str,3);
	$lenfrec = strlen($str);
	echo "nonfrec: ".$nonfrecdata;
	echo "lenfrec: ".$lenfrec;
	$shannon = 0;
	foreach (count_chars($str, 1) as $i => $val) {
		$probx = $val/$lenfrec;
		$shannon -= ($probx)*log($probx, 2);
   		$frec = $val;
	}
	$theshannon['raw_shannon'] = $shannon;
	$theshannon['metric_shannon'] = $shannon/$lenfrec;
	return $theshannon;
}
function entropy($str = '') {

		if (empty($str)) return 0;
		$len = strlen($str);
		$n = 0;

		// only numeric decimal
		if (preg_match('#^[\d]+$#', $str)) {
			$n = 10;
		}
		// only hexadecimal
		elseif ($this->detect_hexadecimal($str)) {
			$n = 16;
		}
		// alpha (lower and upper case) and NO numerals
		elseif ($this->detect_az_both($str) && !$this->detect_numerals($str)) {
			$n = 54;
		}
		// alpha (lower and upper case) and numeric
		elseif ($this->detect_az_both($str) && $this->detect_numerals($str)) {
			$n = 63;
		}
		// alpha (lower OR upper case) and numeric
		elseif ($this->detect_az_upper($str) && $this->detect_numerals($str)) {
			$n = 36;
		}
		// alpha (lower OR upper case) and numeric
		elseif ($this->detect_az_lower($str) && $this->detect_numerals($str)) {
			$n = 36;
		}
		// alpha (lower case) and NO numerals
		elseif ($this->detect_az_lower($str) && !$this->detect_numerals($str)) {
			$n = 26;
		}
		// alpha (lower case) and numeric
		elseif ($this->detect_az_lower($str) && $this->detect_numerals($str)) {
			$n = 36;
		}
		// only alpha upper case
		elseif ($this->detect_az_upper($str) && !$this->detect_numerals($str)) {
			$n = 27;
		}

		// special characters
		if ($this->detect_special($str)) $n += 36;

		$h = ($len*log($n, 2)) - 1;

		if ($h >= 10) return floor($h);
		else return round($h, 2);
	}

	private function detect_special($str) {
		$special = '`~!@#$€£₤§%^&*()-_=+[{]};:\'"\|,<.>/?'; // 36 chars
		$arr = str_split($special);
		foreach ($arr as $char) {
			if (strpos($str, $char) !== false) return true;
		}
		return false;
	}

	private function detect_numerals($str) {
		return preg_match('#[0-9]#', $str);
	}

	private function detect_hexadecimal($str) {
		return preg_match('#^[a-f0-9]+$#', strtolower($str));
	}

	private function detect_az_lower($str) {
		return (preg_match('#[a-z]#', $str) && !preg_match('#[A-Z]#', $str));
	}

	private function detect_az_upper($str) {
		return (preg_match('#[A-Z]#', $str) && !preg_match('#[a-z]#', $str));
	}

	private function detect_az_both($str) {
		return (preg_match('#[a-z]#', $str) && preg_match('#[A-Z]#', $str));
	}

}

