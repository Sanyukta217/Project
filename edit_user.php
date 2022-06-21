<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Edit User";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
  echo $buffer;
  require("_navbar.php");
  $auth = new Auth;
  $check = $auth->validate_rights('can_update_user');
  if ($check == '0'){
   header('Location: 404.php');
  }
  if(isset($_GET['id'])){
    $users = new Users;
    $showuser = $users->view('users_tbl','AND `email_id` = "'.$_GET['id'].'"','');
    // print_r($showuser);
  }
?>
<style>

</style>
<div id="layoutSidenav">
  <?php require("_side_nav.php"); ?>
  <div id="layoutSidenav_content">
    <!-- main part of add user starts here -->
    <main class="mt-3">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-sm-12">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                      <div class="card-header"><h5 class="text-center font-weight-light">Edit User (<?php echo $users->view('users_tbl','AND `email_id` = "'.$_GET['id'].'"','username');?>)</h5></div>
                      <div class="card-body">
                        <form data-id="update" id="users" class="submiit" method="post" nonce="<?php echo $_SESSION['nonce'];?>">
                            <?php foreach ($showuser as $key => $value):
                              $name = $value['username'];
                              ?>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control allow-alphanumeric" id="inputName" type="text" placeholder="Enter your first name" name="username" required  value="<?php echo $name;?>" minlength="3"/>
                                          <label for="inputName">Name</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input class="form-control" id="inputContactnumber" type="text" name="contact_number" placeholder="Enter your last name" required value="<?php echo $value['contact_number']; ?>" minlength="10" maxlength="10"/>
                                          <label for="inputContactnumber">Contact Number</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-floating mb-3">
                                  <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email_id" required value="<?php echo $value['email_id']; ?>" readonly/>
                                  <label for="inputEmail">Email address</label>
                              </div>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputDateofbirth" type="date" name="date_of_birth" required value="<?php echo $value['date_of_birth']; ?>"/>
                                          <label for="inputDateofbirth">Date of Birth</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                        <select  class="form-control" id="inputGender" name="gender" required>
                                        <?php $selec1 = ($value['gender'] == "Male") ? "selected" : "";
                                         $selec2 = ($value['gender'] == "Female") ? "selected" : "";
                                         $selec3 = ($value['gender'] == "Other") ? "selected": ""; ?>
                                        <option <?php echo $selec1; ?>>Male</option>
                                        <option <?php echo $selec2; ?>>Female</option>
                                        <option <?php echo $selec3; ?>>Other</option>
                                  </select>
                                  <label for="inputGender">Gender</label>
                                      </div>
                                  </div>
                              </div>
                              <hr/>

                        <fieldset class="form-group border p-3">
                          <legend class="float-none w-auto p-2">Assign Rights</legend>
                            <?php
                            $checked1 = ($value['can_add_user'] == '1') ? "checked='checked'" : "";
                            $checked2 = ($value['can_update_user'] == '1') ? "checked='checked'" : "";
                            $checked3 = ($value['can_view_user'] == '1') ? "checked='checked'" : "";
                            $checked4 = ($value['can_add_task'] == '1') ? "checked='checked'" : "";
                            $checked5 = ($value['can_view_task'] == '1') ? "checked='checked'" : "";
                            $checked6 = ($value['can_update_task'] == '1') ? "checked='checked'" : "";
                            $checked7 = ($value['can_add_enquiry'] == '1') ? "checked='checked'" : "";
                            $checked8 = ($value['can_view_enquiry'] == '1') ? "checked='checked'" : "";
                            $checked9 = ($value['can_delete_enquiry'] == '1') ? "checked='checked'" : "";


                            ?>
                            <div id="assign_roless" class="row">
                              <div class="col-sm-4">
                                <input type="checkbox" id="create_user" name="can_add_user" value="1" <?php echo $checked1; ?> />
                                <label>Create User</label>
                              </div>
                              <div class="col-sm-4">
                                <input type="checkbox" id="update_user" name="can_update_user" value="1" <?php echo $checked2; ?>/>
                                <label>Update User</label>
                              </div>
                              <div class="col-sm-4">
                                <input type="checkbox" id="view_user" name="can_view_user" value="1" <?php echo $checked3; ?>/>
                                <label>View User</label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-4">
                                <input type="checkbox" id="add_task" name="can_add_task" value="1" <?php echo $checked4; ?>/>
                                <label>Add Task</label>
                              </div>
                              <div class="col-sm-4">
                                <input type="checkbox" id="update_task" name="can_update_task" value="1" <?php echo $checked5; ?>/>
                                <label>Update Task</label>
                              </div>
                              <div class="col-sm-4">
                                <input type="checkbox" id="view_task" name="can_view_task" value="1" <?php echo $checked6; ?>/>
                                <label>View Task</label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-4">
                                <input type="checkbox" id="add_enquiry" name="can_add_enquiry" value="1" <?php echo $checked7; ?>/>
                                <label>Add Enquiry</label>
                              </div>
                              <div class="col-sm-4">
                                <input type="checkbox" id="view_enquiry" name="can_view_enquiry" value="1" <?php echo $checked8; ?>/>
                                <label>View Enquiry</label>
                              </div>
                              <div class="col-sm-4">
                                <input type="checkbox" id="delete_enquiry" name="can_delete_enquiry" value="1" <?php echo $checked9; ?>/>
                                <label>Delete Enquiry</label>
                              </div>
                            </div>
                          </fieldset>
                            <?php endforeach; ?>
                              <div class="mt-4 mb-0">
                                  <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Update user"/></div>
                              </div>
                          </form>
                      </div>

                  </div>
              </div>
          </div>
      </div>
    </main>
    <!-- main part of add user ends here -->
  </div>
</div>
  <?php require("_foot.php"); ?>
