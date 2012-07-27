<?php
class Data_Access_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $datasetWielder;
    
    private $typeFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Service_Interface_DatasetWielder $datasetWielder,
        Data_Type_Factory $typeFactory
    ) {
        
        $this->datasetWielder = $datasetWielder;
        
        $this->typeFactory = $typeFactory;

        $this->uniqueInstances = array();

    }
    
    /**
     *
     * @return Data_Access_Graph_Factory
     */
    public function makeGraphFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Factory(
                $this->datasetWielder,
                $this->typeFactory->makeGraphFactory(),
                $this->typeFactory->makePlaneFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}