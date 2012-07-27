<?php
class Model_Reader_SyntaxAnalysis_Predicate_SignedActionPredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        // определяем действие
        $actionIdVariable = $this->arguments[0]->translate($translator);
        
        // определяем знак
        $signIdVaraiable = $this->arguments[1]->translate($translator);
        
        // добавляем знак к действию
        $translator->addSignToAction($signIdVaraiable, $actionIdVariable);
        
        return $actionIdVariable;
        
    }
    
}