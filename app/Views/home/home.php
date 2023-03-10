<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php

$title     = "What's wrong with CSS?";
$url_title = url_title($title);

$osArray = array();
$osCountArray = array();
foreach ($data['os'] as $os) {
  $osArray[] = $os['operating_system'];
  $osCountArray[] = $os['count(operating_system)'];
}

// var_dump($osCountArray);
$osString = "'" . implode("', '", $osArray) . "'";
$osCountString = implode(',', $osCountArray);

?>
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row" style="display: inline-block;">
    <div class="tile_count">

      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-newspaper-o"></i> Total Post </span>
        <div class="count"><?= $data['countpost'] ?></div>
        <a href="<?= base_url('admin/post-data') ?>" class="count_bottom"><i class="green">Show</i></a>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-eye"></i> Post Show</span>
        <div class="count"><?= $data['countpostshow'] ?></div>
        <a href="<?= base_url('admin/post-data') ?>" class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Show</i></a>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-youtube-play"></i> Movie</span>
        <div class="count green"><?= $data['countpostmovie'] ?></div>
        <a href="<?= base_url('admin/post-data') ?>" class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Show</i></a>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-youtube-play"></i> Series</span>
        <div class="count"><?= $data['countpostseries'] ?></div>
        <a class="count_bottom"><i class="red"><i class="fa fa-sort-asc"></i>12% </i> From last Week</a>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
        <div class="count">2,315</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
        <div class="count">7,325</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
      </div>
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Network Activities <small>Graph title sub-title</small></h3>
          </div>
          <div class="col-md-6">
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
              <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
            </div>
          </div>
        </div>

        <div class="col-md-9 col-sm-9 ">
          <div id="chart_plot_01" class="demo-placeholder"></div>
        </div>
        <div class="col-md-3 col-sm-3  bg-white">
          <div class="x_title">
            <h2>Top Campaign Performance</h2>
            <div class="clearfix"></div>
          </div>

          <div class="col-md-12 col-sm-12 ">
            <div>
              <p>Facebook Campaign</p>
              <div class="">
                <div class="progress progress_sm" style="width: 76%;">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                </div>
              </div>
            </div>
            <div>
              <p>Twitter Campaign</p>
              <div class="">
                <div class="progress progress_sm" style="width: 76%;">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 ">
            <div>
              <p>Conventional Media</p>
              <div class="">
                <div class="progress progress_sm" style="width: 76%;">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                </div>
              </div>
            </div>
            <div>
              <p>Bill boards</p>
              <div class="">
                <div class="progress progress_sm" style="width: 76%;">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br />

  <div class="row">


    <div class="col-md-4 col-sm-4 ">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>App Versions</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <h4>App Usage across versions</h4>
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.2</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>123k</span>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.3</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>53k</span>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.4</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>23k</span>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.5</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>3k</span>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.6</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>1k</span>
            </div>
            <div class="clearfix"></div>
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-5 col-sm-5 ">
      <div class="x_panel tile fixed_height_400 overflow_hidden">
        <div class="x_title">
          <h2>Device </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-4 ">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Quick Settings</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Settings 1</a>
                <a class="dropdown-item" href="#">Settings 2</a>
              </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">
            <ul class="quick-list">
              <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
              </li>
              <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
              </li>
              <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
              <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
              </li>
              <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
              <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
              </li>
              <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
              </li>
            </ul>

            <div class="sidebar-widget">
              <h4>Profile Completion</h4>
              <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
              <div class="goal-wrapper">
                <span id="gauge-text" class="gauge-value pull-left">0</span>
                <span class="gauge-value pull-left">%</span>
                <span id="goal-text" class="goal-value pull-right">100%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [<?= $osString ?>],
      datasets: [{
        label: 'Jumlah',
        data: [<?= $osCountString ?>],
        borderWidth: 1
      }]
    },
    options: {


    }
  });
</script>

<?= $this->endSection(); ?>