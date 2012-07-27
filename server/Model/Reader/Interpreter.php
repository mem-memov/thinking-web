<?php
class Model_Reader_Interpreter {
    
    private $annotatedTree;
    private $errors;
    
    public function __construct(
            Model_Reader_SyntaxAnalysis_SyntaxAnalysis $syntaxAnalysis
    ) {

        $this->annotatedTree = $syntaxAnalysis->getAnnotatedTree();
        $this->errors = $syntaxAnalysis->getErrors();

    }

    public function manipulate(Model_Reader_ReaderInterface $executor) {
        //var_dump($this->annotatedTree);
        $this->annotatedTree->translate($executor);

        //var_dump($executor);
        
        return $executor;
        
    }
    
    public function getErrors() {
        
        return $this->errors;
        
    }
 
}