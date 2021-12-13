<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends CI_Controller
{
    public $view='template/templateadmin';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->library('table');
    }

    public function index()
    {
        $level = $this->session->userdata('level');
		if($level=="adminx"){
			$data['data']='';
            $this->template->load($this->view, 'template/homebak', $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
            }
	}

    function freset_password()
    {
       	$level = $this->session->userdata('level');
		if($level=="adminx"){
		$data['userid']='';
		    $data['password']='';
	       $this->template->load($this->view, 'admin/freset_password', $data);	
		}    
    }
    function ureset_password()
    {
       	$level = $this->session->userdata('level');
		if($level=="adminx"){
			$data['userid']=$this->input->post('userid', TRUE);
			$pass2=$this->input->post('password', TRUE);
			$data['password']=md5($pass2.'usn1234');
			$key['userid']=$this->input->post('userid', TRUE);
			$hasil2=$this->Admin_model->update_data('user',$data,$key);
			if($hasil2)
			{
					$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Password sudah berhasil dirubah...!!!</p>
					</div>');
			}else
			{
			    	$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Gagal  dirubah...!!!</p>
					</div>');
			}
					 redirect(base_url().'/admin/freset_password');
			
			
		}else
		{
		        $this->session->sess_destroy();
		    	redirect(base_url());
		}
    }
    function get_dasboard()
    {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Admin_model->get_row_selected('user',$data);
            $level = $row->level;
            
            if($level=="bak")
                {
                    $templateku='template/templatebak';
                }
            elseif($level=='wr1')
            {
                $templateku='template/templatewr1';
            }
        $datax['listdata']=$this->jumlah_mhs_prodi();
        $datax['listdata2']=$this->jumlah_total_ukt_fak();
        $datax['listdata3']=$this->jumlah_mhs_registrasi_prodi();
        
        
     //   $this->load->view('bak/dkabak',$datax);
        $this->template->load($templateku,'bak/dkabak',$datax);
    }
    }
	function luser()
	{
		$level = $this->session->userdata('level');
		if($level=="adminx"){
			//$key['aktif']='Ya';
			$data['listuser']=$this->Admin_model->get_all('user');
		
	       $this->template->load($this->view, 'admin/listuser', $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
            }
	}
	function fuser()
	{
		$level = $this->session->userdata('level');
		if($level=="adminx"){
			//$key['aktif']='Ya';
			$data['aksi']="Input";
			$data['userid']='';
			$data['nama']='';
			$data['password']='';
			$data['level']='';
			$data['home_base']='';
			$data['aktif']='';
			$data['listlevel']=$this->Admin_model->get_all('mlevel');
			$data['listhomebase']=$this->Admin_model->get_all('thomebase');
	       $this->template->load($this->view, 'admin/fuser', $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
        }
	}
	function auser()
	{
		$level = $this->session->userdata('level');
		if($level=="adminx"){
			//$key['aktif']='Ya';
			$aksi=$this->input->post('aksi', TRUE);
			$data['userid']=$this->input->post('userid', TRUE);
			$data['nama']=$this->input->post('nama', TRUE);
			$pass2=$this->input->post('password', TRUE);
			$data['level']=$this->input->post('level', TRUE);
			$data['aktif']=$this->input->post('aktif', TRUE);
			 $data['password']=md5($pass2.'usn1234');
			if($aksi=="Input")
			{
				$key['userid']=$this->input->post('userid', TRUE);
				$hasil0=$this->Admin_model->get_row_selected('user',$key);
				if(empty($hasil0))
				{
					$hasil2=$this->Admin_model->save_data('user',$data);
					if($hasil2)
					{
					$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Data sudah tersimpan...!!!</p>
					</div>');
					}
					 redirect(base_url().'/admin/fuser');
				}else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Pesan</h4>
                    <p>Data sudah ada...!!!</p>
					</div>');
					 redirect(base_url().'/admin/fuser');
				}
				
				
				
			}
			
			
	       $this->template->load($this->view, 'admin/fuser', $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
        }
	}

	//modul dosen
	function adosen() {

        $level = $this->session->userdata('level');
        if ($level == "adminx") {
            $aksi = $kd_dosens = $this->input->post('aksi', TRUE);
            $kd_dosens = $this->input->post('kd_dosen', TRUE);
            $kd_dosen_lama = $this->input->post('kd_dosen_lama', TRUE);

            $datax['kd_dosen'] = $kd_dosens;
            $datax['nidn'] = $this->input->post('nidn', TRUE);
            $datax['nm_dosen'] = $this->input->post('nm_dosen', TRUE);
            $datax['jns_kelamin'] = $this->input->post('jns_kelamin', TRUE);
            $datax['alamat'] = $this->input->post('alamat', TRUE);
            $datax['tempat'] = $this->input->post('tempat', TRUE);
            $datax['tgl_lahir'] = $this->input->post('tgl_lahir', TRUE);
            $datax['telepon'] = $this->input->post('telepon', TRUE);
            $datax['agama'] = $this->input->post('agama', TRUE);
            $datax['status'] = $this->input->post('status', TRUE);
            $datax['kd_prodi'] = $this->input->post('kd_prodi', TRUE);
            $datax['email'] = $this->input->post('email', TRUE);
            $datau['nama'] = $this->input->post('nm_dosen', TRUE);
			$datau['userid'] = $kd_dosens;
            $datau['password'] = 'e9d2b7b82f36eb6d492f3074ee7dcd5c';
            $datau['level'] = 'dosen';
            $datau['home_base'] = $this->input->post('kd_prodi', TRUE);;
            $datau['aktif'] = 'Ya';
            if ($aksi == "Edit") {
                $id['kd_dosen'] = $kd_dosen_lama;
				$keyfinddosen['kd_dosen']=$kd_dosens;
				$cek=$this->Admin_model->get_row_selected('dosen',$keyfinddosen);
                if(empty($cek))
				{
					$this->Admin_model->update_data('dosen', $datax, $id);
					$key['userid'] = $kd_dosen_lama;
					
					$this->Admin_model->update_data('user', $datau, $key);
					 redirect(base_url() . 'admin/ldosen');
				}else
				{
					echo "tidak bisa, nik sudah ada yang gunakan";
				}
				
               
            } elseif ($aksi == "Insert") {
                $this->Admin_model->save_data('dosen', $datax);
                //save user
                $datau['userid'] = $kd_dosens;
                $this->Admin_model->save_data('user', $datau);

                redirect(base_url() . 'prodi/ldosen');
            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    function edosen($kd_dosen) {
        $cek = $this->session->userdata('userid');
		$level = $this->session->userdata('level');

            if ($level == "adminx") {


                $id['kd_dosen'] = $kd_dosen;
                $row = $this->Admin_model->get_row_selected('dosen', $id);
                if ($row) {
                    $datax['kd_dosen'] = '';
                    $datax['kd_dosen_lama'] = $row->kd_dosen;
                    $datax['nidn'] = $row->NIDN;
                    $datax['nm_dosen'] = $row->nm_dosen;
                    $datax['jns_kelamin'] = $row->jns_kelamin;
                    $datax['alamat'] = $row->alamat;
                    $datax['tempat'] = $row->tempat;
                    $datax['tgl_lahir'] = $row->tgl_lahir;
                    $datax['telepon'] = $row->telepon;
                    $datax['agama'] = $row->agama;
                    $datax['status'] = $row->Status;
                    $datax['kd_prodi'] = $row->kd_prodi;
                    $datax['email'] = $row->email;
                    $datax['aksi'] = "Edit";
					$datax['listagama']=$this->Admin_model->get_all('tagama');
					$datax['listhomebase']=$this->Admin_model->get_all('prodi');
                    $this->template->load($this->view, 'admin/edosen', $datax);
                } else {

                    $this->Admin_model->save_data('dosen', $datax);
                    redirect(base_url() . 'admin/ldosen');
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        
    }

    function ddosen($kd_dosenx) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['kd_dosen'] = $kd_dosenx;
            $id2['userid'] = $kd_dosenx;
            $this->Admin_model->delete_data('dosen', $id);
            $this->Admin_model->delete_data('user', $id2);

            redirect(base_url() . 'prodi/ldosen');
        }
    }

    function fdosen() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Admin_model->get_row_selected('user', $data);
            $level = $row->level;
            $data = array('data' => 'Bismillah', 'hadist' => 'isbal');
            if ($level == "prodi") {
                $datax['aksi'] = 'Insert';
                $datax['kd_dosen'] = '';
                $datax['nidn'] = '';
                $datax['nm_dosen'] = '';
                $datax['jns_kelamin'] = '';
                $datax['alamat'] = '';
                $datax['tempat'] = '';
                $datax['tgl_lahir'] = '';
                $datax['telepon'] = '';
                $datax['agama'] = '';
                $datax['status'] = '';
                $datax['kd_prodi'] = $homebase;
                $datax['email'] = '';
                $this->template->load($this->view, 'prodi/fdosen', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function ldosen() {
		$level=$this->session->userdata('level');
            if ($level == "adminx") {
                $datax['listdosen'] = $this->Admin_model->get_all('dosen');
                $this->template->load($this->view, 'admin/listdosen', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    

    

}

