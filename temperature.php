<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/top-navigation.php'); ?>
<?php include_once('layouts/main-navigation.php'); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Main navbar -->
    <div class="navbar navbar-expand-lg navbar-light navbar-static">
        <div class="d-flex flex-1 d-lg-none">
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-transmission"></i>
            </button>
        </div>

        <div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">

        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content d-sm-flex">
            <div class="page-title">
                <h4><span class="font-weight-semibold">Temperatures</span></h4>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        <!-- Form layouts -->
        <div class="row">
            <div class="col-md-12">

                <!-- Horizontal form -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title"></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th style="width:1px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th style="width:1px">Contact</th>
                                        <th style="width:1px">Scanned</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach(get_user_temperature() as $user) { ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$user['firstname']?> <?=$user['middlename']?> <?=$user['surname']?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=$user['contact']?></td>
                                        <td class="text-center">
                                            <?=$user['total']?>
                                        </td>
                                        <td style="width:1px" class="text-center">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-gear"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="view-temperature.php?id=<?=encode($user['temperature_id'])?>&accounts_id=<?=encode($user['accounts_id'])?>" class="dropdown-item"><i class="icon-eye"></i>
                                                    View Temperature</a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /horizotal form -->
            </div>
        </div>
        <!-- /form layouts -->

    </div>
    <!-- /content area -->
    <?php include_once('layouts/footer.php'); ?>
    <?php include_once('layouts/scripts.php'); ?>