<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Laporan</h3>
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
            <label for="varchar">Evaluasi <?php echo form_error('evaluasi') ?></label>
            <!-- <input type="text" class="form-control" name="evaluasi" id="evaluasi" placeholder="Evaluasi" value="<?php echo $evaluasi; ?>" /> -->
            <select class="form-control" name="evaluasi" id="evaluasi">
                <option value="Data Tidak Sinkron">Data Tidak Sinkron</option>
                <option value="Gambar Tidak Ada">Gambar Tidak Ada</option>
                <option value="Tidak Ada Slot">Tidak Ada Slot</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="date">Tgl Evaluasi <?php echo form_error('tgl_evaluasi') ?></label>
            <input type="text" class="form-control" name="tgl_evaluasi" id="tgl_evaluasi" placeholder="Tgl Evaluasi" value="<?php echo $tgl_evaluasi; ?>" />
        </div>
	    <input type="hidden" name="id_laporan" value="<?php echo $id_laporan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('laporan') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>