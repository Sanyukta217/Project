<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Add Enquiry";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
  echo $buffer;
  require("_navbar.php");
  $auth = new Auth;
  $check = $auth->validate_rights('can_add_enquiry');
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
                      <div class="card-header"><h5 class="text-center font-weight-light">Add Enquiry</h5></div>
                      <div class="card-body">
                        <form data-id="insert" id="enquiry" class="submiit" method="post" nonce="<?php echo $_SESSION['nonce'];?>">

                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputName" type="text" placeholder="Enter name" required name="name_of_enquiry"/>
                                          <label for="inputName">Name</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input class="form-control" id="inputContactnumber" type="text" placeholder="Conatct Number" required name="contact_number" />
                                          <label for="inputContactnumber">Contact Number</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-floating mb-3">
                                  <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" required name="email_address" />
                                  <label for="inputEmail">Email address</label>
                              </div>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="enquired_on" type="date" required name="enquired_on"/>
                                          <label for="inputDateofbirth">Enquiry on</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                      <input class="form-control" type="time" id="enquired_time" name="enquired_time" required title="Time in 12 hour format">
                                        <label for="inputDateofbirth">Enquiry time</label>
                                    </div>
                                  </div>
                              </div>
                              <div class="mt-4 mb-0">
                                  <div class="d-grid">
                                    <input class="btn btn-sm btn-primary btn-block" type="submit" value="Add"/></div>
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
