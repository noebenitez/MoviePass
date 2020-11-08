<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\PoliticaDeDescuento as Descuento;    
    use DAO\Connection as Connection;

    class DescuentoDAODB{

        private $connection;
        private $tableName = "descuentos";


        public function Add(Descuento $descuento){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (dia, cantidad_entradas, porcentaje, descripcion) VALUES (:dia, :cantidad_entradas, :porcentaje, :descripcion);";
                
                $parameters["dia"] = $descuento->getDia();
                $parameters["cantidad_entradas"] = $descuento->getCantidadMinima();
                $parameters["porcentaje"] = $descuento->getPorcentaje();
                $parameters["descripcion"] = $descuento->getDescripcion();
               

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Edit(Descuento $descuentoActualizado){
            
            $query = "UPDATE " . $this->tableName . " SET id = :id, dia = :dia, porcentaje = :porcentaje, cantidad_entradas = :cantidad_entradas, descripcion = :descripcion WHERE id = :id";
            $parameters["id"] = $descuentoActualizado->getId();
            $parameters["dia"] = $descuentoActualizado->getDia();
            $parameters["porcentaje"] = $descuentoActualizado->getPorcentaje();
            $parameters["cantidad_entradas"] = $descuentoActualizado->getCantidadMinima();
            $parameters["descripcion"] = $descuentoActualizado->getDescripcion();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function Remove($id){ 

            $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $parameters["id"] = $id;

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

        public function GetOne($id){

            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
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

        public function GetAll(){
            
            try
            {
                $descuentosList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $descuento = new Descuento();
                    $descuento->setId($row["id"]);
                    $descuento->setPorcentaje($row["porcentaje"]);
                    $descuento->setDia($row["dia"]);
                    $descuento->setCantidadMinima($row["cantidad_entradas"]);
                    $descuento->setDescripcion($row["descripcion"]);

                    array_push($descuentosList, $descuento);
                }

                return $descuentosList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Descuento($p["id"], $p["porcentaje"], $p["dia"], $p["cantidad_entradas"], $p["descripcion"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }
    }