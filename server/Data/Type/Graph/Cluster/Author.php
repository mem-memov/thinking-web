<?php
class Data_Type_Graph_Cluster_Author extends Data_Type_Graph_Cluster_Abstract {
    
    private $phrase;
    private $messages;
    private $propositions;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->phrase = null;
        $this->messages = array();
        $this->propositions = array();
        
    }
    
    
    
    public function setPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        if (!is_null($this->phrase)) {
            throw new Data_Type_Graph_Cluster_Exception('Имя автора обозначается только одной фразой.');
        }
        
        $this->phrase = $phrase;
        
    }
    
    public function addMessage(
        Data_Type_Graph_Cluster_Message $message
    ) {
        
        $this->messages[] = $message;
        
    }
    
    public function addProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        $this->propositions[] = $proposition;
        
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
    
}