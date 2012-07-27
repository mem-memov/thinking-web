<?php
/**
 * Описание. Характеризует уточнение дейставия. 
 */
class Data_Type_Graph_Cluster_Description 
extends Data_Type_Graph_Cluster_Abstract 
implements Data_Type_Graph_Cluster_Interface_TypedArrayProvider
{
    
    private $phrase;
    private $sign;
    private $detail;
    private $subdescriptions;
    private $superdescription;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_HelpfulOrderedTypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->phrase = null;
        $this->sign = null;
        $this->detail = null;
        $this->subdescriptions = array();
        $this->superdescription = null;
        
    }
    
    public function setPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        if (!is_null($this->phrase)) {
            throw new Data_Type_Graph_Cluster_Exception('Описание может быть названо только одной фразой.');
        }
        
        $this->phrase = $phrase;
        
    }
    
    public function setSign(
        Data_Type_Graph_Cluster_Sign $sign
    ) {
        
        if (!is_null($this->sign)) {
            throw new Data_Type_Graph_Cluster_Exception('У описания может быть только один знак.');
        }
        
        $this->sign = $sign;
        
    }
    
    public function setDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        if (!is_null($this->detail)) {
            throw new Data_Type_Graph_Cluster_Exception('Описание может относиться только к одному уточнению.');
        }
        
        $this->detail = $detail;
        
    }
    
    public function addSubdescription(
        Data_Type_Graph_Cluster_Description $subdescription
    ) {
        
        $this->subdescriptions[] = $subdescription;
        
    }
    
    public function setDescription(
        Data_Type_Graph_Cluster_Description $description
    ) {
        
        if (!is_null($this->superdescription)) {
            throw new Data_Type_Graph_Cluster_Exception('Описание может относиться только к одному описанию верхнего уровня.');
        }
        
        $this->superdescription = $description;
        
    }
    
    public function setNumber(
        $number
    ) {

        $this->typeId instanceof Data_Type_Graph_Cluster_Interface_OrderedTypeId;
        $this->typeId->setNumber($number);
        
    }
    
    public function canProvideNextNumber() {
        
        return $this->typeId->canProvideNextNumber();
        
    }
    
    public function provideNextNumber() {
        
        return $this->typeId->provideNextNumber();
        
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
        
        if (!empty($this->subdescriptions)) {
            foreach ($this->subdescriptions as $subdescription) {
                $string .= ' '.$subdescription;
            }
        }

        return $string;
        
    }
    
    public function getTypedArray() {
        
        $this->phrase instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
        $typedArray = $this->phrase->getTypedArray();

        $descriptionType = $this->getShortTypeName();
        if (
                !array_key_exists($descriptionType, $typedArray) 
            ||  !in_array($this, $typedArray[$descriptionType], true)
        ) {
            $typedArray[$descriptionType][] = $this;
        }
        
        if (!empty($this->subdescriptions)) {
            foreach ($this->subdescriptions as $subdescription) {
                $subdescription instanceof Data_Type_Graph_Cluster_Interface_TypedArrayProvider;
                $typedArray = array_merge_recursive($typedArray, $subdescription->getTypedArray());
            }
        }
        
        return $typedArray;
        
    }
    
}