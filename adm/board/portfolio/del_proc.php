<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$idx = $_GET['idx'];

	$r = libQuery("update bbs set del='Y' where idx='$idx' ");
	
	fExit('삭제되었습니다.', '/adm/board/portfolio/');
?>