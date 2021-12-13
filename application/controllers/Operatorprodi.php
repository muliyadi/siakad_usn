<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Operatorprodi extends CI_Controller {

    var $gallery_path;
    public $gallery_path_url;
    public $view = 'template/templateprodi';

    function __construct() {
        parent::__construct();
        $this->load->model('Prodi_model');
         $this->load->model('Akademika_model');
        //$this->load->library('form_validation');berita_acara_final
        $this->gallery_path = realpath(APPPATH . '../doc/rps/');
        $this->gallery_path_url = base_url() . 'doc/rps/';
    }
    function renumbering_kd_jadwal()
    {
        $key['kd_prodi']='018';
        $key['kd_tahun_ajaran']='20211';
        $jadwals=$this->Akademika_model->get_list_selected('jadwal',$key);
        foreach($jadwals as $jadwal)
        {
            $kd_prodi=$jadwal->kd_prodi;
            $kd_ta=$jadwal->kd_tahun_ajaran;
            
            $data['kd_jadwal_baru']=$this->createNoJK($kd_prodi,$kd_ta);
             $data['kd_jadwal']=$jadwal->kd_jadwal;
             echo json_encode($data);
        }
    }
    public function index() {
        // $dosen = $this->Dosen_model->get_all();
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');vkrs
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            $data = array('data' => 'Bismillah',
                'hadist' => 'isbal');
            $data['homebase'] = $homebase;

            if ($level == "prodi") {
               $this->dashboard();
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    
    //modul kkn
    
     function list_kkn()
    {
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $kd_prodi=$this->session->userdata('home_base');
        $sql="SELECT kkn.file_transkrip, kkn.kd_tahun_ajaran,kkn.tgl_daftar,kkn.nim,kkn.jum_sks,kkn.status,mahasiswa.nm_mahasiswa,mahasiswa.angkatan,mahasiswa.jns_kelamin FROM `kkn`,mahasiswa where kkn.nim=mahasiswa.nim and mahasiswa.kd_prodi='".$kd_prodi."' and kkn.kd_tahun_ajaran='".$kd_tahun_ajaran."'";
         $data['list_kkn']= $this->db->query($sql)->result();
          $this->template->load($this->view, 'prodi/list_kkn', $data);
    }
    function tolak_kkn($kd_ta,$nim)
    {
        $key['nim']=$nim;
        $key['kd_tahun_ajaran']=$kd_ta;
        
        $hasil=$this->Akademika_model->get_row_selected('vkkn',$key);
        $data['nim']=$hasil->nim;
        $data['kd_tahun_ajaran']=$hasil->kd_tahun_ajaran;
        $data['nm_mahasiswa']=$hasil->nm_mahasiswa;
        $data['angkatan']=$hasil->angkatan;
        $data['jum_sks']=$hasil->jum_sks;
        $data['file_transkrip']=$hasil->file_transkrip;
        $data['keterangan']='';
        $this->template->load($this->view, 'prodi/fkkn_tolak', $data);
    }
    function atolak_kkn()
    {
        $key['nim']=$this->input->post('nim');
        $key['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran');
        $data['keterangan']=$this->input->post('keterangan');
        
        $this->Akademika_model->update_data('kkn',$data,$key);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <h4>Informasi...!</h4><p> Keterangan Penolakan KKN, berhasil tersimpan.</p>
					</div>');
    }
    function terima_kkn($nim)
    {
         $url="https://sidu.usn.ac.id/web/sidu_kkn_siakad.php?nim=$nim";
         $result=file_get_contents($url);
        $hasil=json_encode($result);
        if($hasil)
        {
            $key['nim']=$nim;
            $data['status']='Diterima';
            $this->Akademika_model->update_data('kkn',$data,$key);
             $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <h4>Informasi...!</h4><p> Update status KKN, berhasil tersimpan.</p>
					</div>');
        }else
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <h4>Informasi...!</h4><p> Update status KKN, gagal tersimpan.</p>
					</div>');
        }
        $this->list_kkn();
    }
    
    function hapus_kkn($kd_ta,$nim)
    {
        $key['nim']=$nim;
        $key['kd_tahun_ajaran']=$kd_ta;
        
        $this->Akademika_model->delete_data('kkn',$key);
        redirect(base_url('prodi/list_kkn'));
    }
    //absensi
    
    function list_absen()
    {
        
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $kd_prodi=$this->session->userdata('home_base');
        $sql="SELECT absensih.id_absen,absensih.aktif,materi,MAX(pertemuan_ke) as pertemuan_saat_ini, SUM(absensid.h) as h,SUM(absensid.i) as i,SUM(absensid.s)as s,SUM(absensid.a) as a,matakuliah.nm_mtk,jadwal.kelas,jadwal.hari,jadwal.jam,dayname(tgl_pertemuan) as tgl_pertemuan, time(tgl_pertemuan) as waktu_pertemuan,prodi.nm_prodi,dosen.nm_dosen,(absensih.pertemuan_ke),absensih.tgl_pertemuan, absensih.kd_jadwal,jadwal.kd_prodi FROM `absensih`,jadwal,prodi,dosen,matakuliah,absensid WHERE absensih.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_prodi=prodi.kd_prodi and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_prodi='".$kd_prodi."' and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and absensih.id_absen=absensid.id_absen group by absensih.id_absen";
         $data['list_absen']= $this->db->query($sql)->result();
          $this->template->load($this->view, 'prodi/labsen', $data);
    }
    
    
    function fedom()
    {
        $data['listta']=$this->Prodi_model->get_all('thnajaran');
        $this->template->load($this->view, 'prodi/fedom', $data);
    }
    
    function edom()
    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran');
        $kd_prodi=$this->session->userdata('home_base');
        $sql="SELECT dosen.NIDN,dosen.nm_dosen, matakuliah.nm_mtk,matakuliah.sks,no_1,no_2,no_3,no_4,no_5,no_6,no_7,no_8,no_9,no_10,nm_mtk 
        from quisioner_mahasiswa,jadwal,dosen,matakuliah 
        where quisioner_mahasiswa.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_prodi='".$kd_prodi."' and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_mtk=matakuliah.kd_mtk 
        order by nm_dosen asc";
        $data['list']= $this->db->query($sql)->result();
        $data['file']="LAP EDOM";
       $this->load->view('prodi/lap_edom_prodi_excel',$data);
    }
    function view_permintaan_akses_nilai()
    {
        $kd_prodi = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT permintaan_akses_nilai.kd_jadwal,jadwal.kd_tahun_ajaran,permintaan_akses_nilai.penjelasan,permintaan_akses_nilai.tgl_usul,permintaan_akses_nilai.status,jadwal.kelas,dosen.nm_dosen,dosen.NIDN,matakuliah.nm_mtk,matakuliah.sks 
        FROM `permintaan_akses_nilai`,jadwal,matakuliah,dosen 
        where permintaan_akses_nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_prodi='".$kd_prodi."' and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' order by permintaan_akses_nilai.status desc ";
         $hasil= $this->db->query($sql)->result();
        $data['list_permintaan']=$hasil;
         $this->template->load($this->view, 'prodi/list_permintaan_akses_nilai', $data);
        
    }
     function cek_tgl_batas_nilai()
    {
       // $this->load->model('Akademika_model');
        
        $status=false;
        $keyta['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
        $keyta['kd_kegiatan']='NILAI';
        $ta = $this->Akademika_model->get_row_selected('jadwalakademik', $keyta);
            
        //$ta=$this->Akademika_model->get_row_selected('jadwalakademik',$keyta);
        $tgl_batas=$ta->sampai_tanggal;
        $tgl_saat_ini=date("Y-m-d");
        if($tgl_saat_ini>$tgl_batas)
        {
            $status="lewat";
        }else
        {
            $status="belum";
        }
        return $status;
        //echo json_encode($status);
    }
    function setujui_permintaan_akses_nilai($kd_jadwal)
    {
        $cek=$this->cek_tgl_batas_nilai();
        $key['kd_jadwal']=$kd_jadwal;
        $data['status']='Diterima oleh Ka Prodi';
            
        if($cek=="belum")
        {
            $data['status']='Diterima oleh Ka Prodi';
            $data_jadwal['status']='Terbuka';
            //$this->Prodi_model->update_data('permintaan_akses_nilai',$data,$key);
            $this->Prodi_model->update_data('jadwal',$data_jadwal,$key);
            
        }
        
        $data['tgl_setujui_1']=date("Y-m-d");
        $this->Prodi_model->update_data('permintaan_akses_nilai',$data,$key);
         
          redirect('Prodi/view_permintaan_akses_nilai'); 
        
    }
    function tolak_permintaan_akses_nilai($kd_jadwal)
    {
        $key['kd_jadwal']=$kd_jadwal;
        $data['status']='Ditolak oleh Ka Prodi';
        $data_jadwal['status']='Tertutup';
        
        $this->Prodi_model->update_data('permintaan_akses_nilai',$data,$key);
         $this->Prodi_model->update_data('jadwal',$data_jadwal,$key);
          redirect('Prodi/view_permintaan_akses_nilai'); 
        
    }
    //modul ruang
    function ruang()
    {
         $kd_prodi = $this->session->userdata('home_base');
         $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
         $key['gedung']=$prodi->kd_fak;
        $data['list_ruang']=$this->Prodi_model->get_list_selected('ruang',$key);
         $this->template->load($this->view, 'prodi/lruang', $data);
    }
    function iruang()
    {
        $data['aksi']='input';
       // $data['list_ruang']=$this->Prodi_model->get_list_selected('ruang',$key);
         $this->template->load($this->view, 'prodi/fruang', $data);
    }
    function sruang()
    {
        $kd_prodi = $this->session->userdata('home_base');
         $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
         //$key['gedung']=$prodi->kd_fak;
        $data['kd_ruang']=$this->input->post('kd_ruang');
        $data['nm_ruang']=$this->input->post('nm_ruang');
        $data['kap_maksimal']=$this->input->post('kap_maksimal');
        $data['fasilitas']=$this->input->post('fasilitas');
        $data['gedung']=$prodi->kd_fak;
        $this->Prodi_model->save_data('ruang',$data);
        redirect(base_url() . 'Prodi/ruang'); 
        
    }
    function eruang($kd_ruang)
    {
        $key['kd_ruang']=$kd_ruang;
        $data=$this->Prodi_model->get_row_selected('ruang',$key);
         $this->template->load($this->view, 'prodi/eruang', $data);
         //$data->aksi='edit';
    }
    function uruang()
    {
        $kd_prodi = $this->session->userdata('home_base');
         $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
         //$key['gedung']=$prodi->kd_fak;
       
        $data['nm_ruang']=$this->input->post('nm_ruang');
        $data['kap_maksimal']=$this->input->post('kap_maksimal');
        $data['fasilitas']=$this->input->post('fasilitas');
        $data['gedung']=$prodi->kd_fak;
        $keys['kd_ruang']=$this->input->post('kd_ruang');
        $this->Prodi_model->update_data('ruang',$data,$keys);
        redirect(base_url() . 'Prodi/ruang'); 
    }
    function druang($kd_ruang)
    {
        $keys['kd_ruang']=$kd_ruang;
        $this->Prodi_model->delete_data('ruang',$keys);
        redirect(base_url() . 'Prodi/ruang'); 
    }
    //laporan data mahasiswa
    function frmhs()
    {
        $listta['listangkatan'] = $this->Prodi_model->get_all('angkatan');
        $this->template->load($this->view, 'prodi/frmhs', $listta);
    }
    function lap_mhs()
    {
         $home_base=$this->session->userdata('home_base');
        $key['angkatan']=$this->input->post('angkatan',true);
        $key['kd_prodi']= $home_base;
       
        $data['prodi']=$this->Akademika_model->get_data_prodi($home_base);
         $data['list']=$this->Akademika_model->get_list_selected('mahasiswa',$key);
        //$data['list']=$this->Akademika_model->get_list_selected('mahasiswa',$key);
        $this->load->view('prodi/lap_mhs', $data);
    }
    //modul do
    function ldo()
    {
         $homebase= $this->session->userdata('home_base');
         $data['listdo'] = $this->get_ldo($homebase);
		  //$prodi=$this->Prodi_model->get_row_selected('thnajaran');
		  $this->template->load($this->view, 'prodi/listdo', $data);
    }
    
    function fudo()
	{
	    $homebase= $this->session->userdata('home_base');
	    $data['aksi']='input';
		 $data['kd_tahun_ajaran']= $this->session->userdata('kd_tahun_ajaran');
	    //$data['kd_prodi']= $this->session->userdata('kd_tahun_ajaran');
		 $data['listmhs'] = $this->get_mhs_udo($homebase);
		  //$prodi=$this->Prodi_model->get_row_selected('thnajaran');
		  $this->template->load($this->view, 'prodi/fudo', $data);
	}
	function audo()
	{
	    
	}
	function lmhsdo($no_do)
	{
	    $data['listmhs'] = $this->get_lmhsdo($no_do);
		  //$prodi=$this->Prodi_model->get_row_selected('thnajaran');
		  $this->template->load($this->view, 'prodi/lmhsdo', $data);
	}
	public function get_lmhsdo($no_do)
	{
	    $sql="SELECT no_do,dod.nim,mahasiswa.nm_mahasiswa,angkatan,semester,status from dod,mahasiswa where dod.nim=mahasiswa.nim and no_do='".$no_do."'";
        $listdo= $this->db->query($sql)->result();
       return ($listdo);
	}
	public function get_ldo($kd_prodi)
	{
	    $sql="SELECT doh.no_do,tgl_do,kd_tahun_ajaran,count(*) as jumlah, angkatan from doh,dod where doh.no_do=dod.no_do and kd_prodi='".$kd_prodi."' group by doh.no_do ";
        $listdo= $this->db->query($sql)->result();
       return ($listdo);
	}
    //modul ustatus wisuda
    public function ustatus_lulus_mahasiswa()
    {
        $homebase = $this->session->userdata('home_base');
        $list=$this->get_wisudawan_ta($homebase);
        foreach($list as $r)
        {
            $key['nim']=$r->nim;
            $data['status']='L';
            $this->Akademika_model->update_data('mahasiswa',$data,$key);
        }
       redirect(base_url() . 'Prodi/list_wisudawan'); 
        
    }
    
    public function list_wisudawan()
    
    {
        $homebase = $this->session->userdata('home_base');
        $data['listwisudawan']=$this->get_wisudawan_ta($homebase);
         $this->template->load($this->view, 'prodi/listwisudawan', $data); 
        
    }
    private function get_wisudawan_ta($kd_prodi){
        $sql="SELECT wisudawan.nim,wisudawan.kd_tahun_ajaran,mahasiswa.nm_mahasiswa,mahasiswa.angkatan,mahasiswa.status FROM wisudawan,mahasiswa where wisudawan.nim=mahasiswa.nim and mahasiswa.kd_prodi='".$kd_prodi."' order by angkatan,nim ASC";
        $listwisudawan= $this->db->query($sql)->result();
        return ($listwisudawan);
    }
    
    //modul pembayaran
function fsinkron_pembayaran()
    {
        $data['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
        $this->template->load($this->view,'prodi/fsinkron_keuangan',$data);
    }
    public function sinkron_pembayaran()
    {
        
        $ta=$this->input->post('ta',true);
        $homebase = $this->session->userdata('home_base');
        $url="http://sidu.usn.ac.id/sidu_siakad.php?ta=$ta";
        $result=file_get_contents($url);
        $hasil=json_decode($result);
       //echo $hasil;
     
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
//modul pembayaran
public function rekap_reg_mhs_angkatan()
{
    $homebase = $this->session->userdata('home_base');
    $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
    $key['kd_prodi']= $homebase;
    $listmhs=$this->Akademika_model->get_list_selected('mahasiswa',$key);
    $list=array();
    foreach($listmhs as $mhs)
    {
        $sql2="SELECT * FROM `thnajaran` where `kd_tahun_ajaran` >='".$mhs->awal_semester."' and kd_tahun_ajaran<='".$kd_tahun_ajaran."' order by kd_tahun_ajaran asc";   
            $listta= $this->db->query($sql2)->result();
            //$data['listta']=$listta;
            //echo json_encode($listta);
            foreach($listta as $ta)
            {
                $status=$this->get_reg($mhs->nim,$ta->kd_tahun_ajaran);
                $data[$ta->kd_tahun_ajaran]=$status;
            }
          
           // $rec_ips=$this->get_ips($mhs->nim,$kd_tahun_ajaran);
            $data['nim']=$mhs->nim;
            $data['nm_mahasiswa']=$mhs->nm_mahasiswa;
            $data['angkatan']=$mhs->angkatan;
              $data['ukt']=$mhs->nilai_ukt;
            //$data['ips']=$rec_ips;
            array_push($list,$data);
    }
    echo json_encode($list);
}

function get_reg($nim,$ta)
{
    $a=0;
    $sql="SELECT * FROM `registrasi`,mjenis_registrasi where registrasi.jns_registrasi=mjenis_registrasi.kd_registrasi and kd_tahun_ajaran='".$ta."' and nim='".$nim."' ";
     $hasil= $this->db->query($sql)->row();
     if($hasil)
     {
         $a=$hasil->nm_registrasi;
     }else
     {
         $a='Unreg';
     }return $a;
}
//modul yudisium


 function lap_yudisium_ta_f()
{
   $data['listta'] = $this->Prodi_model->get_all_desc('thnajaran','kd_tahun_ajaran');
     $this->template->load($this->view, 'prodi/lap_yudisium_ta_f', $data); 
}
function lap_yudisium_ta()
{
 $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
     $kd_prodi = $this->session->userdata('home_base');
      $data['prodi']=$this->Akademika_model->get_data_prodi($kd_prodi);
    $sql="select no_daftar,tgl_daftar,yudisium.nim,nm_mahasiswa,angkatan,judul,nilai,ipk,yudisium.status from yudisium,mahasiswa where yudisium.nim=mahasiswa.nim and kd_tahun_ajaran='".$kd_tahun_ajaran."' and yudisium.kd_prodi='".$kd_prodi."'";
    $data['list']=$this->db->query($sql)->result();
    $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
     $this->load->view('prodi/lap_yudisium_ta_r', $data); 
}
public function get_skripsi()
{
    // $keynim['nim']=$nim;
        $home_base=$this->session->userdata('home_base');
        $key['nim']=$this->input->post('nim',TRUE);
        $key['urutan']='2';
        
        $hasil=$this->Akademika_model->get_row_selected('daftar',$key);
        
        
        echo json_encode($hasil);
    
}
function fyudisium()
{
    $data['aksi']='input';
     $data['ta'] = $this->session->userdata('kd_tahun_ajaran');
    $this->template->load($this->view, 'prodi/fyudisium', $data);
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

public function lyudisium()
{
     $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
     $kd_prodi = $this->session->userdata('home_base');
    $sql="select no_daftar,tgl_daftar,yudisium.nim,nm_mahasiswa,angkatan,judul,nilai,ipk,yudisium.status from yudisium,mahasiswa where yudisium.nim=mahasiswa.nim and kd_tahun_ajaran='".$kd_tahun_ajaran."' and yudisium.kd_prodi='".$kd_prodi."'";
    $data['list']=$this->db->query($sql)->result();
    $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
    
    $this->template->load($this->view, 'prodi/lyudisium', $data);
}
//modul input nilai

public function fnilai_mhs_ta()
{
    $kd_prodi = $this->session->userdata('home_base');
    $data['listta']=$this->Akademika_model->get_all('thnajaran');
    $keymtk['kd_prodi']=$kd_prodi;
    $data['listmtk']=$this->Akademika_model->get_list_selected('matakuliah',$keymtk);
    
     $this->template->load($this->view, 'prodi/fnilai_mhs_ta', $data);
}

public function anilai_mhs_ta()
{
    $kd_prodi = $this->session->userdata('home_base');
    $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true);
    $nim=$this->input->post('nim',true);
    
    $kd_mtk=$this->input->post('kd_mtk',true);
    $kelas=$this->input->post('kelas',true);
     $angkatan=$this->input->post('angkatan',true);
     $nilai=$this->input->post('nilai',true);
    
    //baca krs
    $keykrsh['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $keykrsh['nim']=$nim;
    $krsh=$this->Akademika_model->get_row_selected('rencanastudih',$keykrsh);
    
    $no_krs=$krsh->no_krs;
   
    //baca jadwal
    $keyjadwal['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $keyjadwal['kd_mtk']=$kd_mtk;
    $keyjadwal['kelas']=$kelas;
    
    $jadwal=$this->Akademika_model->get_row_selected('jadwal',$keyjadwal);
    $cek = $this->session->userdata('userid');
        $kd_jadwal=$jadwal->kd_jadwal;
    $keymtk['kd_mtk']=$kd_mtk;
   $mtk=$this->Akademika_model->get_row_selected('matakuliah',$keymtk);
   $datanilai['no_krs']=$no_krs;
   $datanilai['aktif']='Ya';
   $datanilai['kd_jadwal']=$kd_jadwal;
   $datanilai['kd_mtk']=$kd_mtk;
   $datanilai['sks']=$mtk->sks;
   $datanilai['nilai']=$nilai;
   $datanilai['status']='Ya';
   $datanilai['edit_by']=$cek;
   $this->Akademika_model->save_data('rencanastudid',$datanilai);
   $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Data nilai telah disimpan...!</p>
					</div>');
     redirect(base_url() . 'prodi/fnilai_mhs_ta');
    
}

//modul pemilihan bem
 

///modul registrasi pemilih
public function generate_pemilih()
{
    $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
    $homebase = '012';
    $homebase2 = '022';
    $keyreg['kd_prodi']=$homebase;
    $keyreg['periode']='2019-2020';
    
    $this->Akademika_model->delete_data('registrasi_pemilih_bem',$keyreg);
    $this->Akademika_model->delete_data('voting_hmps',$keyreg);
    
    //$sql2="delete from registrasi_pemilih_bem where kd_prodi='".$homebase."'";
   $sql="select * from registrasi where kd_tahun_ajaran='".$kd_tahun_ajaran."' and (home_base='".$homebase."' or home_base='".$homebase2."')";
   $hasil= $this->db->query($sql)->result();
   foreach($hasil as $row)
   {
       $data['tgl_registrasi']=date('Y-m-d');
       $data['periode']='2019-2020';
       $data['nim']=$row->nim;
       $data['kunci']=$this->Akademika_model->acak2(4);
        $data['kd_prodi']=$homebase;
      
       
       
       $this->Akademika_model->save_data('registrasi_pemilih_bem',$data);
   }
   redirect(base_url() . 'prodi/lreg_pemilih');
}

public function dashboard_pemilihan()
{
    $sql="SELECT voting_hmps.no_calon,mahasiswa.nm_mahasiswa,mahasiswa.foto,COUNT(*)as jumlah FROM `voting_hmps`,calon_hmps,mahasiswa WHERE voting_hmps.no_calon=calon_hmps.no_calon and calon_hmps.nim=mahasiswa.nim GROUP by voting_hmps.periode,voting_hmps.kd_prodi,voting_hmps.no_calon";
    $data['hasil'] = $this->db->query($sql)->result();
    
}
public function print_reg_pemilih_hmps()
{
    $homebase = $this->session->userdata('home_base');
    $periode='2019-2020';
    $kd_prodi='012';
      $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
      $sql="select registrasi_pemilih_hmps.nim,nm_mahasiswa,angkatan,registrasi_pemilih_hmps.status,registrasi_pemilih_hmps.kunci from registrasi_pemilih_hmps,mahasiswa where registrasi_pemilih_hmps.nim=mahasiswa.nim and periode='".$periode."' and registrasi_pemilih_hmps.kd_prodi='".$kd_prodi."' order by mahasiswa.kd_prodi,angkatan,mahasiswa.nim asc";
       $data['list'] = $this->db->query($sql)->result();
    // $data['list'] = $this->Akademika_model->get_list_selected('registrasi_pemilih_bem',$key);
      $this->load->view('prodi/lap_reg_pemilih_hmps', $data);
}
public function print_reg_pemilih()
{
    $homebase = $this->session->userdata('home_base');
    $periode='2019-2020';
    $kd_prodi='012';
      $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
      $sql="select registrasi_pemilih_bem.nim,nm_mahasiswa,angkatan,tgl_registrasi,registrasi_pemilih_bem.status,registrasi_pemilih_bem.kunci from registrasi_pemilih_bem,mahasiswa where registrasi_pemilih_bem.nim=mahasiswa.nim and periode='".$periode."' and registrasi_pemilih_bem.kd_prodi='".$kd_prodi."' order by mahasiswa.kd_prodi,angkatan,mahasiswa.nim asc";
       $data['list'] = $this->db->query($sql)->result();
    // $data['list'] = $this->Akademika_model->get_list_selected('registrasi_pemilih_bem',$key);
      $this->load->view('prodi/lap_reg_pemilih', $data);
}
public function lreg_pemilih()
{
    
     $data['listdata'] = $this->Akademika_model->get_all('registrasi_pemilih_bem');
      $this->template->load($this->view, 'prodi/lreg_pemilih', $data);
      
}
public function lreg_pemilih_hmps()
{
    
     $data['listdata'] = $this->Akademika_model->get_all('registrasi_pemilih_hmps');
      $this->template->load($this->view, 'prodi/lreg_pemilih_hmps', $data);
      
}

function freg_pemilih_hmps()
{
     $cek = $this->session->userdata('userid');

        if (empty($cek)) {
            redirect(base_url());
        } else {

                    $datax['nim'] = '';
                    $datax['tgl_registrasi'] = '';
                    $datax['periode'] = '2019-2020';
                    

                    //$datax['listmhs']=$this->Prodi_model->get_all('mahasiswa');
                    $this->template->load($this->view, 'prodi/freg_pemilih_hmps', $datax);
                }
            } 


function areg_pemilih_hmps()
{
     $cek = $this->session->userdata('userid');
$homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {

    $akun=$this->Akademika_model->acak2(4);
   // $qrcode= 'https://siakad.usn.ac.id/mahasiswa/fpilih_hpms/'.$akun;
        
 //  echo '<img src="https://api.qrserver.com/v1/create-qr-code/?data='.$qrcode.'"&amp;size=100x100" alt="" title="" />';
    $datax['nim'] = $this->input->post('nim',true);
   $datax['status'] = '0';
    $datax['periode'] = '2019-2020';
    $datax['kunci']=$akun;
     $datax['tgl_registrasi']=$akun;
  
     $datax['kd_prodi']=$homebase;
   
    $this->Akademika_model->save_data('registrasi_pemilih_hmps',$datax);
    //$key['userid']=$this->input->post('nim',true);
   
    //$this->Akademika_model->update_data('user',$data,$key);
                    
$this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Gunakan Hak Pilih Anda dengan bijak. Terimakasih</p>
					</div>');
                    //$datax['listmhs']=$this->Prodi_model->get_all('mahasiswa');
                     redirect(base_url() . 'prodi/lreg_pemilih_hmps');
                }
            } 

//modul laporan


public function list_stauts_penelitian_mahasiswa()
{
    $sql="SELECT daftar_judul.nim,mahasiswa.nm_mahasiswa,angkatan,mahasiswa.status,status_akademik,pembimbing_skripsi.pembimbing,dosen.nm_dosen,dosen.jafung,pembimbing_skripsi.pembimbing_ke from daftar_judul,pembimbing_skripsi,mahasiswa,dosen where daftar_judul.no_daftar=pembimbing_skripsi.no_daftar and daftar_judul.nim=mahasiswa.nim and pembimbing_skripsi.pembimbing=dosen.kd_dosen order by daftar_judul.nim,pembimbing_skripsi.pembimbing_ke asc ";
}
//modul skripsi
public function rekap_penguji_ta()
{
    $sql="SELECT daftar.kd_tahun_ajaran, daftar_judul.nim,nm_mahasiswa,daftar.judul,dosen.NIDN,dosen.nm_dosen,(SELECT 2) as jns_peran,penguji.penguji_ke as urutan,prodi.kd_prodi_forlap,jenis_ujian_prodi.jenis_ujian from prodi,daftar,penguji,daftar_judul,mahasiswa,jenis_ujian_prodi,dosen where daftar_judul.nim=mahasiswa.nim and daftar_judul.no_daftar=daftar.no_daftar_judul and daftar.no_daftar=penguji.no_daftar and daftar.urutan=jenis_ujian_prodi.urutan and penguji.penguji=dosen.kd_dosen and mahasiswa.kd_prodi=prodi.kd_prodi";
    $data['list']=$this->db->query($sql)->result();
    $data['file']='daftar_ujian';
    $this->load->view('prodi/export_list_penguji.php',$data);

    //echo json_encode($pembimbing);
}
public function rekap_penguji_tax($kd_prodi,$kd_tahun_ajaran)
{
    $sql="SELECT daftar.kd_tahun_ajaran, daftar_judul.nim,nm_mahasiswa,daftar.judul,dosen.NIDN,dosen.nm_dosen,(SELECT 2) as jns_peran,penguji.penguji_ke as urutan,prodi.kd_prodi_forlap,jenis_ujian_prodi.jenis_ujian from prodi,daftar,penguji,daftar_judul,mahasiswa,jenis_ujian_prodi,dosen where daftar.kd_prodi='".$kd_prodi."' and daftar.kd_tahun_ajaran='".$kd_tahun_ajaran."' and daftar_judul.nim=mahasiswa.nim and daftar_judul.no_daftar=daftar.no_daftar_judul and daftar.no_daftar=penguji.no_daftar and daftar.urutan=jenis_ujian_prodi.urutan and penguji.penguji=dosen.kd_dosen and mahasiswa.kd_prodi=prodi.kd_prodi";
    $pembimbing=$this->db->query($sql)->result();
    echo json_encode($pembimbing);
}
public function rekap_total_bimbingan_dosen()
{
   //$data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
   $kd_prodi=$this->session->userdata('home_base');
   $data['prodi']=$this->Akademika_model->get_data_prodi($kd_prodi);
   $keyprodi['kd_prodi']=$kd_prodi;
   $data['listdosen']=$this->Akademika_model->get_list_selected('dosen',$keyprodi);
   $data['list']= $this->Akademika_model->get_jumlah_mhs_bimbingan_by_prodi($kd_prodi);
    $this->load->view('prodi/lap_rekap_jum_bimbingan_dosen', $data);
}

public function flap_pengujian_dosen_prodi_ta()
{
      $datax['listta'] = $this->Prodi_model->get_all('thnajaran');
    $this->template->load($this->view, 'prodi/flap_pengujian_dosen_ta', $datax);
}
public function rekap_pengujian_dosen_prodi_ta()
{
    $kd_prodi=$this->session->userdata('home_base');
    $ta=$this->input->post('kd_tahun_ajaran',true);
   //$data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
   $kd_prodi=$this->session->userdata('home_base');
   $data['prodi']=$this->Akademika_model->get_data_prodi($kd_prodi);
   $data['list']= $this->Akademika_model->get_jumlah_pengujian_dosen($kd_prodi,$ta);
   $data['ta']=$ta;
   $this->load->view('prodi/lap_jumlah_pengujian_dosen_angkatan', $data);
}

public function fjudul()
{
    $data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
   
    $this->template->load($this->view, 'prodi/flap_judul', $data);
}

public function laporan_judul()
{
    $homebase = $this->session->userdata('home_base');
    $angkatan=$this->input->post('angkatan');
    $status=$this->input->post('status');
    $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
    if($status=='sudah')
    {
        $data['list']=$this->Akademika_model->get_mhs_blm_judul($homebase,$angkatan,$status);
         $this->load->view('prodi/lap_pengajuan_judu_sudah', $data);
    }else
    {
         $data['list']=$this->Akademika_model->get_mhs_blm_judul($homebase,$angkatan,$status);
         $this->load->view('prodi/lap_pengajuan_judu_belum', $data);
    }
   
    
}
function edit_usulan_judul($no_daftar)
{
    $homebase=$this->session->userdata('home_base');
    $keydaftar['no_daftar']=$no_daftar;
    $usulan=$this->Prodi_model->get_row_selected('daftar_judul',$keydaftar);
    $data['aksi']='edit';
     $sql3="select no_daftar,pembimbing,nm_dosen,jafung,pembimbing_ke from pembimbing_skripsi,dosen where pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_skripsi.no_daftar='".$no_daftar."'";
    $pembimbing=$this->db->query($sql3)->result();
    foreach($pembimbing as $row)
   {
       if($row->pembimbing_ke==1)
       {
           $data['kd_dosen1']=$row->pembimbing;
           $data['nm_dosen1']=$row->nm_dosen;
            $data['jafung1']=$row->jafung;
       }
       if($row->pembimbing_ke==2)
       {
           $data['kd_dosen2']=$row->pembimbing;
           $data['nm_dosen2']=$row->nm_dosen;
            $data['jafung2']=$row->jafung;
       }
       
   }
     $data['nim']=$usulan->nim;
     $data['no_daftar']=$no_daftar;
      $data['tgl_daftar']=$usulan->tgl_daftar;
    $keydosen['kd_prodi']=$homebase;
    $data['dosen']=$this->Prodi_model->get_list_selected('dosen',$keydosen);
   
    $data['judul']=$usulan->judul;
    $this->template->load($this->view, 'prodi/daftar_judul', $data);
}
//modul pindah kelas
public function list_mhs_jadwal($kd_jadwal)
{
           $list['list'] = $this->Akademika_model->get_list_mhs_kelas($kd_jadwal);
     $this->template->load($this->view, 'prodi/list_mhs_jadwal', $list);
}
function fpindah_kelas($nim,$kd_jadwal)
{
    $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
    $keyjadwal_asal['kd_jadwal']=$kd_jadwal;
    $hasil=$this->Akademika_model->get_row_selected('jadwal',$keyjadwal_asal);
    $kd_mtk=$hasil->kd_mtk;
    $keyjadwal['kd_mtk']=$kd_mtk;
    $keyjadwal['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $keymhs['nim']=$nim;
    $data['mtk']=$hasil;
    
    $data['listkelas']=$this->Akademika_model->get_list_selected('jadwal',$keyjadwal);
    $data['mhs']=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
    $this->template->load($this->view, 'prodi/fpindah_kelas', $data);
}
 function pindah_kelas()
{
    
     $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
     $nim=$this->input->post('nim');
     $kd_kelas_asal=$this->input->post('kd_jadwal_asal');
     $kd_kelas_tujuan=$this->input->post('kd_kelas_tujuan');
     $keykrs['nim']=$nim;
     $keykrs['kd_tahun_ajaran']=$kd_tahun_ajaran;
     $krsh=$this->Akademika_model->get_row_selected('rencanastudih',$keykrs);
     $no_krs=$krsh->no_krs;
     $keykrsd['no_krs']=$no_krs;
     $keykrsd['kd_jadwal']=$kd_kelas_asal;
     $data['kd_jadwal']=$kd_kelas_tujuan;
     $this->Akademika_model->update_data('rencanastudid',$data,$keykrsd);
     redirect(base_url().'prodi/list_mhs_jadwal/'.$kd_kelas_asal);
    
} 
function fpilih_angkatan()
{
    $data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
    $this->template->load($this->view, 'prodi/fpilih_angkatan', $data);
   
}
function nilai_kelas($kd_jadwal) 
    {
        $list['head'] = '';
        $list['list'] = '';
        
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $keyjadwal['kd_jadwal'] = $kd_jadwal;
            $rowjadwal = $this->Akademika_model->get_row_selected('jadwal', $keyjadwal);
            
            $homebase=$rowjadwal->kd_prodi;

            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);

            $level = $row->level;
            if ($level == "prodi") {

                $list['kd_tahun_ajaran'] = $rowjadwal->kd_tahun_ajaran;
                $list['head'] = $this->Akademika_model->get_jadwal_mtk($kd_jadwal);
                $list['list'] = $this->Akademika_model->get_list_mhs_kelas($kd_jadwal);
                 $list['prodi']=$this->Akademika_model->get_data_prodi($homebase);
               $this->load->view('dosen/lapnilaikelas', $list);
                //$this->load->view('dosen/lap_nilai_kelas_excel', $list);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    
    function list_mhs_kelas($kd_jadwal) {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        //cek jadwal open atau close
       $this->cek_jadwal($kd_jadwal);
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);

            $level = $row->level;
            if ($level == "prodi") {
                $list['data'] = $this->get_jadwal_mtk($kd_jadwal);
                $list['list'] = $this->get_list_mhs_kelas($kd_jadwal);
                $kd_nilai="D";
                $sql="select * from tnilai,snilaiangkatan where tnilai.kd_nilai=snilaiangkatan.kd_nilai";
                $list['lnilai'] = $this->db->query($sql)->result();
                $this->template->load($this->view, 'prodi/lmhskls', $list);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    function unilai() {
        $sms = 0;
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                // $udata['nilai']=3;
                // $key['no_krs']='KRSSI00000001';
                // $key['kd_jadwal']='JMsi201621111207';
                $udata['nilai'] = $this->input->post('nilai', true);
                $udata['edit_by'] = $cek;
                $key['no_krs'] = $this->input->post('no_krs', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);

                $sms = $this->Akademika_model->update_data('rencanastudid', $udata, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
    function cek_jadwal($kd_jadwal)
    {
    $keyjadwal['kd_jadwal']=$kd_jadwal;
    $keyjadwal['status']="Tertutup";
    
    $status = $this->Akademika_model->get_row_selected('jadwal', $keyjadwal);
    if (!empty($status) and $status->status=='Tertutup')
        {
             $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Kelas ini sudah tertutup dan tidak dapat dilakukan perubahan lagi.</p>
					</div>');
            redirect(base_url().'prodi/ljm');
        }
        

    }
    private function get_jadwal_mtk2($kd_jadwal)
    {
        
        $sql = "SELECT matakuliah.*, jadwal.kd_jadwal,jadwal.kelas FROM `jadwal`,matakuliah WHERE jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_jadwal='".$kd_jadwal."'";
        $output = $this->db->query($sql)->row();
        return $output;
    }
    private function get_jadwal_mtk($kd_jadwal) {
        $sql = "SELECT dosen.nm_dosen,dosen.NIDN,`jadwal`.`kd_jadwal`, `jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`,`jadwal`.`kd_dosen`, `matakuliah`.`sks`, `matakuliah`.`semester_ke`,`jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kd_ruang` FROM  `jadwal` INNER JOIN  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` inner join dosen on jadwal.kd_dosen=dosen.kd_dosen WHERE `jadwal`.`kd_jadwal` ='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->row();
        return $output;
    }
     private function get_list_mhs_kelas($kd_jadwal) {

        $sql = "SELECT nilai_angka,`rencanastudid`.`kd_jadwal`, `rencanastudih`.`nim`, `rencanastudih`.`no_krs`, `rencanastudid`.`nilai`,  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`
FROM  `rencanastudih` INNER JOIN  `rencanastudid` ON `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs`
  INNER JOIN  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim`  where `rencanastudid`.`kd_jadwal`='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->result();
        return $output;
    }
public function laporan_ujian_ta()
{
    
    $data['listta']=$this->Akademika_model->get_all('thnajaran');
      $this->template->load($this->view, 'laporan/lap_ujian_jenis_ta_f', $data);
   
     

       
}
public function get_lap_ujian_ta()
{
    $jenis_ujian=$this->input->post('jenis_ujian',true);
    $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true);
    $kd_prodi = $this->session->userdata('home_base');
    $keyprodi['kd_prodi']=$kd_prodi;
            $prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Prodi_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
    
    
    $sql="SELECT daftar.nilai,daftar.lulus,daftar.tgl_ujian,daftar.nim,mahasiswa.nm_mahasiswa,daftar.judul,jenis_ujian_prodi.jenis_ujian FROM `daftar`,mahasiswa,jenis_ujian_prodi WHERE daftar.nim=mahasiswa.nim and daftar.kd_prodi='".$kd_prodi."' and kd_tahun_ajaran='".$kd_tahun_ajaran."' AND daftar.urutan=jenis_ujian_prodi.urutan and daftar.kd_prodi=jenis_ujian_prodi.kd_prodi and daftar.urutan='".$jenis_ujian."' and daftar.status>='2'   order by tgl_ujian asc";
   
    $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
     $keyprodi['urutan']=$jenis_ujian;
     
     $jns_ujian=$this->Prodi_model->get_row_selected('jenis_ujian_prodi',$keyprodi);
      $data['jenis_ujian']=$jns_ujian->jenis_ujian;
     $hasil = $this->db->query($sql)->result();
    //echo json_encode($hasil);
     $data['list']=$hasil;
      $this->load->view('laporan/lap_ujian_jenis_ta_r', $data);

       
}

//fungsi reset krs
public function reset_krs($no_krs)
{
   
    $data['setujui_pa']='Tidak';
    $id['no_krs']=$no_krs;
    $row=$this->Prodi_model->get_row_selected('rencanastudih',$id);
    $nim=$row->nim;
    $this->Prodi_model->update_data('rencanastudih', $data, $id);
     $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>KRS sudah direset.</p>
                    </div>');
   redirect(base_url().'prodi/krs_mhs/'.$nim);
  
}

//modul rekap sks lulus

function rekap_sks_lulus()
{
    $list=array();
    $angkatan='2018';
    $key['angkatan']=$angkatan;
    $list_mhs=$this->Akademika_model->get_list_selected('mahasiswa',$key);
    foreach($list_mhs as $row)
    {
        $data['nim']=$row->nim;
        $data['nm_mahasiswa']=$row->nm_mahasiswa;
        $data['angkatan']=$row->angkatan;
        $data['kd_prodi']=$row->kd_prodi;
        $data['total_sks_lulus']=$this->Akademika_model->get_tot_sks_lulus($row->nim);
        array_push($list,$data);
    }
    echo json_encode($list);
}

//MODUL BEASISWA


function beasiswa()
{
       $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
       $kd_prodi = $this->session->userdata('home_base');
       $a=$this->get_beasiswa($kd_tahun_ajaran,$kd_prodi);
       $data['list']=$a;
       
       
        $this->template->load($this->view, 'prodi/list_penerima_beasiswa', $data);
       
}


function get_beasiswa($kd_tahun_ajaran,$kd_prodi)
{
    $sql="select beasiswa.jenis_beasiswa,beasiswa.nim,nm_mahasiswa,angkatan,nilai_ukt,semester,status from beasiswa,mahasiswa where beasiswa.nim=mahasiswa.nim and beasiswa.kd_tahun_ajaran='".$kd_tahun_ajaran."' and mahasiswa.kd_prodi='".$kd_prodi."'";
     $hasil = $this->db->query($sql)->result();
    return ($hasil);
    
}
//modul setting tahun ajaran aktif
function lta() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
       
        if (empty($cek)) {
            redirect(base_url());
        } else {
           
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
             
                $key1['kd_prodi']=$homebase;
                $listta['listta'] = $this->Prodi_model->get_list_selected('thnajaranprodi', $key1);

                

              
                $this->template->load($this->view, 'prodi/listta', $listta);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    
function hapus_matkul_krs($no_krs,$kd_mtk)
{
    $key['no_krs']=$no_krs;
    $key['kd_mtk']=$kd_mtk;
    
    //$this->Prodi_model->update_data('rencanastudid',$data,$key);
    $keykrs['no_krs']=$no_krs;
    $krs=$this->Prodi_model->get_row_selected('rencanastudih',$keykrs);
    $nim=$krs->nim;
    $data['aktif']="Tidak";
    $this->Prodi_model->update_data('rencanastudid',$data,$key);
    
     redirect(base_url().'Prodi/list_matkul_mhs/'.$nim);
    
}
function aktif_matkul_krs($no_krs,$kd_mtk)
{
    $key['no_krs']=$no_krs;
    $key['kd_mtk']=$kd_mtk;
    
    //$this->Prodi_model->update_data('rencanastudid',$data,$key);
    $keykrs['no_krs']=$no_krs;
    $krs=$this->Prodi_model->get_row_selected('rencanastudih',$keykrs);
    $nim=$krs->nim;
    $data['aktif']="Ya";
    
    $this->Prodi_model->update_data('rencanastudid',$data,$key);
    
     redirect(base_url().'Prodi/list_matkul_mhs/'.$nim);
    
}
// modul aktivitas kuliah mahasiswa

function fakam()
{
    $level = $this->session->userdata('level');
        if ($level == "prodi") {
            $datax['nim']='';
            $datax['sks_total']='';
            $datax['sks_semester']='';
            $datax['kd_tahun_ajaran']='';
            $datax['ipk']='';
            $datax['ips']='';
        $this->template->load($this->view, 'prodi/akm', $datax);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
}

function aakm()
{
        
    $datax['nim']=$this->input->post('nim',true);
    $datax['sks_total']=$this->input->post('sks_total',true);
    $datax['sks_semester']=$this->input->post('sks_semester',true);
    $datax['kd_tahun_ajaran']=$this->input->post('kd_tahun_ajaran',true);
    $datax['ipk']=$this->input->post('ipk',true);
    $datax['ips']=$this->input->post('ips',true);
    //$datax=$this->input->post('reg',true);
    $this->Prodi_model->save_data('akm', $datax);
        $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data sudah tersimpan</p>
                    </div>');
    redirect('Prodi/fakam');
    
}
    //modul upload rps
    function fuploadrps($kd_mtk) {
        $level = $this->session->userdata('level');
        if ($level == "prodi") {
            $datax['kd_mtk'] = $kd_mtk;
            $this->template->load($this->view, 'prodi/uploadrps', $datax);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }



    function uploadrps() {
        $key['kd_mtk'] = $this->input->post('kd_mtk');
        if ($this->input->post('upload')) {
            $config = array(
                'allowed_types' => 'pdf|doc|docx|rtf',
                'upload_path' => $this->gallery_path,
                'max_size' => 2000,
                'file_name' => url_title($this->input->post('file_upload'))
            );

            $this->load->library('upload', $config);
            $this->upload->do_upload();
        }
        //  $this->gallery_path_url = base_url() . 'doc/rps/';
        $file = $this->upload->file_name;
        $data['linkrps'] = $this->gallery_path_url  . $file;
        $this->Prodi_model->update_data('matakuliah', $data, $key);
        ///////// END

        redirect('Prodi/lmatakuliah');
    }

    function detailmtk($kd_mtk)
    {
         $key['kd_mtk']=$kd_mtk;
         $data['detail_mtk']=$this->Akademika_model->get_list_selected('matakuliahd',$key);
         $data['mtk']=$this->Akademika_model->get_row_selected('matakuliah',$key);
         $data['kd_mtk']=$kd_mtk;
          $this->template->load($this->view, 'prodi/detail_matakuliah', $data);
       
         
    }
    function jurnal_kuliah($kd_mtk)
    {
         $homebase = $this->session->userdata('home_base');
        $key['kd_mtk']=$kd_mtk;
         $data['detail_mtk']=$this->Akademika_model->get_list_selected('matakuliahd',$key);
         $data['mtk']=$this->Akademika_model->get_row_selected('matakuliah',$key);
         $data['kd_mtk']=$kd_mtk;
         
                    $keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
				$data['fak']=$fak;
                $data['prodi']=$prodi;
               
         // $this->template->load($this->view, 'prodi/detail_matakuliah', $data);
           $this->load->view('prodi/jurnal_kuliah', $data);
    }
    function tambah_detailmtk($kd_mtk)
    {
         $data['kd_mtk']=$kd_mtk;
         $data['pertemuan']=$this->get_last_detail_mtk($kd_mtk);
         $data['sub_cp_mk']='';
         $data['indikator']='';
         $data['kriteria_bentuk_penilaian']='';
         $data['metode_pembelajaran']='';
         $data['materi_pembelajaran']='';
         $data['bobot_penilaian']='';
         $this->template->load($this->view, 'prodi/fdetail_matakuliah', $data);
         
    }
    function adetail_matakuliah()
    {
        $kd_mtk=$this->input->post('kd_mtk');
        $data['kd_mtk']=$kd_mtk;
        $data['pertemuan']=$this->input->post('pertemuan');
         $data['sub_cp_mk']=$this->input->post('sub_cp_mk');
         $data['indikator']=$this->input->post('indikator');
         $data['kriteria_bentuk_penilaian']=$this->input->post('kriteria_bentuk_penilaian');
         $data['metode_pembelajaran']=$this->input->post('metode_pembelajaran');
         $data['materi_pembelajaran']=$this->input->post('materi_pembelajaran');
         $data['bobot_penilaian']=$this->input->post('bobot_penilaian');
         
         $cek=$this->Akademika_model->save_data('matakuliahd',$data);
         if($cek)
         {
            $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data derail rencana pembelajaran sukses tersimpan</p>
					</div>');
				
         }else
         {
             $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data derail rencana pembelajaran gagal tersimpan</p>
					</div>');
         }
         	redirect(base_url('prodi/detailmtk').'/'.$kd_mtk); 
    }
    function ddetail_mtk($kd_mtk,$pertemuan)
    {
        
       
         $key['kd_mtk']=$kd_mtk;
          $key['pertemuan']=$pertemuan;
         
         
         $cek=$this->Akademika_model->delete_data('matakuliahd',$key);
         if($cek)
         {
            $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data detail rencana pembelajaran sukses dihapus</p>
					</div>');
				
         }else
         {
             $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data derail rencana pembelajaran gagal dihapus</p>
					</div>');
         }
         	redirect(base_url('prodi/detailmtk').'/'.$kd_mtk); 
    }
    function get_last_detail_mtk($kd_mtk)
    {
        $output=0;
        $sql="select * from matakuliahd where kd_mtk='".$kd_mtk."' order by pertemuan desc limit 1";
        
        $hasil = $this->db->query($sql)->row();
        if($hasil)
        {
            $output= $hasil->pertemuan;
            
        }
        else
        {
              $output=0;
        }
        return $output+1;
    }
    //modul pa
    function preview_all_pa_dosen() {
      $kd_dosen= $this->input->post('kd_dosen', TRUE);
      $homebase=$this->session->userdata('home_base');
      $list['prodi']=$this->Akademika_model->get_data_prodi($homebase);
   // $kd_dosen = '0017038504';
   $keydosen['kd_dosen']=$kd_dosen;
   $list['dosen']=$this->Prodi_model->get_row_selected('dosen',$keydosen);
    $list['listmhsbimbingan'] = $this->Akademika_model->get_list_mhs_bimbingan($kd_dosen,$homebase);

    $this->load->view('prodi/lap_mhs_bimbingan', $list);

    }

    function fpreview_all_pa_dosen()
    {
        
        $keydosen['kd_prodi']=$this->session->userdata('home_base');
         $datax['listdosen']=$this->Prodi_model->get_list_selected('dosen', $keydosen);
          $datax['listta'] = $this->Prodi_model->get_all('thnajaran');
         $this->template->load($this->view, 'prodi/flap_all_pa', $datax);
    }
    function fpreview_pa()
    {
        
    
      	$key['kd_prodi'] = $this->session->userdata('home_base');
		 
		  $prodi=$this->Prodi_model->get_row_selected('prodi', $key);
         $datax['listdosen']=  $this->get_dosen_fakultas($prodi->kd_fak);
          $datax['listta'] = $this->Prodi_model->get_all('thnajaran');
         $this->template->load($this->view, 'prodi/flap_pa', $datax);
    }
    
    function preview_pa()
    {
    
          $kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
          $dosen= $this->input->post('kd_dosen', TRUE);
          $datax['jarak']= $this->input->post('jarak', TRUE);
          $homebase = $this->session->userdata('home_base');
           $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $sql="select mahasiswa.no_hp,pad.nim,nm_mahasiswa,mahasiswa.status,angkatan,pah.kd_dosen,nm_dosen,registrasi.no_reg_bank,registrasi.tgl_reg_bank,tgl_reg_bak from pad,pah,registrasi,mahasiswa,dosen WHERE pah.no_pa=pad.no_pa and pad.nim=registrasi.nim and pad.nim=mahasiswa.nim and dosen.kd_dosen=pah.kd_dosen and mahasiswa.kd_prodi='".$homebase."' and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."' and pah.kd_dosen='".$dosen."' group by registrasi.nim order by angkatan,nm_mahasiswa asc";
         $hasil = $this->db->query($sql)->result();
         //echo json_encode($hasil);
          $datax['listmhsbimbingan'] = $hasil;
          $keydosen['kd_dosen']=$dosen;
          $datax['dosen']=$this->Akademika_model->get_row_selected('dosen',$keydosen);
           $datax['prodi']=$this->Akademika_model->get_data_prodi($homebase);
          $this->load->view('prodi/lap_mhs_bimbingan', $datax);
    }

    function pilihta()
    {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
 

            $datax['listta'] = $this->Prodi_model->get_all('thnajaran');
             


            //   $this->load->view('bak/dkabak',$datax);
            $this->template->load($this->view, 'prodi/fpilihta', $datax);
        
    }
    
    //model set ta
    function setta()
    {
        $kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
        $sess_data['kd_tahun_ajaran']=$kd_tahun_ajaran;
            $this->session->set_userdata($sess_data);
            $this->dashboard();
    }
    
    public function test()
    {
        $homebase='012';$kd_tahun_ajaran='20181';
        $this->Prodi_model->get_jumlah_mhs_tak_registrasi($homebase, $kd_tahun_ajaran);
    }
    //modul dashboard
   public function get_jumlah_mhs_status($kd_prodi)
    {
        $sql="SELECT status,count(nim)as jumlah from mahasiswa where kd_prodi='".$kd_prodi."' group by status";
         $hasil = $this->db->query($sql)->result_array();
        echo json_encode ($hasil);
    }
    function dashboard() {
        $cek = $this->session->userdata('userid');
        
       $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $level = $this->session->userdata('level');
        $homebase = $this->session->userdata('home_base');
        
        $keypro['kd_prodi']=$homebase;
       
        if ($level == "prodi") {
            
            $datax['listdata0'] = $this->Prodi_model->get_jumlah_mhs_status($homebase);

           $datax['listdata'] = $this->jumlah_mhs_angkatan($homebase);
            //$datax['listdata2'] = $this->jumlah_registrasi_angkatan($homebase, $kd_tahun_ajaran);
            $datax['listdata3'] = $this->jumlah_krs_angkatan($homebase, $kd_tahun_ajaran);
             $datax['listdata4'] = $this->jumlah_registrasi_angkatan_prodi($homebase, $kd_tahun_ajaran);
           // $datax['listdata'] ='';
            $datax['listdata2'] =$this->Prodi_model->get_jumlah_mhs_cuti($homebase,$kd_tahun_ajaran);
               $datax['listdata5'] =$this->Prodi_model->get_jumlah_mhs_lulus($homebase);
               $datax['listdata6'] =$this->Prodi_model->get_jumlah_mhs_tidak_aktif($homebase);
                $datax['prodi'] = $this->Akademika_model->get_row_selected('prodi',$keypro);
            //$datax['listdata3'] = '';
           // $datax['listdata4'] = '';

            //   $this->load->view('bak/dkabak',$datax);
            $this->template->load($this->view, 'template/homeprodi', $datax);
        }
    }

    //modul pesan
    function fpesan() {
        $data['pesan'] = '';
        $data['aksi'] = 'Input';

        $this->template->load($this->view, 'prodi/pesan', $data);
    }

     private function jumlah_krs_angkatan($prodi, $tahun_ajaran) {
        $sql = "SELECT count(no_krs) as jumlah,angkatan FROM `rencanastudih` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` WHERE rencanastudih.kd_prodi='".$prodi."' and rencanastudih.kd_tahun_ajaran='".$tahun_ajaran."' group by angkatan";
        $hasil = $this->db->query($sql)->result_array();
        return ($hasil);
        // echo json_encode($hasil);
    }
    private function jumlah_registrasi_angkatan($prodi, $tahun_ajaran) {
        $sql = "select mahasiswa.angkatan AS angkatan,count(registrasi_import.nim) as jumlah from registrasi_import,mahasiswa,prodi where registrasi_import.nim=mahasiswa.nim and mahasiswa.kd_prodi=prodi.kd_prodi and mahasiswa.kd_prodi='" . $prodi . "' and kd_tahun_ajaran='" . $tahun_ajaran . "' group by mahasiswa.angkatan";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        // echo json_encode($hasil);
    }
   private function jumlah_registrasi_angkatan_prodi($prodi, $tahun_ajaran) {
        $sql = "select mahasiswa.angkatan AS angkatan,count(registrasi.nim) as jumlah from registrasi,mahasiswa where registrasi.nim=mahasiswa.nim  and registrasi.home_base='".$prodi."' and kd_tahun_ajaran='".$tahun_ajaran."' and jns_registrasi='p03' group by mahasiswa.angkatan";
        $hasil = $this->db->query($sql)->result_array();
        return ($hasil);
        // echo json_encode($hasil);
    }

    private function jumlah_mhs_angkatan($kd_prodi) {
        $sql = "SELECT angkatan,count(nim) as jumlah FROM `mahasiswa` where kd_prodi='".$kd_prodi."' group by angkatan";
        $hasil = $this->db->query($sql)->result_array();
        //echo json_encode($hasil);
        return ($hasil);
    }
    private function jumlah_mhs_aktif($kd_prodi) {
        $sql = "SELECT angkatan,count(nim) as jumlah FROM `mahasiswa` where kd_prodi='".$kd_prodi."' and (status<>'L' or status<>'D' or status<>'K') group by angkatan";
        $hasil = $this->db->query($sql)->result_array();
        //echo json_encode($hasil);
        return ($hasil);
    }
    function dreg($no_reg) {
        $key['noreg'] = $no_reg;
        $this->Prodi_model->delete_data('registrasi', $key);
        redirect(base_url() . 'prodi/lreg');
    }
    //modul profil fakultas
    function profil_fakultas() {
        $homebase = $this->session->userdata('home_base');
        $key['kd_prodi'] = $homebase;
        $prodi = $this->Prodi_model->get_row_selected('prodi', $key);
        $datax['prodi'] = $this->Prodi_model->get_row_selected('prodi', $key);
        $datax['listfakultas'] = $this->Prodi_model->get_all('fakultas');
        $datax['kd_fak']=$prodi->kd_fak;
        $keyfak['kd_fak']=$prodi->kd_fak;
        $datax['fakultas'] = $this->Prodi_model->get_row_selected('fakultas', $keyfak);
        $this->template->load($this->view, 'prodi/fprofilfakultas', $datax);
    }

    function uprofil_fakultas() {
        $key['kd_fak'] = $this->input->post('kd_fak', TRUE);
        //$data['nm_fak'] = $this->input->post('nm_prodi', TRUE);
        $data['dekan'] = $this->input->post('dekan', TRUE);
        
        $data['nip_dekan'] = $this->input->post('nip_dekan', TRUE);
        $data['wd1'] = $this->input->post('wd1', TRUE);
         $data['nip_wd1'] = $this->input->post('nip_wd1', TRUE);
        
        $this->Prodi_model->update_data('fakultas', $data, $key);
        redirect(base_url().'prodi/profil_fakultas');
    }
    //modul profil
    function profil() {
        $homebase = $this->session->userdata('home_base');
        $key['kd_prodi'] = $homebase;
        $datax['prodi'] = $this->Prodi_model->get_row_selected('prodi', $key);
        $datax['listfakultas'] = $this->Prodi_model->get_all('fakultas');
        $this->template->load($this->view, 'prodi/fprofil', $datax);
    }

    function uprofil() {
        $key['kd_prodi'] = $this->input->post('kd_prodi', TRUE);
        $data['nm_prodi'] = $this->input->post('nm_prodi', TRUE);
        $data['ka_prodi'] = $this->input->post('ka_prodi', TRUE);
        $data['kd_fak'] = $this->input->post('kd_fak', TRUE);
        $data['nidn'] = $this->input->post('nidn', TRUE);
        $data['visi_misi'] = $this->input->post('visi_misi', TRUE);
        $data['misi'] = $this->input->post('misi', TRUE);
        $this->Prodi_model->update_data('prodi', $data, $key);
        redirect(base_url('prodi'));
    }
    //modul monitoring kam
    function monitoring_kam()
    {
        $homebase = $this->session->userdata('home_base');
        $level= $this->session->userdata('level');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        if($level=="prodi")
        {
            $keymhs['kd_prodi']=$homebase;
            
            $mhs=$this->Prodi_model->get_list_selected('mahasiswa',$keymhs);
          
 
            $listmhs=array();
            foreach($mhs as $mhs)
            {
                 $keyregis['kd_tahun_ajaran']=$kd_tahun_ajaran;
                    $keyregis['home_base']=$homebase;
                 $keyregis['nim']=$mhs->nim;
                 $reg=$this->Prodi_model->get_row_selected('registrasi',$keyregis);
                 if($reg){
                     $spp='Ya';
                     //echo $reg->noreg;
               }else{
                     $spp='Tidak';
                 }
                 
                  $keykrs['nim']=$mhs->nim;
                  $keykrs['kd_prodi']=$homebase;
                  $keykrs['kd_tahun_ajaran']=$kd_tahun_ajaran;
                  $krs=$this->Prodi_model->get_row_selected('rencanastudih',$keykrs);
                 if($krs){
                     $krsh='Ya';
                 }else{
                     $krsh='Tidak';
                 }
                 
                 $mahasiswa['nim']=$mhs->nim;
                 $mahasiswa['nm_mahasiswa']=$mhs->nm_mahasiswa;
                 $mahasiswa['angkatan']=$mhs->angkatan;
                 $mahasiswa['status']=$mhs->status;
                 
                 $mahasiswa['no_hp']='62'.substr($mhs->no_hp,-(Strlen($mhs->no_hp-1))) ;
                 $mahasiswa['spp']=$spp;
                  $mahasiswa['krs']=$krsh;
                 
                 array_push($listmhs,$mahasiswa);
                 
                 
                
            }
            $hasil['listmhs']=$listmhs;
           $this->template->load($this->view, 'prodi/lkam', $hasil);
            
        }else
        {
            redirect(base_url());
        }
    }
    
    function detail_reg($nim)
    {
        $sql="select nim,kd_tahun_ajaran,noreg,tgl_reg_bak,no_reg_bank,tgl_reg_bank,jns_registrasi from registrasi where nim='".$nim."'";
         $hasil['list'] = $this->db->query($sql)->result();
        $this->template->load($this->view, 'prodi/detail_reg_mhs', $hasil);
       // echo ($hasil);
        
    }
    //modul biodata
    function print_biodata($nim) {
        $id['nim']=$nim;
        $hasil = $this->Prodi_model->get_row_selected('mahasiswa',$id);

        
        $hasil2 = $this->Prodi_model->get_fakultas_by_nim($nim);

        $this->load->library('cfpdf');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(25, 10, 10, 30);
        $pdf->SetFont('times', '', 12);

        $gambar = "assets/image/usnx.gif";
        $pdf->image($gambar, 24, 12, 30);

        $pdf->Cell(20);
        $pdf->Cell(0, 8, 'KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI', 0, 0, 'C');
        $pdf->ln(5);
        //$pdf->Cell(25);
        $pdf->Cell(0, 8, 'UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA', 0, 0, 'C');
    $pdf->ln(5);
      //  $pdf->Cell(25);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 8, $hasil2->nm_fak, 0, 0, 'C');
  $pdf->ln(5);
        // $pdf->Cell();
        $pdf->SetFont('times', '', 10);
        $pdf->Cell(0, 7, 'Alamat: Jl. Pemuda No.339 Kabupaten Kolaka, Sulawesi Tenggara 93517', 0, 0, 'C');
  $pdf->ln(5);
     // $pdf->Cell(25);
        $pdf->Cell(0, 7, 'Telp. (0405) 23321, Fax. (0405) 23321', 0, 0, 'C');
  $pdf->ln(5);
 //$pdf->Cell();
        $pdf->Cell(0, 7, 'Email: rektorat@usn.ac.id; Website: https://usn.ac.id', 0, 0, 'C');
 //$pdf->Cell(10);
   $pdf->ln(5);
        $pdf->Cell(160, 1, '', 'B', 1, 'L');
        $pdf->Cell(160, 1, '', 'B', 0, 'L');
  $pdf->ln(5);
        
        
     
        $pdf->Cell(0, 5, 'BIODATA MAHASISWA', 0, 0, 'C');
        $pdf->ln(5);
        $prodi = "PROGRAM STUDI " . $hasil2->nm_prodi;
        $pdf->Cell(0, 5, $prodi, 0, 0, 'C');
        //$pdf->ln(10);
         // $pdf->image($gambar, 89, 57, 30,'C');
          $pdf->ln(40);
        $pdf->Cell(20);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(80, 8, 'Identitas Mahasiswa', 0, 0, 'L');
        $pdf->ln(5);
        
        $pdf->SetFont('times', '', 10);
        //BARIS I
         $pdf->Cell(20);
        $pdf->Cell(50, 8, 'NIM', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(50, 8, $hasil->nim, 0, 0, 'L');
$pdf->ln(5);
         $pdf->Cell(20);
                //BARIS II
        $pdf->Cell(50, 8, 'Nama Mahasiswa', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(100, 8, $hasil->nm_mahasiswa, 0, 0, 'L');
        $pdf->ln(5);
         $pdf->Cell(20);
                        //BARIS III
        $pdf->Cell(50, 8, 'Tempat / Tgl Lahir', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->tempat_lahir.'/'.$hasil->tgl_lahir, 0, 0, 'L');
$pdf->ln(5);
        
         $pdf->Cell(20);
                                //BARIS III
        $pdf->Cell(50, 8, 'Alamat', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->jalan, 0, 0, 'L');
$pdf->ln(5);
                       //BARIS VI
                        $pdf->Cell(20);
        $pdf->Cell(50, 8, 'No HP', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->no_hp , 0, 0, 'L');
$pdf->ln(5);
         $pdf->Cell(20);
                        //BARIS IV
        $pdf->Cell(50, 8, 'NIK', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->NIK, 0, 0, 'L');
$pdf->ln(5);
 $pdf->Cell(20);
                        //BARIS V
        $pdf->Cell(50, 8, 'Agama', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->agama, 0, 0, 'L');
$pdf->ln(5);
 $pdf->Cell(20);
                                //BARIS VI
        $pdf->Cell(50, 8, 'Jenis Kelamin', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->jns_kelamin, 0, 0, 'L');
$pdf->ln(5);
                   $pdf->Cell(20);
                   //BARIS VI
        $pdf->Cell(50, 8, 'Asal Sekolah', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->npsn , 0, 0, 'L');
$pdf->ln(5);
 $pdf->Cell(20);
        //BARIS VI
        $pdf->Cell(50, 8, 'Tahun Tamat SMA', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->thn_tamat_sma , 0, 0, 'L');
$pdf->ln(5);
 $pdf->Cell(20);
        //BARIS VI
        $pdf->Cell(50, 8, 'Jalur Masuk ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->jalur_masuk , 0, 0, 'L');
$pdf->ln();
 $pdf->Cell(20);
       $pdf->SetFont('times', '', 12); 
        $pdf->Cell(80, 8, 'Identitas Orang Tua', 0, 0, 'L');
$pdf->ln(5);
        $pdf->SetFont('times', '', 10);
         $pdf->Cell(20);
                //BARIS VI
        $pdf->Cell(50, 8, 'Nama Ayah ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->nm_ayah , 0, 0, 'L');
$pdf->ln(5);
                //BARIS VI
                 $pdf->Cell(20);
        $pdf->Cell(50, 8, 'Pekerjaan Ayah ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->pekerjaan_ayah , 0, 0, 'L');
$pdf->ln(5);
                //BARIS VI
                 $pdf->Cell(20);
        $pdf->Cell(50, 8, 'Kategori Penghasilan Ayah ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->penghasilan_ayah , 0, 0, 'L');
$pdf->ln(5);
        //ibu
         $pdf->Cell(20);
                $pdf->Cell(50, 8, 'Nama Ibu ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->nm_ibu , 0, 0, 'L');
$pdf->ln(5);
                //BARIS VI
                 $pdf->Cell(20);
        $pdf->Cell(50, 8, 'Pekerjaan Ibu ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->pekerjaan_ibu , 0, 0, 'L');
        $pdf->ln(7);
                //BARIS VI
                 $pdf->Cell(20);
        $pdf->Cell(50, 8, 'Ketegori Penghasilan Ibu ', 0, 0, 'L');
        $pdf->Cell(6, 8, ':', 0, 0, 'C');
        $pdf->Cell(200, 8, $hasil->penghasilan_ibu , 0, 0, 'L');
$pdf->ln(10);

        //tabel
       
//buat tanggal
        



        $pdf->Output();
    }
    //modul jadwal dan abasensi
    function ajd()
    {
        $data['kd_jadwal']=$this->input->post('kd_jadwal');
        $data['dosen_ke']=$this->input->post('dosen_ke');
        $data['kd_dosen']=$this->input->post('kd_dosen');
        $data['jumlah_sks']=$this->input->post('jumlah_sks');
        $data['subtansi']=$this->input->post('subtansi');
         $data['jumlah_pertemuan']=$this->input->post('jumlah_pertemuan');
        $data['kd_jenis_subtansi']=$this->input->post('kd_jenis_subtansi');
        $kd_jadwal=$this->input->post('kd_jadwal');
        $this->Akademika_model->save_data('jadwal_dosen',$data);
         redirect(base_url() . 'Prodi/fjadwal_dosen/'.$kd_jadwal);
    }
   
    function djd($kd_jadwal,$kd_dosen)
    {
        $key['kd_jadwal']=$kd_jadwal;
        $key['kd_dosen']=$kd_dosen;
        
        $this->Akademika_model->delete_data('jadwal_dosen',$key);
        redirect(base_url() . 'Prodi/fjadwal_dosen/'.$kd_jadwal);
        
    }
    function fjadwal_dosen($kd_jadwal)
    {
        $key['kd_jadwal']=$kd_jadwal;
        
   // $data['jadwal']=$this->Prodi_model->get_row_selected('jadwal',$key);
    $homebase=$this->session->userdata('home_base');
    //$data['aksi']='input';
    //$data['no_daftar']='';
    $data['kd_dosen']='';
     $data['nm_dosen']='';
      $data['jafung']='';
      $data['dosen_ke']='';
      $data['nidn']='';
      $data['jumlah_sks']='';
      $data['jumlah_pertemuan']='';
      
      $hasil=$this->get_jadwal_mtk2($kd_jadwal);
     $data['kd_jadwal']=$hasil->kd_jadwal;
     $data['nm_mtk']=$hasil->nm_mtk;
     $data['sks']=$hasil->sks;
     $data['semester']=$hasil->semester_ke;
     $data['kelas']=$hasil->kelas;
    $data['subtansi']='';
    $data['dosen']=$this->Prodi_model->get_all('dosen');
   
    $data['kd_jadwal']=$kd_jadwal;
    
    $data['list']=$this->Akademika_model->ljd($kd_jadwal);
    $data['ljs']=$this->Akademika_model->get_all('jenis_subtansi_mtk');
    $this->template->load($this->view, 'prodi/fjadwal_dosen', $data);
    

    }
    

   
    function fabsensi($kd_jadwal)
    {
        $data['kertas']='A4';
        $data['posisi']='L';
        $data['kd_jadwal']=$kd_jadwal;
        $data['jarak_antar_baris']='6';
        
         $this->template->load($this->view, 'prodi/fabsensi', $data);
    }
    
    function absensi() {
        
        $kertas=$this->input->post('kertas',true);
        $posisi=$this->input->post('posisi',true);
        $jumlah=$this->input->post('jumlah',true);
        $jarak_antar_baris=$this->input->post('jarak_antar_baris',true);
        $kd_jadwal= $this->input->post('kd_jadwal',true);
        $jumlah_tambahan= $this->input->post('jumlah',true);
        $hasil = $this->get_absensi($kd_jadwal);
        $hasil2 = $this->get_hjadwal($kd_jadwal);

        $this->load->library('cfpdf');
        $pdf = new FPDF($posisi, 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(15, 10, 10, 10);
        $pdf->SetFont('times', '', 13);

        $gambar = "assets/image/usnx.gif";
        $pdf->image($gambar, 20, 10, 30);

        $pdf->Cell(25);
        $pdf->Cell(0, 5, $this->config->item('kementerian'), 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(20);
        $pdf->Cell(0, 5, $this->config->item('namakampus'), 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Cell(0, 5, $hasil2->nm_fak, 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 5,  $this->config->item('alamatinduk'), 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'Telp. (0405) 23321, Fax. (0405) 23321', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'Email: rektorat@usn.ac.id; Website: https://usn.ac.id', 0, 0, 'C');
        $pdf->ln(5);
        $pdf->Cell(270, 1, '', 'B', 1, 'L');
        $pdf->ln(5);
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(0, 5, '*** ABSENSI PERKULIAHAN ***', 0, 0, 'C');
        

        $pdf->SetFont('arial', '', 11);
        $pdf->ln(10);
        //BARIS PERTAMA
        $pdf->Cell(40, 5, 'Matakuliah/Kelas', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(100, 5, $hasil2->nm_mtk.'/'.$hasil2->kelas.' - '.$hasil2->sks . ' SKS', 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(40, 5, 'Dosen Pengampu', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(54, 5, $hasil2->nm_dosen, 0, 0, 'L');
        $pdf->ln(5);
        //BARIS KEDUA
        $ambil1 = $hasil2->kd_tahun_ajaran;
        $ambil2 = substr($ambil1,4);
        if ($ambil2 == '1'){
            $smt = 'Ganjil';
        }else{
            $smt = 'Genap';
        }
        $ambil3 = $hasil2->kd_tahun_ajaran;
        $ambil4 = substr($ambil1,0,4);
        $tahun  = $ambil4 + 1;
        $pdf->Cell(40, 5, 'Tahun Akademik', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(100, 5, $ambil4.'/'.$tahun.'-'.$smt, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(40, 5, 'Jadwal Perkuliahan', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $hari1 = $hasil2->hari;
        $hari2 = strtolower($hari1);
        $hari3 = ucwords($hari2);
        $pdf->Cell(54, 5, $hari3.', '.$hasil2->jam, 0, 0, 'L');
        $pdf->ln(5);
        
        $pdf->Cell(40, 5, 'Program Studi', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(100, 5, $hasil2->nm_prodi, 0, 0, 'L');
        $pdf->ln(7);
        //tabel
         $pdf->Cell(10, 16, 'No', 1, 0, 'C');
        $pdf->Cell(24, 16, 'N I M', 1, 0, 'C');
        $pdf->Cell(60, 16, 'Nama Mahasiswa', 1, 0, 'C');
        $pdf->Cell(176, 8, 'Pertemuan Ke-', 1, 0, 'C');
         $pdf->ln(8);
         $pdf->Cell(94);
        for ($i = 1; $i < 17; $i++) {
            $pdf->Cell(11, 8, $i, 1, 0, 'C');
        }
        $pdf->ln();

        $no=1;
        foreach ($hasil as $row) {
            $nama1 = $row->nm_mahasiswa;
            $nama2 = strtolower($nama1);
            $nama3 = ucwords($nama2);
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(24, $jarak_antar_baris, $row->nim, 1, 0, 'C');
            $pdf->Cell(60, $jarak_antar_baris, $nama3, 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');

            $pdf->Ln();
        }
        for($i=0;$i<$jumlah;$i++)
        {
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(24, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(60, $jarak_antar_baris,'', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(11, $jarak_antar_baris, '', 1, 0, 'L');

            $pdf->Ln();
        }
        $pdf->Cell(94, 9, 'Tanggal Pertemuan  ', 1, 0, 'R');

        for ($i = 0; $i < 16; $i++) {
            $pdf->Cell(11, 9, '', 1, 0, 'c');
        }
        $pdf->ln(9);
        $pdf->Cell(94, 10, 'Paraf Dosen  ', 1, 0, 'R');

        for ($i = 0; $i < 16; $i++) {
            $pdf->Cell(11, 10, '', 1, 0, 'c');
        }
        $pdf->ln(11);
        $pdf->ln(3);
        
        $namaePDF = 'Absen Perkuliahan_'.$hasil2->nm_mtk;
        $pdf->Output('$namaPDF','I');
    }
     function fberita_acara_final_BAU($kd_jadwal)
    {
        $data['kertas']='A4';
        $data['posisi']='L';
        $data['kd_jadwal']=$kd_jadwal;
        $data['jarak_antar_baris']='7';
        
         $this->template->load($this->view, 'prodi/fberita_acara_ujian_BAU', $data);
    }
     function fberita_acara_final($kd_jadwal)
    {
        $data['kertas']='A4';
        $data['posisi']='L';
        $data['kd_jadwal']=$kd_jadwal;
        $data['jarak_antar_baris']='7';
        
         $this->template->load($this->view, 'prodi/fberita_acara_ujian', $data);
    }
    
    function fberita_nilai($kd_jadwal)
    {
        $data['kertas']='A4';
        $data['posisi']='L';
        $data['kd_jadwal']=$kd_jadwal;
        $data['jarak_antar_baris']='7';
        
         $this->template->load($this->view, 'prodi/fberita_nilai', $data);
    }
    function berita_nilai() {
        
        $kertas=$this->input->post('kertas',true);
        $posisi=$this->input->post('posisi',true);
        $jumlah=$this->input->post('jumlah',true);
        $jarak_antar_baris=$this->input->post('jarak_antar_baris',true);
        $kd_jadwal= $this->input->post('kd_jadwal',true);
        $jumlah_tambahan= $this->input->post('jumlah',true);
        $hasil = $this->get_absensi($kd_jadwal);
        $hasil2 = $this->get_hjadwal($kd_jadwal);

        $this->load->library('cfpdf');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(120, 20, 20, 20);
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
        $pdf->Cell(0, 5, $hasil2->nm_fak, 0, 0, 'C');
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
        $ambil1 = $hasil2->kd_tahun_ajaran;
        $ambil2 = substr($ambil1,4);
        if ($ambil2 == '1'){
            $smt = 'Ganjil';
        }else{
            $smt = 'Genap';
        }
        $ambil3 = $hasil2->kd_tahun_ajaran;
        $ambil4 = substr($ambil1,0,4);
        $tahun  = $ambil4 + 1;
        $pdf->MultiCell(190, 6, 'Pada hari ini ................... tanggal ...... bulan ............... tahun .......... telah diselenggarakan Ujian Akhir Semester '.$smt.' Tahun Akademik '.$ambil4.'/'.$tahun.'.');
        $pdf->Cell(40, 5, 'Nama Matakuliah', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(50, 5, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(5);
        //BARIS KEDUA
        $pdf->Cell(20);
        $pdf->Cell(60, 5, 'SKS / Kelas', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(50, 5, $hasil2->sks. ' SKS / '.$hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(5);
         $pdf->Cell(40, 5, 'Program Studi', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(50, 5, $hasil2->nm_prodi, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(3);
         //BARIS KEDUA
       
        $pdf->ln(5);
        //tabel
         $pdf->Cell(10, 10, 'NO', 1, 0, 'C');
        $pdf->Cell(25, 10, 'NIM', 1, 0, 'C');
        $pdf->Cell(70, 10, 'NAMA MAHASISWA', 1, 0, 'C');
        $pdf->Cell(40, 10, 'NILAI', 1, 0, 'C');
        $pdf->Cell(45, 10, 'KETERANGAN', 1, 0, 'C');
        
        $pdf->ln();

        $no=1;
        foreach ($hasil as $row) {
            $namaku1 = $row->nm_mahasiswa;
            $namaku2 = strtolower($namaku1);
            $namaku3 = ucwords($namaku2);
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(25, $jarak_antar_baris, $row->nim, 1, 0, 'C');
            $pdf->Cell(70, $jarak_antar_baris, $namaku3, 1, 0, 'L');
            $pdf->Cell(40, $jarak_antar_baris, $row->nilai, 1, 0, 'L');
            $pdf->Cell(45, $jarak_antar_baris, '', 1, 0, 'C');
            $pdf->Ln();
        }
        for($i=0;$i<$jumlah;$i++)
        {
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(25, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(70, $jarak_antar_baris,'', 1, 0, 'L');
            $pdf->Cell(40, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(45, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Ln();
        }
        $pdf->Ln(10);
        $pdf->Cell(10, $jarak_antar_baris, '', 0, 0, 'L');
        
        $pdf->Cell(35, $jarak_antar_baris, 'Pengawas,', 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, 'Dosen Pengampu,', 0, 0, 'L');
        $pdf->Ln(25);
        $pdf->Cell(10, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, '___________________________', 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,$hasil2->nm_dosen , 0, 0, 'L');
        
        $namaPDF = 'Berita Acara Ujian '.$hasil2->nm_mtk;
        $pdf->Output($namaPDF,'I');
    }
    function berita_acara_final() {
        
        $jns_ujian=$this->input->post('jujian',true);
        
        if($jns_ujian=='uas')
        {
            $ket_ujian1="UJIAN AKHIR SEMESTER ";
            $ket_ujian2="Ujian Akhir Semester ";
        }else
        {
            $ket_ujian1="UJIAN TENGAH SEMESTER ";
            $ket_ujian2="Ujian Tengah Semester ";
        }
        $kertas=$this->input->post('kertas',true);
        $posisi=$this->input->post('posisi',true);
        $jumlah=$this->input->post('jumlah',true);
        $jarak_antar_baris=$this->input->post('jarak_antar_baris',true);
        $kd_jadwal= $this->input->post('kd_jadwal',true);
        $jumlah_tambahan= $this->input->post('jumlah',true);
        $hasil = $this->get_absensi($kd_jadwal);
        $hasil2 = $this->get_hjadwal($kd_jadwal);

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
        $pdf->SetFont('times', '', 14);
        $pdf->Cell(0, 5, $hasil2->nm_fak, 0, 0, 'C');
        $pdf->ln(5);
          
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
        $pdf->Cell(0, 5, 'BERITA ACARA', 0, 1, 'C');
        $pdf->Cell(0, 5, strtoupper($ket_ujian2), 0, 1, 'C');
        
        $pdf->SetFont('arial', '', 10);
        $pdf->ln(7);
        //BARIS PERTAMA
        //$pdf->Text(10,40,"ini adalah teks dalam pdf fpdf",0);
        $ambil1 = $hasil2->kd_tahun_ajaran;
        $ambil2 = substr($ambil1,4);
        if ($ambil2 == '1'){
            $smt = 'Ganjil';
        }else{
            $smt = 'Genap';
        }
        $ambil3 = $hasil2->kd_tahun_ajaran;
        $ambil4 = substr($ambil1,0,4);
        $tahun  = $ambil4 + 1;
        $pdf->MultiCell(190, 6, 'Pada hari ini ................... Tanggal .....Bulan ............... Tahun .......... telah diselenggarakan '.$ket_ujian2 .$smt.' Tahun Akademik '.$ambil4.'/'.$tahun.'.');
        
        $pdf->Cell(40,10, 'Program Studi', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10,$hasil2->nm_prodi, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        $pdf->Cell(40,10, 'Nama Mata Kuliah', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
       
       
        $pdf->Cell(40, 10, 'Jumlah SKS', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, $hasil2->sks. ' SKS ', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        $pdf->Cell(40,10, 'Kelas', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, $hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        
        $pdf->Cell(40, 10, 'Dosen Pengampu', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, $hasil2->nm_dosen, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        
        
        
        
        
        //BARIS KEDUA
        
        $pdf->Cell(40,10, 'Ruang', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '----------', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
         
        $pdf->Cell(40,10, 'Waktu', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '(--------s/d--------) WITA', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(10);
        
        $pdf->Cell(40,10, 'Jumlah Mahasiswa', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '------ Orang', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        
        $pdf->Cell(40,10, 'Jumlah Mahasiswa Hadir', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '------ Orang', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        $pdf->Cell(40,10, 'Jumlah Mahasiswa Izin', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '------ Orang', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        
        $pdf->Cell(40,10, 'Jumlah Mahasiswa Sakit', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '------ Orang', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
        
        $pdf->Cell(40,10, 'Jumlah Mahasiswa Alpa', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, '------ Orang', 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(15);
        //BARIS KEDUA
         $pdf->Cell(40,10, 'Catatan saat '.$ket_ujian2.' berlangsung:', 0, 0, 'L');
         $pdf->ln(10);
        $pdf->Cell(35, $jarak_antar_baris, '____________________________________________________________________________________________', 0, 0, 'L');
        $pdf->ln(10);
        $pdf->Cell(35, $jarak_antar_baris, '____________________________________________________________________________________________', 0, 0, 'L');
        $pdf->ln(10);
         $pdf->Cell(35, $jarak_antar_baris, '____________________________________________________________________________________________', 0, 0, 'L');
        $pdf->ln(10);
         $pdf->Cell(35, $jarak_antar_baris, '____________________________________________________________________________________________', 0, 0, 'L');
        $pdf->ln(10);
        $pdf->Ln(20);
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, 'Ketua Program Studi,', 0, 0, 'L');
        $pdf->Cell(75, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, 'Pengawas,', 0, 0, 'L');
        $pdf->Ln(25);
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, $hasil2->ka_prodi, 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,'________________________', 0, 0, 'L');
        $pdf->Ln(0);
        
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,'________________________', 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,' ', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,'NIDN.'.$hasil2->nidn_prodi, 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,' ', 0, 0, 'L');
        
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
        $pdf->SetFont('times', '', 14);
        $pdf->Cell(0, 5, $hasil2->nm_fak, 0, 0, 'C');
        $pdf->ln(5);
          
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
        $pdf->ln(2);
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(0, 5, 'DAFTAR HADIR', 0, 1, 'C');
        $pdf->Cell(0, 5, strtoupper($ket_ujian2), 0, 1, 'C');
         $pdf->ln(5);
        $pdf->SetFont('arial', '', 11);
         $pdf->Cell(5);
         $pdf->Cell(40,10, 'Tahun Akademik', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10,$smt.' '.$ambil4.'/'.$tahun, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
         $pdf->Cell(5);
        $pdf->Cell(40,10, 'Program Studi', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10,$hasil2->nm_prodi, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
       
       $pdf->Cell(5);
        $pdf->Cell(40,10, 'Mata Kuliah', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
         $pdf->Cell(5);
         $pdf->Cell(40,10, 'SKS / Kelas', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50,10, $hasil2->sks .' / '.$hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(6);
         $pdf->Cell(5);
        $pdf->Cell(40, 10, 'Dosen Pengampu', 0, 0, 'L');
        $pdf->Cell(2, 10, ':', 0, 0, 'C');
        $pdf->Cell(50, 10, $hasil2->nm_dosen, 0, 0, 'L');
        $pdf->Cell(5, 10, '', 0, 0, 'L');
        $pdf->ln(10);
         $pdf->Cell(5);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C');
        $pdf->Cell(24, 8, 'N I M', 1, 0, 'C');
        $pdf->Cell(100, 8, 'Nama Mahasiswa', 1, 0, 'C');
        $pdf->Cell(24, 8, 'Angkatkan', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Paraf', 1, 0, 'C');
        
         $pdf->ln();
        $hasil = $this->get_absensi($kd_jadwal);
        $no=1;
        foreach ($hasil as $row) {
            $nama1 = $row->nm_mahasiswa;
            $nama2 = strtolower($nama1);
            $nama3 = ucwords($nama2);
             $pdf->Cell(5);
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(24, $jarak_antar_baris, $row->nim, 1, 0, 'C');
            $pdf->Cell(100, $jarak_antar_baris, $nama3, 1, 0, 'L');
            $pdf->Cell(24, $jarak_antar_baris, $row->angkatan, 1, 0, 'C');
            $pdf->Cell(25, $jarak_antar_baris, '', 1, 0, 'L');
   

            $pdf->Ln();
        }
         $pdf->Cell('', $jarak_antar_baris, 'Kolaka,......................................', 0, 0, 'R');
         $pdf->Ln();
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, 'Ketua Program Studi,', 0, 0, 'L');
        $pdf->Cell(75, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, 'Pengawas,', 0, 0, 'L');
        $pdf->Ln(25);
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, $hasil2->ka_prodi, 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,'________________________', 0, 0, 'L');
        $pdf->Ln(0);
        
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,'________________________', 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,' ', 0, 0, 'L');
        $pdf->Ln(4);
        $pdf->Cell(20, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,'NIDN.'.$hasil2->nidn_prodi, 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,' ', 0, 0, 'L');
        $namaPDF = $ket_ujian2.$hasil2->nm_mtk;
        $pdf->Output($namaPDF,'I');
    }
    function berita_acara_final_bau() {
        
        $kertas=$this->input->post('kertas',true);
        $posisi=$this->input->post('posisi',true);
        $jumlah=$this->input->post('jumlah',true);
        $jarak_antar_baris=$this->input->post('jarak_antar_baris',true);
        $kd_jadwal= $this->input->post('kd_jadwal',true);
        $jumlah_tambahan= $this->input->post('jumlah',true);
        $hasil = $this->get_absensi($kd_jadwal);
        $hasil2 = $this->get_hjadwal($kd_jadwal);

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
        $pdf->Cell(0, 5, $hasil2->nm_fak, 0, 0, 'C');
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
        $ambil1 = $hasil2->kd_tahun_ajaran;
        $ambil2 = substr($ambil1,4);
        if ($ambil2 == '1'){
            $smt = 'Ganjil';
        }else{
            $smt = 'Genap';
        }
        $ambil3 = $hasil2->kd_tahun_ajaran;
        $ambil4 = substr($ambil1,0,4);
        $tahun  = $ambil4 + 1;
        $pdf->MultiCell(190, 6, 'Pada hari ini ................... tanggal ...... bulan ............... tahun .......... telah diselenggarakan Ujian Akhir Semester '.$smt.' Tahun Akademik '.$ambil4.'/'.$tahun.'.');
        $pdf->Cell(40, 5, 'Nama Matakuliah', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(50, 5, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(5);
        //BARIS KEDUA
        $pdf->Cell(40, 5, 'SKS / Kelas', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(50, 5, $hasil2->sks. ' SKS / '.$hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->ln(5);
         $pdf->Cell(40, 5, 'Program Studi', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(50, 5, $hasil2->nm_prodi, 0, 0, 'L');
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
        foreach ($hasil as $row) {
            $namaku1 = $row->nm_mahasiswa;
            $namaku2 = strtolower($namaku1);
            $namaku3 = ucwords($namaku2);
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(25, $jarak_antar_baris, $row->nim, 1, 0, 'C');
            $pdf->Cell(70, $jarak_antar_baris, $namaku3, 1, 0, 'L');
            $pdf->Cell(30, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(55, $jarak_antar_baris, 'A - AB - B - BC - C - CD - D - E', 1, 0, 'C');
            $pdf->Ln();
        }
        for($i=0;$i<$jumlah;$i++)
        {
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(25, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(70, $jarak_antar_baris,'', 1, 0, 'L');
            $pdf->Cell(30, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(55, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Ln();
        }
        $pdf->Ln(10);
        $pdf->Cell(10, $jarak_antar_baris, '', 0, 0, 'L');
        
        $pdf->Cell(35, $jarak_antar_baris, 'Pengawas,', 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, 'Dosen Pengampu,', 0, 0, 'L');
        $pdf->Ln(25);
        $pdf->Cell(10, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris, '___________________________', 0, 0, 'L');
        $pdf->Cell(70, $jarak_antar_baris, '', 0, 0, 'L');
        $pdf->Cell(35, $jarak_antar_baris,$hasil2->nm_dosen , 0, 0, 'L');
        
        $namaPDF = 'Berita Acara Ujian '.$hasil2->nm_mtk;
        $pdf->Output($namaPDF,'I');
    }
    
    public function get_list_jadwal_kuliah($kd_tahun_ajaran,$kd_prodi)
    {
        $sql="SELECT dosen.kd_dosen,dosen.nidn,jadwal.kd_tahun_ajaran,hari,jam,rencanastudid.kd_jadwal,jadwal.kd_dosen,nm_dosen,matakuliah.nm_mtk,matakuliah.sks,matakuliah.semester_ke,jadwal.kd_prodi,jadwal.kelas,COUNT(rencanastudid.kd_jadwal)as jumlah FROM `rencanastudid`,jadwal,dosen,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and rencanastudid.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen  and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_prodi='".$kd_prodi."' and jadwal.kd_mtk<>'lama.01244' group by rencanastudid.kd_jadwal order by matakuliah.nm_mtk,kelas,nm_dosen asc";
         $hasil = $this->db->query($sql)->result();
       // echo json_encode($hasil);
        return($hasil);
    }
    

    public function get_list_jadwal_dosen($kd_tahun_ajaran,$kd_prodi)
    {
        $sql="SELECT dosen.kd_dosen,dosen.nidn,jadwal.kd_tahun_ajaran,hari,jam,rencanastudid.kd_jadwal,jadwal.kd_dosen,nm_dosen,matakuliah.nm_mtk,matakuliah.sks,matakuliah.semester_ke,jadwal.kd_prodi,jadwal.kelas,COUNT(rencanastudid.kd_jadwal)as jumlah FROM `rencanastudid`,jadwal,dosen,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and rencanastudid.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen  and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_prodi='".$kd_prodi."'  group by rencanastudid.kd_jadwal order by nm_dosen,matakuliah.nm_mtk,kelas asc";
         $hasil = $this->db->query($sql)->result();
       // echo json_encode($hasil);
        return($hasil);
    }
    public function get_list_jadwal_kuliah2($kd_tahun_ajaran,$kd_prodi)
    {
        $sql="SELECT dosen.kd_dosen,dosen.nidn,jadwal.kd_tahun_ajaran,jadwal.hari,jam,jadwal.kd_dosen,nm_dosen,matakuliah.nm_mtk,matakuliah.sks,matakuliah.semester_ke,jadwal.kd_prodi,jadwal.kelas FROM jadwal,dosen,matakuliah,thari where jadwal.hari=thari.hari and jadwal.kd_mtk=matakuliah.kd_mtk and  jadwal.kd_dosen=dosen.kd_dosen  and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_prodi='".$kd_prodi."' order by thari.no,jam,kelas asc";
         $hasil = $this->db->query($sql)->result();
       // echo json_encode($hasil);
        return($hasil);
    }
    
    private function get_hjadwal($kd_jadwal) {
        $sql = "SELECT
  `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_prodi`,
  `jadwal`.`kd_mtk`, `jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`,
  `jadwal`.`kd_dosen`, `prodi`.`nm_prodi`, `prodi`.`ka_prodi`,prodi.nidn as nidn_prodi,
  `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `matakuliah`.`kd_kurikulum`,`matakuliah`.`semester_ke`,
  `matakuliah`.`kd_jenis_mtk`, `dosen`.`NIDN`, `dosen`.`nm_dosen`,
  `thnajaran`.`tahun_ajaran`, `thnajaran`.`semester`, `fakultas`.`nm_fak`
FROM
  `jadwal` INNER JOIN
  `prodi` ON `prodi`.`kd_prodi` = `jadwal`.`kd_prodi` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN
  `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen` INNER JOIN
  `thnajaran` ON `thnajaran`.`kd_tahun_ajaran` = `jadwal`.`kd_tahun_ajaran`
  INNER JOIN
  `fakultas` ON `fakultas`.`kd_fak` = `prodi`.`kd_fak`
WHERE
  `jadwal`.`kd_jadwal` = '" . $kd_jadwal . "'";
        $hasil = $this->db->query($sql)->row();
        return $hasil;
    }

    function get_absensi($kd_jadwal) {
        $sql = "SELECT
  `rencanastudih`.`nim`, `mahasiswa`.`nm_mahasiswa`, `jadwal`.`kd_jadwal`,
  `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_prodi`, `jadwal`.`kd_mtk`,
  `jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kd_ruang`,
  `matakuliah`.`nm_mtk`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`,
  `matakuliah`.`prasyarat_mk`, `matakuliah`.`kd_kurikulum`,
  `matakuliah`.`kd_jenis_mtk`, `mahasiswa`.`angkatan`, `jadwal`.`kd_dosen`,
  `dosen`.`NIDN`, `dosen`.`nm_dosen`, `matakuliah`.`sks`
FROM
  `rencanastudih` INNER JOIN
  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` INNER JOIN
  `rencanastudid` ON `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs`
  INNER JOIN
  `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudid`.`kd_jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN
  `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen`
WHERE
  `jadwal`.`kd_jadwal` = '" . $kd_jadwal . "' and rencanastudih.setujui_pa='Ya' ";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
    }

    //form lmahasiswa lmhs
       function lmhs() {
        $cek = $this->session->userdata('userid');
        $angkatan = $this->input->post('angkatan', TRUE);
        //$kd
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $keyta['aktif'] = 'YA';
                $rowta = $this->Prodi_model->get_row_selected('thnajaran', $keyta);
                
                $kd_tahun_ajaran = $rowta->kd_tahun_ajaran;
                $kd_prodi['kd_prodi'] = $this->session->userdata('home_base');
                 $kd_prodi['status'] ='A';
                  $kd_prodix = $this->session->userdata('home_base');
                $data['listmhs'] = $this->get_mahasiswa($kd_prodix,$angkatan);

                $this->template->load($this->view, 'prodi/listmahasiswa', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    
    
    public function get_mahasiswa($kd_prodi,$angkatan)
    {
         $sql = "select mahasiswa.nim as nim,nm_mahasiswa,NIK,angkatan,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,nilai_ukt,semester,mahasiswa.status,kd_prodi from mahasiswa where  kd_prodi='". $kd_prodi . "' and angkatan='".$angkatan."'";
        
        return $this->db->query($sql)->result();
          //echo json_encode($hasil)  ;    
    }
    function lreg_cuti() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $listdata['status_jspp'] = 'Masih Terbuka';
                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;

                $keyja['kd_kegiatan'] = 'SPP';
                $hasilcekja = $this->Prodi_model->get_row_selected('jadwalakademik', $keyja);
                if ($hasilcekja->aktif == 'Tidak') {
                    $listdata['status_jspp'] = 'Sudah Tutup';
                }
                //operasinya
                $sql = "SELECT `registrasi`.`jns_registrasi`, noreg,`registrasi`.`kd_tahun_ajaran`, `registrasi`.`no_reg_bank`, `registrasi`.`tgl_reg_bank`,`registrasi`.`tgl_reg_bak`, `registrasi`.`nim`, `registrasi`.`home_base`,  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi` FROM `registrasi` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `registrasi`.`nim` and registrasi.kd_tahun_ajaran='" . $kd_tahun_ajaran . "' and `registrasi`.`home_base`='" . $homebase . "' and jns_registrasi='CUTI'";
                $listdata['listdata'] = $this->db->query($sql)->result();
                $listdata['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $listdata['homebase'] = $homebase;
                $this->template->load($this->view, 'prodi/listcuti', $listdata);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    function lreg() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;

            if ($level == "prodi") {
                $listdata['status_jspp'] = 'Masih Terbuka';
                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;

                $keyja['kd_kegiatan'] = 'SPP';
                $hasilcekja = $this->Prodi_model->get_row_selected('jadwalakademik', $keyja);
                if ($hasilcekja->aktif == 'Tidak') {
                    $listdata['status_jspp'] = 'Sudah Tutup';
                }
                //operasinya
                $sql = "SELECT `registrasi`.`jns_registrasi`, noreg,`registrasi`.`kd_tahun_ajaran`, `registrasi`.`no_reg_bank`, `registrasi`.`tgl_reg_bank`,`registrasi`.`tgl_reg_bak`, `registrasi`.`nim`, `registrasi`.`home_base`,  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi` FROM `registrasi` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `registrasi`.`nim` and registrasi.kd_tahun_ajaran='" . $kd_tahun_ajaran . "' and jns_registrasi='P03' and `registrasi`.`home_base`='" . $homebase . "'";
                $listdata['listdata'] = $this->db->query($sql)->result();
                $listdata['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $listdata['homebase'] = $homebase;
                $this->template->load($this->view, 'prodi/listreg', $listdata);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //form registrasi cuti
public function fcuti() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');

       
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;

            if ($level == "prodi") {
                //operasinya
                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $keyja['kd_kegiatan'] = 'SPP';
                $hasilcekja = $this->Prodi_model->get_row_selected('jadwalakademik', $keyja);
                if ($hasilcekja->aktif == 'Tidak') {
                    redirect(base_url() . 'Prodi/lreg');
                } else {


                    $x['aktif'] = 'ya';
                    $hasil = $this->Prodi_model->get_row_selected('thnajaran', $x);
                    $datax['kd_tahun_ajaran'] = $hasil->kd_tahun_ajaran;
                    $datax['aksi'] = 'Input';
                    $datax['no_reg_bank'] = '';
                    $datax['tgl_reg_bank'] = '';
                    $datax['nim'] = '';
                    $datax['tgl_reg_bak'] = '';
                    $datax['jns_registrasi'] = 'CUTI';
                    $datax['userid'] = $cek;
                    //$datax['listmhs']=$this->Prodi_model->get_all('mahasiswa');
                    $this->template->load($this->view, 'prodi/fcuti', $datax);
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //form registrasi mhasiswa 
    public function fregistrasi() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');

       
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;

            if ($level == "prodi") {
                //operasinya
                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $keyja['kd_kegiatan'] = 'SPP';
                $hasilcekja = $this->Prodi_model->get_row_selected('jadwalakademik', $keyja);
                if ($hasilcekja->aktif == 'Tidak') {
                    redirect(base_url() . 'Prodi/lreg');
                } else {


                    $x['aktif'] = 'ya';
                    $hasil = $this->Prodi_model->get_row_selected('thnajaran', $x);
                    $datax['kd_tahun_ajaran'] = $hasil->kd_tahun_ajaran;
                    $datax['aksi'] = 'Input';
                    $datax['no_reg_bank'] = '';
                    $datax['tgl_reg_bank'] = '';
                    $datax['nim'] = '';
                    $datax['tgl_reg_bak'] = '';
                    $datax['jns_registrasi'] = 'P03';
                    $datax['userid'] = $cek;
                    //$datax['listmhs']=$this->Prodi_model->get_all('mahasiswa');
                    $this->template->load($this->view, 'prodi/registrasi', $datax);
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    //fung simpan registrasi mahasiswa
    public function aregistrasi() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $level = $this->session->userdata('level');
        $home_base = $this->session->userdata('home_base');
        if ($level == "prodi") {
            $noregbank = $this->input->post('no_reg_bank', TRUE);
            $datax['kd_tahun_ajaran'] = $kd_tahun_ajaran;
            $datax['no_reg_bank'] = $noregbank;
            $datax['noreg'] = $this->createNoReg($kd_tahun_ajaran,$home_base);
            $datax['tgl_reg_bank'] = $this->input->post('tgl_reg_bank', TRUE);
            $datax['nim'] = $this->input->post('nim', TRUE);
            $datax['tgl_reg_bak'] = date('Y-m-d');
            $datax['jns_registrasi'] = "P03";
            $datax['home_base'] = $home_base;
            $nim = $this->input->post('nim', TRUE);
            $aksi = $this->input->post('aksi', TRUE);
            
            $keymhs['nim'] = $nim;
             $keymhs['kd_prodi'] = $home_base;
            $rowmhs = $this->Prodi_model->get_row_selected('mahasiswa', $keymhs);
            
            if($aksi=="Input")
            {
               
            $a='1';
            $smsmhs = $rowmhs->semester + $a;
            
            $udatamhs['semester'] = $smsmhs;
            $udatamhs['status'] = 'A';
            
            $hasilx = $this->cek_no_registrasi($noreg);
            if (empty($hasilx)) {
                $dupreg = $this->cek_registrasi($kd_tahun_ajaran, $nim);
                if (empty($dupreg)) {
                    $this->Prodi_model->save_data('registrasi', $datax);
                    $this->Prodi_model->update_data('mahasiswa', $udatamhs, $keymhs);
                    $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data sudah tersimpan</p>
					</div>');
					redirect(base_url() . 'Prodi/fregistrasi');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Informasi...!</h4><p>Data tidak dapat disimpan, karena mahasiswa ini sudah registrasi pada tahun akademik ini...!</p>
					</div>');
                    //redirect(base_url() . 'Prodi/ereg/'.$noreg);
                    redirect(base_url() . 'Prodi/fregistrasi');
                }
            }else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Informasi...!</h4><p>Nomor Registrasi ini sudah ada </p>
					</div>');
                redirect(base_url() . 'Prodi/fregistrasi');
				}
            } else {
			                $keynoreg['no_reg_bank']=$noreg;
                $hasil=$this->Prodi_model->delete_data('registrasi',$keynoreg);
                if($hasil)
                {
                    
                }
            


                redirect(base_url() . 'Prodi/fregistrasi');

            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
//SIMPAN CUTI
public function acuti() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $level = $this->session->userdata('level');
        $home_base = $this->session->userdata('home_base');
        if ($level == "prodi") {
            $noregbank = $this->input->post('no_reg_bank', TRUE);
            $datax['kd_tahun_ajaran'] = $kd_tahun_ajaran;
            $datax['no_reg_bank'] = $noregbank;
            $datax['noreg'] = $this->createNoReg($kd_tahun_ajaran,$home_base);
            $datax['tgl_reg_bank'] = $this->input->post('tgl_reg_bank', TRUE);
            $datax['nim'] = $this->input->post('nim', TRUE);
            $datax['tgl_reg_bak'] = date('Y-m-d');
            $datax['jns_registrasi'] = "CUTI";
            $datax['home_base'] = $home_base;
            $nim = $this->input->post('nim', TRUE);
            $aksi = $this->input->post('aksi', TRUE);
            
            $keymhs['nim'] = $nim;
             $keymhs['kd_prodi'] = $home_base;
            $rowmhs = $this->Prodi_model->get_row_selected('mahasiswa', $keymhs);
            
            if($aksi=="Input")
            {
               
            
            $smsmhs = $rowmhs->semester + 1;
            
            $udatamhs['semester'] = $smsmhs;
            
            $hasilx = $this->cek_no_registrasi($noreg);
            if (empty($hasilx)) {
                $dupreg = $this->cek_registrasi($kd_tahun_ajaran, $nim);
                if (empty($dupreg)) {
                    $this->Prodi_model->save_data('registrasi', $datax);
                    //$this->Prodi_model->update_data('mahasiswa', $udatamhs, $keymhs);
                    $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Data sudah tersimpan</p>
					</div>');
					redirect(base_url() . 'Prodi/fcuti');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Informasi...!</h4><p>Data tidak dapat disimpan, karena mahasiswa ini sudah cuti pada tahun akademik ini...!</p>
					</div>');
                    //redirect(base_url() . 'Prodi/ereg/'.$noreg);
                    redirect(base_url() . 'Prodi/fregistrasi');
                }
            }else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-warning">
                    <h4>Informasi...!</h4><p>Nomor Registrasi ini sudah ada </p>
					</div>');
                redirect(base_url() . 'Prodi/fcuti');
				}
            } else {
			                $keynoreg['no_reg_bank']=$noreg;
                $hasil=$this->Prodi_model->delete_data('registrasi',$keynoreg);
                if($hasil)
                {
                    
                }
            


                redirect(base_url() . 'Prodi/fcuti');

            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
function ereg($noreg){
$level = $this->session->userdata('level');
$key['noreg']=$noreg;
if($level=="prodi"){
    $data = $this->Prodi_model->get_row_selected('registrasi', $key);
    $datax['no_reg_bank'] = $data->no_reg_bank;
    $datax['tgl_reg_bank'] = $data->tgl_reg_bank;
    $datax['nim'] =  $data->nim;
     $datax['kd_tahun_ajaran'] =  $data->kd_tahun_ajaran;
    $datax['tgl_reg_bak'] = $data->tgl_reg_bak;
    $datax['jns_registrasi'] =  $data->jns_registrasi;
    //$datax['home_base'] = $data->home_base;
     $datax['aksi'] ="Edit";
    $this->template->load($this->view, 'prodi/registrasi', $datax);

    }
}

    function cek_registrasi($kd_tahun_ajaran, $nim) {
        $key['kd_tahun_ajaran'] = $kd_tahun_ajaran;
        $key['nim'] = $nim;
        $key['jns_registrasi'] = 'P03';
        
        $hasil = $this->Prodi_model->get_row_selected('registrasi', $key);
        return $hasil;
    }

    function cek_no_registrasi($noreg) {

        $key['no_reg_bank'] = $noreg;
        $hasil = $this->Prodi_model->get_row_selected('registrasi', $key);
        return $hasil;
    }

    //form matakuliah
    function fmatakuliah() {
        $this->load->helper('form');
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $data['kd_kurikulum'] = '';
                $data['aksi'] = 'Input';

                $data['kd_mtk'] = '';

                $data['nm_mtk'] = '';
                $data['sks'] = '';
                $data['sks_teori'] = '';
                $data['sks_praktikum_lab'] = '';
                $data['sks_praktikum_lapangan'] = '';
                $data['semester_ke'] = '';
                $data['semester'] = '';
                $data['prasyarat_mk'] = '';
                $data['prasyarat_nilai_mk'] = '';
                $data['prasyarat_mk2'] = '';
                $data['prasyarat_nilai_mk2'] = '';
                
                $data['kd_jenis_mtk'] = '';
                $data['cp_prodi']='';
                $data['cp_matakuliah']='';
                $data['deskripsi_mk']='';
                
                $key['kd_prodi'] = $homebase;
                $keymtk['kd_prodi'] = $homebase;
                // $keymtk['Aktif'] = "Ya";
                $data['listgroupmtk'] = $this->Prodi_model->get_all('groupmatakuliah');

                $data['listkurikulum'] = $this->Prodi_model->get_list_selected('kurikulum', $key);
                $data['listmatakuliah'] = $this->Prodi_model->get_list_selected('matakuliah', $keymtk);
                $this->template->load($this->view, 'prodi/fmatakuliah', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    //daftar matakuliah
    function lmatakuliah() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $keyta['kd_prodi'] = $homebase;
                $data['listmatakuliah'] = $this->Akademika_model->get_list_selected_asc('matakuliah', $keyta,'semester_ke');
                $this->template->load($this->view, 'prodi/lmatakuliah', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    //fungsi simpan matakuliah
    function amatakuliah() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $datay['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $datay);
            $level = $row->level;
            if ($level == "prodi") {
                $aksi = $this->input->post('aksi', TRUE);
                $data['kd_kurikulum'] = $this->input->post('kd_kurikulum', TRUE);
                $kurik = $this->input->post('kd_kurikulum', TRUE);
		        $kd_jenis_mtk = $this->input->post('kd_jenis_mtk', TRUE);
		        
                $kd_mtk = trim($this->input->post('kd_mtk', TRUE));
		        
		        $semester_ke = $this->input->post('semester_ke', TRUE);
                $kd_mtks = $kurik.'.'.$kd_mtk;
                $kd_lama = $this->input->post('kd_mtk_lama', TRUE);
                
		        $kd_mtks_baru = $kurik.'.'.$kd_mtk;

                $data['nm_mtk'] = $this->input->post('nm_mtk', TRUE);
               
               if(($kd_jenis_mtk)=='MKWP')
               {
                   $id_jns_mtk='C';
               }elseif(substr($data,0,3)=='MKW')
               {
                    $id_jns_mtk='A';
                }elseif(($kd_jenis_mtk)=='MKPP')
               {
                    $id_jns_mtk='D';
               }
                $data['semester_ke'] = $semester_ke;
                if($semester_ke==1 or $semester_ke==3 or $semester_ke==5 or $semester_ke==7 )
                {
                    $data['semester'] ='Ganjil';
                }else
                {
                     $data['semester'] ='Genap';
                }
               // $data['semester'] = $this->input->post('semester', TRUE);
                $data['sks_teori'] = $this->input->post('sks_teori', TRUE);
                $data['sks_praktikum_lab'] = $this->input->post('sks_praktikum_lab', TRUE);
                $data['sks_praktikum_lapangan'] = $this->input->post('sks_praktikum_lapangan', TRUE);
                $data['sks'] = $this->input->post('sks_teori', TRUE)+ $this->input->post('sks_praktikum_lab', TRUE)+ $this->input->post('sks_praktikum_lapangan', TRUE);
                $data['prasyarat_mk'] = $this->input->post('prasyarat_mk', TRUE);
                $data['prasyarat_nilai_mk2'] = $this->input->post('prasyarat_nilai_mk2', TRUE);
                $data['prasyarat_mk2'] = $this->input->post('prasyarat_mk2', TRUE);
                $data['kd_jenis_mtk'] = $kd_jenis_mtk;
                
                $data['cp_prodi']=$this->input->post('cp_prodi', TRUE);
                $data['cp_matakuliah']=$this->input->post('cp_matakuliah', TRUE);
                $data['deskripsi_mk']=$this->input->post('deskripsi_mk', TRUE);
                $data['kd_prodi'] = $homebase;
                $id['kd_mtk'] = trim($kd_lama);
                if ($aksi == 'Input') {
                    $row = $this->Prodi_model->get_row_selected('matakuliah', $id);
                    if ($row) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>Data sudah ada.</p>
					</div>');
                        $data['aksi'] = 'Edit';
                        $this->template->load($this->view, 'prodi/fmatakuliah', $data);
                    } else {
			$data['kd_mtk'] = trim($kd_mtks);
                        $this->Prodi_model->save_data('matakuliah', $data);
			  $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    		<h4>Sukses</h4>
                    		<p>Data sudah tersimpan.</p></div>');

                        redirect(base_url() . 'prodi/lmatakuliah');
                    }
                } else {
                    if($kd_mtk==""){
                            $data['kd_mtk'] = $kd_lama;
                
                    }else
                    {
                        $data['kd_mtk'] = str_replace('  ', ' ', $kd_mtks_baru);
                
                    }
                        $this->Prodi_model->update_data('matakuliah', $data, $id);
                        $datax['kd_mtk']=str_replace('  ', ' ', $kd_mtks_baru);
                        $idx['kd_mtk']=$kd_lama;
                        $this->Prodi_model->update_data('jadwal',$datax,$idx);
                
                    redirect(base_url() . 'prodi/lmatakuliah');
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function dmtk($kd_mtk) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['kd_mtk'] = $kd_mtk;
            $hail = $this->Prodi_model->delete_data('matakuliah', $id);

            redirect(base_url() . 'prodi/lmatakuliah');
        }
    }

    function emtk($kd_mtk) {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['kd_mtk'] = $kd_mtk;
            $hasil = $this->Prodi_model->get_row_selected('matakuliah', $id);
            $data['kd_mtk_lama'] = $hasil->kd_mtk;
            $data['kd_mtk_lamax'] = substr($hasil->kd_mtk,strlen($hasil->kd_kurikulum)+1);
            
            $data['kd_mtk'] = '';

            $data['aksi'] = "Edit";
            $data['nm_mtk'] = $hasil->nm_mtk;
            $data['sks_teori'] = $hasil->sks_teori;
            $data['sks'] = $hasil->sks;
            $data['sks_praktikum_lab'] = $hasil->sks_praktikum_lab;
            $data['sks_praktikum_lapangan'] = $hasil->sks_praktikum_lapangan;
            $data['semester_ke'] = $hasil->semester_ke;
            $data['semester'] = $hasil->semester;
            $data['prasyarat_mk'] = $hasil->prasyarat_mk;
            $data['prasyarat_nilai_mk'] = $hasil->prasyarat_nilai_mk;
            $data['prasyarat_mk2'] = $hasil->prasyarat_mk2;
            $data['prasyarat_nilai_mk2'] = $hasil->prasyarat_nilai_mk2;

            $data['kd_jenis_mtk'] = $hasil->kd_jenis_mtk;
            
                  $data['cp_prodi']=$hasil->cp_prodi;
                $data['cp_matakuliah']=$hasil->cp_matakuliah;
                $data['deskripsi_mk']=$hasil->deskripsi_mk;
                
                
            $data['kd_prodi'] = $hasil->kd_prodi;
            $key['kd_prodi'] = $homebase;


            $data['listkurikulum'] = $this->Prodi_model->get_list_selected('kurikulum', $key);
            $keymtk['kd_prodi'] = $homebase;
            $data['listmatakuliah'] = $this->Prodi_model->get_list_selected('matakuliah', $keymtk);

            $data['listgroupmtk'] = $this->Prodi_model->get_all('groupmatakuliah');


            $this->template->load($this->view, 'prodi/ematakuliah', $data);
        }
    }

    //daftar kurikulum
    function lkurikulum() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $keyta['kd_prodi'] = $homebase;
                $data['listkurikulum'] = $this->Prodi_model->get_list_selected('kurikulum', $keyta);
                $this->template->load($this->view, 'prodi/lkurikulum', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function fkurikulum() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $data['kd_kurikulum'] = '';
                $data['nm_kurikulum'] = '';
                $data['thn_awal'] = '';
                $data['thn_akhir'] = '';
                $data['aktif'] = '';
                $data['kd_prodi'] = '';
                $data['aksi'] = 'Input';

                $this->template->load($this->view, 'prodi/fkurikulum', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function dkurikulum($kd_kurikulum) {
        $level = $this->session->userdata('level');
        if ($level == "prodi") {
            $key['kd_kurikulum'] = $kd_kurikulum;
            $this->Prodi_model->delete_data('kurikulum', $key);
            redirect(base_url() . 'prodi/lkurikulum');
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    function ekurikulum($kd_kurikulum) {
        $level = $this->session->userdata('level');
        if ($level == "prodi") {
            $key['kd_kurikulum'] = $kd_kurikulum;
            $data = $this->Prodi_model->get_row_selected('kurikulum', $key);
            $data->aksi = "Edit";
            $this->template->load($this->view, 'prodi/fkurikulum', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    function akurikulum() {
        $kd_prodi = $this->session->userdata('home_base');
        $level = $this->session->userdata('level');
        $datax['nm_kurikulum'] = $this->input->post('nm_kurikulum', TRUE);
        $datax['thn_awal'] = $this->input->post('thn_awal', TRUE);
        $datax['thn_akhir'] = $this->input->post('thn_akhir', TRUE);
        $datax['aktif'] = $this->input->post('aktif', TRUE);
        $datax['kd_prodi'] = $kd_prodi;
        
        $kurik=$this->input->post('kd_kurikulum', TRUE);
        
        $kurikulum=$kd_prodi.$kurik;
        $aksi = $this->input->post('aksi', TRUE);
        if ($level == "prodi") {
            if ($aksi == "Input") {
                $datax['kd_kurikulum'] = $kurikulum;
                
                //cek duplikat
                $key['kd_kurikulum']=$kurikulum;
                 $row = $this->Prodi_model->get_row_selected('kurikulum', $key);
                 if($row){
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>kode kurikulum  ini sudah ada.</p>
					</div>');
                    
                 }
                 else
                 {
                       $this->Prodi_model->save_data('kurikulum', $datax);
                 }
                
               
            } else {
                $key['kd_kurikulum'] = $this->input->post('kd_kurikulum', TRUE);
                $this->Prodi_model->update_data('kurikulum', $datax, $key);
            }
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
        redirect(base_url() . 'prodi/lkurikulum');
    }

//FORM PEMBIMBING AKADEMIK

    function lpa() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $keyta['aktif'] = 'YA';
                $rowta = $this->Prodi_model->get_row_selected('thnajaran', $keyta);
                $kd_tahun_ajaran = $rowta->kd_tahun_ajaran;
                $kd_prodi = $this->session->userdata('home_base');
                $data['homebase'] = $homebase;
                $data['listpa'] = $this->get_lpa($kd_prodi);
                $this->template->load($this->view, 'prodi/listpa', $data);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function emahasiswa($nim) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $datauser['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $datauser);
            $level = $row->level;
            if ($level == "prodi") {
                $key['nim'] = $nim;
                $hasil['mahasiswa'] = $this->Prodi_model->get_row_selected('mahasiswa', $key);
                
                
                $hasil['aksi'] = 'Edit';
                $hasil['liststatus']=$this->Prodi_model->get_all('mstatus');
                 $hasil['listagama']=$this->Prodi_model->get_all('tagama');
                 $hasil['listjalur']=$this->Prodi_model->get_all('mtjalur_masuk');
                $this->template->load($this->view, 'prodi/femahasiswa', $hasil);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function amahasiswa() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $datauseri['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $datauseri);
            $level = $row->level;
            if ($level == "prodi") {
                $data['nim'] = $this->input->post('nim', TRUE);
                $data['nm_mahasiswa'] = $this->input->post('nm_mahasiswa', TRUE);
                $data['tempat_lahir'] = $this->input->post('tempat_lahir', TRUE);
                $data['tgl_lahir'] = $this->input->post('tgl_lahir', TRUE);
               
                $data['jns_kelamin'] = $this->input->post('jns_kelamin', TRUE);
                $data['jalur_masuk'] = $this->input->post('jalur_masuk', TRUE);
                $data['semester'] = $this->input->post('semester', TRUE);
                $data['angkatan'] = $this->input->post('angkatan', TRUE);
                 $data['nilai_ukt'] = $this->input->post('nilai_ukt', TRUE);
                $data['status'] = $this->input->post('status', TRUE);
                $data['NIK'] = $this->input->post('nik', TRUE);
                $data['kd_prodi'] = $homebase;
                $aksi = $this->input->post('aksi', TRUE);
               
                $datauser['nama']=$this->input->post('nm_mahasiswa', TRUE);
                $datauser['level']='mahasiswa';
                
                $datauser['home_base']=$homebase;
                $datauser['aktif']='Ya';
                
                
                
                
                if ($aksi == 'Input') {
                     $datauser['userid']=$this->input->post('nim', TRUE);
                     $datauser['password']='e9d2b7b82f36eb6d492f3074ee7dcd5c';
                    $this->Prodi_model->save_data('mahasiswa', $data);
                    $this->Prodi_model->save_data('user', $datauser);
                    
                } else {
                    $key['nim'] = $this->input->post('nim', TRUE);
                    $this->Prodi_model->update_data('mahasiswa', $data, $key);
                    $keyuser['userid'] = $this->input->post('nim', TRUE);
                    $hasil=$this->Prodi_model->get_row_selected('user',$keyuser);
                    if(!empty($hasil))
                    {
                        $this->Prodi_model->update_data('user', $datauser, $keyuser);
                        
                    }else
                    {
                        $datauser['userid']=$this->input->post('nim', TRUE);
                        $this->Prodi_model->save_data('user', $datauser);
                    
                    }
                }
                redirect(base_url() . 'prodi/lmhs');
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function dmahasiswa($nim) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $datauser['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $datauser);
            $level = $row->level;
            if ($level == "prodi") {
                $data['nim'] = $nim;
                $hasil = $this->Prodi_model->delete_data('mahasiswa', $data);
                if ($hasil) {
                    redirect(base_url() . 'prodi/lmhs');
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function fmahasiswa() {
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $homebase = $this->session->userdata('home_base');

        $level = $this->session->userdata('level');
        //$st=$this->session->userdata('userid');
        $data['userid'] = $cek;
        $row = $this->Prodi_model->get_row_selected('user', $data);
        $level = $row->level;
        if ($level == "prodi") {

            $rowmhs['nim'] = "";
            $rowmhs['nm_mahasiswa'] = "";
            $rowmhs['tempat_lahir'] = "";
            $rowmhs['tgl_lahir'] = "";
            $rowmhs['jns_kelamin'] = "";
            $rowmhs['agama'] = "";
            $rowmhs['kd_prodi'] = $homebase;
            $rowmhs['nilai_ukt'] = "";
            $rowmhs['angkatan'] = "";
            $rowmhs['nilai_ukt'] = "";
            $rowmhs['semester'] = "";
            $rowmhs['aksi'] = "Input";
             $rowmhs['liststatus']=$this->Prodi_model->get_all('mstatus');
                 $rowmhs['listagama']=$this->Prodi_model->get_all('tagama');
                 $rowmhs['listjalur']=$this->Prodi_model->get_all('mtjalur_masuk');
            $this->template->load($this->view, 'prodi/fmahasiswa', $rowmhs);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    

    function ldosen_pa()
    {
        $kd_prodi = $this->session->userdata('home_base');
        $data['list']=$this->get_dosen_pa($kd_prodi);
             $this->template->load($this->view, 'prodi/ldosen_pa', $data);
    }
 
    
    function get_dosen_pa($kd_prodi)
    {
        
        $sql="select pah.kd_dosen,nidn,nm_dosen,jafung, count(*) as jumlah from pah,pad,dosen WHERE pah.kd_dosen=dosen.kd_dosen and pah.no_pa=pad.no_pa and pah.kd_prodi='".$kd_prodi."' GROUP by 	kd_dosen order by jumlah asc" ;
          $hasil = $this->db->query($sql)->result();
        return $hasil;
        
    }
    function edosen($kd_dosen) {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {


                $id['kd_dosen'] = $kd_dosen;
                $row = $this->Prodi_model->get_row_selected('dosen', $id);
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
                    $datax['kd_prodi'] = $homebase;
                    $datax['email'] = $row->email;
                    $datax['aksi'] = "Edit";

                    $this->template->load($this->view, 'prodi/edosen', $datax);
                } else {

                    $this->Prodi_model->save_data('dosen', $datax);
                    redirect(base_url() . 'prodi/ldosen');
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function ddosen($kd_dosenx) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['kd_dosen'] = $kd_dosenx;
            $id2['userid'] = $kd_dosenx;
            $this->Prodi_model->delete_data('dosen', $id);
            $this->Prodi_model->delete_data('user', $id2);

            redirect(base_url() . 'prodi/ldosen');
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

            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                
                $datax['listdosen'] = $this->get_all_dosen();
                $this->template->load($this->view, 'prodi/alldosen', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    
    function ldosen() {
        $cek = $this->session->userdata('userid');
        $kd_prodi = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;

            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $keyta['kd_prodi'] = $kd_prodi;
                $datax['listdosen'] = $this->Prodi_model->get_list_selected('dosen', $keyta);
                
                $this->template->load($this->view, 'prodi/listdosen', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    

    //fungsi tahun_akademik
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
            if($level=="prodi")
            {
               
              
                $datax['kd_tahun_ajaran']='';
                $datax['aktif']='';

                $this->template->load($this->view,'prodi/tahunajaran',$datax);
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
         $home_base = $this->session->userdata('home_base');
    $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;

            if($level=="prodi"|| $level=="wr1")
            {
                 //operasinya
                $ta=$this->input->post('kd_tahun_ajaran',TRUE);

                $datax['kd_tahun_ajaran']=$ta;
                 $datax['kd_prodi']=$home_base;

                $datax['aktif']=$this->input->post('aktif',TRUE);

                $this->Akademika_model->save_data('thnajaranprodi',$datax);
                redirect(base_url());
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }

    }

    function get_lpa($homebase) {
        $sql = "select thn_angkatan,no_pa,tgl_pa,pah.kd_dosen,NIDN,nm_dosen,pah.kd_prodi,(select count(nim) from pad where pad.no_pa=pah.no_pa) as jumlah from pah,dosen where pah.kd_dosen=dosen.kd_dosen and pah.kd_prodi='" . $homebase . "'";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
    }

    function dpad($no_pa, $nim) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['no_pa'] = $no_pa;
            $id['nim'] = $nim;
            $hail = $this->Prodi_model->delete_data('pad', $id);

            redirect(base_url() . 'Prodi/epa/' . $no_pa);
        }
    }

    function dpa($no_pa) {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['no_pa'] = $no_pa;
            $hail = $this->Prodi_model->delete_data('pah', $id);

            redirect(base_url() . 'Prodi/lpa');
        }
    }

    //fungsi form pembimbing akademik
	//modul pa
	
	function fpax()
	{
		 $level = $this->session->userdata('level');
		$key['kd_prodi'] = $this->session->userdata('home_base');
		  $data['angkatan']='';
		  $prodi=$this->Prodi_model->get_row_selected('prodi', $key);
		
		  $data['dosen'] = $this->get_dosen_fakultas($prodi->kd_fak);
		  $this->template->load($this->view, 'prodi/fta', $data);
		  
	}
	
	 function get_dosen_fakultas($fakultas)
	{
	    $sql="select kd_dosen,dosen.NIDN,nm_dosen,jafung from dosen,prodi,fakultas where dosen.kd_prodi=prodi.kd_prodi and prodi.kd_fak=fakultas.kd_fak and prodi.kd_fak='".$fakultas."'";
	     $hasil = $this->db->query($sql)->result();
        return $hasil;
    //     echo json_encode($hasil);
	    
	}
    function fpa() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $level = $this->session->userdata('level');
		$angkatan = $this->input->post('angkatan', TRUE);
		$kd_dosen = $this->input->post('kd_dosen', TRUE);
		$nm_dosen = $this->input->post('nm_dosen', TRUE);
        if ($level == "prodi") {
		
		
            $keyta['aktif'] = 'YA';
            $key['kd_prodi'] = $homebase;
            $data['aksi'] = "Input";
            $data['no_pa'] = "";
            $data['kd_prodi'] = $homebase;
            $data['thn_angkatan'] = $angkatan;
			$data['kd_dosen'] = $kd_dosen;
			$data['nm_dosen'] = $nm_dosen;
            $data['listmhs'] = $this->get_mhs_fpa($homebase,$angkatan);
            $data['dosen'] = $this->Prodi_model->get_list_selected('dosen', $key);
            //echo json_encode($data['dosen']);
			$keyfindpah['kd_dosen']=$kd_dosen;
			$keyfindpah['thn_angkatan']=$angkatan;
			$keyfindpah['kd_prodi']=$homebase;
			
			$hasil=$this->Prodi_model->get_row_selected('pah',$keyfindpah);
			if(empty($hasil))
			{
            $this->template->load($this->view, 'prodi/fpa', $data);
			}else
			{
				echo "Dosen ".$nm_dosen." telah diinput pada Angkatan ".$angkatan;
			}
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    
    //laporan-laporan
    
    
    function flap_registrasi()
    {
         $data['kd_ta']=$this->get_ta_aktif();
         
          $data['list_ta'] = $this->Prodi_model->get_all_desc('thnajaran','kd_tahun_ajaran');
    $data['list_jenis_registrasi'] = $this->Prodi_model->get_all('mjenis_registrasi');
    $data['list_angkatan'] = $this->Prodi_model->get_all_desc('angkatan','tahun');
         $data['jenis_registrasi']='P03';
         $data['status']='Sudah';
         
        $this->template->load($this->view, 'prodi/flap_registrasi', $data);
       
    }
        
    function flap_rekap_jadwal_dosen()
    {
        $kd_tahun_ajaran= $this->session->userdata('kd_tahun_ajaran');
         $data['kd_tahun_ajaran']=$kd_tahun_ajaran;
      
        
        $this->template->load($this->view, 'prodi/flap_rekap_jadwal_dosen', $data);
       
    }
    function jadwal_kuliah()
    {
        $homebase = $this->session->userdata('home_base');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
         $data['kd_tahun_ajaran']= $this->session->userdata('kd_tahun_ajaran');
       
        $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
        $data['list']=$this->get_list_jadwal_kuliah2($kd_tahun_ajaran,$homebase);
         //$this->template->load($this->view, 'prodi/lap_registrasi', $data);
          $this->load->view('prodi/jadwal_kuliah',$data);
    }
     function lap_rekap_jadwal_kuliah()
    {
         $homebase = $this->session->userdata('home_base');
         $data['kd_tahun_ajaran']= $this->input->post('kd_tahun_ajaran', TRUE);
         $kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
        $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
        $data['list']=$this->get_list_jadwal_kuliah($kd_tahun_ajaran,$homebase);
         //$this->template->load($this->view, 'prodi/lap_registrasi', $data);
          $this->load->view('prodi/lap_rekap_jadwal_dosen',$data);
    }
    function lap_rekap_jadwal_dosen()
    {
         $homebase = $this->session->userdata('home_base');
         $data['kd_tahun_ajaran']= $this->input->post('kd_tahun_ajaran', TRUE);
         $kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
        $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
        $data['list']=$this->get_list_jadwal_dosen($kd_tahun_ajaran,$homebase);
         //$this->template->load($this->view, 'prodi/lap_registrasi', $data);
          $this->load->view('prodi/lap_rekap_jadwal_dosen',$data);
    }
    function lap_registrasi()
    {
         $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran', TRUE);
         $jenis_registrasi= $this->input->post('jenis_registrasi', TRUE);
         $status= $this->input->post('status', TRUE);
         $angkatan= $this->input->post('angkatan', TRUE);
        
         $homebase = $this->session->userdata('home_base');
         $data['kd_tahun_ajaran']= $kd_tahun_ajaran;
         //$data[homebase] = $this->session->userdata('home_base');
         $data['jenis_registrasi']= $jenis_registrasi;
         
        $data['prodi']=$this->Akademika_model->get_data_prodi($homebase);
         $data['list']=$this->get_registrasi($kd_tahun_ajaran,$homebase,$angkatan,$jenis_registrasi,$status);
         
         $data['angkatan']=$angkatan;
         if($status=="Sudah")
         {
            $data['judul']="LAPORAN DATA MAHASISWA SUDAH REGISTRASI";
              $this->load->view('prodi/lap_registrasi',$data);
             
         }else
         {
            $data['judul']="LAPORAN DATA MAHASISWA BELUM REGISTRASI";
               $this->load->view('prodi/lap_registrasi_belum',$data);
         }
         
         //$this->template->load($this->view, 'prodi/lap_registrasi', $data);
        
    }
    function get_registrasi($kd_tahun_ajaran,$homebase,$angkatan,$jenis_registrasi,$status)
    {
        if($status=='Sudah')
        {
            $sql="SELECT registrasi.nim,noreg,tgl_reg_bak,tgl_reg_bank,nm_mahasiswa,angkatan,nilai_ukt,status FROM `registrasi`,mahasiswa WHERE registrasi.nim=mahasiswa.nim and kd_tahun_ajaran='".$kd_tahun_ajaran."' and registrasi.home_base='".$homebase."' and mahasiswa.angkatan='".$angkatan."' and jns_registrasi='P03' order by nim asc";    
        }else
        {
            $sql="select mahasiswa.nim, nm_mahasiswa,angkatan,nilai_ukt,mahasiswa.status from mahasiswa where  status!='L' and nim not in (select nim from registrasi where kd_tahun_ajaran='".$kd_tahun_ajaran."') and angkatan='".$angkatan."' and kd_prodi='".$homebase."' order by nm_mahasiswa asc";
        }

        
         $hasil = $this->db->query($sql)->result();
        return $hasil;
       //  echo json_encode($hasil);
    }

    
     function get_all_dosen()
    {
        $sql="select dosen.kd_dosen,dosen.NIDN,nm_dosen,jns_kelamin,alamat,tempat,tgl_lahir,telepon,link_foto,agama,dosen.Status,jafung,s1,s2,s3,email,dosen.kd_prodi,nm_prodi from dosen left join prodi on dosen.kd_prodi=prodi.kd_prodi order by dosen.kd_prodi asc";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
        //echo json_encode($hasil);
    }
    private function get_mhs_udo($homebase) {

        //$sql="select nim,nm_mahasiswa,angkatan,kd_prodi from mahasiswa where nim not in (select nim from pad) and kd_prodi='".$homebase."'";
        $sql = "select nim,nm_mahasiswa,angkatan,kd_prodi,mahasiswa.status as status from mahasiswa where (status<>'A' and status<>'L') and kd_prodi='".$homebase."'  ";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
        // echo json_encode($hasil);
    }
    private function get_mhs_fpa($homebase,$angkatan) {


        //$sql="select nim,nm_mahasiswa,angkatan,kd_prodi from mahasiswa where nim not in (select nim from pad) and kd_prodi='".$homebase."'";
        $sql = "select nim,nm_mahasiswa,angkatan,kd_prodi,mahasiswa.status as status from mahasiswa where nim not in (SELECT  nim FROM  `pah` INNER JOIN
  `pad` ON `pad`.`no_pa` = `pah`.`no_pa`) and kd_prodi='" . $homebase . "' and angkatan='".$angkatan."' order by angkatan,nim asc ";


        $hasil = $this->db->query($sql)->result();
        return $hasil;
        // echo json_encode($hasil);
    }

//fungsi ambil mahasiswa pa angkatan tertentu
    private function get_mhs_epa($homebase,$angkatan,$kd_dosen) {


        //$sql="select nim,nm_mahasiswa,angkatan,kd_prodi from mahasiswa where nim not in (select nim from pad) and kd_prodi='".$homebase."'";
        $sql = "select nim,nm_mahasiswa,angkatan,kd_prodi,mahasiswa.status as status from mahasiswa where nim not in (SELECT  nim FROM  `pah` INNER JOIN
  `pad` ON `pad`.`no_pa` = `pah`.`no_pa` where pah.kd_dosen<>'" .$kd_dosen."') and kd_prodi='" . $homebase . "' and angkatan='".$angkatan."' order by angkatan,nim asc";


        $hasil = $this->db->query($sql)->result();
        return $hasil;
        // echo json_encode($hasil);
    }

    //fungsi ambil data detail pah
    private function get_epah($no_pa) {
        $sql = "SELECT `pah`.`no_pa`, `pah`.`tgl_pa`, `pah`.`kd_dosen`, `dosen`.`NIDN`,`dosen`.`nm_dosen`, `pah`.`thn_angkatan`
		FROM `pah` INNER JOIN `dosen` ON `dosen`.`kd_dosen` = `pah`.`kd_dosen`
		WHERE `pah`.`no_pa` = '" . $no_pa . "'";
        $hasil = $this->db->query($sql)->row();
        return ($hasil);
        //echo json_encode ($hasil);
    }

    //fungsi ambil data detail pad
    private function get_epad($no_pa) {
        $sql = "SELECT `pad`.`nim`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`kd_prodi`, `mahasiswa`.`angkatan`, `pad`.`no_pa`
    FROM `pad` INNER JOIN  `mahasiswa` ON `mahasiswa`.`nim` = `pad`.`nim`
    WHERE `pad`.`no_pa` = '" . $no_pa . "'";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
    }

    //fungsi simpan pembimbing akademik
    function apa() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $aksi = $this->input->post('aksi', TRUE);
                $hdata['thn_angkatan'] = $this->input->post('thn_angkatan', TRUE);
                $hdata['kd_prodi'] = $homebase;
                $hdata['kd_dosen'] = $this->input->post('kd_dosen', TRUE);
                $hdata['tgl_pa'] = date('Y-m-d');
                $hasil = $this->input->post('mhs', TRUE);
                if ($aksi == "Input") {

                    $no_pa = $this->createNoPA($homebase);
                    $hdata['no_pa'] = $no_pa;
                    $this->Prodi_model->save_data('pah', $hdata);
                    foreach ($hasil as $key) {
                        $ddata['nim'] = $key;
                        $ddata['no_pa'] = $no_pa;
                        $this->Prodi_model->save_data('pad', $ddata);
                    }
                    redirect(base_url() . 'Prodi/lpa');
                } else {
                    $no_pa = $this->input->post('no_pa', TRUE);
                    $keypa['no_pa'] = $no_pa;
                    $hdata['no_pa'] = $this->input->post('no_pa', TRUE);
                    $this->Prodi_model->update_data('pah', $hdata, $keypa);
                    $this->Prodi_model->delete_data('pad',$keypa);
                    
                    foreach ($hasil as $key) {
                        $ddata['nim'] = $key;
                        $ddata['no_pa'] = $no_pa;


                        $hasil2 = $this->Prodi_model->get_row_selected('pad', $ddata);
                        if (empty($hasil2)) {
                            $this->Prodi_model->save_data('pad', $ddata);
                        }
                    }
                    redirect(base_url() . 'Prodi/lpa');
                }
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function luser() {

        $homebase = $this->session->userdata('home_base');
        $level = $this->session->userdata('level');
        if ($level == "prodi") {
            $key['home_base'] = $homebase;
            $key['level'] = 'dosen';
            $datax['listuser'] = $this->Prodi_model->get_list_selected('user', $key);
            $this->template->load($this->view, 'prodi/listuser', $datax);
        }
    }

    //form jadwal matakuliah
    function fjm() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            $data = array('data' => 'Bismillah', 'hadist' => 'isbal');
            $keyprodi['kd_prodi'] = $homebase;
            $dprodi = $this->Prodi_model->get_row_selected('prodi', $keyprodi);
            if ($level == "prodi") {
                $keyta['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $ta = $this->Prodi_model->get_row_selected('thnajaran', $keyta);
                $keymtk['semester'] = $ta->semester;
                $keymtk['kd_prodi'] = $homebase;
                $keymtk['aktif'] = 'Ya';
                $matakuliah = $this->Prodi_model->get_list_selected('matakuliah', $keymtk);
                $dosen = $this->Prodi_model->get_all('dosen');
                $ruang = $this->Prodi_model->get_all('ruang');
                $datax['kd_jadwal'] = '';
                $datax['kd_tahun_ajaran'] = $ta->kd_tahun_ajaran;
                $datax['kd_prodi'] = $homebase;
                $datax['nm_prodi'] = $dprodi->nm_prodi;
                $datax['status'] = 'Buat';
                $datax['aksi'] = 'Input';
                $datax['kelas'] = '';
                $datax['kd_mtk'] = '';
                $datax['kd_ruang'] = '';
                $datax['kapasitas'] = '';
                $datax['jam'] = '';
                $datax['kd_dosen'] = '';
                $datax['kd_dosen2'] = '';
                $datax['matakuliah'] = $matakuliah;
                $datax['dosen'] = $dosen;
                $datax['ruang'] = $ruang;
                $datax['listhari'] = $this->Prodi_model->get_all('thari');
                $this->template->load($this->view, 'prodi/jadwalmatakuliah', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    //aksi OPERASI SIMPAN JADWAL AKADEMIK
    function ajm() {
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "prodi") {
                $aksi = $this->input->post('aksi', TRUE);
                $datax['kd_tahun_ajaran'] =$kd_tahun_ajaran;
                $datax['kd_prodi'] = $this->input->post('kd_prodi', TRUE);
                $datax['kd_mtk'] = $this->input->post('kd_mtk', TRUE);
                //$datax['kd_dosen'] = $this->input->post('kd_dosen', TRUE);
                //$datax['kd_dosen2'] = $this->input->post('kd_dosen2', TRUE);
                $datax['kelas'] = $this->input->post('kelas', TRUE);
                $datax['hari'] = $this->input->post('hari', TRUE);
                $datax['jam'] = $this->input->post('jam', TRUE);
                $datax['kd_ruang'] = $this->input->post('kd_ruang', TRUE);
                $datax['kapasitas'] = $this->input->post('kapasitas', TRUE);
                if ($aksi == "Input") {
                    $datax['kd_jadwal'] = $this->createNoJK($homebase,$kd_tahun_ajaran);
                    $this->Prodi_model->save_data('jadwal', $datax);
                } elseif ($aksi == "Edit") {
                    $datax['kd_jadwal'] = $this->input->post('kd_jadwal', TRUE);
                    $key['kd_jadwal'] = $this->input->post('kd_jadwal', TRUE);
                    $this->Prodi_model->update_data('jadwal', $datax, $key);
                    $datad['kd_mtk'] = $this->input->post('kd_mtk', TRUE);
                    $key2['kd_jadwal'] = $this->input->post('kd_jadwal', TRUE);
                    $this->Prodi_model->update_data('rencanastudid', $datad, $key2);
                }
                redirect(base_url() . 'prodi/ljm');
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    function djk($kd_jadwal) {
        $this->cek_jadwal($kd_jadwal);
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {


            $id['kd_jadwal'] = $kd_jadwal;
            $hail = $this->Prodi_model->delete_data('jadwal', $id);

            redirect(base_url() . 'Prodi/ljm');
        }
    }

    function ejk($kd_jadwali) {
       $this->cek_jadwal($kd_jadwali);
        $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
        if (empty($cek)) {
            redirect(base_url());
        } else {
             
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Prodi_model->get_row_selected('user', $data);
            $level = $row->level;

            $keyprodi['kd_prodi'] = $homebase;

            if ($level == "prodi") {
                
                $keymtk['kd_prodi'] = $homebase;
                $datax['matakuliah'] = $this->Prodi_model->get_list_selected('matakuliah', $keymtk);
                $datax['dosen'] = $this->Prodi_model->get_all('dosen');
                $datax['ruang'] = $this->Prodi_model->get_all('ruang');
                $key['kd_jadwal'] = $kd_jadwali;
                $hasil = $this->Prodi_model->get_row_selected('jadwal', $key);
                $datax['kd_tahun_ajaran'] = $hasil->kd_tahun_ajaran;
                $datax['kd_prodi'] = $hasil->kd_prodi;
                $datax['nm_prodi'] = '';
                $datax['aksi'] = 'Edit';
                $datax['kd_mtk'] = $hasil->kd_mtk;
                //$datax['kd_dosen'] = $hasil->kd_dosen;
               // $datax['kd_dosen2'] = $hasil->kd_dosen2;
                $datax['kelas'] = $hasil->kelas;
                $datax['hari'] = $hasil->hari;
                $datax['jam'] = $hasil->jam;
                $datax['kd_ruang'] = $hasil->kd_ruang;
                $datax['listhari'] = $this->Prodi_model->get_all('thari');
                $datax['kapasitas'] = $hasil->kapasitas;
                $datax['kd_jadwal'] = $hasil->kd_jadwal;
                $this->template->load($this->view, 'prodi/jadwalmatakuliah', $datax);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }


    function epa() {
        $no_pa = $this->uri->segment(3);
        $key['no_pa'] = $no_pa;
        $level = $this->session->userdata('level');
        if ($level <> "prodi") {
            redirect(base_url());
        } else {
            $homebase = $this->session->userdata('home_base');
        $key_prodi['kd_prodi']=$homebase;
            $hasil = $this->Prodi_model->get_row_selected('pah', $key);
            $kd_dosen = $hasil->kd_dosen;
			$angkatan = $hasil->thn_angkatan;
            $data['listmhs'] = $this->get_mhs_epa($homebase,$angkatan,$kd_dosen);

        
            $data['datah'] = $this->get_epah($no_pa);
            $data['data'] = $this->get_epad($no_pa);
            $data['aksi'] = "Edit";
             $data['dosen'] = $this->Prodi_model->get_list_selected('dosen', $key_prodi);
            $this->template->load($this->view, 'prodi/epa', $data);
        }
    }

    function tutup_jadwal($kd_jadwal)
    {
       $key['kd_jadwal']=$kd_jadwal;
       
         $hdata['status']='Tertutup';
        $this->Prodi_model->update_data('jadwal',$hdata,$key);
        redirect(base_url() . 'prodi/ljm');
        
    }
     function buka_jadwal($kd_jadwal)
    {
       $key['kd_jadwal']=$kd_jadwal;
       
         $hdata['status']='Terbuka';
        $this->Prodi_model->update_data('jadwal',$hdata,$key);
        redirect(base_url() . 'prodi/ljm');
    }
    //fungsi daftaar jadwal matakuliah/kuliah
    function ljm2() {
        
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $homebase = $this->session->userdata('home_base');
        $kriteria['kd_prodi']=$homebase;
        $kriteria['kd_tahun_ajaran']=$kd_tahun_ajaran;

        if ($level == "prodi") {
            $jadwal=$this->get_list_jadwal($homebase,$kd_tahun_ajaran);
            $lstjadwal['data'] = $this->get_list_jadwal($homebase,$kd_tahun_ajaran);
            
            
            $this->template->load($this->view, 'prodi/listjadwalmtk', $lstjadwal);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    function ljm() {
        $list=array();
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $homebase = $this->session->userdata('home_base');
        $kriteria['kd_prodi']=$homebase;
        $kriteria['kd_tahun_ajaran']=$kd_tahun_ajaran;
        
        if ($level == "prodi") {
            $jadwal=$this->get_list_jadwal($homebase,$kd_tahun_ajaran);
            $lstjadwal['data'] = $this->get_list_jadwal($homebase,$kd_tahun_ajaran);
            foreach($jadwal as $row)
            {
                
                    $data['kd_jadwal']=$row->kd_jadwal;
                        $data['semester_ke']=$row->semester_ke;
         $data['nm_mtk']=$row->nm_mtk;
         $data['kd_mtk']=$row->kd_mtk;
         $data['sks']=$row->sks;
         $data['kelas']=$row->kelas;
         $data['kd_ruang']=$row->kd_ruang;
         $data['kapasitas']=$row->kapasitas;
        $data['hari']=$row->hari;
        $data['jam']=$row->jam;
 $data['status']=$row->status;
$data['terisi']=$row->terisi;

               
                $hasil=$this->get_jadwal_detail($row->kd_jadwal);
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
          //  $list=(object)$list;
                $datax['data']=$list;
               // echo json_encode($datax);
            $this->template->load($this->view, 'prodi/jadwal/list_jadwal', $datax);
           
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
    function frlist_matkul_mhs()
    {
        $data='';
         $this->template->load($this->view, 'prodi/frlist_matkul_mhs', $data);
    }
    public function get_ta_mahasiswa()
    {
        $nim=$this->input->post('nim',true);
        $sql="SELECT DISTINCT kd_tahun_ajaran FROM rencanastudih where nim='".$nim."'";
        $hasil = $this->db->query($sql)->result();
        echo json_encode($hasil);
        
    }
    function frkhs()
    {
        
        $data='';
        $this->template->load($this->view, 'prodi/frkhs', $data);
        
    }
    function get_ta_aktif()
    {
        $key['aktif']='ya';
        $data=$this->Prodi_model->get_row_selected('thnajaran',$key);
        return $data->kd_tahun_ajaran;
    }

    function ftranskrip_nilai()
    {
        $cek = $this->session->userdata('userid');
        //cek_login($cek);
        $data='';
        $this->template->load($this->view, 'laporan/ftranskrip_nilai', $data);
        
    }
    function transkrip_nilai2($nim)
    {
        
          //$nim =$this->session->userdata('userid');
          
           $homebase =$this->session->userdata('home_base');
           $data['pa'] = $this->Akademika_model->get_pa($nim);
            $keyprodi['kd_prodi']=$homebase;
            $keymhs['nim']=$nim;
            $data['mahasiswa']=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
            
				$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
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
     public function transkrip_nilai()
    {
          $nim = $this->input->post('nim');
          $ta_awal = $this->input->post('ta_awal');
          $ta_akhir = $this->input->post('ta_akhir');

           
           
           $data['pa'] = $this->Akademika_model->get_pa($nim);
          
            $keymhs['nim']=$nim;
            $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
              $keyprodi['kd_prodi']=$mhs->kd_prodi;
              $data['mahasiswa']=$mhs;
				$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
				$data['dekan']=$fak->dekan;
				$data['wd1']=$fak->wd1;
                $data['ka_prodi']=$prodi->ka_prodi;
                $data['nm_prodi']=$prodi->nm_prodi;
                $data['nip_dekan']=$fak->nip_dekan;
                $data['nidn_prodi']=$prodi->nidn;
         $data['transkrip'] = $this->Akademika_model->get_transkrip_nilai_ta($nim,$ta_awal,$ta_akhir);
        $this->load->view('laporan/transkrip_nilai', $data);
    }
    function list_matkul_mhs($nim)
    {
         
           $homebase = $cek = $this->session->userdata('home_base');
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
          $this->template->load($this->view, 'prodi/list_mtk_krs_mhs', $data);
       // $this->load->view('prodi/list_mtk_krs_mhs', $data);
    }

    function get_list_all_krs_mtk($nim)
    {
    
        $sql="SELECT rencanastudih.kd_tahun_ajaran, rencanastudid.no_krs,rencanastudid.kd_jadwal, rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai` and rencanastudid.aktif='Ya' order by matakuliah.semester_ke,nm_mtk asc";
         $output = $this->db->query($sql)->result();
            return $output;
        
    //    echo json_encode($output);
    }
    function get_list_all_mtk($nim)
    {
    
        $sql="SELECT rencanastudih.kd_tahun_ajaran, rencanastudid.no_krs,rencanastudid.kd_jadwal, rencanastudid.aktif as aktif,rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai`  order by matakuliah.semester_ke,nm_mtk asc";
         $output = $this->db->query($sql)->result();
            return $output;
        
    //    echo json_encode($output);
    }
    function krs_mhs($nim)
    {
       
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        
        $key['nim']=$nim;
        
        $data['data']=$this->Prodi_model->get_list_selected('rencanastudih',$key);
         $this->template->load($this->view, 'prodi/lkrsmb', $data);
    }
    
    function vkrs($no_krs) {
       // $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
		$homebase = $this->session->userdata('home_base');
        
		if ($level == 'prodi') {
		        //$krsh= 
                //$data['krsh'] =$this->Akademika_model->get_krsh($no_krs);
                $krsh=$this->Akademika_model->get_krsh($no_krs);
                $data['krsh'] = $krsh;
                $kd_ta=$krsh->kd_tahun_ajaran;
                //semestara darurat
                //$hasil=$this->get_ipk($cek);
                $nim=$krsh->nim;
                $data['ipk']=$this->Akademika_model->get_ipk($nim,$kd_ta);
                $data['krsd'] = $this->Akademika_model->get_krsd($no_krs);
                $data['pa'] = $this->Akademika_model->get_pa($nim);
				$keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Prodi_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
				if($homebase=='012')
				{
				    $this->load->view('mahasiswa/krs012', $data);
				}else
				{
				    $this->load->view('mahasiswa/krs', $data);    
				}
                
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    function allkrs() {
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
        $homebase = $this->session->userdata('home_base');
        $ta = $this->session->userdata('kd_tahun_ajaran');

        if ($level == "prodi") {
            $listkrssetujui['listkrs'] = $this->get_all_krs($homebase, $ta);
            $this->template->load($this->view, 'prodi/listkrssetujui', $listkrssetujui);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    function print_krs($no_krs, $nim) {
        $level = $this->session->userdata('level');
        $homebase = $this->session->userdata('home_base');

        if ($level == 'prodi') {
            $krsh=$this->get_krsh($no_krs, $nim);
            $data['krsh'] = $krsh;
            $kd_ta=$krsh->kd_tahun_ajaran;
            $data['ipk'] = $this->Akademika_model->get_ipk_mhs($nim,$kd_ta);
            $data['krsd'] = $this->get_krsd($no_krs);
            $data['pa'] = $this->Akademika_model->get_pa($nim);
            $keyprodi['kd_prodi'] = $homebase;
            $prodi = $this->Prodi_model->get_row_selected('prodi', $keyprodi);
            $keyfak['kd_fak'] = $prodi->kd_fak;
            $fak = $this->Prodi_model->get_row_selected('fakultas', $keyfak);
            $data['nm_fak'] = $fak->nm_fak;
            $this->load->view('prodi/krs', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    function lkhs($nim)
    {
        
        $data['listta']=$this->Akademika_model->get_all_khs_nim($nim);
        $this->template->load($this->view, 'prodi/lkhs', $data);
    }
    function khs($no_krs) {
        //$nim = $this->input->post('nim', true);
        //$kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran', true);
        $homebase = $this->session->userdata('home_base');
        $data['hkhs'] = '';
        $data['dkhs'] = '';
        $hkhs = $this->Akademika_model->get_hkhs($no_krs);
        if ($hkhs) {
            $dkhs = $this->Akademika_model->get_dkhs($hkhs->no_krs);
            $data['hkhs'] = $hkhs;
            $data['dkhs'] = $dkhs;
            $data['pa'] = $this->Akademika_model->get_pa($hkhs->nim);
            $keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
                $data['ka_prodi']=$prodi->ka_prodi;
                $data['nidn']=$prodi->nidn;
                
        $this->load->view('laporan/khss', $data);
        } else {
            echo 'maaf hasil studi anda pada tahun_ajaran ini belum ada...';
        }
    }
    function rkhs() {
        $nim = $this->input->post('nim', true);
        $kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran', true);
        $homebase = $this->session->userdata('home_base');
        $data['hkhs'] = '';
        $data['dkhs'] = '';
        $key['nim']=$nim;
        $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $data2= $this->Akademika_model->get_row_selected('rencanastudih',$key);
     $no_krs=$data2->no_krs;
        $hkhs = $this->Akademika_model->get_hkhs($no_krs);
        if ($hkhs) {
            $dkhs = $this->Akademika_model->get_dkhs($hkhs->no_krs);
            $data['hkhs'] = $hkhs;
            $data['dkhs'] = $dkhs;
            $data['pa'] = $this->Akademika_model->get_pa($nim);
            $keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
                $data['ka_prodi']=$prodi->ka_prodi;
                $data['nidn']=$prodi->nidn;
                
        $this->load->view('laporan/khss', $data);
        } else {
            echo 'maaf hasil studi anda pada tahun_ajaran ini belum ada...';
        }
    }
    function f_rekap_khs()
    {
         $data['ta']=$this->Prodi_model->get_all('thnajaran');
         
         $this->template->load($this->view, 'prodi/frekapkhs', $data);
    }
    
     function rekap_krs()
    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran', TRUE);
        $kd_prodi= $this->session->userdata('home_base');
       // $kd_prodi='019';
        $hasil['jarak']=$this->input->post('jarak', TRUE);
        				$keyprodi['kd_prodi']=$kd_prodi;
				$prodi=$this->Prodi_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Prodi_model->get_row_selected('fakultas',$keyfak);
				$hasil['nm_fak']=$fak->nm_fak;
        $hasil['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $hasil['prodi']=$prodi;
        $hasil['listkhs']= $this->Prodi_model->get_rekap_ips_ta($kd_tahun_ajaran,$kd_prodi);
        //$this->load->view('prodi/lap_rekap_khs', $hasil);
    }
    
    public function get_ips($nim, $kd_tahun_ajaran) {
      // $ips = 0;
        $sqlips = "SELECT `rencanastudih`.`nim`, `rencanastudih`.`no_krs`, Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`) AS `total_bobot`, Sum(`matakuliah`.`sks`),Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`)/ Sum(`matakuliah`.`sks`) AS `ips` FROM mnilai, `rencanastudih`,`rencanastudid`,`matakuliah` where `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs` and  `matakuliah`.`kd_mtk` = `rencanastudid`.`kd_mtk` and rencanastudid.nilai=mnilai.nilai_h and `rencanastudih`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' and  `rencanastudih`.`nim` = '" . $nim . "'
GROUP BY  `rencanastudih`.`nim`, `rencanastudih`.`no_krs`";
        $hasil = $this->db->query($sqlips)->row();

        if(!$hasil)
        {
            $ips=0;
        }
        else
        {
            $ips=$hasil->ips;
            
        }
        
        return $ips;
       // echo $ips;
    }
    
    public function form_rekap_akademik_mhs()
    {
           
             $data['listta'] = $this->Prodi_model->get_all('thnajaran');
             $data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
             
         $this->template->load($this->view, 'prodi/lap_rekap_akademik_form', $data);
    }
    public function form_rekap_krs_mhs()
    {
           
             $data['listta'] = $this->Prodi_model->get_all('thnajaran');
             $data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
             
         $this->template->load($this->view, 'prodi/lap_rekap_krs_mhs_form', $data);
    }
    public function get_rekap_krs_mhs()
    {
        $kd_prodi=$this->session->userdata('home_base');
        $angkatan=$this->input->post('angkatan',TRUE);
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $kd_tahun_ajaran2=$this->input->post('kd_tahun_ajaran2',TRUE);
        $data['ta_awal']=$kd_tahun_ajaran;
        $data['ta_akhir']=$kd_tahun_ajaran2;
        
        $list=array();
        $sql = "select nm_prodi,mahasiswa.nim as nim,nm_mahasiswa,angkatan,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,nilai_ukt,semester,mahasiswa.status,awal_semester from mahasiswa,prodi where  mahasiswa.kd_prodi=prodi.kd_prodi and mahasiswa.kd_prodi='" . $kd_prodi . "' and angkatan='".$angkatan."' order by nm_mahasiswa asc";
        $listmhs= $this->db->query($sql)->result();
        foreach($listmhs as $mhs)
        {
            $sql2="SELECT * FROM `thnajaran` where `kd_tahun_ajaran` >='".$kd_tahun_ajaran."' and kd_tahun_ajaran<='".$kd_tahun_ajaran2."' order by kd_tahun_ajaran asc";   
            $listta= $this->db->query($sql2)->result();
            $data['listta']=$listta;
            //echo json_encode($listta);
            foreach($listta as $ta)
            {
                $rec_ips=$this->get_ips($mhs->nim,$ta->kd_tahun_ajaran);
                $rec_sks_semester=$this->Akademika_model->get_sks_semester($mhs->nim,$ta->kd_tahun_ajaran);
                //$data[$ta->kd_tahun_ajaran]=$rec_ips;
                $data[$ta->kd_tahun_ajaran]=$rec_sks_semester;
            }
            $rec_ipk=$this->Akademika_model->get_ipk_mhs($mhs->nim,$kd_tahun_ajaran2);
            $rec_jum_sks=$this->Akademika_model->get_jum_sks_mhs($mhs->nim,$kd_tahun_ajaran2);
           // $rec_ips=$this->get_ips($mhs->nim,$kd_tahun_ajaran);
            $data['nim']=$mhs->nim;
            $data['nm_mahasiswa']=$mhs->nm_mahasiswa;
            $data['angkatan']=$mhs->angkatan;
            $data['status']=$mhs->status;
             $data['nm_prodi']=$mhs->nm_prodi;
             $data['ukt']=$mhs->nilai_ukt;
            $data['ipk']=$rec_ipk;
            $data['jum_sks']=$rec_jum_sks;

            array_push($list,$data);
           
        }
            $keyprodi['kd_prodi'] = $kd_prodi;
            $prodi = $this->Prodi_model->get_row_selected('prodi', $keyprodi);
           
            $keyfak['kd_fak'] = $prodi->kd_fak;
            $fak = $this->Prodi_model->get_row_selected('fakultas', $keyfak);
            $data['nm_fak'] = $fak->nm_fak;
            $data['prodi']=$prodi;
            $data['angkatan']=$angkatan;
            
          //  echo json_encode($list);
        $data['list']=$list;
         $this->load->view('prodi/lap_rekap_krs_mhs', $data);
    }
    
    public function get_rekap_akademik_mhs()
    {
        $kd_prodi=$this->session->userdata('home_base');
        $angkatan=$this->input->post('angkatan',TRUE);
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $kd_tahun_ajaran2=$this->input->post('kd_tahun_ajaran2',TRUE);
        $data['ta_awal']=$kd_tahun_ajaran;
        $data['ta_akhir']=$kd_tahun_ajaran2;
        
        $list=array();
        $sql = "select nm_prodi,mahasiswa.nim as nim,nm_mahasiswa,mahasiswa.status,angkatan,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,nilai_ukt,semester,mahasiswa.status,awal_semester from mahasiswa,prodi where  mahasiswa.kd_prodi=prodi.kd_prodi and mahasiswa.kd_prodi='" . $kd_prodi . "' and angkatan='".$angkatan."'";
        $listmhs= $this->db->query($sql)->result();
        foreach($listmhs as $mhs)
        {
            $sql2="SELECT * FROM `thnajaran` where `kd_tahun_ajaran` >='".$kd_tahun_ajaran."' and kd_tahun_ajaran<='".$kd_tahun_ajaran2."' order by kd_tahun_ajaran asc";   
            $listta= $this->db->query($sql2)->result();
            $data['listta']=$listta;
            //echo json_encode($listta);
            $tax=0;
            foreach($listta as $ta)
            {
                $tax=$tax+1;;
                $rec_ips=$this->get_ips($mhs->nim,$ta->kd_tahun_ajaran);
                //$rec_sks_semester=$this->get_sks_semester($mhs->nim,$ta->kd_tahun_ajaran);
                $data[$ta->kd_tahun_ajaran]=$rec_ips;
                //$data[$ta->kd_tahun_ajaran]=$rec_sks_semester;
            }
            $rec_ipk=$this->Akademika_model->get_ipk_mhs($mhs->nim,$kd_tahun_ajaran2);
            $rec_jum_sks=$this->Akademika_model->get_jum_sks_mhs($mhs->nim,$kd_tahun_ajaran2);
           // $rec_ips=$this->get_ips($mhs->nim,$kd_tahun_ajaran);
            $data['nim']=$mhs->nim;
            $data['nm_mahasiswa']=$mhs->nm_mahasiswa;
            $data['angkatan']=$mhs->angkatan;
             $data['nm_prodi']=$mhs->nm_prodi;
             $data['ukt']=$mhs->nilai_ukt;
             $data['status']=$mhs->status;
             
            
            $data['ipk']=$rec_ipk;
            $data['jum_sks']=$rec_jum_sks;
            //$data['ips']=$rec_ips;
            array_push($list,$data);
           // echo $rec_ipk; 
            
        }
            $keyprodi['kd_prodi'] = $kd_prodi;
            $prodi = $this->Prodi_model->get_row_selected('prodi', $keyprodi);
           
            $keyfak['kd_fak'] = $prodi->kd_fak;
            $fak = $this->Prodi_model->get_row_selected('fakultas', $keyfak);
            $data['nm_fak'] = $fak->nm_fak;
            $data['prodi']=$prodi;
            $data['angkatan']=$angkatan;
            
          //  echo json_encode($list);
        $data['list']=$list;
         $this->load->view('prodi/lap_rekap_akademik', $data);
    }
    
    
    public function get_ipk_mhs($nim,$kd_ta) {
       
       $sql = "SELECT  `rencanastudih`.`nim`, Sum(`rencanastudid`.`sks`) as jum_sks,Sum(`rencanastudid`.`sks` *  mnilai.nilai_a) / Sum(`rencanastudid`.`sks`) AS `ipk`
        FROM `rencanastudid`, `rencanastudih`,mnilai where `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs` and  rencanastudid.nilai=mnilai.nilai_h  and kd_tahun_ajaran<=$kd_ta and nim='".$nim."' GROUP BY `rencanastudih`.`nim` ";
         $output = $this->db->query($sql)->row();
        if(!$output)
        {
            $hasil=0;
            
        }else
        {
            $hasil=$output->ipk;
        }
       return($hasil);
      
    }
    
    
    
    

    private function get_krsd($no_krs) {
        $sql = "SELECT
  `rencanastudid`.`no_krs`, `rencanastudid`.`kd_jadwal`,rencanastudid.status,
  `rencanastudid`.`aktif`, `matakuliah`.`nm_mtk`, `matakuliah`.`sks`,
  `matakuliah`.`semester_ke`, `matakuliah`.`kd_kurikulum`,
  `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kd_dosen`, `jadwal`.`kelas`,
  `dosen`.`NIDN`, `dosen`.`nm_dosen`, `jadwal`.`hari`, `jadwal`.`jam`,
  `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`, `jadwal`.`kd_mtk`
FROM
  `rencanastudid` INNER JOIN
  `jadwal` ON `rencanastudid`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN
  `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen` INNER JOIN
  `matakuliah` ON `jadwal`.`kd_mtk` = `matakuliah`.`kd_mtk`
WHERE
  `rencanastudid`.`no_krs` = '" . $no_krs . "'";

        $output = $this->db->query($sql)->result();
        return $output;

// echo json_encode($output);
    }



    private function get_krsh($no_krs, $nim) {

        $sql = "SELECT
  `rencanastudih`.`nim`, `rencanastudih`.`ips_sebelumnya` AS `ips`,rencanastudih.status,
  `rencanastudih`.`no_krs`, `rencanastudih`.`semester_ke`,
  `rencanastudih`.`maks_sks`, `rencanastudih`.`nim`, `rencanastudih`.`tgl_krs`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`,
  `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`setujui_pa`,
  `prodi`.`nm_prodi`,prodi.ka_prodi
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
    function get_mahasiswax()
    {
        // $keynim['nim']=$nim;
        $home_base=$this->session->userdata('home_base');
        $key['nim']=$this->input->post('nim',TRUE);
        $key['kd_prodi']=$home_base;
        
        $hasil=$this->Akademika_model->get_row_selected('mahasiswa',$key);
        
        
        echo json_encode($hasil);
    }
    function get_jum_kelas_terisi()
    {
        //$kd_jadwal='JK0121360';
       $kd_jadwal=$this->input->post('jadwal',TRUE);
        $sql="select kd_jadwal as kd_jadwal,COUNT(kd_jadwal) as jumlah from rencanastudid WHERE kd_jadwal='".$kd_jadwal."' ";
       $hasil = $this->db->query($sql)->row();
       echo json_encode($hasil);
    }
    private function get_all_krs($kd_prodi, $ta) {
        $sql = "SELECT dosen.nm_dosen,`rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`, `rencanastudih`.`nim`, `rencanastudih`.`setujui_pa`, `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`kd_prodi`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `rencanastudih`.`semester_ke`, `rencanastudih`.`ips_sebelumnya`, `rencanastudih`.`maks_sks`, `rencanastudih`.`tot_sks` FROM `rencanastudih` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` inner join pad on pad.nim=mahasiswa.nim inner join pah on pah.no_pa=pad.no_pa inner join dosen on dosen.kd_dosen=pah.kd_dosen WHERE `rencanastudih`.`kd_prodi` = '" . $kd_prodi . "' and  `rencanastudih`.`kd_tahun_ajaran`='" . $ta . "' order by setujui_pa desc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
    }

    private function get_list_jadwal($kd_prodi,$kd_ta) {
        $sql = "SELECT
  `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_mtk`,jadwal.status,
  `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `jadwal`.`kelas`, `jadwal`.`hari`,
  `jadwal`.`jam`, `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`,kutota_jadwal.jumlah as terisi,
  `jadwal`.`kd_prodi`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`
FROM
  `jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` left JOIN kutota_jadwal ON kutota_jadwal.kd_jadwal=jadwal.kd_jadwal
WHERE
  `jadwal`.`kd_prodi` = '" . $kd_prodi . "' and `jadwal`.`kd_tahun_ajaran` = '" . $kd_ta . "' order by semester,nm_mtk,kelas asc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        //echo json_encode($hasil);
    }

    public function createNoPA($kd_prodi) {
        $q = $this->db->query("select MAX(RIGHT(no_pa,4)) as kd_max from pah");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'PA' . $kd_prodi . $kd;
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
    
    public function createNoJK($kd_prodi,$kd_tahun_ajaran) {
        $q = $this->db->query("select MAX(RIGHT(kd_jadwal,4)) as kd_max from jadwal where kd_prodi='".$kd_prodi."' and kd_tahun_ajaran='".$kd_tahun_ajaran."'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'JK' . $kd_prodi . $kd_tahun_ajaran.$kd;
    }

//modul skripsi
function form_koreksi($no_daftar)

{
    echo "buat manual dulu ya";    
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

//modul pembimbing skripsi
public function list_pembimbing_skripsi($no_daftar)
{
    
    $sql="SELECT no_daftar,pembimbing_ke,pembimbing,nm_dosen,nidn,jafung FROM `pembimbing_skripsi`,dosen where pembimbing_skripsi.pembimbing=dosen.kd_dosen and no_daftar='".$no_daftar."'";

      $data['list'] = $this->db->query($sql)->result();
     
     $this->template->load($this->view, 'prodi/list_pembimbing_skripsi', $data);
}
//modul ujian


public function jadwal_ujian()
{
     $homebase=$this->session->userdata('home_base');
    $sql1="select * from daftar,jenis_ujian_prodi where jenis_ujian_prodi.urutan=daftar.urutan and status='1' and daftar.kd_prodi='".$homebase."' ";
      $data = $this->db->query($sql1)->result();
      $jadwal=array();
      foreach($data as $row)
      {
          $sql2="select nm_dosen as pembimbing  from pembimbing_skripsi,dosen where no_daftar='".$row->no_daftar_judul."' and pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_ke='1'";
            $pembimbing = $this->db->query($sql2)->row();
             $sqlpembimbing2="select nm_dosen as pembimbing  from pembimbing_skripsi,dosen where no_daftar='".$row->no_daftar_judul."' and pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_ke='2'";
            $pembimbing2 = $this->db->query($sqlpembimbing2)->row();
         $sqlpenguji1="select nm_dosen as penguji  from penguji,dosen where no_daftar='".$row->no_daftar."' and penguji.penguji=dosen.kd_dosen and penguji_ke='1'";
            $penguji1 = $this->db->query($sqlpenguji1)->row();
             $sqlpenguji2="select nm_dosen as penguji  from penguji,dosen where no_daftar='".$row->no_daftar."' and penguji.penguji=dosen.kd_dosen and penguji_ke='2'";
            $penguji2 = $this->db->query($sqlpenguji2)->row();
            $sqlpenguji3="select nm_dosen  as penguji from penguji,dosen where no_daftar='".$row->no_daftar."' and penguji.penguji=dosen.kd_dosen and penguji_ke='3'";
            $penguji3 = $this->db->query($sqlpenguji3)->row();
        
           
          $datax['tgl_ujian']=date('d F Y', strtotime($row->tgl_ujian));
          $datax['jenis_ujian']=$row->jenis_ujian;
          $datax['no_daftar']=$row->no_daftar;
          $datax['nim']=$row->nim;
          $datax['judul']=$row->judul;
           $datax['pembimbing1']=$pembimbing->pembimbing;
         $datax['pembimbing2']=$pembimbing2->pembimbing;
         $datax['penguji1']=$penguji1->penguji;
           $datax['penguji1']=$penguji1->penguji;
         $datax['penguji2']=$penguji2->penguji;
               $datax['penguji3']=$penguji3->penguji;  
          array_push($jadwal,$datax);
      }
     //return $jadwal;
      echo json_encode ($jadwal);
      
}
function delete_daftar_ujian($no_daftar)
{
    $key['no_daftar']=$no_daftar;
    $this->Prodi_model->delete_data('penguji',$key);
    $this->Prodi_model->delete_data('daftar',$key);
    
    redirect(base_url() . 'prodi/list_ujian');
    
}
function list_ujian($status)
{
    $kd_prodi=$this->session->userdata('home_base');
    $sql="SELECT daftar.no_daftar,tgl_daftar,tgl_ujian,jam,no_daftar_judul,nm_mahasiswa,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,daftar.nim,judul,jenis_ujian,daftar.status from daftar,mahasiswa,jenis_ujian_prodi where daftar.nim=mahasiswa.nim and daftar.urutan=jenis_ujian_prodi.urutan and mahasiswa.kd_prodi=jenis_ujian_prodi.kd_prodi and  daftar.status='".$status."' and daftar.kd_prodi='".$kd_prodi."' order by tgl_ujian,jam asc";
      
     $data['list'] = $this->db->query($sql)->result();
     $data['list2'] = $this->Prodi_model->get_all('status_ujian');
     $this->template->load($this->view, 'prodi/list_ujian', $data);
}

function daftar_ujian()
{
     $kd_prodi=$this->session->userdata('home_base');
     $data['aksi'] = 'input';
     $data['kd_dosen1'] = "";
      $data['nim'] = "";
       $data['kd_dosen2'] = "";
        $data['judul'] = "";
    $data['no_daftar'] = "";
    $data['tgl_daftar'] =date('Y-m-d');
     $data['jam_ujian'] ='';
      $data['ruang_ujian'] ='';
    
    
    $keyprodi['kd_prodi']=$kd_prodi;
    
    $data['jenis_ujian']=$this->Prodi_model->get_list_selected('jenis_ujian_prodi',$keyprodi);
    $data['dosen']=$this->Prodi_model->get_list_selected('dosen',$keyprodi);
    $data['kd_dosen_pembimbing1'] = "";
    $data['kd_dosen_pembimbing2'] = "";
    $this->template->load($this->view, 'prodi/daftar_ujian', $data);
}

//modul daftar judul 

function hapus_usulan($no_daftar)
{
    $key['no_daftar']=$no_daftar;
     $this->Akademika_model->delete_data('pembimbing_skripsi',$key);
    $this->Akademika_model->delete_data('daftar_judul',$key);
     $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p>Usulan judul telah dihapus.</p>
                    </div>');
     redirect(base_url() . 'prodi/list_daftar_judul');
    
}
function list_daftar_judul()
{
    $kd_prodi=$this->session->userdata('home_base');
    $sql="SELECT no_daftar,tgl_daftar,kd_tahun_ajaran,daftar_judul.nim,nm_mahasiswa,angkatan,judul,daftar_judul.status FROM daftar_judul,mahasiswa WHERE daftar_judul.nim=mahasiswa.nim AND daftar_judul.kd_prodi='".$kd_prodi."' order by kd_tahun_ajaran,no_daftar asc";
    
     $data['list'] = $this->db->query($sql)->result();
     $this->template->load($this->view, 'prodi/list_usulan_judul', $data);
}


 function get_data_pendaftar_judul()
{
   $no_daftar=$this->input->post('no_daftar',TRUE);
   $hasil=$this->get_data_judul($no_daftar);
   $data['nim']=$hasil->nim;
   $data['nm_mahasiswa']=$hasil->nm_mahasiswa;
   $data['angkatan']=$hasil->angkatan;
   $data['judul']=$hasil->judul;
   
   $hasil2=$this->get_data_pembimbing($no_daftar);
   foreach($hasil2 as $row)
   {
       if($row->pembimbing_ke==1)
       {
           $data['kd_dosen_pembimbing1']=$row->pembimbing;
           $data['nm_dosen_pembimbing1']=$row->nm_dosen;
            $data['jafung_pembimbing1']=$row->jafung;
       }
       if($row->pembimbing_ke==2)
       {
           $data['kd_dosen_pembimbing2']=$row->pembimbing;
           $data['nm_dosen_pembimbing2']=$row->nm_dosen;
            $data['jafung_pembimbing2']=$row->jafung;
       }
       
   }
   echo json_encode($data);
    
}
 function get_data_judul($no_daftar)
{
    //$no_daftar=$this->input->post('no_daftar',TRUE);
    $sql="select daftar_judul.no_daftar,daftar_judul.nim,nm_mahasiswa,angkatan,judul from daftar_judul,mahasiswa where daftar_judul.nim=mahasiswa.nim and daftar_judul.no_daftar='".$no_daftar."'";
   $hasil = $this->db->query($sql)->row();
      return $hasil;
   
     // echo json_encode($hasil);
}

function get_data_pembimbing($no_daftar)
{
     $sql2="SELECT pembimbing_skripsi.no_daftar,pembimbing_skripsi.pembimbing_ke,pembimbing_skripsi.pembimbing,dosen.nm_dosen,dosen.jafung from pembimbing_skripsi,dosen where pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_skripsi.no_daftar='".$no_daftar."'";
     $hasil=$this->db->query($sql2)->result();
     // echo json_encode($hasil);
      return $hasil;
}

function fdaftar_judul()
{
    $homebase=$this->session->userdata('home_base');
    $data['aksi']='input';
     $data['no_daftar']='';
    $data['kd_dosen1']='';
    $data['kd_dosen2']='';
     $data['nm_dosen1']='';
     $data['nm_dosen2']='';
      $data['jafung1']='';
      $data['jafung2']='';
     $data['nim']='';
      $data['tgl_daftar']=date('Y-m-d');
    $keydosen['kd_prodi']=$homebase;
    $data['dosen']=$this->Prodi_model->get_list_selected('dosen',$keydosen);
   
    $data['judul']="";
    $this->template->load($this->view, 'prodi/daftar_judul', $data);
    
}
function aps()
{
     $homebase=$this->session->userdata('home_base');
       $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
    $aksi=$this->input->post('aksi',true);
    $hdata['nim']=$this->input->post('nim',true);
	$hdata['judul']=$this->input->post('judul',true);
	$hdata['deskripsi']=$this->input->post('desk',true);
	$hdata['topik']='';
	$hdata['kd_tahun_ajaran']=$kd_tahun_ajaran;
	$hdata['kd_prodi']=$homebase;
    $hdata['status']='Judul_Diterima';
    $hdata['tgl_daftar']=$this->input->post('tgl_daftar',true);
    $data1['pembimbing_ke']=1;
    $data1['pembimbing']=$this->input->post('kd_dosen',true);
   // $key3['no_daftar']=$this->input->post('no_daftar',true);
    
    $data2['pembimbing_ke']=2;
    $data2['pembimbing']=$this->input->post('kd_dosen2',true);

    if($aksi=="input")
    {
        $no=$this->nousuljudul();
         //simpan judul
        $hdata['no_daftar']=$no;
    	$data1['no_daftar']=$no;
        $data2['no_daftar']=$no;
        $this->Prodi_model->save_data('daftar_judul',$hdata);
        $this->Prodi_model->save_data('pembimbing_skripsi',$data1);
        $this->Prodi_model->save_data('pembimbing_skripsi',$data2);
    }else
    {
        $keyhdata['no_daftar']=$this->input->post('no_daftar',true);
        $keydata1['no_daftar']=$this->input->post('no_daftar',true);
        $keydata1['pembimbing_ke']=1;
        $keydata2['no_daftar']=$this->input->post('no_daftar',true);
        $keydata2['pembimbing_ke']=2;
        
        $data1['no_daftar']=$this->input->post('no_daftar',true);
        $data1['no_daftar']=$this->input->post('no_daftar',true);
        $data2['no_daftar']=$this->input->post('no_daftar',true);
        $this->Prodi_model->update_data('daftar_judul',$hdata,$keyhdata);
        $this->Prodi_model->update_data('pembimbing_skripsi',$data1,$keydata1);
        $this->Prodi_model->update_data('pembimbing_skripsi',$data2,$keydata2);
    }
     
   
       
        //$this->Prodi_model->hapus_data('daftar_judul',$data3,$key3);

    //echo "berhasil";
    redirect(base_url() . 'prodi/list_daftar_judul');
    
}

public function nousuljudul(){
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
//echo $inisial.$home_base.$kd_tahun_ajaran.$kd;

	}
	public function nodaftar_ujian(){
	
		$tabel="daftar";
		$home_base=$this->session->userdata('home_base');
			$inisial='U';
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
//echo $inisial.$home_base.$kd_tahun_ajaran.$kd;

	}
	
	function fnilai_ujian($no_daftar)
	{
	     $sql="select daftar.no_daftar_judul,daftar.nim,no_daftar,tgl_daftar,tgl_ujian,jam,ruang,judul,nm_mahasiswa,angkatan,urutan from daftar,mahasiswa where daftar.nim=mahasiswa.nim and daftar.no_daftar='".$no_daftar."'";
         $data['pendaftar']=$this->db->query($sql)->row();
	   
	      $sql="select * from tnilai where tnilai.kd_nilai='D'";
                $data['lnilai'] = $this->db->query($sql)->result();
	     $this->template->load($this->view, 'prodi/fnilai_hasil_ujian', $data);
	}
	function unilai_ujian()
	{
	    $no_daftar=$this->input->post('no_daftar',true);
	    $key['no_daftar']=$no_daftar;
        $hdata['nilai']=$this->input->post('nilai',true);
        $hdata['lulus']=$this->input->post('lulus',true);
        $hdata['status']='2';
        $this->Prodi_model->update_data('daftar',$hdata,$key);
        
        $key['no_daftar']=$no_daftar;
        $ujian=$this->Prodi_model->get_row_selected('daftar',$key);
        $key_daftar_judul['no_daftar']=$ujian->no_daftar_judul;
        if($ujian->urutan=='1')
        {
            $udata['status']='Hasil';
        }elseif($ujian->urutan=='2')
        {
             $udata['status']='Skripsi';
        }elseif($ujian->urutan=='0')
        {
            $udata['status']='Proposal';
        }
        
        $this->Prodi_model->update_data('daftar_judul',$udata,$key_daftar_judul);
        
        $jns_ujian=$ujian->urutan;
        if($jns_ujian==0)
        {
            redirect(base_url() . 'prodi/list_ujian/0');
        }elseif($jns_ujian==1)
        {
            redirect(base_url() . 'prodi/list_ujian/1');
        }
        elseif($jns_ujian==2)
        {
             redirect(base_url() . 'prodi/list_ujian/2');
        }
         
	}
	function adaftar_ujian()
{
    
    $aksi=$this->input->post('aksi',true);
    $no_daftar=$this->input->post('no_daftar',true);
    $key_daftar['no_daftar']=$no_daftar;
    $no=$this->nodaftar_ujian();
    $homebase=$this->session->userdata('home_base');
    $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
    $hdata['tgl_daftar']=$this->input->post('tgl_daftar',true);
    $hdata['no_daftar_judul']=$this->input->post('no_daftar_judul',true);
    $hdata['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $hdata['kd_prodi']=$homebase;
    $hdata['nim']=$this->input->post('nim',true);
    $hdata['judul']=$this->input->post('judul',true);
    $hdata['status']='1';
    $hdata['link_draft']='-';
	$hdata['urutan']=$this->input->post('jenis_ujian',true);
    $hdata['nilai']=0;
    $hdata['tgl_ujian']=$this->input->post('tgl_ujian',true);
    $hdata['jam']=$this->input->post('jam_ujian',true);
    $hdata['ruang']=$this->input->post('ruang_ujian',true);
    //simpan penguji
   
    $data1['penguji_ke']=1;
    $data2['penguji_ke']=2;
    $data3['penguji_ke']=3;
    $data1['penguji']=$this->input->post('kd_dosen1',true);
    $data2['penguji']=$this->input->post('kd_dosen2',true);
    $data3['penguji']=$this->input->post('kd_dosen3',true);
    if($aksi=="input"){
    $hdata['no_daftar']=$no;
    $data1['no_daftar']=$no;
    $data2['no_daftar']=$no;
    $data3['no_daftar']=$no;
     
    $this->Prodi_model->save_data('daftar',$hdata);
    $this->Prodi_model->save_data('penguji',$data1);
    $this->Prodi_model->save_data('penguji',$data2);
    $this->Prodi_model->save_data('penguji',$data3);
        
    }else
    {
    $data1['no_daftar']=$no_daftar;
    $data2['no_daftar']=$no_daftar;
    $data3['no_daftar']=$no_daftar;
    $hdata['nilai']=$this->input->post('nilai',true);
    $hdata['lulus']=$this->input->post('lulus',true);
    $this->Prodi_model->update_data('daftar',$hdata,$key_daftar);
    $keypenguji1['no_daftar']=$no_daftar;
    $keypenguji1['penguji_ke']=1;
    //$keypenguji1['penguji']=$this->input->post('kd_dosen1',true);
    
    $keypenguji2['no_daftar']=$no_daftar;
    $keypenguji2['penguji_ke']=2;
   // $keypenguji2['penguji']=$this->input->post('kd_dosen2',true);;
    
    $keypenguji3['no_daftar']=$no_daftar;
    $keypenguji3['penguji_ke']=3;
  //  $keypenguji3['penguji']=$this->input->post('kd_dosen3',true);;
    
    $cekpenguji1=$this->Prodi_model->get_row_selected('penguji',$keypenguji1);
     $cekpenguji2=$this->Prodi_model->get_row_selected('penguji',$keypenguji2);
      $cekpenguji3=$this->Prodi_model->get_row_selected('penguji',$keypenguji3);
    if(!empty($cekpenguji1))
    {
         $this->Prodi_model->update_data('penguji',$data1,$keypenguji1);
    }else
    {
         $this->Prodi_model->save_data('penguji',$data1);
    }
     if(!empty($cekpenguji2))
    {
         $this->Prodi_model->update_data('penguji',$data2,$keypenguji2);
    }else
    {
         $this->Prodi_model->save_data('penguji',$data2);
    }
     if(!empty($cekpenguji3))
    {
         $this->Prodi_model->update_data('penguji',$data3,$keypenguji3);
    }else
    {
         $this->Prodi_model->save_data('penguji',$data3);
    }
   
   
    
        
    }
     $key['no_daftar']=$no_daftar;
        $ujian=$this->Prodi_model->get_row_selected('daftar',$key);
        $jns_ujian=$ujian->urutan;
        if($jns_ujian=0)
        {
            redirect(base_url() . 'prodi/list_ujian/0');
        }elseif($jns_ujian=1)
        {
            redirect(base_url() . 'prodi/list_ujian/1');
        }
        elseif($jns_ujian=2)
        {
             redirect(base_url() . 'prodi/list_ujian/2');
        }
    
}

function fedaftar_ujian($no_daftar)
{
    $homebase=$this->session->userdata('home_base');
    $keyprodi['kd_prodi']=$homebase;
    $data['aksi']="edit";
   
    $sql="select daftar.no_daftar_judul,daftar.nim,no_daftar,tgl_daftar,tgl_ujian,jam,ruang,judul,nm_mahasiswa,angkatan,urutan from daftar,mahasiswa where daftar.nim=mahasiswa.nim and daftar.no_daftar='".$no_daftar."'";
    $pendaftar=$this->db->query($sql)->row();
    $sql2="select no_daftar,penguji,penguji_ke,nm_dosen,jafung from penguji,dosen where penguji.penguji=dosen.kd_dosen and penguji.no_daftar='".$no_daftar."'";
     $data['dosen']=$this->Prodi_model->get_list_selected('dosen',$keyprodi);
    $no_daftar_judul=$pendaftar->no_daftar_judul;
    $sql3="select no_daftar,pembimbing,nm_dosen,jafung,pembimbing_ke from pembimbing_skripsi,dosen where pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_skripsi.no_daftar='".$no_daftar_judul."'";
    $pembimbing=$this->db->query($sql3)->result();
    $penguji=$this->db->query($sql2)->result();
    //$keydosen['kd_prodi']=$homebase;
   // $data['dosen']=$this->Prodi_model->get_list_selected('dosen',$keydosen);
   
    
    foreach($pembimbing as $row)
   {
       if($row->pembimbing_ke==1)
       {
           $data['kd_dosen_pembimbing1']=$row->pembimbing;
           $data['nm_dosen_pembimbing1']=$row->nm_dosen;
            $data['jafung_pembimbing1']=$row->jafung;
       }
       if($row->pembimbing_ke==2)
       {
           $data['kd_dosen_pembimbing2']=$row->pembimbing;
           $data['nm_dosen_pembimbing2']=$row->nm_dosen;
            $data['jafung_pembimbing2']=$row->jafung;
       }
       
   }
   if(!empty($penguji))
   {
   foreach($penguji as $row2)
   {
       if($row2->penguji_ke==1)
       {
           $data['kd_dosen_penguji1']=$row2->penguji;
           $data['nm_dosen_penguji1']=$row2->nm_dosen;
            $data['jafung_penguji1']=$row2->jafung;
       }
       if($row2->penguji_ke==2)
       {
           $data['kd_dosen_penguji2']=$row2->penguji;
           $data['nm_dosen_penguj2']=$row2->nm_dosen;
            $data['jafung_penguji2']=$row2->jafung;
       }
       if($row2->penguji_ke==3)
       {
           $data['kd_dosen_penguji3']=$row2->penguji;
           $data['nm_dosen_penguji3']=$row2->nm_dosen;
            $data['jafung_penguji3']=$row2->jafung;
       }
       
   }}
   else
   {
           $data['kd_dosen_penguji3']='';
           $data['nm_dosen_penguji3']='';
            $data['jafung_penguji3']='';
              $data['kd_dosen_penguji2']='';
           $data['nm_dosen_penguj2']='';
            $data['jafung_penguji2']='';
              $data['kd_dosen_penguji1']='';
           $data['nm_dosen_penguji1']='';
            $data['jafung_penguji1']='';
       
   }
                $sql="select * from tnilai where tnilai.kd_nilai='D'";
                $data['lnilai'] = $this->db->query($sql)->result();
    $data['pendaftar']=$pendaftar;
    $data['penguji']=$penguji;
    $data['pembimbing']=$pembimbing;
    $data['aksi']='edit';
     $data['listjenis_ujian']=$this->Prodi_model->get_list_selected('jenis_ujian_prodi',$keyprodi);
     $this->template->load($this->view, 'prodi/edaftar_ujian', $data);
    
}
function lap_ujian_tgl()
{
    $sql="select distinct(tgl_ujian) from daftar order by tgl_ujian asc";
     $data['ltgl_ujian'] = $this->db->query($sql)->result();
      $this->template->load($this->view, 'laporan/lap_ujian_f', $data);
}
public function jadwal_ujianx()
{
    $tgl_ujian=$this->input->post('tgl_ujian',true);
    $sql1="select daftar.nim,daftar.judul,nm_mahasiswa,tgl_ujian,jam,no_daftar,jenis_ujian,no_daftar_judul,link_draft from daftar,jenis_ujian_prodi,mahasiswa where tgl_ujian='".$tgl_ujian."' and jenis_ujian_prodi.urutan=daftar.urutan and daftar.nim=mahasiswa.nim and daftar.status='1' order by tgl_ujian,jam asc ";
      $data = $this->db->query($sql1)->result();
      $jadwal=array();
      foreach($data as $row)
      {
          $sql2="select nm_dosen as pembimbing  from pembimbing_skripsi,dosen where no_daftar='".$row->no_daftar_judul."' and pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_ke='1'";
            $pembimbing = $this->db->query($sql2)->row();
             $sqlpembimbing2="select nm_dosen as pembimbing  from pembimbing_skripsi,dosen where no_daftar='".$row->no_daftar_judul."' and pembimbing_skripsi.pembimbing=dosen.kd_dosen and pembimbing_ke='2'";
            $pembimbing2 = $this->db->query($sqlpembimbing2)->row();
         $sqlpenguji1="select nm_dosen as penguji  from penguji,dosen where no_daftar='".$row->no_daftar."' and penguji.penguji=dosen.kd_dosen and penguji_ke='1'";
            $penguji1 = $this->db->query($sqlpenguji1)->row();
             $sqlpenguji2="select nm_dosen as penguji  from penguji,dosen where no_daftar='".$row->no_daftar."' and penguji.penguji=dosen.kd_dosen and penguji_ke='2'";
            $penguji2 = $this->db->query($sqlpenguji2)->row();
            $sqlpenguji3="select nm_dosen  as penguji from penguji,dosen where no_daftar='".$row->no_daftar."' and penguji.penguji=dosen.kd_dosen and penguji_ke='3'";
            $penguji3 = $this->db->query($sqlpenguji3)->row();
          $datax['tgl_ujian']=date('d F Y', strtotime($row->tgl_ujian));
          $datax['jenis_ujian']=$row->jenis_ujian;
          $datax['link_draft']=$row->link_draft;  
            $datax['jam']=$row->jam;
          $datax['no_daftar']=$row->no_daftar;
          $datax['nim']=$row->nim;
           $datax['nm_mahasiswa']=$row->nm_mahasiswa;
           
          $datax['judul']=$row->judul;
           $datax['pembimbing1']=$pembimbing->pembimbing;
         $datax['pembimbing2']=$pembimbing2->pembimbing;
         $datax['penguji1']=$penguji1->penguji;
           $datax['penguji1']=$penguji1->penguji;
         $datax['penguji2']=$penguji2->penguji;
               $datax['penguji3']=$penguji3->penguji;  
          array_push($jadwal,$datax);
      }
    // return $jadwal;
    $data['jadwalujianlengkap']=$jadwal;
        $this->template->load($this->view, 'laporan/lap_ujian_tgl_r', $data);
      
}
function edaftar_ujian($no_daftar)
{
    $no=$this->nodaftar_ujian();
    $homebase=$this->session->userdata('home_base');
    $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
    $hdata['no_daftar']=$no;
    $hdata['tgl_daftar']=$this->input->post('tgl_daftar',true);
    $hdata['no_daftar_judul']=$this->input->post('no_daftar_judul',true);
    $hdata['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $hdata['kd_prodi']=$homebase;
    $hdata['nim']=$this->input->post('nim',true);
    $hdata['judul']=$this->input->post('judul',true);
    $hdata['status']='0';
    $hdata['link_draft']='-';
	$hdata['urutan']=$this->input->post('jenis_ujian',true);
    $hdata['nilai']=0;
    $hdata['tgl_ujian']=$this->input->post('tgl_ujian',true);
    $hdata['jam_ujian']=$this->input->post('jam_ujian',true);
    $hdata['ruang_ujian']=$this->input->post('ruang_ujian',true);
    //simpan penguji
    $data1['no_daftar']=$no;
    $data2['no_daftar']=$no;
    $data3['no_daftar']=$no;
    $data1['penguji_ke']=1;
    $data2['penguji_ke']=2;
    $data3['penguji_ke']=3;
    $data1['penguji']=$this->input->post('kd_dosen1',true);
    $data2['penguji']=$this->input->post('kd_dosen2',true);
    $data3['penguji']=$this->input->post('kd_dosen3',true);

    $this->Prodi_model->save_data('daftar',$hdata);
    $this->Prodi_model->save_data('penguji',$data1);
    $this->Prodi_model->save_data('penguji',$data2);
    $this->Prodi_model->save_data('penguji',$data3);
    redirect(base_url() . 'Prodi/list_ujian');
    
}
public function list_penguji($no_daftar)
{
     $sql="select * from daftar,penguji,dosen where daftar.no_daftar=penguji.no_daftar and penguji.penguji=dosen.kd_dosen and daftar.no_daftar='".$no_daftar."'";
     $data['list']=$this->db->query($sql)->result();
     //$data=$this->db->query($sql)->result();
     //echo json_encode($data);
     $this->template->load($this->view, 'prodi/list_penguji', $data);

      
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
function reset_password($userid)
    {
       	
			//$data['userid']=$userid;
			$pass2='usn1234';
			$data['password']=md5($pass2.'usn1234');
			$key['userid']=$userid;
			$hasil2=$this->Prodi_model->update_data('user',$data,$key);
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
					 redirect(base_url().'prodi/lmhs');
			
			
		
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

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-27 03:48:53 */
/* http://harviacode.com */