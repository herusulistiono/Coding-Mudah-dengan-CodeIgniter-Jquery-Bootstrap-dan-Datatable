<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?></h3>
	<?php echo form_open('#',array('id'=>'pegawai'));?>
	<div id="info"></div>
	<div class="col-md-6">
		<div class="form-group">
			<label>NIP:</label>
			<input type="text" name="txtNip" class="form-control" placeholder="NIP" autofocus/>
		</div>
		<div class="form-group">
			<label>Nama Pegawai:</label>
			<input type="text" name="txtNama" class="form-control" placeholder="Nama Pegawai"/>
		</div>
		<div class="form-group">
			<label>Jabatan:</label>
			<input type="text" name="txtJabatan" class="form-control" placeholder="Jabatan"/>
		</div>
		<div class="form-group">
			<label>Bagian:</label>
			<select name="txtIdBag" class="form-control">
				<option value="">Bagian</option>
				<?php foreach ($bagian as $opt): ?>
				<?php echo '<option value="'.$opt['id_bag'].'">'.$opt['nama_bagian'].'</option>'; ?>
				<?php endforeach ?>
			</select>
		</div>
		<div class="form-group">
			<label>KTP:</label>
			<input type="text" name="txtKtp" class="form-control" placeholder="KTP"/>
		</div>
		<div class="form-group">
			<label>Kelamin:</label>
			<input name="txtKelamin" class="" type="radio" value="L"/> Laki-Laki
			<input name="txtKelamin" class="" type="radio" value="P"/> Perempuan
		</div>
		<div class="form-group">
			<label>Agama:</label>
			<?php $agama=array('Budha','Hindu','Islam','Katolik','Kristen') ?>
			<select name="txtAgama" class="form-control">
				<option value="">Pilih</option>
				<?php foreach ($agama as $value): ?>
				<?php echo '<option value="'.$value.'">'.$value.'</option>' ?>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Lahir:</label>
			<input type="text" name="txtLahir" class="form-control" placeholder="Tempat Lahir"/>
		</div>
		<div class="form-group">
			<label>Tanggal Lahir:</label>
			<input type="text" name="txtTgl_lahir" class="form-control date" placeholder="Tanggal Lahir"/>
		</div>
		<div class="form-group">
			<label>Telepon:</label>
			<input type="text" name="txtTelp" class="form-control" placeholder="Telepon"/>
		</div>
		<div class="form-group">
			<label>Alamat:</label>
			<textarea name="txtAlamat" class="form-control" placeholder="Alamat"></textarea>
		</div>
		<div class="form-group">
			<label>Foto:</label>
			<input type="file" name="txtFoto"/>
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
	});
	function simpan() {
    var data = new FormData($('#pegawai')[0]);
		$.ajax({
			url: "<?php echo site_url('pegawai/simpan/'); ?>",
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