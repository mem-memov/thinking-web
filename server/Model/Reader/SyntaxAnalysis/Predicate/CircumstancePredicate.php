<?php
class Model_Reader_SyntaxAnalysis_Predicate_CircumstancePredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {

        // уточнение
        $detailIdVariable = $this->arguments[0]->translate($translator);

        
        // определения и ссылки
        if (array_key_exists(1, $this->arguments)) {

            foreach ($this->arguments[1] as $item) {
              
                // определение
                if ($item instanceof Model_Reader_SyntaxAnalysis_Predicate_DescriptionPredicate) {
                    $descriptionIdVariable = $item->translate($translator);
                    $translator->addDescriptionToDetail($descriptionIdVariable, $detailIdVariable);
                }

                // ссылка
                if ($item instanceof Model_Reader_SyntaxAnalysis_Predicate_ReferencePredicate) {
                    $referenceIdVariable = $item->translate($translator);
                    $translator->addReferenceToDetail($referenceIdVariable, $detailIdVariable);
                    $translator->finishReferenceBody($referenceIdVariable);
                }
                
            }
            
        }
        
        
        
        
        
        
        
        if(isset($this->arguments[1])){
        //var_dump($this->arguments[1]);
        }
        
        
        return $detailIdVariable;

    }
    
}