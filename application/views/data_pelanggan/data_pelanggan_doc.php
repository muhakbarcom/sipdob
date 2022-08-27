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
        <h2>Data_pelanggan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ket Pelanggan</th>
		<th>Lokasi Pelanggan</th>
		<th>Nama Pelanggan</th>
		<th>No Hp</th>
		
            </tr><?php
            foreach ($data_pelanggan_data as $data_pelanggan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_pelanggan->ket_pelanggan ?></td>
		      <td><?php echo $data_pelanggan->lokasi_pelanggan ?></td>
		      <td><?php echo $data_pelanggan->nama_pelanggan ?></td>
		      <td><?php echo $data_pelanggan->no_hp ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>