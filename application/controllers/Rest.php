<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rest extends CI_Controller
{
   
        
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('table');
    }

   public function xlogin()
   {
        $this->load->model('Api_model');
      $u=$this->input->post('userid', TRUE);
       $p=$this->input->post('password', TRUE);
       $key['userid']=($u);
       $key['password']=md5($p.'usn1234');
       $row=$this->Api_model->get_row_selected('user',$key);
       if($row)
       {
           echo '1';
       }else
       {
           echo 'Login Gagal';
       }
   }
   public function xprodi()
   {
       $this->load->model('Api_model');
      
       $row=$this->Api_model->get_all('prodi');
       if($row)
       {
           echo json_encode($row);
       }else
       {
           echo 'Data tidak ditemukan';
       }
   }
   
   public function xdosen()
   {
       $this->load->model('Api_model');
      
       $row=$this->Api_model->get_all_asc('dosen','nm_dosen');
       if($row)
       {
           echo json_encode($row);
       }else
       {
           echo 'Data tidak ditemukan';
       }
   }

    

}

