<?php
class Model_State_Plane_Object extends Model_State_Plane_AbstractPlane {
    
    public function getName() {
        
        return 'object';
    
    }
    
    public function isAftermath() {
        
        return true;
        
    }
    
}
