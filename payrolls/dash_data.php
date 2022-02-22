<div class="content-header mt-5 mb-5 border-bottom pb-3">
  	<div class="container-fluid mt-5">
    	<div class="row mb-2 mt-5">
      		<div class="col-sm-6">
        		<h4 class="m-0"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></h4>
      		</div>
      		<div class="col-sm-6">
        		<ol class="breadcrumb float-sm-right">
          			<li class="breadcrumb-item"><a href="./" id="timeRemaining">Home</a></li>
          			<li class="breadcrumb-item active"><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $_SESSION['parent_id']);?> </li>
        		</ol>
      		</div>
    	</div>
  	</div>
</div>