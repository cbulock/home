<?php
namespace cbulock\home\Controller;

class Device extends Base {

	public function process() {

		$this->setTemplate('Device');

		$device_id = $this->route->get_data(1);

		$devices = new \cbulock\home\Network\Devices;

		$this->addData(
			[
				'device' => $devices->get($device_id)
			]
		);
	}

}