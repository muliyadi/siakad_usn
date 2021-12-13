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
class Mahasiswa_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

    }

    //result multi row....

    function get_all($table)
    {
        return $this->db->get($table)->result();
    }

    function get_row_selected($table,$data)
    {
        

            $hasil=$this->db->get_where($table, $data)->row();
            
       

            return $hasil;        
    }

 function get_list_selected_report($table,$data)
     {
        return $this->db->get_where($table, $data);
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
       $this->db->insert($table, $data);
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

    function get_transkrip_nilai($nim)
    {
    
        $sql="SELECT rencanastudih.kd_tahun_ajaran, rencanastudid.no_krs,rencanastudih.nim, `mnilai`.`nilai_a` as nilai_a,rencanastudid.kd_mtk,matakuliah.nm_mtk,rencanastudid.sks,matakuliah.semester_ke,rencanastudid.nilai,rencanastudid.nilai_angka from rencanastudih,rencanastudid,matakuliah,mnilai WHERE rencanastudih.nim='".$nim."' and rencanastudih.no_krs=rencanastudid.no_krs and rencanastudid.kd_mtk=matakuliah.kd_mtk and `mnilai`.`nilai_h` = `rencanastudid`.`nilai` order by matakuliah.semester_ke asc";
         $output = $this->db->query($sql)->result();
            return $output;
        
    //    echo json_encode($output);
    }
    
    
    public function get_ips($kd_tahun_ajaran,$nim)
{
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
 public function get_rekap_ips($kd_tahun_ajaran,$nim)
{
   $sqlips = "SELECT angkatan,rencanastudih.kd_tahun_ajaran,`rencanastudih`.`nim`, `rencanastudih`.`no_krs`, Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`) AS `total_bobot`, Sum(`matakuliah`.`sks`) as jumlah_sks,Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`)/ Sum(`matakuliah`.`sks`) AS `ips` FROM mahasiswa,mnilai, `rencanastudih`,`rencanastudid`,`matakuliah` where rencanastudih.nim=mahasiswa.nim and `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs` and  `matakuliah`.`kd_mtk` = `rencanastudid`.`kd_mtk` and rencanastudid.nilai=mnilai.nilai_h and `rencanastudih`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' and  `rencanastudih`.`nim` = '" . $nim . "'
GROUP BY  `rencanastudih`.`nim`, `rencanastudih`.`no_krs`";
        $hasil = $this->db->query($sqlips)->row();
       
        return $hasil;
       // echo $ips;
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

function get_berkas_ujian($no_daftar) {
        $sql = "SELECT `daftar`.`no_daftar`, `prodi`.`nm_prodi` FROM `daftar` LEFT JOIN `prodi` ON `daftar`.`kd_prodi` = `prodi`.`kd_prodi` WHERE `daftar`.`no_daftar` = '".$no_daftar."'";
        $hasil = $this->db->query($sql)->result();
        return $hasil;
    }

function rule_maks_sks($ips)
{
  $maks=20;
              if($ips>=1 && $ips<=2.75 )
            {
                $maks=18;    
            }
            elseif($ips>=2.76 && $ips<=3.0)
            {
                 $maks=20;    
            }
            else
            {
                $maks=24;
            }
  return $maks;
}


}

?>
