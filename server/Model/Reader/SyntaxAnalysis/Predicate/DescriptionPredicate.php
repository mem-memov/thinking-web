<?php
class Model_Reader_SyntaxAnalysis_Predicate_DescriptionPredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {

        $descriptionIdVariable = $translator->addDescription($this->arguments[0]->getValue());
        
        // определения
        if (array_key_exists(1, $this->arguments)) {

            foreach ($this->arguments[1] as $item) {

                // определение
                if ($item instanceof Model_Reader_SyntaxAnalysis_Predicate_DescriptionPredicate) {
                    $subdescriptionIdVariable = $translator->addDescription($item->getValue());
                    $translator->addSubdescriptionToDescription($subdescriptionIdVariable, $descriptionIdVariable);
                }
                
            }
            
        }
        
        return $descriptionIdVariable;
        
    }
    
}