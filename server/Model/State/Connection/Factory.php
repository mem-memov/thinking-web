<?php
class Model_State_Connection_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct() {

        $this->uniqueInstances = array();

    }
    
    public function makeSpace() {
        
        return new Model_State_Connection_Space(
            $this->makeGroundFactory()
        );
        
    }
    
    private function makeGroundFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Connection_GroundFactory(
                $this->makeClusterFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Model_State_Connection_ConnectionFactory
     */
    public function makeConnectionFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Connection_ConnectionFactory(

            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    

    /**
     *
     * @return Model_State_Connection_ConnectionFactory
     */
    private function makeClusterFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Connection_ClusterFactory(
                $this->makeConnectionFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

    
}