<?php 

namespace Models;

class Film {

    private $poster;
    private $adultos;
    private $descripcion;
    private $fechaEstreno;
    private $generos;
    private $id;
    private $tituloOriginal;
    private $titulo;
    private $idiomaOriginal;
    private $fondo; //supuestamente es una imagen de fondo, pero ni idea
    private $popularidad;
    private $cantidadVotos;
    private $video; //está como video, es un booleano, calculo será si tiene o no trailer
    private $puntuacion; 

    function __construct($poster = '', $adultos = false, $descripcion = '', $fechaEstreno = '', $id = 0, $titulo = '', $idiomaOriginal = '', $fondo = '', $popularidad = 0, $cantidadVotos = 0, $video = false, $puntuacion = 0) {
        $this->poster = $poster;
        $this->adultos = $adultos;
        $this->descripcion = $descripcion;
        $this->fechaEstreno = $fechaEstreno;
        $this->generos = array();
        $this->id = $id;
        $this->titulo = $titulo;
        $this->idiomaOriginal = $idiomaOriginal;
        $this->fondo = $fondo;
        $this->popularidad = $popularidad;
        $this->cantidadVotos = $cantidadVotos;
        $this->video = $video;
        $this->puntuacion = $puntuacion;
    }

    public function getPoster() {
        return $this->poster;
    }

    public function setPoster($value) {
        $this->poster = $value;
    }

    public function getAdultos() {
        return $this->adultos;
    }

    public function setAdultos($value) {
        $this->adultos = $value;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($value) {
        $this->descripcion = $value;
    }

    public function getFechaEstreno() {
        return $this->fechaEstreno;
    }

    public function setFechaEstreno($value) {
        $this->fechaEstreno = $value;
    }

    public function getGeneros() {
        return $this->generos;
    }

    public function setGeneros($value) {
        $this->generos = $value;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($value) {
        $this->titulo = $value;
    }

    public function getTituloOriginal() {
        return $this->tituloOriginal;
    }

    public function setTituloOriginal($value) {
        $this->tituloOriginal = $value;
    }

    public function getIdiomaOriginal() {
        return $this->idiomaOriginal;
    }

    public function setIdiomaOriginal($value) {
        $this->idiomaOriginal = $value;
    }

    public function getFondo() {
        return $this->fondo;
    }

    public function setFondo($value) {
        $this->fondo = $value;
    }
    
    public function getPopularidad() {
        return $this->popularidad;
    }

    public function setPopularidad($value) {
        $this->popularidad = $value;
    }

    public function getCantidadVotos() {
        return $this->cantidadVotos;
    }

    public function setCantidadVotos($value) {
        $this->cantidadVotos = $value;
    }

    public function getVideo() {
        return $this->video;
    }

    public function setVideo($value) {
        $this->video = $value;
    }

    public function getPuntuacion() {
        return $this->puntuacion;
    }

    public function setPuntuacion($value) {
        $this->puntuacion = $value;
    }

}
