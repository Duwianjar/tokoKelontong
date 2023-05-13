<?php 
//Koneksi ke Database
$db = mysqli_connect("localhost", "root", "", "db_toko");

?>


<script>
var optionsProfileVisit = {
    annotations: {
        position: 'back',
    },
    dataLabels: {
        enabled: false,
    },
    chart: {
        type: 'bar',
        height: 400,
    },
    fill: {
        opacity: 2,
    },
    plotOptions: {},
    series: [{
        name: 'Penjualan',
        data: [
            <?php $ambiljumlah=$db->query("SELECT * FROM barang");
                while($pecahjumlah = $ambiljumlah->fetch_assoc())
                {
                    $id=$pecahjumlah['id_barang'];
                    $ambilhitung=$db->query("SELECT * FROM detail_transaksi where id_barang=$id");
                    $jumlah=0;
                    while ($pecahhitung = $ambilhitung->fetch_assoc()) 
                    {
                    $jumlah = $jumlah+$pecahhitung['Jumlah'];
                    }
                    ?>
            <?= $jumlah ?>,
            <?php  }?>

        ],
    }, ],
    colors: '#435ebe',
    xaxis: {
        categories: [
            <?php $ambilbarang=$db->query("SELECT * FROM barang");
                while($pecahbarang = $ambilbarang->fetch_assoc()) {?>

            '<?= $pecahbarang['id_barang']?>
            <?= $pecahbarang['nama_barang']?> ',
            <?php  }?>
        ],
    },
};
</script>


<?php 
$ambilpenjualan1=$db->query("SELECT * FROM transaksi where id_karyawan=1");
                                            $total1 = 0;
                                            while($pecahpenjualan1 = $ambilpenjualan1->fetch_assoc()) {
                                            $total1++;
                                             }
$ambilpenjualan2=$db->query("SELECT * FROM transaksi where id_karyawan=2");
                                            $total2 = 0;
                                            while($pecahpenjualan2 = $ambilpenjualan2->fetch_assoc()) {
                                            $total2++;
                                             }?>
<script>
let optionsVisitorsProfile = {

    series: [<?=$total1?>, <?=$total2?>],
    labels: ['Aris', 'Ridwan'],
    colors: ['#435ebe', '#55c6e8'],
    chart: {
        type: 'donut',
        width: '100%',
        height: '350px',
    },
    legend: {
        position: 'bottom',
    },
    plotOptions: {
        pie: {
            donut: {
                size: '30%',
            },
        },
    },
};

var optionsEurope = {
    series: [{
        name: 'series1',
        data: [310, 800, 600, 430, 540, 340, 605, 805, 430, 540, 340, 605],
    }, ],
    chart: {
        height: 80,
        type: 'area',
        toolbar: {
            show: false,
        },
    },
    colors: ['#5350e9'],
    stroke: {
        width: 2,
    },
    grid: {
        show: false,
    },
    dataLabels: {
        enabled: false,
    },
    xaxis: {
        type: 'datetime',
        categories: [
            '2018-09-19T00:00:00.000Z',
            '2018-09-19T01:30:00.000Z',
            '2018-09-19T02:30:00.000Z',
            '2018-09-19T03:30:00.000Z',
            '2018-09-19T04:30:00.000Z',
            '2018-09-19T05:30:00.000Z',
            '2018-09-19T06:30:00.000Z',
            '2018-09-19T07:30:00.000Z',
            '2018-09-19T08:30:00.000Z',
            '2018-09-19T09:30:00.000Z',
            '2018-09-19T10:30:00.000Z',
            '2018-09-19T11:30:00.000Z',
        ],
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
        },
    },
    show: false,
    yaxis: {
        labels: {
            show: false,
        },
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm',
        },
    },
};

let optionsAmerica = {
    ...optionsEurope,
    colors: ['#008b75'],
};
let optionsIndonesia = {
    ...optionsEurope,
    colors: ['#dc3545'],
};

var chartProfileVisit = new ApexCharts(document.querySelector('#chart-profile-visit'), optionsProfileVisit);
var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile);
var chartEurope = new ApexCharts(document.querySelector('#chart-europe'), optionsEurope);
var chartAmerica = new ApexCharts(document.querySelector('#chart-america'), optionsAmerica);
var chartIndonesia = new ApexCharts(document.querySelector('#chart-indonesia'), optionsIndonesia);

chartIndonesia.render();
chartAmerica.render();
chartEurope.render();
chartProfileVisit.render();
chartVisitorsProfile.render();
</script>