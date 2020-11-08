<?php

    namespace Models;

    class Ticket{

        private $id;  //Nro de Entrada
        private $valorUnitario;
        private $asiento;
        private $qr;
        private $idUsuario;
        private $idFuncion;
        private $idCompra;

        public function __construct($id = 0, $valorUnitario = 0, $asiento = "", $qr = "", $idUsuario = 0, $idFuncion = 0){

            $this->id = $id;
            $this->valorUnitario = $valorUnitario;
            $this->asiento = $asiento;
            $this->qr = $qr;
            $this->idUsuario = $idUsuario;
            $this->idFuncion = $idFuncion;
            
        }

       public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setValorUnitario($valorUnitario){
            $this->valorUnitario = $valorUnitario;
        }

        public function getValorUnitario(){
            return $this->valorUnitario;
        }

        public function setAsiento($asiento){
            $this->asiento = $asiento;
        }

        public function getAsiento(){
            return $this->asiento;
        }

        public function setQR($qr){
            $this->qr = $qr;
        }

        public function getQR(){
            return $this->qr;
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

        public function setIdCompra($idCompra){
            $this->idCompra = $idCompra;
        }

        public function getIdCompra(){
            return $this->idCompra;
        }
    }

?>