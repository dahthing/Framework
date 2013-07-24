<?php

/**
 * Driver class file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 */
/**
 * Driver is a helper class serving common framework functionalities.
 *
 * Do not use DnaBase directly. Instead, use its child class {@link \Dna\Configuration\Configuration} where
 * you can customize methods of DnaBase.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @package system.configuration
 * @since 1.0
 */

namespace Dna\Configuration {

    use Dna\Base\Base as Base;
    use Dna\Configuration\Exception as Exception;

    class Driver extends Base {

        protected $_parsed = array();

        public function initialize() {
            return $this;
        }

        protected function _getExceptionForImplementation($method) {
            return new Exception\Implementation("{$method} method not implemented");
        }

    }

}

?>
