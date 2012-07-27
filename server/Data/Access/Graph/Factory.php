<?php
class Data_Access_Graph_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $datasetWielder;
    
    private $typeFactory;
    
    private $planeFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Service_Interface_DatasetWielder $datasetWielder,
        Data_Type_Graph_Factory $typeFactory,
        Data_Type_Plane_Factory $planeFactory
    ) {

        $this->datasetWielder = $datasetWielder;
        
        $this->typeFactory = $typeFactory;
        
        $this->planeFactory = $planeFactory;
        
        $this->uniqueInstances = array();

    }
    
    /**
     *
     * @return Data_Access_Graph_Cluster_Factory 
     */
    public function makeClusterFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Factory(
                $this->datasetWielder,
                $this->typeFactory->makeClusterFactory(),
                $this->planeFactory
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}