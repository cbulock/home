<?php
namespace cbulock\home\Controller;

class Devices extends Base {

	public function process() {

		$this->setTemplate('Devices');

		$devices = new \cbulock\home\Network\Devices;

		$this->addData(
			[
				'devices' => $devices->all()
			]
		);
	}

}
