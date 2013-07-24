<?php

/**
 * DnaBase class file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 */

/**
 * DnaBase is a helper class serving common framework functionalities.
 *
 * Do not use DnaBase directly. Instead, use its child class {@link Dna} where
 * you can customize methods of DnaBase.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @package system
 * @since 1.0
 */

namespace Dna {

    use Dna\Core\Exception as Exception;

    class DnaBase {

        private static $_loaded = array();
        private static $_paths = array(
            "/app/libraries",
            "/app/controllers",
            "/app/models",
            "/app",
            ""
        );

        /**
         * @return string the version of Dna framework
         */
        public static function getVersion() {
            return '1.0.0';
        }

        /**
         * @return string the path of the framework
         */
        public static function getFrameworkPath() {
            return DNA_PATH;
        }

        public static function initialize() {

            if (!defined("DNA_PATH")) {
                throw new Exception("DNA_PATH not defined");
            }
            
            // fix extra backslashes in $_POST/$_GET

            if (get_magic_quotes_gpc()) {
                $globals = array("_POST", "_GET", "_COOKIE", "_REQUEST", "_SESSION");

                foreach ($globals as $global) {
                    if (isset($GLOBALS[$global])) {
                        $GLOBALS[$global] = self::_clean($GLOBALS[$global]);
                    }
                }
            }

            // start autoloading

            $paths = array_map(function($item) {
                        return DNA_PATH . $item;
                    }, self::$_paths);

            $paths[] = get_include_path();
            set_include_path(join(PATH_SEPARATOR, $paths));
            spl_autoload_register(__CLASS__ . "::_autoload");
        }

        /**
         * Class autoload loader.
         * This method is provided to be invoked within an __autoload() magic method.
         * @param string $className class name
         * @return boolean whether the class has been loaded successfully
         */
        protected static function _autoload($class) {
            $paths = explode(PATH_SEPARATOR, get_include_path());
            $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
            $file = strtolower(str_replace("\\", DIRECTORY_SEPARATOR, trim($class, "\\"))) . ".php";

            foreach ($paths as $path) {
                $combined = $path . DIRECTORY_SEPARATOR . $file;

                if (file_exists($combined)) {
                    include($combined);
                    return;
                }
                //echo ($combined). ' - '.file_exists($combined) .'<br>';
            }
           // die($class);
            throw new Exception("{$class} not found");
        }

        /**
         * Clean Array
         * This method is provided to clean the array.
         * @param string $className class name
         * @return boolean whether the class has been loaded successfully
         */
        protected static function _clean($array) {
            if (is_array($array)) {
                return array_map(__CLASS__ . "::_clean", $array);
            }
            return stripslashes($array);
        }

    }

}

?>
