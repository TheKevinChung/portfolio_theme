<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$id = $_POST['adm_id'];
	$pw = $_POST['adm_pw'];

	$r = libQuery("select * from account where id='$id' and pw='$pw' ");
	
	if (count($r) == 1) {
		session_start();

		$_SESSION['adm_id'] = $id;
		$_SESSION['adm_nick'] = $r[0]['name'];
		header('location:index.php');
	} else {
		print "<script> alert('The account is not valid.'); location.replace('login.php'); </script>";
	}
?>
