<? include $_SERVER['DOCUMENT_ROOT'].'/inc/head.php'; ?>
	<title><?=$site_tit?></title>
<? $r = libQuery("select metadata, upfile from page where del='N'"); ?>
</head>
<body>
<? include $_SERVER['DOCUMENT_ROOT'].'/inc/header.php'; ?>
	<section class="about-me">
<? if ($r) {
	for ($i=0; $i<count($r);$i++) {
		$data = $r[$i];
		$m = $data['metadata'];
		$meta = unserialize(base64_decode($m));
?>

	<? if($data['upfile']) {?>
		<div class="about-img" style="background-image:url('<?=$data['upfile'] ?? ''?>')" data-aos="fade-in"></div>
	<? } ?>
		<div class="about-list">
			<h2><?=$meta['tit'] ?? ''?></h2>
			<table>
				<tbody>
				<? for ($a=0; $a<@count($meta['name']);$a++) { ?>
					<tr>
						<td><p><?=$meta['name'][$a] ?? ''?></p></td>
                        <td><p><?=$meta['desc'][$a] ?? ''?></p></td>
					</tr>
				<? } ?>
				</tbody>
			</table>
		</div>
<?
		}
	}
?>        
	</section>

	<? include $_SERVER['DOCUMENT_ROOT'].'/inc/footer.php'; ?>
	</body>
</html>