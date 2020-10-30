<?
	session_start();
	session_destroy();
	
	print "<script> alert('You have been successfully logged out.'); location.replace('/'); </script>";
?>
