<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css');?>"/>
</head>
<body>
	<div class="wrapper">
	    <?php echo form_open('',array('id'=>'login','class'=>'form-signin','autocomplete'=>'off')); ?>
	      <h2 class="form-signin-heading">Login</h2>
	      <div id="info"></div>
	      <input type="text" class="form-control" name="username" placeholder="Username" autofocus/>
	      <input type="password" class="form-control" name="password" placeholder="Password"/>      
	      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="login()">Login</button>   
	    <?php echo form_close(); ?>
  	</div>
  	<script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
  	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
  	<script>
  		function login() {
	    	$.ajax({
	          url: "<?php echo site_url('welcome/cek_data') ?>",
	          type: 'POST',
	          dataType: 'json',
	          data: $('#login').serialize(),
	          encode:true,
	          success:function(data) {
		          if (!data.success) {
		            if (data.errors) {
		            	$('#info').html(data.errors).addClass('alert alert-danger');
		            }
		          }else{
		          	$('#info').removeClass('alert alert-danger');
		            alert(data.message);
		            setTimeout(function() {
		                window.location.reload();
		            },1000);
		          }
	          }
	      });
	    }
  	</script>
</body>
</html>