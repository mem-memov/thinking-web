<?php
class Data_Type_Graph_Cluster_Collaborator_HelpfulOrderedTypeId 
extends Data_Type_Graph_Cluster_Collaborator_OrderedTypeId
implements Data_Type_Graph_Cluster_Interface_HelpfulOrderedTypeId
{
    
    public function canProvideNextNumber() {
        
        return !is_null($this->number);
        
    }
    
    public function provideNextNumber() {
        
        if (is_null($this->number)) {
            throw new Data_Type_Graph_Cluster_Exception('Следующий номер не может быть предоставлен.');
        }
        
        return $this->number + 1;
        
    }
    
}


