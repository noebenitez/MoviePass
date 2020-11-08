<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Ticket as Ticket;    
    use DAO\Connection as Connection;

    class TicketDAODB{

        private $connection;
        private $tableName = "tickets";

        public function Add(Ticket $ticket){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (valor_unitario, asiento, id_usuario, id_funcion, id_compra) VALUES (:valorUnitario, :asiento, :idUsuario, :idFuncion, :idCompra);";
                
                $parameters["valorUnitario"] = $ticket->getValorUnitario();
                $parameters["asiento"] = $ticket->getAsiento();
                //$parameters["qr"] = $ticket->getQR();
                $parameters["idUsuario"] = $ticket->getIdUsuario();
                $parameters["idFuncion"] = $ticket->getIdFuncion();
                $parameters["idCompra"] = $ticket->getIdCompra();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $this->agregarQR($ticket);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function agregarQR($ticket){

            $idTicket = $this->lastId();

            $qr = 'Ticket Nro.: '.$idTicket.' - Funcion ID: '.$ticket->getIdFuncion().' - Asiento: '.$ticket->getAsiento();

            $query = "UPDATE " . $this->tableName . " SET qr = :qr WHERE id = " . $idTicket;
            $parameters["qr"] = $qr;
            
            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex){ 
                throw $ex;
            }

        }

        public function GetAll(){
            
            try
            {
                $ticketList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $ticket = new Ticket();
                    $ticket->setId($row["id"]);
                    $ticket->setValorUnitario($row["valor_unitario"]);
                    $ticket->setAsiento($row["asiento"]);
                    $ticket->setQR($row["qr"]);
                    $ticket->setIdUsuario($row["id_usuario"]);
                    $ticket->setIdFuncion($row["id_funcion"]);
                    $ticket->setIdCompra($row["id_compra"]);

                    array_push($ticketList, $ticket);
                }

                return $ticketList;
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
                return new Ticket($p["id"], $p["valor_unitario"], $p["asiento"], $p["qr"], $p["id_usuario"], $p["id_funcion"], $p["id_compra"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }


        public function nroAsiento($idFuncion){ //Busca el último número de asiento de una función y retorna el siguiente

            $query = "SELECT MAX(asiento) as ultimoAsiento FROM " . $this->tableName . " WHERE id_funcion = " . $idFuncion;
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

            } catch (Exception $ex){ 
                throw $ex;
            }

            if (!empty($resultSet)){
                
                $row = $resultSet[0];
                return $row["ultimoAsiento"] + 1;

            }else{
                return false;
            }
        }

        public function lastId(){

            try{
                $query = "SELECT MAX(id) AS id FROM " . $this->tableName;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
    
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
    
               return $resultSet[0]['id'];
            }
        

    }

?>