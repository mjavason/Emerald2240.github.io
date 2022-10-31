<?php
class DBController
{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "esut_gamma";

	private $conn;
	private $connPDO;

	//PDO Side
	private $dsn;

	function __construct()
	{
		$this->conn = $this->connectDB();
		$this->connPDO = $this->connectPDO();
	}

	function connectDB()
	{
		$conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		if ($conn->connect_error) {
			die("Error Occured" . $conn->connect_error);
		} else {
			//echo "Connection Established";
		}
		return $conn;
	}

	function connectPDO()
	{
		// Set DSN
		$dsn = "mysql:host=" . $this->host . ";dbname=" . $this->database;

		$options = [
			// turn off emulation mode for "real" prepared statements
			PDO::ATTR_EMULATE_PREPARES   => false,

			//turn on errors in the form of exceptions
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,

			//make the default fetch be an associative array
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

			//Getting the number of affected rows is exceedingly simple, as all you need to do is $stmt->rowCount().
			PDO::MYSQL_ATTR_FOUND_ROWS => true,
		];

		try {
			$pdo = new PDO($dsn, $this->user, $this->password, $options);
			return $pdo;
		} catch (Exception $e) {
			error_log($e->getMessage());
			exit('Something weird happened'); //something a user can understand
		}
	}




	function runQuery($query)
	{
		$result = mysqli_query($this->conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if (!empty($resultset))
			return $resultset;
	}

	function runQueryWithoutResponse($query)
	{
		if (mysqli_query($this->conn, $query)) {
			return true;
		} else {
			die(mysqli_error($this->conn)); //something a user can understand
			return false;
		}
	}

	function numRows($query)
	{
		$result  = mysqli_query($this->conn, $query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}

	function getUniqueDataNotDeleted($unique_id, $table)
	{
		$query = "SELECT * FROM $table WHERE `unique_id`='" . $unique_id . "' AND `is_deleted`='0'  ";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAll($table)
	{
		$query = "SELECT * FROM $table ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllNotDeleted($table)
	{
		$query = "SELECT * FROM $table WHERE `is_deleted`='0' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhere($table, $where, $equals)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhere_inactive($table, $where, $equals)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND `inactive`= 0 ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhere_active($table, $where, $equals)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND `inactive`= 1 ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhere_NotDeleted($table, $where, $equals)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND `is_deleted` ='0' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhereWith2Conditions($table, $where, $equals, $where2, $equals2)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}
	public function selectAllWhereWith2Condition_NotDeleted($table, $where, $equals, $where2, $equals2)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND `is_deleted`='0' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhereWith3Conditions($table, $where, $equals, $where2, $equals2, $where3, $equals3)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectWhereAllWith3Conditions_NotDeleted($table, $where, $equals, $where2, $equals2, $where3, $equals3)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' AND `is_deleted`='0' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhereWith4Conditions($table, $where, $equals, $where2, $equals2, $where3, $equals3, $where4, $equals4)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' AND $where4 ='" . $equals4 . "' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllWhereWith4Conditions_NotDeleted($table, $where, $equals, $where2, $equals2, $where3, $equals3, $where4, $equals4)
	{
		$query = "SELECT * FROM $table WHERE $where ='" . $equals . "' AND $where2 ='" . $equals2 . "' AND $where3 ='" . $equals3 . "' AND $where4 ='" . $equals4 . "' AND `is_deleted`='0' ORDER by id DESC";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllOrderBy($table, $orderBy)
	{
		$query = "SELECT * FROM $table ORDER BY `$orderBy` DESC ";
		$result = $this->runQuery($query);
		return $result;
	}

	public function selectAllOrderBy_Limited($table, $orderBy, $limit)
	{
		$query = "SELECT * FROM $table ORDER BY `$orderBy` DESC LIMIT $limit";
		$result = $this->runQuery($query);
		return $result;
	}

	public function updateSingleColumnWhere1Condition($table, $columnToUpdate, $update, $targetColumn, $targetUniqueId)
	{
		// $query = "UPDATE `messages` SET `seen` = '1' WHERE `messages`.`id` = 5;";
		$query = "UPDATE `$table` SET `$columnToUpdate` = '$update' WHERE `$table`.`$targetColumn` = $targetUniqueId;";
		$result = $this->runQueryWithoutResponse($query);
		return $result;
	}

	public function deleteSingleColumnWhere1Condition($table, $targetColumn, $targetUniqueId)
	{
		$query = "DELETE FROM `$table` WHERE `$table`.`$targetColumn` = $targetUniqueId;";
		$result = $this->runQueryWithoutResponse($query);
		return $result;
	}
}//end of class
