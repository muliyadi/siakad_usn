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
class Admin_model extends CI_Model {
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
