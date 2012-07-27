<?php
interface Model_Reader_ReaderInterface {

    public function addAuthor($author);
    
    public function addMessage();
    
    public function addMessageToAuthor($messageIdVariable, $authorIdVariable);
    
    public function addProposition();
    
    public function beginPropositionBody($propositionIdVariable);
    
    public function finishPropositionBody($propositionIdVariable);
    
    public function addPropositionToMessage($propositionIdVariable, $messageIdVariable);
    
    public function addAction($action);
    
    public function beginActionBody($actionIdVariable);
    
    public function finishActionBody($actionIdVariable);
    
    public function addSign($sign);
    
    public function addSignToAction($signIdVaraiable, $actionIdVariable);
    
    public function addSignToDetail($signIdVaraiable, $detailIdVariable);
    
    public function addSignToDescription($signIdVaraiable, $descriptionIdVaraiable);
    
    public function addActionToProposition($actionIdVariable, $propositionIdVariable);
    
    public function addDetail($detail);
    
    public function addDetailToAction($detailIdVariable, $actionIdVariable);
    
    public function addDescription($description);
    
    public function addDescriptionToDetail($descriptionIdVariable, $detailIdVariable);
    
    public function addSubdescriptionToDescription($subdescriptionIdVariable, $descriptionIdVariable);
    
    public function addReference();
    
    public function beginReferenceBody($referenceIdVariable);
    
    public function finishReferenceBody($referenceIdVariable);
    
    public function addPropositionToReference($propositionIdVariable, $referenceIdVariable);

    public function addReferenceToDetail($referenceIdVariable, $detailIdVariable);
    
    public function addInteraction();
    
    public function beginInteractionBody($interactionIdVariable);
    
    public function finishInteractionBody($interactionIdVariable);
    
    public function addPropositionToInteraction($propositionIdVariable, $interactionIdVariable);

    public function addInteractionToAction($interactionIdVariable, $actionIdVariable);
    
}