<?php
class Data_Access_Graph_Cluster_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $datasetWielder;
    
    private $typeFactory;
    
    private $planeFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Service_Interface_DatasetWielder $datasetWielder,
        Data_Type_Graph_Cluster_Factory $typeFactory,
        Data_Type_Plane_Factory $planeFactory
    ) {

        $this->datasetWielder = $datasetWielder;
        
        $this->typeFactory = $typeFactory;
        
        $this->planeFactory = $planeFactory;
        
        $this->uniqueInstances = array();

    }
    
    public function makeAction() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Action(
                $this->datasetWielder,
                $this->typeFactory->makeActionFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeAction()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeAuthor() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Author(
                $this->datasetWielder,
                $this->typeFactory->makeAuthorFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeAuthor()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeCommunication() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Communication(
                $this->datasetWielder,
                $this->typeFactory->makeCommunicationFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeCommunication()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeComposition() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Composition(
                $this->datasetWielder,
                $this->typeFactory->makeCompositionFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeComposition()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDescription() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Description(
                $this->datasetWielder,
                $this->typeFactory->makeDescriptionFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeDescription()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDetail() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Detail(
                $this->datasetWielder,
                $this->typeFactory->makeDetailFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeDetail()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeInteraction() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Interaction(
                $this->datasetWielder,
                $this->typeFactory->makeInteractionFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeInteraction()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeMessage() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Message(
                $this->datasetWielder,
                $this->typeFactory->makeMessageFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeMessage()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeObject() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Object(
                $this->datasetWielder,
                $this->typeFactory->makeObjectFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeObject()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makePhrase() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Phrase(
                $this->datasetWielder,
                $this->typeFactory->makePhraseFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makePhrase()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeProposition() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Proposition(
                $this->datasetWielder,
                $this->typeFactory->makePropositionFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeProposition()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeReference() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Reference(
                $this->datasetWielder,
                $this->typeFactory->makeReferenceFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeReference()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeSign() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Sign(
                $this->datasetWielder,
                $this->typeFactory->makeSignFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeSign()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeWord() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Word(
                $this->datasetWielder,
                $this->typeFactory->makeWordFactory(),
                $this->makeOriginFinder(),
                $this->planeFactory->makeWord()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeOriginFinder() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Graph_Cluster_Collaborator_OriginFinder(
                $this->datasetWielder
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
}