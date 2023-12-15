<?php 
    require_once('../database/Database.php');

    
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        @session_start();

        $role = $_SESSION['role'];
        $dni = $_SESSION['dni_user'];

        $onConnection = new Database();
        if($role == 'admin'){
            $query = "SELECT rt.id_restaurant, rt.name_restaurant, rt.street_restaurant, rt.city_restaurant, rt.phone_number_restaurant, CONCAT(u.name_user, ' ', u.last_name ) AS name_user 
                      FROM restaurants AS rt INNER JOIN users AS u ON u.dni_user = rt.dni_user WHERE rt.status = '1' ";
        }else if($role == 'dueño'){
            $query = "SELECT rt.id_restaurant, rt.name_restaurant, rt.street_restaurant, rt.city_restaurant, rt.phone_number_restaurant, CONCAT(u.name_user, ' ', u.last_name ) AS name_user 
                      FROM restaurants AS rt INNER JOIN users AS u ON u.dni_user = rt.dni_user WHERE u.role = 'dueño' and rt.status = '1' and rt.dni_user = '$dni' ";   
        }else{
            $query = "SELECT rt.id_restaurant, rt.name_restaurant, rt.street_restaurant, rt.city_restaurant, rt.phone_number_restaurant, CONCAT(u.name_user, ' ', u.last_name ) AS name_user 
                      FROM restaurants AS rt INNER JOIN users AS u ON u.dni_user = rt.dni_user WHERE rt.status = '1';";
        }



        $data = $onConnection->getRows($query);
        
        foreach($data as $values){
            if($role == 'cliente'){
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<button type="button" onclick="reservar('.$values['id_restaurant'].')"  id="btn_reservar" class="btn btn-success">Reservar</button>';
                $actions .= '</div>';

            }else if($role == 'dueño'){
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="./pages/update_restaurant.php?id_restaurant='.$values['id_restaurant'].'" class="btn btn-primary">Actualizar</a>';
                $actions .= '</div>';
            }else{
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="./pages/update_restaurant.php?id_restaurant='.$values['id_restaurant'].'" class="btn btn-primary">Actualizar</a>';
                $actions .= '<button type="button" onclick="eliminar('.$values['id_restaurant'].')" class="btn btn-danger">Eliminar</button>';
                $actions .= '</div>';
            }

            $jsonArrayObject = array(
                'id_restaurant' => $values['id_restaurant'],
                'name_restaurant' => $values['name_restaurant'],
                'address' => $values['street_restaurant'],
                'city_restaurant' => $values['city_restaurant'],
                'phone_number' => $values['phone_number_restaurant'],
                'name_user' => $values['name_user'],
                'actions' => $actions,
                
            );
            $rows[] = $jsonArrayObject ;
        }

        echo json_encode($rows);
        

    }
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        $onConnection = new Database(); 

     

    }
    
      //TODO: CREACION
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name   = $_POST['name'];
        $street = $_POST['street'];
        $city   = $_POST['city'];
        $phone  = $_POST['phone'];
        $dni    = $_POST['dni_user'];
        

        $onConnection = new Database(); 
        $query = "INSERT INTO restaurants VALUES(null, '$name', '$street', '$city', '$phone', '$dni', 1)";
        $onConnection->shotSimple($query); 
        if($onConnection->last_id == 0){
            echo json_encode(false);
            
        }else{
            echo json_encode(true);

        }
      

    }
   

    if($_SERVER["REQUEST_METHOD"] == "DELETE"){
        
        $data = file_get_contents("php://input");
        $id_restaurant = json_decode($data);
        $id_restaurant = $id_restaurant->id_restaurant;

        $onConnection = new Database(); 
        $query = "UPDATE restaurants SET status='0' where id_restaurant='$id_restaurant' ";
        $resp = $onConnection->shotSimple($query); 

        echo json_encode($resp);

    }
   

?>