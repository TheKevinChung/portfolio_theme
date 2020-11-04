<?	
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$ACT = $_POST['ACT'] ?? '';
	$idx = $_POST['idx'] ?? '';

	$meta_list['tit'] 	= trim($_POST['tit'] ?? '');
	$meta_list['name']  = array_filter($_POST['name'] ?? '');
	$meta_list['desc']	= array_filter($_POST['desc'] ?? '');
	$meta = base64_encode(serialize($meta_list));

	$upfile = "empty";
	$msg = "";

	if(count($_FILES) > 0) {
		$el = $_FILES['upfile'];

		if (!$el['name']) {
			$upfile = "";
		} else {
			$name  = uniqid();
			$ext   = strtolower(substr($el['name'], strripos($el['name'], '.') + 1));
			$path1 = $_SERVER['DOCUMENT_ROOT'].'uploads';
			$path2 = 'about'.date('/Y/m');
			if (!is_dir("{$path1}/{$path2}")) mkdir("{$path1}/{$path2}", 0755, true);
			move_uploaded_file( $el['tmp_name'], "{$path1}/{$path2}/{$name}.{$ext}" );

			$upfile = "/uploads/{$path2}/{$name}.{$ext}";
		}
	}

	switch ($ACT) {
		case 'n':

			if($upfile !== 'empty') {
				$r = libQuery("insert into page (cate, metadata, upfile) values ('1', '$meta', '$upfile') ");
			} else {
				$r = libQuery("insert into page (cate, metadata) values ('1', '$meta') ");
			}

			$msg = "저장되었습니다.";
		break;
		case 'u':
			$idx  = $_POST['idx'];
			$date = date('Y-m-d H:i:s');

			if($upfile !== 'empty') {
				$r = libQuery("update page set metadata='$meta', upfile='$upfile', mod_date='$date' where idx='$idx' ");
			} else {
				$r = libQuery("update page set metadata='$meta', mod_date='$date' where idx='$idx' ");
			}

			$msg = "수정되었습니다.";
		break;
	}

	fExit($msg, '/adm/board/about/');
?>