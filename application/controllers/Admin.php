<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function index()
	{
		checkLogin();
		$data['id_router'] = null;
		$data['data_router'] = array('id_router'=> null);
		$data['username_'] = $_COOKIE['username_'];
		$this->load->view('home',$data);
	}

	public function change_password(){
		checkLogin();
		$data['username_'] = $_COOKIE['username_'];
		$this->load->view('change-password',$data);
	}

	public function setting(){
		checkLogin();
		$data['username_'] = $_COOKIE['username_'];
		$this->load->view('setting',$data);
	}

	public function client($subUrl=null){
		checkLogin();
		$data['username_'] = $_COOKIE['username_'];

		switch (strtolower($subUrl??'')) {
			case 'payment':
				$this->load->view('@client/payment',$data);
				break;
			case 'jenis':
				$this->load->view('@client/jenis',$data);
			break;
			case 'bandwith':
				$this->load->view('@client/bandwith',$data);
			break;
			default:
			$this->load->view('@client/client',$data);
			break;
		}
	}

	public function jenis(){
		checkLogin();
		$data['username_'] = $_COOKIE['username_'];
		$this->load->view('jenis',$data);
	}

	public function about(){
		checkLogin();
		$data['username_'] = $_COOKIE['username_'];
		$this->load->view('about',$data);
	}

	public function login()
	{
		if (isset($_COOKIE['id_admin'])) {
			redirect('admin/index');
		} else {
			$this->load->view('login');
		}
	}

	public function print()
	{
		checkLogin();
		$this->load->view("print-standart");
	}


	public function proccessLogin()
	{

		$token       = $this->input->post('_token');
		$username    = $this->input->post('_username');
		$password    = $this->input->post('_password');

		validateToken($token);

		$response['result']  = false;
		$response['id_admin'] = null;

		if ($username != null && $password != null) {

			$admin = new JSONAdmin;

			$data = $admin->read();
			$data = json_decode($data);

			if ($username === $data->username_){
				if ($password === $data->password_){
					$response['id_admin'] = $data->id_admin;
					$response['result'] = true;
				}
			}
		} else {
			$response['result'] = '404';
		}
		echo json_encode($response);
	}


	public function checkLogin()
	{
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');

		validateToken($token);

		if ($id_admin != null) {
			$result = false;

			if (isset($_COOKIE['id_admin'])){	
				if ($_COOKIE['id_admin']===$id_admin){
					$result = true;
				}
			}

			if ($result) {
				echo "T";
			} else {
				echo "F";
			}
		} else {
			echo "404";
		}
	}

	public function updateRouter()
	{
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$router_name  = $this->input->post('_router_name');
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$id_admin  = $this->input->post('_id_admin');
		$port  = $this->input->post('_port');
		$id_router  = $this->input->post('_id_router');

		validateToken($token);

		if ($id_admin != null  && $router_name != null && $ip_address != null && $username != null && $id_router != null) {
			if ($port == null) {
				$port = 8728;
			}
			$this->load->model('M_router');
			$this->M_router->id_admin = $id_admin;
			$this->M_router->username_ = $username;
			$this->M_router->password_ = $password;
			$this->M_router->router_name = $router_name;
			$this->M_router->ip_address = $ip_address;
			$this->M_router->port_api = $port;
			$this->M_router->id_router = $id_router;

			$result = $this->M_router->updateData();

			if ($result) {
				echo "T";
			} else {
				echo "F";
			}
		} else {
			echo "404";
		}
	}



	public function saveRouter()
	{
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$router_name  = $this->input->post('_router_name');
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$id_admin  = $this->input->post('_id_admin');
		$port  = $this->input->post('_port');

		validateToken($token);

		if ($id_admin != null  && $router_name != null && $ip_address != null && $username != null) {
			if ($port == null) {
				$port = 8728;
			}

			$json = new JSONHelper();

			$encrypt = new EncryptDecrypt;

			$encrypt->setString($username);
			$username = $encrypt->encrypt();

			$encrypt->setString($password);
			$password = $encrypt->encrypt();

			$encrypt->setString($router_name);
			$router_name = $encrypt->encrypt();

			$encrypt->setString($ip_address);
			$ip_address = $encrypt->encrypt();

			$encrypt->setString($port);
			$port = $encrypt->encrypt();

			$id_router = _randomStr(25);

			$json->setData(
				array(
					'username_' => $username, 'password_' => $password,
					'router_name' => $router_name, 'ip_address' => $ip_address, 'port_api' => $port,
					'id_router' => $id_router
				)
			);
			$json->setFileName($id_admin);

			// check file terlebih dahulu
			if (!$json->checkFile()) {
				$json->create();
			}

			$json->read();

			$result = $json->addItem();

			if ($result) {
				echo "T";
			} else {
				echo "F";
			}
		} else {
			echo "404";
		}
	}

	public function cleanDataRouterJson(){
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');

		validateToken($token);

		if ($id_admin != null) {
			$json = new JSONHelper;
			$json->setFileName($id_admin);
			
			if ($json->checkFile()) {
				$json->clean();
				echo 'T';
			}else{
				echo 'F';
			}
		} else {
			echo "404";
		}
	}

	public function clearDataRouterJson(){
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');

		validateToken($token);

		if ($id_admin != null) {
			$json = new JSONHelper;
			$json->setFileName($id_admin);
			
			if ($json->checkFile()) {
				$json->clear();
				echo 'T';
			}else{
				echo 'F';
			}
		} else {
			echo "404";
		}
	}

	public function loadDataRouterNew()
	{
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');

		validateToken($token);

		if ($id_admin != null) {
			$json = new JSONHelper;
			$json->setFileName($id_admin);
			
			if ($json->checkFile()) {
				
				echo $json->read();
			} else {
				$json->create();
				echo 'EMPTY';
			}
		} else {
			echo "404";
		}
	}

	public function searchRouter(){
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');
		$query  = $this->input->post('_query');
		

		validateToken($token);

        if (isset($_COOKIE['id_admin'])) {
			$json = new JSONHelper;

			$json->setFileName($id_admin);

			$data = $json->read();
			$data = json_decode($data);

			$result= null;
			$index = 0;

			$query = strtolower($query);

			for ($i=0; $i < count($data); $i++) { 
				$obj = $data[$i];
				$ip = $obj->{'ip_address'};
				$ip = strtolower($ip);
				
				$router_name = $obj->{'router_name'};
				$router_name = strtolower($router_name);

				if (strstr( $ip, $query)){
					$result[$index]=($data[$i]);
					$index++;
				}
				else if (strstr( $router_name, $query)){
					$result[$index]=($data[$i]);
					$index++;
				}
			}
			echo json_encode($result);
        }else{
			echo '404';
		}
	}

	public function changePassword(){
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');
		$new_username  = $this->input->post('_new_username');
		$new_password  = $this->input->post('_new_password');

		validateToken($token);

		if (isset($_COOKIE['id_admin'])) {

			$json = new JSONAdmin;

			$data = array("username_"=>$new_username, "password_"=>$new_password, "id_admin"=>$id_admin);
			
			$json->setData(
				$data
			);

			
			$json->convertToJson();

			$json->create();

			echo "T";
		}else{
			echo "F";
		}
	}


	public function deleteRouter()
	{
		checkLoginAjax();

		$token    = $this->input->post('_token');
		$id_admin  = $this->input->post('_id_admin');
		$id_router  = $this->input->post('_id_router');

		validateToken($token);

		if ($id_admin != null) {

			$json = new JSONHelper;		
			$json->setFileName($id_admin);
			$result = $json->delete($id_router);
			if ($result) {
				echo 'T';
			} else {
				echo 'F';
			}
		} else {
			echo "404";
		}
	}

	public function router($id_router = null, $interface = null)
	{
		checkLogin();

		if ($id_router == null) {
			redirect('/admin/index');
			exit;
		}

		$json = new JSONHelper;
		$json->setFileName($_COOKIE['id_admin']);

		$data['router'] = '';
		$data_json = $json->read();

		$data_json = json_decode($data_json);
		
		$match = false;
		for ($i = 0; $i < count($data_json); $i++) {
			$obj = $data_json[$i];

			if ($obj->{"id_router"} === $id_router) {
				$data['id_router'] = $obj->{"id_router"};
				$data['data_router'] = ($obj);
				
				$match = true;
			break;
			} else {
				$match = false;
			}
		}
		
		if (!$match) {
			redirect('/admin/index');
			exit;
		}
		if ($interface == null) {
			$this->load->view("dashboard", $data);
		} else {
			switch ($interface) {
				case 'interface':
					$this->load->view("interface", $data);
					break;
				case 'ipaddress':
					$this->load->view("_ip/ipaddress", $data);
					break;
				case 'iproute':
					$this->load->view("_ip/iproute", $data);
					break;
				case 'ipdns':
					$this->load->view("_ip/ipdns", $data);
					break;
				case 'ipfirewall':
					$this->load->view("_ip/ipfirewall", $data);
					break;
				case 'ippool':
					$this->load->view("_ip/ippool", $data);
					break;
				case 'ipservice':
					$this->load->view("_ip/ipservice", $data);
					break;
				case 'queues':
					$this->load->view("queues", $data);
					break;
				case 'system':
					$this->load->view("_ip/system", $data);
					break;
				case 'useractive':
					$this->load->view("useractives", $data);
					break;
				case 'hotspot-server':
					$this->load->view("_hotspot/server", $data);
					break;
				case 'hotspot-profile-server':
					$this->load->view("_hotspot/server-profiles", $data);
					break;
				case 'hotspot-user-profile':
					$this->load->view("_hotspot/user-profiles", $data);
					break;
				case 'hotspot-user-multiple':
					$this->load->view("_hotspot/user-multiple", $data);
					break;
				case 'hotspot-user-single':
					$this->load->view('_hotspot/user-single',$data);
				break;
				case 'ppp-interface':
					$this->load->view("_ppp/interface", $data);
					break;
				case 'ppp-servers':
					$this->load->view("_ppp/servers", $data);
					break;
				case 'ppp-secrets':
					$this->load->view("_ppp/secrets", $data);
					break;
				case 'ppp-profiles':
					$this->load->view("_ppp/profiles", $data);
					break;
				case 'log':
					$this->load->view('log',$data);
					break;
				case 'files':
					$this->load->view('files',$data);
					break;
				case 'netwatch':
					$this->load->view('netwatch',$data);
					break;
				case 'package':
					$this->load->view('package',$data);
					break;
				case 'wireless-interface':
					$this->load->view('wireless_interface',$data);
					break;
				case 'wireless-registration':
					$this->load->view('wireless_registration',$data);
					break;
				default:
					$this->load->view("dashboard", $data);
					break;
			}
		}
	}

}