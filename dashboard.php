<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Dashboard";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
  echo $buffer;
  if (!isset($_SESSION['logged']) || $_SESSION['logged']!='in') {
  	header('Location: ./index.php');
  }
  require("_navbar.php");
?>

<div id="layoutSidenav">
  <?php require("_side_nav.php"); ?>
  <div id="layoutSidenav_content">
    <!-- main part of dashboard starts here -->
    <main class="mt-3">
        <div class="container-fluid px-4">

            <ol class="breadcrumb  mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                        <b style="font-size:26px;">
                        <?php
                        $users = new Users;
                        $showtbl2 = $users->count('users_tbl','');
                        echo $showtbl2; ?></b> User(s)</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="users.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><b style="font-size:26px;">
                        <?php
                        $users = new Users;
                        $showtbl2 = $users->count('task_tbl',' AND `status`="0"');
                        echo $showtbl2; ?></b> Task(s) Completed</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="tasks.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body"><b style="font-size:26px;">
                        <?php
                        $users = new Users;
                        $showtbl2 = $users->count('task_tbl',' AND `status`="1"');
                        echo $showtbl2; ?></b> Task(s) Pending</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="tasks.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                          <b style="font-size:26px;">
                          <?php
                          $users = new Users;
                          $showtbl2 = $users->count('enquiry_tbl','');
                          echo $showtbl2; ?></b> Enquiry</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="enquiry.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Enquiry
                        </div>
                        <div class="card-body"> <div id="myAreaChart2" style="width:400; height:300"></div></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Task Completed
                        </div>
                        <div class="card-body"><div id="myAreaChart" style="width:400; height:300"></div></div>
                    </div>
                </div>
            </div>
          </div>
        </main>
    <!-- main part of dashboard ends here -->
  </div>
</div>
  <?php require("_foot.php"); ?>
