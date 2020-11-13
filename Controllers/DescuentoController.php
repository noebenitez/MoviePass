<?php
    namespace Controllers;

    use \Exception as Exception;
    use DAO\DescuentoDAODB as DescuentoDAO;
    use Models\PoliticaDeDescuento as Descuento;

    class DescuentoController{

        private $descuentoDAO;

        public function __construct()
        {
            $this->descuentoDAO = new DescuentoDAO();
        }

        public function ShowAddView(){
            try{
                if($_SESSION["esAdmin"] == false){
                    
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                    require_once(ROOT . '/Views/login.php');
                }else{
                    require_once(ROOT . '/Views/header.php');
                    require_once(ROOT . '/Views/nav-admin.php');

                    require_once(VIEWS_PATH."add-descuento.php");
                }
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información del descuento.", $ex->getMessage(), "Descuento/ShowListView/");
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
        
                    $descuento = $this->descuentoDAO->GetOne($id);
        
                    require_once(VIEWS_PATH)."edit-descuento.php";
                }
                require_once(ROOT . '/Views/footer.php');

            }catch(Exeption $ex){

                HomeController::ShowErrorView("Error al obtener la información del descuento.", $ex->getMessage(), "Descuento/ShowListView/");
            }

        }

        public function ShowRemoveView($id){
            
            try{
                if($_SESSION["esAdmin"] == false){
                    
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                    require_once(ROOT . '/Views/login.php');
                }else{

                    require_once(ROOT . '/Views/header.php');
                    require_once(ROOT . '/Views/nav-admin.php');
        
                    $descuento = $this->descuentoDAO->GetOne($id);
        
                    require_once(VIEWS_PATH)."remove-descuento.php";
                }
                require_once(ROOT . '/Views/footer.php');

            }catch(Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información del descuento.", $ex->getMessage(), "Descuento/ShowListView/");
            }
        }

        public function Remove($id){

            try{

                $this->descuentoDAO->Remove($id);
                $this->ShowListView();

            }catch (Exception $ex){

                HomeController::ShowErrorView("El descuento no pudo ser eliminado.", $ex->getMessage(), "Descuento/ShowListView/");
            }
        }


        public function ShowListView(){

            try{
                if($_SESSION["esAdmin"] == false){
                    
                    require_once(ROOT . '/Views/header-login.php');
                    require_once(ROOT . '/Views/nav-principal.php');
                    require_once(ROOT . '/Views/login.php');
                }else{
                    
                    require_once(ROOT . '/Views/header.php');
                    require_once(ROOT . '/Views/nav-admin.php');
        
                    $descuentosList = $this->descuentoDAO->GetAll();
        
                    require_once(VIEWS_PATH."descuentos-list.php");
                }
                require_once(ROOT . '/Views/footer.php');

            }catch (Exception $ex){

                HomeController::ShowErrorView("Error al obtener la información de los descuentos.", $ex->getMessage(), "Home/Index/");
            }
        }



        public function Add($dia, $porcentaje, $cantidad, $descripcion){
            
            try{
                $descripcion = HomeController::validateString($descripcion);

                if (!$descripcion){
                    throw new Exception("La descripción está vacía.");
                }
                $descuento = new Descuento();
                $descuento->setDia($dia);
                $descuento->setPorcentaje($porcentaje);
                $descuento->setCantidadMinima($cantidad);
                $descuento->setDescripcion($descripcion);


                $this->descuentoDAO->Add($descuento);
                $this->ShowListView();
    
            }catch(Exception $ex){

                HomeController::ShowErrorView("No pudo agregarse el descuento.", $ex->getMessage(), "Descuento/ShowListView/");
            }

        }

        public function Edit($id, $dia, $porcentaje, $cantidad, $descripcion){

            $descuento = new Descuento();
            $descuento->setId($id);
            $descuento->setDia($dia);
            $descuento->setPorcentaje($porcentaje);
            $descuento->setCantidadMinima($cantidad);
            $descuento->setDescripcion($descripcion);
           

            try{

                $this->descuentoDAO->Edit($descuento);
                $this->ShowListView();

            }catch(Exception $ex){
                
                HomeController::ShowErrorView("No puedo actualizarse la información del descuento.", $ex->getMessage(), "Descuento/ShowListView/");
            }

        }

        public function comprobarDescuento($cantidadEntradas){

            $descuentos = $this->descuentoDAO->GetAll();

            date_default_timezone_set('America/Argentina/Buenos_Aires');

            foreach($descuentos as $desc){
                if($cantidadEntradas >= $desc->getCantidadMinima() && date('l') == $desc->getDia()){
                    return $desc;
                }
            }
            return false;
        }
    }