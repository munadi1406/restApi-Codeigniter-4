<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<?php

$osArray = array();
$osCountArray = array();
$cityArray = array();
$cityCountArray=array();
$countryArray = array();
$countryCountArray=array();



foreach ($device as $log) {
    $osArray[] = $log['device'];
    $osCountArray[] = $log['count(device)'];
}



foreach ($city as $cityLog) {
    $cityArray[] = $cityLog['city'];
    $cityCountArray[] = $cityLog['count(city)'];
}


foreach ($country as $countryLog) {
    $countryArray[] = $countryLog['country'];
    $countryCountArray[] = $countryLog['count(country)'];
}


// var_dump($osCountArray);
$osString = "'" . implode("', '", $osArray) . "'";
$osCountString = implode(',', $osCountArray);
$cityString = "'" . implode("', '", $cityArray) . "'";
$cityCountString = implode(',', $cityCountArray);
$countryString = "'" . implode("', '", $countryArray) . "'";
$countryCountString = implode(',', $countryCountArray);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Device</h6>
                </div>
                <div class="card-body h-100 d-flex justify-content-center align-items-center ">

                    <canvas id="myChart" class="w-100 h-100"></canvas>
                </div>

            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik City</h6>
                </div>
                <div class="card-body h-100 d-flex justify-content-center align-items-center ">

                    <canvas id="city" class="w-100 h-100"></canvas>
                </div>

            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik County</h6>
                </div>
                <div class="card-body h-100 d-flex justify-content-center align-items-center ">

                    <canvas id="country" class="w-100 h-100"></canvas>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Log Activity</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Visit Time</th>
                                <th>Ip Address</th>
                                <th>Browser</th>
                                <th>Operating System</th>
                                <th>Visited Page</th>
                                <th>City</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>Referer</th>
                                <th>Screen Resolution</th>
                                <th>Device</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $datas) { $visit_time = $datas['visit_time'];
                                $datetime = new DateTime($visit_time, new DateTimeZone('UTC')); // Mengubah waktu menjadi zona waktu UTC
                                $datetime->setTimezone(new DateTimeZone('Asia/Jakarta')); // Menyesuaikan zona waktu menjadi WIB
                                
                                $wib_time = $datetime->format('H:i d/m/Y'); // Format waktu menjadi HH:ii (24 jam)
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $wib_time ?></td>
                                    <td><?= $datas['ip_address'] ?></td>
                                    <td><?= $datas['browser'] ?></td>
                                    <td><?= $datas['operating_system'] ?></td>
                                    <td><?= $datas['visited_page'] ?></td>
                                    <td><?= $datas['city'] ?></td>
                                    <td><?= $datas['region'] ?></td>
                                    <td><?= $datas['country'] ?></td>
                                    <td><?= $datas['referrer'] ?></td>
                                    <td><?= $datas['screen_resolution'] ?></td>
                                    <td><?= $datas['device'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?= $osString ?>],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $osCountString ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
    const city = document.getElementById('city');
    new Chart(city, {
        type: 'bar',
        data: {
            labels: [<?= $cityString ?>],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $cityCountString ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });

    const country = document.getElementById('country');
    new Chart(country, {
        type: 'bar',
        data: {
            labels: [<?= $countryString ?>],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $countryCountString ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
</script>

<?= $this->endSection() ?>