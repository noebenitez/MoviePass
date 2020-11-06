<?php
    namespace Controllers;

    use \Exception as Exception;
    use Models\Funcion as Funcion;
    use DAO\FuncionDAODB as FuncionDAO;
    use Models\Film as Film;
    use DAO\FilmsDAODB as FilmsDAO;
    use Models\Room as Room;
    use DAO\RoomDAODB as RoomDAO;
    use DAO\CinemaDAODB as CinemaDAO;
    use DAO\GenresDAODB as GenresDAO;

    class FuncionController{

        private $funcionDAO;
        private $roomDAO;
        private $filmDAO;
        private $cinemaDAO;
        private $genresDAO;

        public function __construct(){

            $this->funcionDAO = new FuncionDAO();
            $this->roomDAO = new RoomDAO();
            $this->filmDAO = new FilmsDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->genresDAO = new GenresDAO();
        }


        public function ShowAddView($idFilm){

            try{

                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
    
                $cinemaController = new CinemaController();
                $film = $this->filmDAO->GetOne($idFilm);
                $duracionFilm = $this->filmDAO->getDuracion($idFilm);
                $rooms = $this->roomDAO->GetAll();
    
                require_once(VIEWS_PATH."add-funcion.php");
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de la función.", $ex->getMessage(), "Films/getAll/");
            }


        }


        public function ShowListView() {

            try{

                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');

                $films = $this->filmDAO->getFilmsConFunciones();
                
                require_once(VIEWS_PATH."funcion-list.php");
                require_once(ROOT . '/Views/footer.php');

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de las funciones.", $ex->getMessage(), "Home/Index/");
            }

        }

        
        public function ShowEditView($id){

            try{

                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
    
                $cinemaController = new CinemaController();
                $rooms = $this->roomDAO->GetAll();
                $funcion = $this->funcionDAO->GetOne($id);
                $film = $this->filmDAO->GetOne($funcion->getIdFilm());
    
                require_once(VIEWS_PATH)."edit-funcion.php";
                require_once(ROOT . '/Views/footer.php');

            }catch(Exeption $ex){

                HomeController::ShowErrorView("Error al obtener la información de la función.", $ex->getMessage(), "Funcion/ShowListView/");
            }

        }

        public function ShowRemoveView($id){
            
            try{

                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
    
                $funcion = $this->funcionDAO->GetOne($id);
                $film = $this->filmDAO->GetOne($funcion->getIdFilm());
                $room = $this->roomDAO->GetOne($funcion->getIdSala());
                $cinema = $this->cinemaDAO->GetOne($room->getIdCine());
    
                require_once(VIEWS_PATH)."remove-funcion.php";
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de la función.", $ex->getMessage(), "Funcion/ShowListView/");
            }
        }

        public function Remove($id){

            try{

                $this->funcionDAO->Remove($id);
                $this->ShowListView();

            }catch (Exception $ex){

                HomeController::ShowErrorView("La función no pudo ser eliminada.", $ex->getMessage(), "Funcion/ShowListView/");
            }
        }

        public function Edit($id, $idFilm, $idSala, $fecha, $hora, $duracion, $entradasVendidas){

            $funcion = new Funcion();
            $funcion->setId($id);
            $funcion->setFecha($fecha);
            $funcion->setHora($hora);
            $funcion->setIdSala($idSala);
            $funcion->setIdFilm($idFilm);
            $funcion->setDuracion($duracion);
            $funcion->setEntradasVendidas($entradasVendidas);

            try{

                $this->funcionDAO->Edit($funcion);
                $this->ShowListView();

            }catch(Exception $ex){
                
                HomeController::ShowErrorView("No puedo actualizarse la información de la función.", $ex->getMessage(), "Funcion/ShowListView/");
            }

        }

        public function Add($idFilm, $idSala, $fecha, $hora, $duracion){

            $funcion = new Funcion();
            $funcion->setIdFilm($idFilm);
            $funcion->setIdSala($idSala);
            $funcion->setFecha($fecha);
            $funcion->setHora($hora);
            $funcion->setDuracion($duracion);
            $funcion->setEntradasVendidas(0);

            try{

                if($this->funcionDAO->verificarHora($funcion)){
                    throw new Exception("La función ingresada se superpone con otra en la misma fecha y sala.");
                }

                $this->funcionDAO->Add($funcion);
                $this->ShowListView();
    
            }catch(Exception $ex){

                HomeController::ShowErrorView("No pudo agregarse la función.", $ex->getMessage(), "Films/getAll/");
            }

        }


        public function peliculaEnCartelera($id){

            try{
                return $this->funcionDAO->peliculaEnCartelera($id);

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener las películas en cartelera.", $ex->getMessage(), "Home/Index/");
            }
        }

        public function entradasDisponibles($idFilm){ //Para mostrar en cartelera solo si la película tiene alguna de sus funciones disponibles

            try{

                $funciones = $this->funcionDAO->getFuncionesPorPelicula($idFilm);
                if (!empty($funciones)){
    
                    foreach ($funciones as $funcion){
                        
                        $room = $this->roomDAO->getOne($funcion->getIdSala());
    
                        if ($funcion->getEntradasVendidas() == $room->getCapacidad()){
    
                            return false;
                        }
                    }
                }
                return true;

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al verificar si existen entradas disponibles.", $ex->getMessage(), "Home/Index");
            }
        }

        public function ShowCartelera(){

            try{

                if($_SESSION['log'] == false){
                    require_once(ROOT . '/Views/header-login.php'); 
                    require_once(ROOT . '/Views/nav-principal.php');
                }else{
                    require_once(ROOT . '/Views/header.php'); 
                    
                    if( $_SESSION['esAdmin'] == true){
                        require_once(ROOT . '/Views/nav-admin.php');
                    }else{
                        require_once(ROOT . '/Views/nav-user.php');
                    }
                }
    
                $films = $this->filmDAO->getFilmsCartelera();  //Solo trae las que tienen funciones futuras

                $genres = $this->genresDAO->GetAll();
                $rangoFechas = $this->filmDAO->getRangoFechas();
                require_once(VIEWS_PATH)."cartelera.php";
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener las películas de la cartelera.", $ex->getMessage(), "Home/Index");
            }

        }

        public function getFilmsByGenres($id) {

            try{

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

                $genre = $this->genresDAO->GetOne($id);
                $genreName = $genre->getNombre();
                var_dump($genre);
                $films = $this->filmDAO->getFilmsCartelera();
        
                require_once(ROOT . '/Views/film-by-genre-funcion.php');
                require_once(ROOT . '/Views/footer.php');
        

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener las películas por género.", $ex->getMessage(), "Home/Index/");
            }
        }
    
        public function getFilmsByDate($date){
            
            try{

                if($_SESSION['log'] == false) {
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                }else{
                    require_once(ROOT . '/Views/header.php');
                    require_once(ROOT . '/Views/nav-user.php');
                }
        
                $films = $this->funcionDAO->getByDate($date);
                require_once(ROOT . '/Views/film-by-date-funcion.php');
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener las películas por fecha.", $ex->getMessage(), "Home/Index/");
            }
        }

    }
    
?>

