<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$ACT   = $_POST['ACT'] ?? '';
	$urlid = $_POST['urlid'] ?? '';

	$meta_list['tit'] 	= trim($_POST['tit'] ?? '');
	$meta_list['desc1'] = $_POST['desc1'] ?? '';
	$meta_list['desc2']	= $_POST['desc2'] ?? '';
	$meta_list['video']	= trim($_POST['video'] ?? '');
	$meta_list['main'] 	= $_POST['main'] ?? '';
	$meta = base64_encode(serialize($meta_list));
	
	$thumb  = "empty";
	$msg 	= "";

	if(count($_FILES) > 0) {
		$el = $_FILES['thumb'];
		$thumb = libFileUpload($el, 'portfolio');
	}

	switch ($ACT) {
		case 'n':
			$r = libQuery("insert into bbs (url_id, metadata, thumb) values ('$urlid', '$meta', '$thumb') ");
			$msg = "저장되었습니다.";
		break;
		case 'u':
			$idx  = $_POST['idx'];
			$date = date('Y-m-d H:i:s');

			if($thumb !== 'empty') {
				$r = libQuery("update bbs set url_id='$urlid', metadata='$meta', thumb='$thumb', mod_date='$date' where idx='$idx' ");
			} else {
				$r = libQuery("update bbs set url_id='$urlid', metadata='$meta', mod_date='$date' where idx='$idx' ");
			}

			$msg = "수정되었습니다.";
		break;
	}

	fExit($msg, '/adm/board/portfolio/');
?>