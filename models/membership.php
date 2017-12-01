<?php

class Membership extends CI_Model{
    function validate(){
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('agent');
        
        if($query->num_rows == 1){
            return true;
        }
        else{
			return false;
		}
    }
    function checkusername()
    {
    	$this->db->where('Username', $this->input->post('username'));
    	$query = $this->db->get('account');

    	if($query->num_rows>=1){
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }
    function compairpassword()
    {
    	if($this->input->post('password') == $this->input->post('confirmpassword'))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }
}