<?php
class Model_Graph_Structure_MessageLock extends Model_Graph_Structure_Message {
 
    private $isLocked;
    
    public function __construct() {
        
        $this->actions = array();
        $this->author= null;
        $this->communication = null;
        $this->compositions = array();
        $this->descriptions = array();
        $this->details = array();
        $this->interactions = array();
        $this->message = null;
        $this->objects = array();
        $this->phrases = array();
        $this->propositions = array();
        $this->references = array();
        $this->signs = array();
        $this->words = array();
        
        $this->isLocked = false;
        
    }
    
    
    
    public function addAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        $this->checkLock();
        
        $this->actions[] = $action;
        
    }
    
    public function setAuthor(
        Data_Type_Graph_Cluster_Author $author
    ) {
        
        $this->checkLock();
        
        
        if (!is_null($this->author)) {
            throw new Model_Graph_Structure_Exception('Обнаружена попытка повторного определения автора сообщения.');
        }
        
        $this->author = $author;
        
    }
    
    public function setCommunication(
        Data_Type_Graph_Cluster_Communication $communication
    ) {
        
        $this->checkLock();
        
        
        if (!is_null($this->communication)) {
            throw new Model_Graph_Structure_Exception('Сообщение может относиться только к одному разговору.');
        }
        
        $this->communication = $communication;
        
    }
    
    public function addComposition(
        Data_Type_Graph_Cluster_Composition $composition
    ) {
        
        $this->checkLock();
        
        
        $this->compositions[] = $composition;
        
    }
    
    public function addDescription(
        Data_Type_Graph_Cluster_Description $description
    ) {
        
        $this->checkLock();
        
        
        $this->descriptions[] = $description;
        
    }
    
    public function addDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        $this->checkLock();
        
        
        $this->details[] = $detail;
        
    }
    
    public function addInteraction(
        Data_Type_Graph_Cluster_Interaction $interaction
    ) {
        
        $this->checkLock();
        
        
        $this->interactions[] = $interaction;
        
    }

    public function setMessage(
        Data_Type_Graph_Cluster_Message $message
    ) {
        
        $this->checkLock();
        
        
        if (!is_null($this->communication)) {
            throw new Model_Graph_Structure_Exception('Соосщения нельзя переопределять.');
        }
        
        $this->message = $message;
        
    }
    
    public function addObject(
        Data_Type_Graph_Cluster_Object $object
    ) {
        
        $this->checkLock();
        
        
        $this->objects[] = $object;
        
    }
    
    public function addPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        $this->checkLock();
        
        
        $this->phrases[] = $phrase;
        
    }
    
    public function addProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        $this->checkLock();
        
        
        $this->propositions[] = $proposition;
        
    }
    
    public function addReference(
        Data_Type_Graph_Cluster_Reference $reference
    ) {
        
        $this->checkLock();
        
        
        $this->references[] = $reference;
        
    }
    
    public function addSign(
        Data_Type_Graph_Cluster_Sign $sign
    ) {
        
        $this->checkLock();
        
        
        $this->signs[] = $sign;
        
    }
    
    public function addWord(
        Data_Type_Graph_Cluster_Word $word
    ) {
        
        $this->checkLock();
        
        
        $this->words[] = $word;
        
    }
    
    
    public function lock() {
        
        $this->isLocked = true;
        
    }
    
  
    
    
    public function getActions() {
        
        return $this->actions;
        
    }
    
    public function getAuthor() {
        
        return $this->author;
        
    }
    
    public function getCommunication() {
        
        return $this->communication;
        
    }
    
    public function getCompositions() {
        
        return $this->compositions;
        
    }
    
    public function getDescriptions() {
        
        return $this->descriptions;
        
    }
    
    public function getDetails() {
        
        return $this->details;
        
    }
    
    public function getInteractions() {
        
        return $this->interactions;
        
    }
    
    public function getMessage() {
        
        return $this->message;
        
    }
    
    public function getObjects() {
        
        return $this->objects;
        
    }
    
    public function getPhrases() {
        
        return $this->phrases;
        
    }
    
    public function getPropositions() {
        
        return $this->propositions;
        
    }
    
    public function getReferences() {
        
        return $this->references;
        
    }
    
    public function getSigns() {
        
        return $this->signs;
        
    }
    
    public function getWords() {
        
        return $this->words;
        
    }
    
    
    
    public function hasAction(
        Data_Type_Graph_Cluster_Action $action
    ) {
        
        foreach ($this->actions as $thisAction) {
            
            if ($action === $thisAction) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasAuthor(
        Data_Type_Graph_Cluster_Author $author
    ) {

        return ($author === $this->author);
        
    }
    
    public function hasCommunication(
        Data_Type_Graph_Cluster_Communication $communication
    ) {

        return ($communication === $this->communication);
        
    }
    
    public function hasComposition(
        Data_Type_Graph_Cluster_Composition $composition
    ) {
        
        foreach ($this->compositions as $thisComposition) {
            
            if ($composition === $thisComposition) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasDescription(
        Data_Type_Graph_Cluster_Description $description
    ) {
        
        foreach ($this->descriptions as $thisDescription) {
            
            if ($description === $thisDescription) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasDetail(
        Data_Type_Graph_Cluster_Detail $detail
    ) {
        
        foreach ($this->details as $thisDetail) {
            
            if ($detail === $thisDetail) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasInteraction(
        Data_Type_Graph_Cluster_Interaction $interaction
    ) {
        
        foreach ($this->interactions as $thisInteraction) {
            
            if ($interaction === $thisInteraction) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasMessage(
        Data_Type_Graph_Cluster_Message $message
    ) {

        return ($message === $this->message);
        
    }
    
    public function hasObject(
        Data_Type_Graph_Cluster_Object $object
    ) {
        
        foreach ($this->objects as $thisObject) {
            
            if ($object === $thisObject) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasPhrase(
        Data_Type_Graph_Cluster_Phrase $phrase
    ) {
        
        foreach ($this->phrases as $thisPhrase) {
            
            if ($phrase === $thisPhrase) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasProposition(
        Data_Type_Graph_Cluster_Proposition $proposition
    ) {
        
        foreach ($this->propositions as $thisProposition) {
            
            if ($proposition === $thisProposition) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasReference(
        Data_Type_Graph_Cluster_Reference $reference
    ) {
        
        foreach ($this->references as $thisReference) {
            
            if ($reference === $thisReference) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasSign(
        Data_Type_Graph_Cluster_Sign $sign
    ) {
        
        foreach ($this->signs as $thisSign) {
            
            if ($sign === $thisSign) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function hasWord(
        Data_Type_Graph_Cluster_Word $word
    ) {
        
        foreach ($this->words as $thisWord) {
            
            if ($word === $thisWord) {
                return true;
            }
            
        }
        
        return false;
        
    }
    

    
    public function findWordByExample(
        Data_Type_Graph_Cluster_Word $word
    ) {
        
        foreach ($this->words as $thisWord) {
            
            $thisWord instanceof Data_Type_Graph_Cluster_Word;
            
            if ($thisWord->isEqual($word)) {
                return $thisWord;
            }
            
        }
        
        return null;
        
    }
    
    private function checkLock() {
        
        if ($this->isLocked) {
            throw new Model_Graph_Structure_Exception('Нельзя вносить изменения в запертую структуру.');
        }
        
    }

}
