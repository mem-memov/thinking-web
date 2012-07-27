<?php
class Model_Reader_SyntaxAnalysis_Predicate_PropositionPredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {

        $propositionIdVariable = $translator->addProposition();
        
        $translator->beginPropositionBody($propositionIdVariable);

        // определяем действие
        $actionIdVariable = $this->arguments[0]->translate($translator);
        
        // добавляем действие в предложение
        $translator->addActionToProposition($actionIdVariable, $propositionIdVariable);
        
        $translator->beginActionBody($actionIdVariable);
        
        // обстоятельства, ссылки на другие действия
        if (array_key_exists(1, $this->arguments)) {

            foreach ($this->arguments[1] as $item) {

                // обстоятельствo
                if ($item instanceof Model_Reader_SyntaxAnalysis_Predicate_CircumstancePredicate) {
                    $detailIdVariable = $item->translate($translator);
                    $translator->addDetailToAction($detailIdVariable, $actionIdVariable);
                }
                
                // взаимодействие
                if ($item instanceof Model_Reader_SyntaxAnalysis_Predicate_InteractionPredicate) {
                    $interactionIdVariable = $item->translate($translator);
                    $translator->addInteractionToAction($interactionIdVariable, $actionIdVariable);
                    $translator->finishInteractionBody($interactionIdVariable);
                }
                
            }

        }
        
        $translator->finishActionBody($actionIdVariable);
        
        $translator->finishPropositionBody($propositionIdVariable);
        
        return $propositionIdVariable;

    }
    
}