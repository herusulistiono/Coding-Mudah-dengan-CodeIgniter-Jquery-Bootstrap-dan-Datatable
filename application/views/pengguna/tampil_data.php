<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?>
		<p class="pull-right">
      <a href="javascript:void(0)" type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Data</a>
    </p>
	</h3>
	<table id="pengguna" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th>Nama Pengguna</th>
        <th>Level</th>
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
        <h4 id="title" class="modal-title">Data Pengguna</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('#',array('id'=>'user'));?>
        <?php echo form_hidden('txtId'); ?>
        <div id="info"></div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="txtNama" class="form-control" placeholder="Username"/>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="txtPass" class="form-control" placeholder="Password"/>
        </div>
        <div class="form-group">
          <label>Level</label>
          <select name="txtLevel" class="form-control">
            <option value="">Level</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
          </select>
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
    $('#pengguna').DataTable({
      "processing": true,
      "ajax": {
       "url": "<?php echo site_url('pengguna/data_pengguna') ?>",
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
      url: '<?php echo site_url('pengguna/simpan/') ?>',
      type: 'POST',
      dataType: 'json',
      data: $('#user').serialize(),
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
  function data_ubah(id) {
    $('.modal').modal('show');
    $('#simpan').attr('disabled', 'disabled');
    $('#ganti').removeAttr('disabled', 'disabled');
    $.ajax({
      url: "<?php echo site_url('pengguna/ubah/'); ?>",
      type: 'POST',
      dataType: 'json',
      data: 'id='+id,
      encode:true,
      success:function(data) {
        $('#ganti').removeAttr('disabled');
        $('input[name="txtId"]').val(data.id);
        $('input[name="txtNama"]').val(data.username);
        $('select[name="txtLevel"]').val(data.level);
      }
    });
  }
  function ganti() {
    $.ajax({
      url: '<?php echo site_url('pengguna/simpan_ubah/') ?>',
      type: 'POST',
      dataType: 'json',
      data: $('#user').serialize(),
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