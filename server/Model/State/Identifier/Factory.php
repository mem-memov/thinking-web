<?php
class Model_State_Identifier_Factory {
    
    private $planeFactory;
    
    public function __construct(
        Model_State_Plane_Factory $planeFactory
    ) {
        
        $this->planeFactory = $planeFactory;
        
    }
    
    public function makeAuthorIdentifier() {

        return new Model_State_Identifier_Identifier(
           $this->planeFactory->makeSubject()
        );
        
    }
    
    public function makeMessageIdentifier() {

        return new Model_State_Identifier_Identifier(
           $this->planeFactory->makeCommunication()
        );
        
    }
    
    public function makePropositionIdentifier() {

        return new Model_State_Identifier_Identifier(
           $this->planeFactory->makeProposition()
        );
        
    }
    
    public function makeActionIdentifier() {

        return new Model_State_Identifier_Identifier(
           $this->planeFactory->makeAction()
        );
        
    }
    
    public function makeSignIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeSign()
        );
        
    }
    
    public function makeDetailIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeDetail()
        );
        
    }
    
    public function makeDescriptionIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeDescription()
        );
        
    }
    
    public function makeReferenceIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeReference()
        );
        
    }
    
    public function makeInteractionIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeInteraction()
        );
        
    }
    
    public function makePhraseIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makePhrase()
        );
        
    }
    
    public function makeWordIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeWord()
        );
        
    }
    
    public function makeObjectIdentifier() {

        return new Model_State_Identifier_Identifier(
            $this->planeFactory->makeObject()
        );
        
    }

}