<?php

/**
 * DNA bootstrap file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 * @package system
 * @since 1.0
 */

/**
 * Dna is a helper class serving common framework functionalities.
 *
 * It encapsulates {@link DnaBase} which provides the actual implementation.
 * By writing your own Dna class, you can customize some functionalities of DnaBase.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @package system
 * @since 1.0
 */

namespace Dna {
    
    /**
    * Gets the application start timestamp.
    */
   defined('DNA_BEGIN_TIME') or define('DNA_BEGIN_TIME', microtime(true));

   /**
    * This constant defines whether the application should be in debug mode or not. Defaults to false.
    */
   defined('DNA_DEBUG') or define('DNA_DEBUG', true);

   /**
    * Defines the Dna framework installation path.
    */
   defined('DNA_PATH') or define('DNA_PATH', dirname(__DIR__));
   
   if(DNA_DEBUG):
       ini_set('display_errors', 1);
       error_reporting(E_ALL);
   endif;

    require(dirname(__FILE__) . '/DnaBase.php');
    use Dna\DnaBase as DnaBase;

    class Dna extends DnaBase {
        
    }

}

?>
