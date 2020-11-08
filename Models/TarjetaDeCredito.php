<?php

    namespace Models;

    class TarjetaDeCredito{

        private $id;
        private $nroTarjeta; 
        private $empresa;
        private $codSeguridad;
        private $vencimiento;
        private $titular;
        private $idUsuario;

        public function __construct($id = null, $nroTarjeta = null, $empresa= null, $codSeguridad = null, $vencimiento = null, $titular = null, $idUsuario = null){
            $this->id = $id;
            $this->nroTarjeta = $nroTarjeta; 
            $this->empresa = $empresa;
            $this->codSeguridad = $codSeguridad;
            $this->vencimiento = $vencimiento;
            $this->titular = $titular;
            $this->idUsuario = $idUsuario;
            
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

       public function setNroTarjeta($nroTarjeta){
            $this->nroTarjeta = $nroTarjeta;
        }

        public function getNroTarjeta(){
            return $this->nroTarjeta;
        }

        public function setEmpresa($empresa){
            $this->empresa = $empresa;
        }

        public function getEmpresa(){
            return $this->empresa;
        }

        public function setCodSeguridad($codSeguridad){
            $this->codSeguridad = $codSeguridad;
        }

        public function getCodSeguridad(){
            return $this->codSeguridad;
        }

        public function setVencimiento($vencimiento){
            $this->vencimiento = $vencimiento;
        }

        public function getVencimiento(){
            return $this->vencimiento;
        }

        public function setTitular($titular){
            $this->titular = $titular;
        }

        public function getTitular(){
            return $this->titular;
        }

        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }

    }

?>