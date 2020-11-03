<?
	session_start();

	if (!isset($_SESSION['adm_id'])) {
		header('location:/adm/login.php');
	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$r = libQuery("select num, metadata from config");
	$num = $r[0]['num'];

	if ($r) {
		$m = $r[0]['metadata'];
		$meta = unserialize(base64_decode($m));
	}
?>

<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/head.php'; ?>

</head>

<body id="page-top">
	<div id="wrapper">
	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/header.php'; ?>

		<div class="container-fluid" id="container-wrapper">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">기본 설정</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/adm/">Home</a></li>
					<li class="breadcrumb-item">setting</li>
					<li class="breadcrumb-item active" aria-current="page">기본 설정</li>
				</ol>
			</div>
			  
			<div class="row justify-content-md-center">
				<div class="col-xl-6">
					<div class="card mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">사이트 설정</h6>
						</div>
						<div class="card-body">
							<form action="_proc.php" method="post">
								<input type="hidden" name="ACT" value="<?=$r ? "u" : "n"?>">
								<input type="hidden" name="num" value="<?=$num ? $num : ""?>">
								<div class="form-group">
									<label for="titInput">제목</label>
									<input type="text" name="tit" value="<?=$meta['tit'] ? $meta['tit'] : ""?>" class="form-control" id="titInput" placeholder="title">
								</div>
								<div class="form-group">
									<label for="logoInput">로고</label>
									<input type="text" name="logo" value="<?=$meta['logo'] ? $meta['logo'] : ""?>" class="form-control" id="logoInput" placeholder="logo">
								</div>
								<div class="form-group">
									<label for="footerInput">카피라이트</label>
									<input type="text" name="footer" value="<?=$meta['footer'] ? $meta['footer'] : ""?>" class="form-control" id="footerInput" placeholder="copyright">
								</div>
								
  								<hr>
								<div class="form-group">
									<label>SNS 바로가기 링크</label>
								<?
									if ($meta['snsDName'][0]) {
										$snsDName = $meta['snsDName'];
										$snsDUrl  = @$meta['snsDUrl'];

										for ($i=0; $i<count($snsDName); $i++) {
								?>
									<div class="row">
										<div class="form-group col-lg-6">
											<label for="titInput">SNS명</label>
											<input type="text" name="snsDName[]" value="<?=$snsDName[$i] ? $snsDName[$i] : ""?>" class="form-control" id="titInput" placeholder="sns">
										</div>
										<div class="form-group col-lg-6">
											<label for="titInput">링크</label>
											<input type="text" name="snsDUrl[]" value="<?=$snsDUrl[$i] ? $snsDUrl[$i] : ""?>" class="form-control" id="titInput" placeholder="url">
										</div>
									</div>
								<?
										}
									} else {
								?>
									<div class="row">
										<div class="form-group col-lg-6">
											<label for="titInput">SNS명</label>
											<input type="text" name="snsDName[]" class="form-control" id="titInput" placeholder="sns">
										</div>
										<div class="form-group col-lg-6">
											<label for="titInput">링크</label>
											<input type="text" name="snsDUrl[]" class="form-control" id="titInput" placeholder="url">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-lg-6">
											<label for="titInput">SNS명</label>
											<input type="text" name="snsDName[]" class="form-control" id="titInput" placeholder="sns">
										</div>
										<div class="form-group col-lg-6">
											<label for="titInput">링크</label>
											<input type="text" name="snsDUrl[]" class="form-control" id="titInput" placeholder="url">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-lg-6">
											<label for="titInput">SNS명</label>
											<input type="text" name="snsDName[]" class="form-control" id="titInput" placeholder="sns">
										</div>
										<div class="form-group col-lg-6">
											<label for="titInput">링크</label>
											<input type="text" name="snsDUrl[]" class="form-control" id="titInput" placeholder="url">
										</div>
									</div>
								<? } ?>
									<!-- <div class="row justify-content-md-center">
										<a href="#" class="btn btn-info btn-sm">
											<i class="fas fa-plus"></i>
										</a>
									</div> -->
								</div>
								<hr>
								<div class="form-group">
									<label>SNS공유 항목</label>

									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="snsS[0]" value="fb" <?=@$meta['snsS'][0] ? "checked" : ""?> class="custom-control-input" id="fbCheck">
										<label class="custom-control-label" for="fbCheck"><i class="fab fa-facebook-f"></i> facebook</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="snsS[1]" value="tw" <?=@$meta['snsS'][1] ? "checked" : ""?> class="custom-control-input" id="twCheck">
										<label class="custom-control-label" for="twCheck"><i class="fab fa-twitter"></i> twitter</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="snsS[2]" value="pin" <?=@$meta['snsS'][2] ? "checked" : ""?> class="custom-control-input" id="pinCheck">
										<label class="custom-control-label" for="pinCheck"><i class="fab fa-pinterest"></i> pinterest</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="snsS[3]" value="email" <?=@$meta['snsS'][3] ? "checked" : ""?> class="custom-control-input" id="emailCheck">
										<label class="custom-control-label" for="emailCheck"><i class="far fa-envelope"></i> email</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="snsS[4]" value="link" <?=@$meta['snsS'][4] ? "checked" : ""?> class="custom-control-input" id="linkCheck">
										<label class="custom-control-label" for="linkCheck"><i class="fas fa-link"></i> link copy</label>
									</div>
								</div>
								<div class="row justify-content-md-center">
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
	</body>
</html>