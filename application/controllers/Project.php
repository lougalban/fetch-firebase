<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		if(!$this->__user->is_authenticated()) { redirect('secure/login'); }
	}

	public function index() {
		$id = $_GET['id'];
		$project = $this->project_model->find($id);
		$template = 'project/overview';
		$data['project'] = $project;
		$this->parser->parse(
				$template, 
				$this->__getglobal->data_default($data)
			);
	}

	public function dbfb() {
		$template = 'project/dbfb';
		$id = $_GET['id'];
		$project = $this->project_model->find($id);
		$filter_date = $this->project_model->find_filter($id);	
		$data = array(
				'project' => $project,
				'filter_date' => $filter_date
			);
		$this->parser->parse(
				$template, 
				$this->__getglobal->data_default($data)
			);
	}

	public function dbgp() {
		$template = 'project/dbgp';
		$id = $_GET['id'];
		$project = $this->project_model->find($id);
		$filter_date = $this->project_model->find_filter($id);
		$data = array(
				'project' => $project,
				'filter_date' => $filter_date
			);
		$this->parser->parse(
				$template, 
				$this->__getglobal->data_default($data)
			);
	}

	public function notifications() {
		$template = 'project/notifications';	
		$id = $_GET['id'];
		$project = $this->project_model->find($id);
		$data['project'] = $project;
		$this->parser->parse(
				$template,
 				$this->__getglobal->data_default($data)
			);
	}

	public function settings() {
		$id = $_GET['id'];
		$project = $this->project_model->find($id);
		$template = 'project/settings';
		$data['project'] = $project;
		$this->parser->parse(
				$template, 
				$this->__getglobal->data_default($data)
			);
	}

	public function curl() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://PROJECT_ID.firebaseio.com/fb.json');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, '3');
		$response = trim(curl_exec($ch));
		curl_close($ch);

		echo $response;
	}

	public function fbdata_management() {
		$id = $_POST['id'];
		$key = $_POST['key'];
		$fblastkey = $this->fbpagination_model->find($id);
		if (empty($fblastkey)) {
			$lastkeyid = '';
		} else {
			$lastkeyid = $fblastkey[0]->project_id;
		}

		if ($lastkeyid == $_POST['id']) {
			$result = $this->fbpagination_model->update($id, $key);	
		} else {
			$result = $this->fbpagination_model->create($id, $key);	
		}
		echo json_encode($result);
	}

	public function insert_filtering() {
		$id = $_POST['id'];
		$date_from = $_POST['month_ini'];
		$date_end = $_POST['month_end'];
		$filter_date = $this->project_model->find_filter($id);
		if($filter_date) {
			$result = $this->project_model->update_filter($date_from, $date_end, $id);			
		} else {
			$result = $this->project_model->insert_filter($id, $date_from, $date_end);	
		}

	}
}
