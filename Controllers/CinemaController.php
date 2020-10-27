<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    

    class CinemaController{

        private $cinemaDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView() {
            
            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            require_once(VIEWS_PATH."add-cinema.php");

            require_once(ROOT . '/Views/footer.php');
        
        }

        public function ShowListView() {

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $cinemaList = $this->cinemaDAO->GetAll();

            require_once(VIEWS_PATH."cinema-list.php");

            require_once(ROOT . '/Views/footer.php');
        }

        
        public function ShowEditView($id){

            require_once(ROOT . '/Views/header.php');
        
            require_once(ROOT . '/Views/nav-admin.php');

            $cinema = $this->cinemaDAO->GetOne($id);

            require_once(VIEWS_PATH)."edit-cinema.php";

            require_once(ROOT . '/Views/footer.php');
        }

        public function Add($nombre, $calle, $altura, $horaApertura, $horaCierre, $valorEntrada){

            $cinema = new Cinema();
            $cinema->setNombre($nombre);
            $cinema->setCalle($calle);
            $cinema->setAltura($altura);
            $cinema->setHoraApertura($horaApertura);
            $cinema->setHoraCierre($horaCierre);
            $cinema->setValorEntrada($valorEntrada);
            
            
            if ($this->validate($cinema)){  //Valida que no exista otro cine con la misma dirección
                
                $this->cinemaDAO->Add($cinema);
                $this->ShowListView();

            }else{

                echo "<script> if(confirm('Error. Ya existe un cine con la dirección ingresada.'));";
                echo "</script>";
                $this->ShowAddView();

            }
        }

        public function Remove($id){
            $this->cinemaDAO->Remove($id);
            $this->ShowListView();
        }

        public function Edit($id, $nombre, $calle, $altura, $horaApertura, $horaCierre, $valorEntrada){

            $cinema = new Cinema();
            $cinema->setId($id);
            $cinema->setNombre($nombre);
            $cinema->setCalle($calle);
            $cinema->setAltura($altura);
            $cinema->setHoraApertura($horaApertura);
            $cinema->setHoraCierre($horaCierre);
            $cinema->setValorEntrada($valorEntrada);

            if ($this->validate($cinema)){  //Valida que no exista otro cine con la misma dirección
                
                $this->cinemaDAO->Edit($cinema);
                $this->ShowListView();

           }else{

                echo "<script> if(confirm('Error. Ya existe un cine con la dirección ingresada.'));";
                echo "</script>";
                $this->ShowListView();

            }
        }

        public function validate($cinema){
            
            if ($this->cinemaDAO->direccionRepetida($cinema)){
                return false;
            }
            return true;
        }

        public function nombrePorId($id){

            return $this->cinemaDAO->nombrePorId($id);
        }
        
       

    }

?>