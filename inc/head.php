<?
	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$r_site = libQuery("select metadata from config where num='1'");
	
	if ($r_site) {
		$data_site = $r_site[0];
		$m_site = $data_site['metadata'];
		$meta_site = unserialize(base64_decode($m_site));
	}

	$site_tit 		= $meta_site['tit'];
	$site_logo 		= $meta_site['logo'];
	$site_foot 		= $meta_site['footer'];
	$site_snsDName 	= $meta_site['snsDName'];
	$site_snsDUrl 	= $meta_site['snsDUrl'];
	$site_snsS 		= $meta_site['snsS'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
    <meta name="twitter:card" content="" />
    
	<!-- Fav and touch icons -->
	<link rel="shortcut icon" href="">
	
	<!-- css -->
    <link href="/assets/css/common.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/layout.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/aos.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- js -->
	<script src="/assets/js/jquery-3.5.1.min.js"></script>
    <script src="/assets/js/common.js"></script>
    <script src="/assets/js/aos.js"></script>
