<?php
include_once("manufacture_op.php");
include_once("model_op.php");
$manObj = new Mannufature();
$modelObj = new ModelOperation();

$case = trim($_POST['caseid']);
if($case)
{
	switch($case)
	{
		case 1://add manufacture details
			$man_name = trim($_POST['man_name']);
			$man_name = strtolower(filter_var($man_name, FILTER_SANITIZE_STRING));
			$outdata =  $manObj->addManufatureDetails($man_name);
			echo json_encode($outdata);
			break;
			
		case 2: //get all Manufacture
			$outdata = $manObj->getAllMan();			
			echo json_encode($outdata);
			break;
		
		case 3:
			$model_name = trim(filter_var($_POST['mname'], FILTER_SANITIZE_STRING));
			$man_name = trim(filter_var($_POST['man_name'], FILTER_SANITIZE_STRING));
			$man_id = trim(filter_var($_POST['manid'], FILTER_SANITIZE_STRING));
			$year = trim(filter_var($_POST['myear'], FILTER_SANITIZE_STRING));
			$regno = trim(filter_var($_POST['regno'], FILTER_SANITIZE_STRING));
			$color = trim(filter_var($_POST['color'], FILTER_SANITIZE_STRING));
			$outdata = $modelObj->addModelData($man_id,$man_name,$model_name,$year,$regno,$color);
			echo json_encode($outdata);
			break;
			
		case 4:
			$outdata = $modelObj->getAllModelDetails();
			echo json_encode($outdata);
			break;
		case 5:
			$model_name = trim(filter_var($_POST['mname'], FILTER_SANITIZE_STRING));
			$man_name = trim(filter_var($_POST['man_name'], FILTER_SANITIZE_STRING));
			$outdata = $modelObj->getModels($man_name,$model_name);
			echo json_encode($outdata);
			break;
		case 6:
			$model_name = trim(filter_var($_POST['mname'], FILTER_SANITIZE_STRING));
			$man_name = trim(filter_var($_POST['man_name'], FILTER_SANITIZE_STRING));			
			$year = trim(filter_var($_POST['myear'], FILTER_SANITIZE_STRING));
			$regno = trim(filter_var($_POST['regno'], FILTER_SANITIZE_STRING));
			$color = trim(filter_var($_POST['color'], FILTER_SANITIZE_STRING));
			$outdata = $modelObj->removeModelData($man_name,$model_name,$year,$regno,$color);
			echo json_encode($outdata);
			break;
			
		default:
			
			break;
	}
}
?>