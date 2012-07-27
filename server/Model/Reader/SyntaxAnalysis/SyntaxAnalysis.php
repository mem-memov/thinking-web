<?php
class Model_Reader_SyntaxAnalysis_SyntaxAnalysis {
    
    private $syntaxErrorFactory;
    private $predicateFactory;
    
    private $tokens;
    private $errors;
    private $done;
    private $pointer;
    private $annotatedTree;


    public function __construct(
        Model_Reader_LexicalAnalysis_LexicalAnalysis $lexicalAnalysis,
        Model_Reader_SyntaxAnalysis_Error_SyntaxErrorFactory $syntaxErrorFactory,
        Model_Reader_SyntaxAnalysis_Predicate_PredicateFactory $predicateFactory
    ) {
        
        $this->syntaxErrorFactory = $syntaxErrorFactory;
        $this->predicateFactory = $predicateFactory;
        
        $this->tokens = $lexicalAnalysis->getTokens();
        $this->errors = $lexicalAnalysis->getErrors();
        $this->done = false;
        $this->pointer = 0;
        $this->annotatedTree = null;
        
        $this->checkTypeOfTokens();
        $this->analize();
    
    }
    
    public function getAnnotatedTree() {
        
        return $this->annotatedTree;
        
    }
    
    public function getErrors() {
        
        return $this->errors;
        
    }
    
    
    private function analize() {

        $this->annotatedTree = $this->message();

    }
    
    // сообщение
    private function message() {

        $author = $this->match('автор');
        
        $this->match('(');
        
        $propositions = array();
        $this->proposition($propositions);
        
        $this->match(')');
        
        return $this
                    ->predicateFactory
                    ->getMessagePredicate()
                    ->addArgument($author)
                    ->addArgument($propositions);

    }
    
    // предложение
    private function proposition(array &$propositions) {
        
        $proposition = $this->predicateFactory->getPropositionPredicate();
        
        if ($this->lookAhead(1, 'знак')) {
            
            $signedAction = $this->signedAction();
            $proposition->addArgument($signedAction);
            
        } else {
            
            $action = $this->match('действие');
            $proposition->addArgument($action);
        
        }

        if ($this->lookAhead(0, '(')) {
            
            $this->match('(');

            if ($this->lookAhead(0, 'действие')) {
 
                $interactions = array();
                $this->interaction($interactions);
                $proposition->addArgument($interactions);
             
            } else {

                $circumstances = array();
                $this->circumstance($circumstances);
                $proposition->addArgument($circumstances);
                
            }
            
            $this->match(')');
            
        } 
        
        $propositions[] = $proposition;
        
        if ($this->lookAhead(0, 'действие')) {
            
            $this->proposition($propositions);
            
        }
        
        
    }
    
    // действие со знаком
    private function signedAction() {

        $action = $this->match('действие');
        $sign = $this->match('знак');
        
        return $this
                    ->predicateFactory
                    ->getSignedActionPredicate()
                    ->addArgument($action)
                    ->addArgument($sign)
        ;
        
    }
    
    // взаимодействие - ссылка на предыдущее действие
    private function interaction(array &$interactions) {
        
        $interaction = $this->predicateFactory->getInteractionPredicate();
        
        $propositions = array();
        $this->proposition($propositions);
        
        $interaction->addArgument($propositions);

        $interactions[] = $interaction;

    }
    
    // уточнение
    private function circumstance(array &$circumstances) {

        $circumstance = $this->predicateFactory->getCircumstancePredicate();
        
        if ($this->lookAhead(1, 'знак')) {
            
            $signedDetail = $this->signedDetail();
            $circumstance->addArgument($signedDetail);
            
        } else {
            
            $detail = $this->match('уточнение');
            $circumstance->addArgument($detail);
        
        }
        
        if ($this->lookAhead(0, '(')) {
            
            $this->match('(');

            if ($this->lookAhead(0, 'действие')) {

                $references = array();
                $this->reference($references);
                $circumstance->addArgument($references);
          
            } else {
                
                $descriptions = array();
                $this->description($descriptions);
                $circumstance->addArgument($descriptions);
                
            }
            
            $this->match(')');
            
        } 
        
        $circumstances[] = $circumstance;
        
        if ($this->lookAhead(0, 'уточнение')) {
            
            $this->circumstance($circumstances);
            
        }
        
    }
    
    private function signedDetail() {

        $detail = $this->match('уточнение');
        $sign = $this->match('знак');
        
        return $this
                    ->predicateFactory
                    ->getSignedDetailPredicate()
                    ->addArgument($detail)
                    ->addArgument($sign)
        ;
        
    }
    
    // ссылка на предыдущее упоминание предмета
    private function reference(array &$references) {
        
        $reference = $this->predicateFactory->getReferencePredicate();
        
        $propositions = array();
        $this->proposition($propositions);
        
        $reference->addArgument($propositions);

        $references[] = $reference;
        
    }
    
    // описание: уточнение уточнения
    private function description(array &$descriptions) {

        $description = $this->predicateFactory->getDescriptionPredicate();
        
        if ($this->lookAhead(1, 'знак')) {
           
            $signedDescription = $this->signedDescription();
            $description->addArgument($signedDescription);
            
        } else {
            
            $detail = $this->match('уточнение');
            $description->addArgument($detail);
        
        }
        
        if ($this->lookAhead(0, '(')) {
            
            $this->match('(');

            if ($this->lookAhead(0, 'действие')) {

                $reference = $this->reference();
                $description->addArgument($reference);
          
            } else {
               
                $subDescriptions = array();
                $this->description($subDescriptions);
                $description->addArgument($subDescriptions);
                
            }
            
            $this->match(')');
            
        }
        
        $descriptions[] = $description;
        
        if ($this->lookAhead(0, 'уточнение')) {

            $this->description($descriptions);
            
        }
   
    }
    
    private function signedDescription() {

        $detail = $this->match('уточнение');
        $sign = $this->match('знак');
        
        return $this
                    ->predicateFactory
                    ->getSignedDescriptionPredicate()
                    ->addArgument($detail)
                    ->addArgument($sign)
        ;
        
    }
    

    
    
    private function checkTypeOfTokens() {
        
        foreach ($this->tokens as $token) {
            
            if (!($token instanceof Model_Reader_LexicalAnalysis_Token_AbstractToken)) {
                throw new Model_Reader_SyntaxAnalysis_Exception('Неверный тип терминала.');
            }
            
        }
        
    }
    
    
    private function match($expectedTokenName) {

        $currentToken = $this->tokens[$this->pointer];
        $currentTokenName = $currentToken->getName();
        
        if ($currentTokenName == $expectedTokenName) {

            $this->pointer++;
            
            if (!array_key_exists($this->pointer, $this->tokens)) {
                
                $this->done = true;
                
            }
            
        } else {
            
            $this->syntaxErrorFactory->makeSyntaxError(
                1, 
                'Ожидался терминал - '.$expectedTokenName.', вместо него - '.$currentTokenName
            );
            
        }
        
        return $currentToken;
        
    }

    private function lookAhead($increment, $tokenName) {
        
        $expectedTokenExists = array_key_exists($this->pointer + $increment, $this->tokens);
        $expectedTokenMatches = $this->tokens[$this->pointer + $increment]->getName() == $tokenName;
      
        return ($expectedTokenExists && $expectedTokenMatches);
        
    }
    
}