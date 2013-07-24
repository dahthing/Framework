<?php

/**
 * Configuration class file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 * @package system.configuration
 * @since 1.0
 */

namespace Dna\Configuration{

    use Dna\Base\Base as Base;
    use Dna\EventManager\Events as Events;
    use Dna\Configuration as Driver;
    use Dna\Configuration\Exception as Exception;
    
    
    class Configuration extends Base {
         
        /**
        * @readwrite
        */
        protected $_type;
        
        /**
        * @readwrite
        */
        protected $_options;
        
        protected function _getExceptionForImplementation($method)
        {
            return new Exception\Implementation("{$method} method not implemented");
        }
        
        public function initialize()
        {
            Events::fire("framework.configuration.initialize.before", array($this->type, $this->options));
            
            if (!$this->type)
            {
                throw new Exception\Argument("Invalid type");
            }
            
            Events::fire("framework.configuration.initialize.after", array($this->type, $this->options));
            
            switch ($this->type)
            {
                case "ini":
                {
                    return new Driver\Driver\Ini($this->options);
                    break;
                }
                default:
                {
                    throw new Exception\Argument("Invalid type");
                    break;
                }
            }
        }
    }
}
?>
