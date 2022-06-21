<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Enquiry List";
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
      <div class="card mb-4">
          <div class="card-header">
              <i class="fas fa-list"></i>
              Enquiry List
          </div>
          <div class="card-body table-responsive">
              <table id="datatablesSimple" class="datattable border">
                  <thead>
                      <tr>

                          <th><input type="checkbox" class='checkall' id='checkall' title="Check All"><br/><input type="button" id='delete_all_enquiry' value='Delete' class="btn btn-sm btn-danger" active_deactive='Delete' nonce=<?php echo $_SESSION['nonce'];?> ta="enquiry" ></th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact Number</th>
                          <th>Enquiried On</th>
                          <th>Enquiried Time</th>
                          <th>Added By</th>
                          <th>Added On</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                      $users = new Users;
                      $showtbl = $users->view('enquiry_tbl',' ORDER BY `added_on`','');
                      // print_r($showtbl);
                      $outp="";
                      if(is_array($showtbl)){
                      foreach ($showtbl as $key => $value) {
                        $status = ($value['status'] == '1') ? "Pending" : "Completed";
                        $outp.="<tr>";
                        $outp.="<td><input type='checkbox' class='delete_enquiry' id='delcheck_".$value['sno']."' onclick='checkcheckbox();' value='".$value['sno']."'><br/>
                        </td>
                                <td>".$value['name_of_enquiry']."</td>
                                <td>".$value['email_address']."</td>
                                <td>".$value['contact_number']."</td>
                                <td>".$value['enquired_on']."</td>
                                <td>".$value['enquired_time']."</td>
                                <td>".$showtbl = $users->view('users_tbl',"AND `email_id`='".$value['added_by']."'",'username')." </td>
                                <td>".date("d-M-Y H:i:s",strtotime($value['added_on']))."</td>
                                ";
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