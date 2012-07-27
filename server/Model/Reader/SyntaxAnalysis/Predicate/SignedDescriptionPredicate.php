<?php
class Model_Reader_SyntaxAnalysis_Predicate_SignedDescriptionPredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        // определяем определение
        $descriptionIdVariable = $this->arguments[0]->translate($translator);

        // определяем знак
        $signIdVaraiable = $this->arguments[1]->translate($translator);

        // добавляем знак к определению
        $translator->addSignToDescription($signIdVaraiable, $descriptionIdVariable);
        
        return $descriptionIdVariable;
        
    }
    
}