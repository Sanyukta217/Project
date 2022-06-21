<?php
/**
* Connection Page for MySQL connection
*/
if(session_id() == '') {
    session_start();
}
defined('READCON') or die('Connection not authorised');
define("database","demo");
/**
 * Connection to DB class
 */
class Con
{
	function connect (){
		$connection = mysqli_connect('localhost','root','',constant("database")) or die('Database connection error!');
		return $connection;
	}
		//This function is used to create escape string.
	function esc_str($str){
		return mysqli_real_escape_string(Con::connect(), $str);
	}

	//this function is used to check email address
	function c_email($str){
		// Remove all illegal characters from email
		$email = filter_var($str, FILTER_SANITIZE_EMAIL);
		// Validate e-mail
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		  return true;
		} else {
		  return false;
		}
	}
  //this function is used to check numbers
	function c_number($str){
		// Remove all illegal characters from email
		$number = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
		// Validate e-mail
		if (!filter_var($email, FILTER_SANITIZE_NUMBER_INT) === false) {
		  return true;
		} else {
		  return false;
		}
	}
}
class Varification
{
	function validatenonce($nonce){
		if(isset($_SESSION['nonce']) && $_SESSION['nonce'] == $nonce){
			return true;
		}else{
			return false;
		}
	}
}
