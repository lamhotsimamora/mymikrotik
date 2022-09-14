<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    public function load()
    {
        checkLoginAjax();
        $id_admin  = $this->input->post('_id_admin');
        $token  = $this->input->post('_token');

        __check(array($id_admin));
        validateToken($token);
    
        $this->load->model("M_jenis");
        $data = $this->M_jenis->getAll();
        echo json_encode($data);
    }

    public function add(){
		checkLoginAjax();
		
		$token  = $this->input->post('_token');
		$jenis  = $this->input->post('_jenis');

		__check(array($jenis));
		validateToken($token);

		$this->load->model("M_jenis");
		$this->M_jenis->jenis = $jenis;

		$result = $this->M_jenis->add();

		echo $result ? 'T' : 'F';
    }
    
    public function delete(){
        checkLoginAjax();
		$id_jenis  = $this->input->post('_id_jenis');
		$token  = $this->input->post('_token');

		__check(array($id_jenis));
		validateToken($token);
	
        $this->load->model("M_jenis");
        $this->M_jenis->id_jenis  = $id_jenis;
        $data = $this->M_jenis->delete();
        
        echo $data ? 'T' : 'F';
    }
    
}