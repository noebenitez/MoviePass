<?php

    namespace Models;

    class Ticket{

        private $id;  //Nro de Entrada
        private $valorUnitario;
        private $asiento;
        private $qr;
        private $idUsuario;
        private $idFuncion;

        public function __construct(){

            $this->id = 0;
            $this->valorUnitario = 0;
            $this->asiento = '';
            $this->qr = '';
            $this->idUsuario = 0;
            $this->idFuncion = 0;
            
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
    }

?>