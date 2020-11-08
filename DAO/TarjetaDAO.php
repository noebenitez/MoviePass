<?php
    namespace DAO;

    use Models\TarjetaDeCredito as Tarjeta;

    class TarjetaDAO{

        private $cardList = array();


        public function Add($card){

            $this->RetrieveData();
            $card->setId($this->lastId() + 1 );
            array_push($this->cardList, $card);
            $this->SaveData();

        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->cardList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->cardList as $card) {

                if($card->getId() == $id) {

                    return $card;
                }
            }
            return false;
        }


        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->cardList as $card)
            {

                $valuesArray["id"] = $card->getId();
                $valuesArray["nroTarjeta"] = $card->getNroTarjeta();
                $valuesArray["empresa"] = $card->getEmpresa();
                $valuesArray["codSeguridad"] = $card->getCodSeguridad();
                $valuesArray["vencimiento"] = $card->getVencimiento();
                $valuesArray["titular"] = $card->getTitular();
                $valuesArray["idUsuario"] = $card->getIdUsuario();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/tarjetas.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->cardList = array();

            if(file_exists('Data/tarjetas.json'))
            {
                $jsonContent = file_get_contents('Data/tarjetas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $card = new Tarjeta();

                    $card->setId($valuesArray["id"]);
                    $card->setNroTarjeta($valuesArray["nroTarjeta"]);
                    $card->setEmpresa($valuesArray["empresa"]);
                    $card->setCodSeguridad($valuesArray["codSeguridad"]);
                    $card->setVencimiento($valuesArray["vencimiento"]);
                    $card->setTitular($valuesArray["titular"]);
                    $card->setIdUsuario($valuesArray["idUsuario"]);
                    
                    array_push($this->cardList, $card);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->cardList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }

    }
?>