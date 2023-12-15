<?php 
    require_once('../database/Database.php');


    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(isset($_GET['id_restaurant'])){
            $id_restaurant = $_GET['id_restaurant'];
        }

        $type = $_GET['type'];

        switch($type){

            case 'datarestaurant':

                $onConnection = new Database();
        
                $query = "SELECT restaurants.*, CONCAT(users.name_user, ' ', users.last_name)as name_user FROM restaurants INNER JOIN users ON users.dni_user = restaurants.dni_user WHERE id_restaurant = '$id_restaurant'";
        
                $data = $onConnection->getRows($query);
                $rows = [];
                foreach($data as $values){
        
        
                    $jsonArrayObject = array(
                        'id_restaurant' => $values['id_restaurant'],
                        'name_restaurant' => $values['name_restaurant'],
                        'address' => $values['street_restaurant'],
                        'city_restaurant' => $values['city_restaurant'],
                        'phone_number' => $values['phone_number_restaurant'],
                        'name_user' => $values['name_user'],
                        'dni_user' => $values['dni_user'],
                    );
                    $rows[] = $jsonArrayObject ;
                }
        
                echo json_encode($rows);
        

            break;

            case 'dataowners':
                $onConnection = new Database();
        
                $query = "SELECT dni_user, CONCAT(name_user, ' ', last_name)as name_user FROM users WHERE role= 'dueno' ";
        
                $data = $onConnection->getRows($query);
                $rows = [];
                foreach($data as $values){
        
        
                    $jsonArrayObject = array(
                        'dni_user' => $values['dni_user'],
                        'name_user' => $values['name_user'],
         
                    );
                    $rows[] = $jsonArrayObject ;
                }
        
                echo json_encode($rows);

            break;

            

        }

    }

    if($_SERVER["REQUEST_METHOD"] == "PUT"){

        $data = file_get_contents("php://input");
        $json_data = json_decode($data);

        $onConnection = new Database();
        
        $query = "UPDATE restaurants SET phone_number_restaurant= '$json_data->phone_number_restaurant', dni_user= '$json_data->dni_user' 
                    WHERE id_restaurant='$json_data->id_restaurant' ";

        $resp = $onConnection->shotSimple($query);

        echo json_encode($resp);

    }

?>