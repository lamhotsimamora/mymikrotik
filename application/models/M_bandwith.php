<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bandwith extends CI_Model
{
    public $id_bandwith ;
    public $bandwith;
    public $price;

    public function add()
    {
        $data = array(
            'bandwith' => $this->bandwith,
            'price' => $this->price
        );
        return $this->db->insert('t_bandwith', $data);
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('t_bandwith');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete(){
        $result = $this->db->delete('t_bandwith', 
        array('id_bandwith' => $this->id_bandwith)); 
        return $result ? true : false;
    }
}