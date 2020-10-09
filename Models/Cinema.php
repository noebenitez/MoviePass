<?php

    namespace Models;

    class Cinema{

        private $id; //Agregé id para poder eliminar y modificar
        private $nombre;
        private $direccion;
        private $horaApertura;
        private $horaCierre;
        private $valorEntrada;

        public function __construct($id = null, $nombre = '', $direccion = '', $horaApertura = null, $horaCierre = null, $valorEntrada = null){
            
            $this->$id = $id;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->horaApertura = $horaApertura;
            $this->horaCierre = $horaCierre;
            $this->valorEntrada = $valorEntrada;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setDireccion($direccion){
            $this->direccion = $direccion;
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
            
        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getDireccion(){
            return $this->direccion;
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

    }


?>