<?php
class Data_Type_Plane_Object 
implements Data_Type_Plane_Interface_Named
{
    
    public function getName() {
        
        return 'object';
    
    }
    
    public function isAftermath() {
        
        return true;
        
    }
    
}
