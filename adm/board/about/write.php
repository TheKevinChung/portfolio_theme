<?
	session_start();

	if (!isset($_SESSION['adm_id'])) {
		header('location:/adm/login.php');
	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$idx = $_GET['idx'] ?? '';
	$data 	= "";
	$conts 	= "";
	
	$r = libQuery("select * from page where del='N' and idx='$idx'");
	
	if ($r) {
		$data 	= $r[0];
		$m 		= $data['metadata'];
		$meta 	= unserialize(base64_decode($m));
	}
?>

<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/head.php'; ?>

</head>

<body id="page-top">
	<div id="wrapper">
	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/header.php'; ?>

		<div class="container-fluid" id="container-wrapper">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">경력사항</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/adm/">Home</a></li>
					<li class="breadcrumb-item">board</li>
					<li class="breadcrumb-item active" aria-current="page">경력사항</li>
				</ol>
			</div>
			  
			<div class="row">
				<div class="col-12">
					<div class="card mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">새 글 쓰기</h6>
						</div>
						<div class="card-body col-12">
							<form action="write_proc.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="ACT" value="<?=$r ? "u" : "n"?>">
								<input type="hidden" name="idx" value="<?=$data['idx'] ?? ''?>">
								<div class="form-group">
									<label>이미지</label>
									<div class="box-file">

								<? if($data['upfile'] ?? '') { 
									$imgArr = explode('/', $data['upfile']);
									$imgN = $imgArr[5] ?? '';
								?>
										<div class="align-items-center mt-lg-3 mt-sm-5 row">
											<div class="col-2">
												<a href="<?=$data['upfile']?>" target="_blank">
													<img src="<?=$data['upfile']?>" alt="">
												</a>
											</div>
											<div class="col-5 row">
												<div class="col-6">
													<input class="form-control ml-3" type="text" value="<?=$imgN?>" readonly>
												</div>
												<div class="col-6">
													<a href="#" onclick="thumbChange($(this));" class="btn btn-danger btn-lg ml-xl-2 mt-sm-3 mt-lg-0">
														<i class="fas fa-trash"></i>
													</a>
												</div>
											</div>
										</div>
								<? } else { ?>
									<input class="form-control col-xl-8" type="file" name="upfile" accept="image/*">
								<? } ?>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label>타이틀</label>
									<input type="text" name="tit" class="form-control col-xl-9" placeholder="title" value="<?=$meta['tit'] ?? ''?>" required>									
								</div>
								<div class="form-group box-input">
									<label>내용</label>
							<? if (@$data['idx'] && $meta['name']) { ?>
								<? for($i=0;$i<@count($meta['name']);$i++) { 
									$metaN = $meta['name'] ?? '';
									$metaD = $meta['desc'] ?? '';
								?>
									<div class="row col-12 <?=$i > 0 ? 'mt-lg-3 mt-sm-5' : ''?>">
										<input type="text" name="name[]" class="form-control col-xl-5" placeholder="수상내역<?=$i+1?>" value="<?=$metaN[$i]?>" required>								
										<input type="text" name="desc[]" class="form-control col-xl-5 ml-xl-2 mt-sm-3 mt-lg-0" placeholder="설명<?=$i+1?>" value="<?=$metaD[$i]?>" required>									
									</div>
								<? } ?>
							<? } else { ?>
									<div class="row col-12">
										<input type="text" name="name[]" class="form-control col-xl-5" placeholder="수상내역1">									
										<input type="text" name="desc[]" class="form-control col-xl-5 ml-xl-2 mt-sm-3 mt-lg-0" placeholder="설명1">									
									</div>
								<? } ?>
									<div class="col-10 mt-lg-3 mt-sm-5 text-center box-btn">
										<a href="#" class="btn btn-success btn-lg" onclick="listAdd($(this))">
											<i class="fas fa-plus"></i>
										</a>
									</div>
								</div>
								
								<div class="form-group text-center mt-5">
									<a href="index.php" class="btn btn-secondary">목록으로</a>
									<button type="submit" class="btn btn-primary ml-3">저장</button>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/footer.php'; ?>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
function thumbChange(target) {
	var base = target.parents('.box-file');
	var inputFile = '<input class="form-control col-xl-5" type="file" name="upfile" accept="image/*">';

	base.empty().append(inputFile);
}

function listAdd(target) {
	var base = target.parents('.box-btn');
	var parent = target.parents('.box-input');
	var num = parseInt(parent.find('.row').length);
	var htm = '<div class="row col-12 mt-lg-3 mt-sm-5">'
				+'<input type="text" name="name[]" class="form-control col-xl-5" placeholder="수상내역'+(num+1)+'">'						
				+'<input type="text" name="desc[]" class="form-control col-xl-5 ml-xl-2 mt-sm-3 mt-lg-0" placeholder="설명'+(num+1)+'">'								
			+'</div>';

	base.before(htm);
	
}
</script>

	</body>
</html>