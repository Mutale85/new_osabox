<?php
	include '../../includes/db.php';
	extract($_POST);
	$path =  "collaterals/files/".$fname;
	
	$d = $connect->prepare("DELETE FROM collaterals_files WHERE id = ?");
	$ex = $d->execute(array($fileId));
	if ($ex) {
		echo "File Deleted";
		// if (unlink($path)) {
		// 	echo "File Deleted";
		// }
	}
?>