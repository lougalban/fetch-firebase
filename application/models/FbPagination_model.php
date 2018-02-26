<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FbPagination_model extends CI_Model {


	const __TABLE_NAME = 'dbfb_pagination';


	public function create($proj_id, $key) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $proj_id;
		$data[] = $key;
		$sql = "INSERT INTO `$tbl_name`
			(
				`project_id`,
				`lastkey`
			) VALUES(?, ?)";
		$this->db->query($sql, $data);
		$id = $this->db->insert_id();
		$action = 'insert';
		$result = array(
				'action' => $action,
				'id' 	 => $id
			);
		return $result;
	}

	public function find($projid) {
		$tbl_name = self::__TABLE_NAME;
		$date_format = __DATETIME_FORMAT_SHORT;
		$data[] = $projid;
		$sql = "SELECT
			`project_id`,
			`lastkey`
			FROM `$tbl_name`
			WHERE `project_id` = ? 
			LIMIT 1";
		$query = $this->db->query($sql, $data);
		$result = $query->result();
		return $result;

	}

	public function update($projid, $key) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $key;
		$data[] = $projid;
		$sql = "UPDATE `$tbl_name` SET 
			`lastkey` = ?
			WHERE `project_id` = ?";
		$this->db->query($sql, $data);
		$affected_rows = $this->db->affected_rows();
		$action = 'update';
		$result = array(
				'action' => $action,
				'affected_rows' => $affected_rows
			);
		return $result;
	}

}

