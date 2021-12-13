<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pjm extends CI_Controller
{
    public $view='template/templatepjm';
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
 
    }

    public function index()
    {
        $level = $this->session->userdata('level');
		if($level=="admin_pjm"){
			$hasil=$this->Akademika_model->get_all('edom_jawaban');
			$data['list_edom_jawaban']=$hasil;
            $this->template->load($this->view, 'template/homepjm', $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
            }
	}
	
	public function fedom()
    {
        $level = $this->session->userdata('level');
		if($level=="admin_pjm"){
		     $data['listta']=$this->Akademika_model->get_all('thnajaran');
		     $this->template->load($this->view, 'pjm/edom/edom_ta_f', $data);
           
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
            }
	}
	public function list_edom_soal()
	{
	     $level = $this->session->userdata('level');
		if($level=="admin_pjm"){
		     $data['list_edom_soal']=$this->Akademika_model->get_all('vedom_soal');
		     $this->template->load($this->view, 'pjm/edom/list_edom_soal', $data);
           
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
            }
	}
	public function update_edom_soal()
	{
	    $key['nosoal']=$this->input->post('nosoal');
	    $data['nosoal']=$this->input->post('nosoal');
	    $data['pertanyaan']=$this->input->post('pertanyaan');
	    $data['kd_kategori']=$this->input->post('kd_kategori');
	     $data['aktif']='Y';
	    
	    $cek=$this->Akademika_model->update_data('edom_soal',$data,$key);
	    if($cek)
	    {
	         $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Data berhasil diubah....!!!</p>
					</div>');
	    }else
	    {
	        $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Data gagal diubah....!!!</p>
					</div>');
	    }
	    $this->list_edom_soal();
	}
	public function delete_edom_soal($nosoal)
	{
	    $key['nosoal']=$nosoal;
	    $cek=$this->Akademika_model->delete_data('edom_soal',$key);
	    if($cek)
	    {
	         $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <h4>Informasi...!</h4><p> Data berhasil dihapus....!!!</p>
					</div>');
	    }else
	    {
	         $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Data gagal dihapus...!!!</p>
					</div>');
	    }
	    $this->list_edom_soal();
	}
	public function aktif_edom_soal($nosoal)
	{
	    $key['nosoal']=$nosoal;
	    $data['aktif']='Y';
	    $cek=$this->Akademika_model->update_data('edom_soal',$data,$key);
	    if($cek)
	    {
	        $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <h4>Informasi...!</h4><p> Data berhasil diaktifkan...!!!</p>
					</div>');
	    }else
	    {
	         $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Data gagal diaktifkan...!!!</p>
					</div>');
	    }
	    $this->list_edom_soal();
	}
	public function nonaktif_edom_soal($nosoal)
	{
	    $key['nosoal']=$nosoal;
	    $data['aktif']='T';
	    $cek=$this->Akademika_model->update_data('edom_soal',$data,$key);
	    if($cek)
	    {
	        $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <h4>Informasi...!</h4><p> Data berhasil dinonaktifkan...!!!</p>
					</div>');
	    }else
	    {
	         $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Data gagal dinonaktifkan...!!!</p>
					</div>');
	    }
	    $this->list_edom_soal();
	}
	public function edit_edom_soal($nosoal)
	{
	    $key['nosoal']=$nosoal;
	    $cek=$this->Akademika_model->get_row_selected('edom_soal',$key);
	    $data['nosoal']=$cek->nosoal;
	    $data['pertanyaan']=$cek->pertanyaan;
	    $data['kd_kategori']=$cek->kd_kategori;
	    $data['aktif']=$cek->aktif;
	    $data['list_kategori']=$this->Akademika_model->get_all('edom_kategori');
	    
	     $this->template->load($this->view, 'pjm/edom/edom_soal_f', $data);
	    
	}
	
	public function edom()
    {
        $level = $this->session->userdata('level');
         $kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran');
         $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
		if($level=="admin_pjm"){
			$hasil=$this->Akademika_model->get_list_selected('vedom_jawaban2',$key);
			$data['list']=$hasil;
			$data['file']='edom_'.$kd_tahun_ajaran;
            $this->load->view('pjm/edom/edom_ta_excel', $data);
        }else{
            $this->session->sess_destroy();
            redirect(base_url());
            }
	}
	
	//modul absensi
	function get_max_pertemuan($kd_jadwal)
    {
        $sql="SELECT MAX(`pertemuan_ke`) as pertemuan FROM `absensih` where `kd_jadwal`='".$kd_jadwal."'";
        $jadwal= $this->db->query($sql)->row();
        return $jadwal->pertemuan;
    }
    
    function list_jadwal_absensi()
    {
        $list=array();
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
         $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
       // $homebase = $this->session->userdata('home_base');
        //$kriteria['kd_prodi']=$homebase;
        $kriteria['kd_tahun_ajaran']=$kd_tahun_ajaran;
        
        if ($level == "admin_pjm") {
            $jadwal=$this->get_list_jadwal($kd_tahun_ajaran);
            $lstjadwal['data'] = $this->get_list_jadwal($kd_tahun_ajaran);
            foreach($jadwal as $row)
            {
                
                    $data['kd_jadwal']=$row->kd_jadwal;
                    $data['kd_prodi']=$row->kd_prodi;
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
$data['max_pertemuan']=$this->get_max_pertemuan($row->kd_jadwal);
$data['link_virtual']=$row->link_virtual;
$data['group_wa']=$row->group_wa;

               
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
            $this->template->load($this->view, 'pjm/absensi/list_jadwal_kuliah', $datax);
           
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
    private function get_list_jadwal($kd_ta) {
        $sql = "SELECT
  `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_mtk`,jadwal.status,
  `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `jadwal`.`kelas`, `jadwal`.`hari`,
  `jadwal`.`jam`, `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`,kutota_jadwal.jumlah as terisi,
  `jadwal`.`kd_prodi`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`,jadwal.link_virtual,group_wa
FROM
  `jadwal` INNER JOIN
  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` left JOIN kutota_jadwal ON kutota_jadwal.kd_jadwal=jadwal.kd_jadwal
WHERE
  `jadwal`.`kd_tahun_ajaran` = '" . $kd_ta . "' order by jadwal.kd_prodi,semester,nm_mtk,kelas asc";
        $hasil = $this->db->query($sql)->result();
        return ($hasil);
        //echo json_encode($hasil);
    }

    

}

