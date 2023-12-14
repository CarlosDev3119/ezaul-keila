<?php 
    require_once('../database/Database.php');

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        @session_start();

        $dniUser = $_SESSION['dni_user'];

        $idRestaurante = $_POST['idRestaurant'];


        $onConnection = new Database();

        $query = "INSERT INTO estancias values(null, '$dniUser', '$idRestaurante' );";

        $onConnection->shotSimple($query);


        echo json_encode($onConnection);
        

    }


   

?>