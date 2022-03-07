<nav id="sidebarnav" class="sb-sidenav accordion sb-sidenav-blue" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a id="navIndex" class="nav-link active" href="index">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Patient Management</div>
            <a id="navForms" class="nav-link" href="patient_forms">
                <div class="sb-nav-link-icon"><i class="fa fa-list-alt"></i></div>
                Patient Forms
            </a>
            <a id="navPatientManagement" class="nav-link" href="patient_information">
                <div class="sb-nav-link-icon"><i class="fas fa-hospital-user"></i></div>
                Patient Information
            </a>
            <a id="navLaboratory" class="nav-link" href="laboratory">
                <div class="sb-nav-link-icon"><i class="fas fa-flask"></i></div>
                Laboratory
            </a>
            <a id="navReports" class="nav-link" href="reports">
                <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                Reports
            </a>
            <a id="navUsers" class="nav-link" href="users">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Users
            </a>
            <?php
            if ($user->category == 7) {
                # code... to change the views here
                echo "  <div class=\"sb-sidenav-menu-heading\">System Management</div>
                <a id=\"navUserCategories\" class=\"nav-link\" href=\"usercategories\">
                    <div class=\"sb-nav-link-icon\"><i class=\"fas fa-users-cog\"></i></div>
                    User Category
                </a>";
            
            } else {
                # code...
                echo    "<a id=\"navFacilities\" class=\"nav-link\" href=\"facilities\">
                    <div class=\"sb-nav-link-icon\"><i class=\"fas fa-building\"></i></div>
                    Facilities
                </a>";
            }
            
            ?>
            
        </div>
    </div>
</nav>
