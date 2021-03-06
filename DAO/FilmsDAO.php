<?php

namespace DAO;

//include("config/constants.php");

class FilmsDAO {

    private $filmsArray;

    public function __construct()
    {
        $filmsArray = array();
    }

    public function GetOne($id) {

        $this->RetrieveData();
        foreach($this->filmsArray as $film) {

            if($film->getId() == $id) {

                return $film;
            }
        }
        return false;
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

        return $this->filmsArray;
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
        $this->filmsArray = array();

            if($jsonContent = file_get_contents(PELICULAS)){

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode['results'] as $valuesArray)
             {
                $film = new \models\Film();

                $film->setPoster($valuesArray['poster_path']);
                $film->setAdultos($valuesArray['adult']);
                $film->setDescripcion($valuesArray['overview']);
                $film->setFechaEstreno($valuesArray['release_date']);
                $film->setGeneros($valuesArray['genre_ids']);
                $film->setId($valuesArray['id']);
                $film->setTitulo($valuesArray['title']);
                $film->setIdiomaOriginal($valuesArray['original_language']);
                $film->setTituloOriginal($valuesArray['original_title']);
                $film->setFondo($valuesArray['backdrop_path']);
                $film->setPopularidad($valuesArray['popularity']);
                $film->setCantidadVotos($valuesArray['vote_count']);
                $film->setVideo($valuesArray['video']);
                $film->setPuntuacion($valuesArray['vote_average']);

                array_push($this->filmsArray, $film);
             }
            }
    }

    public function getRangoFechas(){

        $rango = array();
        if ($jsonContent = file_get_contents(PELICULAS)){
            
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            $rango = $arrayToDecode['dates'];
        }
        return $rango; //Es un array con keys 'maximum' y 'minimum'
    }

    public function getByDate($date){

        $arrayFecha = array();
        $this->RetrieveData();
        foreach ($this->filmsArray as $film){

            if ($film->getFechaEstreno() == $date){

                array_push($arrayFecha, $film);
            }
        }
        return $arrayFecha;
    }

    public function getGeneros($idFilm){
            
        $genres = array();
       
        $this->RetrieveData();

        foreach ($this->filmsArray as $film){

            if ($film->getId() == $idFilm){

                $genres = $film->getGeneros();
            }
        }
        return $genres;

    }

}