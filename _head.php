<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="This is independently designed and developed by Sanyukta(sanyukta217@gmail.com)" />
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.ico">
        <meta name="author" content="Sanyukta Kumari" />
        <title></title>
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    </head>
<body>
  <div id="spinner">
    <div class="lds-hourglass"></div>
  </div>
  <?php
  if(session_id() == '') {
      session_start();
  }
  if (!defined('READAUTh')) {
	  define('READAUTh', true);
	}
	require_once('authenticate.php');
  ?>
