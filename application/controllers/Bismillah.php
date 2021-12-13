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
class Bismillah extends CI_Controller {
 public $view = 'template/templatelogin';
    function __construct() {
        parent::__construct();
        
	    
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
        $this->load->library('user_agent');
        $this->load->library('table');
        $this->load->helper(array('captcha','url','form'));
    }

    function index() {

            $config_captcha = array(
            'img_path'  => './captcha/',
            'img_url'  => base_url().'captcha/',
            'img_width'  => '330',
            'img_height' => 60,
            'border' => 1, 
            'expiration' => 1800,
            'word_length'   => 3,
            'font_size'     => 40,
             'pool'          =>'01234567890123456789012345678901234567890123456789012345678900',
             'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(211, 211, 211),
                'text' => array(0, 0, 0),
                'grid' => array(255, 255, 255)
        )
            
            
           );
          
           // create captcha image
           $cap = create_captcha($config_captcha);
          
           // store image html code in a variable
           $datax['captcha'] = $cap['image'];
          
           // store the captcha word in a session
           $this->session->set_userdata('mycaptcha', $cap['word']);
           
           
            $datax['listta'] = $this->Akademika_model->get_all_desc('thnajaran','kd_tahun_ajaran');
            $key['aktif']='ya';
    	    $ta=$this->Akademika_model->get_row_selected('thnajaran',$key);
    	    $datax['kd_tahun_ajaran']=$ta->kd_tahun_ajaran;
                 $this->template->load($this->view, 'login', $datax);
       
    }
    

function faduan()
{
    
}
function check_captcha($session,$input)
{
    
    if($session==$input) {

        return true;
    
    } else {

       

        return false;
    }
}
    public function freset_password()
    {
        
        $datax['userid']='';
       // $datax['no_wa']='';
        $datax['email']='';
        
        $this->load->view('reset_password',$datax);
    }
    function reset_password()
    {
        $email=$this->input->post('email');
        $userid=$this->input->post('userid');
        $password=$this->input->post('password');
        $key['userid']=$userid;
        $key['email']=$email;
        
        
        $datax['tgl_permohonan']=date('Y-m-d');
        $datax['userid']=$userid;
        $datax['email']=$email;
        $datax['new_pass']=$password;
        
        $pesan= '<H1>Aktifkan Password Baru dengan cara klik Link berikut: https://siakad.usn.ac.id/bismillah/verifikasi_reset'.'/'.$userid.'/'.$password;//ini adalah isi/body email
        $cek=$this->Akademika_model->get_row_selected('user',$key);
        if($cek)
        {
             $subject="Reset Password";
            $x= $this->kirim_email($email,$pesan,$subject);
            
            if($x=='terkirim')
            {
                $hasil=$this->Akademika_model->save_data('reset_password', $datax);
                echo 'Cek Inbox Email: '.$email. ' dan aktifkan password baru Anda....!!!';
            }
        }else
        {
            //echo 'Akun dan Email Anda belum terdaftar/verifikasi....!!!';
            $this->finput_email2($userid);
        }
       // redirect(base_url());
        
    }
    public function verifikasi_reset($userid,$password)
    {
        $key['userid']=$userid;
        $key['new_pass']=$password;
        $hasil=$this->Akademika_model->get_row_selected('reset_password',$key);
        if($hasil)
        {
            $data['password']=md5($password.'usn1234');
            //$data['password']=$password;
            $keys['userid']=$userid;
            $this->Akademika_model->update_data('user',$data,$keys);
        }
        redirect(base_url());
    }
    public function get_useri()
    {
        date_default_timezone_set('Asia/Jakarta');
        		if ($this->agent->is_browser()){
			$agent = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_mobile()){
			$agent = $this->agent->mobile();
		}else{
			$agent = 'Data user gagal di dapatkan';
		}
 echo $agent."<br>";
	//echo "Di akses dari :<br/>";
		echo "Browser = ". $agent . "<br/>";
		echo "Sistem Operasi = " . $this->agent->platform() ."<br/>"; // Platform info (Windows, Linux, Mac, etc.)
		//ip hanya muncul pada hosting
	      $ip=$this->input->ip_address();
	       $agent= $agent.$this->agent->platform();
	       $lokasi=$this->input->post('lokasi',true);
	        $u=$this->input->post('userid',true);
	       $datax['userid']=$u;
	         $datax['agent']=$agent;
	         $datax['ip']=$ip;
	          $datax['lokasi']=$lokasi;
	          $datax['date']=date('Y-m-d H:i:s');
	          
	     //  $this->Akademika_model->save_data('log',$datax);
	       
	       
    }
    function cek_akun()
    {
        $key['userid']=$this->session->userdata('userid');
        $user=$this->Akademika_model->get_row_selected('user',$key);
        if($user->status=='' or $user->email=='')
        {
            redirect('Bismillah/finput_email');
        }
        
    }
    function finput_email2($userid)
    {
        $key['userid']=$userid;
        $user=$this->Akademika_model->get_row_selected('user',$key);
        $data['userid']=$user->userid;
        $data['nama']=$user->nama;
        $data['email']='';
        $this->load->view('template/femail2',$data);
        
    }
    function finput_email()
    {
        $level=$this->session->userdata('level');
        $data['userid']=$this->session->userdata('userid');
        $data['nama']=$this->session->userdata('nama');
        $data['email']='';
        //$user=$this->Akademika_model->get_row_selected('user',$key);
            if($level=='dosen')
            {
                $this->template->load('template/templatedosen','template/femail',$data);
            }elseif($level=='prodi')
            {
                $this->template->load('template/templateprodi','template/femail',$data);
            }elseif($level=='mahasiswa')
            {
                $this->template->load('template/templatemhs','template/femail',$data);
            }elseif($level=='baak')
            {
                $this->template->load('template/templatebak','template/femail',$data);
            }elseif($level=='pddikti')
            {
                $this->template->load('template/templatepddikti','template/femail',$data);
                
            }elseif($level=='adminx')
            {
                  $this->template->load('template/templateadmin','template/femail',$data);
            }
            elseif($level=='wr1')
            {
                  $this->template->load('template/templatewr1','template/femail',$data);
            }
            elseif($level=='dekan')
            {
                  $this->template->load('template/templatedekan','template/femail',$data);
            }
            elseif($level=='admin_pjm')
            {
                  $this->template->load('template/templatepjm','template/femail',$data);
            }
        
    }
    function registrasi_akun()
    {
        $userid=$this->input->post('userid');
        $key['userid']=$userid;
        $email=$this->input->post('email');
        $data['email']=$email;
        $data['status']='registrasi';
         $message = '<h2 align="center">Lakukan verifikasi akun siakad Anda anda dengan cara Klik link berikut: https://siakad.usn.ac.id/bismillah/verifikasi'.'/'.$userid.'</h2>';//ini adalah isi/body email
   
       // $data['tokenreg']=mt_rand(5);
        $hasil = $this->Akademika_model->update_data('user',$data,$key);
        if($hasil)
        {
            $subject="Registrasi Akun";
            $this->kirim_email($email,$message,$subject);
            echo '<h2 align="center"> Cek inbox email: '.$email. ' untuk melakukan verifikasi akun SIAKAD Anda.</h2>';
           
        }else
        {
            redirect('Bismillah/finput_email');
        }
        
    }
   
    public function kirim_email($email,$message,$subject)
	{
    //pengaturan email
    $key['email']=$email;
     $user=$this->Akademika_model->get_row_selected('user',$key);
     $userid=$user->userid;
    $this->load->library('email');//panggil library email codeigniter
    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'muliyadibuton@gmail.com',
        'smtp_pass' => 'Bismillah17031985',
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
    );
    //$email = 'muliyadi_aditia@yahoo.com';//email penerima

    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from($config['smtp_user']);
    $this->email->to($email);
    $this->email->subject($subject);//subjek email
    $this->email->message($message);
    
    //proses kirim email
    if($this->email->send()){
       // $this->session->set_flashdata('message','Sukses kirim email');
        $hasil= 'terkirim';
    }
    else{
        $hasil= $this->email->print_debugger();
    }
    return $hasil;
	}
	
	public function verifikasi($email)
	{
	    $key['email']=$email;
	    $hasil=$this->Akademika_model->get_row_selected('user',$key);
	    if($hasil)
	    {
	        $data['status']='verified';
	        $this->Akademika_model->update_data('user',$data,$key);
	        $this->session->set_flashdata('message','Email akun anda sukses terverifikasi...!');
	    }else
	    {
	        $this->session->set_flashdata('message','Email akun anda gagal terverifikasi...!');
	    }
	    redirect(base_url());
	}
    
    
    public function login() {
        $lokasi='';
        $this->load->helper('security');
//$this->load->model('user_model');
        $u =$this->input->input_stream('userid', TRUE);
        $p =$this->input->input_stream('password', TRUE);
        $ta =$this->input->post('kd_tahun_ajaran', TRUE);
        $data['userid']=$u;
		$data['password']=md5($p.'usn1234');
        $hasil = $this->Akademika_model->get_row_selected('user',$data);
         $session = $this->session->userdata('mycaptcha');
        $input=$this->input->input_stream('captcha', TRUE);
       $cek=$this->check_captcha($session,$input);
       //$this->get_useri();
        if ($hasil && $cek) {
           // $keyta['aktif']='YA';
            //$hasilta=$this->Akademika_model->get_row_selected('thnajaran',$keyta);
            $sess_data['logged_in'] = 'yes';
            $sess_data['userid'] = $u;
            $sess_data['nama'] = $hasil->nama;
            $sess_data['home_base'] = $hasil->home_base;
            
            $sess_data['level']=$hasil->level;
			if($hasil->level=="prodi")
			{
			     $lokasi='prodi';
			    $x['kd_prodi']=$hasil->home_base;
			$hasilprodi = $this->Akademika_model->get_row_selected('prodi',$x);
			$sess_data['departemen']=$hasilprodi->nm_prodi;
			$sess_data['kd_fak']=$hasilprodi->kd_fak;
			}
			elseif($hasil->level=="mahasiswa")
			{
			    $lokasi='mahasiswa';
			     $sess_data['nm_dosen_pa']=$this->get_pa($u);
			}
			elseif($hasil->level=="wr1")
			{
			    $lokasi='wr1';
					$sess_data['departemen']="WR1";
			}
			elseif($hasil->level=="dekan")
			{
					$sess_data['departemen']="Fakultas";
					$lokasi='dekan';
					
			}elseif($hasil->level=="dosen")
			{
			     $lokasi='dosen';
			}
			elseif($hasil->level=="pddikti")
			{
			     $lokasi='pddikti';
			}
			elseif($hasil->level=="bak")
			{
			     $lokasi='bak';
			}elseif($hasil->level=='adminx')
			{
			    $lokasi='admin';
			}
			elseif($hasil->level=='admin_pjm')
			{
			    $lokasi='pjm';
			}
			
            $sess_data['kd_tahun_ajaran']=$ta;
            $this->session->set_userdata($sess_data);
            $this->cek_akun();
             $this->session->set_flashdata('msg', '<div class="alert alert-success">
                  Selamat Datang!
					</div>');
            redirect(base_url($lokasi));

        } else {
             $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                   Informasi...!<br> User ID/Password/Captcha tidak sesuai.
					</div>');
            header('location:' . base_url() );
            //redirect(site_url());
        }
    }

    
    public function logout() {
        $this->session->sess_destroy();
         
        redirect(base_url());
    }

    public function editUser()
    {
        
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());   
        } else {
            $datauser['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$datauser);
            $level = $row->level;
			    $datax['nama']=$row->nama;
			    $datax['passlama']="";
			    
			    $datax['email']=$row->email;
                $datax['passbaru']="";
              
            if($level=="mahasiswa")
            {
 
                $this->template->load('template/templatemhs','template/fupass',$datax);
            }
			elseif($level=="prodi"){$this->template->load('template/templateprodi','template/fupass',$datax);}
			elseif($level=="bak"){$this->template->load('template/templatebak','template/fupass',$datax);}
			elseif($level=="dosen"){$this->template->load('template/templatedosen','template/fupass',$datax);}
			elseif($level=="wr1"){$this->template->load('template/templatewr1','template/fupass',$datax);}
        }
    }

     function get_pa($nim)
    {
      
        $sql="SELECT  `pad`.`nim`, `pah`.`kd_dosen`, `dosen`.`NIDN`, `dosen`.`nm_dosen` FROM
        `pah` INNER JOIN `pad` ON `pad`.`no_pa` = `pah`.`no_pa` INNER JOIN `dosen` ON `dosen`.`kd_dosen` = `pah`.`kd_dosen`
    WHERE `pad`.`nim` = '".$nim."'";
        $output = $this->db->query($sql)->row();
        //
        if($output)
        {
            $x=$output->nm_dosen;
        }else
        {
             $x='';
        }
        return $x;
       // echo json_encode($output);
    }
    


    public function updateUser()
    {
        $level='';
        $pass1=$this->input->post('passbaru',TRUE);
    
        $email=$this->input->post('email',TRUE);
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $datauser['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$datauser);
            $level = $row->level;
            if($row)
            {
                
                $data['email']=$email;
                $data['nama']=$this->input->post('nama',TRUE);
                if($pass1!=''){
                    $data['password']=md5($pass1.'usn1234');
                    $this->Akademika_model->update_data('user',$data,$datauser);
                }else
                {
                    $this->Akademika_model->update_data('user',$data,$datauser);
                }
            }
        }
		 if($level=='prodi')
		 {
		     redirect(base_url('prodi'));
		 }elseif($level=='mahasiswa')
		 {
		     redirect(base_url('mahasiswa'));
		 }elseif($level=='dosen')
		 {
		     redirect(base_url('dosen'));
		 }
}

}
?>
