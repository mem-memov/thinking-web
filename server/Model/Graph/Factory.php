<?php
class Model_Graph_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $clusterTypeFactory;
    private $clusterAccessFactory;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Data_Type_Graph_Cluster_Factory $clusterTypeFactory,
        Data_Access_Graph_Cluster_Factory $clusterAccessFactory
    ) {

        $this->clusterTypeFactory = $clusterTypeFactory;
        $this->clusterAccessFactory = $clusterAccessFactory;
        
        $this->uniqueInstances = array();

    }
    
    /**
     *
     * @return Model_Graph_Structure_Factory
     */
    public function makeStructureFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Graph_Structure_Factory(
                $this->clusterTypeFactory,
                $this->clusterAccessFactory
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}
