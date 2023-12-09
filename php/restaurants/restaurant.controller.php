<?php 
    require_once('../database/Database.php');

    
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        @session_start();

        $role = $_SESSION['role'];

        $onConnection = new Database();

        $query = "SELECT rest.*, CONCAT(own.name_owner, ' ', own.last_name) as name_owner FROM restaurants as rest INNER JOIN owners as own ON own.dni_owner = rest.dni_owner";

        $data = $onConnection->getRows($query);

        if($role == 'cliente'){
            $actions = '<div class="btn-group" role="group">';
            $actions .= '<button type="button" class="btn btn-primary">Actualizar</button>';
            $actions .= '</div>';
        }else{
            $actions = '<div class="btn-group" role="group">';
            $actions .= '<button type="button" class="btn btn-primary">Actualizar</button>';
            $actions .= '</div>';
            $actions .= '<button type="button" class="btn btn-danger">Eliminar</button>';
        }

        $rows = [];
        foreach($data as $values){
            $jsonArrayObject = array(
                'id_restaurant' => $values['id_restaurant'],
                'name_restaurant' => $values['name_restaurant'],
                'address' => $values['street_restaurant'],
                'city_restaurant' => $values['city_restaurant'],
                'phone_number' => $values['phone_number_restaurant'],
                'owner' => $values['name_owner'],
                'actions' => $actions,
                
            );
            $rows[] = $jsonArrayObject ;
        }

        echo json_encode($rows);
        

    }

    //TODO: ACTUALIZACION
    if($_SERVER["REQUEST_METHOD"] == "PUT"){

    }

    //TODO: ELIMINACION
    if($_SERVER["REQUEST_METHOD"] == "DELETE"){

    }

      //TODO: CREACION
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    }
   

?>