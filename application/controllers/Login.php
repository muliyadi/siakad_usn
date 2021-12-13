<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author abd_salam
 */
class Login extends CI_Controller {

    public function _construct() {
ob_start();
	session_start();
    }

    function index() 
    {
	$cek = $this->session->userdata('logged_in');
    	if (empty($cek)) 
    	{
    	    $data = array('userid' => '', 'password' => '');
    	    
    	    $this->load->view('login', $data);
    	} 
    	else 
    	{
    	    'cek levelnya';
    	}
    }

    public function login2() {
	$this->load->model('user_model');
	$u = $this->input->post('userid');
	$p = $this->input->post('password');
	$u2 = mysql_real_escape_string($u);
	//$p2 = md5(mysql_real_escape_string($p));
	$p2 = (mysql_real_escape_string($p));

	$hasil = $this->user_model->cek($u2, $p2);
	if ($hasil) {
	    $sess_data['logged_in'] = 'yes';
	    $sess_data['nim'] = $u2;
	    $sess_data['prodi'] = 'SI';
	    $data=array('data'=>'bismillah');
	    $this->session->set_userdata($sess_data);
	    $this->template->load('templatemhs', 'bismillah', $data);
	} else {
	    header('location:' . base_url() . 'krs');
	    //redirect(site_url());
	}
    }
    public function logout()
    {
	$this->session->sess_destroy();
	 redirect(base_url());
    }

}

?>
