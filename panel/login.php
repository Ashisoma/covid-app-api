<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tiba Tekelezi - Login</title>
    <link rel="icon" type="image/x-icon" href="img/virus.png"/>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/toastr/toastr.css" rel="stylesheet" />

</head>

<body class="bg-image">

<div class="container mt-4">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form action="code.php" method="POST" class="user" onsubmit="preventDefault();">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-user" id="inputPhone"
                                               aria-describedby="emailHelp" placeholder="Enter Phone number.">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="inputPassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <input type="button" class="btn btn-primary btn-user btn-block" onclick="login();"
                                           value="Login">

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#" id="forgotPasswordBtn">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.php">Activate your Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/toastr/toastr.min.js"></script>
<script src="js/app.js"></script>
<script>
    const inputPhone = document.getElementById('inputPhone')
    const inputPassword = document.getElementById('inputPassword')

    function login() {
        let phone = inputPhone.value.trim()
        let password = inputPassword.value.trim()

        $.ajax({
            type: "POST",
            url: "login",
            data: {
                phone: phone,
                password: password,
            },
            success: () => {
                window.location.replace("index");
            },
            error: err => {
                toastr.error("Unable To login. Kindly try again")
            }
        })
    }
    document.getElementById("forgotPasswordBtn").addEventListener("click", ()=>{
                let email = inputEmailAddress.value.trim();
                // let password  = inputPassword.value;
                if (email == "") {
                    window.alert("Check your credentials and try again.");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url:"password_reset",
                        data:{
                            email:email,        
                        },
                        success: (response) => {
                            // let mResponse = JSON.parse(response);
                            // console.log(mResponse);
                            if(response.code = 200){
                                // console.log(mResponse.data);
                                window.location.replace("forgot_password");
                             }else {
                            window.alert("Something went wrong. Please try again.");
                        }
                        
                        },
                    
                    })
                }
            })
</script>
</body>

</html>
