<?php
namespace cbulock\home\Controller;

class Devices extends Base {

	public function process() {

		$this->setTemplate('Devices');

		$devices = new \cbulock\home\Network\Devices;

		$this->addData(
			[
				'devices' =>			$devices->all(),
				'device_types' =>	$devices->gettypes(),
				'users' =>				$devices->getusers()
			]
		);
	}

}
