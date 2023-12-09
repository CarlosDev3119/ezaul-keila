<?php require_once "./views/header.php" ?>
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
                    <h1 class="h3 mb-2 text-gray-800">Restaurantes</h1>
                    <p class="mb-4">Descubre una variedad única de experiencias culinarias en nuestros destacados restaurantes. 
                        Desde la elegancia sofisticada hasta la calidez acogedora, cada establecimiento ofrece un ambiente distintivo para acompañar su excepcional 
                        propuesta gastronómica. Deléitate con platos elaborados con los ingredientes más frescos y disfruta de un servicio de alta calidad en cada uno 
                        de nuestros restaurantes. </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos sobre restaurantes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>DIRECCION</th>
                                            <th>CIUDAD</th>
                                            <th>NUMERO DE RESTAURANTE</th>
                                            <th>DUEÑO</th>
                                            <th>ACCIONES</th>
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

    <script src="./js/restaurant/restaurant.js" type="module"></script>
</body>
</html>