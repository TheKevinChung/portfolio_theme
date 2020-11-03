<?
	session_start();

	if (!isset($_SESSION['adm_id'])) {
		header('location:/adm/login.php');
	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$idx = $_GET['idx'] ?? '';
	$act = $_GET['ACT'] ?? 'n';

	if ($idx && $act == 'u') {
		$r = libQuery("select metadata, thumb from bbs where idx='".$idx."'");
		
		$arr = $r[0];
		$m = $arr['metadata'];
		$meta = unserialize(base64_decode($m));
	}
?>

<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/head.php'; ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
	.ql-snow .ql-tooltip {z-index:9999}
	.ql-snow b, .ql-snow strong {font-weight:bold;}
	.form-control {color:#545454;}
	.form-control:focus {color:#000;}
	.ql-editor p {color:#000;font-weight:400}
</style>

</head>

<body id="page-top">
	<div id="wrapper">
	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/header.php'; ?>
		 <!-- Container Fluid-->
		<div class="container-fluid" id="container-wrapper">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">포트폴리오 추가</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="./">Home</a></li>
					<li class="breadcrumb-item">board</li>
					<li class="breadcrumb-item active" aria-current="page">포트폴리오</li>
				</ol>
			</div>

			<div class="row">
				<div class="col-lg-12 mb-4">
					<div class="card mb-4">
						<div class="card-body">
							<form method="post" action="write_proc.php" enctype="multipart/form-data">
								<input type="hidden" name="ACT" value="<?=$act?>">
								<input type="hidden" name="idx" value="<?=$idx ?? ""?>">
								<p class="font-weight-bold text-primary">상단 영역</p>
								<hr>
								<div class="form-group row ml-sm-1">
									<label class="col-sm-2 col-xl-1 col-form-label">썸네일</label>
							<?
								if($idx && $arr['thumb']) {
									$imgArr = explode('/', $arr['thumb']);
									$imgN = $imgArr[5];
							?>
									<div class="col-sm-9 box-file">
										<a href="<?=$arr['thumb']?>" target="_blank">
											<img src="<?=$arr['thumb']?>" alt="">
										</a>
										<div class="row align-items-center mt-3">
											<input class="form-control col-3 ml-3" type="text" value="<?=$imgN?>" readonly>
											<div>
												<a href="#" onclick="thumbChange($(this));" class="btn btn-danger btn-lg ml-2">
													<i class="fas fa-trash"></i>
												</a>
											</div>
										</div>
									</div>
							<? } else { ?>
									<div class="col-sm-9">
										<input class="form-control col-xl-5" type="file" name="thumb" accept="image/*" required>
									</div>
								<? } ?>
								</div>  <!-- thumb end -->

								<div class="form-group row ml-sm-1">
									<label class="col-sm-2 col-xl-1 col-form-label">타이틀</label>
									<div class="col-sm-9">
										<input class="form-control" name="tit" placeholder="title" type="text" value="<?=$meta['tit']?? ''?>" required>
									</div>
								</div>
								
								<div class="form-group row ml-sm-1">
									<label class="col-sm-2 col-xl-1 col-form-label">설명1</label>
									<div class="col-sm-9 box-quill">
										<div class="box-quitxt qui-1" style="height:150px"></div>
										<textarea name="desc1" style="display:none;"><?=$meta['desc1']?? ''?></textarea>
									</div>
								</div>

								<div class="form-group row ml-sm-1">
									<label class="col-sm-2 col-xl-1 col-form-label">설명2</label>
									<div class="col-sm-9 box-quill">
										<div class="box-quitxt qui-2" style="height:150px"></div>
										<textarea name="desc2" style="display:none;"><?=$meta['desc2']?? ''?></textarea>
									</div>
								</div>
								
								<p class="font-weight-bold mt-5 text-primary">하단 영역</p>
								<hr>
								<div class="form-group row ml-sm-1">
									<label class="col-sm-2 col-xl-1 col-form-label">메인 영상</label>
									<div class="col-sm-9">
										<textarea style="resize:none" name="video" class="form-control" rows="3" placeholder="<iframe ...></iframe>"><?=$meta['video']?? ''?></textarea>
									</div>
								</div>
								<div class="form-group row ml-sm-1">
									<label class="col-sm-2 col-xl-1 col-form-label">본문</label>
									<div class="col-sm-9 box-quill">
										<div class="box-quitxt qui-full" style="height:500px"></div>
										<textarea name="main" style="display:none;"><?=$meta['main']?? ''?></textarea>
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
			<!--Row-->
		</div>
	</div>

	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/footer.php'; ?>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
$(function(){
	var quiOpt = [
		[{ 'size': ['small', false, 'large', 'huge'] }],
		[{ 'header': [ 2, 3, 4, 5, 6, false] }],
		[{ 'color': [] }, { 'background': [] }],        
		['bold', 'italic', 'underline', 'strike'],      
		[{ 'align': [] }],
		['blockquote', 'code-block'],

		['link'], ['image'],
		[{ 'list': 'ordered'}, { 'list': 'bullet' }],
		[{ 'indent': '-1'}, { 'indent': '+1' }],        
		[{ 'direction': 'rtl' }],                       
		['clean']
	];

	var quiTxtOpt = [
		[{ 'size': ['small', false, 'large', 'huge'] }],
		[{ 'header': [ 2, 3, 4, 5, 6, false] }],
		[{ 'color': [] }, { 'background': [] }],        
		['bold', 'italic', 'underline', 'strike'],      
		[{ 'align': [] }],
		['code-block'],

		[{ 'list': 'ordered'}, { 'list': 'bullet' }],
		['clean']
	];
	
	$('.box-quitxt').each(function(){		
		var cls = $(this).attr('class').replace('box-quitxt ', '');
		cls = "."+cls;

		if (cls == '.qui-full') {
			var opt = quiOpt;
		} else {
			var opt = quiTxtOpt;
		}

		var quiObj = new Quill(cls, {
			modules: {
				toolbar: opt
			},
			placeholder: 'Content',
			theme: 'snow'
		})

		var txtArea = $(this).parents('.box-quill').find('textarea');
		var myEditor = $(this).find('.ql-editor');

		if (txtArea.val()) {
			quiObj.clipboard.dangerouslyPasteHTML(txtArea.val());
		}

		quiObj.on('text-change', (delta, oldDelta, source) => {
			txtArea.val(myEditor.html());
		})

		quiObj.getModule('toolbar').addHandler('image', function(){
			selectLocalImage(quiObj);
		})

	})
})

function thumbChange(target) {
	var base = target.parents('.box-file');
	var inputFile = '<input class="form-control col-xl-5" type="file" name="thumb" accept="image/*" required>';

	base.empty().append(inputFile);
}

function selectLocalImage(target){
	const input = document.createElement('input');
	input.setAttribute('type', 'file');
	input.setAttribute('accept', 'image/*');
	input.setAttribute('name', 'imageFile');
	input.click();

	input.onchange = function(){
		const fd = new FormData();
		const file = $(this)[0].files[0];
		fd.append('imageFile', file);

		$.ajax({
			type: 'post',
			enctype: 'multipart/form-data',
			url: 'editor_upload.php',
			data: fd,
			processData:false,
			contentType:false,
			dataType: 'json',
			success: function(data) {
				if(data.error) {
					alert(data.error);
				} else {
					const range = target.getSelection();
					target.insertEmbed(range.index, 'image', data.url);
					target.setSelection(range.index + 1, range.index + 1);
				}
			},
			error: function(err) {
				console.error('Error ::: '+err);
			}
		})
	}
}
</script>

</body>
</html>