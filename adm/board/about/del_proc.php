<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$idx = $_GET['idx'] ?? '';

	if ($idx) {
		$r = libQuery("update page set del='Y' where idx='$idx' ");
		fExit('삭제되었습니다.', '/adm/board/about/');
	} else {
		fExit('삭제 게시물이 존재하지 않습니다.', '/adm/board/about/');
	}
	
?>