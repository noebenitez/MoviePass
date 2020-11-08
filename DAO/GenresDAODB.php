<?php

namespace DAO;

use \Exception as Exception;
use Models\Genre as Genre;    
use DAO\Connection as Connection;

class GenresDAODB {

    private $connection;
    private $tableName = "generos";


    public function Add(Genre $genre){

        try
        {
            $query = "INSERT IGNORE INTO ".$this->tableName." (id, nombre) VALUES (:id, :nombre);";
            
            $parameters["id"] = $genre->getId();
            $parameters["nombre"] = $genre->getNombre();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function cargarGeneros(){ //De la api a la bd, sería necesario una única vez
        
        if($jsonContent = file_get_contents(GENEROS)){

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode['genres'] as $valuesArray){

                $genre = new Genre();

                $genre->setNombre($valuesArray['name']);
                $genre->setId($valuesArray['id']);

                try{
                    $this->Add($genre);
                }catch(Exception $ex){
                    throw $ex;
                }
             }
        }
        
    } 

    public function GetAll(){
            
        try
        {
            $genreList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {                
                $genre = new Genre();
                $genre->setId($row["id"]);
                $genre->setNombre($row["nombre"]);

                array_push($genreList, $genre);
            }

            return $genreList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetOne($id){

        $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
        $parameters["id"] = $id;

        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            if (!empty($resultSet)){
                return $this->mapear($resultSet);
            }else{
                return false;
            }
            
        } catch (Exception $ex){ 
            throw $ex;
        }
        
    }

    protected function mapear($value){

        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Genre($p["nombre"], $p["id"]);
        }, $value);

        return count($resp) > 1 ? $resp : $resp["0"];
    }

}