<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Project_model extends CI_Model {


	const __TABLE_NAME = 'projects';


	public function create($name, $proj_id, $key) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $name;
		$data[] = $proj_id;
		$data[] = $key;
		$sql = "INSERT INTO `$tbl_name`
			(
				`name`,
				`project_id`,
				`apikey`,
				`date_created`
			) VALUES(?, ?, ?, NOW())";
		$this->db->query($sql, $data);
		$id = $this->db->insert_id();
		$action = 'insert';
		$result = array(
				'action' => $action,
				'id' 	 => $id
			);
		return $result;
	}

	public function delete($id) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $id;
		$sql = "DELETE FROM `$tbl_name`
			WHERE `id` = ? 
			LIMIT 1";
		$this->db->query($sql, $data);
		$affected_rows = $this->db->affected_rows();
		$action = 'delete';
		$result = array(
				'action' => $action,
				'affected_rows' => $affected_rows
			);
		return $result;
	}

	public function find($id) {
		$tbl_name = self::__TABLE_NAME;
		$date_format = __DATETIME_FORMAT_SHORT;
		$data[] = $id;
		$sql = "SELECT
			`id`,
			`name`,
			`project_id`,
			`apikey`,
			DATE_FORMAT(`date_created`, '$date_format') AS 'date_created'
			FROM `$tbl_name`
			WHERE `id` = ? 
			LIMIT 1";
		$query = $this->db->query($sql, $data);
		$result = $query->result();
		return $result;

	}

	public function find_all($name, $key, $proj_id, $offset, $limit) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $key . '%';
		$data[] = $name . '%';
		$data[] = (int) $offset;
		$data[] = (int) $limit;
		$sql = "SELECT 
			`id`,
			`name`,
			`project_id`,
			`apikey`,
			`date_created`
			FROM `$tbl_name`
			WHERE `apikey` LIKE ?
			AND `name` LIKE ?
			ORDER BY `name` ASC
			LIMIT ?, ?";

			//echo $sql;
		$query = $this->db->query($sql, $data);
		$result = $query->result();

		return $result;
	}

	public function update($name, $projid, $key, $id) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $name;
		$data[] = $projid;
		$data[] = $key;
		$data[] = $id;
		$sql = "UPDATE `$tbl_name` SET 
			`name` = ?,
			`project_id` = ?,
			`apikey` = ?,
			`date_updated` = NOW()
			WHERE `id` = ?";
		$this->db->query($sql, $data);
		$affected_rows = $this->db->affected_rows();
		$action = 'update';
		$result = array(
				'action' => $action,
				'affected_rows' => $affected_rows
			);
		return $result;
	}

	public function insert_filter($proj_id, $date_from, $date_end) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $proj_id;
		$data[] = $date_from;
		$data[] = $date_end;
		$sql = "INSERT INTO `filtering`
			(
				`project_id`,
				`date_from`,
				`date_end`
			) VALUES(?, ?, ?)";
		$this->db->query($sql, $data);
		$id = $this->db->insert_id();
		$action = 'insert';
		$result = array(
				'action' => $action,
				'id' 	 => $id
			);
		return $result;
	}

	public function find_filter($id) {
		$tbl_name = self::__TABLE_NAME;
		$date_format = __DATETIME_FORMAT_SHORT;
		$data[] = $id;
		$sql = "SELECT
			`project_id`,
			`date_from`,
			`date_end`
			FROM `filtering`
			WHERE `project_id` = ? 
			LIMIT 1";
		$query = $this->db->query($sql, $data);
		$result = $query->result();
		return $result;
	}

	public function update_filter($date_from, $date_end, $proj_id) {
		$tbl_name = self::__TABLE_NAME;
		$data[] = $date_from;
		$data[] = $date_end;
		$data[] = $proj_id;
		$sql = "UPDATE `filtering` SET 
			`date_from` = ?,
			`date_end` = ?
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

