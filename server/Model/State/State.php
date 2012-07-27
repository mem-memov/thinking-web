<?php
class Model_State_State 
implements 
    Model_State_GettingInterface,
    Model_Reader_ReaderInterface 
{

    private $identifierFactory;
    private $connectionSpace;
    private $structureFactory;
    
    private $wordIds;
    private $words;
    
    /** Идентификаторы главных предложений сообщения @var array */
    private $mainPropositionIds;
    /** Идентификаторы виртуальных объектов, по одному на каждую ссылку @var array */
    private $objects;
    /** Идентификаторы ссылочных предложений @var array */
    private $referencePropositions;
    /** Индексы главный предложений для соответствующих индексов ссылочныйх предложений @var array */
    private $referencePositions;
    private $referencedDetailIds;
    /** Буфер для накопления ссылочных предложений внутри главного @var array */
    private $referencePropositionBuffer;
    
    private $currentAuthorId;
    private $currentPropositionId;
    private $currentActionId;
    private $currentReferenceId;
    private $currentReferencedDetailId;
    private $currentReferencingDetailId;
    private $currentInteractionId;
    
    /** Идентификатор текущего продложения в конце @var array */
    private $propositionStack;
    
    private $propositionCount;
    
    public function __construct(
        Model_State_Identifier_Factory $identifierFactory,
        Model_State_Connection_Space $connectionSpace,
        Model_State_Structure_Factory $structureFactory
    ) {
        
        $this->identifierFactory = $identifierFactory;
        $this->connectionSpace = $connectionSpace;
        $this->structureFactory = $structureFactory;
        
        $this->wordIds = array();
        $this->words = array();
        $this->mainPropositionIds = array();
        $this->objects = array();
        $this->referencePropositions = array();
        $this->referencedDetailIds = array();
        $this->referencePositions = array();
        
        $this->referencePropositionBuffer = array();
        
        $this->currentAuthorId = null;
        $this->currentPropositionId = null;
        $this->currentActionId = null;
        $this->currentReferenceId = null;
        $this->currentReferencedDetailId = null;
        $this->currentReferencingDetailId = null;
        $this->currentInteractionId = null;
        
        $this->propositionStack = array();
        
        $this->propositionCount = 0;

    }
    
    
    
    // Model_State_GettingInterface : START ---------------------------------
    
    public function getVagueClusters() {

        return $this->connectionSpace->getVagueClusters();
        
    }
    
    public function getProgressiveClusters() {

        return $this->connectionSpace->getProgressiveClusters();
        
    }
    
    public function getObjectsAndPropositionStructuresAndPositionsAndDetails() {
        
        $propositionStructures = array();
        
        foreach ($this->referencePropositions as $referencePropositions) {
           
            $list = array();
            
            foreach ($referencePropositions as $referenceProposition) {
                
                $propositionStructure = $this->structureFactory->makePropositionStructure();
                $propositionStructure->fillUsingConnectionSpace($referenceProposition, $this->connectionSpace);

                $list[] = $propositionStructure;
                
            }
            
            
            $propositionStructures[] = $list;
            
        }
        
        return array($this->objects, $propositionStructures, $this->referencePositions, $this->referencedDetailIds);
        
    }
    
    public function getPropositionStructures() {
        
        $propositionStructures = array();
        
        foreach ($this->mainPropositionIds as $mainPropositionId) {
            
            $propositionStructure = $this->structureFactory->makePropositionStructure();
            $propositionStructure->fillUsingConnectionSpace($mainPropositionId, $this->connectionSpace);

            $propositionStructures[] = $propositionStructure;
            
        }

        return $propositionStructures;
        
    }
    
    public function hasReverseConnection(
        Model_State_Identifier_Identifier $origin,
        Model_State_Identifier_Identifier $target
    ) {
        
        return $this->connectionSpace->hasReverseConnection($origin, $target);
        
    }
    
    public function getTailPropositionStructures(
        Service_Interface_DatasetWielder $datasetWielder  
    ) {
        
        $tailPropositionStructures = array();
        
        $tail = $datasetWielder->getProgressTailUsingExample(
            $this->currentAuthorId, 
            $this->identifierFactory->makePropositionIdentifier(),
            5,
            $this->propositionCount
        );

        foreach ($tail as $propositionId) {
            
            $propositionStructure = $this->structureFactory->makePropositionStructure();
            
            $propositionIdentifier = $this->identifierFactory->makePropositionIdentifier();
            $propositionIdentifier->setId($propositionId);
            
            
            $propositionStructure->fillUsingDatasetWielder($propositionIdentifier, $datasetWielder);
            
            $tailPropositionStructures[] = $propositionStructure;
            
        }
        
        return $tailPropositionStructures;
        
    }
    
    public function getSubject() {
        
        return $this->currentAuthorId;
        
    }
    
    public function getConnections() {
        
        return $this->connectionSpace->getConnections();
        
    }
    
    // Model_State_GettingInterface : END ---------------------------------
    
    
    
    // Model_Reader_ReaderInterface : START ---------------------------------
    
    public function addAuthor($author) {

        $authorId = $this->identifierFactory->makeAuthorIdentifier($author);
        $phraseId = $this->addPhrase($author);
        $this->connectionSpace->addConnection($phraseId, $authorId);
        $this->connectionSpace->addConnection($authorId, $phraseId);
        $this->currentAuthorId = $authorId;
      
        return $authorId;

    }

    public function addMessage() {

        $messageId = $this->identifierFactory->makeMessageIdentifier();
        
        return $messageId;

    }

    public function addMessageToAuthor($messageId, $authorId) {

        $this->connectionSpace->addConnection($messageId, $authorId);
        $this->connectionSpace->addConnection($authorId, $messageId);

    }

    public function addProposition() {

        $propositionId = $this->identifierFactory->makePropositionIdentifier();

        $this->connectionSpace->addConnection($this->currentAuthorId, $propositionId);
        $this->connectionSpace->addConnection($propositionId, $this->currentAuthorId);
        
        if (!is_null($this->currentReferenceId)) {
            $this->referencePropositionBuffer[] = $propositionId;
        } else {
            $this->mainPropositionIds[] = $propositionId;
        }
        
        $this->propositionCount++;

        return $propositionId;

    }
    
    public function beginPropositionBody($propositionId) {
        
        if (!is_null($this->currentPropositionId)) {
            array_push($this->propositionStack, $this->currentPropositionId);
        }

        $this->currentPropositionId = $propositionId;
        
    }

    public function finishPropositionBody($propositionId) {
        
        if (!empty($this->propositionStack)) {
            $this->currentPropositionId = array_pop($this->propositionStack);
        } else {
            $this->currentPropositionId = null;
        }
        
    }

    public function addPropositionToMessage($propositionId, $messageId) {

        $this->connectionSpace->addConnection($propositionId, $messageId);
        $this->connectionSpace->addConnection($messageId, $propositionId);

    }

    public function addAction($action) {

        $actionId = $this->identifierFactory->makeActionIdentifier($action);
        $phraseId = $this->addPhrase($action);
        $this->connectionSpace->addConnection($actionId, $phraseId);
        $this->connectionSpace->addConnection($phraseId, $actionId);

        return $actionId;
        
    }
    
    public function beginActionBody($actionId) {
        
        $this->currentActionId = $actionId;
        
    }

    public function finishActionBody($actionId) {
        
        $this->currentActionId = null;
        
    }


    public function addSign($sign) {

        $signId = $this->identifierFactory->makeSignIdentifier($sign);

        return $signId;

    }

    public function addSignToAction($signId, $actionId) {

        $this->connectionSpace->addConnection($signId, $actionId);
        $this->connectionSpace->addConnection($actionId ,$signId);
        
    }

    public function addSignToDetail($signId, $detailId) {

        $this->connectionSpace->addConnection($signId, $detailId);
        $this->connectionSpace->addConnection($detailId, $signId);

    }

    public function addSignToDescription($signId, $descriptionId) {

        $this->connectionSpace->addConnection($signId, $descriptionId);
        $this->connectionSpace->addConnection($descriptionId, $signId);

    }

    public function addActionToProposition($actionId, $propositionId) {

        $this->connectionSpace->addConnection($actionId, $propositionId);
        $this->connectionSpace->addConnection($propositionId, $actionId);
        
    }

    public function addDetail($detail) {

        $detailId = $this->identifierFactory->makeDetailIdentifier($detail);
        $phraseId = $this->addPhrase($detail);
        $this->connectionSpace->addConnection($detailId, $phraseId);
        $this->connectionSpace->addConnection($phraseId, $detailId);
        
        if(!is_null($this->currentActionId)) {
            $this->connectionSpace->addConnection($detailId, $this->currentActionId);
            $this->connectionSpace->addConnection($this->currentActionId, $detailId);
        }

        if(!is_null($this->currentPropositionId)) { 
            $this->connectionSpace->addConnection($detailId, $this->currentPropositionId);
            $this->connectionSpace->addConnection($this->currentPropositionId, $detailId);
        }

        return $detailId;

    }

    public function addDetailToAction($detailId, $actionId) {

        $this->connectionSpace->addConnection($detailId, $actionId);
        $this->connectionSpace->addConnection($actionId, $detailId);
        
        if(!is_null($this->currentReferenceId) && is_null($this->currentReferencedDetailId)) {
            $this->currentReferencedDetailId = $detailId;
        }
        
    }

    public function addDescription($description) {

        $descriptionId = $this->identifierFactory->makeDescriptionIdentifier($description);
        $phraseId = $this->addPhrase($description);
        $this->connectionSpace->addConnection($descriptionId, $phraseId);
        $this->connectionSpace->addConnection($phraseId, $descriptionId);
        
        if(!is_null($this->currentActionId)) {
            $this->connectionSpace->addConnection($descriptionId, $this->currentActionId);
            $this->connectionSpace->addConnection($this->currentActionId, $descriptionId);
        }

        if(!is_null($this->currentPropositionId)) {
            $this->connectionSpace->addConnection($descriptionId, $this->currentPropositionId);
            $this->connectionSpace->addConnection($this->currentPropositionId, $descriptionId);
        }

        return $descriptionId;

    }

    public function addDescriptionToDetail($descriptionId, $detailId) {

        $this->connectionSpace->addConnection($descriptionId, $detailId);
        $this->connectionSpace->addConnection($detailId, $descriptionId);

    }

    public function addSubdescriptionToDescription($subdescriptionId, $descriptionId) {

        $this->connectionSpace->addConnection($subdescriptionId, $descriptionId);

    }

    public function addReference() {

        $referenceId = $this->identifierFactory->makeReferenceIdentifier();

        return $referenceId;

    }
    
    public function beginReferenceBody($referenceId) {

        $this->currentReferenceId = $referenceId;
        
    }

    public function finishReferenceBody($referenceId) {

        if (!is_null($this->currentReferencingDetailId) && !is_null($this->currentReferencedDetailId)) {
            
            $objectId = $this->identifierFactory->makeObjectIdentifier();
            
            $this->objects[] = $objectId;
            $this->referencePropositions[] = $this->referencePropositionBuffer;
            $this->referencedDetailIds[] = $this->currentReferencedDetailId;
            $this->referencePropositionBuffer = array();
            $this->referencePositions[] = count($this->mainPropositionIds) - 1;

            $this->connectionSpace->addConnection($objectId, $referenceId);
            $this->connectionSpace->addConnection($referenceId, $objectId);

            $this->connectionSpace->addConnection($objectId, $this->currentPropositionId);
            $this->connectionSpace->addConnection($this->currentPropositionId, $objectId);
            
            $this->connectionSpace->addConnection($objectId, $this->currentReferencingDetailId);
            $this->connectionSpace->addConnection($this->currentReferencingDetailId, $objectId);
            
            $this->connectionSpace->addConnection($objectId, $this->currentReferencedDetailId);
            $this->connectionSpace->addConnection($this->currentReferencedDetailId, $objectId);
            
            $this->connectionSpace->addConnection($objectId, $this->currentAuthorId);
            $this->connectionSpace->addConnection($this->currentAuthorId, $objectId);
            
        }
        
        $this->currentReferenceId = null;
        $this->currentReferencingDetailId = null;
        $this->currentReferencedDetailId = null;
        
    }


    public function addPropositionToReference($propositionId, $referenceId) {

        $this->connectionSpace->addConnection($propositionId, $referenceId);
        $this->connectionSpace->addConnection($referenceId, $propositionId);

    }

    public function addReferenceToDetail($referenceId, $detailId) {

        $this->connectionSpace->addConnection($referenceId, $detailId);
        $this->connectionSpace->addConnection($detailId, $referenceId);

        if(is_null($this->currentReferencingDetailId)) {
            $this->currentReferencingDetailId = $detailId;
        }

    }

    public function addInteraction() {

        $interactionId = $this->identifierFactory->makeInteractionIdentifier();

        return $interactionId;

    }
    
    public function beginInteractionBody($interactionId) {
        
        $this->currentInteractionId = $interactionId;
        
    }

    public function finishInteractionBody($interactionId) {
        
        $this->currentInteractionId = null;
        
    }


    public function addPropositionToInteraction($propositionId, $interactionId) {

        $this->connectionSpace->addConnection($propositionId, $interactionId);
        $this->connectionSpace->addConnection($interactionId, $propositionId);

    }

    public function addInteractionToAction($interactionId, $actionId) {

        $this->connectionSpace->addConnection($interactionId, $actionId);
        $this->connectionSpace->addConnection($actionId, $interactionId);
        
    }

    // Model_Reader_ReaderInterface : STOP ---------------------------------
    
    
    
    private function addPhrase($phrase) {

        $phraseId = $this->identifierFactory->makePhraseIdentifier();
        
        $words = explode(' ', $phrase);

        foreach ($words as $word) {
            $wordId = $this->addWord($word);
            $this->addWordToPhrase($wordId, $phraseId);
        }
        
        return $phraseId;

    }
    
    private function addWord($word) {
        
        $index = array_search($word, $this->words);
        
        if ($index !== false) {
            
            return $this->wordIds[$index];
            
        }
        
        $wordId = $this->identifierFactory->makeWordIdentifier();
        $wordId->setId($word);
        $this->wordIds[] = $wordId;
        $this->words[] = $word;
        
        return $wordId;

    }
    
    private function addWordToPhrase($wordId, $phraseId) {
        
        $this->connectionSpace->addConnection($wordId, $phraseId);
        $this->connectionSpace->addConnection($phraseId, $wordId);
        
    }
 
}