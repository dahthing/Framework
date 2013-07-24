<?php

/**
 * DNA bootstrap file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 */
/**
 * Base is the base class for all application classes.
 *
 * An application serves as the global context that the user request
 * is being processed. It manages a set of application components that
 * provide specific functionalities to the whole application.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @package system.base
 * @since 1.0
 */

namespace Dna\Base {

    use Dna\Utils\ArrayMethods as ArrayMethods;
    use Dna\Utils\StringMethods as StringMethods;
    use Dna\Core\Exception as Exception;

    class Base {

        public function __construct($options = array()) {
            if (is_array($options) || is_object($options)) {
                foreach ($options as $key => $value) {
                    $key = ucfirst($key);
                    $method = "set{$key}";
                    $this->$method($value);
                }
            }
        }

        public function __call($name, $arguments) {
            $getMatches = StringMethods::match($name, "^get([a-zA-Z0-9]+)$");
            if (sizeof($getMatches) > 0) {
                $normalized = lcfirst($getMatches[0]);
                $property = "_{$normalized}";

                if (property_exists($this, $property)) {
                    if (isset($this->$property)) {
                        return $this->$property;
                    }

                    return null;
                }
            }

            $setMatches = StringMethods::match($name, "^set([a-zA-Z0-9]+)$");
            if (sizeof($setMatches) > 0) {
                $normalized = lcfirst($setMatches[0]);
                $property = "_{$normalized}";

                if (property_exists($this, $property)) {
                    $this->$property = $arguments[0];
                    return $this;
                }
            }

            throw $this->_getExceptionForImplementation($name);
        }

        public function __get($name) {
            $function = "get" . ucfirst($name);
            return $this->$function();
        }

        public function __set($name, $value) {
            $function = "set" . ucfirst($name);
            return $this->$function($value);
        }

        protected function _getExceptionForReadonly($property) {
            return new Exception\ReadOnly("{$property} is read-only");
        }

        protected function _getExceptionForWriteonly($property) {
            return new Exception\WriteOnly("{$property} is write-only");
        }

        protected function _getExceptionForProperty() {
            return new Exception\Property("Invalid property");
        }

        protected function _getExceptionForImplementation($method) {
            return new Exception\Argument("{$method} method not implemented");
        }

    }

}

?>
