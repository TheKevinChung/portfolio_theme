<? include $_SERVER['DOCUMENT_ROOT'].'/inc/head.php'; ?>
<?
	$id = $_GET['url'] ?? '';
	$id = str_replace('/','',$id);

	$r = libQuery("select idx, url_id, metadata, view_cnt from bbs where url_id='$id' and del='N'");

	if ($r) {
		$data = $r[0];
		$m = $data['metadata'];
		$meta = unserialize(base64_decode($m));

		$idx = $data['idx'];
		$view = (int)$data['view_cnt'];
		$viewN = $view + 1;
		$r_view = libQuery("update bbs set view_cnt='$viewN' where idx='$idx' ");

	} else {
		fExit('The page does not exist.', '/');
	}

	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
		$h = "https://";
	} else {
		$h = "http://";
	}

	$curUrl = $h.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<title><?=$meta['tit']?></title>
</head>
<body>
<? include $_SERVER['DOCUMENT_ROOT'].'/inc/header.php'; ?>
	<section class="view-cont">
        <div class="area-tit">
            <h1><?=$meta['tit']?></h1>
            <p><?=$meta['desc1']?></p>
        </div>
	<? if($meta['desc2']) { ?>
        <div class="area-subtit">
			<?=$meta['desc2']?>
        </div>
	<? } ?>
	<? if($meta['video']) { ?>
        <div class="area-video"><?=$meta['video']?></div>
	<? } ?>
	<? if($meta['main']) { ?>
        <div class="area-detail ql-editor"><?=$meta['main']?></div>
	<? } ?>
    </section>
    
	<? if($site_snsS) { ?>
    <div class="sns-share">
		<? if($site_snsS[0] ?? '') { ?>
        <a href="#none" class="facebook" onclick="snsShare('facebook', '')">
            <i class="fab fa-facebook-f"></i>
        </a>
		<? } ?>

		<? if($site_snsS[1] ?? '') { ?>
        <a href="#none" class="twitter" onclick="snsShare('twitter', '')">
            <i class="fab fa-twitter"></i>
        </a>
		<? } ?>

		<? if($site_snsS[2] ?? '') { ?>
        <a href="#none" class="pinterest" onclick="snsShare('pinterest', '')">
            <i class="fab fa-pinterest"></i>
        </a>
		<? } ?>

		<? if($site_snsS[3] ?? '') { ?>
        <a href="mailto:?Subject=<?=$meta['tit']?>&Body=<?=$curUrl?>" class="mail">
            <i class="far fa-envelope"></i>
        </a>
		<? } ?>

		<? if($site_snsS[4] ?? '') { ?>
        <a href="#none" class="link-copy">
            <i class="fas fa-link"></i>
            <span class="pop">Link Copied</span>
        </a>
		<? } ?>
    </div>
	<? } ?>

	<? include $_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'; ?>
	</body>
</html>