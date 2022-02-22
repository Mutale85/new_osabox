<?php 
  require ("../includes/db.php");
  if (!isset($_COOKIE['userLoggedin']) && !isset($_SESSION['email'])) {?>
      <script>
          window.location = '../';
      </script>
  <?php
    } 
  $option = '';
  $query = $connect->prepare("SELECT * FROM currencies");
  $query->execute();
  foreach ($query->fetchAll() as $row) {
    $option .= '<option value="'.$row['code'].'">'.$row['code'].'</option>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("links.php") ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  <style>
    .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #ff80ac;
        height: 38px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline {
        width: 100%;
        margin-left: .375rem;
        height: 38px;
    }
    .select2-container--default .select2-selection--single {
        background-color: #f8f9fa;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 38px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        box-sizing: border-box;
        list-style: none;
        margin: 0;
        padding: .4em;
        width: 100%;
    }

  </style>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <div class="mb-4">
              <!-- <h2 class="h4">Set Up Currency:</h2> -->
              <form method="post" class="form-inlines">
                <div class="form-group">
                  <label>Currency Set Up</label>
                  <select class="form-control select2" id="currency" style="width: 100%">
                    <?php echo $option?>
                  </select>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="container-fluid">
        <?php if($_SESSION['user_role'] == 'Admin'):?>
        <div class="row">
          <div class="col-lg-12 mb-4">
            <h1 class="h3 text-center"><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $_SESSION['parent_id'])?> <small><?php echo $_SESSION['user_role']?></small></h1>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo countBorrowers ($connect, $_SESSION['parent_id'])?></h3>

                <p>Registered Clients</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="borrowers/all-borrowers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo countIncomeSources($connect, $_SESSION['parent_id'])?></h3>

                <p>Added Incomes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="expenses/add_expenses" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo countAllMembers($connect, $_SESSION['parent_id'])?></h3>

                <p>Staff Members</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="members/staff-members" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo countAllLoans($connect, $_SESSION['parent_id'])?></h3>

                <p>All Loans</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="loans/view_loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <h3><?php echo countBorrowers ($connect, $_SESSION['parent_id'])?></h3>

                <p>Registered Clients</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="borrowers/all-borrowers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo countAllLoans($connect, $_SESSION['parent_id'])?></h3>

                <p>All Loans</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="loans/view_loans" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <?php endif;?>
        
            
        </section>
        <section class="connectedSortable container-fluid">
          <div class="row">
            <div class="col-lg-6 mb-4 mt-5 connectedSortable ">
              <?php include("todolist.php")?>
            </div>
            <div class="col-md-6 mt-5 connectedSortable">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Accomplished Tasks</h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list" id="fetchCompletedTasks"></ul>
                </div>
              </div>
            </div>
            
          </div>
        </section>

          <section class="connectedSortable">
            <div class="container-fluid border-top pt-3">
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-info">
                    <div class="card-header">
                      <h4 class="card-title">Organization Form</h4>
                      <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <form method="post" id="orgForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Logo</label>
                          <input type="file" name="org_logo" name="org_logo" class="form-controls" accept="image/png, image/jpg, image/jpeg">
                          <!-- <input type="" name=""> -->
                        </div>
                        <div class="form-group">
                          <label>Organization Name</label>
                          <input type="text" name="organisation_name" id="organisation_name" class="form-control">
                          <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
                          <input type="hidden" name="ID" id="ID" value="">
                        </div>
                        <div class="form-group">
                          <label>HQ Email</label>
                          <input type="text" name="admin_email" id="admin_email" class="form-control" value="<?php echo $_SESSION['email']?>" required>
                          <!-- <input type="text" name="admin_password" id="admin_password" class="form-control" value="<?php echo $_SESSION['password']?>"> -->
                        </div>
                        <div class="form-group">
                          <label>HQ Phone</label>
                          <input type="text" name="hq_phone" id="hq_phone" class="form-control" value="" required>
                        </div>
                        <div class="form-group">
                          <label>HQ Address</label>
                          <textarea name="hq_address" id="hq_address" class="form-control" rows="2" required></textarea>
                        </div>
                        <button class="btn btn-info shadow" type="submit" id="submit">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-info">
                    <div class="card-header">
                      <h4 class="card-title">Organization</h4>
                      <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <?php
                        $query = $connect->prepare("SELECT * FROM `organisations` WHERE parent_id = ? ");
                        $query->execute(array($_SESSION['parent_id']));
                        if ($query->rowCount() > 0) {
                          $row = $query->fetch();
                          if ($row) {?>
                            <img src="members/adminphotos/<?php echo $row['org_logo']?>" alt="<?php echo $row['org_logo']?>" class="img-fluid img-responsive" width="80">
                            <address>
                                <strong><?php echo $row['organisation_name'] ?></strong><br>
                                <?php echo nl2br($row['hq_address']) ?><br>
                                
                                Phone: <?php echo $row['hq_phone']?><br>
                                Email: <?php echo $row['admin_email']?>
                              </address>
                                  <a href="" class="editData" data-id="<?php echo $row['id']?>">Edit</a>
                        <?php }
                        }else{
                          echo '<h4>Add Organization\'s Data</h4>';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">

  </aside>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include("footer_links.php")?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
  var input = document.getElementById('currency');
  input.onchange = function () {
    localStorage['currency_main'] = this.value;
    
  }
  document.addEventListener('DOMContentLoaded', function () {
     var input = document.getElementById('currency');
     if (localStorage['currency_main']) { 
         input.value = localStorage['currency_main'];
     }
     input.onchange = function () {
          localStorage['currency_main'] = this.value;
      }
  });

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
          url:"projects/postTask",
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
            url:"projects/editData",
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
          url:"projects/editData",
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
      $.ajax({
          url:"projects/fetchTasks",
          method:"post",
          data:{tasks:tasks},
          success:function(data){
            $("#fetchTasks").html(data);
          }

        })
    }
    fetchTasks();

    // ======= UPDATE TASK IF COMPLETED =========
    function todoCheck(taskId, status){
      if(confirm("Confirm you are changing status of the task")){
        $.ajax({
            url:"projects/editData",
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
    display_ct();

 function fetchCompletedTasks(){
    var fetchCompletedTasks = "fetchCompletedTasks";
    $.ajax({
        url:"projects/fetchTasks",
        method:"post",
        data:{fetchCompletedTasks:fetchCompletedTasks},
        success:function(data){
          $("#fetchCompletedTasks").html(data);
        }

      })
  }
  fetchCompletedTasks();


</script>
</body>
</html>
