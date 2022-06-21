<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Add Task";
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
                      <div class="card-header"><h5 class="text-center font-weight-light">Add Task</h5></div>
                      <div class="card-body">
                        <form data-id="insert" id="task" class="submiit" method="post" nonce="<?php echo $_SESSION['nonce'];?>">
                              <div class="row mb-3">
                                  <div class="col-md-12">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputTitle" name="task_title" required type="text" placeholder="Enter task title" />
                                          <label for="inputTitle">Task title</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-floating">
                                          <textarea class="form-control" id="inputTaskDesc" name="task_desc" placeholder="Enter your last name" row="5"> </textarea>
                                          <label for="inputTaskDesc">Task Description</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="mt-4 mb-0">
                                  <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Add Task"/></div>
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
