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
              <div class="col-lg-7">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                      <div class="card-header"><h5 class="text-center font-weight-light">Update Profile</h5></div>
                      <div class="card-body">
                          <form>

                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputName" type="text" placeholder="Enter your first name" />
                                          <label for="inputName">Name</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input class="form-control" id="inputContactnumber" type="text" placeholder="Enter your last name" />
                                          <label for="inputContactnumber">Contact Number</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-floating mb-3">
                                  <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                  <label for="inputEmail">Email address</label>
                              </div>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputDateofbirth" type="date" />
                                          <label for="inputDateofbirth">Date of Birth</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                        <select  class="form-control" id="inputGender" >
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
                          <legend class="float-none w-auto p-2">Assigned Rights</legend>

                              <div id="assign_roless" class="row">
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>Create User</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>Update User</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>View User</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>Add Task</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>Update Task</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>View Task</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>Add Enquiry</label>
                                </div>
                                <div class="col-sm-4">
                                  <input type="checkbox" id="create_user"/>
                                  <label>View Enquiry</label>
                                </div>
                              </div>
                            </fieldset>
                              <div class="mt-4 mb-0">
                                  <div class="d-grid"><a class="btn btn-primary btn-block" type="submit">Edit user</a></div>
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
