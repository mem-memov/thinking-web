<?php
class Model_Reader_SyntaxAnalysis_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $lexicalAnalysisFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Model_Reader_LexicalAnalysis_Factory $lexicalAnalysisFactory
    ) {

        $this->uniqueInstances = array();
        $this->lexicalAnalysisFactory = $lexicalAnalysisFactory;

    }
    
    
    public function makeSyntaxAnalysis(Model_Reader_Message $message) {
        
        return new Model_Reader_SyntaxAnalysis_SyntaxAnalysis(
            $this->lexicalAnalysisFactory->makeLexicalAnalysis($message),
            $this->makeSyntaxErrorFactory(),
            $this->makePredicateFactory()
        );
        
    }

    private function makeSyntaxErrorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_SyntaxAnalysis_Error_SyntaxErrorFactory(

            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    private function makePredicateFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Model_Reader_SyntaxAnalysis_Predicate_PredicateFactory(

            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}