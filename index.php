<? include $_SERVER['DOCUMENT_ROOT'].'/inc/head.php'; ?>
	<title><?=$site_tit?></title>
<?
	$r_main = libQuery("select conts, upfile from main where num = 1");
	$r_bbs = libQuery("select url_id, thumb from bbs where del = 'N' order by idx desc");

	if ($r_main) {
		$d_main = $r_main[0];
		$c = $d_main['conts'];
		$conts = unserialize(base64_decode($c));
	}
?>
</head>
<body>
<? include $_SERVER['DOCUMENT_ROOT'].'/inc/header.php'; ?>
	<section class="main-banner" style="background-image:url('<?=$d_main['upfile'] ?? ''?>')">
	<? if($d_main['conts']) { ?>
		<div class="cont"><?=$conts['txt'] ?? ''?></div>
	<? } ?>
	
	</section>

	<? if (count($r_bbs) > 0) { ?>
	<section class="main-list">
		<? for($i=0;$i<count($r_bbs);$i++){ 
			$data = $r_bbs[$i];
		?>
		<div class="item" data-aos="fade-up" data-aos-offset="100">
			<a style="background-image:url('<?=$data['thumb']?>')" href="/portfolio/<?=$data['url_id']?>"></a>
		</div>
		<? } ?>
	</section>
	<? } ?>

	<? include $_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'; ?>
	</body>
</html>