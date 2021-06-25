<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?></h3>
	<?php echo form_open('#',array('id'=>'pegawai'));?>
	<?php echo form_hidden('txtIdpeg',$id_peg); ?>
	<div id="info"></div>
	<div class="col-md-6">
		<div class="form-group">
			<label>NIP:</label>
			<input type="text" name="txtNip" class="form-control" value="<?php echo $nip ?>"/>
		</div>
		<div class="form-group">
			<label>Nama Pegawai:</label>
			<input type="text" name="txtNama" class="form-control" value="<?php echo $nm_lengkap ?>"/>
		</div>
		<div class="form-group">
			<label>Jabatan:</label>
			<input type="text" name="txtJabatan" class="form-control" value="<?php echo $jabatan ?>"/>
		</div>
		<div class="form-group">
			<label>Bagian:</label>
			<select name="txtIdBag" class="form-control">
              <option value="">Bagian</option>
              <?php foreach ($bagian as $opt): ?>
              <?php 
              if ($id_bag==$opt['id_bag']) {
                    $selected='selected="selected"';}
                  else{
                    $selected='';}
                  echo '<option value="'.$opt['id_bag'].'" '.$selected.'>'.$opt['nama_bagian'].'</option>';
              ?>
              <?php endforeach ?>
            </select>
		</div>
		<div class="form-group">
			<label>KTP:</label>
			<input type="text" name="txtKtp" class="form-control" value="<?php echo $ktp ?>" />
		</div>
		<div class="form-group">
			<label>Kelamin:</label>
			<?php
                $kel=array('L'=>'Laki-laki','P'=>'Perempuan');
                foreach ($kel as $key => $value): 
                  if ($kelamin==$key) {
                    $checked='checked="checked"';}
                  else{
                    $checked='';}
                    echo '<input name="txtKelamin" type="radio" value="'.$key.'" '.$checked.'>&nbsp;'.$value.'&nbsp;';
                endforeach;
             ?>


		</div>
		<div class="form-group">
			<label>Agama:</label>
			<?php $data_agama=array('Budha','Hindu','Islam','Katolik','Kristen') ?>
            <select name="txtAgama" class="form-control">
              <option value="">Pilih</option>
              <?php foreach ($data_agama as $opt): ?>
              <?php 
              if ($agama==$opt) {
                    $selected='selected="selected"';}
                  else{
                    $selected='';}
                  echo '<option value="'.$opt.'" '.$selected.'>'.$opt.'</option>';
              ?>
              <?php endforeach ?>
            </select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Lahir:</label>
			<input type="text" name="txtLahir" class="form-control" value="<?php echo $lahir ?>"/>
		</div>
		<div class="form-group">
			<label>Tanggal Lahir:</label>
			<input type="text" name="txtTgl_lahir" class="form-control date" value="<?php echo $tgl_lahir ?>"/>
		</div>
		<div class="form-group">
			<label>Telepon:</label>
			<input type="text" name="txtTelp" class="form-control" value="<?php echo $telp ?>"/>
		</div>
		<div class="form-group">
			<label>Alamat:</label>
			<textarea name="txtAlamat" class="form-control"><?php echo $alamat ?></textarea>
		</div>
		<div class="form-group">
			<label>Foto:</label>
			<input type="file" name="txtFoto"/>
		</div>
		<div class="form-group">
			<label>Status:</label>
			<?php $ak=array('Aktif','Tidak') ?>
            <select name="txtStatus" class="form-control">
              <option value="">Pilih</option>
              <?php foreach ($ak as $opt): ?>
              <?php 
              if ($status==$opt) {
                    $selected='selected="selected"';}
                  else{
                    $selected='';}
                  echo '<option value="'.$opt.'" '.$selected.'>'.$opt.'</option>';
              ?>
              <?php endforeach ?>
            </select>
		</div>
	</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
		<a href="<?php echo site_url('pegawai/index') ?>" class="btn btn-warning">Batal</a>
	</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.date').datepicker({
	        dateFormat: 'dd-mm-yy'
	    });
	})
	function simpan() {
    var data = new FormData($('#pegawai')[0]);
		$.ajax({
			url: "<?php echo site_url('pegawai/simpan_ubah/'); ?>",
			type: 'POST',
	      	dataType: 'json',
	      	data: data,
	      	mimeType: 'multipart/form-data',
	      	secureuri:false,
	      	contentType:false,
	      	cache : false,
	      	processData:false,
	      	encode:true,
			success:function(data) {
				if(!data.success){
					if(data.errors){$("#info").addClass('alert alert-danger').html(data.errors);}
				}else{
					$("#info").removeClass('alert alert-danger');
					alert(data.message);
					window.location.href="<?php echo site_url('pegawai/index') ?>";
				}
			}
		})
	}
</script>