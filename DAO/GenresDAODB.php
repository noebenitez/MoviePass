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
            $query = "INSERT INTO ".$this->tableName." (id, nombre) VALUES (:id, :nombre);";
            
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

    private function RetrieveData()
    {
        $this->genresArray = array();

            if($jsonContent = file_get_contents(GENEROS)){

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode['genres'] as $valuesArray)
             {
                $genre = new \models\Genre();

                $genre->setNombre($valuesArray['name']);
                $genre->setId($valuesArray['id']);

                array_push($this->genresArray, $genre);
             }
            }
    }

    public function cargarGeneros(){ //De la api a la bd, sería necesario una única vez
        
        if($jsonContent = file_get_contents(GENEROS)){

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode['genres'] as $valuesArray){

                $genre = new Genre();

                $genre->setNombre($valuesArray['name']);
                $genre->setId($valuesArray['id']);

                $this->Add($genre);
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

}