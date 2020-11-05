<?php
    namespace Controllers;

    use \Exception as Exception;
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

            try{

                require_once(ROOT . '/views/header.php');
                require_once(ROOT . '/views/nav-admin.php');
    
                $cinemaList = $this->cinemaDAO->GetAll();
                $roomList = $this->roomDAO->GetAll();
    
                require_once(VIEWS_PATH."add-room.php");
                require_once(ROOT . '/views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de los cines y salas.", $ex->getMessage(), "Room/ShowListView/");
            }


        }

        public function ShowListView() {

            try{

                require_once(ROOT . '/views/header.php');
                require_once(ROOT . '/views/nav-admin.php');
    
                $cinemaList = $this->cinemaDAO->GetAll();
                $roomList = $this->roomDAO->GetAll();
    
                require_once(VIEWS_PATH."room-list.php");
                require_once(ROOT . '/views/footer.php');

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de los cines y salas.", $ex->getMessage(), "Home/Index/");
            }
        }


        
        public function ShowEditView($id){

            try{

                require_once(ROOT . '/views/header.php');
                require_once(ROOT . '/views/nav-admin.php');
    
                $room = $this->roomDAO->GetOne($id);
                $cinema = $this->cinemaDAO->GetOne($room->getIdCine());
    
                require_once(VIEWS_PATH)."edit-room.php";
                require_once(ROOT . '/views/footer.php');

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de la sala.", $ex->getMessage(), "Room/ShowListView/");
            }

        }

        public function Add($idCine, $nombre, $capacidad, $valorEntrada){

            $room = new Room();
            $room->setNombre($nombre);
            $room->setCapacidad($capacidad);
            $room->setIdCine($idCine);
            $room->setValorEntrada($valorEntrada);

            try{

                $this->roomDAO->Add($room);
                $this->cinemaDAO->updateCapacidadCine($idCine, $this->roomDAO->capacidadCine($idCine));
                $this->ShowListView(); 

            }catch (Exception $ex){

                HomeController::ShowErrorView("No pudo guardarse la nueva sala.", $ex->getMessage(), "Room/ShowAddView/");
            }

        }

        public function ShowRemoveView($id){

            try{

                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
    
                $room = $this->roomDAO->GetOne($id);
                $cinema = $this->cinemaDAO->GetOne($room->getIdCine());
    
                require_once(VIEWS_PATH)."remove-room.php";
                require_once(ROOT . '/Views/footer.php');

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de la sala.", $ex->getMessage(), "Room/ShowListView/");
            }

        }

        public function Remove($id){

            try{
                $room = $this->roomDAO->getOne($id);
                $this->roomDAO->Remove($id);
                $this->cinemaDAO->updateCapacidadCine($room->getIdCine(), $this->roomDAO->capacidadCine($room->getIdCine()));
                $this->ShowListView();

            }catch (Exception $ex){

                HomeController::ShowErrorView("No pudo borrarse correctamente la sala seleccionada.", $ex->getMessage(), "Room/ShowListView/");
            }
        }


        public function Edit($id, $idCine, $nombre, $capacidad, $valorEntrada){

            $room = new Room();
            $room->setId($id);
            $room->setIdCine($idCine);
            $room->setNombre($nombre);
            $room->setCapacidad($capacidad);
            $room->setValorEntrada($valorEntrada);

            try{

                $this->roomDAO->Edit($room);
                $this->cinemaDAO->updateCapacidadCine($idCine, $this->roomDAO->capacidadCine($idCine));
                $this->ShowListView();
                
            }catch (Exception $ex){

                HomeController::ShowErrorView("La información de la sala no pudo actualizarse.", $ex->getMessage(), "Room/ShowListView/");
            }
            

        }

        public function nombrePorId($id){

            try{
                return $this->roomDAO->nombrePorId($id);

            }catch (Exception $ex){

                HomeController::ShowErrorView("No pudo obtenerse el nombre de la sala.", $ex->getMessage(), "Home/Index/");
            }
        }

        public function GetAll(){
            return $this->roomDAO->GetAll();
        }


    }
    
?>