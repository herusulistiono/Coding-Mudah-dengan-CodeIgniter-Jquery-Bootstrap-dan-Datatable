<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?>
		<p class="pull-right">
      <?php echo anchor('pegawai/tambah','Tambah Data Pegawai',array('class'=>'btn btn-primary btn-xs'));?>
      <?php echo anchor('pegawai/pdf','Export PDF',array('class'=>'btn btn-primary btn-xs'));?>
      <?php //echo anchor('pegawai/excel','Export Excel',array('class'=>'btn btn-primary btn-xs'));?>
    </p>
	</h3>
	<div id="info"></div>
	<table id="pegawai" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th>NIP</th>
				<th>Nama</th>
				<th>Jabatan</th>
				<th>Bagian</th>
				<th>Kelamin</th>
				<th>Telp</th>
				<th>Status</th>
				<th width="8%" class="no-sort">#</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    $('#pegawai').DataTable({
      "processing": true,
      "ajax": {
       "url": "<?php echo site_url('pegawai/data_pegawai') ?>",
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
	function hapus(id_peg) {
      if (confirm("Anda yakin mau hapus data ini!!")) {
        $.ajax({
            url: '<?php echo site_url('pegawai/hapus/'); ?>',
            type: 'POST',
            dataType: 'json',
            data: 'id_peg='+id_peg,
            encode:true,
            success:function (data) {
                if(!data.success){
                    if(data.errors){
                        $('#info').addClass('alert alert-danger').html(data.errors);
                        return false;
                    }
                }else{
                    $('#info').removeClass('alert alert-danger').addClass('alert alert-success').html(data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                }
            }
        })
      }
    }
</script>