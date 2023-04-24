<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url('admin/')?>" class="site_title"><img src="<?= base_url('assets/images/icon.png')?>" alt=""><span>MKDIR Data Center</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= base_url('assets/images/avatar.png') ?>" alt="Avatar" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <div class="badge badge-primary"><?= session('ruid') ?></div>
                <h2><?= session('uuid') ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?= base_url('admin/')?>"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li><a><i class="fa fa-newspaper-o"></i> Post <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('admin/post-add')?>">Post Add</a></li>
                            <li><a href="<?= base_url('admin/post-data')?>">Post Data</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-youtube-play"></i> Tipe <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('admin/post-movie')?>">Movie</a></li>
                            <li><a href="<?= base_url('admin/post-series')?>">Series</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-history"></i> Log <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('log') ?>">Log Data</a></li>
                            <li><a href="<?= base_url('log-view')?>">Log Views</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-users"></i> Users<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('users') ?>">Users Data</a>
                            <li><a href="#level1_1">Add Users</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" class="w-100" data-placement="top" title="Logout" href="<?= base_url('log-out')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>