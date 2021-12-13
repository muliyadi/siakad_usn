<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public $view = 'template/templatedosen';

    function __construct() {
        parent::__construct();
        $this->load->model('Akademika_model');
        $this->load->library('form_validation');
         $this->foto_dosen_path = realpath(APPPATH . '../doc/foto/dosen/');
      // realpath(APPPATH . '../doc/rps/');
       // $this->foto_dosen_path = 'doc/foto/dosen';
        
        $this->foto_dosen_path_url = base_url() . 'doc/foto/dosen/';
    }

    public function index() {
        // $dosen = $this->Dosen_model->get_all();
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            $data = array('data' => 'Bismillah pak dosen',
                'hadist' => 'isbal');
            if ($level == "dosen") {
                //$this->template->load($this->view, 'bismillah', $data);
                //$this->pilihta();
                //$this->template->load($this->view, 'template/homedosen', $data);
                 redirect(base_url().'dosen/dashboard');
        
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    //modul kkn
    
    function get_kkn()
    {
        $cek = $this->session->userdata('userid');
        $level = $this->session->userdata('level');
        
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        if ($level=='dosen') {
            $keykkn['kd_dosen']=$cek;
           $list=$this->Akademika_model->get_list_selected('vkkn',$keykkn);
        } else {

            redirect(base_url());
        }
        echo json_encode($list);
    }
     function lmatakuliah() {
         
        $level=$this->session->userdata('level');
        $homebase = $this->session->userdata('home_base');
    if ($level == "dosen") {
        $keyta['kd_prodi'] = $homebase;
        $data['listmatakuliah'] = $this->Akademika_model->get_list_selected('matakuliah', $keyta);
        $this->template->load($this->view, 'dosen/lmatakuliah', $data);
        } else {
            $this->session->sess_destroy();
            redirect(base_url());
            }
    }
    public function quisioner()
    {
        $data['list']=$this->Akademika_model->get_all('quiosioner_pembelajaran_soal');
        $this->template->load($this->view, 'prodi/lkam', $data);
    }
    
    //modul akm
    public function monitoring_kam()
    {
        
        $homebase = $this->session->userdata('home_base');
        $userid = $this->session->userdata('userid');
        $level= $this->session->userdata('level');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        
        if($level=="dosen")
        {
            $keymhs['kd_prodi']=$homebase;
            $sql="select pad.nim,nm_mahasiswa,angkatan,no_hp,mahasiswa.status from pad,pah,mahasiswa where pad.no_pa=pah.no_pa and pad.nim=mahasiswa.nim and pah.kd_dosen='".$userid."' and mahasiswa.status<>'L' ";
             $mhs = $this->db->query($sql)->result(); 
             //echo json_encode($mhs);
           // $mhs=$this->Prodi_model->get_list_selected('mahasiswa',$keymhs);
          
 
            $listmhs=array();
            foreach($mhs as $mhs)
            {
                 $keyregis['kd_tahun_ajaran']=$kd_tahun_ajaran;
                  
                 $keyregis['nim']=$mhs->nim;
                 $reg=$this->Akademika_model->get_row_selected('registrasi',$keyregis);
                 if($reg){
                     $spp='Ya';
                     //echo $reg->noreg;
               }else{
                     $spp='Tidak';
                 }
                 
                  $keykrs['nim']=$mhs->nim;
                 
                  $keykrs['kd_tahun_ajaran']=$kd_tahun_ajaran;
                  $krs=$this->Akademika_model->get_row_selected('rencanastudih',$keykrs);
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
    //fungsi cek periode input nilai
    
    //fungsi cek periode input nilai remedi
    function editprofile()
    {
        
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
        $key['kd_dosen']=$cek;
        $data['dosen']=$this->Akademika_model->get_row_selected('dosen',$key);
        $data['listagama']=$this->Akademika_model->get_all('tagama');
        $data['listjafung']=$this->Akademika_model->get_all('tjafung');
        $this->template->load($this->view, 'dosen/fdosen', $data);
        }
    }
    function udosen()
    {
         $this->foto_dosen_path='doc/foto/dosen';
        $cek = $this->session->userdata('userid');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            $kd_dosen=$this->input->post('kd_dosen',true);
            $key['kd_dosen']=$this->input->post('kd_dosen',true);
            $data['kd_dosen']=$this->input->post('kd_dosen',true);
            $data['NIDN']=$this->input->post('nidn',true);
            $data['nm_dosen']=$this->input->post('nm_dosen',true);
            $data['jns_kelamin']=$this->input->post('jns_kelamin',true);
            $data['alamat']=$this->input->post('alamat',true);
            $data['tempat']=$this->input->post('tempat',true);
            $data['tgl_lahir']=$this->input->post('tgl_lahir',true);
            $data['telepon']=$this->input->post('telepon',true);
            $data['agama']=$this->input->post('agama',true);
            $data['Status']=$this->input->post('status',true);
            $data['jafung']=$this->input->post('jafung',true);
            //$data['kd_prodi']=$this->input->post('kd_prodi',true);
            $data['email']=$this->input->post('email',true);
          
            $config['upload_path']   = './doc/foto/dosen/';
        $config['allowed_types'] = 'jpg|jpeg|png'; //mencegah upload backdor
        $config['file_name']     = $kd_dosen; 
        $config['overwrite']	 = true;
        $this->upload->initialize($config);
         if (!empty($_FILES['link_foto']['name'])) 
         {
             if ($this->upload->do_upload('link_foto')){
        		    $image = $this->upload->data();
        			$data['link_foto'] = base_url('doc/foto/dosen').'/'.$image['file_name'];
        		    
                }
         }
		    $this->Akademika_model->update_data('dosen',$data,$key);
            
              redirect(base_url().'dosen/editprofile');
            
        }
    }
    public function cek_input_nilai()
    {
            $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
    
        $key['kd_kegiatan']="NILAI";
        $key['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $row = $this->Akademika_model->get_row_selected('jadwalakademik', $key);
        $tgl_batas= $row->sampai_tanggal;
        //$tgl_sekarang=strtotime('now');
        // $tgl_batas=strtotime($tgl_batas);
        $tgl_sekarang=date("Y-m-d");
         $tgl_batas=($tgl_batas);
      if($tgl_sekarang>=$tgl_batas)
      {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Tanggal penginputan nilai telah lewat. Ajukan permohonan akses untuk membuka kembali penginputan nilai. Terimakasih</p>
                    </div>');
       redirect(base_url().'dosen/dashboard');
      }
     
        
    }
    
    //modul absensi baru
    function list_absen()
    {
         $list=array();
        $kd_dosen=$this->session->userdata('userid');
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $sql="SELECT absensih.materi,absensih.kd_jadwal,absensih.id_absen, absensih.pertemuan_ke,absensih.tgl_pertemuan,absensih.durasi_absen,absensih.link_kelas,absensih.aktif FROM `absensih`,jadwal,jadwal_dosen where absensih.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_jadwal=jadwal_dosen.kd_jadwal and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal_dosen.kd_dosen='".$kd_dosen."' and absensih.aktif='Y'";
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
         //$datax['absenstatuss']=$this->Akademika_model->get_all('absenstatus');
       //echo json_encode($list);
       $datax['list']=$list;
        $this->template->load($this->view, 'dosen/absen/labsen', $datax);
        
    }
     function ajax_save_absen()
    {
        $pesan='Gagal';
        $kd_dosen=$this->session->userdata('userid');
        $id_absen=$this->input->post('id_absen');
      
        $data['kd_dosen']=  $kd_dosen;
        $data['tgl_absen_dosen']=date('Y-m-d H:m:s');
        
        $key['id_absen']=$id_absen;
        

            $this->Akademika_model->update_data('absensih',$data,$key);
            $pesan="Tersimpan";

         $this->session->sess_destroy();
     //  redirect('http://www.facebook.com'); 
      echo $pesan;
    }
         function ajax_tutup_absen()
    {
        $pesan='Gagal';
        $kd_dosen=$this->session->userdata('userid');
        $id_absen=$this->input->post('id_absen');
      
        $data['status']= 'T';
        $data['tgl_tutup_absen']=date('Y-m-d H:m:s');
        
        $key['id_absen']=$id_absen;
        

            $this->Akademika_model->update_data('absensih',$data,$key);
            $pesan="Tersimpan";

         $this->session->sess_destroy();
     //  redirect('http://www.facebook.com'); 
      echo $pesan;
    }
     function get_jadwalx($kd_jadwal){
        
          $sql2="select jadwal.kd_jadwal,jadwal.kelas,jadwal.hari,jadwal.jam,matakuliah.nm_mtk,matakuliah.semester_ke from jadwal,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_jadwal='".$kd_jadwal."'";
          $jadwal= $this->db->query($sql2)->row();
          return $jadwal;
    }
    //modul absensi lama
    
    
        function get_last_pertemuan($kd_jadwal)
        {
            //last_pertemuan='';
            $sql="SELECT MAX(pertemuan_ke) as last_pertemuan from absensih where kd_jadwal='".$kd_jadwal."'";
             $hasil=$this->db->query($sql)->row();
             return $hasil->last_pertemuan;
        }
    
function cpertemuan($kd_jadwal)
    {

      $jadwal=$this->Akademika_model->get_jadwal($kd_jadwal);
        $data['jadwal']=$jadwal;
       $data['tgl_pertemuan']=date('Y-m-d H:m:s');
         $pertemuan_ke=$this->get_last_pertemuan($kd_jadwal)+1;
       $data['pertemuan_ke']=$pertemuan_ke;
       $data['link_kelas']=$jadwal->link_virtual;
       $key['kd_mtk']=$jadwal->kd_mtk;
       $key['pertemuan']=$pertemuan_ke;
        
       $matakuliahd=$this->Akademika_model->get_row_selected('matakuliahd',$key);
       if($matakuliahd)
       {
            $data['materi']=$matakuliahd->materi_pembelajaran;
            
       }else{
           $data['materi']='';
       }
      
          $this->template->load($this->view, 'dosen/absen/fabsen', $data);
    }
   function aabsen()
    {
        $kd_dosen=$this->session->userdata('userid');
        $kd_jadwal=$this ->input->post('kd_jadwal',true);
        $pertemuan_ke=$this ->input->post('pertemuan_ke',true);
        
        $key['kd_jadwal']=$kd_jadwal;
        $key['pertemuan_ke']=$pertemuan_ke;
        $cek=$this->Akademika_model->get_row_selected('absensih',$key);
        if(!$cek)
        {
            $data['kd_dosen']=$kd_dosen;
            $data['kd_jadwal']=$kd_jadwal;
            $data['pertemuan_ke']=$pertemuan_ke;
            $data['tgl_pertemuan']=$this->input->post('tgl_pertemuan');
            $data['id_absen']=$kd_jadwal.$pertemuan_ke;
            $data['aktif']='Ya';
            $data['materi']=$this->input->post('materi');
            $data['durasi_absen']=$this->input->post('durasi_absen');
            $data['link_kelas']=$this->input->post('link_kelas');
            $datax['aktif']='Tidak';
              $keyx['kd_jadwal']=$kd_jadwal;
            $this->Akademika_model->update_data('absensih',$datax,$keyx);
            $this->db->insert('absensih',$data);
            
            $dataj['link_virtual']=$this->input->post('link_kelas');
            $keyj['kd_jadwal']=$kd_jadwal;
             $this->Akademika_model->update_data('jadwal',$dataj,$keyj);
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p>Absen kelas kuliah berhasil tersimpan. Terimakasih</p>
					</div>');
        }
         redirect( base_url('dosen/labsen').'/'.$kd_jadwal,'refresh'); 
        
    }
    function labsen($kd_jadwal)
    {
        $list=array();
        $keys['kd_jadwal']=$kd_jadwal;
      
        $ljadwal=$this->Akademika_model->get_list_selected('absensih',$keys);
        //$datax['list_absen']=$this->db->query($sql)->result(); 
        $datax['kd_jadwal']=$kd_jadwal;
        $datax['matakuliah']=$this->get_mtk($kd_jadwal);
       
        if($ljadwal)
        {
            foreach($ljadwal as $row)
            {
                $id_absen=$row->id_absen;
                $data['id_absen']=$row->id_absen;
                $data['kd_jadwal']=$row->kd_jadwal;
                $data['pertemuan_ke']=$row->pertemuan_ke;
                $data['tgl_pertemuan']=$row->tgl_pertemuan;
                $data['durasi_absen']=$row->durasi_absen;
                $data['materi']=$row->materi;
                $data['link_kelas']=$row->link_kelas;
                $data['aktif']=$row->aktif;
                $data['h']=$this->get_hadir($id_absen);
                $data['i']=$this->get_izin($id_absen);
                $data['s']=$this->get_sakit($id_absen);
                $data['a']=$this->get_alpa($id_absen);
                array_push($list,$data);
            }
            
            $datax['list_absen']=$list;
        }else
        {
              $datax['list_absen']='';
        }
        $this->template->load($this->view, 'dosen/labsen', $datax);
    }
    function rekap_absen_mahasiswa($kd_jadwal)
    {
        $filter['kd_jadwal']=$kd_jadwal;
        $data['list']=$this->Akademika_model->get_list_selected('vrekap_absensi_mahasiswa',$filter);
           $this->template->load($this->view, 'dosen/absen/rekap_absensi_mahasiswa', $data);
        //echo json_encode($hasil);
    }
    function get_alpa($id_absen)
    {
        $sql="SELECT count(*) as jumlah from absensid where absensid.id_absen='".$id_absen."' and absensid.status='A'";
        $data=$this->db->query($sql)->row(); 
        if($data)
        {
            return $data->jumlah;
        }else{
             return 0;
        }
    }
    function get_hadir($id_absen)
    {
        $sql="SELECT count(*) as jumlah from absensid where absensid.id_absen='".$id_absen."' and absensid.status='H'";
        $data=$this->db->query($sql)->row(); 
        if($data)
        {
            return $data->jumlah;
        }else{
             return 0;
        }
    }
     function get_sakit($id_absen)
    {
        $sql="SELECT count(*) as jumlah from absensid where absensid.id_absen='".$id_absen."' and absensid.status='S'";
        $data=$this->db->query($sql)->row(); 
        if($data)
        {
            return $data->jumlah;
        }else{
             return 0;
        }
    }
     function get_izin($id_absen)
    {
        $sql="SELECT count(*) as jumlah from absensid where absensid.id_absen='".$id_absen."' and absensid.status='I'";
        $data=$this->db->query($sql)->row(); 
        if($data)
        {
            return $data->jumlah;
        }else{
             return 0;
        }
    }
    
     function detail_absensi($id_absensi)
    {
        
        $data['list_absensi']=$this->get_detail_absensi($id_absensi);
      $this->template->load($this->view, 'dosen/detail_absensi', $data);
    }
    function tolak_absen($id_absen,$nim)
    {
        $key['id_absen']=$id_absen;
        $key['nim']=$nim;
 
        $this->Akademika_model->delete_data('absensid',$key);
     $this->detail_absensi($id_absen);
    }
    function tutup_absensi($id_absensi,$kd_jadwal)
    {
        $key['id_absen']=$id_absensi;
        $data['aktif']='T';
        $data['tgl_tutup_absen']=date('Y-m-d H:m:s');
        
         $this->Akademika_model->update_data('absensih',$data,$key);
     $this->labsen($kd_jadwal);
    }
    function dabsensi($id_absensi,$kd_jadwal)
    {
        $key['id_absen']=$id_absensi;
        
         $this->Akademika_model->delete_data('absensih',$key);
     $this->labsen($kd_jadwal);
    }
    function create_group_wa($kd_jadwal)
    {
       
       $data['kd_jadwal']=($kd_jadwal);
       
       
          $this->template->load($this->view, 'dosen/fgroup_wa', $data);
    }
    function create_group_wa_kelas()
    {
        $key['kd_jadwal']=$this->input->post('kd_jadwal',true);
        $data['group_wa']=$this->input->post('group_wa',true);
       $this->Akademika_model->update_data('jadwal', $data, $key);
      redirect(base_url().'dosen/lklsngajar');
        
    }

    function cek()
    {
          $x= $this->session->userdata('level');
         if ($x<>'dosen') {
               $this->session->sess_destroy();
            redirect(base_url());
         }
    }

   function hadir() {
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
            if ($level == "dosen") {
                // $udata['nilai']=3;
                // $key['no_krs']='KRSSI00000001';
                // $key['kd_jadwal']='JMsi201621111207';
                $udata['hadir'] = $this->input->post('hadir', true);
                $key['nim'] = $this->input->post('nim', true);
                $key['pertemuan_ke'] = $this->input->post('pertemuan_ke', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);

                $sms = $this->Akademika_model->update_data('absensi', $udata, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
function tidakhadir() {
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
            if ($level == "dosen") {
                // $udata['nilai']=3;
                // $key['no_krs']='KRSSI00000001';
                // $key['kd_jadwal']='JMsi201621111207';
                $udata['hadir'] = $this->input->post('hadir', true);
                $key['nim'] = $this->input->post('nim', true);
                $key['pertemuan_ke'] = $this->input->post('pertemuan_ke', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);

                $sms = $this->Akademika_model->update_data('absensi', $udata, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
    function izin() {
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
            if ($level == "dosen") {
                // $udata['nilai']=3;
                // $key['no_krs']='KRSSI00000001';
                // $key['kd_jadwal']='JMsi201621111207';
                $udata['hadir'] = $this->input->post('hadir', true);
                $key['nim'] = $this->input->post('nim', true);
                $key['pertemuan_ke'] = $this->input->post('pertemuan_ke', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);

                $sms = $this->Akademika_model->update_data('absensi', $udata, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
    function sakit() {
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
            if ($level == "dosen") {
                // $udata['nilai']=3;
                // $key['no_krs']='KRSSI00000001';
                // $key['kd_jadwal']='JMsi201621111207';
                $udata['hadir'] = $this->input->post('hadir', true);
                $key['nim'] = $this->input->post('nim', true);
                $key['pertemuan_ke'] = $this->input->post('pertemuan_ke', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);

                $sms = $this->Akademika_model->update_data('absensi', $udata, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
    function list_absen_mhs_kelas()
    {
        $this->cek();
        
        $kd_jadwal=$this ->input->post('kd_jadwal',true);
        $pertemuan_ke=$this ->input->post('pertemuan_ke',true);
        $key['kd_jadwal']=$this ->input->post('kd_jadwal',true);
        $key['pertemuan_ke']=$pertemuan_ke;
        $cek=$this->Akademika_model->get_row_selected('absensi',$key);
        if(!$cek)
        {
            
            $mahasiswas=$this->get_list_mahasiswa_jadwal($kd_jadwal);
            foreach ($mahasiswas as $row) {
            $data['kd_jadwal']=$kd_jadwal;
            $data['pertemuan_ke']=$pertemuan_ke;
            $data['tgl_pertemuan']=date('Y-m-d');
            $data['nim']=$row->nim;
            $data['hadir']='T';          
            $this->db->insert('absensi',$data);
            }
        }
        
       
       
       
       //ini belum
         $datax['pertemuan_ke']=$pertemuan_ke;
        $datax['jadwal']=$this->Akademika_model->get_jadwal($kd_jadwal);
        $datax['list']=$this->get_list_mahasiswa_jadwal2($kd_jadwal,$pertemuan_ke);

          $this->template->load($this->view, 'dosen/list_absen_mhs_kelas', $datax);
    }

     

    function get_list_mahasiswa_jadwal($kd_jadwal)
    {
        $sql="SELECT `rencanastudid`.`kd_jadwal`, `rencanastudih`.`nim`, `mahasiswa`.`nm_mahasiswa`,angkatan FROM
        `rencanastudid` INNER JOIN  `rencanastudih` ON `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs`
        INNER JOIN  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim` where kd_jadwal='".$kd_jadwal."' order by nim asc";
        $output = $this->db->query($sql)->result(); 
        return $output;
        //echo json_encode($output);
    }

    function get_detail_absensi($id_absensi)
    {
        $sql="SELECT absensih.id_absen,
  `absensid`.`nim`, `absensih`.`pertemuan_ke`,angkatan, `absensih`.`tgl_pertemuan`,no_hp,
  `absensih`.`kd_jadwal`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`agama`,
  `mahasiswa`.`tempat_lahir`, `mahasiswa`.`tgl_lahir`, absensid.status FROM `absensih` left JOIN absensid on absensih.id_absen=absensid.id_absen inner join
  `mahasiswa` ON `absensid`.`nim` = `mahasiswa`.`nim`  where absensih.id_absen='".$id_absensi."'  order by nm_mahasiswa asc";
        $output = $this->db->query($sql)->result(); 
        return $output;
    }
    //modul skripsi/judul
    
    function lmbimbingan_skripsi()
    {
        $this->cek();
        
         $cek = $this->session->userdata('userid');
        $data['list']=$this->get_mhs_bimbingan_skripsi($cek);
       
          $this->template->load($this->view, 'dosen/list_mhs_bimb_skripsi', $data);
    }
    
    public function get_mhs_bimbingan_skripsi($dosen)
    {
        $sql="SELECT daftar_judul.nim,nm_mahasiswa,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,judul,pembimbing_ke,daftar_judul.status FROM `pembimbing_skripsi`,daftar_judul,mahasiswa WHERE pembimbing_skripsi.no_daftar=daftar_judul.no_daftar and daftar_judul.nim=mahasiswa.nim and pembimbing='".$dosen."'";
         $output = $this->db->query($sql)->result();
//echo json_encode($output);
return $output;
        
    }
    
    public function get_jadwal_ujianz()
    {
        $sql="select * from penguji where penguji='123123'";
        $output = $this->db->query($sql)->result();
        
        foreach($output as $row)
        {
            $no_daftar=$row->no_daftar;
             $sql2="select daftar.no_daftar,penguji,penguji_ke,nm_mahasiswa,angkatan from daftar,mahasiswa,penguji where daftar.nim=mahasiswa.nim and daftar.no_daftar=penguji.no_daftar and daftar.no_daftar='".$no_daftar."'";
            $output2 = $this->db->query($sql2)->result();
             echo json_encode($output2);
            
        }
        //echo json_encode($output);
        //return $output;
    }
    
    function pilihta()
    {
        $this->cek();
       // $cek = $this->session->userdata('userid');
        $homebase = $this->session->userdata('home_base');
 

            $datax['listta'] = $this->Akademika_model->get_all('thnajaran');
             


            //   $this->load->view('bak/dkabak',$datax);
            $this->template->load($this->view, 'dosen/fpilihta', $datax);
       // $this->template->load($this->view, 'bismillah', $data);
    }
        function dashboard() {
            
        $cek = $this->session->userdata('userid');
        $home_base = $this->session->userdata('home_base');
        $keypro['kd_prodi']=$home_base;
        $data['prodi'] = $this->Akademika_model->get_row_selected('prodi',$keypro);
        //$kd_tahun_ajaran= $this->input->post('kd_tahun_ajaran', TRUE);
        //$sess_data['kd_tahun_ajaran']=$kd_tahun_ajaran;
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $data['list1']=$this->get_jum_bimbingan($cek);
       // $data['jadwalujian']=$this->Akademika_model->get_jadwal_ujian();
        //$data['jadwalujian']='';
        $data['jadwalmembimbingujian']=$this->get_jadwal_membimbing_ujian($cek,$kd_tahun_ajaran);
         $data['jadwalujianlengkap']=$this->jadwal_ujian();
        $data['list3']=$this->get_list_kelas_ngajar($kd_tahun_ajaran,$cek);
        $data['kalender_akademik']=$this->Akademika_model->get_kalender_akademik($kd_tahun_ajaran);
        //$this->session->set_userdata($sess_data);
        $this->template->load($this->view, 'template/homedosen', $data);
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
        public  function get_jadwal_membimbing_ujian($kd_dosen,$kd_tahun_ajaran)
        {
            $sql="SELECT  pembimbing_skripsi.pembimbing,daftar.tgl_ujian,daftar.jam, jenis_ujian,pembimbing_skripsi.pembimbing_ke,daftar_judul.nim,nm_mahasiswa FROM pembimbing_skripsi,daftar_judul,daftar,dosen,mahasiswa,jenis_ujian_prodi WHERE daftar_judul.no_daftar=pembimbing_skripsi.no_daftar AND daftar.no_daftar_judul=daftar_judul.no_daftar and daftar.urutan=jenis_ujian_prodi.urutan AND pembimbing_skripsi.pembimbing=dosen.kd_dosen and daftar.nim=mahasiswa.nim and pembimbing_skripsi.pembimbing='".$kd_dosen."' and daftar.kd_tahun_ajaran='".$kd_tahun_ajaran."' and daftar.status='1'";
            $output = $this->db->query($sql)->result();
            return $output;
            //echo json_encode($output);
            
        }
        
        public function get_jadwal_ujian()
        {
            $dosen = $this->session->userdata('userid');
            $sql="select day(tgl_ujian) as hari,daftar.nim,jenis_ujian,judul,link_draft,penguji_ke,nm_mahasiswa,angkatan,tgl_ujian,jam,ruang from daftar,penguji,mahasiswa,jenis_ujian_prodi where daftar.urutan=jenis_ujian_prodi.urutan and daftar.no_daftar=penguji.no_daftar and daftar.nim=mahasiswa.nim and penguji.penguji='".$dosen."' and daftar.status='1'";
             $output = $this->db->query($sql)->result();
            return $output;
            //echo json_encode($output);
        }
        
        private function get_jum_bimbingan($dosen)
        {
            $sql="SELECT kd_tahun_ajaran,pembimbing_ke,pembimbing,count(pembimbing)as jumlah FROM pembimbing_skripsi,daftar_judul WHERE pembimbing_skripsi.no_daftar=daftar_judul.no_daftar and pembimbing='".$dosen."' and daftar_judul.status<>'lulus' group by kd_tahun_ajaran,pembimbing_ke,pembimbing order by kd_tahun_ajaran,pembimbing_ke asc";
             $output = $this->db->query($sql)->result();
            return $output;
            
        }
        //modul berita acara ujian
    function fberita_acara_final($kd_jadwal)
    {
        $this->cek();
        $data['kertas']='A4';
        $data['posisi']='L';
        $data['kd_jadwal']=$kd_jadwal;
        $data['jarak_antar_baris']='7';
        
         $this->template->load($this->view, 'dosen/fberita_acara_ujian', $data);
    }
    function fabsensi($kd_jadwal)
    {
        $this->cek();
        $data['kertas']='A4';
        $data['posisi']='L';
$data['kd_jadwal']=$kd_jadwal;
        $data['jarak_antar_baris']='7';
        
         $this->template->load($this->view, 'dosen/fabsensi', $data);
    }
    function absensi() {
        $this->cek();
        $kertas=$this->input->post('kertas',true);
        $posisi=$this->input->post('posisi',true);
 $jumlah=$this->input->post('jumlah',true);
 $kementerian= $this->config->item('kementerian');
        $jarak_antar_baris=$this->input->post('jarak_antar_baris',true);
       $kd_jadwal= $this->input->post('kd_jadwal',true);
        $jumlah_tambahan= $this->input->post('jumlah',true);
        $hasil = $this->get_absensi($kd_jadwal);
        $hasil2 = $this->get_hjadwal($kd_jadwal);

        $this->load->library('cfpdf');
        $pdf = new FPDF($posisi, 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10, 10);
        $pdf->SetFont('times', '', 14);

        $gambar = "assets/image/usnx.gif";
        $pdf->image($gambar, 20, 10, 30);

        $pdf->Cell(25);
        $pdf->Cell(0, 5,$kementerian, 0, 0, 'C');
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
        $pdf->Cell(260, 1, '', 'B', 1, 'L');
        $pdf->Cell(260, 1, '', 'B', 0, 'L');
        $pdf->ln(3);
        $pdf->Cell(0, 5, 'ABSENSI KEHADIRAN', 0, 0, 'C');
        $pdf->ln(5);
        $prodi = "PROGRAM STUDI " . $hasil2->nm_prodi;
        $pdf->Cell(0, 5, $prodi, 0, 0, 'C');


        $pdf->ln(10);
        //BARIS PERTAMA
        $pdf->Cell(50, 5, 'MATA KULIAH ', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(100, 5, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(50, 5, 'TAHUN AJARAN', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(54, 5, $hasil2->kd_tahun_ajaran, 0, 0, 'L');
        $pdf->ln(5);
        //BARIS KEDUA
        $pdf->Cell(50, 5, 'JUMLAH SKS/KELAS', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(100, 5, $hasil2->sks . 'SKS'.'/ '.$hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(50, 5, 'DOSEN PENGAMPU', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(54, 5, $hasil2->nm_dosen, 0, 0, 'L');
        $pdf->ln(5);
         //BARIS KEDUA
        $pdf->Cell(50, 5, 'SEMESTER', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(100, 5, $hasil2->semester_ke, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(50, 5, 'JADWAL', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(54, 5, $hasil2->hari.', Jam'. $hasil2->jam, 0, 0, 'L');
        $pdf->ln(6);

        //tabel
         $pdf->Cell(10, 16, 'NO', 1, 0, 'C');
        $pdf->Cell(24, 16, 'NIM', 1, 0, 'C');
        $pdf->Cell(60, 16, 'NAMA MAHASISWA', 1, 0, 'L');
        $pdf->Cell(176, 8, 'Pertemuan Ke-', 1, 0, 'C');
         $pdf->ln(8);
         $pdf->Cell(94);
        for ($i = 1; $i < 17; $i++) {
            $pdf->Cell(11, 8, $i, 1, 0, 'C');
        }
        $pdf->ln();

        $no=1;
        foreach ($hasil as $row) {
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(24, $jarak_antar_baris, $row->nim, 1, 0, 'C');
            $pdf->Cell(60, $jarak_antar_baris, $row->nm_mahasiswa, 1, 0, 'L');
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
        $pdf->Cell(94, 9, 'TANGGAL PERTEMUAN', 1, 0, 'R');

        for ($i = 0; $i < 16; $i++) {
            $pdf->Cell(11, 9, '', 1, 0, 'c');
        }
        $pdf->ln(9);
        $pdf->Cell(94, 10, 'PARAF DOSEN PENGAMPU', 1, 0, 'R');

        for ($i = 0; $i < 16; $i++) {
            $pdf->Cell(11, 10, '', 1, 0, 'c');
        }
        $pdf->ln(11);
        $pdf->ln(3);
//buat tanggal
        
        
        


        
        //$pdf->Cell(0,5,'Halaman '.$pdf->PageNo().'Dari'.'/{nb}',0,0,'R');
        $pdf->Output();
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
  `jadwal`.`kd_jadwal` = '" . $kd_jadwal . "'";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
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
    function berita_acara_final() {
        $this->cek();
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
        $pdf->Cell(0, 5, 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
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
        $pdf->Cell(0, 5, 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
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
        $pdf->Cell(0, 5, 'DAFTAR HADIR', 0, 1, 'C');
        $pdf->Cell(0, 5, strtoupper($ket_ujian2), 0, 1, 'C');
         $pdf->ln(10);
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
    function berita_acara_finalx() {
        $this->cek();
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
        $pdf->image($gambar, 20, 10, 30);

        $pdf->Cell(25);
        $pdf->Cell(0, 5, 'KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI', 0, 0, 'C');
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
        $pdf->Cell(260, 1, '', 'B', 1, 'L');
        $pdf->Cell(260, 1, '', 'B', 0, 'L');
        $pdf->ln(3);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(0, 5, 'BERITA ACARA UJIAN AKHIR SEMESTER', 0, 0, 'C');
        $pdf->ln(5);
        $prodi = "PROGRAM STUDI " . $hasil2->nm_prodi;
        $pdf->Cell(0, 5, $prodi, 0, 0, 'C');

        $pdf->SetFont('times', '', 10);
        $pdf->ln(10);
        //BARIS PERTAMA
        //$pdf->Text(10,40,"ini adalah teks dalam pdf fpdf",0);
        $pdf->Cell(50, 5, 'Pada hari ini,.............. tanggal.......bulan.....tahun.......telah diselenggarakan UJIAN AKHIR SEMESTER tahun akademik .'.$hasil2->kd_tahun_ajaran.' pada:' , 0,0,'L');
        $pdf->ln(10);
        $pdf->Cell(40, 5, 'MATA KULIAH ', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(40, 5, $hasil2->nm_mtk, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        
        $pdf->Cell(40, 5, 'TAHUN AJARAN', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        
        $pdf->Cell(40, 5, $hasil2->kd_tahun_ajaran, 0, 0, 'L');
        $pdf->ln(5);
        //BARIS KEDUA
        $pdf->Cell(40, 5, 'JUMLAH SKS/KELAS', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(40, 5, $hasil2->sks . 'SKS'.'/ '.$hasil2->kelas, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(40, 5, 'DOSEN PENGAMPU', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(40, 5, $hasil2->nm_dosen, 0, 0, 'L');
        $pdf->ln(5);
         //BARIS KEDUA
        $pdf->Cell(40, 5, 'SEMESTER', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(40, 5, $hasil2->semester_ke, 0, 0, 'L');
        $pdf->Cell(5, 5, '', 0, 0, 'L');
        $pdf->Cell(40, 5, 'JADWAL', 0, 0, 'L');
        $pdf->Cell(2, 5, ':', 0, 0, 'C');
        $pdf->Cell(40, 5, $hasil2->hari.', Jam'. $hasil2->jam, 0, 0, 'L');
        $pdf->ln(6);

        //tabel
         $pdf->Cell(10, 16, 'NO', 1, 0, 'C');
        $pdf->Cell(30, 16, 'NIM', 1, 0, 'C');
        $pdf->Cell(100, 16, 'NAMA MAHASISWA', 1, 0, 'L');
        $pdf->Cell(20, 16, 'PARAF', 1, 0, 'L');
        $pdf->Cell(35, 16, 'KETERANGAN', 1, 0, 'L');
        
        $pdf->ln();

        $no=1;
        foreach ($hasil as $row) {
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(30, $jarak_antar_baris, $row->nim, 1, 0, 'C');
            $pdf->Cell(100, $jarak_antar_baris, $row->nm_mahasiswa, 1, 0, 'L');
            $pdf->Cell(20, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(35, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Ln();
        }
        for($i=0;$i<$jumlah;$i++)
        {
            $pdf->Cell(10, $jarak_antar_baris, $no++, 1, 0, 'C');
            $pdf->Cell(30, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(100, $jarak_antar_baris,'', 1, 0, 'L');
            $pdf->Cell(20, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Cell(35, $jarak_antar_baris, '', 1, 0, 'L');
            $pdf->Ln();
        }
           $pdf->Ln(10);
        $pdf->Cell(10, $jarak_antar_baris, '', 0, 0, 'C');
        
        $pdf->Cell(35, $jarak_antar_baris, 'Pengawas', 0, 0, 'C');
        $pdf->Cell(100, $jarak_antar_baris, '', 0, 0, 'C');
        $pdf->Cell(35, $jarak_antar_baris, 'Dosen Pengampu', 0, 0, 'C');
            $pdf->Ln(30);
        $pdf->Cell(10, $jarak_antar_baris, '', 0, 0, 'C');
        $pdf->Cell(35, $jarak_antar_baris, '___________________________', 0, 0, 'C');
        $pdf->Cell(100, $jarak_antar_baris, '', 0, 0, 'C');
        $pdf->Cell(35, $jarak_antar_baris,$hasil2->nm_dosen , 0, 0, 'C');
        
        
        $pdf->Output();
    }
        
        function list_bimbingan_akademik()
        {
             $cek = $this->session->userdata('userid');
             $homebase=$this->session->userdata('home_base');
            if($cek)
            {
            $list['prodi']=$this->Akademika_model->get_data_prodi($homebase);
            $list['listmhsbimbingan'] = $this->get_list_mhs_bimbingan($cek);
            $keydosen['kd_dosen']=$cek;
            $list['dosen']=$this->Akademika_model->get_row_selected('dosen',$keydosen);
          //  $this->template->load($this->view, 'dosen/lmhsbimbingan', $list);
              $this->load->view('dosen/lap_mhs_bimbingan', $list);
            }
            else
            {
                $this->session->sess_destroy();
                redirect(base_url());
            }
           
        }
    function viewJadwal()
	{
		$cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $level = $this->session->userdata('level');
        if($level=="dosen")
        {
            $data['listjadwal']=$this->get_jadwal_kuliah($cek,$kd_tahun_ajaran);
               $this->load->view('laporan/jadwalkuliahdosen', $data);
            
        }else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        
	}
	
	//fungsi cetak mahasiswa bimbingan
	
  private  function get_jadwal_kuliah($kd_dosen,$kd_tahun_ajaran)
    {
        $sql="SELECT jadwal.kd_prodi,`jadwal`.`kd_dosen`, `jadwal`.`hari`, `jadwal`.`kelas`, `thari`.`no`,`matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `matakuliah`.`sks_praktikum_lab`, `matakuliah`.`sks_praktikum_lapangan`, `jadwal`.`jam`, `jadwal`.`kd_ruang` FROM `jadwal` INNER JOIN `thari` ON `thari`.`hari` = `jadwal`.`hari` INNER JOIN `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk`where kd_dosen='".$kd_dosen."'  and kd_tahun_ajaran='".$kd_tahun_ajaran."' order by no asc";
        $output = $this->db->query($sql)->result();
        return $output;
    }
    function lkhs($nim)
    {
        $this->cek();
        $data['listta']=$this->Akademika_model->get_all_khs_nim($nim);
        $this->template->load($this->view, 'dosen/lkhs', $data);
    }
    function khs($no_krs) {
        $this->cek();
        $nim = $this->input->post('nim', true);
        $kd_tahun_ajaran = $this->input->post('kd_tahun_ajaran', true);
        $homebase = $this->session->userdata('home_base');
        $data['hkhs'] = '';
        $data['dkhs'] = '';
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
        $this->load->view('mahasiswa/khss', $data);
        } else {
            echo 'maaf hasil studi anda pada tahun_ajaran ini belum ada...';
        }
    }
    function transkrip_nilai($nim)
    {
         
          $this->cek();
           $data['pa'] = $this->Akademika_model->get_pa($nim);
          
            $keymhs['nim']=$nim;
           $mhs=$this->Akademika_model->get_row_selected('mahasiswa',$keymhs);
            $data['mahasiswa']=$mhs;
             $homebase =$mhs->kd_prodi;
               $keyprodi['kd_prodi']=$homebase;
				$prodi=$this->Akademika_model->get_row_selected('prodi',$keyprodi);
				$keyfak['kd_fak']=$prodi->kd_fak;
				$fak=$this->Akademika_model->get_row_selected('fakultas',$keyfak);
				$data['nm_fak']=$fak->nm_fak;
				$data['dekan']=$fak->dekan;
				$data['wd1']=$fak->wd1;
                $data['ka_prodi']=$prodi->ka_prodi;
                $data['nm_prodi']=$prodi->nm_prodi;
                $data['nip_dekan']=$fak->nip_dekan;
                
         $data['transkrip'] = $this->Akademika_model->get_transkrip_nilai($nim);
        $this->load->view('mahasiswa/transkrip_nilai', $data);
    }
    function list_krs_mhs()
    {
        $this->cek();
        $kd_dosen=$this->session->userdata('userid');
        $kd_tahun_ajaran=$this->session->userdata('kd_tahun_ajaran');
        $data['data']=$this->get_krs_mhs_bimbingan($kd_tahun_ajaran,$kd_dosen);
         $this->template->load($this->view, 'dosen/lkrsmb', $data);
    }
      
    function ekrs($no_krs) {
        
        $homebase = $this->session->userdata('home_base');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $levela = $this->session->userdata('level');
        if ($levela == "dosen") {
            $key['no_krs']=$no_krs;
            $hasil=$this->Akademika_model->get_row_selected('rencanastudih',$key);
            $status_registrasi = $this->status_registrasi($kd_tahun_ajaran, $hasil->nim);
            if ($status_registrasi == TRUE) {
                $keyja['kd_tahun_ajaran'] = $kd_tahun_ajaran;
                $keyja['kd_kegiatan'] = 'KRS';
                $hasilcekja = $this->Akademika_model->get_row_selected('jadwalakademik', $keyja);
                if ($hasilcekja->aktif == 'Ya') {
                    $krsh = $this->get_krsh($no_krs, $hasil->nim);
                    
                    $data['krsh'] = $krsh;
                    $ips=$krsh->ips;
                    $data['maks_sks']=$this->Akademika_model->rule_maks_sks($ips);
                   $jadwal= $this->get_krsd($no_krs);
                     $data['krsd']=$this->parsing($jadwal);
                    $this->template->load($this->view, 'dosen/ekrs', $data);
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
    private function get_mtk($kd_jadwal) {
        $sql = "select jadwal.kd_mtk,matakuliah.nm_mtk,matakuliah.sks,jadwal.kelas from jadwal,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_jadwal='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->row();
        return $output;
    }
//    function list_krsx()
//    {
//        $cek = $this->session->userdata('userid');
//        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
//        $level = $this->session->userdata('level');
//
//
//            if ($level == "dosen") {
//                $kd_dosen = $cek;
//                $list['listkrs'] = $this->get_all_krs_mhs($nim);
//                $this->template->load($this->view, 'dosen/listkrsmhsbimbingan', $list);
//            } else {
//                $this->session->sess_destroy();
//                redirect(base_url());
//            }
//        }
    
    //fungsi untuk manampilkan list krs mahasiswa
    public function list_krs($nim) {
        
        $cek = $this->session->userdata('userid');
//        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "dosen") {
                $list['listkrs'] = $this->get_all_krs_mhs($nim);
                $this->template->load($this->view, 'dosen/listkrsmhsbimbingan', $list);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    private function status_registrasi($kd_tahun_ajaran, $nim) {
        $outut = false;
        $sql = "SELECT nim from registrasi where kd_tahun_ajaran='" . $kd_tahun_ajaran . "' and nim='" . $nim . "' and jns_registrasi='P03' ";
        $hasil = $this->db->query($sql)->result();
        if ($hasil) {
            $outut = true;
        }
        return $outut;
    }

     function get_krs_mhs_bimbingan($kd_tahun_ajaran,$kd_dosen)
    {
        $sql="SELECT  `rencanastudih`.`nim`, `rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`,
  `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`setujui_pa`,`rencanastudih`.kd_prodi,
  `rencanastudih`.`semester_ke`, `rencanastudih`.`ips_sebelumnya`,
  `rencanastudih`.`maks_sks`, `rencanastudih`.`tot_sks`,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp,
  `mahasiswa`.`nm_mahasiswa`, `pah`.`kd_dosen`, `mahasiswa`.`angkatan`
    FROM  `rencanastudih` INNER JOIN  `pad` ON `rencanastudih`.`nim` = `pad`.`nim` INNER JOIN
  `pah` ON `pah`.`no_pa` = `pad`.`no_pa` INNER JOIN  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim`
WHERE
  `pah`.`kd_dosen` = '".$kd_dosen."' and  `rencanastudih`.`kd_tahun_ajaran`='".$kd_tahun_ajaran."' order by setujui_pa desc";
         $output = $this->db->query($sql)->result();
       // echo json_encode($output);
        return $output;
    }
    //fungsi get allkrs mahasiswa
    private function get_all_krs_mhs($nim) {
        $sql = "SELECT
  `rencanastudih`.`nim`, `rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`,
  `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`setujui_pa`,
  `rencanastudih`.`semester_ke`, `rencanastudih`.`ips_sebelumnya`,
  `rencanastudih`.`maks_sks`, `rencanastudih`.`tot_sks`,
  `mahasiswa`.`nm_mahasiswa`
FROM
  `rencanastudih` INNER JOIN
  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim`
WHERE
  `rencanastudih`.`nim` = '" . $nim . "'";
        $output = $this->db->query($sql)->result();
        return $output;
    }

    //fungsi menampilkan mahasiswa bimbingan
    function list_mhs_bimbingan() {
        
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "dosen") {
                $kd_dosen = $this->session->userdata('userid');
                $list['listmhsbimbingan'] = $this->get_list_mhs_bimbingan($cek);
                $this->template->load($this->view, 'dosen/lmhsbimbingan', $list);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    //fungsi get_mahasiswa_bimbingan
    private function get_list_mhs_bimbingan($kd_dosen) {
        $sql = "SELECT mahasiswa.kd_prodi,`pad`.`nim`, `pah`.`kd_dosen`, `mahasiswa`.`nm_mahasiswa`,`mahasiswa`.`jns_kelamin`,nilai_ukt,concat('62',RIGHT(no_hp,length(no_hp)-1)) as no_hp, `mahasiswa`.`angkatan`, `mahasiswa`.`agama`,mahasiswa.status
			FROM `pah` INNER JOIN `pad` ON `pad`.`no_pa` = `pah`.`no_pa` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `pad`.`nim` WHERE `pah`.`kd_dosen` = '" . $kd_dosen . "' and mahasiswa.status not in('L','D') and mahasiswa.status_akademik not in('skripsi')  order by mahasiswa.kd_prodi,angkatan,nm_mahasiswa asc" ;
        $output = $this->db->query($sql)->result();
        return $output;
    }

    function get_jumlah_mhs_prodi_angkatan() {
        $hasil = "select kd_prodi,count(nim)as jumlah from mahasiswa group by kd_prodi";
        $data['list'] = $this->db->query($hasil)->result();
        $this->load->view('prodi/ljum_mhs_prodi_angkatan', $data);
        // echo json_encode($data);
    }
   
    
    
    function unilai() {
        $sms = 0;
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $nilai=$this->input->post('nilai', true);
        
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "dosen") {

                 $keys['no_krs'] = $this->input->post('no_krs', true);
                $keys['kd_mtk'] = $this->input->post('kd_mtk', true);
                 $this->Akademika_model->get_row_selected('nilai_mtk_mhs',$keys);
                   
                
                
                 $ub['nilai_a'] = $nilai;
                 $this->Akademika_model->update_data('nilai_mtk_mhs', $ub, $keys);
                
                
                $key['no_krs'] = $this->input->post('no_krs', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);
                
                
                $ukrs['nilai']=$nilai;
                $ukrs['tgl_edit']=date('Y-m-d H:m:s');
               
               $sms= $this->Akademika_model->update_data('rencanastudid', $ukrs, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
    function angka_mutu($nilai)
    {
        $mutu='E';
        if($nilai>=86 and $nilai<=100)
        {
            $mutu='A';
        }elseif($nilai>=81 and $nilai<86)
        {
            $mutu='AB';
        }elseif($nilai>=76 and $nilai<81)
        {
            $mutu='B';
        }elseif($nilai>=71 and $nilai<76)
        {
            $mutu='BC';
        }
        elseif($nilai>=61 and $nilai<71)
        {
            $mutu='C';
        }
        elseif($nilai>=51 and $nilai<61)
        {
            $mutu='CD';
        }elseif($nilai>=41 and $nilai<51)
        {
            $mutu='D';
        }
        elseif($nilai<41)
        {
            $mutu='E';
        }
        return $mutu;
    }
    function ajax_unilai() {
        $sms = 0;
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        $nilai_angka=$this->input->post('nilai', true);
        $nilai_mutu=$this->angka_mutu($nilai_angka);
        if (empty($cek)) {
            redirect(base_url());
        } else {
            
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "dosen") {

                 $keys['no_krs'] = $this->input->post('no_krs', true);
                $keys['kd_mtk'] = $this->input->post('kd_mtk', true);
                
                
                $this->Akademika_model->get_row_selected('nilai_mtk_mhs',$keys);
                   
                
                
                 $ub['nilai_a'] = $nilai_mutu;
                 $this->Akademika_model->update_data('nilai_mtk_mhs', $ub, $keys);
                $key['no_krs'] = $this->input->post('no_krs', true);
                $key['kd_jadwal'] = $this->input->post('kd_jadwal', true);
                $ukrs['nilai_angka']=$nilai_angka;
                $ukrs['nilai']=$nilai_mutu;
                $ukrs['edit_by']=$cek;
                $ukrs['tgl_update']=date('Y-m-d');                
               $sms= $this->Akademika_model->update_data('rencanastudid', $ukrs, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
    function tutup_jadwal($kode){
        $key['kd_jadwal']=$kode;
        $ukrs['status']='Tertutup';
        $this->Akademika_model->update_data('jadwal', $ukrs, $key);
    }
    function selesai($kode){
        $key['kd_jadwal']=$kode;
        $ukrs['status_nilai']='Selesai';
        $this->Akademika_model->update_data('jadwal', $ukrs, $key);
        redirect('dosen/lklsngajar');
    }
     function revisi($kode){
        $key['kd_jadwal']=$kode;
        $ukrs['status_nilai']='Revisi';
        $this->Akademika_model->update_data('jadwal', $ukrs, $key);
        redirect('dosen/nilai_kelas'.'/'.$kode);
    }
    function anilai() {
        $sms = 0;
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
       // $this->cek_input_nilai();
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;
            if ($level == "dosen") {
                $udata['nilai_a'] = $this->input->post('nilai', true);
                $udata['nim'] = $this->input->post('nim', true);
                $udata['tgl_update'] =  date('Y-m-d');
                $key['no_krs'] = $this->input->post('no_krs', true);
                $key['kd_mtk'] = $this->input->post('kd_mtk', true);
                $udatakrs['nilai'] = $this->input->post('nilai', true);
                $udatakrs['tgl_edit'] =  date('Y-m-d');
                $ada=$this->Akademika_model->get_row_selected('nilai_mtk_mhs',$key);
                if($ada)
                {
                   $this->Akademika_model->update_data('nilai_mtk_mhs', $udata, $key);
                }else
                {
                     $udata['no_krs'] = $this->input->post('no_krs', true);
                    $udata['kd_mtk'] = $this->input->post('kd_mtk', true);
                    $udata['nim'] = $this->input->post('nim', true);
                    $this->Akademika_model->save_data('nilai_mtk_mhs', $udata);
                }
                $sms = $this->Akademika_model->update_data('rencanastudid', $udatakrs, $key);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
        echo $sms;
    }
function permintaan_akses_nilai($kd_jadwal)
{
    $this->cek();
    $data['jadwal']=$this->get_jadwal_mtk($kd_jadwal);
    $this->template->load($this->view, 'dosen/permintaan_akses_nilai_f', $data);
}
function save_permintaan_akses_nilai()
{
    $this->cek();
    $key['kd_jadwal']=$this->input->post('kd_jadwal');
    $userid=$this->session->userdata('userid');
    
    $cek=$this->Akademika_model->get_row_selected('permintaan_akses_nilai',$key);
        
    $data['penjelasan']=$this->input->post('penjelasan');
    $data['tgl_usul']=date("Y-m-d H:i:s");
    if($cek)
    {
        $datax['status_nilai']='Usul Akses';
        $this->Akademika_model->update_data('jadwal', $datax,$key);   
        $this->Akademika_model->update_data('permintaan_akses_nilai', $data,$key);    
    }else
    {
        $data['userid']=$userid;
        $data['status']='Usul';
        $datax['status_nilai']='Usul Akses';
        $data['kd_jadwal']=$this->input->post('kd_jadwal');
         $this->Akademika_model->save_data('permintaan_akses_nilai', $data);  
         $this->Akademika_model->update_data('jadwal', $datax,$key);   
    }
    redirect('dosen/lklsngajar');
    
}
function cek_jadwal($kd_jadwal)
{
    $this->cek();
    $keyjadwal['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');
    $keyjadwal['kd_kegiatan']="NILAI";
    $status = $this->Akademika_model->get_row_selected('jadwalakademik', $keyjadwal);
    
    //$keyjadwalx['kd_tahun_ajaran']=$this->session->userdata('kd_tahun_ajaran');;
    $keyjadwalx['kd_jadwal']=$kd_jadwal;
    $statusx = $this->Akademika_model->get_row_selected('jadwal', $keyjadwalx);
    
    
    
    if (!empty($status) and $status->aktif=='Tidak' and $statusx->status=='Tertutup')
        {
             $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <h4>Informasi...!</h4><p> Batas waktu penginputan nilai telah berakhir. Penginputan nilai akan dibuka kembali jika ada perpanjangan/perubahan kalender akademik. Terimakasih</p>
					</div>');
            redirect(base_url().'dosen/lklsngajar');
        }
}
function cek_jadwal2($kd_jadwal)
{
    $this->cek();
    $keyjadwal['kd_jadwal']=$kd_jadwal;
    $keyjadwal['status']="Tertutup";
    
    $status = $this->Akademika_model->get_row_selected('jadwal', $keyjadwal);
    if (!empty($status) and $status->status=='Tertutup')
        {
             $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> Batas waktu penginputan nilai telah berakhir. Silahkan mengajukan permohonan  ke BAAK/Admin SIAKAD agar penginputan nilai dapat dilakukan. Terimakasih</p>
					</div>');
            redirect(base_url().'dosen/lklsngajar');
        }
        

}
   function list_mhs_kelas($kd_jadwal) {
       $this->cek();
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
            if ($level == "dosen") {
                $list['data'] = $this->get_jadwal_mtk($kd_jadwal);
                $list['list'] = $this->get_list_mhs_kelas($kd_jadwal);
                $kd_nilai="D";
                $sql="select * from tnilai,snilaiangkatan where tnilai.kd_nilai=snilaiangkatan.kd_nilai";
                $list['lnilai'] = $this->db->query($sql)->result();
                $this->template->load($this->view, 'dosen/lmhskls', $list);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
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
            if ($level == "dosen") {

                $list['kd_tahun_ajaran'] = $rowjadwal->kd_tahun_ajaran;
                $list['head'] = $this->get_jadwal_mtk($kd_jadwal);
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
function nilai_kelas_excel($kd_jadwal) 
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
            if ($level == "dosen") {

                $list['kd_tahun_ajaran'] = $rowjadwal->kd_tahun_ajaran;
                $list['head'] = $this->get_jadwal_mtk($kd_jadwal);
                $list['list'] = $this->get_list_mhs_kelas($kd_jadwal);
                 $list['prodi']=$this->Akademika_model->get_data_prodi($homebase);
               // $this->load->view('dosen/lapnilaikelas', $list);
                $this->load->view('dosen/lap_nilai_kelas_excel', $list);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
    private function get_jadwal_mtk($kd_jadwal) {
        $sql = "SELECT jadwal.kd_tahun_ajaran,`jadwal`.`kd_jadwal`, `jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`,`jadwal`.`kd_dosen`, `matakuliah`.`sks`, `matakuliah`.`semester_ke`,`jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kd_ruang` FROM  `jadwal` INNER JOIN  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk`  WHERE `jadwal`.`kd_jadwal` ='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->row();
        return $output;
    }

    function lklsngajar() {
       
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;

            if ($level == "dosen") {
                 
                $dlklsngajar['list'] = $this->get_list_kelas_ngajar($kd_tahun_ajaran, $cek);
                $this->template->load($this->view, 'dosen/lklsngajar', $dlklsngajar);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }

    private function get_nilai_kelas($kd_jadwal) {
        $sql = "SELECT  `jadwal`.`kd_dosen`, `dosen`.`NIDN`, `dosen`.`nm_dosen`, `jadwal`.`kd_mtk`,
        `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `rencanastudid`.`nilai`,  `rencanastudid`.`kd_jadwal`
        FROM  `jadwal` INNER JOIN  `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen` INNER JOIN
        `rencanastudid` ON `rencanastudid`.`kd_jadwal` = `jadwal`.`kd_jadwal`  INNER JOIN  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` where jadwal.kd_jadwal='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->result();
        return $output;
    }

    private function get_list_mhs_kelas($kd_jadwal) {

        $sql = "SELECT  `rencanastudid`.`kd_jadwal`,`rencanastudid`.`kd_mtk`, `rencanastudih`.`nim`, `rencanastudih`.`no_krs`,nilai_angka, `rencanastudid`.`nilai`,  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`,concat('62',RIGHT(no_hp,length(no_hp)-1))as no_hp, `mahasiswa`.`kd_prodi`
FROM  `rencanastudih` INNER JOIN  `rencanastudid` ON `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs`
  INNER JOIN  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim`  where `rencanastudid`.`kd_jadwal`='" . $kd_jadwal . "' and rencanastudih.setujui_pa='Ya' ";
        $output = $this->db->query($sql)->result();
        return $output;
    }

    private function get_list_kelas_ngajar($kd_tahun_ajaran, $kd_dosen) {
        $sql = "SELECT nm_prodi,jadwal.status,jadwal.status_nilai, `jadwal`.`kd_mtk`,`jadwal`.`kd_jadwal`,group_wa, `jadwal`.`kd_dosen`, `dosen`.`NIDN`, `dosen`.`nm_dosen`,`dosen`.`kd_prodi` AS home_base, `jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`,`jadwal`.`kd_ruang`, `jadwal`.`kapasitas`,matakuliah.sks, `matakuliah`.`nm_mtk`,jadwal_dosen.jumlah_pertemuan, `jadwal_dosen`.`jumlah_sks` as jumlah_sks, `matakuliah`.`semester_ke`, `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_prodi` from jadwal,jadwal_dosen,matakuliah,prodi,dosen where jadwal.kd_jadwal=jadwal_dosen.kd_jadwal and jadwal.kd_tahun_ajaran='".$kd_tahun_ajaran."' and jadwal_dosen.kd_dosen='".$kd_dosen."' and jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_prodi=prodi.kd_prodi and jadwal_dosen.kd_dosen=dosen.kd_dosen ORDER BY jadwal.kd_prodi asc";
        $output = $this->db->query($sql)->result();
        //echo json_encode($output);
        return $output;
    }

    function lkrsmb() {
        
        $cek = $this->session->userdata('userid');
        $kd_tahun_ajaran = $this->session->userdata('kd_tahun_ajaran');
        if (empty($cek)) {
            redirect(base_url());
        } else {
            //$st=$this->session->userdata('userid');
            $data['userid'] = $cek;
            $row = $this->Akademika_model->get_row_selected('user', $data);
            $level = $row->level;

            if ($level == "dosen") {
                $hlkrsmb['data'] = $this->get_lkrsmb($kd_tahun_ajaran, $cek);

                $this->template->load($this->view, 'dosen/lkrsmb', $hlkrsmb);
            } else {
                $this->session->sess_destroy();
                redirect(base_url());
            }
        }
    }
public function list_mhs_jadwal($kd_jadwal)
{
    $this->cek();
           $list['list'] = $this->Akademika_model->get_list_mhs_kelas($kd_jadwal);
     $this->template->load($this->view, 'dosen/list_mhs_jadwal', $list);
}
    private function list_jadwal($kd_tahun_ajaran, $kd_prodi) {

        $sql = "SELECT `jadwal`.`kd_jadwal`, `jadwal`.`kd_tahun_ajaran`, `jadwal`.`kd_prodi`,`jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`, `matakuliah`.`sks`, `jadwal`.`kd_ruang`,
`jadwal`.`kd_dosen`, `matakuliah`.`semester_ke`, `matakuliah`.`semester`,`matakuliah`.`prasyarat_mk`, `matakuliah`.`prasyarat_nilai_mk`,
`matakuliah`.`kd_kurikulum`, `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kelas`,`jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kapasitas`,
`dosen`.`nm_dosen`, `dosen`.`NIDN` FROM `jadwal` INNER JOIN `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN `dosen` ON `dosen`.`kd_dosen` = `jadwal`.`kd_dosen`
WHERE `jadwal`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' AND `jadwal`.`kd_prodi` = '" . $kd_prodi . "'";
        $hasil = $this->db->query($sql)->result();

        return ($hasil);
    }

    private function get_krsh($no_krs, $nim) {

        $sql = "SELECT
  `rencanastudih`.`nim`, `rencanastudih`.`ips_sebelumnya` AS `ips`,
  `rencanastudih`.`no_krs`, `rencanastudih`.`semester_ke`,
  `rencanastudih`.`maks_sks`, `rencanastudih`.`nim`, `rencanastudih`.`tgl_krs`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`,
  `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`setujui_pa`,
  `prodi`.`nm_prodi`,prodi.ka_prodi,`rencanastudih`.`tot_sks`
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
                             $datax['kapasitas']=$row->kapasitas;
                            $datax['hari']=$row->hari;
                            $datax['jam']=$row->jam;
                            $datax['status']=$row->status;
                            $datax['no_krs']=$row->no_krs;
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

    private function get_krsd($no_krs) {
        /* $sql = "SELECT
  `rencanastudid`.`no_krs`, `rencanastudid`.`kd_jadwal`,rencanastudid.status,
  `rencanastudid`.`aktif`, `matakuliah`.`nm_mtk`, `matakuliah`.`sks`,
  `matakuliah`.`semester_ke`, `matakuliah`.`kd_kurikulum`,
  `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`,
  `jadwal`.`kd_ruang`, `jadwal`.`kapasitas`, `jadwal`.`kd_mtk`
FROM
  `rencanastudid` INNER JOIN
  `jadwal` ON `rencanastudid`.`kd_jadwal` = `jadwal`.`kd_jadwal` INNER JOIN
  `matakuliah` ON `jadwal`.`kd_mtk` = `matakuliah`.`kd_mtk`
WHERE
  `rencanastudid`.`no_krs` = '".$no_krs."'";*/
        $sql="SELECT rencanastudid.kd_jadwal, jadwal.kelas, no_krs,rencanastudid.status,matakuliah.kd_mtk,jadwal.hari,jadwal.jam,jadwal.kapasitas,matakuliah.nm_mtk,matakuliah.sks,matakuliah.semester_ke,matakuliah.kd_kurikulum,matakuliah.kd_jenis_mtk from rencanastudid,jadwal,matakuliah where rencanastudid.kd_jadwal=jadwal.kd_jadwal and jadwal.kd_mtk=matakuliah.kd_mtk and rencanastudid.no_krs='".$no_krs."'";
       

        $output = $this->db->query($sql)->result();
        return $output;

// echo json_encode($output);
    }

    function setujui_mtk($no_krs,$kd_jadwal) {
        $this->cek();
        $data['status'] = "Ya";
        $key['no_krs'] = $no_krs;
        $key['kd_jadwal'] = $kd_jadwal;
        
        $this->Akademika_model->update_data('rencanastudid', $data, $key);
        redirect(base_url() . 'dosen/ekrs'.'/'.$no_krs);
    }
    function tolak_mtk($no_krs,$kd_jadwal) {
        $this->cek();
        $data['status'] = "Tidak";
        $key['no_krs'] = $no_krs;
        $key['kd_jadwal'] = $kd_jadwal;
        $this->batal_setujui_krsmb($no_krs);
        $this->Akademika_model->update_data('rencanastudid', $data, $key);
        redirect(base_url() . 'dosen/ekrs'.'/'.$no_krs);
    }
    function hapus_mtk($no_krs,$kd_jadwal) {
        $this->cek();
        //$data['status'] = "Tidak";
        $key['no_krs'] = $no_krs;
        $key['kd_jadwal'] = $kd_jadwal;
        //$this->batal_setujui_krsmb($no_krs);
        $this->Akademika_model->delete_data('rencanastudid', $key);
        redirect(base_url() . 'dosen/ekrs'.'/'.$no_krs);
    }
    //operasi setujui krs mahasiswa bimbingan
    function setujui_krsmb($no_krs) {
        $this->cek();
        $data['setujui_pa'] = "Ya";
        $data['tgl_pa_setujui'] = date('Y-m-d H:m:s');
        $key['no_krs'] = $no_krs;
        $datad['status'] = "Ya";
        $this->Akademika_model->update_data('rencanastudih', $data, $key);
        $this->Akademika_model->update_data('rencanastudid', $datad, $key);
        
        redirect(base_url() . 'dosen/lkrsmb');
        
    }

    function batal_setujui_krsmb($no_krs) {
        $this->cek();
        $data['setujui_pa'] = "Tidak";
        $key['no_krs'] = $no_krs;
        $this->Akademika_model->update_data('rencanastudih', $data, $key);
                            $this->session->set_flashdata('msg', '<div class="alert alert-info">
                    <h4>Informasi...!</h4><p> sudah dibatalkan</p>
					</div>');
        //redirect(base_url() . 'dosen/lkrsmb');
    }

    function get_lkrsmb($kd_tahun_ajaran, $kd_dosen) {

        $sql = "SELECT  `rencanastudih`.`kd_tahun_ajaran`,`pah`.`kd_dosen`, `mahasiswa`.`nm_mahasiswa`,
  `mahasiswa`.`angkatan`,concat('62',RIGHT(no_hp,length(no_hp)-1))as no_hp, `rencanastudih`.`setujui_pa`, `pah`.`kd_prodi`,
  `rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`, `rencanastudih`.`nim`
FROM
  `pah` INNER JOIN
  `pad` ON `pad`.`no_pa` = `pah`.`no_pa` INNER JOIN
  `rencanastudih` ON `rencanastudih`.`nim` = `pad`.`nim` INNER JOIN
  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim`
WHERE
  `rencanastudih`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' AND
  `pah`.`kd_dosen` = '" . $kd_dosen . "'";

        $Output = $this->db->query($sql)->result();
        return $Output;
        //echo json_encode($Output);
    }

    //SETUJUI KRS MAHASISWA
    function setujui_krs_mhs($kd_tahun_ajaran, $kd_dosen, $nim) {
        $this->Akademika_model->update_data('');
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