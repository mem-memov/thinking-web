<?php
class Model_State_Identifier_Identifier 
implements 
    Service_Interface_Identifier 
{
    
    private $plane;
    private $id;
    
    public function __construct(
        Model_State_Plane_AbstractPlane $plane
    ) {
        
        $this->id = null;
        $this->plane = $plane;
        
    }
    
    // Service_Interface_Identifier: START
    
    public function isDefined() {
        
        return (!is_null($this->id));
        
    }
    
    public function setId($id) {
        
        if (is_null($id)) {
            throw new Model_State_Identifier_Exception('Нельзя использовать NULL в качестве кода идентификатора.');
        }
        
        if ($this->isDefined()) {
            throw new Model_State_Identifier_Exception('Нельзя устанавливать идентификатор дважды.');
        }
        
        $this->id = $id;
        
    }

    public function getId() {
        
        if (!$this->isDefined()) {
            throw new Model_State_Identifier_Exception('Обнаружена попытка использования неустановленного идентификатора.');
        }
        
        return $this->id;
        
    }
    
    public function getType() {
            
        return $this->plane->getName();
        
    }
    
    public function isProgressive() {
       
        return $this->plane->isProgressive();
        
    }
    
    public function isAftermath() {
        
        return $this->plane->isAftermath();
        
    }
    
    public function getProducingTypes() {
        
        return $this->plane->getProducingTypes();
        
    }
    
    // Service_Interface_Identifier: END
    

    

    
}