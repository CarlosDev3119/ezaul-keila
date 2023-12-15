<?php 
    require_once('../database/Database.php');

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        @session_start();

        $dniUser = $_SESSION['dni_user'];

        $idRestaurante = $_POST['idRestaurant'];


        $onConnection = new Database();

        $query = "INSERT INTO estancias values(null, '$dniUser', '$idRestaurante' );";

        $onConnection->shotSimple($query);


        if($onConnection->last_id == 0){
            echo json_encode(false);
            
        }else{
            echo json_encode(true);

        }
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        @session_start();

        $role = $_SESSION['role'];
        $dniUser = $_SESSION['dni_user'];

        $onConnection = new Database();

        if( $role == 'admin' ){
            $query = "SELECT es.id_estancia, CONCAT(u.name_user, ' ', u.last_name) AS name_user, rt.name_restaurant, CONCAT(rt.street_restaurant, ' ', rt.city_restaurant) AS address_restaurant, rt.phone_number_restaurant FROM estancias AS es INNER JOIN users AS u ON u.dni_user = es.dni_user 
            INNER JOIN restaurants AS rt ON rt.id_restaurant = es.id_restaurant;";
        }
        else if ( $role == "cliente" ){
        $query = "SELECT es.id_estancia, CONCAT(u.name_user, ' ', u.last_name) AS name_user, rt.name_restaurant, CONCAT(rt.street_restaurant, ' ', rt.city_restaurant) AS address_restaurant, rt.phone_number_restaurant FROM estancias AS es INNER JOIN users AS u ON u.dni_user = es.dni_user 
        INNER JOIN restaurants AS rt ON rt.id_restaurant = es.id_restaurant";
        }

        $data = $onConnection->getRows($query);


        $rows = [];
        foreach($data as $values){
            $jsonArrayObject = array( //datos para mandar a la tabla /mostrado
                'id_estancia' => $values['id_estancia'],
                'name_user' => $values['name_user'],
                'name_restaurant' => $values['name_restaurant'],
                'address_restaurant' => $values['address_restaurant'],
                'phone_number_restaurant' => $values['phone_number_restaurant'],
                'dni_user' => $values['dni_user']
            );
            $rows[] = $jsonArrayObject ;
        }

        echo json_encode($rows);
        

    }
?>