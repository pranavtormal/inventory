<?php
class Db
{
	private $host = "localhost"; //server name
	private $user = "root";      //user name
	private $password = ""; // password
	private $database = "inventory"; // database name
	private $con = "";  
	private $arr = array();

	function __construct()
	{
		$this->makeConn();
	}
	public function makeConn()
	{
		if($this->con == "")
		{
			$this->con = mysqli_connect($this->host,$this->user, $this->password,$this->database);
			if (mysqli_connect_error()) {
				return $arr['msg'] = "Connection failed: " .mysqli_connect_error();
			}
		}
	}
	public function makeQuery($sql)      //Query execution function 
	{
		$result = mysqli_query($this->con,$sql);
		$stmt = 
		$data = array();
		$qry_array = array();
		$sql = strtolower(trim($sql));    
		$qry_array  = explode(" ",$sql); // Exploding Query query to indentify operation
		//print_r($qry_array);
		
		if($result)
		{
			if($qry_array[0] == "select")
			{
				while($row = mysqli_fetch_assoc($result))
				{
					array_push($data,$row);
				}
				if(count($data) != 0 && $data != null)
				{
					return $data;
				}
				else
				{
					 $data['msg'] = "-1";
					 return $data;
				}
			}
			elseif($qry_array[0] = "update" || $qry_array[0] = "insert")
			{
				if($result)
				{
					$data['msg'] = 1;
					return $data;
				}
				else
				{
					$data['msg']= "query error";
					return $data;
				}
			}
			elseif($qry_array[0] = "delete")
			{
				if($result)
				{
					$data['msg'] = 2;
					return $data;
				}
				else
				{
					$data['msg']= "query error";
					return $data;
				}
			}
	
		}
		else
		{
			return $arr['msg'] = "Query Failed".mysqli_error($this->con);
		}
	}
	public function checkMan($sql)
	{
		$result1 = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($result1);
		return $count;
	}
	public function closeConnection()
	{
		if($this->con)
		{
			mysqli_close($this->con);
		}
	}
	
}

?>
