<?php
namespace cbulock\home\Network;

class DB extends \PDO {

	public function __construct($dsn = 'pgsql:dbname=devices') {
		parent::__construct($dsn);
		$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
	}


	public function fetch(\Peyote\Query $query) {
		$q = $query->compile();
		$s = $this->prepare($q);
		$s->execute($query->getParams());
		return $s->fetchAll();
	}

}