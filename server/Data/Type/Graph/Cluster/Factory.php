<?php
class Data_Type_Graph_Cluster_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    private $planeFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Data_Type_Plane_Factory $planeFactory
    ) {

        $this->uniqueInstances = array();
        
        $this->planeFactory = $planeFactory;

    }
    
    public function makeActionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_ActionFactory(
                $this->planeFactory->makeAction()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeAuthorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_AuthorFactory(
                $this->planeFactory->makeAuthor()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeCommunicationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_CommunicationFactory(
                $this->planeFactory->makeCommunication()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeCompositionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_CompositionFactory(
                $this->planeFactory->makeComposition()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDescriptionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_DescriptionFactory(
                $this->planeFactory->makeDescription()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeDetailFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_DetailFactory(
                $this->planeFactory->makeDetail()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeInteractionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_InteractionFactory(
                $this->planeFactory->makeInteraction()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_MessageFactory(
                $this->planeFactory->makeMessage()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeObjectFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_ObjectFactory(
                $this->planeFactory->makeObject()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makePhraseFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_PhraseFactory(
                $this->planeFactory->makePhrase()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makePropositionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_PropositionFactory(
                $this->planeFactory->makeProposition()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeReferenceFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_ReferenceFactory(
                $this->planeFactory->makeReference()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeSignFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_SignFactory(
                $this->planeFactory->makeSign()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    public function makeWordFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Graph_Cluster_WordFactory(
                $this->planeFactory->makeWord()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
   
}