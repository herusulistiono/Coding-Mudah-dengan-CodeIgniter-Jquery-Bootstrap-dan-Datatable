<?php 
$id=$this->session->userdata['sess_peg']['id'];
$username=$this->session->userdata['sess_peg']['username'];
$level=$this->session->userdata['sess_peg']['level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css') ?>"/>
	<style type="text/css" media="screen">
		body {
		  min-height: 2000px;
		  padding-top: 70px;
		}
	</style>
	<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">CI Kepegawaian</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <?php if ($level=='Admin'): ?>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor('pegawai/index', 'Data Pegawai'); ?></li>
                <li role="separator" class="divider"></li>
                <li><?php echo anchor('bagian/index', 'Data Bagian'); ?></li>
                <li><?php echo anchor('pengguna/index', 'Data Pengguna'); ?></li>
              </ul>
          </li>
          <?php else: ?>
            <li><?php echo anchor('pegawai/index', 'Data Pegawai'); ?></li>
          <?php endif ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><?php echo anchor('profil/index/'.$id, 'Hello,' .$username); ?></li>
            <li><?php echo anchor('welcome/keluar', '<i class="glyphicon glyphicon-off"></i> Keluar'); ?></li>
          </ul>
      </div>
    </div>
  </nav>
  <div class="container"><?php echo $_content; ?></div>
</body>
</html>