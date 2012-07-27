<?php
class Data_Type_Graph_Cluster_Collaborator_OrderedTypeId 
extends Data_Type_Graph_Cluster_Collaborator_TypeId
implements Data_Type_Graph_Cluster_Interface_OrderedTypeId
{

    protected $number;
    private $separator = '-';
    
    public function setNumber($number) {
        
        if (!is_null($this->number)) {
            throw new Data_Type_Graph_Cluster_Exception('Допустим лишь один порядковый номер.');
        }
        
        $this->number = $number;
        
    }
    
    public function getShortTypeName() {
       
        return $this->plane->getName().$this->separator.$this->number;
        
    }
    
    public function setId($id) {

        if (is_null($id)) {
            throw new Data_Type_Graph_Cluster_Exception('Нельзя использовать NULL в качестве кода идентификатора.');
        }
        
        if ($this->isDefined()) {
            throw new Data_Type_Graph_Cluster_Exception('Нельзя устанавливать идентификатор дважды.');
        }
        
        $numberPosition = strpos($id, $this->separator);
        if ($numberPosition !== false) {
            
            $this->id = $id;
            $this->number = substr($id, $numberPosition);
            
        } else {
            
            if (!is_null($this->number)) {
                $this->id = $id.$this->separator.$this->number;
            } else {
                throw new Data_Type_Graph_Cluster_Exception('Идентификатор композиции не содержит порядковый номер.');
            }
            
        }

    }
    
}
