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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="int">Upload File Validasi <?php echo form_error('odp_name') ?></label>
                        <input type="file" class="form-control" name="uploadFile" id="uploadFile" />
                    </div>
                    <input type="hidden" name="id_odp" value="<?php echo $id_odp; ?>" />
                    <button type="submit" name="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('data_odp') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#pelanggan').change(function() {
        var id
        $.ajax({
            url: <?php echo base_url('Data_odp/ambil_pelanggan') ?>,
            dataType: 'json',
            data: [
                'id' => id
            ]
            beforeSend: function() {
                $loader.show();
            }
        })
    })
</script>