<?php $id=$this->session->userdata['sess_peg']['id']; ?>
<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?></h3>
	<?php echo form_open('#',array('id'=>'profil'));?>
	<?php echo form_hidden('txtId', $id); ?>
	<div id="info"></div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Username:</label>
			<input type="text" name="txtUname" class="form-control" value="<?php echo $username; ?>" readonly/>
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input type="password" name="txtPass" class="form-control"/>
		</div>
	</div>
	<div class="col-md-6"></div>
	<div class="col-md-12">
		<button type="button" class="btn btn-primary" onclick="ganti()">Ganti</button>
	</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
 function ganti() {
    $.ajax({
      url: '<?php echo site_url('profil/ganti/') ?>',
      type: 'POST',
      dataType: 'json',
      data: $('#profil').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
          if(data.errors){$("#info").addClass('alert alert-danger').html(data.errors);}
        }else{
          $("#info").removeClass('alert alert-danger');
          alert(data.message);
          window.location.reload();
        }
      }
    });
 }
</script>