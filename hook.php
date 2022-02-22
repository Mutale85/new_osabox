<?php
	include ("includes/db.php");

	if($json = json_decode(file_get_contents("php://input"), true)) {
      	print_r($json);
      	$data = $json;

      	$id = $data['id'];
		$msisdn  = $data['msisdn'];
		$time 	 = $data['time'];
		$status  = $data['status'];
		$message = 'message';
		$webhook = getParentIBByBorroweresPhone($connect, $msisdn);
		echo "Up Here";
      	$sql = $connect->prepare("INSERT INTO `sms_sent`(`sms_id`, `time_sent`, `message`, `status`, `webhook_label`) VALUES(?, ?, ?, ?, ?) ");
		$sql->execute(array($id, $time, $msisdn, $status, $webhook));
      
    } else {
      	print_r($_POST);
      	$data = $_POST;
      	echo "Down Here";
    }

?>