<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - AdminComputo</title>

    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/pc.png">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center my-5">

            <div class="col-xl-6 col-lg-6 col-md-9 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                           
                            <div class="col-lg-12">
                                <div class="p-5">
                                
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Iniciar Sesion</h1>
                                    </div>
                                    <?php if (session()->getFlashdata('alert-type')): ?>
                                        <div class="col-12 mt-2">
                                            <div class="alert <?= session()->getFlashdata('alert-type'); ?> alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                <h5><i class="icon fas fa-info"></i> <?= session()->getFlashdata('alert-title'); ?></h5>
                                                <?= session()->getFlashdata('alert-message'); session_destroy(); ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <form class="user" action="<?=base_url('/dashboard'); ?>" autocomplete="true" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" 
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        
                                        <?php if(session()->getFlashdata('icon')):?>
                                            <div class="my-3 card <?= session()->getFlashdata('color')?> text-white shadow">
                                                <div class="card-body">
                                                    <i class="<?= session()->getFlashdata('icon');?>"></i>
                                                <?= session()->getFlashdata('mensaje') ?>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </form>
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

</body>

</html>