<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
	
    
	public function load(){
		checkLoginAjax();
		$id_admin  = $this->input->post('_id_admin');
		$token  = $this->input->post('_token');

		__check(array($id_admin));
		validateToken($token);
	
		$this->load->model("M_client");
		$data = $this->M_client->getAll();
		echo json_encode($data);
	}

	public function searchData(){
		checkLoginAjax();
		$id_admin  = $this->input->post('_id_admin');
		$query  = $this->input->post('_query');
		$token  = $this->input->post('_token');

		__check(array($id_admin,$query));
		validateToken($token);
	
		$this->load->model("M_client");
		$this->M_client->nama = $query;
		$data = $this->M_client->searchClient();
		echo json_encode($data);
	}
	
	public function add(){
		checkLoginAjax();
		
		$token  = $this->input->post('_token');
		$nama  = $this->input->post('_nama');
		$id_jenis  = $this->input->post('_id_jenis');
		$tgl_pasang  = $this->input->post('_tgl_pasang');
		$id_bandwith  = $this->input->post('_id_bandwith');

		__check(array($nama,$id_jenis,$tgl_pasang,$id_bandwith));
		validateToken($token);

		$this->load->model("M_client");
		$this->M_client->nama = $nama;
		$this->M_client->id_jenis = $id_jenis;
		$this->M_client->tgl_pasang = $tgl_pasang;
		$this->M_client->id_bandwith = $id_bandwith;

		$result = $this->M_client->add();

		echo $result ? 'T' : 'F';
	}

    public function delete(){
        checkLoginAjax();
		$id_client  = $this->input->post('_id_client');
		$token  = $this->input->post('_token');

		__check(array($id_client));
		validateToken($token);
	
        $this->load->model("M_client");
        $this->M_client->id_client  = $id_client;
        $data = $this->M_client->delete();
        
        echo $data ? 'T' : 'F';
    }
    
}