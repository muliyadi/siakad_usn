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
class Prodi_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

    }

    //result multi row....
   public function get_jumlah_mhs_tak_registrasi($kd_prodi,$kd_tahun_ajaran)
    {
        $sql="SELECT angkatan,count(nim) as jumlah from mahasiswa where nim not in(select nim from registrasi where kd_tahun_ajaran='".$kd_tahun_ajaran."') and (status<>'L' and status<>'C' and status<>'D' and status<>'K') and kd_prodi='".$kd_prodi."'group by angkatan";
         $hasil = $this->db->query($sql)->result_array();
        echo json_encode($hasil);
        return $hasil;
    }
    function get_jumlah_mhs_cuti($kd_prodi,$kd_tahun_ajaran)
    {
        $sql="SELECT angkatan,count(registrasi.nim)as jumlah from registrasi,mahasiswa where registrasi.nim=mahasiswa.nim and registrasi.home_base='".$kd_prodi."' and registrasi.kd_tahun_ajaran='".$kd_tahun_ajaran."' and registrasi.jns_registrasi='CUTI' group by angkatan";
         $hasil = $this->db->query($sql)->result_array();
        return $hasil;
    }
    function get_jumlah_mhs_lulus($kd_prodi)
    {
        $sql="SELECT angkatan,count(*)as jumlah from mahasiswa,wisudawan  where mahasiswa.nim=wisudawan.nim and mahasiswa.kd_prodi='".$kd_prodi."' group by angkatan";
         $hasil = $this->db->query($sql)->result_array();
        return $hasil;
    }
    function get_jumlah_mhs_tidak_aktif($kd_prodi)
    {
        $sql="SELECT angkatan,count(*)as jumlah from mahasiswa where mahasiswa.kd_prodi='".$kd_prodi."' and mahasiswa.status='T' group by angkatan";
         $hasil = $this->db->query($sql)->result_array();
        return $hasil;
    }
    function get_jumlah_mhs_status($kd_prodi)
    {
        $sql="SELECT status,count(nim)as jumlah from mahasiswa where kd_prodi='".$kd_prodi."' group by status";
         $hasil = $this->db->query($sql)->result_array();
        return $hasil;
    }
    function get_fakultas_by_nim($nim)
    {
        $sql="select nim,nm_fak,nm_prodi from mahasiswa,prodi,fakultas where mahasiswa.kd_prodi=prodi.kd_prodi and prodi.kd_fak=fakultas.kd_fak and nim='".$nim."'";
           $hasil = $this->db->query($sql)->row();
        return $hasil;
    }
    function get_all($table)
    {
        return $this->db->get($table)->result();
    }
    function get_all_asc($table,$field)
    {
         $this->db->order_by($field, 'ASC');
        return $this->db->get($table)->result();
    }
    function get_all_desc($table,$field)
    {
         $this->db->order_by($field, 'DESC');
        return $this->db->get($table)->result();
    }

    function get_row_selected($table,$data)
    {
        
        $output=false;
        
            $hasil=$this->db->get_where($table, $data)->row();
        if($hasil)
        {
            $output= $hasil;
        }return $output;
       

              
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

 function get_rekap_ips_ta($kd_tahun_ajaran,$kd_prodi)
{
   $sqlips = "SELECT angkatan,nm_mahasiswa,nilai_ukt,rencanastudih.kd_tahun_ajaran,`rencanastudih`.`nim`, `rencanastudih`.`no_krs`, Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`) AS `total_bobot`, Sum(`matakuliah`.`sks`) as jumlah_sks,Sum(`matakuliah`.`sks` *
`mnilai`.`nilai_a`)/ Sum(`matakuliah`.`sks`) AS `ips` FROM mahasiswa,mnilai, `rencanastudih`,`rencanastudid`,`matakuliah` where rencanastudih.nim=mahasiswa.nim and `rencanastudid`.`no_krs` = `rencanastudih`.`no_krs` and  `matakuliah`.`kd_mtk` = `rencanastudid`.`kd_mtk` and rencanastudid.nilai=mnilai.nilai_h and `rencanastudih`.`kd_tahun_ajaran` = '" . $kd_tahun_ajaran . "' and rencanastudih.kd_prodi='".$kd_prodi."' 
GROUP BY  `rencanastudih`.`nim`, `rencanastudih`.`no_krs` order by angkatan asc,ips desc ";
        $hasil = $this->db->query($sqlips)->result();
       
        return $hasil;
       // echo $ips;
}

    public function get_ips($kd_tahun_ajaran,$nim)
{
    $ips=0;
     $sqlips="SELECT `jadwal`.`kd_tahun_ajaran`, `rencanastudi`.`nim`, Sum(`rencanastudi`.`nilai` *
    `matakuliah`.`sks`) AS `total_bobot`, Sum(`matakuliah`.`sks`)as total_sks,Sum(`rencanastudi`.`nilai` * `matakuliah`.`sks`) / Sum(`matakuliah`.`sks`) AS `ips`, `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan` FROM `rencanastudi` INNER JOIN
    `jadwal` ON `jadwal`.`kd_jadwal` = `rencanastudi`.`kd_jadwal` INNER JOIN `matakuliah` ON `matakuliah`.`kd_mtk` = `jadwal`.`kd_mtk` INNER JOIN `mahasiswa` ON `mahasiswa`.`nim` = `rencanastudi`.`nim` WHERE `rencanastudi`.`nim` = '".$nim."' and `jadwal`.`kd_tahun_ajaran`='" .$kd_tahun_ajaran."' GROUP BY `mahasiswa`.`nm_mahasiswa`, `mahasiswa`.`angkatan`";
    $hasil=$this->db->query($sqlips)->result();
    if($hasil)
    {
        foreach ($hasil as $key) {
            # code...
            $ips=$key->ips;
        }
        
    }

  return $ips;
}
 function get_ipk($nim,$kd_ta) {
       $sql = "SELECT  `rencanastudih`.`nim`, Sum(`rencanastudid`.`sks` *  mnilai.nilai_a) / Sum(`rencanastudid`.`sks`) AS `ipk`
        FROM `rencanastudid`, `rencanastudih`,mnilai where `rencanastudih`.`no_krs` = `rencanastudid`.`no_krs` and rencanastudid.nilai=mnilai.nilai_h  and kd_tahun_ajaran<$kd_ta
        GROUP BY `rencanastudih`.`nim` HAVING `rencanastudih`.`nim` = '" . $nim . "'";
         $output = $this->db->query($sql)->row();
        //return $output;
       // $hasil=array();
        if (!$output)
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
