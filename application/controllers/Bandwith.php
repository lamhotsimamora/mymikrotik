<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bandwith extends CI_Controller
{
    public function load()
    {
        checkLoginAjax();
        $id_admin  = $this->input->post('_id_admin');
        $token  = $this->input->post('_token');

        __check(array($id_admin));
        validateToken($token);
    
        $this->load->model("M_bandwith");
        $data = $this->M_bandwith->getAll();
        echo json_encode($data);
    }

    public function add(){
		checkLoginAjax();
		
		$token  = $this->input->post('_token');
		$bandwith  = $this->input->post('_bandwith');
		$price  = $this->input->post('_price');

		__check(array($bandwith,$price));
		validateToken($token);

		$this->load->model("M_bandwith");
		$this->M_bandwith->bandwith = $bandwith;
		$this->M_bandwith->price = $price;

		$result = $this->M_bandwith->add();

		echo $result ? 'T' : 'F';
    }

    public function delete(){
        checkLoginAjax();
		$id_bandwith  = $this->input->post('_id_bandwith');
		$token  = $this->input->post('_token');

		__check(array($id_bandwith));
		validateToken($token);
	
        $this->load->model("M_bandwith");
        $this->M_bandwith->id_bandwith  = $id_bandwith;
        $data = $this->M_bandwith->delete();
        
        echo $data ? 'T' : 'F';
    }
}