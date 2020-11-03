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
                $query = "INSERT INTO ".$this->tableName." (fecha, horario_funcion, id_sala, id_pelicula, duracion, entradas_vendidas) VALUES (:fecha, :horario_funcion, :id_sala, :id_pelicula, :duracion, :entradasVendidas);";
                
                $parameters["fecha"] = $funcion->getFecha();
                $parameters["horario_funcion"] = $funcion->getHora();
                $parameters["id_sala"] = $funcion->getIdSala();
                $parameters["id_pelicula"] = $funcion->getIdFilm();
                $parameters["duracion"] = $funcion->getDuracion();
                $parameters["entradasVendidas"] = $funcion->getEntradasVendidas();

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
                    $funcion->setEntradasVendidas($row["entradas_vendidas"]);
                    
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
            
            $query = "UPDATE " . $this->tableName . " SET fecha = :fecha, horario_funcion = :horario_funcion, id_sala = :id_sala, id_pelicula = :id_pelicula, duracion = :duracion, entradas_vendidas = :entradas_vendidas WHERE id_funcion = :id";
            $parameters["id"] = $funcionActualizado->getId();
            $parameters["fecha"] = $funcionActualizado->getFecha();
            $parameters["horario_funcion"] = $funcionActualizado->getHora();
            $parameters["id_sala"] = $funcionActualizado->getIdSala();
            $parameters["id_pelicula"] = $funcionActualizado->getIdFilm();
            $parameters["duracion"] = $funcionActualizado->getDuracion();
            $parameters["entradas_vendidas"] = $funcionActualizado->getEntradasVendidas();

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
                return new Funcion($p["id_funcion"], $p["fecha"], $p["horario_funcion"], $p["id_sala"], $p["id_pelicula"], $p["duracion"], $p["entradas_vendidas"]);
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


        public function getFuncionesPorPelicula($idFilm){


            $query = "SELECT * FROM " . $this->tableName . " WHERE id_pelicula = :id";
            $parameters["id"] = $idFilm;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                if (!empty($resultSet)){

                    $funciones = array();
                    
                    foreach ($resultSet as $row)
                    {                
                        $funcion = new Funcion();
                        $funcion->setId($row["id_funcion"]);
                        $funcion->setFecha($row["fecha"]);
                        $funcion->setHora($row["horario_funcion"]);
                        $funcion->setIdSala($row["id_sala"]);
                        $funcion->setIdFilm($row["id_pelicula"]);
                        $funcion->setDuracion($row["duracion"]);
                        $funcion->setEntradasVendidas($row["entradas_vendidas"]);

                        array_push($funciones, $funcion);
                    }
            
                    return $funciones;
                }

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function actualizarEntradasVendidas($idFuncion, $cant){

            $query = "UPDATE " . $this->tableName . " SET entradas_vendidas = entradas_vendidas + " . $cant . " WHERE id_funcion = " . $idFuncion;
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->ExecuteNonQuery($query);

            } catch (Exception $ex){ 
                throw $ex;
            }

        }

        private function getFuncionesEnFechaYSala($date, $idSala){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_sala = :idSala AND fecha = :fecha;";

            $parameters["idSala"] = $idSala;
            $parameters["fecha"] = $date;

            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                if (!empty($resultSet)){

                    $funciones = array();
                    
                    foreach ($resultSet as $row)
                    {                
                        $funcion = new Funcion();
                        $funcion->setId($row["id_funcion"]);
                        $funcion->setFecha($row["fecha"]);
                        $funcion->setHora($row["horario_funcion"]);
                        $funcion->setIdSala($row["id_sala"]);
                        $funcion->setIdFilm($row["id_pelicula"]);
                        $funcion->setDuracion($row["duracion"]);
                        $funcion->setEntradasVendidas($row["entradas_vendidas"]);

                        array_push($funciones, $funcion);
                    }
            
                    return $funciones;
                }

            } catch (Exception $ex){ 
                throw $ex;
            }
        }


        public function verificarHora($entry){

            $funcionesMismoDiaSala = $this->getFuncionesEnFechaYSala($entry->getFecha(), $entry->getIdSala());

            if(!empty($funcionesMismoDiaSala)){  //Si es que hay funciones el mismo día en la misma sala

                $comienzoEntry = date ( 'Y-m-d H:i:s' , strtotime($entry->getFecha() . $entry->getHora())); //Comienzo funcion entrante
                $duracionMas15MinEntry = $entry->getDuracion() + 15;
                $entryMasDuracion = strtotime ( "+".$duracionMas15MinEntry." minute" , strtotime($entry->getFecha() . $entry->getHora()) );  //Se calcula el final funcion entrante
                $finalEntry = date ( 'Y-m-d H:i:s' , $entryMasDuracion);  //Formato a la fecha de final de la funcion entrante

                foreach($funcionesMismoDiaSala as $func){

                    if ($func->getId() != $entry->getId()){ //Para que al editar una funcion no la evalue con el horario viejo

                        $comienzoFunc = date ( 'Y-m-d H:i:s' , strtotime($func->getFecha() . $func->getHora())); //Comienzo de funcion existente
                        $duracionMas15MinFunc = $func->getDuracion() + 15;
                        $funcMasDuracion = strtotime ( "+".$duracionMas15MinFunc." minute" , strtotime($func->getFecha() . $func->getHora()) ); // Se calcular el final de la funcion existente
                        $finalFunc = date ( 'Y-m-d H:i:s' , $funcMasDuracion); //Formato a la fecha de final de la funcion existente
                        
                        
                        if ($comienzoEntry < $finalFunc && $comienzoFunc < $finalEntry){ // Si el comienzo de la función entrante es antes de la función existente y termina después del comienzo de la función existente entonces se interponen
        
                            return false;
                        }
                    }
    
                }
            }
            return true;
        }

    }

?>