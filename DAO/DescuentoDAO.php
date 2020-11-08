<?php
    namespace DAO;

    use Models\PoliticaDeDescuento as Descuento;

    class DescuentoDAO{

        private $descuentoList = array();


        public function Add($descuento){

            $this->RetrieveData();
            $descuento->setId($this->lastId() + 1 );
            array_push($this->descuentoList, $descuento);
            $this->SaveData();

        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->descuentoList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->descuentoList as $descuento) {

                if($descuento->getId() == $id) {

                    return $descuento;
                }
            }
            return false;
        }


        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->descuentoList as $descuento)
            {

                $valuesArray["id"] = $descuento->getId();
                $valuesArray["porcentaje"] = $descuento->getPorcentaje();
                $valuesArray["entradasMinimas"] = $descuento->getCantidadMinima();
                $valuesArray["dia"] = $descuento->getDia();
                $valuesArray["descripcion"] = $descuento->getDescripcion();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/descuentos.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->descuentoList = array();

            if(file_exists('Data/descuentos.json'))
            {
                $jsonContent = file_get_contents('Data/descuentos.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $descuento = new Descuento();

                    $descuento->setId($valuesArray["id"]);
                    $descuento->setPorcentaje($valuesArray["porcentaje"]);
                    $descuento->setCantidadMinima($valuesArray["entradasMinimas"]);
                    $descuento->setDia($valuesArray["dia"]);
                    $descuento->setDescripcion($valuesArray["descripcion"]);
                    
                    array_push($this->descuentoList, $descuento);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->descuentoList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }

    }
?>