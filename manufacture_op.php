<?php
include_once("dbconn.php");
class Mannufature extends Db
{
	private $arr = array();
	public function addManufatureDetails($manName)
	{
		$out_data = array();
		$check_sql = "select man_name from manufacture_details where man_name='$manName'";
		$out = $this->checkMan($check_sql);
		
		if($out == 0)
		{
			$in_sql = "insert into manufacture_details (id,insert_time,man_name) values('',now(),'$manName')";
			$res_out = $this->makeQuery($in_sql); 
			return $res_out;
		}else{
			$arr['msg'] = 'Manufacture already added.';
			return $arr;
		}
	}
	public function getAllMan()
	{
		$sql_que = "select * from manufacture_details";
		$res_out = $this->makeQuery($sql_que); 
		return $res_out;
	}
}
?>