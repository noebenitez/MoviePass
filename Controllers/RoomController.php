<?php
    namespace Controllers;

    use DAO\RoomDAODB as RoomDAO;
    use DAO\CinemaDAODB as CinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;

    class RoomController{

        private $roomDAO;
        private $cinemaDAO;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView(){

            require_once(ROOT . '/views/header.php');
        
            require_once(ROOT . '/views/nav-admin.php');

            $cinemaList = $this->cinemaDAO->GetAll();

            $roomList = $this->roomDAO->GetAll();

            require_once(VIEWS_PATH."add-room.php");

            require_once(ROOT . '/views/footer.php');

        }

        public function ShowListView() {

            require_once(ROOT . '/views/header.php');
        
            require_once(ROOT . '/views/nav-admin.php');

            $cinemaList = $this->cinemaDAO->GetAll();

            $roomList = $this->roomDAO->GetAll();

            require_once(VIEWS_PATH."room-list.php");

            require_once(ROOT . '/views/footer.php');
        }

        
        public function ShowEditView($id){

            require_once(ROOT . '/views/header.php');
        
            require_once(ROOT . '/views/nav-admin.php');

            $room = $this->roomDAO->GetOne($id);

            $cinema = $this->cinemaDAO->GetOne($room->getIdCine());

            require_once(VIEWS_PATH)."edit-room.php";

            require_once(ROOT . '/views/footer.php');
        }

        public function Add($idCine, $nombre, $capacidad){

            $room = new Room();
            $room->setNombre($nombre);
            $room->setCapacidad($capacidad);
            $room->setIdCine($idCine);

            $this->roomDAO->Add($room);
            $this->ShowListView();
        }

        public function Remove($id){
            $this->roomDAO->Remove($id);
            $this->ShowListView();
        }

        public function RemovePorCine($idCine){
            $this->roomDAO->RemovePorCine($idCine);
        }


        public function Edit($id, $idCine, $nombre, $capacidad){

            $room = new Room();
            $room->setId($id);
            $room->setIdCine($idCine);
            $room->setNombre($nombre);
            $room->setCapacidad($capacidad);

            $this->roomDAO->Edit($room);
            $this->ShowListView();

        }

        public function nombrePorId($id){

            return $this->roomDAO->nombrePorId($id);
        }

        public function GetAll(){
            return $this->roomDAO->GetAll();
        }


    }
    
?>