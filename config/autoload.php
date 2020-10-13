<?php namespace Config;
	
    class Autoload {
        
        public static function Start() {
            spl_autoload_register(function($className)
			{
                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
                
				include_once($classPath);
			});
        }
    }
?>


/////////////////////////
////////////CANDELA

<?php namespace config;

    class Autoload {

        public static function start() {

            //echo '<br>Estoy en autoload<br>';

            spl_autoload_register(function($classPath) {


                // Model\User

                // Invierto las barras

                $pathBarrasInvertidas = str_replace("\\", "/", $classPath);

                // Model/User
                
                $classFile = strtolower(ROOT . $pathBarrasInvertidas . ".php");

                include_once($classFile);
            });
        }
    }
?>
