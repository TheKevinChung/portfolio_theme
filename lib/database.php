<?

@header('Expires: Sun, 1 Jan 2020 12:00:00 GMT');
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Pragma: no-cache');

function fExit($msg="", $url="") {
	global $mysqli;
	$script = "";

	if ($msg) {
		$script .= "alert(\"{$msg}\");\n";
	}

	switch ($url) {
		case "":
			$script .= "history.back();\n";
		break;
		default :
			$script .= "location.replace(\"{$url}\");\n";
		break;
	}
?>
	<script type="text/javascript" language="javascript">
	<?php echo $script; ?>
	</script>
<?
	if ($mysqli) @mysql_close($mysqli);
	exit;
}

function libIsSafety() {
	return
		get_cfg_var('is_test');
}

function libReturn($state='', $arr=array()) {
	$res = array('state'=>$state, 'arr'=>$arr);

	if ($GLOBALS['ret_type'] == 'ajax') {
		echo json_encode($res);
		exit;
	} else {
		return $res;
	}
}

function libRefValues(&$arr) {
	if (strnatcmp(phpversion(),'5.3') >= 0) {
		$refs = array();
		foreach ($arr as $key => $value)
			$refs[$key] = &$arr[$key];
		return $refs;
	}
	return $arr;
}

function libConnect() {
	global $mysqli;

	if (!$mysqli) {
		$mysqli = @mysqli_connect('db.chungkevin.com', 'chungkevin', 'chungkevin!@#', 'dbchungkevin') or include('err_db.php');
		@mysqli_set_charset($mysqli, 'utf8');
	}
	return $mysqli ;
}

function libQuery($sql, $types='', $params=array()) {
	$r = array();

	if ($types && count($params) > 0) {
		$stmt = @mysqli_prepare(libConnect(), $sql) or include('err_db.php');
		@call_user_func_array('mysqli_stmt_bind_param', array_merge(array($stmt, $types), libRefValues($params))) or include('err_db.php');
		@mysqli_stmt_execute($stmt);

		// echo '<xmp>';
		// print_r($stmt);
		// echo '</xmp>';

		if (@$stmt->field_count) {
			$cols = array();
			$meta = mysqli_stmt_result_metadata($stmt);
			while ($col = $meta-> fetch_field()) $cols[$col->name] = '';

			@call_user_func_array('mysqli_stmt_bind_result', array_merge(array($stmt), libRefValues($cols)));

			$idx = 0;
			while (@mysqli_stmt_fetch($stmt)) {
				foreach ($cols as $k => $v) $r[$idx][$k] = $v;
				$idx++;
			}
		}
	} else {
		$res = @mysqli_query(libConnect(), $sql) or include('err_db.php');

		if (is_object($res)) while ($row = @mysqli_fetch_assoc($res)) {
			$r[] = $row;
		}
	}

	return $r;
}

function libFileUpload($el, $dir="") {
	if (!$el['name']) {
		$upfile = "";
	} else {
		$name  = date('dhi').'_'.uniqid();
		$ext   = strtolower(substr($el['name'], strripos($el['name'], '.') + 1));
		$root  = $_SERVER['DOCUMENT_ROOT'];
		if (substr($root, -1) == '/') {
			$root = substr_replace($root, '', -1);
		}

		$path1 = $root.'/uploads';
		$path2 = $dir.date('/Y/m');
		if (!is_dir("{$path1}/{$path2}")) mkdir("{$path1}/{$path2}", 0777, true);
		move_uploaded_file( $el['tmp_name'], "{$path1}/{$path2}/{$name}.{$ext}" );

		$upfile = "/uploads/{$path2}/{$name}.{$ext}";
	}

	return $upfile;
}

?>