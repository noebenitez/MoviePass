<?php 
    namespace Config;

    class Request
    {
        private $controller;
        private $method;
        private $parameters = array();
        
        public function __construct()
        {
            $url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);

            $urlArray = explode("/", $url);
         
            $urlArray = array_filter($urlArray);

            if(empty($urlArray))
                $this->controller = "Home";            
            else
                $this->controller = ucwords(array_shift($urlArray));

            if(empty($urlArray))
                $this->method = "Index";
            else
                $this->method = array_shift($urlArray);

            $methodRequest = $this->getMethodRequest();
                        
            if($methodRequest == "GET")
            {
                unset($_GET["url"]);

                if(!empty($_GET))
                {                    
                    foreach($_GET as $key => $value)                    
                        array_push($this->parameters, $value);
                }
                else
                    $this->parameters = $urlArray;
            }
            elseif ($_POST)
                $this->parameters = $_POST;
            
            if($_FILES)
            {
                unset($this->parameters["button"]);
                
                foreach($_FILES as $file)
                {
                    array_push($this->parameters, $file);
                }
            }
        }

        private static function getMethodRequest()
        {
            return $_SERVER["REQUEST_METHOD"];
        }            

        public function getController() {
            return $this->controller;
        }

        public function getMethod() {
            return $this->method;
        }

        public function getparameters() {
            return $this->parameters;
        }
    }
?>



//////////////candela

<?php namespace config;

    class Request {

        private $controlador;
        private $metodo;
        private $parametros;
        
        public function __construct() {

            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $urlToArray = explode("/", $url);

            $ArregloUrl = array_filter($urlToArray);

            

            if(empty($ArregloUrl)) {
                $this->controlador = 'Films';  //inicio por defecto
            } else {
                $this->controlador = array_shift($ArregloUrl);
            }

            if(empty($ArregloUrl)) {
                $this->metodo = 'getAll';  //metodo del controlador por defecto
            } else {
                $this->metodo = array_shift($ArregloUrl);
            }            

            $metodoRequest = $this->getMetodoRequest();

            if($metodoRequest == 'GET') {
                if(!empty($ArregloUrl)) {
                    $this->parametros = $ArregloUrl;
                }
            } else {
                $this->parametros = $_POST;
            }

        }

        /**
         * 
         */
        public static function getInstance()
        {
            static $inst = null;
            if ($inst === null) {
                $inst = new Request();
            }
            return $inst;
        }



        /**
        * Devuelve el método HTTP
        * con el que se hizo el
        * Request
        * 
        * @return String
        */
        public static function getMetodoRequest()
        {
            return $_SERVER['REQUEST_METHOD'];
        }

        /**
        * Devuelve el controlador
        * 
        * @return String
        */
        public function getControlador() {
            return $this->controlador;
        }

        /**
        * Devuelve el método 
        * 
        * @return String
        */
        public function getMetodo() {
            return $this->metodo;
        }
        
        /**
        * Devuelve los atributos
        * 
        * @return Array
        */
        public function getParametros() {
            return $this->parametros;
        }
    }