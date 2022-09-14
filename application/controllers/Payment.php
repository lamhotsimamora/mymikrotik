<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function load()
    {
        checkLoginAjax();
        $id_admin  = $this->input->post('_id_admin');
        $token  = $this->input->post('_token');

        __check(array($id_admin));
        validateToken($token);
       
        $this->load->model("M_payment");
        $data = $this->M_payment->getAll();
        echo json_encode($data);
    }

    public function add(){
		checkLoginAjax();
		
		$token  = $this->input->post('_token');
		$jml_pay  = $this->input->post('_jml_pay');
		$id_client  = $this->input->post('_id_client');
		$tgl_bayar  = $this->input->post('_tgl_bayar');

		__check(array($jml_pay,$id_client,$tgl_bayar));
		validateToken($token);

		$this->load->model("M_payment");
		$this->M_payment->jml_pay = $jml_pay;
		$this->M_payment->id_client = $id_client;
		$this->M_payment->tgl_bayar = $tgl_bayar;

		$result = $this->M_payment->add();

		echo $result ? 'T' : 'F';
    }

    public function delete(){
        checkLoginAjax();
		$id_payment  = $this->input->post('_id_payment');
		$token  = $this->input->post('_token');

		__check(array($id_payment));
		validateToken($token);
	
        $this->load->model("M_payment");
        $this->M_payment->id_payment  = $id_payment;
        $data = $this->M_payment->delete();
        
        echo $data ? 'T' : 'F';
    }

}