<? include $_SERVER['DOCUMENT_ROOT'].'/inc/head.php'; ?>
	<title><?=$site_tit?></title>
<?
	$r = libQuery("select url_id, thumb from bbs where del = 'N' order by idx desc");
?>
</head>
<body>
<? include $_SERVER['DOCUMENT_ROOT'].'/inc/header.php'; ?>
	<section class="main-banner">
		<div class="cont">
			<p><span style="color: rgb(0, 0, 0);">Lorem ipsum dolor sit amet,&nbsp;</span><u style="color: rgb(0, 0, 0);">consectetur adipiscing elit</u></p>
			<p><span style="color: rgb(0, 0, 0);">Donec quis turpis tristique elit scelerisque elementum.</span></p>
			<p><span style="color: rgb(0, 0, 0);">Ut vitae erat et&nbsp;</span><u style="color: rgb(0, 0, 0);">orci blandit</u><span style="color: rgb(0, 0, 0);">&nbsp;semper. Lorem ipsum dolor sit amet,&nbsp;</span><u style="color: rgb(0, 0, 0);">consectetur adipiscing elit</u></p>
			<p><span style="color: rgb(0, 0, 0);">Donec quis turpis tristique elit scelerisque elementum.</span></p>
		</div>
	</section>
	<? if (count($r) > 0) { ?>
	<section class="main-list">
		<? for($i=0;$i<count($r);$i++){ 
			$data = $r[$i];
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