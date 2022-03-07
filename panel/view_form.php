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
    <!-- <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/forms.css" rel="stylesheet" />
    <script src="vendor/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/toastr/toastr.min.css">

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
                    <ol class="breadcrumb mb-4 transparent">
                        <li class="breadcrumb-item">
                            <a href="patient_forms">Patient Forms</a>
                        </li>
                        <?php
                        if (isset($_GET['form'])) {
                            $form = $_GET['form'];
                            echo "<li class=\"breadcrumb-item active\">$form</li>";
                        }
                        ?>

                    </ol>
                    <div class="row m-2">
                        <div class="col-12">

                            <div class="card card-checkin" id="checkedInCard">
                                <div class="card-body px-4">
                                    <h3>Checked In Patient</h3>
                                    <h4 id="headerPatientName">Johnson and Johnson</h4>
                                    <h6 id="headerPhoneNumber"></h6>
                                    <h6 id="headerFacilityName">6 years</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <?php
                        if (isset($_GET['form'])) {
                            $form = $_GET["form"];
                            if ($form == "patient_registration") {
                                include_once("includes/forms/patient_registration_form.php");
                            } elseif ($form == "triage") {
                                include_once("includes/forms/triage_form.php");
                            } elseif ($form == "screening") {
                                include_once("includes/forms/screening_form.php");
                            } elseif ($form == "Laboratory Request") {
                                include_once("includes/forms/lab_request_form.php");
                            } elseif ($form == "Contact Tracing") {
                                include_once("includes/forms/contact_tracing_form.php");
                            } elseif ($form == "Radiology Request") {
                                include_once("includes/forms/radiology_request_form.php");
                            } elseif ($form == "Patient Management") {
                                include_once("includes/forms/patient_management_form.php");
                            } elseif ($form == "Patient History") {
                                include_once("includes/forms/patient_history.php");
                            } elseif ($form == "Laboratory Result") {
                                include_once("includes/forms/lab_result_form.php");
                            } elseif ($form == "Linkage") {
                                include_once("includes/forms/patient_linkage_form.php");
                            } else {
                                echo "Form not found.";
                            }
                        } else {
                            echo "Form not found.";
                        }

                        ?>
                    </div>

                </div>
            </main>
            <?php
            include_once("includes/footer.php");
            ?>
        </div>
    </div>


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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="vendor/toastr/toastr.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/app.js"></script>
    <script src="js/view_form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>