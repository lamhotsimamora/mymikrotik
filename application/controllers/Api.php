<?php
defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{

	private $RouterOS;


	public function __construct()
	{
		parent::__construct();
		$this->RouterOS = new RouterosAPI();
	}


	public function loginRouter()
	{
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port  = $this->input->post('_port');
		
		__check(array($ip_address,$username,$password,$port));

		validateToken($token);
		
		echo json_encode($this->connectRouter($ip_address, $username, $password, $port));
	}

	private function connectRouter($ip_address, $username, $password, $port = 8728)
	{
		try {
			if ($port != null) {
				$this->RouterOS->port = $port;
			}else if ($port==null){
				$this->RouterOS->port = 8728;
			}
			return $this->RouterOS->connect($ip_address, $username, $password,$this->RouterOS->port) ? true : false;
		} catch (Exception $ex) {
			(var_dump($ex));
			return false;
		}
	}


	public function pingRouter()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$token  = $this->input->post('_token');
		$port  = $this->input->post('_port');

		validateToken($token);

		__check(array($ip_address,$port));

		try {
			if ($ip_address != null) {
				$waitTimeoutInSeconds = 1;
				$fp = fsockopen($ip_address, $port, $errCode, $errSt, $waitTimeoutInSeconds);
	
				if ($fp) {
					echo 'T';
				} else {
					echo 'F';
				}
			}
		} catch (\Throwable $th) {
			exit(var_dump($th));
		}
	}

	public function getNetwatch(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));

		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/tool/netwatch/getall'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function disableInterface(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/interface/disable", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function enableInterface(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/interface/enable", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}
	
	public function hotspotServerProfileAdd(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$name  = $this->input->post('_name');
		$hotspot_address  = $this->input->post('_address_hotspot');
		$dns_name  = $this->input->post('_dns');
		$htmldir  = $this->input->post('_htmldir');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$name,$hotspot_address,$dns_name,$htmldir));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/profile/add", array(
				"name"     => $name,
				"hotspot-address" => $hotspot_address,
				"dns-name" => $dns_name,
				"html-directory" => $htmldir,
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function deleteHotspotServerProfile(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/profile/remove", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function deleteQueues(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id_queues  = $this->input->post('_id_queues');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id_queues));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/queue/simple/remove", array(
				"numbers"     => $id_queues
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function interfaceChangeName(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$name = $this->input->post('_name');
		$number = $this->input->post('_number');

		__check(array($ip_address,$username,$password,$port,$name,$number));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/interface/set", array(
				"name"     => $name,
				"numbers"  => $number
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function htmlDirectoryGet(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/file/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			
			echo (json_encode($data));
		} else {
			echo "F";
		}
	}

	public function hotspotServerDelete(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$id = $this->input->post('_id');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/remove", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function hotspotServerAdd(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$name = $this->input->post('_name');
		$interface = $this->input->post('_interface');
		$profile = $this->input->post('_profile');
		$ippool = $this->input->post('_ippool');
		$timeout = $this->input->post('_timeout');

		__check(array($ip_address,$username,$password,$port,$name,$interface,$profile,$ippool,$timeout));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/add", array(
				"name"     => $name,
				"interface" => $interface,
				"profile"=> $profile,
				"address-pool"=> $ippool,
				"idle-timeout"=> $timeout
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function pppServerDelete(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/interface/pppoe-server/server/remove", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function pppServerAdd(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$service_name = $this->input->post('_service_name');
		$interface = $this->input->post('_interface');
		$profile = $this->input->post('_profile');

		__check(array($ip_address,$username,$password,$port,$service_name,$interface,$profile));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/interface/pppoe-server/server/add", array(
				"service-name"     => $service_name,
				"interface" => $interface,
				"default-profile"=> $profile
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function pppSecretDelete(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id_secret  = $this->input->post('_id_secret');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id_secret));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ppp/secret/remove", array(
				"numbers"     => $id_secret
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function pppSecretAdd(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$name = $this->input->post('_name');
		$service = $this->input->post('_service');
		$password_ppp = $this->input->post('_password_ppp');
		$profile = $this->input->post('_profile');

		__check(array($ip_address,$username,$password,$port,$name,$service,$password_ppp,$profile));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ppp/secret/add", array(
				"name"     => $name,
				"service" => $service,
				"password" => $password_ppp,
				"profile" => $profile
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function pppProfilesDelete(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ppp/profile/remove", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}
	public function pppProfilesAdd(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$name = $this->input->post('_name');
		$local = $this->input->post('_local');
		$remote = $this->input->post('_remote');
		$limit = $this->input->post('_limit');

		__check(array($ip_address,$username,$password,$port,$name,$local,$remote,$limit));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ppp/profile/add", array(
				"name"     => $name,
				"local-address" => $local,
				"remote-address" => $remote,
				"rate-limit" => $limit
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function addQueues(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$name = $this->input->post('_name');
		$target = $this->input->post('_target');
		$download = $this->input->post('_download');
		$upload = $this->input->post('_upload');

		__check(array($ip_address,$username,$password,$port,$name,$target,$download,$upload));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/queue/simple/add", array(
				"name"     => $name,
				"target" => $target,
				"max-limit" => $upload.'/'.$download
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function addIpFirewallNat(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
	
		$port = $this->input->post('_port');

		$src = $this->input->post('_src');
		$action = $this->input->post('_action');
		$chain = $this->input->post('_chain');

		__check(array($ip_address,$username,$password,$port,$chain,$src,$action));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/firewall/nat/add", array(
				"chain"     => $chain ,
				"action" => $action,
				"src-address" => $src

			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function enableIpFirewall(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/firewall/nat/enable", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}
	public function disableIpFirewall(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/firewall/nat/disable", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function deleteIpFirewall(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/firewall/nat/remove", array(
				"numbers"     => $id
			));
			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}

	public function getIpService(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));

		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/ip/service/getall'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getPackage(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));

		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/system/package/getall'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function backupRouter(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));

		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/system/backup/save'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo 'T';
		} else {
			echo "F";
		}
	}

	public function getFiles(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));

		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/file/getall'); 
			
			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getLog(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));

		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/log/getall'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getHealthSystem(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/system/health/getall'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getResource(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/system/resource/print'); 

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}
	
	public function testBeep(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/beep'); // /interface/getall

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getInterface()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');
		
		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/interface/getall'); // /interface/getall

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getIpAddress()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/address/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getIpDNS()
	{
		checkLoginAjax();
		
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/dns/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getIpRoute()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password)) {
			$this->RouterOS->write('/ip/route/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getIPFirewall()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/firewall/nat/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getIPPool()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/ip/pool/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getRouterIdentity()
	{
		checkLoginAjax();
		$port = $this->input->post('_port');
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/system/identity/print');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getUsersVoucherByComment(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$comment  = $this->input->post('_comment');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/hotspot/user/comment["'.$comment.'"]/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getServerHotspot()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/hotspot/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getServerProfile()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/hotspot/profile/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}
	public function getUsersVoucher()
	{
		checkLoginAjax();
		
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/hotspot/user/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getUsersHotspotActive()
	{
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ip/hotspot/active/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getQueue()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/queue/simple/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);
			$this->RouterOS->disconnect();
			echo json_encode($data);
		} else {
			echo "F";
		}
	}


	public function deleteServerUserProfiles()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$id_profile  = $this->input->post('_id');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$id_profile));
		validateToken($token);


		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/user/profile/remove", array(
				"numbers"     => $id_profile
			));

			$this->RouterOS->disconnect();

			echo "T";
		} else {
			echo "F";
		}
	}


	public function getServerUserProfiles()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/ip/hotspot/user/profile/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			$this->RouterOS->disconnect();

			echo json_encode($data);
		} else {
			echo "F";
		}
	}
	public function deleteUserVoucher()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');
		$id_user  = $this->input->post('_id_user');
	
		__check(array($ip_address,$username,$password,$port,$id_user));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/user/remove", array(
				"numbers"     => $id_user
			));
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}

	public function deleteIpPool()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');
		$id_pool  = $this->input->post('_id_pool');

		__check(array($ip_address,$username,$password,$port,$id_pool));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/pool/remove", array(
				"numbers"     => $id_pool
			));
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}

	public function deleteIpAddress(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$port = $this->input->post('_port');
		$id_ip  = $this->input->post('_id_ip');

		__check(array($ip_address,$username,$password,$port,$id_ip));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/address/remove", array(
				"numbers"     => $id_ip
			));
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}

	public function addIpAddress()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');

		$interface  = $this->input->post('_interface');
		// ip new data for insert
		$ip  = $this->input->post('_ipaddress');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$ip,$interface));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/address/add", array(
				"address"     => $ip,
				"interface" => $interface
			));
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}

	public function addIpPool()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');

		$name  = $this->input->post('_name');
		$address  = $this->input->post('_address');
		$next_pool  = $this->input->post('_next_pool');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$name,$address));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			if ($next_pool === 'null') {
				$this->RouterOS->comm("/ip/pool/add", array(
					"ranges"     => $address,
					"name"       => $name
				));
			} else {
				$this->RouterOS->comm("/ip/pool/add", array(
					"ranges"     => $address,
					"name" => $name,
					'next-pool' => $next_pool
				));
			}
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}

	public function generateUserVoucher()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');

		$qty  = $this->input->post('_qty');
		$time_limit  = $this->input->post('_time_limit');
		$comment  = $this->input->post('_comment');
		$server  = $this->input->post('_server');
		$profile  = $this->input->post('_profile');
		$length = $this->input->post('_length');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,
			$qty,$time_limit,$comment,$server,$profile,$length));
		validateToken($token);

		$time_limit = $time_limit . 'h';

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			for ($i = 0; $i < $qty; $i++) {
				$username_generate = _randomStr($length);
				$password_generate = _randomStr($length);
				$this->RouterOS->comm("/ip/hotspot/user/add", array(
					'name'     => $username_generate,
					'comment' => $comment,
					'server' => $server,
					'profile' => $profile,
					'password' => $password_generate,
					'limit-uptime' => $time_limit
				));
			}
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}
	public function addUserVoucher()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');

		$time_limit  = $this->input->post('_time_limit');
		$comment  = $this->input->post('_comment');
		$server  = $this->input->post('_server');
		$profile  = $this->input->post('_profile');
		$length = $this->input->post('_length');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$time_limit,$comment,$server,$profile,$length));
		validateToken($token);

		$time_limit = $time_limit . 'h';

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$username_generate = _randomStr($length);
			$password_generate = _randomStr($length);
			$this->RouterOS->comm("/ip/hotspot/user/add", array(
				'name'     => $username_generate,
				'comment' => $comment,
				'server' => $server,
				'profile' => $profile,
				'password' => $password_generate,
				'limit-uptime' => $time_limit
			));
			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}

	public function addUserProfileHotspot()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$token  = $this->input->post('_token');
		$name  = $this->input->post('_name');
		$pool  = $this->input->post('_pool');
		$rate_limit  = $this->input->post('_rate_limit');
		$day  = $this->input->post('_day');
		$port = $this->input->post('_port');

		__check(array($ip_address,$username,$password,$port,$name,$pool,$rate_limit,$day));
		validateToken($token);

		$day = $day . 'd';

		$script = ':put (",rem,0,' . $day . ',,,Disable,"); {:local date [ /system clock get date ]; :local year [ :pick $date 7 11 ]; :local month [ :pick $date 0 3 ]; :local comment [ /ip hotspot user get [/ip hotspot user find where name="$user"] comment]; :local ucode [:pic $comment 0 2]; :if ($ucode = "vc" or $ucode = "up" or $comment = "") do={ /sys sch add name="$user" disable=no start-date=$date interval="' . $day . 'd"; :delay 2s; :local exp [ /sys sch get [ /sys sch find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pic $exp 0 6]; :local t [:pic $exp 7 16]; :local s ("/"); :local exp ("$d$s$year $t"); /ip hotspot user set comment=$exp [find where name="$user"];}; :if ($getxp = 8) do={ /ip hotspot user set comment="$date $exp" [find where name="$user"];}; :if ($getxp > 15) do={ /ip hotspot user set comment=$exp [find where name="$user"];}; /sys sch remove [find where name="$user"]}}';

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->comm("/ip/hotspot/user/profile/add", array(
				"name"             => $name,
				'on-login' => $script,
				'rate-limit' => $rate_limit,
				'address-pool' => $pool
			));

			$this->RouterOS->disconnect();
			echo "T";
		} else {
			echo "F";
		}
	}


	public function rebootRouter()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/system/reboot');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			echo 'T';
		} else {
			echo "F";
		}
	}

	public function getPPPoEProfiles(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ppp/profile/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function reconnectWirelessRegistration(){
		checkLoginAjax();
		 $ip_address  = $this->input->post('_ip_address');
		 $username  = $this->input->post('_username');
		 $password  = $this->input->post('_password');
		 $port = $this->input->post('_port');
		 $token  = $this->input->post('_token');
		 $id  = $this->input->post('_id');
 
		 __check(array($ip_address,$username,$password,$port,$id));
		 validateToken($token);
 
		 if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->comm("/interface/wireless/registration-table/remove", array(
				'numbers'     => $id
			));
 
			$this->RouterOS->disconnect();
			echo 'T';
		 } else {
			 echo "F";
		 }
	}

	public function getWirelessRegistration(){
		checkLoginAjax();
		 $ip_address  = $this->input->post('_ip_address');
		 $username  = $this->input->post('_username');
		 $password  = $this->input->post('_password');
		 $port = $this->input->post('_port');
		 $token  = $this->input->post('_token');
 
		 __check(array($ip_address,$username,$password,$port));
		 validateToken($token);
 
		 if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			 $this->RouterOS->write('/interface/wireless/registration-table/getall');
 
			 $read = $this->RouterOS->read(false);
			 $data = $this->RouterOS->parseResponse($read);
 
			 echo json_encode($data);
		 } else {
			 echo "F";
		 }
	}

	public function getSecurityProfilesWireless(){
		checkLoginAjax();
		 $ip_address  = $this->input->post('_ip_address');
		 $username  = $this->input->post('_username');
		 $password  = $this->input->post('_password');
		 $port = $this->input->post('_port');
		 $token  = $this->input->post('_token');
 
		 __check(array($ip_address,$username,$password,$port));
		 validateToken($token);
 
		 if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			 $this->RouterOS->write('/interface/wireless/security-profiles/getall');
 
			 $read = $this->RouterOS->read(false);
			 $data = $this->RouterOS->parseResponse($read);
 
			 echo json_encode($data);
		 } else {
			 echo "F";
		 }
	 }

	public function getWirelessInterface(){
	   checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/interface/wireless/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getPPPoESecrets(){
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password ,$port)) {
			$this->RouterOS->write('/ppp/secret/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			echo json_encode($data);
		} else {
			echo "F";
		}
	}

	public function getPPPoEServers(){
		checkLoginAjax();

		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/interface/pppoe-server/server/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			echo json_encode($data);
		} else {
			echo "F";
		}
	}
	
	public function getPPPInterface()
	{
		checkLoginAjax();
		$ip_address  = $this->input->post('_ip_address');
		$username  = $this->input->post('_username');
		$password  = $this->input->post('_password');
		$port = $this->input->post('_port');
		$token  = $this->input->post('_token');

		__check(array($ip_address,$username,$password,$port));
		validateToken($token);

		if ($this->connectRouter($ip_address, $username, $password,$port)) {
			$this->RouterOS->write('/ppp/active/getall');

			$read = $this->RouterOS->read(false);
			$data = $this->RouterOS->parseResponse($read);

			echo json_encode($data);
		} else {
			echo "F";
		}
	}

}
