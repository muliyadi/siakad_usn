<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Created by Abd.Salam bin Muliyadi
 *

 */
class Laporan extends CI_Controller {
    private $templatenya;
    private  $view='template/templatebak';
    function __construct() {
        parent::__construct();
        $this->load->helper('help1_helper');
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
        $this->load->library('table');
        
        
    }
    
    function index() {
        $this->cek_login();
    }
    function cek_login(){
        $cek = $this->session->userdata('logged_in');
        if (empty($cek)) {
            
            //$this->template->load('template/templateutama', 'login', $data);
             $this->load->view('login');
        } else {
            $st = $this->session->userdata('userid');
            $data['userid']=$st;
            $row = $this->Akademika_model->get_row_selected('user',$data);

            $level=$row->level;
            $data = array('data' => $row->userid,
                'hadist' => 'isbal');
            if ($level == 'mahasiswa') {
                $this->view='template/templatemhs';
               //redirect(base_url().'mahasiswa');
            } elseif ($level == "bak") {
                $this->view='template/templatebak';
                //redirect(base_url().'bak');
            } elseif ($level == "dosen") {
                $this->view='template/templatedosen';
                // redirect(base_url().'dosen');
            }elseif($level=="admin")
            {
                $this->view='template/templateadmin';
                //redirect(base_url().'admin');
            }
            elseif($level=="prodi")
            {
                $this->view='template/templateprodi';
                 //redirect(base_url().'prodi');
            }
            
            else
            {
                 $this->load->view('login');
            }
        }
    }

function ftranskrip_nilai()
    {
       
        $this->cek_login();
        $data='';
        $this->template->load($this->view, 'laporan/ftranskrip_nilai', $data);
        
    }
    public function transkrip_nilai()
    {
          $nim = $this->input->post('nim');
          $ta_awal = $this->input->post('ta_awal');
          $ta_akhir = $this->input->post('ta_akhir');

           $this->get_transkrip($nim,$ta_awal,$ta_akhir);
           
          
    }
    public function get_transkrip($nim,$ta_awal,$ta_akhir)
    {
        $data['nim']=$nim;
        $data['ta_awal']=$ta_awal;
        $data['ta_akhir']=$ta_akhir;
        
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
                $data['level_prodi']=$prodi->level_prodi;
                $data['nip_dekan']=$fak->nip_dekan;
                $data['nidn_prodi']=$prodi->nidn;
                $data['nip_wd1']=$fak->nip_wd1;
         $data['transkrip'] = $this->Akademika_model->get_transkrip_nilai_ta($nim,$ta_awal,$ta_akhir);
        $this->load->view('laporan/transkrip_nilai', $data);
    }
    function frkhs()
    {
        $cek = $this->session->userdata('userid');
       // cek_login($cek);
        $data='';
        $this->template->load($this->view, 'laporan/frkhs', $data);
        
    }
    function rkhs() {
        $nim = $this->input->post('nim', true);
        $kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran', true);
       
        $data['hkhs'] = '';
        $data['dkhs'] = '';
        $key['nim']=$nim;
        $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
    $data2= $this->Akademika_model->get_row_selected('rencanastudih',$key);
     $homebase = $data2->kd_prodi;
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
       // $text= $this->output->get_output();

/* contoh text */  
    
/* tulis dan buka koneksi ke printer, sesuaikan dengan printer di komputer anda */    
//$printer = printer_open("Microsoft Print to PDF");  
/* write the text to the print job */  
//printer_write($printer, $text);   
/* close the connection */ 
//printer_close($printer);

        
        } else {
            echo 'maaf hasil studi anda pada tahun_ajaran ini belum ada...';
        }
    }
    function lap3()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;

            if($level=="bak")
            {
                
                $this->templatenya='template/templatebak';
               
            }elseif ($level=="wr1") {
               $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        $this->template->load($this->templatenya,'laporan/lap3f');
    }
    function plap3()
    {
        $filter=$this->input->post('filter',TRUE);
        $nfilter=$this->input->post('nfilter',TRUE);
        $angkatan=$this->input->post('angkatan',true);
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $datax['angkatan']=$angkatan;
        $datax['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $datax['list']='';

        if($filter=='fakultas')
        {
            $hasil=$this->get_lap3_fak($nfilter,$angkatan,$kd_tahun_ajaran);
            if($hasil)
            {

                $datax['list']=$hasil;
            }
            else
            {
                echo "tahun ajaran atau data tidak ada";
            }
        }elseif($filter=='all')
        {
            $hasil=$this->get_lap3_all($angkatan,$kd_tahun_ajaran);
            if($hasil)
            {

                $datax['list']=$hasil;
            }
            else
            {
                echo "tahun ajaran atau data tidak ada";
            }
        }else{
            $hasil=$this->get_lap3_prodi($nfilter,$angkatan,$kd_tahun_ajaran);
            if($hasil)
            {
                $datax['list']=$hasil;
            }
            else
            {
                echo "tahun ajaran atau data tidak ada";
            }
            
        }

      $this->load->view('laporan/lap3r',$datax);

    }

    

    //1. LAPORAN JUMLAH MAHASIWA REGISTRASI / SEMESTER
    function lap1()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
           $datax['data']='';
           $datax['listjns_registrasi']=$this->Akademika_model->get_all('mjenis_registrasi');
           $datax['listthnajaran']=$this->Akademika_model->get_all('thnajaran');
           
            if($level=="bak")
            {
                $this->templatenya='template/templatebak';
               
            }
            elseif ($level=='wr1') {
                $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
         $this->template->load($this->templatenya,'laporan/lap1f',$datax);

    }

    //1.p
    function plap1()
    {
        $datax['rekapregistrasi']='';
        $filter=$this->input->post('filter',TRUE);
        $nfilter=$this->input->post('nfilter',TRUE);
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $jns_registrasi=$this->input->post('kd_registrasi',TRUE);
        //$hasil=$this->get_rregistrasi_fak_ta($kd_tahun_ajaran,$jns_registrasi);
       $datax['jml_mhs_prodi']=$this->get_jumlah_aktif_prodi();
            $hasil=$this->get_rregistrasi($kd_tahun_ajaran,$jns_registrasi);
            if($hasil)
            {
                $datax['ta']=$kd_tahun_ajaran;
                $datax['rekapregistrasi']=$hasil;
            }
            else
            {
                echo "data tidak ada";
            }
        
        $key['kd_registrasi']=$jns_registrasi;
        $hasil3=$this->Akademika_model->get_row_selected('mjenis_registrasi',$key);
        $datax['jns_registrasi']=$hasil3->nm_registrasi;
        $this->load->view('laporan/lap1r',$datax);
    }
    function plap21()
    {
          $datax['list']='';
        $filter=$this->input->post('filter',TRUE);
        $nfilter=$this->input->post('nfilter',TRUE);
        if($filter=='fakultas')
        {
            $hasil=$this->get_rata_ipk_fak($nfilter);
            if($hasil)
            {
                $datax['list']=$hasil;
            }
            else
            {
                echo "data tidak ada";
            }
        }elseif($filter=='all')
        {
            $hasil=$this->get_rata_ipk_all();
            if($hasil)
            {
                $datax['list']=$hasil;
            }
            else
            {
                echo "data tidak ada";
            }
        }else{
            $hasil=$this->get_rata_ipk_prodi($nfilter);
            if($hasil)
            {

                $datax['list']=$hasil;
            }
            else
            {
                echo "data tidak ada";
            }
            
        }
        $this->load->view('laporan/lap21r',$datax);
    }

    //1.g
     function get_rregistrasi($kd_tahun_ajaran,$jns_registrasi)
    {
        $sql="select mahasiswa.kd_prodi,nm_prodi,angkatan,count(registrasi.nim)as jumlah from registrasi,prodi,mahasiswa,fakultas where mahasiswa.nim=registrasi.nim and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."' and mahasiswa.kd_prodi=prodi.kd_prodi  and prodi.kd_fak=fakultas.kd_fak and jns_registrasi='".$jns_registrasi."' group by mahasiswa.kd_prodi,angkatan order by mahasiswa.kd_prodi,angkatan asc ";

        $Output=$this->db->query($sql)->result();
       // echo json_encode($Output);
	 return $Output;
    }
    public function get_jumlah_aktif_prodi()
    {
       $sql= "select mahasiswa.kd_prodi,angkatan,count(*) as jumlah from mahasiswa where status not in('L','D') group by mahasiswa.kd_prodi,angkatan ";
        $Output=$this->db->query($sql)->result();
    //   echo json_encode($Output);
	 return $Output;
    }
    //1.g2
    
    //11.g1
   

    //4.1
    private function get_lap4()
    {
        $sql="SELECT  `rencanastudih`.`nim`, Avg(`rencanastudih`.`ips_sebelumnya`) AS `ipk`,
        `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`, `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`semester`FROM  `rencanastudih` INNER JOIN
        `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` WHERE  `rencanastudih`.`semester_ke` > 1 GROUP BY  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`nim`, `mahasiswa`.`semester`";
        $Output=$this->db->query($sql)->result();
        return $Output;
    }
    //4.2
    function lap4()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $datax['data']='';
            if($level=="bak")
            {
                $this->templatenya='template/templatebak';
               
            }elseif ($level=="wr1") {
               $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        $this->template->load($this->templatenya,'laporan/lap4f',$datax);
    }
    function lap51()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $datax['data']='';
            if($level=="bak")
            {
                $this->templatenya='template/templatebak';
               
            }elseif ($level=="wr1") {
               $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        $this->template->load($this->templatenya,'laporan/lap51f',$datax);
    }
     function lap52()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $datax['data']='';
            if($level=="bak")
            {
                $this->templatenya='template/templatebak';
               
            }elseif ($level=="wr1") {
               $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        $this->template->load($this->templatenya,'laporan/lap52f',$datax);
    }

    //4.2
    function plap4()
    {
        $datax['list']='';
        $filter=$this->input->post('filter',TRUE);
        $nfilter=$this->input->post('nfilter',TRUE);
        $nilai=$this->input->post('nilai',TRUE);
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
        $datax['nilai']=$nilai;
        if($filter=='fakultas')
        {
            $hasil=$this->get_lap4_fak($nfilter,$nilai);
            if($hasil){
                $datax['list']=$hasil;
                 $this->load->view('laporan/lap4r', $datax);
            }
            else{
                echo "data tidak ada";
            }
        }elseif($filter=='all')
        {
            $hasil=$this->get_lap4_all($nilai);
            if($hasil)
            {

                $datax['list']=$hasil;
                $this->load->view('laporan/lap4r', $datax);
            }
            else
            {
                echo "data tidak ada";
            }
        }else{
            $hasil=$this->get_lap4_prodi($nfilter,$nilai);
            if($hasil)
            {

                $datax['list']=$hasil;
                 $this->load->view('laporan/lap4r', $datax);
            }
            else
            {
                echo " data tidak ada";
            }
        }
        
    }
    function plap51()
    {
         $datax['list']='';

        $filter=$this->input->post('filter',TRUE);
        $nfilter=$this->input->post('nfilter',TRUE);
        $semester=$this->input->post('semester',TRUE);
        $datax['semester']=$semester;
        if($filter=='fakultas' && empty($nfilter)==false)
        {

            $hasil=$this->get_lap51_fak($nfilter,$semester);
            if($hasil){
                $datax['list']=$hasil;
                 
            }
            else{
                echo "data tidak ada";
            }
        }elseif($filter=='all')
        {
            $hasil=$this->get_lap51_all($semester);
            if($hasil)
            {

                $datax['list']=$hasil;

            }
            else
            {
                echo "data tidak ada";
            }
        }elseif(empty($nfilter)==false){
            $hasil=$this->get_lap51_prodi($nfilter,$semester);
            if($hasil)
            {

                $datax['list']=$hasil;
               
            }
            else
            {
                echo "tahun ajaran atau data tidak ada";
            }
        }
        $this->load->view('laporan/lap51r', $datax);
    }
    //5. 2
    function plap52()
    {
        $filter=$this->input->post('filter',TRUE);
        $nfilter=$this->input->post('nfilter',TRUE);
        $semester=$this->input->post('semester',TRUE);
        $datax['semester']=$semester;
        if($filter=='fakultas')
        {
            $hasil=$this->get_lap52_fak($nfilter,$semester);
            if($hasil){
                $datax['list']=$hasil;
                 $this->load->view('laporan/lap52r', $datax);
            }
            else{
                echo "tahun ajaran atau data tidak ada";
            }
        }elseif($filter=='all')
        {
            $hasil=$this->get_lap52_all($semester);
            if($hasil)
            {

                $datax['list']=$hasil;
                $this->load->view('laporan/lap52r', $datax);
            }
            else
            {
                echo "tahun ajaran atau data tidak ada";
            }
        }else{
            $hasil=$this->get_lap52_prodi($nfilter,$semester);
            if($hasil)
            {

                $datax['list']=$hasil;
                 $this->load->view('laporan/lap52r', $datax);
            }
            else
            {
                echo "tahun ajaran atau data tidak ada";
            }
        }
        
    }
    //1.2
    function lap12()
    {
        $cek = $this->session->userdata('userid');
        $datax['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
           $datax['data']='';
            if($level=="bak")
            {
                $this->templatenya='template/templatebak';
               
            }
            elseif ($level=='wr1') {
                $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
         $this->template->load($this->templatenya,'laporan/lap12f',$datax);
}

    //1.2
   function plap12()

    {
        $kd_tahun_ajaran=$this->input->post('kd_tahun_ajaran',TRUE);
         $datax['kd_tahun_ajaran']=$kd_tahun_ajaran;

         $ta=$this->Akademika_model->get_row_selected('thnajaran',$datax);
         $hasil=$this->get_lap12($kd_tahun_ajaran);
         if($ta && $hasil)
         {
            $datax['ta']=$ta->tahun_ajaran;
            $datax['semester']=$ta->semester;
         $datax['list'] =$hasil;
        
        $this->load->view('laporan/lap12r',$datax);
       
         }
         else
         {
            echo "tahun ajaran atau data tidak ada";
         }         
    }

    function lap21()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            $datax['data']='';
            if($level=="bak")
            {
                $this->templatenya='template/templatebak';
               
            }elseif ($level=="wr1") {
               $this->templatenya='template/templatewr1';
            }
            else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        $this->template->load($this->templatenya,'laporan/lap21f',$datax);
    }
    //1.2 get
    private function get_lap12($kd_tahun_ajaran)
    {
        $sql="SELECT prodi.kd_fak,prodi.nm_prodi,
  `mahasiswa`.`nim`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`,mahasiswa.kd_prodi,
  `mahasiswa`.`kd_ukm`, `ukm`.`jumlah`
FROM  `mahasiswa` LEFT JOIN  `ukm` ON `mahasiswa`.`kd_ukm` = `ukm`.`kd_ukm` join prodi on mahasiswa.kd_prodi=prodi.kd_prodi where mahasiswa.nim not in(select nim from registrasi where registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."') order by kd_fak,kd_prodi,angkatan,nim asc";

  $output=$this->db->query($sql)->result();
    return $output;
    // echo json_encode($output);

    }

    //2. get_rata_ipk
    private  function get_rata_ipk_all()
    {
        $sql="SELECT  `rencanastudih`.`kd_tahun_ajaran`,`rencanastudih`.`nim`, `round`(Avg(`rencanastudih`.`ips_sebelumnya`),2) AS `rataipk`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `prodi`.`status_akreditas`, `rencanastudih`.`kd_prodi`
        FROM `rencanastudih` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `rencanastudih`.`kd_prodi` GROUP BY
        `rencanastudih`.`kd_prodi`,`rencanastudih`.`kd_tahun_ajaran`";
        $Output=$this->db->query($sql)->result();
        return $Output;
    }
        //2. get_rata_ipk
    private function get_rata_ipk_fak($kd_fak)
    {
        $sql="SELECT  `rencanastudih`.`kd_tahun_ajaran`,`rencanastudih`.`nim`, `round`(Avg(`rencanastudih`.`ips_sebelumnya`),2) AS `rataipk`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `prodi`.`status_akreditas`, `rencanastudih`.`kd_prodi`
        FROM `rencanastudih` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `rencanastudih`.`kd_prodi`  where prodi.kd_fak='".$kd_fak."' GROUP BY
        `rencanastudih`.`kd_prodi`,`rencanastudih`.`kd_tahun_ajaran`";
        $Output=$this->db->query($sql)->result();
        return $Output;
    }
            //2. get_rata_ipk
    private function get_rata_ipk_prodi($kd_prodi)
    {
        $sql="SELECT  `rencanastudih`.`kd_tahun_ajaran`,`rencanastudih`.`nim`, `round`(Avg(`rencanastudih`.`ips_sebelumnya`),2) AS `rataipk`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `prodi`.`status_akreditas`, `rencanastudih`.`kd_prodi`
        FROM `rencanastudih` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `rencanastudih`.`kd_prodi` where rencanastudih.kd_prodi='".$kd_prodi."' GROUP BY
        `rencanastudih`.`kd_prodi`,`rencanastudih`.`kd_tahun_ajaran` ";
        $Output=$this->db->query($sql)->result();
        return $Output;
        // echo json_encode($Output);
    }
    //5.1 get_lap51_all
    private function get_lap51_all($semester)
    {
        $sql="SELECT
  `prodi`.`kd_fak`, `prodi`.`nm_prodi`, `mahasiswa`.`semester`, Count(`mahasiswa`.`nim`) AS `jumlah`, `prodi`.`kd_prodi` FROM  `mahasiswa`, `prodi` WHERE  `mahasiswa`.`kd_prodi` = `prodi`.`kd_prodi` GROUP BY
  `prodi`.`kd_prodi` HAVING  `mahasiswa`.`semester` = '".$semester."' ORDER BY  `mahasiswa`.`semester`, `prodi`.`kd_fak`, `prodi`.`kd_prodi`";
        $Output=$this->db->query($sql)->result();
        return $Output;
        // ECHO json_encode($Output);
    }
    //5.1 get_lap52_fak
   private function get_lap51_fak($kd_fak,$semester)
    {
        $sql="SELECT
  `prodi`.`kd_fak`, `prodi`.`nm_prodi`, `mahasiswa`.`semester`, Count(`mahasiswa`.`nim`) AS `jumlah`, `prodi`.`kd_prodi` FROM  `mahasiswa`, `prodi` WHERE  `mahasiswa`.`kd_prodi` = `prodi`.`kd_prodi` GROUP BY
  `prodi`.`kd_prodi` HAVING  `mahasiswa`.`semester` = '".$semester."' and prodi.kd_fak='".$kd_fak."' ORDER BY  `mahasiswa`.`semester`, `prodi`.`kd_fak`, `prodi`.`kd_prodi`";
        $Output=$this->db->query($sql)->result();
        // echo json_encode($Output);
        return $Output;
    }
     //5.2 get_lap52_prodi
    private function get_lap51_prodi($kd_prodi,$semester)
    {
        $sql="SELECT
  `prodi`.`kd_fak`, `prodi`.`nm_prodi`, `mahasiswa`.`semester`,mahasiswa.kd_prodi, Count(`mahasiswa`.`nim`) AS `jumlah`, `prodi`.`kd_prodi` FROM  `mahasiswa`, `prodi` WHERE  `mahasiswa`.`kd_prodi` = `prodi`.`kd_prodi` GROUP BY
  `prodi`.`kd_prodi` HAVING  `mahasiswa`.`semester` = '".$semester."' and mahasiswa.kd_prodi='".$kd_prodi."' ORDER BY  `mahasiswa`.`semester`, `prodi`.`kd_fak`, `prodi`.`kd_prodi`";
        $Output=$this->db->query($sql)->result();
        return $Output;
        // echo json_encode($Output);
    }

    //4.2
    private function get_lap4_all($nilai)
    {
        $sql="SELECT `rencanastudih`.`nim`, round(Avg(`rencanastudih`.`ips_sebelumnya`),2) AS `ipk`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`,
  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,
  `mahasiswa`.`semester` FROM `rencanastudih` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` WHERE  `rencanastudih`.`semester_ke` > 0 GROUP BY `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`nim`, `mahasiswa`.`semester` having ipk>='".$nilai."' order by ipk desc";
    $Output=$this->db->query($sql)->result();
    return $Output;
    // echo json_encode($Output);

    }
    //4.2
    private function get_lap4_fak($kd_fak,$nilai)
    {
         $sql="SELECT  `rencanastudih`.`nim`, round(Avg(`rencanastudih`.`ips_sebelumnya`),2) AS `ipk`,
        `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`,  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`semester` FROM `rencanastudih` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` WHERE  `rencanastudih`.`semester_ke` > 0 GROUP BY `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`nim`, `mahasiswa`.`semester` having ipk>='".$nilai."' and prodi.kd_fak='".$kd_fak."' order by ipk desc";
        $Output=$this->db->query($sql)->result();
        return $Output;
    }

    //4.2
    private function get_lap4_prodi($kd_prodi,$nilai)
    {
        $sql="SELECT  `rencanastudih`.`nim`, round(Avg(`rencanastudih`.`ips_sebelumnya`),2) AS `ipk`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`,  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`semester` FROM `rencanastudih` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` INNER JOIN  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` WHERE  `rencanastudih`.`semester_ke` > 0 GROUP BY `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,  `mahasiswa`.`nim`, `mahasiswa`.`semester` having ipk>='".$nilai."' and kd_prodi='".$kd_prodi."' order by ipk desc";
    $Output=$this->db->query($sql)->result();
    return $Output;
    }


//5. laporan mahasiswa semester 
private function get_lap52_prodi($kd_prodi,$semester)
{
    $sql="SELECT
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`,
  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,
  `mahasiswa`.`semester`, `mahasiswa`.`nim`, `fakultas`.`nm_fak`
FROM
  `mahasiswa` INNER JOIN
  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` INNER JOIN
  `fakultas` ON `fakultas`.`kd_fak` = `prodi`.`kd_fak` where prodi.kd_prodi='".$kd_prodi."' and semester='".$semester."'";
    $Output=$this->db->query($sql)->result();
    return $Output;

}
//5. laporan mahasiswa semester 
private function get_lap52_fak($kd_fak,$semester)
{
    $sql="SELECT
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`,
  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,
  `mahasiswa`.`semester`, `mahasiswa`.`nim`, `fakultas`.`nm_fak`
FROM
  `mahasiswa` INNER JOIN
  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` INNER JOIN
  `fakultas` ON `fakultas`.`kd_fak` = `prodi`.`kd_fak` where prodi.kd_fak='".$kd_fak."' and semester='".$semester."'";
    $Output=$this->db->query($sql)->result();
    return $Output;

}

//5. laporan mahasiswa semester    
private function get_lap52_all($semester)
{
    $sql="SELECT
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`jalur_masuk`,
  `mahasiswa`.`kd_prodi`, `prodi`.`nm_prodi`, `prodi`.`kd_fak`,
  `mahasiswa`.`semester`, `mahasiswa`.`nim`, `fakultas`.`nm_fak`
FROM
  `mahasiswa` INNER JOIN
  `prodi` ON `prodi`.`kd_prodi` = `mahasiswa`.`kd_prodi` INNER JOIN
  `fakultas` ON `fakultas`.`kd_fak` = `prodi`.`kd_fak` where semester='".$semester."'";
    $Output=$this->db->query($sql)->result();
    return $Output;

}

//3. lap rangking mahasiswa all
    private function get_lap3_all($angkatan,$kd_tahun_ajaran)
    {
        $sql="select rencanastudih.semester_ke,ips_sebelumnya,mahasiswa.nim,mahasiswa.nm_mahasiswa,angkatan,mahasiswa.kd_prodi,nm_prodi from rencanastudih,mahasiswa,prodi where rencanastudih.nim=mahasiswa.nim and mahasiswa.angkatan='" .$angkatan."' and rencanastudih.kd_tahun_ajaran='" .$kd_tahun_ajaran."' and mahasiswa.kd_prodi=prodi.kd_prodi order by ips_sebelumnya desc";
        $hasil=$this->db->query($sql)->result();
        // echo json_encode($hasil);
        return $hasil;
    }
    //3.lap rangkaing mahasiswa fakultas
    private function get_lap3_fak($kd_fak,$angkatan,$kd_tahun_ajaran)
    {
        $sql="select rencanastudih.semester_ke,ips_sebelumnya,mahasiswa.nim,mahasiswa.nm_mahasiswa,angkatan,mahasiswa.kd_prodi,nm_prodi from rencanastudih,mahasiswa,prodi where rencanastudih.nim=mahasiswa.nim and mahasiswa.angkatan='" .$angkatan."' and prodi.kd_fak='" .$kd_fak."' and rencanastudih.kd_tahun_ajaran='" .$kd_tahun_ajaran."' and mahasiswa.kd_prodi=prodi.kd_prodi order by ips_sebelumnya desc";
        $hasil=$this->db->query($sql)->result();
        // echo json_encode($hasil);
        return $hasil;
    }
    //3.lap rangkaing mahasiswa prodi
    private function get_lap3_prodi($kd_prodi,$angkatan,$kd_tahun_ajaran)
    {
        $sql="select rencanastudih.semester_ke,ips_sebelumnya,mahasiswa.nim,mahasiswa.nm_mahasiswa,angkatan,mahasiswa.kd_prodi,nm_prodi from rencanastudih,mahasiswa,prodi where rencanastudih.nim=mahasiswa.nim and mahasiswa.angkatan='" .$angkatan."' and mahasiswa.kd_prodi='" .$kd_prodi."' and rencanastudih.kd_tahun_ajaran='" .$kd_tahun_ajaran."' and mahasiswa.kd_prodi=prodi.kd_prodi order by ips_sebelumnya desc";
        $hasil=$this->db->query($sql)->result();
        // echo json_encode($hasil);
        return $hasil;
    }

    function lap_jum_mhs_prodi_aktif()
    {
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid']=$cek;
            $row = $this->Akademika_model->get_row_selected('user',$data);
            $level = $row->level;
            if($level=="bak")
            {
                $otabel['list']= $this->get_lap_jum_mhs_prodi_aktif();
                $this->template->load('template/templatebak', 'laporan/lap_jum_mhs_prodi_aktif', $otabel);
            }else
            {
                 $this->session->sess_destroy();
                redirect(base_url());
            }
        }
       

   }
    
    
    private function get_lap_jum_mhs_prodi_aktif()
    {
         $sql="select prodi.kd_fak,prodi.kd_prodi,nm_prodi,count(nim)as jumlah,status from mahasiswa,prodi,fakultas  where mahasiswa.kd_prodi=prodi.kd_prodi and prodi.kd_fak=fakultas.kd_fak and status='Aktif' group by kd_prodi";
         $hasil=$this->db->query($sql)->result();
         return $hasil;
    }
   function get_data()
   {
    $angkatan=$this->input->post('angkatan',true);
    // $angkatan='2013';
    $key['angkatan']=$angkatan;
    //$hasil=$this->Akademika_model->get_list_selected('mahasiswa',$key);
    //$hasil =$this->Akademika_model->get_list_selected_report('mahasiswa',$key);
        $sql="select * from mahasiswa where angkatan='".$angkatan."'";
        $hasil=$this->db->query($sql);
    $template = array(
        'table_open' => '<table  class="table table-striped table-hover">'
    );

$this->table->set_template($template);
    $this->table->set_heading('NIM', 'NAMA');


    $otabel['data']= $this->table->generate($hasil);
     $this->template->load($this->view, 'mahasiswa/home', $otabel);
   }

}
?>
