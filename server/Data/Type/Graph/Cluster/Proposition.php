<?php
class Data_Type_Graph_Cluster_Proposition extends Data_Type_Graph_Cluster_Abstract {
    
    private $author;
    private $message;
    private $reference;
    private $actions;
    private $iteraction;
    
    public function __construct(
        Data_Type_Graph_Cluster_Interface_TypeId $typeId
    ) {

        parent::__construct($typeId);
        
        $this->author = null;
        $this->message = null;
        $this->reference = null;
        $this->actions = array();
        $this->iteraction = null;
        
    }
    
    
    
    public function setAuthor(
        Data_Type_Graph_Cluster_Author $author
    ) {
        
        if (!is_null($this->author)) {
            throw new Data_Type_Graph_Cluster_Exception('У предложения есть только один автор.');
        }
        
        $this->author = $author;
        
    }
    
    public function setMessage(
        Data_Type_Graph_Cluster_Message $message
    ) {
        
        if (!is_null($this->message)) {
            throw new Data_Type_Graph_Cluster_Exception('Предложение может быть высказано только в одном сообщении..');
        }
        
        $this->message = $message;
        
    }
    
    public function setReference(
        Data_Type_Graph_Cluster_Reference $reference
    ) {
        
        if (!is_null($this->reference)) {
            throw new Data_Type_Graph_Cluster_Exception('Предложение может входить только в одну.ссылочную конструкцию.');
        }
        
        $this->reference = $reference;
        
    }
    
    public function addAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        $this->actions[] = $action;
        
    }
    
    public function setIteraction(
        Data_Type_Graph_Cluster_Iteraction $interaction
    ) {
        
        if (!is_null($this->interaction)) {
            throw new Data_Type_Graph_Cluster_Exception('Предложение может находиться только внутри одного взаимодействия.');
        }
        
        $this->interaction = $interaction;
        
    }
    
    /** @return boolean */
    public function canBeDefinedByTargetIds() {

        return (
                    !is_null($this->actions) 
        );
        
    }
    
   
    /** @return array [ 0:[type], 1:[id] ] */
    public function getDefiningTargetTypesAndIds() {
        
        if (is_null($this->actions)) {
            throw new Data_Type_Graph_Cluster_Exception('Предложение не может быть определено.');
        }
        
        $targetTypes = array();
        $targetIds = array();
        
        foreach ($this->actions as $action) {
            
            $action instanceof Data_Type_Graph_Cluster_Interface_Trackable;
            
            $targetTypes[] = $action->getShortTypeName();
            $targetIds[] = $action->getId();
            
        }

        return array($targetTypes, $targetIds);
        
    }
    
    public function __toString() {
        
        $string = '';
        
        if (!is_null($this->actions)) {
            foreach ($this->actions as $action) {
                $string .= $action.' ';
            }
        }

        return $string;
        
    }
    
}