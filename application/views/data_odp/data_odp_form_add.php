<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Data_odp</h3>
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
                        <label for="enum">Pelanggan <?php echo form_error('id_pelanggan') ?></label>
                        <select class="form-control" name="id_pelanggan" id="id_pelanggan">
                            <option>Pilih Pelanggan</option>
                            <?php foreach ($list_pelanggan as $value) : ?>
                                <option value="<?php echo $value->id_pelanggan ?>" data-id="<?php echo $value->id_pelanggan ?>"><?php echo $value->nama_pelanggan ?></option>

                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
            <label for="enum">Ket Pelanggan <?php echo form_error('ket_pelanggan') ?></label>
            <input type="text" class="form-control" name="ket_pelanggan" id="ket_pelanggan" placeholder="Ket Pelanggan" value="<?php echo $ket_pelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Lokasi Pelanggan <?php echo form_error('lokasi_pelanggan') ?></label>
            <input type="text" class="form-control" name="lokasi_pelanggan" id="lokasi_pelanggan" placeholder="Lokasi Pelanggan" value="<?php echo $lokasi_pelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Pelanggan <?php echo form_error('nama_pelanggan') ?></label>
            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan" value="<?php echo $nama_pelanggan; ?>" />
        </div> -->
                    <div class="form-group">
                        <label for="int">Odp Name <?php echo form_error('odp_name') ?></label>
                        <input disabled type="text" class="form-control" id="odp_name" placeholder="Odp Name" value="<?php echo $odp_name; ?>" />
                        <input type="hidden" class="form-control" name="odp_name" id="odp_name" placeholder="Odp Name" value="<?php echo $odp_name; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Otp Slot <?php echo form_error('otp_slot') ?></label>
                        <input type="text" class="form-control" name="otp_slot" id="otp_slot" placeholder="Otp Slot" value="<?php echo $otp_slot; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Tgl Pengecekan <?php echo form_error('tgl_pengecekan') ?></label>
                        <input type="date" class="form-control" name="tgl_pengecekan" id="tgl_pengecekan" placeholder="Tgl Pengecekan" value="<?php echo $tgl_pengecekan; ?>" />
                    </div>

                    <input type="hidden" name="id_odp" value="<?php echo $id_odp; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('data_odp') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // otomatis isi odp name saat pilih pelanggan
    $('#id_pelanggan').change(function() {
        //    ambil id yang di pilih
        var id_pelanggan = $(this).val();
        $.ajax({
            url: "<?php echo base_url('Data_odp/ambil_odp') ?>",
            method: "POST",
            data: {
                id: id_pelanggan
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#odp_name').val(data);
            }

        })
    });
</script>