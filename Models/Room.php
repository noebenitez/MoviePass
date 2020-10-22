<?php

    namespace Models;

    class Room{

        //private $id; 
        private $nombre;
        private $capacidad;

        public function __construct($nombre = '', $capacidad = 0){
            
            //$this->$id = $id;
            $this->nombre = $nombre;
            $this->capacidad = $capacidad;
        }

       /* public function setId($id){
            $this->id = $id;
        }*/

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setCapacidad($capacidad){
            $this->capacidad = $capacidad;
        }
            
       /* public function getId(){
            return $this->id;
        }*/

        public function getNombre(){
            return $this->nombre;
        }

        public function getCapacidad(){
            return $this->capacidad;
        }

    }


?>