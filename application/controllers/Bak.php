<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bak extends CI_Controller
{
    public $view='template/templatebak';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
        $this->load->library('table');
    }

    public function index()
    {
       // $dosen = $this->Dosen_model->get_all();
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            if($level=="bak")
            {
               $this->template->load($this->view, 'template/homebak', $data);
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    function rekap_sks_lulus()
    {
    $list=array();
    $list2=array();
    $angkatan='2018';
    $key['angkatan']=$angkatan;
    $list_mhs=$this->Akademika_model->get_list_selected('mahasiswa',$key);
    foreach($list_mhs as $row)
    {
        $data['nim']=$row->nim;
        $data['nm_mahasiswa']=$row->nm_mahasiswa;
        $data['angkatan']=$row->angkatan;
        $data['kd_prodi']=$row->kd_prodi;
        
        $keypro['kd_prodi']=$row->kd_prodi;
        $prodi=$this->Akademika_model->get_row_selected('prodi',$keypro);
        $data['nm_prodi']=$prodi->nm_prodi;
       
        $tot_sks_lulus=$this->Akademika_model->get_tot_sks_lulus($row->nim);
         $data['total_sks_lulus']=$tot_sks_lulus;
        //$data2=$row->nim.','.$row->nm_mahasiswa.','.$row->angkatan.','.$tot_sks_lulus;
       // array_push($list2,$data2);
        
        array_push($list,$data);
    }
    echo json_encode($list);
    }
    function rekap_sks()
    {
    $list=array();
    $list2=array();
    $angkatan='2018';
    $key['angkatan']=$angkatan;
    $list_mhs=$this->Akademika_model->get_list_selected('mahasiswa',$key);
    foreach($list_mhs as $row)
    {
        $data['nim']=$row->nim;
        $data['nm_mahasiswa']=$row->nm_mahasiswa;
        $data['angkatan']=$row->angkatan;
        $data['kd_prodi']=$row->kd_prodi;
        
        $keypro['kd_prodi']=$row->kd_prodi;
        $prodi=$this->Akademika_model->get_row_selected('prodi',$keypro);
        $data['nm_prodi']=$prodi->nm_prodi;
       
        $tot_sks_lulus=$this->Akademika_model->get_tot_sks($row->nim);
         $data['total_sks_lulus']=$tot_sks_lulus;
        //$data2=$row->nim.','.$row->nm_mahasiswa.','.$row->angkatan.','.$tot_sks_lulus;
       // array_push($list2,$data2);
        
        array_push($list,$data);
    }
        echo json_encode($list);
    }
    public function backup() {
	    
	    $this->load->dbutil();
		$this->load->helper('file');
		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'dbakademik.sql'
		);
		
		$backup = $this->dbutil->backup($config);
        $nama_database = 'database_smu1masteng_backup_on_'. date("Y-m-d-H-i-s") .'.zip';
        $simpan = 'backup/'.$nama_database;
        $this->load->helper('file');
        $hasil= write_file($simpan, $backup);
       
	}
    function fsinkron_mahasiswa()
    {
         $data['list']=$this->Akademika_model->get_all('angkatan');
        $this->template->load($this->view,'bak/fsinkron_mahasiswa',$data);
    }
    function sinkron_mahasiswa()
    {
        $ta=$this->input->post('ta',true);
        $url="https://sidu.usn.ac.id/web/sidu_mahasiswa_siakad.php?ta=$ta";
        $result=file_get_contents($url);
        $hasil=json_decode($result);
       //echo $hasil;
       foreach ($hasil as $row)
       {
           $keyprodi['kd_sidu'] =$row->kode_prodi;
           $rowprodi = $this->Akademika_model->get_row_selected('prodi', $keyprodi);
           $data['nim']=$row->nim_mhs;
           $data['nm_mahasiswa']=$row->nam_mhs;
           $data['angkatan']=$row->ang_mhs;
           $data['awal_semester']=$row->ang_mhs.'1';
           $data['status']='A';
           $data['nilai_ukt']=$row->ukt_mhs;
           
           $data['kd_prodi']=$rowprodi->kd_prodi;
           $keymhs['nim']=$row->nim_mhs;
           $cek=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
           if($cek)
           {
                $this->Akademika_model->update_data('mahasiswa', $data,$keymhs);
                $datax['nama']=$row->nam_mhs;
                $datax['level']='mahasiswa';
                $datax['home_base']=$rowprodi->kd_prodi;
                $datax['aktif']='Ya';
                $datax['userid']=$row->nim_mhs;
                $datax['password']=md5('merdeka'.'usn1234');
                $keyuser['userid']=$row->nim_mhs;
                $this->Akademika_model->update_data('user',$datax,$keyuser);
                //$this->Akademika_model->save_data('user',$datax);
                  echo 'Mahasiswa dengan NIM:'.$row->nim_mhs.' NAMA:'.$row->nam_mhs.'Sudah diperbaharui <br>';
           }else
           {
                $datax['nama']=$row->nam_mhs;
                $datax['level']='mahasiswa';
                $datax['home_base']=$rowprodi->kd_prodi;
                $datax['aktif']='Ya';
                 $datax['userid']=$row->nim_mhs;
                $datax['password']=md5('merdeka'.'usn1234');
                $this->Akademika_model->save_data('mahasiswa', $data);
                $this->Akademika_model->save_data('user',$datax);
                  echo 'Mahasiswa dengan NIM:'.$row->nim_mhs.' NAMA:'.$row->nam_mhs.'Sudah tersimpan <br>';
           }
       }
    }

     function fpilihta_ukt()
    {
        $data['listta']=$this->Akademika_model->get_all_desc('thnajaran','kd_tahun_ajaran');
       
        $this->template->load($this->view,'bak/ukt/fpilihta_ukt',$data);
    }
    function fsinkron_pembayaran()
    {
        $data['list']=$this->Akademika_model->get_all_desc('thnajaran','kd_tahun_ajaran');
       
        $this->template->load($this->view,'bak/ukt/fsinkron_keuangan',$data);
    }
    
    public function sinkron_pembayaran()
    {
        
        $ta=$this->input->post('ta',true);
        $homebase = $this->session->userdata('home_base');
        $url="https://sidu.usn.ac.id/web/sidu_siakad.php?ta=$ta";
        $result=file_get_contents($url);
        $hasil=json_decode($result);
       //echo $hasil;
     
       foreach ($hasil as $row)
       {
           $keymhs['nim'] =$row->nim_mhs;
           $rowmhs = $this->Akademika_model->get_row_selected('mahasiswa', $keymhs);
                     if(empty($rowmhs))
                     {
                          $data= 'Mahasiswa dengan NIM :'.$row->nim_mhs.' tidak ada dalam SIAKAD USN KOLAKA';
                         $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Pesan</h4>
                    <p>'.$data.'</p>
					</div>');
                     }else
                     {
                    $nim= $row->nim_mhs;
                    $kd_tahun_ajaran=$row->kode_ta;
                    $jns=$row->kode_jns;
                     $home_base=$rowmhs->kd_prodi;
                    $dupreg = $this->cek_registrasi($kd_tahun_ajaran, $nim,$jns);
                    //echo $dupreg;
                    if ($dupreg)
                    {
                        $keyupdate['nim']=$nim;
                        $keyupdate['kd_tahun_ajaran']=$kd_tahun_ajaran;
                         $datau['no_reg_bank']=$row->nomr_byr;
                          $datau['jns_registrasi'] =$jns;
                          $datau['bank'] = $row->nama_bank;
                          $this->Akademika_model->update_data('registrasi', $datau,$keyupdate);
                         
                    }else
                    {
                        $datax['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                        $datax['no_reg_bank'] = $row->nomr_byr;
                        $datax['noreg'] = $this->createNoReg($kd_tahun_ajaran,$home_base);
                        $datax['tgl_reg_bak'] = date('Y-m-d');
                        $datax['nim'] = $nim;
                        $datax['tgl_reg_bank'] = $row->tgl_byr;
                        $datax['home_base'] = $home_base;
                        $datax['bank'] = $row->nama_bank;
                        $datax['jns_registrasi'] =$jns;
                        if($row->kode_jns=='P16')
                        {
                             $datas['status']='C';
                              $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
                        }
                       elseif($row->kode_jns=='P03')
                       {
                            $datas['status']='A';
                             $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
                            // echo 'berhasil';
                       } elseif($row->kode_jns=='P10')
                       {
                           $datas['status']='L';
                            $this->Akademika_model->update_data('mahasiswa', $datas,$keymhs);
                       }
                        $keymhs['nim']=$nim;
                            $this->Akademika_model->save_data('registrasi', $datax);
                       
                    }
                    			//redirect(base_url() . 'Prodi/fcuti');
                } 
           
       }
      $this->lreg2($ta);
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
    function fmahasiswa()
    {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
		$level = $this->session->userdata('level');
            if ($level == "bak") {
                $key['nim'] = '';
               $mhs= $this->Akademika_model->get_row_selected('mahasiswa', $key);
                 $data['nim'] = '';
                $data['nm_mahasiswa'] = '';
                $data['tempat_lahir'] = '';
                $data['tgl_lahir'] = '';
                $data['agama'] = '';
                $data['jalan'] = '';
                $data['kelurahan'] = '';
                $data['kd_jenis_tinggal'] = '';
                $data['no_hp'] = '';
                $data['email'] ='';
                $data['telp_rumah'] ='';
                 $data['jns_pembiayaan'] = '';
                $data['terima_kps'] = '';
                $data['no_kps'] = '';
                $data['jns_kelamin'] = '';
                $data['jalur_masuk'] = '';
                $data['npsn'] = '';
                $data['nisn'] = '';
                 $data['NIK'] = '';
                $data['thn_tamat_sma'] ='';
                $data['jurusan_sma'] = '';
                $data['no_kk'] = '';
                $data['nm_ayah'] = '';
                $data['id_wilayah_kec'] = '';
                $data['nm_wilayah_kec'] = '';
                  $data['dusun'] = '';
                $data['rw'] = '';
                $data['rt'] = '';
                $data['pend_ayah'] = '';
                $data['penghasilan_ayah'] = '';
                $data['nm_ibu'] = '';
                $data['tgl_lahir_ayah'] = '';
                $data['tgl_lahir_ibu'] = '';
                $data['pend_ibu'] = '';
                $data['penghasilan_ibu'] = '';
                $data['semester'] = '';
                $data['terima_kps'] = 0;
                $data['angkatan'] = '';
                 $data['nilai_ukt'] = '';
                 $data['status'] = '';
				$key2['aktif'] ='Ya';
                $data['listjalur'] = $this->Akademika_model->get_list_selected('mtjalur_masuk', $key2);
				$data['listpengortu']=$this->Akademika_model->get_all('mgolongan_penghasilan');
                $data['listagama']=$this->Akademika_model->get_all('tagama');
                 $data['listprodi']=$this->Akademika_model->get_all('prodi');
                $data['listjenjang_pendidikan']=$this->Akademika_model->get_all('mjenjang_pendidikan');
                $data['listjenis_tinggal']=$this->Akademika_model->get_all('mjenis_tinggal');
                $data['listpropinsi']=$this->Akademika_model->get_all('propinsi');
                $data['listkabupaten']=$this->Akademika_model->get_all('kabupaten');
                $data['listkecamatan']=$this->Akademika_model->get_all('kecamatan');
                //$keysekolah['npsn']=$mhs->npsn;
                $data['sekolah']=$this->Akademika_model->get_all('sekolah');
                //$data['listkecamatan']=$this->Akademika_model->get_list_selected('kecamatan',$keykec);
                $data['listjns_pembiayaan']=$this->Akademika_model->get_all('mjenis_pembiayaan');
                $data['listnegara']=$this->Akademika_model->get_all('negara');
				$this->template->load($this->view, 'bak/fmahasiswa', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
    }
     function amahasiswa() {
        $cek = $this->session->userdata('userid');
        //$kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
//$st=$this->session->userdata('userid');
            $key['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $key);
            $level = $row->level;
            if ($level == "bak") {
                $data['nim'] = $this->input->post('nim', TRUE);
                $data['nm_mahasiswa'] = $this->input->post('nm_mahasiswa', TRUE);
                $data['tempat_lahir'] = $this->input->post('tempat_lahir', TRUE);
                $data['tgl_lahir'] = $this->input->post('tgl_lahir', TRUE);
                $data['agama'] = $this->input->post('agama', TRUE);
                $data['jalan'] = $this->input->post('jalan', TRUE);
                $data['kelurahan'] = $this->input->post('kelurahan', TRUE);
                $data['kd_jenis_tinggal'] = $this->input->post('kd_jenis_tinggal', TRUE);
                $data['no_hp'] = $this->input->post('no_hp', TRUE);
                $data['email'] = $this->input->post('email', TRUE);
                $data['jns_pembiayaan'] = $this->input->post('jns_pembiayaan', TRUE);
                $data['terima_kps'] = $this->input->post('terima_kps', TRUE);
                $data['no_kps'] = $this->input->post('no_kps', TRUE);
                $data['jns_kelamin'] = $this->input->post('jns_kelamin', TRUE);
                $data['jalur_masuk'] = $this->input->post('jalur_masuk', TRUE);
                $data['npsn'] = $this->input->post('npsnx', TRUE);
                $data['nisn'] = $this->input->post('nisn', TRUE);
                $data['NIK'] = $this->input->post('nik', TRUE);
                $data['thn_tamat_sma'] = $this->input->post('thn_tamat_sma', TRUE);
                $data['jurusan_sma'] = $this->input->post('jurusan_sma', TRUE);
                $data['no_kk'] = $this->input->post('no_kk', TRUE);
                $data['nm_ayah'] = $this->input->post('nm_ayah', TRUE);
                $data['id_wilayah_kec'] = $this->input->post('id_wilayah_kec', TRUE);
                $data['dusun'] = $this->input->post('dusun', TRUE);
                $data['rw'] = $this->input->post('rw', TRUE);
                $data['rt'] = $this->input->post('rt', TRUE);
                $data['pend_ayah'] = $this->input->post('pend_ayah', TRUE);
                $data['penghasilan_ayah'] = $this->input->post('penghasilan_ayah', TRUE);
                $data['nm_ibu'] = $this->input->post('nm_ibu', TRUE);
                $data['tgl_lahir_ayah'] = $this->input->post('tgl_lahir_ayah', TRUE);
                $data['tgl_lahir_ibu'] = $this->input->post('tgl_lahir_ibu', TRUE);
                $data['pend_ibu'] = $this->input->post('pend_ibu', TRUE);
                $data['penghasilan_ibu'] = $this->input->post('penghasilan_ibu', TRUE);
                $data['semester'] = $this->input->post('semester', TRUE);
                $data['angkatan'] = $this->input->post('angkatan', TRUE);
                $data['terima_kps'] = 0;
                $data['awal_semester']=$this->input->post('angkatan', TRUE)+1;
                 $data['kd_prodi']=$this->input->post('kd_prodi', TRUE);
                $this->Akademika_model->save_data('mahasiswa', $data);
                //$keyuser['userid']=$cek;
                $datauser['email']=$this->input->post('email', TRUE);
                $datauser['userid']=$this->input->post('nim', TRUE);
                $datauser['nama']=$this->input->post('nm_mahasiswa', TRUE);
                $datauser['password']='e9d2b7b82f36eb6d492f3074ee7dcd5c';
                $datauser['level']='mahasiswa';
                $datauser['home_base']=$this->input->post('kd_prodi', TRUE);
                $datauser['aktif']='Ya';
                $this->Akademika_model->save_data('user', $datauser);
				
 
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
 redirect(base_url().'bak/fmahasiswa');
    }
    //modul mahasiswa
    function flist_mahasiswa_angkatan()
    {
        
          $data['listangkatan'] = $this->Akademika_model->get_all('angkatan');
        $data['listprodi']=$this->Akademika_model->get_all('prodi');
        $this->template->load($this->view,'bak/flist_mahasiswa_prodi',$data);
    }
    function list_mahasiswa_angkatan()
    {
        $angkatan=$this->input->post('angkatan');

        $data['list']=$this->get_list_mhs_prodi($angkatan);
        $this->template->load($this->view,'bak/list_mahasiswa_prodi',$data);
    }
    function get_list_mhs_prodi($angkatan)
    {
        $sql="select nim,nm_mahasiswa,angkatan,mahasiswa.kd_prodi,nm_prodi,nilai_ukt,status,NIK from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi and angkatan='".$angkatan."' order by mahasiswa.kd_prodi, mahasiswa.nim asc";
        $hasil = $this->db->query($sql)->result();
      // echo json_encode($hasil);
        return ($hasil);
    }
   //modul beasiswa
   function fbeasiswa()
   {
       $data['ta']=$this->Akademika_model->get_all('thnajaran');
       $data['lbs']=$this->Akademika_model->get_all('jenis_beasiswa');
       $this->template->load($this->view,'bak/fbeasiswa',$data);
   }
   public function lbeasiswa()
   {
       //$kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
       $jns_beasiswa=$this->input->post('jns_beasiswa');
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran');
       //$jns_beasiswa='bidikmisi';
      
       $list=$this->get_list_mhs_beasiswa($jns_beasiswa,$kd_tahun_ajaran);
        $data['list']=$list;
        $listmhs=$this->Akademika_model->get_all('mahasiswa');
        foreach($listmhs as $mhs)
        {
            foreach($list as $row)
            {
                
                if($mhs->nim==$row->nim)
                {
                    $data['beasiswa']=$row->jenis_beasiswa;
                    $key['nim']=$row->nim;
                    $this->Akademika_model->update_data('mahasiswa',$data,$key);
                }
            
            }    
        }
        
        $data['jns_beasiswa']=strtoupper($jns_beasiswa);
       $this->template->load($this->view,'bak/list_penerima_beasiswa',$data);
       
   }

     function get_list_mhs_beasiswa($jns_beasiswa,$kd_tahun_ajaran)
    {
        
        $sql="select beasiswa.nim,nm_mahasiswa,angkatan,mahasiswa.kd_prodi,nm_prodi,nilai_ukt,jenis_beasiswa from mahasiswa,beasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi and beasiswa.nim=mahasiswa.nim and jenis_beasiswa='".$jns_beasiswa."' and kd_tahun_ajaran='".$kd_tahun_ajaran."' order by mahasiswa.kd_prodi,beasiswa.nim asc";
        $hasil = $this->db->query($sql)->result();
      // echo json_encode($hasil);
        return ($hasil);
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
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            
            if($level=="bak")
                {
                    $templateku='template/templatebak';
                }
            elseif($level=='wr1')
            {
                $templateku='template/templatewr1';
            }
        //$datax['listdata']=$this->jumlah_mhs_prodi();
       // $datax['listdata2']=$this->jumlah_total_ukt_fak();
        $datax['listdata3']=$this->jumlah_mhs_registrasi_prodi($kd_tahun_ajaran);
        
        
     //   $this->load->view('bak/dkabak',$datax);
        $this->template->load($templateku,'bak/dkabak',$datax);
    }
    }
    
    
     public function rekap_nilai()
    {
       $data['listta'] = $this->Akademika_model->get_all('thnajaran');
       $data['listprodi'] = $this->Akademika_model->get_all('prodi');
       
       $data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
       $this->template->load($this->view, 'bak/lap_rekap_akademik_form', $data);
    }
    public function get_rekap_akademik_mhs()
    {
        $kd_prodi=$this->input->post('kd_prodi',TRUE);
        $angkatan=$this->input->post('angkatan',TRUE);
        $angkatan2=$this->input->post('angkatan2',TRUE);
        
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $list=array();
        $sql = "select nm_prodi,mahasiswa.nim as nim,nm_mahasiswa,angkatan,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,nilai_ukt,semester,mahasiswa.status from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi and mahasiswa.kd_prodi='" . $kd_prodi . "' and angkatan>='".$angkatan."' and angkatan <='".$angkatan2."' order by angkatan asc";
        $listmhs= $this->db->query($sql)->result();
        foreach($listmhs as $mhs)
        {
            $rec_ipk=$this->Akademika_model->get_ipk($mhs->nim,$kd_tahun_ajaran);
            $rec_jum_sks=$this->Akademika_model->get_jum_sks_mhs($mhs->nim,$kd_tahun_ajaran);
            $rec_ips=$this->Akademika_model->get_ips($mhs->nim,$kd_tahun_ajaran);
            
            $data['nim']=$mhs->nim;
            $data['nm_mahasiswa']=$mhs->nm_mahasiswa;
            $data['angkatan']=$mhs->angkatan;
             $data['nm_prodi']=$mhs->nm_prodi;
              $data['ukt']=$mhs->nilai_ukt;
            $data['ipk']=$rec_ipk;
            $data['jum_sks']=$rec_jum_sks;
            $data['ips']=$rec_ips;
            array_push($list,$data);
           // echo $rec_ipk; 
            
        }
            $keyprodi['kd_prodi'] = $kd_prodi;
            $prodi = $this->Akademika_model->get_row_selected('prodi', $keyprodi);
           
            $keyfak['kd_fak'] = $prodi->kd_fak;
            $fak = $this->Akademika_model->get_row_selected('fakultas', $keyfak);
            $data['nm_fak'] = $fak->nm_fak;
            $data['prodi']=$prodi;
            $data['ta']=$kd_tahun_ajaran;
            
        $data['list']=$list;
        //echo json_encode($data);
        $this->load->view('bak/lap_rekap_akademik', $data);
    }
    function lfakultas()
    {
        
        $data['listfakultas'] = $this->Akademika_model->get_all('fakultas');
        $this->template->load($this->view,'bak/listfakultas',$data);
    }
    function lprodi()
    {
        
        $prodi['prodi'] = $this->Akademika_model->get_all('prodi');
        $this->template->load($this->view,'bak/listprodi',$prodi);
    }
    
    function fprodi()
    {
        $prodi['kd_prodi'] = '';
        $prodi['nm_prodi'] = '';
        $prodi['kd_fak'] = '';
        $prodi['status_akreditasi'] = '';
        $prodi['singkatan'] = '';
        $prodi['ka_prodi'] = '';
        $prodi['nidn'] = '';
        $prodi['kd_prodi_forlap'] = '';
        $prodi['listfakultas'] = $this->Akademika_model->get_all('fakultas');
        $this->template->load($this->view,'bak/fprodi',$prodi);
    }
    function aprodi()
    {
        $data['kd_prodi']=$this->input->post('kd_prodi',TRUE);
         $data['nm_prodi']=$this->input->post('nm_prodi',TRUE);
          $data['kd_fak']=$this->input->post('kd_fak',TRUE);
           $data['status_akreditasi']=$this->input->post('status_akreditasi',TRUE);
            $data['singkatan']=$this->input->post('singkatan',TRUE);
             $data['ka_prodi']=$this->input->post('ka_prodi',TRUE);
         $data['kd_prodi_forlap']=$this->input->post('kd_prodi_forlap',TRUE);
             $data['nidn']=$this->input->post('nidn',TRUE);
             $this->Akademika_model->save_data('prodi',$data);
              redirect(base_url().'bak/lprodi');
    }
     function ffakultas()
    {
        $fakultas['kd_fak'] = '';
        $fakultas['nm_fak'] = '';
        $fakultas['deskripsi'] = '';
        $fakultas['dekan'] = '';
        $fakultas['nip_dekan'] = '';
        $fakultas['wd1'] = '';
        $fakultas['nip_wd1'] = '';
        //$prodi['listfakultas'] = $this->Akademika_model->get_all('fakultas');
        $this->template->load($this->view,'bak/ffakultas',$fakultas);
    }
    //modul dosen
    function fdosen() {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            
            if ($level == "bak") {
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
                $datax['s1'] = '';
                $datax['s2'] = '';
                $datax['s3'] = '';
                $datax['status'] = '';
                $datax['kd_prodi'] = '';
                $datax['email'] = '';
                 $datax['kd_prodi'] = '';
                $datax['listhomebase']=$this->Akademika_model->get_all('prodi');
                $this->template->load($this->view, 'bak/fdosen', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    function adosen() {

       $cek2 = $this->session->userdata('userid');
       if (!empty($cek2)) {
            $aksi = $this->input->post('aksi', TRUE);
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
                $kd_dosens = $this->input->post('kd_dosen', TRUE);
                $kd_dosen_lama = $this->input->post('kd_dosen_lama', TRUE);
				if($kd_dosens=='' or $kd_dosens==$kd_dosen_lama)
				{
				    $id['kd_dosen'] = $kd_dosen_lama;
				    $this->Akademika_model->update_data('dosen', $datax, $id);
				    redirect(base_url() . 'bak/alldosen');
				}
				
				$keyfinddosen['kd_dosen']=$kd_dosen;
				$cek=$this->Akademika_model->get_row_selected('dosen',$keyfinddosen);
				
                if(($cek))
				{ 
				    	$this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Pesan</h4>
                    <p>Kode dosen ini sudah digunakan oleh dosen yang lain...!!!</p>
					</div>');
				}else
				{
				    $keyuser['userid'] = $kd_dosen_lama;
				    $datau['userid'] = $kd_dosens;
					$this->Akademika_model->update_data('user', $datau, $keyuser);
				    $keydosen['kd_dosen'] = $kd_dosen_lama;
					$datax['kd_dosen'] = $kd_dosens;
			        $this->Akademika_model->update_data('dosen', $datax, $keydosen);
			        $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Pesan</h4>
                    <p>Data dosen berhasil diperbaharui...!!!</p>
					</div>');
					 redirect(base_url() . 'bak/alldosen');
				}
				
               
            } elseif ($aksi == "Insert") {
                 $datax['kd_dosen'] = trim($this->input->post('kd_dosen', TRUE));
                $this->Akademika_model->save_data('dosen', $datax);
                //save user
                $datau['userid'] = trim($this->input->post('kd_dosen', TRUE));
                $this->Akademika_model->save_data('user', $datau);
                 $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Pesan</h4>
                    <p>Data dosen berhasil disimpan...!!!</p>
					</div>');
                redirect(base_url() . 'bak/alldosen');
            }
        } else {
            //echo $cek2;
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
     function alldosen() {
        $cek = $this->session->userdata('userid');
        //$kd_prodi = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "bak") {
                $datax['listdosen'] = $this->get_all_dosen();
                $this->template->load($this->view, 'bak/alldosen', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
      function get_all_dosen()
    {
        $sql="select dosen.kd_dosen,dosen.NIDN,nm_dosen,jns_kelamin,alamat,tempat,tgl_lahir,telepon,agama,dosen.Status,jafung,s1,s2,s3,link_foto,email,dosen.kd_prodi,nm_prodi from dosen,prodi where dosen.kd_prodi=prodi.kd_prodi order by dosen.kd_prodi asc";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
        //echo json_encode($hasil);
    }
     function edosen($kd_dosen) {
        $cek = $this->session->userdata('userid');
		$level = $this->session->userdata('level');
            if ($level == "bak") {
                $id['kd_dosen'] = $kd_dosen;
                $row = $this->Akademika_model->get_row_selected('dosen', $id);
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
					$datax['listagama']=$this->Akademika_model->get_all('tagama');
					$datax['listhomebase']=$this->Akademika_model->get_all('prodi');
                    $this->template->load($this->view, 'bak/edosen', $datax);
                } else {

                    $this->Akademika_model->save_data('dosen', $datax);
                    redirect(base_url() . 'bak/alldosen');
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
            $this->Akademika_model->delete_data('dosen', $id);
            $this->Akademika_model->delete_data('user', $id2);
            redirect(base_url() . 'bak/alldosen');
        }
    }

     function jumlah_mhs_registrasi_prodi($kd_tahun_ajaran)
    {
        $sql="select prodi.singkatan as singkatan,count(registrasi.nim) as jumlah from registrasi,mahasiswa,prodi where mahasiswa.nim=registrasi.nim and mahasiswa.kd_prodi=prodi.kd_prodi and kd_tahun_ajaran='".$kd_tahun_ajaran."' group by prodi.kd_prodi";
        $hasil=$this->db->query($sql)->result_array();
        //echo json_encode($hasil);
        return ($hasil);
    }
    private function jumlah_total_ukt_fak()
    {
        $sql="select kd_fak,sum(nilai_ukt) as jumlah from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi group by kd_fak";
        $hasil=$this->db->query($sql)->result_array();
        return ($hasil);
    }

    private function jumlah_mhs_prodi()
    {
        $sql="select singkatan,count(nim) as jumlah from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi group by mahasiswa.kd_prodi";
        $hasil=$this->db->query($sql)->result_array();
        return ($hasil);
    }


	//laporan registrasi
    function frrregistrasi()
    {
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $datax['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $this->template->load($this->view,'bak/frregistrasi',$datax);
    }

    //belum lengkap
    function get_mahasiswa()
    {
        // $keynim['nim']=$nim;
        $keynim['nim']=$this->input->post('nim',TRUE);
        $hasil=$this->Akademika_model->get_row_selected('mahasiswa',$keynim);
        echo json_encode($hasil);
    }

    function cek_registrasi($kd_tahun_ajaran,$nim)
    {
        $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $key['nim']=$nim;
        $hasil=$this->Akademika_model->get_row_selected('registrasi',$key);
        if($hasil)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    private function get_rregistrasi($kd_tahun_ajaran)
    {
        $sql="select kd_prodi,nm_prodi,kd_fak, (SELECT count(mahasiswa.nim)as tmhsprodi from mahasiswa where kd_prodi=prodi.kd_prodi)as jumlahmhs,(select count(registrasi.nim) from registrasi,mahasiswa where registrasi.nim=mahasiswa.nim and mahasiswa.kd_prodi=prodi.kd_prodi and jns_registrasi='SPP' and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."')as jumlah_registrasi_spp,(select count(registrasi.nim) from registrasi,mahasiswa where registrasi.nim=mahasiswa.nim and mahasiswa.kd_prodi=prodi.kd_prodi and jns_registrasi='cuti' and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."')as jumlah_registrasi_cuti from prodi order by kd_fak asc";

        $Output=$this->db->query($sql)->result();
        if($Output)
        {
            return ($Output);
        }
        else
        {
            return false;
        }
    }
    //form master kegiatan akademik
    function fka()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
			    $datax['kd_kegiatan']='';
                $datax['nm_kegiatan']='';
                $datax['deskripsi']='';
            if($level=="bak")
            {
                $this->template->load($this->view,'bak/kegiatanakademik',$datax);
            }
            elseif ($level=="wr1") {

                $this->template->load('template/templatewr1','bak/kegiatanakademik',$datax);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
	//
    //aksi save kegiatan akademik
    function aka()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
            if($level=="bak"||$level=="wr1")
            {
               
                $datax['kd_kegiatan']=$this->input->post('kd_kegiatan',TRUE);
                $datax['nm_kegiatan']=$this->input->post('nm_kegiatan',TRUE);
                $datax['deskripsi']=$this->input->post('deskripsi',TRUE);
                try {
                     $this->Akademika_model->save_data('kegiatanakademik',$datax);
                } catch (Exception $e) {
                    echo 'error';
                }
               
                redirect(base_url().'bak/fka');
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //list data tahun ajaran
    function lta()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
            if($level=="bak")
            {
                $listtahunajaran['data'] = $this->Akademika_model->get_all_desc('thnajaran','kd_tahun_ajaran');
                $this->template->load($this->view,'bak/tahunajaran/listtahunajaran',$listtahunajaran);
            }
            elseif($level=="wr1")
            {
                $listtahunajaran['data'] = $this->Akademika_model->get_all('thnajaran');
                $this->template->load('template/templatewr1','bak/tahunajaran/listtahunajaran',$listtahunajaran);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }

        }
    }
    function aktif_ta($kd_ta)
    {
        $key['kd_tahun_ajaran']=$kd_ta;
        $data['aktif']='ya';
        $this->Akademika_model->update_data('thnajaran',$data,$key);
        $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Data Tahun Akademik berhasil diaktifkan...!!!</p>
					</div>');
        $this->lta();
    }
    function noaktif_ta($kd_ta)
    {
        $key['kd_tahun_ajaran']=$kd_ta;
        $data['aktif']='tidak';
        $this->Akademika_model->update_data('thnajaran',$data,$key);
        $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Pesan</h4>
                    <p>Data Tahun Akademik berhasil dinon aktifkan...!!!</p>
					</div>');
        $this->lta();
    }
    //form tahun ajaran
    function fta()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
            if($level=="bak")
            {
                $datax['tahun_ajaran']='';
                $datax['semester']='';
                $datax['keterangan']='';
                $this->template->load($this->view,'bak/tahunajaran',$datax);
            }elseif ($level=='wr1') {
                 $datax['tahun_ajaran']='';
                $datax['semester']='';
                $datax['keterangan']='';
                $this->template->load('template/templatewr1','bak/tahunajaran',$datax);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //operasi tahun ajaran
    function ata()
    {
    $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
            if($level=="bak"|| $level=="wr1")
            {
                 //operasinya
                $ta=$this->input->post('tahun_ajaran',TRUE);
                $semester=$this->input->post('semester',TRUE);
                $kd_semester=1;
                if($semester=="GENAP")
                {
                    $kd_semester=2;
                }

                $kd_tahun_ajaran=$ta.$kd_semester;
                $datax['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $datax['tahun_ajaran']=$ta;
                $datax['semester']=$semester;
                $datax['keterangan']=$this->input->post('keterangan',TRUE);
                $datax['aktif']='YA';
                $this->Akademika_model->save_data('thnajaran',$datax);
                redirect(base_url());
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }

    }
	//list kegiatan akademik
function listkegiatan()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
            if($level=="bak")
            {
                $datax['listkegiatan'] = $this->Akademika_model->get_all('kegiatanakademik');
                $this->template->load($this->view,'bak/listkegiatan',$datax);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //close kegiatan akademik
    function cja($kd_tahun_ajaran,$kd_kegiatan)
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;

            if($level=="bak"||$level=="wr1")
            {
                if($kd_kegiatan=='JDWL')
                {
                    $dataxy['status']='Tertutup';   
                    $keyx['kd_tahun_ajaran']=$kd_tahun_ajaran;
                    $this->Akademika_model->update_data('jadwal',$dataxy,$keyx);
                }
                if($kd_kegiatan=="KRS"){
                    $keyx['kd_tahun_ajaran']=$kd_tahun_ajaran;
                    $dataxy['status_krs']='Tertutup';   
                    $this->Akademika_model->update_data('jadwal',$dataxy,$keyx);
                }
                if($kd_kegiatan=="NILAI")
                {
                    $keyx['kd_tahun_ajaran']=$kd_tahun_ajaran;
                    $dataxy['status_nilai']='Tertutup';   
                    $this->Akademika_model->update_data('jadwal',$dataxy,$keyx);
                }
                $datax['aktif']='Tidak';
               $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $key['kd_kegiatan']=$kd_kegiatan;
                $this->Akademika_model->update_data('jadwalakademik',$datax,$key);
                redirect(base_url().'bak/lja');
            
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //open kegiatan akademik
     function oja($kd_tahun_ajaran,$kd_kegiatan)
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;

            if($level=="bak"||$level=="wr1")
            {
                $datax['aktif']='YA';
                $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $key['kd_kegiatan']=$kd_kegiatan;
                $keyx['kd_tahun_ajaran']=$kd_tahun_ajaran;
                if($kd_kegiatan=='JDWL')
                {
                    $dataxy['status']='Terbuka';    
                }
                if($kd_kegiatan=="KRS"){
                    $dataxy['status_krs']='Terbuka';   
                }
                if($kd_kegiatan=="NILAI")
                {
                    $dataxy['status_nilai']='Terbuka';   
                    
                }
                $this->Akademika_model->update_data('jadwalakademik',$datax,$key);
                $this->oja_khusus();
                //$this->Akademika_model->update_data('jadwal',$dataxy,$keyx);
                
                redirect(base_url().'bak/lja');
            
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    function oja_khusus()
    {
        $key['setujui_2']='pddikti';
        $list=$this->Akademika_model->get_list_selected('permintaan_akses_nilai',$key);
        foreach($list as $row)
        {
            $data['status_nilai']='Terbuka';
            $keys['kd_jadwal']=$row->kd_jadwal;
            $this->Akademika_model->update_data('jadwal',$data,$keys);
        }
    }
    //LIST JADWAL KEGIATAN AKADEMIK

    function lja()
    {
        $cek = $this->session->userdata('userid');
        $ta_aktif = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
             //$keyta['aktif']="YA";
             //$keyta['kd_tahun_ajaran']=$ta_aktif;
             
             //$ta = $this->Akademika_model->get_row_selected('thnajaran',$keyta);
             //$kd_tahun_ajaran=$ta->kd_tahun_ajaran;
            if($level=="bak")
            {
               $ljs['data']=$this->get_lja($ta_aktif);
                $this->template->load($this->view,'bak/listjka',$ljs);
            }elseif ($level=="wr1") {
               
                $ljs['data']=$this->get_lja($kd_tahun_ajaran);
                $this->template->load('template/templatewr1','bak/listjka',$ljs);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    private function get_lja($kd_tahun_ajaran)
    {
        $sql="SELECT  `jadwalakademik`.`kd_tahun_ajaran`, `jadwalakademik`.`kd_kegiatan`,
                `kegiatanakademik`.`nm_kegiatan`, `kegiatanakademik`.`deskripsi`,
                `jadwalakademik`.`dari_tanggal`, `jadwalakademik`.`sampai_tanggal`,
                `jadwalakademik`.`aktif`
                FROM
                 `jadwalakademik` INNER JOIN
                `kegiatanakademik` ON `kegiatanakademik`.`kd_kegiatan` =`jadwalakademik`.`kd_kegiatan` where `jadwalakademik`.`kd_tahun_ajaran`='".$kd_tahun_ajaran."'";
                $output=$this->db->query($sql)->result();
                return $output;
    }
    function eja($kd_tahun_ajaran,$kd_kegiatan)
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
                $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $key['kd_kegiatan']=$kd_kegiatan;
                $kegiatan=$this->Akademika_model->get_row_selected('jadwalakademik',$key);
                $listkegiatan=$this->Akademika_model->get_all('kegiatanakademik');
                $datax['kd_tahun_ajaran']=$kegiatan->kd_tahun_ajaran;
                $datax['kd_kegiatan']=$kegiatan->kd_kegiatan;
                $datax['dari_tanggal']=$kegiatan->dari_tanggal;
                $datax['sampai_tanggal']=$kegiatan->sampai_tanggal;
                $datax['aktif']=$kegiatan->aktif;
                $datax['listkegiatan']=$listkegiatan;
            if($level=="bak")
            {
                $this->template->load($this->view,'bak/jadwalkegiatanakademik',$datax);
            }elseif ($level=="wr1") {
                $this->template->load('template/templatewr1','bak/jadwalkegiatanakademik',$datax);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //form jadwal kegiatan akademik
    function fja()
    {
        $cek = $this->session->userdata('userid');
        $kd_ta = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
                $listkegiatan=$this->Akademika_model->get_all('kegiatanakademik');
                $datax['kd_tahun_ajaran']=$kd_ta;
                $datax['kd_kegiatan']='';
                $datax['dari_tanggal']='';
                $datax['sampai_tanggal']='';
                $datax['aktif']='YA';
                $datax['listkegiatan']=$listkegiatan;
            if($level=="bak")
            {
                
                $this->template->load($this->view,'bak/jadwalkegiatanakademik',$datax);
            }elseif ($level="wr1") {
                $this->template->load('template/templatewr1','bak/jadwalkegiatanakademik',$datax);
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //OPERASI JADWAL KEGIATAN AKADEMIK
    function aja()
    {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah','hadist' => 'isbal');
            if($level=="bak" || $level=='wr1')
            {
                 //operasinya
               $key['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran');
                    $key['kd_kegiatan']=$this->input->post('kd_kegiatan');
                
                $kegiatan=$this->Akademika_model->get_row_selected('jadwalakademik',$key);
                if(empty($kegiatan))
                {
                    $datax['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran');
                    $datax['kd_kegiatan']=$this->input->post('kd_kegiatan');
                    $datax['dari_tanggal']=$this->input->post('dari_tanggal');
                    $datax['sampai_tanggal']=$this->input->post('sampai_tanggal');
                    $datax['aktif']=$this->input->post('aktif');
                    $this->Akademika_model->save_data('jadwalakademik',$datax);
                    
                }
                else
                {
                    $key['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran');
                    $key['kd_kegiatan']=$this->input->post('kd_kegiatan');
                    $datax['dari_tanggal']=$this->input->post('dari_tanggal');
                    $datax['sampai_tanggal']=$this->input->post('sampai_tanggal');
                    $datax['aktif']=$this->input->post('aktif');
                     $this->Akademika_model->update_data('jadwalakademik',$datax,$key);
                }
                redirect(base_url().'bak/lja');
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //list registrasi
     function lreg2($kd_ta)
    {
        $cek = $this->session->userdata('userid');
         $kd_tahun_ajaran = $kd_ta;
        if (empty($cek)) {
            redirect(base_url());
        } else {
                 //operasinya
                $sql="SELECT bank,`registrasi`.`noreg`, `registrasi`.`kd_tahun_ajaran`, `registrasi`.`no_reg_bank`, `registrasi`.`tgl_reg_bank`,`registrasi`.`tgl_reg_bak`, `registrasi`.`nim`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi` FROM `registrasi` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `registrasi`.`nim` and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."'";
                    $listdata['listdata']=$this->db->query($sql)->result();
				$listdata['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $this->template->load($this->view,'bak/ukt/list_pembayaran_ukt',$listdata);
        }
    }
    function lreg()
    {
        $cek = $this->session->userdata('userid');
         $kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
                 //operasinya
                   $sql="SELECT bank,`registrasi`.`noreg`, `registrasi`.`kd_tahun_ajaran`, `registrasi`.`no_reg_bank`, `registrasi`.`tgl_reg_bank`,`registrasi`.`tgl_reg_bak`, `registrasi`.`nim`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi` FROM `registrasi` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `registrasi`.`nim`  and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."'";
                    $listdata['listdata']=$this->db->query($sql)->result();
				$listdata['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $this->template->load($this->view,'bak/ukt/list_pembayaran_ukt',$listdata);
        }
        

    }
function freset_password()
    {
       	$level = $this->session->userdata('level');
		if($level=="bak"){
		$data['userid']='';
		    $data['password']='';
	       $this->template->load($this->view, 'bak/freset_password', $data);	
		}    
    }
    function ureset_password()
    {
       	$level = $this->session->userdata('level');
		if($level=="bak"){
			$data['userid']=$this->input->post('userid', TRUE);
			$pass2=$this->input->post('password', TRUE);
			$data['password']=md5($pass2.'usn1234');
			$key['userid']=$this->input->post('userid', TRUE);
			$hasil2=$this->Akademika_model->update_data('user',$data,$key);
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
					 redirect(base_url().'/bak/freset_password');
			
			
		}else
		{
		        $this->session->sess_destroy();
		    	redirect(base_url());
		}
    }
    //form registrasi mhasiswa 
    public function fregistrasi()
    {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
           
            if($level=="bak")
            {
                 //operasinya
                 $keyja['kd_tahun_ajaran']=$kd_tahun_ajaran;
               $keyja['kd_kegiatan']='SPP';
              $hasilcekja=$this->Akademika_model->get_row_selected('jadwalakademik',$keyja);
              if($hasilcekja->aktif=='Tidak')
              {
                redirect(base_url().'bak/lreg');
              }
              else
              {

				
                
                $datax['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $datax['no_reg_bank']='';
                $datax['tgl_reg_bank']='';
                $datax['nim']='';
                $datax['tgl_reg_bak']='';
                $datax['jns_registrasi']='P03';
                $datax['userid']=$cek;
                //$datax['listmhs']=$this->Akademika_model->get_all('mahasiswa');
                $this->template->load($this->view,'bak/registrasi',$datax);
                }
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    //fung simpan registrasi mahasiswa
    public function aregistrasi()
    {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            if($level=="bak")
            {
                 //operasinya
                $x['aktif']='ya';
                $nim=$this->input->post('nim',TRUE);
                $datax['kd_tahun_ajaran']=$kd_tahun_ajaran;
                $datax['no_reg_bank']=$this->input->post('no_reg_bank',TRUE);
                $datax['tgl_reg_bank']=$this->input->post('tgl_reg_bank',TRUE);
                $datax['nim']=$this->input->post('nim',TRUE);
                $keymhs['nim']=$nim;
                $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
                $home_base=$mhs->kd_prodi;
                $datax['tgl_reg_bak']=date('Y-m-d');
                $datax['jns_registrasi']="P03";
                $datax['home_base']=$mhs->kd_prodi;
                
                $datax['noreg'] = $this->createNoReg($kd_tahun_ajaran,$home_base);
                $keymhs['nim']=$this->input->post('nim',TRUE);
                $rowmhs = $this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
                $smsmhs=$rowmhs->semester+1;
                $udatamhs['semester']=$smsmhs;
                $hasilx=$this->cek_registrasi($kd_tahun_ajaran,$nim);
                if($hasilx==0)
                {
                $this->Akademika_model->save_data('registrasi',$datax);
                $this->Akademika_model->update_data('mahasiswa',$udatamhs,$keymhs);
                 $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Data sudah tersimpan..... Terimakasih</p>
					</div>');
                redirect(base_url().'bak/fregistrasi');
                }
                else
                {
                     $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Sudah registrasi sebelumnya..... Terimakasih</p>
					</div>');
                redirect(base_url().'bak/fregistrasi');
                }
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }

    }


    

    
    
    
    
    
    
    
    
    

    public function _rules() 
    {
	$this->form_validation->set_rules('NIDN', 'nidn', 'trim|required');
	$this->form_validation->set_rules('nm_dosen', 'nm dosen', 'trim|required');
	$this->form_validation->set_rules('jns_kelamin', 'jns kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
	$this->form_validation->set_rules('agama', 'agama', 'trim|required');
	$this->form_validation->set_rules('Status', 'status', 'trim|required');
	$this->form_validation->set_rules('kd_prodi', 'kd prodi', 'trim|required');

	$this->form_validation->set_rules('kd_dosen', 'kd_dosen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "dosen.xls";
        $judul = "dosen";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "NIDN");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Dosen");
	xlsWriteLabel($tablehead, $kolomhead++, "Jns Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Telepon");
	xlsWriteLabel($tablehead, $kolomhead++, "Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Prodi");

	foreach ($this->Dosen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NIDN);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_dosen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jns_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telepon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_prodi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=dosen.doc");

        $data = array(
            'dosen_data' => $this->Dosen_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('dosen_doc',$data);
    }
    public function pdf()
    {
        $this->load->library('m_pdf');
        $data = array(
            'dosen_data' => $this->Dosen_model->get_all(),
            'start' => 0
        );
        
        $html=$this->load->view('dosen_pdf',$data);
//        $pdfFilePath = "hasilreport.pdf";
//        //lokasi file css yang akan di load
//        //$css = $this->load->view('bootstrap.min.css');
//        //$stylesheet = file_get_contents($css);
// 
//        $pdf = $this->m_pdf->load();
// 
//        $pdf->AddPage('L');
//        //$pdf->WriteHTML($stylesheet, 1);
//        $pdf->WriteHTML($html);
//        
//        $pdf->Output($pdfFilePath, "D");
//        exit();
    }

}

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-27 03:48:53 */
/* http://harviacode.com */