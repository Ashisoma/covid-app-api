<?php
require_once("webauth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tiba Tekelezi</title>
    <link rel="icon" type="image/x-icon" href="img/icon_white.jfif" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    <link href="vendor/toastr/toastr.css" rel="stylesheet" />

    <!-- fa icons  -->
    <script src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>

    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body class="sb-nav-fixed">
    <?php
    include_once("includes/topnavbar.php");
    ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php
            include_once("includes/sidenavbar.php");
            ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row m-2">
                        <div class="col-12">

                            <div class="card d-none" id="checkedInCard">
                                <div class="card-body px-4  card-checkin">
                                    <h3>Checked In Patient</h3>
                                    <h4 id="headerPatientName">Johnson and Johnson</h4>
                                    <h6 id="headerPhoneNumber"></h6>
                                    <h6 id="headerFacilityName">6 years</h6>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" onclick="getLabRequests();">
                                        <span class="icon text-white-50 mr-2">
                                            <i class="fas fa-download"></i>
                                        </span>
                                        <span class="text">Get Lab Requests</span>
                                    </button>
                                    <button class="btn btn-warning float-right" onclick="checkoutPatient();"><i class="fas fa-sign-in-alt mr-2" aria-hidden="true"></i>Check Out</button>
                                </div>
                            </div>
                            <div class="float-right" id="divNoCheckedIn">
                                <button id="btnCheckInPatient float-right" class="btn btn-primary" data-toggle="modal" data-target="#checkinDialogModal">Check in patient</button>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            
                            Lab Requests
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="tableLabRequests">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Test Type</th>
                                        <th>Specimen Type</th>
                                        <th>Date Collected</th>
                                        <th>Date Sent To Lab</th>
                                        <th>Date Received In Lab</th>
                                        <th>Confirming Lab</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Test Type</th>
                                        <th>Specimen Type</th>
                                        <th>Date Collected</th>
                                        <th>Date Sent To Lab</th>
                                        <th>Date Received In Lab</th>
                                        <th>Confirming Lab</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include_once("includes/footer.php");
            ?>
        </div>
    </div>

    <?php
    include_once("includes/dialogs/checkin_dialog.php");
    ?>

    <script>
        let navLaboratory = document.getElementById("navLaboratory");
        let sidenav = document.getElementById("sidebarnav")
        let listItems = sidenav.getElementsByTagName("a")
        for (let i = 0; i < listItems.length; i++) {
            let item = listItems[i]
            if (item.classList.contains("active")) {
                item.classList.remove("active")
            }
        }
        navLaboratory.classList.add('active')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="vendor/toastr/toastr.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/toastr/toastr.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/laboratory.js"></script>

</body>

</html>