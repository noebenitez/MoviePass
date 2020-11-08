<?php
    namespace DAO;

    use Models\Compra as Compra;

    class CompraDAO{

        private $compraList = array();


        public function Add($compra){

            $this->RetrieveData();
            $compra->setId($this->lastId() + 1 );
            array_push($this->compraList, $compra);
            $this->SaveData();

        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->compraList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->compraList as $compra) {

                if($compra->getId() == $id) {

                    return $compra;
                }
            }
            return false;
        }


        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->compraList as $compra)
            {

                $valuesArray["id"] = $compra->getId();
                $valuesArray["nroTarjeta"] = $compra->getNroTarjeta();
                $valuesArray["cantidad"] = $compra->getCantidadEntradas();
                $valuesArray["total"] = $compra->getValorTotal();
                $valuesArray["idUsuario"] = $compra->getIdUsuario();
                $valuesArray["idFuncion"] = $compra->getIdFuncion();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/compras.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->compraList = array();

            if(file_exists('Data/compras.json'))
            {
                $jsonContent = file_get_contents('Data/compras.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $compra = new Compra();

                    $compra->setId($valuesArray["id"]);
                    $compra->setNroTarjeta($valuesArray["nroTarjeta"]);
                    $compra->setCantidadEntradas($valuesArray["cantidad"]);
                    $compra->setValorTotal($valuesArray["total"]);
                    $compra->setIdUsuario($valuesArray["idUsuario"]);
                    $compra->setIdFuncion($valuesArray["idFuncion"]);

                    array_push($this->compraList, $compra);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->compraList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }

    }
?>