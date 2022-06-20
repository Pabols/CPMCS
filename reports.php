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
                <h4><span class="font-weight-semibold">Reports</span></h4>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        <!-- Form layouts -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-primary flat btn-sm" data-toggle="modal"
                        data-target="#exampleModal">Search</button>
                </div>
                <!-- Horizontal form -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="width:100%" class="table datatable-button-html5-basic">
                                <thead>
                                    <tr>
                                        <th style="width:1px">#</th>
                                        <th>Name</th>
                                        <th>Serial</th>
                                        <th>Temperature</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th style="width:1px">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach(get_reports() as $user) { ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$user['firstname']?> <?=$user['middlename']?> <?=$user['surname']?></td>
                                        <td><?=$user['rfid']?></td>
                                        <td><?=$user['temperature']?> &#176;C</td>
                                        <td><?=date('F j, Y',strtotime($user['scanned_date']))?></td>
                                        <td><?=date('g:i A',strtotime($user['scanned_date']))?></td>
                                        <td><?=$user['type']?></td>
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

    <form action="result.php" data-parsley-validate method="POST">
        <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">From</label>
                            <input type="date" name="from" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">To</label>
                            <input type="date" name="to" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn-search" class="btn btn-primary btn-sm flat">Search Now</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /content area -->
    <?php include_once('layouts/footer.php'); ?>
    <?php include_once('layouts/scripts.php'); ?>