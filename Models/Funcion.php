<?php
    
    namespace Models;

    class Funcion{
 
        private $id;
        private $fecha;
        private $hora;
        private $idSala;
        private $idFilm;
        private $duracion;
        private $entradasVendidas;

        
        public function __construct ($id = null, $fecha = null, $hora = null, $idSala = null, $idFilm = null, $duracion= null, $entradasVendidas = 0){

            $this->id = $id;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->idSala = $idSala;
            $this->idFilm = $idFilm;
            $this->duracion = $duracion;
            $this->entradasVendidas = $entradasVendidas;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function setHora($hora){
            $this->hora = $hora;
        }

        public function setIdSala($idSala){
            $this->idSala = $idSala;
        }

        public function setIdFilm($idFilm){
            $this->idFilm = $idFilm;
        }

        public function setDuracion($duracion){
            $this->duracion = $duracion;
        }

        public function setEntradasVendidas($entradasVendidas){
            $this->entradasVendidas = $entradasVendidas;
        }

        public function getId(){
            return $this->id;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getHora(){
            return $this->hora;
        }

        public function getIdSala(){
            return $this->idSala;
        }

        public function getIdFilm(){
            return $this->idFilm;
        }

        public function getDuracion(){
            return $this->duracion;
        }

        public function getEntradasVendidas(){
            return $this->entradasVendidas;
        }
    }
?>