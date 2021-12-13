<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public $gallery_path;
    public $gallery_path_url;
    public $naskah_path;
    public $naskah_path_url;
    public $view = 'template/templatemhs';

    function __construct() {
        parent::__construct();
        $this->load->model('Mahasiswa_model');
         $this->load->model('Prodi_model');
          $this->load->model('Akademika_model');
        $this->load->library('form_validation');
        $this->load->library('table');
		 $this->gallery_path = realpath(APPPATH . '../doc/foto/');
        $this->gallery_path_url = base_url() . 'doc/foto/';
        	 $this->naskah_path = realpath(APPPATH . '../doc/naskah/');
        $this->naskah_path_url = base_url() . 'doc/naskah/';
        
        		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    }

    public function index() {
         
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $home_base = $this->session->userdata('home_base');
        $level = $this->session->userdata('level');
        $keypro['kd_prodi']=$home_base;
         //$this->cek_biodata($cek);
        if ($level == "mahasiswa") {
            $status_registrasi = $this->status_registrasi($kd_tahun_ajaran, $cek);
            if ($status_registrasi == false) {
                $data['data'] = "Cek SIDU , ";
            } else {
                $data['data'] = "Sudah";
            }

            $sql = $this->db->query("select * from jadwalakademik where kd_tahun_ajaran='" . $kd_tahun_ajaran . "'");
            $template = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="table table-bordered table-hover">');
            $this->table->set_template($template);
            $this->table->set_heading('TA', 'KEGIATAN', 'DARI TANGGAL', 'SAMPAI TANGGAL', 'AKTIF');
            $data['jadwal'] = $this->table->generate($sql);
            $ljadwal=$this->get_jadwal($cek,$kd_tahun_ajaran);
            $data['jadwalkuliah']=$this->parsing($ljadwal);
             //$data['jadwalujian']=$this->get_jadwal_ujian($cek);
            $data['listips'] = $this->get_all_ips($cek);
            $data['ipk'] = $this->Akademika_model->get_ipk($cek,$kd_tahun_ajaran);
            $data['ips'] = $this->get_ips($cek,$kd_tahun_ajaran);
             $data['pa'] = $this->Akademika_model->get_pa($cek);
             $data['jadwalujianlengkap']=$this->jadwal_ujian();
            $data['tot_sks'] = $this->get_tot_sks($cek);
             $data['prodi'] = $this->Akademika_model->get_row_selected('prodi',$keypro);
            $this->template->load($this->view, 'template/homemhs', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    
    //modul help
    
    function help()
    {
         $cek = $this->session->userdata('userid');
        $key['userid']=$cek;
        $data['list_help']=$this->Akademika_model->get_list_selected('help',$key);
         $data['list_help_status']=$this->Akademika_model->get_all('help_status');
         $this->template->load($this->view, 'mahasiswa/help/list_help', $data);
    }
    function input_help()
    {
        $data='';

        $this->template->load($this->view, 'mahasiswa/help/form_help', $data);
    }
    //modul edom
    function cek_edomx($no_krs)
    {
        
            $this->khs($no_krs);
        
        
    }
    
    function cek_edom($no_krs)
    {
        $list=array();
        $data['hkhs'] = '';
        $data['dkhs'] = '';
        $data['no_krs']=$no_krs;
        $dkhs = $this->Akademika_model->get_dkhs_edom($no_krs);
        $hkhs = $this->Akademika_model->get_hkhs($no_krs);
        $data['hkhs'] = $hkhs;    
        //echo json_encode($dkhs);
        
        if($dkhs)
        {
            foreach($dkhs as $row)
            {
                //cek isian
                $cek=$this->get_isian_edom($row->kd_jadwal);
                if($cek)
                {
                    $x['kd_jadwal']=$row->kd_jadwal;
                     $x['kd_mtk']=$row->kd_mtk;
                      $x['nm_mtk']=$row->nm_mtk;
                       $x['sks']=$row->sks;
                        $x['kelas']=$row->kelas;
                        $x['nm_dosen']='';
                         array_push($list,$x);
                }
            }
            $data['dkhs'] = $list;    
            if( count($list)<1){
                 $this->khs($no_krs);
                
            }else
            {
                $this->template->load($this->view, 'mahasiswa/edom/list_mtk_krs_mhs', $data);  
            }
              
        }else
        {
            $this->khs($no_krs);
        }
        
    }
  
   function get_isian_edom($kd_jadwal)
   {
       $sql2="select count(*) as jumlah from edom_soal where aktif='Y' ";
       $hasil2 = $this->db->query($sql2)->row();
       $x=$hasil2->jumlah;
       $sql="SELECT kd_jadwal,COUNT(*) as jumlah FROM `edom_jawaban2` where kd_jadwal='".$kd_jadwal."' group by edom_jawaban2.kd_jadwal";
         $hasil = $this->db->query($sql)->row();
        if($hasil)
        {
            $jumlah=$hasil->jumlah;
            if($jumlah<=$x)
            {
                return true;
            }else
            {
               return false;
            }
        }else
        {
            return true;
        }
        
       
   }
    function edom2($kd_jadwal,$no_krs)
    {
        
       $data['no_krs']=$no_krs;
       $sql="select * from edom_soal WHERE edom_soal.nosoal not IN (SELECT no_soal from edom_jawaban2 where edom_jawaban2.kd_jadwal='".$kd_jadwal."') order by edom_soal.nosoal ASc LIMIT 1";
        $hasil = $this->db->query($sql)->row();
        if($hasil)
        {
            $data['soal']=$hasil;
             $data['jadwal']=$this->Akademika_model->get_jadwal($kd_jadwal);
              $this->template->load($this->view, 'mahasiswa/edom/fedom', $data);
        }else
        {
            $this->cek_edom($no_krs);
        }
       
        
       
        
    }
    
    function save_edom2()
    {
        $no_krs=$this->input->post('no_krs');
        $kd_jadwal=$this->input->post('kd_jadwal');
        
        $data['no_soal']=$this->input->post('no_soal');
        $data['jawaban']=$this->input->post('jawaban');
        $data['kd_jadwal']=$this->input->post('kd_jadwal');
        $data['kd_mtk']=$this->input->post('kd_mtk');
         $data['kd_dosen']=$this->input->post('kd_dosen');
         $data['nim'] = $this->session->userdata('userid');
       
        $key['kd_jadwal']=$this->input->post('kd_jadwal');
         $key['nim'] = $this->session->userdata('userid');
          $key['no_soal']=$this->input->post('no_soal');
          
      $cek= $this->Akademika_model->get_row_selected('edom_jawaban2',$key);
       if($cek)
        {
            $this->Akademika_model->update_data('edom_jawaban2',$data,$key);
           
        }else
        {
          
             $this->Akademika_model->save_data('edom_jawaban2',$data);
        }
        $this->edom2($kd_jadwal,$no_krs);
    }
    
   
    
    //modul kelas
    
    
    function kelas()
    {
        $home_base=$this->session->userdata('home_base');
        $keys['nim']=$this->session->userdata('userid');
        
        $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keys);
        $key['angkatan']=$mhs->angkatan;
        $key['kd_prodi']=$home_base;
        $data['list_kelas']=$this->Akademika_model->get_list_selected('kelas_mahasiswa',$key);
        $data['list_jumlah']=$this->Akademika_model->get_list_selected('vkelas_angkatan',$key);
        
        $hasil=$this->Akademika_model->get_row_selected('kelas_mahasiswa_detail',$keys);
        if($hasil)
        {
            $data['kd_kelas']=$hasil->kd_kelas;
        }else
        {
             $data['kd_kelas']='';
        }
        $this->template->load($this->view, 'mahasiswa/fpilih_kelas_angkatan', $data);
    }
    function cek_quota_kelas($id_kelas)
    {
         $output='unfull';
        $key['kd_kelas']=$id_kelas;
        $hasil=$this->Akademika_model->get_row_selected('vkelas_angkatan',$key);
        if($hasil)
        {
            if($hasil->kuota<=$hasil->jumlah)
            {
                $output='full';
            }else
            {
                $output='unfull';
            }
        }
        
        return $output;
    }
    function kelas_gabung()
    {
        //$key['kd_kelas']=$id_kelas;
        $id_kelas=$this->input->post('kd_kelas');
        $key['nim']=$this->session->userdata('userid');
        $keyk['kd_kelas']=$id_kelas;
       $kelas=$this->Akademika_model->get_row_selected('kelas_mahasiswa',$keyk);
       $datam['kelas']=$kelas->kelas;
        $cek=$this->Akademika_model->get_row_selected('kelas_mahasiswa_detail',$key);
        if($cek)
        {
             $data['kd_kelas']=$id_kelas;
            $this->Akademika_model->update_data('kelas_mahasiswa_detail',$data,$key);
             $this->Akademika_model->update_data('mahasiswa',$datam,$key);
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Anda sudah tergabung dalam kelas '.$kelas->kelas.'...!!!</p>
					</div>');
        }else
        {
            $cek_quota=$this->cek_quota_kelas($id_kelas);
            if($cek_quota=='unfull')
            {
                 $data['kd_kelas']=$id_kelas;
                $data['nim']=$this->session->userdata('userid');
                
                $this->Akademika_model->save_data('kelas_mahasiswa_detail',$data,$key);
                $this->Akademika_model->update_data('mahasiswa',$datam,$key);
            
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Anda sudah tergabung dalam kelas '.$kelas->kelas.'...!!!</p>
					</div>');
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Data kelas sudah penuh...!!!</p>
					</div>');
            }
        }
         redirect(base_url('mahasiswa/kelas'));
        
    }
    
    //modul kkn
    
    
    function list_kkn()
    {
        $nim=$this->session->userdata('userid');
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT kkn.nim,mahasiswa.nm_mahasiswa,tot_sks,status from kkn,mahasiswa where kkn.nim=mahasiswa.nim ";
        
         $data['list_kkn'] = $this->db->query($sql)->result();
        $this->template->load($this->view, 'mahasiswa/labsen', $data);
    }
    function daftar_kkn()
    {
        $key['nim']=$this->session->userdata('userid');
        $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$key);
        $data['nim']=$mhs->nim;
        $data['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
        $data['nm_mahasiswa']=$mhs->nm_mahasiswa;
        $data['jum_sks']=$this->get_tot_sks_lulus($mhs->nim);
        $this->template->load($this->view, 'mahasiswa/fkkn', $data);
    }
    function akkn()
    {
        $sks=$this->input->post('jum_sks',true);
        $nim=$this->input->post('nim',true);
        $kd_ta=$this->input->post('kd_tahun_ajaran',true);
        $data['nim']=$this->input->post('nim',true);
        $data['tgl_daftar']=date("Y-m-d");
        $data['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran',true);
        $data['jum_sks']=$this->input->post('jum_sks',true);
        $data['status']='daftar';
        
        if($sks<123)
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Pendaftaran KKN belum Memenuhi Syarat Minimal Jumlah SKS yang telah diambil (lulus)</p>
					</div>');
        }else
        {
            $lokasi= './files/transkrip/';
            $config['upload_path'] = './files/transkrip';
            $config['allowed_types'] = 'pdf';
           $config['file_name']           = $nim;
            
           
           // $lokasi=$this->gallery_path;
           
            
            $this->load->library('upload', $config);
             $file=$lokasi.'/'.$nim.'.pdf';
            if(file_exists($file))
            {
                unlink($file);
            }
           
            $this->upload->do_upload('userfile');
            $data['file_transkrip']=base_url('files/transkrip').'/'. $this->upload->data("file_name");
            $keycek['nim']=$nim;
            $keycek['kd_tahun_ajaran']=$kd_ta;
            
            $cek=$this->Akademika_model->get_row_selected('kkn',$keycek);
            if($cek)
            {
                $this->Akademika_model->update_data('kkn',$data,$keycek);
            $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Pendaftaran KKN berhasil disimpan, selanjutnya tunggu persetujuan dari Program Studi</p>
					</div>');
            }else
            {
                $this->Akademika_model->save_data('kkn',$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Pendaftaran KKN berhasil disimpan, selanjutnya tunggu persetujuan dari Program Studi</p>
					</div>');
            }
            
        }
         redirect(base_url('mahasiswa'));
    }
    //modul absen
    function get_rekap_absensi_mahasiswa($kd_jadwal,$status)
    {
        $output=0;
        $filter['nim']= $nim=$this->session->userdata('userid');
         $filter['kd_jadwal']=$kd_jadwal;
         $filter['status']=$status;
        $hasil=$this->Akademika_model->get_row_selected('vrekap_absensi_mahasiswa',$filter);
        if($hasil)
        {
            $output=$hasil->jumlah;
        }
        return $output;
         
    }
    
    function list_absen()
    {
         $list=array();
        $nim=$this->session->userdata('userid');
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT absensih.id_absen,durasi_absen,absensih.kd_jadwal,absensih.pertemuan_ke,absensih.link_kelas,absensih.materi,absensih.tgl_pertemuan,absensih.aktif FROM `absensih`,rencanastudid,rencanastudih WHERE absensih.kd_jadwal=rencanastudid.kd_jadwal and rencanastudid.no_krs=rencanastudih.no_krs and rencanastudih.nim='".$nim."' and rencanastudih.kd_tahun_ajaran='".$kd_tahun_ajaran."' and absensih.aktif='Y' and rencanastudih.setujui_pa='Ya'";
         $kuliahs= $this->db->query($sql)->result();
        foreach($kuliahs as $kuliah)
        {
            $data['id_absen']=$kuliah->id_absen;
             $data['pertemuan_ke']=$kuliah->pertemuan_ke;
             $data['tgl_pertemuan']=$kuliah->tgl_pertemuan;
             $data['durasi_absen']=$kuliah->durasi_absen;
             $data['link_kelas']=$kuliah->link_kelas;
             $data['aktif']=$kuliah->aktif;
             $data['materi']=$kuliah->materi;
            $mtk=$this->get_jadwalx($kuliah->kd_jadwal);
             $data['nm_mtk']=$mtk->nm_mtk;
             $data['kelas']=$mtk->kelas;
             
             $hasil=$this->get_jadwal_detail($kuliah->kd_jadwal);
                            if($hasil)
                            {
                                 $dosen='';
                                foreach($hasil as $d)
                                {
                                        $dosen=$dosen.'('.$d->dosen_ke.')'.'.'.$d->nm_dosen;
                                        $data['dosen']=$dosen;
                                        //array_push($list,$data);
                                }
                            }else
                            {
                                $data['dosen']='';
                            }
             
            array_push($list,$data);
        }
         $datax['absenstatuss']=$this->Akademika_model->get_all('absenstatus');
       //echo json_encode($list);
       $datax['list']=$list;
        $this->template->load($this->view, 'mahasiswa/labsen', $datax);
        
    }
    function get_jadwalx($kd_jadwal){
        
          $sql2="select jadwal.kd_jadwal,jadwal.kelas,jadwal.hari,jadwal.jam,matakuliah.nm_mtk,matakuliah.semester_ke from jadwal,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_jadwal='".$kd_jadwal."'";
          $jadwal= $this->db->query($sql2)->row();
          return $jadwal;
    }

    function save_absen_kuliah($id_absen)
    {
        $nim=$this->session->userdata('userid');
      
        $data['h']='1';
        $data['tgl_absen']=date('Y-m-d H:m:s');
        $key['nim']=$nim;
        $key['id_absen']=$id_absen;
        
        $cek= $this->Akademika_model->get_row_selected('absensid',$key);
        if($cek)
        {
            $this->Akademika_model->update_data('absensid',$data,$key);
        }else
        {
            $data['nim']=$nim;
            $data['id_absen']=$id_absen;
             $this->Akademika_model->save_data('absensid',$data);
        }
       
       $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Data Absen tersimpan..... Terimakasih</p>
					</div>');
			 redirect(base_url() . 'mahasiswa/list_absen');		
    }
    function ajax_save_absen()
    {
        $pesan='Gagal';
        $nim=$this->session->userdata('userid');
       $id_absen=$this->input->post('id_absen');
      
        $data['status']=  $this->input->post('status');
        $data['tgl_absen']=date('Y-m-d H:m:s');
        $key['nim']=$nim;
        $key['id_absen']=$id_absen;
        
        $cek= $this->Akademika_model->get_row_selected('absensid',$key);
        if($cek)
        {
            $this->Akademika_model->update_data('absensid',$data,$key);
            $pesan="Tersimpan";
        }else
        {
            $data['nim']=$nim;
            $data['id_absen']=$id_absen;
             $this->Akademika_model->save_data('absensid',$data);
             $pesan="Tersimpan";
        }
         $this->session->sess_destroy();
     //  redirect('http://www.facebook.com'); 
      echo $pesan;
    }
    //modul maintenance
    function maintenance()
    {
        $this->load->view('maintenance');
        $this->session->sess_destroy();
    }
    
    //modul cuti
    
    function fcuti()
    {
         
        $nim=$this->session->userdata('userid');
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        
        
        
        
            $keymhs['nim']=$nim;
            $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
        $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $data['aksi']='input';
        $data['nim']=$mhs->nim;
        $data['nm_mahasiswa']=$mhs->nm_mahasiswa;
        $data['alasan']='';
       
        
        $this->template->load($this->view, 'mahasiswa/fcuti', $data);
        
        
    }
    function cek_reg_cuti($kd_tahun_ajaran,$nim)
    {
        
    }
    function lcuti()
    {
         
        $key['nim']=$this->session->userdata('userid');
        $data['list']=$this->Akademika_model->get_list_selected('cuti',$key);
        $this->template->load($this->view, 'mahasiswa/lcuti', $data);
    }
    function acuti()
    {
        
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $kd_prodi=$this->session->userdata('home_base');
        
        $data['nim']=$this->input->post('nim',true);
        $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $data['alasan']=$this->input->post('alasan',true);
        $data['tgl_cuti']=date('Y-m-d');
        $data['kd_prodi']=$kd_prodi;
         $data['no_cuti']=$this->createNoCuti($kd_prodi,$kd_tahun_ajaran);
        $this->Akademika_model->save_data('cuti',$data);
        redirect(base_url() . 'mahasiswa/lcuti');
    }
    function hapus_cuti($id)
    {
        $key['no_cuti']=$id;
        $hasil=$this->Akademika_model->delete_data('cuti',$key);
        if($hasil)
        {
             $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Permohonan cuti berhasil dihapus..... Terimakasih</p>
					</div>');
        }else
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Permohonan cuti gagal dihapus..... Terimakasih</p>
					</div>');
        }
          redirect(base_url('prodi/lcuti'));
    }
    
    ///modul yudisium
    function fyudisium()
{
     
    $data['aksi']='input';
     $data['ta'] = $this->session->userdata('kd_tahun_ajaran');
    $this->template->load($this->view, 'mahasiswa/fyudisium', $data);
}
function cek_yudisium($nim)
{
    $key['nim']=$nim;
    return $this->Akademika_model->get_row_selected('yudisium',$key);
}
function ayudisium()
{
    
    $nim=$this->input->post('nim',true);
    $homebase = $this->session->userdata('home_base');
    $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
    $data['nim']=$this->input->post('nim',true);
    
    $data['tgl_daftar ']=date('Y-m-d');
    $data['kd_prodi ']=$homebase;
    $data['judul']=$this->input->post('judul',true);
    $data['ipk']=$this->input->post('ipk',true);
    $data['tgl_ujian']=$this->input->post('tgl_ujian',true);
     $data['nilai']=$this->input->post('nilai',true);
     $data['status']=$this->input->post('status',true);
     $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
      $data['ket']=$this->input->post('ket',true);
    $hasil=$this->cek_yudisium($nim);
    if(empty($hasil))
     {
         $data['no_daftar']=$this->Akademika_model->createNoYudisium($homebase,$kd_tahun_ajaran);
     $this->Akademika_model->save_data('yudisium',$data);
      $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Tersimpan..... Terimakasih</p>
					</div>');
     }
     else
     {
         $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Data Yudisium Mahasiswa ini sudah ada. Terimakasih</p>
					</div>');
     }
    redirect(base_url() . 'prodi/lyudisium');
}
function dyudisium($no)
{
    $data['no_daftar']=$no;
     $this->Akademika_model->delete_data('yudisium',$data);
     redirect(base_url() . 'prodi/lyudisium');
}
    
    function list_daftar_judul()
{
     
    $kd_prodi=$this->session->userdata('home_base');
    $sql="SELECT kd_tahun_ajaran,daftar_judul.nim,nm_mahasiswa,angkatan,judul,daftar_judul.status FROM daftar_judul,mahasiswa WHERE daftar_judul.nim=mahasiswa.nim AND daftar_judul.kd_prodi='".$kd_prodi."' order by kd_tahun_ajaran,no_daftar asc";
    
     $data['list'] = $this->db->query($sql)->result();
     $this->template->load($this->view, 'mahasiswa/list_judul', $data);
}
   //fitur pemilihan umum mhasiswa
   function fpin_hmps()
   {
        
      // $key='2frk';
       $cek = $this->session->userdata('userid');
       if(empty($cek))
       {
            $this->session->sess_destroy();
            redirect(base_url());
       }
       $keymhs['nim']=$cek;
       $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
       if($mhs->kd_prodi<>'012')
       {
           $this->session->set_flashdata('msg2', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Anda tidak dapat mengukuti pemilihan HMPS Program Studi Sistem Informasi. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }
       $key2['nim']=$cek;
       $key2['periode']='2019-2020';
       $data2=$this->Akademika_model->get_row_selected('registrasi_pemilih_hmps',$key2);
       if (empty($data2))
       {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Anda belum bisa memilih, Silahkan Registrasi ke Panitia Pemilihan HMPS dan BEM. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }else{
          
      // $sql="select calon_hmps.nim,calon_hmps.no_calon,calon_hmps.nm_calon,mahasiswa.foto,mahasiswa.nm_mahasiswa,periode from calon_hmps,mahasiswa where mahasiswa.nim=calon_hmps.nim and calon_hmps.periode='2019-2020'";
    //    $data['list'] = $this->db->query($sql)->result();
     //   $this->load->view('mahasiswa/list_calon_hmps', $data);
        $data='';
         $this->template->load($this->view, 'mahasiswa/pin_pemilih_hmps', $data);
       }
       
   }
   function fpin_bem()
   {
      echo "pemilihan tertutup";
   }
   function  fpin_bem2()
   {
       // $key='2frk';
       $cek = $this->session->userdata('userid');
       if(empty($cek))
       {
            $this->session->sess_destroy();
            redirect(base_url());
       }
       $keyvote['nim']=$cek;
       $vote=$this->Akademika_model->get_row_selected('vote_bem',$keyvote);
       if(empty($vote))
       {
       $keymhs['nim']=$cek;
       $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
       if($mhs->kd_prodi<>'012' and $mhs->kd_prodi<>'022')
       {
           $this->session->set_flashdata('msg2', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Anda tidak dapat mengukuti pemilihan BEM FTI. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }
       $key2['nim']=$cek;
       $key2['periode']='2019-2020';
       $data2=$this->Akademika_model->get_row_selected('registrasi_pemilih_bem',$key2);
       if (empty($data2))
       {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Anda belum bisa memilih, Silahkan Registrasi ke Panitia Pemilihan HMPS dan BEM. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }else{
          
      // $sql="select calon_hmps.nim,calon_hmps.no_calon,calon_hmps.nm_calon,mahasiswa.foto,mahasiswa.nm_mahasiswa,periode from calon_hmps,mahasiswa where mahasiswa.nim=calon_hmps.nim and calon_hmps.periode='2019-2020'";
    //    $data['list'] = $this->db->query($sql)->result();
     //   $this->load->view('mahasiswa/list_calon_hmps', $data);
        $data='';
         $this->template->load($this->view, 'mahasiswa/pin_pemilih_bem', $data);
       }
       }else
       {
            $sql="select calon_bem.nim,calon_bem.no_calon,mahasiswa.foto,mahasiswa.nm_mahasiswa,periode from calon_bem,mahasiswa where mahasiswa.nim=calon_bem.nim and calon_bem.periode='2019-2020'";
        $data['list'] = $this->db->query($sql)->result();
        $key3['nim']=$cek;
       $key3['periode']='2019-2020';
       $datareg=$this->Akademika_model->get_row_selected('registrasi_pemilih_bem',$key3);
        $data['pin']=$datareg->kunci;
         $this->template->load($this->view, 'mahasiswa/list_calon_bem', $data);
       }
       
   }
   public function pemilihan()
   {
        $tglsekarang =strtotime(date('Y-m-d'));
$jam_sekarang = strtotime(date('H:i:s'));
$jam_pemilihan = strtotime('14:00:20');
$tglpemilihan= strtotime('2019-03-18');
echo $tglsekarang==$tglpemilihan and $jam_pemilihan<=$jam_sekarang; 
echo "<br>";
echo $tglsekarang."<br>".$tglpemilihan;
//$istirahat = strtotime('12:30:00');
//$siang = strtotime('14:00:00');
//$sore = strtotime('15:50:00');
   }
   function fpilih_bem()
   {
      $tglsekarang = strtotime(date('Y-m-d'));
$jam_sekarang = strtotime(date('H:i:s'));
$jam_pemilihan = strtotime('08:00:00');
$tglpemilihan= strtotime('2019-03-18');
if($tglsekarang==$tglpemilihan)
{
    
   
      // $key='2frk';
       $cek = $this->session->userdata('userid');
       if(empty($cek))
       {
            $this->session->sess_destroy();
            redirect(base_url());
       }
       
       $keymhs['nim']=$cek;
       $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
       if($mhs->kd_prodi<>'012' and $mhs->kd_prodi<>'022')
       {
           $this->session->set_flashdata('msg2', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Anda tidak dapat mengukuti pemilihan BEM FTI. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }
       $key2['nim']=$cek;
       $key2['kunci']=$this->input->post('pin',true);
       $key2['periode']='2019-2020';
       $data2=$this->Akademika_model->get_row_selected('registrasi_pemilih_bem',$key2);
       if (empty($data2))
       {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>NO PIN ANDA SALAH. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }else{
           
           $keyvote['nim']=$cek;
           $cek_vote=$this->Akademika_model->get_row_selected('vote_bem',$keyvote);
           if(empty($cek_vote))
           {
                $sql="select calon_bem.nim,calon_bem.no_calon,mahasiswa.foto,mahasiswa.nm_mahasiswa,periode from calon_bem,mahasiswa where mahasiswa.nim=calon_bem.nim and calon_bem.periode='2019-2020'";
        $data['list'] = $this->db->query($sql)->result();
        $data['pin']=$this->input->post('pin',true);
     //   $this->load->view('mahasiswa/list_calon_hmps', $data);
    
         $this->template->load($this->view, 'mahasiswa/list_calon_bem', $data);
           }else
           {
               $sql="select calon_bem.nim,calon_bem.no_calon,mahasiswa.foto,mahasiswa.nm_mahasiswa,periode from calon_bem,mahasiswa where mahasiswa.nim=calon_bem.nim and calon_bem.periode='2019-2020'";
        $data['list'] = $this->db->query($sql)->result();
        $data['pin']=$this->input->post('pin',true);
     //   $this->load->view('mahasiswa/list_calon_hmps', $data);
    
         $this->template->load($this->view, 'mahasiswa/list_calon_bem', $data);
               //$data['vote_bem']=$cek_vote;
               //$this->template->load($this->view, 'mahasiswa/view_vote_bem', $data);
           }
          
      
       }
}else
{
    $this->session->set_flashdata('msg2', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Pemilihan baru bisa dilaksanakan pada Tanggal 18-03-2019 Jam 10:00. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
}
       
   }
   
   
   public function view_vote_bem()
   {
       $cek = $this->session->userdata('userid');
       
       $keyvote['nim']=$cek;
           $cek_vote=$this->Akademika_model->get_row_selected('vote_bem',$keyvote);
           if (empty($cek_vote))
           {
            echo "anda belum memilih...!!!, Segera memilih sebelum jam 14:00";    
           
           }else
           {
               $data['vote_bem']=$cek_vote;
               $this->template->load($this->view, 'mahasiswa/view_vote_bem', $data);
           
           }
   }
   function fpilih_hmps()
   {
      // $key='2frk';
       $cek = $this->session->userdata('userid');
       if(empty($cek))
       {
            $this->session->sess_destroy();
            redirect(base_url());
       }
       $keymhs['nim']=$cek;
       $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
       if($mhs->kd_prodi<>'012')
       {
           $this->session->set_flashdata('msg2', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Anda tidak dapat mengukuti pemilihan HMPS Program Studi Sistem Informasi. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }
       $key2['nim']=$cek;
       $key2['kunci']=$this->input->post('pin',true);
       $key2['periode']='2019-2020';
       $data2=$this->Akademika_model->get_row_selected('registrasi_pemilih_hmps',$key2);
       if (empty($data2))
       {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>NO PIN ANDA SALAH. Terimakasih</p>
					</div>');
					 redirect(base_url().'mahasiswa');
       }else{
           
           $keyvote['nim']=$cek;
           $cek_vote=$this->Akademika_model->get_row_selected('voting_hmps',$keyvote);
           if(empty($cek_vote))
           {
                $sql="select calon_hmps.nim,calon_hmps.no_calon,calon_hmps.nm_calon,mahasiswa.foto,mahasiswa.nm_mahasiswa,periode from calon_hmps,mahasiswa where mahasiswa.nim=calon_hmps.nim and calon_hmps.periode='2019-2020'";
        $data['list'] = $this->db->query($sql)->result();
        $data['pin']=$this->input->post('pin',true);
     //   $this->load->view('mahasiswa/list_calon_hmps', $data);
    
         $this->template->load($this->view, 'mahasiswa/list_calon_hmps', $data);
           }else
           {
               $data['vote_hmps']=$cek_vote;
               $this->template->load($this->view, 'mahasiswa/view_vote_hmps', $data);
           }
          
      
       }
       
   }
   public function vote_hmps() {
     $sms = 0;
     $cek = $this->session->userdata('userid');
    $keymhs['nim']=$cek;
    $mhs=$this->Akademika_model->get_row_selected('mahasiswa', $keymhs);
     $kd_prodi=$mhs->kd_prodi;
            
                $keyvote['nim']=$cek;
                $hasil=$this->Akademika_model->get_row_selected('voting_hmps', $keyvote);
                if(empty($hasil))
                {
                $datax['nim'] = $cek;
                $datax['periode'] = $this->input->post('periode',TRUE);
                //$datax['kunci']= $this->input->post('kunci',TRUE);
                $datax['tgl_pilih'] = date('Y-m-d');
                $datax['no_calon'] = $this->input->post('no_calon',TRUE);
                $datax['kd_prodi'] = $kd_prodi;
               // $this->Akademika_model->save_data('voting_hmps',$data);
              //  $this->db->insert('voting_hmps',$data);
               $this->Akademika_model->save_data('voting_hmps',$datax);
               $sms=1;
                }
               else
               {
                   
                    $sms=0;
               }
          
      echo $sms;
       
    }
    public function vote_bem() {

    echo "pemilihan ditutup";   
    }
    
    function vote_bem2()
    {
         $cek = $this->session->userdata('userid');
        
                $datax['nim'] = $cek;
                $datax['periode'] = $this->input->post('periode',TRUE);
                //$datax['kunci']= $this->input->post('kunci',TRUE);
                $datax['tgl_pilih'] = date('Y-m-d');
                $datax['no_calon'] = $this->input->post('no_calon',TRUE);
                $datax['kd_fak'] = 'FTI';
               // $this->Akademika_model->save_data('voting_hmps',$data);
              //  $this->db->insert('voting_hmps',$data);
                $key['nim']=$cek;
                
               $this->Akademika_model->delete_data('vote_bem',$key);
               $this->Akademika_model->save_data('vote_bem',$datax);
               $sms=1;
      echo $sms;
    
    }
    function berita_acara_ujian($no_daftar)
{
    //$sql_daftar=" from daftar where "
    
    $home_base=$this->session->userdata('home_base');
    $sql="SELECT nm_dosen,pembimbing_ke,jafung,jenis_ujian FROM `daftar`,daftar_judul,pembimbing_skripsi,dosen,jenis_ujian_prodi WHERE daftar.no_daftar_judul=daftar_judul.no_daftar AND daftar_judul.no_daftar=pembimbing_skripsi.no_daftar and pembimbing_skripsi.pembimbing=dosen.kd_dosen and daftar.urutan=jenis_ujian_prodi.urutan and daftar.no_daftar='".$no_daftar."'  order by pembimbing_ke asc ";
    $sql2="select daftar.nim,nm_mahasiswa,judul, kd_tahun_ajaran,no_daftar,tgl_daftar,tgl_ujian,jam,urutan from daftar,mahasiswa where daftar.nim=mahasiswa.nim and no_daftar='".$no_daftar."' ";
    
    $key['kd_prodi']=$home_base;
    $prodi=$this->Prodi_model->get_row_selected('prodi',$key);
    $data['prodi']= $prodi;
    $key2['kd_fak']=$prodi->kd_fak;
   // echo $prodi->kd_fak;
    $data['fakultas']=$this->Prodi_model->get_row_selected('fakultas',$key2);
    
      $data['listpembibming'] = $this->db->query($sql)->result();
       $data['mhs'] = $this->db->query($sql2)->row();
      $key3['no_daftar']=$no_daftar;
      $ujian=$this->Prodi_model->get_row_selected('daftar',$key3);
      if($ujian->urutan=='0')
      {
          $data['ket1']="Dengan nilai hasil ujian proposal (_________) dan dinyatakan Lulus / Tidak Lulus.";
      }
      elseif($ujian->urutan=='1')
      {
           $data['ket1']="Dengan nilai hasil seminar hasil (_________) dan dinyatakan Lulus dengan perbaikan Minor / Mayor.";
      }elseif ($ujian->urutan=='2')
      {
          $data['ket1']="Dengan nilai hasil seminar skripsi (_________) dan dinyatakan Lulus / Tidak Lulus.";
      }
       $this->load->view('prodi/berita_acara_hasil', $data);
    // $this->load-view, 'prodi/list_pembimbing_skripsi', $data);
}
function form_nilai($no_daftar)
{
      $home_base=$this->session->userdata('home_base');
      $sql2="select daftar.nim,nm_mahasiswa,judul, kd_tahun_ajaran,no_daftar,tgl_daftar,tgl_ujian,jam,urutan from daftar,mahasiswa where daftar.nim=mahasiswa.nim and no_daftar='".$no_daftar."' ";
           $hasil=$this->db->query($sql2)->row();
           $data['daftar'] = $hasil;
    
    
    $key['kd_prodi']=$home_base;
    $prodi=$this->Prodi_model->get_row_selected('prodi',$key);
    $data['prodi']= $prodi;
    $key2['kd_fak']=$prodi->kd_fak;
    //echo $prodi->kd_fak;
    $data['fakultas']=$this->Prodi_model->get_row_selected('fakultas',$key2);
           
           if($hasil->urutan=='0')
           {
               $data['judul']='FORM NILAI SEMINAR PROPOSAL';
              $this->load->view('prodi/form_nilai_proposal', $data); 
           }
           if($hasil->urutan=='1')
           {
               $data['judul']='FORM NILAI SEMINAR HASIL';
              $this->load->view('prodi/form_nilai_hasil', $data); 
           }
           if($hasil->urutan=='2')
           {
               $data['judul']='FORM NILAI SEMINAR SKRIPSI';
              $this->load->view('prodi/form_nilai_skripsi', $data); 
           }
           
              
    
}
function lembar_koreksi($no_daftar)
{
      $home_base=$this->session->userdata('home_base');
      $sql2="select daftar.nim,nm_mahasiswa,judul, kd_tahun_ajaran,no_daftar,tgl_daftar,tgl_ujian,jam,urutan from daftar,mahasiswa where daftar.nim=mahasiswa.nim and no_daftar='".$no_daftar."' ";
           $hasil=$this->db->query($sql2)->row();
           $data['daftar'] = $hasil;
    
    
    $key['kd_prodi']=$home_base;
    $prodi=$this->Prodi_model->get_row_selected('prodi',$key);
    $data['prodi']= $prodi;
    $key2['kd_fak']=$prodi->kd_fak;
    //echo $prodi->kd_fak;
    $data['fakultas']=$this->Prodi_model->get_row_selected('fakultas',$key2);
           
           if($hasil->urutan=='0')
           {
               $data['judul']='LEMBAR KOREKSI SEMINAR PROPOSAL';
              $this->load->view('prodi/lembar_koreksi', $data); 
           }
           if($hasil->urutan=='1')
           {
               $data['judul']='LEMBAR KOREKSI SEMINAR HASIL';
              $this->load->view('prodi/lembar_koreksi', $data); 
           }
           if($hasil->urutan=='2')
           {
               $data['judul']='LEMBAR KOREKSI SEMINAR SKRIPSI';
              $this->load->view('prodi/lembar_koreksi', $data); 
           }
           
              
    
}
  public function jadwal_ujian()
        {
             $homebase = $this->session->userdata('home_base');
    $sql1="select DISTINCT daftar.nim,daftar.judul,nm_mahasiswa,tgl_ujian,jam,no_daftar,jenis_ujian,no_daftar_judul,link_draft from daftar,jenis_ujian_prodi,mahasiswa where daftar.kd_prodi='".$homebase."' and jenis_ujian_prodi.urutan=daftar.urutan and daftar.nim=mahasiswa.nim and daftar.status='1' order by tgl_ujian,jam asc";
      $data = $this->db->query($sql1)->result();
      $jadwal=array();
      foreach($data as $row)
      {
          $pembimbing=$this->get_pembimbing($row->no_daftar_judul);
           $penguji=$this->get_penguji($row->no_daftar);
          $datax['tgl_ujian']=date('d F Y', strtotime($row->tgl_ujian));
          $datax['jenis_ujian']=$row->jenis_ujian;
          $datax['link_draft']=$row->link_draft;  
            $datax['jam']=$row->jam;
          $datax['no_daftar']=$row->no_daftar;
          $datax['nim']=$row->nim;
           $datax['nm_mahasiswa']=$row->nm_mahasiswa;
          $datax['judul']=$row->judul;
         $datax['pembimbing']=json_encode($pembimbing);
        
         $datax['penguji']=json_encode($penguji);
          array_push($jadwal,$datax);
      }
    return $jadwal;
     // echo json_encode ($jadwal);
      
}
        public function get_pembimbing($no_daftar)
        {
            $pembimbing=array();
            $filter['no_daftar']=$no_daftar;
            $data=$this->Akademika_model->get_list_selected('vpembimbing_skripsi',$filter);
            foreach($data as $row)
            {
                $datax=$row->pembimbing_ke.'. '.$row->nm_dosen;
                
                   array_push($pembimbing,$datax);
            }
            return $pembimbing;
        }
        public function get_penguji($no_daftar)
        {
            $penguji=array();
            $filter['no_daftar']=$no_daftar;
            $data=$this->Akademika_model->get_list_selected('vpenguji_skripsi',$filter);
            foreach($data as $row)
            {
                $datax=$row->penguji_ke.'. '.$row->nm_dosen;
                 
                   array_push($penguji,$datax);
            }
            return $penguji;
        }
  
    function get_jadwal_ujian($nim)
    {
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT jenis_ujian, tgl_ujian,jam,judul from daftar,jenis_ujian_prodi where daftar.urutan=jenis_ujian_prodi.urutan and nim='".$nim."' and kd_tahun_ajaran='".$kd_tahun_ajaran."'";
        $output = $this->db->query($sql)->result();
        //echo json_encode($output);
        return $output;
    }
    
    function pilihta()
    {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
 

            $datax['listta'] = $this->Mahasiswa_model->get_all('thnajaran');
             


            //   $this->load->view('bak/dkabak',$datax);
            $this->template->load($this->view, 'mahasiswa/fpilihta', $datax);
        
    }
    
    //model set ta
    function setta()
    {
        $kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
        $sess_data['kd_tahun_ajaran']=$kd_tahun_ajaran;
            $this->session->set_userdata($sess_data);
            redirect(base_url()); 
    }
    
    //modul dosen
    function ldosen()
    {
          
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
        $home_base= $this->session->userdata('home_base');
        
        if ($level == "mahasiswa") {
            $key['kd_prodi']=$home_base;
            $key['aktif']='Ya';
            
            $data['listdosen']=$this->Mahasiswa_model->get_list_selected('dosen',$key);
             $this->template->load($this->view, 'mahasiswa/list_dosen', $data);
            
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
        
    }
    public function cek_biodata($nim)
    {
         
        $key['nim']=$nim;
        $data=$this->Mahasiswa_model->get_row_selected('mahasiswa',$key);
        $no_hp=$data->no_hp;
        $nm_mahasiswa=$data->nm_mahasiswa;
        $tempat_lahir=$data->tempat_lahir;
        $tgl_lahir=$data->tgl_lahir;
        $nik=$data->NIK;
        $jalur_masuk=$data->jalur_masuk;
        $email=$data->email;
        $jns_pendaftaran=$data->jns_pendaftaran;
        $kelurahan=$data->kelurahan;
        $id_wilayah_kec=$data->id_wilayah_kec;
        $terima_kps=$data->terima_kps;
        $no_hp_orang_tua=$data->no_hp_orang_tua;
        $nm_ayah=$data->nm_ayah;
        $email=$data->email;
        $nm_ibu=$data->nm_ibu;
        $penghasilan_ayah=$data->penghasilan_ayah;
        $penghasilan_ibu=$data->penghasilan_ibu;
        $npsn=$data->npsn;
       
        if($nm_mahasiswa=='' or Strlen($nm_mahasiswa)<2){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Nama Mahasiswa tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($tempat_lahir=='' or Strlen($tempat_lahir)<4){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Tempat Lahir tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($tgl_lahir==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Tanggal Lahir tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($nik==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> NIK tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
             
             
             
        if($no_hp=='' or Strlen($no_hp)<11){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap. No HP mahasiswa tidak boleh kosong atau dibawah 11 digit</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($jalur_masuk=='' ){ $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap. Jalur Masuk Tes tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($email=='' ){ $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap. Email tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($nm_ayah==''){ $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap. Nama Ayah tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');;}
        if($nm_ibu==''){ $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap.Nama Ibu tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($penghasilan_ayah==''){ $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap. Penghasilan Ayah tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($penghasilan_ibu==''){ $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Untuk melakukan penawaran/krs online isi terlebih dahulu biodata anda dengan lengkap. Penghasilan Ibu tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
         if($email==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Input email yang aktif, ini untuk kebutuhan reset password.</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($npsn==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> NPSN tidak boleh kosong</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($terima_kps==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Terima KPS tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($id_wilayah_kec==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Kecamatan harus, tidak boleh kosong </p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($kelurahan==''){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Kelurahan tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        if($jns_pendaftaran=='' or $jns_pendaftaran=='0'){
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Jenis Pendaftaran tidak boleh kosong atau diisi sembarangan</p>
					</div>');
             redirect(base_url() . 'mahasiswa/fmahasiswa/');}
        
    }
    //REKOMENDASI-REKOMENDASI
    
    
    function rec_proposal()
    {
        $key['nim']=$this->session->userdata['userid'];
        $key_prodi['kd_prodi']=$this->session->userdata('home_base');
        $data['mahasiswa']=$this->Mahasiswa_model->get_row_selected('mahasiswa',$key);
        $prodi=$this->Mahasiswa_model->get_row_selected('prodi',$key_prodi);
         $key_fak['kd_fak']=$prodi->kd_fak;
        $data['fakultas']=$this->Mahasiswa_model->get_row_selected('fakultas',$key_fak);
         $data['prodi']=$prodi;
        

        
        
         $this->load->view('mahasiswa/rekomendasi_proposal', $data);
    }
    function rec_hasil()
    {
        $key['nim']=$this->session->userdata['userid'];
        $key_prodi['kd_prodi']=$this->session->userdata('home_base');
        $data['mahasiswa']=$this->Mahasiswa_model->get_row_selected('mahasiswa',$key);
        $prodi=$this->Mahasiswa_model->get_row_selected('prodi',$key_prodi);
         $key_fak['kd_fak']=$prodi->kd_fak;
        $data['fakultas']=$this->Mahasiswa_model->get_row_selected('fakultas',$key_fak);
         $data['prodi']=$prodi;
        

        
        
         $this->load->view('mahasiswa/rekomendasi_hasil', $data);
    }
    function rec_skripsi()
    {
        $key['nim']=$this->session->userdata['userid'];
        $key_prodi['kd_prodi']=$this->session->userdata('home_base');
        $data['mahasiswa']=$this->Mahasiswa_model->get_row_selected('mahasiswa',$key);
        $prodi=$this->Mahasiswa_model->get_row_selected('prodi',$key_prodi);
         $key_fak['kd_fak']=$prodi->kd_fak;
        $data['fakultas']=$this->Mahasiswa_model->get_row_selected('fakultas',$key_fak);
         $data['prodi']=$prodi;
        

        
        
         $this->load->view('mahasiswa/rekomendasi_skripsi', $data);
    }
    //modul api for apul
    
    //modul skripsi
    //0. usulan
    
    function nousuljudul(){
		$inisial="J";
		$tabel="daftar_judul";
		$home_base=$this->session->userdata('home_base');
		$kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
		$query="select max(right(no_daftar,4)) as idmax from ".$tabel." where kd_tahun_ajaran=".$kd_tahun_ajaran." and kd_prodi=".$home_base."";
		$q=$this->db->query($query);
		$kd="";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$temp=($k->idmax)+1;
				
				$kd= sprintf('%04s',$temp);
			}
		}else{
			$kd="0001";
		}
		return $inisial.$home_base.$kd_tahun_ajaran.$kd;

	}
    function ajudul()
	{
	    	$kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
		$home_base=$this->session->userdata('home_base');
	
	
		
		$aksi=$this->input->post('aksi',true);
		
		$hdata['kd_tahun_ajaran']=$kd_tahun_ajaran;
		$hdata['tgl_daftar']=date('Y-m-d');
		$hdata['nim']=$this->session->userdata('userid');
		$hdata['judul']=$this->input->post('judul',true);
		$hdata['deskripsi']=$this->input->post('deskripsi',true);
		$hdata['topik']='';
		$hdata['kd_prodi']=$home_base;
		$hdata['status']="Usul";
		
	    if($aksi=='Edit')
		{
		    $key['no_daftar']=$this->input->post('no_daftar',true);
    		try {
    		    $this->db->update('daftar_judul', $hdata,$key);
    			          
    
    		} catch (Exception $e) {
			echo "terjadi kesalahan saat penyimpanan, periksa kembali data yang diinput apa sudah benar...?".$e;
	    	}
		}
		else{
            try {
                	$hdata['no_daftar']=$this->nousuljudul();
			$this->db->insert('daftar_judul', $hdata);
			          

    		} catch (Exception $e) {
    			echo "terjadi kesalahan saat penyimpanan, periksa kembali data yang diinput apa sudah benar...?".$e;
    		}
		}
		
		   redirect(base_url().'mahasiswa/lusulan');
		
	}
	
	function ejudul($no_daftar)
	{
	     
	    $key['no_daftar']=$no_daftar;
	    $data['aksi']='Edit';
       $judul=$this->Mahasiswa_model->get_row_selected('daftar_judul',$key);
        $data['judul']=$judul->judul;
         $data['deskripsi']=$judul->deskripsi;
         $data['no_daftar']=$judul->no_daftar;
         
         $this->template->load($this->view, 'mahasiswa/form_usulan_judul', $data);
	}
		function djudul($no_daftar)
	{
	     
	    $key['no_daftar']=$no_daftar;
	  
       $this->Mahasiswa_model->delete_data('daftar_judul',$key);
      
          redirect(base_url().'mahasiswa/lusulan');
	}
	

    function lusulan()
    {
        
        
        $key['nim']=$this->session->userdata['userid'];
        $data['list']=$this->Mahasiswa_model->get_list_selected('daftar_judul',$key);
        
         $this->template->load($this->view, 'mahasiswa/list_usulan_judul', $data);
    }
    //1. lihat pembimbing
    
    function lps($no_daftar)
    {
        
        $data['list']=$this->get_ps($no_daftar);
         $this->template->load($this->view, 'mahasiswa/lps', $data);
    }
    
    //perbaikan
    function fberkas_ujian($no_daftar)
    {
        
        $data['kertas']='A4';
        $data['posisi']='P';
        $data['no_daftar']=$no_daftar;
        $data['jarak_antar_baris']='7';
        
        
         $this->template->load($this->view, 'mahasiswa/fberkas_ujian', $data);
    }
    
    function get_berkas_ujian($no_daftar) {
        $sql = "SELECT `daftar`.`no_daftar`, `prodi`.`nm_prodi` FROM `daftar` LEFT JOIN `prodi` ON `daftar`.`kd_prodi` = `prodi`.`kd_prodi` WHERE `daftar`.`no_daftar` = '".$no_daftar."'";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
    }
    
    function berkas_ujian() {
        
        $kertas=$this->input->post('kertas',true);
        $posisi=$this->input->post('posisi',true);
        $jumlah=$this->input->post('jumlah',true);
        $jarak_antar_baris=$this->input->post('jarak_antar_baris',true);
        $no_daftar= $this->input->post('no_daftar',true);
        $jumlah_tambahan= $this->input->post('jumlah',true);
        $hasil = $this->get_berkas_ujian($no_daftar);
        
        $this->load->library('cfpdf');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10, 10);
        $pdf->SetFont('times', '', 12);

        $gambar = "assets/image/usnx.gif";
        $pdf->image($gambar, 10, 10, 30);
        
        $pdf->SetFont('times', '', 13);
        $pdf->Cell(25);
        $pdf->Cell(0, 5,  $this->config->item('kementerian'), 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(20);
        $pdf->Cell(0, 5, 'UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 5,$hasil->nm_prodi, 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 5, 'Alamat: Jl. Pemuda No.339 Kolaka Sulawesi Tenggara 93517', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'Telp. (0405) 23321, Fax. (0405) 23321', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'email: rektorat@usn.ac.id; website: https://usn.ac.id', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(190, 1, '', 'B', 1, 'L');
        $pdf->ln(5);
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(0, 5, 'DAFTAR HADIR DAN BERITA ACARA', 0, 1, 'C');
        $pdf->Cell(0, 5, 'UJIAN AKHIR SEMESTER', 0, 0, 'C');
        
        $pdf->SetFont('arial', '', 10);
        $pdf->ln(7);
        //BARIS PERTAMA
        //$pdf->Text(10,40,"ini adalah teks dalam pdf fpdf",0);
        //$ambil1 = $hasil2->kd_tahun_ajaran;
        //$ambil2 = substr($ambil1,4);
        
        //$ambil3 = $hasil2->kd_tahun_ajaran;
        //$ambil4 = substr($ambil1,0,4);
        //$tahun  = $ambil4 + 1;
        //$pdf->MultiCell(190, 6, 'Pada hari ini ................... tanggal ...... bulan ............... tahun .......... telah diselenggarakan Ujian Akhir Semester '.$smt.' Tahun Akademik '.$ambil4.'/'.$tahun.'.');
        $pdf->Cell(40, 5, 'Nama Matakuliah', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        //$pdf->Cell(50, 5, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(5);
        //BARIS KEDUA
        $pdf->Cell(40, 5, 'SKS / Kelas', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        //$pdf->Cell(50, 5, $hasil2->sks. ' SKS / '.$hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(5);
         $pdf->Cell(40, 5, 'Program Studi', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        //$pdf->Cell(50, 5, $hasil2->nm_prodi, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(3);
         //BARIS KEDUA
       
        $pdf->ln(5);
        //tabel
         $pdf->Cell(10, 10, 'NO', 1, 0, 'C');
        $pdf->Cell(25, 10, 'NIM', 1, 0, 'C');
        $pdf->Cell(70, 10, 'NAMA MAHASISWA', 1, 0, 'C');
        $pdf->Cell(30, 10, 'PARAF', 1, 0, 'C');
        $pdf->Cell(55, 10, 'NILAI AKHIR', 1, 0, 'C');
        
        $pdf->ln();

        $no=1;
        
        
        $namaPDF = 'Berita Acara Ujian ';
        $pdf->Output($namaPDF,'I');
    }
    //modul olah daftar ujian
    function list_ujian()
    {
        
        $data['list']=$this->get_list_ujian();
         $this->template->load($this->view, 'mahasiswa/listujian', $data);
    }
    
    function daftar_ujian()
    {
        
	     $key['nim']=$this->session->userdata['userid'];
	     //$key['status']="Judul_Diterima";
	    // $key['status']="Usul";
        $row=$this->Mahasiswa_model->get_row_selected('daftar_judul',$key);
	    if($row)
	  {

        $data['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
	    $key2['kd_prodi']=$this->session->userdata('home_base');
      	$data['no_daftar_judul']= $row->no_daftar;
	    $data['judul']=$row->judul;
      	$data['list_jenis_ujian']=$this->Mahasiswa_model->get_list_selected('jenis_ujian_prodi',$key2);
        $this->template->load($this->view,'mahasiswa/daftar_ujian',$data);
	  }
	  else
	  {
	      echo "Judul penelitian anda belum terdaftar, Silahkan ajukan dulu ke program studi. Terimakasih";
	  }
    
    }

    function list_penguji($no_daftar)
    {
        
        $sql="select penguji_ke,nm_dosen,jafung,penguji.penguji,nidn from penguji,dosen where penguji.penguji=dosen.kd_dosen and penguji.no_daftar='".$no_daftar."'";
        $data['list'] = $this->db->query($sql)->result();
        $this->template->load($this->view, 'mahasiswa/listpenguji', $data);
        // $this->template->load($this->view,'mahasiswa/',$data);
        
    }
    function list_jadwal_ujian($no_daftar)
    {
        
        $sql="select from daftar where daftar.no_daftar='".$no_daftar."'";
        $data['list'] = $this->db->query($sql)->result();
        $this->template->load($this->view, 'mahasiswa/listpenguji', $data);
        // $this->template->load($this->view,'mahasiswa/',$data);
        
    }
   function get_last_ujian()
    {
        
            $nim=$this->session->userdata('userid');
           
             
        $sql="select * from daftar where nim='".$nim."' and status='3' order by urutan desc" ;

         $output = $this->db->query($sql)->result();
        
         
   return $output;


       
        
        
    }
 public function get_last_data()
    {
        $awal=$this->input->post('urutan',TRUE);
        if($awal==0)
        {
            $key['nim']=  $this->session->userdata('userid');
            $key['status']= 'Judul_Diterima';  
            $hasil=$this->Mahasiswa_model->get_row_selected('daftar_judul',$key);
             
        }elseif($awal>0)
        {
            $sebelumnya=$awal-1;
            $key['urutan']=$sebelumnya;
            $key['nim']=  $this->session->userdata('userid');
            $key['status']= 'Diterima';  
            $hasil=$this->Mahasiswa_model->get_row_selected('daftar',$key);
        }
        


       
        
        
        echo json_encode($hasil);
    }
    
    function edit_ujian($no_daftar)
    {
        
        $keyprodi['kd_prodi']=$this->session->userdata['home_base'];
        $data['listjnsujian']=$this->Mahasiswa_model->get_list_selected('jenis_ujian_prodi',$keyprodi);
        
        $key['no_daftar']=$no_daftar;
        $hasil=$this->Mahasiswa_model->get_row_selected('daftar',$key);
        $data['no_daftar']=$hasil->no_daftar;
         $data['no_daftar_judul']=$hasil->no_daftar_judul;
        $data['tgl_daftar']=$hasil->tgl_daftar;
        $data['judul']=$hasil->judul;
        $data['urutan']=$hasil->urutan;
         $data['kd_tahun_ajaran']=$hasil->kd_tahun_ajaran;
         $data['link']=$hasil->link_draft;
         $this->template->load($this->view, 'mahasiswa/edaftar_ujian', $data);
        
    }
     function update_ujian()
{
	    $no_daftar=$this->input->post('no_daftar',true);
		$hdata['no_daftar']=$this->input->post('no_daftar',true);
		$hdata['tgl_daftar']=date('Y-m-d');
		$hdata['no_daftar_judul']=$this->input->post('no_daftar_judul',true);
	   
        $hdata['urutan']=$this->input->post('jenis_ujian',true);
        $hdata['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
        $hdata['kd_prodi']=$this->session->userdata('home_base');
        $hdata['nim']=$this->session->userdata('userid');
      
        $hdata['judul']=$this->input->post('judul',true);
       $keydaftar['no_daftar']=$no_daftar;
       
           
                $config = array(
                'allowed_types' => 'pdf',
                'upload_path' => $this->naskah_path,
                'max_size' => 3000,
                'file_name' => $no_daftar
            );
            $lokasi=$this->naskah_path;
            $lokasi_url=$this->naskah_path_url.$no_daftar.'.pdf';
            $file=$lokasi.'/'.$no_daftar.'.pdf';
            if(file_exists($file))
            {
                unlink($lokasi.'/'.$no_daftar.'.pdf');
            }
           
                $this->load->library('upload', $config);
            
              
              
                
                if($this->upload->do_upload("link_draft"))
                {
                    
                      $hdata['link_draft']=$lokasi_url;
                    $this->Mahasiswa_model->update_data('daftar', $hdata,$keydaftar);
                    
                     redirect(base_url().'mahasiswa/list_ujian');
                }else
                {
                     $this->Mahasiswa_model->update_data('daftar', $hdata,$keydaftar);
                        redirect(base_url().'mahasiswa/list_ujian');
                }
             
                
            
           


    }
    function test()
    {
        $this->load->helper('file');
        $file=$this->input->post('link_draft');
        if($file)
        {
            echo 'tidak kosong';
        }else
        {
            echo 'kosong';
        }
    }
    function simpan_ujian()
{
    $hdata['link_draft'] ='';
		$urutan=$this->input->post('jenis_ujian',true);
		$key['urutan']=$urutan;
		$ju=$this->Mahasiswa_model->get_row_selected('jenis_ujian_prodi',$key);
		$inisial=$ju->kode;
		$hdata['no_daftar']=$this->noujian($inisial);
		$hdata['tgl_daftar']=date('Y-m-d');
		$hdata['no_daftar_judul']=$this->input->post('no_daftar_judul',true);
		$nim=$this->input->post('nim',true);
        $hdata['status']='0';
        $hdata['urutan']=$urutan;
        $hdata['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran',true);
        $hdata['kd_prodi']=$this->session->userdata('home_base');
        $hdata['nim']=$this->session->userdata('userid');
       $file='';
        $hdata['judul']=$this->input->post('judul',true);
        $no_daftar=$this->noujian($inisial);
       
      
            
            $lokasi=$this->naskah_path;
            $lokasi_url=$this->naskah_path_url.$no_daftar.'.pdf';
            
             $nama = ($this->input->post('npsn'));
		$config['upload_path']   = $lokasi;
        $config['allowed_types'] = 'pdf|doc|docx'; //mencegah upload backdor
        $config['file_name']     = $no_daftar; 
        $config['overwrite']	 = true;
        $this->upload->initialize($config);
         if (!empty($_FILES['userfile']['name'])) 
         {
             if ($this->upload->do_upload('userfile')){
        		    $image = $this->upload->data();
        			$hdata['link_draft'] = $image['file_name'];
        	}
         }
            
			$this->db->insert('daftar', $hdata);
        redirect('mahasiswa/list_ujian');

      
    }
function noujian($inisial){
		$inisialx=$inisial;
		$tabel="daftar";
		$home_base=$this->session->userdata('home_base');
		$kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
	//	$kd_tahun_ajaran='20171';
		
		$query="select max(right(no_daftar,4)) as idmax from ".$tabel." where kd_tahun_ajaran=".$kd_tahun_ajaran." and kd_prodi=".$home_base."";
		$q=$this->db->query($query);
		$kd="";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$temp=($k->idmax)+1;
				
				$kd= sprintf('%04s',$temp);
			}
		}else{
			$kd="0001";
		}
		return $inisialx.$home_base.$kd_tahun_ajaran.$kd;
	}
public function get_dosen_pa()
{
        $nim = $this->session->userdata('userid');
    
    $sql="SELECT nm_dosen FROM `pad`,pah,dosen where nim='".$nim."'  and pah.no_pa=pad.no_pa and pah.kd_dosen=dosen.kd_dosen";
        $hasil = $this->db->query($sql)->row();
        echo json_encode ($hasil);
       //return $hasil;
}

    function delete_ujian($id)
    {
        $key['no_daftar']=$id;
        $this->Mahasiswa_model->delete_data('daftar',$key);
        redirect(base_url().'mahasiswa/list_ujian');
    }
    function get_list_ujian()
    {
        
        $nim = $this->session->userdata('userid');
    
        $sql="select no_daftar,tgl_daftar,judul,link_draft,jenis_ujian,tgl_ujian,jam,daftar.status,daftar.lulus,daftar.nilai from daftar,mahasiswa,jenis_ujian_prodi where daftar.nim=mahasiswa.nim and daftar.urutan=jenis_ujian_prodi.urutan and daftar.kd_prodi=jenis_ujian_prodi.kd_prodi and daftar.nim='".$nim."'";
        $hasil = $this->db->query($sql)->result();
        //echo json_encode ($hasil);
       return $hasil;
    }
    private function get_ps($no_daftar)
    {
        $sql="select no_daftar,pembimbing_ke, pembimbing, nm_dosen,nidn,kd_dosen,jafung from pembimbing_skripsi,dosen where pembimbing_skripsi.pembimbing=dosen.kd_dosen and no_daftar='".$no_daftar."'";
        $hasil = $this->db->query($sql)->result();
       // echo json_encode ($hasil);
       return $hasil;
    }
    //2. form usulan judul penelitian
    
    function fusul_judul()
    {
        
        $data['judul']='';
         $data['aksi']='Input';
        $data['deskripsi']='';
        $data['no_daftar']='';
        
         $this->template->load($this->view, 'mahasiswa/form_usulan_judul', $data);
    }
    //print biodata
    
    function preview_biodata($nim)
    {
        
        $id['nim']=$nim;
        $data['mahasiswa'] = $this->Prodi_model->get_row_selected('mahasiswa',$id);
        $data['fakultas'] = $this->Prodi_model->get_fakultas_by_nim($nim);
        
       $this->load->view('laporan/biodata_mahasiswa', $data);    
    }
    function print_biodata($nim) {

        $id['nim']=$nim;
        $hasil = $this->Prodi_model->get_row_selected('mahasiswa',$id);

        
        $hasil2 = $this->Prodi_model->get_fakultas_by_nim($nim);

        $this->load->library('cfpdf');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(15, 10, 10, 10);
        $pdf->SetFont('times', '', 14);

        $gambar = "assets/image/usnx.gif";
        $pdf->image($gambar, 15, 10, 30);

        $pdf->Cell(25);
        $pdf->Cell(0, 5,  $this->config->item('kementerian'), 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(20);
        $pdf->Cell(0, 5, 'UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(0, 5, $hasil2->nm_fak, 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 5, 'Alamat: Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'Telp. (0405) 23321, Fax. (0405) 23321', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'Email: rektorat@usn.ac.id; Website: https://usn.ac.id', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(180, 1, '', 'B', 1, 'L');
        $pdf->Cell(180, 1, '', 'B', 0, 'L');
        $pdf->ln(3);
        $pdf->Cell(0, 5, 'BIODATA MAHASISWA', 0, 0, 'C');
        $pdf->ln(5);
        $prodi = "PROGRAM STUDI " . $hasil2->nm_prodi;
        $pdf->Cell(0, 5, $prodi, 0, 0, 'C');
        $pdf->ln(10);
        $pdf->SetFont('times', '', 20);
        $pdf->Cell(80, 8, 'IDENTITAS MAHASISWA', 0, 0, 'L');
        $pdf->ln(10);
        $pdf->SetFont('times', '', 14);
        //BARIS I

        //$pdf->image($gambari, 160, 45, 30);
        $pdf->Cell(80, 8, 'NIM', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(10, 8, $hasil->nim, 0, 0, 'L');

        $pdf->ln(8);
                //BARIS II
        $pdf->Cell(80, 8, 'NAMA MAHASISWA', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(10, 8, $hasil->nm_mahasiswa, 0, 0, 'L');
        $pdf->ln(8);
                        //BARIS III
        $pdf->Cell(80, 8, 'TEMPAT / TGL LAHIR', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(10, 8, $hasil->tempat_lahir.'/'.$hasil->tgl_lahir, 0, 0, 'L');
        $pdf->ln(8);
                                //BARIS III
        $pdf->Cell(80, 8, 'ALAMAT', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->jalan, 0, 0, 'L');
        $pdf->ln(8);
                       //BARIS VI
        $pdf->Cell(80, 8, 'NO HP', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->no_hp , 0, 0, 'L');
        $pdf->ln(8);
                        //BARIS IV
        $pdf->Cell(80, 8, 'NIK', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->NIK, 0, 0, 'L');
        $pdf->ln(8);
                        //BARIS V
        $pdf->Cell(80, 8, 'AGAMA', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->agama, 0, 0, 'L');
        $pdf->ln(8);
                                //BARIS VI
        $pdf->Cell(80, 8, 'JENIS KELAMIN', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->jns_kelamin, 0, 0, 'L');
        $pdf->ln(8);
                                        //BARIS VI
        $pdf->Cell(80, 8, 'SEKOLAH ASAL', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->nm_sma , 0, 0, 'L');
        $pdf->ln(8);
        //BARIS VI
        $pdf->Cell(80, 8, 'TAHUN TAMAT SMA', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->thn_tamat_sma , 0, 0, 'L');
        $pdf->ln(8);
        //BARIS VI
        $pdf->Cell(80, 8, 'JALUR MASUK ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->jalur_masuk , 0, 0, 'L');
        $pdf->ln(12);
        $pdf->SetFont('times', '', 20);
        $pdf->Cell(80, 8, 'IDENTITAS ORANG TUA', 0, 0, 'L');
        $pdf->ln(10);
        $pdf->SetFont('times', '', 14);
                //BARIS VI
        $pdf->Cell(80, 8, 'NAMA AYAH ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->nm_ayah , 0, 0, 'L');
        $pdf->ln(8);
                //BARIS VI
        $pdf->Cell(80, 8, 'PEKERJAAN AYAH ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->pekerjaan_ayah , 0, 0, 'L');
        $pdf->ln(8);
                //BARIS VI
        $pdf->Cell(80, 8, 'PENGHASILAN/BULAN ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->penghasilan_ayah , 0, 0, 'L');
        $pdf->ln(8);
        //ibu
                $pdf->Cell(80, 8, 'NAMA IBU ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->nm_ibu , 0, 0, 'L');
        $pdf->ln(8);
                //BARIS VI
        $pdf->Cell(80, 8, 'PEKERJAAN IBU ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->pekerjaan_ibu , 0, 0, 'L');
        $pdf->ln(8);
                //BARIS VI
        $pdf->Cell(80, 8, 'PENGHASILAN/BULAN ', 0, 0, 'L');
        $pdf->Cell(2, 8, ':', 0, 0, 'C');
        $pdf->Cell(100, 8, $hasil->penghasilan_ibu , 0, 0, 'L');
        $pdf->ln(20);

        //tabel
       
//buat tanggal
        

        $tgl = date('d-M-Y');
        $pdf->Cell(130, 5, 'KOLAKA,', 0, 0, 'R');
        $pdf->Cell(140, 5, $tgl, 0, 0, 'L');
        $pdf->ln(40);
        $pdf->Cell(140, 5, 'MAHASISWA,', 0, 0, 'R');



        $pdf->Output();
    }
    
	//modul upload foto
    function fuploadfoto() {
        $level = $this->session->userdata('level');
        $cek = $this->session->userdata('userid');
        $key['nim']=$cek;
        $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$key);
        if ($level == "mahasiswa") {
            $datax['nim']=$cek;
            $datax['foto']=$mhs->foto;
            $this->template->load($this->view, 'mahasiswa/uploadfoto', $datax);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
     function uploadfoto() {
     $nim=$this->input->post('nim');
    
    $filter['nim']=$nim;
                $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$filter);
                
                unlink('doc/foto'.'/'.$mhs->foto);
          $config['upload_path']   = 'doc/foto/';
        $config['allowed_types'] = 'jpg'; //menceh upload bagackdor
        $config['file_name']     = $nim; 
        $config['overwrite']	 = true;
        
        $this->upload->initialize($config);
         if (!empty($_FILES['userfile']['name'])) 
         {
             if ($this->upload->do_upload('userfile')){
        		    $image = $this->upload->data();
        			$data['foto'] = $image['file_name'];
        		     $key['nim']=$nim;
		            $this->Akademika_model->update_data('mahasiswa',$data,$key);
                }
         }
        
            

       redirect('mahasiswa');
    
     }
   
    //modul dashboard
    function get_dasboard() {
        
    }
	
	
   private function get_jadwal($nim,$kd_tahun_ajaran)
    {
        $sql="SELECT
  `rencanastudid`.`kd_jadwal`, `rencanastudih`.`kd_tahun_ajaran`,
  `jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`,matakuliah.semester_ke,jadwal.kapasitas,
  `matakuliah`.`sks`, `rencanastudih`.`nim`, `thari`.`no`,
  `rencanastudid`.`no_krs`, `jadwal`.`kd_ruang`, `jadwal`.`kelas`,group_wa
FROM
  `rencanastudih` INNER JOIN
  `rencanastudid` ON `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs`
  INNER JOIN
  `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudid`.`kd_jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN
  `thari` ON `jadwal`.`hari` = `thari`.`hari`
WHERE
  `rencanastudih`.`kd_tahun_ajaran` = '".$kd_tahun_ajaran."' and 
  `rencanastudih`.`nim` = '".$nim."' order by no asc";
     $output = $this->db->query($sql)->result();
//echo json_encode($output);
   return $output;
    }

    //modul password
    function editPass() {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $datauser['userid'] = $cek;
            $row = $this->Mahasiswa_model->get_row_selected('user', $datauser);
            $level = $row->level;
            if ($level == "mahasiswa") {
                
            }
        }
    }

    //modul mahasiswa
    function umahasiswa() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
//$st=$this->session->userdata('userid');
            $datauser['userid'] = $cek;
            $row = $this->Mahasiswa_model->get_row_selected('user', $datauser);
            $level = $row->level;
            if ($level == "mahasiswa") {
                $key['nim'] = $this->input->post('nim', TRUE);
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
                $data['terima_kps'] = 0;
                $this->Mahasiswa_model->update_data('mahasiswa', $data, $key);
                $keyuser['userid']=$cek;
                $datauser['email']=$this->input->post('email', TRUE);
                $this->Mahasiswa_model->update_data('user', $datauser, $keyuser);
				
 $config = array(
                'allowed_types' => 'jpg|png|bmp',
                'upload_path' => $this->gallery_path,
                'max_size' => 2000,
                'file_name' => url_title($this->input->post('fotox'))
            );

            $this->load->library('upload', $config);
            $this->upload->do_upload();
            $this->cek_biodata($cek);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
 redirect(base_url().'mahasiswa/fmahasiswa');
    }

    function fmahasiswa() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
		$level = $this->session->userdata('level');
            if ($level == "mahasiswa") {
                $key['nim'] = $cek;
                $mhs= $this->Mahasiswa_model->get_row_selected('mahasiswa', $key);
                $data['mhs'] =$mhs;
				$key2['aktif'] ='Ya';
                $data['listjalur'] = $this->Mahasiswa_model->get_list_selected('mtjalur_masuk', $key2);
				$data['listpengortu']=$this->Mahasiswa_model->get_all('mgolongan_penghasilan');
                $data['listagama']=$this->Mahasiswa_model->get_all('tagama');
                $data['listjenjang_pendidikan']=$this->Mahasiswa_model->get_all('mjenjang_pendidikan');
                $data['listjenis_tinggal']=$this->Mahasiswa_model->get_all('mjenis_tinggal');
                $data['listpropinsi']=$this->Mahasiswa_model->get_all('propinsi');
                $keykab['kd_kab']=$mhs->id_wilayah_kab;
                $keykec['kd_kec']=$mhs->id_wilayah_kec;
                $data['listkabupaten']=$this->Mahasiswa_model->get_list_selected('kabupaten',$keykab);
                $data['listkecamatan']=$this->Mahasiswa_model->get_list_selected('kecamatan',$keykec);
                $keysekolah['npsn']=$mhs->npsn;
                 $data['sekolah']=$this->Mahasiswa_model->get_row_selected('sekolah',$keysekolah);
                 $data['listkecamatan']=$this->Mahasiswa_model->get_list_selected('kecamatan',$keykec);
                 
                 
                 $data['listjns_pembiayaan']=$this->Mahasiswa_model->get_all('mjenis_pembiayaan');
                 $data['listnegara']=$this->Mahasiswa_model->get_all('negara');
                 
                 
				$this->template->load($this->view, 'mahasiswa/fmahasiswa', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        
    }
   public function get_kab(){
        $id['kd_prop']=$this->input->post('id');
        $data=$this->Mahasiswa_model->get_list_selected('kabupaten',$id);
        echo json_encode($data);
    }
    public function get_kec(){
        $id['kd_kab']=$this->input->post('id');
        $data=$this->Mahasiswa_model->get_list_selected('kecamatan',$id);
        echo json_encode($data);
    }
    public function get_sekolah_by_kec()
    {
        $key['kd_wilayah_kec']=$this->input->post('id', TRUE);
        // $key['kd_wilayah_kec']='201604';
        
        $sekolah=$this->Mahasiswa_model->get_list_selected('sekolah',$key);
        echo json_encode($sekolah);
    }
     public function get_kecamatan_by_name()
    {
        $key=$this->input->post('id', TRUE);
       // $nm_sekolah='%'.$nm_sekolah2.'%';
       $sql="select kd_kec,nm_kecamatan from kecamatan where nm_kecamatan like '%".$key."%'";
        $data = $this->db->query($sql)->result();
        echo json_encode($data);
        
       //echo '<table id="lookup3" class="table tblsekolah"><tr><td>NPSN</td><td>Nama Sekolah</td><td>Pilih</td></tr>';
      // foreach($data as $row)
     //  {
      //     echo '<tr><td class="tnpsn">'.$row->npsn.'</td><td>'.$row->nm_sekolah.'</td><td><button class="btn btn-primary pilih3">Pilih</button></td></tr>';
     //  }
     //   echo '</table>';
       
    }
    public function get_sekolah_by_name()
    {
        $nm_sekolah2=$this->input->post('id', TRUE);
       // $nm_sekolah='%'.$nm_sekolah2.'%';
       $sql="select npsn,nm_sekolah,kecamatan.nm_kecamatan from sekolah left JOIN kecamatan on sekolah.kd_wilayah_kec=kecamatan.kd_kec where nm_sekolah like '%".$nm_sekolah2."%' or alamat like '%".$nm_sekolah2."%' ";
     
        $data = $this->db->query($sql)->result();
        echo json_encode($data);
   
    }
     public function get_kec_by_name()
    {
        $key=$this->input->post('id', TRUE);
       // $nm_sekolah='%'.$nm_sekolah2.'%';
       $sql="select DISTINCT kd_kec,nm_kecamatan,nm_kabupaten from kecamatan,kabupaten where kecamatan.kd_kab=kabupaten.kd_kab and (nm_kecamatan like '%".$key."%' or nm_kabupaten like '%".$key."%')";
    
        $data = $this->db->query($sql)->result();
        echo json_encode($data);
   
    }
    //modul matakuliah
    function lmatakuliah() {
        
        $level=$this->session->userdata('level');
        $homebase = $this->session->userdata('home_base');
    if ($level == "mahasiswa") {
        $keyta['kd_prodi'] = $homebase;
        $data['listmatakuliah'] = $this->Mahasiswa_model->get_list_selected('matakuliah', $keyta);
        $this->template->load($this->view, 'mahasiswa/lmatakuliah', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
            }
    }
    
    //modul krs
    public function lkrs() {
        
        $cek = $this->session->userdata('userid');
        $this->cek_biodata($cek);
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
//$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Mahasiswa_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "mahasiswa") {
                $key['nim'] = $cek;

                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $keyja['kd_kegiatan'] = 'KRS';
                $hasilcekja = $this->Mahasiswa_model->get_row_selected('jadwalakademik', $keyja);
                $allkrs['mhs'] = $this->Mahasiswa_model->get_row_selected('mahasiswa', $key);
                $allkrs['krs'] = $this->get_all_krs($cek);
                $allkrs['pa'] = $this->Akademika_model->get_pa($cek);
                $this->template->load($this->view, 'mahasiswa/lkrs', $allkrs);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function vkrs($no_krs) {
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
		$homebase = $this->session->userdata('home_base');

		if ($level == 'mahasiswa') {
               $krsh= $this->get_krsh($no_krs, $cek);
                $kd_ta=$krsh->kd_tahun_ajaran;
                $data['krsh'] = $krsh;
                $data['ipk']=$this->Akademika_model->get_ipk($cek,$kd_ta);
                
                $data['krsd'] = $this->get_krsd($no_krs);
                $data['pa'] = $this->Akademika_model->get_pa($cek);
				$keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Mahasiswa_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Mahasiswa_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
				if($prodi->kd_prodi=='022' and $krsh->angkatan=='2019'){
				    $data['plt']='Koordinator Program Studi';
				
				}else{
				    $data['plt']='Ketua Program Studi';
				
				}
				    $this->load->view('mahasiswa/krs', $data);    
			//	}
                
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    function lihstkrs($no_krs) {
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
		$homebase = $this->session->userdata('home_base');

		if ($level == 'mahasiswa') {
                $krsh = $this->get_krsh($no_krs, $cek);
                
                    //$data['ipk']=0;
                
                $kd_ta=$krsh->kd_tahun_ajaran;
                $data['krsh'] = $krsh;
                $data['ipk']=$this->Akademika_model->get_ipk($cek,$kd_ta);
                $data['krsh']=$krsh;
                $data['krsd'] = $this->get_krsd($no_krs);
                $data['pa'] = $this->Akademika_model->get_pa($cek);
				$keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Mahasiswa_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Mahasiswa_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
                $this->load->view('mahasiswa/vkrs', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }

    public function cek_ta_krs($no_krs)
    {
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $key['no_krs']=$no_krs;
        $krs=$this->Mahasiswa_model->get_row_selected('rencanastudih',$key);
        
        if($kd_tahun_ajaran<>$krs->kd_tahun_ajaran)
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Periode Penawaran untuk KRS ini sudah ditutup. Terimakasih</p>
					</div>');
            redirect(base_url().'mahasiswa/lkrs');
        }
        
        
    }
  
    function ekrs($no_krs) {
          
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $keymhs['nim']=$cek;
        $mhs=$this->Mahasiswa_model->get_row_selected('mahasiswa',$keymhs);
$angkatan=$mhs->angkatan;
        //$this->cek_ta_krs($no_krs);
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        $levela = $this->session->userdata('level');
        if ($levela == "mahasiswa") {
            $status_registrasi = $this->status_registrasi($kd_tahun_ajaran, $cek);
            if ($status_registrasi == TRUE) {
                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                //$keyja['kd_kegiatan'] = 'KRS';
                $hasilcekja = $this->Mahasiswa_model->get_row_selected('jadwalakademik', $keyja);
                if ($hasilcekja->aktif == 'Ya' or $hasilcekja->aktif=='Tidak') {
                    $krsh=$this->get_krsh($no_krs, $cek);
                    $data['krsh'] = $krsh;
                    $data['krsd'] = $this->get_krsd($no_krs);
                    $data['aksi'] = "Edit";
                     $kd_tahun_ajaranips=$this->semesterips($kd_tahun_ajaran);
                    $hasilx=$this->get_ips($cek, $kd_tahun_ajaranips);
                    $data['ips'] =$hasilx;
                    $keykelas['nim']=$cek;
                    $kelas2=$this->Mahasiswa_model->get_row_selected('vkelas_mahasiswa',$keykelas);
                     
                         $semester_ke= $this->get_semester($angkatan,$kd_tahun_ajaran);
                    if($kelas2)
                    {
                        
                        $kelasx=$kelas2->kelas;
                        //$data['listjadwal'] = $this->list_jadwalx($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
                      // $jadwal = $this->list_jadwalx($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
                      // $data['listjadwal'] = $this->list_jadwal($kd_tahun_ajaran, $homebase);
                        $jadwal= $this->list_jadwaly($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
                        $data['listjadwal']=$this->parsing($jadwal);
                      
            
                    }else
                    {
                        
                        $jadwal= $this->list_jadwal($kd_tahun_ajaran, $homebase,$angkatan);
                        
                       
                        $data['listjadwal']=$this->parsing($jadwal);
                      
                        
                    }
                   
                        
                        	if($semester_ke=='1' or $semester_ke=='2' or $mhs->kd_prodi=='024' )
                		{
                			
                				$data['maks_sks']= '24';
                		}
                		else
                		{
                		    	$data['maks_sks']= $this->rule_maks_sks($hasilx);
                			
                		//	echo json_encode($data);
                		}
                    
                    $status=$krsh->setujui_pa;
                    if($status=='Ya')
                    {
                        $data['tombol'] = "tutup";
                    }
                    else
                    {
                         $data['tombol'] = "buka";
                    }
                    $data['semester_ke'] = $this->get_semester($angkatan,$kd_tahun_ajaran);
                    $data['pa'] = $this->Akademika_model->get_pa($cek);
                    $this->template->load($this->view, 'mahasiswa/krs/ekrs', $data);
                } else {
                    echo 'Mohon maaf, proses krs sudah ditutup';
                }
            } else {
                echo 'belum membayar spp';
            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    function get_jadwal_detail($kd_jadwal)
    {
        $key['kd_jadwal']=$kd_jadwal;
        $hasil=$this->Akademika_model->get_list_selected('vjadwal_dosen',$key);
        if($hasil){
           // echo json_encode($hasil);
            return ($hasil);    
        }else
        {
           // echo json_encode(false);
            return false;
        }
        
    }
    function hapus_matkul_krs($no_krs,$kd_mtk)
{
    $key['no_krs']=$no_krs;
    $key['kd_mtk']=$kd_mtk;
    
    //$this->Prodi_model->update_data('rencanastudid',$data,$key);
    $keykrs['no_krs']=$no_krs;
    $krs=$this->Mahasiswa_model->get_row_selected('rencanastudih',$keykrs);
    $nim=$krs->nim;
    $data['aktif']="Tidak";
    $this->Mahasiswa_model->update_data('rencanastudid',$data,$key);
    
     redirect(base_url().'mahasiswa/list_matkul_mhs');
    
}
function aktif_matkul_krs($no_krs,$kd_mtk)
{
    $key['no_krs']=$no_krs;
    $key['kd_mtk']=$kd_mtk;
    
    //$this->Prodi_model->update_data('rencanastudid',$data,$key);
    $keykrs['no_krs']=$no_krs;
    $krs=$this->Mahasiswa_model->get_row_selected('rencanastudih',$keykrs);
    $nim=$krs->nim;
    $data['aktif']="Ya";
    
    $this->Mahasiswa_model->update_data('rencanastudid',$data,$key);
    
     redirect(base_url().'mahasiswa/list_matkul_mhs');
    
}
    function list_matkul_mhs()
    {
         
           $homebase = $cek = $this->session->userdata('home_base');
           $nim = $this->session->userdata('userid');
           $data['pa'] = $this->Akademika_model->get_pa($nim);
            $keyprodi['kd_prodi']=$homebase;
            $keymhs['nim']=$nim;
            $data['mahasiswa']=$this->Prodi_model->get_row_selected('mahasiswa',$keymhs);
				$prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Prodi_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
				$data['dekan']=$fak->dekan;
				$data['wd1']=$fak->wd1;
                $data['ka_prodi']=$prodi->ka_prodi;
         $data['transkrip'] = $this->get_list_all_mtk($nim);
          $this->template->load($this->view, 'mahasiswa/list_mtk', $data);
       // $this->load->view('prodi/list_mtk_krs_mhs', $data);
    }
    function get_list_all_mtk($nim)
    {
    
        $sql="SELECT rencanastudih.kd_tahun_ajaran, rencanastudid.no_krs,rencanastudid.kd_jadwal, rencanastudid.aktif as aktif,rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai`  order by matakuliah.semester_ke,nm_mtk asc";
         $output = $this->db->query($sql)->result();
            return $output;
        
    //    echo json_encode($output);
    }
   
    function transkrip_nilai()
    {
        
          $nim =$this->session->userdata('userid');
           $homebase =$this->session->userdata('home_base');
           $data['pa'] = $this->Akademika_model->get_pa($nim);
            $keyprodi['kd_prodi']=$homebase;
            $keymhs['nim']=$nim;
            $data['mahasiswa']=$this->Mahasiswa_model->get_row_selected('mahasiswa',$keymhs);
            
				$prodi=$this->Mahasiswa_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Mahasiswa_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
				$data['dekan']=$fak->dekan;
				$data['wd1']=$fak->wd1;
                $data['ka_prodi']=$prodi->ka_prodi;
                $data['nidn_prodi']=$prodi->nidn;
                
                $data['nm_prodi']=$prodi->nm_prodi;
                $data['nip_dekan']=$fak->nip_dekan;
                
         $data['transkrip'] = $this->Akademika_model->get_transkrip_nilai($nim);
        $this->load->view('mahasiswa/transkrip_nilai', $data);
    }
     

    
//view all khs
    function lkhs()
    {
        
        $nim =$this->session->userdata('userid');
        $this->cek_biodata($nim);
        $data['listta']=$this->get_all_khs_nim($nim);
        $this->template->load($this->view, 'mahasiswa/lkhs', $data);
    }

//view khs
    function fkhss() {
        
        $data['nim'] = $cek = $this->session->userdata('userid');
        $data['listta'] = $this->Mahasiswa_model->get_all('thnajaran');
        $this->template->load($this->view, 'mahasiswa/rkhss', $data);
    }

     
    
    
    function khs($no_krs) {
        
       /// $nim = $this->input->post('nim', true);
        //$kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran', true);
        //$homebase = $this->session->userdata('home_base');
        $data['hkhs'] = '';
        $data['dkhs'] = '';
        //$datau['qrcode'] = $this->Akademika_model->acak(12);
        //$datau['time_edit'] =  date('Y-m-d H:i:s');
        //$keys['no_krs']=$no_krs;
        //$this->Akademika_model->update_data('rencanastudih',$datau,$keys);
        $hkhs = $this->Akademika_model->get_hkhs($no_krs);
        
        $cek = $this->session->userdata('userid');
        if ($hkhs) {
            $dkhs = $this->Akademika_model->get_dkhs($hkhs->no_krs);
            
            $data['hkhs'] = $hkhs;
            $data['dkhs'] = $dkhs;
            
             $data['pa'] = $this->Akademika_model->get_pa($cek);
            $homebase=$hkhs->kd_prodi;
            $keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Mahasiswa_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Mahasiswa_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
                $data['ka_prodi']=$prodi->ka_prodi;
                $data['nidn']=$prodi->nidn;
        if($homebase=='022') 
        {
            $this->load->view('mahasiswa/khss', $data);
        }
        else
        {
            $this->load->view('mahasiswa/khss', $data);
        }
        
        
        } else {
            echo 'maaf hasil studi anda pada tahun_ajaran ini belum ada...';
        }
    }
    
    private function get_all_khs_nim($nim)
    {
        $sql="SELECT `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`semester_ke`, `rencanastudih`.`tot_sks`,`rencanastudih`.`ips_sebelumnya`, `rencanastudih`.`maks_sks`, `rencanastudih`.`no_krs`, `rencanastudih`.`nim` FROM `rencanastudih`
            WHERE `rencanastudih`.`nim` = '".$nim."'";
              $output = $this->db->query($sql)->result();
            return $output;
    }
    

    


    function get_all_ips($nim) {
        $sql = "SELECT `rencanastudih`.`kd_tahun_ajaran` as semester_ke ,Sum(`rencanastudid`.`sks` * `mnilai`.`nilai_a`) /Sum(`rencanastudid`.`sks`) AS `ips` FROM `rencanastudid`, `rencanastudih`,mnilai where rencanastudih.nim='".$nim."' and `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs` and rencanastudid.nilai=mnilai.nilai_h  GROUP by kd_tahun_ajaran";
        $output = $this->db->query($sql)->result_array();

        return $output;
        //echo json_encode($output);
    }


   	public function parsing($jadwal)
	{
	    $list=array();
	
						foreach($jadwal as $row)
                        {
                
                            $datax['kd_jadwal']=$row->kd_jadwal;
                            $datax['semester_ke']=$row->semester_ke;
                             $datax['nm_mtk']=$row->nm_mtk;
                             $datax['kd_mtk']=$row->kd_mtk;
                             $datax['sks']=$row->sks;
                             $datax['kelas']=$row->kelas;
                             $datax['kd_ruang']=$row->kd_ruang;
                             $datax['kapasitas']=$row->kapasitas;
                            $datax['hari']=$row->hari;
                            $datax['jam']=$row->jam;
                            $datax['group_wa']=$row->group_wa;
                           $datax['h']=$this->get_rekap_absensi_mahasiswa($row->kd_jadwal,'H');
                            $datax['i']=$this->get_rekap_absensi_mahasiswa($row->kd_jadwal,'I');
                            $datax['s']=$this->get_rekap_absensi_mahasiswa($row->kd_jadwal,'S');
                            
                              $datax['tersisa']=$row->kapasitas-$this->get_terisi($row->kd_jadwal);
                        
                            $hasil=$this->get_jadwal_detail($row->kd_jadwal);
                            if($hasil)
                            {
                                 $dosen='';
                                foreach($hasil as $d)
                                {
                                    
                                        $dosen=$dosen.'('.$d->dosen_ke.')'.'.'.$d->nm_dosen;
                                        $datax['dosen']=$dosen;
                                        //array_push($list,$data);
                                    
                                    
                                }
                            }else
                            {
                                $datax['dosen']='';
                            }
                            array_push($list,$datax);
                            
                        }
                     return $list;
					   }

//FORM KRS
    public function fkrs() {
        
        $cek = $this->session->userdata('userid');
        $this->cek_biodata($cek);
        $level = $this->session->userdata('level');
		$homebase = $this->session->userdata('home_base');
        //$this->tutup_krs();
       
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
		
        $keymhs['nim'] = $cek;
        $rowmhs = $this->Mahasiswa_model->get_row_selected('mahasiswa', $keymhs);
        $data['nim'] = $rowmhs->nim;
        $data['nm_mahasiswa'] = $rowmhs->nm_mahasiswa;
        $data['kd_prodi'] = $rowmhs->kd_prodi;
        $data['angkatan'] = $rowmhs->angkatan;
        $data['pa'] = $this->Akademika_model->get_pa($cek);
        $kd_tahun_ajaranips=$this->semesterips($kd_tahun_ajaran);
        $data['kd_tahun_ajaran'] = $kd_tahun_ajaran;
        $angkatan=$rowmhs->angkatan;
        $semester_ke= $this->get_semester($angkatan,$kd_tahun_ajaran);
        $data['semester_ke'] =$semester_ke;
       
        $angkatan=$rowmhs->angkatan;
       // $semester_sebelumnya = $rowmhs->semester - 1;
        $hasilx=$this->get_ips($cek, $kd_tahun_ajaranips);
        $data['ips'] =$hasilx;
		if($semester_ke=='1' or $semester_ke=='2' or $rowmhs->kd_prodi=='024')
		{
				$data['maks_sks']='24';
		}
		else
		{
			$data['maks_sks']= $this->rule_maks_sks($hasilx);
		//	echo json_encode($data);
		}
         
        $data['krsd'] = '';
        $keykelas['nim']=$cek;
        $kelas2=$this->Mahasiswa_model->get_row_selected('vkelas_mahasiswa', 
        $keykelas);
        
        if($kelas2 && $angkatan=='2017' )
        {
            $kelasx=$kelas2->kelas;
           $jadwal= $this->list_jadwaly($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
           $data['listjadwal']=$this->parsing($jadwal);

        }elseif($kelas2 && $angkatan<>'2017')
        {
             $kelasx=$kelas2->kelas;
           $jadwal = $this->list_jadwalx($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
            $data['listjadwal']= $this->parsing($jadwal);
        }
            else
        {
         $jadwal= $this->list_jadwal($kd_tahun_ajaran, $homebase,$angkatan);
            $data['listjadwal']= $this->parsing($jadwal);
        }
        $data['listterisi'] = $this->list_terisi($kd_tahun_ajaran, $homebase);
        
        $data['aksi'] = "Input";
        $hregistrasi=$this->status_registrasi($kd_tahun_ajaran, $cek);
            
        if ($level == "mahasiswa") {
        if($hregistrasi==FALSE)
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>KRSan dapat dilakukan setelah melakukan pembayaran UKT</p>
					</div>');
             redirect(base_url() . 'mahasiswa/lkrs/');
        }
        else {
            $key['kd_tahun_ajaran'] = $kd_tahun_ajaran;
            $key['nim'] = $cek;
            $hasil = $this->Mahasiswa_model->get_row_selected('rencanastudih', $key);
            if ($hasil) {
                redirect(base_url() . 'mahasiswa/ekrs/' . $hasil->no_krs);
            } else {
                $this->template->load($this->view, 'mahasiswa/krs/fkrs', $data);
            }
            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    public function fkrs2() {
        $list=array();
        $cek = $this->session->userdata('userid');
        $this->cek_biodata($cek);
        $level = $this->session->userdata('level');
		$homebase = $this->session->userdata('home_base');
        //$this->tutup_krs();
       
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
		
        $keymhs['nim'] = $cek;
        $rowmhs = $this->Mahasiswa_model->get_row_selected('mahasiswa', $keymhs);
        $data['nim'] = $rowmhs->nim;
        $data['nm_mahasiswa'] = $rowmhs->nm_mahasiswa;
        $data['kd_prodi'] = $rowmhs->kd_prodi;
        $data['angkatan'] = $rowmhs->angkatan;
        $data['pa'] = $this->Akademika_model->get_pa($cek);
        $kd_tahun_ajaranips=$this->semesterips($kd_tahun_ajaran);
        $data['kd_tahun_ajaran'] = $kd_tahun_ajaran;
        $angkatan=$rowmhs->angkatan;
        $data['semester_ke'] = $this->get_semester($angkatan,$kd_tahun_ajaran);
       
        $angkatan=$rowmhs->angkatan;
       // $semester_sebelumnya = $rowmhs->semester - 1;
        $hasilx=$this->get_ips($cek, $kd_tahun_ajaranips);
        $data['ips'] =$hasilx;
		if($rowmhs->semester==1 or $rowmhs->semester==2 or $rowmhs->kd_prodi=='024')
		{
				$data['maks_sks']='24';
		}
		else
		{
			$data['maks_sks']= $this->rule_maks_sks($data['ips']);
		//	echo json_encode($data);
		}
         
        $data['krsd'] = '';
        $keykelas['nim']=$cek;
        $kelas2=$this->Mahasiswa_model->get_row_selected('vkelas_mahasiswa', 
        $keykelas);
        
        if($kelas2 && $angkatan=='2017' )
        {
            $kelasx=$kelas2->kelas;
            $jadwal = $this->list_jadwaly($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
             foreach($jadwal as $row)
                        {
                
                            $datax['kd_jadwal']=$row->kd_jadwal;
                            $datax['semester_ke']=$row->semester_ke;
                             $datax['nm_mtk']=$row->nm_mtk;
                             $datax['kd_mtk']=$row->kd_mtk;
                             $datax['sks']=$row->sks;
                             $datax['kelas']=$row->kelas;
                             $datax['kd_ruang']=$row->kd_ruang;
                             $datax['kapasitas']=$row->kapasitas;
                            $datax['hari']=$row->hari;
                            $datax['jam']=$row->jam;
                            $datax['kuota']=$row->kuota;
                            $datax['group_wa']=$row->group_wa;
                           
                            
            
                           
                            $hasil=$this->get_jadwal_detail($row->kd_jadwal);
                            if($hasil)
                            {
                                 $dosen='';
                                foreach($hasil as $d)
                                {
                                    
                                        $dosen=$dosen.'('.$d->dosen_ke.')'.'.'.$d->nm_dosen;
                                        $datax['dosen']=$dosen;
                                        //array_push($list,$data);
                                    
                                    
                                }
                            }else
                            {
                                $datax['dosen']='';
                            }
                            array_push($list,$datax);
                            
                        }
                       $data['listjadwal'] = $list;

        }elseif($kelas2 && $angkatan<>'2017')
        {
            
             $kelasx=$kelas2->kelas;
            $jadwal = $this->list_jadwalx($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
            //$jadwal = $this->list_jadwalx($kd_tahun_ajaran, $homebase,$kelasx,$angkatan);
                      // $data['listjadwal'] = $this->list_jadwal($kd_tahun_ajaran, $homebase);
                      foreach($jadwal as $row)
                        {
                
                            $datax['kd_jadwal']=$row->kd_jadwal;
                            $datax['semester_ke']=$row->semester_ke;
                             $datax['nm_mtk']=$row->nm_mtk;
                             $datax['kd_mtk']=$row->kd_mtk;
                             $datax['sks']=$row->sks;
                             $datax['kelas']=$row->kelas;
                             $datax['kd_ruang']=$row->kd_ruang;
                             $datax['kapasitas']=$row->kapasitas;
                            $datax['hari']=$row->hari;
                            $datax['jam']=$row->jam;
                            $datax['kuota']=$row->kuota;
                           $datax['group_wa']=$row->group_wa;
                            
            
                           
                            $hasil=$this->get_jadwal_detail($row->kd_jadwal);
                            if($hasil)
                            {
                                 $dosen='';
                                foreach($hasil as $d)
                                {
                                    
                                        $dosen=$dosen.'('.$d->dosen_ke.')'.'.'.$d->nm_dosen;
                                        $datax['dosen']=$dosen;
                                        //array_push($list,$data);
                                    
                                    
                                }
                            }else
                            {
                                $datax['dosen']='';
                            }
                            array_push($list,$datax);
                            
                        }
                       $data['listjadwal'] = $list;
        }
            else
        {
            $jadwal = $this->list_jadwal($kd_tahun_ajaran, $homebase,$angkatan);
            foreach($jadwal as $row)
                        {
                
                            $datax['kd_jadwal']=$row->kd_jadwal;
                            $datax['semester_ke']=$row->semester_ke;
                             $datax['nm_mtk']=$row->nm_mtk;
                             $datax['kd_mtk']=$row->kd_mtk;
                             $datax['sks']=$row->sks;
                             $datax['kelas']=$row->kelas;
                             $datax['kd_ruang']=$row->kd_ruang;
                             $datax['kapasitas']=$row->kapasitas;
                            $datax['hari']=$row->hari;
                            $datax['jam']=$row->jam;
                            $datax['kuota']=$row->kuota;
                            $datax['group_wa']=$row->group_wa;
                            
            
                           
                            $hasil=$this->get_jadwal_detail($row->kd_jadwal);
                            if($hasil)
                            {
                                 $dosen='';
                                foreach($hasil as $d)
                                {
                                    
                                        $dosen=$dosen.'('.$d->dosen_ke.')'.'.'.$d->nm_dosen;
                                        $datax['dosen']=$dosen;
                                        //array_push($list,$data);
                                    
                                    
                                }
                            }else
                            {
                                $datax['dosen']='';
                            }
                            array_push($list,$datax);
                            
                        }
                       $data['listjadwal'] = $list;
        }
        //$data['listjadwal'] = $this->list_jadwal($kd_tahun_ajaran, $homebase);
        $data['listterisi'] = $this->list_terisi($kd_tahun_ajaran, $homebase);
        
        $data['aksi'] = "Input";
        $hregistrasi=$this->status_registrasi($kd_tahun_ajaran, $cek);
            
        if ($level == "mahasiswa") {
        if($hregistrasi==FALSE)
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>KRSan dapat dilakukan setelah melakukan pembayaran SPP</p>
					</div>');
             redirect(base_url() . 'mahasiswa/lkrs/');
        }
        else {
            $key['kd_tahun_ajaran'] = $kd_tahun_ajaran;
            $key['nim'] = $cek;
            $hasil = $this->Mahasiswa_model->get_row_selected('rencanastudih', $key);
            if ($hasil) {
                redirect(base_url() . 'mahasiswa/ekrs/' . $hasil->no_krs);
            } else {
                $this->template->load($this->view, 'mahasiswa/krs/fkrs', $data);
            }
            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    
    public function tutup_krs()
    {
        	$homebase = $this->session->userdata('home_base');
        if($homebase=='012' or $homebase=='022' )
        {
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Periode penawaran sudah selesai hari jumat Tgl 28 Sept 2018, Dan Pada tgl 01 Oktober 2018 perkuliahan akan segera dimulai. Terimakasih </p>
					</div>');
             redirect(base_url() . 'mahasiswa/lkrs/');
        }
    }
    public  function semesterips($kd_tahun_ajaran)
    {
       //$kd_tahun_ajaran='20171';
        //$kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $hasilx=substr($kd_tahun_ajaran,-1);
        if($hasilx=='2')
        {
            $tahun=substr($kd_tahun_ajaran,0,4);
            $semester='1';
            $akhir=$tahun.$semester;
        }elseif($hasilx=='1')
        {
            $tahunx=substr($kd_tahun_ajaran,0,4);
            $tahun=intval($tahunx)-1;
            $semester='2';
            $akhir=$tahun.$semester;
        }
        return $akhir;
    }

    public function batal_mtk($no_krs, $kd_jadwal) {
        $level = $this->session->userdata('level');
        $nim = $this->session->userdata('userid');
        if ($level == "mahasiswa") {
            $sql = "delete from rencanastudid where no_krs='" . $no_krs . "' and kd_jadwal='" . $kd_jadwal . "'";
            $this->db->query($sql);
            redirect(base_url() . 'mahasiswa/ekrs/' . $no_krs);
        } elseif ($level == "dosen") {
            $sql = "delete from rencanastudid where no_krs='" . $no_krs . "' and kd_jadwal='" . $kd_jadwal . "'";
            $this->db->query($sql);
            redirect(base_url() . 'dosen/list_krs/' . $nim);
        }
    }


    
    public function cek_krs($kd_tahun_ajaran,$nim)
    {
        $sql="select * from rencanastudih where nim='".$nim."' and kd_tahun_ajaran='".$kd_tahun_ajaran."'";
         $output = $this->db->query($sql)->row();
        //return $output;
       // $hasil=array();
       $hasil=0;
        if (!$output)
        {
             $hasil=0;
            
        }else
        {
            $hasil=1;
        }
       return($hasil);
       //echo json_encode($hasil);
    }

  function akrs() {
        
         $this->load->model('Akademika_model');
        $level = $this->session->userdata('level');
          
          
          
        $aksi = $this->input->post('aksi', TRUE);
        $nim = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $angkatan=$this->input->post('angkatan', TRUE);
        $hasil = $this->input->post('jadwal', TRUE);
        
        $hdata['nim'] = $nim;
        $hdata['semester_ke'] = $this->input->post('semester_ke', TRUE);
        $hdata['tgl_krs'] = date('Y-m-d');
        $hdata['kd_prodi'] = $homebase;
        $hdata['maks_sks'] = $this->input->post('maks_sks', TRUE);
        $hdata['ips_sebelumnya'] = $this->input->post('ips', true);
        $hdata['tot_sks'] = $this->input->post('tot_sks', true);
        $hdata['angkatanx'] = $angkatan;
        
        if ($level == "mahasiswa" ) {
            if ($aksi == "Input") {
                
                $hdata['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $cekdoublekrs=$this->cek_krs($kd_tahun_ajaran,$nim);
                if($cekdoublekrs==1)
                {
                    echo "KRS Anda pada Tahun Akademik ini sudah ada";
                }else
                {   
                
                $no_krs = $this->createNoKRS($kd_tahun_ajaran,$homebase,$angkatan);
                $hdata['no_krs'] = $no_krs;
                
                $hdata['qrcode'] = $this->Akademika_model->acak(12);
                $hdata['time_edit'] =  date('Y-m-d H:i:s');
               
                $hdata['setujui_pa'] = 'Tidak';
                $this->db->trans_start();
                $this->db->insert('rencanastudih', $hdata);
                foreach ($hasil as $key) {
                    $ddata['no_krs'] = $no_krs;
                    $ddata['kd_jadwal'] = $key;
                    $mtk = $this->get_mtk($key);
                    $ddata['kd_mtk'] = $mtk->kd_mtk;
                    $ddata['sks'] = $mtk->sks;
                    $ddata['nilai'] = 'E';
                    $ddata['aktif'] = 'Ya';
                    $ddata['status'] = 'Tidak';
                    if($this->cek_kuota($key)>0)
                    {
                    $this->db->insert('rencanastudid', $ddata);
                    }
                }
                $this->db->trans_complete();
                }
            } elseif ($aksi == "Edit") {
                $key['no_krs'] = $this->input->post('no_krs', TRUE);
                 $no_krs = $this->input->post('no_krs', TRUE);
               // $this->db->trans_start();
                $this->Mahasiswa_model->update_data('rencanastudih', $hdata, $key);
                //$this->db->delete('rencanastudid', $key);
                $tot_sks=0;
                
                
                if($hasil)
                {
                 $this->db->trans_start();
                foreach ($hasil as $key) {
                    $no_krs= $this->input->post('no_krs', TRUE);
                    $ddata['no_krs'] =$no_krs;
                    $ddata['kd_jadwal'] = $key;
                    $mtk = $this->get_mtk($key);
                    $ddata['kd_mtk'] = $mtk->kd_mtk;
                    $ddata['sks'] = $mtk->sks;
                    //$ddata['nilai'] = 'E';
                    $tot_sks=$tot_sks+$mtk->sks;
                    //$ddata['aktif'] = 'Ya';
              
                    $keydetail['no_krs']=$no_krs;
                    $keydetail['kd_jadwal']=$key;
                    
                    $hasily=$this->Mahasiswa_model->get_row_selected('rencanastudid',$keydetail);
                    if(!empty($hasily))
                    {
                        $this->db->update('rencanastudid',$ddata,$keydetail);
                    }else
                    {
                        $ddata['nilai'] = 'E';
                        if($this->cek_kuota($key)>0)
                        {
                            $ddata['aktif'] = 'Ya';
                            $this->db->insert('rencanastudid', $ddata);
                        }
                        
                
                    }
                   
                    //hapus krsdetail yang tidak ada
                    
                   // $this->db->update('rencanastudid',$ddata,$kunci);
                   // $this->db->insert('rencanastudid', $ddata);
                }
                }$a=json_encode($hasil);
                 
                 $a=Rtrim($a,']');
                 $a=Ltrim($a,'[');
               // echo $a;
                 //hapus krsdetail yang tidak ada
                $sql="delete from rencanastudid where no_krs='".$no_krs."' and kd_jadwal not in ($a)";
                $this->db->query($sql);
                $udata['tot_sks']=$tot_sks;
                 $keyu['no_krs'] = $this->input->post('no_krs', TRUE);
                $this->Mahasiswa_model->update_data('rencanastudih', $udata, $keyu);
                $this->db->trans_complete();
                
                
            }
            
            redirect(base_url().'mahasiswa/lkrs');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }

    }
    

    function get_semester($angkatan,$ta)
    {
        $tahun=substr($ta,0,4);
       // //$tahun=intval($tahun);
        $selisih=$tahun-$angkatan;
        $akhir=substr($ta,-1);
       if($akhir=='1')
       {
           $semester=$selisih+1+$selisih;
       }else
       {
           $semester=$selisih+2+$selisih;
       }
        return $semester;
    }


    private function get_mtk($kd_jadwal) {
        $sql = "select jadwal.kd_mtk,matakuliah.nm_mtk,matakuliah.sks from jadwal,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_jadwal='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->row();
        return $output;
    }

    private function status_registrasi($kd_tahun_ajaran, $nim) {
        $outut = false;
        $sql = "SELECT nim from registrasi where kd_tahun_ajaran='".$kd_tahun_ajaran."' and nim='" .$nim."' and jns_registrasi='P03' ";
        $hasil = $this->db->query($sql)->result();
        if ($hasil) {
            $outut = true;
        }
        return $outut;
    }

    public function rule_maks_sks($ips) {
        $maks = 24;

		if ($ips >= 3.0 && $ips <= 4.0) {
            $maks = 24;}
		elseif ($ips >= 2.75 && $ips <= 2.99) {
            $maks = 22;
        } 
		elseif ($ips >= 2.50 && $ips <= 2.74) {
            $maks = 20;
        }
		elseif ($ips > 0 && $ips <= 2.49) {
            $maks = 18;
        }
	

        
       // echo json_encode($maks);
        return $maks;
    }

    private function get_all_krs($nim) {
        
        $sql = "SELECT
  `rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`,
  `rencanastudih`.`semester_ke`, `rencanastudih`.`kd_tahun_ajaran`,
  `thnajaran`.`tahun_ajaran`, `thnajaran`.`semester`, `rencanastudih`.`nim`,
  `rencanastudih`.`tot_sks`,setujui_pa
FROM
  `rencanastudih` INNER JOIN
  `thnajaran` ON `thnajaran`.`kd_tahun_ajaran` =
    `rencanastudih`.`kd_tahun_ajaran`
WHERE
  `rencanastudih`.`nim` = '".$nim."'";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
    }

//fungsi krs mtk
    public function view_krs($no_krs) {
        
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
//$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Mahasiswa_model->get_row_selected('user', $data);
            $level = $row->level;

            if ($level == "mahasiswa") {
                $key['nim'] = $cek;

                $this->template->load($this->view, 'mahasiswa/home', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    private function get_krsh($no_krs, $nim) {

        $sql = "SELECT
  `rencanastudih`.`nim`, `rencanastudih`.`ips_sebelumnya` AS `ips`,rencanastudih.status,
  `rencanastudih`.`no_krs`, `rencanastudih`.`semester_ke`,
  `rencanastudih`.`maks_sks`, `rencanastudih`.`nim`, `rencanastudih`.`tgl_krs`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`,
  `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`setujui_pa`,
  `prodi`.`nm_prodi`,prodi.ka_prodi,mahasiswa.lokasi
FROM
  `rencanastudih` INNER JOIN
  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` INNER JOIN
  `prodi` ON `prodi`.`kd_prodi` = `rencanastudih`.`kd_prodi`
WHERE
  `rencanastudih`.`nim` = '" . $nim . "' AND
  `rencanastudih`.`no_krs` = '" . $no_krs . "'";

        $output = $this->db->query($sql)->row();

        return $output;
// echo json_encode($output);
    }

    private function get_krsd($no_krs) {
        $sql = "SELECT
  `rencanastudid`.`no_krs`, `rencanastudid`.`kd_jadwal`,rencanastudid.status,
  `rencanastudid`.`aktif`, `matakuliah`.`nm_mtk`, `matakuliah`.`sks`,
  `matakuliah`.`semester_ke`, `matakuliah`.`kd_kurikulum`,
  `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kd_dosen`, `jadwal`.`kelas`,
  `jadwal`.`hari`, `jadwal`.`jam`,
  `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`, `jadwal`.`kd_mtk`
FROM
  `rencanastudid` INNER JOIN
  `jadwal` ON `rencanastudid`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN
  `matakuliah` ON `jadwal`.`kd_mtk` = `matakuliah`.`kd_mtk`
WHERE
  `rencanastudid`.`no_krs` = '".$no_krs."'";

        $output = $this->db->query($sql)->result();
        return $output;

// echo json_encode($output);
    }
    private function list_terisi($kd_tahun_ajaran, $kd_prodi)
    {
        $sql="select kd_jadwal,count(kd_jadwal)as jumlah from rencanastudih,rencanastudid  where rencanastudid.no_krs=rencanastudih.no_krs and kd_tahun_ajaran='".$kd_tahun_ajaran."' and kd_prodi='".$kd_prodi."' group by kd_jadwal";
         $hasil = $this->db->query($sql)->result();
       return ($hasil);
       //echo json_encode($hasil);
    }
    public function get_terisi($kd_jadwal)
    {
        $sql="select count(*) as jumlah from rencanastudid where rencanastudid.kd_jadwal='".$kd_jadwal."'";
         $hasil = $this->db->query($sql)->row();
         if($hasil)
         {
             return $hasil->jumlah;
         }else
         {
             return 0;
         }
    }
    public function cek_kuota($kd_jadwal)
    {
        $terisi=$this->get_terisi($kd_jadwal);
      
           $sql="SELECT * from jadwal where kd_jadwal='".$kd_jadwal."'";
       //$key['kd_jadwal']=$kd_jadwal;
      //$hasil=$this->Akademika_model->get_row_selected('kutota_jadwal',$key);
       $hasil = $this->db->query($sql)->row();
       if($hasil)
       {
           return $hasil->kapasitas-$terisi;
       }else
       {
           return 1;
       }
       //return $nilai;
     
    }
    public function list_jadwal($kd_tahun_ajaran, $kd_prodi,$angkatan)
    {
        $sql="SELECT jadwal.group_wa,semester_ke,jadwal.kd_ruang,jadwal.kd_mtk,matakuliah.nm_mtk,matakuliah.sks,jadwal.kd_jadwal,jadwal.kelas,jadwal.hari,jadwal.jam,jadwal.kapasitas from jadwal,matakuliah,kurikulum where jadwal.kd_mtk=matakuliah.kd_mtk and matakuliah.kd_kurikulum=kurikulum.kd_kurikulum and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_prodi='".$kd_prodi."' and kurikulum.thn_awal<='".$angkatan."' and kurikulum.thn_akhir>='".$angkatan."' order by semester_ke,nm_mtk,kelas asc";
         $hasil = $this->db->query($sql)->result();
        //echo json_encode($hasil);
        return ($hasil);
    }
    
    public function list_jadwal2($kd_tahun_ajaran, $kd_prodi,$angkatan) {
        $sql = "SELECT `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_prodi`,kutota_jadwal.jumlah as kuota,`jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `jadwal`.`kd_ruang`,
`jadwal`.`kd_dosen`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`,`matakuliah`.`prasyarat_mk`, `matakuliah`.`prasyarat_nilai_mk`,`matakuliah`.`prasyarat_mk2`, `matakuliah`.`prasyarat_nilai_mk2`,
`matakuliah`.`kd_kurikulum`, `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kelas`,`jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kapasitas`,
`dosen`.`nm_dosen`, `dosen`.`NIDN` FROM `jadwal` INNER JOIN `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen` left JOIN kutota_jadwal ON kutota_jadwal.kd_jadwal=jadwal.kd_jadwal INNER JOIN kurikulum ON matakuliah.kd_kurikulum=kurikulum.kd_kurikulum
WHERE `jadwal`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' AND `jadwal`.`kd_prodi` = '" . $kd_prodi . "' and kurikulum.thn_awal<='".$angkatan."' and kurikulum.thn_akhir>='".$angkatan."' order by semester_ke,nm_mtk,kelas asc";
        $hasil = $this->db->query($sql)->result();
        //echo json_encode($hasil);
        return ($hasil);
    }
         private function list_jadwalx($kd_tahun_ajaran, $kd_prodi,$kelas,$angkatan) {
        $sql = "SELECT jadwal.group_wa,semester_ke,jadwal.kd_ruang,jadwal.kd_mtk,matakuliah.nm_mtk,matakuliah.sks,jadwal.kd_jadwal,jadwal.kelas,jadwal.hari,jadwal.jam,jadwal.kapasitas from jadwal,matakuliah,kurikulum where jadwal.kd_mtk=matakuliah.kd_mtk and matakuliah.kd_kurikulum=kurikulum.kd_kurikulum and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_prodi='".$kd_prodi."' and kurikulum.thn_awal<='".$angkatan."' and kurikulum.thn_akhir>='".$angkatan."' and jadwal.kelas='".$kelas."' order by semester_ke,nm_mtk,kelas asc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        //echo json_encode($hasil);
    }
    private function list_jadwaly($kd_tahun_ajaran, $kd_prodi,$kelas) {
        $sql = "SELECT jadwal.group_wa,semester_ke,jadwal.kd_ruang,jadwal.kd_mtk,matakuliah.nm_mtk,matakuliah.sks,jadwal.kd_jadwal,jadwal.kelas,jadwal.hari,jadwal.jam,jadwal.kapasitas from jadwal,matakuliah,kurikulum where jadwal.kd_mtk=matakuliah.kd_mtk and matakuliah.kd_kurikulum=kurikulum.kd_kurikulum and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_prodi='".$kd_prodi."' and jadwal.kelas='".$kelas."' order by semester_ke,nm_mtk,kelas asc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        //echo json_encode($hasil);
    }

    private function last_ta_mhs($nim) {

        $kd_tahun_ajaran = null;

        $sql = "SELECT kd_tahun_ajaran from rencanastudih where nim='" . $nim . "' order by kd_tahun_ajaran DESC limit 1";
        $hasil = $this->db->query($sql)->result();
        if ($hasil) {
            foreach ($hasil as $row) {
                $kd_tahun_ajaran = $row->kd_tahun_ajaran;
            }
        }
        return $kd_tahun_ajaran;
    }

    private function get_ips($nim, $kd_tahun_ajaran) {
      // $ips = 0;
        $sqlips = "SELECT `rencanastudih`.`nim`, `rencanastudih`.`no_krs`, Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`) AS `total_bobot`, Sum(`matakuliah`.`sks`),Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`)/ Sum(`matakuliah`.`sks`) AS `ips` FROM mnilai, `rencanastudih`,`rencanastudid`,`matakuliah` where `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs` and  `matakuliah`.`kd_mtk` = `rencanastudid`.`kd_mtk` and rencanastudid.nilai=mnilai.nilai_h and `rencanastudih`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' and  `rencanastudih`.`nim` = '" . $nim . "'
GROUP BY  `rencanastudih`.`nim`, `rencanastudih`.`no_krs`";
        $hasil = $this->db->query($sqlips)->row();
        if($hasil)
        {
             $ips=$hasil->ips;
        }
       else
       {
           $ips=0;
       }
        
        return $ips;
       // echo $ips;
    }

    private function cek_maks_sks($hasil, $maks) {

        $jum_sks = 0;
        foreach ($hasil as $key) {
//$keya['kd_jadwal'] = $key;
            $sks = $this->get_sks_jadwal($key);
            $jum_sks = $jum_sks + $sks;
        }
        if ($jum_sks > $maks) {
            return false;
        } else {
            return $jum_sks;
        }
    }

    private function cek_maks_sks_edit($hasil, $maks, $awal) {

        $jum_sks = $awal;
        foreach ($hasil as $key) {
//$keya['kd_jadwal'] = $key;
            $sks = $this->get_sks_jadwal($key);
            $jum_sks = $jum_sks + $sks;
        }
        if ($jum_sks > $maks) {
            return false;
        } else {
            return $jum_sks;
        }
    }

    public function get_tot_sks_lulus($nim)
    {
        $sql="select sum(sks) as tot_sks from rencanastudid,rencanastudih where nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.nilai<>'E'";
         $output = $this->db->query($sql)->row();

        $sks = $output->tot_sks;
        //echo $sks;
        return $sks;
    }
    public function get_tot_sks($nim)
    {
        $sql="select sum(sks) as tot_sks from rencanastudid,rencanastudih where nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs";
         $output = $this->db->query($sql)->row();

        $sks = $output->tot_sks;
        //echo $sks;
        return $sks;
    }
    private function get_sks_jadwal($kd_jadwal) {
        $sql = "SELECT `jadwal`.`kd_jadwal`, `matakuliah`.`sks` FROM  `jadwal` INNER JOIN `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` WHERE `jadwal`.`kd_jadwal` = '" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->row();

        $sks = $output->sks;

        return $sks;
    }
    private function createNoCuti($kd_prodi,$kd_ta) {
         $q = $this->db->query("select MAX(RIGHT(no_cuti,3)) as kd_max from cuti where kd_tahun_ajaran='".$kd_ta."' and kd_prodi='".$kd_prodi."'");
        $kd = "";
        $ta=substr($kd_ta,-3);
       
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return 'CTI' . $kd_prodi.$ta.$kd;
    }
    private function createNoKRS($kd_ta,$kd_prodi,$angkatan) {
         $q = $this->db->query("select MAX(RIGHT(no_krs,3)) as kd_max from rencanastudih where kd_tahun_ajaran='".$kd_ta."' and kd_prodi='".$kd_prodi."' and angkatanx='".$angkatan."'");
        $kd = "";
        $ta=substr($kd_ta,-3);
        $ang=substr($angkatan,-2);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return 'KRS' . $kd_prodi .$ta. $ang.$kd;
    }
     function test_createNoKRS($kd_ta,$kd_prodi,$angkatan) {
        $q = $this->db->query("select MAX(RIGHT(no_krs,3)) as kd_max from rencanastudih where kd_tahun_ajaran='".$kd_ta."' and kd_prodi='".$kd_prodi."' and angkatanx='".$angkatan."'");
        $kd = "";
        $ta=substr($kd_ta,-3);
        $ang=substr($angkatan,-2);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        echo  'KRS' . $kd_prodi .$ta. $ang.$kd;
       // return 'KRS' . $kd_prodi .$ta. $ang.$kd;
    }

    public function _rules() {
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

    public function excel() {
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

    public function word() {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=dosen.doc");

        $data = array(
            'dosen_data' => $this->Dosen_model->get_all(),
            'start' => 0
        );

        $this->load->view('dosen_doc', $data);
    }
    
public function krs_mhs()
    {
        $sql="select nm_mahasiswa,angkatan,rencanastudih.nim,no_krs,tgl_krs,setujui_pa as status,kd_tahun_ajaran,semester_ke,ips_sebelumnya,maks_sks,tot_sks from rencanastudih,mahasiswa where rencanastudih.nim=mahasiswa.nim and rencanastudih.nim='F1A113039'";
        $hasil = $this->db->query($sql)->result();
        echo json_encode ($hasil);
    }
    public function jadwal_ku()
    {
        $nim='f1a113039';
        $kd_tahun_ajaran='20172';
         $sql="SELECT
  `rencanastudid`.`kd_jadwal`, `rencanastudih`.`kd_tahun_ajaran`,
  `jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`,
  `matakuliah`.`sks`, `rencanastudih`.`nim`, `thari`.`no`,
  `rencanastudid`.`no_krs`, `jadwal`.`kd_ruang`, `jadwal`.`kelas`,
  `dosen`.`nm_dosen`
FROM
  `rencanastudih` INNER JOIN
  `rencanastudid` ON `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs`
  INNER JOIN
  `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudid`.`kd_jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN
  `thari` ON `jadwal`.`hari` = `thari`.`hari` INNER JOIN
  `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen`
WHERE
  `rencanastudih`.`kd_tahun_ajaran` = '".$kd_tahun_ajaran."' and 
  `rencanastudih`.`nim` = '".$nim."' order by no asc";
     $output = $this->db->query($sql)->result();
echo json_encode($output);
    }
    
    
    public function simpan_krsku()
    {
        
        $postdata = file_get_contents("php://input");

		$dataObjek = json_decode($postdata);

	$data['no_krs'] = $dataObjek->data->no_krs;
	$data['nim'] = $dataObjek->data->nim;
	$simpan=$this->Mahasiswa_model->save_data('krsh',$data);
	
    echo $simpan;
        
        
        
    }
    public function jadwal_saja()
    {

        $sql="select jadwal.kd_jadwal,nm_dosen,nm_mtk,matakuliah.sks,hari,jam from jadwal,matakuliah,dosen where jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_tahun_ajaran='20172' and jadwal.kd_prodi='012'";
        $hasil = $this->db->query($sql)->result();
        echo json_encode ($hasil);
      // return $hasil;
        
    }

    public function pdf() {
        $this->load->library('m_pdf');
        $data = array(
            'dosen_data' => $this->Dosen_model->get_all(),
            'start' => 0
        );

        $html = $this->load->view('dosen_pdf', $data);
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

/* Location: ./application/controllers/Dosen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-27 03:48:53 */
/* http://harviacode.com */