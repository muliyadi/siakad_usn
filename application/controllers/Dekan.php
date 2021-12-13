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
class Dekan extends CI_Controller {
	public $view='template/templatedekan';
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
        $this->load->library('table');
    }

    function index() {
		
		
	$cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
           
           $kd_fak = $this->session->userdata('home_base');
            $data['tabulasi'] = $this->Akademika_model->rekap_mahasiswa_fakultas($kd_fak);
            $data['tabulasi2'] = $this->Akademika_model->rekap_status_mhs_fakultas($kd_fak);
            
             $this->template->load($this->view, 'dekan/homedekan', $data);
        }
    }
    
    function kkn()
    {
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
         $homebase = $this->session->userdata('home_base');
         $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
         $key['kd_fak']=$homebase;
         
         $data['list']=$this->Akademika_model->get_list_selected('vkkn_jumlah_prodi',$key);
         //echo json_encode($data);
          $this->template->load($this->view, 'dekan/list_kkn', $data);
        
    }
    public function list_akses_nilai()
    {
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
         $homebase = $this->session->userdata('home_base');
         
         
        $sql="SELECT permintaan_akses_nilai.kd_jadwal,jadwal.kd_tahun_ajaran,permintaan_akses_nilai.penjelasan,permintaan_akses_nilai.tgl_usul,permintaan_akses_nilai.status,jadwal.kelas,dosen.nm_dosen,dosen.NIDN,matakuliah.nm_mtk,matakuliah.sks 
        FROM `permintaan_akses_nilai`,jadwal,matakuliah,dosen,prodi,fakultas 
        where jadwal.kd_prodi=prodi.kd_prodi and prodi.kd_fak=fakultas.kd_fak and prodi.kd_fak='".$homebase."' and permintaan_akses_nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and permintaan_akses_nilai.status<>'Usul' order by permintaan_akses_nilai.status desc ";
         $hasil= $this->db->query($sql)->result();
        $data['list_permintaan']=$hasil;
         $this->template->load($this->view, 'dekan/list_permintaan_akses_nilai', $data);
    }
    public function cek_tgl_batas_nilai()
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
        
        $cek = $this->session->userdata('userid');
        $key['kd_jadwal']=$kd_jadwal;
        $data['status']='Diterima Oleh Dekan';
        $data['setujui_3']=$cek;
        $data['tgl_setujui_3']=date("Y-m-d");
        $datax['status_nilai']='Terbuka';
        $this->Akademika_model->update_data('permintaan_akses_nilai',$data,$key);
         $this->Akademika_model->update_data('jadwal',$datax,$key);
          redirect('pddikti/view_permintaan_akses_nilai'); 
        
    }
    function tolak_permintaan_akses_nilai($kd_jadwal)
    {
        $key['kd_jadwal']=$kd_jadwal;
        $data['status']='Ditolak oleh Dekan';
        $data_jadwal['status']='Tertutup';
        
        $this->Akademika_model->update_data('permintaan_akses_nilai',$data,$key);
         $this->Akademika_model->update_data('jadwal',$data_jadwal,$key);
          redirect('pddikti/view_permintaan_akses_nilai'); 
        
    }
    //modul rekap krs
    public function form_rekap_krs_mhs()
    {   $this->load->model('Akademika_model');
           
             $data['listta'] = $this->Akademika_model->get_all('thnajaran');
             $data['listangkatan'] = $this->Akademika_model->get_all_angkatan();
             
         $this->template->load($this->view, 'dekan/lap_rekap_krs_mhs_form', $data);
    }
    public function get_rekap_krs_mhs()
    {
        $this->load->model('Akademika_model');
        $kd_fak=$this->session->userdata('home_base');
        $angkatan=$this->input->post('angkatan',TRUE);
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $kd_tahun_ajaran2=$this->input->post('kd_tahun_ajaran2',TRUE);
        $data['ta_awal']=$kd_tahun_ajaran;
        $data['ta_akhir']=$kd_tahun_ajaran2;
        
        $list=array();
        $sql = "select nm_prodi,mahasiswa.nim as nim,nm_mahasiswa,angkatan,sekolah.nm_sekolah,kecamatan.nm_kecamatan,kabupaten.nm_kabupaten,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,nilai_ukt,semester,mahasiswa.status,awal_semester from mahasiswa right join sekolah on mahasiswa.npsn=sekolah.npsn,kecamatan,kabupaten,prodi where sekolah.kd_wilayah_kec=kecamatan.kd_kec and kecamatan.kd_kab=kabupaten.kd_kab and mahasiswa.kd_prodi=prodi.kd_prodi and prodi.kd_fak='" . $kd_fak . "' and angkatan='".$angkatan."' order by nm_kabupaten,nm_kecamatan,nm_sekolah,nm_mahasiswa asc";
        $listmhs= $this->db->query($sql)->result();
        foreach($listmhs as $mhs)
        {
            $sql2="SELECT * FROM `thnajaran` where `kd_tahun_ajaran` >='".$kd_tahun_ajaran."' and kd_tahun_ajaran<='".$kd_tahun_ajaran2."' order by kd_tahun_ajaran asc";   
            $listta= $this->db->query($sql2)->result();
            $data['listta']=$listta;
            //echo json_encode($listta);
            foreach($listta as $ta)
            {
                //$rec_ips=$this->get_ips($mhs->nim,$ta->kd_tahun_ajaran);
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
            $data['nm_sekolah']=$mhs->nm_sekolah;
             $data['nm_kecamatan']=$mhs->nm_kecamatan;
             $data['nm_kabupaten']=$mhs->nm_kabupaten;
            array_push($list,$data);
        }
            $keyfak['kd_fak'] = $kd_fak;
            $fak = $this->Akademika_model->get_row_selected('fakultas', $keyfak);
            $data['nm_fak'] = $fak->nm_fak;
           
            $data['angkatan']=$angkatan;
            
          //  echo json_encode($list);
        $data['list']=$list;
         $this->load->view('dekan/lap_rekap_krs_mhs', $data);
    }
    function data_mhs_fak()
{
    $this->load->model('Akademika_model');
    $kd_fak = $this->session->userdata('home_base');
    $keyfak['kd_fak']=$kd_fak;
    $data['list'] = $this->Akademika_model->get_status_mhs_fakultas($kd_fak);
     $data['fakultas']=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
     $this->template->load($this->view, 'dekan/data_mhs_fak', $data);
    
}
    
function laporan_status_mhs()
{
    $this->load->model('Akademika_model');
    $kd_fak = $this->session->userdata('home_base');
    $keyfak['kd_fak']=$kd_fak;
    $data['list'] = $this->Akademika_model->get_status_mhs_fakultas($kd_fak);
     $data['fakultas']=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
    $this->load->view('dekan/lap_status_mhs_fak', $data);
    
}
function laporan_rekap_reg_krs()
    {
        $this->load->model('Akademika_model');
		$this->load->model('Prodi_model');
		
        $homebase ='012';
        $status='L';
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        
            $keymhs['kd_prodi']=$homebase;
            $keymhs['status']=$status;
            $mhs=$this->get_mahasiswa_prodi_status($homebase,$status);
          
 
            $listmhs=array();
            foreach($mhs as $mhs)
            {
                 $keyregis['kd_tahun_ajaran']=$kd_tahun_ajaran;
                //$keyregis['home_base']=$homebase;
                 $keyregis['nim']=$mhs->nim;
                 $keyregis['jns_registrasi']='P03';
                 
                 $reg=$this->Akademika_model->get_row_selected('registrasi',$keyregis);
                 if($reg){
                     $spp='Ya';
                     //echo $reg->noreg;
               }else{
                     $spp='Tidak';
                 }
                 
                  $keykrs['nim']=$mhs->nim;
                  //$keykrs['kd_prodi']=$homebase;
                  $keykrs['kd_tahun_ajaran']=$kd_tahun_ajaran;
                  $krs=$this->Prodi_model->get_row_selected('rencanastudih',$keykrs);
                 if($krs){
                     $krsh='Ya';
                 }else{
                     $krsh='Tidak';
                 }
                 
                 $mahasiswa['dosen_pa']=$mhs->nm_dosen;
                 
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
            $hasil['ta']=$kd_tahun_ajaran;
            $keyfak['kd_fak']=$this->session->userdata('home_base');
            $hasil['fakultas']=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
           $this->load->view('laporan/lap_akm_fak', $hasil);
            
 
    }
    
  public function get_mahasiswa_prodi_status($kd_prodi,$status)
    {
         $sql = "select dosen.nm_dosen,mahasiswa.nim as nim,nm_mahasiswa,angkatan,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,nilai_ukt,semester,mahasiswa.status,mahasiswa.kd_prodi from mahasiswa,pah,pad,dosen where  pah.kd_dosen=dosen.kd_dosen and pad.nim=mahasiswa.nim and pad.no_pa=pah.no_pa and mahasiswa.kd_prodi='". $kd_prodi . "' and mahasiswa.status<>'".$status."'";
        
        return $this->db->query($sql)->result();
          //echo json_encode($hasil)  ;    
    }    

}

?>
