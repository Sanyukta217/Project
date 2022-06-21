<?php
/**
* Connection Page for MySQL connection
*/
if(session_id() == '') {
    session_start();
}
defined('READAUTh') or die('Not authorised');
/**
 * Connection to DB class
 */
 date_default_timezone_set('Asia/Kolkata');
 $_SESSION['nonce'] = md5(rand(11111,99999));
 //To connect with the dbconnection file
 if (!defined('READCON')) {
   define('READCON', true);
 }
 require_once('connect.php');
 //Check if the nounce is correct

 $conn = new Con;
 $connection = $conn->connect();
 class Users extends Con{
   function view($tbl,$cond,$return=''){
     $sqlSelct = "SELECT * FROM `".$tbl."` WHERE 1 ".$cond."";
     // echo $sqlSelct;
     $resSelect = mysqli_query($GLOBALS['connection'],$sqlSelct);
     if($resSelect && mysqli_num_rows($resSelect) > 0){
       if($return == ""){
         $retyrn = array();
       }
       else{
         $retyrn = "";
       }
       while ($rowSql = mysqli_fetch_array($resSelect)) {
         if($return == ""){
           $retyrn[]= $rowSql;
         }
         else{
           $retyrn = $rowSql[$return];
         }
       }
       return $retyrn;
     }
   }
   function count($tbl, $cond){
     $sqlSelct = "SELECT * FROM `".$tbl."` WHERE 1 ".$cond."";
     // echo $sqlSelct;
     $resSelect = mysqli_query($GLOBALS['connection'],$sqlSelct);
     if($resSelect && mysqli_num_rows($resSelect) > 0){
       return mysqli_num_rows($resSelect);
     }
     else{
       return 0;
     }
   }
 }

 /**
  *
  */
 class Auth extends Con
 {
   function validate_rights($rights){
     $sqlRights = "SELECT * FROM `users_tbl` WHERE `email_id`='".$_SESSION['email_id']."'";
     $resRighs = mysqli_query($GLOBALS['connection'],$sqlRights);
     if($resRighs && mysqli_num_rows($resRighs)){
       $rowRights = mysqli_fetch_array($resRighs);
       if($rowRights[$rights] == "1"){
         return 1;
       }
       else{
         return 0;
       }
     }
   }
   function fetchRights($email){
     if(session_id() == '') {
         session_start();
     }
     $sqlRights = "SELECT * FROM `users_tbl` WHERE `email_id`='".$_SESSION['email_id']."'";
     $resRighs = mysqli_query($GLOBALS['connection'],$sqlRights);
     if($resRighs && mysqli_num_rows($resRighs)){
       $rowLogin = mysqli_fetch_array($resRighs);
       $_SESSION['can_add_user'] = $rowLogin['can_add_user'];
       $_SESSION['can_view_user'] = $rowLogin['can_view_user'];
       $_SESSION['can_update_user'] = $rowLogin['can_update_user'];
       $_SESSION['can_delete_user'] = $rowLogin['can_delete_user'];
       $_SESSION['can_add_enquiry'] = $rowLogin['can_add_enquiry'];
       $_SESSION['can_view_enquiry'] = $rowLogin['can_view_enquiry'];
       $_SESSION['can_delete_enquiry'] = $rowLogin['can_delete_enquiry'];
       $_SESSION['can_add_task'] = $rowLogin['can_add_task'];
       $_SESSION['can_view_task'] = $rowLogin['can_view_task'];
       $_SESSION['can_update_task'] = $rowLogin['can_update_task'];
     }
   }
 }


 ?>
