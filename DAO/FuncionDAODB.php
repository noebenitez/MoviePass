<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Funcion as Funcion;    
    use DAO\Connection as Connection;
    use DAO\FilmsDAODB as FilmsDAO;

    class FuncionDAODB{

        private $connection;
        private $tableName = "funciones";

        public function Add(Funcion $funcion){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (fecha, horario_funcion, id_sala, id_pelicula, duracion) VALUES (:fecha, :horario_funcion, :id_sala, :id_pelicula, :duracion);";
                
                $parameters["fecha"] = $funcion->getFecha();
                $parameters["horario_funcion"] = $funcion->getHora();
                $parameters["id_sala"] = $funcion->getIdSala();
                $parameters["id_pelicula"] = $funcion->getIdFilm();
                $parameters["duracion"] = $funcion->getDuracion();

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
                $funcionList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $funcion = new Funcion();
                    $funcion->setId($row["id_funcion"]);
                    $funcion->setFecha($row["fecha"]);
                    $funcion->setHora($row["horario_funcion"]);
                    $funcion->setIdSala($row["id_sala"]);
                    $funcion->setIdFilm($row["id_pelicula"]);
                    $funcion->setDuracion($row["duracion"]);

                    array_push($funcionList, $funcion);
                }

                return $funcionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_funcion = :id";
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

            $query = "DELETE FROM " . $this->tableName . " WHERE id_funcion = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function Edit(Funcion $funcionActualizado){
            
            $query = "UPDATE " . $this->tableName . " SET fecha = :fecha, horario_funcion = :horario_funcion, id_sala = :id_sala, id_pelicula = :id_pelicula, duracion = :duracion WHERE id_funcion = :id";
            $parameters["id"] = $funcionActualizado->getId();
            $parameters["fecha"] = $funcionActualizado->getFecha();
            $parameters["horario_funcion"] = $funcionActualizado->getHora();
            $parameters["id_sala"] = $funcionActualizado->getIdSala();
            $parameters["id_pelicula"] = $funcionActualizado->getIdFilm();
            $parameters["duracion"] = $funcionActualizado->getDuracion();

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
                return new Funcion($p["id_funcion"], $p["fecha"], $p["horario_funcion"], $p["id_sala"], $p["id_pelicula"], $p["duracion"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }

        public function peliculaEnCartelera($id){

            $funciones = $this->GetAll();
            foreach ($funciones as $funcion){
                if ($funcion->getIdFilm() == $id){
                    return true;
                }
            }
            return false;
        }

        public function getByDate($date){

            $arrayFecha = array();
            $funciones = $this->GetAll();
            foreach ($funciones as $funcion){
    
                if ($funcion->getFecha() == $date){
    
                    $daosFilms = new FilmsDAO();
                    $film = $daosFilms->GetOne($funcion->getIdFilm());
                    array_push($arrayFecha, $film);
                }
            }
            return $arrayFecha;
        }

    }

?>