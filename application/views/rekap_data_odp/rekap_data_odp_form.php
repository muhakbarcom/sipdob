<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Rekap_data_odp</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Gambar <?php echo form_error('gambar') ?></label>
            <input type="text" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Ket Pelanggan <?php echo form_error('ket_pelanggan') ?></label>
            <input type="text" class="form-control" name="ket_pelanggan" id="ket_pelanggan" placeholder="Ket Pelanggan" value="<?php echo $ket_pelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Lokasi Pelanggan <?php echo form_error('lokasi_pelanggan') ?></label>
            <input type="text" class="form-control" name="lokasi_pelanggan" id="lokasi_pelanggan" placeholder="Lokasi Pelanggan" value="<?php echo $lokasi_pelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Odp Name <?php echo form_error('odp_name') ?></label>
            <input type="text" class="form-control" name="odp_name" id="odp_name" placeholder="Odp Name" value="<?php echo $odp_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Tgl Pengecekan <?php echo form_error('tgl_pengecekan') ?></label>
            <input type="text" class="form-control" name="tgl_pengecekan" id="tgl_pengecekan" placeholder="Tgl Pengecekan" value="<?php echo $tgl_pengecekan; ?>" />
        </div>
	    <input type="hidden" name="id_rekap_data" value="<?php echo $id_rekap_data; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('rekap_data_odp') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>