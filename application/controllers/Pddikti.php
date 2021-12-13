<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pddikti extends CI_Controller
{
    public $view='template/templatebak';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
       
    }

    public function index()
    {
       // $dosen = $this->Dosen_model->get_all();
        $cek = $this->session->userdata('userid');
       // $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            if($level=="pddikti")
            {
               $this->template->load($this->view, 'template/homepddikti', $data);

            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }

    }
    //modul 
    function view_permintaan_akses_nilai()
    {
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT permintaan_akses_nilai.kd_jadwal,jadwal.kd_tahun_ajaran,permintaan_akses_nilai.penjelasan,permintaan_akses_nilai.tgl_usul,permintaan_akses_nilai.status,jadwal.kelas,dosen.nm_dosen,dosen.NIDN,matakuliah.nm_mtk,matakuliah.sks 
        FROM `permintaan_akses_nilai`,jadwal,matakuliah,dosen 
        where permintaan_akses_nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and permintaan_akses_nilai.status<>'Usul' order by permintaan_akses_nilai.status desc ";
         $hasil= $this->db->query($sql)->result();
        $data['list_permintaan']=$hasil;
         $this->template->load($this->view, 'pddikti/list_permintaan_akses_nilai', $data);
        
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
        $batas=$this->cek_tgl_batas_nilai();
        
        $cek = $this->session->userdata('userid');
        $key['kd_jadwal']=$kd_jadwal;
        $data['status']='Diterima oleh PDDIKTI';
        $data['setujui_2']=$cek;
        $data['tgl_setujui_2']=date("Y-m-d");
        $datax['status_nilai']='Terbuka';
        $this->Akademika_model->update_data('permintaan_akses_nilai',$data,$key);
         $this->Akademika_model->update_data('jadwal',$datax,$key);
          redirect('pddikti/view_permintaan_akses_nilai'); 
        
    }
    function tolak_permintaan_akses_nilai($kd_jadwal)
    {
        $key['kd_jadwal']=$kd_jadwal;
        $data['status']='Ditolak oleh PDDIKTI';
        $data_jadwal['status']='Tertutup';
        
        $this->Akademika_model->update_data('permintaan_akses_nilai',$data,$key);
         $this->Akademika_model->update_data('jadwal',$data_jadwal,$key);
          redirect('pddikti/view_permintaan_akses_nilai'); 
        
    }
    //modul matakuliah
    function fmatakuliah()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
           $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $this->template->load($this->view, 'pddikti/matakuliah_prodi_f', $data);
        }
    }
    public function matakuliah_prodi()
    {
        $kd_prodi=$this->input->post('kd_prodi',true);
        $sql="SELECT RIGHT(matakuliah.kd_mtk,length(matakuliah.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,nm_mtk,matakuliah.id_jns_mtk,matakuliah.sks_teori,matakuliah.sks_praktikum_lab,matakuliah.sks_praktikum_lapangan,matakuliah.sks_simulasi,tgl_mulai,tg_berakhir,semester_ke FROM `matakuliah`,kurikulum WHERE matakuliah.kd_kurikulum=kurikulum.kd_kurikulum and matakuliah.kd_prodi='".$kd_prodi."' order by matakuliah.kd_kurikulum,semester_ke,kd_mtk ASC";
         //$this->db->query($sql1)->result(); 
         $data['list'] = $this->db->query($sql)->result(); 
         $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='Matakuliah_'.$prodi->nm_prodi;
         $this->load->view('pddikti/lap_matakuliah_prodi_excel.php',$data);
    }
    //modul export mahasiswa
    public function fmahasiswa()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
          // $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listangkatan']=$this->Akademika_model->get_all('angkatan');
           $this->template->load($this->view, 'pddikti/mahasiswa_prodi_angkatan_f', $data);
        }
    }
     public function mahasiswa_prodi_angkatan()
    {
        $angkatan=$this->input->post('angkatan',true);
        //$kd_prodi=$this->input->post('kd_prodi',true);
        $sql="SELECT kd_prodi_forlap,nim,nm_mahasiswa,tempat_lahir,tgl_lahir,jns_kelamin,NIK,agama,nisn,jalur_masuk,npwp,kewarganegaraan,jns_pendaftaran, tgl_masuk_kuliah,awal_semester,jalan,rt,rw,dusun,kelurahan,id_wilayah_kec,kodepos,kd_jenis_tinggal,id_transportasi,telp_rumah,no_hp,email,terima_kps,no_kps,nik_ayah,nm_ayah,tgl_lahir_ayah,pend_ayah,pekerjaan_ayah,penghasilan_ayah,nik_ibu,nm_ibu,tgl_lahir_ibu,pend_ibu,pekerjaan_ibu,penghasilan_ibu,nama_wali,tgl_lahir_wali,pend_wali,pekerjaan_wali,penghasilan_wali,jns_pembiayaan FROM `mahasiswa`,prodi WHERE angkatan='".$angkatan."' and mahasiswa.kd_prodi=prodi.kd_prodi ";
         //$this->db->query($sql1)->result(); 
         $data['list'] = $this->db->query($sql)->result(); 
         //$keyprodi['kd_prodi']=$kd_prodi;
        // $prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='MAHASISWA_'.$angkatan;
         $this->load->view('pddikti/lap_mahasiswa_prodi_angkatan_excel.php',$data);
    }
    //modul export PA
    public function fpa()
    {
        
         $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
          $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listta']=$this->Akademika_model->get_all('thnajaran');
           $this->template->load($this->view, 'pddikti/fpa', $data);
        }
        
    }
    public function pa()
    {
        $kd_prodi=$this->input->post('kd_prodi');
        $data['ta']=$this->input->post('kd_tahun_ajaran');
        $sql="select mahasiswa.nm_mahasiswa,dosen.nm_dosen,dosen.NIDN,pad.nim,prodi.kd_prodi_forlap from pah,pad,dosen,mahasiswa,prodi where pah.no_pa=pad.no_pa and pah.kd_dosen=dosen.kd_dosen and pad.nim=mahasiswa.nim and pah.kd_prodi=prodi.kd_prodi and pah.kd_prodi='".$kd_prodi."'";
         $data['list'] = $this->db->query($sql)->result();
          $data['file']='LAP_PA';
          $this->load->view('pddikti/lap_pa.php',$data);
         
    }
    
    //modul export ajarkelas
    public function fajar()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
           $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listta']=$this->Akademika_model->get_all('thnajaran');
           $this->template->load($this->view, 'pddikti/ajar_prodi_ta_f', $data);
        }
    }
    public function ajar_prodi_ta()
    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true);
        //$kd_prodi=$this->input->post('kd_prodi',true);
        $sql="SELECT jadwal.kd_tahun_ajaran,dosen.NIDN,dosen.nm_dosen,RIGHT(matakuliah.kd_mtk,length(matakuliah.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,jadwal.kelas,nm_mtk,matakuliah.sks from jadwal,dosen,matakuliah where jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."'";
         //$this->db->query($sql1)->result(); 
         $data['list'] = $this->db->query($sql)->result(); 
         //$keyprodi['kd_prodi']=$kd_prodi;
         //$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='AJAR_'.$kd_tahun_ajaran;
         $this->load->view('pddikti/lap_ajar_prodi_excel.php',$data);
    }
    
    //modul export nilai
    public function fnilai()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
           $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listta']=$this->Akademika_model->get_all('thnajaran');
           $this->template->load($this->view, 'pddikti/nilai_prodi_ta_f', $data);
        }
    }
    public function nilai_prodi_ta()
    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true);
        $kd_prodi=$this->input->post('kd_prodi',true);
        if($kd_prodi=="all")
        {
            $sql="SELECT kd_prodi_forlap,rencanastudih.nim,mahasiswa.nm_mahasiswa,rencanastudih.kd_tahun_ajaran, RIGHT(matakuliah.kd_mtk,length(matakuliah.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,matakuliah.nm_mtk,jadwal.kelas,rencanastudid.nilai,nilai_a,rencanastudid.nilai_angka FROM rencanastudih,rencanastudid,mahasiswa,jadwal,matakuliah,mnilai,prodi where rencanastudih.kd_prodi=prodi.kd_prodi and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudih.nim=mahasiswa.nim and rencanastudid.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_mtk=matakuliah.kd_mtk  and rencanastudih.kd_tahun_ajaran='".$kd_tahun_ajaran."' and rencanastudid.nilai=mnilai.nilai_h";
          $data['list'] = $this->db->query($sql)->result(); 
        
         
         $data['file']='NILAI_'.$kd_tahun_ajaran;
         $this->load->view('pddikti/lap_nilai_prodi_excel.php',$data);
        }
        if($kd_prodi=='003' or ($kd_prodi=='012' and $kd_tahun_ajaran<='20171'))
        {
              $sql="SELECT kd_prodi_forlap,rencanastudih.nim,mahasiswa.nm_mahasiswa,rencanastudih.kd_tahun_ajaran, RIGHT(matakuliah.kd_mtk,length(matakuliah.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,matakuliah.nm_mtk,rencanastudid.nilai,nilai_a,nilai_angka FROM rencanastudih,rencanastudid,mahasiswa,matakuliah,mnilai,prodi where rencanastudih.kd_prodi=prodi.kd_prodi and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudih.nim=mahasiswa.nim and rencanastudid.kd_mtk=matakuliah.kd_mtk and rencanastudih.kd_prodi='".$kd_prodi."' and rencanastudih.kd_tahun_ajaran='".$kd_tahun_ajaran."' and rencanastudid.nilai=mnilai.nilai_h";
         $data['list'] = $this->db->query($sql)->result(); 
         $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='NILAI_'.$kd_tahun_ajaran.'_'.$prodi->nm_prodi;
         $this->load->view('pddikti/lap_nilai_prodi_siakad_excel.php',$data);
        }else
        {
            $sql="SELECT kd_prodi_forlap,rencanastudih.nim,mahasiswa.nm_mahasiswa,rencanastudih.kd_tahun_ajaran, RIGHT(matakuliah.kd_mtk,length(matakuliah.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,matakuliah.nm_mtk,jadwal.kelas,rencanastudid.nilai,nilai_a,nilai_angka FROM rencanastudih,rencanastudid,mahasiswa,jadwal,matakuliah,mnilai,prodi where rencanastudih.kd_prodi=prodi.kd_prodi and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudih.nim=mahasiswa.nim and rencanastudid.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_mtk=matakuliah.kd_mtk and rencanastudih.kd_prodi='".$kd_prodi."' and rencanastudih.kd_tahun_ajaran='".$kd_tahun_ajaran."' and rencanastudid.nilai=mnilai.nilai_h";
          $data['list'] = $this->db->query($sql)->result(); 
         $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='NILAI_'.$kd_tahun_ajaran;
         $this->load->view('pddikti/lap_nilai_prodi_excel.php',$data);
        }
        //$sql1="set @no=0";
       // //$this->db->query($sql1)->result(); 
    }
    //MODUL EXPORT krs
    public function fkrs()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
          // $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listta']=$this->Akademika_model->get_all('thnajaran');
           $this->template->load($this->view, 'pddikti/krs_prodi_ta_f', $data);
        }
    }
    public function krs_prodi_ta()
    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true);
       // $kd_prodi=$this->input->post('kd_prodi',true);
        
        //$sql1="set @no=0";
        $sql="SELECT rencanastudih.nim,mahasiswa.nm_mahasiswa,rencanastudih.kd_tahun_ajaran, RIGHT(matakuliah.kd_mtk,length(matakuliah.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,matakuliah.nm_mtk,jadwal.kelas FROM rencanastudih,rencanastudid,mahasiswa,jadwal,matakuliah where rencanastudih.no_krs=rencanastudid.no_krs and rencanastudih.nim=mahasiswa.nim and rencanastudid.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_mtk=matakuliah.kd_mtk  and rencanastudih.kd_tahun_ajaran='".$kd_tahun_ajaran."'";
         //$this->db->query($sql1)->result(); 
         $data['list'] = $this->db->query($sql)->result(); 
        /* $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='KRS_'.$kd_tahun_ajaran.'_'.$prodi->nm_prodi;*/
         $data['file']='KRS_'.$kd_tahun_ajaran;
         $this->load->view('pddikti/lap_krs_prodi_excel.php',$data);
    }
    //modul export kelas
    public function fkelas()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
           //$data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listta']=$this->Akademika_model->get_all('thnajaran');
           $this->template->load($this->view, 'pddikti/kelas_prodi_ta_f', $data);
        }
    }
    public function kelas_prodi_ta()
    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true);
       // $kd_prodi=$this->input->post('kd_prodi',true);
        //$sql1="set @no=0";
        $sql2="SELECT jadwal.kd_tahun_ajaran as semester,RIGHT(jadwal.kd_mtk,length(jadwal.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,nm_mtk,jadwal.kelas as kelas,bahasan,thnajaran.tgl_mulai,thnajaran.tgl_selesai FROM `jadwal`,matakuliah,kurikulum,thnajaran WHERE jadwal.kd_mtk=matakuliah.kd_mtk and matakuliah.kd_kurikulum=kurikulum.kd_kurikulum  and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal.kd_tahun_ajaran=thnajaran.kd_tahun_ajaran";
         //$this->db->query($sql1)->result(); 
         $data['list'] = $this->db->query($sql2)->result(); 
        /* $keyprodi['kd_prodi']=$kd_prodi;
         $prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
         $data['file']='Kelas_'.$kd_tahun_ajaran.'_'.$prodi->nm_prodi;*/
         $data['file']='Kelas_'.$kd_tahun_ajaran;
         $this->load->view('pddikti/lap_kelas_prodi_excel.php',$data);
    }
    //data akm
    public function fakam()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
           $data['listprodi']=$this->Akademika_model->get_all('prodi');
           $data['listta']=$this->Akademika_model->get_all('thnajaran');
           $data['listangaktan']=$this->Akademika_model->get_all('thnajaran');
           
           $this->template->load($this->view, 'pddikti/lap_akm_prodi_ta_f', $data);
        }
    }
    public function akmprodita()
    {
        $cek = $this->session->userdata('userid');
         if (empty($cek)) {
            redirect(base_url());
        } else {
           $kd_prodi=$this->input->post('kd_prodi',true); 
           $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',true); 
           $angkatan=$this->input->post('angkatan',true); 
           $data['ta']=$kd_tahun_ajaran;
           $data['listakam']=$this->Akademika_model->get_akm_prodi($kd_prodi,$angkatan,$kd_tahun_ajaran);
           
           $this->template->load($this->view, 'pddikti/lap_akm_prodi_ta_r', $data);
        }
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

