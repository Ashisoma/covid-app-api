<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index">Tiba Tekelezi</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <!-- <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div> -->
    </form>
    <!-- Navbar-->

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4" style="float: right !important;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="float: right !important;" id="navbarDropdown" href="#"
               role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user->names; ?> </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#"><?php echo $user->names; ?></a></li>
                <li><a class="dropdown-item" href="#!">
                        <span class="icon text-black-50"><i class="fas fa-envelope"></i></span>
                        <span class="text ml-2 text-primary"> <?php echo $user->email; ?></span>
                    </a></li>
                <li><a class="dropdown-item" href="#!">
                        <span class="icon text-black-50"><i class="fas fa-phone"></i></span>
                        <span class="text ml-2 text-primary"> <?php echo $user->phone; ?></span>
                    </a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li>
                    <div class="dropdown-item" onclick="logout()">Logout</div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<style>
    span :hover {
        text-decoration: underline !important;
    }
</style>
<script>
    function logout() {
        $.ajax({
            type: "GET",
            url: "./logout",
            success: () => {
                window.location.replace("login.html");
            },
            error: error => {
                toastr.error("Unable to log out. Try again later", err.status)
            }
        })
    }
</script>