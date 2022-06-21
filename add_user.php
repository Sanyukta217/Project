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

  $check = $auth->validate_rights('can_add_user');
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
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-7">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                      <div class="card-header"><h5 class="text-center font-weight-light">Add User</h5></div>
                      <div class="card-body">
                          <form data-id="insert" id="users" class="submiit" method="post" nonce="<?php echo $_SESSION['nonce'];?>">

                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputName" type="text" placeholder="Enter your first name" name="username" required/>
                                          <label for="inputName">Name</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input class="form-control" id="inputContactnumber" type="text" name="contact_number" placeholder="Enter your conatact number" required/>
                                          <label for="inputContactnumber" >Contact Number</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-floating mb-3">
                                  <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email_id" required/>
                                  <label for="inputEmail">Email address</label>
                              </div>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputDateofbirth" type="date" name="date_of_birth" required/>
                                          <label for="inputDateofbirth">Date of Birth</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                        <select  class="form-control" id="inputGender" name="gender" required>
                                          <option>Male</option>
                                          <option>Female</option>
                                          <option>Other</option>
                                        </select>
                                        <label for="inputGender">Gender</label>
                                      </div>
                                  </div>
                              </div>
                              <hr/>

                        <fieldset class="form-group border p-3">
                          <legend class="float-none w-auto p-2">Assign Rights</legend>

                              <div id="assign_roless" class="row">
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user" name="can_add_user" value="1"/>
                                  <label>Create User</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="update_user" name="can_update_user" value="1"/>
                                  <label>Update User</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="view_user" name="can_view_user" value="1"/>
                                  <label>View User</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-4">
                                  <input type="checkbox" id="add_task" name="can_add_task" value="1"/>
                                  <label>Add Task</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="update_task" name="can_update_task" value="1"/>
                                  <label>Update Task</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="view_task" name="can_view_task" value="1"/>
                                  <label>View Task</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-4">
                                  <input type="checkbox" id="add_enquiry" name="can_add_enquiry" value="1"/>
                                  <label>Add Enquiry</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="view_enquiry" name="can_view_enquiry" value="1"/>
                                  <label>View Enquiry</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="delete_enquiry" name="can_delete_enquiry" value="1"/>
                                  <label>Delete Enquiry</label>
                                </div>
                              </div>
                            </fieldset>
                              <div class="mt-4 mb-0">
                                  <div class="d-grid">
                                    <input type="submit" class="btn btn-primary btn-block" value="Add user"/></div>
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
