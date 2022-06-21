<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Add User";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
  echo $buffer;
  require("_navbar.php");
  $auth = new Auth;
  $check = $auth->validate_rights('can_view_user');
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
              User List
          </div>
          <div class="card-body table-responsive">
              <table id="datatablesSimple" class="border datattable compact">
                  <thead>
                      <tr>
                          <th >Actions</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact Number</th>
                          <th>Date of Birth</th>
                          <th>Gender</th>
                          <th>Can Add user</th>
                          <th>Can Update user</th>
                          <th>Can View user</th>
                          <th>Can Add Task</th>
                          <th>Can Update Task</th>
                          <th>Can View Task</th>
                          <th>Can Add Enquiry</th>
                          <th>Can View Enquiry</th>
                          <th>Can Delete Enquiry</th>
                          <th>Added on</th>
                          <th>Added by</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $users = new Users;
                        $showtbl = $users->view('users_tbl','AND `email_id` <> "'.$_SESSION['email_id'].'"','');
                        // print_r($showtbl);
                        $outp="";
                        if (is_array($showtbl)) {

                        foreach ($showtbl as $key => $value) {
                          $croxx1 = ($value['can_add_user'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";

                          $croxx2 = ($value['can_view_user'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx3 = ($value['can_update_user'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx4 = ($value['can_add_task'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx5 = ($value['can_update_task'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx6 = ($value['can_view_task'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx7 = ($value['can_add_enquiry'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx8 = ($value['can_view_enquiry'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $croxx9 = ($value['can_delete_enquiry'] == '0') ? "<i class='fa fa-close text-danger'></i>" : "<i class='fa fa-check text-success'></i>";
                          $status = ($value['status'] == '0') ? "Deactive" : "Active";
                          $outp.="<tr>";
                          $outp.="<td class='center'>";
                          if ($_SESSION['can_update_user'] == '1'){
                                $outp.="<a href='edit_user.php?id=".$value["email_id"]."'><i class='fa fa-edit'></i></a>";
                              }
                                $outp.="</td><td>".$value['username']."</td>
                                  <td>".$value['email_id']."</td>
                                  <td>".$value['contact_number']."</td>
                                  <td>".$value['date_of_birth']."</td>
                                  <td>".$value['gender']."</td>
                                  <td>".$croxx1."</td>
                                  <td>".$croxx3."</td>
                                  <td>".$croxx2."</td>
                                  <td>".$croxx4."</td>
                                  <td>".$croxx5."</td>
                                  <td>".$croxx6."</td>
                                  <td>".$croxx7."</td>
                                  <td>".$croxx8."</td>
                                  <td>".$croxx9."</td>
                                  <td>".$showtbl = $users->view('users_tbl',"AND `email_id`='".$value['added_by']."'",'username')."</td>
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
