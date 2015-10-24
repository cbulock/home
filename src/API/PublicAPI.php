<?php
namespace cbulock\home\API;

class PublicAPI {

	private $class;
	private $method;
	private $req;

	public function setClass($class) {
		$this->class = $class;
	}

	public function setMethod($method) {
		$this->method = $method;
	}

	public function setRequest($req) {
		$this->req = $req;
	}

	public function output() {
		$api = new \cbulock\home\PublicAPI\API;

		try {
			$result = $api->call($this->class.'/'.$this->method, $this->req);
		}
		catch(\Exception $e) {
			$result = $this->exceptionHandler($e);
		}
		if (!is_array($result)) $result = ['response' => $result];

		return $result;
	}

	private function exceptionHandler($e) {
		if (method_exists($e, 'getHttpStatus')) {
			$status = $e->getHttpStatus();
			header("HTTP/1.0 " . $status);
		}
		return [
			'error' => $e->getCode(),
			'message' => $e->getMessage()
		];
	}

}