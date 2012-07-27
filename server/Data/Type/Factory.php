<?php
class Data_Type_Factory {
    
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
    
    /**
     *
     * @return Data_Type_Graph_Factory
     */
    public function makeGraphFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Factory(
                $this->makeplaneFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Data_Type_Plane_Factory
     */
    public function makePlaneFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Plane_Factory(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}