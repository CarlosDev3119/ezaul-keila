<?php 
    require_once('../database/Database.php');

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // session_start();

        if(isset($_POST["email"])){
            $email = $_POST["email"];
        }
        if(isset($_POST["password"])){
            $password  = $_POST["password"];
        }

        $onConnection = new Database();

        $query = "SELECT * FROM users where email = '$email' AND password = '$password' ";

        $data = $onConnection->getRows($query);
        
        if($onConnection->numberRows == 0){
            echo 0;
        }else{
            session_start();
            $_SESSION["user_email"]  = $data[0]["email"];
            $_SESSION["role"]        = $data[0]["role"];
            $_SESSION["status_user"] = $data[0]["status_user"];
            echo 1;

        }



    }

   

?>