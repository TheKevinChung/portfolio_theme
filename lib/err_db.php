<div style="position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:#fff; overflow:auto">
	<div style="width:100vw; height:100vh; display:table">
		<div style="display:table-cell; text-align:center; vertical-align:middle; font-size:15px; line-height:30px">
			<b>죄송합니다.</b><br>
			<br>
			일시적으로 데이터베이스 문제가 발생하여 사이트를 오픈할 수 없습니다.<br>
		</div>
	</div>
</div>
<script>document.body.style.overflow='hidden';</script>
<?

if (libIsSafety()) {
	echo '<script>';
	if ($GLOBALS['mysqli'])
		echo 'console.warn(`Database error: '. str_replace('`','\`', mysqli_error($GLOBALS['mysqli'])) .'`);';
	else
		echo 'console.warn("Could not connect");';
	echo 'console.log(`'. str_replace('`','\`', $sql) .'`);';
	echo 'console.log(`'. str_replace('`','\`', $types) .'`);';
	echo 'console.log(`'. str_replace('`','\`', print_r($params, true)) .'`);';
	echo '</script>';
}

exit;

?>
