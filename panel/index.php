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
    <!-- <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/toastr/toastr.min.css" rel="stylesheet">

    <script src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>
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
                <h1 class="mt-4">Dashboard</h1>
                <div class="row">

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-left-primary mb-4">
                            <div class="card-header font-weight-bolder">Screened</div>
                            <div class="card-body">
                                <h3>Total</h3>
                                <p id="pTotalScreened" class="font-weight-bold text-primary">24 </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card border-left-warning mb-4">
                            <div class="card-header font-weight-bolder">Presumptive</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>TB</h3>
                                        <p id="pPresumptiveTb" class="font-weight-bold text-warning">14</p>
                                    </div>
                                    <div class="col-6">
                                        <h3>Covid</h3>
                                        <p id="pPresumptiveCovid" class="font-weight-bold text-warning ml-2">14</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card border-left-success mb-4">
                            <div class="card-header font-weight-bolder ">Evaluated</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>TB</h3>
                                        <p class="font-weight-bold text-success ml-2 mt-2">0</p>
                                    </div>
                                    <div class="col-6">
                                        <h3>Covid</h3>
                                        <p class="font-weight-bold text-success ml-2 mt-2">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card border-left-warning mb-4">
                            <div class="card-header font-weight-bolder">Confirmed</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3>TB</h3>
                                        <p id="pTBConfirmed" class="font-weight-bold text-warning ml-2 mt-2">14</p>
                                    </div>
                                    <div class="col-6">
                                        <h3>Covid</h3>
                                        <p id="pCovidConfirmed" class="font-weight-bold text-warning ml-2">14</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header font-weight-bolder">
                                Laboratory
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 align-items-left">
                                        <i class="fas fa-share-square fa-2x text-warning align-items-center ml-4"></i>

                                        <div class="col mr-2">
                                            <h3>Requests Sent</h3>
                                            <p id="pLabRequestsSent" class="font-weight-bold text-warning ml-2">14</p>
                                        </div>
                                    </div>
                                    <div class="col-6 align-items-right">
                                        <i class="fas fa-sign-in-alt fa-2x text-success ml-4"></i>

                                        <div class="col mr-2">
                                            <h3>Requests Received</h3>
                                            <p id="pLabRequestsReceived" class="font-weight-bold text-success ml-2">
                                                14</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header font-weight-bolder">
                                Radiology
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 align-items-left">
                                        <i class="fas fa-share-square fa-2x text-warning align-items-center ml-4"></i>

                                        <div class="col mr-2">
                                            <h3>Requests Sent</h3>
                                            <p id="pRadRequestsSent" class="font-weight-bold text-warning ml-2">14</p>
                                        </div>
                                    </div>
                                    <div class="col-6 align-items-right">
                                        <i class="fas fa-sign-in-alt fa-2x text-success ml-4"></i>

                                        <div class="col mr-2">
                                            <h3>Requests Received</h3>
                                            <p id="pRadRequestsReceived" class="font-weight-bold text-success ml-2">
                                                14</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script>
    let navIndex = document.getElementById("navIndex");
    let sidenav = document.getElementById("sidebarnav")
    let listItems = sidenav.getElementsByTagName("a")
    for (let i = 0; i < listItems.length; i++) {
        let item = listItems[i]
        if (item.classList.contains("active")) {
            item.classList.remove("active")
        }
    }
    navIndex.classList.add('active')
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="vendor/toastr/toastr.min.js"></script>
<script src="js/app.js"></script>
<script src="js/index.js"></script>
</body>

</html>
