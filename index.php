
<?php require_once "./views/header.php" ?>

<?php 
    @session_start();
    if(isset($_SESSION["user_email"]) && $_SESSION["user_email"]){
        echo "<script>
            window.location.href='./home.php';
        </script>";
        exit(0);
    }
?>

<body class="bg-gradient-primary">

    <div class="container login-center">

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
                                        <h1 class="h4 text-gray-900 mb-4">Ingresar al sistema!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Ingresa tu correo...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Ingresa tu contraseña">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                            </div>
                                        </div>
                                        <a id="btnLogin" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                        
                                    </form>
                          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php require_once "./views/footer.php" ?>
    
    <script type="module" src="./js/auth/login.js">
        
    </script>

</body>
</html>