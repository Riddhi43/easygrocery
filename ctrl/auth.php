<?php 
$NO_REDIRECT = 1;
require_once('../inc/ad.common.php');

if($_SERVER['REQUEST_METHOD']=="POST"){

	if(isset($_POST["txtusername"]) && isset($_POST["txtpassword"])){
		$username = $_POST['txtusername'];
		$password = $_POST['txtpassword'];

		if($password=='')
			ForceOut(5);
		elseif($username=='')
			ForceOut(5);
		else{
			$q = "SELECT id, name, username, password, fkRoleId FROM user WHERE username='$username' and status='A'";
			$r = sql_query($q);

			if(sql_num_rows($r)){
				list($u_id, $u_name, $u_username, $u_password, $u_role) = sql_fetch_row($r);

				if($u_password == md5($password)){
					session_destroy();
					session_start();

					$_SESSION[AD_SESSION_ID] = new userdat;
					$_SESSION[AD_SESSION_ID]->log_stat = "A";
					$_SESSION[AD_SESSION_ID]->user_id = $u_id;
					$_SESSION[AD_SESSION_ID]->user_name = $u_name;
					$_SESSION[AD_SESSION_ID]->user_role = $u_role;
					$_SESSION[AD_SESSION_ID]->sess_id = session_id();
					$_SESSION[AD_SESSION_ID]->log_time = NOW;

					$q = "UPDATE user set lastLogin='".NOW."' WHERE id=$u_id";
					$r = sql_query($q);

					$loc_url = "dashboard.php";

					if($u_role == '4')
						$loc_url = "orders.php";

					header("location:$loc_url");
					exit;
				}
				else{
					// incorrect password
					ForceOut(5);
				}
				
			}
			else{
				ForceOut(5);
			}
		}
	}
	else{
		ForceOut(4);
	}
}
else{
	session_destroy();
	ForceOut(5);
	exit;
}
