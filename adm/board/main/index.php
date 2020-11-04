<?
	session_start();

	if (!isset($_SESSION['adm_id'])) {
		header('location:/adm/login.php');
	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$r = libQuery("select conts, upfile from main where num=1");
	$data 	= "";
	$conts 	= "";

	if ($r) {
		$data 	= $r[0];
		$c 		= $data['conts'];
		$conts 	= unserialize(base64_decode($c));
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

		<div class="container-fluid" id="container-wrapper">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">메인페이지</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/adm/">Home</a></li>
					<li class="breadcrumb-item">board</li>
					<li class="breadcrumb-item active" aria-current="page">메인페이지</li>
				</ol>
			</div>
			  
			<div class="row justify-content-md-center">
				<div class="col-xl-6">
					<div class="card mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">메인페이지 배너 설정</h6>
						</div>
						<div class="card-body">
							<form action="_proc.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="ACT" value="<?=$r ? "u" : "n"?>">
								<input type="hidden" name="num" value="1">
								<div class="form-group">
									<label>배경 이미지</label>
									<div class="box-file">

								<? if($data['upfile']) { 
									$imgArr = explode('/', $data['upfile']);
									$imgN = $imgArr[5];
								?>
										<div class="align-items-center mt-3 row">
											<div class="col-4">
												<a href="<?=$data['upfile']?>" target="_blank">
													<img src="<?=$data['upfile']?>" alt="">
												</a>
											</div>
											<div class="col-8 row">
												<div class="col-6">
													<input class="form-control ml-3" type="text" value="<?=$imgN?>" readonly>
												</div>
												<div class="col-6">
													<a href="#" onclick="thumbChange($(this));" class="btn btn-danger btn-lg ml-2">
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
								<div class="form-group box-quill">
									<label>텍스트</label>
									<div class="box-quitxt qui-1" style="height:150px"></div>
									<textarea name="conts" style="display:none;"><?=$conts ?? ''?></textarea>
								</div>
								
								<div class="row justify-content-md-center mt-5">
									<button type="submit" class="btn btn-primary mb-1">저장</button>
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
$(function(){
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
	})
})

function thumbChange(target) {
	var base = target.parents('.box-file');
	var inputFile = '<input class="form-control col-xl-5" type="file" name="upfile" accept="image/*">';

	base.empty().append(inputFile);
}
</script>

	</body>
</html>