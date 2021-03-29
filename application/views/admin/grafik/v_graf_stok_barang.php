<?php
$this->load->view('layout/header');
?>
<?php
/* Mengambil query report*/
foreach ($report as $result) {
    $bulan[] = $result->nama_kategori; //ambil bulan
    $value[] = (float) $result->tot_stok; //ambil nilai
}
/* end mengambil query*/

?>

<!-- Load chart dengan menggunakan ID -->
<div id="report"></div>
<!-- END load chart -->

<?php
$this->load->view('layout/script');
?>

<script src="<?php echo base_url() . 'assets/js/grafik/jquery.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/grafik/highcharts.js' ?>"></script>
<!-- Script untuk memanggil library Highcharts -->
<script type="text/javascript">
    $(function() {
        $('#report').highcharts({
            chart: {
                type: 'column',
                margin: 75,
                options3d: {
                    enabled: false,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Grafik Stok Barang Perkategori',
                style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            subtitle: {
                text: '',
                style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: <?php echo json_encode($bulan); ?>
            },
            exporting: {
                enabled: false
            },
            yAxis: {
                title: {
                    text: 'Total Stok'
                },
            },
            tooltip: {
                formatter: function() {
                    return 'Total Stok <b>' + this.x + '</b> Adalah <b>' + Highcharts.numberFormat(this.y, 0) + '</b> Items ';
                }
            },
            series: [{
                name: 'Stok Barang',
                data: <?php echo json_encode($value); ?>,
                shadow: true,
                dataLabels: {
                    enabled: true,
                    color: '#045396',
                    align: 'center',
                    formatter: function() {
                        return Highcharts.numberFormat(this.y, 0);
                    }, // one decimal
                    y: 0, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>

<?php
$this->load->view('layout/footer');
?>