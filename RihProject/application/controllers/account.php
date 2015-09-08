<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cash control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default function, redirects to login page if no admin logged in yet***/
    public function index()
    {
        
              
    }
    
    function create(){
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|xss_clean|callback__validate_creation'
            )
        );
        
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_creation',  ' Creación fallida!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
        
        
        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('login');
            $this->load->view('signup');
        } else {
            if ($this->session->userdata('admin_login') == 1)
                redirect(base_url() . '?admin/dashboard', 'refresh');
            if ($this->session->userdata('user_login') == 1)
                redirect(base_url() . '?user/profile', 'refresh');
           
        }
    }
    /***validate login****/
    function _validate_creation($str)
    {
        $email = $this->input->post('email');
        $query = $this->db->get_where('account',array('correo' => $email));        
        $usertype = 'user';
        
        
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('flash_message', 'Correo ya utilizado');
            redirect(base_url() . '?account/create', 'refresh');
            return FALSE;
        }else{
        
            if ( $usertype== 'user') {
                $this->session->set_userdata('user_login', '1');
                $this->session->set_userdata('login_type', $usertype);
                $this->session->set_userdata('email',$email);
            }
          
            return TRUE;
        }

    }

/***CREATE A NEW ACCOUNT TO REQUESTED EMAIL****/
      function create_account()
    {
        
        
        $email  = $this->input->post('email');
        $query  =   $this->db->get_where('account' , array('Muser' => $email));
        if($query->num_rows() > 0 || strlen($email) == 0){
            $this->session->set_flashdata('flash_message', 'Creación de cuenta fallida, correo inválido o cuenta ya existe!');
            //redirect(base_url() . '?account/create', 'refresh');    
            $page_data['flash_message'] = 'Creación de cuenta fallida, correo inválido o cuenta ya existe!';
            $this->load->view('signup',$page_data);

        }else{            
            
            $lengthsalt = 10;            
            $newsalt   =   $this->email_model->generateRandomString($lengthsalt);
            $length = $this->input->post('npassword');

            //$password = $this->email_model->generateRandomString($length);
            $password = '';
            for ($i=1;$i<=$length;$i++){
                $password .= strval($i);
            }
            $newpass = sha1($password + $newsalt);
            $pattern = '12344321';
            $data = array(
                'Muser' => $email,
                'Mpassword' => $newpass,
                'Mpattern' => $pattern,
                'salt' => $newsalt
                );
            $result = $this->email_model->create_account_email($data,$password); //SEND EMAIL ACCOUNT OPENING EMAIL
            if ($result == true) {
                $this->session->set_flashdata('flash_message', 'Cuenta creada, contraseña enviada a su correo.');
                $page_data['flash_message'] = 'Cuenta creada con éxito, contraseña enviada a su correo.';
                $this->load->view('signin',$page_data);
            } else if ($result == false) {
                $this->session->set_flashdata('flash_message', 'Creación de cuenta fallida.');
                $page_data['flash_message'] = 'Creación de cuenta fallida!';
                $this->load->view('singup',$page_data);
            }       
            //redirect(base_url() . '?login', 'refresh');            
        }
       
    }    
   /***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
    function recover()
    {
         $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email'
            )
        );
        $this->form_validation->set_rules($config);
        $this->load->view('recover');
    }

    
    
    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    
/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
    function recover_password()
    {
        
        $email  = $this->input->post('email');
        $npassword = $this->input->post('npassword');
        $query = $this->db->get_where('account', array('Muser' => $email));
        if ($query->num_rows() > 0 && strlen($email) > 0){
                $result = $this->email_model->password_reset_email($email,$npassword); //SEND EMAIL ACCOUNT OPENING EMAIL
            if ($result == true) {
                $this->session->set_flashdata('flash_message', 'Contraseña enviada.');
                $page_data['flash_message'] = 'Contraseña enviada a su correo';
                $this->load->view('recover',$page_data);
            }           
        }else{
            $this->session->set_flashdata('flash_message', 'Correo inválido o Cuenta no encontrada.');
            $page_data['flash_message'] = 'Cuenta no encontrada';
            $this->load->view('recover',$page_data);
        }
        
        //redirect(base_url(), 'refresh');
    }

    function change_password_form(){
        $this->load->view('change_password');
    }

    function change_password(){
         
        
        $data['new_password']         = $this->input->post('password');
        
        //$data['password']  = sha1($this->input->post('oldpassword') + $current_salt);

        if ( $data['new_password'] != "") {
            //$data['confirm_new_password'] = $this->input->post('repassword');
            $query = $this->db->get_where('account', array('correo' => $this->session->userdata('email')));
            $current_password = $query->row()->password;
            $current_salt = $query->row()->salt;

            //SALT CREATION            
            $length = 10;            
            $newsalt   =   $this->email_model->generateRandomString($length);
            $newpass = sha1($data['new_password'] + $newsalt);
            $this->db->where('correo', $this->session->userdata('email'));
            $this->db->update('account', array(
                'password' => $newpass,
                'salt' => $newsalt
            ));
            //SENDING AN EMAIL TO REMIND THE PASSWORD HAD CHANGED
            $this->email_model->password_change_email( $this->session->userdata('email'), $data['new_password']);            
            $this->session->set_flashdata('flash_message', 'Contraseña actualizada');
            
            //$msg = "Contraseña actualizada, se ha enviado un correo para futura referencia aunque se recomienda eliminar el correo y memorizar.";
        } else {
            //$msg = "Contraseña invalida, intente nuevamente.";
            $this->session->set_flashdata('flash_message', 'Contraseña vacía');
            
        }

        if ($this->session->userdata('admin_login') == 1)       redirect(base_url() . '?admin/dashboard', 'refresh');
        else if ($this->session->userdata('user_login') == 1)   redirect(base_url() . '?user/profile', 'refresh');
        else                                                    redirect(base_url(), 'refresh');
    
    }
	
    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'?login' , 'refresh');
    }
    
}
