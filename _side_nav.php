    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Home
                    </a>
                    <!-- <div class="sb-sidenav-menu-heading">A</div> -->
                    
                    <?php if((!empty($_SESSION['can_add_user']) && $_SESSION['can_add_user'] == "1") || (!empty($_SESSION['can_view_user']) && $_SESSION['can_view_user'] == "1") || (!empty($_SESSION['can_update_user']) && $_SESSION['can_update_user'] == "1")) : ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                          <?php if(!empty($_SESSION['can_add_user']) && $_SESSION['can_add_user'] == "1") : ?>
                            <a class="nav-link" href="add_user.php">Add User</a>
                          <?php endif ?>
                          <?php if((!empty($_SESSION['can_update_user']) && $_SESSION['can_update_user'] == "1") || (!empty($_SESSION['can_view_user']) && $_SESSION['can_view_user'] == "1")) : ?>
                            <a class="nav-link" href="users.php">User List</a>
                          <?php endif ?>
                        </nav>
                    </div>
                  <?php endif ?>
                    <?php if((!empty($_SESSION['can_add_task']) && $_SESSION['can_add_task'] == "1") || (!empty($_SESSION['can_view_task']) && $_SESSION['can_view_task'] == "1") || (!empty($_SESSION['can_update_task']) && $_SESSION['can_update_task'] == "1")) : ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Task
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <?php if(!empty($_SESSION['can_add_task']) && $_SESSION['can_add_task'] == "1") : ?>
                            <a class="nav-link" href="add_task.php">Add Task</a>
                          <?php endif ?>
                          <?php if((!empty($_SESSION['can_view_task']) && $_SESSION['can_view_task'] == "1") || (!empty($_SESSION['can_update_task']) && $_SESSION['can_update_task'] == "1")) : ?>
                              <a class="nav-link" href="tasks.php">Task List</a>
                          <?php endif ?>
                      </nav>
                    </div>
                  <?php endif ?>
                  <?php if((!empty($_SESSION['can_add_enquiry']) && $_SESSION['can_add_enquiry'] == "1") || (!empty($_SESSION['can_view_enquiry']) && $_SESSION['can_view_enquiry'] == "1") || (!empty($_SESSION['can_delete_enquiry']) && $_SESSION['can_delete_enquiry'] == "1")) : ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEnquiry" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                        Enquiry
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseEnquiry" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                        <?php if(!empty($_SESSION['can_add_enquiry']) && $_SESSION['can_add_enquiry'] == "1") : ?>
                          <a class="nav-link" href="add_enquiry.php">Add Enquiry</a>
                        <?php endif ?>
                        <?php if((!empty($_SESSION['can_view_enquiry']) && $_SESSION['can_view_enquiry'] == "1") || (!empty($_SESSION['can_delete_enquiry']) && $_SESSION['can_delete_enquiry'] == "1")) : ?>
                          <a class="nav-link" href="enquiry.php">Enquiry List</a>
                        <?php endif ?>
                      </nav>
                    </div>
                  <?php endif ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php
                if(session_id() == '') {
          			    session_start();
          			}
                echo ucwords($_SESSION['name']);
                ?>
            </div>
        </nav>
    </div>
