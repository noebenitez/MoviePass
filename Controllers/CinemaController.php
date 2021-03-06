<?php
    namespace Controllers;

    use \Exception as Exception;
    use DAO\CinemaDAODB as CinemaDAO;
    use Models\Cinema as Cinema;
    

    class CinemaController{

        private $cinemaDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView() {

            if ($_SESSION["esAdmin"] == false){
                require_once(ROOT . '/Views/header-login.php');
                require_once(ROOT . '/Views/nav-principal.php');
                require_once(ROOT . '/Views/login.php');
            }else{

                require_once(ROOT . '/Views/header.php');
                require_once(ROOT . '/Views/nav-admin.php');
                require_once(VIEWS_PATH."add-cinema.php");
            }
    
                require_once(ROOT . '/Views/footer.php');
            
        
        }

        public function ShowListView() {

            try{

                if($_SESSION["esAdmin"] == false){
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                    require_once(ROOT . '/Views/login.php');
                }else{

                    require_once(ROOT . '/Views/header.php');
                
                    require_once(ROOT . '/Views/nav-admin.php');
        
                    $cinemaList = $this->cinemaDAO->GetAll();
        
                    require_once(VIEWS_PATH."cinema-list.php");
                }
                
    
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al cargar los cines.", $ex->getMessage(), "Home/Index/");
            }
        }

        
        public function ShowEditView($id){

            try{

                if($_SESSION["esAdmin"] == false){
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                    require_once(ROOT . '/Views/login.php');
                }else{

                    require_once(ROOT . '/Views/header.php');
                
                    require_once(ROOT . '/Views/nav-admin.php');
        
                    $cinema = $this->cinemaDAO->GetOne($id);
        
                    require_once(VIEWS_PATH)."edit-cinema.php";
                }

    
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información del cine.", $ex->getMessage(), "Cinema/ShowListView/");
            }
        }

        public function Add($nombre, $calle, $altura, $horaApertura, $horaCierre){

            try{

                $nombre = HomeController::validateString($nombre);
                $calle = HomeController::validateString($calle);

                if (!($calle && $nombre)){

                    throw new Exception("El nombre y/o calle está vacío.");
                }

                $cinema = new Cinema();
                $cinema->setNombre($nombre);
                $cinema->setCalle($calle);
                $cinema->setAltura($altura);
                $cinema->setHoraApertura($horaApertura);
                $cinema->setHoraCierre($horaCierre);
            
                $this->cinemaDAO->Add($cinema);
                $this->ShowListView();

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al agregar el cine.", $ex->getMessage(), "Cinema/ShowAddView/");
            }
        }

        public function ShowRemoveView($id){

            try{
                if ($_SESSION["esAdmin"] == false){
                    
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                    require_once(ROOT . '/Views/login.php');
                }else{

                    require_once(ROOT . '/Views/header.php');
                
                    require_once(ROOT . '/Views/nav-admin.php');
        
                    $cinema = $this->cinemaDAO->GetOne($id);
        
                    require_once(VIEWS_PATH)."remove-cinema.php";

                }

    
                require_once(ROOT . '/Views/footer.php');

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información del cine.", $ex->getMessage(), "Cinema/ShowListView/");
            }
        }

        public function Remove($id){
            try{

                $this->cinemaDAO->Remove($id);
                $this->ShowListView();

            }catch(Exception $ex){
                
                HomeController::ShowErrorView("No se pudo eliminar el cine.", $ex->getMessage(), "Cinema/ShowListView/");
            }
        }

        public function Edit($id, $nombre, $calle, $altura, $horaApertura, $horaCierre){

            try{

                $nombre = HomeController::validateString($nombre);
                $calle = HomeController::validateString($calle);

                if (!($calle && $nombre)){
                    
                    throw new Exception("El nombre y/o calle está vacío.");
                }

                $cinema = new Cinema();
                $cinema->setId($id);
                $cinema->setNombre($nombre);
                $cinema->setCalle($calle);
                $cinema->setAltura($altura);
                $cinema->setHoraApertura($horaApertura);
                $cinema->setHoraCierre($horaCierre);

                $this->cinemaDAO->Edit($cinema);
                $this->ShowListView();
                

            }catch(Exception $ex){

                HomeController::ShowErrorView("No se pudo actualizar la información del cine.", $ex->getMessage(), "Cinema/ShowListView/");
            }

        }
        

        public function nombrePorId($id){

            try{
                
                return $this->cinemaDAO->nombrePorId($id);

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener información del cine.", $ex->getMessage(), "Home/Index/");
            }
        }
        
       

    }

?>