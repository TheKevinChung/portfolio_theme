<?
	session_start();

	if (!isset($_SESSION['adm_id'])) {
		header('location:/adm/login.php');
	}

	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$max_row = 30;
	$page = (int)(@$_POST['page'] ?: 1);

	$r = libQuery("
		select *
		from bbs
		where del = 'N'
		order by idx desc
		limit ? offset ?
	", 'ii', array($max_row, ($page - 1) * $max_row));
?>

<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/head.php'; ?>

</head>

<body id="page-top">
	<div id="wrapper">
	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/header.php'; ?>
		 <!-- Container Fluid-->
		<div class="container-fluid" id="container-wrapper">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">포트폴리오 게시판</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="./">Home</a></li>
					<li class="breadcrumb-item">board</li>
					<li class="breadcrumb-item active" aria-current="page">포트폴리오</li>
				</ol>
			</div>

			<div class="row">
				<div class="col-lg-12 mb-4">
					<!-- Simple Tables -->
					<div class="card">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">리스트</h6>
						</div>
						<div class="table-responsive">
							<table class="table  align-items-center table-flush">
								<thead class="thead-light">
									<tr>
										<th width="100px">번호</th>
										<th>썸네일</th>
										<th>제목</th>
										<th>등록일</th>
										<th>수정일</th>
										<th>조회수</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?
								if($r) {

									for ($i=0; $i<count($r); $i++) {
										$num = $i+1;
										$arr = $r[$i];
										$m = $arr['metadata'];
										$meta = unserialize(base64_decode($m));
							?>
									<tr>
										<td><a href="#" target="_blank"><?=$num?></a></td>
										<td>
											<img src="<?=$arr['thumb']?>" alt="">
										</td>
										<td><a href="#" target="_blank"><?=$meta['tit']?></a></td>
										<td><?=date_format(date_create($arr['reg_date']), 'Y-m-d')?></td>
										<td><?=date_format(date_create($arr['mod_date']), 'Y-m-d')?></td>
										<td><?=$arr['view_cnt']?></td>
										<td>
											<a href="write.php?ACT=u&idx=<?=$arr['idx']?>" class="btn btn-sm btn-primary">수정</a>&nbsp;
											<a href="#none" onclick="if(confirm('삭제하시겠습니까?')) {location.href='del_proc.php?idx=<?=$arr['idx']?>'}" class="btn btn-sm btn-danger">삭제</a>
										</td>
									</tr>
								<? } ?>
							<? } else { ?>
									<tr>
										<td colspan="7">데이터가 없습니다.</td>
									</tr>
							<? } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-center mt-4">
						<a href="write.php" class="btn mb-1 btn-success">추가</a>
					</div>
				</div>
			</div>
			<!--Row-->
		</div>
	</div>
	<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/footer.php'; ?>
	</body>
</html>