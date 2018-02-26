<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class __getglobal {

	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function data_default($data) {
		$temp['base_url'] = base_url();
		$temp['app_name'] = $this->CI->config->item('app_name');
		$temp['app_name_sub'] = $this->CI->config->item('app_name_sub');
		$temp['app_version'] = $this->CI->config->item('app_version');
		$merge = array_merge($data, $temp);

		return $merge;
	}

	public function check_ip() {
		if ($this->valid_ip()) {
			exit('Access Denied');
		}
	}

	function valid_ip() {
		switch ($this->get_client_ip()) {
			case '192.168.100.1':
				return false;
				break;
			case '121.58.237.125':
				return false;
				break;
			case '203.90.242.146':
				return false;
				break;	
			default:
				return true;
				break;
		}
	}

	function get_client_ip() {
	  $ipaddress = '';
	  if (getenv('HTTP_CLIENT_IP'))
	      $ipaddress = getenv('HTTP_CLIENT_IP');
	  else if(getenv('HTTP_X_FORWARDED_FOR'))
	      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	  else if(getenv('HTTP_X_FORWARDED'))
	      $ipaddress = getenv('HTTP_X_FORWARDED');
	  else if(getenv('HTTP_FORWARDED_FOR'))
	      $ipaddress = getenv('HTTP_FORWARDED_FOR');
	  else if(getenv('HTTP_FORWARDED'))
	     $ipaddress = getenv('HTTP_FORWARDED');
	  else if(getenv('REMOTE_ADDR'))
	      $ipaddress = getenv('REMOTE_ADDR');
	  else
	      $ipaddress = 'UNKNOWN';
	   return $ipaddress;
	}
}
