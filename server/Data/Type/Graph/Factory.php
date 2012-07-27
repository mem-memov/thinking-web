<?php
class Data_Type_Graph_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $planeFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Data_Type_Plane_Factory $planeFactory
    ) {

        $this->uniqueInstances = array();
        
        $this->planeFactory = $planeFactory;

    }
    
    public function makeClusterFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_Factory(
                $this->planeFactory
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}