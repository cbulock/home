<?php
namespace cbulock\home\PublicAPI\Network;

class devices {

	private $devices;

	public function __construct() {
		$this->devices = new \cbulock\home\Network\Devices;
	}

	public function all() {
		return $this->devices->all();
	}

	public function get($id) {
		return $this->devices->get($id);
	}

	public function add($data) {
		return $this->devices->add($data);
	}

	public function update($id, $data) {
		return $this->devices->update($id, $data);
	}

	public function types() {
		return $this->devices->gettypes();
	}

	public function users() {
		return $this->devices->getusers();
	}

}