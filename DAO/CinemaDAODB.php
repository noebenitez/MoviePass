<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Cinema as Cinema;    
    use DAO\Connection as Connection;

    class CinemaDAODB{

        private $connection;
        private $tableName = "cines";

        public function Add(Cinema $cinema){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (nombre_cine, domicilio_cine, altura_cine, hora_apertura, hora_cierre, valor_entrada, capacidad) VALUES (:nombre, :calle, :altura, :horaApertura, :horaCierre, :valorEntrada, :capacidad);";
                
                $parameters["nombre"] = $cinema->getNombre();
                $parameters["calle"] = $cinema->getCalle();
                $parameters["altura"] = $cinema->getAltura();
                $parameters["horaApertura"] = $cinema->getHoraApertura();
                $parameters["horaCierre"] = $cinema->getHoraCierre();
                $parameters["valorEntrada"] = $cinema->getValorEntrada();
                $parameters["capacidad"] = $cinema->getCapacidad();

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
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new Cinema();
                    $cinema->setId($row["id_cine"]);
                    $cinema->setNombre($row["nombre_cine"]);
                    $cinema->setCalle($row["domicilio_cine"]);
                    $cinema->setAltura($row["altura_cine"]);
                    $cinema->setHoraApertura($row["hora_apertura"]);
                    $cinema->setHoraCierre($row["hora_cierre"]);
                    $cinema->setValorEntrada($row["valor_entrada"]);

                   /*  $this->updateCapacidadCine($cinema->getId()); */
                    $cinema->setCapacidad($row["capacidad"]);

                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_cine = :id";
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

        public function Remove($id){  //Borra en cascada las salas, y funciones

            $query = "DELETE FROM " . $this->tableName . " WHERE id_cine = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function Edit(Cinema $cinemaActualizado){
            
            $query = "UPDATE " . $this->tableName . " SET nombre_cine = :nombre, domicilio_cine = :calle, altura_cine = :altura, hora_apertura = :horaApertura, hora_cierre = :horaCierre, valor_entrada = :valorEntrada, capacidad = :capacidad WHERE id_cine = :id";
            $parameters["nombre"] = $cinemaActualizado->getNombre();
            $parameters["calle"] = $cinemaActualizado->getCalle();
            $parameters["altura"] = $cinemaActualizado->getAltura();
            $parameters["horaApertura"] = $cinemaActualizado->getHoraApertura();
            $parameters["horaCierre"] = $cinemaActualizado->getHoraCierre();
            $parameters["valorEntrada"] = $cinemaActualizado->getValorEntrada();
            $parameters["capacidad"] = $cinemaActualizado->getCapacidad();
            $parameters["id"] = $cinemaActualizado->getId();

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }


        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Cinema($p["id_cine"], $p["nombre_cine"], $p["domicilio_cine"], $p["altura_cine"], $p["hora_apertura"], $p["hora_cierre"], $p["valor_entrada"], $p["capacidad"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }

        public function nombrePorId($id){

            $query = "SELECT nombre_cine FROM " . $this->tableName . " WHERE id_cine = " . $id;
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            } catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                
                $row = $resultSet[0];
                return $row["nombre_cine"];

            }else{
                return false;
            }
        }

        /* public function updateCapacidades(){
            
            $cinemas = $this->GetAll();
            foreach($cinemas as $cinema){
                $this->updateCapacidadCine($cinema->getId());
            }
        }

        private function updateCapacidadCine($id){

            $query = "UPDATE " . $this->tableName . " SET capacidad = :capacidad WHEN id_cine = " . $id;
            $parameters["capacidad"] = $this->capacidadCine($id);
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        
        private function capacidadCine($id){
            
            $capacidad = 0;
            $roomController = new \Controllers\RoomController();
            $roomList = $roomController->GetAll();

            foreach ($roomList as $room){
                if ($room->getIdCine() == $id){
                    $capacidad += $room->getCapacidad();
                }
            }
            return $capacidad;
        } */

    }

?>