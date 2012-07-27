<?php
class Model_Reader_LexicalAnalysis_ActionList_ActionList {
    
    private $actions;
    
    private $actionSniffer;
    
    public function __construct(
        array $phrases,
        Model_ActionSniffer $actionSniffer
    ) {
        
        $this->actionSniffer = $actionSniffer;
        
        $this->actions = array();
        
        $this->fillActions($phrases);
        
        
    }
    
    public function isAction($phrase) {
        
        return in_array($phrase, $this->actions);
        
    }
    
    /**
     * Для добавления действия, названия которого стоит в начале строки текущего сообщения без табуляции
     *
     * @param string $phrase 
     */
    public function addAction($phrase) {
        
        if (!in_array($phrase, $this->actions)) {
            $this->actions[] = $phrase;
        }
        
    }
    
    private function fillActions(array $phrases) {
        
        foreach ($phrases as $phrase) {
            
            $words = explode(' ', $phrase);

            if ($this->actionSniffer->isAction($words)) {
                $this->actions[] = $phrase;
                break;
            }
            
        }

        
    }
    
}