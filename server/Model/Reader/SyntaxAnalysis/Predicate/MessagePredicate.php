<?php
class Model_Reader_SyntaxAnalysis_Predicate_MessagePredicate extends Model_Reader_SyntaxAnalysis_Predicate_AbstractPredicate {
    
    public function translate(Model_Reader_ReaderInterface $translator) {
       
        // автор
        $authorIdVariable = $this->arguments[0]->translate($translator);
        
        // сообщение
        $messageIdVariable = $translator->addMessage();
        
        // добавляем сообщение автору
        $translator->addMessageToAuthor($messageIdVariable, $authorIdVariable);
        
        // предложения
        foreach ($this->arguments[1] as $proposition) {
            $propositionIdVariable = $proposition->translate($translator);
            // добавляем предложение к сообщению
            $translator->addPropositionToMessage($propositionIdVariable, $messageIdVariable);
        }
        
    }
    
}