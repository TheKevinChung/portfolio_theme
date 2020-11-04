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

		if (!$el['name']) {
			$upfile = "";
		} else {
			$name  = uniqid();
			$ext   = strtolower(substr($el['name'], strripos($el['name'], '.') + 1));
			$root  = $_SERVER['DOCUMENT_ROOT'];
			if (substr($root, -1) == '/') {
				$root = substr_replace($root, '', -1);
			}

			$path1 = $root.'/uploads';
			$path2 = 'main'.date('/Y/m');
			if (!is_dir("{$path1}/{$path2}")) mkdir("{$path1}/{$path2}", 0777, true);
			move_uploaded_file( $el['tmp_name'], "{$path1}/{$path2}/{$name}.{$ext}" );
	
			$upfile = "/uploads/{$path2}/{$name}.{$ext}";
		}
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