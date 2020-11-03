<?php
    namespace DAO;

    use \Exception as Exception;
    use Models\Film as Film;    
    use DAO\Connection as Connection;

    class FilmsDAODB{

        private $connection;
        private $tableName = "peliculas";

        public function Add(Film $film){

            try
            {
                $query = "INSERT INTO ".$this->tableName." (id, poster, adultos, descripcion, fecha_estreno, titulo_original, titulo, idioma_original, fondo, popularidad, cantidad_votos, video, puntuacion) VALUES (:id, :poster, :adultos, :descripcion, :fecha_estreno, :titulo_original, :titulo, :idioma_original, :fondo, :popularidad, :cantidad_votos, :video, :puntuacion);";
                
                $parameters["id"] = $film->getId();
                $parameters["poster"] = $film->getPoster();
                $parameters["adultos"] = $film->getAdultos();
                $parameters["descripcion"] = $film->getDescripcion();
                $parameters["fecha_estreno"] = $film->getFechaEstreno();
                $parameters["titulo_original"] = $film->getTituloOriginal();
                $parameters["titulo"] = $film->getTitulo();
                $parameters["idioma_original"] = $film->getIdiomaOriginal();
                $parameters["fondo"] = $film->getFondo();
                $parameters["popularidad"] = $film->getPopularidad();
                $parameters["cantidad_votos"] = $film->getCantidadVotos();
                $parameters["video"] = $film->getVideo();
                $parameters["puntuacion"] = $film->getPuntuacion();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function refrescarDB(){

            if($jsonContent = file_get_contents(PELICULAS)){

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode['results'] as $valuesArray){

                    $film = new Film();

                    $film->setPoster($valuesArray['poster_path']);
                    $film->setAdultos($valuesArray['adult']);
                    $film->setDescripcion($valuesArray['overview']);
                    $film->setFechaEstreno($valuesArray['release_date']);
                    $film->setId($valuesArray['id']);
                    $film->setTitulo($valuesArray['title']);
                    $film->setIdiomaOriginal($valuesArray['original_language']);
                    $film->setTituloOriginal($valuesArray['original_title']);
                    $film->setFondo($valuesArray['backdrop_path']);
                    $film->setPopularidad($valuesArray['popularity']);
                    $film->setCantidadVotos($valuesArray['vote_count']);
                    $film->setVideo($valuesArray['video']);
                    $film->setPuntuacion($valuesArray['vote_average']);
                    
                    $this->Add($film);
                    $this->addGeneros($film->getId(), $valuesArray['genre_ids']);

                }
        }
        }

        public function GetAll(){
            
            try
            {
                $filmList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                
                foreach ($resultSet as $row)
                {   
                    $film = new Film();
                    $film->setPoster($row['poster']);
                    $film->setAdultos($row['adultos']);
                    $film->setDescripcion($row['descripcion']);
                    $film->setFechaEstreno($row['fecha_estreno']);
                    $film->setId($row['id']);
                    $film->setTitulo($row['titulo']);
                    $film->setIdiomaOriginal($row['idioma_original']);
                    $film->setTituloOriginal($row['titulo_original']);
                    $film->setFondo($row['fondo']);
                    $film->setPopularidad($row['popularidad']);
                    $film->setCantidadVotos($row['cantidad_votos']);
                    $film->setVideo($row['video']);
                    $film->setPuntuacion($row['puntuacion']);

                    array_push($filmList, $film);
                }

                return $filmList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetOne($id){
            
            try{

                $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
                $parameters["id"] = $id;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                
                
            } catch (Exception $ex){ 
                throw $ex;
            }
            
            if (!empty($resultSet)){

                return $this->mapear($resultSet);

            }else{
                return false;
            }
        }


        protected function mapear($value){

            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Film($p["poster"], $p["adultos"], $p["descripcion"], $p["fecha_estreno"], $p["id"], $p["titulo_original"], $p["titulo"], $p["idioma_original"], $p["fondo"], $p["popularidad"], $p["cantidad_votos"], $p["video"], $p["puntuacion"]);
            }, $value);

            return count($resp) > 1 ? $resp : $resp["0"];
        }


        public function getRangoFechas(){

            $rango = array();
            if ($jsonContent = file_get_contents(PELICULAS)){
                
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                $rango = $arrayToDecode['dates'];
            }
            return $rango; //Es un array con keys 'maximum' y 'minimum'
        }
    
        public function getByDate($date){
    
            $arrayFecha = array();
            $films = $this->GetAll();
            foreach ($films as $film){
    
                if ($film->getFechaEstreno() == $date){
    
                    array_push($arrayFecha, $film);
                }
            }
            return $arrayFecha;
        }

        public function addGeneros($idFilm, $generos){

            if(!empty($generos)){

                try{
                    $query = "INSERT INTO peliculaxGenero (id_pelicula, id_genero) VALUES (:idFilm, :id_genero);";
                    
                    foreach($generos as $genero){
                        
                        $parameters["idFilm"] = $idFilm;
                        $parameters["id_genero"] = $genero;
                        $this->connection = Connection::GetInstance();
                        $this->connection->ExecuteNonQuery($query, $parameters);
        
                    }
    
                }catch(Exeption $ex){
                    throw $ex;
                } 
            }
        }

        public function getGeneros($idFilm){
            
            $genres = array();
            $query = "SELECT id_genero FROM peliculaxGenero WHERE id_pelicula = ".$idFilm;

            try{

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row){
                    array_push($genres, $row[0]);
                }
                return $genres;

            } catch(Exeption $ex){

                throw $ex;
            }
        }

        public function getDuracion($idFilm){

            $request = "https://api.themoviedb.org/3/movie/" . $idFilm . "?api_key=f20416aa14acdc6b2cd1af3feb7633a6";
    
            if($jsonContent = file_get_contents($request)){
    
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                return $arrayToDecode["runtime"];
            }else{
    
                return false;
            }
        }


    }

?>