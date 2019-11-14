 <?php
 	session_start();
	include_once 'lib/Controller.php';
	if (isset($POST["login"])) {
			extract($POST);
			if ($Username != "") {
				if ($password != "") {
					$pass = md5($password);
					$param = array(":umail"=>$Username, ":pw"=>$pass);
					$getUs = $db->execute("select nama, id, status from user where username = :umail and password = :pw", $param);
					while ($givUs = $getUs->fetch()) {
						$_SESSION["sess_user"] = $givUs["id"];
						$_SESSION["sess_name"] = $givUs["nama"];
						$_SESSION["sess_stat"] = $givUs["status"];
						$db->execute("insert into activity values('', :idu, '1', 'success', now())", array(":idu"=>$givUs["id"]));
						$db->redirect("index.php");
					}
				}
				else{
					$db->redirect("login.php?erm=error&msg=password");
				}
			}
			else{
				$db->redirect("login.php?erm=error&msg=username");
			}
			
		}
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		include_once 'dist/style.php';
	?>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<b>Poli</b>Pantai
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">
				Login untuk masuk Dashboard
			</p>
					<?php
						if ($getErm == "error" && $getmsg) {
						?>
							<div class="callout callout-danger">
									<button type="button" class="close" id="close-alert">&times;</button>
				                maaf harap tidak kosongi <?php echo $getmsg;?>
				              </div>
						<?php
						}
					?>
			<form method="post">
				<div class="form-group has-feedback">
					<label>Username</label>
					<input type="text" name="Username" class="form-control" placeholder="Username">
					<span class="fa fa-at form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password">
					<span class="fa fa-unlock-alt form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<input type="submit" name="login" class="btn btn-primary btn-flat btn-block" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>

</body>
	<?php
		include_once 'dist/js.php';
	?>
</html>