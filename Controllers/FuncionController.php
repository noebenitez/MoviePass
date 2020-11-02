<?php
    namespace Controllers;

    use Models\Funcion as Funcion;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Film as Film;
    use DAO\Films as FilmsDAO;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\Genres as GenresDAO;

    class FuncionController{

        private $funcionDAO;
        private $roomDAO;
        private $filmDAO;

        public function __construct(){

            $this->funcionDAO = new FuncionDAO();
            $this->roomDAO = new RoomDAO();
            $this->filmDAO = new FilmsDAO();
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

            $cinemaDAO = new CinemaDAO();

            $filmList = $this->filmDAO->GetAll();

            $funcionList = $this->funcionDAO->GetAll();
            $films = array();

            foreach($filmList as $film){
                if ($this->peliculaEnCartelera($film->getId())){
                    array_push($films, $film);
                }
            }

            require_once(VIEWS_PATH."funcion-list.php");

            require_once(ROOT . '/Views/footer.php');
        }

        
        public function ShowEditView($id){

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $cinemaController = new CinemaController();

            $rooms = $this->roomDAO->GetAll();

            $funcion = $this->funcionDAO->GetOne($id);

            $film = $this->filmDAO->GetOne($funcion->getIdFilm());

            require_once(VIEWS_PATH)."edit-funcion.php";

            require_once(ROOT . '/Views/footer.php');
        }

        public function ShowRemoveView($id){

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $funcion = $this->funcionDAO->GetOne($id);
            $film = $this->filmDAO->GetOne($funcion->getIdFilm());
            $room = $this->roomDAO->GetOne($funcion->getIdSala());

            $cinemaDAO = new CinemaDAO();
            $cinema = $cinemaDAO->GetOne($room->getIdCine());

            require_once(VIEWS_PATH)."remove-funcion.php";

            require_once(ROOT . '/Views/footer.php');
        }

        public function Remove($id){
            $this->funcionDAO->Remove($id);
            $this->ShowListView();
        }

        public function RemovePorSala($idSala){
            $this->funcionDAO->RemovePorSala($idSala);
        }

        public function Edit($id, $idFilm, $idSala, $fecha, $hora, $duracion){

            $funcion = new Funcion();
            $funcion->setId($id);
            $funcion->setFecha($fecha);
            $funcion->setHora($hora);
            $funcion->setIdSala($idSala);
            $funcion->setIdFilm($idFilm);
            $funcion->setDuracion($duracion);

           $this->funcionDAO->Edit($funcion);
            $this->ShowListView();

        }

        public function Add($idFilm, $idSala, $fecha, $hora, $duracion){

            $funcion = new Funcion();
            $funcion->setIdFilm($idFilm);
            $funcion->setIdSala($idSala);
            $funcion->setFecha($fecha);
            $funcion->setHora($hora);
            $funcion->setDuracion($duracion);

            $this->funcionDAO->Add($funcion);
            $this->ShowListView();
        
            /*if($this->funcionDAO->Add($funcion)){

               $this->ShowListView();

            }else{

                echo "<script> if(confirm('Error. La película ya tiene una función asignada para la fecha ingresada o el horario es antes de los 15 minutos de terminar la anterior función.'));";
                echo "</script>";
                $this->ShowAddView($idFilm);

            }*/
        }


        public function GetAll(){
            return $this->funcionDAO->GetAll();
        }


        public function peliculaEnCartelera($id){
            return $this->funcionDAO->peliculaEnCartelera($id);
        }

        public function ShowCartelera(){


            if($_SESSION['log'] == false){
                    require_once(ROOT . '/Views/header-login.php'); 
                    require_once(ROOT . '/Views/nav-principal.php');
            }


            if($_SESSION['log'] == true){
                require_once(ROOT . '/Views/header.php'); 
             if( $_SESSION['esAdmin'] == true){
                    require_once(ROOT . '/Views/nav-admin.php');
            }else{
                   require_once(ROOT . '/Views/nav-user.php');
             }
            }

            $allFilms = $this->filmDAO->GetAll();
            $films = array();

            foreach($allFilms as $film){
                if ($this->peliculaEnCartelera($film->getId())){
                    array_push($films, $film);
                }
            }

            $daosGenres = new GenresDAO();
            $genres = $daosGenres->GetAll();

            $daosFilms = new FilmsDAO();
            $rangoFechas = $daosFilms->getRangoFechas();

            require_once(VIEWS_PATH)."cartelera.php";

            require_once(ROOT . '/Views/footer.php');

        }

        public function getFilmsByGenres($id) {

                if($_SESSION['log'] == false) {
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                }else{
                    require_once(ROOT . '/Views/header.php');

                    if ($_SESSION['esAdmin'] == true){

                        require_once(ROOT . '/Views/nav-admin.php');
                    }else{
                        require_once(ROOT . '/Views/nav-user.php');
                    }
                }
    
            $daosGenres = new GenresDAO();
    
            $genres = $daosGenres->GetAll();

            $daosFilms = new FilmsDAO();

           $daosFunciones = new FuncionDAO();
    
           $funciones = $daosFunciones->GetAll();

           $allFilms = $this->filmDAO->GetAll();
            $films = array();

            foreach($allFilms as $film){
                if ($this->peliculaEnCartelera($film->getId())){
                    array_push($films, $film);
                }
            }
    
            require_once(ROOT . '/Views/film-by-genre-funcion.php');
    
            require_once(ROOT . '/Views/footer.php');
    
        }
    
        public function getFilmsByDate($date){
    
                if($_SESSION['log'] == false) {
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                }else{
                    require_once(ROOT . '/Views/header.php');
                    require_once(ROOT . '/Views/nav-user.php');
                }
    
            $daosFuncion = new FuncionDAO();
    
            $films = $daosFuncion->getByDate($date);
    
            require_once(ROOT . '/Views/film-by-date-funcion.php');
    
            require_once(ROOT . '/Views/footer.php');
        }

    }
    
?>

