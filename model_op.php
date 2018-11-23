<?php

include_once("dbconn.php");
class ModelOperation extends Db
{
	public function addModelData($man_id,$man_name,$model_name,$year,$regno,$color)
	{
		$add_sql = "insert into model_details (id,insert_time,man_id,man_name,model_name,regno,manyear,color) values ('',now(),'$man_id','$man_name','$model_name','$regno','$year','$color')";
		$out = $this->makeQuery($add_sql);
		return $out;
	}
	public function getAllModelDetails()
	{
		$sql_all = "select man_name,model_name,count(model_name) as mcount from model_details group by model_name";
		$out = $this->makeQuery($sql_all);
		return $out;
	}
	public function getModels($man_name,$model_name)
	{
		$sql_model = "select id,man_id,man_name,model_name,regno,manyear,color from model_details where man_name='$man_name' and model_name='$model_name'";
		$out = $this->makeQuery($sql_model);
		return $out;
	}
	
	public function removeModelData($man_name,$model_name,$year,$regno,$color)
	{
		$sql_rm = "delete from model_details where man_name='$man_name' and model_name='$model_name' and manyear='$year' and regno='$regno' and color='$color'";
		$out = $this->makeQuery($sql_rm);
		return $out;
	}
}
?>