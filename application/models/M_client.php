<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_client extends CI_Model {

	public $id_client;
    public $nama;
    public $tgl_pasang;
    public $id_jenis;
    public $id_bandwith;


     public function getAll(){
        $this->db->select('*');
        $this->db->from('view_client');
        $this->db->order_by('id_client','desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add(){
        $data = array(
            'nama' => $this->nama,
            'tgl_pasang' => $this->tgl_pasang,
            'id_jenis' => $this->id_jenis,
            'id_bandwith' => $this->id_bandwith
        );

        return $this->db->insert('t_client', $data);
    }

    public function searchClient(){
        $this->db->select('*');
        $this->db->from('view_client');
        $this->db->like('nama',$this->nama);
       
        
        $query = $this->db->get();
        $data  = $query->result();
       
        return $data;
    }
    
    public function update(){
        $this->db->set('nama', $this->nama);
        $this->db->where('id_client', $this->id_client);
        return $this->db->update('t_client'); 
    }
   
    public function delete(){
        $result = $this->db->delete('t_client', 
        array('id_client' => $this->id_client)); 
        return $result ? true : false;
    }

}