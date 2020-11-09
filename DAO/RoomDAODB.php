<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Room as Room;    
    use DAO\Connection as Connection;

    class RoomDAODB{

        private $connection;
        private $tableName = "salas";

        public function Add(Room $room){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (nombre, capacidad, id_cine) VALUES (:nombre, :capacidad, :id_cine);";
                
                $parameters["nombre"] = $room->getNombre();
                $parameters["capacidad"] = $room->getCapacidad();
                $parameters["id_cine"] = $room->getIdCine();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll(){

            try
            {
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $room = new Room();
                    $room->setId($row["id_sala"]);
                    $room->setNombre($row["nombre"]);
                    $room->setCapacidad($row["capacidad"]);
                    $room->setIdCine($row["id_cine"]);

                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_sala = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }
        }

        public function Remove($id){  //Borra en cascada las funciones

            $query = "DELETE FROM " . $this->tableName . " WHERE id_sala = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function Edit(Room $roomActualizado){
            
            $query = "UPDATE " . $this->tableName . " SET nombre = :nombre, capacidad = :capacidad, id_cine = :id_cine WHERE id_sala = :id";
            $parameters["nombre"] = $roomActualizado->getNombre();
            $parameters["capacidad"] = $roomActualizado->getCapacidad();
            $parameters["id_cine"] = $roomActualizado->getIdCine();
            $parameters["id"] = $roomActualizado->getId();
            
            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }


        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Room($p["id_sala"], $p["nombre"], $p["capacidad"], $p["id_cine"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }

        public function nombrePorId($id){

            $query = "SELECT nombre FROM " . $this->tableName . " WHERE id_sala = " . $id;
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){

                return $resultSet["nombre"];

            }else{
                return false;
            }
        }

        public function capacidadCine($idCine){
            
            $query = "SELECT SUM(capacidad) as capacidadCine FROM " . $this->tableName . " WHERE id_cine = " . $idCine;
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            } catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                
                $row = $resultSet[0];
                return $row["capacidadCine"];

            }else{
                return false;
            }
        }

    } 
?>