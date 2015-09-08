<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
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
        
        // Captcha parameters:
        $captchaConfig = array(
            'CaptchaId' => 'FormCaptcha', // a unique Id for the Captcha instance
            'UserInputId' => 'CaptchaCode' // Id of the Captcha code input textbox
        );
        // load the BotDetect Captcha library
        $this->load->library('botdetect/BotDetectCaptcha', $captchaConfig);
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'email'));
        
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . '?admin/dashboard', 'refresh');
            //$this->load->view('admin/dashboard');
            
            
        if ($this->session->userdata('user_login') == 1)            
            redirect(base_url() . '?user/dashboard', 'refresh');
            //$this->load->view('user/profile');
            

        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|xss_clean|callback__validate_login'
            ),
            array( // Captcha code user input validation rules
                'field'   => 'CaptchaCode', 
                'label'   => 'Captcha code'
                //'rules'   => 'callback_captcha_validate'
            )
        );
        
        $this->form_validation->set_rules($config);
        //$this->form_validation->set_message('_validate_login', ' Login failed!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>', '</div>');


        // the Captcha is not shown if the user already solved it but validation of
        // other form fields failed
        if (!$this->botdetectcaptcha->IsSolved) {
            $page_data['captchaSolved'] = false;
            $page_data['captchaHtml'] = $this->botdetectcaptcha->Html();
        } else {
            $page_data['captchaSolved'] = true;
            $page_data['captchaHtml'] = '';
        }


        if ($this->form_validation->run() == FALSE) {
            $page_data['flash_message'] = $this->session->flashdata('flash_message');
            $this->load->view('signin',$page_data);
        } else {
            $this->botdetectcaptcha->Reset(); 
            if ($this->session->userdata('admin_login') == 1)
                redirect(base_url() . '?admin/dashboard', 'refresh');
                //$this->load->view('admin/dashboard');
                
            if ($this->session->userdata('user_login') == 1)                
                redirect(base_url() . '?user/dashboard', 'refresh');
                //$this->load->view('user/profile');
                
           
        }
        
    }
    
    /***validate login****/
    function _validate_login($str)
    {
        $email = $this->input->post('email');
        
        //USEFUL TO CHOOSE FILE OF VIEWS
        $usertype = 'user';
        //$mailAdmin = 'marco.espinoza@live.cl';
        $mailAdmin = 'drigox90rih@gmail.com';
        if ($email == $mailAdmin){
            $usertype = 'admin';
        }
        $query_prev = $this->db->select('*')->get_where('account', array('Muser' => $email  ));

        if ($query_prev ->num_rows() > 0) {
            
            $salt = $query_prev->row()->salt;
            $password = sha1($this->input->post('password') + $salt);
            $query = $this->db->select('*')->get_where('account', array('Muser' => $email, 'Mpassword' => $password ));

            //echo 'PASS FROM TABLE: '.$pass;
           if ($query ->num_rows() > 0) {
                $userid = $this->crud_model->account_get_id_by_Muser($email);
                //$this->crud_model->insertCode(1000);
                if ($usertype == 'admin') {
                    $this->session->set_userdata('admin_login', '1');
                    $this->session->set_userdata('userid', $userid);
                    $this->session->set_userdata('login_type', $usertype);
                    $this->session->set_userdata('email',$email);
                }
                if ($usertype == 'user') {

                    $this->session->set_userdata('user_login', '1');
                    $this->session->set_userdata('userid', $userid);
                    $this->session->set_userdata('login_type', $usertype);
                    $this->session->set_userdata('email',$email);
                }
              
                return TRUE;    
            }else{
                $this->session->set_flashdata('flash_message', 'Usuario y/o contraseña incorrecto(s)');
                //redirect(base_url(). '?login' , 'refresh');
                $page_data['flash_message'] = "Usuario y/o contraseña incorrecto";
                $this->load->view('signin', $page_data);
                return FALSE;
            }
        
            
        } else {

            $this->session->set_flashdata('flash_message', 'Usuario y/o contraseña invalida(s)');
            //redirect(base_url(). '?login' , 'refresh');
            $page_data['flash_message'] = "Usuario y/o contraseña invalido";
            $this->load->view('signin', $page_data);
            return FALSE;
        }
    }

    // Captcha validation callback used in form validation
    public function captcha_validate($code) {
        // user considered human if they previously solved the Captcha...
        $isHuman = $this->botdetectcaptcha->IsSolved;
        if (!$isHuman) {
            // ...or if they solved the current Captcha
            $isHuman = $this->botdetectcaptcha->Validate($code);
        }
        
        // set error if Captcha validation failed
        if (!$isHuman) {
            $this->form_validation->set_message('captcha_validate', 'Please retype the characters from the image correctly.');
        }
        
        return $isHuman;
    }
    
    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    
}
