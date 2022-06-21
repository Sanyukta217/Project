<?php
	ob_start();
	session_start();
	session_unset();
	session_destroy();
	header_remove();
	header('Location: index.php');
	ob_end_flush();
?>
