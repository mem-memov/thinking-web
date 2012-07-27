<?php
class Service_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки сервисов
     *
     * @var array
     */
    private $configuration;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;

    }
    
    public function makeDatasetWielder() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $redisFactory = new Service_Redis_Factory($this->configuration['Redis']);
            
            $this->instances[$instance_key] = $redisFactory->makeDatasetWielder();
            
        }

        return $this->instances[$instance_key];
        
    }
    
}