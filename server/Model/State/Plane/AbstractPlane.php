<?php
abstract class Model_State_Plane_AbstractPlane {

    private $producingTypes;
    
    public function __construct(
        
    ) {

        $this->producingTypes = null;
  
    }
    
    abstract public function getName();
    
    public function setProducingTypes(
        array $producingTypes
    ) {
        
        if (!is_null($this->producingTypes)) {
            throw new Model_State_Plane_Exception('Нельзя устанавливать определяющие плоскости дважды.');
        }
        
        $nameChecks = array();
        foreach ($producingTypes as $producingType) {
            if (in_array($producingType, $nameChecks)) {
                throw new Model_State_Plane_Exception('Не может быть двух одинаковых определяющих плоскочей.');
            }
            $nameChecks[] = $producingType;
        }
        
        $this->producingTypes = $producingTypes;
        
    }
   
    /**
     * Образуют ли несколько одинаковых элементов цепочку
     *
     * @return boolean 
     */
    public function isProgressive() {
        
        return false;
        
    }
    
    /**
     * Требет ли анализа предыдущих высказываний
     *
     * @return boolean 
     */
    public function isAftermath() {
        
        return false;
        
    }
    
    /**
     * Какие типы необходимы для распознавания
     * ВНИМАНИЕ! Чтобы распознавание прошло успешно, связи с этими типами должны быть двунаправленными
     *
     * @return array 
     */
    public function getProducingTypes() {

        if (is_null($this->producingTypes)) {
            
            return array();
            
        } else {
            
            
            return $this->producingTypes;
        }

    }
    
}
