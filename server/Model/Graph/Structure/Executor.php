<?php
class Model_Graph_Structure_Executor 
implements Model_Reader_ReaderInterface
{
    
    private $messageStructure;
    
    private $actionFactory;
    private $authorFactory;
    private $communicationFactory;
    private $compositionFactory;
    private $descriptionFactory;
    private $detailFactory;
    private $interactionFactory;
    private $messageFactory;
    private $objectFactory;
    private $phraseFactory;
    private $propositionFactory;
    private $referenceFactory;
    private $signFactory;
    private $wordFactory;
    
    public function __construct(
        Model_Graph_Structure_Message $messageStructure,
        Data_Type_Graph_Cluster_ActionFactory $actionFactory,
        Data_Type_Graph_Cluster_AuthorFactory $authorFactory,
        Data_Type_Graph_Cluster_CommunicationFactory $communicationFactory,
        Data_Type_Graph_Cluster_CompositionFactory $compositionFactory,
        Data_Type_Graph_Cluster_DescriptionFactory $descriptionFactory,
        Data_Type_Graph_Cluster_DetailFactory $detailFactory,
        Data_Type_Graph_Cluster_InteractionFactory $interactionFactory,
        Data_Type_Graph_Cluster_MessageFactory $messageFactory,
        Data_Type_Graph_Cluster_ObjectFactory $objectFactory,
        Data_Type_Graph_Cluster_PhraseFactory $phraseFactory,
        Data_Type_Graph_Cluster_PropositionFactory $propositionFactory,
        Data_Type_Graph_Cluster_ReferenceFactory $referenceFactory,
        Data_Type_Graph_Cluster_SignFactory $signFactory,
        Data_Type_Graph_Cluster_WordFactory $wordFactory
    ) {
        
        $this->messageStructure = $messageStructure;
        
        $this->actionFactory = $actionFactory;
        $this->authorFactory = $authorFactory;
        $this->communicationFactory = $communicationFactory;
        $this->compositionFactory = $compositionFactory;
        $this->descriptionFactory = $descriptionFactory;
        $this->detailFactory = $detailFactory;
        $this->interactionFactory = $interactionFactory;
        $this->messageFactory = $messageFactory;
        $this->objectFactory = $objectFactory;
        $this->phraseFactory = $phraseFactory;
        $this->propositionFactory = $propositionFactory;
        $this->referenceFactory = $referenceFactory;
        $this->signFactory = $signFactory;
        $this->wordFactory = $wordFactory;
        
    }
    
    public function getMessageStructure() {
        
        return $this->messageStructure;
        
    }
    
    // Model_Reader_ReaderInterface : START ---------------------------------
    
    public function addAuthor($author) {
        
        if (!is_string($author)) {
            throw new Model_Graph_Structure_Exception('В качестве имени автора передан неверный тип.');
        }
        
        $authorId = $this->authorFactory->makeCluster();
        $phraseId = $this->addPhrase($author);
        $phraseId->setAuthor($authorId);
        $authorId->setPhrase($phraseId);
        $this->messageStructure->setAuthor($authorId);
        
        return $authorId;

    }

    public function addMessage() {

        $messageId = $this->messageFactory->makeCluster();
        $this->messageStructure->setMessage($messageId);
        
        return $messageId;

    }

    public function addMessageToAuthor($messageId, $authorId) {
        
        $messageId instanceof Data_Type_Graph_Cluster_Message;
        $authorId instanceof Data_Type_Graph_Cluster_Author;
        
        $messageId->setAuthor($authorId);
        $authorId->addMessage($messageId);

    }

    public function addProposition() {

        $propositionId = $this->propositionFactory->makeCluster();
        
        $authorId = $this->messageStructure->getAuthor();
        $authorId instanceof Data_Type_Graph_Cluster_Author;
        $propositionId->setAuthor($authorId);
        $authorId->addProposition($propositionId);
        
        $this->messageStructure->addProposition($propositionId);

        return $propositionId;

    }
    
    public function beginPropositionBody($propositionId) {}

    public function finishPropositionBody($propositionId) {}

    public function addPropositionToMessage($propositionId, $messageId) {

        $propositionId instanceof Data_Type_Graph_Cluster_Proposition;
        $messageId instanceof Data_Type_Graph_Cluster_Message;

        $propositionId->setMessage($messageId);
        $messageId->addProposition($propositionId);

    }

    public function addAction($action) {

        $actionId = $this->actionFactory->makeCluster();
        $phraseId = $this->addPhrase($action);

        $actionId->setPhrase($phraseId);
        $phraseId->setAction($actionId);
        
        $this->messageStructure->addAction($actionId);
        
        return $actionId;
        
    }
    
    public function beginActionBody($actionId) {}

    public function finishActionBody($actionId) {}


    public function addSign($sign) {

        $signId = $this->signFactory->makeCluster();
        
        $this->messageStructure->addSign($signId);

        return $signId;

    }

    public function addSignToAction($signId, $actionId) {

        $signId instanceof Data_Type_Graph_Cluster_Sign;
        $actionId instanceof Data_Type_Graph_Cluster_Action;
        
        $signId->setAction($actionId);
        $actionId->setSign($signId);
        
    }

    public function addSignToDetail($signId, $detailId) {

        $signId instanceof Data_Type_Graph_Cluster_Sign;
        $detailId instanceof Data_Type_Graph_Cluster_Detail;
        
        $signId->setDetail($detailId);
        $detailId->setSign($signId);

    }
    
    public function addSignToDescription($signId, $descriptionId) {

        $signId instanceof Data_Type_Graph_Cluster_Sign;
        $descriptionId instanceof Data_Type_Graph_Cluster_Description;
        
        $signId->setDescription($descriptionId);
        $descriptionId->setSign($signId);

    }

    public function addActionToProposition($actionId, $propositionId) {

        $actionId instanceof Data_Type_Graph_Cluster_Action;
        $propositionId instanceof Data_Type_Graph_Cluster_Proposition;
        
        $actionId->setProposition($propositionId);
        $propositionId->addAction($actionId);
        
    }

    public function addDetail($detail) {
   
        $detailId = $this->detailFactory->makeCluster();
        $phraseId = $this->addPhrase($detail);
        $phraseId->setDetail($detailId);
        $detailId->setPhrase($phraseId);
        
        $this->messageStructure->addDetail($detailId);

        return $detailId;

    }

    public function addDetailToAction($detailId, $actionId) {

        $detailId instanceof Data_Type_Graph_Cluster_Detail;
        $actionId instanceof Data_Type_Graph_Cluster_Action;
        
        $detailId->setAction($actionId);
        $actionId->addDetail($detailId);
        
    }

    public function addDescription($description) {
      
        $descriptionId = $this->descriptionFactory->makeCluster();
        
        $descriptionId instanceof Data_Type_Graph_Cluster_Interface_HelpfulOrderedTypeId;
        if (!$descriptionId->canProvideNextNumber()) {
            $descriptionId->setNumber(0);
        }
        
        $phraseId = $this->addPhrase($description);
        $descriptionId->setPhrase($phraseId);
        $phraseId->setDescription($descriptionId);
        
        $this->messageStructure->addDescription($descriptionId);

        return $descriptionId;

    }

    public function addDescriptionToDetail($descriptionId, $detailId) {

        $descriptionId instanceof Data_Type_Graph_Cluster_Description;
        $detailId instanceof Data_Type_Graph_Cluster_Detail;
        
        $detailId->addDescription($descriptionId);
        $descriptionId->setDetail($detailId);

    }

    public function addSubdescriptionToDescription($subdescriptionId, $descriptionId) {

        $descriptionId instanceof Data_Type_Graph_Cluster_Interface_HelpfulOrderedTypeId;
        $subdescriptionId instanceof Data_Type_Graph_Cluster_Interface_HelpfulOrderedTypeId;
        
        $subdescriptionId->setNumber($descriptionId->provideNextNumber());
        
        $subdescriptionId instanceof Data_Type_Graph_Cluster_Description;
        $descriptionId instanceof Data_Type_Graph_Cluster_Description;
        
        $subdescriptionId->addDescription($descriptionId);
        $descriptionId->addSubdescription($subdescriptionId);

    }

    public function addReference() {

        $referenceId = $this->referenceFactory->makeCluster();
        
        $this->messageStructure->addReference($referenceId);

        return $referenceId;

    }
    
    public function beginReferenceBody($referenceId) {}

    public function finishReferenceBody($referenceId) {}


    public function addPropositionToReference($propositionId, $referenceId) {
        
        $propositionId instanceof Data_Type_Graph_Cluster_Proposition;
        $referenceId instanceof Data_Type_Graph_Cluster_Reference;
        
        $propositionId->setReference($referenceId);
        $referenceId->addProposition($propositionId);

    }

    public function addReferenceToDetail($referenceId, $detailId) {

        $referenceId instanceof Data_Type_Graph_Cluster_Reference;
        $detailId instanceof Data_Type_Graph_Cluster_Detail;

        $referenceId->setDetail($detailId);
        $detailId->addReference($referenceId);

    }

    public function addInteraction() {

        $interactionId = $this->interactionFactory->makeCluster();
        
        $this->messageStructure->addInteraction($interactionId);

        return $interactionId;

    }
    
    public function beginInteractionBody($interactionId) {}

    public function finishInteractionBody($interactionId) {}


    public function addPropositionToInteraction($propositionId, $interactionId) {

        $propositionId instanceof Data_Type_Graph_Cluster_Proposition;
        $interactionId instanceof Data_Type_Graph_Cluster_Interaction;
        
        $propositionId->setIteraction($interactionId);
        $interactionId->addProposition($propositionId);

    }

    public function addInteractionToAction($interactionId, $actionId) {

        $interactionId instanceof Data_Type_Graph_Cluster_Interaction;
        $actionId instanceof Data_Type_Graph_Cluster_Action;
        
        $interactionId->setAction($actionId);
        $actionId->addInteraction($interactionId);
        
        
    }

    // Model_Reader_ReaderInterface : STOP ---------------------------------
    

    private function addPhrase($phrase) {

        $phraseId = $this->phraseFactory->makeCluster();
        $words = explode(' ', $phrase);
        foreach ($words as $index => $word) {
            $compositionId = $this->addComposition($word, $index+1);
            $phraseId->addComposition($compositionId);
            $compositionId->setPhrase($phraseId);
        }
        $this->messageStructure->addPhrase($phraseId);
        
        return $phraseId;

    }
    
    /**
     *
     * @param string $word слово
     * @param string $number порядковый номер слова в фразе, начиная с 1
     * @return Data_Type_Graph_Cluster_Composition
     */
    private function addComposition($word, $number) {
        
        // создаем композиционныей кластер
        $compositionId = $this->compositionFactory->makeCluster();
        
        // создаём словесный кластер
        $wordId = $this->addWord($word);
        
        // сплетаем слово и композицию
        $compositionId->setWord($wordId);
        $compositionId->setNumber($number);

        // добавляем композицию в структуру
        $this->messageStructure->addComposition($compositionId);
        
        // возвращаем композицию
        return $compositionId;

    }
    
    private function addWord($word) {
        
        $wordId = $this->wordFactory->makeCluster();
        $wordId->setId($word);
        $this->messageStructure->addWord($wordId);

        return $wordId;

    }

    
    
}
