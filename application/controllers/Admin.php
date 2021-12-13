<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $view='template/templateadmin';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
        $this->load->library('table');
    }

    public function update_status()
    {
        $ldo=$this->Akademika_model->get_all('vdo_mhs');
        foreach($ldo as $do)
        {
            $key['nim']=$do->nim;
            $data['status']='D';
            $this->Akademika_model->update_data('mahasiswa',$data,$key);
            echo json_encode($key);
        }
        //echo json_encode($ldo);
    }
    public function xx()
    {
       // $jadwal=$this->Akademika_model->get_all('vjadwal_kuliah');
        $sql="SELECT jadwal.*,matakuliah.nm_mtk,matakuliah.sks FROM `jadwal`,matakuliah WHERE jadwal.kd_mtk=matakuliah.kd_mtk";
         $jadwal = $this->db->query($sql)->result();
        //echo json_encode($jadwal);
        foreach($jadwal as $xx)
        {
            $data['kd_jadwal']=$xx->kd_jadwal;
            $data['dosen_ke']='1';
            $data['kd_dosen']=$xx->kd_dosen;
             $data['jumlah_sks']=$xx->sks;
           //  echo json_encode($data);
           $key['kd_jadwal']=$xx->kd_jadwal;
           $key['kd_dosen']=$xx->kd_dosen;
           
           $hasil=$this->Akademika_model->get_row_selected('jadwal_dosen',$key);
           if($hasil)
           {
               echo 'sudah ada';
           }else
           {
               $this->Akademika_model->save_data('jadwal_dosen',$data);
           }
            
        }
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
	function list_user_mahasiswa()
	{
	    $key['level']='mahasiswa';
	    $key['home_base']='022';
	    $data['list_user_mahasiswa']=$this->Akademika_model->get_list_selected('user',$key);
	     $this->template->load($this->view, 'admin/list_user_mahasiswa', $data);
	}
	public function tes_absen()
	{
	    $a='';
    	$nim='180120053';
    	
    	echo '<table border=1>
    	<tr>'; 
    	
    	echo '<td>Nama</td>';
    	for ($i = 1; $i <=16; $i++){
    	
    	    echo '<td>'.$i.'</td>';
    	}
    	echo '</tr>';
    	echo '<tr>';
    	
    	echo '<td>'.$nim.'</td>';
    	
	    for ($x = 1; $x <=16; $x++){
	        $key['pertemuan_ke']=$x;
	        $key['kd_jadwal']='JK0017841';
    	    $key['nim']=$nim;
    	    $key['h']=1;
            $data=$this->Akademika_model->get_row_selected('vabsensi',$key);
            if($data)
            {
             echo '<td>H</td>';
            }else
            {
                echo '<td align=center style="background-color: red;">x</td>';
            }
        }
         echo '</tr>';
        echo '</table>';
	}
	//modul jadwal
    function ljadwal()
    {
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $homebase = $this->session->userdata('home_base');
        $kriteria['kd_prodi']=$homebase;
        $kriteria['kd_tahun_ajaran']=$kd_tahun_ajaran;

        if ($level == "bak" or $level=="adminx") {
            $data['lstatus'] = $this->Akademika_model->get_all('mstatus_jadwal');
             $data['data'] = $this->get_all_jadwal($kd_tahun_ajaran);

            $this->template->load($this->view, 'admin/all_jadwal', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    function tutup_jadwal($kd_jadwal)
    {
       $key['kd_jadwal']=$kd_jadwal;
       
         $hdata['status']='Tertutup';
        $this->Akademika_model->update_data('jadwal',$hdata,$key);
        redirect(base_url() . 'admin/ljadwal');
        
    }
     function buka_jadwal()
    {
        $sms = 0;
      
       
         $hdata['status']=$this->input->post('status', true);
         $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);
               
              
        $hasil=$this->Akademika_model->update_data('jadwal',$hdata,$key);
        if($hasil)
        {
            $sms=1;
        }
        echo $sms;
    }
     private function get_all_jadwal($kd_ta) {
        $sql = "SELECT prodi.nm_prodi,
  `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_mtk`,jadwal.status, `jadwal`.`kd_dosen`, `dosen`.`nm_dosen`, `dosen`.`NIDN`,
  `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `jadwal`.`kelas`, `jadwal`.`hari`,
  `jadwal`.`jam`, `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`,kutota_jadwal.jumlah as terisi,
  `jadwal`.`kd_prodi`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`
FROM
  `jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN
  `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen` left JOIN kutota_jadwal ON kutota_jadwal.kd_jadwal=jadwal.kd_jadwal inner join prodi on jadwal.kd_prodi=prodi.kd_prodi
WHERE
  `jadwal`.`kd_tahun_ajaran` = '" . $kd_ta . "' order by nm_dosen asc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        //echo json_encode($hasil);
    }
	public function list_tabel()
	{
	   $tables = $this->db->list_tables();

       echo json_encode($tables);
	}
	public function register()
	{
    //pengaturan email
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
    $message = "Hello World, this is test email by codeigniter";//ini adalah isi/body email
    $email = 'muliyadi_aditia@yahoo.com';//email penerima

    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from($config['smtp_user']);
    $this->email->to($email);
    $this->email->subject('Email verifikasi');//subjek email
    $this->email->message($message);
    
    //proses kirim email
    if($this->email->send()){
        $this->session->set_flashdata('message','Sukses kirim email');
        echo 'berhasil';
    }
    else{
        echo $this->email->print_debugger();
    }
	}
	public function kirim()
    {

       
         $from_email = "muliyadibuton@gmail.com"; 
         $to_email ='muliyadi@usn.ac.id';
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
          echo $this->email->print_debugger();
         //$this->load->view('email_form'); 
      
        
    }
    
    //fungsi rekap status akademik
    public function rekap_status_akademik()
    {
        $sql2="SELECT * from daftar_judul";
         $hasil2 = $this->db->query($sql2)->result(); 
        foreach($hasil2 as $row2)
        {
            $key2['nim']=$row2->nim;
           
                $udatajudul['status_akademik']='judul';
                
            
            
            
            $this->Akademika_model->update_data('mahasiswa', $udatajudul,$key2);
            
        }
        
        
        $sql="SELECT * from daftar where lulus='Y' order by urutan asc";
         $hasil = $this->db->query($sql)->result(); 
        foreach($hasil as $row)
        {
            $key['nim']=$row->nim;
            $jns_ujian=$row->urutan;
            if($jns_ujian=='0'){
                $udata['status_akademik']='proposal';
                
            }elseif($jns_ujian=='1')
            {
                 $udata['status_akademik']='hasil';
            }elseif($jns_ujian=='2')
            {
                 $udata['status_akademik']='skripsi';
            }
            
            
            $this->Akademika_model->update_data('mahasiswa', $udata,$key);
            
        }
    }
    //modul tutup kegiatan akademik
    function tutup_input_nilai()
    {
        
    }
    //fungnsi singkron ke keuangan
    function fsinkron_pembayaran()
    {
        
        $this->template->load($this->view,'admin/fsinkron_keuangan');
    }
    public function sinkron_ukt()
    {
        
        //$ta=$this->input->post('ta',true);
        $url="http://sidu.usn.ac.id/web/ukt_siakad.php";
        $result=file_get_contents($url);
        $hasil=json_decode($result);
       //echo $hasil;
     
       foreach ($hasil as $row)
       {
           $keymhs['nim'] =$row->nim_mhs;
           $datas['nilai_ukt']=$row->ukt_mhs;
            $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
            echo $row->nim_mhs.'-'.$row->ukt_mhs.'-'.$row->nam_mhs.'- Update';
            echo "<br>";
       }
    }
    public function sinkron_pembayaran()
    {
        
        $ta=$this->input->post('ta',true);
        $url="http://sidu.usn.ac.id/web/sidu_siakad.php?ta=$ta";
        $result=file_get_contents($url);
        $hasil=json_decode($result);
       echo json_encode($hasil);
     
       foreach ($hasil as $row)
       {
           $keymhs['nim'] =$row->nim_mhs;
           $rowmhs = $this->Akademika_model->get_row_selected('mahasiswa', $keymhs);
                     if(empty($rowmhs))
                     {
                         echo 'Mahasiswa dengan NIM :'.$row->nim_mhs.' tidak ada dalam SIAKAD USN KOLAKA';
                         echo "<br>";
                     }else
                     {
                    $nim= $row->nim_mhs;
                    $kd_tahun_ajaran=$row->kode_ta;
                    $jns=$row->kode_jns;
                     $home_base=$rowmhs->kd_prodi;
                    $dupreg = $this->cek_registrasi($kd_tahun_ajaran, $nim,$jns);
                    if (empty($dupreg)) {
                    $datax['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                    $datax['no_reg_bank'] = $row->nomr_byr;
                    $datax['noreg'] = $this->createNoReg($kd_tahun_ajaran,$home_base);
                    $datax['tgl_reg_bak'] = date('Y-m-d');
                    $datax['nim'] = $nim;
                    $datax['tgl_reg_bank'] = $row->tgl_byr;
                    $datax['home_base'] = $home_base;
                    $datax['jns_registrasi'] =$row->kode_jns;
                    if($row->kode_jns=='P16')
                    {
                         $datas['status']='C';
                          $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
                    }
                   elseif($row->kode_jns=='P03')
                   {
                        $datas['status']='A';
                         $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
                   } elseif($row->kode_jns=='P10')
                   {
                       $datas['status']='L';
                        $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
                   }
                    $keymhs['nim']=$nim;
                        $this->Akademika_model->save_data('registrasi', $datax);
                        
                         echo 'berhasil:'.$ta.$row->nim_mhs;
                         echo "<br>";
                     }
                    			//redirect(base_url() . 'Prodi/fcuti');
                } 
           
       }
        
    }
    //prodi
    function lprodi()
    {
        
        $prodi['prodi'] = $this->Akademika_model->get_all('prodi');
        $this->template->load($this->view,'bak/listprodi',$prodi);
    }
     private function createNoReg($kd_ta,$kd_prodi) {

       
        $q = $this->db->query("select MAX(RIGHT(noreg,4)) as kd_max from registrasi where kd_tahun_ajaran='".$kd_ta."' and home_base='".$kd_prodi."' ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'REG' .substr($kd_ta,2). $kd_prodi. $kd;
    }
    
        function cek_registrasi($kd_tahun_ajaran, $nim,$jns) {
        $key['kd_tahun_ajaran'] = $kd_tahun_ajaran;
        $key['nim'] = $nim;
         $key['jns_registrasi'] = $jns;
        $hasil = $this->Akademika_model->get_row_selected('registrasi', $key);
        return $hasil;
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
    
    function luser_dosen()
    {
        $key['level']='dosen';
        $datax['label']='Dosen';
        $datax['listuser'] = $this->Admin_model->get_list_selected('user',$key);
        $this->template->load($this->view, 'admin/luser_dosen', $datax);
    }
    function luser_prodi()
    {
        $key['level']='prodi';
        $datax['label']='Prodi';
        $datax['listuser'] = $this->Admin_model->get_list_selected('user',$key);
        $this->template->load($this->view, 'admin/luser_dosen', $datax);
    }
    function aktif_user_dosen($id)
    {
        $cek = $this->session->userdata('userid');
       // $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid']=$cek;
            $row = $this->Admin_model->get_row_selected('user',$data);
            $level = $row->level;
            
            if($level=="adminx")
                {
                    $key['userid']=$id;
                    $datax['aktif']='Ya';
                    $this->Admin_model->update_data('user',$datax,$key);
                	$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Akun sudah aktif kembali...!!!</p>
					</div>');
                     redirect(base_url().'admin/luser_dosen');
                }
        }
    }
    function non_aktif_user_dosen($id)
    {
        $cek = $this->session->userdata('userid');
       // $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid']=$cek;
            $row = $this->Admin_model->get_row_selected('user',$data);
            $level = $row->level;
            
            if($level=="adminx")
                {
                    $key['userid']=$id;
                    $datax['aktif']='Tidak';
                    $this->Admin_model->update_data('user',$datax,$key);
                	$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Akun sudah aktif kembali...!!!</p>
					</div>');
                     redirect(base_url().'admin/luser_dosen');
                }
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
    
    public function backup_nilai_mhs($kd_tahun_ajaran)
    {
       
        $sql="SELECT rencanastudid.no_krs,rencanastudid.kd_mtk,rencanastudid.nilai,rencanastudih.kd_tahun_ajaran FROM rencanastudid,rencanastudih WHERE rencanastudih.no_krs=rencanastudid.no_krs and rencanastudih.kd_tahun_ajaran='".$kd_tahun_ajaran."'";
         $hasil = $this->db->query($sql)->result(); 
        foreach($hasil as $row)
        {
            $keynilai['no_krs']=$row->no_krs;
            $keynilai['kd_mtk']=$row->kd_mtk;
            $hasil=$this->Akademika_model->get_row_selected('nilai_mtk_mhs',$keynilai);
            if(empty($hasil))
            {
                $data['no_krs']=$row->no_krs;
                $data['kd_mtk']=$row->kd_mtk;
                $data['nilai_a']=$row->nilai;
                $data['tgl_update']= date('Y-m-d');
               $this->Akademika_model->save_data('nilai_mtk_mhs',$data);
            }else
            {
                $udata['nilai_a']=$row->nilai;
                $udata['tgl_update']= date('Y-m-d');
               $this->Akademika_model->update_data('nilai_mtk_mhs',$udata,$keynilai);
            }
            
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
		$data['label']='Semua';
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
	function euser($userid,$level)
	{
	    $key['userid']=$userid;
	    
	    $row=$this->Admin_model->get_row_selected('user',$key);
	    $data['userid']=$userid;
	    $data['aksi']="Edit";
			$data['nama']=$row->nama;
			$data['password']='';
			$data['level']=$row->level;
			$data['home_base']=$row->home_base;
			$data['aktif']=$row->aktif;
			$data['listlevel']=$this->Admin_model->get_all('mlevel');
			$data['listhomebase']=$this->Admin_model->get_all('thomebase');
	    $this->template->load($this->view, 'admin/euser', $data);
	}
	function auser()
	{
		$level = $this->session->userdata('level');
		$datalevel=$this->input->post('level', TRUE);
		if($level=="adminx"){
			//$key['aktif']='Ya';
			$aksi=$this->input->post('aksi', TRUE);
			$data['userid']=$this->input->post('userid', TRUE);
			$data['nama']=$this->input->post('nama', TRUE);
			$pass2=$this->input->post('password', TRUE);
			$data['level']=$this->input->post('level', TRUE);
			$data['aktif']=$this->input->post('aktif', TRUE);
			$data['home_base']=$this->input->post('home_base', TRUE);
			
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
				
				}else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Pesan</h4>
                    <p>Data sudah ada...!!!</p>
					</div>');
					 redirect(base_url().'/admin/fuser');
				}
				
				
				
			}
			else
			{
			    $keydata['userid']=$this->input->post('userid', TRUE);
			    
			    	$datax['userid']=$this->input->post('userid', TRUE);
			$datax['nama']=$this->input->post('nama', TRUE);
		
			$datax['level']=$this->input->post('level', TRUE);
			$datax['aktif']=$this->input->post('aktif', TRUE);
			$datax['home_base']=$this->input->post('home_base', TRUE);
			    	$hasil2=$this->Admin_model->update_data('user',$datax,$keydata);
			}
			if($datalevel=='prodi')
			{
			  redirect(base_url().'/admin/luser_prodi');   
			}elseif($datalevel=='dosen')
			{
			    redirect(base_url().'/admin/luser_dosen');   
			    
			}
			
	      
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
        }
	}

	//modul dosen
	function duser($userid,$level) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $id2['userid'] = $userid;
           
            $this->Admin_model->delete_data('user', $id2);
            	$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Akun sudah dihapus dari sistem...!!!</p>
					</div>');
				if($level=='dosen')
				{
				    redirect(base_url() . 'admin/luser_dosen');
				}elseif($level=='prodi')
				{
				     redirect(base_url() . 'admin/luser_prodi');
				}
            
        }
    }
	function adosen() {

        $level = $this->session->userdata('level');
        if ($level == "adminx") {
            $aksi = $kd_dosens = $this->input->post('aksi', TRUE);
            $kd_dosens = $this->input->post('kd_dosen', TRUE);
            $kd_dosen_lama = $this->input->post('kd_dosen_lama', TRUE);
            
            
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
		
            $datau['password'] = 'e9d2b7b82f36eb6d492f3074ee7dcd5c';
            $datau['level'] = 'dosen';
            $datau['home_base'] = $this->input->post('kd_prodi', TRUE);;
            $datau['aktif'] = 'Ya';
            if ($aksi == "Edit") {
               	$keyfinddosen['kd_dosen']=$kd_dosens;
				
				if($kd_dosens=='')
				{
				    $id['kd_dosen'] = $kd_dosen_lama;
				    $this->Admin_model->update_data('dosen', $datax, $id);
				    redirect(base_url() . 'admin/ldosen');
				}
				$cek=$this->Admin_model->get_row_selected('dosen',$keyfinddosen);
				
                if(($cek))
				{ 
				    $key['userid'] = $kd_dosen_lama;
					$id['kd_dosen'] = $kd_dosen_lama;
			        $this->Admin_model->update_data('dosen', $datax, $id);
					$this->Admin_model->update_data('user', $datau, $key);
					 redirect(base_url() . 'admin/ldosen');
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

            redirect(base_url() . 'admin/ldosen');
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

