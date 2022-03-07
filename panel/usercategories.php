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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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

                    <div class="card mb-4">
                        <div class="card-header py-3">
                            User Categories
                            <button class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#userCategoryModal" id="btnAddUserCategory">
                                <span class="icon text-white-50">
                                    <i class="fas fa-user-cog"></i>
                                </span>
                                <span class="text">Add New User Category</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="categoriesTable">
                                <thead>
                                    <tr>
                                        <th>Names</th>
                                        <th>Description</th>
                                        <th>Access Level</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Names</th>
                                        <th>Description</th>
                                        <th>Access Level</th>
                                        <th>Permissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                    </tr>

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

    <!-- User category dialog -->
    <div class="modal fade" id="userCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id='formCategory' action="code.php" method="POST" onsubmit="event.preventDefault();">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>User Category Name</label>
                            <input type="text" name="cadreName" class="form-control" id="inputCategoryName" placeholder="Enter User Category Name" required>
                        </div>
                        <div class="form-group">
                        <label>Access level</label>
                        <select id="accessLevelSelect" class="form-control">
                            <option hidden value="0">Select Access Level</option>
                        </select>
                    </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" placeholder="Add a small description of this user" required id="inputCategoryDesc"></textarea>
                        </div>
                        <div class="form-group" id="divPermissions">
                            <label>Permissions</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addrolebtn" class="btn btn-primary" id="btnSaveCategory">Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        let navUserCategories = document.getElementById("navUserCategories");
        let sidenav = document.getElementById("sidebarnav")
        let listItems = sidenav.getElementsByTagName("a")
        for (let i = 0; i < listItems.length; i++) {
            let item = listItems[i]
            if (item.classList.contains("active")) {
                item.classList.remove("active")
            }
        }
        navUserCategories.classList.add('active')
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!-- <script src="js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="js/demo/chart-bar-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/usercategories.js"></script>

</body>

</html>