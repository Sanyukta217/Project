<?php
  ob_start();
  require("_head.php");
  $buffer=ob_get_contents();
  ob_end_clean();
  //set title of page using preg_replace
  $title = "Reset Password";
  $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
  echo $buffer;
  if (!defined('READCON')) {
    define('READCON', true);
  }
  require_once('connect.php');

  $conn = new Con;
  $connection = $conn->connect();
  if(isset($_SESSION['logged']) && $_SESSION['logged']=='in'){
      //echo "<script> window.location.href='dashboard.php';</script>";
      header('Location: ./dashboard.php');
      die('You are already logged in!');
  }
  class Reset
  {
  	function email_check($username)
  	{
  		$sqlLogin = "SELECT * FROM `users_tbl` WHERE `email_id` = '".$username."'";
  		//return $sqlLogin;
  		$resLogin = mysqli_query($GLOBALS['connection'],$sqlLogin);
  		if($resLogin && mysqli_num_rows($resLogin) > 0){
  			$rowLogin = mysqli_fetch_array($resLogin);
        if($rowLogin['status'] == '0'){
          // return "Your login id is deactive. Please contact administrator of company.";
        }
        else{
          return "Login";
        }
  		}
  		else{
  			return 'User not found.';
  		}
    }
  }
  if(isset($_POST['email_id']) && isset($_POST['submit'])){
    if (!Con::c_email($_POST['email_id'])) {
  		echo "<script> alert('Please enter a valid email address'); </script>";
  	}else{
   		$email = Con::esc_str($_POST['email_id']);

  		// $emailVerify = call_user_func(array('Reset', 'email_check'), $email);

      $reset = new Reset;
      $loginsuccss = $reset->email_check($email);
      //echo $emailVerify;
      if($loginsuccss == "Login"){
      	ob_clean();
         define("url","https://localhost/");
         $validate_unique = md5(mt_rand(00000,99999));
         $linkUpdate = "UPDATE `users_tbl` SET `link_password`='".$validate_unique."' WHERE `email_id` = '".$email."'";
         $res = mysqli_query($GLOBALS['connection'],$linkUpdate);
        //email sending code for sending reset link
        $to = $email;
        $subject = 'Request reset Password';
        $message = 'Hello User \n
        You have requested a new password. \n
        <p>Click this link to recover your password<br><a href="'.url. 'reset_password.php?email='.$email. '&v='.$validate_unique.'">'.url.'reset_password.php?email='.$email.'&v='.$validate_unique.'</a><br><br></p>';
        /* Send the message using mail() function */
        if(@mail($to, $subject, $message ))
        {


        //echo "New Password has been sent to your mail, Please check your mail and SignIn.";
        }
        $_SESSION["sucessPsswreset"] = 'Reset Password link sent on your email';
      	echo "<script> window.location.href='index.php';</script>";

      	//header('Location: ./dashboard.php');
      	//echo "<script> alert('".$loginsuccss."')</script>";
      }else{
      	//$_SESSION['message'] = "Email Id or Password is not correct";
        $errorPassword = $loginsuccss;
      }
  	}
  }

  if(isset($_GET['v']) && isset($_GET['email'])){
		$show = "SELECT * FROM `users_tbl` WHERE `link_password` ='".md5($_GET['v'])."' AND `email_id` = '".$_GET['email']."'";
		$res = mysqli_query($GLOBALS['connection'],$show);
		if(!$res){
			echo "You are not a authorized person to view this page.";
		}
	}
	if(isset($_POST["reset-password"])) {

		$sql = "UPDATE `users_tbl` SET `password` = '" . md5($_POST["password"]). "' WHERE `email_id` = '" . $_GET["email"] . "'";

		$result = mysqli_query($GLOBALS['connection'],$sql);
		$success_message = "Password is reset successfully.";
		echo "<script>setTimeout(function(){window.location.href='login.php'},2000);</script>";

	}
?>
  <style>
  body{
          background: linear-gradient(269deg, #42275a,#734b6d);
          background-size: 400% 400%;

          -webkit-animation: AnimationName 60s ease infinite;
          -moz-animation: AnimationName 60s ease infinite;
          animation: AnimationName 60s ease infinite;
      }

      @-webkit-keyframes AnimationName {
          0%{background-position:0% 50%}
          50%{background-position:100% 51%}
          100%{background-position:0% 50%}
      }
      @-moz-keyframes AnimationName {
          0%{background-position:0% 50%}
          50%{background-position:100% 51%}
          100%{background-position:0% 50%}
      }
      @keyframes AnimationName {
          0%{background-position:0% 50%}
          50%{background-position:100% 51%}
          100%{background-position:0% 50%}
      }
  </style>
  <script>
  function validate_password_reset() {
  	if((document.getElementById("password").value == "") && (document.getElementById("confirm_password").value == "")) {
  		document.getElementById("validation-message").innerHTML = "Please enter new password!"
  		return false;
  	}
  	if(document.getElementById("password").value  != document.getElementById("confirm_password").value) {
  		document.getElementById("validation-message").innerHTML = "Password should be same!"
  		document.getElementById("confirm_password").value="";
  		return false;
  	}
  	return true;
  }
  </script>
  <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
          <main>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-5">
                          <div class="card shadow-lg border-0 rounded-lg mt-5">
                              <div class="card-header"><h3 class="text-center font-weight-light my-4">Forgot Password!!</h3></div>
                              <div class="card-body">
                                <?php if(!isset($_GET['v']) && !isset($_GET['email'])){ ?>
                                  <form  class="loggin" action="reset_password.php" method="POST" id="login" nonce="<?php echo $_SESSION['nonce'];?>">
                                    <div id="validation-message">
                                      <?php if(!empty($errorPassword)) { ?>
                                         <?php echo $errorPassword; ?>
                                      <?php } ?>
                                    </div>
                                      <div class="form-floating mb-3">
                                          <input class="form-control" name="email_id" id="inputEmail" type="email" placeholder="name@example.com" />
                                          <label for="inputEmail">Email address</label>
                                      </div>

                                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                          <a class="btn btn-sm btn-info" href="index.php">Login</a>
                                          <input class="btn btn-sm btn-success" name="submit" type="submit" id="submit" value="Reset"/>
                                      </div>
                                  </form>
                                <?php } else{ ?>
                                <form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">
                                  	<h4><a>WELCOME</a></h4>
                                    <h2>Reset Password</h2>
                                  	<?php if(!empty($success_message)) { ?>
                                  	<div class="success_message"><?php echo $success_message; ?></div>
                                  	<?php } ?>

                                  	<div id="validation-message">
                                  		<?php if(!empty($error_message)) { ?>
                                  	<?php echo $error_message; ?>
                                  	<?php } ?>
                                  	</div>

                                  	<div class="field-group">
                                  		<div><label for="Password">Password</label></div>
                                  		<div>
                                  		<input type="password" name="password" id="password" class="input-field form-control"></div>
                                  	</div>

                                  	<div class="field-group">
                                  		<div><label for="email">Confirm Password</label></div>
                                  		<div><input type="password" id="password" class="input-field form-control"></div>
                                  	</div>
                                  	<br/>
                                  	<div class="field-group">
                                  		<div><input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="form-submit-button btn btn-success"></div>
                                  	</div>
                                  </form>
                                <?php } ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </main>
      </div>
  </div>
<?php require("_foot.php"); ?>
