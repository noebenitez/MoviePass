<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;

    class CinemaDAO implements ICinemaDAO{

        private $cinemaList = array();


        public function Add(Cinema $cinema){

            $this->RetrieveData();

            if(!$this->existeId($cinema->getId())){
                
                array_push($this->cinemaList, $cinema);
                $this->SaveData();
                return true;

            }else{

                return false;
            }
    
        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->cinemaList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->cinemaList as $cinema) {

                if($cinema->getId() == $id) {

                    return $cinema;
                }
            }
            return false;
        }

        public function Remove($idRemove){

            $this->RetrieveData();
            $newList = array();

            foreach ($this->cinemaList as $cinema){

                if ($cinema->getId() != $idRemove){
                    
                    array_push($newList, $cinema);
                } 
            }
            $this->cinemaList = $newList;
            $this->SaveData();       
        }

        public function Edit(Cinema $cinemaActualizado){
            
            $this->RetrieveData();
            foreach ($this->cinemaList as $key=>$cinema){

                if ($cinema->getId() == $cinemaActualizado->getId()){
                    
                    $this->cinemaList[$key] = $cinemaActualizado;
                } 
            }
            $this->SaveData();
        }
    

        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {

                $valuesArray["id"] = $cinema->getId();
                $valuesArray["nombre"] = $cinema->getNombre();
                $valuesArray["direccion"] = $cinema->getDireccion();
                $valuesArray["horaApertura"] = $cinema->getHoraApertura();
                $valuesArray["horaCierre"] = $cinema->getHoraCierre();
                $valuesArray["valorEntrada"] = $cinema->getvalorEntrada();

                $arraySalas = array();

               foreach($cinema->getSalas() as $sala){

                    $valueSalas['nombre'] = $sala->getNombre();
                    $valueSalas['capacidad'] = $sala->getCapacidad();

                    array_push($arraySalas, $valueSalas);
               }

               $valuesArray['salas'] = $arraySalas;

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cinemas.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->cinemaList = array();

            if(file_exists('Data/cinemas.json'))
            {
                $jsonContent = file_get_contents('Data/cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema();
                    $cinema->setId($valuesArray["id"]);
                    $cinema->setNombre($valuesArray["nombre"]);
                    $cinema->setDireccion($valuesArray["direccion"]);
                    $cinema->setHoraApertura($valuesArray["horaApertura"]);
                    $cinema->setHoraCierre($valuesArray["horaCierre"]);
                    $cinema->setValorEntrada($valuesArray["valorEntrada"]);
<<<<<<< Updated upstream
=======
                    $cinema->setCapacidad($valuesArray["capacidad"]);
                    
                   
                   
                    $salas = $valuesArray["salas"];
                    
                  
                    foreach($salas as $sala)
                    {
                        $nuevaSala = new Room();
                        $nuevaSala->setNombre($sala['nombre']);
                        $nuevaSala->setCapacidad($sala['capacidad']);
                        $cinema->addSalas($nuevaSala);
                    }
                    
>>>>>>> Stashed changes

                    array_push($this->cinemaList, $cinema);
                }
            }
        }

        private function existeId($id){
            
            foreach($this->cinemaList as $cinema){
                if ($cinema->getId() == $id){
                    return true;
                }
            }
            return false;
        }
    }
?>