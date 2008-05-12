<?php
/*
 * Winn Database Class for PostgreSQL
 * NOT SUPPORTED YET
 * - v1.0.2
 */
define('DBHOST','localhost');
define('DBNAME','database name');
define('DBUSER','username');
define('DBPASS','password');

if ($dbc = @pg_connect ("host=".DBHOST." dbname=".DBNAME." user=".DBUSER." password=".DBPASS) ) {
}else{
	//this will display a readable error
	die ('bad.. and you cant connect ' . pg_last_error($dbc) . '');
}

class dbcon {
	
	/* Insert
	 * $ins[] = 'column=value';
	 * $ins[] = 'column2=value2';
	 * $db->insert('table',$ins);
	 *
	 *
	 *
	 */
	function insert($table,$vars) {
		$t = sizeof($vars);
		$i = 0;
		foreach($vars AS $value) {
			$i += 1;
			$i == $t ? $comma = '' : $comma = ',';
			$cols[] = $value . $comma;
		}
		pg_query('INSERT INTO ' . $table . ' SET ' . $cols);
	}
	
	function update($table,$vars,$id) {
		$t = sizeof($vars);
		$i = 0;
		foreach($vars AS $value) {
			$i += 1;
			$i == $t ? $comma = '' : $comma = ',';
			$cols[] = $value . $comma;
		}
		pg_query('UPDATE ' . $table . ' SET ' . $cols . ' WHERE id=' . $id);
	}
}
?>