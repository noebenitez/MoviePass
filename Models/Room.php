<?php

    namespace Models;

    class Room{

        private $id; 
        private $nombre;
        private $capacidad;
        private $idCine;

        public function __construct($id = null, $nombre = '', $capacidad = 0, $idCine = null){
            
            $this->id = $id;
            $this->nombre = $nombre;
            $this->capacidad = $capacidad;
            $this->idCine = $idCine;
        }

       public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setCapacidad($capacidad){
            $this->capacidad = $capacidad;
        }

        public function setIdCine($idCine){
            $this->idCine = $idCine;
        }
            
        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getCapacidad(){
            return $this->capacidad;
        }

        public function getIdCine(){
            return $this->idCine;
        }

    }


?>