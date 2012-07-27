<?php
class Model_Reader_SyntaxAnalysis_Predicate_SignedDetailPredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        // определяем уточнение
        $detailIdVariable = $this->arguments[0]->translate($translator);

        // определяем знак
        $signIdVaraiable = $this->arguments[1]->translate($translator);

        // добавляем знак к уточнению
        $translator->addSignToDetail($signIdVaraiable, $detailIdVariable);
        
        return $detailIdVariable;
        
    }
    
}