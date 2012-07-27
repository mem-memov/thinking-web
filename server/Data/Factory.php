<?php
class Data_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки доступа к данным
     *
     * @var array
     */
    private $configuration;
    
    private $datasetWielder;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration,
        Service_Interface_DatasetWielder $datasetWielder
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;
        $this->datasetWielder = $datasetWielder;

    }
    
    /**
     *
     * @return Data_Access_Factory 
     */
    public function makeAccessFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Factory(
                $this->datasetWielder,
                $this->makeTypeFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Data_Type_Factory
     */
    public function makeTypeFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Factory(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

    
}