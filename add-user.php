<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/top-navigation.php'); ?>
<?php include_once('layouts/main-navigation.php'); ?>
<?php 

if(isset($_POST['btn_add_user'])) {
    $rfid          = post('rfid');
    $surname       = post('surname');
    $firstname     = post('firstname');
    $middlename    = post('middlename');
    $email         = post('email');
    $password      = post('password');
    $contact       = post('contact');
    $user_type_id  = post('user_type_id');
    add_users($rfid,$firstname,$middlename,$surname,$email,$password,$contact,$user_type_id);
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
                <h4><span class="font-weight-semibold">Add Users</span></h4>
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
                        <h5 class="card-title">User Information</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" data-parsley-validate enctype="multipart/form-data">

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Image</label>
                                <div class="col-md-10">
                                    <input type="file" name="files" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row rfid">
                                <label class="col-md-2 col-form-label">RFID Serial Number</label>
                                <div class="col-md-10">
                                    <input type="text" name="rfid" autofocus data-parsley-pattern="^[0-9]*$" id="rfid"
                                        class="form-control" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Surname</label>
                                <div class="col-md-10">
                                    <input type="text" name="surname" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">First Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="firstname" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Middle Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="middlename" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Email Address</label>
                                <div class="col-md-10">
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Contact</label>
                                <div class="col-md-10">
                                    <input type="text" name="contact" data-parsley-pattern="^[0-9]*$"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Password <b class="text-muted">
                                        (default)</b></label>
                                <div class="col-md-10">
                                    <input type="text" name="password" readonly value="12345678" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">User Type</label>
                                <div class="col-md-10">
                                    <select name="user_type_id" class="form-control user_type" class="form-control">
                                        <?php foreach(show_all_user_types() as $user_type) { ?>
                                        <option value="<?=$user_type['id']?>"><?=$user_type['type']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" name="btn_add_user"
                                    class="btn button-flat btn-sm btn-primary">Create User</button>
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

    <script>
    $('.user_type').change(e => {
        var user_type = $('.user_type').val();
        if (user_type == '5') {
            $('.rfid').attr('hidden', true);
            $('#rfid').val('');
            $('#rfid').attr('required', false)
        } else {
            $('#rfid').attr('required', true)
            $('.rfid').attr('hidden', false);
        }
    })
    </script>