<?php

    namespace Models;

    class Compra{

        private $id; 
        private $idTarjeta;
        private $cantidadEntradas;
        private $valorTotal;
        private $idUsuario;
        private $idFuncion;

        public function __construct(){
             
            $this->id = 0;
            $this->nroTarjeta = 0;
            $this->cantidadEntradas = 0;
            $this->valorTotal = 0;
            $this->idUsuario = 0;
            $this->idFuncion = 0;
            
        }

       public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setIdTarjeta($idTarjeta){
            $this->idTarjeta = $idTarjeta;
        }

        public function getIdTarjeta(){
            return $this->idTarjeta;
        }

        public function setCantidadEntradas($cantidadEntradas){
            $this->cantidadEntradas = $cantidadEntradas;
        }

        public function getCantidadEntradas(){
            return $this->cantidadEntradas;
        }

        public function setValorTotal($valorTotal){
            $this->valorTotal = $valorTotal;
        }

        public function getValorTotal(){
            return $this->valorTotal;
        }

        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function setIdFuncion($idFuncion){
            $this->idFuncion = $idFuncion;
        }

        public function getIdFuncion(){
            return $this->idFuncion;
        }


    }

?>