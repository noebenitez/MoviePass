<?php

namespace DAO;

   
    use Models\User as User;
    use \Exception as Exception;
    use DAO\Connection as Connection;


    class UsersDAODB {
        private $usersList = array();
        private $connection;
        private $tableName = "usuarios";
        
        public function __construct()
        {
                   

        }

        public function Add($user)
        {
            try
            {
                 $query = "INSERT INTO ".$this->tableName." (    
                                    
                                    dni_usuario, 
                                    nombre_usuario,
                                    apellido_usuario,
                                    email_usuario,
                                    password_usuario,
                                    admin_usuario,
                                    id_fb_usuario)  
                                    VALUES (
                                    :dni, 
                                   :nombre, 
                                   :apellido,
                                    :email,
                                    :password,
                                    :admin,
                                     :id_fb);";
                                    

                                    $valuesArray["nombre"] = $user->getNombre();
                                    $valuesArray["apellido"] = $user->getApellido();
                                    $valuesArray["dni"] = $user->getDni();
                                    $valuesArray["email"] = $user->getEmail();
                                    $valuesArray["password"] = $user->getPassword();
                                    $valuesArray["admin"] = $user->getAdmin();
                                    $valuesArray["id_fb"] = $user->getIdFB();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $valuesArray);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }    


        public function AddFB($user)
        {
           $this->add($user);

        }

        public function GetAll()
        {
            try
            {
                $UserList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setId($row["id_usuario"]);
                    $user->setNombre($row["nombre_usuario"]);
                    $user->setApellido($row["apellido_usuario"]);
                    $user->setDni($row["dni_usuario"]);
                    $user->setEmail($row["email_usuario"]);
                    $user->setPassword($row["password_usuario"]);
                    $user->setAdmin($row["admin_usuario"]);
                    $user->setIdFB($row["id_fb_usuario"]);

                    array_push($this->usersList, $user);
                }

                return $this->userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new User($p["id_usuario"], $p["nombre_usuario"], $p["apellido_usuario"], $p["email_usuario"], $p["password_usuario"], $p["admin_usuario"], $p["id_fb_usuario"], $p["dni_usuario"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }

        public function GetOne($id) {

            $query ="SELECT * FROM " . $this->tableName . " WHERE id_usuario = '" . $id. "';";
            
               
                try{
                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->Execute($query);
    
                } catch (Exception $ex){ 
                    throw $ex;
                }
    
                if (!empty($resultSet)){
                   
    
                    return $this->mapear($resultSet);
    
                }else{
                    return false;
                }
            }
    

            

        public function GetOneFB($idFB) {
                $query = "SELECT * FROM " . $this->tableName . " WHERE id_fb_usuario = " . $idFB.";";
                try{
                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->Execute($query);
    
                } catch (Exception $ex){ 
                    throw $ex;
                }
    
                if (!empty($resultSet)){
                   
    
                    return $this->mapear($resultSet);
    
                }else{
                    return false;
                }
            }


          

        public function read($email, $pass)
        {   
            try
            {
                
            $query ="SELECT * FROM " . $this->tableName . " WHERE email_usuario = '" . $email. "' and password_usuario= '".$pass."';";
            
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                if (!empty($resultSet))
                {
                    return $this->mapear($resultSet);
                }

              
                else
                {
                    return false;
                }
            }       
            catch (Exception $ex)
            { 
                throw $ex;
            }
        }

        public function Edit(User $userEditado){
            
            ECHO $userEditado->getId();
            $query = "UPDATE " . $this->tableName . " SET  
                                                        dni_usuario= :dni, 
                                                        nombre_usuario=:nombre,
                                                        apellido_usuario= :apellido,
                                                        email_usuario=:email,
                                                        password_usuario=:password,
                                                        admin_usuario=:admin,
                                                        id_fb_usuario=:id_fb
                                                        WHERE id_usuario = :id";
            
            
                                    $valuesArray["id"] = $userEditado->getId();
                                    $valuesArray["nombre"] = $userEditado->getNombre();
                                    $valuesArray["apellido"] = $userEditado->getApellido();
                                    $valuesArray["dni"] = $userEditado->getDni();
                                    $valuesArray["email"] = $userEditado->getEmail();
                                    $valuesArray["password"] = $userEditado->getPassword();
                                    $valuesArray["admin"] = $userEditado->getAdmin();
                                    $valuesArray["id_fb"] = $userEditado->getIdFB();


            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $valuesArray);

            } catch (Exception $ex){ 
                throw $ex;
            }
        }

    }

          
    
?>