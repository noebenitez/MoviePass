<?php

    namespace Models;

    class PoliticaDeDescuento{

        private $id;
        private $porcentaje;
        private $dia;
        private $cantidadMinima;  //de entradas
        private $descripcion;

        public function __construct ($id = null, $porcentaje = null, $dia = null, $cantidadMinima = null, $descripcion = null){

            $this->id = $id;
            $this->porcentaje = $porcentaje;
            $this->dia = $dia;
            $this->cantidadMinima = $cantidadMinima;
            $this->descripcion = $descripcion;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setPorcentaje($porcentaje){
            $this->porcentaje = $porcentaje;
        }

        public function getPorcentaje(){
            return $this->porcentaje;
        }

        public function setDia($dia){
            $this->dia = $dia;
        }

        public function getDia(){
            return $this->dia;
        }

        public function setCantidadMinima($cantidadMinima){
            $this->cantidadMinima = $cantidadMinima;
        }

        public function getCantidadMinima(){
            return $this->cantidadMinima;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

    }