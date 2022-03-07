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

<body class="sb-nav-fixed bg-image">
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

                            <div class="card d-none transparent" id="checkedInCard">
                                <div class="card-body px-4  card-checkin">
                                    <h3>Checked In Patient</h3>
                                    <h4 id="headerPatientName">Johnson and Johnson</h4>
                                    <h6 id="headerPhoneNumber"></h6>
                                    <h6 id="headerFacilityName">6 years</h6>
                                </div>
                                <div class="card-footer transparent">
                                    <button class="btn btn-warning float-right" onclick="checkoutPatient();"><i class="fas fa-sign-in-alt mr-2" aria-hidden="true"></i>Check Out</button>
                                </div>
                            </div>
                            <div class="float-right" id="divNoCheckedIn">
                                <button id="btnCheckInPatient float-right" class="btn btn-primary" data-toggle="modal" data-target="#checkinDialogModal">Check in patient</button>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="card mb-4">
                                <a href="#divCollapseScreening" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="divCollapseScreening">
                                    <h6 class="m-0 font-weight-bold text-center"> Patient Screening (Latest) </h6>
                                </a>
                                <div id="divCollapseScreening" class=" px-3 card-body collapse hide">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 px-3">
                                            <table id="tablePatientScreeening" class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Screened On</td>
                                                        <td>2021-12-12</td>
                                                    </tr>
                                                    <tr>
                                                        <td>History Of Fever/Chills</td>
                                                        <td>Filled At</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Filled At</td>
                                                        <td>Filled At</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6 col-sm-12 px-3">
                                            <table id="tablePatientScreeening2" class=" table table-striped table-bordered">
                                                <thead>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Screened On</td>
                                                        <td>2021-12-12</td>
                                                    </tr>
                                                    <tr>
                                                        <td>History Of Fever/Chills</td>
                                                        <td>Filled At</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Filled At</td>
                                                        <td>Filled At</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">

                            <div class="card mb-4">
                                <a href="#divCollapseHistory" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="divCollapseHistory">
                                    <h6 class="m-0 font-weight-bold text-center"> Patient History (Latest) </h6>
                                </a>
                                <div id="divCollapseHistory" class="card-body collapse">
                                    <table id="tablePatientHistory" class="table table-striped table-bordered">
                                        <thead>
                                            <th>Question</th>
                                            <th>Value</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Filled At</td>
                                                <td>Filled At</td>
                                            </tr>
                                            <tr>
                                                <td>Filled At</td>
                                                <td>Filled At</td>
                                            </tr>
                                            <tr>
                                                <td>Filled At</td>
                                                <td>Filled At</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Triage Information</h5>
                                </div>
                                <div class="card-body">
                                    <table id="tableTriage" class="table table-striped table-bordered">
                                        <thead>
                                            <th>Question</th>
                                            <th>Answer</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Filled At</td>
                                                <td>Filled At</td>
                                            </tr>
                                            <tr>
                                                <td>Filled At</td>
                                                <td>Filled At</td>
                                            </tr>
                                            <tr>
                                                <td>Filled At</td>
                                                <td>Filled At</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card mb-4 ">
                                <div class="card-header">
                                    <h5>Patient Contacts</h5>
                                </div>
                                <div class="card-body">
                                    <div id="liContacts" class="list-group">
                                        <li class="list-group-item mb-2">

                                            <h6>Jackline Maundu</h6>
                                            <p class="mb-0">0717845485</p>
                                        </li>
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="card mb-4 transparent">
                                <div class="card-header transparent">
                                    <h5>Laboratory and Radiology Requests</h5>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="card shadow mb-3">
                                            <a href="#collapseCardLabRequests" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardLabRequests">
                                                <h6 class="m-0 font-weight-bold text-center"> Laboratory Requests</h6>
                                            </a>
                                            <div id="collapseCardLabRequests" class="collapse hide">
                                                <div class="card-body">
                                                    <table id="tableLabRequests" class="table table-striped table-bordered">
                                                        <thead>
                                                            <th>Specimen Type</th>
                                                            <th>Test Type</th>
                                                            <th>Date Collected</th>
                                                            <th>Date Sent to Lab</th>
                                                            <th>Confirming Lab</th>
                                                            <th>Result</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card shadow mb-3">
                                            <a href="#collapseCardRadRequests" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardRadRequests">
                                                <h6 class="m-0 font-weight-bold text-center"> Radiology Requests</h6>
                                            </a>
                                            <div id="collapseCardRadRequests" class="collapse hide">
                                                <div class="card-body">
                                                    <table id="tableRadRequests" class="table table-striped table-bordered">
                                                        <thead>
                                                            <th>Date Requested</th>
                                                            <th>Date Done</th>
                                                            <th>Results</th>
                                                            <th>Comments</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        let navPatientManagement = document.getElementById("navPatientManagement");
        let sidenav = document.getElementById("sidebarnav")
        let listItems = sidenav.getElementsByTagName("a")
        for (let i = 0; i < listItems.length; i++) {
            let item = listItems[i]
            if (item.classList.contains("active")) {
                item.classList.remove("active")
            }
        }
        navPatientManagement.classList.add('active')
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
    <script src="js/patient_information.js"></script>

</body>

</html>