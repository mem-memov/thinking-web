<?php
class Frontend_Factory {
    
    /**
     * Единственный экземпляр данного класса в системе
     * 
     * @var Frontend_Factory 
     */
    private static $instance;

    /** 
     * Контейнер для уникальных объектов
     * 
     * @var array  
     */
    private $uniqueInstances;
    
    /** 
     * Путь к корневому каталогу
     * 
     * @var string  
     */
    private $root;
    
    /** 
     * Настройки системы
     * 
     * @var array  
     */
    private $configuration;
    
    /**
     * Создаёт экземпляр класса
     * 
     * @param array $configuration Настройки системы
     * @param Frontend_Interface_ClassLoader $classLoader Автозагрузчик классов
     */
    protected function __construct(
        array $configuration,
        Frontend_Interface_ClassLoader $classLoader
    ) {

        $classLoader->register();
        
        $this->uniqueInstances = array();
        $this->root = dirname(dirname(__FILE__));
        $this->configuration = $configuration;

    }

    /**
     * Возвращает уникальный экземпляр фабрики
     * @param array $configuration Настройки системы
     * @param Frontend_Interface_ClassLoader $classLoader Автозагрузчик классов
     * @return Frontend_Factory
     * @throws Frontend_Exception
     */
    public static function construct(
        array $configuration,
        Frontend_Interface_ClassLoader $classLoader
    ) {

        if (empty(self::$instance)) {
            


            self::$instance = new self($configuration, $classLoader);

        } else {

            throw new Frontend_Exception('Фабрику верхнего слоя можно создавать только один раз.');

        }
        
        return self::$instance;

    }
    
    public function makeController() {
      
        return new Frontend_Controller(
            $this->makeModelFactory()
        );
        
    }
    
    private function makeModelFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            $this->instances[$instance_key] = new Model_Factory(
                $this->configuration['Model'],
                $this->makeDataFactory(),
                $this->makeServiceFactory()
            );
        }

        return $this->instances[$instance_key];
        
    }

    private function makeDataFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $serviceFactory = $this->makeServiceFactory();
            
            $this->instances[$instance_key] = new Data_Factory(
                $this->configuration['Data'],
                $serviceFactory->makeDatasetWielder()
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    private function makeServiceFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            $this->instances[$instance_key] = new Service_Factory(
                $this->configuration['Service']
            );
        }

        return $this->instances[$instance_key];
        
    }

}