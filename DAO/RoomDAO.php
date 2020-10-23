<?php
    namespace DAO;

    use Models\Room as Room;

    class RoomDAO{

        private $roomList = array();


        public function Add(Room $room){

            $this->RetrieveData();
            $room->setId($this->lastId() + 1 );
            array_push($this->roomList, $room);
            $this->SaveData();

        }

        public function GetAll(){

            $this->RetrieveData();

            return $this->roomList;
        }

        public function GetOne($id) {

            $this->RetrieveData();
            foreach($this->roomList as $room) {

                if($room->getId() == $id) {

                    return $room;
                }
            }
            return false;
        }

        public function Remove($idRemove){

            $this->RetrieveData();
            $newList = array();

            foreach ($this->roomList as $room){

                if ($room->getId() !== $idRemove){
                    
                    array_push($newList, $room);
                } 
            }
            $this->roomList = $newList;
            $this->SaveData();       
        }

        public function Edit(Room $roomActualizado){
            
            $this->RetrieveData();
            foreach ($this->roomList as $key=>$room){

                if ($room->getId() == $roomActualizado->getId()){
                    
                    $this->roomList[$key] = $roomActualizado;
                } 
            }
            $this->SaveData();
        }
    

        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->roomList as $room)
            {

                $valuesArray["id"] = $room->getId();
                $valuesArray["idCine"] = $room->getIdCine();
                $valuesArray["nombre"] = $room->getNombre();
                $valuesArray["capacidad"] = $room->getCapacidad();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/rooms.json', $jsonContent);
        }

        private function RetrieveData(){

            $this->roomList = array();

            if(file_exists('Data/rooms.json'))
            {
                $jsonContent = file_get_contents('Data/rooms.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $room = new Room();
                    $room->setId($valuesArray["id"]);
                    $room->setIdCine($valuesArray["idCine"]);
                    $room->setNombre($valuesArray["nombre"]);
                    $room->setCapacidad($valuesArray["capacidad"]);

                    array_push($this->roomList, $room);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->roomList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }

        public function nombrePorId($id){

            $this->RetrieveData();
            foreach ($this->roomList as $room){
                if ($room->getId() == $id){

                    return $room->getNombre();
                }
            }
            return false;
        }

    }
?>