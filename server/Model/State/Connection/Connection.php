<?php
class Model_State_Connection_Connection {
    
    private $origin;
    private $target;
    
    public function __construct(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {

        $this->origin = $origin;
        $this->target = $target;

    }
    
    public function getOrigin() {
        
        return $this->origin;
        
    }
    
    public function getTarget() {
        
        return $this->target;
        
    }
    
    public function getOriginType() {
        
        return $this->origin->getType();
        
    }
    
    public function getTargetType() {
        
        return $this->target->getType();
        
    }

}
