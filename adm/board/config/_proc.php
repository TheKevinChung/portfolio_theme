<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$ACT = $_POST['ACT'] ?? '';
	$fav = "empty";

	if(count($_FILES) > 0) {
		$el = $_FILES['fav'];

		if (!$el['name']) {
			$fav = "";
		} else {
			$name  = uniqid();
			$ext   = strtolower(substr($el['name'], strripos($el['name'], '.') + 1));
			$root  = $_SERVER['DOCUMENT_ROOT'];
			if (substr($root, -1) == '/') {
				$root = substr_replace($root, '', -1);
			}

			$path1 = $root.'/uploads';
			$path2 = 'favicon'.date('/Y/m');
			if (!is_dir("{$path1}/{$path2}")) mkdir("{$path1}/{$path2}", 0777, true);
			move_uploaded_file( $el['tmp_name'], "{$path1}/{$path2}/{$name}.{$ext}" );

			$fav = "/uploads/{$path2}/{$name}.{$ext}";
		}
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