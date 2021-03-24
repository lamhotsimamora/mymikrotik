<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function _getDate($custom=null)
{
	date_default_timezone_set('Asia/Jakarta');
	($custom==null) ?  $d  = date('Y/m/d') : $d   = date($custom);
	return $d;
}

function _getTime($custom=null)
{
	date_default_timezone_set('Asia/Jakarta');
	$t = ($custom == null) ? date('H:i') : date($custom) ;
	return $t;
}

