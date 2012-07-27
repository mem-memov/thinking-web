<?php
class Model_Reader_SyntaxAnalysis_Predicate_InteractionPredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {

        $interactionIdVariable = $translator->addInteraction();
        
        $translator->beginInteractionBody($interactionIdVariable);

        // предложения
        foreach ($this->arguments[0] as $proposition) {

            $propositionIdVariable = $proposition->translate($translator);
            $translator->addPropositionToInteraction($propositionIdVariable, $interactionIdVariable);
            
        }

        return $interactionIdVariable;
        
    }
    
}