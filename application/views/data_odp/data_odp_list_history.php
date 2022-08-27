<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">History</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php if ($this->ion_auth->in_group("Team Leaderx")) : ?>
                            <?php echo anchor(site_url('data_odp/create'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?>
                        <?php endif ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">

                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        </form>
                    </div>
                </div>
                <form method="post" action="<?= site_url('data_odp/deletebulk'); ?>" id="formbulk">
                    <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
                        <tr>
                            <?php if ($this->ion_auth->in_group("Team Leaderx")) : ?>
                                <th style="width: 10px;"><input type="checkbox" name="selectall" /></th>
                            <?php endif; ?>
                            <th>No</th>
                            <th>Id odp</th>
                            <th>Nama Pelanggan</th>
                            <th>Odp Name</th>
                            <th>Otp Slot</th>
                            <th>Tgl Pengecekan</th>
                            <th>Penginput</th>
                            <th>Keterangan</th>
                        </tr><?php
                                foreach ($data_odp_data as $data_odp) {
                                ?>
                            <tr>

                                <?php if ($this->ion_auth->in_group("Team Leaderx")) : ?>
                                    <td style="width: 10px;padding-left: 8px;">
                                        <input type="checkbox" name="id" value="<?= $data_odp->id_odp; ?>" />&nbsp;
                                    </td>
                                <?php endif; ?>

                                <td width="80px"><?php echo ++$start ?></td>
                                <td><?php echo $data_odp->id_odp ?></td>
                                <td><?php echo nama_pelanggan($data_odp->id_pelanggan) ?></td>
                                <td><?php echo $data_odp->odp_name ?></td>
                                <td><?php echo $data_odp->otp_slot ?></td>
                                <td><?php echo $data_odp->tgl_pengecekan ?></td>
                                <td><?php echo nama_user($data_odp->penginput) ?></td>
                                <td><?php echo cek_keterangan_validasi($data_odp->validasi_history) ?></td>

                            </tr>
                        <?php
                                }
                        ?>
                    </table>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <?php if ($this->ion_auth->in_group("Team Leaderx")) : ?>
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>
                            <?php endif ?>
                            <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6 text-right">
                        <?php echo $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
    $(':checkbox[name=selectall]').click(function() {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $("#formbulk").on("submit", function() {
        var rowsel = [];
        $.each($("input[name='id']:checked"), function() {
            rowsel.push($(this).val());
        });
        if (rowsel.join(",") == "") {
            alertify.alert('', 'Tidak ada data terpilih!', function() {});

        } else {
            var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?',
                'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                ok: 'Yakin',
                cancel: 'Batal!'
            }).set('onok', function(closeEvent) {

                $.ajax({
                    url: "data_odp/deletebulk",
                    type: "post",
                    data: "msg = " + rowsel.join(","),
                    success: function(response) {
                        if (response == true) {
                            location.reload();
                        }
                        //console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });
            $(".ajs-header").html("Konfirmasi");
        }
        return false;
    });
</script>