<?php
namespace cbulock\home\PublicAPI;

class API {

	/*
	* Call public API methods
	*
	* Accesses allowed methods through a common interface.
	*
	* @param string $method Method name to access.
	* @param mixed[] $params Associated array of named parameters and their values.
	*/

	public function call($method, $params=[]) {
		$result = explode('/',$method);
		$class = $result[0] . '\\' . $result[1];
		$method = $result[2];

		//limit methods to PublicAPI namespace
		$class = "cbulock\home\PublicAPI\\" . $class;

		$reflectClass = new \ReflectionClass($class);
		$reflectMethod = $reflectClass->getMethod($method);
		$reflectParams = $reflectMethod->getParameters();

		$indexed_params = [];

		foreach($reflectParams as $param) {
			if (isset($params[$param->getName()])) {
				$indexed_params[] = $params[$param->getName()];
			} else {
				if ($param->isOptional()) {
					$indexed_params[] = $param->getDefaultValue();
				} else {
					$indexed_params[] = NULL;
				}
			}
		}

		$class_obj = new $class;

		return $reflectMethod->invokeArgs($class_obj, $indexed_params);
	}

}