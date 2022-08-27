<div class="container">
    <div class="row">

        <div class="box">
            <div class="box-header">
                <!-- <h2>Laporan</h2> -->
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="POST">
                            <label for="">Filter</label>
                            <input type="month" name="bulan">
                            <select name="lokasi" id="">
                            <?php foreach ($lokasi as $loc): ?>   
                            <option value="<?= $loc->lokasi?>"><?= $loc->lokasi?></option>
                            <?php endforeach ?>
                            </select>
                            <button type="submit" class="btn btn-primary">submit</button>
                        </form>
                        <br><br><br>
                        <div class="col-md-12"><canvas id="chart-area-profit"></canvas></div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Maps of <?php echo $lokasimaps ?></label><br>
                        <img src="<?php echo base_url('assets/uploads/maps/'.$nama_file)?>" alt="" width="300px">
                    </div>
                </div>
                <div class="row" style="margin-top:50px ;">
                    
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url(); ?>assets/chart.js/Chart.js"></script>

<script>
    var pieDataProfit = [{
            value: <?= $total_lokasi ?>,
            color: "#4B3C77",
            highlight: "#554488",
            label: 'Total Lokasi'
        }
        // ,
        // {
        //     value: <?= $total_lokasi ?>,
        //     color: "#2100AA",
        //     highlight: "#2200aaea",
        //     label: 'Chat Dengan Admin'
        // },
        // {
        //     value: <?= $total_lokasi ?>,
        //     color: "#DED828",
        //     highlight: "#cfca26",
        //     label: 'Chat Dengan Bot'
        // },
        // {
        //     value: <?= $total_lokasi ?>,
        //     color: "#28A0F6",
        //     highlight: "#2493e2",
        //     label: 'Chat Selesai'
        // },
        // {
        //     value: <?= $total_lokasi ?>,
        //     color: "#FF8B49",
        //     highlight: "#e67d41",
        //     label: 'abc'
        // }

    ];



    window.onload = function() {
        var ctxProfit = document.getElementById("chart-area-profit").getContext("2d");
        window.myPie = new Chart(ctxProfit).Pie(pieDataProfit);
    };
</script>