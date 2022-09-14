<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jenis extends CI_Model
{
    public $id_jenis;
    public $jenis;

    public function add(){
        $data = array(
            'jenis' => $this->jenis
        );
        return $this->db->insert('t_jenis', $data);
    }


    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('t_jenis');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete(){
        $result = $this->db->delete('t_jenis', 
        array('id_jenis' => $this->id_jenis)); 
        return $result ? true : false;
    }
}