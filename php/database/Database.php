<?php 
    include ("../config/dbConfig.php");

    class Database {

        var $numberRows;
        var $last_id;

        function __construct(){
            $this->numberRows = 0;
        }

        function getConnections() {
            $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, 3306);
            if( !$connection ){
                printf("Error de conexion: %s\n", mysqli_connect_error());
                exit();
            }
            $connection->set_charset('utf8');
            return $connection;
        }

        function closeConnection($param) {
            mysqli_close($param);
        }

        function getRows($params){
            $allContent = array();
            $this->numberRows;
            $onConnection = $this->getConnections();
            if($result = mysqli_query($onConnection, $params)){
                $this->numberRows = $result->num_rows;
                while($rows = $result->fetch_array()){
                    $allContent[]=$rows;
                }
            }

            $this->closeConnection($onConnection);
            return $allContent;
        }

        function getSimple($params){
            $oconn   = $this->GetConnections();
            $rows    = mysqli_query($oconn,$params);
            $records = $rows->fetch_array();
            $response = $records[0];
            $this->closeConnection($oconn);

            return $response;
        }

        function shotSimple($param){
            $onConnection = $this->getConnections();
            $result = mysqli_query($onConnection, $param);

            if ($result) {
                // La consulta fue exitosa
                $this->last_id = $onConnection->insert_id;
            } else {
                // La consulta falló
                // Puedes manejar el error según tus necesidades
                echo "Error en la consulta: " . mysqli_error($onConnection);
            }
    
            $this->closeConnection($onConnection);
    
            // Devuelve un indicador de éxito
            return $result;
        }

    }

?> 