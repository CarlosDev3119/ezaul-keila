<?php require_once "./views/header.php" ?>
<?php session_start()?>
<body>
    
      <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once "./views/ui/topBar.php" ?>
             

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Reservaciones</h1>
                    <p class="mb-4">Aqui puedes visualizar las reservaciones actuales que has registrado. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos sobre tu reservación</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable_Reservation" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID_ESTANCIA</th>
                                            <th>NOMBRE DEL CLIENTE</th>
                                            <th>NOMBRE DEL RESTAURATE</th>
                                            <th>DIRECCIÓN DEL RESTAURATE</th>
                                            <th>NUMERO DE TÉLEFONO DEL RESTAURANTE </th>
                                            <th>DNI DEL USUARIO </th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                       
                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    
    <?php require_once "./views/footer.php" ?>
    
</body>
</html>