<?php
class Model_Reader_LexicalAnalysis_LexicalAnalysis {

    private $cleanText;
    private $textFormat;
    private $tokenFactory;
    private $actionListFactory;
    private $tokens;
    private $errors;

    public function __construct(
        Model_Reader_TextFormat_CleanText $cleanText,
        Model_Reader_TextFormat_TextFormat $textFormat,
        Model_Reader_LexicalAnalysis_Token_TokenFactory $tokenFactory,
        Model_Reader_LexicalAnalysis_ActionList_ActionListFactory $actionListFactory
    ) {

        $this->cleanText = $cleanText;
        $this->textFormat = $textFormat;
        $this->tokenFactory = $tokenFactory;
        $this->actionListFactory = $actionListFactory;
        $this->tokens = array();
        $this->errors = array();

        $this->analize();

    }

    public function getTokens() {

        return $this->tokens;

    }

    public function getErrors() {

        return $this->errors;

    }

    private function analize() {

        
        $textIsClean = $this->clean();

        if (!$textIsClean) {
            var_dump($this->errors);
            return;
        }
        
        
        $actionList = $this->getActionList();
        

        $depth = 0;
        foreach ($this->cleanText->getLines() as $line) {

            if (!($line instanceof Model_Reader_TextFormat_TextPart_Line)) {
                throw new Model_Reader_LexicalAnalysis_Exception('Неверный тип строки.');
            }
            
            // расставляем скобки
            
            $depthDifference = $line->getDepth() - $depth;

            if ($depthDifference > 0) {

                $this->tokens[] = $this->tokenFactory->makeLeftBracketToken();
                
            } elseif ($depthDifference < 0) {

                for ($i = $depthDifference; $i < 0; $i++) {

                    $this->tokens[] = $this->tokenFactory->makeRightBracketToken();
                }
                
            }
            

            
            // определяем автора по началу сообщения
            if ($line->getDepth() == 0 && $line->getNumber() == 0) {
                $this->tokens[] = $this->tokenFactory->makeAuthorToken($line->getPhrase());
                $this->tokens[] = $this->tokenFactory->makeLeftBracketToken();
            }
            
            // определяем действие по началу строки
            if ($line->getDepth() == 0 && $line->getNumber() > 0) {
                $this->tokens[] = $this->tokenFactory->makeActionToken($line->getPhrase());
                $actionList->addAction($line->getPhrase());
            }

            // в глубине вложенной структуры
            if ($line->getDepth() > 0 && $line->getNumber() > 1) {
                
                if ($actionList->isAction($line->getPhrase())) {
                    // определяем действие по списку
                    $this->tokens[] = $this->tokenFactory->makeActionToken($line->getPhrase());
                } else {
                    // остальные - уточнения
                    $this->tokens[] = $this->tokenFactory->makeDetailToken($line->getPhrase());
                }
                
                
            }
            
            // ставим знак
            if ($line->hasSign()) {
                $this->tokens[] = $this->tokenFactory->makeSignToken($line->getSign());
            }

            
            $depth = $line->getDepth();

        }
        
        if ($depth > 0) {
            for ($i = 0; $i < $depth; $i++) {
                $this->tokens[] = $this->tokenFactory->makeRightBracketToken();
            }
        }
        
        $this->tokens[] = $this->tokenFactory->makeRightBracketToken();

        /*
        $test = '';
        foreach($this->tokens as $token) {
            $test .= ' '.$token->getName();
        }
        var_dump($test);
        */

    }

    private function clean() {
        
        $this->cleanText->removeDirtySpots($this->textFormat->getErrors());
        $this->errors = $this->cleanText->getSevereErrors();
        
        return empty($this->errors);
        
    }
    
    private function getActionList() {
        
        $phrases = array();
        foreach ($this->cleanText->getLines() as $line) {
            if ($line->getDepth() > 0) { // в начале строки без табуляции либо автор, либо действие
                $phrases[] = $line->getPhrase();
            }
        }
        $actionList = $this->actionListFactory->makeActionList($phrases);
        
        return $actionList;
        
    }

}