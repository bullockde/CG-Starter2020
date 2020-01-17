<?php
date_default_timezone_set('Europe/London');
class DB {
	/*var $hostname 	= 'localhost';
	var $username 	= 'root';
	var $password 	= '';
	var $db_name	= '';
	var $connection;
	var $errors		= array();
	var $queries	= array();
	var $query		= '';
	var $insert_id	= 0;
	var $debug		= 1;
	
	
	function DB($params=array()) {
		if(!empty($params)) {
			foreach($params as $k=>$v) {
				if(isset($this->{$k})) {
					$this->{$k} = $v;
				}
			}
		}
		
		if($this->hostname != '' && $this->username != '' && $this->db_name != '') {
			$this->connection = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->hostname, $this->username, $this->password));
			if(!$this->connection) {
				$this->errors[] = 'Could not connect: '.((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
				return FALSE;
			}
			if(!((bool)mysqli_query($this->connection, "USE `" . $this->db_name ."`"))) {
				$this->errors[] = 'Database error: '.((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
				return FALSE;
			}
		} else {
			$this->errors[] = 'Wrong database information';
			return FALSE;
		}
		
		if($this->debug && !empty($this->errors)) {
			$this->print_debug($this->errors);
		}
		
	return TRUE;
	}
	*/
	
	function query($sql) {
		$this->queries[] = $sql;
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		
		if(!$result) {
			$this->errors[] = 'Invalid query: '.((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
		}
		if($result===TRUE) {
			$this->insert_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
		}
		
		if($this->debug && !empty($this->errors)) {
			$this->print_debug($this->errors);
			$this->print_debug($sql);
		}
		
	return $result;
	}
	
	
	function get_rows($sql) {
		$result = $this->query($sql);
		
		$rows = array();
		if($result !== FALSE) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
		}
	return $rows;
	}
	
	
	function get_row($sql) {
		$result = $this->query($sql);
		$row = array();
		if($result !== FALSE) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
	return $row;
	}


	function escape($str) {
		return $str;
	}
	
	
	function insert($table, $data) {

		
		foreach($data as $k=>$v) {
			$data[$k] = $this->escape($v);
		}


		if(!isset($data['created'])) {
			$data['created'] = date("Y-m-d H:i:s");
		}
		

		$fields = $this->get_sql_field_names($table);
		
		foreach($data as $k=>$v) {
			if(!in_array($k,$fields)) {
				unset($data[$k]);
			}
		}


		$keys 	= array_keys($data);
		$values = array_values($data);

		$sql = "INSERT INTO ".$this->escape($table)." (".implode(',',$keys).") VALUES('".implode("','",$values)."')";
		
	return $this->query($sql);
	}
	
	
	function update($table, $data, $id) {

		if(!isset($data['modified'])) {
			$data['modified'] = date("Y-m-d H:i:s");
		}

		$fields = $this->get_sql_field_names($table);
		$update = '';
		foreach($data as $k=>$v) {
			if(in_array($k,$fields)) {
				$update .= "`$k`='".$this->escape($v)."', ";
			}
		}

		$update = substr($update, 0, strrpos($update, ','));

		$sql = "UPDATE ".$this->escape($table)." SET ".$update." WHERE id=".$this->escape($id);

	return $this->query($sql);
	}
	
	function delete($table, $id) {
		

		$sql = "DELETE FROM ".$this->escape($table)." WHERE id=".$this->escape($id);

	return $this->query($sql);
	}


	function get_insert_id() {
		return $this->insert_id;
	}


	function get_sql_field_names($table) {
		$columns = array();
		$rows = $this->get_rows("SHOW COLUMNS FROM ".$table);
		
		foreach($rows as $k=>$v) {
			if(!in_array($v['Field'], $columns)) {
				$columns[] = $v['Field'];
			}
		}
	return $columns;
	}


	function print_debug($debug) {
		echo '<pre>';
		if(is_string($debug)) {
			echo $debug;
		} else {
			print_r($debug);
		}
		echo '</pre>';
	}
}