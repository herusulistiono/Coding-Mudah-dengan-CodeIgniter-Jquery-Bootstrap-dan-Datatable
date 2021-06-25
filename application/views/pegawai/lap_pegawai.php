<html>
  <head>
    <title><?php echo $title;?></title>
    <style type="text/css">
      .display_header {border-collapse: collapse;}
      .display_header th, .display_header td {border: none; padding:3px 4px;}

      table
      {
        width: 100%;
        border-collapse: collapse;
        padding: 0px;
        margin: 0px;
        font-family: Arial;
        font-size: 11px;
        line-height: 1.4;
      }
      th
      {
        border: solid 1px #000000;
        text-align: center;
        color: #212529;
      }
      td
      {
        border: solid 1px #000000;
        color: #212529;
      }
    </style>
  </head>
  <body>
  <h3>Data Pegawai</h3>
  <?php 
      $warnaGenap = "#dee2e6";
      $warnaGanjil = "#fff";
      $warnaHeading = "#007bff";
    ?>

  <table>
      <thead>
        <tr bgcolor="<?php echo $warnaHeading ?>">
          <th width="5%">No</th>
          <th>NIP</th>
          <th>Nama</th>
          <th>Jabatan</th>
          <th>Bagian</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $no = (int)1; foreach ($pegawai as $row): 
        if ($no % 2 == 0) $warna = $warnaGenap;
        else $warna = $warnaGanjil;
      ?>
        <tr bgcolor="<?php echo $warna;?>">
          <td align="center"> <?php echo $no++ ?></td>
          <td> <?php echo $row->nip;?></td>
          <td> <?php echo $row->nm_lengkap;?></td>
          <td> <?php echo $row->jabatan;?></td>
          <td> <?php echo $row->nama_bagian;?></td>
        </tr>

      <?php endforeach ?>
    </tbody>
    </table>
  </body>
</html>