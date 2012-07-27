<?php
abstract class Data_Type_Graph_Cluster_Abstract 
implements 
    Data_Type_Graph_Cluster_Interface_Definable,
    Data_Type_Graph_Cluster_Interface_Checkable,
    Data_Type_Graph_Cluster_Interface_Trackable
{
    
    protected $typeId;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        $this->typeId = $typeId;

    }
    
    public function isDefined() {
        
        return $this->typeId->isDefined();;
        
    }
    
    public function setId($id) {
        
        $this->typeId->setId($id);
        
    }

    public function getId() {

        return $this->typeId->getId();
        
    }
    
    public function getShortTypeName() {
        
        return $this->typeId->getShortTypeName();
        
    }

    public function getDefiningTargetTypesAndIds() {} //TODO: удалить строку
    public function canBeDefinedByTargetIds() {} //TODO: удалить строку 
 
}