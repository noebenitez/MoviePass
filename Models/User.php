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

        public function __construct($id_usuario=NULL, $nombre_usuario=NULL, $apellido_usuario=NULL, $email_usuario=NULL, $password_usuario=NULL, $admin_usuario=NULL, $id_fb_usuario=NULL, $dni_usuario=NULL)
        {
            $this->id=$id_usuario;
            $this->nombre=$nombre_usuario;
            $this->apellido=$apellido_usuario;
            $this->dni=$dni_usuario;
            $this->email=$email_usuario;
            $this->password=$password_usuario;
            $this->esAdmin=$admin_usuario;
            $this->idFB=$id_fb_usuario;

        }

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
            $this->esAdmin = (bool)$esAdmin;
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