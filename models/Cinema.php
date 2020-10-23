<?php

    namespace Models;

    class Cinema{

        private $id; //Agregé id para poder eliminar y modificar
        private $nombre;
        private $calle;
        private $altura;
        private $horaApertura;
        private $horaCierre;
        private $valorEntrada;
        private $capacidad;
    

        public function __construct($id = null, $nombre = '', $calle = '', $altura= null, $horaApertura = null, $horaCierre = null, $valorEntrada = null, $capacidad = 0){
            
            $this->$id = $id;
            $this->nombre = $nombre;
            $this->calle = $calle;
            $this->altura = $altura;
            $this->horaApertura = $horaApertura;
            $this->horaCierre = $horaCierre;
            $this->valorEntrada = $valorEntrada;
            $this->capacidad = $capacidad;
           
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setCalle($calle){
            $this->calle = $calle;
        }

        public function setAltura($altura){
            $this->altura = $altura;
        }

        public function setHoraApertura($horaApertura){
            $this->horaApertura = $horaApertura;
        }

        public function setHoraCierre($horaCierre){
            $this->horaCierre = $horaCierre;
        }
        
        public function setValorEntrada($valorEntrada){
            $this->valorEntrada = $valorEntrada;
        }

        public function setCapacidad($capacidad){
            $this->capacidad = $capacidad;
        }
            
        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getCalle(){
            return $this->calle;
        }

        public function getAltura(){
            return $this->altura;
        }

        public function getHoraApertura(){
            return $this->horaApertura;
        }

        public function getHoraCierre(){
            return $this->horaCierre;
        }

        public function getValorEntrada(){
            return $this->valorEntrada;
        }

        public function getCapacidad(){
            return $this->capacidad;
        }

    }


?>