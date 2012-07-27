<?php
class Service_Redis_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки Redis
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

            $this->instances[$instance_key] = new Service_Redis_DatasetWielder(
                $this->makeRedis()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    private function makeRedis() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $redis = new Service_Redis_Redis(
                $this->configuration['host'],
                $this->configuration['port']
            );
            
            $redis->Select($this->configuration['database']);
            
            $this->instances[$instance_key] = $redis;
            
        }

        return $this->instances[$instance_key];
        
    }
    
    
}