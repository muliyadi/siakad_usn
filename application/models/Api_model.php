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
class Api_model extends CI_Model {
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

   

}

?>
