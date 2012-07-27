<?php
/**
 * Композиция слов. Определяет порядок слов внутри фразы.
 */
class Data_Type_Graph_Cluster_Composition 
extends Data_Type_Graph_Cluster_Abstract 
implements Data_Type_Graph_Cluster_Interface_TypedArrayProvider
{

    /** @var Data_Type_Graph_Cluster_Phrase|null */
    private $phrase;

    /** @var Data_Type_Graph_Cluster_Word|null */
    private $word;
    
    /** @var integer порядковй номер внутри фразы */
    private $number;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_OrderedTypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->phrase = null;
        $this->word = null;
        $this->number = null;
        
    }
    
    public function setPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        if (!is_null($this->phrase)) {
            throw new Data_Type_Graph_Cluster_Exception('Композиция слов может быть связана только с одной фразой.');
        }
        
        $this->phrase = $phrase;
        
    }
    
    public function setWord(
        Data_Type_Graph_Cluster_Word $word
    ) {

        if (!is_null($this->word)) {
            throw new Data_Type_Graph_Cluster_Exception('Композоция слов может иметь только одно начальное слово.');
        }
        
        $this->word = $word;
        
    }
    
    public function setNumber(
        $number
    ) {

        $this->typeId instanceof Data_Type_Graph_Cluster_Interface_OrderedTypeId;
        $this->typeId->setNumber($number);
        
    }
    

    
    /** @return boolean */
    public function canBeDefinedByTargetIds() {

        return (
                    !is_null($this->word) 
                &&  !is_null($this->number)
        );
        
    }
    
   
    /** @return array [ 0:[type], 1:[id] ] */
    public function getDefiningTargetTypesAndIds() {
        
        if (is_null($this->word) || is_null($this->number)) {
            throw new Data_Type_Graph_Cluster_Exception('Композиция слов не может быть определена.');
        }
        
        $targetTypes = array();
        $targetIds = array();
        
        $this->word instanceof Data_Type_Graph_Cluster_Interface_Trackable;
        
        $targetTypes[] = $this->word->getShortTypeName();
        $targetIds[] = $this->word->getId();

        return array($targetTypes, $targetIds);
        
    }
    
    public function __toString() {
        
        $string = '';
        
        $string .= $this->word->getId();

        
        return $string;
        
    }
    
    public function getTypedArray() {
        
        $typedArray = array();

        $wordType = $this->word->getShortTypeName();
        if (
                !array_key_exists($wordType, $typedArray) 
            ||  !in_array($this->word, $typedArray[$wordType], true)
        ) {
            $typedArray[$wordType][] = $this->word;
        }
        
        $compositionType = $this->getShortTypeName();
        if (
                !array_key_exists($compositionType, $typedArray)  
            ||  !in_array($this, $typedArray[$compositionType], true)
        ) {
            $typedArray[$compositionType][] = $this;
        }
        
        return $typedArray;
        
    }

}