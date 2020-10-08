<?php

namespace daos;

include("config/autoload.php");
//include("config/constants.php");

class Genres {

    private $genresArray;

    public function __construct()
    {
        $genresArray = array();
    }

   /* public function create($film) {

        if($this->Add($film)) {
            return true;
        } 
        return false;       
    }

    public function Add(\models\Film $film)
    {
        $this->RetrieveData();
        
        array_push($this->filmsArray, $film);

        return $this->SaveData();
    }*/

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->genresArray;
    }

  /*  private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->filmsArray as $film)
        {
            //$valuesArray["id"] = $film->getId();
           

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        return file_put_contents($this->url, $jsonContent);
    }*/

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

}