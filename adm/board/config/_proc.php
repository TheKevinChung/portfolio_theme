<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$ACT = $_POST['ACT'] ?? '';
	$fav = "empty";

	if(count($_FILES) > 0) {
		$el = $_FILES['fav'];
		$fav = libFileUpload($el, 'favicon');
	}

	$meta_list['tit'] 	 	= $_POST['tit'] ?? '';
	$meta_list['logo'] 	 	= $_POST['logo'] ?? '';
	$meta_list['footer'] 	= $_POST['footer'] ?? '';
	$meta_list['snsDName']	= $_POST['snsDName'] ?? '';
	$meta_list['snsDUrl']	= $_POST['snsDUrl'] ?? '';
	$meta_list['snsS'] 	 	= $_POST['snsS'] ?? '';

	if ($fav !== 'empty'){
		$meta_list['fav'] = $fav;
	}

	$meta = base64_encode(serialize($meta_list));	

	switch ($ACT) {
		case 'n':
			$r = libQuery("insert into config (metadata) values ('$meta') ");
			$msg = "저장되었습니다.";
		break;
		case 'u':
			$num  = $_POST['num'];
			$date = date('Y-m-d H:i:s');

			$r = libQuery("update config set metadata='$meta', mod_date='$date' where num = '$num' ");
			$msg = "수정되었습니다.";
		break;
	}

	fExit($msg, '/adm/board/config/');
?>