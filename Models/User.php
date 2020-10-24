<?php

    namespace Models;

    class User{

        private $id;
        private $nombre;
        private $apellido;
        private $dni;
        private $email;
        private $password;
        private $esAdmin;
        private $idFB;

        public function setId($id) {
            $this->id = $id;
        }

        public function getId() {
            return $this->id;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function setDni($dni) {
            $this->dni = $dni;
        }

        public function getDni() {
            return $this->dni;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setAdmin($esAdmin) {
            $this->esAdmin = $esAdmin;
        }

        public function getAdmin() {
            return $this->esAdmin;
        }

        public function setIdFB($idFB) {
            $this->idFB = $idFB;
        }

        public function getIdFB() {
            return $this->idFB;
        }

    }