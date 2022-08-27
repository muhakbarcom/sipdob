<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Rekap Data Odp</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Gambar</th>
		<th>Ket Pelanggan</th>
		<th>Lokasi Pelanggan</th>
		<th>Odp Name</th>
		<th>Tgl Pengecekan</th>
		
            </tr><?php
            foreach ($rekap_data_odp_data as $rekap_data_odp)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $rekap_data_odp->gambar ?></td>
		      <td><?php echo $rekap_data_odp->ket_pelanggan ?></td>
		      <td><?php echo $rekap_data_odp->lokasi_pelanggan ?></td>
		      <td><?php echo $rekap_data_odp->odp_name ?></td>
		      <td><?php echo $rekap_data_odp->tgl_pengecekan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>