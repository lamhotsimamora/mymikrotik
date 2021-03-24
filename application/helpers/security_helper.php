<?php
defined('BASEPATH') or exit('No direct script access allowed');

function checkLogin(){
	if(! isset($_COOKIE['id_admin'])) {
		redirect(base_url('admin/login'));
		exit;
	}else{
		$id_admin_from_cookie = $_COOKIE['id_admin'];

		$json = new JSONAdmin();

		$data = $json->read();
		$data = json_decode($data);
		
		$id_admin = $data->{'id_admin'};
		
		
		if ($id_admin != $id_admin_from_cookie){
			delete_cookie('id_admin'); 
			redirect(base_url('admin/login'));
			exit();
		}
	}
}

function checkLoginAjax(){
	if(! isset($_COOKIE['id_admin'])) {
		exit("LOGIN FAILED");
	}
}

function createToken()
{
	$code = _randomStr(15);
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = $code;
	}
}

function validateToken($token)
{

	if ($token != null || $token != '') {
		if ($token === "zPkIextMxdJ6JGrxxLCYEQsRn21Xmo7PbpWgJJ0qPO0qUtoASfTSs6NWU4sDtCJepvD116yaFb5B8qj2thZDhLLq") {
		} else {
			exit('TOKEN_WRONG');
		}
	} else {
		exit("TOKEN_WRONG");
	}
}

function getToken()
{
	return $_SESSION['token'] ? $_SESSION['token'] : false;
}

function _md5($str = null)
{
	$tot = strlen(trim($str));
	return md5($tot . $str . $tot);
}

function _randomStr($length = 10)
{
	$c = '0123456789aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ';
	$cL = strlen($c);
	$rS = '';
	for ($i = 0; $i < $length; $i++) {
		$rS .= $c[rand(0, $cL - 1)];
	}
	return $rS;
}

function __check($data){
	$length = count($data);

	for ($i=0; $i < $length ; $i++) { 
		$string = $data[$i];
		
		if ($string==='' || $string== null || $string==='undefined' || $string ==='null'){
			exit("INPUT IS EMPTY");
		}
	}
}