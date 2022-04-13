<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tiba Tekelezi - Register</title>
    <link rel="icon" type="image/x-icon" href="img/virus.png" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-image">

    <div class="container mt-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Password Reset!</h1>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="inputPhone"
                                        placeholder="Phone Number">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="inputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="inputPasswordRepeat" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary btn-user btn-block" onclick="registerAccount();">
                                    Reset Password
                                </a>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
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
    <script src="js/app.js"></script>
    <script>
        const inputPhone = document.getElementById('inputPhone')
        const inputPassword = document.getElementById('inputPassword')
        const inputPasswordRepeat = document.getElementById('inputPasswordRepeat')

        function registerAccount(){
            let phone = inputPhone.value.trim()
            let password = inputPassword.value.trim()
            let passwordRepeat = inputPasswordRepeat.value.trim()
            if(password !== passwordRepeat) {
                alert("Please enter similar passwords.")
            }
            $.ajax({
                type: "POST",
                url: "forgot_reset",
                data: {
                    phone: phone,
                    password: password,
                },
                success: response => {
                    window.location.replace("login.html");
                },
                error: err => {
                    toastr.error("Unable to reset password")
                }
            })
        }

        document.getElementById("forgotPassword").addEventListener("click", ()=>{
            const inputPhone = document.getElementById('inputPhone')
                // let password  = inputPassword.value;
                if (inputPhone == "") {
                    window.alert("Check your credentials and try again.");
                }
                // else{
                //     $.ajax({
                //         type: "POST",
                //         url:"password_reset",
                //         data:{
                //             email:email,        
                //         },
                //         success: (response) => {
                //             // let mResponse = JSON.parse(response);
                //             // console.log(mResponse);
                //             if(response.code = 200){
                //                 // console.log(mResponse.data);
                //                 window.location.replace("forgot_password");
                //              }else {
                //             window.alert("Something went wrong. Please try again.");
                //         }
                        
                //         },
                    
                //     })
                // }
            })
    </script>

</body>

</html>
