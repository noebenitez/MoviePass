<?php
    namespace Controllers;

    use Models\Funcion as Funcion;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Film as Film;
    use DAO\Films as FilmDAO;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;

    class FuncionController{

        private $funcionDAO;
        private $roomDAO;
        private $filmDAO;

        public function __construct(){

            $this->funcionDAO = new FuncionDAO();
            $this->roomDAO = new RoomDAO();
            $this->filmDAO = new FilmDAO();
        }


        public function ShowAddView($idFilm){

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $cinemaController = new CinemaController();

            $film = $this->filmDAO->GetOne($idFilm);

            $rooms = $this->roomDAO->GetAll();

            require_once(VIEWS_PATH."add-funcion.php");

            require_once(ROOT . '/Views/footer.php');

        }

        public function ShowListView() {

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $cinemaList = $this->cinemaDAO->GetAll();

            $roomList = $this->roomDAO->GetAll();

            require_once(VIEWS_PATH."room-list.php");

            require_once(ROOT . '/Views/footer.php');
        }

        
        public function ShowEditView($id){

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $room = $this->roomDAO->GetOne($id);

            $cinema = $this->cinemaDAO->GetOne($room->getIdCine());

            require_once(VIEWS_PATH)."edit-room.php";

            require_once(ROOT . '/Views/footer.php');
        }

        public function Add($idFilm, $idSala, $fecha, $hora, $duracion){

            $funcion = new Funcion();
            $funcion->setIdFilm($idFilm);
            $funcion->setIdSala($idSala);
            $funcion->setFecha($fecha);
            $funcion->setHora($hora);
            $funcion->setDuracion($duracion);
            
            if($this->funcionDAO->verificacion($funcion)){

                $this->funcionDAO->Add($funcion);
                

            }else{

                echo "<script> if(confirm('Error. La película ya tiene una función asignada para la fecha ingresada o el horario es antes de los 15 minutos de terminar la anterior función.'));";
                echo "</script>";
                $this->ShowAddView($idFilm);

            }
        }


        public function GetAll(){
            return $this->funcionDAO->GetAll();
        }


        public function peliculaEnCartelera($id){
            return $this->funcionDAO->peliculaEnCartelera($id);
        }

        public function ShowCartelera(){

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $allFilms = $this->filmDAO->GetAll();
            $films = array();

            foreach($allFilms as $film){
                if ($this->peliculaEnCartelera($film->getId())){
                    array_push($films, $film);
                }
            }

            require_once(VIEWS_PATH)."cartelera.php";

            require_once(ROOT . '/Views/footer.php');

        }

    }
    
?>