<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/top-navigation.php'); ?>
<?php include_once('layouts/main-navigation.php'); ?>
<?php 
if(isset($_GET['id'])) { 
    if(get_user_information($_GET['id']) !== false) {
        $row = get_user_information($_GET['id']);
    } else {
        header('location: view-users.php');
    }
} else { 
    header('location: view-users.php');
}

if(isset($_POST['btn_edit_profile'])) {
    $id = post('id');
    edit_profile($id);
}

?>
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
                <h4><span class="font-weight-semibold">Edit Profile Picture</span></h4>
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
                        <h5 class="card-title">Update Profile Picture</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" data-parsley-validate enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=encode($row->id)?>">

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label"></label>
                                <div class="col-md-10">
                                    <img src="assets/profile/<?=$row->image?>" style="width:250px;height:250px" class="img-responsive" alt="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Image</label>
                                <div class="col-md-10">
                                    <input type="file" name="files" class="form-control" required>
                                </div>
                            </div>
                     
                            <div class="text-right">
                                <button type="submit" name="btn_edit_profile" class="btn button-flat btn-primary">Save Changes</button>
                            </div>
                        </form>
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