<?php 
  require ("includes/db.php");
  if (!isset($_COOKIE['ManagementApp']) && !isset($_SESSION['email'])) {?>
      <script>
          window.location = '../home';
      </script>
  <?php
    }else if ($_COOKIE['ManagementApp'] == 'payrolls') {
      echo "<script>
            window.location = '../payrolls';
          </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("links.php") ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include ("nav_side.php"); ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid mt-4">
        <div class="row mb-2 mt-5">
          <div class="col-sm-6">
            <h4 class="m-0"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./" id="timeRemaining">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?> </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <?php if (!isset($_COOKIE['SelectedBranch'])):?>
      <!-- When user just logs in, they should create a branch -->
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-warning card-outline mb-5">
                <div class="card-header">
                  <h4 class="card-title">Added Branches</h4>
                </div>
                <div class="card-body box-profile">
                  
                  <div class="table table-responsive mb-5 mt-5">
                    <table id="branchesTable" class="cell-border" style="width:100%">
                          <thead>
                              <tr>
                                <th>Branch Name</th>
                                  <th>Location</th>
                                  <th>Landline</th>
                                  <th>Mobile</th>
                                  <th>Login</th>
                                  <?php if($_SESSION['user_role'] == 'Admin'):?> 
                                    <th>Actions</th>
                                <?php endif;?>
                              </tr>
                          </thead>
                          <tbody id="fetchBranches" class="text-dark">

                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- end of brannch -->
    <?php else:?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
        </div>
      </div>
      
      <div class="container-fluid">
        <?php if($_SESSION['user_role'] == 'Admin'):?>
        <div class="row">
          <div class="col-lg-12 mb-4">
            <h1 class="h3 text-center"><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $_SESSION['parent_id'])?> <small><?php echo $_SESSION['user_role']?></small></h1>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo countBranchProjects($connect, $_SESSION['parent_id'], $BRANCHID)?></h3>
                <p>Add Projects</p>
              </div>
              <div class="icon">
                <i class="bi bi-bag"></i>
              </div>
              <a href="projects-add" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo countAllMembers($connect, $_SESSION['parent_id'])?></h3>

                <p>Staff Members</p>
              </div>
              <div class="icon">
                <i class="bi bi-person-plus"></i>
              </div>
              <a href="members/staff-members" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo countAllToDoTasks($connect, $_SESSION['parent_id'], $BRANCHID)?></h3>

                <p>All Todo's</p>
              </div>
              <div class="icon">
                <i class="bi bi-check2-square"></i>
              </div>
              <a href="to-do-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo countClients($connect, $_SESSION['parent_id'], $BRANCHID)?></h3>

                <p>Our Clients</p>
              </div>
              <div class="icon">
                <i class="bi bi-people"></i>
              </div>
              <a href="our-clients" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo countAllSMS($connect, $_SESSION['parent_id'])?> SMS</h3>
                <p>SMS Clients</p>
              </div>
              <div class="icon">
                <i class="bi bi-replies"></i>
              </div>
              <a href="sms-clients" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <?php else:?>
          <div class="row">
          <div class="col-lg-12 mb-4">
            <h1 class="h3 text-center"><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $_SESSION['parent_id'])?> <small><?php echo $_SESSION['user_role']?></small></h1>
          </div>
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo countBranchProjects($connect, $_SESSION['parent_id'], $BRANCHID)?></h3>
                <p>All Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="view-projects" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo countAllToDoTasks($connect, $_SESSION['parent_id'], $BRANCHID)?></h3>
                <p>All Todo's</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="to-do-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <?php endif;?>
        
            
        </section>
      </div>
    </div>
  </section>
  <?php endif;?>
  </div>

  <aside class="control-sidebar control-sidebar-dark">

  </aside>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include("footer_links.php")?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
  

  function manageBranches(){
    var xhr = new XMLHttpRequest();
    var url = 'branches/fetch-branches';
    
    xhr.open("POST", url, true);
    // var branch_name = document.getElementById('branch_name').value;
    var data = 'member_id=<?php echo $_SESSION['parent_id']?>';
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('fetchBranches').innerHTML = xhr.responseText
      }
    }
    xhr.send(data);
  }
  manageBranches();

  $(document).on("click", ".setCookies", function(e){
    e.preventDefault();
    var cvalue = $(this).data('id');
    var cname = "SelectedBrach";
    setCookie(cname, cvalue);
  })
  function setCookie(cname, cvalue) {
    event.preventDefault();
    const d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

   // ================ sumit orgdata=========
    $(document).on("submit", "#orgForm", function(e){
      e.preventDefault();
      var data = document.getElementById('orgForm');
      var formData = new FormData(data);
      $.ajax({
        url:"members/submitOrgData",
        method:'POST',
        data: formData,
        cache : false,
        processData: false,
        contentType: false,
        beforeSend:function(){
          $("#submit").html('<i class="fa fa-spinner fa-spin"></i>');
        },
        success:function(data){
          if (data === 'done') {
            successNow("Organization Information Posted");
            setTimeout(function(){
              location.reload();
            }, 1500);
          }else if (data === 'updated') {
            successNow("Organization Information Updated");
            setTimeout(function(){
              location.reload();
            }, 1500);
          }else{
            errorNow(data);
          }
        }
      })
    })

    $(document).on("click", ".editData", function(e){
      e.preventDefault();
      var organisation_id = $(this).data("id");
      $.ajax({
        url:"members/edit",
        method:"post",
        data:{organisation_id:organisation_id},
        dataType:"JSON",
        success:function(data){
          $("#org_logo").val(data.org_logo);
          $("#organisation_name").val(data.organisation_name);
          $("#admin_email").val(data.admin_email);
          $("#hq_phone").val(data.hq_phone);
          $("#hq_address").val(data.hq_address);
          $("#ID").val(data.id);
        }
      })
    })
    // sortable -------
    $(function(){
      // Make the dashboard widgets sortable Using jquery UI
      $('.connectedSortable').sortable({
        placeholder: 'sort-highlight',
        connectWith: '.connectedSortable',
        handle: '.card-header, .nav-tabs',
        forcePlaceholderSize: true,
        zIndex: 999999
      })
      $('.connectedSortable .card-header').css('cursor', 'move')

      // jQuery UI sortable for the todo list
      $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
      })

      // ###################### CREATE TASK ############
    })

    function clearForm(){
        document.getElementById('task').value = '';
        $("#task_id").val("");
    }
    $(function(){
      $(document).on("submit", "#taskForm", function(e){
        e.preventDefault();
        $.ajax({
          url:"postTask",
          method:"post",
          data:$(this).serialize(),
          success:function(data){
            if (data === "done") {
              successNow("Task Added");
              setTimeout(function(){
                fetchTasks();
              }, 1000);
              clearForm();
            }else if(data === 'updated'){
              successNow("Task Updated");
              setTimeout(function(){
                clearForm();
                fetchTasks();
              }, 1000);
            }else{
              errorNow(data);
              setTimeout(function(){
                fetchTasks();
              }, 1000);
            }
          }
        })
      })
      // ================ CHECK TASK =============

      //========= edit ==============

      $(document).on("click", ".editTask", function(e){
        e.preventDefault();
        var edit_task_id = $(this).attr("href");
        $("#modal-lg").modal("show");
        $.ajax({
            url:"editData",
            method:"post",
            data:{edit_task_id:edit_task_id},
            dataType:"JSON",
            success:function(data){
              $("#task_id").val(data.id);
              $("#task").val(data.task);
            }
          })
        })
      })

    // DELETE TASK --------

    $(document).on("click", ".deleteTask", function(e){
      e.preventDefault();
      var delete_id = $(this).attr("href");
      if (!confirm("You wish to remove the task from?")) {
        return false;
      }else{
        $.ajax({
          url:"editData",
          method:"post",
          data:{delete_id:delete_id},
          
          success:function(data){
            fetchTasks();
          }
        })
      }
    })
      

    function fetchTasks(){
      var tasks = "fetchTasks";
      var branch_id = '<?php echo $BRANCHID?>';
      $.ajax({
          url:"fetchTasks",
          method:"post",
          data:{tasks:tasks, branch_id:branch_id},
          success:function(data){
            $("#fetchTasks").html(data);
          }

        })
    }
    // fetchTasks();

    // ======= UPDATE TASK IF COMPLETED =========
    function todoCheck(taskId, status){
      if(confirm("Confirm you are changing status of the task")){
        $.ajax({
            url:"editData",
            method:"post",
            data:{taskId:taskId, status:status},
            success:function(data){
              if(data === 'updated'){
                successNow("Task Updated");
                setTimeout(function(){
                  fetchTasks();
                }, 1500);
              }
            }
          })
      }else{
        return false;
      }
    }

    // ========= ALERTS ============
     function successNow(msg){
      toastr.success(msg);
          toastr.options.progressBar = true;
          toastr.options.positionClass = "toast-top-center";
          toastr.options.showDuration = 1000;
      }

    function errorNow(msg){
    toastr.error(msg);
        toastr.options.progressBar = true;
        toastr.options.positionClass = "toast-top-center";
        toastr.options.showDuration = 1000;
    }

    // timer 
     function display_c(){
      var refresh=1000; // Refresh rate in milli seconds
      mytime=setTimeout('display_ct()',refresh)
    }

    function display_ct() {
      var x = new Date()
      document.getElementById('nowTime').innerHTML = x;
      display_c();
    }
    // display_ct();

 function fetchCompletedTasks(){
    var fetchCompletedTasks = "fetchCompletedTasks";
    var branch_id = '<?php echo $BRANCHID?>';
    $.ajax({
        url:"fetchTasks",
        method:"post",
        data:{fetchCompletedTasks:fetchCompletedTasks, branch_id:branch_id},
        success:function(data){
          $("#fetchCompletedTasks").html(data);
        }

      })
  }
  // fetchCompletedTasks();


</script>
</body>
</html>
