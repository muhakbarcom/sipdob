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
        <h2>Data_odp List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ket Pelanggan</th>
		<th>Lokasi Pelanggan</th>
		<th>Nama Pelanggan</th>
		<th>Odp Name</th>
		<th>Otp Slot</th>
		<th>Tgl Pengecekan</th>
		
            </tr><?php
            foreach ($data_odp_data as $data_odp)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo cek_status_ket($data_odp->ket_pelanggan) ?></td>
		      <td><?php echo $data_odp->lokasi_pelanggan ?></td>
		      <td><?php echo $data_odp->nama_pelanggan ?></td>
		      <td><?php echo $data_odp->odp_name ?></td>
		      <td><?php echo $data_odp->otp_slot ?></td>
		      <td><?php echo $data_odp->tgl_pengecekan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>