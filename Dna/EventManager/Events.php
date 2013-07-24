<?php

/**
 * Event class file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 */


/**
 * Event is the base class for all event classes.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @package system.eventmanager
 * @since 1.0
 */

namespace Dna\EventManager{
    
    class Events {

        private static $_callbacks = array();

        private function __construct() {
            // do nothing
        }

        private function __clone() {
            // do nothing
        }

        public static function add($type, $callback) {
            if (empty(self::$_callbacks[$type])) {
                self::$_callbacks[$type] = array();
            }

            self::$_callbacks[$type][] = $callback;
        }

        public static function fire($type, $parameters = null) {
            if (!empty(self::$_callbacks[$type])) {
                foreach (self::$_callbacks[$type] as $callback) {
                    call_user_func_array($callback, $parameters);
                }
            }
        }

        public static function remove($type, $callback) {
            if (!empty(self::$_callbacks[$type])) {
                foreach (self::$_callbacks[$type] as $i => $found) {
                    if ($callback == $found) {
                        unset(self::$_callbacks[$type][$i]);
                    }
                }
            }
        }

    }
}

?>
