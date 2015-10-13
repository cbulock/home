<?php
namespace cbulock\home\Network;

class DB extends \SQLite3 {

	private $dbfile = "devicelist.db";

	public function __construct($dbfile = NULL) {
		if ($dbfile) $this->dbfile = $dbfile;
		$this->open( $this->dbfile );
	}

	public function fetchAll( $result ) {
		$data = [];
		while($row=$result->fetchArray(SQLITE3_ASSOC)){
			$data[] = $row;
		}
		return $data;
	}
}