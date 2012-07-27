<?php
class Data_Type_Graph_Cluster_Collaborator_TypeId 
implements Data_Type_Graph_Cluster_Interface_TypeId
{

    protected $id;
    
    protected $plane;
    
    public function __construct(
        Data_Type_Plane_Interface_Named $plane
    ) {
        
        $this->plane = $plane;
        
        $this->id = null;

    }
    
    public function isDefined() {
        
        return (!is_null($this->id));
        
    }
    
    public function setId($id) {
        
        if (is_null($id)) {
            throw new Data_Type_Graph_Cluster_Exception('Нельзя использовать NULL в качестве кода идентификатора.');
        }
        
        if ($this->isDefined()) {
            throw new Data_Type_Graph_Cluster_Exception('Нельзя устанавливать идентификатор дважды.');
        }
        
        $this->id = $id;
        
    }

    public function getId() {
        
        if (!$this->isDefined()) {
            throw new Data_Type_Graph_Cluster_Exception('Обнаружена попытка использования неустановленного идентификатора.');
        }
        
        return $this->id;
        
    }
    
    public function getShortTypeName() {
        
        return $this->plane->getName();
        
    }
    
}
