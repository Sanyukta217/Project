<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Tasks";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
  echo $buffer;
  require("_navbar.php");
  $auth = new Auth;
  $check = $auth->validate_rights('can_view_task');
  if ($check == '0'){
   header('Location: 404.php');
  }
?>
<style>

</style>
<div id="layoutSidenav">
  <?php require("_side_nav.php"); ?>
  <div id="layoutSidenav_content">
    <!-- main part of add user starts here -->
    <main class="mt-3">
      <div class="card mb-4">
          <div class="card-header">
              <i class="fas fa-users"></i>
              Task List
          </div>
          <div class="card-body table-responsive">
              <table id="taskList" class="border datattable nowrap compact">
                  <thead>
                      <tr>
                          <th>Actions</th>
                          <th>Task title</th>
                          <th>Description</th>
                          <th>Added by</th>
                          <th>Added on</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                      $users = new Users;
                      $showtbl = $users->view('task_tbl','AND `added_by` = "'.$_SESSION['email_id'].'" ORDER BY `added_on`','');
                      // print_r($showtbl);
                      $outp="";
                      if(is_array($showtbl)){
                      foreach ($showtbl as $key => $value) {
                        $status = ($value['status'] == '1') ? "Pending" : "Completed";
                        $check="";
                        if ($_SESSION['can_update_task'] == '1'){
                          $check = ($value['status'] == '1') ? "<input type='checkbox' class='mark_done' value='".$value['sno']."' title='Check to mark completed' nonce='".$_SESSION['nonce']."' ta='task' active_deactive='Update'/>" : "";
                        }
                        $outp.="<tr>";
                        $outp.="<td>".$check."</td>
                                <td>".$value['task_title']."</td>
                                <td>".$value['task_desc']."</td>
                                <td>".$showtbl = $users->view('users_tbl',"AND `email_id`='".$value['added_by']."'",'username')." </td>
                                <td>".date("d-M-Y H:i:s",strtotime($value['added_on']))."</td>
                                <td>".$status."</td>";
                        $outp.="</tr>";

                      }
                      echo $outp;
                    }
                     ?>
                  </tbody>
              </table>
          </div>
        </div>
    </main>
    <!-- main part of add user ends here -->
  </div>
</div>
  <?php require("_foot.php"); ?>
