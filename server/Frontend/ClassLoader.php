<?php
/**
 * Автозагрузчик файлов с классами 
 */
class Frontend_ClassLoader implements Frontend_Interface_ClassLoader {
    
    /** 
     * Путь к корневому каталогу
     * 
     * @var string  
     */
    private $root;
    
    /**
     * Создаёт экземпляр класса
     *
     * @param string $root путь к корневому каталогу
     */
    public function __construct($root) {
        
        $this->root = $root;
        
    }
    
    /**
     * Регистрирует метод автозагрузки
     */
    public function register() {
        
        spl_autoload_register(array($this, 'autoload'));
        
    }
    
    /**
     * Выполняет автоматическую подгрузку файлов с классами
     * 
     * @param string $class
     * @throws Frontend_Exception
     */
    public function autoload($class) {


        $path = $this->buildUnderscoreClassPath($class);
        if (is_readable($path)) {
            require_once($path);
        } else {
            throw new Frontend_Exception('Файл "'.$path.'" не найден для класса "'.$class.'".');
        }


    }
    
    /**
     * Строит путь к файлу с классом
     *
     * @param string $class
     * @return string 
     */
    private function buildUnderscoreClassPath($class) {

        $path = $this->root.'/'.str_replace('_', '/', $class).'.php';

        return $path;
        
    }
    
}