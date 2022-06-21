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
              <div class="col-sm-8">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                      <div class="card-header"><h5 class="text-center font-weight-light">Update Profile</h5></div>
                      <div class="card-body">
                          <form data-id="update" id="users" class="submiit" method="post" nonce="<?php echo $_SESSION['nonce'];?>">
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputName" type="text" name="username" required value="<?php echo $_SESSION['name'];?>" placeholder="Enter your name" />
                                          <label for="inputName">Name</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input class="form-control" id="inputContactnumber" type="text" placeholder="Enter your Contact number" name="contact_number" required value="<?php echo $_SESSION['contact_number'];?>" />
                                          <label for="inputContactnumber">Contact Number</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-floating mb-3">
                                  <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email_id" required value="<?php echo $_SESSION['email_id'];?>" readonly/>
                                  <label for="inputEmail">Email address</label>
                              </div>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputDateofbirth" type="date" name="date_of_birth" required value="<?php echo $_SESSION['date_of_birth'];?>"/>
                                          <label for="inputDateofbirth">Date of Birth</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                        <select  class="form-control" id="inputGender" >
                                          <?php $selec1 = ($_SESSION['gender'] == "Male") ? "selected" : "";
                                           $selec2 = ($_SESSION['gender'] == "Female") ? "selected" : "";
                                           $selec3 = ($_SESSION['gender'] == "Other") ? "selected": ""; ?>
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
                          <legend class="float-none w-auto p-2">Assigned Rights</legend>
                          <?php
                          $checked1 = ($_SESSION['can_add_user'] == '1') ? "Create User" : "";
                          $checked2 = ($_SESSION['can_update_user'] == '1') ? "Update User" : "";
                          $checked3 = ($_SESSION['can_view_user'] == '1') ? "View User" : "";
                          $checked4 = ($_SESSION['can_add_task'] == '1') ? "Add Task" : "";
                          $checked5 = ($_SESSION['can_view_task'] == '1') ? "View Task" : "";
                          $checked6 = ($_SESSION['can_update_task'] == '1') ? "Update Task" : "";
                          $checked7 = ($_SESSION['can_add_enquiry'] == '1') ? "Add Enquiry" : "";
                          $checked8 = ($_SESSION['can_view_enquiry'] == '1') ? "View Enquiry" : "";

                          ?>
                          <div id="assign_roless" class="row">
                            <div class="col-sm-4">
                              <label><?php echo $checked1; ?> </label>
                            </div>
                            <div class="col-sm-4">
                              <label><?php echo $checked2; ?></label>
                            </div>
                            <div class="col-sm-4">
                              <label><?php echo $checked3; ?></label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <label><?php echo $checked4; ?></label>
                            </div>
                            <div class="col-sm-4">
                              <label><?php echo $checked5; ?></label>
                            </div>
                            <div class="col-sm-4">
                              <label><?php echo $checked6; ?></label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <label><?php echo $checked7; ?></label>
                            </div>
                            <div class="col-sm-4">
                              <label><?php echo $checked8; ?></label>
                            </div>
                          </div>
                            </fieldset>
                              <div class="mt-4 mb-0">
                                  <div class="d-grid">
                                    <input class="btn btn-primary btn-block" type="submit" value="Update" /></div>
                              </div>
                          </form>
                      </div>

                  </div>
              </div>
              <div class="col-sm-4">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header"><h3 class="text-center font-weight-light my-4">Change Password</h3></div>
                  <div class="card-body">
                    <form id="changepass" method="post" nonce="<?php echo $_SESSION['nonce'];?>">
                      <div class="row">
                        <input type="email" hidden value="<?php echo $_SESSION['email_id']; ?>" name="email_id" id="email_id" disabled />
                        <input type="text" hidden value="<?php echo $_SESSION['mypass']; ?>" name="my_passw" id="my_passw" disabled />

                        <div class="col-sm-6"><label>Current Password<span class="text-danger">*</span></label></div>
                        <div class="col-sm-6"><input type="password" name="current_password" id="current_password" class="form-control" required="required"></div>
                      </div><br>
                      <div class="row">
                        <div class="col-sm-6"><label>New Password<span class="text-danger">*</span></label></div>
                        <div class="col-sm-6">
                          <input type="password" name="newpass" id="newpass" class="form-control" required="required"></div>
                      </div><br>
                      <div class="row">
                        <div class="col-sm-6"><label>Confirm Password<span class="text-danger">*</span></label></div>
                        <div class="col-sm-6">
                          <input type="password" name="confirmpass" id="confirmpass" class="form-control" required="required"></div>
                      </div><br>
                      <button class="btn btn-success btn-sm float-right" type="submit">Change Password</button>
                    </form>
                  </div>

              </div>
          </div>
      </div>
    </main>
    <!-- main part of add user ends here -->
  </div>
</div>
  <?php require("_foot.php"); ?>
