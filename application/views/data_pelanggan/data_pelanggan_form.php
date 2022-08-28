<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Data_pelanggan</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="enum">Ket Pelanggan <?php echo form_error('ket_pelanggan') ?></label>
                        <!-- <input type="text" class="form-control" name="ket_pelanggan" id="ket_pelanggan" placeholder="Ket Pelanggan" value="<?php echo $ket_pelanggan; ?>" /> -->
                        <select class="form-control" name="ket_pelanggan" id="ket_pelanggan">
                            <option value="A">Aktif</option>
                            <option value="T">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Lokasi Pelanggan <?php echo form_error('lokasi_pelanggan') ?></label>
                        <input type="text" class="form-control" name="lokasi_pelanggan" id="lokasi_pelanggan" placeholder="Lokasi Pelanggan" value="<?php echo $lokasi_pelanggan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Pelanggan <?php echo form_error('nama_pelanggan') ?></label>
                        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan" value="<?php echo $nama_pelanggan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama ODP <?php echo form_error('nama_odp') ?></label>
                        <input type="text" class="form-control" name="nama_odp" id="nama_odp" placeholder="Nama ODP" value="<?php echo $nama_odp; ?>" />
                    </div>
                    <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('data_pelanggan') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>