<?php
    namespace DAO;

    use Models\Ticket as Ticket;

    class TicketDAO{

        private $ticketList = array();


        public function Add($ticket){

            $this->RetrieveData();
            $ticket->setId($this->lastId() + 1 );
            $ticket->setQR('Ticket Nro.: '.$ticket->getId().' - Funcion ID: '.$ticket->getIdFuncion().' - Asiento: '.$ticket->getAsiento());
            array_push($this->ticketList, $ticket);
            $this->SaveData();

        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->ticketList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->ticketList as $ticket) {

                if($ticket->getId() == $id) {

                    return $ticket;
                }
            }
            return false;
        }


        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->ticketList as $ticket)
            {

                $valuesArray["id"] = $ticket->getId();
                $valuesArray["valor"] = $ticket->getValorUnitario();
                $valuesArray["asiento"] = $ticket->getAsiento();
                $valuesArray["qr"] = $ticket->getQR();
                $valuesArray["idUsuario"] = $ticket->getIdUsuario();
                $valuesArray["idFuncion"] = $ticket->getIdFuncion();
                $valuesArray["idCompra"] = $ticket->getIdCompra();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/tickets.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->ticketList = array();

            if(file_exists('Data/tickets.json'))
            {
                $jsonContent = file_get_contents('Data/tickets.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $ticket = new Ticket();

                    $ticket->setId($valuesArray["id"]);
                    $ticket->setValorUnitario($valuesArray["valor"]);
                    $ticket->setAsiento($valuesArray["asiento"]);
                    $ticket->setQR($valuesArray["qr"]);
                    $ticket->setIdUsuario($valuesArray["idUsuario"]);
                    $ticket->setIdFuncion($valuesArray["idFuncion"]);
                    $ticket->setIdCompra($valuesArray["idCompra"]);

                    array_push($this->ticketList, $ticket);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->ticketList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }

    }
?>