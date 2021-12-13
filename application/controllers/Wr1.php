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
class Wr1 extends CI_Controller {
	public $view='template/templatewr1';
	
    public function _construct() {
	
	session_start();
    }

    function index() {
	$this->load->model('Akademika_model');
	$cek = $this->session->userdata('userid');

        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $data = array('data' => 'Bismillah',
                'hadist' => 'isbal');
            if($level=="wr1")
            {
                 $this->template->load($this->view, 'bismillah', $data);
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    function get_max_pertemuan($kd_jadwal)
    {
        $sql="SELECT MAX(`pertemuan_ke`) as pertemuan FROM `absensih` where `kd_jadwal`='".$kd_jadwal."'";
        $jadwal= $this->db->query($sql)->row();
        return $jadwal->pertemuan;
    }
    private function get_list_jadwal($kd_ta) {
        $sql = "SELECT prodi.nm_prodi,
  `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_mtk`,jadwal.status,
  `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `jadwal`.`kelas`, `jadwal`.`hari`,
  `jadwal`.`jam`, `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`,kutota_jadwal.jumlah as terisi,
  `jadwal`.`kd_prodi`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`,jadwal.link_virtual
FROM
  `jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` left JOIN kutota_jadwal ON kutota_jadwal.kd_jadwal=jadwal.kd_jadwal join prodi on jadwal.kd_prodi=prodi.kd_prodi
WHERE  `jadwal`.`kd_tahun_ajaran` = '" . $kd_ta . "' order by semester,nm_mtk,kelas asc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        //echo json_encode($hasil);
    }
    function list_jadwal_absensi()
    {
       	$this->load->model('Akademika_model');
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
       
       // $kriteria['kd_prodi']=$homebase;
        $filter['kd_tahun_ajaran']=$kd_tahun_ajaran;
        
        if ($level == "wr1") {
           
            $datax['data'] = $this->Akademika_model->get_list_selected('vrekap_jumlah_absensi',$filter);
           
            $this->template->load($this->view, 'wr1/list_jadwal', $datax);
           
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    function get_jadwal_detail($kd_jadwal)
    {
        	$this->load->model('Akademika_model');
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
     function view_permintaan_akses_nilai()
    {
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT prodi.nm_prodi, permintaan_akses_nilai.kd_jadwal,jadwal.kd_tahun_ajaran,permintaan_akses_nilai.penjelasan,permintaan_akses_nilai.tgl_usul,permintaan_akses_nilai.status,jadwal.kelas,dosen.nm_dosen,dosen.NIDN,matakuliah.nm_mtk,matakuliah.sks 
        FROM `permintaan_akses_nilai`,jadwal,matakuliah,dosen,prodi 
        where jadwal.kd_prodi=prodi.kd_prodi and permintaan_akses_nilai.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_dosen=dosen.kd_dosen and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and permintaan_akses_nilai.status<>'Usul' order by tgl_usul desc ";
         $hasil= $this->db->query($sql)->result();
        $data['list_permintaan']=$hasil;
         $this->template->load($this->view, 'wr1/list_permintaan_akses_nilai', $data);
        
    }
    public function rekap()
    {
        	$this->load->model('Akademika_model');
         $this->Akademika_model->rekap_status_mhs();
         
    }
    function dashboardusn()
    {
        $this->load->model('Akademika_model');
	$cek = $this->session->userdata('userid');
		$kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;

            if($level=="wr1" or $level=="rektor")
            {
                 $datax['tabulasi'] = $this->Akademika_model->rekap_mahasiswa_usn();
                 $datax['tabulasi2'] = $this->Akademika_model->rekap_mahasiswa_usn_aktif_ta($kd_tahun_ajaran);
                 $datax['tabulasi5'] = $this->Akademika_model->rekap_mahasiswa_usn_lulus();
                 $datax['tabulasi3'] = $this->Akademika_model->rekap_mahasiswa_usn_cuti_ta($kd_tahun_ajaran);
                 $datax['tabulasi4'] = $this->Akademika_model->rekap_mahasiswa_usn_tak_aktif_ta($kd_tahun_ajaran);
                 
                 
                 $this->template->load($this->view, 'template/dashboardusn', $datax);
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    
    function kkn()
    {
        $this->load->model('Akademika_model');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
         $homebase = $this->session->userdata('home_base');
         $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
         
         
         $data['list']=$this->Akademika_model->get_list_selected('vkkn_jumlah_prodi',$key);
         //echo json_encode($data);
          $this->template->load($this->view, 'wr1/list_kkn', $data);
        
    }

    

}

?>
