<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class User extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        
		$this->load->database();
        $this->load->model('crud_model');
        $this->load->library("pagination");
        //$this->load->library('encryption');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/

   
    public function index()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url() . '?login', 'refresh');
        if ($this->session->userdata('user_login') == 1)
            redirect(base_url() . '?user/dashboard', 'refresh');
    }
   
    /*trying ajax response!! */
    public function viewpassword(){
        //if ($this->session->userdata('user_login') != 1){
            //redirect(base_url(), 'refresh');
        //}else{
            
            $id = $this->input->post('serv_id');      
            //$id = 1;
            //echo $this->input->ip_address();
            //print_r($this->uri->segment_array());
            $row = $this->crud_model->vinculation_accountservice_get_field_by_id($id,'password');
            $result = array("password" => $row->password);
            $send = array('token' => $this->security->get_csrf_hash()) + $result;
            if (!headers_sent()) {
                header('Cache-Control: no-cache, must-revalidate');
                header('Expires: ' . date('r'));
                header('Content-type: application/json');
            }

            print_r(json_encode($send)); 
            echo json_encode($send);
            //return $row->password;
        
        //}
    }

    function dashboard()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{            

            //print_r($this->encryption);
            $page_data['page_name']  = 'dashboard';
            $page_data['page_title'] = 'Dashboard';
            $idAcc = $this->session->userdata('userid');
            //CHECK IF PWD HAD NOT RENEWED
            $this->crud_model->vinculation_accountservice_update_status_by_iduser($idAcc);
            $page_data['nservices'] = $this->crud_model->get_num_filas('service');
            $page_data['nmyservices'] = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($idAcc);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $thestats = array(
                                '000' => array('Visible','Vulnerable','Asynchronous'),
                                '001' => array('Visible','Vulnerable','Synchronous'),
                                '010' => array('Visible','Protected','Asynchronous'),
                                '011' => array('Visible','Protected','Synchronous'),
                                '100' => array('Hidden','Vulnerable','Asynchronous'),
                                '101' => array('Hidden','Vulnerable','Synchronous'),
                                '110' => array('Hidden','Protected','Asynchronous'),
                                '111' => array('Hidden','Protected','Synchronous')
                            );
            $result = $this->crud_model->vinculation_accountservice_fetch_tabla_by_idAcc($idAcc,10, 0, "all");
            if($result != false){
                $raw_data = array_column($result,'idServ');
                $data = array();
                $thename = array('servname'=>'');
                $thestat = array('stats' => '');
                $theurl = array('url' => '');
                for($i=0;$i<count($result);$i++){
                    //$names[]['servname'] = $this->crud_model->service_get_name_by_id($d);
                    $thename['servname'] = $this->crud_model->service_get_name_by_id($result[$i]['idServ']);
                    $theurl['url'] = $this->crud_model->service_get_field_by_id($result[$i]['idServ'],'url');
                    $thestat['stats'] = $thestats[$result[$i]['status']];
                    if($result[$i]['status'][0] == '1'){
                        $len = strlen($result[$i]['password']);
                        $pwd = "";
                        for($j=0;$j<$len;$j++) $pwd .="*";                    
                        $result[$i]['password'] = $pwd;                        
                    }elseif($result[$i]['status'][0] =='0'){
                        //Decrypt password
                    }
                    $result2[] = array_merge($result[$i],$thename,$thestat,$theurl);
                } 
                //print_r($names);
                //print_r($result2);
                $page_data["favservices"] = $result2; 
            }          
            //$this->session->keep_flashdata('flash_message');
            $page_data['flash_message'] = $this->session->flashdata('flash_message');
            //$this->crud_model->insertCode(75000);
            //$this->session->set_flashdata('flash_message',$this->session->userdata('flash_message'));
            $this->load->view('index', $page_data);
            //$this->load->view('admin/dashboard', $page_data);    
        }
        
        
    }

    function request_service_form()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data['page_name']  = 'requestservice';
            $page_data['page_title'] = 'Request Service';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            //$page_data['flash_message'] = $this->session->flashdata('flash_message');
            $this->load->view('index', $page_data);
           
        }
        
        
    }
    function request_service()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data['page_name']  = 'requestservice';
            $page_data['page_title'] = 'Request Service';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $name = $this->input->post('name');
            $url = $this->input->post('url');
            $topic = $this->input->post('topic');
            $desc = $this->input->post('description');
            $this->crud_model->service_insert($name,$url,$topic,$desc);
            //$this->session->set_flashdata('flash_message', 'Nuevo servicio creado!');
            $page_data['flash_message'] = 'Nuevo servicio solicitado!';
            $this->load->view('index', $page_data);
           
        }
        
        
    }

    function vinculate_service_form()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data['page_name']  = 'vinculateservice';
            $page_data['page_title'] = 'Vinculate Service';
            $idAcc = $this->session->userdata('userid');
            $page_data['nservices'] = $this->crud_model->get_num_filas('service');            
            $page_data['nmyservices'] = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($idAcc);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $page_data['services'] = $this->crud_model->service_get_all();
            //$page_data['flash_message'] = $this->session->flashdata('flash_message');
            $this->load->view('index', $page_data);
           
        }
        
        
    }
        function vinculate_service()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data['page_name']  = 'vinculateservice';
            $page_data['page_title'] = 'Vinculate Service';            
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $page_data['services'] = $this->crud_model->service_get_all();
            //INPUT DATA (post - validate)
            $idAcc = $this->session->userdata('userid');
            $page_data['nservices'] = $this->crud_model->get_num_filas('service');
            $page_data['nmyservices'] = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($idAcc);
            $idServ = $this->input->post('service_id');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $valuation = $this->input->post('valuation');
            $notes = $this->input->post('notes');
            $status ='001';
            $this->crud_model->vinculation_accountservice_insert($idAcc, $idServ, $status,$valuation, $username, $password,$notes); //value is service worth by user
            $page_data['idserv']=$idServ;
            //$this->crud_model->service_insert($name,$url,$topic,$desc);
            //$this->session->set_flashdata('flash_message', 'Nuevo servicio creado!');
            $page_data['flash_message'] = 'Nuevo servicio vinculado a tu cuenta!';
            $this->load->view('index', $page_data);
           
        }
        
        
    }


    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function myservices($option = "all", $val="")
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $validOrderOptions = array("all","vulnerable","async","search");
            //if(!in_array($option,$validOrderOptions)) $option = "all";

            $page_data['page_name'] = 'myservices';
            $page_data['page_title']  = 'My Services';
            $iduser = $this->session->userdata('userid');            
            //CHECK IF PWD HAD NOT RENEWED
            $this->crud_model->vinculation_accountservice_update_status_by_iduser($iduser);
            $nmyservices = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($iduser);
            $optionmyservices = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($iduser,$option, $val);

            $page_data['nservices'] = $this->crud_model->get_num_filas('service');
            $page_data['nmyservices'] = $nmyservices;
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $page_data['csrf_hash'] = $this->security->get_csrf_hash();
            $style = array('Visible' => 'danger',
                           'Hidden' => 'success',
                           'Asynchronous' => 'danger',
                           'Synchronous' => 'success',
                            'Vulnerable' => 'danger',
                            'Protected' => 'success'
                );
            $page_data['stylestatus'] = $style;
            //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
            //pagination!
            $thestats = array(
                                '000' => array('Visible','Vulnerable','Asynchronous'),
                                '001' => array('Visible','Vulnerable','Synchronous'),
                                '010' => array('Visible','Protected','Asynchronous'),
                                '011' => array('Visible','Protected','Synchronous'),
                                '100' => array('Hidden','Vulnerable','Asynchronous'),
                                '101' => array('Hidden','Vulnerable','Synchronous'),
                                '110' => array('Hidden','Protected','Asynchronous'),
                                '111' => array('Hidden','Protected','Synchronous')
                            );


            $config = array();
            if($option == "search" && $val != ""){
                $config["base_url"] = base_url() . "?user/myservices/".$option."/".$val;
                $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
                $config["uri_segment"] = 5; 
            }
            else{
                $config["base_url"] = base_url() . "?user/myservices/".$option;
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $config["uri_segment"] = 4; 
            }

            $config["total_rows"] = $optionmyservices;
            $config["per_page"] = 5; //20 antes
            

            $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            
            $config['next_link'] = '<i class="fa fa-step-forward"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config); 
            
            $result = $this->crud_model->vinculation_accountservice_fetch_tabla_by_idAcc($iduser,$config["per_page"], $page, $option, $val);
            if($result != false){
                //$raw_data = array_column($result,'idServ');
                $data = array();
                $thename = array('servname'=>'');
                $thestat = array('stats' => '');
                $theurl = array('url' => '');
                $theentropy = array('entropy' => '');
                for($i=0;$i<count($result);$i++){
                    //$names[]['servname'] = $this->crud_model->service_get_name_by_id($d);
                    $thename['servname'] = $this->crud_model->service_get_name_by_id($result[$i]['idServ']);
                    $theurl['url'] = $this->crud_model->service_get_field_by_id($result[$i]['idServ'],'url');
                    $thestat['stats'] = $thestats[$result[$i]['status']];
                    //$theentropy['entropy'] = $this->crud_model->entropy($result[$i]['password']);
                    if($result[$i]['status'][0] == '1'){
                        //$len = strlen($result[$i]['password']);
                        $len = 8;
                        $pwd = "";
                        for($j=0;$j<$len;$j++) $pwd .="*";                    
                        $result[$i]['password'] = $pwd;                        
                    }elseif($result[$i]['status'][0] =='0'){
                        //Decrypt password
                    }
                    $result2[] = array_merge($result[$i],$thename,$thestat,$theurl);
                } 
                //print_r($names);
                //print_r($result2);
                $page_data["services"] = $result2;
            }
            $page_data["links"] = $this->pagination->create_links();
            

            $this->load->view('index', $page_data);
        }

    }

    function viewservice($idvinculation)
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_name'] = 'theservice';
            $page_data['page_title']  = 'View Service';
            $iduser = $this->session->userdata('userid');
            $this->crud_model->vinculation_accountservice_update_status_by_iduser($iduser);
            $nmyservices = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($iduser);
            $page_data['nservices'] = $this->crud_model->get_num_filas('service');
            $page_data['nmyservices'] = $nmyservices;
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $page_data['csrf_hash'] = $this->security->get_csrf_hash();
            $thestats = array(
                                '000' => array('Visible','Vulnerable','Asynchronous'),
                                '001' => array('Visible','Vulnerable','Synchronous'),
                                '010' => array('Visible','Protected','Asynchronous'),
                                '011' => array('Visible','Protected','Synchronous'),
                                '100' => array('Hidden','Vulnerable','Asynchronous'),
                                '101' => array('Hidden','Vulnerable','Synchronous'),
                                '110' => array('Hidden','Protected','Asynchronous'),
                                '111' => array('Hidden','Protected','Synchronous')
                            );

            //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
            //pagination!
            //styling status
            $style = array('Visible' => 'danger',
                           'Hidden' => 'success',
                           'Asynchronous' => 'danger',
                           'Synchronous' => 'success',
                            'Vulnerable' => 'danger',
                            'Protected' => 'success'
                );
            $page_data['stylestatus'] = $style;
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($idvinculation);            
            if($result != false){          
                $stat = $result['status'];
                $theentropy['entropy'] = $this->crud_model->entropy($result['password']);
                $ent = $this->crud_model->shannonEntropy($result['password']);
                $theentropy['shann_entropy'] = $ent['raw_shannon'];
                $theentropy['mshann_entropy'] = $ent['metric_shannon'];
                if($stat[0] == '1'){
                    //$len = strlen($result['password']);
                    //$oldlen = strlen($result['oldpassword']);                    
                    $len = $oldlen = 8;
                    $pwd = "";
                    $oldpwd = "";
                    for($i=0;$i<$len;$i++) $pwd .="*";                    
                    for($i=0;$i<$oldlen;$i++) $oldpwd .="*";                    
                    $result['password'] = $pwd;
                    $result['oldpassword'] = $oldpwd;
                    //print_r($result);
                }elseif($stat[0] == '0'){
                     //decrypt password
                    
                }
                //print_r($result);
                $page_data['stats'] = $thestats[$result['status']];
                $thename = array('servname'=>'');
                $theurl = array('url' => '');
                $thename['servname'] = $this->crud_model->service_get_name_by_id($result['idServ']);
                $theurl['url'] = $this->crud_model->service_get_field_by_id($result['idServ'],'url')->url;

                $result2 = $result + $thename + $theurl + $theentropy;
                //print_r($names);
                //print_r($result2);
                $page_data["service"] = $result2;
            }

            $this->load->view('index', $page_data);
        }

    }
    function goservice($id)
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                       
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            $idserv = $result['idServ'];
            $resultquery = $this->crud_model->vinculation_accountservice_update_times_by_id($id,$idserv);
            $theurl = $this->crud_model->service_get_field_by_id($idserv,'url');                                    
            redirect($theurl->url);
        }

    }
    function renewpasswordservice($id){
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                       
            $pwdlen = $this->input->post('passwordlen');
            //print_r($pwdlen);
            $newpass = $this->crud_model->generateRandomString($pwdlen,-1);                    
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            if($result != false){
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $status = $result['status'];
                $newstat = $status[0].'10'; //
                $data = array('password' => $newpass,
                            'status' => $newstat,
                            'lastChangedPwd' => date("Y-m-d H:i:s"));
                $this->crud_model->vinculation_accountservice_update_fields_by_id($id,$data);    
            }
            
            redirect(base_url().'?user/myservices', 'refresh');
        }
    }
    function renewthepassword($id){
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                       
            $pwdlen = $this->input->post('passwordlen');
            //print_r($pwdlen);
            $newpass = $this->crud_model->generateRandomString($pwdlen,-1);                    
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            if($result != false){
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $status = $result['status'];
                $newstat = $status[0].'10'; //
                $data = array('password' => $newpass,
                            'status' => $newstat,
                            'lastChangedPwd' => date("Y-m-d H:i:s"));
                $this->crud_model->vinculation_accountservice_update_fields_by_id($id,$data);    
            }
            
            redirect(base_url().'?user/viewservice/'.$id, 'refresh');
        }
    }
    function renewthevaluation($id){
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                       
            $valuation = $this->input->post('valuation');               
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);       
            if($result != false){
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $this->crud_model->vinculation_accountservice_update_field_by_id($id,'valuation',$valuation);    
            }
            
            redirect(base_url().'?user/viewservice/'.$id, 'refresh');
        }
    }
    function renewthenotes($id){
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                       
            $notes = $this->input->post('notes');               
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);       
            if($result != false){
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $this->crud_model->vinculation_accountservice_update_field_by_id($id,'notes',$notes);    
            }
            
            redirect(base_url().'?user/viewservice/'.$id, 'refresh');
        }
    }
    
    function syncservice($id){
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                                   
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            if($result != false){                
                $status = $result['status'];
                $password = $result['password'];
                $newstat = $status[0].$status[1].'1'; //                
                $data = array('status' => $newstat,'oldpassword' => $password);
                $this->crud_model->vinculation_accountservice_update_fields_by_id($id,$data);    
                //$this->crud_model->vinculation_accountservice_update_field_by_id($id,'status',$newstat);    
            }
            
            redirect(base_url().'?user/myservices', 'refresh');
        }
    }
    function synctheservice($id){
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{                                   
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            if($result != false){                
                $status = $result['status'];
                $password = $result['password'];
                $newstat = $status[0].$status[1].'1'; //
                $data = array('status' => $newstat,'oldpassword' => $password);
                $this->crud_model->vinculation_accountservice_update_fields_by_id($id,$data);    
                //$this->crud_model->vinculation_accountservice_update_field_by_id($id,'status',$newstat);    
            }
            
            redirect(base_url().'?user/viewservice/'.$id, 'refresh');
        }
    }
    function dismiss_service($id)
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{ 
            $check = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            $iduser = $this->session->userdata('userid');
            if($check['idAcc'] = $iduser){
                $result = $this->crud_model->vinculation_accountservice_delete_by_id($id);                                              
            }            
            redirect(base_url().'?user/myservices','refresh');
        }

    }
    function check_password($id=-1, $hide="show")
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            if($id==-1){
                $idAcc = $this->session->userdata('userid');
                if(strtolower($hide)=="show"){
                    $result = $this->crud_model->vinculation_accountservice_fetch_tabla_by_idAcc($idAcc,90,0,"hide");
                    if($result != false){
                        foreach($result as $row){                                                        
                            $id      = $row['id'];
                            $status  = $row['status'];
                            $newstat = '0'.$status[1].$status[2]; //                    
                            $this->crud_model->vinculation_accountservice_update_field_by_id($id,'status',$newstat);    
                        }                 
                       
                    }                    
                }elseif(strtolower($hide) == "hide"){
                    $result = $this->crud_model->vinculation_accountservice_fetch_tabla_by_idAcc($idAcc,90,0,"visible");
                    if($result != false){
                        foreach($result as $row){                                                        
                            $id      = $row['id'];
                            $status  = $row['status'];
                            $newstat = '1'.$status[1].$status[2]; //                    
                            $this->crud_model->vinculation_accountservice_update_field_by_id($id,'status',$newstat);    
                        }                 
                       
                    } 
                }                   
                   
            }else{
                $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
                if($result != false){                
                    $status = $result['status'];
                    if(strtolower($hide)=="show"){
                        $newstat = '0'.$status[1].$status[2]; //                
                    }elseif(strtolower($hide) == "hide"){
                        $newstat = '1'.$status[1].$status[2]; //                
                    }
                    $this->crud_model->vinculation_accountservice_update_field_by_id($id,'status',$newstat);    
                }    
            }
            
            
            redirect(base_url().'?user/myservices', 'refresh');
        }
    }
    function check_thepassword($id, $hide="show")
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{ 
            $result = $this->crud_model->vinculation_accountservice_get_all_by_id($id);
            if($result != false){                
                $status = $result['status'];
                if(strtolower($hide)=="show"){
                    $newstat = '0'.$status[1].$status[2]; //                
                }elseif(strtolower($hide) == "hide"){
                    $newstat = '1'.$status[1].$status[2]; //                
                }
                $this->crud_model->vinculation_accountservice_update_field_by_id($id,'status',$newstat);    
            }            
            redirect(base_url().'?user/viewservice/'.$id, 'refresh');
        }
    }
    
    function myservices_to_excel()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to Excel';
            $page_data['page_name']  = 'myservices_to_excel';  
            $iduser = $this->session->userdata('userid');
            $total = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($iduser);          
            $limit = 2;
            $start = 0;                       
            $finalresult = array();            
            for($start; $start <= $total; $start += $limit){                
                $result = $this->crud_model->vinculation_accountservice_fetch_tabla_by_idAcc($iduser,$limit,$start);                
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;
                
            }          
            //print_r($finalresult);
            $page_data["services"] = $finalresult;
            $this->load->view('user/myservices_to_excel', $page_data);    
        }

    }
    function myservices_to_xml()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to XML';
            $page_data['page_name']  = 'myservices_to_xml';
            $iduser = $this->session->userdata('userid');
            $total = $this->crud_model->vinculation_accountservice_get_num_filas_by_id($iduser);
            $limit = 50;
            $start = 0;                       
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){                
                $result = $this->crud_model->vinculation_accountservice_fetch_tabla_by_idAcc($iduser,$limit,$start);                
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;
                
            }          
            
            $page_data["services"] = $finalresult;
            //$page_data["output"] = $output;
            $this->load->view('user/myservices_to_xml', $page_data);    
        }

    }

    /* IGNORE BELLOW - JUST FOR FUTURE REFERENCES */

    /*
    function comprar_numero($thehash = '')
    {
        $mail = $this->session->userdata('email');
        $iduser = $this->session->userdata('userid');
        $query = $this->db->get_where('payment', array('iduser' => $iduser));
        $cantidad = $query->row()->cantidad;
        $hash = $query->row()->hash;
        $page_data['cantidad']  = $cantidad;
        $page_data['personal_data'] = $this->crud_model->get_datos_personales();
        if ($thehash != '' && strtoupper($thehash) != 'NONE' && $hash == $thehash){
            $result = $this->crud_model->update_rifa($cantidad);    
        }else{
            $this->session->set_flashdata('flash_message', 'Creación de cuenta fallida!');
            //redirect(base_url() . '?account/create', 'refresh');    
            $page_data['flash_message'] = 'Creación de cuenta fallida!';
            $this->load->view('signup',$page_data);

            $result = false;
        }
        
        $this->crud_model->update_payment(0);
        
        if($result == true){
            $page_data['page_name']  = 'invoice';
            $page_data['page_title'] = 'invoice';
            $page_data['valor_rifa'] = 10000;            
            $page_data['numeros_rifa'] = $this->crud_model->get_last_venta($cantidad);
            $idtransaccion = $this->crud_model->get_last_transaccion_by_id($iduser);
            $page_data['idtransaccion'] = $idtransaccion;
        
            $fecha = $this->db->select('fecha_transaccion')
                                ->from('transaccion')
                                ->where('idtransaccion',$idtransaccion)
                                ->get()->first_row()->fecha_transaccion;
            $page_data['fecha_transaccion'] = $fecha;
            
            $this->load->view('index', $page_data);
        }else{
            $this->session->set_flashdata('flash_message', 'Creación de cuenta fallida!');
            //redirect(base_url() . '?account/create', 'refresh');    
            $page_data['flash_message'] = 'Creación de cuenta fallida!';
            $this->load->view('signup',$page_data);

            redirect(base_url() . 'index.php?user/profile', 'refresh');    
        }
        

        $page_data['voucher'] = $result;
        
        //$this->load->view('user/invoice', $page_data);
    }

    
    function reg_sell()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');
        
        $iduser = $this->session->userdata('userid');
        $page_data['page_title'] = 'registered_sells';
        $page_data['page_name']  = 'registered_sells';
        $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
        $query = $this->db->query("SELECT T.* FROM transaccion T, venta V WHERE V.id_user = $iduser AND T.idtransaccion = V.idtransaccion GROUP BY idtransaccion");
        $page_data['transaccion'] = $query->num_rows();
        //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
        //pagination!
        
        $config = array();
        $config["base_url"] = base_url() . "?user/reg_sell";        
        $config["total_rows"] = $query->num_rows();        
        $config["per_page"] = 10; //20 antes
        $config["uri_segment"] = 3; 
        
        $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '<i class="fa fa-step-forward"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
                
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  //SEGMENTO QUE INDICA EL NUMERO      
        $page_data["transaction"] = $this->crud_model->fetch_trans_by_id($iduser,$config["per_page"],$page);        
        $page_data["links"] = $this->pagination->create_links();
        

        $this->load->view('index', $page_data);

    }

    function voucher($idtransaccion = 0)
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');
        
        $iduser = $this->session->userdata('userid');
        $page_data['page_name'] = 'invoice';
        $page_data['page_title'] = 'invoice';
        $query = $this->db->query("SELECT T.* FROM transaccion T, venta V WHERE V.id_user = $iduser AND T.idtransaccion = V.idtransaccion GROUP BY idtransaccion");              
        $page_data['transaccion'] = $query->num_rows();        
        $page_data['idtransaccion'] = $idtransaccion;
        $query_trans = $this->db->get_where('venta', array('idtransaccion' => $idtransaccion, 'id_user' => $iduser));
        if($query_trans->num_rows() > 0){
            $fecha = $this->db->select('fecha_transaccion')
                            ->from('transaccion')
                            ->where('idtransaccion',$idtransaccion)
                            ->get()->first_row()->fecha_transaccion;
            $page_data['fecha_transaccion'] = $fecha;
            
            $result = $query_trans->result();
            $page_data['numeros_rifa'] = $result;        
            $page_data['personal_data'] = $this->crud_model->get_datos_personales();        
            $page_data['valor_rifa'] = 10000;
            $page_data['cantidad'] = $query_trans->num_rows(); 
            $this->load->view('index',$page_data);
        }else{
            $page_data['page_title'] = '404NotFound';
            $page_data['page_name']  = 'four_zero_four';
            $this->load->view('index',$page_data);

        }
        
    }

    function proceso_pago()
    {   
        $iduser = $this->session->userdata('userid');
        $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
        $query = $this->db->query("SELECT T.* FROM transaccion T, venta V WHERE V.id_user = $iduser AND T.idtransaccion = V.idtransaccion GROUP BY idtransaccion");
        $page_data['transaccion'] = $query->num_rows();
        $page_data['transaction'] = $query->result();
        $page_data['compras'] = $this->crud_model->get_rifa();
        $page_data['valor_rifa'] = 10000;
        $mail = $this->session->userdata('email');
        $iduser = $this->session->userdata('userid');
        $cantidad = $this->input->post('cantidad');
        if ($cantidad == ''){
            $page_data['page_name'] = 'profile';
            $page_data['page_title'] = 'profile';
            $page_data['flash_message'] = 'Error, no ha ingresado una cantidad de boletos';
            $cantidad = 0;
        }else{
            $cantidad = intval($cantidad);
        	$str = $this->crud_model->generateRandomString(20);
        	$hash = sha1($str);
            $rifa_total = $this->crud_model->get_num_filas('rifa');
            $rifa_compradas = $this->crud_model->get_num_filas('venta');
            $disponible = $rifa_total - $rifa_compradas;
            if ($disponible >= $cantidad){                
                $this->crud_model->update_payment($cantidad, $hash,0);  
                $page_data['thehash'] = $hash;
                $page_data['page_name'] = 'payment';
                $page_data['page_title'] = 'payment';
                $page_data['cantidad'] = $this->crud_model->get_payment_by_id($iduser)->cantidad;
                

                
            }else{
                $page_data['page_name'] = 'profile';
                $page_data['page_title'] = 'profile';
                $page_data['flash_message'] = 'Error, cantidad solicitada mayor a la disponible de '.$disponible.' reintente con menos boletos.';

            }
        }
        
        $this->load->view('index',$page_data);   
    }

    function confirmar_compra(){
        $iduser = $this->session->userdata('userid');
        $page_data['page_name'] = 'request';
        $page_data['page_title'] = 'request';
        $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
        $query = $this->db->query("SELECT T.* FROM transaccion T, venta V WHERE V.id_user = $iduser AND T.idtransaccion = V.idtransaccion GROUP BY idtransaccion");
        $page_data['transaccion'] = $query->num_rows();
        $page_data['cantidad'] = $this->crud_model->get_payment_by_id($iduser)->cantidad;
        $page_data['valor_rifa'] = 10000;
        $confirmado = $this->crud_model->get_payment_by_id($iduser)->confirmado;
        if($confirmado == 0){
            $page_data['flash_message'] = 'Petición de pago.';
            $this->crud_model->confirm_payment();
            $this->email_model->send_request_email();
        }else{
            $page_data['flash_message'] = 'Nueva petición de pago.';
            $this->crud_model->confirm_payment();
            $this->email_model->send_request_email();
        }
        $this->load->view('index',$page_data);
    }

    function denegar_compra(){
        $iduser = $this->session->userdata('userid');
        $page_data['page_name'] = 'profile';
        $page_data['page_title'] = 'profile';
        $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
        $query = $this->db->query("SELECT T.* FROM transaccion T, venta V WHERE V.id_user = $iduser AND T.idtransaccion = V.idtransaccion GROUP BY idtransaccion");
        $page_data['transaccion'] = $query->num_rows();
        //$page_data['flash_message'] = 'Ha rechazado una petición de pago.';
        $this->crud_model->update_payment(0);
        $this->load->view('index',$page_data);   
    }
    */
    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $page_data['page_title'] = '404NotFound';
        $page_data['page_name']  = 'four_zero_four';    
        $this->load->view('index',$page_data);
    }

    function pago_fallido()
    {
        $page_data['page_name'] = 'error404';
        $page_data['page_title'] = 'error404';
        $this->crud_model->update_payment(0);
        $this->load->view('index',$page_data);      
    }
  
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?user/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?user/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('index', $page_data);
    }
    
   
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('user_login') != 1)
            redirect('login', 'refresh');
        if ($do == 'upload') {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/document/" . $_FILES["userfile"]["name"]);
            $data['document_name'] = $this->input->post('document_name');
            $data['file_name']     = $_FILES["userfile"]["name"];
            $data['file_size']     = $_FILES["userfile"]["size"];
            $this->db->insert('document', $data);
            redirect(base_url() . 'admin/manage_document', 'refresh');
        }
        if ($do == 'delete') {
            $this->db->where('document_id', $document_id);
            $this->db->delete('document');
            redirect(base_url() . 'admin/manage_document', 'refresh');
        }
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('index', $page_data);
    }
    
}
