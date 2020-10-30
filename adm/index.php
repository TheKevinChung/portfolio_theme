<?
  session_start();

  if (!isset($_SESSION['adm_id'])) {
    header('location:/adm/login.php');
  }
?>

<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/head.php'; ?>

</head>

<body id="page-top">
  <div id="wrapper">
  <? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/header.php'; ?>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <div class="text-center col-12">
              <img src="img/think.svg" style="max-height: 90px">
              <h4 class="pt-3">save your <b>imagination</b> here!</h4>
            </div>
          </div>
          <!--Row-->
        </div>
        <!---Container Fluid-->
      </div>

<? include $_SERVER['DOCUMENT_ROOT'].'/adm/inc/footer.php'; ?>
