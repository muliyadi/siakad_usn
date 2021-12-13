<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Akademika_model
 *
 * @author abd_salam
 */
class Akademika_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

    }
     function rule_maks_sks($ips) {
        $maks = 24;

		if ($ips >= 3.0 and $ips <= 4.0) {
            $maks = 24;}
		elseif ($ips >= 2.75 and $ips <= 2.99) {
            $maks = 22;
        } 
		elseif ($ips >= 2.50 and $ips <= 2.74) {
            $maks = 20;
        }
		elseif ($ips > 0 and $ips <= 2.49) {
            $maks = 18;
        }
	

        
       // echo json_encode($maks);
        return $maks;
    }
    
    function get_kalender_akademik($kd_ta)
    {
        $sql="SELECT kd_tahun_ajaran,jadwalakademik.kd_kegiatan,kegiatanakademik.nm_kegiatan,dari_tanggal,sampai_tanggal,aktif FROM `jadwalakademik`,kegiatanakademik where jadwalakademik.kd_kegiatan=kegiatanakademik.kd_kegiatan and kd_tahun_ajaran='".$kd_ta."'";
         $output = $this->db->query($sql)->result();
        return $output;
    }
    function get_jadwal($kd_jadwal)
    {
        $sql="select jadwal.*,matakuliah.nm_mtk,matakuliah.semester_ke from jadwal,matakuliah where jadwal.kd_mtk=matakuliah.kd_mtk and jadwal.kd_jadwal='".$kd_jadwal."'";
        $output = $this->db->query($sql)->row(); 
       return $output;
       // echo json_encode($output);
    }
     public function get_list_mhs_kelas($kd_jadwal) {

        $sql = "SELECT mahasiswa.no_hp,nilai_angka, `rencanastudid`.`kd_jadwal`, `rencanastudih`.`nim`, `rencanastudih`.`no_krs`, `rencanastudid`.`nilai`,  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`
FROM  `rencanastudih` INNER JOIN  `rencanastudid` ON `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs`
  INNER JOIN  `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudih`.`nim`  where `rencanastudid`.`kd_jadwal`='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->result();
        return $output;
    }
    public function get_jadwal_mtk($kd_jadwal) {
        $sql = "SELECT dosen.nm_dosen,dosen.NIDN,`jadwal`.`kd_jadwal`, `jadwal`.`kd_mtk`, `matakuliah`.`nm_mtk`,`jadwal`.`kd_dosen`, `matakuliah`.`sks`, `matakuliah`.`semester_ke`,`jadwal`.`kelas`, `jadwal`.`hari`, `jadwal`.`jam`, `jadwal`.`kd_ruang` FROM  `jadwal` INNER JOIN  `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` inner join dosen on jadwal.kd_dosen=dosen.kd_dosen WHERE `jadwal`.`kd_jadwal` ='" . $kd_jadwal . "'";
        $output = $this->db->query($sql)->row();
        return $output;
    }
    
    public function ljd($kd_jadwal)
    {
        $sql="SELECT jadwal_dosen.kd_jadwal,jadwal_dosen.dosen_ke,jadwal_dosen.kd_dosen,dosen.nm_dosen,dosen.NIDN,dosen.jafung,jumlah_sks FROM `jadwal_dosen`,dosen where jadwal_dosen.kd_dosen=dosen.kd_dosen and jadwal_dosen.kd_jadwal='".$kd_jadwal."'";
        $hasil = $this->db->query($sql)->result();
       // echo json_encode($hasil);
        return($hasil);
    }

//modul skripsi

public function get_jumlah_mhs_bimbingan_by_prodi($kd_prodi)
{
   $sql="SELECT angkatan, pembimbing,nm_dosen,jafung,COUNT(*)AS jumlah from daftar_judul,pembimbing_skripsi,dosen,mahasiswa where mahasiswa.nim=daftar_judul.nim and daftar_judul.no_daftar=pembimbing_skripsi.no_daftar and pembimbing_skripsi.pembimbing=dosen.kd_dosen and dosen.kd_prodi='".$kd_prodi."' GROUP BY angkatan,pembimbing order by nm_dosen,angkatan asc";
    $output = $this->db->query($sql)->result();
    return $output;
    
}
public function get_jumlah_pengujian_dosen($kd_prodi,$ta)
{
    $sql="SELECT penguji.penguji,dosen.NIDN,nm_dosen,jafung,angkatan,COUNT(*) as jumlah from daftar,penguji,dosen,mahasiswa where penguji.no_daftar=daftar.no_daftar and penguji.penguji=dosen.kd_dosen and daftar.nim=mahasiswa.nim and daftar.kd_tahun_ajaran='".$ta."' and daftar.kd_prodi='".$kd_prodi."' group by penguji.penguji,angkatan order by nm_dosen,angkatan asc";
     $output = $this->db->query($sql)->result();
    return $output;
}
public function get_mhs_blm_judul($kd_prodi,$angkatan,$status)
{
    $sqlbelum="SELECT mahasiswa.nim,mahasiswa.nm_mahasiswa,mahasiswa.angkatan from mahasiswa where angkatan='".$angkatan."' and nim not IN (SELECT nim from daftar_judul) and kd_prodi='".$kd_prodi."'";
    $sqlsudah="SELECT mahasiswa.nim,mahasiswa.nm_mahasiswa,mahasiswa.angkatan,judul from mahasiswa,daftar_judul where mahasiswa.nim=daftar_judul.nim and angkatan='".$angkatan."' and mahasiswa.nim IN(SELECT nim from daftar_judul) and mahasiswa.kd_prodi='".$kd_prodi."'";
    if($status=='sudah')
    {
        $hasil = $this->db->query($sqlsudah)->result();
    }else
    {
        $hasil = $this->db->query($sqlbelum)->result();
    }
    
    
    return $hasil;
}
public function get_all_angkatan()
{
    $sql="select distinct tahun from angkatan";
     $hasil = $this->db->query($sql)->result();
        return $hasil;
}
public function get_akm_prodi($kd_prodi,$angkatan, $kd_tahun_ajaran) {
      // $ips = 0;
        $sql = "SELECT `rencanastudih`.`nim`,nm_mahasiswa,angkatan, rencanastudih.kd_tahun_ajaran,Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`)/ Sum(`matakuliah`.`sks`) AS `ips` FROM mnilai, `rencanastudih`,mahasiswa,`rencanastudid`,`matakuliah` where rencanastudih.nim=mahasiswa.nim and `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs` and  `matakuliah`.`kd_mtk` = `rencanastudid`.`kd_mtk` and rencanastudid.nilai=mnilai.nilai_h and `rencanastudih`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' and angkatan='".$angkatan."' and  `rencanastudih`.`kd_prodi` = '" . $kd_prodi . "'
GROUP BY  `rencanastudih`.`nim`, `rencanastudih`.`no_krs` order by angkatan,nim asc";
        $hasil = $this->db->query($sql)->result();
       
        
       
        //echo json_encode($hasil);
        return $hasil;
    }
    
function get_transkrip_nilai_ta($nim,$ta_awal,$ta_akhir)
    {
    
       // $sql="SELECT rencanastudih.kd_tahun_ajaran, rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudih.kd_tahun_ajaran>='".$ta_awal."' and rencanastudih.kd_tahun_ajaran<='".$ta_akhir."' and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai`  order by matakuliah.semester_ke asc";
        //$sql="SELECT rencanastudih.kd_tahun_ajaran, matakuliah.kd_kurikulum,rencanastudid.no_krs,rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudid.aktif='Ya' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai` and rencanastudih.kd_tahun_ajaran>='".$ta_awal."' and rencanastudih.kd_tahun_ajaran<='".$ta_akhir."'  order by matakuliah.semester_ke,nm_mtk asc";
         $sql="select * from vnilai_transkrip WHERE vnilai_transkrip.nim='".$nim."' and vnilai_transkrip.kd_tahun_ajaran>='".$ta_awal."' and vnilai_transkrip.kd_tahun_ajaran<='".$ta_akhir."'  order by semester_ke,nm_mtk asc";
        
         $output = $this->db->query($sql)->result();
            return $output;
        
    //    echo json_encode($output);
    }
    
function get_hkhs($no_krs) {
        $sql = "SELECT
  `rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`, `rencanastudih`.`nim`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`,
  `prodi`.`nm_prodi`, `rencanastudih`.`kd_tahun_ajaran`,
  `rencanastudih`.`semester_ke`, `rencanastudih`.`maks_sks`,
  `rencanastudih`.`tot_sks`, `thnajaran`.`tahun_ajaran`, `thnajaran`.`semester`,
  rencanastudih.qrcode
FROM
  `rencanastudih` INNER JOIN
  `mahasiswa` ON `rencanastudih`.`nim` = `mahasiswa`.`nim` INNER JOIN
  `prodi` ON `mahasiswa`.`kd_prodi` = `prodi`.`kd_prodi` INNER JOIN
  `thnajaran` ON `thnajaran`.`kd_tahun_ajaran` =
    `rencanastudih`.`kd_tahun_ajaran` 
WHERE
  rencanastudih.no_krs='" . $no_krs . "'";
        $output = $this->db->query($sql)->row();

        return $output;
    }
    function get_khs_by_ta($ta,$nim) {
        $sql = "SELECT
  `rencanastudih`.`no_krs`, `rencanastudih`.`tgl_krs`, `rencanastudih`.`nim`,
  `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`, `mahasiswa`.`kd_prodi`,
  `prodi`.`nm_prodi`, `rencanastudih`.`kd_tahun_ajaran`,
  `rencanastudih`.`semester_ke`, `rencanastudih`.`maks_sks`,
  `rencanastudih`.`tot_sks`, `thnajaran`.`tahun_ajaran`, `thnajaran`.`semester`,
  `pah`.`kd_dosen`, `dosen`.`nm_dosen`, `dosen`.`NIDN`
FROM
  `rencanastudih` INNER JOIN
  `mahasiswa` ON `rencanastudih`.`nim` = `mahasiswa`.`nim` INNER JOIN
  `prodi` ON `mahasiswa`.`kd_prodi` = `prodi`.`kd_prodi` INNER JOIN
  `thnajaran` ON `thnajaran`.`kd_tahun_ajaran` =
    `rencanastudih`.`kd_tahun_ajaran` INNER JOIN
  `pad` ON `pad`.`nim` = `rencanastudih`.`nim` INNER JOIN
  `pah` ON `pah`.`no_pa` = `pad`.`no_pa` INNER JOIN
  `dosen` ON `dosen`.`kd_dosen` = `pah`.`kd_dosen`
WHERE
  rencanastudih.nim='" . $nim . "' and rencanastudih.kd_tahun_ajaran='" . $ta . "'";
        $output = $this->db->query($sql)->row();
 //echo json_encode ($output);
        return $output;
    }
    function get_dkhs_edom($no_krs) {
      
         $sql = "SELECT rencanastudid.kd_jadwal,`rencanastudid`.`no_krs`,jadwal.kelas, `rencanastudid`.`aktif`, right(`rencanastudid`.`kd_mtk`,length(rencanastudid.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,`matakuliah`.`nm_mtk`, `matakuliah`.`semester_ke`, `matakuliah`.`sks`,
		`rencanastudid`.`nilai`, `mnilai`.`nilai_a` as nilai_a FROM `rencanastudid` INNER JOIN `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudid`.`kd_jadwal`  inner JOIN matakuliah on matakuliah.kd_mtk=jadwal.kd_mtk inner JOIN
		`mnilai` ON `mnilai`.`nilai_h` = `rencanastudid`.`nilai` WHERE `rencanastudid`.`no_krs` = '" . $no_krs . "' ";
        $output = $this->db->query($sql)->result();
        if($output){
            return  $output;
        }
        else{
            return false;
        }
    }
  function get_dkhs($no_krs) {
      
         $sql = "SELECT rencanastudid.kd_jadwal,`rencanastudid`.`no_krs`,jadwal.kelas, `rencanastudid`.`aktif`, right(`rencanastudid`.`kd_mtk`,length(rencanastudid.kd_mtk)-length(matakuliah.kd_kurikulum)-1) as kd_mtk,`matakuliah`.`nm_mtk`, `matakuliah`.`semester_ke`, `matakuliah`.`sks`,
		`rencanastudid`.`nilai`, `mnilai`.`nilai_a` as nilai_a FROM `rencanastudid` INNER JOIN `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudid`.`kd_jadwal`  inner JOIN matakuliah on matakuliah.kd_mtk=jadwal.kd_mtk inner JOIN
		`mnilai` ON `mnilai`.`nilai_h` = `rencanastudid`.`nilai`  WHERE `rencanastudid`.`no_krs` = '" . $no_krs . "' order by matakuliah.nm_mtk asc ";
        $output = $this->db->query($sql)->result();

       return  $output;
    }
     function get_pa($nim)
    {
        $sql="SELECT  `pad`.`nim`, `pah`.`kd_dosen`, `dosen`.`NIDN`, `dosen`.`nm_dosen` FROM
  `pah` LEFT JOIN `pad` ON `pad`.`no_pa` = `pah`.`no_pa` LEFT JOIN `dosen` ON `dosen`.`kd_dosen` = `pah`.`kd_dosen`
    WHERE `pad`.`nim` = '".$nim."'";
        $output = $this->db->query($sql)->row();
        return $output;
    }
    
function acak($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
function acak2($panjang)
{
    $karakter= '1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}


    //result multi row....

    function get_all($table)
    {
        return $this->db->get($table)->result();
    }
    function get_all_desc($table,$key)
    {
        $this->db->order_by($key, 'DESC');
        return $this->db->get($table)->result();
    }
    function get_all_asc($table,$key)
    {
        $this->db->order_by($key, 'ASC');
        return $this->db->get($table)->result();
         
    }
    
 

    function get_row_selected($table,$data)
    {
        
        $output=false;
            $hasil=$this->db->get_where($table, $data)->row();
            if($hasil)
            {
                $output=$hasil;
            }
       

            return $output;        
    }
    function get_data_prodi($kd_prodi)
    {
        $sql="select prodi.kd_prodi,nm_prodi,nm_fak,ka_prodi,email,web from prodi,fakultas where prodi.kd_fak=fakultas.kd_fak and kd_prodi='".$kd_prodi."'";
          $output = $this->db->query($sql)->row();
        return $output;
        
    }
      
    function get_all_khs_nim($nim)
    {
        $sql="SELECT `rencanastudih`.`kd_tahun_ajaran`, `rencanastudih`.`semester_ke`, `rencanastudih`.`tot_sks`,`rencanastudih`.`ips_sebelumnya`, `rencanastudih`.`maks_sks`, `rencanastudih`.`no_krs`, `rencanastudih`.`nim` FROM `rencanastudih`
            WHERE `rencanastudih`.`nim` = '".$nim."'";
              $output = $this->db->query($sql)->result();
            return $output;
    }
    
     function get_list_mhs_bimbingan($kd_dosen,$homebase) {
        $sql = "SELECT `pad`.`nim`, `pah`.`kd_dosen`, `mahasiswa`.`nm_mahasiswa`,`mahasiswa`.`jns_kelamin`, `mahasiswa`.`angkatan`, `mahasiswa`.`agama`,mahasiswa.status,mahasiswa.no_hp
			FROM `pah` INNER JOIN `pad` ON `pad`.`no_pa` = `pah`.`no_pa` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `pad`.`nim` WHERE `pah`.`kd_dosen` = '" . $kd_dosen . "' and mahasiswa.status<>'L' and pah.kd_prodi='".$homebase."' order by angkatan,nm_mahasiswa asc" ;
        $output = $this->db->query($sql)->result();
        return $output;
    }
 function get_krsh($no_krs) {

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
  
  `rencanastudih`.`no_krs` = '".$no_krs."'";

        $output = $this->db->query($sql)->row();

        return $output;
// echo json_encode($output);
    }
    function get_krsd($no_krs) {
        $sql = "SELECT
  `rencanastudid`.`no_krs`, `rencanastudid`.`kd_jadwal`,rencanastudid.status,
  `rencanastudid`.`aktif`, `matakuliah`.`nm_mtk`, `matakuliah`.`sks`,
  `matakuliah`.`semester_ke`, `matakuliah`.`kd_kurikulum`,
  `matakuliah`.`kd_jenis_mtk`, `jadwal`.`kd_dosen`, `jadwal`.`kelas`,`jadwal`.`hari`, `jadwal`.`jam`,
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
    
    function get_transkrip_nilai($nim)
    {
    
        $sql="SELECT rencanastudih.kd_tahun_ajaran,  rencanastudid.no_krs,rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk, matakuliah.kd_kurikulum,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudid.aktif='Ya' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai` order by matakuliah.semester_ke,matakuliah.kd_mtk asc";
         $output = $this->db->query($sql)->result();
            return $output;
        
    //    echo json_encode($output);
    }
 function get_list_selected_report($table,$data)
     {
        return $this->db->get_where($table, $data);
     }
          function get_list_selected_asc($table,$data,$field) 
     {
         $this->db->order_by($field, 'ASC');
        return $this->db->get_where($table, $data)->result();
     }
     function get_list_selected_desc($table,$data,$field) 
     {
         $this->db->order_by($field, 'DESC');
        return $this->db->get_where($table, $data)->result();
     }
     
	 //output berupa array
     function get_list_selected($table,$data) 
     {
        return $this->db->get_where($table, $data)->result();
     }
    
    function update_data($table,$data,$field_key)
    {
        $status=FALSE;
        try {
            $this->db->update($table,$data,$field_key);
            $status=TRUE;
        
        } catch (Exception $e) {
            
        }
            return $status;
        }


    function save_data($table,$data){
      
       
       $status=FALSE;
        try {
            $this->db->insert($table, $data);
            $status=TRUE;
        
        } catch (Exception $e) {
            
        }
        return $status;
    }
    
    function replace_data($table,$data,$filter){
      
       
       $status=FALSE;
            $hasil=$this->db->get_where($table,$filter)->row();
            if($hasil)
            {
                $this->db->update($table, $data,$filter);
                $status=true;
            }else{
                $this->db->insert($table, $data);
                $status=true;
            }
            
         
        return $status;
    }

    function delete_data($table,$data)
    {
        $status=FALSE;
        try {
            $this->db->delete($table,$data);
            $status=TRUE;
        
        } catch (Exception $e) {
            
        }
        return $status;
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
public function get_ipkxxx($nim,$kd_ta) {
       
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
     function get_ipk($nim,$kd_ta) {
       $sql = "SELECT `rencanastudih`.`nim`, Sum(`rencanastudid`.`sks`) as jum_sks,Sum(`rencanastudid`.`sks` * mnilai.nilai_a) / Sum(`rencanastudid`.`sks`) AS `ipk` FROM `rencanastudid`, `rencanastudih`,mnilai where `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs` and rencanastudid.nilai=mnilai.nilai_h and kd_tahun_ajaran<'".$kd_ta."' and nim='".$nim."' GROUP BY `rencanastudih`.`nim` ";
         $output = $this->db->query($sql)->row();
        //return $output;
       // $hasil=array();
       if(!$output)
        {
            $hasil=0;
            
        }else
        {
            $hasil=$output->ipk;
        }
       return($hasil);
      // echo json_encode($hasil);
    }
public function createNo($format,$kd_prodi)
  {
    $q = $this->db->query("select MAX(RIGHT(no_pa,4)) as kd_max from pah");
    $kd = "";
    if($q->num_rows()>0)
    {
      foreach($q->result() as $k)
      {
        $tmp = ((int)$k->kd_max)+1;
        $kd = sprintf("%04s", $tmp);
      }
    }
    else
    {
      $kd = "0001";
    } 
    return 'PA'.$kd_prodi.$kd;
  }
  public function createNoDO($kd_prodi)
  {
    $q = $this->db->query("select MAX(RIGHT(no_do,4)) as kd_max from doh");
    $kd = "";
    if($q->num_rows()>0)
    {
      foreach($q->result() as $k)
      {
        $tmp = ((int)$k->kd_max)+1;
        $kd = sprintf("%04s", $tmp);
      }
    }
    else
    {
      $kd = "0001";
    } 
    return 'DO'.$kd_prodi.$kd;
  }
  
  public function createNoYudisium($kd_prodi,$ta) {
        $q = $this->db->query("select MAX(RIGHT(no_daftar,4)) as kd_max from yudisium");
        $kd = "";
        $ta=substr($ta,-3);
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return 'NY' . $kd_prodi .$ta. $kd;
    }
    public function get_ipk_mhsx($nim,$kd_tahun_ajaran)
    {
        $ipk=$this->Akademika_model->get_ipk($nim,$kd_tahun_ajaran);
        echo json_encode($ipk);
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
    public function get_jum_sks_mhs($nim,$kd_ta) {
       
       $sql = "SELECT  Sum(`rencanastudid`.`sks`) as jum_sks
        FROM `rencanastudid`, `rencanastudih`,mnilai where `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs` and  rencanastudid.nilai=mnilai.nilai_h  and kd_tahun_ajaran<=$kd_ta and nim='".$nim."'
        GROUP BY `rencanastudih`.`nim`";
         $output = $this->db->query($sql)->row();
        if(!$output)
        {
            $hasil=0;
            
        }else
        {
            $hasil=$output->jum_sks;
        }
       return($hasil);
      
    }
public function last_ta_mhs($nim)
{
   
    $kd_tahun_ajaran=null;

    $sql="SELECT distinct `rencanastudi`.`nim`, `jadwal`.`kd_tahun_ajaran` FROM `rencanastudi` INNER JOIN
  `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudi`.`kd_jadwal` WHERE `rencanastudi`.`nim` = '" .$nim."'
ORDER BY `jadwal`.`kd_tahun_ajaran` DESC limit 1";
$hasil=$this->db->query($sql)->result();
if($hasil)
{
    foreach ($hasil as $row) {
      $kd_tahun_ajaran=$row->kd_tahun_ajaran;
    }
}
    return  $kd_tahun_ajaran;
}


//fungsi rekap mahasiswa seluruh status

public function rekap_status_mhs()
{
    $sql="select status,count(nim) as jumlah from mahasiswa  group by status ";
    $hasil=$this->db->query($sql)->result_array();
    echo json_encode($hasil);
}
function rekap_mahasiswa_usn()
{
    $sql="select angkatan,count(nim) as jumlah from mahasiswa  group by angkatan order by angkatan asc";
    $hasil=$this->db->query($sql)->result_array();
    return $hasil;
}
function rekap_mahasiswa_fakultas($kd_fak)
{
    $sql="select angkatan,count(nim) as jumlah from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi and prodi.kd_fak='".$kd_fak."' group by angkatan order by angkatan asc";
    $hasil=$this->db->query($sql)->result_array();
    return $hasil;
}
function rekap_status_mhs_fakultas($kd_fak)
{
    $sql="select status,count(nim) as jumlah from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi and prodi.kd_fak='".$kd_fak."'  group by status ";
    $hasil=$this->db->query($sql)->result_array();
    return ($hasil);
}
function get_status_mhs_fakultas($kd_fak)
{
    $sql="select prodi.kd_prodi,nim,nm_mahasiswa,NIK,angkatan,status,status_akademik,no_hp from mahasiswa,prodi where mahasiswa.kd_prodi=prodi.kd_prodi and prodi.kd_fak='".$kd_fak."'  order by prodi.kd_prodi,angkatan,nim asc ";
    $hasil=$this->db->query($sql)->result();
    return ($hasil);
}
//fungsi rekap mahasiswa seluruh status
function rekap_mahasiswa_usn_aktif_ta($kd_tahun_ajaran)
{
    $sql="select mahasiswa.angkatan,count(registrasi.nim)as jumlah from registrasi,mahasiswa where registrasi.nim=mahasiswa.nim and kd_tahun_ajaran='".$kd_tahun_ajaran."' and jns_registrasi='P03' group by angkatan";
    $hasil=$this->db->query($sql)->result_array();
    return $hasil;
}
public function get_sks_semester($nim,$kd_ta)
    {
        $sql = "SELECT  Sum(`rencanastudid`.`sks`) as jum_sks
        FROM `rencanastudid`, `rencanastudih`,mnilai where `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs` and  rencanastudid.nilai=mnilai.nilai_h  and kd_tahun_ajaran=$kd_ta and nim='".$nim."'
        GROUP BY `rencanastudih`.`nim`";
         $output = $this->db->query($sql)->row();
        if(!$output)
        {
            $hasil=0;
            
        }else
        {
            $hasil=$output->jum_sks;
        }
       return($hasil);
    }
function rekap_mahasiswa_usn_cuti_ta($kd_tahun_ajaran)
{
    $sql="select mahasiswa.angkatan,count(registrasi.nim)as jumlah from registrasi,mahasiswa where registrasi.nim=mahasiswa.nim and kd_tahun_ajaran='".$kd_tahun_ajaran."' and jns_registrasi='CUTI' group by angkatan";
    $hasil=$this->db->query($sql)->result_array();
    return $hasil;
}
function rekap_mahasiswa_usn_tak_aktif_ta($kd_tahun_ajaran)
{
    $sql="select mahasiswa.angkatan,count(nim)as jumlah from mahasiswa where nim not in (select nim from registrasi where kd_tahun_ajaran='".$kd_tahun_ajaran."') group by angkatan";
    $hasil=$this->db->query($sql)->result_array();
    return $hasil;
}
function rekap_mahasiswa_usn_lulus()
{
    $sql="select angkatan,count(nim)as jumlah from mahasiswa where status='L' group by angkatan";
    $hasil=$this->db->query($sql)->result_array();
    return $hasil;
}

}

?>
