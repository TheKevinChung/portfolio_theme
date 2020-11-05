<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$ACT = $_POST['ACT'] ?? '';
	$num = $_POST['num'] ?? '';
	$conts_list['edtColor'] = $_POST['edtColor'] ?? '';
	$conts_list['txt'] = trim($_POST['conts'] ?? '');
	$conts = base64_encode(serialize($conts_list));
	$upfile = "empty";

	if(count($_FILES) > 0) {
		$el = $_FILES['upfile'];
		$upfile = libFileUpload($el, 'main');
	}

	switch ($ACT) {
		case 'n':
			$r = libQuery("insert into main (conts, upfile) values ('$conts', '$upfile') ");
			$msg = "저장되었습니다.";
		break;
		case 'u':
			$date = date('Y-m-d H:i:s');

			if($upfile !== 'empty') {
				$r = libQuery("update main set conts='$conts', upfile='$upfile', mod_date='$date' where num = '$num' ");
			} else {
				$r = libQuery("update main set conts='$conts', mod_date='$date' where num = '$num' ");
			}
			$msg = "수정되었습니다.";
		break;
	}

	fExit($msg, '/adm/board/main/');

?>