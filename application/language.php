<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class language extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$action = $this->input->post('action', NULL);
		$insert_id = NULL;
		$save_id = NULL;
		switch($action) {
			case 'create':
				$code = $this->input->post('code', NULL);
				$name = $this->input->post('name', NULL);
				$insert_id = $this->language_model->create($code, $name);
				break;
			case 'update':
				$code = $this->input->post('code', NULL);
				$name = $this->input->post('name', NULL);
				$id = $this->input->post('id', NULL);
				$affected_rows = $this->language_model->update($code, $name, $id);
				$save_id = $id;
				break;
			case 'delete':
				$id = $this->input->post('id', NULL);
				$this->language_model->delete($id);
				break;
		}
		$event = $this->uri->segment(3);
		$edit_id = NULL;
		$delete_id = NULL;
		switch($event) {
			case 'edit':
				$edit_id = $this->uri->segment(4);
				break;
			case 'delete':
				$delete_id = $this->uri->segment(4);
				break;
		}
		$language_list = $this->language_model->find_all('', '', 0, 100);

		$template = 'language/index';
		$data['insert_id'] = $insert_id;
		$data['language_list'] = $language_list;
		$data['edit_id'] = $edit_id;
		$data['delete_id'] = $delete_id;
		$data['save_id'] = $save_id;
		$this->parser->parse(
				$template, 
				$this->__global->data_default($data)
			);
	}

}
