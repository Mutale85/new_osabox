<?php
	include '../../includes/db.php';
	if (isset($_POST['branch_id_select'])) {
        $branch_id = preg_replace("#[^0-9]#", "", base64_decode($_POST['branch_id_select']));
        $sql = $connect->prepare("SELECT * FROM borrowers WHERE branch_id = ? AND parent_id = ? ");
        $sql->execute(array($branch_id, $_SESSION['parent_id']));
        if ($sql->rowCount() > 0) {
     		$ouput = '<option value="">Select Borrower</option>';
	        foreach ($sql->fetchAll() as $row) {
	            $branch_id = $row['branch_id'];
	            $ouput .=  '<option value="'.$row['borrower_ID'].'">'.getBorrowerFullNames($connect, $row['id']).' - ID: '.$row['borrower_ID'].' </option>';
	        }

        }else{
        	$ouput.= '<option value="">No Borrower Found</option>';
        }

        $query = $connect->prepare("SELECT * FROM `group_borrowers` WHERE branch_id = ? AND parent_id = ? ");
        $query->execute(array($branch_id, $_SESSION['parent_id']));

        foreach ($query->fetchAll() as $row) {
            $ouput .=  '<option value="'.$row['group_id'].'">'.ucwords($row['group_name']).' Group ID: '.$row['group_id'].' </option>';
        }
        echo $ouput;
    }

    if (isset($_POST['borrower_card_id'])) {
        $ouput = "";
    	$borrower_card_id = $_POST['borrower_card_id'];
        $sql = $connect->prepare("SELECT * FROM guarantors WHERE borrower_id = ? AND parent_id = ? ");
        $sql->execute(array($borrower_card_id, $_SESSION['parent_id']));
        if ($sql->rowCount() > 0) {
	        foreach ($sql->fetchAll() as $row) {
	            
	            $ouput .=  '<option value="'.$row['id'].'" selected>'.ucwords($row['firstname'] .' '. $row['lastname']).'</option>';
	        }

        }else{
        	$ouput.= '<option value="0">No Guarantors Found</option>';
        }
        echo $ouput;
    }

    if (isset($_POST['loan_type_id'])) {
    	$ouput = '';
    	$loan_type_id = preg_replace("#[^0-9]#", "", $_POST['loan_type_id']);
        $sql = $connect->prepare("SELECT * FROM loan_plans WHERE loan_type = ? AND parent_id = ? ");
        $sql->execute(array($loan_type_id, $_SESSION['parent_id']));
        if ($sql->rowCount() > 0) {
     		// $ouput .= '<option value="">Select Loan Plan</option>';
	        foreach ($sql->fetchAll() as $row) {
	            
	            $ouput .=  '<option value="'.$row['id'].'">'.$row['months'].' Months / [ '.$row['interest_percentage'].'% ] / [ '.$row['penalty_rate'].'% ]</option>';
	        }

        }else{
        	$ouput.= '<option value="">No Loan Plan Found</option>';
        }
        echo $ouput;
    }


     if (isset($_POST['loan_parent_id'])) {
        $loan_parent_id = preg_replace("#[^0-9]#", "", base64_decode($_POST['loan_parent_id']));
        $sql = $connect->prepare("SELECT * FROM loan_type WHERE parent_id = ? ");
        $sql->execute(array($loan_parent_id));
        if ($sql->rowCount() > 0) {
            $ouput = '<option value="">Select Loan Type</option>';
            foreach ($sql->fetchAll() as $row) {
                
                $ouput .=  '<option value="'.$row['id'].'">'.ucwords($row['type_name']).'</option>';
            }

        }else{
            $ouput.= '<option value="">No Loan Type Found</option>';
        }
        echo $ouput;
    }

    if (isset($_POST['borrower_card_id_get_loan_number'])) {
        echo preg_replace("#[^0-9]#", "_", $_POST['borrower_card_id_get_loan_number']);
    }
    
?>