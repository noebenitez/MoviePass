<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\TarjetaDeCredito as Tarjeta;    
    use DAO\Connection as Connection;

    class TarjetaDAODB{

        private $connection;
        private $tableName = "tarjetasCredito";

        public function Add(Tarjeta $tarjeta){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (nro_tarjeta, empresa, cod_seguridad, vencimiento, titular, id_usuario) VALUES (:nroTarjeta, :empresa, :codSeguridad, :vencimiento, :titular, :idUsuario);";
                
                $parameters["nroTarjeta"] = $tarjeta->getNroTarjeta();
                $parameters["empresa"] = $tarjeta->getEmpresa();
                $parameters["codSeguridad"] = $tarjeta->getCodSeguridad();
                $parameters["vencimiento"] = $tarjeta->getVencimiento();
                $parameters["titular"] = $tarjeta->getTitular();
                $parameters["idUsuario"] = $tarjeta->getIdUsuario();

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
                $tarjetaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $tarjeta = new Tarjeta();
                    $tarjeta->setId($row["id"]);
                    $tarjeta->setNroTarjeta($row["nro_tarjeta"]);
                    $tarjeta->setEmpresa($row["empresa"]);
                    $tarjeta->setCodSeguridad($row["cod_seguridad"]);
                    $tarjeta->setVencimiento($row["vencimiento"]);
                    $tarjeta->setTitular($row["titular"]);
                    $tarjeta->setIdUsuario($row["id_usuario"]);

                    array_push($tarjetaList, $tarjeta);
                }

                return $tarjetaList;
            }
            catch(Exception $ex)
            {
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



        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Tarjeta($p["id"], $p["nro_tarjeta"], $p["empresa"], $p["cod_seguridad"], $p["vencimiento"], $p["titular"], $p["id_usuario"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }

        public function getIdByNroTarjeta($nroTarjeta){

            $query = "SELECT id FROM " . $this->tableName . " WHERE nro_tarjeta = " . $nroTarjeta;
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            } catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                
                $row = $resultSet[0];
                return $row["id"];

            }else{
                return false;
            }
        }

    }

?>