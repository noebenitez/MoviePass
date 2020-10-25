<?php
    namespace DAO;

    use Models\Funcion as Funcion;
    
    class FuncionDAO{

        private $funcionList = array();


        public function Add(Funcion $funcion){

            $this->RetrieveData();
            $funcion->setId($this->lastId() + 1 );
            array_push($this->funcionList, $funcion);
            $this->SaveData();

    
        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->funcionList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->funcionList as $funcion) {

                if($funcion->getId() == $id) {

                    return $funcion;
                }
            }
            return false;
        }

        public function Edit(Funcion $funcionActualizada){
            
            $this->RetrieveData();
            foreach ($this->funcionList as $key=>$funcion){

                if ($funcion->getId() == $funcionActualizada->getId()){
                    
                    $this->funcionList[$key] = $funcionActualizada;
                } 
            }
            $this->SaveData();
        } 
    

        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->funcionList as $funcion)
            {

                $valuesArray["id"] = $funcion->getId();
                $valuesArray["fecha"] = $funcion->getFecha();
                $valuesArray["hora"] = $funcion->getHora();
                $valuesArray["idSala"] = $funcion->getIdSala();
                $valuesArray["idFilm"] = $funcion->getIdFilm();
                $valuesArray["duracion"] = $funcion->getDuracion();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/funciones.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->funcionList = array();

            if(file_exists('Data/funciones.json'))
            {
                $jsonContent = file_get_contents('Data/funciones.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $funcion = new funcion();
                    $funcion->setId($valuesArray["id"]);
                    $funcion->setFecha($valuesArray["fecha"]);
                    $funcion->setHora($valuesArray["hora"]);
                    $funcion->setIdSala($valuesArray["idSala"]);
                    $funcion->setIdFilm($valuesArray["idFilm"]);
                    $funcion->SetDuracion($valuesArray["duracion"]);
                    
                    array_push($this->funcionList, $funcion);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->funcionList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }

        public function verificacion($funcion){

            if (!$this->peliculaMismaFecha($funcion) && $this->intervalo15min($funcion)){

                return true;
                
            }
            return false;
        }

        private function peliculaMismaFecha($entry){  //Para validar que en una fecha se reproduzca en un único cine y sala
            
            $this->RetrieveData();
            foreach($this->funcionList as $funcion){
                if ($funcion->getFecha() == $entry->getFecha()){
                    if($funcion->getIdFilm() == $entry->getIdFilm()){

                        return true;
                    }
                }
            }
            return false;
        }

        private function intervalo15min($entry){ //Verifica que una función en la misma sala y misma fecha empieze 15 min después de la anterior

            $this->RetrieveData();
            foreach($this->funcionList as $funcion){
                
                if($funcion->getFecha() == $entry->getFecha() && $funcion->getIdSala() == $entry->getIdSala()){

                    if (!$entry->getHora() > $this->sumarMinutosHora($funcion->getHora(), ($funcion->getDuracion() + 15)) ){ //Verifica si la hora de comienzo de $entry NO es después de los 15 min del fin de $funcion
                        return false;

                    }
                }
            }
            return true;
        }


        private function sumarMinutosHora($horaComienzo, $minDuracion){

            $horas = intdiv($minDuracion, 60); //Devuelve el entero de la división
            $min = $minDuracion - $horas * 60;

            $arrayHoraComienzo = explode(':',$horaComienzo); //EL array en 0 tiene las horas, y en 1 los minutos

            $arrayHoraComienzo[1] += $min; //Los minutos del momento del comienzo más los de la duración

            if ($arrayHoraComienzo[1] > 59){  //Si los minutos llegan a 60 entonces se suma una hora y calculan los minutos sobrantes

                $arrayHoraComienzo[0] ++;
                $arrayHoraComienzo[1] -= 60;
            }

            $arrayHoraComienzo[0] += $horas; //La hora de comienzo más las horas de duración

            if($arrayHoraComienzo[0] > 23){ //La función finaliza al otro día

                return false;
            }

            return implode(":", $arrayHoraComienzo); //El array tiene el resultado de la suma y lo devuelve en formato hh:mm
        }

        public function peliculaEnCartelera($id){

            $this->RetrieveData();
            foreach ($this->funcionList as $funcion){
                if ($funcion->getIdFilm() == $id){
                    return true;
                }
            }
            return false;
        }

        public function getByDate($date){

            $arrayFecha = array();
            $this->RetrieveData();
            foreach ($this->funcionList as $funcion){
    
                if ($funcion->getFecha() == $date){
    
                    $daosFilms = new \DAO\Films();
                    $film = $daosFilms->GetOne($funcion->getIdFilm());
                    array_push($arrayFecha, $film);
                }
            }
            return $arrayFecha;
        }

        public function Remove($idRemove){

            $this->RetrieveData();
            $newList = array();

            foreach ($this->funcionList as $funcion){

                if ($funcion->getId() != $idRemove){
                    
                    array_push($newList, $funcion);
                } 
            }
            $this->funcionList = $newList;
            $this->SaveData();       
        }
        
         
    }
?>