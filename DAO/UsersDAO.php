<?php
    namespace DAO;

    use Models\User as User;

    class UsersDAO {

        private $usersList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__) . "/Data/users.json";
        }

        public function Add($user)
        {
            $this->RetrieveData();
            $user->setId($this->lastId() + 1 );
            $user->setIdFB(0);
            array_push($this->usersList, $user);

            $this->SaveData();

            return $user->getId();
        }

        public function AddFB($user)
        {
            $this->RetrieveData();
            $user->setId($this->lastId() + 1 );
            $user->setIdFB($user->getIdFB());
            array_push($this->usersList, $user);

            $this->SaveData();

            return $user->getId();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->usersList;
        }

        public function GetOne($id) {

            $this->RetrieveData();

            foreach($this->usersList as $user) {

                if($user->getId() == $id) {
                    return $user;
                }

            }

            return false;

        }

        public function GetOneFB($idFB) {

            $this->RetrieveData();

            foreach($this->usersList as $user) {

                if($user->getIdFB() == $idFB) {
                    return $user;
                }

            }

            return false;

        }

        public function read($email, $pass){

            $this->RetrieveData();

            foreach($this->usersList as $user) {

                if($user->getEmail() == $email) {
                    
                    if($user->getPassword() == $pass){
                       
                        return $user;
                    }
                }

            }

            return false;
        }

        public function Edit($nuevoUser){

            $this->RetrieveData();
            foreach ($this->usersList as $key=>$user){

                if ($user->getId() == $nuevoUser->getId()){
                    
                    $this->usersList[$key] = $nuevoUser;
                } 
            }
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->usersList as $user)
            {
                $valuesArray["id"] = $user->getId();
                $valuesArray["nombre"] = $user->getNombre();
                $valuesArray["apellido"] = $user->getApellido();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["esAdmin"] = $user->getAdmin();
                $valuesArray["idFB"] = $user->getIdFB();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->usersList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    $user->setId($valuesArray["id"]);
                    $user->setNombre($valuesArray["nombre"]);
                    $user->setApellido($valuesArray["apellido"]);
                    $user->setDni($valuesArray["dni"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);
                    $user->setAdmin($valuesArray["esAdmin"]);
                    $user->setIdFB($valuesArray["idFB"]);

                    array_push($this->usersList, $user);
                }
            }
        }

        private function lastId(){
            
            $this->RetrieveData();
            $id = end($this->usersList); //end() recibe un array y devuelve el último elemento, si el array está vacío retorna false.
            if ($id == false){
                return 0;
            }
            return $id->getId();
        }
    }
?>