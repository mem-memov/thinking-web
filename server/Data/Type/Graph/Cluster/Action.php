<?php
class Data_Type_Graph_Cluster_Action 
extends Data_Type_Graph_Cluster_Abstract 
implements Data_Type_Graph_Cluster_Interface_TypedArrayProvider
{
    
    private $phrase;
    private $sign;
    private $details;
    private $proposition;
    private $interactions;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->phrase = null;
        $this->sign = null;
        $this->details = array();
        $this->proposition = null;
        $this->interactions = array();
        
    }
    
    public function setPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        if (!is_null($this->phrase)) {
            throw new Data_Type_Graph_Cluster_Exception('Действие может быть названо только одной фразой.');
        }
        
        $this->phrase = $phrase;
        
    }
    
    public function setSign(
        Data_Type_Graph_Cluster_Sign $sign
    ) {
        
        if (!is_null($this->sign)) {
            throw new Data_Type_Graph_Cluster_Exception('У действия может быть только один знак.');
        }
        
        $this->sign = $sign;
        
    }
    
    public function addDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        $this->details[] = $detail;
        
    }
    
    public function setProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        if (!is_null($this->proposition)) {
            throw new Data_Type_Graph_Cluster_Exception('Действие может входить только в состав одного предложения.');
        }
        
        $this->proposition = $proposition;
        
    }
    
    public function addInteraction(
        Data_Type_Graph_Cluster_Interaction $iteraction
    ) {
        
        $this->iteractions[] = $iteraction;
        
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

        return $string;
        
    }
    
    public function getTypedArray() {
        
        $this->phrase instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
        $typedArray = $this->phrase->getTypedArray();

        $actionType = $this->getShortTypeName();
        if (
                !array_key_exists($actionType, $typedArray) 
            ||  !in_array($this, $typedArray[$actionType], true)
        ) {
            $typedArray[$actionType][] = $this;
        }
        
        if (!empty($this->details)) {
            foreach ($this->details as $detail) {
                $detail instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
                $typedArray = array_merge_recursive($typedArray, $detail->getTypedArray());
            }
        }
        
        return $typedArray;
        
    }
    
    
}