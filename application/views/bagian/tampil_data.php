<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?>
		<p class="pull-right">
      <a href="javascript:void(0)" type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Data</a>
    </p>
	</h3>
	<table id="bagian" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th>Nama Bagian</th>
				<th width="3%" class="no-sort">#</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="title" class="modal-title">Data Bagian</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('#',array('id'=>'form_bagian'));?>
        <?php echo form_hidden('txtId'); ?>
        <div id="info"></div>
        <div class="form-group">
          <label>Nama Bagian</label>
          <input type="text" name="txtNama" class="form-control" placeholder="Nama Bagian"/>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" id="simpan" class="btn btn-primary" onclick="simpan()">Simpan</button>
        <button type="button" id="ganti" class="btn btn-warning" onclick="ganti()">Ganti</button>
      </div>
    </div>
  </div>
</div>


<script>
	$(document).ready(function() {
    $('#bagian').DataTable({
      "processing": true,
      "ajax": {
       "url": "<?php echo site_url('bagian/data_bagian') ?>",
       "type": "POST"
      },
        "sPaginationType": "full_numbers",
        "order":[[0,"asc" ]],
        "columnDefs": [
          {"bVisible": true,},
          {"bSortable": false,"aTargets": ["no-sort"]}
        ]
    });
  });
  function tambah() {
    $('.modal').modal('show');
    $('#ganti').attr('disabled', 'disabled');
  }
  function simpan() {
    $.ajax({
      url: '<?php echo site_url('bagian/simpan/') ?>',
      type: 'POST',
      dataType: 'json',
      data: $('#form_bagian').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
          if(data.errors){$("#info").addClass('alert alert-danger').html(data.errors);}
        }else{
          $("#info").removeClass('alert alert-danger');
          alert(data.message);
          window.location.href="<?php echo site_url('bagian/index') ?>";
        }
      }
    });
  }
  function data_ubah(id_bag) {
    $('.modal').modal('show');
    $('#simpan').attr('disabled', 'disabled');
    $('#ganti').removeAttr('disabled', 'disabled');
    $.ajax({
      url: "<?php echo site_url('bagian/ubah/'); ?>",
      type: 'POST',
      dataType: 'json',
      data: 'id_bag='+id_bag,
      encode:true,
      success:function(data) {
        $('#ganti').removeAttr('disabled');
        $('input[name="txtId"]').val(data.id_bag);
        $('input[name="txtNama"]').val(data.nama_bagian);
      }
    });
  }
  function ganti() {
    $.ajax({
      url: '<?php echo site_url('bagian/simpan_ubah/') ?>',
      type: 'POST',
      dataType: 'json',
      data: $('#form_bagian').serialize(),
      encode:true,
      success:function (data) {
        if(!data.success){
          if(data.errors){$("#info").addClass('alert alert-danger').html(data.errors);}
        }else{
          $("#info").removeClass('alert alert-danger');
          alert(data.message);
          window.location.href="<?php echo site_url('bagian/index') ?>";
        }
      }
    });
  }
</script>