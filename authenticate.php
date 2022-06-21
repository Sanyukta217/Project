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
 }

 ?>
