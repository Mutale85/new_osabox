<?php 
	if (isset($_COOKIE['SelectedBranch'])) {
		$BRANCHID = $_COOKIE['SelectedBranch'];
	}else{
		$BRANCHID = "";
		// header("location:index");
	}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], base64_decode($BRANCHID)))?></title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<link rel="icon" type="text/css" href="../images/icon2.png">
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="intl.17/build/css/intlTelInput.css">
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap-icons/font/bootstrap-icons.css">
<!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
<script type="text/javascript" src="pdf.js"></script>


<?php $BRANCHID = base64_decode($BRANCHID);?>
<!-- 0491012250 -->