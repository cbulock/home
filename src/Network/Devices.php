<?php
namespace cbulock\home\Network;

class Devices {

	private $db;

	public function __construct() {
		$this->db = new DB();
	}

	public function all() {
		$query = new \Peyote\Select('devices AS d');
		$query->columns(
							'd.id',
							'd.name',
							'd.hostname',
							'd.ip_address',
							'd.mac_address',
							'd.location_floor',
							'd.location_x',
							'd.location_y',
							'u.name AS primary_user',
							'u.id AS primary_user_id',
							't.type',
							't.id AS type_id'
						)
					->join('users AS u', 'left outer')
					->on('d.primary_user', '=', 'u.id')
					->join('device_types AS t', 'left outer')
					->on('d.device_type', '=', 't.id');

		return $this->db->fetch($query);
	}

	public function get($id) {
		if ( !(is_int($id) || ctype_digit($id)) ) throw new \Exception('Not a valid device ID.');

		$query = new \Peyote\Select('devices AS d');
		$query->columns(
							'd.id',
							'd.name',
							'd.hostname',
							'd.ip_address',
							'd.mac_address',
							'd.location_floor',
							'd.location_x',
							'd.location_y',
							'u.name AS primary_user',
							'u.id AS primary_user_id',
							't.type',
							't.id AS type_id'
						)
					->join('users AS u', 'left outer')
					->on('d.primary_user', '=', 'u.id')
					->join('device_types AS t', 'left outer')
					->on('d.device_type', '=', 't.id')
					->where('d.id', '=', $id);

		return $this->db->fetch($query)[0];
	}

	public function update($id, $data) {
		if ( !(is_int($id) || ctype_digit($id)) ) throw new \Exception('Not a valid device ID.');

		$data = $this->sanitze_input($data);

		$query = new \Peyote\Update('devices');
		$query->set($data)
					->where('id', '=', $id);

		return $this->db->fetch($query);
	}

	public function add($data) {
		$data = $this->sanitze_input($data);

		$query = new \Peyote\Insert('devices');
		$query->columns(array_keys($data))
					->values(array_values($data));

		return $this->db->fetch($query);
	}

	public function gettypes() {
		$query = new \Peyote\Select('device_types');
		$query->columns('id','type');

		return $this->db->fetch($query);
	}

	public function getusers() {
		$query = new \Peyote\Select('users');
		$query->columns('id','name');

		return $this->db->fetch($query);
	}

	private function sanitze_input($data) {
		if (!$data['mac_address']) $data['mac_address'] = NULL;
		if (!$data['ip_address']) $data['ip_address'] = NULL;
		if (!$data['primary_user']) $data['primary_user'] = NULL;
		if (!$data['location_floor']) $data['location_floor'] = NULL;
		if (!$data['location_x']) $data['location_x'] = NULL;
		if (!$data['location_y']) $data['location_y'] = NULL;
		return $data;
	}

}
