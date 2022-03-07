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
    <link rel="icon" type="image/x-icon" href="img/icon_white.jfif"/>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="vendor/toastr/toastr.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    <script src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                <button class="btn btn-primary mb-2" onclick="viewForm('patient_registration')">
                                        <span class="icon text-white-50 mr-2">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    <span class="text">Registration Information</span>
                                </button>
                                <button class="btn btn-warning float-right mb-2" onclick="checkoutPatient();"><i
                                            class="fas fa-sign-in-alt mr-2" aria-hidden="true"></i>Check Out
                                </button>
                            </div>
                        </div>
                        <div class="float-right" id="divNoCheckedIn">
                            <button id="btnRegisterPatient" class="btn btn-primary mb-1"
                                    onclick="viewForm('patient_registration')">Register New Patient
                            </button>
                            <button id="btnCheckInPatient float-right" class="btn btn-primary mb-1" data-toggle="modal"
                                    data-target="#checkinDialogModal">Check in patient
                            </button>
                        </div>

                    </div>
                </div>
                <hr>
                <h1 class="mt-4">Patient Forms</h1>
                <div class="row m-3">
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('triage')">
                        <img class="rounded-circle bg-white" width="100px" height="100px" src="img/nurse.png">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #7cb644; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Triage</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('screening')">
                        <img class="rounded-circle bg-white" width="100px" height="100px" src="img/screening.png">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #FFD700; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Screening</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('Laboratory Request')">
                        <img class="rounded-circle bg-white" width="100px" height="100px" src="img/microscope.png">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #7cb644; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Laboratory Request</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('Radiology Request')">
                        <img class="rounded-circle bg-white" width="100px" height="100px" src="img/x-ray.png">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #FFD700; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Radiology</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('Patient Management')">
                        <img class="rounded-circle bg-white" width="100px" height="100px" src="img/medical-file.png">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #7cb644; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Covid Patient Management</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('Contact Tracing')">
                        <img class="rounded-circle bg-white" width="100px" height="100px" src="img/user.png">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #FFD700; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Contact Tracing</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('Patient History')">
                        <img class="rounded-circle p-2" width="100px" height="100px" src="img/history.png" style="background:#7cb644">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #7cb644; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Patient History</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-3 col-sm-4 text-center" onclick="viewForm('Linkage')">
                        <img class="rounded-circle p-2" width="100px" height="100px" src="img/2chain.png" style="background:#FFD700">
                        <div class="card mb-4" style="border-style: solid;
                                border-width: medium; border-color: #FFD700; margin-top: -50px; height: 150px; position: revert">
                            <div class="card-body">
                                <p class="card-title"
                                   style="margin-top: 50px; text-transform: uppercase; font-size: large">Linkage</p>
                            </div>
                        </div>
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
    let navForms = document.getElementById("navForms");
    let sidenav = document.getElementById("sidebarnav")
    let listItems = sidenav.getElementsByTagName("a")
    for (let i = 0; i < listItems.length; i++) {
        let item = listItems[i]
        if (item.classList.contains("active")) {
            item.classList.remove("active")
        }
    }
    navForms.classList.add('active')
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="vendor/toastr/toastr.min.js"></script>
<script src="js/app.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/patient_forms.js"></script>
</body>

</html>
