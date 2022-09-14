<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_payment extends CI_Model
{
    public $id_payment;
    public $id_client;
    public $tgl_bayar;
    public $jml_pay;

    public function add(){
        $data = array(
            'id_client' => $this->id_client,
            'tgl_bayar' => $this->tgl_bayar,
            'jml_pay' => $this->jml_pay
        );
        return $this->db->insert('t_payment', $data);
    }


    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('view_payment');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete(){
        $result = $this->db->delete('t_payment', 
        array('id_payment' => $this->id_payment)); 
        return $result ? true : false;
    }
}