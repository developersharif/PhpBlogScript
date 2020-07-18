<?php

/**
 * main class
 */
class main
{
	private $host = host;
	private $user = user_name;
	private $pass = password;
	private $db = db_name;
	public $dblink;
	public function __construct()
	{
		if (new mysqli($this->host, $this->user, $this->pass, $this->db)) {
			$this->dblink = new mysqli($this->host, $this->user, $this->pass, $this->db);
		} elseif (mysqli_connect_errno()) {
			$this->dblink = 'database error';
		}
	}

	public function db_check()
	{
		$conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
		if (mysqli_connect_errno()) {
			return false;
		} else {
			return true;
		}
	}

	public function select($query)
	{
		$query = mysqli_query($this->dblink, $query);
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function insert($query)
	{
		$query = mysqli_query($this->dblink, $query);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update($query)
	{
		$query = mysqli_query($this->dblink, $query);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($query)
	{
		$query = mysqli_query($this->dblink, $query);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function num_rows($query)
	{
		$query = mysqli_query($this->dblink, $query);
		$rows = mysqli_num_rows($query);
		if ($rows != 0) {
			return $rows;
		} else {
			return false;
		}
	}


	public function db_query($table, $pcol, $val)
	{

		$query = mysqli_query($this->dblink, "SELECT * FROM $table WHERE $pcol='$val'");
		if ($query) {
			$result = $query->fetch_assoc();
			return $result;
		} else {
			return false;
		}
	}
}