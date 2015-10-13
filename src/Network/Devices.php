<?php
namespace cbulock\home\Network;

class Devices {

	private $db;

	public function __construct() {
		$this->db = new DB();
	}

	public function all() {
		$sql = "
			SELECT d.id, d.name, d.hostname, d.ip_address, d.mac_address, u.name AS primary_user, t.type
			FROM devices as d
			LEFT OUTER JOIN users AS u
			ON d.primary_user = u.id
			LEFT OUTER JOIN device_types AS t
			ON d.device_type = t.id;
		";
		$result = $this->db->query($sql);
		return $this->db->fetchAll($result);
	}

	public function get($id) {
		if ( !(is_int($id) || ctype_digit($id)) ) throw new \Exception('Not a valid device ID.');
		
		$sql = "
			SELECT d.id, d.name, d.hostname, d.ip_address, d.mac_address, u.name AS primary_user, t.type
			FROM devices as d
			LEFT OUTER JOIN users AS u
			ON d.primary_user = u.id
			LEFT OUTER JOIN device_types AS t
			ON d.device_type = t.id
			WHERE d.id = " . $id . ";
		";
		$result = $this->db->query($sql);
		return $this->db->fetchAll($result)[0];
	}

}
