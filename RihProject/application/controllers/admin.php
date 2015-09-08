<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *   Nulled By Vokey 
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();

		$this->load->database();
        $this->load->model('crud_model');
        $this->load->library("pagination");
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . '?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . '?admin/dashboard', 'refresh');

        
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            if($param1 != ''){
                $page_data['msg'] = $param1;
            }
            $page_data['page_name']  = 'dashboard';
            $page_data['page_title'] = 'Dashboard';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            
             $page_data['compraspendientes'] = 3;
            $page_data['user'] = 12;
            $page_data['venta'] = 55;
            $page_data['transaccion'] = 66;
            $page_data['rifa'] = 22;
            //$page_data['last_transaccion'] = $this->crud_model->get_last_transaction();
            
            $page_data['valor_rifa'] = 10000;
            //$this->session->keep_flashdata('flash_message');
            $page_data['flash_message'] = $this->session->flashdata('flash_message');
            //$this->crud_model->insertCode(75000);
            //$this->session->set_flashdata('flash_message',$this->session->userdata('flash_message'));
            $this->load->view('index', $page_data);
            //$this->load->view('admin/dashboard', $page_data);    
        }
        
        
    }
    function create_service_form()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data['page_name']  = 'createservice';
            $page_data['page_title'] = 'Create Service';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            //$page_data['flash_message'] = $this->session->flashdata('flash_message');
            $this->load->view('index', $page_data);
           
        }
        
        
    }
        function create_service()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data['page_name']  = 'createservice';
            $page_data['page_title'] = 'Create Service';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $name = $this->input->post('name');
            $url = $this->input->post('url');
            $topic = $this->input->post('topic');
            $desc = $this->input->post('description');
            $this->crud_model->service_insert($name,$url,$topic,$desc,1); //approvation not required
            //$this->session->set_flashdata('flash_message', 'Nuevo servicio creado!');
            $page_data['flash_message'] = 'Nuevo servicio creado!';
            $this->load->view('index', $page_data);
           
        }       
        
    }
    function edit_service($idserv = 0){
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            if($idserv == 0 || $idserv < 0) redirect(base_url().'?admin/services','refresh');

            $page_data['page_name']  = 'edit_theservice';
            $page_data['page_title'] = 'Edit Service';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            $result = $this->crud_model->service_get_all_by_id($idserv);
            $page_data['service'] = $result[0];
            //print_r($result);
            $this->load->view('index', $page_data);
        }
    }
    function renew_service($idserv = 0){
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $result = $this->crud_model->service_get_all_by_id($idserv);
            if($idserv == 0 || $idserv < 0 || $result == false) redirect(base_url().'?admin/services','refresh');

            $page_data['page_name']  = 'edit_theservice';
            $page_data['page_title'] = 'Edit Service';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1; 
            //print_r($this->input->post('edit'));
            //print_r($_POST['edit']);
            switch ($this->input->post('edit')) {
                case 'Edit Name':
                    # code...
                    $field = "name";
                    break;
                case 'Edit Topic':
                    # code...
                    $field = "topic";
                    break;
                case 'Edit Description':
                    # code...
                    $field = "desc";
                    break;
                case 'Edit Url':
                    # code...
                    $field = "url";
                    break;
                case 'Edit All':
                    # code...
                    $field = "all";
                    break;
                
                default:
                    # code...
                    $field = "all";
                    break;
            }
            if($field == "all"){
                $name = $this->input->post('name');
                $topic =$this->input->post('topic');
                $desc = $this->input->post('desc');
                $url = $this->input->post('url');
                $data = array('name' => $name,                    
                              'url' => $url,
                              'topic' => $topic,
                              'desc' => $desc                
                );
                $this->crud_model->service_update_fields_by_id($idserv,$data);
            }else{
                $val = $this->input->post($field);
                if($val != '')
                    $this->crud_model->service_update_field_by_id($idserv,$field,$val);
            }
            $result = $this->crud_model->service_get_all_by_id($idserv);
            $page_data['service'] = $result[0];
            //print_r($result);
            $this->load->view('index', $page_data);
        }
    }

    function services()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_name']  = 'services';
            $page_data['page_title'] = 'Services';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
            //pagination!
            
            $config = array();
            $config["base_url"] = base_url() . "?admin/services";
            $config["total_rows"] = $this->crud_model->service_get_num_filas(true);
            $config["per_page"] = 20; //20 antes
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $arg = true;
            $page_data["services"] = $this->crud_model->service_fetch_tabla($config["per_page"], $page, $arg);
            $page_data["links"] = $this->pagination->create_links();
            

            $this->load->view('index', $page_data);
        }

    }
    function users()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{            
            $page_data['page_name']  = 'users';
            $page_data['page_title'] = 'Users';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            
            //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
            //pagination!
            
            $config = array();
            $config["base_url"] = base_url() . "?admin/users";
            $config["total_rows"] = $this->crud_model->get_num_filas('account')+1;
            $config["per_page"] = 20; //20 antes
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            $page_data["accounts"] = $this->crud_model->fetch_tabla('account',$config["per_page"], $page);
            $page_data["links"] = $this->pagination->create_links();
            

            $this->load->view('index', $page_data);
        }

    }
    function deleteuser($iduser=0){
          if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $this->crud_model->account_delete_by_id('account',$iduser);
            redirect(base_url().'?admin/users', 'refresh');
        }
    }
    

    function approval_services()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{            
            $page_data['page_name']  = 'approval_services';
            $page_data['page_title'] = 'Approval Services';
            $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
            $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
            $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
            //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
            //pagination!
            
            $config = array();
            $config["base_url"] = base_url() . "?admin/approval_services";
            $config["total_rows"] = $this->crud_model->service_get_num_filas(false);
            $config["per_page"] = 20; //20 antes
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $arg = false;
            $page_data["services"] = $this->crud_model->service_fetch_tabla($config["per_page"], $page, $arg);
            $page_data["links"] = $this->pagination->create_links();
            

            $this->load->view('index', $page_data);
        }

    }

    function check_service($idserv=0, $option = "deny"){
          if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            if($option == "approve"){
                $fieldname = "approved";
                $this->crud_model->service_update_field_by_id($idserv,$fieldname, 1); //aprove new service
            }else if($option == "deny"){
                $this->crud_model->service_delete_by_id($idserv);
            }
            
            redirect(base_url().'?admin/approval_services', 'refresh');
        }
    }


    function services_to_excel()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to Excel';
            $page_data['page_name']  = 'services_to_excel';
            $total = $this->crud_model->get_num_filas('service');
            $limit = 2;
            $start = 0;                       
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){                
                $result = $this->crud_model->fetch_tabla('service',$limit,$start);                
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;
                
            }          
           
            $page_data["services"] = $finalresult;
            $this->load->view('admin/services_to_excel', $page_data);    
        }

    }
    function services_to_xml()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to XML';
            $page_data['page_name']  = 'services_to_xml';
            $total = $this->crud_model->get_num_filas('service');
            $limit = 50;
            $start = 0;                       
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){                
                $result = $this->crud_model->fetch_tabla('service',$limit,$start);                
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;
                
            }          
            
            $page_data["services"] = $finalresult;
            //$page_data["output"] = $output;
            $this->load->view('admin/services_to_xml', $page_data);    
        }

    }


/*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup($operation = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        $tables = $this->db->list_tables();
        $page_data['nservices'] = $this->crud_model->service_get_num_filas(true);
        $page_data['nservicesforapproval'] = $this->crud_model->service_get_num_filas(false);
        $page_data['nusers'] = $this->crud_model->get_num_filas('account')+1;
        
        if ($operation == 'backup') {
            $type = $this->input->post('table');            
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            //print_r($_FILES['userfile']['tmp_name']);
            $this->crud_model->restore_backup();
            //$this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['tables'] = $tables;
        $page_data['page_title'] = 'Backup and Restore Data';
        $this->load->view('index', $page_data);
    }
    
    /*IGNORE BELLOW - JUST FOR FUTURE REFERENCES */
    /*
    function reg_buy()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data['page_title'] = 'registered_buys';
            $page_data['page_name']  = 'registered_buys';
            $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
            $page_data['compraspendientes'] = $this->crud_model->get_num_compras();
            $page_data['user'] = $this->crud_model->get_num_filas('user');
            $page_data['venta'] = $this->crud_model->get_num_filas('venta');
            $page_data['transaccion'] = $this->crud_model->get_num_filas('transaccion');
            $page_data['rifa'] = $this->crud_model->get_num_rifas_compradas();
            $page_data['valor_rifa'] = 10000;
            //$page_data['user'] = $this->crud_model->get_all_datos_personales();

            $config = array();
            $config["base_url"] = base_url() . "?admin/reg_buy";
            $config["total_rows"] = $this->crud_model->get_num_compras();
            $config["per_page"] = 20;
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;        
            $page_data["users"] = $this->crud_model->fetch_all_buys($config["per_page"],$page);
            $page_data["links"] = $this->pagination->create_links();        

            $this->load->view('index', $page_data);
        }
    }

   
    function reg_user()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'registered_users';
            $page_data['page_name']  = 'registered_users';
            $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
            $page_data['compraspendientes'] = $this->crud_model->get_num_compras();
            $page_data['user'] = $this->crud_model->get_num_filas('user');
            $page_data['venta'] = $this->crud_model->get_num_filas('venta');
            $page_data['transaccion'] = $this->crud_model->get_num_filas('transaccion');
            $page_data['rifa'] = $this->crud_model->get_num_rifas_compradas();
            //$page_data['user'] = $this->crud_model->get_all_datos_personales();

            $config = array();
            $config["base_url"] = base_url() . "?admin/reg_user";
            $config["total_rows"] = $this->crud_model->get_num_filas('user');
            $config["per_page"] = 20;
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;        
            $page_data["users"] = $this->crud_model->get_all_datos_personales($config["per_page"],$page);
            $page_data["links"] = $this->pagination->create_links();        

            $this->load->view('index', $page_data);
        }

    }
    
    function confirmar_venta($iduser, $thehash = '')
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $query = $this->db->get_where('payment', array('iduser' => $iduser));
            $cantidad = $query->row()->cantidad;
            $hash = $query->row()->hash;
            $page_data['cantidad']  = $cantidad;
            $page_data['personal_data'] = $this->crud_model->get_datos_personales();
            if ($thehash != '' && strtoupper($thehash) != 'NONE' && $hash == $thehash){
                $result = $this->crud_model->update_rifa($iduser,$cantidad);
                $this->email_model->confirm_sell_email($iduser);
            }else{
                $result = false;
            }
            
            $this->crud_model->update_payment_by_id($iduser);         
            redirect(base_url() . '?admin/reg_buy', 'refresh');    
            $page_data['voucher'] = $result;
            
            //$this->load->view('user/invoice', $page_data);
        }
        
        
    }
    function denegar_venta($iduser){
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $this->crud_model->update_payment_by_id($iduser);
            $this->email_model->deny_sell_email($iduser);
            redirect(base_url() . '?admin/reg_buy', 'refresh');        
        }        
    }

    function reg_sell()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'registered_sells';
            $page_data['page_name']  = 'registered_sells';
            $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
            $page_data['compraspendientes'] = $this->crud_model->get_num_compras();
            $page_data['sell'] = $this->crud_model->get_tabla('venta');
            $page_data['user'] = $this->crud_model->get_num_filas('user');
            $page_data['venta'] = $this->crud_model->get_num_filas('venta');
            $page_data['transaccion'] = $this->crud_model->get_num_filas('transaccion');
            $page_data['rifa'] = $this->crud_model->get_num_rifas_compradas();
            
            //$page_data['transaction'] = $this->crud_model->get_tabla('transaccion');        
            //pagination!
            
            $config = array();
            $config["base_url"] = base_url() . "?admin/reg_sell";
            $config["total_rows"] = $this->crud_model->get_num_filas('transaccion');
            $config["per_page"] = 20; //20 antes
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
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            $page_data["transaction"] = $this->crud_model->fetch_tabla('transaccion',$config["per_page"], $page);
            $page_data["links"] = $this->pagination->create_links();
            

            $this->load->view('index', $page_data);
        }

    }

    

    function user($iduser = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{

            
            $page_data['user'] = $this->crud_model->get_num_filas('user');
            $page_data['venta'] = $this->crud_model->get_num_filas('venta');
            $page_data['compraspendientes'] = $this->crud_model->get_num_compras();
            $page_data['transaccion'] = $this->crud_model->get_num_filas('transaccion');
            $page_data['rifa'] = $this->crud_model->get_num_rifas_compradas();
            $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
            
            $query = $this->db->get_where('user', array('iduser' => $iduser));

            if($query->num_rows() > 0 && $iduser != $this->session->userdata('userid')){                
                $page_data['page_name']  = 'userprofile';
                $page_data['page_title'] = 'userprofile';
                $page_data['personal_userdata']  = $this->crud_model->get_datos_personales_by_id($iduser);
                $page_data['compras'] = $this->crud_model->get_rifa_by_id($iduser);
                $this->load->view('index', $page_data);

            }else{                
                
                $page_data['page_title'] = '404NotFound';
                $page_data['page_name']  = 'four_zero_four';
                $this->load->view('index', $page_data);
            }
        }

    }

    function voucher($idtransaccion = 0)
    {   
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $query_trans = $this->db->get_where('venta', array('idtransaccion' => $idtransaccion));
            $page_data['personal_data'] = $this->crud_model->get_datos_personales($this->session->userdata('email'));
            $page_data['compraspendientes'] = $this->crud_model->get_num_compras();
            $page_data['user'] = $this->crud_model->get_num_filas('user');
            $page_data['venta'] = $this->crud_model->get_num_filas('venta');
            $page_data['transaccion'] = $this->crud_model->get_num_filas('transaccion');
            $page_data['rifa'] = $this->crud_model->get_num_rifas_compradas();
            $page_data['idtransaccion'] = $idtransaccion;
            
            if($query_trans->num_rows() > 0){
                $page_data['page_name'] = 'invoice';
                $page_data['page_title'] = 'invoice';
                
                $fecha = $this->db->select('fecha_transaccion')
                                    ->from('transaccion')
                                    ->where('idtransaccion',$idtransaccion)
                                    ->get()->first_row()->fecha_transaccion;
                $page_data['fecha_transaccion'] = $fecha;        
                $result = $query_trans->result();
                $page_data['venta_user'] = $result;
                $iduser = $query_trans->first_row()->id_user;
                $page_data['personal_userdata'] = $this->crud_model->get_datos_personales_by_id($iduser);                
                $page_data['valor_rifa'] = 10000;
                $page_data['cantidad'] = $query_trans->num_rows();
                $this->load->view('index',$page_data);    

            }else{
                $page_data['page_title'] = '404NotFound';
                $page_data['page_name']  = 'four_zero_four';
                $this->load->view('index',$page_data);
            }
        }

        
        
    }

function user_excel()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'registered_users';
            $page_data['page_name']  = 'registered_users';
            
            $page_data["users"] = $this->crud_model->get_all_user_datos_personales();
            $this->load->view('admin/users_excel', $page_data);    
        }

    }
    
    function sell_excel()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'registered_sells';
            $page_data['page_name']  = 'registered_sells';        
            $page_data["transaction"] = $this->crud_model->get_all_tansacciones();
            $this->load->view('admin/ventas_excel', $page_data);
        }
    }

    function boleto_excel()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'registered_sells';
            $page_data['page_name']  = 'registered_sells';        
            
            $page_data["rifas_vendidas"] = $this->crud_model->get_all_ventas();
            
            $this->load->view('admin/boletos_excel', $page_data);

        }
        
      
    }
    */
     /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $page_data['page_title'] = '404NotFound';
        $page_data['page_name']  = 'four_zero_four';    
        $this->load->view('index',$page_data);
    }
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->insert('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('index', $page_data);
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('index', $page_data);
    }
    
   

    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param2 == 'do_update') {
            $this->db->where('type', $param1);
            $this->db->update('settings', array(
                'description' => $this->input->post('description')
            ));
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('index', $page_data);
    }
    

    
    
    
    
}
