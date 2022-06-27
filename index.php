<?php include 'functions.php';?>
<?php
if(isset($_POST['rfid'])) {
    $rfid = $_POST['rfid'];
    $temperature = $_POST['temperature'];
    temperature($rfid,$temperature);
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>HEALTH AND SAFETY PROTOCOL SREENING, MONITORING AND CONTACT TRACING SYSTEM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="login/css/style.css">
<style>
    body {
        background-image: url('assets/images/background.jpg');
        background-repeat: no-repeat;
        background-size:cover;
    }
    .heading-section {
        color:#fff
    }
</style>
</head>

<body >
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-3">
                    <h2 class="heading-section">HEALTH AND SAFETY PROTOCOL SREENING, MONITORING AND CONTACT TRACING SYSTEM</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center ">
                            <div class="text w-100">
                                    <img class="" id="image" style="width:250px;height:250px" src="assets/images/default.jpg" alt="">
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <form method="POST" id="form" autocomplete="off" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Serial Code</label>
                                    <input type="text" style="border-radius:0px" class="form-control" id="rfid" name="rfid" autofocus required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Full Name</label>
                                    <input type="text" style="border-radius:0px" class="form-control" id="fullname" name="fullname" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="label" for="password">Temperatue</label>
                                    <input type="text" style="border-radius:0px" class="form-control" id="temperature" name="temperature" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="login/js/jquery.min.js"></script>
    <script src="login/js/popper.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
    <script src="login/js/main.js"></script>

    <script>
        $('#rfid').change(e => {
            var rfid = $('#rfid').val();
            scanner(rfid)
        })

        function scanner(rfid) {
            $.ajax({
                type: 'POST',
                url: 'retrieve.php',
                dataType: 'json',
                data: {
                    rfid: rfid
                },
                success: function(data) {
                    $('#fullname').val(data.fullname);
                    $('#image').attr("src", 'assets/profile/' + data.image);
                    $.ajax({
                        type: 'GET',
                        url: 'call.php',
                        dataType: 'json',
                        success: function(data) {
                            $('#temperature').val(data.temperature);
                            
                            setTimeout(() => $('#form').submit(), 3000)
                            
                        }
                    })
                }
            })
        }
    </script>

</body>

</html>