<?php
class Model_State_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct(

    ) {

        $this->uniqueInstances = array();

    }
    
    public function makeState() {
        
        return new Model_State_State(
            $this->makeIdentifierFactory(),
            $this->makeConnectionFactory()->makeSpace(),
            $this->makeStructureFactory()
        );
        
    }
    
    public function makeIdentifierFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Identifier_Factory(
                $this->makePlaneFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
    private function makeConnectionFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Connection_Factory(
                $this->makePlaneFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
    private function makePlaneFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Plane_Factory(
                
            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
    public function makeStructureFactory() {

        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_State_Structure_Factory(
                $this->makeIdentifierFactory(),
                $this->makeConnectionFactory()->makeConnectionFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];

    }
    
}