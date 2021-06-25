<style type="text/css">
  .table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}

.table-user-information > tbody > tr > td {
    border-top: 0;
}
</style>
<div class="col-md-12">
	<h3 class="page-header"><?php echo $title; ?></h3>
	<div class="col-md-3 col-lg-3 " align="center">
        <img src="<?php echo base_url('foto/'.$foto) ?>" class="img-circle img-responsive"/>
        <p><?php echo $nm_lengkap; ?></p>
    </div>
    <div class=" col-md-9 col-lg-9 "> 
        <table class="table table-user-information">
          <tbody>
            <tr>
              <td>NIP</td>
              <td><?php echo $nip; ?></td>
            </tr>
            <tr>
              <td>Nama Lengkap</td>
              <td><?php echo $nm_lengkap; ?></td>
            </tr>
            <tr>
              <td>Bagian</td>
              <td><?php echo $nama_bagian; ?></td>
            </tr>
            <tr>
              <td>Jabatan</td>
              <td><?php echo $jabatan; ?></td>
            </tr>
            <tr>
              <td>KTP</td>
              <td><?php echo $ktp; ?></td>
            </tr>
            <tr>
              <td>TTL</td>
              <td><?php echo $lahir.',&nbsp;'.date('d M Y',strtotime($tgl_lahir));?></td>
            </tr>
            <tr>
              <tr>
                <td>Kelamin</td>
                <td><?php echo $kelamin; ?></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td><?php echo $agama; ?></td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td><?php echo $telp; ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>
                  <p><?php echo $alamat; ?></p><br>
                </td>
              </tr>
              <tr>
                <td>Status</td>
                <td><?php echo$status; ?></td>
              </tr>
            </tr>
          </tbody>
        </table>
        <?php echo anchor('pegawai/index', 'Kembali',array('class'=>'btn btn-warning')); ?>
    </div>
</div>