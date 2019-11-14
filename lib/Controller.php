<?php
	/**
	* 
	*/
	$POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$getact = isset($GET["act"])?$GET["act"]:"";
	$getid = isset($GET["id"])?$GET["id"]:"";
	$getmsg = isset($GET["msg"])?$GET["msg"]:"";
	$gettype =isset($GET["type"])?$GET["type"]:"";
	$getTit = isset($GET["name"])?$GET["name"]:"";
	$getErm = isset($GET["erm"])?$GET["erm"]:"";
	$getVm = isset($GET["vm"])?$GET["vm"]:"";
	$getoption = isset($GET["opt"])?$GET["opt"]:"";
	$getEs = isset($GET["es"])?$GET["es"]:"";
	$getidob = isset($GET["ido"])?$GET["ido"]:""; 
	$getCh = isset($GET["chg"])?$GET["chg"]:"";
	$getedob = isset($GET["edo"])?$GET["edo"]:"";
	$getub = isset($GET["ub"])?$GET["ub"]:"";
	$getba = isset($GET["byr"])?$GET["byr"]:"";
	$getsd = isset($GET["sd"])?$GET["sd"]:"";
	$getfd = isset($GET["fd"])?$GET["fd"]:"";
	$getpr = isset($GET["pr"])?$GET["pr"]:"";
	class Controller
	{
		public static $con;

		function __construct()
		{
			$this->connect();
		}
		function connect(){
			try{
					$this::$con = new PDO("mysql:host=localhost;dbname=ukk", "root", "");
					$this::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		function post($a, $b=""){
			return isset($POST["$a"])?$POST["$a"]:"$b";
		}
		function get($a, $b=""){
			return isset($GET["$a"])?$GET["$a"]:"$b";
		}
		function sess($a, $b=""){
			return isset($_SESSION["$a"])?$_SESSION["$a"]:"$b";
		}
		function alert($a){
			echo "<script>alert('$a');</script>";
		}
		function errorInput($a, $b){
			echo "<script>location.href='$a&erm=error&msg=$b';</script>";
		}
		function validationInput($a, $b){
			echo "<script>location.href='$a&vm=vali&msg=$b';</script>";
		}
		function redirect($a){
			echo "<script>location.href='$a';</script>";
		}
		function duit($a){
			return "Rp ".number_format($a);
		}
		function execute($a, $b){
			try{
					$sel = $this::$con->prepare($a);
					$sel->execute($b);
					return $sel;
			}
			catch(PDOException $e){
				die ($e->getMessage());
			}
		}
		function getResult($a){
			try{
					$sel = $this::$con->prepare($a);
					$sel->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			return $sel;
		}
		function getRow($a){
			try{
					$sel = $this::$con->prepare($a);
					$sel->execute();

					return $sel->fetch();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		function getField($a){
			try{
					$sel = $this::$con->prepare($a);
					$sel->execute();
					$data = $sel->fetch();

					return $data[0];
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}

	$db = new Controller();
?>