<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$id    = $_POST['id'] ?? '';
	$r_cnt = libQuery("select count(*) as cnt from bbs where url_id='$id'");

	echo json_encode($r_cnt[0]);
?>