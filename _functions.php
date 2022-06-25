<?php
//Check if the session has started
//If not, start the session
if(session_id() == '') {
    session_start();
}

(!isset($_POST['nonce'])) ? die('You are not on a valid location') : "";

//To connect with the dbconnection file
if (!defined('READCON')) {
  define('READCON', true);
}
require_once('connect.php');
//Check if the nounce is correct

$conn = new Con;
$connection = $conn->connect();
$varification =new Varification;
if ($varification->validatenonce($_POST['nonce'])) {
  //echo "OK";
}else{
  die('Your request is coming from a wrong route!');
}

if(isset($_POST['data']) && isset($_POST['type']) && isset($_POST['action'])){

 if($_POST['action'] == "insert"){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    //echo $_POST['data'];
    $decoded = json_decode($_POST['data'],true);
    $values="";
    $columns = "";
    $column=""; $col="";
    $values=""; $val="";
    foreach ($decoded as $key => $value) {
        //get column name of each field. Make sure the name attribute in html form is same as the name of column in database
        $col = mysqli_real_escape_string($GLOBALS['connection'], $value['name']);
        $val = mysqli_real_escape_string($GLOBALS['connection'], $value['value']);
        if($col == "email_id"){
          $email_id = $val;
        }
        if($col == "contact_number"){
          $contact = $val;
        }

        if($col == 'password'){
          $column.= "`".$col."`,";
            $values.= "'".md5($val)."',";
        }
        else{
            $column.= "`".$col."`,";
            $values.= "'".$val."',";
        }
        //$update .= "`".$col."`='".$val."',";
    }
    // echo $values;

    // Generate query based on data received and table that is required to insert data into.
    $added_by = $_SESSION['email_id'];
    if($_POST['type'] == "users"){
      $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
      $password_mail =  substr(str_shuffle($data), 0, 7);
      $password = md5($password_mail);
      $query = "INSERT INTO `".mysqli_real_escape_string($GLOBALS['connection'], $_POST['type'])."_tbl`  (".rtrim($column,',').",`password`,`added_by`) VALUES (".rtrim($values,",").",'".$password."','".$added_by."')";
    }
    else{
      $query = "INSERT INTO `".mysqli_real_escape_string($GLOBALS['connection'], $_POST['type'])."_tbl`  (".rtrim($column,',').",`added_by`) VALUES (".rtrim($values,",").",'".$added_by."')";
    }

    $result = mysqli_query($GLOBALS['connection'], $query);

// }
//echo $query;

      if($result){
          if($_POST['type'] == "users"){

              $to = $email_id;
              $subject = 'Added as new user';
              $message = 'Hello User
              Your password : '.$password.'
              E-mail: '.$email_id.'
              Now you can login with this email and password.';
              /* Send the message using mail() function */
              if(@mail($to, $subject, $message ))
              {
              //echo "New Password has been sent to your mail, Please check your mail and SignIn.";
              }
            }
          echo "Successful";
        }
        else{
          echo "Some error occured ".mysqli_error($GLOBALS['connection']);
        }

    }
  if($_POST['action'] == "update"){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
   //require_once('../_connection.php');

        // decode JSON string to PHP object, 2nd param sets to associative array
    $decoded = json_decode($_POST['data'],true);
    $sno = "";
    $values="";
    $columns = "";
    $comb="";
    $uni="";
    $password = "";
    foreach ($decoded as $key => $value) {
      $col = mysqli_real_escape_string($GLOBALS['connection'], $value['name']);
      $val = mysqli_real_escape_string($GLOBALS['connection'], $value['value']);
    	  if($value['name']=='email_id'){
                $sno = $value['value'];
                $uni = "email_id";
                // $col = "";
                // $val = "";
                $comb.="";
        }
        else{
          $comb.= "`".$col."`='".$val."',";
        }
        if($value['name']=='sno'){
                $sno = $value['value'];
                $uni = "sno";
        }

        if($value['name']=='password'){
                $password = $value['value'];
        }
        // $comb.= "`".$col."`='".$val."',";
    }
    $todayDate = date("Y-m-d H:i:s");


    $query = "UPDATE `".mysqli_real_escape_string($GLOBALS['connection'], $_POST['type'])."_tbl` SET ".rtrim($comb,',').",`updated_by`='".$_SESSION['email_id']."',`updated_on`='".$todayDate."' WHERE `".$uni."`='".$sno."'";
    // echo $query;

    $result = mysqli_query($GLOBALS['connection'], $query);
    if($result){
      echo "Successful";
    }else{
      echo "Unable to process at this moment";
    }

  } //update post checj
  // data post check
}

//approve user

if (isset($_POST['for']) && $_POST['for']=='delete_enquiry') {
$active_deactive = Con::esc_str($_POST['active_deactive']);
$t = Con::esc_str($_POST['t']);
$upatedDate = date("Y-m-d H:i:s");
$approveids_arr = array();

   if(isset($_POST['approveids_arr'])){
      $approveids_arr = $_POST['approveids_arr'];
   }
   if($active_deactive == "Delete"){
     $status = '1';
     $message = 'Deleted Successfully';
   }
   foreach($approveids_arr as $userid){
     $sqlDelte = "DELETE FROM `".$t."_tbl` WHERE `sno`='".$userid."'";
     $resEDEl = mysqli_query($GLOBALS['connection'],$sqlDelte);
     if($resEDEl){
       echo $message;
     }
     else{
       echo "Try again";
     }
     exit;
   }
 }

 if (isset($_POST['for']) && $_POST['for']=='update_task') {
 $active_deactive = Con::esc_str($_POST['active_deactive']);
 $t = Con::esc_str($_POST['t']);
 $upatedDate = date("Y-m-d H:i:s");
 $approveids_arr = array();

    if(isset($_POST['approveids_arr'])){
       $approveids_arr = $_POST['approveids_arr'];
    }
    if($active_deactive == "Update"){
      $status = '0';
      $message = 'Completed';
    }
    foreach($approveids_arr as $userid){
      $sqlDone = "UPDATE `".$t."_tbl` SET `status` ='".$status."' WHERE `sno`='".$userid."'";
      $resDone = mysqli_query($GLOBALS['connection'],$sqlDone);
      if($resDone){
        // echo $message;
        if (!defined('READAUTh')) {
          define('READAUTh', true);
        }
        require_once('authenticate.php');
        $users = new Users;
        $showtbl = $users->view('task_tbl','AND `added_by` = "'.$_SESSION['email_id'].'" ORDER BY `added_on`','');
        // print_r($showtbl);
        $outp="";
        if(is_array($showtbl)){
        foreach ($showtbl as $key => $value) {
          $status = ($value['status'] == '1') ? "Pending" : "Completed";
          $check = ($value['status'] == '1') ? "<input type='checkbox' class='mark_done' value='".$value['sno']."' nonce='".$_SESSION['nonce']."' ta='task' active_deactive='Update' title='Check to mark completed'/>" : "";

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
      }
      else{
        echo "Try again";
      }
      exit;
    }
  }

  if (isset($_POST['for']) && $_POST['for']=='change_passowrd') {
    $email = Con::esc_str($_POST['email']);
    $password = Con::esc_str($_POST['password']);
    $currpass = Con::esc_str($_POST['current_password']);
    $sqlSel = "SELECT * FROM `users_tbl` WHERE `email_id` = '".$email."' AND `password`='".md5($currpass)."'";
    // echo $sqlSel;
    $showtbl = mysqli_query($GLOBALS['connection'],$sqlSel);

    if($showtbl && mysqli_num_rows($showtbl) == '1'){
      $sqlUpdatePass = "UPDATE `users_tbl` SET `password` = '".md5($password)."' WHERE `email_id`='".$email."'";
       $res = mysqli_query($GLOBALS['connection'], $sqlUpdatePass);
       if($res){
         $to = $email;
         $subject = 'Your password has been changed';
         $message = 'Hello User \n
         Your password has been changed recently. Please login in with new password.';
         /* Send the message using mail() function */
         if(@mail($to, $subject, $message ))
         {


         //echo "New Password has been sent to your mail, Please check your mail and SignIn.";
         }
         echo "Done";
       }
       else{
         echo "Try again";
       }
    }
    else{
      echo "Current Password is not correct";
    }

  }
