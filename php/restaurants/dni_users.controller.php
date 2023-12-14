<?php 
    require_once('../database/Database.php');

    
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        @session_start();

        $role = $_SESSION['role'];
        $dniUser = $_SESSION['dni_user'];

        $onConnection = new Database();

        if( $role == 'admin' ){
            $query = "SELECT name_user, dni_user FROM users WHERE role = 'dueño' OR role = 'admin';";
        }else if ( $role == "dueño" ){
            $query = "SELECT name_user, dni_user FROM users WHERE dni_user = '$dniUser'";
        }

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
        

    }


   

?>