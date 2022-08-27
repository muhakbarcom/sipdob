<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Laporan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>id odp</th>
		<th>Nama Pelanggan</th>
		<th>Lokasi Pelanggan</th>
		
            </tr><?php
            foreach ($laporan_data as $laporan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
              <td><?php echo $laporan->id_odp ?></td>
		      <td><?php echo $laporan->nama_pelanggan ?></td>	
		      <td><?php echo $laporan->lokasi_pelanggan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>