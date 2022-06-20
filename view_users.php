<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/top-navigation.php'); ?>
<?php include_once('layouts/main-navigation.php'); ?>
<?php if(isset($_GET['delete'])) { ?>
    <?php delete_user($_GET['delete']); ?>
<?php } ?>
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
                <h4><span class="font-weight-semibold">View Users</span></h4>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        <!-- Form layouts -->
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_GET['message'])){ ?>
                <div class="alert alert-info"><?=urldecode(base64_decode($_GET['message']))?></div>
                <?php } ?>

                <!-- Horizontal form -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">List of Users</h5>
                    </div>

                    <div class="card-body">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th style="width:1px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th style="width:1px">Serial</th>
                                        <th style="width:1px">Contact</th>
                                        <th style="width:1px">Role</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach(users() as $user) { ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$user['firstname']?> <?=$user['middlename']?> <?=$user['surname']?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=$user['rfid']?></td>
                                        <td><?=$user['contact']?></td>
                                        <td>
                                            <?php if($user['user_type_id'] == '1') { ?>
                                                <label class="badge badge-primary">Student</label>
                                            <?php } elseif($user['user_type_id'] == '2') { ?>
                                                <label class="badge badge-success">Teacher</label>
                                            <?php } elseif($user['user_type_id'] == '3') { ?>
                                                <label class="badge badge-warning">Staff</label>
                                            <?php } else { ?>
                                                <label class="badge badge-danger">Visitor</label>
                                            <?php } ?>
                                        </td>
                                        <td style="width:1px" class="text-center">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-gear"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="edit-users.php?id=<?=encode($user['id'])?>" class="dropdown-item"><i class="icon-pencil"></i>
                                                    Edit Information</a>

                                                <a href="edit-profile-picture.php?id=<?=encode($user['id'])?>" class="dropdown-item"><i class="icon-image2"></i>
                                                Edit Profile Picture</a>

                                                <a href="edit-password.php?id=<?=encode($user['id'])?>" class="dropdown-item"><i class="icon-lock"></i>
                                                    Change Password</a>
                                                <a href="?delete=<?=encode($user['id'])?>" class="dropdown-item"><i class="icon-trash"></i> Delete User</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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