<?php
/**
 * Точка входа
 */
ini_set('display_errors', true);

header('Content-type: text/html; charset=utf-8');

require_once('Frontend/Interface/ClassLoader.php');
require_once('Frontend/ClassLoader.php');
require_once('Frontend/Factory.php');

try {

    $data = Frontend_Factory::construct(
        require_once('configuration.php'),
        new Frontend_ClassLoader(
                dirname(__FILE__)
        )
    )->makeController()->process($_POST);
    
} catch (Exception $e) {
    
    echo $e->getMessage();
    exit();
    
}