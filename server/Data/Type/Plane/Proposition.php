<?php
class Data_Type_Plane_Proposition 
implements Data_Type_Plane_Interface_Named
{
    
    public function getName() {
        
        return 'proposition';
    
    }
    
    public function isProgressive() {
        
        return true;
        
    }
    
}
