<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    var $data;

     function __construct(){
        parent::__construct(); // needed when adding a constructor to a controller

        date_default_timezone_set('America/Bogota');
        
        $this->data = array(
            //'dashboard_count' => $this->customer->get_customer_count(),
            'dashboard_count' => "2",
            'customer_count' => "2",
            'development_count' => "2",
            'requests_count' => "2",
            'launched_count' => "2",
            'account_count' => "2"
        );
        // $this->data can be accessed from anywhere in the controller.
    }
    //view index
    public function index()
    {
    	if ($this->session->userdata('is_logged_in'))
		{
            $username= $this->session->userdata('username');

            if ($this->get_identity($username)=='admin')
            {
                
				redirect('main/admin_dashboard';
            }
            elseif ($this->get_identity($username)=='employee')
            {
                
                redirect('main/employee_dashboard');
                
            }
		}
		else
		{
			redirect('main/login');
		}
    	
    }
     public function user_authentication()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->form_validation->set_rules('username', 'User Name', 'trim|required|callback_validate_credential');
        $this->form_validation->set_rules('password', 'Password', 'trim|md5|required');
                 
        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            //$identifier = $this->user->identifier($username);


                $data = array('username' => $username, 'is_logged_in' => 1);
        
                $this->session->set_userdata($data);
                $this->index();
        }
        else
        {
            redirect('main/login');
        }
    }
   
    //view validate credential
    public function validate_credential()
    {
        if($this->membership->validate())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //view logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('main/login');
    }
}