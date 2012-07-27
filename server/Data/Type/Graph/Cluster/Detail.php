<?php
/**
 * Уточнение. 
 * Характеризует действие. 
 */
class Data_Type_Graph_Cluster_Detail extends Data_Type_Graph_Cluster_Abstract {
    
    private $phrase;
    private $sign;
    private $action;
    private $descriptions;
    private $references;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->phrase = null;
        $this->sign = null;
        $this->action = null;
        $this->descriptions = array();
        $this->references = array();
        
    }
    
    public function setPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        if (!is_null($this->phrase)) {
            throw new Data_Type_Graph_Cluster_Exception('Уточнение может быть названо только одной фразой.');
        }
        
        $this->phrase = $phrase;
        
    }
    
    public function setSign(
        Data_Type_Graph_Cluster_Sign $sign
    ) {
        
        if (!is_null($this->sign)) {
            throw new Data_Type_Graph_Cluster_Exception('У уточнения может быть только один знак.');
        }
        
        $this->sign = $sign;
        
    }
    
    public function setAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        if (!is_null($this->action)) {
            throw new Data_Type_Graph_Cluster_Exception('Уточнение может относиться только к одному действию.');
        }
        
        $this->action = $action;
        
    }
    
    public function addDescription(
        Data_Type_Graph_Cluster_Description $description
    ) {
        
        $this->descriptions[] = $description;
        
    }
    
    public function addReference(
        Data_Type_Graph_Cluster_Reference $reference
    ) {
        
        $this->references[] = $reference;
        
    }
    
    /** @return boolean */
    public function canBeDefinedByTargetIds() {

        return (
                    !is_null($this->phrase) 
        );
        
    }
    
    /** @return array [ 0:[type], 1:[id] ] */
    public function getDefiningTargetTypesAndIds() {
        
        if (is_null($this->phrase)) {
            throw new Data_Type_Graph_Cluster_Exception('Имя автора не может быть определено.');
        }
        
        $targetTypes = array();
        $targetIds = array();
        
        $this->phrase instanceof Data_Type_Graph_Cluster_Interface_Trackable;
        
        $targetTypes[] = $this->phrase->getShortTypeName();
        $targetIds[] = $this->phrase->getId();
   
        return array($targetTypes, $targetIds);
        
    }
    
    public function __toString() {
        
        $string = '';
        
        if (!is_null($this->phrase)) {
            $string .= $this->phrase;
        }
        
        if (!empty($this->descriptions)) {
            foreach ($this->descriptions as $description) {
                $string .= ' '.$description;
            }
        }

        return $string;
        
    }
    
    public function getTypedArray() {
        
        $this->phrase instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
        $typedArray = $this->phrase->getTypedArray();

        $detailType = $this->getShortTypeName();
        if (!in_array($this, $typedArray[$detailType], true)) {
            $typedArray[$detailType][] = $this;
        }
        
        if (!empty($this->descriptions)) {
            foreach ($this->descriptions as $description) {
                $description instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
                $typedArray = array_merge_recursive($typedArray, $description->getTypedArray());
            }
        }
        
        return $typedArray;
        
    }
    
}