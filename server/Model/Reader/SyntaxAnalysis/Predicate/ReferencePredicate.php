<?php
class Model_Reader_SyntaxAnalysis_Predicate_ReferencePredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {
        
        $referenceIdVariable = $translator->addReference();
        
        $translator->beginReferenceBody($referenceIdVariable);

        // предложения
        foreach ($this->arguments[0] as $proposition) {

            $propositionIdVariable = $proposition->translate($translator);
            $translator->addPropositionToReference($propositionIdVariable, $referenceIdVariable);
            
        }

        return $referenceIdVariable;
        
    }
    
}