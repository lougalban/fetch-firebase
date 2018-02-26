<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->__user->is_authenticated()) { redirect('secure/login'); }
	}

	public function index() {
		$project_list = $this->project_model->find_all('', '', '', 0, 10);
		$template = 'main/index';
		$data['projects'] = $project_list;
		$this->parser->parse(
				$template, 
				$this->__getglobal->data_default($data)
			);
	}

	public function addProject() {
		$this->load->helper('url');
		$name = $this->input->post('name');
		$proj_id = $this->input->post('pid');
		$key = $this->input->post('apikey');
		$insert_id = $this->project_model->create($name, $proj_id, $key);
		redirect('/', 'refresh');
	}

	public function updateProject() {
		$name = $this->input->post('name');
		$projid = $this->input->post('pid');
		$key = $this->input->post('apikey');
		$id = $this->input->post('id');
		$project = $this->project_model->update($name, $projid, $key, $id);
		redirect('project/settings?id='.$id, 'refresh');
	}

	public function deleteProject() {
		$id = $this->input->post('id');
		$project = $this->project_model->delete($id);
		redirect('main/index', 'refresh');
	}
}
