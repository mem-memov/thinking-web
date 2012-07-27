<?php
class Data_Type_Graph_Cluster_Phrase 
extends Data_Type_Graph_Cluster_Abstract 
implements Data_Type_Graph_Cluster_Interface_TypedArrayProvider
{
    
    /** @var Data_Type_Graph_Cluster_Detail|Data_Type_Graph_Cluster_Description|Data_Type_Graph_Cluster_Author|Data_Type_Graph_Cluster_Action|null */
    private $higherCluster;
    
    /** @var Data_Type_Graph_Cluster_Composition[] */
    private $compositions;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->higherCluster = null;
        $this->compositions = array();
        
    }
    
    
    
    public function addComposition(
        Data_Type_Graph_Cluster_Composition $composition
    ) {

        $this->compositions[] = $composition;
        
    }
    
    public function setAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $action;
        
    }
    
    public function setAuthor(
        Data_Type_Graph_Cluster_Author $author
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $author;
        
    }
    
    public function setDescription(
        Data_Type_Graph_Cluster_Description $description
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $description;
        
    }
    
    public function setDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        $this->checkHigherCluster();
        
        $this->higherCluster = $detail;
        
    }
    
    /** @return boolean */
    public function canBeDefinedByTargetIds() {

        return (
                    !empty($this->compositions) 
        );
        
    }
    
    /** @return array [ 0:[type], 1:[id] ] */
    public function getDefiningTargetTypesAndIds() {
        
        if (empty($this->compositions)) {
            throw new Data_Type_Graph_Cluster_Exception('Фраза не может быть определена.');
        }
        
        $targetTypes = array();
        $targetIds = array();
        
        foreach ($this->compositions as $composition) {
            
            $composition instanceof Data_Type_Graph_Cluster_Interface_Trackable;
            
            $targetTypes[] = $composition->getShortTypeName();
            $targetIds[] = $composition->getId();
            
        }

        return array($targetTypes, $targetIds);
        
    }
    
    public function __toString() {
        
        $string = '';
        
        foreach ($this->compositions as $composition) {
            $string .= ' '.$composition;
        }

        return $string;
        
    }
    
    public function getTypedArray() {
        
        $typedArray = array();
        foreach ($this->compositions as $composition) {
            $composition instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
            $typedArray = array_merge_recursive($typedArray, $composition->getTypedArray());
        }

        
        $phraseType = $this->getShortTypeName();
        if (
                !array_key_exists($phraseType, $typedArray) 
            ||  !in_array($this, $typedArray[$phraseType], true)
        ) {
            $typedArray[$phraseType][] = $this;
        }
        
        return $typedArray;
        
    }
    
    
    private function checkHigherCluster() {
        
        if (!is_null($this->higherCluster)) {
            throw new Data_Type_Graph_Cluster_Exception('Фраза может быть связана лишь с одним членом предложения.');
        }
        
    }
    
}