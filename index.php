<?php
	include_once 'lib/Controller.php';
	session_start();
	if (!isset($_SESSION["sess_user"]) && !isset($_SESSION["sess_name"]) && !isset($_SESSION["sess_stat"])) {
		$db->redirect("login.php");
	}
	$user_sess = $_SESSION["sess_user"];
	$user_name = $_SESSION["sess_name"];
	$user_stat = $_SESSION["sess_stat"];
	$getIdDok = $db->execute("select id from poli where id_dokter = :id", array(":id"=>$user_sess));
	$givIdDok = $getIdDok->fetch();
	$_SESSION["idp"] = $givIdDok["id"];
	$user_poli = $_SESSION["idp"];
?>
<!DOCTYPE html> 
<html>
<head>
	<?php
		include_once 'dist/style.php';
		include_once 'dist/js.php';
	?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<?php
				include_once 'default/header.php';
			?>
		</header>
		<aside class="main-sidebar">
			<?php
				include_once 'default/sidebar.php';
			?>
		</aside>
		<div class="content-wrapper" id="content-wrapper">
			<?php
				$hal = isset($GET["hal"])?$GET["hal"]:"home/home";
				if ($hal != "") {
					require_once "page/".$hal.".php";
				}
			?>
		</div>
		<footer class="main-footer">
			<?php
				include_once 'default/footer.php';
			?>
		</footer>
	</div>
</body>
</html>