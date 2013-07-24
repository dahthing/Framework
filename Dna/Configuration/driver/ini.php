<?php

/**
 * Ini Driver class file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 */
/**
 * Ini Driver is a helper class serving common framework functionalities.
 *
 * Do not use DnaBase directly. Instead, use its child class {@link \Dna\Configuration\Driver} where
 * you can customize methods of DnaBase.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @package system.configuration.driver
 * @since 1.0
 */

namespace Dna\Configuration\Driver {

    use Dna\Utils\ArrayMethods as ArrayMethods;
    
    use Dna\Configuration as Config;
    
    
    use Dna\Configuration\Exception as Exception;
    

    class Ini extends Config\Driver {

        protected function _pair($config, $key, $value) {
            if (strstr($key, ".")) {
                $parts = explode(".", $key, 2);

                if (empty($config[$parts[0]])) {
                    $config[$parts[0]] = array();
                }

                $config[$parts[0]] = $this->_pair($config[$parts[0]], $parts[1], $value);
            } else {
                $config[$key] = $value;
            }

            return $config;
        }

        public function parse($path) {
            if (empty($path)) {
                throw new Exception\Argument("\$path argument is not valid");
            }

            if (!isset($this->_parsed[$path])) {
                $config = array();

                ob_start();
                include("{$path}.ini");
                $string = ob_get_contents();
                ob_end_clean();

                $pairs = parse_ini_string($string);

                if ($pairs == false) {
                    throw new Exception\Syntax("Could not parse configuration file");
                }

                foreach ($pairs as $key => $value) {
                    $config = $this->_pair($config, $key, $value);
                }

                $this->_parsed[$path] = ArrayMethods::toObject($config);
            }


            return $this->_parsed[$path];
        }

    }

}
?>
