<?php
class Model_Reader_Translator implements Model_Reader_ReaderInterface {
    
    /**
     * Аннотированное дерево синтаксического разбора
     * @var Model_AbstractPredicate 
     */
    private $annotatedTree;
    private $errors;
    private $translationStatements;
    private $translation;
    private $variableIndex;
    
    public function __construct(Model_Reader_SyntaxAnalysis_SyntaxAnalysis $syntaxAnalysis) {
        
        $this->annotatedTree = $syntaxAnalysis->getAnnotatedTree();
        $this->errors = $syntaxAnalysis->getErrors();
        $this->translationStatements = array();
        $this->translation = null;
        $this->variableIndex = 0;
        
        $this->translate();
    
    }
    
    public function getTranslation() {
        
        return $this->translation;
        
    }
    
    public function getErrors() {
        
        return $this->errors;
        
    }
    
    private function translate() {
        //var_dump($this->annotatedTree);
        $this->annotatedTree->translate($this);
        $this->translation = implode("\n",  $this->translationStatements);
        $this->translationStatements = null;
        //var_dump($this->translation);
        
    }

    public function addAuthor($author) {
        
        $authorIdVariable = $this->composeUniqueVariableName('$authorId');
        $this->translationStatements[] .= $authorIdVariable.' = $knowledge->addAuthor(\''.$author.'\');';
        
        return $authorIdVariable;
        
    }
    
    public function addMessage() {
        
        $messageIdVariable = $this->composeUniqueVariableName('$messageId');
        $this->translationStatements[] = $messageIdVariable.' = $knowledge->addMessage();';
        
        return $messageIdVariable;
        
    }
    
    public function addMessageToAuthor($messageIdVariable, $authorIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->addMessageToAuthor('.$messageIdVariable.', '.$authorIdVariable.');';
        
    }
    
    public function addProposition() {
        
        $propositionIdVariable = $this->composeUniqueVariableName('$propositionId');
        $this->translationStatements[] = $propositionIdVariable.' = $knowledge->addProposition();';
        
        return $propositionIdVariable;
        
    }
    
    public function beginPropositionBody($propositionIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->beginPropositionBody('.$propositionIdVariable.');';
        
    }

    public function finishPropositionBody($propositionIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->finishPropositionBody('.$propositionIdVariable.');';
        
    }
    
    public function addPropositionToMessage($propositionIdVariable, $messageIdVariable) {

        $this->translationStatements[] = '$knowledge->addPropositionToMessage('.$propositionIdVariable.', '.$messageIdVariable.');';
        
    }
    
    public function addAction($action) {
        
        $actionIdVariable = $this->composeUniqueVariableName('$actionId');
        $this->translationStatements[] = $actionIdVariable.' = $knowledge->addAction(\''.$action.'\');';
        
        return $actionIdVariable;
        
    }
    
    public function beginActionBody($actionIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->beginActionBody('.$actionIdVariable.');';
        
    }

    public function finishActionBody($actionIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->finishActionBody('.$actionIdVariable.');';
        
    }

    
    public function addSign($sign) {
        
        $signIdVaraiable = $this->composeUniqueVariableName('$signId');
        $this->translationStatements[] = $signIdVaraiable.' = $knowledge->addSign(\''.$sign.'\');';
        
        return $signIdVaraiable;
        
    }
    
    public function addSignToAction($signIdVaraiable, $actionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addSignToAction('.$actionIdVariable.', '.$signIdVaraiable.');';
        
    }
    
    public function addSignToDetail($signIdVaraiable, $detailIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addSignToDetail('.$signIdVaraiable.', '.$detailIdVariable.');';
        
    }
    
    public function addSignToDescription($signIdVaraiable, $descriptionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addSignToDescription('.$signIdVaraiable.', '.$descriptionIdVariable.');';
        
    }
    
    public function addActionToProposition($actionIdVariable, $propositionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addActionToProposition('.$actionIdVariable.', '.$propositionIdVariable.');';
        
    }
    
    public function addDetail($detail) {
        
        $detailIdVariable = $this->composeUniqueVariableName('$detailId');
        $this->translationStatements[] = $detailIdVariable.' = $knowledge->addDetail(\''.$detail.'\');';
        
        return $detailIdVariable;
       
    }
    
    public function addDetailToAction($detailIdVariable, $actionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addDetailToAction('.$detailIdVariable.', '.$actionIdVariable.');';
        
    }
    
    public function addDescription($description) {
        
        $descriptionIdVariable = $this->composeUniqueVariableName('$descriptionId');
        $this->translationStatements[] = $descriptionIdVariable.' = $knowledge->addDetail(\''.$description.'\');';
        
        return $detailIdVariable;
       
    }
    
    public function addDescriptionToDetail($descriptionIdVariable, $detailIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addDescriptionToDetail('.$descriptionIdVariable.', '.$detailIdVariable.');';
        
    }
    
    public function addSubdescriptionToDescription($subdescriptionIdVariable, $descriptionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addSubdescriptionToDescription('.$subdescriptionIdVariable.', '.$descriptionIdVariable.');';
        
    }
    
    public function addReference() {
        
        $referenceIdVariable = $this->composeUniqueVariableName('$referenceId');
        $this->translationStatements[] = $referenceIdVariable.' = $knowledge->addReference();';
        
        return $referenceIdVariable;
        
    }
    
    public function beginReferenceBody($referenceIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->beginReferenceBody('.$referenceIdVariable.');';
        
    }

    public function finishReferenceBody($referenceIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->finishReferenceBody('.$referenceIdVariable.');';
        
    }
    
    public function addPropositionToReference($propositionIdVariable, $referenceIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addPropositionToReference('.$propositionIdVariable.', '.$referenceIdVariable.');';
        
    }

    public function addReferenceToDetail($referenceIdVariable, $detailIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addReferenceToDetail('.$referenceIdVariable.', '.$detailIdVariable.');';
        
    }
    
    public function addInteraction() {
        
        $interactionIdVariable = $this->composeUniqueVariableName('$interactionId');
        $this->translationStatements[] = $interactionIdVariable.' = $knowledge->addInteraction();';
        
        return $interactionIdVariable;
        
    }
    
    public function beginInteractionBody($interactionIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->beginInteractionBody('.$interactionIdVariable.');';
        
    }

    public function finishInteractionBody($interactionIdVariable) {
        
        $this->translationStatements[] .= '$knowledge->finishInteractionBody('.$interactionIdVariable.');';
        
    }

    
    public function addPropositionToInteraction($propositionIdVariable, $interactionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addPropositionToInteraction('.$propositionIdVariable.', '.$interactionIdVariable.');';
        
    }

    public function addInteractionToAction($interactionIdVariable, $actionIdVariable) {
        
        $this->translationStatements[] = '$knowledge->addInteractionToAction('.$interactionIdVariable.', '.$actionIdVariable.');';
        
    }
    

    

    
    private function composeUniqueVariableName($prefix) {
        
        $this->variableIndex++;
        
        return $prefix.'_'.$this->variableIndex;
        
    }
    
}