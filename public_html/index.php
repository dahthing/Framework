<?php
/**
 * Index file.
 *
 * @author Rui Guedes <rpgprogramacao@gmail.com>
 * @link http://www.rpwebprojects.com/
 * @copyright Copyright &copy; 2013 Rp Web Projects Software LLC
 * @license http://www.rpwebprojects.com/license/
 * @package Public
 * @since 1.0
 */

try{

    require(dirname(dirname(__FILE__))."/Dna/Dna.php");
    Dna\Dna::initialize();
    
    // configuration
    $configuration = new Dna\Configuration\Configuration(array(
        "type" => "ini"
    ));
    \Dna\RegistryManager\Registry::set("configuration", $configuration->initialize());
    
}catch (Exception $e){

    $exceptions = array(
        "500" => array(
            "Dna\Cache\Exception",
            "Dna\Cache\Exception\Argument",
            "Dna\Cache\Exception\Implementation",
            "Dna\Cache\Exception\Service",
            
            "Dna\Configuration\Exception",
            "Dna\Configuration\Exception\Argument",
            "Dna\Configuration\Exception\Implementation",
            "Dna\Configuration\Exception\Syntax",
            
            "Dna\Controller\Exception",
            "Dna\Controller\Exception\Argument",
            "Dna\Controller\Exception\Implementation",
            
            "Dna\Core\Exception",
            "Dna\Core\Exception\Argument",
            "Dna\Core\Exception\Implementation",
            "Dna\Core\Exception\Property",
            "Dna\Core\Exception\ReadOnly",
            "Dna\Core\Exception\WriteOnly",
            
            "Dna\Database\Exception",
            "Dna\Database\Exception\Argument",
            "Dna\Database\Exception\Implementation",
            "Dna\Database\Exception\Service",
            "Dna\Database\Exception\Sql",
            
            "Dna\Model\Exception",
            "Dna\Model\Exception\Argument",
            "Dna\Model\Exception\Connector",
            "Dna\Model\Exception\Implementation",
            "Dna\Model\Exception\Primary",
            "Dna\Model\Exception\Type",
            "Dna\Model\Exception\Validation",
            
            "Dna\Request\Exception",
            "Dna\Request\Exception\Argument",
            "Dna\Request\Exception\Implementation",
            "Dna\Request\Exception\Response",
            
            "Dna\Router\Exception",
            "Dna\Router\Exception\Argument",
            "Dna\Router\Exception\Implementation",
            
            "Dna\Session\Exception",
            "Dna\Session\Exception\Argument",
            "Dna\Session\Exception\Implementation",
            
            "Dna\Template\Exception",
            "Dna\Template\Exception\Argument",
            "Dna\Template\Exception\Implementation",
            "Dna\Template\Exception\Parser",
            
            "Dna\View\Exception",
            "Dna\View\Exception\Argument",
            "Dna\View\Exception\Data",
            "Dna\View\Exception\Implementation",
            "Dna\View\Exception\Renderer",
            "Dna\View\Exception\Syntax"
        ),
        "404" => array()
    );
    
    $exception = get_class($e);

    \Dna\Utils\VarDumper::dump($e);
    
}

?>