  <?php
    ob_start();
    require("_head.php");
    $buffer=ob_get_contents();
    ob_end_clean();
    //set title of page using preg_replace
    $title = "Login";
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
    class Login
    {
    	function login_check($username,$password)
    	{
        if($password == ""){
          	$sqlLogin = "SELECT * FROM `users_tbl` WHERE `email_id` = '".$username."'";
        }
        else{
          $sqlLogin = "SELECT * FROM `users_tbl` WHERE `email_id` = '".$username."' AND `password`='".md5($password)."'";
        }

    		//return $sqlLogin;
    		$resLogin = mysqli_query($GLOBALS['connection'],$sqlLogin);
    		if($resLogin && mysqli_num_rows($resLogin) > 0){
    			$rowLogin = mysqli_fetch_array($resLogin);

    			if(session_id() == '') {
    			    session_start();
    			}
    			$_SESSION['mypass'] = $password;
    			$_SESSION['name'] = $rowLogin['username'];
    			$_SESSION['email_id'] = $rowLogin['email_id'];
    			$_SESSION['contact_number'] = $rowLogin['contact_number'];
    			$_SESSION['gender'] = $rowLogin['gender'];
    			$_SESSION['date_of_birth'] = $rowLogin['date_of_birth'];
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
    			$_SESSION['status'] = $rowLogin['status'];
    			$_SESSION['added_on'] = $rowLogin['added_on'];
    			$_SESSION['added_by'] = $rowLogin['added_by'];
          $_SESSION['logged'] = "in";

    			return true;
    		}
    		else{
    			return false;
    		}
    	}

    }
    if(isset($_POST['email_id']) && isset($_POST['password']) && isset($_POST['submit'])){
        if (!$conn->c_email($_POST['email_id'])) {
          echo "<script> alert('Please enter a valid email address'); </script>";
        }else{
          $email = $conn->esc_str($_POST['email_id']);
          // $password = $conn->esc_str($_POST['password']);
          if(!isset($_COOKIE["member_login"])) {
            $password = $conn->esc_str($_POST['password']);
                // $sql .= " AND `password` = '" . md5($password) . "'";
          	}
            else{
              $password = "";
            }
            if(!empty($_POST["remember"])) {
      				setcookie ("member_login",$_POST["email_id"],time()+ (10 * 365 * 24 * 60 * 60));
      			} else {
      				if(isset($_COOKIE["member_login"])) {
      					setcookie ("member_login","");
      				}
      			}
          $login = new Login;
          $loginsuccss = $login->login_check($email,$password);
          //echo $loginsuccss;
          if($loginsuccss){
            echo "<script> window.location.href='dashboard.php';</script>";
          }
          else{
             echo "<script> alert('Email Id or Password is not correct'); </script>";
          }
      }
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

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Welcome Back!!</h3></div>
                                <div class="card-body">
                                  <span id="hideAfter2"><?php echo (!empty($_SESSION['sucessPsswreset'])) ? $_SESSION['sucessPsswreset'] : "" ; ?></span>
                                    <form  class="loggin" action="./" method="POST" id="login" nonce="<?php echo $_SESSION['nonce'];?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email_id" id="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="reset_password.php">Forgot Password?</a>
                                            <input class="btn btn-sm btn-primary" name="submit" type="submit" id="submit" value="Login"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
  <?php require("_foot.php");
  unset($_SESSION['sucessPsswreset']);
  ?>
  <script>
    $(document).ready(function(){
      setTimeout(function(){
        $("#hideAfter2").hide();
        $("#hideAfter2").html("");
      },2000);
    });
  </script>
